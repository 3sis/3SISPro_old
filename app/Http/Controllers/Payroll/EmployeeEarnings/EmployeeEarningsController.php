<?php

namespace App\Http\Controllers\Payroll\EmployeeEarnings;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
// Utilities
use Illuminate\Support\Carbon;
use Auth;
use Validator;
use DataTables;
// Traits
use App\Traits\Payroll\EmployeeEarnings\employeeEarningsDbOperations;
use App\Traits\TablesSchema3SIS\tablesSchema3SIS;

class EmployeeEarningsController extends Controller
{
    protected  $gCompanyId = '1000';
    use employeeEarningsDbOperations, tablesSchema3SIS;
    function Index(){
        
        $data = $this->dataTableXLSchemaTrait();        
        return view('Payroll.EmployeeEarnings.employeeEarnings')->with($data);
    }
    function BrowserData(){
        $BrowserDataTable = $this->PMEE11BrowserDataTrait();
        return DataTables::of($BrowserDataTable)
        ->addColumn('action', function($EmployeeMaster){
            return '<a href="#" class="btn mr-1 btnEditRec3SIS edit" id="'.$EmployeeMaster->EMGIHUniqueId.'">Edit
                        <i class="fas fa-edit fa-xs"></i>
                    </a>';
        })
        ->make(true);
    }
    function FetchData(Request $request){
        // Get Header Info
        $fethchedData = $this->PMEE11FethchEditedDataTrait($request);
        
        // Delete Mem Tables
        $this->PMEE11DeleteMemTablesTrait($request);
        // Append Actual table to mem Table
        $this->UpdateMemTableIncome($request);
        
        $this->UpdateMemTableDeduction($request);
        echo json_encode($fethchedData);
    }
    // Income Sub Form Methods
    function BrowserSubFormIncome(Request $request){
        // echo 'Data Submitted at Trait.';
        // return $request->input();
        // die();
        $BrowserDataTable = $this->PMEE11BrowserSubFormIncomeTrait($request);
        return DataTables::of($BrowserDataTable)
        ->addColumn('action', function($MemEmployeeIncome){
            return '<a href="#" class="btn mr-1 btnEditRec3SIS edit_income" id="'.$MemEmployeeIncome->EEIMDUniqueId.'">Edit
                        <i class="fas fa-edit fa-xs"></i>
                    </a>
                    <a href="#" class="btn btnDeleteRec3SIS delete_income" id="'.$MemEmployeeIncome->EEIMDUniqueId.'">Del
                        <i class="far fa-trash-alt fa-xs"></i>
                    </a>';
        })
        ->make(true);
    }
    // Deduction Sub Form Methods
    function BrowserSubFormDeduction(Request $request){
        // echo 'Data Submitted at Trait.';
        // return $request->input();
        // die();
        $BrowserDataTable = $this->PMEE11BrowserSubFormDeductionTrait($request);
        return DataTables::of($BrowserDataTable)
        ->addColumn('action', function($MemEmployeeDeduction){
            return '<a href="#" class="btn mr-1 btnEditRec3SIS edit_deduction" id="'.$MemEmployeeDeduction->EEDMDUniqueId.'">Edit
                        <i class="fas fa-edit fa-xs"></i>
                    </a>
                    <a href="#" class="btn btnDeleteRec3SIS delete_deduction" id="'.$MemEmployeeDeduction->EEDMDUniqueId.'">Del
                        <i class="far fa-trash-alt fa-xs"></i>
                    </a>';
        })
        ->make(true);
    }
    function PostSubFormDataIncome(Request $request){
        echo 'Data Submitted.';
        return $request->input();
        die();
        $this->ConvertScreenVariablesIncome($request);
        $errorOutput = '';        
        $validator = Validator::make($request->all(), [
            'EEIMDIncomeId'         =>  'required',
            'EEIMDEffectiveFrom'    =>  'required',
            'EEIMDEffectiveTo'      =>  'required|after:EEIMDEffectiveFrom',
            'EEIMDGrossIncome'      =>  'required',
            'EEIMDPayrollIncome'    =>  'required',
        ]);

        if(!$validator->passes()){
            return response()->json(['status'=>0, 'error'=>$validator->errors()->toArray(), 'ErrorOutput'=>$errorOutput]);
        }
        // Check for duplicate entry
        $DuplicateFound = $this->PMEE11CheckDuplicateIncomeTrait($request);
        if ($DuplicateFound != '') {
            $errorOutput = 'DUPLICATE - This Entry Exist at line no. : '.$DuplicateFound->EEIMDLineNo;
            return response()->json(['status'=>0, 'ErrorOutput'=>$errorOutput]);
        }
        // Check for duplicate entry Ends*****
        $UniqueId = $this->PMEE11AddUpdateMemIncomeTrait($request);
        // echo 'Last Inserted Record. : ' .$UniqueId;
        // die();
        if($request->get('button_action_DetailEntry1') == 'insert')
        {
            return response()->json(['status'=>1, 'Id'=>$request->get('EEIMDIncomeId'), 
                'Desc1'=>'',
                'masterName'=>'Employee Income ', 'updateMode'=>'Added']);
        }
        // When edit button is pushed
        if($request->get('button_action_DetailEntry1') == 'update')
        {
            return response()->json(['status'=>1, 'Id'=>$request->get('EEIMDIncomeId'), 
                'Desc1'=>'',
                'masterName'=>'Employee Income ', 'updateMode'=>'Updated']);
        }     
        
    }
    function PostSubFormDataDeduction(Request $request){
        // echo 'Data Submitted.';
        // return $request->input();
        // die();
        $this->ConvertScreenVariablesDeduction($request);
        $errorOutput = '';        
        $validator = Validator::make($request->all(), [
            'EEDMDDeductionId'          =>  'required',
            'EEDMDEffectiveFrom'        =>  'required',
            'EEDMDEffectiveTo'          =>  'required|after:EEDMDEffectiveFrom',
            'EEDMDGrossDeduction'       =>  'required',
            'EEDMDPayrollDeduction'     =>  'required',
        ]);

        if(!$validator->passes()){
            return response()->json(['status'=>0, 'error'=>$validator->errors()->toArray(), 'ErrorOutput'=>$errorOutput]);
        }
        // Check for duplicate entry
        $DuplicateFound = $this->PMEE11CheckDuplicateTraitDeduction($request);
        if ($DuplicateFound != '') {
            $errorOutput = 'DUPLICATE - This Entry Exist at line no. : '.$DuplicateFound->EEDMDLineNo;
            return response()->json(['status'=>0, 'ErrorOutput'=>$errorOutput]);
        }
        // Check for duplicate entry Ends*****
        $UniqueId = $this->PMEE11AddUpdateMemDeductionTrait($request);
        if($request->get('button_action_DetailEntry2') == 'insert')
        {
            return response()->json(['status'=>1, 'Id'=>$request->get('EEDMDDeductionId'), 
                'Desc1'=>'',
                'masterName'=>'Employee Deduction ', 'updateMode'=>'Added']);
        }
        // When edit button is pushed
        if($request->get('button_action_DetailEntry2') == 'update')
        {
            return response()->json(['status'=>1, 'Id'=>$request->get('EEDMDDeductionId'), 
                'Desc1'=>'',
                'masterName'=>'Employee Deduction ', 'updateMode'=>'Updated']);
        }     
        
    }
    function ConvertScreenVariablesIncome($request){
        if ($request->EEIMDIncomeId == "-- Income Type --") {
            $request->merge(['EEIMDIncomeId' => '']);
        }
        if ($request->EEIMDEffectiveFrom == "null") {
            $request->merge(['EEIMDEffectiveFrom' => '']);
        }
        if ($request->EEIMDEffectiveTo == "null") {
            $request->merge(['EEIMDEffectiveTo' => '']);
        }
        if ((float)$request->EEIMDGrossIncome <= 0.00) {
            $request->merge(['EEIMDGrossIncome' => '']);
        }
        if ((float)$request->EEIMDPayrollIncome <= 0.00) {
            $request->merge(['EEIMDPayrollIncome' => '']);
        }
    }
    function ConvertScreenVariablesDeduction($request){
        if ($request->EEDMDDeductionId == "-- Deduction Type --") {
            $request->merge(['EEDMDDeductionId' => '']);
        }
        if ($request->EEDMDEffectiveFrom == "null") {
            $request->merge(['EEDMDEffectiveFrom' => '']);
        }
        if ($request->EEDMDEffectiveTo == "null") {
            $request->merge(['EEDMDEffectiveTo' => '']);
        }
        if ((float)$request->EEDMDGrossDeduction <= 0.00) {
            $request->merge(['EEDMDGrossDeduction' => '']);
        }
        if ((float)$request->EEDMDPayrollDeduction <= 0.00) {
            $request->merge(['EEDMDPayrollDeduction' => '']);
        }
    }
    function PostHeaderSubformData(Request $request){
        $UniqueId = $this->PMEE11AddUpdateHeaderDetailTrait($request);
        return response()->json(['status'=>1, 'Id'=>$request->get('EMGIHEmployeeId'), 
            'Desc1'=>$request->get('EMGIHFullName'),
            'masterName'=>'Employee Earnings ', 'updateMode'=>'Updated']);
    }
    function DeleteMemDataIncome(Request $request){
        $this->PMEE11DeleteMemRecordIncomeTrait($request);
        return response()->json(['status'=>1]);        
    }
    function DeleteMemDataDeduction(Request $request){
        $this->PMEE11DeleteMemRecordDeductionTrait($request);
        return response()->json(['status'=>1]);        
    }
    function FetchSubFormDataIncome(Request $request){        
        // Get Income Detail Info
        $fethchedData = $this->PMEE11FethchEditedDataIncomeTrait($request);        
        echo json_encode($fethchedData);
    }
    function FetchSubFormDataDeduction(Request $request){        
        // Get Deduction Detail Info
        $fethchedData = $this->PMEE11FethchEditedDataDeductionTrait($request);        
        echo json_encode($fethchedData);
    }
    // Income Sub Form Methods Ends*****
}
// echo 'Data Submitted.';
// return $request->input();
// die();

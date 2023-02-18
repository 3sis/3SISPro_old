<?php

namespace App\Http\Controllers\Payroll\PayrollGeneration;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\ErrorMessages3SISRequest;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
// CopyChange
use Illuminate\Support\Carbon;
use Auth;
use Validator;
use DataTables;
use App\Traits\Payroll\PayrollGeneration\incomeAdjustmentDbOperations;
use App\Traits\DropDown3SIS\dropDowns3SIS;
use App\Traits\TablesSchema3SIS\tablesSchema3SIS;

use Excel;
use App\Imports\SalaryRevisionImport;

class IncomeAdjustmentController extends Controller
{
    use incomeAdjustmentDbOperations, dropDowns3SIS, tablesSchema3SIS;
    protected  $gCompanyId = '1000';
    function Index()
    {
        $data = $this->dataTableXLSchemaTrait();
        // $this->ZmemDeleteTrait();   
        return view('Payroll.PayrollGeneration.xlUploadIncomeAdjustment')->with($data);
    }
    function Import(Request $request)
    {
        $errorOutput = '113';        
        $validator = Validator::make($request->all(), [
            'file' => 'required|mimes:xls,xlsx'
        ]);
        if(!$validator->passes()){
            return response()->json(['status'=>0, 'error'=>$validator->errors()->toArray(), 'ErrorOutput'=>'You must select a valid file.']);
        }else {
            $this->XLDeleteMemSalaryRevisionXLTrait();  
            $this->DeleteMemDeductionTypeTrait();   
            Excel :: Import(new SalaryRevisionImport,$request->file);
            return response()->json(['status'=>1, 'Id'=>"", 
            'Desc1'=>"",
            'masterName'=>'Excel Import For Income Adjustment ', 'updateMode'=>'Imported']);
        }
        
    }
    function BrowserData()
    {
        //Eloquent way - Model is must
        $BrowserDataTable = $this->XLUploadBrowserDataTrait();
        return DataTables::of($BrowserDataTable)
        ->make(true);
    }
    function Select_UnSelect(Request $request){
       
        $UniqueId = $this->UpdateSelect_UnSelectTrait($request);
        return response()->json(['status'=>1]);
        
    }

    function UpdateDeductionTypeMem(Request $request){
        
        $this->UpdateDeductionTypeMemTrait($request);
       
        return response()->json(['status'=>1]);
        
    }
    function BrowserDeductionTypeList(Request $request){
       
        $BrowserDataTable = $this->BrowserDeductionTypeListTrait($request);
        return DataTables::of($BrowserDataTable)
        ->make(true);
    }
    function Select_UnSelectDeductionType(Request $request){
       
        $UniqueId = $this->UpdateSelect_UnSelectDeductionTypeTrait($request);
        return response()->json(['status'=>1]);
        
    }
    function PostData(Request $request){
        $SelectedDeductionType = $this->CheckSelectedDeductionTypeMemTrait($request);
        if ($SelectedDeductionType == '') {
            $errorOutput = 'At least one Deduction type shoud be selected.';
            return response()->json(['status'=>0, 'ErrorOutput'=>$errorOutput]);
        }
        $SelectedEmployee = $this->CheckSelectedEmployeAtSalaryRevisionMemTrait($request);
        if ($SelectedEmployee == '') {
            $errorOutput = 'At least one Employe shoud be selected to upload this excel data.';
            return response()->json(['status'=>0, 'ErrorOutput'=>$errorOutput]);
        }
        $UniqueId = $this->UpdateActualTableWithUpdateDeductionTypeMemTrait($request);
        $this->XLDeleteMemSalaryRevisionXLTrait();   
        $this->DeleteMemDeductionTypeTrait();   
        return response()->json(['status'=>1, 'Id'=>"", 'Desc1'=>"",
            'masterName'=>'Income Adjustment ', 'updateMode'=>'Updated']);

    }

    function IndexHed()
    {
        $data = $this->dataTableXLSchemaTrait();
        // $this->ZmemDeleteTrait();   
        return view('Payroll.PayrollGeneration.maintainIncomeAdjustment')->with($data);
    }
    function BrowserHeadData()
    {
        //Eloquent way - Model is must
        $BrowserHeadData = $this->BrowserHeadDataTrait();
        return DataTables::of($BrowserHeadData)
        ->addColumn('action', function($DeductionAdjustmentHeader){
            return '<a href="#" class="btn mr-1 btnEditRec3SIS editHeader" id="'.$DeductionAdjustmentHeader->PGDAHEmployeeId.'">Edit
                        <i class="fas fa-edit fa-xs"></i>
                    </a>';
        })
        ->make(true);
    }
    function BrowserDetailData(Request $request)
    {
        // echo 'Data Submitted.'.$request->input();
        // print_r($request->input());
        // die();
        //Eloquent way - Model is must
        $BrowserDetailData = $this->BrowserDetailDataTrait($request);
        return DataTables::of($BrowserDetailData)
        ->addColumn('action', function($DeductionAdjustmentDetail){
            return '<a href="#" class="btn mr-1 btnEditRec3SIS editDetail" id="'.$DeductionAdjustmentDetail->PGDADUniqueId.'">Edit
                        <i class="fas fa-edit fa-xs"></i>
                    </a>
                    <a href="#" class="btn btnDeleteRec3SIS deleteDetail" id="'.$DeductionAdjustmentDetail->PGDADUniqueId.'">Del
                        <i class="far fa-trash-alt fa-xs"></i>
                    </a>';
        })
        ->make(true);
    }
    function FetchSubFormDataDeduction(Request $request){        
        // Get Deduction Detail Info        
        $fethchedData = $this->FethchEditedDetailDataTrait($request);        
        echo json_encode($fethchedData);
    }
    function PostSubFormDataDeduction(Request $request){
        // echo 'Data Submitted.';
        // return $request->input();
        // die();
        $this->ConvertScreenVariables($request);
        $errorOutput = '';        
        $validator = Validator::make($request->all(), [
            'PGDADIncDedId'         =>  'required',
            'PGDADNetDeduction'    =>  'required',
            'PGDADFromDate'         =>  'required',
            'PGDADToDate'    =>  'required',
        ]);

        if(!$validator->passes()){
            return response()->json(['status'=>0, 'error'=>$validator->errors()->toArray(), 'ErrorOutput'=>$errorOutput]);
        }
        // Check for duplicate entry
        $DuplicateFound = $this->CheckDuplicateDeductionTrait($request);
        if ($DuplicateFound != '') {
            $errorOutput = 'DUPLICATE - This Deduction Type already exist in detail.';
            return response()->json(['status'=>0, 'ErrorOutput'=>$errorOutput]);
        }
        // Check for duplicate entry Ends*****
        $UniqueId = $this->AddUpdateDeductionAdjustmentDetailTrait($request);
        // echo 'Last Inserted Record. : ' .$UniqueId;
        // die();
        if($request->get('button_action_DetailEntry1') == 'insert')
        {
            return response()->json(['status'=>1, 'Id'=>$request->get('PGDADIncDedId'), 
                'Desc1'=>'','EmpId'=>$request->get('PGDADEmployeeId'),
                'masterName'=>'Employee Deduction ', 'updateMode'=>'Added']);
        }
        // When edit button is pushed
        if($request->get('button_action_DetailEntry1') == 'update')
        {
            return response()->json(['status'=>1, 'Id'=>$request->get('PGDADIncDedId'), 
                'Desc1'=>'','EmpId'=>$request->get('PGDADEmployeeId'),
                'masterName'=>'Employee Deduction ', 'updateMode'=>'Updated']);
        }     
        
    }
    function DeleteDeductionAdjustmentDetail(Request $request){
        $this->DeleteRecordDeductionAdjustmentDetailTrait($request);
        return response()->json(['status'=>1]);        
    }
    function ConvertScreenVariables($request){
        if ($request->PGDADIncDedId == "-- Deduction Type --") {
            $request->merge(['PGDADIncDedId' => '']);
        }
    }
}

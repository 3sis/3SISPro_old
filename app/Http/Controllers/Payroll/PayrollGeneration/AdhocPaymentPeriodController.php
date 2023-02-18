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
use App\Traits\Payroll\PayrollGeneration\adhocPaymentPeriodDbOperations;
use App\Traits\DropDown3SIS\dropDowns3SIS;
use App\Traits\TablesSchema3SIS\tablesSchema3SIS;

use Excel;
use App\Imports\SalaryRevisionImport;

class AdhocPaymentPeriodController extends Controller
{
    use adhocPaymentPeriodDbOperations, dropDowns3SIS, tablesSchema3SIS;
    protected  $gCompanyId = '1000';
    function Index()
    {
        $data = $this->dataTableXLSchemaTrait();
        return view('Payroll.PayrollGeneration.xlUploadAdhocPaymentPeriod')->with($data);
    }
    function Import(Request $request)
    {
        
        $errorOutput = '';        
        // $this->validate($request, [
        //     'file' => 'required|mimes:xls,xlsx'
        // ]);
        $validator = Validator::make($request->all(), [
            'file' => 'required|mimes:xls,xlsx'
        ]);
        if(!$validator->passes()){
            return response()->json(['status'=>0, 'error'=>$validator->errors()->toArray(), 'ErrorOutput'=>'You must select a valid file.']);
        }else {
            $this->XLDeleteMemSalaryRevisionXLTrait();  
            $this->DeleteMemIncomeTypeTrait();   
            Excel :: Import(new SalaryRevisionImport,$request->file);
            return response()->json(['status'=>1, 'Id'=>"", 
            'Desc1'=>"",
            'masterName'=>'Excel Import For Adhoc Payment ', 'updateMode'=>'Imported']);
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

    function UpdateIncomeTypeMem(Request $request){
        
        $this->UpdateIncomeTypeMemTrait($request);
       
        return response()->json(['status'=>1]);
        
    }
    function BrowserIncomeTypeList(Request $request){
       
        $BrowserDataTable = $this->BrowserIncomeTypeListTrait($request);
        return DataTables::of($BrowserDataTable)
        ->make(true);
    }
    function Select_UnSelectIncomeType(Request $request){
       
        $UniqueId = $this->UpdateSelect_UnSelectIncomeTypeTrait($request);
        return response()->json(['status'=>1]);
        
    }
    function PostData(Request $request){
        $SelectedIncomeType = $this->CheckSelectedIncomeTypeMemTrait($request);
        if ($SelectedIncomeType == '') {
            $errorOutput = 'At least one income type shoud be selected.';
            return response()->json(['status'=>0, 'ErrorOutput'=>$errorOutput]);
        }
        $SelectedEmployee = $this->CheckSelectedEmployeAtSalaryRevisionMemTrait($request);
        if ($SelectedEmployee == '') {
            $errorOutput = 'At least one Employe shoud be selected to upload this excel data.';
            return response()->json(['status'=>0, 'ErrorOutput'=>$errorOutput]);
        }
        $UniqueId = $this->UpdateActualTableWithUpdateIncomeTypeMemTrait($request);
        $this->XLDeleteMemSalaryRevisionXLTrait();   
        $this->DeleteMemIncomeTypeTrait();   
        return response()->json(['status'=>1, 'Id'=>"", 'Desc1'=>"",
            'masterName'=>'Adhoc Payment ', 'updateMode'=>'Updated']);

    }
    function IndexHed()
    {
        $data = $this->dataTableXLSchemaTrait();
        // $this->ZmemDeleteTrait();   
        return view('Payroll.PayrollGeneration.maintainAdhocPaymentPeriod')->with($data);
    }
    
    function BrowserDetailData(Request $request)
    {
        // echo 'Data Submitted.'.$request->input();
        // print_r($request->input());
        // die();
        //Eloquent way - Model is must
        $BrowserDetailData = $this->BrowserDetailDataTrait($request);
        return DataTables::of($BrowserDetailData)
        ->addColumn('action', function($AdhocPaymentPeriodDetail){
            return '<a href="#" class="btn mr-1 btnEditRec3SIS editDetail" id="'.$AdhocPaymentPeriodDetail->PGAIDUniqueId.'">Edit
                        <i class="fas fa-edit fa-xs"></i>
                    </a>
                    <a href="#" class="btn btnDeleteRec3SIS deleteDetail" id="'.$AdhocPaymentPeriodDetail->PGAIDUniqueId.'">Del
                        <i class="far fa-trash-alt fa-xs"></i>
                    </a>';
        })
        ->make(true);
    }
    function FetchSubFormDataIncome(Request $request){        
        // Get Income Detail Info        
        $fethchedData = $this->FethchEditedDetailDataTrait($request);        
        echo json_encode($fethchedData);
    }
    function PostSubFormDataIncome(Request $request){
        // echo 'Data Submitted.';
        // return $request->input();
        // die();
        $this->ConvertScreenVariables($request);
        $errorOutput = '';        
        $validator = Validator::make($request->all(), [
            'PGAIDEmployeeId'         =>  'required',
            'PGAIDIncDedId'         =>  'required',
            'PGAIDGrossPayment'    =>  'required',
            'PGAIDFromDate'    =>  'required',
            'PGAIDToDate'    =>  'required',
        ]);

        if(!$validator->passes()){
            return response()->json(['status'=>0, 'error'=>$validator->errors()->toArray(), 'ErrorOutput'=>$errorOutput]);
        }
        // Check for duplicate entry
        $DuplicateFound = $this->CheckDuplicateIncomeTrait($request);
        if ($DuplicateFound != '') {
            $errorOutput = 'DUPLICATE - This Income Type already exist in detail.';
            return response()->json(['status'=>0, 'ErrorOutput'=>$errorOutput]);
        }
        // Check for duplicate entry Ends*****
        $UniqueId = $this->AddUpdateAdhocPaymentPeriodTrait($request);
        // echo 'Last Inserted Record. : ' .$UniqueId;
        // die();
        if($request->get('button_action_DetailEntry1') == 'insert')
        {
            return response()->json(['status'=>1, 'Id'=>$request->get('PGAIDIncDedId'), 
                'Desc1'=>'','EmpId'=>$request->get('PGAIDEmployeeId'),
                'masterName'=>'Employee Income ', 'updateMode'=>'Added']);
        }
        // When edit button is pushed
        if($request->get('button_action_DetailEntry1') == 'update')
        {
            return response()->json(['status'=>1, 'Id'=>$request->get('PGAIDIncDedId'), 
                'Desc1'=>'','EmpId'=>$request->get('PGAIDEmployeeId'),
                'masterName'=>'Employee Income ', 'updateMode'=>'Updated']);
        }     
        
    }
    function DeleteAdhocPaymentPeriod(Request $request){
        $this->DeleteRecordAdhocPaymentPeriodTrait($request);
        return response()->json(['status'=>1]);        
    }
    function ConvertScreenVariables($request){
        if ($request->PGAIDIncDedId == "-- Income Type --") {
            $request->merge(['PGAIDIncDedId' => '']);
        }
        if ($request->PGAIDEmployeeId == "-- Select Employee Id --") {
            $request->merge(['PGAIDEmployeeId' => '']);
        }
    }
}

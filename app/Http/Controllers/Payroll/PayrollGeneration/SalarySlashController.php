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
use App\Traits\Payroll\PayrollGeneration\salarySlashDbOperations;
use App\Traits\DropDown3SIS\dropDowns3SIS;
use App\Traits\TablesSchema3SIS\tablesSchema3SIS;
use Excel;
use App\Imports\SalaryRevisionImport;

class SalarySlashController extends Controller
{
    use salarySlashDbOperations, dropDowns3SIS, tablesSchema3SIS;
    protected  $gCompanyId = '1000';
    function Index()
    {
        $data = $this->dataTableXLSchemaTrait();
        // $this->ZmemDeleteTrait();   
        return view('Payroll.PayrollGeneration.xlUploadSalarySlash')->with($data);
    }
    function Import(Request $request)
    {
        // echo 'Data Submitted.'.$request->file;
        // // print_r($request);
        // die();
        $errorOutput = '113';        
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
            'masterName'=>'Excel Import For Salary Slash ', 'updateMode'=>'Imported']);
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
            'masterName'=>'Salary Shash ', 'updateMode'=>'Updated']);

    }
    function IndexHed()
    {
        $data = $this->dataTableXLSchemaTrait();
        // $this->ZmemDeleteTrait();   
        return view('Payroll.PayrollGeneration.maintainSalarySlash')->with($data);
    }
    function BrowserHeadData()
    {
        //Eloquent way - Model is must
        $BrowserHeadData = $this->BrowserHeadDataTrait();
        return DataTables::of($BrowserHeadData)
        ->addColumn('action', function($SalarySlashHeader){
            return '<a href="#" class="btn mr-1 btnEditRec3SIS editHeader" id="'.$SalarySlashHeader->PGSSHEmployeeId.'">Edit
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
        ->addColumn('action', function($SalarySlashDetail){
            return '<a href="#" class="btn mr-1 btnEditRec3SIS editDetail" id="'.$SalarySlashDetail->PGSSDUniqueId.'">Edit
                        <i class="fas fa-edit fa-xs"></i>
                    </a>
                    <a href="#" class="btn btnDeleteRec3SIS deleteDetail" id="'.$SalarySlashDetail->PGSSDUniqueId.'">Del
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
            'PGSSDIncDedId'         =>  'required',
            'PGSSDGrossPayment'    =>  'required',
            'PGSSDFromDate'    =>  'required',
            'PGSSDToDate'    =>  'required',
            'PGSSDIncomeFixOrPercent'    =>  'required',
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
        $UniqueId = $this->AddUpdateSalarySlashDetailTrait($request);
        // echo 'Last Inserted Record. : ' .$UniqueId;
        // die();
        if($request->get('button_action_DetailEntry1') == 'insert')
        {
            return response()->json(['status'=>1, 'Id'=>$request->get('PGSSDIncDedId'), 
                'Desc1'=>'','EmpId'=>$request->get('PGSSDEmployeeId'),
                'masterName'=>'Employee Income ', 'updateMode'=>'Added']);
        }
        // When edit button is pushed
        if($request->get('button_action_DetailEntry1') == 'update')
        {
            return response()->json(['status'=>1, 'Id'=>$request->get('PGSSDIncDedId'), 
                'Desc1'=>'','EmpId'=>$request->get('PGSSDEmployeeId'),
                'masterName'=>'Employee Income ', 'updateMode'=>'Updated']);
        }     
        
    }
    function DeleteSalarySlashDetail(Request $request){
        $this->DeleteRecordSalarySlashDetailTrait($request);
        return response()->json(['status'=>1]);        
    }
    function ConvertScreenVariables($request){
        if ($request->PGSSDIncDedId == "-- Income Type --") {
            $request->merge(['PGSSDIncDedId' => '']);
        }
    }

}

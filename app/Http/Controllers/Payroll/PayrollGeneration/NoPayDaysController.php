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
// use App\Models\Payroll\Leave\MemNoPayDays;
// use App\Models\Payroll\Leave\NoPayDays;
use App\Traits\Payroll\PayrollGeneration\noPayDaysDbOperations;
use App\Traits\DropDown3SIS\dropDowns3SIS;
use App\Traits\TablesSchema3SIS\tablesSchema3SIS;
use Excel;
use App\Imports\NoPayDaysImport;

class NoPayDaysController extends Controller
{
    use NoPayDaysDbOperations, dropDowns3SIS, tablesSchema3SIS;
    protected  $gCompanyId = '1000';
    function ImportForm()
    {
        $data = $this->dataTableXLSchemaTrait();
        // $this->ZmemDeleteTrait();   
        return view('Payroll.PayrollGeneration.xlUploadNoPayDays')->with($data);
    }
    function Import(Request $request)
    {
        // echo 'Data Submitted.'.$diff_Days;
        // print_r($request->input());
        // die();
        $this->validate($request, [
            'file' => 'required|mimes:xls,xlsx'
        ]);
        $this->XLUploadZmemDeleteTrait();   
        Excel :: Import(new NoPayDaysImport,$request->file);
        $this->XLUploadUpdateMemTableAfterUploadTrait($request);
        return response()->json(['status'=>1, 'Id'=>"", 
        'Desc1'=>"",
        'masterName'=>'Excel Import For No Pay Days ', 'updateMode'=>'Imported']);
        // return back() ->withStatus('Excel file import successfully!');
    }
    function BrowserData()
    {
        //Eloquent way - Model is must
        $BrowserDataTable = $this->XLUploadBrowserDataTrait();
            return DataTables::of($BrowserDataTable)
        ->make(true);
    }
    function PostData(Request $request){
        $UniqueId = $this->XLUploadUpdateActualTableWithMemTableTrait($request);
        $this->XLUploadZmemDeleteTrait();   
        return response()->json(['status'=>1, 'Id'=>"", 
            'Desc1'=>"",
            'masterName'=>'No Pay Days ', 'updateMode'=>'Updated']);
        // return back() ->withStatus('No Pay Days updated successfully!');

    }



    function Index()
    { 
        $data = $this->dataTableXLSchemaTrait();
        return view('Payroll.PayrollGeneration.maintainNoPayDays')->with($data);
    }
    function LoadSubForm(Request $request)
    {
            // echo 'Data Submitted.';
            // print_r($request->input());
            // die();
        //Eloquent way - Model is must
        $BrowserDataTable = $this->BrowserDataTrait($request); 
        // echo 'Data Submitted.';
        // print_r($BrowserDataTable);
        // die();       
        return DataTables::of($BrowserDataTable)
        ->addColumn('action', function($NoPayDays){
            return '<a href="#" class="btn mr-1 btnEditRec3SIS edit" id="'.$NoPayDays->PGADHUniqueId.'">Edit
                        <i class="fas fa-edit fa-xs"></i>
                    </a>
                    <a href="#" class="btn btnDeleteRec3SIS delete" id="'.$NoPayDays->PGADHUniqueId.'">Del
                        <i class="far fa-trash-alt fa-xs"></i>
                    </a>';
        })
        ->make(true);
    } 
    function Fetchdata(Request $request)
    {
        $fethchedData = $this->FethchEditedDataTrait($request);
        echo json_encode($fethchedData);
    }
    function PostHeaderFormData(Request $request){
        $validator = Validator::make($request->all(), [
            'PGADHFiscalYearId'    =>  'required',
            'PGADHPeriodId'   =>  'required',
            'PGADHEmployeeId'     =>  'required',
            'PGADHNoPayDays'    =>  'required',
        ]);


        if(!$validator->passes()){
            return response()->json(['status'=>0, 'error'=>$validator->errors()->toArray()]);
        }
        // echo 'Data Submitted.';
        // return $request->input();;
        // die();
        $DuplicateFound = $this->CheckDuplicateEmployeeNoPayDaysTrait($request);
        if ($DuplicateFound != '') {
            $errorOutput = 'DUPLICATE - Entry for This Employee ('.$DuplicateFound->PGADHEmployeeId.') Exist';
            return response()->json(['status'=>0, 'ErrorOutput'=>$errorOutput]);
        }
        $UniqueId = $this->UpdateFormDataToNoPayDaysTrait($request);
        return response()->json(['status'=>1, 'Id'=>$request->get('PGADHEmployeeId'), 
            'Desc1'=>$request->get(' '),
            'masterName'=>'No Pay Days ', 'updateMode'=>'Updated']);
        
    }
    function DeleteData(Request $request)
    {
        if ($request->id !=0) {
            $Id = $this->DeleteRecordTrait($request);
            // echo 'Data Submitted.1';
            // print_r( $Id['status']);
            // die();
            if ( $Id['status'] != 0) {
                return response()->json(['status'=>1, 'Id'=> $Id['PGADHEmployeeId'], 
                'Desc1'=>'','masterName'=>'No Pay Days ', 'updateMode'=>'Deleted']); 
            }else{
                return response()->json(['status'=>0, 'Id'=>$Id['PGADHEmployeeId'], 
                'Desc1'=>'','masterName'=>'No Pay Days', 'updateMode'=>'Delete']);
            }
        }
        
    }
    
}

<?php

namespace App\Http\Controllers\CommonMasters\FiscalYear;

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
use App\Traits\CommonMasters\FiscalYear\weeklyOffDbOperations;
use App\Traits\GetDescriptions3SIS\getDescriptions3SIS;
use App\Traits\DropDown3SIS\dropDowns3SIS;
use App\Traits\TablesSchema3SIS\tablesSchema3SIS;

class WeeklyOffController extends Controller
{
    use weeklyOffDbOperations, getDescriptions3SIS, dropDowns3SIS, tablesSchema3SIS;
    //
    function Index()
    { 
        $data = $this->dataTableXLSchemaTrait();
        return view('CommonMasters.FiscalYear.weeklyOff')->with($data);
    }
    function BrowserData()
    {
        //Eloquent way - Model is must
        $BrowserDataTable = $this->BrowserDataTrait();
        $this->DeleteMemTablesTrait();

        return DataTables::of($BrowserDataTable)
        ->editColumn('FYFYHStartDate', function ($BrowserDataTable) {
            return $BrowserDataTable->FYFYHStartDate ? with(new Carbon($BrowserDataTable->FYFYHStartDate))->format('d/m/Y') : '';
        })
        ->editColumn('FYFYHEndDate', function ($BrowserDataTable) {
            return $BrowserDataTable->FYFYHEndDate ? with(new Carbon($BrowserDataTable->FYFYHEndDate))->format('d/m/Y') : '';
        })
        ->addColumn('action', function($WeeklyOff){
            return '<a href="#" class="btn mr-1 btnEditRec3SIS edit" id="'.$WeeklyOff->FYWOHUniqueId.'">Edit
                        <i class="fas fa-edit fa-xs"></i>
                    </a>
                    <a href="#" class="btn btnDeleteRec3SIS delete" id="'.$WeeklyOff->FYWOHUniqueId.'">Del
                        <i class="far fa-trash-alt fa-xs"></i>
                    </a>';
        })
        ->make(true);
    } 
    function Fetchdata(Request $request){
        // Delete Mem Tables
        $this->DeleteMemTablesTrait($request);
        // Get Header Info
        $fethchedData = $this->FethchEditedDataTrait($request);
        
		//  echo 'Data Submitted.'.$fethchedData;
        // print_r( $fethchedData);
        // die();
        
        // Append Actual table to mem Table
        $this->UpdateMemTable($request);
        
        echo json_encode($fethchedData);
    }
    function DeleteData(Request $request)
    {
        $FiscalYearId = $this->DeleteRecordTrait($request);
        return response()->json(['status'=>1, 'Id'=>$FiscalYearId, 
            'Desc1'=>'', 'masterName'=>'Weekly Off ', 'updateMode'=>'Deleted']);        
    }
    function BrowserDeletedRecords()
    {
        //Eloquent way - Model is must
        $browserDeletedRecords = $this->BrowserDeletedRecorTrait();          
        return DataTables::of($browserDeletedRecords)
        ->editColumn('FYFYHStartDate', function ($BrowserDataTable) {
            return $BrowserDataTable->FYFYHStartDate ? with(new Carbon($BrowserDataTable->FYFYHStartDate))->format('m/d/Y') : '';
        })
        ->editColumn('FYFYHEndDate', function ($BrowserDataTable) {
            return $BrowserDataTable->FYFYHEndDate ? with(new Carbon($BrowserDataTable->FYFYHEndDate))->format('m/d/Y') : '';
        })
        ->addColumn('action', function($DeletedFiscalYear){
            return '<a href="#" class="btn mr-1 btnEditRec3SIS restore" id="'.$DeletedFiscalYear->FYWOHUniqueId.'">Restore
                        <i class="fas fa-trash-restore"></i>
                    </a>';
        })
        ->make(true);
    } 
    function RestoreDeletedRecord(Request $request)
    {
        $FiscalYearId = $this->UnDeleteRecordTrait($request);
        return response()->json(['status'=>1, 'Id'=>$FiscalYearId, 
            'Desc1'=>'', 'masterName'=>'Weekly Off ', 'updateMode'=>'Restored']);        
    }
    function BrowserSubFormWeeklyOff(Request $request){
        // echo 'Data Submitted at Trait.';
        // return $request->input();
        // die();
        $BrowserDataTableSubDetail = $this->BrowserSubFormWeeklyOffDetailMemTrait($request);
        return DataTables::of($BrowserDataTableSubDetail)
        ->addColumn('action', function($MemWeeklyOff){
            return '<a href="#" class="btn mr-1 btnEditRec3SIS edit_WeeklyOff" id="'.$MemWeeklyOff->FYWODUniqueId.'">Edit
                        <i class="fas fa-edit fa-xs"></i>
                    </a>
                    <a href="#" class="btn btnDeleteRec3SIS delete_WeeklyOff" id="'.$MemWeeklyOff->FYWODUniqueId.'">Del
                        <i class="far fa-trash-alt fa-xs"></i>
                    </a>';
        })
        ->make(true);
    }
    function FetchSubFormData(Request $request){        
        // Get Income Detail Info
        $fethchedData = $this->FethchEditedDataWeeklyOffTrait($request);        
        echo json_encode($fethchedData);
    }
    function PostSubFormData(Request $request){
        // echo 'Data Submitted.1';
        // return $request->input();
        // die();
        $errorOutput = '';        
        $validator = Validator::make($request->all(), [
            'FYWODDayId'       =>  'required',
            
        ]);

        if(!$validator->passes()){
            return response()->json(['status'=>0, 'error'=>$validator->errors()->toArray(), 'ErrorOutput'=>$errorOutput]);
        }
        // Check for duplicate entry
        if($request->get('button_action_DetailEntry1') == 'insert')
        {
            $DuplicateFound = $this->CheckDuplicateWeeklyOffTrait($request);
            if ($DuplicateFound != '') {
                $errorOutput = 'DUPLICATE - This Entry Exist for : '.$DuplicateFound->FYWODDayId;
                return response()->json(['status'=>0, 'ErrorOutput'=>$errorOutput]);
            }
        }
       
        // Check for duplicate entry Ends*****
        $UniqueId = $this->AddUpdateMemWeeklyOffTrait($request);
        
        if($request->get('button_action_DetailEntry1') == 'insert')
        {
            return response()->json(['status'=>1, 'Id'=>$request->get('FYWODDesc1'), 
                'Desc1'=>'',
                'masterName'=>'Weekly Off ', 'updateMode'=>'Added']);
        }
        // When edit button is pushed
        if($request->get('button_action_DetailEntry1') == 'update')
        {
            return response()->json(['status'=>1, 'Id'=>$request->get('FYWODDesc1'), 
                'Desc1'=>'',
                'masterName'=>'Weekly Off ', 'updateMode'=>'Updated']);
        }     
        
    }

    function PostHeaderSubformData(Request $request){
        $this->ConvertScreenVariables($request);
        $validator = Validator::make($request->all(), [
            'FYWOHCalendarId'    =>  'required',
            'FYWOHFiscalYearId'  =>  'required',
            'FYWOHDesc1'         =>  'required',
        ]);


        if(!$validator->passes()){
            return response()->json(['status'=>0, 'error'=>$validator->errors()->toArray()]);
        }
        $IsMemTableUpdated = $this->IsMemTableUpdatedTrait();
        if ($IsMemTableUpdated == '') {
            $errorOutput = 'You must have to defined at list one off day.';
            return response()->json(['status'=>0, 'ErrorOutput'=>$errorOutput]);
        }

        $UniqueId = $this->AddUpdateHeaderDetailTrait($request);
        return response()->json(['status'=>1, 'Id'=>$request->get('FYWOHFiscalYearId'), 
            'Desc1'=>$request->get(' '),
            'masterName'=>'Weekly Off ', 'updateMode'=>'Updated']);
        
    }
    public function GetFiscalYearDate(Request $request){        
        // echo 'Data Submitted.';
        // return $request->input();
        // die();
        $FiscalYearDate = $this->getFiscalYearDateTrait($request); 
        // echo 'Data Submitted.';
        // print_r($FiscalYearDate[0]->FYFYHStartDate);
        // die();
        return response()->json([
            'startDate'=>$FiscalYearDate[0]->FYFYHStartDate, 
            'endDate'=>$FiscalYearDate[0]->FYFYHEndDate, 
            
        ]);
    }
    // Update Tables on Final Save
    function AddUpdateHeaderDetailTrait($request){ 
        
        // Move data from Mem Table to Actual Table : WeeklyOff Header
        $this->UpdateFormDataToWeeklyOffHeaderTrait($request);  
        
    }

    # Delete Mem Tables
    public function DeleteDetailsMemTables(){        
        // Delete Mem Table
        // echo 'Data Submitted Madhav.';
        // die();
        $this->DeleteMemTablesTrait();
        return;
    }
    // Delete Methods : Detail Sub Form
    function FetchSubformDetailData(Request $request){
        $fetchSubFormDetailData = $this->FetchSubFormDetailTrait($request);
        // Check if there are more than 1 row to delete.
        echo json_encode($fetchSubFormDetailData);
    }
    function DeleteSubFormDetail(Request $request){
        $deleteThisRow = $this->DeleteThisRowTrait($request);
        return;
    }
    function DublicateCheckHeader(Request $request){
        // echo 'Data Submitted test.';
        // print_r($request->input());
        // die();
        if ($request->transactionMode == 'AddMode') {
            $this->ConvertScreenVariables($request);
            $errorOutput = '';        
            $validator = Validator::make($request->all(), [
                'FYWOHCalendarId'    =>  'required',
                'FYWOHFiscalYearId'  =>  'required',
                // 'FYWOHDesc1'         =>  'required',
            ]);
            if(!$validator->passes()){
                return response()->json(['status'=>0, 'error'=>$validator->errors()->toArray(), 'ErrorOutput'=>$errorOutput]);
            }
            // Check for duplicate entry
            if($request->get('button_action_DetailEntry1') == 'insert')
            {
                $DuplicateFound = $this->CheckDuplicateHeaderTrait($request);
                if ($DuplicateFound != '') {
                    $errorOutput = 'DUPLICATE - This Entry Exist for : '.$DuplicateFound->FYWOHFiscalYearId;
                    return response()->json(['status'=>0, 'ErrorOutput'=>$errorOutput]);
                }else{
                    return response()->json(['status'=>1]);

                }
            }
        }else{
            return response()->json(['status'=>1]);

        }

    }
    function ConvertScreenVariables($request){
        if ($request->FYWOHCalendarId == "-- Select Calendar --") {
            $request->merge(['FYWOHCalendarId' => '']);
        }
        if ($request->FYWOHFiscalYearId == "-- Select Fiscal Year --") {
            $request->merge(['FYWOHFiscalYearId' => '']);
        }
    }
}

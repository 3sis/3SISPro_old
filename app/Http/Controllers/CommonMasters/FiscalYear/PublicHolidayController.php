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
use App\Traits\TablesSchema3SIS\tablesSchema3SIS;
use App\Traits\CommonMasters\FiscalYear\publicHolidayDbOperations;
use App\Traits\GetDescriptions3SIS\getDescriptions3SIS;
use App\Traits\DropDown3SIS\dropDowns3SIS;

class PublicHolidayController extends Controller
{
    use publicHolidayDbOperations, getDescriptions3SIS, dropDowns3SIS,tablesSchema3SIS;

    function Index()
    { 
        $data = $this->dataTableXLSchemaTrait();
        return view('CommonMasters.FiscalYear.publicHoliday')->with($data);
    }
    function BrowserData()
    {
        //Eloquent way - Model is must
        $BrowserDataTable = $this->BrowserDataTrait();        
        return DataTables::of($BrowserDataTable)
        ->editColumn('FYFYHStartDate', function ($BrowserDataTable) {
            return $BrowserDataTable->FYFYHStartDate ? with(new Carbon($BrowserDataTable->FYFYHStartDate))->format('d/m/Y') : '';
        })
        ->editColumn('FYFYHEndDate', function ($BrowserDataTable) {
            return $BrowserDataTable->FYFYHEndDate ? with(new Carbon($BrowserDataTable->FYFYHEndDate))->format('d/m/Y') : '';
        })
        ->addColumn('action', function($PublicHoliday){
            return '<a href="#" class="btn mr-1 btnEditRec3SIS edit" id="'.$PublicHoliday->FYPHHUniqueId.'">Edit
                        <i class="fas fa-edit fa-xs"></i>
                    </a>
                    <a href="#" class="btn btnDeleteRec3SIS delete" id="'.$PublicHoliday->FYPHHUniqueId.'">Del
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
        // Append Actual table to mem Table
        $this->UpdateMemTable($request);
        echo json_encode($fethchedData);
    }
    function DeleteData(Request $request)
    {
        $FiscalYearId = $this->DeleteRecordTrait($request);
        return response()->json(['status'=>1, 'Id'=>$FiscalYearId, 
            'Desc1'=>'', 'masterName'=>'Public Holiday ', 'updateMode'=>'Deleted']);        
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
            return '<a href="#" class="btn mr-1 btnEditRec3SIS restore" id="'.$DeletedFiscalYear->FYPHHUniqueId.'">Restore
                        <i class="fas fa-trash-restore"></i>
                    </a>';
        })
        ->make(true);
    } 
    function RestoreDeletedRecord(Request $request)
    {
        $FiscalYearId = $this->UnDeleteRecordTrait($request);
        return response()->json(['status'=>1, 'Id'=>$FiscalYearId, 
            'Desc1'=>'', 'masterName'=>'Public Holiday ', 'updateMode'=>'Restored']);        
    }
    function BrowserSubFormPublicHoliday(Request $request){
        // echo 'Data Submitted at Trait.';
        // return $request->input();
        // die();
        $BrowserDataTableSubDetail = $this->BrowserSubFormPublicHolidayDetailMemTrait($request);
        return DataTables::of($BrowserDataTableSubDetail)
        ->editColumn('FYPHDHolidayDate', function ($BrowserDataTableSubDetail) {
            return $BrowserDataTableSubDetail->FYPHDHolidayDate ? with(new Carbon($BrowserDataTableSubDetail->FYPHDHolidayDate))->format('d/m/Y') : '';
        })
        ->editColumn('HolidayDateSort', function ($BrowserDataTableSubDetail) {
            return $BrowserDataTableSubDetail->HolidayDateSort ? with(new Carbon($BrowserDataTableSubDetail->HolidayDateSort))
            ->format('Y/m/d') : '';
        })
        ->addColumn('action', function($MemPublicHoliday){
            return '<a href="#" class="btn mr-1 btnEditRec3SIS edit_PublicHoliday" id="'.$MemPublicHoliday->FYPHDUniqueId.'">Edit
                        <i class="fas fa-edit fa-xs"></i>
                    </a>
                    <a href="#" class="btn btnDeleteRec3SIS delete_PublicHoliday" id="'.$MemPublicHoliday->FYPHDUniqueId.'">Del
                        <i class="far fa-trash-alt fa-xs"></i>
                    </a>';
        })
        ->make(true);
    }
    function FetchSubFormData(Request $request){        
        // Get Income Detail Info
        $fethchedData = $this->FethchEditedDataPublicHolidayTrait($request);        
        echo json_encode($fethchedData);
    }
    function PostSubFormData(Request $request){
        // echo 'Data Submitted.1';
        // return $request->input();
        // die();
        $errorOutput = '';        
        $validator = Validator::make($request->all(), [
            'FYPHDHolidayDate'       =>  'required',
        ]);
        if(!$validator->passes()){
            return response()->json(['status'=>0, 'error'=>$validator->errors()->toArray(), 'ErrorOutput'=>$errorOutput]);
        }
        // Check for duplicate entry
        if($request->get('button_action_DetailEntry1') == 'insert')
        {
            $DuplicateFound = $this->CheckDuplicatePublicHolidayTrait($request);
            // echo 'Data Submitted.1';
            // print_r($DuplicateFound);
            // die();
            if ($DuplicateFound != '') {
                $errorOutput = 'DUPLICATE - This Entry Exist : '.$DuplicateFound->FYPHDHolidayDate;
                return response()->json(['status'=>0, 'ErrorOutput'=>$errorOutput]);
            }
        }
        // Check for duplicate entry Ends*****
        $UniqueId = $this->AddUpdateMemPublicHolidayTrait($request);
        if($request->get('button_action_DetailEntry1') == 'insert')
        {
            return response()->json(['status'=>1, 'Id'=>$request->get('FYPHDDesc1'), 
                'Desc1'=>'',
                'masterName'=>'Public Holiday ', 'updateMode'=>'Added']);
        }
        // When edit button is pushed
        if($request->get('button_action_DetailEntry1') == 'update')
        {
            return response()->json(['status'=>1, 'Id'=>$request->get('FYPHDDesc1'), 
                'Desc1'=>'',
                'masterName'=>'Public Holiday ', 'updateMode'=>'Updated']);
        }     
    }
    function PostHeaderSubformData(Request $request){
        $this->ConvertScreenVariables($request);
        $validator = Validator::make($request->all(), [
            'FYPHHCalendarId'    =>  'required',
            'FYPHHFiscalYearId'  =>  'required',
        ]);

        if(!$validator->passes()){
            return response()->json(['status'=>0, 'error'=>$validator->errors()->toArray()]);
        }
        $IsMemTableUpdated = $this->IsMemTableUpdatedTrait();
        if ($IsMemTableUpdated == '') {
            $errorOutput = 'You must have to defined at list one Public Holiday.';
            return response()->json(['status'=>0, 'ErrorOutput'=>$errorOutput]);
        }

        $UniqueId = $this->AddUpdateHeaderDetailTrait($request);
        return response()->json(['status'=>1, 'Id'=>$request->get('FYPHHFiscalYearId'), 
            'Desc1'=>$request->get(' '),
            'masterName'=>'Public Holiday ', 'updateMode'=>'Updated']);
        
    }
    public function GetFiscalYearDate(Request $request){        
        $FiscalYearDate = $this->getFiscalYearDateTrait($request); 
        return response()->json([
            'startDate'=>$FiscalYearDate[0]->FYFYHStartDate, 
            'endDate'=>$FiscalYearDate[0]->FYFYHEndDate, 
            
        ]);
    }
    // Update Tables on Final Save
    function AddUpdateHeaderDetailTrait($request){ 
        
        // Move data from Mem Table to Actual Table : Public Holiday Header
        $this->UpdateFormDataToPublicHolidayHeaderTrait($request);  
        
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
                'FYPHHCalendarId'    =>  'required',
                'FYPHHFiscalYearId'  =>  'required',
            ]);
            if(!$validator->passes()){
                return response()->json(['status'=>0, 'error'=>$validator->errors()->toArray(), 'ErrorOutput'=>$errorOutput]);
            }
            // Check for duplicate entry
            if($request->get('button_action_DetailEntry1') == 'insert')
            {
                $DuplicateFound = $this->CheckDuplicateHeaderTrait($request);
                if ($DuplicateFound != '') {
                    $errorOutput = 'DUPLICATE - This Entry Exist for : '.$DuplicateFound->FYPHHFiscalYearId;
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
        if ($request->FYPHHCalendarId == "-- Select Calendar --") {
            $request->merge(['FYPHHCalendarId' => '']);
        }
        if ($request->FYPHHFiscalYearId == "-- Select Fiscal Year --") {
            $request->merge(['FYPHHFiscalYearId' => '']);
        }
    }
}

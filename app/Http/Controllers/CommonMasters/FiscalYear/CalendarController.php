<?php

namespace App\Http\Controllers\CommonMasters\FiscalYear;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Carbon;
use Auth;
use Validator;
// Add Model here
use App\Models\CommonMasters\FiscalYear\Calendar;
use DataTables;
use App\Traits\TablesSchema3SIS\tablesSchema3SIS;
use App\Traits\CommonMasters\FiscalYear\calendarDbOperations;

class CalendarController extends Controller
{
    use tablesSchema3SIS, calendarDbOperations;
    protected  $gCompanyId = '1000';
    function Index()
    { 
        $data = $this->dataTableXLSchemaTrait();
        return view('CommonMasters.FiscalYear.calendar')->with($data);
    }
    function BrowserData()
    {
        //Eloquent way - Model is must 
        $BrowserDataTable = $this->cmcaBrowserDataTrait();
        return DataTables::of($BrowserDataTable)
        ->addColumn('action', function($calendarmaster){
            return '<a href="#" class="btn mr-1 btnEditRec3SIS edit" id="'.$calendarmaster->FYCAHUniqueId.'">Edit
                        <i class="fas fa-edit fa-xs"></i>
                    </a>
                    <a href="#" class="btn btnDeleteRec3SIS delete" id="'.$calendarmaster->FYCAHUniqueId.'">Del
                        <i class="far fa-trash-alt fa-xs"></i>
                    </a>';
        })
        ->make(true);
    }
    function Fetchdata(Request $request)
    {
        $fethchedData = $this->cmcaFethchEditedDataTrait($request);
        echo json_encode($fethchedData);
    }
    function Postdata(Request $request)
    {
        if($request->get('button_action') == 'insert')
        {
            $validator = Validator::make($request->all(), [
                'FYCAHCalendarId'           =>  'required|max:10|unique:t05903l02,FYCAHCalendarId',
                'FYCAHDesc1'                => 'required|max:100',
                'FYCAHDesc2'                => 'max:200',
                'FYCAHShiftStartTime'       => 'required',
                'FYCAHShiftEndTime'         => 'required|after:FYCAHShiftStartTime',
                'FYCAHShiftWorkingTime'     => 'required',
                'FYCAHBiDesc'               => 'max:100',
            ]);
        }
        else
        {
            $validator = Validator::make($request->all(), [
                'FYCAHCalendarId'           =>  'required|max:10|',
                'FYCAHDesc1'                => 'required|max:100',
                'FYCAHDesc2'                => 'max:200',
                'FYCAHShiftStartTime'       => 'required',
                'FYCAHShiftEndTime'         => 'required',
                'FYCAHShiftWorkingTime'     => 'required',
                'FYCAHBiDesc'               => 'max:100',
            ]);
        }
        if(!$validator->passes()){
            return response()->json(['status'=>0, 'error'=>$validator->errors()->toArray()]);
        }
        else{
            // When add button is pushed
            if($request->get('button_action') == 'insert')
            {
                // $calendarMaster = new Calendar;
                
                // $calendarMaster->FYCAHCalendarId            =   $request->FYCAHCalendarId;
                // $calendarMaster->FYCAHDesc1                 =   $request->FYCAHDesc1;
                // $calendarMaster->FYCAHDesc2                 =   $request->FYCAHDesc2;
                // $calendarMaster->FYCAHShiftStartTime        =   $request->FYCAHShiftStartTime;
                // $calendarMaster->FYCAHShiftEndTime          =   $request->FYCAHShiftEndTime;
                // $calendarMaster->FYCAHShiftBreakTime        =   $request->FYCAHShiftBreakTime;
                // $calendarMaster->FYCAHShiftWorkingTime      =   $request->FYCAHShiftWorkingTime;
                // $calendarMaster->FYCAHLateComingGraceTime   =   $request->FYCAHLateComingGraceTime;
                // $calendarMaster->FYCAHEarlyGoingGraceTime   =   $request->FYCAHEarlyGoingGraceTime;
                // $calendarMaster->FYCAHBiDesc                =   $request->FYCAHBiDesc;
                // $calendarMaster->FYCAHMarkForDeletion       =   0;
                // $calendarMaster->FYCAHUser                  =   Auth::user()->name;
                // $calendarMaster->FYCAHLastCreated           =   Carbon::now();
                // $calendarMaster->FYCAHLastUpdated           =   Carbon::now();

                // $calendarMaster->save();
                $UniqueId = $this->cmcaAddUpdateTrait($request);
                return response()->json(['status'=>1, 'Id'=>$request->get('FYCAHCalendarId'), 
                    'Desc1'=>$request->get('FYCAHDesc1'),
                    'masterName'=>'Calendar ', 'updateMode'=>'Added']); 
            }
            // When edit button is pushed
            if($request->get('button_action') == 'update')
            {                
                //Eloquent Way
                $updateTable = Calendar::find($request->get('FYCAHUniqueId'))->update([
                    'FYCAHDesc1'                    => $request->FYCAHDesc1,
                    'FYCAHDesc2'                    => $request->FYCAHDesc2,
                    'FYCAHShiftStartTime'           => $request->FYCAHShiftStartTime,
                    'FYCAHShiftEndTime'             => $request->FYCAHShiftEndTime,
                    'FYCAHShiftBreakTime'           => $request->FYCAHShiftBreakTime,
                    'FYCAHShiftWorkingTime'         => $request->FYCAHShiftWorkingTime,
                    'FYCAHLateComingGraceTime'      => $request->FYCAHLateComingGraceTime,
                    'FYCAHEarlyGoingGraceTime'      => $request->FYCAHEarlyGoingGraceTime,
                    'FYCAHBiDesc'                   => $request->FYCAHBiDesc,                    
                    'FYCAHUser'                     => Auth::user()->name,
                    'FYCAHLastUpdated'              => Carbon::now()                    
                ]);  
                return response()->json(['status'=>1, 'Id'=>$request->get('FYCAHCalendarId'), 
                    'Desc1'=>$request->get('FYCAHDesc1'), 'masterName'=>'Calendar ', 'updateMode'=>'Updated']);           
            }
                   
        }
    }
    function DeleteData(Request $request)
    {
        $CalendarId = $this->cmcaDeleteRecordTrait($request);
        return response()->json(['status'=>1, 'Id'=>$CalendarId, 
            'Desc1'=>'', 'masterName'=>'Calendar ', 'updateMode'=>'Deleted']);          
    }
    function BrowserDeletedRecords()
    {
        //Eloquent way - Model is must 
        $browserDeletedRecords = $this->cmcaBrowserDeletedRecordsTrait(); 
        return DataTables::of($browserDeletedRecords)
        ->addColumn('action', function($DeletedState){
            return '<a href="#" class="btn mr-1 btnEditRec3SIS restore" id="'.$DeletedState->FYCAHUniqueId.'">Restore
                        <i class="fas fa-trash-restore"></i>
                    </a>';
        })
        ->make(true);
    } 
    function RestoreDeletedRecord(Request $request)
    {                    
        $Id = $this->cmcaUnDeleteRecordTrait($request);
        return response()->json(['status'=>1, 'Id'=>$Id, 
        'Desc1'=>'', 'masterName'=>'Country ', 'updateMode'=>'Restored']); 
    } 
}

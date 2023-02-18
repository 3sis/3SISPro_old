<?php
namespace app\Traits\CommonMasters\FiscalYear;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Auth;
use Illuminate\Support\Carbon;
use App\Models\CommonMasters\FiscalYear\Calendar;
// FY : Fiscal Year Master
trait calendarDbOperations {        
    public function cmcaBrowserDataTrait() 
    {
        return $browserData = Calendar::
        select(
            'FYCAHUniqueId',
            'FYCAHCalendarId',
            'FYCAHDesc1', 
            'FYCAHShiftStartTime',
            'FYCAHShiftEndTime',
            'FYCAHShiftBreakTime',
            'FYCAHShiftWorkingTime',
            'FYCAHUser',
            'FYCAHLastUpdated')
        ->where('FYCAHMarkForDeletion', 0);
    }
    public function cmcaBrowserDeletedRecordsTrait() 
    {
        return $browserDeletedRecords = Calendar::
        select(
            'FYCAHUniqueId', 
            'FYCAHCalendarId',
            'FYCAHDesc1', 
            'FYCAHDesc2')
        ->where('FYCAHMarkForDeletion', 1);
    }
    public function cmcaAddUpdateTrait($request)
    {
        if($request->get('button_action') == 'insert') {
            $Calendar = new Calendar;
            $Calendar->FYCAHCalendarId       =   $request->FYCAHCalendarId ;
            $Calendar->FYCAHLastCreated       =   Carbon::now();
        }elseif($request->get('button_action') == 'update'){
            $Calendar = Calendar::find($request->get('FYCAHUniqueId'));
        }

        $Calendar->FYCAHDesc1                   =   $request->FYCAHDesc1;
        $Calendar->FYCAHDesc2                   =   $request->FYCAHDesc2;
        $Calendar->FYCAHShiftStartTime          =   $request->FYCAHShiftStartTime;
        $Calendar->FYCAHLateComingGraceTime     =   $request->FYCAHLateComingGraceTime;
        $Calendar->FYCAHShiftEndTime            =   $request->FYCAHShiftEndTime;
        $Calendar->FYCAHEarlyGoingGraceTime     =   $request->FYCAHEarlyGoingGraceTime;
        $Calendar->FYCAHShiftBreakTime          =   $request->FYCAHShiftBreakTime;
        $Calendar->FYCAHShiftWorkingTime        =   $request->FYCAHShiftWorkingTime;
        $Calendar->FYCAHBiDesc                  =   $request->FYCAHBiDesc;
        $Calendar->FYCAHMarkForDeletion         =   0;
        $Calendar->FYCAHUser                    =   Auth::user()->name;
        $Calendar->FYCAHLastUpdated             =   Carbon::now(); 
        $Calendar->save();
        
        if($request->get('button_action') == 'insert') {
            $UniqueId = $Calendar->FYCAHUniqueId; 
        }elseif($request->get('button_action') == 'update'){
            $UniqueId = $request->get('FYCAHUniqueId');
        }
        return $UniqueId;
    }
    public function cmcaFethchEditedDataTrait($request)
    {
        $FYCAHUniqueId = $request->input('id');
        $calendarMaster = Calendar::find($FYCAHUniqueId);
        return $output = array(
            'FYCAHUniqueId'             =>  $calendarMaster->FYCAHUniqueId,
            'FYCAHCalendarId'           =>  $calendarMaster->FYCAHCalendarId,
            'FYCAHDesc1'                =>  $calendarMaster->FYCAHDesc1,
            'FYCAHDesc2'                =>  $calendarMaster->FYCAHDesc2,
            'FYCAHShiftStartTime'       =>  $calendarMaster->FYCAHShiftStartTime,
            'FYCAHShiftEndTime'         =>  $calendarMaster->FYCAHShiftEndTime,
            'FYCAHShiftBreakTime'       =>  $calendarMaster->FYCAHShiftBreakTime,
            'FYCAHShiftWorkingTime'     =>  $calendarMaster->FYCAHShiftWorkingTime,
            'FYCAHLateComingGraceTime'  =>  $calendarMaster->FYCAHLateComingGraceTime,
            'FYCAHEarlyGoingGraceTime'  =>  $calendarMaster->FYCAHEarlyGoingGraceTime,
            'FYCAHBiDesc'               =>  $calendarMaster->FYCAHBiDesc,
            'FYCAHUser'                 =>  $calendarMaster->FYCAHUser,
            'FYCAHLastCreated'          =>  $calendarMaster->FYCAHLastCreated,
            'FYCAHLastUpdated'          =>  $calendarMaster->FYCAHLastUpdated
        );
    }
    public function cmcaDeleteRecordTrait($request)
    {
        $UniqueId = $request->input('id');
        //Eloquent Way
        $Calendar = Calendar::find($UniqueId);
        $Calendar->FYCAHMarkForDeletion   =   1;
        $Calendar->FYCAHUser              =   Auth::user()->name;
        $Calendar->FYCAHDeletedAt         =  Carbon::now();
        $Calendar->save();        
        return $Calendar->FYCAHCalendarId;
    }
    public function cmcaUnDeleteRecordTrait($request)
    {
        $UniqueId = $request->input('id');
        //Eloquent Way
        $Calendar = Calendar::find($UniqueId);
        $Calendar->FYCAHMarkForDeletion   =   0;
        $Calendar->FYCAHUser              =   Auth::user()->name;
        $Calendar->FYCAHDeletedAt         =  Null;
        $Calendar->save();        
        return $Calendar->FYCAHCalendarId;
    }
}
//Fiscal Year Master Ends***** 
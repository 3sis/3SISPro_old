<?php
namespace app\Traits\CommonMasters\FiscalYear;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Auth;
use Illuminate\Support\Carbon;
use App\Models\CommonMasters\FiscalYear\WeeklyOffHeader;
use App\Models\CommonMasters\FiscalYear\WeeklyOffDetail;
use App\Models\CommonMasters\FiscalYear\MemWeeklyOffDetail;
// PHH : Public Holiday Header Master
// PHD : Public Holiday Detail Master
trait weeklyOffDbOperations {
    public function BrowserDataTrait() 
    {
        return $browserData = WeeklyOffHeader::join('T05903L02', 'T05903L02.FYCAHCalendarId', '=', 
         't05903l03.FYWOHCalendarId')
         ->join('t05903L01', 't05903L01.FYFYHFiscalYearId', '=', 't05903l03.FYWOHFiscalYearId')
         ->where('t05903l03.FYWOHMarkForDeletion', 0)
         ->get([
             't05903l03.FYWOHUniqueId',
             't05903l03.FYWOHCalendarId',
             'T05903L02.FYCAHDesc1',
             't05903l03.FYWOHFiscalYearId',
             'T05903L01.FYFYHStartDate',
             'T05903L01.FYFYHEndDate',
             't05903l03.FYWOHDesc1',
             't05903l03.FYWOHMonday',
             't05903l03.FYWOHTuesday',
             't05903l03.FYWOHWednesday',
             't05903l03.FYWOHThursday',
             't05903l03.FYWOHFriday',
             't05903l03.FYWOHSaturday',
             't05903l03.FYWOHSunday',
             't05903l03.FYWOHUser',
             't05903l03.FYWOHLastCreated',
             't05903l03.FYWOHLastUpdated'
         ]);
    }
    public function BrowserDeletedRecorTrait() 
    {
        return $browserData = WeeklyOffHeader::join('T05903L02', 'T05903L02.FYCAHCalendarId', '=', 
         't05903l03.FYWOHCalendarId')
         ->join('t05903L01', 't05903L01.FYFYHFiscalYearId', '=', 't05903l03.FYWOHFiscalYearId')
         ->where('t05903l03.FYWOHMarkForDeletion', 1)
         ->get([
             't05903l03.FYWOHUniqueId',
             't05903l03.FYWOHCalendarId',
             'T05903L02.FYCAHDesc1',
             't05903l03.FYWOHFiscalYearId',
             'T05903L01.FYFYHStartDate',
             'T05903L01.FYFYHEndDate',
             't05903l03.FYWOHDesc1',
         ]);
        // ->where('FYWOHMarkForDeletion', 1);
    }
    # Edit events - Landing Page Browser
    public function FethchEditedDataTrait($request){        
        // Now Update all the Header fields
        $FYWOHUniqueId = $request->input('id');
        $WeeklyOffHeader = WeeklyOffHeader::find($FYWOHUniqueId);        
        // Get Foreign Keys Description Ends*****
        return $output = array(

            'FYWOHUniqueId'            =>  $WeeklyOffHeader->FYWOHUniqueId,
            'FYWOHCalendarId'          =>  $WeeklyOffHeader->FYWOHCalendarId,
            'FYWOHFiscalYearId'        =>  $WeeklyOffHeader->FYWOHFiscalYearId,
            'FYWOHDesc1'               =>  $WeeklyOffHeader->FYWOHDesc1,
            'FYWOHUser'                =>  $WeeklyOffHeader->FYWOHUser,
            'FYWOHLastCreated'         =>  $WeeklyOffHeader->FYWOHLastCreated,
            'FYWOHLastUpdated'         =>  $WeeklyOffHeader->FYWOHLastUpdated
        );
    }
    # Append Mem Table 
    public function UpdateMemTable($request){
        $loginName = Auth::user()->name;
        // Add records from Employee LoanBook table to mem table
        $Master = WeeklyOffDetail::where('FYWODUniqueIdH', $request->id)
        ->orderBy('FYWODDayId')
        ->get();
        foreach ($Master as $key => $value) {
            MemWeeklyOffDetail::create([
                'FYWODUniqueId'         => $value -> FYWODUniqueId,
                'FYWODUniqueIdH'        => $value -> FYWODUniqueIdH,
                'FYWODCalendarId'       => $value -> FYWODCalendarId,
                'FYWODFiscalYearId'     => $value -> FYWODFiscalYearId,
                'FYWODHolidayType'      => $value -> FYWODHolidayType,
                'FYWODDayId'            => $value -> FYWODDayId,
                'FYWODDesc1'            => $value -> FYWODDesc1,
                'FYWODDesc2'            => $value -> FYWODDesc2,
                'FYWODAll'              => $value -> FYWODAll,
                'FYWODFirst'            => $value -> FYWODFirst,
                'FYWODSecond'           => $value -> FYWODSecond,
                'FYWODThird'            => $value -> FYWODThird,
                'FYWODFourth'           => $value -> FYWODFourth,
                'FYWODFifth'            => $value -> FYWODFifth,
                'FYWODMarkForDeletion'  => $value -> FYWODMarkForDeletion,
                'FYWODUser'             => $loginName,
                'FYWODStatusId'         => $value -> FYWODStatusId,
                'FYWODLastCreated'      => $value -> FYWODLastCreated,
                'FYWODLastUpdated'      => $value -> FYWODLastUpdated,
                'FYWODDeletedAt'        => $value -> FYWODDeletedAt,
            ]);     
        }
    }
    
    # WeeklyOffDetail Mem Sub Form
    public function BrowserSubFormWeeklyOffDetailMemTrait($request){
        // echo 'Data Submitted at Trait.1';
        // print_r($request->input());
        // die();
        return $browserData = MemWeeklyOffDetail::get([
            'FYWODDayId',
            'FYWODDesc1',
            'FYWODDesc2',
            'FYWODAll',
            'FYWODFirst',
            'FYWODSecond',
            'FYWODThird',
            'FYWODFourth',
            'FYWODFifth',
            'FYWODUser',
            'FYWODMarkForDeletion',
            'FYWODUniqueId'
        ]);
    }
    # Delete Mem Tables
    public function DeleteMemTablesTrait(){        
        $loginName = Auth::user()->name;  
        MemWeeklyOffDetail::where('FYWODUser', $loginName)
        ->delete();
        return;
    }
    public function CheckDuplicateWeeklyOffTrait($request){
        if ($request->button_action_DetailEntry1 == 'insert') {
            # code...
            return $DuplicateFound = MemWeeklyOffDetail::where('FYWODUniqueIdH', $request->FYWOHUniqueId)
            ->where('FYWODCalendarId', $request->FYWOHCalendarId)
            ->where('FYWODFiscalYearId', $request->FYWOHFiscalYearId)
            ->where('FYWODDayId', $request->FYWODDayId)
            ->get(['FYWODDayId'])
            ->first();            
        } else {
            # code...
            return $DuplicateFound = MemWeeklyOffDetail::where('FYWODUniqueIdH', $request->FYWOHUniqueId)
            ->where('FYWODCalendarId', $request->FYWOHCalendarId)
            ->where('FYWODFiscalYearId', $request->FYWOHFiscalYearId)
            ->where('FYWODDayId', $request->FYWODDayId)
            ->where('FYWODUniqueId', '!=' ,$request->FYWODUniqueId)
            ->get(['FYWODDayId'])
            ->first();      
        }
    }
    public function AddUpdateMemWeeklyOffTrait($request){
        // echo 'Data Submitted at Trait.1';
        // print_r($request->input());
        // die();
        if($request->get('button_action_DetailEntry1') == 'insert') {
            // Find the last Line No.
            $getLastLineNo = MemWeeklyOffDetail::where('FYWODUniqueIdH', $request->FYWOHUniqueId)
            ->orderBy('FYWODDayId', 'desc')
            ->get(['FYWODDayId'])
            ->first();
            $HeadUniqueId = 10;
         
            $MemWeeklyOffDetail = new MemWeeklyOffDetail;                
            $MemWeeklyOffDetail->FYWODUniqueIdH          =   $HeadUniqueId;            
            $MemWeeklyOffDetail->FYWODCalendarId         =   $request->FYWOHCalendarId;       
            $MemWeeklyOffDetail->FYWODFiscalYearId       =   $request->FYWOHFiscalYearId; 
            $MemWeeklyOffDetail->FYWODDayId              =   $request->FYWODDayId; 
            $MemWeeklyOffDetail->FYWODLastCreated        =   Carbon::now();
        }elseif($request->get('button_action_DetailEntry1') == 'update'){
            $MemWeeklyOffDetail = MemWeeklyOffDetail::find($request->get('FYWODUniqueId'));
        } 
        $MemWeeklyOffDetail->FYWODDesc1        =   $request->FYWODDesc1;
        $MemWeeklyOffDetail->FYWODDesc2        =   $request->FYWODDesc2;
        $MemWeeklyOffDetail->FYWODAll          =   $request->FYWODAll;
        $MemWeeklyOffDetail->FYWODFirst        =   $request->FYWODFirst;
        $MemWeeklyOffDetail->FYWODSecond       =   $request->FYWODSecond;
        $MemWeeklyOffDetail->FYWODThird        =   $request->FYWODThird;
        $MemWeeklyOffDetail->FYWODFourth       =   $request->FYWODFourth;
        $MemWeeklyOffDetail->FYWODFifth        =   $request->FYWODFifth;
        $MemWeeklyOffDetail->FYWODBiDesc       =   $request->FYWODBiDesc;
        $MemWeeklyOffDetail->FYWODUser         =   Auth::user()->name;
        $MemWeeklyOffDetail->FYWODLastUpdated  =   Carbon::now();
        $MemWeeklyOffDetail->save(); 
        if($request->get('button_action_DetailEntry1') == 'insert') {
            $UniqueId = $MemWeeklyOffDetail->FYWODUniqueId; 
        }elseif($request->get('button_action_DetailEntry1') == 'update'){
            $UniqueId = $request->get('FYWODUniqueId');
        }
        return $UniqueId; 
    }
    public function FethchEditedDataWeeklyOffTrait($request){  
        $loginName = Auth::user()->name;
        $FYWODUniqueId = $request->input('id');
        $MemWeeklyOffDetail = MemWeeklyOffDetail::find($FYWODUniqueId);
        return $output = array(
                'FYWODUniqueId'         => $MemWeeklyOffDetail ->FYWODUniqueId,
                'FYWODUniqueIdH'        => $MemWeeklyOffDetail ->FYWODUniqueIdH,
                'FYWODCalendarId'       => $MemWeeklyOffDetail ->FYWODCalendarId,
                'FYWODFiscalYearId'     => $MemWeeklyOffDetail -> FYWODFiscalYearId,
                'FYWODDayId'            => $MemWeeklyOffDetail -> FYWODDayId,
                'FYWODDesc1'            => $MemWeeklyOffDetail -> FYWODDesc1,
                'FYWODAll'              => $MemWeeklyOffDetail -> FYWODAll,
                'FYWODFirst'            => $MemWeeklyOffDetail -> FYWODFirst,
                'FYWODSecond'           => $MemWeeklyOffDetail -> FYWODSecond,
                'FYWODThird'            => $MemWeeklyOffDetail -> FYWODThird,
                'FYWODFourth'           => $MemWeeklyOffDetail -> FYWODFourth,
                'FYWODFifth'            => $MemWeeklyOffDetail -> FYWODFifth,
                'FYWODBiDesc'           => $MemWeeklyOffDetail -> FYWODBiDesc,
                'FYWODUser'             => $loginName
        );
    }
    public function IsMemTableUpdatedTrait(){
        return $IsMemTableUpdated = MemWeeklyOffDetail::where('FYWODUser', Auth::user()->name)
        // ->where('FYWODDayId' !='')
        ->get(['FYWODDayId'])
        ->first();
        // if ($IsMemTableUpdated == '') {
        //     $Update = 1;
        // }
        // // return $Update
        // echo 'Data Submitted at Trait.1'.$Update;
        // print_r($IsMemTableUpdated);
        // die();
    }
    public function UpdateFormDataToWeeklyOffHeaderTrait($request)
    {
       if($request->get('button_action') == 'insert') {
           $WeeklyOffHeader = new WeeklyOffHeader;                
           $WeeklyOffHeader->FYWOHCalendarId    = $request->FYWOHCalendarId;
           $WeeklyOffHeader->FYWOHFiscalYearId  = $request->FYWOHFiscalYearId;
           $WeeklyOffHeader->FYWOHLastCreated   = Carbon::now();
       }elseif($request->get('button_action') == 'update'){
           $WeeklyOffHeader = WeeklyOffHeader::find($request->get('FYWOHUniqueId'));
       }
       $WeeklyOffHeader->FYWOHDesc1     = $request->FYWOHDesc1;
       $WeeklyOffHeader->FYWOHDesc2     = $request->FYWOHDesc2;

       $WeeklyOffHeader->FYWOHMonday    = 0;
       $WeeklyOffHeader->FYWOHTuesday   = 0;
       $WeeklyOffHeader->FYWOHWednesday = 0;
       $WeeklyOffHeader->FYWOHThursday  = 0;
       $WeeklyOffHeader->FYWOHFriday    = 0;
       $WeeklyOffHeader->FYWOHSaturday  = 0;
       $WeeklyOffHeader->FYWOHSunday    = 0;

       $WeeklyOffHeader->FYWOHMarkForDeletion = 0;
       $WeeklyOffHeader->FYWOHUser            = Auth::user()->name;
       $WeeklyOffHeader->FYWOHLastUpdated     = Carbon::now();
       $WeeklyOffHeader->save(); 
       if($request->get('button_action') == 'insert') {
           $UniqueId = $WeeklyOffHeader->FYWOHUniqueId; 
       }elseif($request->get('button_action') == 'update'){
           $UniqueId = $request->get('FYWOHUniqueId');
       }
       $this->deleteDetailTable($request);
       $this->moveSubFormDataWeeklyOffTrait($UniqueId, $WeeklyOffHeader);
       // echo 'Data Submitted.1';
       // print_r( $UniqueId);
       // die();  
       return $UniqueId; 
    }
    public function FetchSubFormDetailTrait($request){
        $MemWeeklyOffDetail = MemWeeklyOffDetail::where('FYWODUniqueId', $request->id)
        ->get()
        ->first();
        return $output = array(
            // For Delete Button and Delete Detail Entry Form
            'FYWODDayId'    =>  $MemWeeklyOffDetail->FYWODDayId,
            'FYWODDesc1'  =>  $MemWeeklyOffDetail->FYWODDesc1,
        );
    }
    public function DeleteThisRowTrait($request){
        $MemWeeklyOffDetail = MemWeeklyOffDetail::where('FYWODUniqueId', $request->id)
        ->delete();
        return;
    }
    function moveSubFormDataWeeklyOffTrait($UniqueId, $WeeklyOffHeader){
        $MemWeeklyOffDetail = MemWeeklyOffDetail::orderBy('FYWODDayId')
        ->get();
        $TotalWeeklyOff =  0;
        
        foreach ($MemWeeklyOffDetail as $key => $value) {
            $DayId = $value->FYWODDayId;
            $TotalWeeklyOff ++;
            WeeklyOffDetail::create([
                'FYWODUniqueIdH'        => $UniqueId,
                'FYWODCalendarId'       => $value->FYWODCalendarId,
                'FYWODFiscalYearId'     => $value->FYWODFiscalYearId,
                'FYWODHolidayType'      => $value->FYWODHolidayType,
                'FYWODDayId'            => $value->FYWODDayId,
                'FYWODDesc1'            => $value->FYWODDesc1,
                'FYWODDesc2'            => $value->FYWODDesc2,
                'FYWODAll'              => $value->FYWODAll,
                'FYWODFirst'            => $value->FYWODFirst,
                'FYWODSecond'           => $value->FYWODSecond,
                'FYWODThird'            => $value->FYWODThird,
                'FYWODFourth'           => $value->FYWODFourth,
                'FYWODFifth'            => $value->FYWODFifth,
                'FYWODBiDesc'           => $value->FYWODBiDesc,
                'FYWODMarkForDeletion'  => $value->FYWODMarkForDeletion,
                'FYWODUser'             => Auth::user()->name,
                'FYWODLastCreated'      => $value->FYWODLastCreated,
                'FYWODLastUpdated'      => $value->FYWODLastUpdated,
                'FYWODDeletedAt'        => $value->FYWODDeletedAt
            ]);
            $this->updateWeeklyOffHeaderForDayId($UniqueId, $DayId, $TotalWeeklyOff);

        }
    }
    function updateWeeklyOffHeaderForDayId($UniqueId, $DayId, $TotalWeeklyOff){
        if ((int)$DayId==7) {
            $WeeklyOffHeader = WeeklyOffHeader::where('FYWOHUniqueId', $UniqueId)
            ->first()              
            ->update([
                'FYWOHSunday'      => 1
            ]);
        }
        if ((int)$DayId==1) {
            $WeeklyOffHeader = WeeklyOffHeader::where('FYWOHUniqueId', $UniqueId)
            ->first()              
            ->update([
                'FYWOHMonday'      => 1
            ]);
        }
        if ((int)$DayId==2) {
            $WeeklyOffHeader = WeeklyOffHeader::where('FYWOHUniqueId', $UniqueId)
            ->first()              
            ->update([
                'FYWOHTuesday'      => 1
            ]);
        }
        if ((int)$DayId==3) {
            $WeeklyOffHeader = WeeklyOffHeader::where('FYWOHUniqueId', $UniqueId)
            ->first()              
            ->update([
                'FYWOHWednesday'      => 1
            ]);
        }
        if ((int)$DayId==4) {
            $WeeklyOffHeader = WeeklyOffHeader::where('FYWOHUniqueId', $UniqueId)
            ->first()              
            ->update([
                'FYWOHThursday'      => 1
            ]);
        }
        if ((int)$DayId==5) {
            $WeeklyOffHeader = WeeklyOffHeader::where('FYWOHUniqueId', $UniqueId)
            ->first()              
            ->update([
                'FYWOHFriday'      => 1
            ]);
        }
        if ((int)$DayId==6) {
            $WeeklyOffHeader = WeeklyOffHeader::where('FYWOHUniqueId', $UniqueId)
            ->first()              
            ->update([
                'FYWOHSaturday'      => 1
            ]);
        }
        $WeeklyOffHeader = WeeklyOffHeader::where('FYWOHUniqueId', $UniqueId)
        ->first()              
        ->update([
            'FYWOHTotalWeeklyOff'      => $TotalWeeklyOff
        ]);
        
    }
    // Delete Detail Table
    public function deleteDetailTable($request){
        $WeeklyOffDetail = WeeklyOffDetail::where('FYWODUniqueIdH', $request->FYWOHUniqueId)
        ->delete();
    }   
    public function DeleteRecordTrait($request)
    {
        $UniqueId = $request->input('id');
        //Eloquent Way
        $WeeklyOffHeader = WeeklyOffHeader::find($UniqueId);
        $WeeklyOffHeader->FYWOHMarkForDeletion   =   1;
        $WeeklyOffHeader->FYWOHUser              =   Auth::user()->name;
        $WeeklyOffHeader->FYWOHDeletedAt         =  Carbon::now();
        $WeeklyOffHeader->save();        
        return $WeeklyOffHeader->FYWOHFiscalYearId;
    }
    public function UnDeleteRecordTrait($request)
    {
        $UniqueId = $request->input('id');
        //Eloquent Way
        $WeeklyOffHeader = WeeklyOffHeader::find($UniqueId);
        $WeeklyOffHeader->FYWOHMarkForDeletion   =   0;
        $WeeklyOffHeader->FYWOHUser              =   Auth::user()->name;
        $WeeklyOffHeader->FYWOHDeletedAt         =  Null;
        $WeeklyOffHeader->save();        
        return $WeeklyOffHeader->FYWOHFiscalYearId;
    }

    public function CheckDuplicateHeaderTrait($request){
        if ($request->button_action_DetailEntry1 == 'insert') {
            # code...
            return $DuplicateFound = WeeklyOffHeader::where('FYWOHCalendarId', $request->FYWOHCalendarId)
            ->where('FYWOHFiscalYearId', $request->FYWOHFiscalYearId)
            ->get(['FYWOHFiscalYearId'])
            ->first();            
        } 
    }
}

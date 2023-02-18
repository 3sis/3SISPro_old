<?php
namespace app\Traits\CommonMasters\FiscalYear;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Auth;
use Illuminate\Support\Carbon;
use App\Models\CommonMasters\FiscalYear\PublicHolidayHeader;
use App\Models\CommonMasters\FiscalYear\PublicHolidayDetail;
use App\Models\CommonMasters\FiscalYear\MemPublicHolidayDetail;
// PHH : Public Holiday Header Master
// PHD : Public Holiday Detail Master
trait publicHolidayDbOperations {
    public function BrowserDataTrait() 
    {
        return $browserData = PublicHolidayHeader::join('T05903L02', 'T05903L02.FYCAHCalendarId', '=', 
         't05903l04.FYPHHCalendarId')
         ->join('t05903L01', 't05903L01.FYFYHFiscalYearId', '=', 't05903l04.FYPHHFiscalYearId')
         ->where('t05903l04.FYPHHMarkForDeletion', 0)
         ->get([
            't05903l04.FYPHHUniqueId',
            't05903l04.FYPHHCalendarId',
            'T05903L02.FYCAHDesc1',
            't05903l04.FYPHHFiscalYearId',
            'T05903L01.FYFYHStartDate',
            'T05903L01.FYFYHEndDate',
            't05903l04.FYPHHUser',
            't05903l04.FYPHHLastUpdated',
        ]);
    }
    public function BrowserDeletedRecorTrait() 
    {
        return $browserData = PublicHolidayHeader::join('T05903L02', 'T05903L02.FYCAHCalendarId', '=', 
         't05903l04.FYPHHCalendarId')
         ->join('t05903L01', 't05903L01.FYFYHFiscalYearId', '=', 't05903l04.FYPHHFiscalYearId')
         ->where('t05903l04.FYPHHMarkForDeletion', 1)
         ->get([
             't05903l04.FYPHHUniqueId',
             't05903l04.FYPHHCalendarId',
             'T05903L02.FYCAHDesc1',
             't05903l04.FYPHHFiscalYearId',
             'T05903L01.FYFYHStartDate',
             'T05903L01.FYFYHEndDate',
         ]);
        // ->where('FYPHHMarkForDeletion', 1);
    }
    # Edit events - Landing Page Browser
    public function FethchEditedDataTrait($request){        
        // Now Update all the Header fields
        $FYPHHUniqueId = $request->input('id');
        $PublicHolidayHeader = PublicHolidayHeader::find($FYPHHUniqueId);        
        // Get Foreign Keys Description Ends*****
        return $output = array(

            'FYPHHUniqueId'            =>  $PublicHolidayHeader->FYPHHUniqueId,
            'FYPHHCalendarId'          =>  $PublicHolidayHeader->FYPHHCalendarId,
            'FYPHHFiscalYearId'        =>  $PublicHolidayHeader->FYPHHFiscalYearId,
            'FYPHHUser'                =>  $PublicHolidayHeader->FYPHHUser,
            'FYPHHLastCreated'         =>  $PublicHolidayHeader->FYPHHLastCreated,
            'FYPHHLastUpdated'         =>  $PublicHolidayHeader->FYPHHLastUpdated
        );
    }
    # Append Mem Table 
    public function UpdateMemTable($request){
        $loginName = Auth::user()->name;
        // Add records from Employee LoanBook table to mem table
        $Master = PublicHolidayDetail::where('FYPHDUniqueIdH', $request->id)
        ->orderBy('FYPHDHolidayDate')
        ->get();
        foreach ($Master as $key => $value) {
            MemPublicHolidayDetail::create([
                'FYPHDUniqueId'         => $value -> FYPHDUniqueId,
                'FYPHDUniqueIdH'        => $value -> FYPHDUniqueIdH,
                'FYPHDCalendarId'       => $value -> FYPHDCalendarId,
                'FYPHDFiscalYearId'     => $value -> FYPHDFiscalYearId,
                'FYPHDHolidayType'      => $value -> FYPHDHolidayType,
                'FYPHDHolidayDate'      => $value -> FYPHDHolidayDate,
                'FYPHDDesc1'            => $value -> FYPHDDesc1,
                'FYPHDDesc2'            => $value -> FYPHDDesc2,
                'FYPHDBiDesc'           => $value -> FYPHDBiDesc,
                'FYPHDMarkForDeletion'  => $value -> FYPHDMarkForDeletion,
                'FYPHDUser'             => $loginName,
                'FYPHDLastCreated'      => $value -> FYPHDLastCreated,
                'FYPHDLastUpdated'      => $value -> FYPHDLastUpdated,
                'FYPHDDeletedAt'        => $value -> FYPHDDeletedAt,
            ]);     
        }
    }
    # PublicHolidayDetail Mem Sub Form
    public function BrowserSubFormPublicHolidayDetailMemTrait($request){
        // echo 'Data Submitted at Trait.1';
        // print_r($request->input());
        // die();
        return $browserData = MemPublicHolidayDetail::get([
            'FYPHDHolidayDate',
            'FYPHDHolidayDate AS HolidayDateSort',
            'FYPHDDesc1',
            'FYPHDUser',
            'FYPHDUniqueId'
        ]);
    }
    public function CheckDuplicatePublicHolidayTrait($request){
            // echo 'Data Submitted.1';
            // print_r($request->input());
            // die();
        if ($request->button_action_DetailEntry1 == 'insert') {
            # code...
            return $DuplicateFound = MemPublicHolidayDetail::where('FYPHDUniqueIdH', $request->FYPHHUniqueId)
            ->where('FYPHDCalendarId', $request->FYPHHCalendarId)
            ->where('FYPHDFiscalYearId', $request->FYPHHFiscalYearId)
            ->where('FYPHDHolidayDate', $request->FYPHDHolidayDate)
            ->get(['FYPHDHolidayDate'])
            ->first();            
        } else {
            # code...
            return $DuplicateFound = MemPublicHolidayDetail::where('FYPHDUniqueIdH', $request->FYPHHUniqueId)
            ->where('FYPHDCalendarId', $request->FYPHHCalendarId)
            ->where('FYPHDFiscalYearId', $request->FYPHHFiscalYearId)
            ->where('FYPHDHolidayDate', $request->FYPHDHolidayDate)
            ->where('FYPHDUniqueId', '!=' ,$request->FYPHDUniqueId)
            ->get(['FYPHDHolidayDate'])
            ->first();      
        }
    }
    public function AddUpdateMemPublicHolidayTrait($request){
        // echo 'Data Submitted at Trait.1';
        // print_r($request->input());
        // die();
        if($request->get('button_action_DetailEntry1') == 'insert') {
            // Find the last Line No.
            $getLastLineNo = MemPublicHolidayDetail::where('FYPHDUniqueIdH', $request->FYPHHUniqueId)
            ->orderBy('FYPHDHolidayDate', 'desc')
            ->get(['FYPHDHolidayDate'])
            ->first();
            $HeadUniqueId = 10;
         
            $MemPublicHolidayDetail = new MemPublicHolidayDetail;                
            $MemPublicHolidayDetail->FYPHDUniqueIdH          =   $HeadUniqueId;            
            $MemPublicHolidayDetail->FYPHDCalendarId         =   $request->FYPHHCalendarId;       
            $MemPublicHolidayDetail->FYPHDFiscalYearId       =   $request->FYPHHFiscalYearId; 
            $MemPublicHolidayDetail->FYPHDHolidayDate        =   $request->FYPHDHolidayDate; 
            $MemPublicHolidayDetail->FYPHDLastCreated        =   Carbon::now();
        }elseif($request->get('button_action_DetailEntry1') == 'update'){
            $MemPublicHolidayDetail = MemPublicHolidayDetail::find($request->get('FYPHDUniqueId'));
        } 
        $MemPublicHolidayDetail->FYPHDDesc1        =   $request->FYPHDDesc1;
        $MemPublicHolidayDetail->FYPHDDesc2        =   $request->FYPHDDesc2;
        $MemPublicHolidayDetail->FYPHDBiDesc       =   $request->FYPHDBiDesc;
        $MemPublicHolidayDetail->FYPHDUser         =   Auth::user()->name;
        $MemPublicHolidayDetail->FYPHDLastUpdated  =   Carbon::now();
        $MemPublicHolidayDetail->save(); 
        if($request->get('button_action_DetailEntry1') == 'insert') {
            $UniqueId = $MemPublicHolidayDetail->FYPHDUniqueId; 
        }elseif($request->get('button_action_DetailEntry1') == 'update'){
            $UniqueId = $request->get('FYPHDUniqueId');
        }
        return $UniqueId; 
    }
    # Delete Mem Tables
    public function DeleteMemTablesTrait(){        
        $loginName = Auth::user()->name;  
        MemPublicHolidayDetail::where('FYPHDUser', $loginName)
        ->delete();
        return;
    }
    // Detail Sub Form Events
    public function FetchSubFormDetailTrait($request){
        $MemPublicHolidayDetail = MemPublicHolidayDetail::where('FYPHDUniqueId', $request->id)
        ->get()
        ->first();
        return $output = array(
            // For Delete Button and Delete Detail Entry Form
            'FYPHDHolidayDate'    =>  $MemPublicHolidayDetail->FYPHDHolidayDate,
            'FYPHDDesc1'  =>  $MemPublicHolidayDetail->FYPHDDesc1,
        );
    }
    public function DeleteThisRowTrait($request){
        $MemPublicHolidayDetail = MemPublicHolidayDetail::where('FYPHDUniqueId', $request->id)
        ->delete();
        return;
    }
    
    public function FethchEditedDataPublicHolidayTrait($request){  
        $loginName = Auth::user()->name;
        $FYPHDUniqueId = $request->input('id');
        $MemPublicHolidayDetail = MemPublicHolidayDetail::find($FYPHDUniqueId);
        return $output = array(
                'FYPHDUniqueId'         => $MemPublicHolidayDetail -> FYPHDUniqueId,
                'FYPHDUniqueIdH'        => $MemPublicHolidayDetail -> FYPHDUniqueIdH,
                'FYPHDCalendarId'       => $MemPublicHolidayDetail -> FYPHDCalendarId,
                'FYPHDFiscalYearId'     => $MemPublicHolidayDetail -> FYPHDFiscalYearId,
                'FYPHDHolidayDate'      => $MemPublicHolidayDetail -> FYPHDHolidayDate,
                'FYPHDDesc1'            => $MemPublicHolidayDetail -> FYPHDDesc1,
                'FYPHDUser'             => $loginName
        );
    }
    public function IsMemTableUpdatedTrait(){
       return $IsMemTableUpdated = MemPublicHolidayDetail::where('FYPHDUser', Auth::user()->name)
        // ->where('FYPHDHolidayDate' !='')
        ->get(['FYPHDHolidayDate'])
        ->first();
        // echo 'Data Submitted at Trait.1';
        // print_r($IsMemTableUpdated);
        // die();
    }
    public function UpdateFormDataToPublicHolidayHeaderTrait($request)
    {
       if($request->get('button_action') == 'insert') {
           $PublicHolidayHeader = new PublicHolidayHeader;                
           $PublicHolidayHeader->FYPHHCalendarId    = $request->FYPHHCalendarId;
           $PublicHolidayHeader->FYPHHFiscalYearId  = $request->FYPHHFiscalYearId;
           $PublicHolidayHeader->FYPHHLastCreated   = Carbon::now();
       }elseif($request->get('button_action') == 'update'){
           $PublicHolidayHeader = PublicHolidayHeader::find($request->get('FYPHHUniqueId'));
       }
       $PublicHolidayHeader->FYPHHMarkForDeletion = 0;
       $PublicHolidayHeader->FYPHHUser            = Auth::user()->name;
       $PublicHolidayHeader->FYPHHLastUpdated     = Carbon::now();
       $PublicHolidayHeader->save(); 
       if($request->get('button_action') == 'insert') {
           $UniqueId = $PublicHolidayHeader->FYPHHUniqueId; 
       }elseif($request->get('button_action') == 'update'){
           $UniqueId = $request->get('FYPHHUniqueId');
       }
       $this->deleteDetailTable($request);
       $this->moveSubFormDataPublicHolidayTrait($UniqueId, $PublicHolidayHeader);
       // echo 'Data Submitted.1';
       // print_r( $UniqueId);
       // die();  
       return $UniqueId; 
    }
    function moveSubFormDataPublicHolidayTrait($UniqueId, $PublicHolidayHeader){
        $MemPublicHolidayDetail = MemPublicHolidayDetail::orderBy('FYPHDHolidayDate')
        ->get();
        foreach ($MemPublicHolidayDetail as $key => $value) {
            $DayId = $value->FYPHDHolidayDate;
            PublicHolidayDetail::create([
                'FYPHDUniqueIdH'        => $UniqueId,
                'FYPHDCalendarId'       => $value->FYPHDCalendarId,
                'FYPHDFiscalYearId'     => $value->FYPHDFiscalYearId,
                'FYPHDHolidayType'      => $value->FYPHDHolidayType,
                'FYPHDHolidayDate'      => $value->FYPHDHolidayDate,
                'FYPHDDesc1'            => $value->FYPHDDesc1,
                'FYPHDDesc2'            => $value->FYPHDDesc2,
                'FYPHDBiDesc'           => $value->FYPHDBiDesc,
                'FYPHDMarkForDeletion'  => $value->FYPHDMarkForDeletion,
                'FYPHDUser'             => Auth::user()->name,
                'FYPHDLastCreated'      => $value->FYPHDLastCreated,
                'FYPHDLastUpdated'      => $value->FYPHDLastUpdated,
                'FYPHDDeletedAt'        => $value->FYPHDDeletedAt
            ]);
        }
    }
    // Delete Detail Table
    public function deleteDetailTable($request){
        $PublicHolidayDetail = PublicHolidayDetail::where('FYPHDUniqueIdH', $request->FYPHHUniqueId)
        ->delete();
    }  
    public function DeleteRecordTrait($request)
    {
        $UniqueId = $request->input('id');
        //Eloquent Way
        $PublicHolidayHeader = PublicHolidayHeader::find($UniqueId);
        $PublicHolidayHeader->FYPHHMarkForDeletion   =   1;
        $PublicHolidayHeader->FYPHHUser              =   Auth::user()->name;
        $PublicHolidayHeader->FYPHHDeletedAt         =  Carbon::now();
        $PublicHolidayHeader->save();        
        return $PublicHolidayHeader->FYPHHFiscalYearId;
    }
    public function UnDeleteRecordTrait($request)
    {
        $UniqueId = $request->input('id');
        //Eloquent Way
        $PublicHolidayHeader = PublicHolidayHeader::find($UniqueId);
        $PublicHolidayHeader->FYPHHMarkForDeletion   =   0;
        $PublicHolidayHeader->FYPHHUser              =   Auth::user()->name;
        $PublicHolidayHeader->FYPHHDeletedAt         =  Null;
        $PublicHolidayHeader->save();        
        return $PublicHolidayHeader->FYPHHFiscalYearId;
    }

    public function CheckDuplicateHeaderTrait($request){
        if ($request->button_action_DetailEntry1 == 'insert') {
            # code...
            return $DuplicateFound = PublicHolidayHeader::where('FYPHHCalendarId', $request->FYPHHCalendarId)
            ->where('FYPHHFiscalYearId', $request->FYPHHFiscalYearId)
            ->get(['FYPHHFiscalYearId'])
            ->first();            
        } 
    }
}
//Public Holiday Master Ends***** 
// return Schema::create($tableName,function($table)
// {
//     $table->increments('id');
//     $table->string('title');
// });
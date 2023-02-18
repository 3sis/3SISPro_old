<?php
namespace app\Traits\CommonMasters\FiscalYear;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Auth;
use Illuminate\Support\Carbon;
use Carbon\CarbonImmutable;
use App\Models\CommonMasters\FiscalYear\MaintainCalendar;
use App\Models\CommonMasters\FiscalYear\WeeklyOffDetail;
use App\Models\CommonMasters\FiscalYear\PublicHolidayDetail;
trait MaintainCalendarDbOperations {
    public function BrowserDataTrait() 
    {
        return $browserData = MaintainCalendar::where('FYCOHMarkForDeletion', 0)
         ->get([
            'FYCOHOffDate',
            'FYCOHOffDate AS OffDateSort',
            'FYCOHOffDateReason',
            'FYCOHOffDayCode',
            'FYCOHDesc',
            'FYCOHBiDesc',
            'FYCOHMarkForDeletion',
            'FYCOHUser',
            'FYCOHLastUpdated',
        ]);
    }
    public function PopulateCalendarTrait($request){
        //get off DayId from WeeklyOffDetail actual table
        $this->updateMaintainCalendarForPublicHoliday($request);

        $WeeklyOffDayId = WeeklyOffDetail::where('FYWODCalendarId', $request->FYCOHCalendarId)
        ->where('FYWODFiscalYearId', $request->FYCOHFiscalYearId)
        ->where('FYWODMarkForDeletion' , 0)
        ->get();

        

        // $day = Carbon::createFromFormat('d/m/Y', $startDate)->format('l');
        // dd($day);
        // $DayId = $startDate->isoFormat('dddd');

        // $days = $end->diffInDays($start);
        // $en = CarbonImmutable::parse($request->FYFYHStartDate)->locale('en_US');
        // $en1 = CarbonImmutable::parse($request->FYFYHStartDate)->format('d/m/Y');
        // $en2 = CarbonImmutable::parse($en1)->weekday();
        //  $dump=$en->Weekday(); 
        //  $dump1=$en->isoWeekday(); 

        // $weekDay = CarbonImmutable::parse($startDateOfFY)->format('d/m/Y')->weekday();

        
        // echo 'Data Submitted at Trait for get Week Day '.$request->FYFYHStartDate.' '. $dump1;
        // echo 'Data Submitted at Trait for get Week Day '.$request->FYFYHStartDate.' '.$startDateOfFY.' '. $dump1.' ';
        
        // echo 'Data Submitted at Trait '.$en.' '.$en1.' '.$en2.' '.$weekDayId;
        // $weekDayId = Carbon::parse($request->FYFYHStartDate)->isoweekday();
        // print_r($en);
        // $startDate2 = 2;
        // $startDate = $startDate->addDays(1);

        // echo 'Data Submitted at Trait '.$DayId;
        // die();

        foreach ($WeeklyOffDayId as $key => $value) {
            $startDate = Carbon::parse($request->FYFYHStartDate);
            $endDate = Carbon::parse($request->FYFYHEndDate);
            $whichDayIsOff = 0;
            
            $totalDays = $startDate->diffInDays($endDate)+1;

            // echo 'Data Submitted  value '.$value.'<BR>' ;

            for ($loopLength = 1; $loopLength < $totalDays; $loopLength++){
                $weekDayId = Carbon::parse($startDate)->isoweekday();
                $DayId = $startDate->isoFormat('D');
                if ($DayId == 1) {
                    $whichDayIsOff = 0;
                }
                if ($weekDayId == $value->FYWODDayId) {
                    $whichDayIsOff ++;
                    if ($value->FYWODAll !='') {
                        $this->updateMaintainCalendarWeeklyOff($request,$startDate);
                    } 
                    if ($value->FYWODFirst !='' && $whichDayIsOff == 1) {
                        $this->updateMaintainCalendarWeeklyOff($request,$startDate);
                    }
                    if ($value->FYWODSecond !='' && $whichDayIsOff == 2) {
                        $this->updateMaintainCalendarWeeklyOff($request,$startDate);
                    }
                    if ($value->FYWODThird !='' && $whichDayIsOff == 3) {
                        $this->updateMaintainCalendarWeeklyOff($request,$startDate);
                    }
                    if ($value->FYWODFourth !='' && $whichDayIsOff == 4) {
                        $this->updateMaintainCalendarWeeklyOff($request,$startDate);
                    }
                    if ($value->FYWODFifth !='' && $whichDayIsOff == 5) {
                        $this->updateMaintainCalendarWeeklyOff($request,$startDate);
                    }
                }
                $startDate = $startDate->addDays(1);
            }
        }
    }
    public function DeleteTablesTrait($request){        
        $loginName = Auth::user()->name;  
        MaintainCalendar::where('FYCOHCalendarId', $request->FYCOHCalendarId)
        ->where('FYCOHFiscalYearId', $request->FYCOHFiscalYearId)
        ->where('FYCOHMarkForDeletion' , 0)
        ->delete();
        return;
    }   
    function updateMaintainCalendarForPublicHoliday($request)
    {
        $PublicHolidayDetail = PublicHolidayDetail::where('FYPHDCalendarId', $request->FYCOHCalendarId)
        ->where('FYPHDFiscalYearId', $request->FYCOHFiscalYearId)
        ->orderBy('FYPHDHolidayDate')
        ->get();
        foreach ($PublicHolidayDetail as $key => $value) {
            $offDate = Carbon::parse($value->FYPHDHolidayDate);
            $DayName = $offDate->isoFormat('dddd');
            MaintainCalendar::create([
                'FYCOHCompId'           =>  $this->gCompanyId,
                'FYCOHCalendarId'       => $request->FYCOHCalendarId,
                'FYCOHFiscalYearId'     => $request->FYCOHFiscalYearId,
                'FYCOHOffDate'          => $value->FYPHDHolidayDate,
                'FYCOHOffDateReason'    => $DayName.' - Public Holiday',
                'FYCOHOffDayCode'       => 'PH',
                'FYCOHDesc'             => 'Public Holiday',
                'FYCOHBiDesc'           => '',
                'FYCOHMarkForDeletion'  => 0,
                'FYCOHUser'             => Auth::user()->name,
                'FYCOHLastCreated'      => Carbon::now(),
                'FYCOHLastUpdated'      => Carbon::now(),
            ]);
        }
    }
    function updateMaintainCalendarWeeklyOff($request,$startDate)
    {
        $MaintainCalendarOffDay = MaintainCalendar::where('FYCOHCalendarId', $request->FYCOHCalendarId)
        ->where('FYCOHFiscalYearId', $request->FYCOHFiscalYearId)
        ->where('FYCOHOffDate', $startDate)
        ->orderBy('FYCOHOffDate')
        ->get(['FYCOHOffDate'])            
        ->first();            
        // echo 'Data Submitted. '.$MaintainCalendarOffDay->FYCOHOffDate.' '.$startDate.'<BR>';
        // print_r($MaintainCalendarOffDay);
        // die();
        if ($MaintainCalendarOffDay == '') {
            
            $DayName = $startDate->isoFormat('dddd');

            $MaintainCalendar = new MaintainCalendar;                
            $MaintainCalendar->FYCOHCompId        =   $this->gCompanyId; 
            $MaintainCalendar->FYCOHCalendarId    =   $request->FYCOHCalendarId;       
            $MaintainCalendar->FYCOHFiscalYearId  =   $request->FYCOHFiscalYearId;
            $MaintainCalendar->FYCOHOffDate       =   $startDate;
            $MaintainCalendar->FYCOHOffDateReason =   $DayName.' - Weekly Off';
            $MaintainCalendar->FYCOHOffDayCode    =   'WO';
            $MaintainCalendar->FYCOHDesc          =   'Weekly Off';
            $MaintainCalendar->FYCOHBiDesc       =   $request->FYCOHBiDesc;
            $MaintainCalendar->FYCOHUser         =   Auth::user()->name;
            $MaintainCalendar->FYCOHLastCreated  =   Carbon::now();
            $MaintainCalendar->FYCOHLastUpdated  =   Carbon::now();
            $MaintainCalendar->save(); 
        }
    }
    # Delete Mem Tables
    
}

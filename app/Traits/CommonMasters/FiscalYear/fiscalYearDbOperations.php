<?php
namespace app\Traits\CommonMasters\FiscalYear;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Auth;
use Illuminate\Support\Carbon;
use App\Models\CommonMasters\FiscalYear\FiscalYear;
use App\Models\SystemsMaster\PeriodMaster;
// FY : Fiscal Year Master
trait fiscalYearDbOperations {        
    public function fyBrowserDataTrait() 
    {
        return $browserData = FiscalYear::join('T00901L01', 'T00901L01.FYPMHPeriodId', '=', 
         'T05903L01.FYFYHCurrentPeriod')
         ->where('T05903L01.FYFYHCompanyId', $this->gCompanyId)
         ->where('T05903L01.FYFYHMarkForDeletion', 0)
         ->get([
             'T05903L01.FYFYHUniqueId',
             'T05903L01.FYFYHCompanyId',
             'T05903L01.FYFYHFiscalYearId',
             'T05903L01.FYFYHStartDate',
             'T05903L01.FYFYHEndDate',
             'T05903L01.FYFYHCurrentFY',
             'T05903L01.FYFYHCurrentPeriod',
             'T00901L01.FYPMHDesc1',
             'T05903L01.FYFYHPeriodStartDate',
             'T05903L01.FYFYHPeriodEndDate',
             'T05903L01.FYFYHUser',
             'T05903L01.FYFYHLastCreated',
             'T05903L01.FYFYHLastUpdated'
         ]);
    }
    public function fyBrowserDeletedRecorTrait() 
    {
        return $browserDeletedRecords = FiscalYear::
        select(
            'FYFYHUniqueId', 
            'FYFYHFiscalYearId',
            'FYFYHStartDate', 
            'FYFYHEndDate')
            // This is AND condition in wherer to apply OR second where should be orwhere
        // ->where('FYFYHCompanyId', $this->gCompanyId)
        ->where('FYFYHMarkForDeletion', 1);
    }
    public function fyAddUpdateTrait($request)
    {
        DB::select("CALL getPeriodFromToDate(".$request->FYFYHFiscalYearId.", ".$request->periodId.", @fromDate, @toDate)");
        $results = DB::select('select @fromDate as fromDate, @toDate as toDate ');  
        // return date('Y-m-d h:i A', strtotime($val)); // A is for am pm
        if($request->get('button_action') == 'insert') {
            $FiscalYear = new FiscalYear;                
            $FiscalYear->FYFYHCompanyId         =   $request->FYFYHCompanyId;
            $FiscalYear->FYFYHFiscalYearId      =   $request->FYFYHFiscalYearId;
            $FiscalYear->FYFYHLastCreated       =   Carbon::now();
        }elseif($request->get('button_action') == 'update'){
            $FiscalYear = FiscalYear::find($request->get('FYFYHUniqueId'));
        }

        $FiscalYear->FYFYHStartDate         =   $request->FYFYHStartDate;
        $FiscalYear->FYFYHEndDate           =   $request->FYFYHEndDate;
        $FiscalYear->FYFYHCurrentFY         =   $request->FYFYHCurrentFY;
        $FiscalYear->FYFYHCurrentPeriod     =   $request->periodId;
        $FiscalYear->FYFYHPeriodStartDate   =   $results[0]->fromDate;
        $FiscalYear->FYFYHPeriodEndDate     =   $results[0]->toDate;
        $FiscalYear->FYFYHMarkForDeletion   =   0;
        $FiscalYear->FYFYHUser              =   Auth::user()->name;
        $FiscalYear->FYFYHLastUpdated       =   Carbon::now();    
        // return $FiscalYear->save();
        $FiscalYear->save();
        
        if($request->get('button_action') == 'insert') {
            $UniqueId = $FiscalYear->FYFYHUniqueId; 
        }elseif($request->get('button_action') == 'update'){
            $UniqueId = $request->get('FYFYHUniqueId');
        }
        return $UniqueId;
    }
    public function fyFethchEditedDataTrait($request)
    {
        $FYFYHUniqueId = $request->input('id');
        $activeFiscalYearId = FiscalYear::where('FYFYHCurrentFY', 1)
            ->first();
        $FiscalYear = FiscalYear::find($FYFYHUniqueId);
        return $output = array(
            'FYFYHUniqueId'         =>  $FiscalYear->FYFYHUniqueId,
            'FYFYHCompanyId'        =>  $FiscalYear->FYFYHCompanyId,
            'FYFYHFiscalYearId'     =>  $FiscalYear->FYFYHFiscalYearId,
            'FYFYHStartDate'        =>  $FiscalYear->FYFYHStartDate,
            'FYFYHEndDate'          =>  $FiscalYear->FYFYHEndDate,
            'FYFYHCurrentFY'        =>  $FiscalYear->FYFYHCurrentFY,
            'FYFYHCurrentPeriod'    =>  $FiscalYear->FYFYHCurrentPeriod,
            'FYFYHUser'             =>  $FiscalYear->FYFYHUser,
            'FYFYHLastCreated'      =>  $FiscalYear->FYFYHLastCreated,
            'FYFYHLastUpdated'      =>  $FiscalYear->FYFYHLastUpdated,
            'activeFiscalYearId'    =>  $activeFiscalYearId == '' ? 0 : $activeFiscalYearId->FYFYHUniqueId, 
        );
    }
    public function fyDeleteRecordTrait($request)
    {
        $UniqueId = $request->input('id');
        //Eloquent Way
        $FiscalYear = FiscalYear::find($UniqueId);
        $FiscalYear->FYFYHMarkForDeletion   =   1;
        $FiscalYear->FYFYHUser              =   Auth::user()->name;
        $FiscalYear->FYFYHDeletedAt         =  Carbon::now();
        $FiscalYear->save();        
        return $FiscalYear->FYFYHFiscalYearId;
    }
    public function fyUnDeleteRecordTrait($request)
    {
        $UniqueId = $request->input('id');
        //Eloquent Way
        $FiscalYear = FiscalYear::find($UniqueId);
        $FiscalYear->FYFYHMarkForDeletion   =   0;
        $FiscalYear->FYFYHUser              =   Auth::user()->name;
        $FiscalYear->FYFYHDeletedAt         =  Null;
        $FiscalYear->save();        
        return $FiscalYear->FYFYHFiscalYearId;
    }
}
//Fiscal Year Master Ends***** 
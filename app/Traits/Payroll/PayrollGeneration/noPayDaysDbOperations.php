<?php
namespace app\Traits\Payroll\PayrollGeneration;
use Illuminate\Support\Facades\DB;
use Auth;
use Illuminate\Support\Carbon;
use App\Models\Payroll\EmployeeMaster\GeneralInfo;
use App\Models\CommonMasters\GeographicInfo\Location;
use App\Models\Payroll\PayrollGeneration\MemNoPayDays;
use App\Models\Payroll\PayrollGeneration\NoPayDays;

trait NoPayDaysDbOperations {
    // No Pay Days XL Upload
    public function XLUploadZmemDeleteTrait() 
     {
        $loginName = Auth::user()->name;
        $MemNoPayDays=MemNoPayDays::where('PGADHUser', $loginName)
        ->delete();
    }
    public function XLUploadUpdateMemTableAfterUploadTrait($request){
        $start_date = Carbon::parse($request->FYFYHPeriodStartDate);
        $end_date = Carbon::parse($request->FYFYHPeriodEndDate);
        $diff_Days = $start_date->diffInDays($end_date)+1;

        $MemNoPayDays = MemNoPayDays::get();
        if ($MemNoPayDays != '') {
            foreach ($MemNoPayDays as $MemTable) {
                $EmployeeMaster = GeneralInfo::where('EMGIHCompId', $this->gCompanyId)
                ->where('EMGIHEmployeeId', $MemTable->PGADHEmployeeId)
                ->get(['EMGIHLocationId','EMGIHFullName'])
                ->first();
               
                $MemTable->PGADHCompanyId    = $this->gCompanyId;
                if($EmployeeMaster!=''){
                    $MemTable->PGADHFullName   = $EmployeeMaster->EMGIHFullName;
                    $MemTable->PGADHLocationId   = $EmployeeMaster != '' ?$EmployeeMaster->EMGIHLocationId :'Error';
                    $LocationMaster = Location::where('GMLMHLocationId', $MemTable->PGADHLocationId)
                    ->get(['GMLMHDesc1'])
                    ->first();
                    $MemTable->PGADHLocationDesc   = $LocationMaster != '' ?$LocationMaster->GMLMHDesc1 :'Location Not found';

                }else{
                    $MemTable->PGADHFullName            = "Error";
                    $MemTable->PGADHLocationDesc        = "Error";
                    $MemTable->PGADHMarkForDeletion     = 9;
                }

                
                $MemTable->PGADHFiscalYearId = $request->FYFYHFiscalYearId;
                $MemTable->PGADHPeriodId     = $request->FYFYHCurrentPeriod;
                $MemTable->PGADHPeriodMonth  = $request->FYFYHCurrentPeriodDesc;
                $MemTable->PGADHTotalDays    = $diff_Days;
                $MemTable->PGADHPaidDays     = $diff_Days- $MemTable->PGADHNoPayDays;
                $MemTable->save();
            };
        }
    }
    public function XLUploadBrowserDataTrait() 
     { 
         return $browserData = MemNoPayDays::get([
            'PGADHEmployeeId',
            'PGADHFullName',
            'PGADHLocationId',
            'PGADHLocationDesc',
            'PGADHTotalDays',
            'PGADHNoPayDays',
            'PGADHPaidDays',
         ]);
     }
    public function XLUploadUpdateActualTableWithMemTableTrait($request){
        //Delete Actual Table Data : NoPayDays
        // 
        $loginName = Auth::user()->name;
        $MemNoPayDays1 = MemNoPayDays::get(['PGADHEmployeeId']);
        $NoPayDays = NoPayDays::where('PGADHFiscalYearId', $request->PGADHFiscalYearId)
        ->where('PGADHPeriodId', $request->PGADHPeriodId)
        ->where('PGADHCompanyId', $this->gCompanyId)
        ->where('PGADHMarkForDeletion', '!=' , 1)
        ->get();
        foreach ($NoPayDays as $value) {
           
            $value->PGADHStatusId           = 9999;
            $value->PGADHMarkForDeletion    = 1;
            $value->PGADHUser               = Auth::user()->name;
            $value->PGADHDeletedAt          = Carbon::now();
            $value->save();
        };
        // Append from Income Mem to Actual
        $MemNoPayDays = MemNoPayDays::orderBy('PGADHEmployeeId')
        ->where('PGADHMarkForDeletion', '!=' , 9)
        ->get();
        foreach ($MemNoPayDays as $key => $value) {
            NoPayDays::create([
            'PGADHCompanyId'        => $value->PGADHCompanyId,
            'PGADHEmployeeId'       => $value->PGADHEmployeeId,
            'PGADHLocationId'       => $value->PGADHLocationId,
            'PGADHFiscalYearId'     => $value->PGADHFiscalYearId,
            'PGADHPeriodId'         => $value->PGADHPeriodId,
            'PGADHPeriodMonth'      => $value->PGADHPeriodMonth,
            'PGADHTotalDays'        => $value->PGADHTotalDays,
            'PGADHNoPayDays'        => $value->PGADHNoPayDays,
            'PGADHPaidDays'         => $value->PGADHPaidDays,
            'PGADHMarkForDeletion'  => $value->PGADHMarkForDeletion,
            'PGADHUser'             => Auth::user()->name,
            'PGADHStatusId'         => 1000,
            'PGADHLastCreated'      => Carbon::now(),
            'PGADHLastUpdated'      => Carbon::now()
            ]);
        }
    }
    // No Pay Days XL Upload Ends*****

    public function BrowserDataTrait($request) 
    { 
        //    echo 'Data Submitted.'.$request;
        //     // print_r($StateCountryDesc);
        //     die();
        //  return $browserData = NoPayDays::join('T05901L06', 'T05901L06.GMLMHLocationId', '=', 't11125l01.PGADHLocationId')
        //  ->join('T11101l01', 'T11101l01.EMGIHEmployeeId', '=', 't11125l01.PGADHEmployeeId')
        //  ->where('t11125l01.PGADHCompanyId', $this->gCompanyId)
        //  ->where('t11125l01.PGADHFiscalYearId', $request->PGADHFiscalYearId)
        //  ->where('t11125l01.PGADHPeriodId', $request->PGADHPeriodId)
        //  ->where('t11125l01.PGADHMarkForDeletion', 0) 
        //  ->get([
        //     't11125l01.PGADHEmployeeId',
        //     't11125l01.PGADHUniqueId',
        //     'T11101l01.EMGIHFullName',
        //     't11125l01.PGADHLocationId',
        //      // Location table field
        //      'T05901L06.GMLMHDesc1',
        //     't11125l01.PGADHTotalDays',
        //     't11125l01.PGADHNoPayDays',
        //     't11125l01.PGADHPaidDays',
        //  ]);
        return $browserData = NoPayDays::join('T05901L06', 'T05901L06.GMLMHLocationId', '=', 't11125l01.PGADHLocationId')
         ->join('T11101l01', 'T11101l01.EMGIHEmployeeId', '=', 't11125l01.PGADHEmployeeId')
         ->where('t11125l01.PGADHMarkForDeletion', 0) 
         ->get([
            't11125l01.PGADHEmployeeId',
            't11125l01.PGADHUniqueId',
            'T11101l01.EMGIHFullName',
            't11125l01.PGADHLocationId',
             // Location table field
             'T05901L06.GMLMHDesc1',
            't11125l01.PGADHTotalDays',
            't11125l01.PGADHNoPayDays',
            't11125l01.PGADHPaidDays',
         ]);
            
    }
    public function FethchEditedDataTrait($request)
    {
        $PGADHUniqueId = $request->input('id');
        $NoPayDays = NoPayDays::find($PGADHUniqueId);
        return $output = array(
            'PGADHUniqueId'                 => $NoPayDays->PGADHUniqueId,
            'PGADHCompanyId'                => $NoPayDays->PGADHCompanyId,
            'PGADHLocationId'               => $NoPayDays->PGADHLocationId,
            'PGADHEmployeeId'               => $NoPayDays->PGADHEmployeeId,
            'PGADHTotalDays'                => $NoPayDays->PGADHTotalDays,
            'PGADHNoPayDays'                => $NoPayDays->PGADHNoPayDays,
            'PGADHPaidDays'                 => $NoPayDays->PGADHPaidDays,
            
        );
    }
    public function UpdateFormDataToNoPayDaysTrait($request)
    {
        if($request->get('button_action') == 'insert') {
            $NoPayDays = new NoPayDays;                
            $NoPayDays->PGADHCompanyId     = $this->gCompanyId;
            $NoPayDays->PGADHLocationId    = $request->PGADHLocationId;
            $NoPayDays->PGADHEmployeeId    = $request->PGADHEmployeeId;
            $NoPayDays->PGADHFiscalYearId  = $request->PGADHFiscalYearId;            
            $NoPayDays->PGADHPeriodId      = $request->PGADHPeriodId;            
            $NoPayDays->PGADHPeriodMonth   = $request->PGADHPeriodMonth;  
            $NoPayDays->PGADHTotalDays     = $request->PGADHTotalDays;
            $NoPayDays->PGADHLastCreated   = Carbon::now();
        }elseif($request->get('button_action') == 'update'){
            $NoPayDays = NoPayDays::find($request->get('PGADHUniqueId'));
        }
        $NoPayDays->PGADHNoPayDays      = $request->PGADHNoPayDays;
        $NoPayDays->PGADHPaidDays       = $request->PGADHPaidDays;
        $NoPayDays->PGADHMarkForDeletion= 0;
        $NoPayDays->PGADHUser           = Auth::user()->name;
        $NoPayDays->PGADHStatusId       = $request->PGADHStatusId;
        $NoPayDays->PGADHLastUpdated    = Carbon::now();
        $NoPayDays->save(); 
        if($request->get('button_action') == 'insert') {
            $UniqueId = $NoPayDays->PGADHUniqueId; 
        }elseif($request->get('button_action') == 'update'){
            $UniqueId = $request->get('PGADHUniqueId');
        }
        return $UniqueId; 
    }
    public function CheckDuplicateEmployeeNoPayDaysTrait($request){
        
        if ($request->button_action == 'insert') {
            # code...
            return $DuplicateFound = NoPayDays::where('PGADHCompanyId', $this->gCompanyId)
            ->where('PGADHFiscalYearId', $request->PGADHFiscalYearId)
            ->where('PGADHPeriodId', $request->PGADHPeriodId)
            ->where('PGADHLocationId', $request->PGADHLocationId)
            ->where('PGADHEmployeeId', $request->PGADHEmployeeId)
            ->get(['PGADHEmployeeId'])
            ->first();            
        }
    }
    public function DeleteRecordTrait($request)
    {
       $NoPayDays = NoPayDays::where('PGADHUniqueId', $request->id)
       ->get()
       ->first();
       NoPayDays::where('PGADHUniqueId', $request->id)
        ->delete();
        return $output = array(
            'PGADHEmployeeId'=>$NoPayDays->PGADHEmployeeId,
            'status'=>1
        );
    }
}
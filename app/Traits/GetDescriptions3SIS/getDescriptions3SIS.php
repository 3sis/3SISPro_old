<?php
namespace app\Traits\GetDescriptions3SIS;
use Illuminate\Support\Facades\DB;
use App\Models\CommonMasters\GeographicInfo\City;
use App\Models\CommonMasters\GeographicInfo\State;
use App\Models\CommonMasters\GeographicInfo\Country;
use App\Models\CommonMasters\GeographicInfo\Location;
use App\Models\Payroll\EmployeeMaster\GeneralInfo;
use App\Models\CommonMasters\FiscalYear\FiscalYear;

trait getDescriptions3SIS {
    public function getStateCountryDescTrait($request)
    {
        $Id = $request->get('id');
        // echo 'Data Submitted.';
        // print_r($Id);
        // die();
        return $StateCountryDesc = City::leftJoin('t05901L04', 't05901L04.GMSMHStateId', '=', 't05901L05.GMCTHStateId')
        ->leftJoin('t05901L03', 't05901L03.GMCMHCountryId', '=', 't05901L05.GMCTHCountryId')
        ->where('t05901L05.GMCTHCityId', $Id)
        ->get([
            't05901L04.GMSMHStateId', 
            't05901L04.GMSMHDesc1', 
            't05901L03.GMCMHCountryId',
            't05901L03.GMCMHDesc1'
        ]);
    }
    public function getLocationDescTrait($request)
    {
        $Id = $request->get('id');
        return $LocationDesc = GeneralInfo::leftjoin('t05901l06', 't05901l06.GMLMHLocationId', '=', 'T11101l01.EMGIHLocationId')
         ->where('EMGIHEmployeeId', $Id)
        ->get([
            't05901l06.GMLMHDesc1',
            't05901l06.GMLMHLocationId'
            ])
        ->first();
    }
    public function getFiscalYearDateTrait($request)
    {
        $Id = $request->get('id');
        return $FiscalYear = FiscalYear::where('FYFYHFiscalYearId', $Id)
        ->get([
            'FYFYHStartDate',
            'FYFYHEndDate'
        ]);
        // ->first();
    }
}   
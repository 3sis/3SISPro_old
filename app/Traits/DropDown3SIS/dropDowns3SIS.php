<?php
namespace app\Traits\DropDown3SIS;
use Illuminate\Support\Facades\DB;
use App\Models\SystemsMaster\PeriodMaster;
use App\Models\SystemsMaster\BiColumnHead;
use App\Models\SystemsMaster\PaymentMaster\RuleDefinition;
use App\Models\CommonMasters\GeographicInfo\City;
use App\Models\CommonMasters\GeographicInfo\State;
use App\Models\CommonMasters\GeographicInfo\Country;
use App\Models\CommonMasters\BankingMaster\BankName;
use App\Models\CommonMasters\BankingMaster\BranchName;
use App\Models\CommonMasters\FiscalYear\FiscalYear;
use App\Models\CommonMasters\FiscalYear\Calendar;
use App\Models\CommonMasters\GeneralMaster\Currency;
trait dropDowns3SIS {
    // Rule Definition Drop Down
    public function ruleDefIncomeDropDownTrait($request)
    {        
        if($request == ''){
            return $fetchData = RuleDefinition::orderby('PMRDHRuleId','asc')
                ->select('PMRDHRuleId','PMRDHDesc1')
                ->whereIn('PMRDHIncOrDed', ['I', 'Z'])
                // ->limit(5)
                ->get();
        }else
        {
            return $fetchData = RuleDefinition::orderby('PMRDHRuleId','asc')
            ->select('PMRDHRuleId','PMRDHDesc1')
            ->where('PMRDHDesc1', 'like', '%'.$request.'%')
            ->whereIn('PMRDHIncOrDed', ['I', 'Z'])
            // ->limit(5)
            ->get();
        }
    }
    public function ruleDefDeductionDropDownTrait($request)
    {        
        if($request == ''){
            return $fetchData = RuleDefinition::orderby('PMRDHRuleId','asc')
                ->select('PMRDHRuleId','PMRDHDesc1')
                ->whereIn('PMRDHIncOrDed', ['D', 'Z'])
                // ->limit(5)
                ->get();
        }else
        {
            return $fetchData = RuleDefinition::orderby('PMRDHRuleId','asc')
            ->select('PMRDHRuleId','PMRDHDesc1')
            ->where('PMRDHDesc1', 'like', '%'.$request.'%')
            ->whereIn('PMRDHIncOrDed', ['D', 'Z'])
            // ->limit(5)
            ->get();
        }
    }
    // Rule Definition Drop Down Ends
    // BI Income Type Master Drop Down
    public function biDescDropDownIncomeTrait($request)
    {
        if($request == ''){
            return $fetchData = BiColumnHead::orderby('BICHHElementId','asc')
                ->select('BICHHElementId','BICHHBiElementDesc')
                ->where('BICHHSystemCode', 11)
                ->where('BICHHGroupId', 10)
                // ->limit(5)
                ->get();
        }else
        {
            return $fetchData = BiColumnHead::orderby('BICHHElementId','asc')
            ->select('BICHHElementId','BICHHBiElementDesc')
            ->where('BICHHBiElementDesc', 'like', '%'.$request.'%')
            ->where('BICHHSystemCode', 11)
            ->where('BICHHGroupId', 10)
            // ->limit(5)
            ->get();
        }
    }
    // BI Income Type Master Drop Down Ends
    // BI Deduction Type Master Drop Down
    public function biDescDropDownDeductionTrait($request)
    {
        if($request == ''){
            return $fetchData = BiColumnHead::orderby('BICHHElementId','asc')
                ->select('BICHHElementId','BICHHBiElementDesc')
                ->where('BICHHSystemCode', 11)
                ->where('BICHHGroupId', 11)
                // ->limit(5)
                ->get();
        }else
        {
            return $fetchData = BiColumnHead::orderby('BICHHElementId','asc')
            ->select('BICHHElementId','BICHHBiElementDesc')
            ->where('BICHHBiElementDesc', 'like', '%'.$request.'%')
            ->where('BICHHSystemCode', 11)
            ->where('BICHHGroupId', 11)
            // ->limit(5)
            ->get();
        }
    }
    // BI Deduction Type Master Drop Down Ends
    // Period Master Drop Down
    public function periodDropDownTrait($request)
    {
        if($request == ''){
            return $fetchData = PeriodMaster::orderby('FYPMHPeriodId','asc')
                ->select('FYPMHPeriodId','FYPMHDesc1')
                // ->limit(5)
                ->get();
        }else
        {
            return $fetchData = PeriodMaster::orderby('FYPMHPeriodId','asc')
            ->select('FYPMHPeriodId','FYPMHDesc1')
            ->where('FYPMHDesc1', 'like', '%'.$request.'%')
            // ->limit(5)
            ->get();
        }
    }
    // Period Master Drop Down Ends*****
    // Country Master Drop Down
    public function countryDropDownTrait($request)
     {
        if($request == ''){
               return $fetchData = Country::orderby('GMCMHCountryId','asc')
                    ->select('GMCMHCountryId','GMCMHDesc1')
                    // ->limit(5)
                    ->get();
            }else
            {
              return $fetchData = Country::orderby('GMCMHCountryId','asc')
                ->select('GMCMHCountryId','GMCMHDesc1')
                ->where('GMCMHDesc1', 'like', '%'.$request.'%')
                // ->limit(5)
                ->get();
            }
     }
    // Country Master Drop Down Ends*****

    // State Master Drop Down
    public function stateDropDownTrait($request)
     {
        if($request == ''){
               return $fetchData = State::orderby('GMSMHStateId','asc')
                    ->select('GMSMHStateId','GMSMHDesc1')
                    // ->limit(5)
                    ->get();
            }else
            {
              return $fetchData = State::orderby('GMSMHStateId','asc')
                ->select('GMSMHStateId','GMSMHDesc1')
                ->where('GMSMHDesc1', 'like', '%'.$request.'%')
                // ->limit(5)
                ->get();
            }
     }
    // State Master Drop Down Ends*****

    // City Master Drop Down
    public function cityDropDownTrait($request)
     {
        if($request == ''){
               return $fetchData = City::orderby('GMCTHCityId','asc')
                    ->select('GMCTHCityId','GMCTHDesc1')
                    // ->limit(5)
                    ->get();
            }else
            {
              return $fetchData = City::orderby('GMCTHCityId','asc')
                ->select('GMCTHCityId','GMCTHDesc1')
                ->where('GMCTHDesc1', 'like', '%'.$request.'%')
                // ->limit(5)
                ->get();
            }
     }
    // City Master Drop Down Ends*****

    // Bank Master Drop Down
    public function bankDropDownTrait($request)
    {
       if($request == ''){
              return $fetchData = BankName::orderby('BMBNHBankId','asc')
                   ->select('BMBNHBankId','BMBNHDesc1')
                   // ->limit(5)
                   ->get();
           }else
           {
             return $fetchData = BankName::orderby('BMBNHBankId','asc')
               ->select('BMBNHBankId','BMBNHDesc1')
               ->where('BMBNHDesc1', 'like', '%'.$request.'%')
               // ->limit(5)
               ->get();
           }
    }
    // Bank Master Drop Down Ends*****
    // Fiscal Year Drop Down *****
    public function fiscalYearDropDownDataTrait($request)
    {
        if($request == ''){
            return $fetchData = FiscalYear::orderby('FYFYHFiscalYearId','asc')
                ->select('FYFYHFiscalYearId')
                // ->limit(5)
                ->get();
        }else
        {
            return $fetchData = FiscalYear::orderby('FYFYHFiscalYearId','asc')
            ->select('FYFYHFiscalYearId')
            ->where('FYFYHFiscalYearId', 'like', '%'.$request.'%')
            // ->limit(5)
            ->get();
        }
    }
    // Fiscal Year Drop Down Ends*****
    // Calendar Master Drop Down *****
    public function calendarDropDownDataTrait($request)
    {
        if($request == ''){
            return $fetchData = Calendar::orderby('FYCAHCalendarId','asc')
                ->select('FYCAHCalendarId','FYCAHDesc1')
                // ->limit(5)
                ->get();
        }else
        {
            return $fetchData = Calendar::orderby('FYCAHCalendarId','asc')
            ->select('FYCAHCalendarId','FYCAHDesc1')
            ->where('FYCAHCalendarId', 'like', '%'.$request.'%')
            // ->limit(5)
            ->get();
        }
    }
    // Calendar Master Drop Down Ends*****
    // Currency Master Drop Down
    public function currencyDropDownTrait($request)
     {
        if($request == ''){
               return $fetchData = Currency::orderby('GMCRHCurrencyId','asc')
                    ->select('GMCRHCurrencyId','GMCRHDesc1')
                    // ->limit(5)
                    ->get();
            }else
            {
              return $fetchData = Currency::orderby('GMCRHCurrencyId','asc')
                ->select('GMCRHCurrencyId','GMCRHDesc1')
                ->where('GMCRHDesc1', 'like', '%'.$request.'%')
                // ->limit(5)
                ->get();
            }
     }
    // Currency Master Drop Down Ends*****
    // Branch Master Drop Down
    public function branchDropDownTrait($request)
     {
        if($request == ''){
               return $fetchData = BranchName::orderby('BMBRHBranchId','asc')
                    ->select('BMBRHBranchId','BMBRHDesc1')
                    // ->limit(5)
                    ->get();
            }else
            {
              return $fetchData = Currency::orderby('BMBRHBranchId','asc')
                ->select('BMBRHBranchId','BMBRHDesc1')
                ->where('BMBRHDesc1', 'like', '%'.$request.'%')
                // ->limit(5)
                ->get();
            }
     }
    // Currency Master Drop Down Ends*****
}   
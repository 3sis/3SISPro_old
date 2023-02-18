<?php

namespace App\Http\Controllers\DropdownMasters;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\CommonMasters\GeographicInfo\City;
use App\Models\CommonMasters\BankingMaster\BranchName;
use App\Traits\DropDown3SIS\dropDowns3SIS;
use App\Traits\GetDescriptions3SIS\getDescriptions3SIS;

class DropDownController extends Controller
{
    protected  $gCompanyId = '1000';
    use dropDowns3SIS,getDescriptions3SIS;
    public function GetCityDropDown(Request $request)
    {
        $searchText = $request->search;
        $select2Data = $this->cityDropDownTrait($searchText);
        $response = array();
        foreach($select2Data as $result){
            $response[] = array(
                    "id"    =>  $result->GMCTHCityId ,
                    "text"  =>  $result->GMCTHDesc1
            );
        }
        return response()->json($response); 
    }
    // Return State and Country Based on CityId
    // public function GetGeoDesc(Request $request){
    //     $Id = $request->get('id');
    //     $geoDesc = City::join('t05901L04', 't05901L04.GMSMHStateId', '=', 't05901L05.GMCTHStateId')
    //     ->join('t05901L03', 't05901L03.GMCMHCountryId', '=', 't05901L05.GMCTHCountryId')
    //     ->where('t05901L05.GMCTHCityId', $Id)
    //     ->get([
    //         't05901L04.GMSMHDesc1',
    //         't05901L03.GMCMHDesc1', 
    //         't05901L05.GMCTHStateId',
    //         't05901L05.GMCTHCountryId'
    //     ]);
    //     // echo 'Data Submitted.';
    //     // return $geoDesc;
    //     // die();
    //     return response()->json([
    //         'stateDesc1'=>$geoDesc[0]->GMSMHDesc1, 
    //         'countryDesc1'=>$geoDesc[0]->GMCMHDesc1, 
    //         'stateId'=>$geoDesc[0]->GMCTHStateId, 
    //         'countryId'=>$geoDesc[0]->GMCTHCountryId
    //     ]);
    // }
    public function GetGeoDesc(Request $request){        
        $StateCountryDesc = $this->getStateCountryDescTrait($request); 
        return response()->json([
            'stateId'=>$StateCountryDesc[0]->GMSMHStateId, 
            'stateDesc1'=>$StateCountryDesc[0]->GMSMHDesc1, 
            'countryId'=>$StateCountryDesc[0]->GMCMHCountryId, 
            'countryDesc1'=>$StateCountryDesc[0]->GMCMHDesc1
        ]);
    }
    public function GetCurrencyDropDown(Request $request)
    {
        $searchText = $request->search;
        $select2Data = $this->currencyDropDownTrait($searchText);
        $response = array();
        foreach($select2Data as $result){
            $response[] = array(
                    "id"    =>  $result->GMCRHCurrencyId ,
                    "text"  =>  $result->GMCRHDesc1
            );
        }
        return response()->json($response); 
    }
    //Retrun Branch BI Dropdown In Add and Edit Mode
    public function GetBranchDropDown(Request $request)
    {
        $branchId = $request->input('id');
        $fetchData = DB::table('t05902l02')->orderBy('BMBRHBranchId', 'ASC')->get();
        $response = array();

        foreach($fetchData as $result)
        {   
            if($result->BMBRHBranchId == $branchId)
            {
            $secected = 'selected';
            }else{
            $secected = '';
            }
            
            if($branchId == 00){
                $Add = "<option>-- Select Branch --</option>";
                $branchId = '';
            }else{
                $Add = '';
            }
            $response[] = ' '.$Add.' <option value='.$result->BMBRHBranchId .' '.$secected.'>'.$result->BMBRHDesc1.'</option>';
        }        
        return response()->json(['SelectedItem'=>$response]);      
    }
    // Return Bank and IFS Code Based on CityId
    public function GetBranchDetails(Request $request){
        $Id = $request->get('id');
        $branchDetails = BranchName::join('t05902l01', 't05902l01.BMBNHBankId', '=', 't05902l02.BMBRHBankId')
        ->where('t05902l02.BMBRHBranchId', $Id)
        ->get(['t05902l01.BMBNHDesc1', 't05902l02.BMBRHIFSCId', 't05902l02.BMBRHBankId']);
        // echo 'Data Submitted.';
        // return $branchDetails;
        // die();
        return response()->json(['bankDesc1'=>$branchDetails[0]->BMBNHDesc1, 
                    'ifsCode'=>$branchDetails[0]->BMBRHIFSCId, 'bankId'=>$branchDetails[0]->BMBRHBankId]);
    }
    // Retrun Period Dropdown In Add and Edit Mode
    public function GetSelectedPeriod(Request $request)
    {
        $Id = $request->input('id');
        $fetchData = DB::table('T00901L01')->orderBy('FYPMHPeriodId', 'ASC')->get();
        $response = array();
        $count = 0;
        foreach($fetchData as $result)
        {
            if ($Id == 00) {
                $selected = '';
                $Add = '';
                if ($count == 0) {
                    $Add = "<option>-- Select Active Period --</option>";
                    $count = 1;
                }
                $response[] = ' '.$Add.' <option value='.$result->FYPMHPeriodId .' '.$selected.'>'.$result->FYPMHBiDesc.'</option>';
            }else{
                $selected = '';
                $Add = '';
                $response[] = ' '.$Add.' <option value='.$result->FYPMHPeriodId .' '.$selected.'>'.$result->FYPMHBiDesc.'</option>';
                // Multi Selected Options
                $periodFound = DB::table('t11906l010211')
                ->where('PMIDDIncDedIdK', $Id)
                ->where('PMIDDPeriodId', $result->FYPMHPeriodId)
                ->where('PMIDDMarkForDeletion', 0)
                ->get()
                ->first();
                if($periodFound != null){
                    $selected = 'selected';
                    $Add = '';
                    $response[] = ' '.$Add.' <option value='.$result->FYPMHPeriodId .' '.$selected.'>'.$result->FYPMHBiDesc.'</option>';
                }
            }
        }
        // echo 'Data Submitted : ';
        // print_r($response);
        // die();
        return response()->json(['SelectedItem'=>$response]);      
    }
    public function GetPeriodDropDown(Request $request)
    {
        $Id = $request->input('id');
        $fetchData = DB::table('T00901L01')->orderBy('FYPMHPeriodId', 'ASC')->get();
        $response = array();

        foreach($fetchData as $result)
        {   
            if($result->FYPMHPeriodId == $Id)
            {
            $secected = 'selected';
            }else{
            $secected = '';
            }
            
            if($Id == 00){
                $Add = "<option>-- Select Period --</option>";
                $Id = '';
            }else{
                $Add = '';
            }
            $response[] = ' '.$Add.' <option value='.$result->FYPMHPeriodId .' '.$secected.'>'.$result->FYPMHBiDesc.'</option>';
        }        
        return response()->json(['SelectedItem'=>$response]);      
    }
    // Retrun Income BI Dropdown In Add and Edit Mode
    public function GetSelectedIncomeBiDesc(Request $request)
    {
        $Id = $request->input('id');
        $fetchData = DB::table('T00904L01')
            ->where('BICHHSystemCode', 11)
            ->where('BICHHGroupId', 10)
            ->orderBy('BICHHElementId', 'ASC')
            ->get();
        $response = array();

        foreach($fetchData as $result)
        {   
            if($result->BICHHElementId == $Id)
            {
            $selected = 'selected';
            }else{
            $selected = '';
            }
            
            if($Id == 00){
                $Add = "<option>-- BI Code --</option>";
                $Id = '';
            }else{
                $Add = '';
            }
            $response[] = ' '.$Add.' <option value='.$result->BICHHElementId .' '.$selected.'>'.$result->BICHHBiElementDesc.'</option>';
        }
        // echo 'Data Submitted : ';
        // return $response;
        // die();
        return response()->json(['SelectedItem'=>$response]);      
    }
    // Retrun Deduction BI Dropdown In Add and Edit Mode
    public function GetSelectedDeductionBiDesc(Request $request)
    {
        $Id = $request->input('id');
        $fetchData = DB::table('T00904L01')
            ->where('BICHHSystemCode', 11)
            ->where('BICHHGroupId', 11)
            ->orderBy('BICHHElementId', 'ASC')
            ->get();
        $response = array();

        foreach($fetchData as $result)
        {   
            if($result->BICHHElementId == $Id)
            {
            $selected = 'selected';
            }else{
            $selected = '';
            }
            
            if($Id == 00){
                $Add = "<option>-- BI Code --</option>";
                $Id = '';
            }else{
                $Add = '';
            }
            $response[] = ' '.$Add.' <option value='.$result->BICHHElementId .' '.$selected.'>'.$result->BICHHBiElementDesc.'</option>';
        }
        // echo 'Data Submitted : ';
        // return $response;
        // die();
        return response()->json(['SelectedItem'=>$response]);      
    }
    // Retrun Rule Definition (Income) Dropdown In Add and Edit Mode
    public function GetSelectedRuleDefDescIncome(Request $request)
    {
        $Id = $request->input('id');
        $fetchData = DB::table('T00903L03')
            ->whereIn('PMRDHIncOrDed', ['I', 'Z'])
            ->orderby('PMRDHRuleId','asc')
            ->get();
        $response = array();

        foreach($fetchData as $result)
        {   
            if($result->PMRDHRuleId == $Id)
            {
                $selected = 'selected';
            }else{
                $selected = '';
            }
            
            if($Id == 00){
                $Add = "<option>- Select Rule -</option>";
                $Id = '';
            }else{
                $Add = '';
            }
            $response[] = ' '.$Add.' <option value='.$result->PMRDHRuleId .' '.$selected.'>'.$result->PMRDHDesc1.'</option>';
        }
        // echo 'Data Submitted : ';
        // return $response;
        // die();
        return response()->json(['SelectedItem'=>$response]);      
    }
    // Retrun Rule Definition (Deduction) Dropdown In Add and Edit Mode
    public function GetSelectedRuleDefDescDeduction(Request $request)
    {
        $Id = $request->input('id');
        $fetchData = DB::table('T00903L03')
            ->whereIn('PMRDHIncOrDed', ['D', 'Z'])
            ->orderby('PMRDHRuleId','desc')
            ->get();
        $response = array();

        foreach($fetchData as $result)
        {   
            if($result->PMRDHRuleId == $Id)
            {
                $selected = 'selected';
            }else{
                $selected = '';
            }
            
            if($Id == 00){
                $Add = "<option>- Select Rule -</option>";
                $Id = '';
            }else{
                $Add = '';
            }
            $response[] = ' '.$Add.' <option value='.$result->PMRDHRuleId .' '.$selected.'>'.$result->PMRDHDesc1.'</option>';
        }
        // echo 'Data Submitted : ';
        // return $response;
        // die();
        return response()->json(['SelectedItem'=>$response]);      
    }
    // Retrun Income Type Dropdown In Add and Edit Mode
    public function GetSelectedIncomeTypes(Request $request)
    {
        $Id = $request->input('id');
        $fetchData = DB::table('T11906L01')
            ->where('PMITHMarkForDeletion', 0)
            ->orderBy('PMITHIncomeId', 'ASC')
            ->get();
        $response = array();

        foreach($fetchData as $result)
        {   
            if($result->PMITHIncomeId == $Id)
            {
            $selected = 'selected';
            }else{
            $selected = '';
            }
            
            if($Id == 00){
                $Add = "<option>-- Income Type --</option>";
                $Id = '';
            }else{
                $Add = '';
            }
            $response[] = ' '.$Add.' <option value='.$result->PMITHIncomeId .' '.$selected.'>'.$result->PMITHDesc1.'</option>';
        }
        return response()->json(['SelectedItem'=>$response]);      
    }
    // Retrun Deduction Type Dropdown In Add and Edit Mode

    // Retrun Income Type Dropdown In Add and Edit Mode only thouse not in employee earning
    public function GetSelectedIncomeTypeApartFromEarning(Request $request)
    {
        $EmpId = $request->input('empId');
        $Id = $request->input('id');
        $fetchData = DB::table('T11906L01')
            ->where('PMITHMarkForDeletion', 0)
            ->orderBy('PMITHIncomeId', 'ASC')
            ->get();
        $response = array();

        foreach($fetchData as $result)
        {   
            $EmployeeEarning = DB::table('T11121l0111')
            ->where('EEIMDCompId', $this->gCompanyId)
            ->where('EEIMDEmployeeId', $EmpId)
            ->where('EEIMDIncomeId', $result->PMITHIncomeId)
            ->where('EEIMDMarkForDeletion', 0)
            ->get(['EEIMDIncomeId'])
            ->first();
            // echo 'Data Submitted.'.$EmployeeEarning->EEIMDIncomeId;
            // die();
            if ($EmployeeEarning ==''  ) {
                # code...
            
                if($result->PMITHIncomeId == $Id)
                {
                $selected = 'selected';
                }else{
                $selected = '';
                }
                
                if($Id == 00){
                    $Add = "<option>-- Income Type --</option>";
                    $Id = '';
                }else{
                    $Add = '';
                }
                $response[] = ' '.$Add.' <option value='.$result->PMITHIncomeId .' '.$selected.'>'.$result->PMITHDesc1.'</option>';
            }
        }

        return response()->json(['SelectedItem'=>$response]);      
    }
    // Retrun Deduction Type Dropdown In Add and Edit Mode
    public function GetSelectedDeductionTypes(Request $request)
    {
        $Id = $request->input('id');
        $fetchData = DB::table('T11906L02')
            ->where('PMDTHMarkForDeletion', 0)
            ->orderBy('PMDTHDeductionId', 'ASC')
            ->get();
        $response = array();
		//  echo 'Data Submitted.';
        // // print_r($StateCountryDesc);
        // dd($fetchData);
        foreach($fetchData as $result)
        {   
            if($result->PMDTHDeductionId == $Id)
            {
            $selected = 'selected';
            }else{
            $selected = '';
            }
            
            if($Id == 00){
                $Add = "<option>-- Deduction Type --</option>";
                $Id = '';
            }else{
                $Add = '';
            }
            $response[] = ' '.$Add.' <option value='.$result->PMDTHDeductionId .' '.$selected.'>'.$result->PMDTHDesc1.'</option>';
        }
        return response()->json(['SelectedItem'=>$response]);      
    }
    // Retrun Deduction Type Dropdown In Add and Edit Mode
    public function GetSelectedDeductionTypesLoan(Request $request)
    {
        $Id = $request->input('id');
        $fetchData = DB::table('T11906L02')
            ->where('PMDTHIsThisLoanLine', 1)
            ->where('PMDTHMarkForDeletion', 0)
            ->orderBy('PMDTHDeductionId', 'ASC')
            ->get();
        $response = array();
		//  echo 'Data Submitted.';
        // // print_r($StateCountryDesc);
        // dd($fetchData);
        foreach($fetchData as $result)
        {   
            if($result->PMDTHDeductionId == $Id)
            {
            $selected = 'selected';
            }else{
            $selected = '';
            }
            
            if($Id == 00){
                $Add = "<option>-- Deduction Type --</option>";
                $Id = '';
            }else{
                $Add = '';
            }
            $response[] = ' '.$Add.' <option value='.$result->PMDTHDeductionId .' '.$selected.'>'.$result->PMDTHDesc1.'</option>';
        }
        return response()->json(['SelectedItem'=>$response]);      
    }
    // Geographic Location Dropdowns in Add and Edit Mode
    # Country
    public function GetSelectedCountry(Request $request)
    {
        $Id = $request->input('id');
        $fetchData = DB::table('T05901L03')
            ->where('GMCMHMarkForDeletion', 0)
            ->orderBy('GMCMHCountryId', 'ASC')
            ->get();
        $response = array();

        foreach($fetchData as $result)
        {   
            if($result->GMCMHCountryId == $Id)
            {
            $selected = 'selected';
            }else{
            $selected = '';
            }
            
            if($Id == 00){
                $Add = "<option>-- Country --</option>";
                $Id = '';
            }else{
                $Add = '';
            }
            $response[] = ' '.$Add.' <option value='.$result->GMCMHCountryId .' '.$selected.'>'.$result->GMCMHDesc1.'</option>';
        }
        return response()->json(['SelectedItem'=>$response]);      
    }
    # State
    public function GetSelectedState(Request $request)
    {
        $Id = $request->input('id');
        $fetchData = DB::table('T05901L04')
            ->where('GMSMHMarkForDeletion', 0)
            ->orderBy('GMSMHStateId', 'ASC')
            ->get();
            
        $response = array();
        

        foreach($fetchData as $result)
        {   
            if($result->GMSMHStateId == $Id)
            {
            $selected = 'selected';
            }else{
            $selected = '';
            }
            
            if($Id == 00){
                $Add = "<option>-- State --</option>";
                $Id = '';
            }else{
                $Add = '';
            }
            $response[] = ' '.$Add.' <option value='.$result->GMSMHStateId .' '.$selected.'>'.$result->GMSMHDesc1.'</option>';
        }
        return response()->json(['SelectedItem'=>$response]);      
    }
    # City
    public function GetSelectedCity(Request $request)
    {
        $cityId = $request->input('id');
        $fetchData = DB::table('t05901l05')->orderBy('GMCTHCityId', 'ASC')->get();
        $response = array();

        foreach($fetchData as $result)
        {   
            if($result->GMCTHCityId == $cityId)
            {
            $secected = 'selected';
            }else{
            $secected = '';
            }
            
            if($cityId == 00){
                $Add = "<option>-- Select City --</option>";
                $cityId = '';
            }else{
                $Add = '';
            }
            $response[] = ' '.$Add.' <option value='.$result->GMCTHCityId .' '.$secected.'>'.$result->GMCTHDesc1.'</option>';
        }
        // echo 'Data Submitted : ';
        // return $response;
        // die();
        return response()->json(['SelectedItem'=>$response]);      
    }
    // public function GetSelectedCity(Request $request)
    // {
    //     $Id = $request->input('id');
    //     $fetchData = DB::table('T05901L05')
    //         ->where('GMCTHMarkForDeletion', 0)
    //         ->orderBy('GMCTHCityId', 'ASC')
    //         ->get();
            
    //     $response = array();
        

    //     foreach($fetchData as $result)
    //     {   
    //         if($result->GMCTHCityId == $Id)
    //         {
    //         $selected = 'selected';
    //         }else{
    //         $selected = '';
    //         }
            
    //         if($Id == 00){
    //             $Add = "<option>-- City --</option>";
    //             $Id = '';
    //         }else{
    //             $Add = '';
    //         }
    //         $response[] = ' '.$Add.' <option value='.$result->GMCTHCityId .' '.$selected.'>'.$result->GMCTHDesc1.'</option>';
    //     }
    //     return response()->json(['SelectedItem'=>$response]);      
    // }
    # Location
    public function GetSelectedLocation(Request $request)
    {
        $Id = $request->input('id');
        $fetchData = DB::table('T05901L06')
            ->where('GMLMHCompanyId', $this->gCompanyId)
            ->where('GMLMHMarkForDeletion', 0)
            ->orderBy('GMLMHLocationId', 'ASC')
            ->get();
            
        $response = array();
        foreach($fetchData as $result)
        {   
            if($result->GMLMHLocationId == $Id)
            {
            $selected = 'selected';
            }else{
            $selected = '';
            }
            
            if($Id == 00){
                $Add = "<option>All Location</option>";
                $Id = '';
            }else{
                $Add = '';
            }
            $response[] = ' '.$Add.' <option value='.$result->GMLMHLocationId .' '.$selected.'>'.$result->GMLMHDesc1.'</option>';
        }
        return response()->json(['SelectedItem'=>$response]);      
    }
    # Gender
    public function GetSelectedGender(Request $request)
    {
        $Id = $request->input('id');
        $fetchData = DB::table('T11901l02')
            ->where('GMGDHMarkForDeletion', 0)
            ->orderBy('GMGDHGenderId', 'ASC')
            ->get();
            
        $response = array();
        foreach($fetchData as $result)
        {   
            if($result->GMGDHGenderId == $Id)
            {
            $selected = 'selected';
            }else{
            $selected = '';
            }
            
            if($Id == 00){
                $Add = "<option>-- Gender --</option>";
                $Id = '';
            }else{
                $Add = '';
            }
            $response[] = ' '.$Add.' <option value='.$result->GMGDHGenderId .' '.$selected.'>'.$result->GMGDHDesc1.'</option>';
        }
        return response()->json(['SelectedItem'=>$response]);      
    }

    // Madhav
    // Retrun Nationality Dropdown In Add and Edit Mode
    public function GetSelectedNationality(Request $request)
    {
        $nationalityId = $request->input('id');
        $fetchData = DB::table('T11901L04')->orderBy('GMNAHNationalityId', 'ASC')->get();
        $response = array();

        foreach($fetchData as $result)
        {   
            if($result->GMNAHNationalityId == $nationalityId)
            {
            $secected = 'selected';
            }else{
            $secected = '';
            }
            
            if($nationalityId == 00){
                $Add = "<option>-- Select Nationality --</option>";
                $nationalityId = '';
            }else{
                $Add = '';
            }
            $response[] = ' '.$Add.' <option value='.$result->GMNAHNationalityId .' '.$secected.'>'.$result->GMNAHDesc1.'</option>';
        }        
        return response()->json(['SelectedItem'=>$response]);      
    }
    // Retrun Religion Dropdown In Add and Edit Mode
    public function GetSelectedReligionMaster(Request $request)
    {
        $religionId = $request->input('id');
        $fetchData = DB::table('T11901L06')->orderBy('GMRLHReligionId', 'ASC')->get();
        $response = array();

        foreach($fetchData as $result)
        {   
            if($result->GMRLHReligionId == $religionId)
            {
            $secected = 'selected';
            }else{
            $secected = '';
            }
            
            if($religionId == 00){
                $Add = "<option>-- Select Religion --</option>";
                $religionId = '';
            }else{
                $Add = '';
            }
            $response[] = ' '.$Add.' <option value='.$result->GMRLHReligionId .' '.$secected.'>'.$result->GMRLHDesc1.'</option>';
        }        
        return response()->json(['SelectedItem'=>$response]);      
    }
    // Retrun RaceGroup Dropdown In Add and Edit Mode
    public function GetSelectedRaceGroup(Request $request)
    {
        $raceId = $request->input('id');
        $fetchData = DB::table('T11901L05')->orderBy('GMRAHRaceId', 'ASC')->get();
        $response = array();

        foreach($fetchData as $result)
        {   
            if($result->GMRAHRaceId == $raceId)
            {
            $secected = 'selected';
            }else{
            $secected = '';
            }
            
            if($raceId == 00){
                $Add = "<option>-- Select Race/Cast --</option>";
                $raceId = '';
            }else{
                $Add = '';
            }
            $response[] = ' '.$Add.' <option value='.$result->GMRAHRaceId .' '.$secected.'>'.$result->GMRAHDesc1.'</option>';
        }        
        return response()->json(['SelectedItem'=>$response]);      
    }
    // Retrun Blood Group Dropdown In Add and Edit Mode
    public function GetSelectedBloodGroup(Request $request)
    {
        $bloodGroupId = $request->input('id');
        $fetchData = DB::table('T11901L03')->orderBy('GMBGHBloodGroupId', 'ASC')->get();
        $response = array();

        foreach($fetchData as $result)
        {   
            if($result->GMBGHBloodGroupId == $bloodGroupId)
            {
            $secected = 'selected';
            }else{
            $secected = '';
            }
            
            if($bloodGroupId == 00){
                $Add = "<option>-- Select Blood Group --</option>";
                $bloodGroupId = '';
            }else{
                $Add = '';
            }
            $response[] = ' '.$Add.' <option value='.$result->GMBGHBloodGroupId .' '.$secected.'>'.$result->GMBGHDesc1.'</option>';
        }        
        return response()->json(['SelectedItem'=>$response]);      
    }
    // Retrun PhysicalStatus Dropdown In Add and Edit Mode
    public function GetSelectedPhysicalStatus(Request $request)
    {
        $physicalStatusId = $request->input('id');
        $fetchData = DB::table('T11901L08')->orderBy('GMPSHPhysicalStatusId', 'ASC')->get();
        $response = array();

        foreach($fetchData as $result)
        {   
            if($result->GMPSHPhysicalStatusId == $physicalStatusId)
            {
            $secected = 'selected';
            }else{
            $secected = '';
            }
            
            if($physicalStatusId == 00){
                $Add = "<option>-- Select Physical Status --</option>";
                $physicalStatusId = '';
            }else{
                $Add = '';
            }
            $response[] = ' '.$Add.' <option value='.$result->GMPSHPhysicalStatusId .' '.$secected.'>'.$result->GMPSHDesc1.'</option>';
        }        
        return response()->json(['SelectedItem'=>$response]);      
    }
    // Retrun MaritalStatus Dropdown In Add and Edit Mode
    public function GetSelectedMaritalStatus(Request $request)
    {
        $maritalStatusId = $request->input('id');
        $fetchData = DB::table('T11901L07')->orderBy('GMMSHMaritalStatusId', 'ASC')->get();
        $response = array();

        foreach($fetchData as $result)
        {   
            if($result->GMMSHMaritalStatusId == $maritalStatusId)
            {
            $secected = 'selected';
            }else{
            $secected = '';
            }
            
            if($maritalStatusId == 00){
                $Add = "<option>-- Select Marital Status --</option>";
                $maritalStatusId = '';
            }else{
                $Add = '';
            }
            $response[] = ' '.$Add.' <option value='.$result->GMMSHMaritalStatusId .' '.$secected.'>'.$result->GMMSHDesc1.'</option>';
        }        
        return response()->json(['SelectedItem'=>$response]);      
    }
    // Retrun EmploymentType Dropdown In Add and Edit Mode
    public function GetSelectedEmploymentType(Request $request)
    {
        $empTypeId = $request->input('id');
        $fetchData = DB::table('T11903l04')->orderBy('ESTYHTypeId', 'ASC')->get();
        $response = array();

        foreach($fetchData as $result)
        {   
            if($result->ESTYHTypeId == $empTypeId)
            {
            $secected = 'selected';
            }else{
            $secected = '';
            }
            
            if($empTypeId == 00){
                $Add = "<option>-- Select Employment Type --</option>";
                $empTypeId = '';
            }else{
                $Add = '';
            }
            $response[] = ' '.$Add.' <option value='.$result->ESTYHTypeId .' '.$secected.'>'.$result->ESTYHDesc1.'</option>';
        }        
        return response()->json(['SelectedItem'=>$response]);      
    }
    // Retrun GradeType Dropdown In Add and Edit Mode
    public function GetSelectedGradeType(Request $request)
    {
        $gradeId = $request->input('id');
        $fetchData = DB::table('T11903l02')->orderBy('ESGRHGradeId', 'ASC')->get();
        $response = array();

        foreach($fetchData as $result)
        {   
            if($result->ESGRHGradeId == $gradeId)
            {
            $secected = 'selected';
            }else{
            $secected = '';
            }
            
            if($gradeId == 00){
                $Add = "<option>-- Select Grade Type --</option>";
                $gradeId = '';
            }else{
                $Add = '';
            }
            $response[] = ' '.$Add.' <option value='.$result->ESGRHGradeId .' '.$secected.'>'.$result->ESGRHDesc1.'</option>';
        }        
        return response()->json(['SelectedItem'=>$response]);      
    }
    // Retrun Designation Dropdown In Add and Edit Mode
    public function GetSelectedDesignation(Request $request)
    {
        $designationId = $request->input('id');
        $fetchData = DB::table('T11903L01')->orderBy('ESDEHDesignationId', 'ASC')->get();
        $response = array();

        foreach($fetchData as $result)
        {   
            if($result->ESDEHDesignationId == $designationId)
            {
            $secected = 'selected';
            }else{
            $secected = '';
            }
            
            if($designationId == 00){
                $Add = "<option>-- Select Designation Type --</option>";
                $designationId = '';
            }else{
                $Add = '';
            }
            $response[] = ' '.$Add.' <option value='.$result->ESDEHDesignationId .' '.$secected.'>'.$result->ESDEHDesc1.'</option>';
        }        
        return response()->json(['SelectedItem'=>$response]);      
    }
    // Retrun Department Dropdown In Add and Edit Mode
    public function GetSelectedDepartment(Request $request)
    {
        $departmentId = $request->input('id');
        $fetchData = DB::table('T11903L03')->orderBy('ESDPHDepartmentId', 'ASC')->get();
        $response = array();

        foreach($fetchData as $result)
        {   
            if($result->ESDPHDepartmentId == $departmentId)
            {
            $secected = 'selected';
            }else{
            $secected = '';
            }
            
            if($departmentId == 00){
                $Add = "<option>-- Select Department Type --</option>";
                $departmentId = '';
            }else{
                $Add = '';
            }
            $response[] = ' '.$Add.' <option value='.$result->ESDPHDepartmentId .' '.$secected.'>'.$result->ESDPHDesc1.'</option>';
        }        
        return response()->json(['SelectedItem'=>$response]);      
    }
    // Retrun Calendar Dropdown In Add and Edit Mode
    public function GetSelectedCalendar(Request $request)
    {
        $calendarId = $request->input('id');
        $fetchData = DB::table('T05903L02')->orderBy('FYCAHCalendarId', 'ASC')->get();
        $response = array();

        foreach($fetchData as $result)
        {   
            if($result->FYCAHCalendarId == $calendarId)
            {
            $secected = 'selected';
            }else{
            $secected = '';
            }
            
            if($calendarId == 00){
                $Add = "<option>-- Select Calendar --</option>";
                $calendarId = '';
            }else{
                $Add = '';
            }
            $response[] = ' '.$Add.' <option value='.$result->FYCAHCalendarId .' '.$secected.'>'.$result->FYCAHDesc1.'</option>';
        }        
        return response()->json(['SelectedItem'=>$response]);      
    }
    // Retrun TaxRegimHeader Dropdown In Add and Edit Mode
    public function GetSelectedTaxRegim(Request $request)
    {
        $taxRegimId = $request->input('id');
        $fetchData = DB::table('t11907l01')->orderBy('ITRMHRegimeId', 'ASC')->get();
        $response = array();

        foreach($fetchData as $result)
        {   
            if($result->ITRMHRegimeId == $taxRegimId)
            {
            $secected = 'selected';
            }else{
            $secected = '';
            }
            
            if($taxRegimId == 00){
                $Add = "<option>-- Select Tax Regim --</option>";
                $taxRegimId = '';
            }else{
                $Add = '';
            }
            $response[] = ' '.$Add.' <option value='.$result->ITRMHRegimeId .' '.$secected.'>'.$result->ITRMHDesc1.'</option>';
        }        
        return response()->json(['SelectedItem'=>$response]);      
    }
    // Retrun TaxRegimHeader Dropdown In Add and Edit Mode
    public function GetSelectedHierarchyId(Request $request)
    {
        $hierarchyId = $request->input('id');
        $fetchData = DB::table('t00903l02')->orderBy('PMRHHHierarchyId', 'ASC')->get();
        $response = array();

        foreach($fetchData as $result)
        {   
            if($result->PMRHHHierarchyId == $hierarchyId)
            {
            $secected = 'selected';
            }else{
            $secected = '';
            }
            
            if($hierarchyId == 00){
                $Add = "<option>-- Select Hierarchy Id --</option>";
                $hierarchyId = '';
            }else{
                $Add = '';
            }
            $response[] = ' '.$Add.' <option value='.$result->PMRHHHierarchyId .' '.$secected.'>'.$result->PMRHHDesc1.'</option>';
        }        
        return response()->json(['SelectedItem'=>$response]);      
    }
    // Retrun Statutory Deduction Method Dropdown In Add and Edit Mode
    public function GetSelectedDeductionMethod(Request $request)
    {
        $MethodId = $request->input('id');
        $fetchData = DB::table('T00903L05')->orderBy('PMDMHMethodId', 'ASC')->get();
        $response = array();

        foreach($fetchData as $result)
        {   
            if($result->PMDMHMethodId == $MethodId)
            {
            $secected = 'selected';
            }else{
            $secected = '';
            }
            
            if($MethodId == 00){
                $Add = "<option>-- Select Method Id --</option>";
                $MethodId = '';
            }else{
                $Add = '';
            }
            $response[] = ' '.$Add.' <option value='.$result->PMDMHMethodId .' '.$secected.'>'.$result->PMDMHDesc.'</option>';
        }        
        return response()->json(['SelectedItem'=>$response]);      
    }
    // Retrun Fiscal Year Dropdown In Add and Edit Mode
    public function GetSelectedFiscalYear(Request $request)
    {
        $fiscalYearId = $request->input('id');
        $fetchData = DB::table('t05903L01')->orderBy('FYFYHFiscalYearId', 'ASC')->get();
        $response = array();

        foreach($fetchData as $result)
        {   
            if($result->FYFYHFiscalYearId == $fiscalYearId)
            {
            $secected = 'selected';
            }else{
            $secected = '';
            }
            
            if($fiscalYearId == 00){
                $Add = "<option>-- Select Fiscal Year --</option>";
                $fiscalYearId = '';
            }else{
                $Add = '';
            }
            $response[] = ' '.$Add.' <option value='.$result->FYFYHFiscalYearId .' '.$secected.'>'.$result->FYFYHFiscalYearId.'</option>';
        }        
        return response()->json(['SelectedItem'=>$response]);      
    }
    public function GetActiveFiscalYearParameater()
    {
        $fetchData = DB::table('t05903L01')
        ->where('FYFYHCurrentFY', 1)
        ->where('FYFYHCompanyId', $this->gCompanyId)
        ->where('FYFYHMarkForDeletion', 0)        
        ->get()
        ->first();
        // Get Foreign key desc
        $PeriodDesc = DB::table('T00901L01')
        ->where('FYPMHPeriodId', $fetchData->FYFYHCurrentPeriod)
        ->get(['FYPMHDesc1'])
        ->first();
         $output = array(
            // For Delete Button and Delete Detail Entry Form
            'FYFYHFiscalYearId'         =>  $fetchData->FYFYHFiscalYearId,
            'FYFYHStartDate'            =>  $fetchData->FYFYHStartDate,
            'FYFYHEndDate'              =>  $fetchData->FYFYHEndDate,
            'FYFYHCurrentPeriod'        =>  $fetchData->FYFYHCurrentPeriod,
            'FYFYHCurrentPeriodDesc'    =>  $PeriodDesc->FYPMHDesc1,
            'FYFYHPeriodStartDate'      =>  $fetchData->FYFYHPeriodStartDate,
            'FYFYHPeriodEndDate'        =>  $fetchData->FYFYHPeriodEndDate
        );
        echo json_encode($output);

    }
    public function GetFiscalYearParameater($request)
    {
        $fetchData = DB::table('t05903L01')
        ->where('FYFYHCompanyId', $this->gCompanyId)
        ->where('FYFYHFiscalYearId', $request->FYFYHFiscalYearId)
        ->where('FYFYHMarkForDeletion', 0)
        ->get()
        ->first();
         $output = array(
            // For Delete Button and Delete Detail Entry Form
            // 'FYFYHFiscalYearId'         =>  $fetchData->FYFYHFiscalYearId,
            'FYFYHStartDate'            =>  $fetchData->FYFYHStartDate,
            'FYFYHEndDate'              =>  $fetchData->FYFYHEndDate,
        );
        echo json_encode($output);

    }
    public function GetFiscalYearPeriodDate(Request $request)
    {
		//  echo 'Data Submitted.';
        // print_r($request->input());
        // die();
        $periodId = $request->get('periodId');
        $FiscalYearId = $request->get('FiscalYearId');
        DB::select("CALL getPeriodFromToDate(".$FiscalYearId.", ".$periodId.", @fromDate, @toDate)");
        $results = DB::select('select @fromDate as fromDate, @toDate as toDate ');  
        //  $output = array(
        //     'startDate'            =>  $results[0]->fromDate,
        //     'endDate'              =>  $results[0]->toDate
        // );
        // echo json_encode($output);
        return response()->json(['startDate'=>$results[0]->fromDate, 'endDate'=>$results[0]->toDate]); 

    }
    // Retrun Salutation Dropdown In Add and Edit Mode
    public function GetSelectedSalutation(Request $request)
    {
        $salutationId = $request->input('id');
        $fetchData = DB::table('T11901L01')->orderBy('GMSLHSalutationId', 'ASC')->get();
        $response = array();

        foreach($fetchData as $result)
        {   
            if($result->GMSLHSalutationId == $salutationId)
            {
            $secected = 'selected';
            }else{
            $secected = '';
            }
            
            if($salutationId == 00){
                $Add = "<option>-- Select Salutation --</option>";
                $salutationId = '';
            }else{
                $Add = '';
            }
            $response[] = ' '.$Add.' <option value='.$result->GMSLHSalutationId .' '.$secected.'>'.$result->GMSLHDesc1.'</option>';
        }        
        return response()->json(['SelectedItem'=>$response]);      
    }
    //Retrun PaymentMode Dropdown In Add and Edit Mode
    public function GetPaymentMode(Request $request)
    {
        $paymentModeId = $request->input('id');
        $fetchData = DB::table('t05902l04')->orderBy('BMPMHPaymentModeId', 'ASC')->get();
        $response = array();

        foreach($fetchData as $result)
        {   
            if($result->BMPMHPaymentModeId == $paymentModeId)
            {
            $secected = 'selected';
            }else{
            $secected = '';
            }
            
            if($paymentModeId == 00){
                $Add = "<option>-- Select Payment Mode --</option>";
                $paymentModeId = '';
            }else{
                $Add = '';
            }
            $response[] = ' '.$Add.' <option value='.$result->BMPMHPaymentModeId .' '.$secected.'>'.$result->BMPMHDesc1.'</option>';
        }        
        return response()->json(['SelectedItem'=>$response]);      
    }
    //Retrun Acct Type Dropdown In Add and Edit Mode
    public function GetAcctType(Request $request)
    {
        $acctId = $request->input('id');
        $fetchData = DB::table('t05902l03')->orderBy('BMATHAcctId', 'ASC')->get();
        $response = array();

        foreach($fetchData as $result)
        {   
            if($result->BMATHAcctId == $acctId)
            {
            $secected = 'selected';
            }else{
            $secected = '';
            }
            
            if($acctId == 00){
                $Add = "<option>-- Select Acct Type --</option>";
                $acctId = '';
            }else{
                $Add = '';
            }
            $response[] = ' '.$Add.' <option value='.$result->BMATHAcctId .' '.$secected.'>'.$result->BMATHDesc1.'</option>';
        }        
        return response()->json(['SelectedItem'=>$response]);      
    }
    public function GetSelectedEmployee(Request $request)
    {
        $empId = $request->input('id');
        $fetchData = DB::table('T11101l01')->orderBy('EMGIHEmployeeId', 'ASC')->get();
        $response = array();

        foreach($fetchData as $result)
        {   
            if($result->EMGIHEmployeeId == $empId)
            {
            $secected = 'selected';
            }else{
            $secected = '';
            }
            
            if($empId == 00){
                $Add = "<option>-- Select Employee Id --</option>";
                $empId = '';
            }else{
                $Add = '';
            }
            $response[] = ' '.$Add.' <option value='.$result->EMGIHEmployeeId .' '.$secected.'>'.$result->EMGIHFullName.'</option>';
        }        
        return response()->json(['SelectedItem'=>$response]);      
    }
    public function GetLocationDesc(Request $request){       
        
        $LocationDesc = $this->getLocationDescTrait($request); 
        return response()->json([
            'locationId'=>$LocationDesc->GMLMHLocationId,
            'locationDesc'=>$LocationDesc->GMLMHDesc1
            
        ]);
    }
    // Madhav Ends*****
}
// echo 'Data Submitted : ';
// return $response;
// die();
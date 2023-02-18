<?php

namespace App\Http\Controllers\Payroll\PayrollGeneration;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
// Utilities
use Illuminate\Support\Carbon;
use Auth;
use Validator;
use DataTables;
// Traits
use App\Traits\Payroll\PayrollGeneration\payrollGenerationDbOperations;
// use App\Traits\Payroll\PayrollGeneration\statutoryDeductionTrait;
use App\Traits\DropDown3SIS\dropDowns3SIS;
use App\Traits\TablesSchema3SIS\tablesSchema3SIS;
class PayrollGenerationController extends Controller
{
    use payrollGenerationDbOperations, dropDowns3SIS, tablesSchema3SIS;
    protected  $gCompanyId = '1000';
    function LandingForm()
    {
        $data = $this->dataTableXLSchemaTrait();
        // $this->ZmemDeleteTrait();   
        return view('Payroll.PayrollGeneration.payrollGeneration')->with($data);
    }
    function BrowserData()
    {
        //Eloquent way - Model is must
        $BrowserDataTable = $this->BrowserDataTrait();
        return DataTables::of($BrowserDataTable)
        ->addColumn('action', function($PayrollHeaderMem){
            return '<a href="#" class="btn mr-1 btnEditRec3SIS edit" id="'.$PayrollHeaderMem->PGGPHUniqueId.'">Edit
                        <i class="fas fa-edit fa-xs"></i>
                    </a>';
        })

        ->make(true);
    }
    function BrowserPayrollDetailData(Request $request)
    {
        //Eloquent way - Model is must
        $BrowserDetailDataTable = $this->BrowserPayrollDetailDataTrait($request);
        return DataTables::of($BrowserDetailDataTable)
        ->make(true);
    }
    function UpdateMemEmployee(Request $request){
        // echo 'Data Submitted.';
        // return $request->input();
        // die();
        $this->UpdateMemEmployeeTrait($request);
        // echo 'Data Submitted.'.$UniqueId;
        // die();
        return response()->json(['status'=>1]);
        
    }
    function Select_UnSelectEmployee(Request $request){
        $UniqueId = $this->UpdateSelect_UnSelectEmployeeTrait($request);
        return response()->json(['status'=>1]);
        
    }
    function BrowserEmployeeList(Request $request){
        // echo 'Data Submitted at Trait.';
        // return $request->input();
        // die();
        $BrowserDataTable = $this->BrowserEmployeeListTrait($request);
        return DataTables::of($BrowserDataTable)
        ->make(true);
    }
    function GeneratePayroll(Request $request){
        $this->ConvertScreenVariables($request);
        // echo 'Data Submitted.';
        // print_r($request->input());
        // die();
        if ($request->employeeSelection == 0) {
            $this->UpdateMemForAllEmployeeTrait($request);
            // return response()->json(['status'=>1]);
        }
        $this->CalculateEmployeePayrollTrait($request);
        $this->UpdatePayrollHeaderMemWithTotal();

       
        
    }
    function ConvertScreenVariables($request){
        $start_date = Carbon::parse($request->FYFYHPeriodStartDate);
        $end_date = Carbon::parse($request->FYFYHPeriodEndDate);
        $diff_Days = $start_date->diffInDays($end_date)+1;
        $request->merge(['TotalNoOfDays' => $diff_Days]);
    }
    function PostData(Request $request){
        // $this->UpdateActPayrollDetailWithMemTable($request);
        $this->UpdateActPayrollHeaderWithMemTable($request);
        // return response()->json(['status'=>1, 'Id'=>$request->get('EMGIHEmployeeId'), 
        //     'Desc1'=>$request->get('EMGIHFullName'),
        //     'masterName'=>'Employee Earnings ', 'updateMode'=>'Updated']);
    }
}

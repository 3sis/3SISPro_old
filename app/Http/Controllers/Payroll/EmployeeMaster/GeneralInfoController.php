<?php

namespace App\Http\Controllers\Payroll\EmployeeMaster;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\ErrorMessages3SISRequest;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
// CopyChange
use Illuminate\Support\Carbon;
use Auth;
use Validator;
use DataTables;
// use App\Models\Payroll\EmployeeMaster\GeneralInfo;
// use App\Models\SystemsMaster\PeriodMaster;
use App\Traits\Payroll\EmployeeMaster\generalInfoDbOperations;
use App\Traits\DropDown3SIS\dropDowns3SIS;
use App\Traits\TablesSchema3SIS\tablesSchema3SIS;

class GeneralInfoController extends Controller
{
    
    use generalInfoDbOperations, dropDowns3SIS, tablesSchema3SIS;
    protected  $gCompanyId = '1000';    
    // $this->gCompanyId;

    function Index()
    { 
        $data = $this->dataTableXLSchemaTrait();
        return view('Payroll.EmployeeMaster.generalInfo')->with($data);
    }
    function BrowserData()
    {
        //Eloquent way - Model is must
        $BrowserDataTable = $this->EMGIH11BrowserDataTrait();        
        return DataTables::of($BrowserDataTable)
        ->addColumn('action', function($Employee){
            return '<a href="#" class="btn mr-1 btnEditRec3SIS edit" id="'.$Employee->EMGIHUniqueId.'">Edit
                        <i class="fas fa-edit fa-xs"></i>
                    </a>
                    <a href="#" class="btn btnDeleteRec3SIS delete" id="'.$Employee->EMGIHUniqueId.'">Del
                        <i class="far fa-trash-alt fa-xs"></i>
                    </a>';
        })
        ->make(true);
    } 
    function Fetchdata(Request $request)
    {
        $fethchedData = $this->EMGIH11FethchEditedDataTrait($request);
        echo json_encode($fethchedData);
    }
    function Postdata(Request $request)
    {
        $this->ConvertScreenVariables($request);
        if ($request->EMGIHIsResignation == '1') {
            $request->merge(['EMGIHDateOfLetterSubmission' => ' ']);
        }

        $EMGIHOTApplicable              = (int)$request->EMGIHOTApplicable;
        $EMGIHIsDailyWages              = (int)$request->EMGIHIsDailyWages;
        $EMGIHPFAgreedByComp            = (int)$request->EMGIHPFAgreedByComp;
        $EMGIHSameAsPresentAdd          = (int)$request->EMGIHSameAsPresentAdd;
        $EMGIHIsResignation             = (int)$request->EMGIHIsResignation;
        $EMGIHLeaveWithoutPayIndicator  = (int)$request->EMGIHLeaveWithoutPayIndicator;
        

        $request->merge(['EMGIHCompId' => $this->gCompanyId]);

        // $request->merge(['EMGIHOTApplicable'             => $EMGIHOTApplicable ]);
        // $request->merge(['EMGIHIsDailyWages'             => $EMGIHIsDailyWages ]);
        // $request->merge(['EMGIHPFAgreedByComp'           => $EMGIHPFAgreedByComp ]);
        // $request->merge(['EMGIHSameAsPresentAdd'         => $EMGIHSameAsPresentAdd ]);
        // $request->merge(['EMGIHIsResignation'            => $EMGIHIsResignation ]);
        // $request->merge(['EMGIHLeaveWithoutPayIndicator' => $EMGIHLeaveWithoutPayIndicator ]);
       
        if($request->get('button_action') == 'insert')
        {            
            $validator = Validator::make($request->all(), [
                'EMGIHEmployeeId' => [
                    'required',
                    // 'unique:T11101l01,EMGIHEmployeeId,NULL,EMGIHUniqueId,EMGIHCompId,EMGIHLocationId,'.$request->EMGIHCompId
                ],                
                'EMGIHFirstName'           => 'required|max:100',
                'EMGIHLastName'            => 'required|max:100',
                'EMGIHLocationId'          => 'required',
                'EMGIHSalutationId'        => 'required',
                'EMGIHDateOfBirth'         => 'required',
                'EMGIHDateOfJoining'       => 'required',
                'EMGIHCalendarId'          => 'required',
                'EMGIHPresentAddress1'     => 'required',
                'EMGIHPresentCityId'       => 'required',
                'EMGIHPresentPinCode'      => 'required',
                'EMGIHBranchId'            => 'required',
                'EMGIHAccountTypeId'       => 'required',
                'EMGIHBankAccountNo'       => 'required',
                'EMGIHRegimeId'            => 'required',
                'EMGIHLeaveGroupId'        => 'required',
            ]);
        }
        else
        {
            $validator = Validator::make($request->all(), [                
                'EMGIHFirstName'         => 'required|max:100',
                'EMGIHLastName'          => 'required|max:100',
                'EMGIHLocationId'        => 'required',
                'EMGIHSalutationId'        => 'required',
                'EMGIHDateOfBirth'         => 'required',
                'EMGIHDateOfJoining'       => 'required',
                'EMGIHCalendarId'          => 'required',
                'EMGIHPresentAddress1'     => 'required',
                'EMGIHPresentCityId'       => 'required',
                'EMGIHPresentPinCode'      => 'required',
                'EMGIHBranchId'            => 'required',
                'EMGIHAccountTypeId'       => 'required',
                'EMGIHBankAccountNo'       => 'required',
                'EMGIHRegimeId'            => 'required',
                'EMGIHLeaveGroupId'        => 'required',
            ]);
        }

        if(!$validator->passes()){
            return response()->json(['status'=>0, 'error'=>$validator->errors()->toArray()]);

        }
        else{   
            // When add button is pushed
            if($request->get('button_action') == 'insert')
            {
                $UniqueId = $this->EMGIH11AddUpdateTrait($request);
                return response()->json(['status'=>1, 'Id'=>$request->get('EMGIHEmployeeId'), 
                    'Desc1'=>'',
                    'masterName'=>'Employee ', 'updateMode'=>'Added']);                 
            }
            // When edit button is pushed
            if($request->get('button_action') == 'update')
            {  
                $UniqueId = $this->EMGIH11AddUpdateTrait($request);
                return response()->json(['status'=>1, 'Id'=>$request->get('EMGIHEmployeeId'), 
                    'Desc1'=>'', 'masterName'=>'Employee ', 'updateMode'=>'Updated']);   
            }
                   
        }
    }
    function DeleteData(Request $request)
    {
        $EmployeeId = $this->EMGIH11DeleteRecordTrait($request);
        return response()->json(['status'=>1, 'Id'=>$EmployeeId, 
            'Desc1'=>'', 'masterName'=>'Employee ', 'updateMode'=>'Deleted']);        
    }
    function BrowserDeletedRecords()
    {
        //Eloquent way - Model is must
        $browserDeletedRecords = $this->EMGIH11BrowserDeletedRecorTrait();          
        return DataTables::of($browserDeletedRecords)
        ->addColumn('action', function($DeletedEmployee){
            return '<a href="#" class="btn mr-1 btnEditRec3SIS restore" id="'.$DeletedEmployee->EMGIHUniqueId.'">Restore
                        <i class="fas fa-trash-restore"></i>
                    </a>';
            // <a href="#" class="btn btn-outline-danger mr-1 btn-sm delete" id="'.$FiscalYear->EMGIHUniqueId.'">Delete</a>';
        })
        ->make(true);
    } 
    function RestoreDeletedRecord(Request $request)
    {
        $EmployeeId = $this->EMGIH11UnDeleteRecordTrait($request);
        return response()->json(['status'=>1, 'Id'=>$EmployeeId, 
            'Desc1'=>'', 'masterName'=>'Employee ', 'updateMode'=>'Restored']);        
    }
    function ConvertScreenVariables($request){
        if ($request->EMGIHLocationId == "-- Select Location --") {
            $request->merge(['EMGIHLocationId' => '']);
        }
        if ($request->EMGIHSalutationId == "-- Select Salutation --") {
            $request->merge(['EMGIHSalutationId' => '']);
        }
        if ($request->EMGIHCalendarId == "-- Select Calendar --") {
            $request->merge(['EMGIHCalendarId' => '']);
        }
        if ($request->EMGIHPresentCityId == "-- Select City --") {
            $request->merge(['EMGIHPresentCityId' => '']);
        }
        if ($request->EMGIHBranchId == "-- Select Branch --") {
            $request->merge(['EMGIHBranchId' => '']);
        }
        if ($request->EMGIHAccountTypeId == "-- Select Acct Type --") {
            $request->merge(['EMGIHAccountTypeId' => '']);
        }
        if ($request->EMGIHRegimeId == "-- Select Tax Regim --") {
            $request->merge(['EMGIHRegimeId' => '']);
        }
        if ($request->EMGIHLeaveGroupId == "-- Select Marital Status --") {
            $request->merge(['EMGIHLeaveGroupId' => '']);
        }
	}
}
<?php

namespace App\Http\Controllers\Payroll\IncomeDeductionType;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
// Utilities
use Illuminate\Support\Carbon;
use Auth;
use Validator;
use DataTables;
// Traits
use App\Traits\Payroll\IncomeDeductionType\deductionTypeDbOperations;
use App\Traits\TablesSchema3SIS\tablesSchema3SIS;
use App\Traits\DropDown3SIS\dropDowns3SIS;
use App\Models\Payroll\IncomeDeductionType\PeriodicIncDed;

class DeductionTypeController extends Controller
{
    use deductionTypeDbOperations, dropDowns3SIS, tablesSchema3SIS;
    function Index()
    { 
        $data = $this->dataTableXLSchemaTrait();
        return view('Payroll.IncomeDeductionType.deductionType')->with($data);
    }
    function BrowserData()
    {
        //Eloquent way - Model is must 
        $BrowserDataTable = $this->PMDTH11BrowserDataTrait();
        // echo 'Data Submitted.';
        // return $BrowserDataTable;
        // die();       
        return DataTables::of($BrowserDataTable)
        ->addColumn('action', function($DeductionType){
            return '<a href="#" class="btn mr-1 btnEditRec3SIS edit" id="'.$DeductionType->PMDTHUniqueId.'">Edit
                        <i class="fas fa-edit fa-xs"></i>
                    </a>
                    <a href="#" class="btn btnDeleteRec3SIS delete" id="'.$DeductionType->PMDTHUniqueId.'">Del
                        <i class="far fa-trash-alt fa-xs"></i>
                    </a>';
        })
        ->make(true);
    }    
    function Postdata(Request $request)
    {
        // echo 'Data Submitted.';
        // return $request->input();
        // die();
      
        if($request->get('button_action') == 'insert')
        {
            $validator = Validator::make($request->all(), [
                'PMDTHDeductionId' =>  'required|max:10||unique:T11906L02,PMDTHDeductionId',
                'PMDTHDesc1'    => 'required|max:100',
                'PMDTHDesc2'    => 'max:200',
                "periodId"      => "required_if:deductionCycleId,==,P",
            ]);
        }
        else
        {
            $validator = Validator::make($request->all(), [
                'PMDTHDesc1'    => 'required',
                "periodId"      => "required_if:deductionCycleId,==,P",
            ]);
        }
        if(!$validator->passes()){
            return response()->json(['status'=>0, 'error'=>$validator->errors()->toArray()]);
        }
        else{     
            // When add button is pushed
            if($request->get('button_action') == 'insert')
            {
                $this->PMDTH11AddUpdateTrait($request);
                return response()->json(['status'=>1, 'Id'=>$request->get('PMDTHDeductionId'), 
                    'Desc1'=>$request->get('PMDTHDesc1'),
                    'masterName'=>'DeductionType ', 'updateMode'=>'Added']); 
            }
            // When edit button is pushed
            if($request->get('button_action') == 'update')
            {           
                $this->PMDTH11AddUpdateTrait($request);              
                return response()->json(['status'=>1, 'Id'=>$request->get('PMDTHDeductionId'), 
                    'Desc1'=>$request->get('PMDTHDesc1'), 'masterName'=>'DeductionType ', 'updateMode'=>'Updated']);      
            }     
        }
    }
    function Fetchdata(Request $request)
    {
        // Get Header Info
        $fethchedData = $this->PMDTH11FethchEditedDataTrait($request);
        // Get Detail Info
        
        echo json_encode($fethchedData);
    }
    function DeleteData(Request $request)
    {
        $DeductionId = $this->PMDTH11DeleteRecordTrait($request);
        return response()->json(['status'=>1, 'Id'=>$DeductionId, 
            'Desc1'=>'', 'masterName'=>'DeductionType ', 'updateMode'=>'Deleted']);         
    }    
    function BrowserDeletedRecords()
    {
        //Eloquent way - Model is must 
        $browserDeletedRecords = $this->PMDTH11BrowserDeletedRecordsTrait(); 
        return DataTables::of($browserDeletedRecords)
        ->addColumn('action', function($DeletedDeductionType){
            return '<a href="#" class="btn mr-1 btnEditRec3SIS restore" id="'.$DeletedDeductionType->PMDTHUniqueId.'">Restore
                        <i class="fas fa-trash-restore"></i>
                    </a>';
        })
        ->make(true);
    } 
    function RestoreDeletedRecord(Request $request)
    {                    
        $DeductionId = $this->PMDTH11UnDeleteRecordTrait($request);
        return response()->json(['status'=>1, 'Id'=>$DeductionId, 
        'Desc1'=>'', 'masterName'=>'DeductionType ', 'updateMode'=>'Restored']); 
    }
    // Sub Form Detail Entry Methods
    function AppendSubForm()
    {
        $this->PMDTH11AppendMemTableTrait();
        return;
    }
    function BrowserSubForm(Request $request)
    {
        // echo 'Data Submitted at Trait.';
        // return $request->input();
        // die();
        //Eloquent way - Model is must 
        $BrowserDataTable = $this->PMDTH11BrowserSubFormTrait();
        return DataTables::of($BrowserDataTable)
        ->addColumn('action', function($DeductionType){
            return '<a href="#" class="btn mr-1 btnEditRec3SIS select" id="'.$DeductionType->PMDTDUniqueId.'">Pick
                        <i class="fas fa-check-square fa-xs"></i>
                    </a>
                    <a href="#" class="btn btnDeleteRec3SIS remove" id="'.$DeductionType->PMDTDUniqueId.'">Del
                        <i class="fas fa-eraser fa-xs"></i>
                    </a>';
        })
        ->make(true);
    }
    function FetchSubFormData(Request $request)
    {
        $fethchedSubFormData = $this->PMDTH11FethchEditedSubFormDataTrait($request);
        // echo 'Data Submitted.';
        // return $request->input();
        // die();
        echo json_encode($fethchedSubFormData);
    }
    function PostSubFormData(Request $request)
    {
        if($request->get('button_action_DetailEntry') == 'update')
        {
            $this->PMDTH11AddUpdateDetailEntryTrait($request);              
            return response()->json(['status'=>1]);   
        }        
    }
    function DeleteSubFormData(Request $request)
    {
        $this->PMDTH11DeleteDetailEntryTrait($request);              
        return response()->json(['status'=>1]); 
    }
    // Sub Form Detail Entry Methods End**********
}

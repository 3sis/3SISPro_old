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
use App\Traits\Payroll\IncomeDeductionType\incomeTypeDbOperations;
use App\Traits\TablesSchema3SIS\tablesSchema3SIS;
// use App\Traits\DropDown3SIS\dropDowns3SIS;

class IncomeTypeController extends Controller
{
    use incomeTypeDbOperations, tablesSchema3SIS;
    function Index()
    { 
        
        $data = $this->dataTableXLSchemaTrait();
        return view('Payroll.IncomeDeductionType.incomeType')->with($data);
    }
    function BrowserData()
    {
        //Eloquent way - Model is must 
        $BrowserDataTable = $this->PMITH11BrowserDataTrait();
        // echo 'Data Submitted.';
        // return $BrowserDataTable;
        // die();       
        return DataTables::of($BrowserDataTable)
        ->addColumn('action', function($IncomeType){
            return '<a href="#" class="btn mr-1 btnEditRec3SIS edit" id="'.$IncomeType->PMITHUniqueId.'">Edit
                        <i class="fas fa-edit fa-xs"></i>
                    </a>
                    <a href="#" class="btn btnDeleteRec3SIS delete" id="'.$IncomeType->PMITHUniqueId.'">Del
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
                'PMITHIncomeId' =>  'required|max:10||unique:T11906L01,PMITHIncomeId',
                'PMITHDesc1'    => 'required|max:100',
                'PMITHDesc2'    => 'max:200',
                "periodId"      => "required_if:incomeCycleId,==,P",
            ]);
        }
        else
        {
            $validator = Validator::make($request->all(), [
                'PMITHDesc1'    => 'required',
                "periodId"      => "required_if:incomeCycleId,==,P",
            ]);
        }
        if(!$validator->passes()){
            return response()->json(['status'=>0, 'error'=>$validator->errors()->toArray()]);
        }
        else{     
            // When add button is pushed
            if($request->get('button_action') == 'insert')
            {
                $this->PMITH11AddUpdateTrait($request);
                return response()->json(['status'=>1, 'Id'=>$request->get('PMITHIncomeId'), 
                    'Desc1'=>$request->get('PMITHDesc1'),
                    'masterName'=>'IncomeType ', 'updateMode'=>'Added']); 
            }
            // When edit button is pushed
            if($request->get('button_action') == 'update')
            {           
                $this->PMITH11AddUpdateTrait($request);              
                return response()->json(['status'=>1, 'Id'=>$request->get('PMITHIncomeId'), 
                    'Desc1'=>$request->get('PMITHDesc1'), 'masterName'=>'IncomeType ', 'updateMode'=>'Updated']);      
            }     
        }
    }
    function Fetchdata(Request $request)
    {
        $fethchedData = $this->PMITH11FethchEditedDataTrait($request);
        echo json_encode($fethchedData);
    }
    function DeleteData(Request $request)
    {
        $IncomeId = $this->PMITH11DeleteRecordTrait($request);
        return response()->json(['status'=>1, 'Id'=>$IncomeId, 
            'Desc1'=>'', 'masterName'=>'IncomeType ', 'updateMode'=>'Deleted']);         
    }    
    function BrowserDeletedRecords()
    {
        //Eloquent way - Model is must 
        $browserDeletedRecords = $this->PMITH11BrowserDeletedRecordsTrait(); 
        return DataTables::of($browserDeletedRecords)
        ->addColumn('action', function($DeletedIncomeType){
            return '<a href="#" class="btn mr-1 btnEditRec3SIS restore" id="'.$DeletedIncomeType->PMITHUniqueId.'">Restore
                        <i class="fas fa-trash-restore"></i>
                    </a>';
        })
        ->make(true);
    } 
    function RestoreDeletedRecord(Request $request)
    {                    
        $IncomeId = $this->PMITH11UnDeleteRecordTrait($request);
        return response()->json(['status'=>1, 'Id'=>$IncomeId, 
        'Desc1'=>'', 'masterName'=>'IncomeType ', 'updateMode'=>'Restored']); 
    }
}

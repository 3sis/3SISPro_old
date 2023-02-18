<?php

namespace App\Http\Controllers\SystemsMaster\PaymentMaster;

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
use App\Traits\SystemsMaster\PaymentMaster\RuleDefinitionDbOperations;
use App\Traits\DropDown3SIS\dropDowns3SIS;
use App\Traits\TablesSchema3SIS\tablesSchema3SIS;

class RuleDefinitionController extends Controller
{
    use RuleDefinitionDbOperations, dropDowns3SIS, tablesSchema3SIS;
    function Index()
    {         
        $data = $this->dataTableXLSchemaTrait();
        return view('SystemsMaster.PaymentMaster.ruleDefinition')->with($data);
    } 
    function BrowserData()
    {
        //Eloquent way - Model is must
        $BrowserDataTable = $this->BrowserDataTrait();        
        return DataTables::of($BrowserDataTable)
        ->addColumn('action', function($RuleDefinition){
            return '<a href="#" class="btn mr-1 btnEditRec3SIS edit" id="'.$RuleDefinition->PMRDHUniqueId.'">Edit
                        <i class="fas fa-edit fa-xs"></i>
                    </a>';
        })
        ->make(true);
    } 
    function Fetchdata(Request $request)
    {
        $fethchedData = $this->FethchEditedDataTrait($request);
        echo json_encode($fethchedData);
    }
    function Postdata(Request $request)
    {
        // echo 'Data Submitted.';
        // return $request->input();
        // die();         

        if($request->get('button_action') == 'update')
        {
            $validator = Validator::make($request->all(), [
                'PMRDHHierarchyId'         => 'required',               
                'PMRDHDeductionEligibility'     => 'required',
                'PMRDHDeductionBasis'    => 'required',
            ]);
        }
        if(!$validator->passes()){
            return response()->json(['status'=>0, 'error'=>$validator->errors()->toArray()]);

        }
        else{   
            // When edit button is pushed
            if($request->get('button_action') == 'update')
            {  
                $UniqueId = $this->AddUpdateTrait($request);
                return response()->json(['status'=>1, 'Id'=>$request->get('PMRDHRuleId'), 
                    'Desc1'=>'', 'masterName'=>'Rule Definition ', 'updateMode'=>'Updated']);   
            }
                   
        }
    }
}

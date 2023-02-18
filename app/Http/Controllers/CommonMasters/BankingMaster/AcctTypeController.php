<?php

namespace App\Http\Controllers\CommonMasters\BankingMaster;

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
use App\Models\CommonMasters\BankingMaster\AcctType;
use App\Traits\CommonMasters\BankingMaster\AcctTypeDbOperations;
use App\Traits\TablesSchema3SIS\tablesSchema3SIS;

class AcctTypeController extends Controller
{
    use AcctTypeDbOperations, tablesSchema3SIS;
    function Index()
    { 
        $data = $this->dataTableXLSchemaTrait();
        return view('CommonMasters.BankingMaster.acctType')->with($data);
    }
    function BrowserData()
    {
        //Eloquent way - Model is must 
        $BrowserDataTable = $this->actBrowserDataTrait();        
        return DataTables::of($BrowserDataTable)
        
        ->addColumn('action', function($AcctType){
            return '<a href="#" class="btn mr-1 btnEditRec3SIS edit" id="'.$AcctType->BMATHUniqueId.'">Edit
                        <i class="fas fa-edit fa-xs"></i>
                    </a>
                    <a href="#" class="btn btnDeleteRec3SIS delete" id="'.$AcctType->BMATHUniqueId.'">Del
                        <i class="far fa-trash-alt fa-xs"></i>
                    </a>';
            // <a href="#" class="btn btn-outline-danger mr-1 btn-sm delete" id="'.$AcctType->BMATHUniqueId.'">Delete</a>';
        })
        ->make(true);
    }
    function Fetchdata(Request $request)
    {
        $fethchedData = $this->actFethchEditedDataTrait($request);
        echo json_encode($fethchedData);
    }
    function Postdata(Request $request)
    {       
      
        if($request->get('button_action') == 'insert')
        {
            $validator = Validator::make($request->all(), [
                'BMATHAcctId' =>  'required|min:2|max:10||unique:t05902l03,BMATHAcctId',
                'BMATHDesc1'  => 'required|max:100',
                'BMATHDesc2'  => 'max:200',
                'BMATHBiDesc'  => 'max:100',
            ]);
        }
        else
        {
            $validator = Validator::make($request->all(), [
                'BMATHAcctId' => 'required',
                'BMATHDesc1'  => 'required',
                'BMATHDesc2'  => 'max:200',
                'BMATHBiDesc'  => 'max:100',

            ]);
        }
        if(!$validator->passes()){
            return response()->json(['status'=>0, 'error'=>$validator->errors()->toArray()]);
        }
        else{     
            // When add button is pushed
            if($request->get('button_action') == 'insert')
            {
                $this->actAddUpdateTrait($request);
                //********************************************************** */
                return response()->json(['status'=>1, 'Id'=>$request->get('BMATHAcctId'), 
                    'Desc1'=>'',
                    'masterName'=>'AcctType ', 'updateMode'=>'Added']); 
            }
            // When edit button is pushed
            if($request->get('button_action') == 'update')
            {           
                $this->actAddUpdateTrait($request);              
                return response()->json(['status'=>1, 'Id'=>$request->get('BMATHAcctId'), 
                    'Desc1'=>'', 'masterName'=>'AcctType ', 'updateMode'=>'Updated']);      
            }           
                   
        }
    }
    function DeleteData(Request $request)
    {
        $AcctTypeId = $this->actDeleteRecordTrait($request);
        return response()->json(['status'=>1, 'Id'=>$AcctTypeId, 
            'Desc1'=>'', 'masterName'=>'AcctType ', 'updateMode'=>'Deleted']);         
    }
    
    function BrowserDeletedRecords()
    {
        //Eloquent way - Model is must 
        $browserDeletedRecords = $this->actBrowserDeletedRecordsTrait(); 
        return DataTables::of($browserDeletedRecords)
        ->addColumn('action', function($DeletedAcctType){
            return '<a href="#" class="btn mr-1 btnEditRec3SIS restore" id="'.$DeletedAcctType->BMATHUniqueId.'">Restore
                        <i class="fas fa-trash-restore"></i>
                    </a>';
        })
        ->make(true);
    } 
    function RestoreDeletedRecord(Request $request)
    {                    
        $AcctTypeId = $this->actUnDeleteRecordTrait($request);
        return response()->json(['status'=>1, 'Id'=>$AcctTypeId, 
        'Desc1'=>'', 'masterName'=>'AcctType ', 'updateMode'=>'Restored']); 
    } 
}


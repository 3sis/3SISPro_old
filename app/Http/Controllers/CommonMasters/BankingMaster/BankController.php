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
use App\Models\CommonMasters\BankingMaster\BankName;
use App\Traits\CommonMasters\BankingMaster\BankDbOperations;
use App\Traits\TablesSchema3SIS\tablesSchema3SIS;

class BankController extends Controller
{
    use BankDbOperations, tablesSchema3SIS;
    function Index()
    { 
        $data = $this->dataTableXLSchemaTrait();
        return view('CommonMasters.BankingMaster.bank')->with($data);
    }
    function BrowserData()
    {
        //Eloquent way - Model is must 
        $BrowserDataTable = $this->bknBrowserDataTrait();        
        return DataTables::of($BrowserDataTable)
        
        ->addColumn('action', function($BankName){
            return '<a href="#" class="btn mr-1 btnEditRec3SIS edit" id="'.$BankName->BMBNHUniqueId.'">Edit
                        <i class="fas fa-edit fa-xs"></i>
                    </a>
                    <a href="#" class="btn btnDeleteRec3SIS delete" id="'.$BankName->BMBNHUniqueId.'">Del
                        <i class="far fa-trash-alt fa-xs"></i>
                    </a>';
        })
        ->make(true);
    }
    function Fetchdata(Request $request)
    {
        $fethchedData = $this->bknFethchEditedDataTrait($request);
        echo json_encode($fethchedData);
    }
    function Postdata(Request $request)
    {
        // echo 'Data Submitted.';
        // return $request->input();
        // die(); 
        if($request->get('button_action') == 'insert')
        {
            $validator = Validator::make($request->all(), [
                'BMBNHBankId' =>  'required|min:2|max:10||unique:t05902l01,BMBNHBankId',
                'BMBNHDesc1'  => 'required|max:100',
                'BMBNHDesc2'  => 'max:200',
                'BMBNHBiDesc'  => 'max:100',
            ]);
        }
        else
        {
            $validator = Validator::make($request->all(), [
                'BMBNHBankId' => 'required',
                'BMBNHDesc1'  => 'required',
                'BMBNHDesc2'  => 'max:200',
                'BMBNHBiDesc'  => 'max:100',

            ]);
        }
        if(!$validator->passes()){
            return response()->json(['status'=>0, 'error'=>$validator->errors()->toArray()]);
        }
        else{     
            // When add button is pushed
            if($request->get('button_action') == 'insert')
            {
                $this->bknAddUpdateTrait($request);
                //********************************************************** */
                return response()->json(['status'=>1, 'Id'=>$request->get('BMBNHBankId'), 
                    'Desc1'=>'',
                    'masterName'=>'Bank ', 'updateMode'=>'Added']); 
            }
            // When edit button is pushed
            if($request->get('button_action') == 'update')
            {           
                $this->bknAddUpdateTrait($request);              
                return response()->json(['status'=>1, 'Id'=>$request->get('BMBNHBankId'), 
                    'Desc1'=>'', 'masterName'=>'Bank ', 'updateMode'=>'Updated']);      
            }           
                   
        }
    }
    function DeleteData(Request $request)
    {
        $BankNameId = $this->bknDeleteRecordTrait($request);
        return response()->json(['status'=>1, 'Id'=>$BankNameId, 
            'Desc1'=>'', 'masterName'=>'Bank ', 'updateMode'=>'Deleted']);         
    }
    
    function BrowserDeletedRecords()
    {
        //Eloquent way - Model is must 
        $browserDeletedRecords = $this->bknBrowserDeletedRecordsTrait(); 
        return DataTables::of($browserDeletedRecords)
        ->addColumn('action', function($DeletedBankName){
            return '<a href="#" class="btn mr-1 btnEditRec3SIS restore" id="'.$DeletedBankName->BMBNHUniqueId.'">Restore
                        <i class="fas fa-trash-restore"></i>
                    </a>';
        })
        ->make(true);
    } 
    function RestoreDeletedRecord(Request $request)
    {                    
        $BankNameId = $this->bknUnDeleteRecordTrait($request);
        return response()->json(['status'=>1, 'Id'=>$BankNameId, 
        'Desc1'=>'', 'masterName'=>'Bank ', 'updateMode'=>'Restored']); 
    } 
}


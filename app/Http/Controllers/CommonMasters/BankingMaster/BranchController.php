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
use App\Models\CommonMasters\BankingMaster\Branch;
use App\Traits\CommonMasters\BankingMaster\branchDbOperations;
use App\Traits\DropDown3SIS\dropDowns3SIS;
use App\Traits\TablesSchema3SIS\tablesSchema3SIS;

class BranchController extends Controller
{
    use branchDbOperations, dropDowns3SIS, tablesSchema3SIS;
    function Index()
    { 
        $data = $this->dataTableXLSchemaTrait();
        return view('CommonMasters.BankingMaster.branch')->with($data);
    }
    function BrowserData()
    {
        //Eloquent way - Model is must 
        $BrowserDataTable = $this->bknBrowserDataTrait();        
        return DataTables::of($BrowserDataTable)
        
        ->addColumn('action', function($Branch){
            return '<a href="#" class="btn mr-1 btnEditRec3SIS edit" id="'.$Branch->BMBRHUniqueId.'">Edit
                        <i class="fas fa-edit fa-xs"></i>
                    </a>
                    <a href="#" class="btn btnDeleteRec3SIS delete" id="'.$Branch->BMBRHUniqueId.'">Del
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
      
        if($request->get('button_action') == 'insert')
        {
            $validator = Validator::make($request->all(), [
                'BMBRHBranchId' =>  'required|min:2|max:10||unique:t05902l02,BMBRHBranchId',
                'BMBRHDesc1'  => 'required|max:100',
                'BMBRHDesc2'  => 'max:200',
                'BMBRHBiDesc'  => 'max:100',
                'bankId'    => 'required',
            ]);
        }
        else
        {
            $validator = Validator::make($request->all(), [
                'BMBRHBranchId' => 'required',
                'BMBRHDesc1'  => 'required',
                'BMBRHDesc2'  => 'max:200',
                'BMBRHBiDesc'  => 'max:100',
                'bankId'    => 'required',

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
                return response()->json(['status'=>1, 'Id'=>$request->get('BMBRHBranchId'), 
                    'Desc1'=>'',
                    'masterName'=>'Bank ', 'updateMode'=>'Added']); 
            }
            // When edit button is pushed
            if($request->get('button_action') == 'update')
            {           
                $this->bknAddUpdateTrait($request);              
                return response()->json(['status'=>1, 'Id'=>$request->get('BMBRHBranchId'), 
                    'Desc1'=>'', 'masterName'=>'Bank ', 'updateMode'=>'Updated']);      
            }           
                   
        }
    }
    function DeleteData(Request $request)
    {
        $BranchId = $this->bknDeleteRecordTrait($request);
        return response()->json(['status'=>1, 'Id'=>$BranchId, 
            'Desc1'=>'', 'masterName'=>'Bank ', 'updateMode'=>'Deleted']);         
    }
    public function GetBank(Request $request)
    {  
        $searchText = $request->search;
        $select2Data = $this->bankDropDownTrait($searchText);
        $response = array();
        foreach($select2Data as $result){
            $response[] = array(
                    "id"    =>  $result->BMBNHBankId,
                    "text"  =>  $result->BMBNHDesc1
            );
        }
        return response()->json($response);       
        
    }
    public function GetSelectedBank(Request $request)
    {

        $bankId = $request->input('id');
        $fetchData = BankName::select(
            'BMBNHBankId',
            'BMBNHDesc1')
            ->where('BMBNHBankId', $bankId)
            ->get();
        
        $response = array();
        foreach($fetchData as $result){
            $response[] = array(
                    "id"    =>  $result->BMBNHBankId,
                    "text"  =>  $result->BMBNHDesc1
            );
        }

        return response()->json($response);        
    }
    function BrowserDeletedRecords()
    {
        //Eloquent way - Model is must 
        $browserDeletedRecords = $this->bknBrowserDeletedRecordsTrait(); 
        return DataTables::of($browserDeletedRecords)
        ->addColumn('action', function($DeletedBank){
            return '<a href="#" class="btn mr-1 btnEditRec3SIS restore" id="'.$DeletedBank->BMBRHUniqueId.'">Restore
                        <i class="fas fa-trash-restore"></i>
                    </a>';
        })
        ->make(true);
    } 
    function RestoreDeletedRecord(Request $request)
    {                    
        $BranchId = $this->bknUnDeleteRecordTrait($request);
        return response()->json(['status'=>1, 'Id'=>$BranchId, 
        'Desc1'=>'', 'masterName'=>'Bank ', 'updateMode'=>'Restored']); 
    } 
}

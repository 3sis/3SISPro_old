<?php

namespace App\Http\Controllers\CommonMasters\GeographicInfo;

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
use App\Models\CommonMasters\GeographicInfo\State;
use App\Traits\CommonMasters\GeographicInfo\stateDbOperations;
use App\Traits\DropDown3SIS\dropDowns3SIS;
use App\Traits\TablesSchema3SIS\tablesSchema3SIS;

class StateController extends Controller
{
    use stateDbOperations, dropDowns3SIS, tablesSchema3SIS;
    function Index()
    { 
        $data = $this->dataTableXLSchemaTrait();
        return view('CommonMasters.GeographicInfo.state')->with($data);
    }
    function BrowserData()
    {
        //Eloquent way - Model is must 
        $BrowserDataTable = $this->stmBrowserDataTrait();        
        return DataTables::of($BrowserDataTable)
        
        ->addColumn('action', function($State){
            return '<a href="#" class="btn mr-1 btnEditRec3SIS edit" id="'.$State->GMSMHUniqueId.'">Edit
                        <i class="fas fa-edit fa-xs"></i>
                    </a>
                    <a href="#" class="btn btnDeleteRec3SIS delete" id="'.$State->GMSMHUniqueId.'">Del
                        <i class="far fa-trash-alt fa-xs"></i>
                    </a>';
            // <a href="#" class="btn btn-outline-danger mr-1 btn-sm delete" id="'.$State->GMSMHUniqueId.'">Delete</a>';
        })
        ->make(true);
    }
    function Postdata(Request $request)
    {       
      
        if($request->get('button_action') == 'insert')
        {
            $validator = Validator::make($request->all(), [
                'GMSMHStateId' =>  'required|min:2|max:10||unique:t05901l04,GMSMHStateId',
                'GMSMHDesc1'  => 'required|max:100',
                'GMSMHDesc2'  => 'max:200',
                'GMSMHBiDesc'  => 'max:100',
                'countryId'    => 'required',
            ]);
        }
        else
        {
            $validator = Validator::make($request->all(), [
                'GMSMHStateId' => 'required',
                'GMSMHDesc1'  => 'required',
                'GMSMHDesc2'  => 'max:200',
                'GMSMHBiDesc'  => 'max:100',
                'countryId'    => 'required',

            ]);
        }
        if(!$validator->passes()){
            return response()->json(['status'=>0, 'error'=>$validator->errors()->toArray()]);
        }
        else{     
            // When add button is pushed
            if($request->get('button_action') == 'insert')
            {
                $this->stmAddUpdateTrait($request);
                //********************************************************** */
                return response()->json(['status'=>1, 'Id'=>$request->get('GMSMHStateId'), 
                    'Desc1'=>'',
                    'masterName'=>'State ', 'updateMode'=>'Added']); 
            }
            // When edit button is pushed
            if($request->get('button_action') == 'update')
            {           
                $this->stmAddUpdateTrait($request);              
                return response()->json(['status'=>1, 'Id'=>$request->get('GMSMHStateId'), 
                    'Desc1'=>'', 'masterName'=>'State ', 'updateMode'=>'Updated']);      
            }           
                   
        }
    }
    function Fetchdata(Request $request)
    {
        $fethchedData = $this->stmFethchEditedDataTrait($request);
        echo json_encode($fethchedData);
    }    
    function DeleteData(Request $request)
    {
        $StateId = $this->stmDeleteRecordTrait($request);
        return response()->json(['status'=>1, 'Id'=>$StateId, 
            'Desc1'=>'', 'masterName'=>'State ', 'updateMode'=>'Deleted']);         
    }
    public function GetCountry(Request $request)
    {  
        $searchText = $request->search;
        $select2Data = $this->countryDropDownTrait($searchText);
        $response = array();
        foreach($select2Data as $result){
            $response[] = array(
                    "id"    =>  $result->GMCMHCountryId,
                    "text"  =>  $result->GMCMHDesc1
            );
        }
        return response()->json($response);       
        
    }
    public function GetSelectedCountry(Request $request)
    {

        $countryId = $request->input('id');
        $fetchData = Country::select(
            'GMCMHCountryId',
            'GMCMHDesc1')
            ->where('GMCMHCountryId', $countryId)
            ->get();
        
        $response = array();
        foreach($fetchData as $result){
            $response[] = array(
                    "id"    =>  $result->GMCMHCountryId,
                    "text"  =>  $result->GMCMHDesc1
            );
        }

        return response()->json($response);        
    }
    function BrowserDeletedRecords()
    {
        //Eloquent way - Model is must 
        $browserDeletedRecords = $this->stmBrowserDeletedRecordsTrait(); 
        return DataTables::of($browserDeletedRecords)
        ->addColumn('action', function($DeletedState){
            return '<a href="#" class="btn mr-1 btnEditRec3SIS restore" id="'.$DeletedState->GMSMHUniqueId.'">Restore
                        <i class="fas fa-trash-restore"></i>
                    </a>';
        })
        ->make(true);
    } 
    function RestoreDeletedRecord(Request $request)
    {                    
        $StateId = $this->stmUnDeleteRecordTrait($request);
        return response()->json(['status'=>1, 'Id'=>$StateId, 
        'Desc1'=>'', 'masterName'=>'State ', 'updateMode'=>'Restored']); 
    } 
}


<?php

namespace App\Http\Controllers\CommonMasters\GeographicInfo;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Carbon;
use Auth;
use Validator;
// Add Model here
use App\Models\CommonMasters\GeographicInfo\City;
use App\Models\CommonMasters\GeographicInfo\State;
use DataTables;
use Illuminate\Support\Facades\DB;
use App\Traits\CommonMasters\GeographicInfo\cityDbOperations;
use App\Traits\DropDown3SIS\dropDowns3SIS;
use App\Traits\TablesSchema3SIS\tablesSchema3SIS;

class CityController extends Controller
{
    use cityDbOperations, dropDowns3SIS, tablesSchema3SIS;
    function Index()
    { 
        $data = $this->dataTableXLSchemaTrait();
        return view('CommonMasters.GeographicInfo.city')->with($data);
    }
    function browserData()
    {
        //Eloquent way - Model is must 
        $BrowserDataTable = $this->ctmBrowserDataTrait();
        return DataTables::of($BrowserDataTable)
        ->addColumn('action', function($city){
            return '<a href="#" class="btn mr-1 btnEditRec3SIS edit" id="'.$city->GMCTHUniqueId.'">Edit
                        <i class="fas fa-edit fa-xs"></i>
                    </a>
                     <a href="#" class="btn btnDeleteRec3SIS delete" id="'.$city->GMCTHUniqueId.'">Delete
                        <i class="far fa-trash-alt fa-xs"></i>
                     </a>';
        })
        ->make(true);
    } 
    function fetchData(Request $request)
    {
        $fethchedData = $this->ctmFethchEditedDataTrait($request);
        echo json_encode($fethchedData);
    }
    function postData(Request $request)
    {
        //echo 'Data Submitted.';
        // return $request->input();
        if($request->get('button_action') == 'insert')
        {
            $validator = Validator::make($request->all(), [
                'GMCTHCityId' => 'required|min:2|unique:t05901l05,GMCTHCityId',
                'GMCTHDesc1'  =>'required|max:100',
                // 'GMCTHStateId'  =>'required',
            ],
        );
        }
        else
        {
            $validator = Validator::make($request->all(), [
                'GMCTHCityId' => 'required',
                'GMCTHDesc1'  =>'required|max:100',
            ],
        );
        }

        if(!$validator->passes()){
            return response()->json(['status'=>0, 'error'=>$validator->errors()->toArray()]);
        }
        else{
            // When add button is pushed
            if($request->get('button_action') == 'insert')
            {
                $UniqueId = $this->ctmAddUpdateTrait($request);
                return response()->json(['status'=>1, 'Id'=>$request->get('GMCTHCityId'), 'Desc1'=>$request->get('GMCTHDesc1'),
                'masterName'=>'city ', 'updateMode'=>'Added']); 
            }
            // When edit button is pushed
            if($request->get('button_action') == 'update')
            {                
                //Eloquent Way
                $UniqueId = $this->ctmAddUpdateTrait($request);
                return response()->json(['status'=>1, 'Id'=>$request->get('GMCTHCityId'), 'Desc1'=>$request->get('GMCTHDesc1'),
                    'masterName'=>'city ', 'updateMode'=>'Updated']);           
            }
                   
        }
    }
    function deleteData(Request $request)
    {        
        $CityId = $this->ctmDeleteRecordTrait($request); 
        return response()->json(['status'=>1, 'Id'=>$CityId, 
            'Desc1'=>'', 'masterName'=>'City ', 'updateMode'=>'Deleted']);        
    }
    public function getState(Request $request)
    {
        $search = $request->search;

        if($search == ''){
            $fetchData = State::orderby('GMSMHDesc1','asc')
                ->select('GMSMHStateId','GMSMHDesc1')
                ->limit(5)
                ->get();
        }else
        {
            $fetchData = State::orderby('GMSMHDesc1','asc')
            ->select('GMSMHStateId','GMSMHDesc1')
            ->where('GMSMHDesc1', 'like', '%'.$search.'%')
            ->limit(5)
            ->get();
        }
        $response = array();
        foreach($fetchData as $result){
            $response[] = array(
                    "id"    =>  $result->GMSMHStateId,
                    "text"  =>  $result->GMSMHDesc1
            );
        }
        return response()->json($response);        
    }
    public function getCountry(Request $request){
        $stateId = $request->get('stateId');
        // echo 'Data Submitted';
        // return $request->input();
        // die();
        $countryDesc = State::join('t05901L03', 't05901L03.GMCMHCountryId', '=', 
        't05901L04.GMSMHCountryId')
        ->where('t05901L04.GMSMHStateId', $stateId)
        ->get(['t05901L03.GMCMHDesc1',]);
        echo $countryDesc[0]->GMCMHDesc1;
    }
    function BrowserDeletedRecords()
    {
        //Eloquent way - Model is must
        $browserDeletedRecords = $this->ctmBrowserDeletedRecordsTrait();          
        return DataTables::of($browserDeletedRecords)
        ->addColumn('action', function($DeletedLocation){
            return '<a href="#" class="btn mr-1 btnEditRec3SIS restore" id="'.$DeletedLocation->GMCTHUniqueId.'">Restore
                        <i class="fas fa-trash-restore"></i>
                    </a>';
        })
        ->make(true);
    } 
    function RestoreDeletedRecord(Request $request)
    {
        $CityId = $this->ctmUnDeleteRecordTrait($request);
        return response()->json(['status'=>1, 'Id'=>$CityId, 
            'Desc1'=>'', 'masterName'=>'Location ', 'updateMode'=>'Restored']);        
    }
     
     
}

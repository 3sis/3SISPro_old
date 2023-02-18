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
// use App\Models\CommonMasters\GeographicInfo\City;
// use App\Models\CommonMasters\GeographicInfo\Location;
use App\Traits\CommonMasters\GeographicInfo\locationDbOperations;
use App\Traits\DropDown3SIS\dropDowns3SIS;
use App\Traits\TablesSchema3SIS\tablesSchema3SIS;
use App\Traits\GetDescriptions3SIS\getDescriptions3SIS;

class LocationController extends Controller

{
    use locationDbOperations, dropDowns3SIS, tablesSchema3SIS,getDescriptions3SIS;
    protected  $gCompanyId = '1000';
    function Index()
    {         
        $data = $this->dataTableXLSchemaTrait();
        return view('CommonMasters.GeographicInfo.location')->with($data);
    } 
    function BrowserData()
    {
        //Eloquent way - Model is must
        $BrowserDataTable = $this->lomBrowserDataTrait();        
        return DataTables::of($BrowserDataTable)
        ->addColumn('action', function($Location){
            return '<a href="#" class="btn mr-1 btnEditRec3SIS edit" id="'.$Location->GMLMHUniqueId.'">Edit
                        <i class="fas fa-edit fa-xs"></i>
                    </a>
                    <a href="#" class="btn btnDeleteRec3SIS delete" id="'.$Location->GMLMHUniqueId.'">Del
                        <i class="far fa-trash-alt fa-xs"></i>
                    </a>';
        })
        ->make(true);
    } 
    function Fetchdata(Request $request)
    {
        $fethchedData = $this->lomFethchEditedDataTrait($request);
        echo json_encode($fethchedData);
    }
    function Postdata(Request $request)
    {
        // echo 'Data Submitted.';
        // return $request->input();
        // die();         
        $request->merge(['GMLMHCompanyId' => $this->gCompanyId]);

        if($request->get('button_action') == 'insert')
        {
            $validator = Validator::make($request->all(), [
                'GMLMHLocationId' =>  'required|max:10||unique:t05901l06,GMLMHLocationId',
                'cityId'         => 'required',               
                'GMLMHDesc1'     => 'required|max:100',
                'GMLMHDesc2'     => 'max:200',
                'GMLMHBiDesc'    => 'max:100',
            ]);
        }
        else
        {
            $validator = Validator::make($request->all(), [                
                'cityId'         => 'required',
                'GMLMHDesc1'     => 'required|max:100',
                'GMLMHDesc2'     => 'max:200',
                'GMLMHBiDesc'    => 'max:100',
            ]);
        }
        if(!$validator->passes()){
            return response()->json(['status'=>0, 'error'=>$validator->errors()->toArray()]);

        }
        else{   
            // When add button is pushed
            if($request->get('button_action') == 'insert')
            {
                $UniqueId = $this->lomAddUpdateTrait($request);
                return response()->json(['status'=>1, 'Id'=>$request->get('GMLMHLocationId'), 
                    'Desc1'=>'',
                    'masterName'=>'Location ', 'updateMode'=>'Added']);                 
            }
            // When edit button is pushed
            if($request->get('button_action') == 'update')
            {  
                $UniqueId = $this->lomAddUpdateTrait($request);
                return response()->json(['status'=>1, 'Id'=>$request->get('GMLMHLocationId'), 
                    'Desc1'=>'', 'masterName'=>'Location ', 'updateMode'=>'Updated']);   
            }
                   
        }
    }
    function DeleteData(Request $request)
    {
        $LocationId = $this->lomDeleteRecordTrait($request);
        return response()->json(['status'=>1, 'Id'=>$LocationId, 
            'Desc1'=>'', 'masterName'=>'Location ', 'updateMode'=>'Deleted']);        
    }
    // public function GetSelectedCity(Request $request)
    // {

    //     $cityId = $request->input('id');
    //     $fetchData = City::select(
    //         'GMCTHCityId',
    //         'GMCTHDesc1')
    //         ->where('GMCTHCityId', $cityId)
    //         ->get();
        
    //     $response = array();
    //     foreach($fetchData as $result){
    //         $response[] = array(
    //                 "id"    =>  $result->GMCTHCityId,
    //                 "text"  =>  $result->GMCTHDesc1
    //         );
    //     }
    //     return response()->json($response);        
    // }
    function BrowserDeletedRecords()
    {
        //Eloquent way - Model is must
        $browserDeletedRecords = $this->lomBrowserDeletedRecordsTrait();          
        return DataTables::of($browserDeletedRecords)
        ->addColumn('action', function($DeletedLocation){
            return '<a href="#" class="btn mr-1 btnEditRec3SIS restore" id="'.$DeletedLocation->GMLMHUniqueId.'">Restore
                        <i class="fas fa-trash-restore"></i>
                    </a>';
        })
        ->make(true);
    } 
    function RestoreDeletedRecord(Request $request)
    {
        $LocationId = $this->lomUnDeleteRecordTrait($request);
        return response()->json(['status'=>1, 'Id'=>$LocationId, 
            'Desc1'=>'', 'masterName'=>'Location ', 'updateMode'=>'Restored']);        
    }
    public function GetGeoDesc(Request $request){        
        $StateCountryDesc = $this->getStateCountryDescTrait($request); 
        return response()->json([
            'stateId'=>$StateCountryDesc[0]->GMSMHStateId, 
            'stateDesc1'=>$StateCountryDesc[0]->GMSMHDesc1, 
            'countryId'=>$StateCountryDesc[0]->GMCMHCountryId, 
            'countryDesc1'=>$StateCountryDesc[0]->GMCMHDesc1
        ]);
    }
}
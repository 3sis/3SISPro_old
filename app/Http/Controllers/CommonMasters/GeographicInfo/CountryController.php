<?php

namespace App\Http\Controllers\CommonMasters\GeographicInfo;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Carbon;
use Auth;
use Validator;
// Add Model here
use App\Models\CommonMasters\GeographicInfo\Country;
use DataTables;
use App\Traits\CommonMasters\GeographicInfo\countryDbOperations;
use App\Traits\TablesSchema3SIS\tablesSchema3SIS;

class CountryController extends Controller
{
    use countryDbOperations, tablesSchema3SIS;
    function Index()
    { 
        $data = $this->dataTableXLSchemaTrait();
        return view('CommonMasters.GeographicInfo.country')->with($data);
    }
    function BrowserData()
    {
        //Eloquent way - Model is must
        $BrowserDataTable = $this->gicmBrowserDataTrait();
        return DataTables::of($BrowserDataTable)
        ->addColumn('action', function($country){
            return '<a href="#" class="btn mr-1 btnEditRec3SIS edit" id="'.$country->GMCMHUniqueId.'">Edit
                        <i class="fas fa-edit fa-xs"></i>
                    </a>
                    <a href="#" class="btn btnDeleteRec3SIS delete" id="'.$country->GMCMHUniqueId.'">Del
                        <i class="far fa-trash-alt fa-xs"></i>
                    </a>';
            // <a href="#" class="btn btn-outline-danger mr-1 btn-sm delete" id="'.$country->GMCMHUniqueId.'">Delete</a>';
        })
        ->make(true);
    }
    function Postdata(Request $request)
    {
        //echo 'Data Submitted.';
        // return $request->input();
        if($request->get('button_action') == 'insert')
        {
            $validator = Validator::make($request->all(), [
                'GMCMHCountryId' =>  'required|min:2|max:10||unique:t05901l03,GMCMHCountryId',
                'GMCMHDesc1'  => 'required|max:100',
                'GMCMHDesc2'  => 'max:200',
                'GMCMHBiDesc'  => 'max:100',
            ]);
        }
        else
        {
            $validator = Validator::make($request->all(), [
                'GMCMHCountryId' => 'required',
                'GMCMHDesc1'  => 'required',
                'GMCMHDesc2'  => 'max:200',
                'GMCMHBiDesc'  => 'max:100',
            ]);
        }
        

        if(!$validator->passes()){
            return response()->json(['status'=>0, 'error'=>$validator->errors()->toArray()]);
        }
        else{
            // When add button is pushed
            if($request->get('button_action') == 'insert')
            {
                $this->gicmAddUpdateTrait($request);
                return response()->json(['status'=>1, 'Id'=>$request->get('GMCMHCountryId'), 'Desc1'=>$request->get('GMCMHDesc1'),
                'masterName'=>'Country ', 'updateMode'=>'Added']); 
            }
            // When edit button is pushed
            if($request->get('button_action') == 'update')
            {
                $this->gicmAddUpdateTrait($request);
                return response()->json(['status'=>1, 'Id'=>$request->get('GMCMHCountryId'), 'Desc1'=>$request->get('GMCMHDesc1'),
                    'masterName'=>'Country ', 'updateMode'=>'Updated']);           
            }
                   
        }
    } 
    function Fetchdata(Request $request)
    {
        $fethchedData = $this->gicmFethchEditedDataTrait($request);
        echo json_encode($fethchedData);
    }    
    function DeleteData(Request $request)
    {
        $Id = $this->gicmDeleteRecordTrait($request);
        return response()->json(['status'=>1, 'Id'=>$Id, 
        'Desc1'=>'','masterName'=>'Country ', 'updateMode'=>'Deleted']); 
    }
    function BrowserDeletedRecords()
    {
        //Eloquent way - Model is must 
        $browserDeletedRecords = $this->gicmBrowserDeletedRecordsTrait(); 
        return DataTables::of($browserDeletedRecords)
        ->addColumn('action', function($DeletedCountry){
            return '<a href="#" class="btn mr-1 btnEditRec3SIS restore" id="'.$DeletedCountry->GMCMHUniqueId.'">Restore
                        <i class="fas fa-trash-restore"></i>
                    </a>';
        })
        ->make(true);
    } 
    function RestoreDeletedRecord(Request $request)
    {                    
        $Id = $this->gicmUnDeleteRecordTrait($request);
        return response()->json(['status'=>1, 'Id'=>$Id, 
        'Desc1'=>'', 'masterName'=>'Country ', 'updateMode'=>'Restored']); 
    } 
}

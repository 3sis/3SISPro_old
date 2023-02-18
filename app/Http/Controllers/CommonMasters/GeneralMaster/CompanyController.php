<?php

namespace App\Http\Controllers\CommonMasters\GeneralMaster;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Auth;
use Validator;
// Add Model here
use App\Models\CommonMasters\GeneralMaster\Company;
use DataTables;
use App\Traits\TablesSchema3SIS\tablesSchema3SIS;
use App\Traits\CommonMasters\GeneralMaster\companyDbOperations;
use App\Traits\GetDescriptions3SIS\getDescriptions3SIS;


class CompanyController extends Controller
{
    use companyDbOperations, tablesSchema3SIS,getDescriptions3SIS;
    function Index()
    { 
        $data = $this->dataTableXLSchemaTrait();
        return view('CommonMasters.GeneralMaster.company')->with($data);
    }
    function BrowserData()
    {
        //Eloquent way - Model is must    
        $BrowserDataTable = $this->gmcmBrowserDataTrait();        
        return DataTables::of($BrowserDataTable)
        ->addColumn('action', function($company){
            return '<a href="#" class="btn mr-1 btnEditRec3SIS edit" id="'.$company->GMCOHUniqueId.'">Edit
                        <i class="fas fa-edit fa-xs"></i>
                    </a>
                    <a href="#" class="btn btnDeleteRec3SIS delete" id="'.$company->GMCOHUniqueId.'">Delete
                        <i class="far fa-trash-alt fa-xs"></i>
                    </a>';
            // <a href="#" class="btn btn-outline-danger mr-1 btn-sm delete" id="'.$country->GMCOHUniqueId.'">Delete</a>';
        })
        ->make(true);
    }
    function PostData(Request $request)
    {
        // echo 'Data Submitted.';
        // return $request->input();
        if($request->get('button_action') == 'insert')
        {
            $validator = Validator::make($request->all(), [
                'GMCOHCompanyId'    =>  'required|min:2|max:10||unique:t05901l01,GMCOHCompanyId',
                'currenyId'    => 'required',
                'GMCOHDesc1'        => 'required|max:100',
                'GMCOHDesc2'        => 'max:200',
                'GMCOHBiDesc'       => 'max:100',
                'GMCOHNickName'     => 'max:50',
            ]);
        }
        else
        {
            $validator = Validator::make($request->all(), [
                'GMCOHCompanyId'    => 'required',
                'currenyId'    => 'required',
                'GMCOHDesc1'        => 'required|max:100',
                'GMCOHDesc2'        => 'max:200',
                'GMCOHBiDesc'       => 'max:100',
                'GMCOHNickName'     => 'max:50',
            ]);
        }
        

        if(!$validator->passes()){
            return response()->json(['status'=>0, 'error'=>$validator->errors()->toArray()]);
        }
        else{            
            // When add button is pushed
            if($request->get('button_action') == 'insert')
            {
                $this->gmcmAddUpdateTrait($request);
                return response()->json(['status'=>1, 'Id'=>$request->get('GMCOHCompanyId'), 'Desc1'=>$request->get('GMCOHDesc1'),
                'masterName'=>'Company ', 'updateMode'=>'Added']); 
            }
            // When edit button is pushed
            if($request->get('button_action') == 'update')
            {
                $this->gmcmAddUpdateTrait($request);
                return response()->json(['status'=>1, 'Id'=>$request->get('GMCOHCompanyId'), 'Desc1'=>$request->get('GMCOHDesc1'),
                    'masterName'=>'Company ', 'updateMode'=>'Updated']);           
            }
                   
        }
    }
    function Fetchdata(Request $request)
    {
        $fethchedData = $this->gmcmFethchEditedDataTrait($request);
        echo json_encode($fethchedData);
    }
    function DeleteData(Request $request)
    {
        $Id = $this->gmcmDeleteRecordTrait($request);
        return response()->json(['status'=>1, 'Id'=>$Id, 
        'Desc1'=>'','masterName'=>'Country ', 'updateMode'=>'Deleted']); 
    }
    function BrowserDeletedRecords()
    {
        //Eloquent way - Model is must 
        $browserDeletedRecords = $this->gmcmBrowserDeletedRecordsTrait(); 
        return DataTables::of($browserDeletedRecords)
        ->addColumn('action', function($DeletedCountry){
            return '<a href="#" class="btn mr-1 btnEditRec3SIS restore" id="'.$DeletedCountry->GMCOHUniqueId.'">Restore
                        <i class="fas fa-trash-restore"></i>
                    </a>';
        })
        ->make(true);
    }
    function RestoreDeletedRecord(Request $request)
    {                    
        $Id = $this->gmcmUnDeleteRecordTrait($request);
        return response()->json(['status'=>1, 'Id'=>$Id, 
        'Desc1'=>'', 'masterName'=>'Company ', 'updateMode'=>'Restored']); 
    } 
}
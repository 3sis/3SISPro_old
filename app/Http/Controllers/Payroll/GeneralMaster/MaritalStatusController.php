<?php

namespace App\Http\Controllers\Payroll\GeneralMaster;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
// Utilities
use Illuminate\Support\Carbon;
use Auth;
use Validator;
use DataTables;
// Traits
use App\Traits\Payroll\GeneralMaster\maritalStatusDbOperations;
use App\Traits\TablesSchema3SIS\tablesSchema3SIS;
class MaritalStatusController extends Controller
{
    use maritalStatusDbOperations, tablesSchema3SIS;
    function Index()
    { 
        $data = $this->dataTableXLSchemaTrait();
        return view('Payroll.GeneralMaster.maritalStatus')->with($data);
    }
    function BrowserData()
    {
        //Eloquent way - Model is must
        $BrowserDataTable = $this->gmms11BrowserDataTrait();
            return DataTables::of($BrowserDataTable)
            ->addColumn('action', function($MaritalStatus){
                return '<a href="#" class="btn mr-1 btnEditRec3SIS edit" id="'.$MaritalStatus->GMMSHUniqueId.'">Edit
                            <i class="fas fa-edit fa-xs"></i>
                        </a>
                        <a href="#" class="btn btnDeleteRec3SIS delete" id="'.$MaritalStatus->GMMSHUniqueId.'">Del
                            <i class="far fa-trash-alt fa-xs"></i>
                        </a>';
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
                'GMMSHMaritalStatusId' =>  'required|max:10||unique:T11901L07,GMMSHMaritalStatusId',
                'GMMSHDesc1'  => 'required|max:100',
                'GMMSHDesc2'  => 'max:200',
                'GMMSHBiDesc'  => 'max:100',
            ]);
        }
        else
        {
            $validator = Validator::make($request->all(), [
                'GMMSHMaritalStatusId' => 'required',
                'GMMSHDesc1'  => 'required',
                'GMMSHDesc2'  => 'max:200',
                'GMMSHBiDesc'  => 'max:100',
            ]);
        }
        if(!$validator->passes()){
            return response()->json(['status'=>0, 'error'=>$validator->errors()->toArray()]);
        }
        else{
            $this->gmms11AddUpdateTrait($request);
            // When add button is pushed
            if($request->get('button_action') == 'insert')
            {                
                return response()->json(['status'=>1, 'Id'=>$request->get('GMMSHMaritalStatusId'), 'Desc1'=>$request->get('GMMSHDesc1'),
                'masterName'=>'MaritalStatus ', 'updateMode'=>'Added']); 
            }
            // When edit button is pushed
            if($request->get('button_action') == 'update')
            {
                return response()->json(['status'=>1, 'Id'=>$request->get('GMMSHMaritalStatusId'), 'Desc1'=>$request->get('GMMSHDesc1'),
                    'masterName'=>'MaritalStatus ', 'updateMode'=>'Updated']);           
            }
                   
        }
    } 
    function Fetchdata(Request $request)
    {
        $fethchedData = $this->gmms11FethchEditedDataTrait($request);
        echo json_encode($fethchedData);
    }    
    function DeleteData(Request $request)
    {
        $Id = $this->gmms11DeleteRecordTrait($request);
        return response()->json(['status'=>1, 'Id'=>$Id, 
        'Desc1'=>'','masterName'=>'MaritalStatus ', 'updateMode'=>'Deleted']); 
    }
    function BrowserDeletedRecords()
    {
        //Eloquent way - Model is must 
        $browserDeletedRecords = $this->gmms11BrowserDeletedRecordsTrait(); 
        return DataTables::of($browserDeletedRecords)
        ->addColumn('action', function($DeletedMaritalStatus){
            return '<a href="#" class="btn mr-1 btnEditRec3SIS restore" id="'.$DeletedMaritalStatus->GMMSHUniqueId.'">Restore
                        <i class="fas fa-trash-restore"></i>
                    </a>';
        })
        ->make(true);
    } 
    function RestoreDeletedRecord(Request $request)
    {                    
        $Id = $this->gmms11UnDeleteRecordTrait($request);
        return response()->json(['status'=>1, 'Id'=>$Id, 
        'Desc1'=>'', 'masterName'=>'MaritalStatus ', 'updateMode'=>'Restored']); 
    } 
}

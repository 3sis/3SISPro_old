<?php

namespace App\Http\Controllers\Payroll\GeneralMaster;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
// Utilities
use Illuminate\Support\Carbon;
use Auth;
use Validator;
use DataTables;
// Model
use App\Models\Payroll\GeneralMaster\Gender;
// Traits
use App\Traits\Payroll\GeneralMaster\genderDbOperations;
use App\Traits\TablesSchema3SIS\tablesSchema3SIS;

class GenderController extends Controller
{
    use genderDbOperations, tablesSchema3SIS;
    function Index()
    { 
        $data = $this->dataTableXLSchemaTrait();
        return view('Payroll.GeneralMaster.gender')->with($data);
    }
    function BrowserData()
    {
        //Eloquent way - Model is must
        $BrowserDataTable = $this->gmgd11BrowserDataTrait();
            return DataTables::of($BrowserDataTable)
            ->addColumn('action', function($Gender){
                return '<a href="#" class="btn mr-1 btnEditRec3SIS edit" id="'.$Gender->GMGDHUniqueId.'">Edit
                            <i class="fas fa-edit fa-xs"></i>
                        </a>
                        <a href="#" class="btn btnDeleteRec3SIS delete" id="'.$Gender->GMGDHUniqueId.'">Del
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
                'GMGDHGenderId' =>  'required|max:10||unique:T11901L02,GMGDHGenderId',
                'GMGDHDesc1'  => 'required|max:100',
                'GMGDHDesc2'  => 'max:200',
                'GMGDHBiDesc'  => 'max:100',
            ]);
        }
        else
        {
            $validator = Validator::make($request->all(), [
                'GMGDHGenderId' => 'required',
                'GMGDHDesc1'  => 'required',
                'GMGDHDesc2'  => 'max:200',
                'GMGDHBiDesc'  => 'max:100',
            ]);
        }
        if(!$validator->passes()){
            return response()->json(['status'=>0, 'error'=>$validator->errors()->toArray()]);
        }
        else{
            $this->gmgd11AddUpdateTrait($request);
            // When add button is pushed
            if($request->get('button_action') == 'insert')
            {                
                return response()->json(['status'=>1, 'Id'=>$request->get('GMGDHGenderId'), 'Desc1'=>$request->get('GMGDHDesc1'),
                'masterName'=>'Gender ', 'updateMode'=>'Added']); 
            }
            // When edit button is pushed
            if($request->get('button_action') == 'update')
            {
                return response()->json(['status'=>1, 'Id'=>$request->get('GMGDHGenderId'), 'Desc1'=>$request->get('GMGDHDesc1'),
                    'masterName'=>'Gender ', 'updateMode'=>'Updated']);           
            }
                   
        }
    } 
    function Fetchdata(Request $request)
    {
        $fethchedData = $this->gmgd11FethchEditedDataTrait($request);
        echo json_encode($fethchedData);
    }    
    function DeleteData(Request $request)
    {
        $Id = $this->gmgd11DeleteRecordTrait($request);
        return response()->json(['status'=>1, 'Id'=>$Id, 
        'Desc1'=>'','masterName'=>'Gender ', 'updateMode'=>'Deleted']); 
    }
    function BrowserDeletedRecords()
    {
        //Eloquent way - Model is must 
        $browserDeletedRecords = $this->gmgd11BrowserDeletedRecordsTrait(); 
        return DataTables::of($browserDeletedRecords)
        ->addColumn('action', function($DeletedGender){
            return '<a href="#" class="btn mr-1 btnEditRec3SIS restore" id="'.$DeletedGender->GMGDHUniqueId.'">Restore
                        <i class="fas fa-trash-restore"></i>
                    </a>';
        })
        ->make(true);
    } 
    function RestoreDeletedRecord(Request $request)
    {                    
        $Id = $this->gmgd11UnDeleteRecordTrait($request);
        return response()->json(['status'=>1, 'Id'=>$Id, 
        'Desc1'=>'', 'masterName'=>'Gender ', 'updateMode'=>'Restored']); 
    } 
}

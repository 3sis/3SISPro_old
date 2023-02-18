<?php

namespace App\Http\Controllers\Payroll\Credentials;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
// Utilities
use Illuminate\Support\Carbon;
use Auth;
use Validator;
use DataTables;
// Traits
use App\Traits\Payroll\Credentials\qualificationDbOperations;
use App\Traits\TablesSchema3SIS\tablesSchema3SIS;

class QualificationController extends Controller
{
    use qualificationDbOperations, tablesSchema3SIS;
    function Index()
    { 
        $data = $this->dataTableXLSchemaTrait();
        return view('Payroll.Credentials.qualification')->with($data);
    }
    function BrowserData()
    {
        //Eloquent way - Model is must
        $BrowserDataTable = $this->CMQUH11BrowserDataTrait();
            return DataTables::of($BrowserDataTable)
            ->addColumn('action', function($Qualification){
                return '<a href="#" class="btn mr-1 btnEditRec3SIS edit" id="'.$Qualification->CMQUHUniqueId.'">Edit
                            <i class="fas fa-edit fa-xs"></i>
                        </a>
                        <a href="#" class="btn btnDeleteRec3SIS delete" id="'.$Qualification->CMQUHUniqueId.'">Del
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
                'CMQUHDegreeId' =>  'required|max:10||unique:T11904l01,CMQUHDegreeId',
                'CMQUHDesc1'  => 'required|max:100',
                'CMQUHDesc2'  => 'max:200',
                'CMQUHBiDesc'  => 'max:100',
            ]);
        }
        else
        {
            $validator = Validator::make($request->all(), [
                'CMQUHDegreeId' => 'required',
                'CMQUHDesc1'  => 'required',
                'CMQUHDesc2'  => 'max:200',
                'CMQUHBiDesc'  => 'max:100',
            ]);
        }
        if(!$validator->passes()){
            return response()->json(['status'=>0, 'error'=>$validator->errors()->toArray()]);
        }
        else{
            $this->CMQUH11AddUpdateTrait($request);
            // When add button is pushed
            if($request->get('button_action') == 'insert')
            {                
                return response()->json(['status'=>1, 'Id'=>$request->get('CMQUHDegreeId'), 'Desc1'=>$request->get('CMQUHDesc1'),
                'masterName'=>'Qualification ', 'updateMode'=>'Added']); 
            }
            // When edit button is pushed
            if($request->get('button_action') == 'update')
            {
                return response()->json(['status'=>1, 'Id'=>$request->get('CMQUHDegreeId'), 'Desc1'=>$request->get('CMQUHDesc1'),
                    'masterName'=>'Qualification ', 'updateMode'=>'Updated']);           
            }
                   
        }
    } 
    function Fetchdata(Request $request)
    {
        $fethchedData = $this->CMQUH11FethchEditedDataTrait($request);
        echo json_encode($fethchedData);
    }    
    function DeleteData(Request $request)
    {
        $Id = $this->CMQUH11DeleteRecordTrait($request);
        return response()->json(['status'=>1, 'Id'=>$Id, 
        'Desc1'=>'','masterName'=>'Qualification ', 'updateMode'=>'Deleted']); 
    }
    function BrowserDeletedRecords()
    {
        //Eloquent way - Model is must 
        $browserDeletedRecords = $this->CMQUH11BrowserDeletedRecordsTrait(); 
        return DataTables::of($browserDeletedRecords)
        ->addColumn('action', function($DeletedQualification){
            return '<a href="#" class="btn mr-1 btnEditRec3SIS restore" id="'.$DeletedQualification->CMQUHUniqueId.'">Restore
                        <i class="fas fa-trash-restore"></i>
                    </a>';
        })
        ->make(true);
    } 
    function RestoreDeletedRecord(Request $request)
    {                    
        $Id = $this->CMQUH11UnDeleteRecordTrait($request);
        return response()->json(['status'=>1, 'Id'=>$Id, 
        'Desc1'=>'', 'masterName'=>'Qualification ', 'updateMode'=>'Restored']); 
    } 
}

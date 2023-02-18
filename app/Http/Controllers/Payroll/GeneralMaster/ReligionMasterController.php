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
// use App\Models\Payroll\GeneralMaster\Religion;
// Traits
use App\Traits\Payroll\GeneralMaster\religionDbOperations;
use App\Traits\TablesSchema3SIS\tablesSchema3SIS;

class ReligionMasterController extends Controller
{
    use religionDbOperations, tablesSchema3SIS;
    function Index()
    { 
        $data = $this->dataTableXLSchemaTrait();
        return view('Payroll.GeneralMaster.religion')->with($data);
    }
    function BrowserData()
    {
        //Eloquent way - Model is must
        $BrowserDataTable = $this->gmrl11BrowserDataTrait();
            return DataTables::of($BrowserDataTable)
            ->addColumn('action', function($Religion){
                return '<a href="#" class="btn mr-1 btnEditRec3SIS edit" id="'.$Religion->GMRLHUniqueId.'">Edit
                            <i class="fas fa-edit fa-xs"></i>
                        </a>
                        <a href="#" class="btn btnDeleteRec3SIS delete" id="'.$Religion->GMRLHUniqueId.'">Del
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
                'GMRLHReligionId' =>  'required|max:10||unique:T11901L06,GMRLHReligionId',
                'GMRLHDesc1'  => 'required|max:100',
                'GMRLHDesc2'  => 'max:200',
                'GMRLHBiDesc'  => 'max:100',
            ]);
        }
        else
        {
            $validator = Validator::make($request->all(), [
                'GMRLHReligionId' => 'required',
                'GMRLHDesc1'  => 'required',
                'GMRLHDesc2'  => 'max:200',
                'GMRLHBiDesc'  => 'max:100',
            ]);
        }
        if(!$validator->passes()){
            return response()->json(['status'=>0, 'error'=>$validator->errors()->toArray()]);
        }
        else{
            $this->gmrl11AddUpdateTrait($request);
            // When add button is pushed
            if($request->get('button_action') == 'insert')
            {                
                return response()->json(['status'=>1, 'Id'=>$request->get('GMRLHReligionId'), 'Desc1'=>$request->get('GMRLHDesc1'),
                'masterName'=>'Religion ', 'updateMode'=>'Added']); 
            }
            // When edit button is pushed
            if($request->get('button_action') == 'update')
            {
                return response()->json(['status'=>1, 'Id'=>$request->get('GMRLHReligionId'), 'Desc1'=>$request->get('GMRLHDesc1'),
                    'masterName'=>'Religion ', 'updateMode'=>'Updated']);           
            }
                   
        }
    } 
    function Fetchdata(Request $request)
    {
        $fethchedData = $this->gmrl11FethchEditedDataTrait($request);
        echo json_encode($fethchedData);
    }    
    function DeleteData(Request $request)
    {
        $Id = $this->gmrl11DeleteRecordTrait($request);
        return response()->json(['status'=>1, 'Id'=>$Id, 
        'Desc1'=>'','masterName'=>'Religion ', 'updateMode'=>'Deleted']); 
    }
    function BrowserDeletedRecords()
    {
        //Eloquent way - Model is must 
        $browserDeletedRecords = $this->gmrl11BrowserDeletedRecordsTrait(); 
        return DataTables::of($browserDeletedRecords)
        ->addColumn('action', function($DeletedReligion){
            return '<a href="#" class="btn mr-1 btnEditRec3SIS restore" id="'.$DeletedReligion->GMRLHUniqueId.'">Restore
                        <i class="fas fa-trash-restore"></i>
                    </a>';
        })
        ->make(true);
    } 
    function RestoreDeletedRecord(Request $request)
    {                    
        $Id = $this->gmrl11UnDeleteRecordTrait($request);
        return response()->json(['status'=>1, 'Id'=>$Id, 
        'Desc1'=>'', 'masterName'=>'Religion ', 'updateMode'=>'Restored']); 
    } 
}

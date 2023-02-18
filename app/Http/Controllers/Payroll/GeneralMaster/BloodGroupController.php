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
use App\Models\Payroll\GeneralMaster\BloodGroup;
// Traits
use App\Traits\Payroll\GeneralMaster\bloodGroupDbOperations;
use App\Traits\TablesSchema3SIS\tablesSchema3SIS;

class BloodGroupController extends Controller
{
    use bloodGroupDbOperations, tablesSchema3SIS;
    function Index()
    { 
        $data = $this->dataTableXLSchemaTrait();
        return view('Payroll.GeneralMaster.bloodGroup')->with($data);
    }
    function BrowserData()
    {
        //Eloquent way - Model is must
        $BrowserDataTable = $this->gmbg11BrowserDataTrait();
            return DataTables::of($BrowserDataTable)
            ->addColumn('action', function($BloodGroup){
                return '<a href="#" class="btn mr-1 btnEditRec3SIS edit" id="'.$BloodGroup->GMBGHUniqueId.'">Edit
                            <i class="fas fa-edit fa-xs"></i>
                        </a>
                        <a href="#" class="btn btnDeleteRec3SIS delete" id="'.$BloodGroup->GMBGHUniqueId.'">Del
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
                'GMBGHBloodGroupId' =>  'required|max:10||unique:T11901L03,GMBGHBloodGroupId',
                'GMBGHDesc1'  => 'required|max:100',
                'GMBGHDesc2'  => 'max:200',
                'GMBGHBiDesc'  => 'max:100',
            ]);
        }
        else
        {
            $validator = Validator::make($request->all(), [
                'GMBGHBloodGroupId' => 'required',
                'GMBGHDesc1'  => 'required',
                'GMBGHDesc2'  => 'max:200',
                'GMBGHBiDesc'  => 'max:100',
            ]);
        }
        if(!$validator->passes()){
            return response()->json(['status'=>0, 'error'=>$validator->errors()->toArray()]);
        }
        else{
            $this->gmbg11AddUpdateTrait($request);
            // When add button is pushed
            if($request->get('button_action') == 'insert')
            {                
                return response()->json(['status'=>1, 'Id'=>$request->get('GMBGHBloodGroupId'), 'Desc1'=>$request->get('GMBGHDesc1'),
                'masterName'=>'BloodGroup ', 'updateMode'=>'Added']); 
            }
            // When edit button is pushed
            if($request->get('button_action') == 'update')
            {
                return response()->json(['status'=>1, 'Id'=>$request->get('GMBGHBloodGroupId'), 'Desc1'=>$request->get('GMBGHDesc1'),
                    'masterName'=>'BloodGroup ', 'updateMode'=>'Updated']);           
            }
                   
        }
    } 
    function Fetchdata(Request $request)
    {
        $fethchedData = $this->gmbg11FethchEditedDataTrait($request);
        echo json_encode($fethchedData);
    }    
    function DeleteData(Request $request)
    {
        $Id = $this->gmbg11DeleteRecordTrait($request);
        return response()->json(['status'=>1, 'Id'=>$Id, 
        'Desc1'=>'','masterName'=>'BloodGroup ', 'updateMode'=>'Deleted']); 
    }
    function BrowserDeletedRecords()
    {
        //Eloquent way - Model is must 
        $browserDeletedRecords = $this->gmbg11BrowserDeletedRecordsTrait(); 
        return DataTables::of($browserDeletedRecords)
        ->addColumn('action', function($DeletedBloodGroup){
            return '<a href="#" class="btn mr-1 btnEditRec3SIS restore" id="'.$DeletedBloodGroup->GMBGHUniqueId.'">Restore
                        <i class="fas fa-trash-restore"></i>
                    </a>';
        })
        ->make(true);
    } 
    function RestoreDeletedRecord(Request $request)
    {                    
        $Id = $this->gmbg11UnDeleteRecordTrait($request);
        return response()->json(['status'=>1, 'Id'=>$Id, 
        'Desc1'=>'', 'masterName'=>'BloodGroup ', 'updateMode'=>'Restored']); 
    } 
}

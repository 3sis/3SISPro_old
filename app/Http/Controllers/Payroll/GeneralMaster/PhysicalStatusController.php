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
use App\Traits\Payroll\GeneralMaster\physicalStatusDbOperations;
use App\Traits\TablesSchema3SIS\tablesSchema3SIS;
class PhysicalStatusController extends Controller
{
    use physicalStatusDbOperations, tablesSchema3SIS;
    function Index()
    { 
        $data = $this->dataTableXLSchemaTrait();
        return view('Payroll.GeneralMaster.physicalStatus')->with($data);
    }
    function BrowserData()
    {
        //Eloquent way - Model is must
        $BrowserDataTable = $this->gmps11BrowserDataTrait();
            return DataTables::of($BrowserDataTable)
            ->addColumn('action', function($PhysicalStatus){
                return '<a href="#" class="btn mr-1 btnEditRec3SIS edit" id="'.$PhysicalStatus->GMPSHUniqueId.'">Edit
                            <i class="fas fa-edit fa-xs"></i>
                        </a>
                        <a href="#" class="btn btnDeleteRec3SIS delete" id="'.$PhysicalStatus->GMPSHUniqueId.'">Del
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
                'GMPSHPhysicalStatusId' =>  'required|max:10||unique:T11901L08,GMPSHPhysicalStatusId',
                'GMPSHDesc1'  => 'required|max:100',
                'GMPSHDesc2'  => 'max:200',
                'GMPSHBiDesc'  => 'max:100',
            ]);
        }
        else
        {
            $validator = Validator::make($request->all(), [
                'GMPSHPhysicalStatusId' => 'required',
                'GMPSHDesc1'  => 'required',
                'GMPSHDesc2'  => 'max:200',
                'GMPSHBiDesc'  => 'max:100',
            ]);
        }
        if(!$validator->passes()){
            return response()->json(['status'=>0, 'error'=>$validator->errors()->toArray()]);
        }
        else{
            $this->gmps11AddUpdateTrait($request);
            // When add button is pushed
            if($request->get('button_action') == 'insert')
            {                
                return response()->json(['status'=>1, 'Id'=>$request->get('GMPSHPhysicalStatusId'), 'Desc1'=>$request->get('GMPSHDesc1'),
                'masterName'=>'PhysicalStatus ', 'updateMode'=>'Added']); 
            }
            // When edit button is pushed
            if($request->get('button_action') == 'update')
            {
                return response()->json(['status'=>1, 'Id'=>$request->get('GMPSHPhysicalStatusId'), 'Desc1'=>$request->get('GMPSHDesc1'),
                    'masterName'=>'PhysicalStatus ', 'updateMode'=>'Updated']);           
            }
                   
        }
    } 
    function Fetchdata(Request $request)
    {
        $fethchedData = $this->gmps11FethchEditedDataTrait($request);
        echo json_encode($fethchedData);
    }    
    function DeleteData(Request $request)
    {
        $Id = $this->gmps11DeleteRecordTrait($request);
        return response()->json(['status'=>1, 'Id'=>$Id, 
        'Desc1'=>'','masterName'=>'PhysicalStatus ', 'updateMode'=>'Deleted']); 
    }
    function BrowserDeletedRecords()
    {
        //Eloquent way - Model is must 
        $browserDeletedRecords = $this->gmps11BrowserDeletedRecordsTrait(); 
        return DataTables::of($browserDeletedRecords)
        ->addColumn('action', function($DeletedPhysicalStatus){
            return '<a href="#" class="btn mr-1 btnEditRec3SIS restore" id="'.$DeletedPhysicalStatus->GMPSHUniqueId.'">Restore
                        <i class="fas fa-trash-restore"></i>
                    </a>';
        })
        ->make(true);
    } 
    function RestoreDeletedRecord(Request $request)
    {                    
        $Id = $this->gmps11UnDeleteRecordTrait($request);
        return response()->json(['status'=>1, 'Id'=>$Id, 
        'Desc1'=>'', 'masterName'=>'PhysicalStatus ', 'updateMode'=>'Restored']); 
    } 
}

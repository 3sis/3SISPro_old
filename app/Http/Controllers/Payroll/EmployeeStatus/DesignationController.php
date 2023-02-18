<?php

namespace App\Http\Controllers\Payroll\EmployeeStatus;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
// Utilities
use Illuminate\Support\Carbon;
use Auth;
use Validator;
use DataTables;
// Traits
use App\Traits\Payroll\EmployeeStatus\designationDbOperations;
use App\Traits\TablesSchema3SIS\tablesSchema3SIS;

class DesignationController extends Controller
{
    use designationDbOperations, tablesSchema3SIS;
    function Index()
    { 
        $data = $this->dataTableXLSchemaTrait();
        return view('Payroll.EmployeeStatus.designation')->with($data);
    }
    function BrowserData()
    {
        //Eloquent way - Model is must
        $BrowserDataTable = $this->ESDEH11BrowserDataTrait();
            return DataTables::of($BrowserDataTable)
            ->addColumn('action', function($Designation){
                return '<a href="#" class="btn mr-1 btnEditRec3SIS edit" id="'.$Designation->ESDEHUniqueId.'">Edit
                            <i class="fas fa-edit fa-xs"></i>
                        </a>
                        <a href="#" class="btn btnDeleteRec3SIS delete" id="'.$Designation->ESDEHUniqueId.'">Del
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
                'ESDEHDesignationId' =>  'required|max:10||unique:T11903L01,ESDEHDesignationId',
                'ESDEHDesc1'  => 'required|max:100',
                'ESDEHDesc2'  => 'max:200',
                'ESDEHBiDesc'  => 'max:100',
            ]);
        }
        else
        {
            $validator = Validator::make($request->all(), [
                'ESDEHDesignationId' => 'required',
                'ESDEHDesc1'  => 'required',
                'ESDEHDesc2'  => 'max:200',
                'ESDEHBiDesc'  => 'max:100',
            ]);
        }
        if(!$validator->passes()){
            return response()->json(['status'=>0, 'error'=>$validator->errors()->toArray()]);
        }
        else{
            $this->ESDEH11AddUpdateTrait($request);
            // When add button is pushed
            if($request->get('button_action') == 'insert')
            {                
                return response()->json(['status'=>1, 'Id'=>$request->get('ESDEHDesignationId'), 'Desc1'=>$request->get('ESDEHDesc1'),
                'masterName'=>'Designation ', 'updateMode'=>'Added']); 
            }
            // When edit button is pushed
            if($request->get('button_action') == 'update')
            {
                return response()->json(['status'=>1, 'Id'=>$request->get('ESDEHDesignationId'), 'Desc1'=>$request->get('ESDEHDesc1'),
                    'masterName'=>'Designation ', 'updateMode'=>'Updated']);           
            }
                   
        }
    } 
    function Fetchdata(Request $request)
    {
        $fethchedData = $this->ESDEH11FethchEditedDataTrait($request);
        echo json_encode($fethchedData);
    }    
    function DeleteData(Request $request)
    {
        $Id = $this->ESDEH11DeleteRecordTrait($request);
        return response()->json(['status'=>1, 'Id'=>$Id, 
        'Desc1'=>'','masterName'=>'Designation ', 'updateMode'=>'Deleted']); 
    }
    function BrowserDeletedRecords()
    {
        //Eloquent way - Model is must 
        $browserDeletedRecords = $this->ESDEH11BrowserDeletedRecordsTrait(); 
        return DataTables::of($browserDeletedRecords)
        ->addColumn('action', function($DeletedDesignation){
            return '<a href="#" class="btn mr-1 btnEditRec3SIS restore" id="'.$DeletedDesignation->ESDEHUniqueId.'">Restore
                        <i class="fas fa-trash-restore"></i>
                    </a>';
        })
        ->make(true);
    } 
    function RestoreDeletedRecord(Request $request)
    {                    
        $Id = $this->ESDEH11UnDeleteRecordTrait($request);
        return response()->json(['status'=>1, 'Id'=>$Id, 
        'Desc1'=>'', 'masterName'=>'Designation ', 'updateMode'=>'Restored']); 
    } 
}

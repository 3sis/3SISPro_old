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
use App\Traits\Payroll\EmployeeStatus\departmentDbOperations;
use App\Traits\TablesSchema3SIS\tablesSchema3SIS;
class DepartmentController extends Controller
{
    use departmentDbOperations, tablesSchema3SIS;
    function Index()
    { 
        $data = $this->dataTableXLSchemaTrait();
        return view('Payroll.EmployeeStatus.department')->with($data);
    }
    function BrowserData()
    {
        //Eloquent way - Model is must
        $BrowserDataTable = $this->ESDPH11BrowserDataTrait();
            return DataTables::of($BrowserDataTable)
            ->addColumn('action', function($Department){
                return '<a href="#" class="btn mr-1 btnEditRec3SIS edit" id="'.$Department->ESDPHUniqueId.'">Edit
                            <i class="fas fa-edit fa-xs"></i>
                        </a>
                        <a href="#" class="btn btnDeleteRec3SIS delete" id="'.$Department->ESDPHUniqueId.'">Del
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
                'ESDPHDepartmentId' =>  'required|max:10||unique:T11903L03,ESDPHDepartmentId',
                'ESDPHDesc1'  => 'required|max:100',
                'ESDPHDesc2'  => 'max:200',
                'ESDPHBiDesc'  => 'max:100',
            ]);
        }
        else
        {
            $validator = Validator::make($request->all(), [
                'ESDPHDepartmentId' => 'required',
                'ESDPHDesc1'  => 'required',
                'ESDPHDesc2'  => 'max:200',
                'ESDPHBiDesc'  => 'max:100',
            ]);
        }
        if(!$validator->passes()){
            return response()->json(['status'=>0, 'error'=>$validator->errors()->toArray()]);
        }
        else{
            $this->ESDPH11AddUpdateTrait($request);
            // When add button is pushed
            if($request->get('button_action') == 'insert')
            {                
                return response()->json(['status'=>1, 'Id'=>$request->get('ESDPHDepartmentId'), 'Desc1'=>$request->get('ESDPHDesc1'),
                'masterName'=>'Department ', 'updateMode'=>'Added']); 
            }
            // When edit button is pushed
            if($request->get('button_action') == 'update')
            {
                return response()->json(['status'=>1, 'Id'=>$request->get('ESDPHDepartmentId'), 'Desc1'=>$request->get('ESDPHDesc1'),
                    'masterName'=>'Department ', 'updateMode'=>'Updated']);           
            }
                   
        }
    } 
    function Fetchdata(Request $request)
    {
        $fethchedData = $this->ESDPH11FethchEditedDataTrait($request);
        echo json_encode($fethchedData);
    }    
    function DeleteData(Request $request)
    {
        $Id = $this->ESDPH11DeleteRecordTrait($request);
        return response()->json(['status'=>1, 'Id'=>$Id, 
        'Desc1'=>'','masterName'=>'Department ', 'updateMode'=>'Deleted']); 
    }
    function BrowserDeletedRecords()
    {
        //Eloquent way - Model is must 
        $browserDeletedRecords = $this->ESDPH11BrowserDeletedRecordsTrait(); 
        return DataTables::of($browserDeletedRecords)
        ->addColumn('action', function($DeletedDepartment){
            return '<a href="#" class="btn mr-1 btnEditRec3SIS restore" id="'.$DeletedDepartment->ESDPHUniqueId.'">Restore
                        <i class="fas fa-trash-restore"></i>
                    </a>';
        })
        ->make(true);
    } 
    function RestoreDeletedRecord(Request $request)
    {                    
        $Id = $this->ESDPH11UnDeleteRecordTrait($request);
        return response()->json(['status'=>1, 'Id'=>$Id, 
        'Desc1'=>'', 'masterName'=>'Department ', 'updateMode'=>'Restored']); 
    } 
}

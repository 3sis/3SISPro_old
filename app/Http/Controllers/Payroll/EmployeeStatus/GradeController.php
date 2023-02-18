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
use App\Traits\Payroll\EmployeeStatus\gradeDbOperations;
use App\Traits\TablesSchema3SIS\tablesSchema3SIS;

class GradeController extends Controller
{
    use gradeDbOperations, tablesSchema3SIS;
    function Index()
    { 
        $data = $this->dataTableXLSchemaTrait();
        return view('Payroll.EmployeeStatus.grade')->with($data);
    }
    function BrowserData()
    {
        //Eloquent way - Model is must
        $BrowserDataTable = $this->ESGRH11BrowserDataTrait();
            return DataTables::of($BrowserDataTable)
            ->addColumn('action', function($Grade){
                return '<a href="#" class="btn mr-1 btnEditRec3SIS edit" id="'.$Grade->ESGRHUniqueId.'">Edit
                            <i class="fas fa-edit fa-xs"></i>
                        </a>
                        <a href="#" class="btn btnDeleteRec3SIS delete" id="'.$Grade->ESGRHUniqueId.'">Del
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
                'ESGRHGradeId' =>  'required|max:10||unique:T11903L02,ESGRHGradeId',
                'ESGRHDesc1'  => 'required|max:100',
                'ESGRHDesc2'  => 'max:200',
                'ESGRHBiDesc'  => 'max:100',
            ]);
        }
        else
        {
            $validator = Validator::make($request->all(), [
                'ESGRHGradeId' => 'required',
                'ESGRHDesc1'  => 'required',
                'ESGRHDesc2'  => 'max:200',
                'ESGRHBiDesc'  => 'max:100',
            ]);
        }
        if(!$validator->passes()){
            return response()->json(['status'=>0, 'error'=>$validator->errors()->toArray()]);
        }
        else{
            $this->ESGRH11AddUpdateTrait($request);
            // When add button is pushed
            if($request->get('button_action') == 'insert')
            {                
                return response()->json(['status'=>1, 'Id'=>$request->get('ESGRHGradeId'), 'Desc1'=>$request->get('ESGRHDesc1'),
                'masterName'=>'Grade ', 'updateMode'=>'Added']); 
            }
            // When edit button is pushed
            if($request->get('button_action') == 'update')
            {
                return response()->json(['status'=>1, 'Id'=>$request->get('ESGRHGradeId'), 'Desc1'=>$request->get('ESGRHDesc1'),
                    'masterName'=>'Grade ', 'updateMode'=>'Updated']);           
            }
                   
        }
    } 
    function Fetchdata(Request $request)
    {
        $fethchedData = $this->ESGRH11FethchEditedDataTrait($request);
        echo json_encode($fethchedData);
    }    
    function DeleteData(Request $request)
    {
        $Id = $this->ESGRH11DeleteRecordTrait($request);
        return response()->json(['status'=>1, 'Id'=>$Id, 
        'Desc1'=>'','masterName'=>'Grade ', 'updateMode'=>'Deleted']); 
    }
    function BrowserDeletedRecords()
    {
        //Eloquent way - Model is must 
        $browserDeletedRecords = $this->ESGRH11BrowserDeletedRecordsTrait(); 
        return DataTables::of($browserDeletedRecords)
        ->addColumn('action', function($DeletedGrade){
            return '<a href="#" class="btn mr-1 btnEditRec3SIS restore" id="'.$DeletedGrade->ESGRHUniqueId.'">Restore
                        <i class="fas fa-trash-restore"></i>
                    </a>';
        })
        ->make(true);
    } 
    function RestoreDeletedRecord(Request $request)
    {                    
        $Id = $this->ESGRH11UnDeleteRecordTrait($request);
        return response()->json(['status'=>1, 'Id'=>$Id, 
        'Desc1'=>'', 'masterName'=>'Grade ', 'updateMode'=>'Restored']); 
    } 
}

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
use App\Models\Payroll\GeneralMaster\Nationality;
// Traits
use App\Traits\Payroll\GeneralMaster\nationalityDbOperations;
use App\Traits\TablesSchema3SIS\tablesSchema3SIS;
class NationalityController extends Controller
{
    use nationalityDbOperations, tablesSchema3SIS;
    function Index()
    { 
        $data = $this->dataTableXLSchemaTrait();
        return view('Payroll.GeneralMaster.nationality')->with($data);
    }
    function BrowserData()
    {
        //Eloquent way - Model is must
        $BrowserDataTable = $this->gmna11BrowserDataTrait();
            return DataTables::of($BrowserDataTable)
            ->addColumn('action', function($Nationality){
                return '<a href="#" class="btn mr-1 btnEditRec3SIS edit" id="'.$Nationality->GMNAHUniqueId.'">Edit
                            <i class="fas fa-edit fa-xs"></i>
                        </a>
                        <a href="#" class="btn btnDeleteRec3SIS delete" id="'.$Nationality->GMNAHUniqueId.'">Del
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
                'GMNAHNationalityId' =>  'required|max:10||unique:T11901L04,GMNAHNationalityId',
                'GMNAHDesc1'  => 'required|max:100',
                'GMNAHDesc2'  => 'max:200',
                'GMNAHBiDesc'  => 'max:100',
            ]);
        }
        else
        {
            $validator = Validator::make($request->all(), [
                'GMNAHNationalityId' => 'required',
                'GMNAHDesc1'  => 'required',
                'GMNAHDesc2'  => 'max:200',
                'GMNAHBiDesc'  => 'max:100',
            ]);
        }
        if(!$validator->passes()){
            return response()->json(['status'=>0, 'error'=>$validator->errors()->toArray()]);
        }
        else{
            $this->gmna11AddUpdateTrait($request);
            // When add button is pushed
            if($request->get('button_action') == 'insert')
            {                
                return response()->json(['status'=>1, 'Id'=>$request->get('GMNAHNationalityId'), 'Desc1'=>$request->get('GMNAHDesc1'),
                'masterName'=>'Nationality ', 'updateMode'=>'Added']); 
            }
            // When edit button is pushed
            if($request->get('button_action') == 'update')
            {
                return response()->json(['status'=>1, 'Id'=>$request->get('GMNAHNationalityId'), 'Desc1'=>$request->get('GMNAHDesc1'),
                    'masterName'=>'Nationality ', 'updateMode'=>'Updated']);           
            }
                   
        }
    } 
    function Fetchdata(Request $request)
    {
        $fethchedData = $this->gmna11FethchEditedDataTrait($request);
        echo json_encode($fethchedData);
    }    
    function DeleteData(Request $request)
    {
        $Id = $this->gmna11DeleteRecordTrait($request);
        return response()->json(['status'=>1, 'Id'=>$Id, 
        'Desc1'=>'','masterName'=>'Nationality ', 'updateMode'=>'Deleted']); 
    }
    function BrowserDeletedRecords()
    {
        //Eloquent way - Model is must 
        $browserDeletedRecords = $this->gmna11BrowserDeletedRecordsTrait(); 
        return DataTables::of($browserDeletedRecords)
        ->addColumn('action', function($DeletedNationality){
            return '<a href="#" class="btn mr-1 btnEditRec3SIS restore" id="'.$DeletedNationality->GMNAHUniqueId.'">Restore
                        <i class="fas fa-trash-restore"></i>
                    </a>';
        })
        ->make(true);
    } 
    function RestoreDeletedRecord(Request $request)
    {                    
        $Id = $this->gmna11UnDeleteRecordTrait($request);
        return response()->json(['status'=>1, 'Id'=>$Id, 
        'Desc1'=>'', 'masterName'=>'Nationality ', 'updateMode'=>'Restored']); 
    } 
}

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
use App\Models\Payroll\GeneralMaster\RaceGroup;
// Traits
use App\Traits\Payroll\GeneralMaster\raceDbOperations;
use App\Traits\TablesSchema3SIS\tablesSchema3SIS;

class RaceController extends Controller
{
    use raceDbOperations, tablesSchema3SIS;
    function Index()
    { 
        $data = $this->dataTableXLSchemaTrait();
        return view('Payroll.GeneralMaster.race')->with($data);
    }
    function BrowserData()
    {
        //Eloquent way - Model is must
        $BrowserDataTable = $this->gmra11BrowserDataTrait();
            return DataTables::of($BrowserDataTable)
            ->addColumn('action', function($Race){
                return '<a href="#" class="btn mr-1 btnEditRec3SIS edit" id="'.$Race->GMRAHUniqueId.'">Edit
                            <i class="fas fa-edit fa-xs"></i>
                        </a>
                        <a href="#" class="btn btnDeleteRec3SIS delete" id="'.$Race->GMRAHUniqueId.'">Del
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
                'GMRAHRaceId' =>  'required|max:10||unique:T11901L05,GMRAHRaceId',
                'GMRAHDesc1'  => 'required|max:100',
                'GMRAHDesc2'  => 'max:200',
                'GMRAHBiDesc'  => 'max:100',
            ]);
        }
        else
        {
            $validator = Validator::make($request->all(), [
                'GMRAHRaceId' => 'required',
                'GMRAHDesc1'  => 'required',
                'GMRAHDesc2'  => 'max:200',
                'GMRAHBiDesc'  => 'max:100',
            ]);
        }
        if(!$validator->passes()){
            return response()->json(['status'=>0, 'error'=>$validator->errors()->toArray()]);
        }
        else{
            $this->gmra11AddUpdateTrait($request);
            // When add button is pushed
            if($request->get('button_action') == 'insert')
            {                
                return response()->json(['status'=>1, 'Id'=>$request->get('GMRAHRaceId'), 'Desc1'=>$request->get('GMRAHDesc1'),
                'masterName'=>'Race ', 'updateMode'=>'Added']); 
            }
            // When edit button is pushed
            if($request->get('button_action') == 'update')
            {
                return response()->json(['status'=>1, 'Id'=>$request->get('GMRAHRaceId'), 'Desc1'=>$request->get('GMRAHDesc1'),
                    'masterName'=>'Race ', 'updateMode'=>'Updated']);           
            }
                   
        }
    } 
    function Fetchdata(Request $request)
    {
        $fethchedData = $this->gmra11FethchEditedDataTrait($request);
        echo json_encode($fethchedData);
    }    
    function DeleteData(Request $request)
    {
        $Id = $this->gmra11DeleteRecordTrait($request);
        return response()->json(['status'=>1, 'Id'=>$Id, 
        'Desc1'=>'','masterName'=>'Race ', 'updateMode'=>'Deleted']); 
    }
    function BrowserDeletedRecords()
    {
        //Eloquent way - Model is must 
        $browserDeletedRecords = $this->gmra11BrowserDeletedRecordsTrait(); 
        return DataTables::of($browserDeletedRecords)
        ->addColumn('action', function($DeletedRace){
            return '<a href="#" class="btn mr-1 btnEditRec3SIS restore" id="'.$DeletedRace->GMRAHUniqueId.'">Restore
                        <i class="fas fa-trash-restore"></i>
                    </a>';
        })
        ->make(true);
    } 
    function RestoreDeletedRecord(Request $request)
    {                    
        $Id = $this->gmra11UnDeleteRecordTrait($request);
        return response()->json(['status'=>1, 'Id'=>$Id, 
        'Desc1'=>'', 'masterName'=>'Race ', 'updateMode'=>'Restored']); 
    } 
}

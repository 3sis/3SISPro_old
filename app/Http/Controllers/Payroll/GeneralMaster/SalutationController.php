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
use App\Models\Payroll\GeneralMaster\Salutation;
// Traits
use App\Traits\Payroll\GeneralMaster\salutationDbOperations;
use App\Traits\TablesSchema3SIS\tablesSchema3SIS;

class SalutationController extends Controller
{
    use salutationDbOperations, tablesSchema3SIS;
    function Index()
    { 
        $data = $this->dataTableXLSchemaTrait();
        return view('Payroll.GeneralMaster.salutation')->with($data);
    }
    function BrowserData()
    {
        //Eloquent way - Model is must
        $BrowserDataTable = $this->gmsl11BrowserDataTrait();
            return DataTables::of($BrowserDataTable)
            ->addColumn('action', function($Salutation){
                return '<a href="#" class="btn mr-1 btnEditRec3SIS edit" id="'.$Salutation->GMSLHUniqueId.'">Edit
                            <i class="fas fa-edit fa-xs"></i>
                        </a>
                        <a href="#" class="btn btnDeleteRec3SIS delete" id="'.$Salutation->GMSLHUniqueId.'">Del
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
                'GMSLHSalutationId' =>  'required|max:10||unique:T11901L01,GMSLHSalutationId',
                'GMSLHDesc1'  => 'required|max:100',
                'GMSLHDesc2'  => 'max:200',
                'GMSLHBiDesc'  => 'max:100',
            ]);
        }
        else
        {
            $validator = Validator::make($request->all(), [
                'GMSLHSalutationId' => 'required',
                'GMSLHDesc1'  => 'required',
                'GMSLHDesc2'  => 'max:200',
                'GMSLHBiDesc'  => 'max:100',
            ]);
        }
        if(!$validator->passes()){
            return response()->json(['status'=>0, 'error'=>$validator->errors()->toArray()]);
        }
        else{
            $this->gmsl11AddUpdateTrait($request);
            // When add button is pushed
            if($request->get('button_action') == 'insert')
            {                
                return response()->json(['status'=>1, 'Id'=>$request->get('GMSLHSalutationId'), 'Desc1'=>$request->get('GMSLHDesc1'),
                'masterName'=>'Salutation ', 'updateMode'=>'Added']); 
            }
            // When edit button is pushed
            if($request->get('button_action') == 'update')
            {
                return response()->json(['status'=>1, 'Id'=>$request->get('GMSLHSalutationId'), 'Desc1'=>$request->get('GMSLHDesc1'),
                    'masterName'=>'Salutation ', 'updateMode'=>'Updated']);           
            }
                   
        }
    } 
    function Fetchdata(Request $request)
    {
        $fethchedData = $this->gmsl11FethchEditedDataTrait($request);
        echo json_encode($fethchedData);
    }    
    function DeleteData(Request $request)
    {
        $Id = $this->gmsl11DeleteRecordTrait($request);
        return response()->json(['status'=>1, 'Id'=>$Id, 
        'Desc1'=>'','masterName'=>'Salutation ', 'updateMode'=>'Deleted']); 
    }
    function BrowserDeletedRecords()
    {
        //Eloquent way - Model is must 
        $browserDeletedRecords = $this->gmsl11BrowserDeletedRecordsTrait(); 
        return DataTables::of($browserDeletedRecords)
        ->addColumn('action', function($DeletedSalutation){
            return '<a href="#" class="btn mr-1 btnEditRec3SIS restore" id="'.$DeletedSalutation->GMSLHUniqueId.'">Restore
                        <i class="fas fa-trash-restore"></i>
                    </a>';
        })
        ->make(true);
    } 
    function RestoreDeletedRecord(Request $request)
    {                    
        $Id = $this->gmsl11UnDeleteRecordTrait($request);
        return response()->json(['status'=>1, 'Id'=>$Id, 
        'Desc1'=>'', 'masterName'=>'Salutation ', 'updateMode'=>'Restored']); 
    } 
}

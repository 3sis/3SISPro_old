<?php

namespace App\Http\Controllers\CommonMasters\GeneralMaster;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
// Utilities
use Illuminate\Support\Carbon;
use Auth;
use Validator;
use DataTables;
// Model
use App\Models\CommonMasters\GeneralMaster\Currency;
// Traits
use App\Traits\CommonMasters\GeneralMaster\currencyDbOperations;
use App\Traits\TablesSchema3SIS\tablesSchema3SIS;

class CurrencyController extends Controller
{
    use currencyDbOperations, tablesSchema3SIS;
    function Index()
    { 
        $data = $this->dataTableXLSchemaTrait();
        return view('CommonMasters.GeneralMaster.currency')->with($data);
    }
    function BrowserData()
    {
        //Eloquent way - Model is must
        $BrowserDataTable = $this->gmcrBrowserDataTrait();
        return DataTables::of($BrowserDataTable)
        ->addColumn('action', function($Currency){
            return '<a href="#" class="btn mr-1 btnEditRec3SIS edit" id="'.$Currency->GMCRHUniqueId.'">Edit
                        <i class="fas fa-edit fa-xs"></i>
                    </a>
                    <a href="#" class="btn btnDeleteRec3SIS delete" id="'.$Currency->GMCRHUniqueId.'">Del
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
                'GMCRHCurrencyId' =>  'required|min:2|max:10||unique:t05901l07,GMCRHCurrencyId',
                'GMCRHDesc1'  => 'required|max:100',
                'GMCRHDesc2'  => 'max:200',
                'GMCRHBiDesc'  => 'max:100',
            ]);
        }
        else
        {
            $validator = Validator::make($request->all(), [
                'GMCRHCurrencyId' => 'required',
                'GMCRHDesc1'  => 'required',
                'GMCRHDesc2'  => 'max:200',
                'GMCRHBiDesc'  => 'max:100',
            ]);
        }
        if(!$validator->passes()){
            return response()->json(['status'=>0, 'error'=>$validator->errors()->toArray()]);
        }
        else{
            $this->gmcrAddUpdateTrait($request);
            // When add button is pushed
            if($request->get('button_action') == 'insert')
            {                
                return response()->json(['status'=>1, 'Id'=>$request->get('GMCRHCurrencyId'), 'Desc1'=>$request->get('GMCRHDesc1'),
                'masterName'=>'Currency ', 'updateMode'=>'Added']); 
            }
            // When edit button is pushed
            if($request->get('button_action') == 'update')
            {
                return response()->json(['status'=>1, 'Id'=>$request->get('GMCRHCurrencyId'), 'Desc1'=>$request->get('GMCRHDesc1'),
                    'masterName'=>'Currency ', 'updateMode'=>'Updated']);           
            }
                   
        }
    } 
    function Fetchdata(Request $request)
    {
        $fethchedData = $this->gmcrFethchEditedDataTrait($request);
        echo json_encode($fethchedData);
    }    
    function DeleteData(Request $request)
    {
        $Id = $this->gmcrDeleteRecordTrait($request);
        return response()->json(['status'=>1, 'Id'=>$Id, 
        'Desc1'=>'','masterName'=>'Currency ', 'updateMode'=>'Deleted']); 
    }
    function BrowserDeletedRecords()
    {
        //Eloquent way - Model is must 
        $browserDeletedRecords = $this->gmcrBrowserDeletedRecordsTrait(); 
        return DataTables::of($browserDeletedRecords)
        ->addColumn('action', function($DeletedCurrency){
            return '<a href="#" class="btn mr-1 btnEditRec3SIS restore" id="'.$DeletedCurrency->GMCRHUniqueId.'">Restore
                        <i class="fas fa-trash-restore"></i>
                    </a>';
        })
        ->make(true);
    } 
    function RestoreDeletedRecord(Request $request)
    {                    
        $Id = $this->gmcrUnDeleteRecordTrait($request);
        return response()->json(['status'=>1, 'Id'=>$Id, 
        'Desc1'=>'', 'masterName'=>'Currency ', 'updateMode'=>'Restored']); 
    } 
}

<?php

namespace App\Http\Controllers\CommonMasters\BankingMaster;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Http\Requests\ErrorMessages3SISRequest;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
// CopyChange
use Illuminate\Support\Carbon;
use Auth;
use Validator;
use DataTables;
use App\Models\CommonMasters\BankingMaster\PaymentMode;
use App\Traits\CommonMasters\BankingMaster\paymentModeDbOperations;
use App\Traits\TablesSchema3SIS\tablesSchema3SIS;

class PaymentModeController extends Controller
{
    use paymentModeDbOperations, tablesSchema3SIS;
    function Index()
    { 
        $data = $this->dataTableXLSchemaTrait();
        return view('CommonMasters.BankingMaster.paymentMode')->with($data);
    }
    function BrowserData()
    {
        //Eloquent way - Model is must 
        $BrowserDataTable = $this->pymBrowserDataTrait();        
        return DataTables::of($BrowserDataTable)
        
        ->addColumn('action', function($PaymentMode){
            return '<a href="#" class="btn mr-1 btnEditRec3SIS edit" id="'.$PaymentMode->BMPMHUniqueId.'">Edit
                        <i class="fas fa-edit fa-xs"></i>
                    </a>
                    <a href="#" class="btn btnDeleteRec3SIS delete" id="'.$PaymentMode->BMPMHUniqueId.'">Del
                        <i class="far fa-trash-alt fa-xs"></i>
                    </a>';
        })
        ->make(true);
    }
    function Fetchdata(Request $request)
    {
        $fethchedData = $this->pymFethchEditedDataTrait($request);
        echo json_encode($fethchedData);
    }
    function Postdata(Request $request)
    {       
      
        if($request->get('button_action') == 'insert')
        {
            $validator = Validator::make($request->all(), [
                'BMPMHPaymentModeId' =>  'required|min:2|max:10||unique:t05902l04,BMPMHPaymentModeId',
                'BMPMHDesc1'  => 'required|max:100',
                'BMPMHDesc2'  => 'max:200',
                'BMPMHBiDesc'  => 'max:100',
            ]);
        }
        else
        {
            $validator = Validator::make($request->all(), [
                'BMPMHPaymentModeId' => 'required',
                'BMPMHDesc1'  => 'required',
                'BMPMHDesc2'  => 'max:200',
                'BMPMHBiDesc'  => 'max:100',

            ]);
        }
        if(!$validator->passes()){
            return response()->json(['status'=>0, 'error'=>$validator->errors()->toArray()]);
        }
        else{     
            // When add button is pushed
            if($request->get('button_action') == 'insert')
            {
                $this->pymAddUpdateTrait($request);
                //********************************************************** */
                return response()->json(['status'=>1, 'Id'=>$request->get('BMPMHPaymentModeId'), 
                    'Desc1'=>'',
                    'masterName'=>'PaymentMode ', 'updateMode'=>'Added']); 
            }
            // When edit button is pushed
            if($request->get('button_action') == 'update')
            {           
                $this->pymAddUpdateTrait($request);              
                return response()->json(['status'=>1, 'Id'=>$request->get('BMPMHPaymentModeId'), 
                    'Desc1'=>'', 'masterName'=>'PaymentMode ', 'updateMode'=>'Updated']);      
            }           
                   
        }
    }
    function DeleteData(Request $request)
    {
        $PaymentModeId = $this->pymDeleteRecordTrait($request);
        return response()->json(['status'=>1, 'Id'=>$PaymentModeId, 
            'Desc1'=>'', 'masterName'=>'PaymentMode ', 'updateMode'=>'Deleted']);         
    }
    function BrowserDeletedRecords()
    {
        //Eloquent way - Model is must 
        $browserDeletedRecords = $this->pymBrowserDeletedRecordsTrait(); 
        return DataTables::of($browserDeletedRecords)
        ->addColumn('action', function($DeletedPaymentMode){
            return '<a href="#" class="btn mr-1 btnEditRec3SIS restore" id="'.$DeletedPaymentMode->BMPMHUniqueId.'">Restore
                        <i class="fas fa-trash-restore"></i>
                    </a>';
        })
        ->make(true);
    } 
    function RestoreDeletedRecord(Request $request)
    {                    
        $PaymentModeId = $this->pymUnDeleteRecordTrait($request);
        return response()->json(['status'=>1, 'Id'=>$PaymentModeId, 
        'Desc1'=>'', 'masterName'=>'PaymentMode ', 'updateMode'=>'Restored']); 
    } 
}


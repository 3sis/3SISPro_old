<?php

namespace App\Http\Controllers\Payroll\Credentials;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
// Utilities
use Illuminate\Support\Carbon;
use Auth;
use Validator;
use DataTables;
// Traits
use App\Traits\Payroll\Credentials\certificatesDbOperations;
use App\Traits\TablesSchema3SIS\tablesSchema3SIS;

class CertificatesController extends Controller
{
    use certificatesDbOperations, tablesSchema3SIS;
    function Index()
    { 
        $data = $this->dataTableXLSchemaTrait();
        return view('Payroll.Credentials.certificate')->with($data);
    }
    function BrowserData()
    {
        //Eloquent way - Model is must
        $BrowserDataTable = $this->CMCTH11BrowserDataTrait();
            return DataTables::of($BrowserDataTable)
            ->addColumn('action', function($Certificate){
                return '<a href="#" class="btn mr-1 btnEditRec3SIS edit" id="'.$Certificate->CMCTHUniqueId.'">Edit
                            <i class="fas fa-edit fa-xs"></i>
                        </a>
                        <a href="#" class="btn btnDeleteRec3SIS delete" id="'.$Certificate->CMCTHUniqueId.'">Del
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
                'CMCTHCertificateId' =>  'required|max:10||unique:T11904l02,CMCTHCertificateId',
                'CMCTHDesc1'  => 'required|max:100',
                'CMCTHDesc2'  => 'max:200',
                'CMCTHBiDesc'  => 'max:100',
            ]);
        }
        else
        {
            $validator = Validator::make($request->all(), [
                'CMCTHCertificateId' => 'required',
                'CMCTHDesc1'  => 'required',
                'CMCTHDesc2'  => 'max:200',
                'CMCTHBiDesc'  => 'max:100',
            ]);
        }
        if(!$validator->passes()){
            return response()->json(['status'=>0, 'error'=>$validator->errors()->toArray()]);
        }
        else{
            $this->CMCTH11AddUpdateTrait($request);
            // When add button is pushed
            if($request->get('button_action') == 'insert')
            {                
                return response()->json(['status'=>1, 'Id'=>$request->get('CMCTHCertificateId'), 'Desc1'=>$request->get('CMCTHDesc1'),
                'masterName'=>'Certificate ', 'updateMode'=>'Added']); 
            }
            // When edit button is pushed
            if($request->get('button_action') == 'update')
            {
                return response()->json(['status'=>1, 'Id'=>$request->get('CMCTHCertificateId'), 'Desc1'=>$request->get('CMCTHDesc1'),
                    'masterName'=>'Certificate ', 'updateMode'=>'Updated']);           
            }
                   
        }
    } 
    function Fetchdata(Request $request)
    {
        $fethchedData = $this->CMCTH11FethchEditedDataTrait($request);
        echo json_encode($fethchedData);
    }    
    function DeleteData(Request $request)
    {
        $Id = $this->CMCTH11DeleteRecordTrait($request);
        return response()->json(['status'=>1, 'Id'=>$Id, 
        'Desc1'=>'','masterName'=>'Certificate ', 'updateMode'=>'Deleted']); 
    }
    function BrowserDeletedRecords()
    {
        //Eloquent way - Model is must 
        $browserDeletedRecords = $this->CMCTH11BrowserDeletedRecordsTrait(); 
        return DataTables::of($browserDeletedRecords)
        ->addColumn('action', function($DeletedCertificate){
            return '<a href="#" class="btn mr-1 btnEditRec3SIS restore" id="'.$DeletedCertificate->CMCTHUniqueId.'">Restore
                        <i class="fas fa-trash-restore"></i>
                    </a>';
        })
        ->make(true);
    } 
    function RestoreDeletedRecord(Request $request)
    {                    
        $Id = $this->CMCTH11UnDeleteRecordTrait($request);
        return response()->json(['status'=>1, 'Id'=>$Id, 
        'Desc1'=>'', 'masterName'=>'Certificate ', 'updateMode'=>'Restored']); 
    } 
}

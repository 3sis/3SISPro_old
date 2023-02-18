<?php

namespace App\Http\Controllers\CommonMasters\FiscalYear;
use App\Http\Controllers\Controller;
use App\Http\Requests\ErrorMessages3SISRequest;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
// CopyChange
use Illuminate\Support\Carbon;
use Auth;
use Validator;
use DataTables;
use App\Models\CommonMasters\FiscalYear\FiscalYear;
use App\Models\SystemsMaster\PeriodMaster;
use App\Traits\CommonMasters\FiscalYear\fiscalYearDbOperations;
use App\Traits\DropDown3SIS\dropDowns3SIS;
use App\Traits\TablesSchema3SIS\tablesSchema3SIS;

class FiscalYearController extends Controller
{
    use fiscalYearDbOperations, dropDowns3SIS, tablesSchema3SIS;
    protected  $gCompanyId = '1000';    
    // $this->gCompanyId;

    function Index()
    { 
        $data = $this->dataTableXLSchemaTrait();
        return view('CommonMasters.FiscalYear.fiscalYear')->with($data);
    }
    function BrowserData()
    {
        //Eloquent way - Model is must
        $BrowserDataTable = $this->fyBrowserDataTrait();        
        return DataTables::of($BrowserDataTable)
        ->addColumn('action', function($FiscalYear){
            return '<a href="#" class="btn mr-1 btnEditRec3SIS edit" id="'.$FiscalYear->FYFYHUniqueId.'">Edit
                        <i class="fas fa-edit fa-xs"></i>
                    </a>
                    <a href="#" class="btn btnDeleteRec3SIS delete" id="'.$FiscalYear->FYFYHUniqueId.'">Del
                        <i class="far fa-trash-alt fa-xs"></i>
                    </a>';
            // <a href="#" class="btn btn-outline-danger mr-1 btn-sm delete" id="'.$FiscalYear->FYFYHUniqueId.'">Delete</a>';
        })
        ->make(true);
    } 
    function Fetchdata(Request $request)
    {
        $fethchedData = $this->fyFethchEditedDataTrait($request);
        echo json_encode($fethchedData);
    }
    function Postdata(Request $request)
    {
        // echo 'Data Submitted.';
        // return $request->input();
        // die();
        $FYFYHCurrentFY = (int)$request->FYFYHCurrentFY;
        $request->merge(['FYFYHCompanyId' => $this->gCompanyId]);
        $request->merge(['FYFYHCurrentFY' => $FYFYHCurrentFY ]);
        
        if($request->get('button_action') == 'insert')
        {            
            $validator = Validator::make($request->all(), [
                'FYFYHFiscalYearId' => [
                    'required',
                    'unique:t05903L01,FYFYHFiscalYearId,NULL,FYFYHUniqueId,FYFYHCompanyId,'.$request->FYFYHCompanyId
                ],                
                'FYFYHStartDate'        => 'required',
                'FYFYHEndDate'          => 'required|after:FYFYHStartDate',
                'FYFYHCurrentFY'         => 'unique:t05903L01,FYFYHCurrentFY,NULL,
                    FYFYHUniqueId,FYFYHCurrentFY,1,FYFYHCompanyId,'.$request->FYFYHCompanyId, 
                'periodId'              => [
                    Rule::in(['1','2','3','4','5','6','7','8','9','10','11','12']),
                ],
            ]);
        }
        else
        {
            // Ignore if Edited reocrd Active Fiscal Year is true
            if ($request->activeFiscalYearId == $request->FYFYHUniqueId || $request->activeFiscalYearId == 0) {
                $validator = Validator::make($request->all(), [                    
                    'periodId'              => [
                        Rule::in(['1','2','3','4','5','6','7','8','9','10','11','12']),
                    ],
                ]);
            }else {
                $validator = Validator::make($request->all(), [
                    'FYFYHCurrentFY'         => 'unique:t05903L01,FYFYHCurrentFY,NULL,
                        FYFYHUniqueId,FYFYHCurrentFY,1,FYFYHCompanyId,'.$request->FYFYHCompanyId, 
                    'periodId'              => [
                        Rule::in(['1','2','3','4','5','6','7','8','9','10','11','12']),
                    ],
                ]);
            }
           
        }
        if(!$validator->passes()){
            return response()->json(['status'=>0, 'error'=>$validator->errors()->toArray()]);

        }
        else{   
            // When add button is pushed
            if($request->get('button_action') == 'insert')
            {
                $UniqueId = $this->fyAddUpdateTrait($request);
                return response()->json(['status'=>1, 'Id'=>$request->get('FYFYHFiscalYearId'), 
                    'Desc1'=>'',
                    'masterName'=>'FiscalYear ', 'updateMode'=>'Added']);                 
            }
            // When edit button is pushed
            if($request->get('button_action') == 'update')
            {  
                $UniqueId = $this->fyAddUpdateTrait($request);
                return response()->json(['status'=>1, 'Id'=>$request->get('FYFYHFiscalYearId'), 
                    'Desc1'=>'', 'masterName'=>'FiscalYear ', 'updateMode'=>'Updated']);   
            }
                   
        }
    }
    function DeleteData(Request $request)
    {
        $FiscalYearId = $this->fyDeleteRecordTrait($request);
        return response()->json(['status'=>1, 'Id'=>$FiscalYearId, 
            'Desc1'=>'', 'masterName'=>'FiscalYear ', 'updateMode'=>'Deleted']);        
    }
    function BrowserDeletedRecords()
    {
        //Eloquent way - Model is must
        $browserDeletedRecords = $this->fyBrowserDeletedRecorTrait();          
        return DataTables::of($browserDeletedRecords)
        ->addColumn('action', function($DeletedFiscalYear){
            return '<a href="#" class="btn mr-1 btnEditRec3SIS restore" id="'.$DeletedFiscalYear->FYFYHUniqueId.'">Restore
                        <i class="fas fa-trash-restore"></i>
                    </a>';
            // <a href="#" class="btn btn-outline-danger mr-1 btn-sm delete" id="'.$FiscalYear->FYFYHUniqueId.'">Delete</a>';
        })
        ->make(true);
    } 
    function RestoreDeletedRecord(Request $request)
    {
        $FiscalYearId = $this->fyUnDeleteRecordTrait($request);
        return response()->json(['status'=>1, 'Id'=>$FiscalYearId, 
            'Desc1'=>'', 'masterName'=>'FiscalYear ', 'updateMode'=>'Restored']);        
    }
}
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
use App\Traits\Payroll\Credentials\skillsDbOperations;
use App\Traits\TablesSchema3SIS\tablesSchema3SIS;

class SkillsController extends Controller
{
    use skillsDbOperations, tablesSchema3SIS;
    function Index()
    { 
        $data = $this->dataTableXLSchemaTrait();
        return view('Payroll.Credentials.skills')->with($data);
    }
    function BrowserData()
    {
        //Eloquent way - Model is must
        $BrowserDataTable = $this->CMSKH11BrowserDataTrait();
            return DataTables::of($BrowserDataTable)
            ->addColumn('action', function($Skill){
                return '<a href="#" class="btn mr-1 btnEditRec3SIS edit" id="'.$Skill->CMSKHUniqueId.'">Edit
                            <i class="fas fa-edit fa-xs"></i>
                        </a>
                        <a href="#" class="btn btnDeleteRec3SIS delete" id="'.$Skill->CMSKHUniqueId.'">Del
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
                'CMSKHSkillId' =>  'required|max:10||unique:T11904l03,CMSKHSkillId',
                'CMSKHDesc1'  => 'required|max:100',
                'CMSKHDesc2'  => 'max:200',
                'CMSKHBiDesc'  => 'max:100',
            ]);
        }
        else
        {
            $validator = Validator::make($request->all(), [
                'CMSKHSkillId' => 'required',
                'CMSKHDesc1'  => 'required',
                'CMSKHDesc2'  => 'max:200',
                'CMSKHBiDesc'  => 'max:100',
            ]);
        }
        if(!$validator->passes()){
            return response()->json(['status'=>0, 'error'=>$validator->errors()->toArray()]);
        }
        else{
            $this->CMSKH11AddUpdateTrait($request);
            // When add button is pushed
            if($request->get('button_action') == 'insert')
            {                
                return response()->json(['status'=>1, 'Id'=>$request->get('CMSKHSkillId'), 'Desc1'=>$request->get('CMSKHDesc1'),
                'masterName'=>'Skill ', 'updateMode'=>'Added']); 
            }
            // When edit button is pushed
            if($request->get('button_action') == 'update')
            {
                return response()->json(['status'=>1, 'Id'=>$request->get('CMSKHSkillId'), 'Desc1'=>$request->get('CMSKHDesc1'),
                    'masterName'=>'Skill ', 'updateMode'=>'Updated']);           
            }
                   
        }
    } 
    function Fetchdata(Request $request)
    {
        $fethchedData = $this->CMSKH11FethchEditedDataTrait($request);
        echo json_encode($fethchedData);
    }    
    function DeleteData(Request $request)
    {
        $Id = $this->CMSKH11DeleteRecordTrait($request);
        return response()->json(['status'=>1, 'Id'=>$Id, 
        'Desc1'=>'','masterName'=>'Skill ', 'updateMode'=>'Deleted']); 
    }
    function BrowserDeletedRecords()
    {
        //Eloquent way - Model is must 
        $browserDeletedRecords = $this->CMSKH11BrowserDeletedRecordsTrait(); 
        return DataTables::of($browserDeletedRecords)
        ->addColumn('action', function($DeletedSkill){
            return '<a href="#" class="btn mr-1 btnEditRec3SIS restore" id="'.$DeletedSkill->CMSKHUniqueId.'">Restore
                        <i class="fas fa-trash-restore"></i>
                    </a>';
        })
        ->make(true);
    } 
    function RestoreDeletedRecord(Request $request)
    {                    
        $Id = $this->CMSKH11UnDeleteRecordTrait($request);
        return response()->json(['status'=>1, 'Id'=>$Id, 
        'Desc1'=>'', 'masterName'=>'Skill ', 'updateMode'=>'Restored']); 
    } 
}

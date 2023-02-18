<?php

namespace App\Http\Controllers\SystemsMaster;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Carbon;
use Auth;
use Validator;
// Add Model here
use App\Models\SystemsMaster\PeriodMaster;
use DataTables;

class FiscalYearPeriodController extends Controller
{
    function Index()
    { 
        $data = [
            'category_name' => 'datatable',
            'page_name' => 'html5',
            'has_scrollspy' => 0,
            'scrollspy_offset' => '',

        ]; 
        return view('SystemsMaster.fiscalYearPeriods')->with($data);
    }

    function BrowserData()
    {
        //Eloquent way - Model is must 
        $browserData = PeriodMaster::select(
                'FYPMHUniqueId', 
                'FYPMHPeriodId',
                'FYPMHDesc1', 
                'FYPMHDesc2',
                'FYPMHNMonth',
                'FYPMHNAddInt',
                'FYPMHUser',
                'FYPMHLastUpdated'
             )->where('FYPMHMarkForDeletion', 0);        
        return DataTables::of($browserData)
        ->addColumn('action', function($periodmaster){
            return '<a href="#" class="btn mr-1 btnEditRec3SIS edit" id="'.$periodmaster->FYPMHUniqueId.'">Edit
                        <i class="fas fa-edit fa-xs"></i>
                    </a>';
        })
        ->make(true);
    }    

    function Fetchdata(Request $request)
    {
        $FYPMHUniqueId = $request->input('id');
        $periodMaster = PeriodMaster::find($FYPMHUniqueId);
        $output = array(
            'FYPMHUniqueId'      =>  $periodMaster->FYPMHUniqueId,
            'FYPMHPeriodId'     =>  $periodMaster->FYPMHPeriodId,
            'FYPMHDesc1'         =>  $periodMaster->FYPMHDesc1,
            'FYPMHDesc2'         =>  $periodMaster->FYPMHDesc2,
            'FYPMHNMonth'        =>  $periodMaster->FYPMHNMonth,
            'FYPMHNAddInt'       =>  $periodMaster->FYPMHNAddInt,
            'FYPMHBiDesc'        =>  $periodMaster->FYPMHBiDesc
        );
        echo json_encode($output);
    }

    function Postdata(Request $request)
    {
        //echo 'Data Submitted.';
        // return $request->input();
        if($request->get('button_action') == 'insert')
        {
            $validator = Validator::make($request->all(), [
                'FYPMHPeriodId' =>  'required|integer|between:1,12|unique:t00901l01,FYPMHPeriodId',
                'FYPMHDesc1'    => 'required|max:100',
                'FYPMHDesc2'    => 'max:200',
                'FYPMHNMonth'   => 'required|integer|between:1,12',
                'FYPMHNAddInt'  => 'required|integer|between:0,1',
                'FYPMHBiDesc'   => 'max:100',
            ]);
        }
        else
        {
            $validator = Validator::make($request->all(), [
                'FYPMHPeriodId' =>  'required|integer|between:1,12|',
                'FYPMHDesc1'    => 'required|max:100',
                'FYPMHDesc2'    => 'max:200',
                'FYPMHNMonth'   => 'required|integer|between:1,12',
                'FYPMHNAddInt'  => 'required|integer|between:0,1',
                'FYPMHBiDesc'   => 'max:100',
            ]);
        }
        if(!$validator->passes()){
            return response()->json(['status'=>0, 'error'=>$validator->errors()->toArray()]);
        }
        else{
            // When add button is pushed
            if($request->get('button_action') == 'insert')
            {
                $periodMaster = new PeriodMaster;
                
                $periodMaster->FYPMHPeriodId        =   $request->FYPMHPeriodId;
                $periodMaster->FYPMHDesc1           =   $request->FYPMHDesc1;
                $periodMaster->FYPMHDesc2           =   $request->FYPMHDesc2;
                $periodMaster->FYPMHNMonth          =   $request->FYPMHNMonth;
                $periodMaster->FYPMHNAddInt         =   $request->FYPMHNAddInt;
                $periodMaster->FYPMHBiDesc          =   $request->FYPMHBiDesc;
                $periodMaster->FYPMHMarkForDeletion =   0;
                $periodMaster->FYPMHUser            =   Auth::user()->name;
                $periodMaster->FYPMHLastCreated     =   Carbon::now();
                $periodMaster->FYPMHLastUpdated     =   Carbon::now();

                $periodMaster->save();
                return response()->json(['status'=>1, 'Id'=>$request->get('FYPMHPeriodId'), 
                    'Desc1'=>$request->get('FYPMHDesc1'),
                    'masterName'=>'Period ', 'updateMode'=>'Added']); 
            }
            // When edit button is pushed
            if($request->get('button_action') == 'update')
            {                
                //Eloquent Way
                $updateTable = PeriodMaster::find($request->get('FYPMHUniqueId'))->update([
                    'FYPMHDesc1'        => $request->FYPMHDesc1,
                    'FYPMHDesc2'        => $request->FYPMHDesc2,
                    'FYPMHNMonth'       => $request->FYPMHNMonth,
                    'FYPMHNAddInt'      => $request->FYPMHNAddInt,
                    'FYPMHBiDesc'       => $request->FYPMHBiDesc,                    
                    'FYPMHUser'         => Auth::user()->name,
                    'FYPMHLastUpdated'  => Carbon::now()                    
                ]);  
                return response()->json(['status'=>1, 'Id'=>$request->get('FYPMHPeriodId'), 
                    'Desc1'=>$request->get('FYPMHDesc1'), 'masterName'=>'Period ', 'updateMode'=>'Updated']);           
            }
                   
        }
    }

    function DeleteData(Request $request)
    {
        $UniqueId = $request->input('id');

        $updateMarkForDeletion = PeriodMaster::find($UniqueId);
        if($updateMarkForDeletion) 
        {
            $updateMarkForDeletion->FYPMHMarkForDeletion     = 1;
            $updateMarkForDeletion->FYPMHUser                = Auth::user()->name;
            $updateMarkForDeletion->FYPMHDeletedAt           = Carbon::now();    
            $updateMarkForDeletion->save();
            return response()->json(['status'=>1, 'Id'=>$updateMarkForDeletion->FYPMHPeriodId, 
                'Desc1'=>$updateMarkForDeletion->FYPMHDesc1, 'masterName'=>'Period ', 'updateMode'=>'Deleted']);
        }
        
    }
}

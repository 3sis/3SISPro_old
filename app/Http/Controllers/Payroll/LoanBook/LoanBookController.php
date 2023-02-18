<?php

namespace App\Http\Controllers\Payroll\LoanBook;

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
use App\Traits\Payroll\LoanBook\loanBookDbOperations;
use App\Traits\DropDown3SIS\dropDowns3SIS;
use App\Traits\TablesSchema3SIS\tablesSchema3SIS;
use App\Traits\GetDescriptions3SIS\getDescriptions3SIS;

class LoanBookController extends Controller
{
    use loanBookDbOperations, dropDowns3SIS, tablesSchema3SIS,getDescriptions3SIS;
    protected  $gCompanyId = '1000';    
    // $this->gCompanyId;

    function Index()
    { 
        $data = $this->dataTableXLSchemaTrait();
        return view('Payroll.LoanBook.loanBook')->with($data);
    }
    function BrowserData()
    {
        //Eloquent way - Model is must
        $BrowserDataTable = $this->BrowserDataTrait();        
        return DataTables::of($BrowserDataTable)
        ->addColumn('action', function($LoanBook){
            return '<a href="#" class="btn mr-1 btnEditRec3SIS edit" id="'.$LoanBook->LALBHUniqueId.'">Edit
                        <i class="fas fa-edit fa-xs"></i>
                    </a>
                    <a href="#" class="btn btnDeleteRec3SIS delete" id="'.$LoanBook->LALBHUniqueId.'">Del
                        <i class="far fa-trash-alt fa-xs"></i>
                    </a>';
        })
        ->make(true);
    }
    function Fetchdata(Request $request){
        // Delete Mem Tables
        $this->DeleteMemTablesTrait($request);
        // Get Header Info
        $fethchedData = $this->FethchEditedDataTrait($request);
        
		//  echo 'Data Submitted.'.$fethchedData;
        // print_r( $fethchedData);
        // die();
        
        // Append Actual table to mem Table
        $this->UpdateMemTable($request);
        
        echo json_encode($fethchedData);
    }
    function BrowserSubFormLoan(Request $request){
        // echo 'Data Submitted at Trait.';
        // return $request->input();
        // die();
        $BrowserDataTableSubDetail = $this->BrowserSubFormLoanDetailMemTrait($request);
        return DataTables::of($BrowserDataTableSubDetail)
        ->addColumn('action', function($MemLoanBook){
            return '<a href="#" class="btn mr-1 btnEditRec3SIS edit_loan" id="'.$MemLoanBook->LALBDUniqueId.'">Edit
                        <i class="fas fa-edit fa-xs"></i>
                    </a>
                    <a href="#" class="btn btnDeleteRec3SIS delete_loan" id="'.$MemLoanBook->LALBDUniqueId.'">Del
                        <i class="far fa-trash-alt fa-xs"></i>
                    </a>';
        })
        ->make(true);
    }
    public function GetLocationDesc(Request $request){        
        $LocationDesc = $this->getLocationDescTrait($request); 
        return response()->json([
            'locationId'=>$LocationDesc->GMLMHLocationId,
            'locationDesc'=>$LocationDesc->GMLMHDesc1
            
        ]);
    }
    //After Continue Press
    public function MemDetailUpdate(Request $request){ 
        $this->ConvertScreenVariablesLoan($request);
        $this->DeleteMemTablesTrait($request);
        $validator = Validator::make($request->all(), [
            'LALBHEmployeeId'    =>  'required',
            'LALBHDeductionId'   =>  'required',
            'LALBHEMIAmount'     =>  'required',
            'LALBHStartDateEMI'  =>  'required',
            'LALBHNoOfEMI'       =>  'required',
            'LALBHLoanAmount'    =>  'required',
        ]);

        if(!$validator->passes()){
            return response()->json(['status'=>0, 'error'=>$validator->errors()->toArray()]);
        }
        else{ 
            $this->DeleteMemTablesTrait($request);
            $BrowserMemDataTable = $this->UpdateMemTableForCountinue($request);
            // return DataTables::of($BrowserMemDataTable)
            // ->make(true);
            return response()->json(['status'=>1, 'Id'=>$request->get('EMGIHEmployeeId'), 
                        'Desc1'=>'', 'masterName'=>'Employee ', 'updateMode'=>'Updated']);  
        }

    }
    function FetchSubFormDataEMI(Request $request){        
        // Get Income Detail Info
        $fethchedData = $this->FethchEditedDataEMITrait($request);        
        echo json_encode($fethchedData);
    }
    function DeleteMemDataLoan(Request $request){
        $this->DeleteMemRecordLoanTrait($request);
        return response()->json(['status'=>1]);        
    }
    function PostSubFormData(Request $request){
        // echo 'Data Submitted.1';
        // return $request->input();
        // die();
        $this->ConvertScreenVariablesLoan($request);
        $errorOutput = '';        
        $validator = Validator::make($request->all(), [
            'LALBDEMIAmount'       =>  'required',
            'LALBDStartDateEMI'    =>  'required',
            // 'LALBDEndDateEMI'      =>  'required|after:LALBDStartDateEMI',
            
        ]);

        if(!$validator->passes()){
            return response()->json(['status'=>0, 'error'=>$validator->errors()->toArray(), 'ErrorOutput'=>$errorOutput]);
        }
        // Check for duplicate entry
        if($request->get('button_action_DetailEntry1') == 'insert')
        {
            $DuplicateFound = $this->CheckDuplicateLoanTrait($request);
            if ($DuplicateFound != '') {
                $errorOutput = 'DUPLICATE - This Entry Exist at line no. : '.$DuplicateFound->LALBDLineNo;
                return response()->json(['status'=>0, 'ErrorOutput'=>$errorOutput]);
            }
        }
        // echo 'Data Submitted.2';
        // return $request->input();
        // die();
        // Check for duplicate entry Ends*****
        $UniqueId = $this->AddUpdateMemLoanTrait($request);
        // echo 'Last Inserted Record. : ' .$UniqueId;
        // die();
        if($request->get('button_action_DetailEntry1') == 'insert')
        {
            return response()->json(['status'=>1, 'Id'=>$request->get('LALBDLineNo'), 
                'Desc1'=>'',
                'masterName'=>'Loan Detail ', 'updateMode'=>'Added']);
        }
        // When edit button is pushed
        if($request->get('button_action_DetailEntry1') == 'update')
        {
            return response()->json(['status'=>1, 'Id'=>$request->get('LALBDLineNo'), 
                'Desc1'=>'',
                'masterName'=>'Loan Detail ', 'updateMode'=>'Updated']);
        }     
        
    }
    function DeleteData(Request $request)
    {
        // echo 'Data Submitted.1';
        // print_r( $request->input());
        // die();
        if ($request->id !=0) {
            $Id = $this->DeleteRecordTrait($request);
            // echo 'Data Submitted.1';
            // print_r( $Id['status']);
            // die();
            if ( $Id['status'] != 0) {
                return response()->json(['status'=>1, 'Id'=> $Id['LALBHLoanId'], 
                'Desc1'=>'','masterName'=>'Loan Book ', 'updateMode'=>'Deleted']); 
            }else{
                return response()->json(['status'=>0, 'Id'=>$Id['LALBHLoanId'], 
                'Desc1'=>'','masterName'=>'Loan Book', 'updateMode'=>'Delete']);
            }
        }
        
    }
    
    function PostHeaderSubformData(Request $request){
        
        $validator = Validator::make($request->all(), [
            'LALBHEmployeeId'    =>  'required',
            'LALBHDeductionId'   =>  'required',
            'LALBHEMIAmount'     =>  'required',
            'LALBHStartDateEMI'  =>  'required',
            'LALBHLoanAmount'    =>  'required',
            'LALBHNoOfEMI'       =>  'required',
        ]);


        if(!$validator->passes()){
            return response()->json(['status'=>0, 'error'=>$validator->errors()->toArray()]);
        }
        $TotalEMI = $this->SumMemTableEMITrait();
        if ($TotalEMI != $request->LALBHRecoveryAmount) {
            $errorOutput = 'Total EMI Amount ('.$TotalEMI.') should be equal to Recovery Amount ('.$request->LALBHRecoveryAmount.').';
            return response()->json(['status'=>0, 'ErrorOutput'=>$errorOutput]);
        }

        $UniqueId = $this->AddUpdateHeaderDetailTrait($request);
        return response()->json(['status'=>1, 'Id'=>$request->get('LALBHLoanId'), 
            'Desc1'=>$request->get(' '),
            'masterName'=>'Loan Book ', 'updateMode'=>'Updated']);
        
    }
    // Update Tables on Final Save
    function AddUpdateHeaderDetailTrait($request){ 
        
        // Move data from Mem Table to Actual Table : Loan Header
        $this->UpdateFormDataToLoanHeaderTrait($request);  
        // echo 'Data Submitted.1';
        // print_r( $request->input());
        // die();     
        // Move data from Mem Table to Actual Table : Loan Detail
        // $this->moveSubFormDataLoanTrait($request);
        // return response()->json(['status'=>1, 'Id'=>"", 
        //     'Desc1'=>"",
        //     'masterName'=>'No Pay Days ', 'updateMode'=>'Updated']);
    }

    function ConvertScreenVariablesLoan($request){
        if ($request->LALBDLineNo == "null") {
            $request->merge(['LALBDLineNo' => '']);
        }
        if ($request->LALBDEMIAmount == 0.00) {
            $request->merge(['LALBDEMIAmount' => '']);
        }
        if ((float)$request->LALBDStartDateEMI == "null") {
            $request->merge(['LALBDStartDateEMI' => '']);
        }
        if ((float)$request->LALBDEndDateEMI == "null") {
            $request->merge(['LALBDEndDateEMI' => '']);
        }
        if ($request->LALBHEmployeeId == "-- Select Employee Id --") {
            $request->merge(['LALBHEmployeeId' => '']);
        }
        if ($request->LALBHDeductionId == "-- Deduction Type --") {
            $request->merge(['LALBHDeductionId' => '']);
        }
    }

}

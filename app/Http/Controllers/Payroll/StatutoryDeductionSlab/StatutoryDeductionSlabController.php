<?php

namespace App\Http\Controllers\Payroll\StatutoryDeductionSlab;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

// Utilities
use Illuminate\Support\Carbon;
use Auth;
use Validator;
use DataTables;
// Traits
use App\Traits\Payroll\StatutoryDeductionSlab\statutoryDeductionSlabDbOperations;
use App\Traits\TablesSchema3SIS\tablesSchema3SIS;

class StatutoryDeductionSlabController extends Controller
{
    protected  $gCompanyId = '1000';
    use statutoryDeductionSlabDbOperations, tablesSchema3SIS;
    #-----------------------------------------------------------------------------------------------------------------
    // Landing Page Browser
    function Index(){
        
        $data = $this->dataTableXLSchemaTrait();
        return view('Payroll.StatutoryDeductionSlab.statutoryDeductionSlab')->with($data);
    }
    function BrowserData(){
        $BrowserDataTable = $this->PMSDS11BrowserDataTrait();
        return DataTables::of($BrowserDataTable)
        ->addColumn('action', function($StatutoryDeductionSlab){
            return '<a href="#" class="btn mr-1 btnEditRec3SIS editLandingPageBrowser" id="'.$StatutoryDeductionSlab->PMRDHUniqueId.'">Edit
                        <i class="fas fa-edit fa-xs"></i>
                    </a>';
        })
        ->make(true);
    }
    // Landing Page Browser Ends*****
    // Landing Page Browser Events    
    function Fetchdata(Request $request){        
        // Delete Mem Tables
        $this->PMSDS11DeleteMemTablesTrait($request);        
        // Get Landing Page Browser Record Info and Update Mem Tables : Header and Detail
        $fethchedData = $this->PMSDS11FethchEditedDataTrait($request);
        echo json_encode($fethchedData);
    }
    // Landing Page Browser Events Ends*****
    #-----------------------------------------------------------------------------------------------------------------
    // Deduction Slab Sub Form Methods : Header
    function BrowserSubFormHeader(Request $request){
        $BrowserDataTable = $this->PMSDS11BrowserSubFormHeaderTrait($request);
        return DataTables::of($BrowserDataTable)
        ->addColumn('action', function($MemDeductionSlabHead){
            return '<a href="#" class="btn mr-1 btnEditRec3SIS edit_slabHead" id="'.$MemDeductionSlabHead->PMDSHUniqueId.'">Edit
                        <i class="fas fa-edit fa-xs"></i>
                    </a>
                    <a href="#" class="btn btnChangeFields3SIS dateChange_slabHead" id="'.$MemDeductionSlabHead->PMDSHUniqueId.'">Date Change
                    <i class="far fa-calendar-times fa-xs"></i>
                    </a>
                    <a href="#" class="btn btnDeleteRec3SIS delete_slabHead" id="'.$MemDeductionSlabHead->PMDSHUniqueId.'">Del
                        <i class="far fa-trash-alt fa-xs"></i>
                    </a>';
                    
        })
        ->make(true);
    }
    function PostHeaderDetailSubform(Request $request){
        // echo 'Data Submitted.';
        // print_r($request->input());
        // die();
        $errorOutputHeader = '';
        // Check for detail mem Table for at least one Entry
        $IsMemTableEmpty = $this->PMSDS11IsHeaderMemTableEmptyTrait();
        if ($IsMemTableEmpty == 0) {
            $errorOutputHeader = 'You must define atleast one Slab at Header Level.';
            return response()->json(['statusHeader'=>0, 'ErrorOutputHeader'=>$errorOutputHeader]);
        }        
        // Check for detail mem Table for at least one Entry Ends*****
        // Now Post Sub Form to Actual Table
        $this->PMSDS11AddUpdateMemToActualTrait($request);
        return response()->json(['status'=>1, 'Id'=>'', 'Desc1'=>'',
                'masterName'=>'Deduction Slab ', 'updateMode'=>'Updated']);
        // Now Post Sub Form to Actual Table Ends*****
    }
    #-----------------------------------------------------------------------------------------------------------------
    // Deduction Slab Sub Form Methods : Detail
    function BrowserSubFormDeductionSlab(Request $request){
        $BrowserDataTable = $this->PMSDS11BrowserSubFormDeductionSlabTrait($request);
        return DataTables::of($BrowserDataTable)
        ->addColumn('action', function($MemDeductionSlabDetail){
            return '<a href="#" class="btn mr-1 btnEditRec3SIS edit_slabDetail" id="'.$MemDeductionSlabDetail->PMDSDUniqueId .'">Edit
                        <i class="fas fa-edit fa-xs"></i>
                    </a>
                    <a href="#" class="btn btnDeleteRec3SIS delete_slabDetail" id="'.$MemDeductionSlabDetail->PMDSDUniqueId .'">Del
                        <i class="far fa-trash-alt fa-xs"></i>
                    </a>';
        })
        ->make(true);
    }
    // Check the required fields on Add button.
    function CheckHeaderData(Request $request){
        $this->ConvertScreenVariablesHeader($request);
        $errorOutputDetail = '';
        $validator = Validator::make($request->all(), [
            'PMDSHEffectiveFrom'    =>  'required',
            'PMDSHEffectiveTo'      =>  'required|after:PMDSHEffectiveFrom',
            'PMDSHGeographicId'     =>  'required',
            'PMDSHGenderId'         =>  "required_if:PMDTHApplicableFor,==,I",
        ]);
        if(!$validator->passes()){
            return response()->json(['status'=>0, 'error'=>$validator->errors()->toArray(), 'ErrorOutputDetail'=>$errorOutputDetail]);
        }
        // Check for the duplicate record
        $duplicateFound = $this->PMSDS11CheckDuplicateTrait($request);
        if ($duplicateFound != 0) {
            $errorOutputDetail = 'Duplicate Entry : You are trying to add a duplicate Record. To add another slab, last slab To Income should be less than 9,999,999,999.99.';
            return response()->json(['status'=>0, 'ErrorOutputDetail'=>$errorOutputDetail]);
        }
        // Get the last Line No.
        $LastLineNo = $this->PMSDS11GetLastLineNoOnAddTrait($request);
        // Get Next From Slab
        $NextFromSlab = $this->PMSDS11GetNextFromSlabOnAddTrait($request);            
        return response()->json(['status'=>1, 'lastLineNo'=>$LastLineNo, 'nextFromSlab'=>$NextFromSlab]);
        
    }
    // When Save button is pushed : Detail Sub Form
    function PostSubFormDataHeader(Request $request){
        $errorOutputDetail = '';
        $this->ConvertScreenVariablesHeader($request);
        // echo 'Data Submitted :';
        // print_r($request->input());
        // die();
        $validator = Validator::make($request->all(), [
            'PMDSHEffectiveFrom'    =>  'required',
            'PMDSHEffectiveTo'      =>  'required|after:PMDSHEffectiveFrom',
            'PMDSHGeographicId'     =>  'required',
            'PMDSHGenderId'         =>  "required_if:PMDTHApplicableFor,==,I",
        ]);
        if(!$validator->passes()){
            return response()->json(['status'=>0, 'error'=>$validator->errors()->toArray(), 'ErrorOutputDetail'=>$errorOutputDetail]);
        }
        // Check for the duplicate record
        $duplicateFound = $this->PMSDS11CheckDuplicateTraitAtSave($request);
        if ($duplicateFound != 0) {
            $errorOutputDetail = 'Duplicate Entry : You are trying to add a duplicate Record.';
            return response()->json(['status'=>0, 'ErrorOutputDetail'=>$errorOutputDetail]);
        }
        // Check for detail mem Table for at least one Entry
        $IsMemTableEmpty = $this->PMSDS11IsMemTableEmptyTrait($request);
        if ($IsMemTableEmpty == 0) {
            $errorOutputDetail = 'You must define atleast one Slab at Detail Level.';
            return response()->json(['status'=>0, 'ErrorOutputDetail'=>$errorOutputDetail]);
        }
        // Check for the last Slab To amount must be = 9999999999.99
        $lastIncomeTo = $this->PMSDS11CheckLastIncomeToTrait($request);
        if ($lastIncomeTo != 9999999999.99) {
            $errorOutputDetail = 'Invalid Last Slab : Last Slab Income To Amount must be 9999999999.99.';
            return response()->json(['status'=>0, 'ErrorOutputDetail'=>$errorOutputDetail]);
        }
        // Update Header Table for this Geograpic Id
        $UniqieIdHeader = $this->PMSDS11IsMemTableHeaderUpdateTrait($request);
        if($request->button_action_DetailEntry1 == 'insert')
        {
            return response()->json(['status'=>1, 'Id'=>'', 'Desc1'=>'', 'masterName'=>'', 'updateMode'=>'Added']);
        }
        // When edit button is pushed
        if($request->button_action_DetailEntry1 == 'update')
        {
            return response()->json(['status'=>1, 'Id'=>'', 'Desc1'=>'', 'masterName'=>'', 'updateMode'=>'Updated']);
        }
    }
    function ConvertScreenVariablesHeader($request){
        if ($request->PMDSHGeographicId == "-- Country --" || $request->PMDSHGeographicId == "-- State --" 
            || $request->PMDSHGeographicId == "-- City --" || $request->PMDSHGeographicId == "-- Location --") {
            $request->merge(['PMDSHGeographicId' => '']);
        }
        if ($request->PMDSHGenderId == "-- Gender --" || $request->PMDSHGenderId == "null") {
            $request->merge(['PMDSHGenderId' => '']);
        }
        if ($request->PMDSHEffectiveFrom == "null") {
            $request->merge(['PMDSHEffectiveFrom' => '']);
        }
        if ($request->PMDSHEffectiveTo == "null") {
            $request->merge(['PMDSHEffectiveTo' => '']);
        }
        if ($request->PMDTHApplicableFor == "C") {
            $request->merge(['PMDSHGenderId' => 'C']);
        }    
    }
    #-----------------------------------------------------------------------------------------------------------------
    // Detail Entry Methods
    function PostSubFormDataDetail(Request $request){        
        $this->ConvertScreenVariablesDetail($request);                
        $validator = Validator::make($request->all(), [
            'PMDSDIncomeFrom'       =>  'numeric|required|min:0.01',
            'PMDSDIncomeTo'         =>  'numeric|required|after:PMDSDIncomeFrom|max:9999999999.99',
            'PMDSDEmpContriAmount'  =>  'required',
        ]);
        if(!$validator->passes()){
            return response()->json(['status'=>0, 'error'=>$validator->errors()->toArray()]);
        }
        $UniqueId = $this->PMSDS11AddUpdateMemStatutoryDeductionSlabDetailTrait($request);
        $LastLineNo = $this->PMSDS11GetLastLineNoOnSaveTrait($request);
        $NextFromSlab = $request->PMDSDIncomeTo != 9999999999.99 ? $request->PMDSDIncomeTo + .01 : 9999999999.99;
        if($request->get('button_action_DetailEntry2') == 'insert')
        {
            return response()->json(['status'=>1, 'Id'=>'', 
                'Desc1'=>'',
                'masterName'=>'Deduction Slab ', 'updateMode'=>'Added', 'lastLineNo'=>$LastLineNo, 'nextFromSlab'=>$NextFromSlab]);
        }
        // When edit button is pushed
        if($request->get('button_action_DetailEntry2') == 'update')
        {
            return response()->json(['status'=>1, 'Id'=>$request->get('EEIMDIncomeId'), 
                'Desc1'=>'',
                'masterName'=>'Employee Income ', 'updateMode'=>'Updated']);
        }
    }
    function ConvertScreenVariablesDetail($request){
        if ((float)$request->PMDSDIncomeFrom <= 0.00) {
            $request->merge(['PMDSDIncomeFrom' => '']);
        }
        if ((float)$request->PMDSDIncomeTo <= 0.00) {
            $request->merge(['PMDSDIncomeTo' => '']);
        }
        if ((float)$request->PMDSDEmpContriAmount <= 0.00) {
            $request->merge(['PMDSDEmpContriAmount' => '']);
        }
    }
    // Detail Entry Methods End*****
    #-----------------------------------------------------------------------------------------------------------------
    // Delete Methods : Header Sub Form
    function FetchSubformHeaderData(Request $request){
        $fetchSubFormHeaderData = $this->PMSDS11FetchSubFormHeaderTrait($request);
        // echo 'Data Submitted : ';
        // print_r($fetchSubFormHeaderData);
        // die();
        echo json_encode($fetchSubFormHeaderData);
    }
    // Update Effective To date for this record
    function DateChangeHeaderDetail(Request $request){
        if ($request->expiryDate == "null") {
            $request->merge(['expiryDate' => '']);
        }
        $validator = Validator::make($request->all(), [
            'expiryDate'    =>  'required',
        ]);
        if(!$validator->passes()){
            return response()->json(['status'=>0, 'error'=>$validator->errors()->toArray()]);
        }else{
            $this->PMSDS11UpdateExpirtyDateTrait($request);            
            return response()->json(['status'=>1]);
        }
    }
    // Soft Delete Header and Detail Records
    function DeleteSubFormHeaderDetail(Request $request){
        // echo 'Data Submitted Shishir : ';
        // print_r($request);
        // die();
        $this->PMSDS11DeleteHeaderDetailTrait($request);
        return;
    }
    #-----------------------------------------------------------------------------------------------------------------
    // Delete Methods : Detail Sub Form
    function FetchSubformDetailData(Request $request){
        $fetchSubFormDetailData = $this->PMSDS11FetchSubFormDetailTrait($request);
        $IncomeTo = floatval($fetchSubFormDetailData['IncomeTo']);
        // Check if the Income To amount is 9,999,999,999.99
        if ($IncomeTo != 9999999999.99 ) {
            $errorOutputDetail = 'Delete Not Allowed : In order to delete Line No. ' .(string)$fetchSubFormDetailData['LineId'] .', You must delete last slab amount 9,999,999,999.99 first';
            return response()->json(['status'=>0, 'ErrorOutputDetail'=>$errorOutputDetail]);
        }
        // Check if there are more than 1 row to delete.
        $countSubFormDetailRecord = $this->PMSDS11CountSubFormDetailTrait($request);
        if ($countSubFormDetailRecord <=1 ) {
            $errorOutputDetail = 'Delete Not Allowed : Min. 1 row is mandatory for this entry.';
            return response()->json(['status'=>0, 'ErrorOutputDetail'=>$errorOutputDetail]);
        }
        echo json_encode($fetchSubFormDetailData);
    }
    function DeleteSubFormDetail(Request $request){
        $deleteThisRow = $this->PMSDS11DeleteThisRowTrait($request);
        return;
    }
    #-----------------------------------------------------------------------------------------------------------------
    // Edit Methods : Detail Sub Form
    function FetchSubFormDataDeductionSlab(Request $request){
        $fetchSubFormDetailDataEdit = $this->PMSDS11FetchSubFormDetailEditTrait($request);
        echo json_encode($fetchSubFormDetailDataEdit);
    }
    #-----------------------------------------------------------------------------------------------------------------
    
}
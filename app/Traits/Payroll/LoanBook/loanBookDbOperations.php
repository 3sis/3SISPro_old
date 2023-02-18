<?php
namespace app\Traits\Payroll\LoanBook;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Auth;
use Illuminate\Support\Carbon;
use App\Models\Payroll\LoanBook\LoanBookHeader;
use App\Models\Payroll\LoanBook\LoanBookDetail;
use App\Models\Payroll\LoanBook\MemLoanBookDetail;
use App\Models\CommonMasters\GeographicInfo\Location;
use App\Models\Payroll\EmployeeMaster\GeneralInfo;
use App\Models\Payroll\IncomeDeductionType\DeductionType;

trait loanBookDbOperations {        
    public function BrowserDataTrait() 
    {

        return $browserData = LoanBookHeader::join('T11101l01', 'T11101l01.EMGIHEmployeeId', '=', 't11130l01.LALBHEmployeeId')
        ->leftjoin('T05901L06', 'T05901L06.GMLMHLocationId', '=', 't11130l01.LALBHLocationId')
        ->leftjoin('T11906l02', 'T11906l02.PMDTHDeductionId', '=', 't11130l01.LALBHDeductionId')
        ->where('t11130l01.LALBHCompanyId', $this->gCompanyId)
        ->where('t11130l01.LALBHMarkForDeletion', 0)
        ->get([ 
            't11130l01.LALBHUniqueId',
            't11130l01.LALBHCompanyId',
            't11130l01.LALBHEmployeeId',
            'T11101l01.EMGIHFullName',
            't11130l01.LALBHLoanId',
            'T11101l01.EMGIHLocationId',
            // Location table field
            'T05901L06.GMLMHDesc1',

            't11130l01.LALBHDeductionId',
            // Deduction table field
            'T11906l02.PMDTHDesc1',
            't11130l01.LALBHLoanAmount',

            't11130l01.LALBHStartDateEMI',
            't11130l01.LALBHEndDateEMI',
            't11130l01.LALBHPaidAmount',
            't11130l01.LALBHBalanceAmount',
            't11130l01.LALBHUser',
            't11130l01.LALBHLastUpdated'
        ]);
    }
    # Edit events - Landing Page Browser
    public function FethchEditedDataTrait($request){        
        // Now Update all the Header fields
        $LALBHUniqueId = $request->input('id');
        $LoanBookHeader = LoanBookHeader::find($LALBHUniqueId);        
        // Get Foreign Keys Description
        $LocationDesc = Location::where('GMLMHLocationId', $LoanBookHeader->LALBHLocationId)
            ->where('GMLMHCompanyId', $this->gCompanyId)        
            ->get(['GMLMHDesc1'])
            ->first();
        $DeductionDesc = DeductionType::where('PMDTHDeductionId', $LoanBookHeader->LALBHDeductionId)
            ->get(['PMDTHDesc1'])
            ->first();
        // $FullName = GeneralInfo::where('EMGIHEmployeeId', $LoanBookHeader->LALBHEmployeeId)
        //     ->get(['EMGIHFullName'])
        //     ->first();
        // Get Foreign Keys Description Ends*****
        return $output = array(

            'LALBHUniqueId'            =>  $LoanBookHeader->LALBHUniqueId,
            'LALBHLoanId'              =>  $LoanBookHeader->LALBHLoanId,
            'LALBHCompanyId'           =>  $LoanBookHeader->LALBHCompanyId,
            'LALBHEmployeeId'          =>  $LoanBookHeader->LALBHEmployeeId,
            // 'EMGIHFullName'         =>  $FullName->EMGIHFullName,
            'LALBHLocationId'          =>  $LoanBookHeader->LALBHLocationId,
            'LocationDesc'             =>  $LocationDesc->GMLMHDesc1,
            'LALBHDeductionId'         =>  $LoanBookHeader->LALBHDeductionId,
            'DeductionDesc'            =>  $DeductionDesc->PMDTHDesc1,
            'LALBHLoanAmount'          =>  $LoanBookHeader->LALBHLoanAmount,
            'LALBHInterestAmount'      =>  $LoanBookHeader->LALBHInterestAmount,
            'LALBHNoOfEMI'             =>  $LoanBookHeader->LALBHNoOfEMI,
            'LALBHEMIAmount'           =>  $LoanBookHeader->LALBHEMIAmount,
            'LALBHStartDateEMI'        =>  $LoanBookHeader->LALBHStartDateEMI,
            'LALBHEndDateEMI'          =>  $LoanBookHeader->LALBHEndDateEMI,
            'LALBHTotalDeduction'      =>  $LoanBookHeader->LALBHTotalDeduction,
            'LALBHRecoveryAmount'      =>  $LoanBookHeader->LALBHRecoveryAmount,
            'LALBHPaidEMI'             =>  $LoanBookHeader->LALBHPaidEMI,
            'LALBHBalanceEMI'          =>  $LoanBookHeader->LALBHBalanceEMI,
            'LALBHPaidAmount'          =>  $LoanBookHeader->LALBHPaidAmount,
            'LALBHBalanceAmount'       =>  $LoanBookHeader->LALBHBalanceAmount,
            'LALBHLoanPaidFully'       =>  $LoanBookHeader->LALBHLoanPaidFully,
            'LALBHUser'                =>  $LoanBookHeader->LALBHUser,
            'LALBHLastCreated'         =>  $LoanBookHeader->LALBHLastCreated,
            'LALBHLastUpdated'         =>  $LoanBookHeader->LALBHLastUpdated
        );
    }
    # Delete Mem Tables
    public function DeleteMemTablesTrait($request){        
        // Delete Mem Table
        $loginName = Auth::user()->name;  
        MemLoanBookDetail::where('LALBDUser', $loginName)
        ->delete();
        return;
    }
    # Append Mem Table 
    public function UpdateMemTable($request){
        $loginName = Auth::user()->name;
        // Add records from Employee LoanBook table to mem table
        $Master = LoanBookDetail::where('LALBDUniqueIdH', $request->id)
        ->where('LALBDStatusId', '!=' , 9999)
        ->orderBy('LALBDLoanId')
        ->get();
        $LineNo = 10;
        foreach ($Master as $key => $value) {
                     
            MemLoanBookDetail::create([
                'LALBDUniqueId'         => $value -> LALBDUniqueId,
                'LALBDUniqueIdH'        => $value -> LALBDUniqueIdH,
                'LALBDLoanId'           => $value -> LALBDLoanId,
                'LALBDCompanyId'        => $value -> LALBDCompanyId,
                'LALBDLocationId'       => $value -> LALBDLocationId,
                'LALBDEmployeeId'       => $value -> LALBDEmployeeId,
                'LALBDDeductionId'      => $value -> LALBDDeductionId,
                'LALBDLineNo'           => $LineNo,
                'LALBDEMIAmount'        => $value -> LALBDEMIAmount,
                'LALBDPaidAmount'       => $value -> LALBDPaidAmount,
                'LALBDBalanceAmount'    => $value -> LALBDBalanceAmount,
                'LALBDStartDateEMI'     => $value -> LALBDStartDateEMI,
                'LALBDEndDateEMI'       => $value -> LALBDEndDateEMI,
                'LALBDMarkForDeletion'  => $value -> LALBDMarkForDeletion,
                'LALBDUser'             => $loginName,
                'LALBDStatusId'         => $value -> LALBDStatusId,
                'LALBDLastCreated'      => $value -> LALBDLastCreated,
                'LALBDLastUpdated'      => $value -> LALBDLastUpdated,
                'LALBDDeletedAt'        => $value -> LALBDDeletedAt,
                
            ]);     
            $LineNo++;
        }
    }
    # LoanBook Mem Sub Form
    public function BrowserSubFormLoanDetailMemTrait($request){
        // return $browserData = MemLoanBookDetail::join('T11101l01', 'T11101l01.EMGIHEmployeeId', '=', 't11130l01.LALBHEmployeeId')
        // ->leftjoin('T05901L06', 'T05901L06.GMLMHLocationId', '=', 't11130l01.LALBHLocationId')
        // ->leftjoin('T11906l02', 'T11906l02.PMDTHDeductionId', '=', 't11130l01.LALBHDeductionId')
        // ->where('LALBDUniqueIdH', $request ->LALBHUniqueId)
        // ->where('t11130l01.LALBHMarkForDeletion', 0)
        // echo 'Data Submitted at Trait.1';
        // print_r($request->input());
        // die();
        return $browserData = MemLoanBookDetail::get([
            'LALBDLineNo', 
            'LALBDEMIAmount',
            'LALBDPaidAmount',
            'LALBDBalanceAmount', 
            'LALBDStartDateEMI',
            'LALBDEndDateEMI',
            'LALBDUser',
            'LALBDMarkForDeletion',
            'LALBDUniqueId'
         ]);
    }
    public function UpdateMemTableForCountinue($request){
        // 
        // echo 'Data Submitted.1';
        // print_r( $request->input());
        // die(); 
        $loginName = Auth::user()->name;
        $GeneralInfo = GeneralInfo::where('EMGIHEmployeeId', $request->LALBHEmployeeId)
        ->where('EMGIHCompId', $this->gCompanyId)
        ->get()
        ->first();
        $LineNo = 10;
        $noOfEMI     = $request -> LALBHNoOfEMI;
        $startOfMonth =$request->LALBHStartDateEMI;
        // echo 'Data Submitted at Trait.';
        // print_r($LineNo);
        // die();
        for($noOfEMI=0; $noOfEMI< $request->LALBHNoOfEMI; $noOfEMI++){
            $endOfMonth = Carbon::parse($startOfMonth)->endOfMonth();
            
            MemLoanBookDetail::create([
                // 'EEDMDUniqueIdEmp'      => $request->id,
                'LALBDCompanyId'        => $this->gCompanyId,
                'LALBDLocationId'       => $request -> LALBHLocationId,
                'LALBDEmployeeId'       => $request -> LALBHEmployeeId,
                'LALBDDeductionId'      => $request -> LALBHDeductionId,
                'LALBDLineNo'           => $LineNo,
                'LALBDEMIAmount'        => $request -> LALBHEMIAmount,
                'LALBDBalanceAmount'    => $request -> LALBDBalanceAmount,
                'LALBDStartDateEMI'     => $startOfMonth,
                'LALBDEndDateEMI'       => $endOfMonth,
                'LALBDUser'             => $loginName,
                'LALBDStatusId'         => 1000,

                
            ]);     
            $LineNo++;
            $startOfMonth = $endOfMonth->addDays(1);
            // $noOfEMI=$noOfEMI-1;
        }
    }
    public function FethchEditedDataEMITrait($request){  
        $loginName = Auth::user()->name;
        $LALBDUniqueId = $request->input('id');
        $MemLoanEMIDetail = MemLoanBookDetail::find($LALBDUniqueId);
        return $output = array(
                'LALBDUniqueId'         => $MemLoanEMIDetail ->LALBDUniqueId,
                'LALBDUniqueIdH'        => $MemLoanEMIDetail ->LALBDUniqueIdH,
                'LALBDCompanyId'        => $MemLoanEMIDetail ->LALBDCompanyId,
                'LALBDLocationId'       => $MemLoanEMIDetail -> LALBDLocationId,
                'LALBDEmployeeId'       => $MemLoanEMIDetail -> LALBDEmployeeId,
                'LALBDDeductionId'      => $MemLoanEMIDetail -> LALBDDeductionId,
                'LALBDLineNo'           => $MemLoanEMIDetail -> LALBDLineNo,
                'LALBDEMIAmount'        => $MemLoanEMIDetail -> LALBDEMIAmount,
                'LALBDBalanceAmount'    => $MemLoanEMIDetail -> LALBDBalanceAmount,
                'LALBDStartDateEMI'     => $MemLoanEMIDetail -> LALBDStartDateEMI,
                'LALBDEndDateEMI'       => $MemLoanEMIDetail -> LALBDEndDateEMI,
                'LALBDUser'             => $loginName
        );
    }
    public function DeleteMemRecordLoanTrait($request){
        $UniqueId = $request->input('id');
        $MemLoanBookDetail = MemLoanBookDetail::where('LALBDUniqueId', $UniqueId)
        ->where('LALBDPaidAmount', 0)
        ->get()
        ->first();
        $MemLoanBookDetail->LALBDMarkForDeletion    = $MemLoanBookDetail->LALBDMarkForDeletion == 0 ? 1 : 0;
        $MemLoanBookDetail->LALBDStatusId           = $MemLoanBookDetail->LALBDMarkForDeletion == 0 ? 1000 : 9910;
        $MemLoanBookDetail->LALBDDeletedAt          = $MemLoanBookDetail->LALBDMarkForDeletion == 0 ? NULL : Carbon::now();
        $MemLoanBookDetail->save();
        return;
    }
    public function CheckDuplicateLoanTrait($request){
        if ($request->button_action_DetailEntry1 == 'insert') {
            # code...
            return $DuplicateFound = MemLoanBookDetail::where('LALBDUniqueIdH', $request->LALBHUniqueId)
            ->where('LALBDEmployeeId', $request->LALBHEmployeeId)
            ->where('LALBDDeductionId', $request->LALBHDeductionId)
            ->where('LALBDStartDateEMI', $request->LALBDStartDateEMI)
            ->where('LALBDEndDateEMI', $request->LALBDEndDateEMI)
            ->get(['LALBDLineNo'])
            ->first();            
        } else {
            # code...
            return $DuplicateFound = MemLoanBookDetail::where('LALBDUniqueIdH', $request->LALBHUniqueId)
            ->where('LALBDEmployeeId', $request->LALBHEmployeeId)
            ->where('LALBDDeductionId', $request->LALBHDeductionId)
            ->where('LALBDStartDateEMI', $request->LALBDStartDateEMI)
            ->where('LALBDEndDateEMI', $request->LALBDEndDateEMI)
            ->where('LALBDUniqueId', '!=' ,$request->LALBDUniqueId)
            ->get(['LALBDLineNo'])
            ->first();      
        }
    }
    public function AddUpdateMemLoanTrait($request){
        // echo 'Data Submitted at Trait.1';
        // print_r($request->input());
        // die();
        if($request->get('button_action_DetailEntry1') == 'insert') {
            // Find the last Line No.
            $getLastLineNo = MemLoanBookDetail::where('LALBDUniqueIdH', $request->LALBHUniqueId)
            ->orderBy('LALBDLineNo', 'desc')
            ->get(['LALBDLineNo'])
            ->first();
            $HeadUniqueId = 10;

            if ($getLastLineNo == '') {
                $LastLineNo = 10;
            } else {
                $LastLineNo = (int)$getLastLineNo->LALBDLineNo + 1;
            }            
            $MemLoanBookDetail = new MemLoanBookDetail;                
            $MemLoanBookDetail->LALBDUniqueIdH          =   $request->LALBHUniqueId;            
            $MemLoanBookDetail->LALBDLineNo             =   $LastLineNo;            
            $MemLoanBookDetail->LALBDLoanId             =   $request->LALBHLoanId;       
            $MemLoanBookDetail->LALBDCompanyId          =   $this->gCompanyId;        
            $MemLoanBookDetail->LALBDLocationId         =   $request->LALBHLocationId; 
            $MemLoanBookDetail->LALBDEmployeeId         =   $request->LALBHEmployeeId; 
            $MemLoanBookDetail->LALBDDeductionId        =   $request->LALBHDeductionId; 
            $MemLoanBookDetail->LALBDStatusId           =   1000; 
            $MemLoanBookDetail->LALBDLastCreated        =   Carbon::now();
        }elseif($request->get('button_action_DetailEntry1') == 'update'){
            $MemLoanBookDetail = MemLoanBookDetail::find($request->get('LALBDUniqueId'));
        //     echo 'Data Submitted at Trait.1';
        // print_r($MemLoanBookDetail);
        // die();
        } 
        $MemLoanBookDetail->LALBDEMIAmount              =   $request->LALBDEMIAmount;
        $MemLoanBookDetail->LALBDPaidAmount             =   $request->LALBDPaidAmount;
        $MemLoanBookDetail->LALBDBalanceAmount          =   $request->LALBDBalanceAmount;
        $MemLoanBookDetail->LALBDStartDateEMI           =   $request->LALBDStartDateEMI;
        $MemLoanBookDetail->LALBDEndDateEMI             =   $request->LALBDEndDateEMI;
        $MemLoanBookDetail->LALBDUser                   =   Auth::user()->name;
        $MemLoanBookDetail->LALBDLastUpdated            =   Carbon::now();
        $MemLoanBookDetail->save(); 
        if($request->get('button_action_DetailEntry1') == 'insert') {
            $UniqueId = $MemLoanBookDetail->LALBDUniqueId; 
        }elseif($request->get('button_action_DetailEntry1') == 'update'){
            $UniqueId = $request->get('LALBDUniqueId');
        }
        return $UniqueId; 
    }
    public function UpdateFormDataToLoanHeaderTrait($request)
     {
        $LoanId = Carbon::now()->timestamp;
        
        // echo 'Data Submitted.1'.$LoanId1.' . '.$LoanId2.' . ';
        // print_r( $LoanId);
        // die();  
        if($request->get('button_action') == 'insert') {
            $LoanBookHeader = new LoanBookHeader;                
            $LoanBookHeader->LALBHLoanId        = $LoanId;
            $LoanBookHeader->LALBHCompanyId     = $this->gCompanyId;;
            $LoanBookHeader->LALBHLocationId    = $request->LALBHLocationId;
            $LoanBookHeader->LALBHEmployeeId    = $request->LALBHEmployeeId;
            $LoanBookHeader->LALBHDeductionId   = $request->LALBHDeductionId;            
            $LoanBookHeader->LALBHLastCreated   = Carbon::now();
        }elseif($request->get('button_action') == 'update'){
            $LoanBookHeader = LoanBookHeader::find($request->get('LALBHUniqueId'));
        }
        $LoanBookHeader->LALBHLoanAmount     = $request->LALBHLoanAmount;
        $LoanBookHeader->LALBHInterestAmount = $request->LALBHInterestAmount;
        $LoanBookHeader->LALBHRecoveryAmount = $request->LALBHRecoveryAmount;
        $LoanBookHeader->LALBHNoOfEMI        = $request->LALBHNoOfEMI;
        $LoanBookHeader->LALBHEMIAmount      = $request->LALBHEMIAmount;
        $LoanBookHeader->LALBHTotalDeduction = $request->LALBHTotalDeduction;
        $LoanBookHeader->LALBHStartDateEMI   = $request->LALBHStartDateEMI;
        $LoanBookHeader->LALBHEndDateEMI     = $request->LALBHEndDateEMI;
        $LoanBookHeader->LALBHMarkForDeletion =0;
        $LoanBookHeader->LALBHUser           = Auth::user()->name;
        $LoanBookHeader->LALBHStatusId       = $request->LALBHStatusId;
        $LoanBookHeader->LALBHLastUpdated    = Carbon::now();
        $LoanBookHeader->save(); 
        if($request->get('button_action') == 'insert') {
            $UniqueId = $LoanBookHeader->LALBHUniqueId; 
        }elseif($request->get('button_action') == 'update'){
            $UniqueId = $request->get('LALBHUniqueId');
        }
        $this->moveSubFormDataLoanTrait($UniqueId,$LoanId);
        // echo 'Data Submitted.1';
        // print_r( $UniqueId);
        // die();  
        return $UniqueId; 
    }
    public function DeleteRecordTrait($request)
    {
       $LoanBookHeader = LoanBookHeader::where('LALBHUniqueId', $request->id)
       ->get()
       ->first();
       $PaidAmount = $LoanBookHeader->LALBHPaidAmount;
       if($PaidAmount == 0){
            LoanBookHeader::where('LALBHUniqueId', $request->id)
            ->delete();
            LoanBookDetail::where('LALBDUniqueIdH', $request->id)
            ->delete();
            return $output = array(
                'LALBHLoanId'=>$LoanBookHeader->LALBHLoanId,
                'status'=>1
            );
       }
       return $output = array(
            'LALBHLoanId'=>$LoanBookHeader->LALBHLoanId,
            'status'=>0
        );
    }
    function moveSubFormDataLoanTrait($UniqueId ,$LoanId){
        
        $MemLoanBookDetail = MemLoanBookDetail::orderBy('LALBDLineNo')
        ->get();
        foreach ($MemLoanBookDetail as $key => $value) {
            LoanBookDetail::create([
                                
                'LALBDUniqueIdH'        => $UniqueId,
                'LALBDLoanId'           => $LoanId,
                'LALBDCompanyId'        => $value->LALBDCompanyId,
                'LALBDLocationId'       => $value->LALBDLocationId,
                'LALBDEmployeeId'       => $value->LALBDEmployeeId,
                'LALBDDeductionId'      => $value->LALBDDeductionId,
                'LALBDEMIAmount'        => $value->LALBDEMIAmount,
                'LALBDPaidAmount'       => $value->LALBDPaidAmount,
                'LALBDBalanceAmount'    => $value->LALBDBalanceAmount,
                'LALBDStartDateEMI'     => $value->LALBDStartDateEMI,
                'LALBDEndDateEMI'       => $value->LALBDEndDateEMI,
                'LALBDMarkForDeletion'  => $value->LALBDMarkForDeletion,
                'LALBDUser'             => Auth::user()->name,
                'LALBDStatusId'         => $value->LALBDStatusId,
                'LALBDLastCreated'      => $value->LALBDLastCreated,
                'LALBDLastUpdated'      => $value->LALBDLastUpdated,
                'LALBDDeletedAt'        => $value->LALBDDeletedAt,


            ]);
        }
    }
    public function SumMemTableEMITrait(){
        return $TotalEMI = MemLoanBookDetail::where('LALBDUser', Auth::user()->name)
        ->where('LALBDMarkForDeletion', 0)
        ->sum('LALBDEMIAmount');
        
    }
}
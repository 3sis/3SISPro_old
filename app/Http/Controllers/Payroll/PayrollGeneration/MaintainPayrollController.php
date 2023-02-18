<?php

namespace App\Http\Controllers\Payroll\PayrollGeneration;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Carbon;
use Auth;
use Validator;
use DataTables;
// Traits
// use App\Traits\Payroll\PayrollGeneration\maintainPayrollDbOperations;
use App\Traits\Payroll\PayrollGeneration\maintainPayrollDbOperations;
use App\Traits\DropDown3SIS\dropDowns3SIS;
use App\Traits\TablesSchema3SIS\tablesSchema3SIS;

class MaintainPayrollController extends Controller
{
    use maintainPayrollDbOperations, dropDowns3SIS, tablesSchema3SIS;
    protected  $gCompanyId = '1000';

    function Index()
    {
        $data = $this->dataTableXLSchemaTrait();
        // $this->ZmemDeleteTrait();   
        return view('Payroll.PayrollGeneration.maintainPayroll')->with($data);
    }
    function BrowserData()
    {
        //Eloquent way - Model is must
        $BrowserDataTable = $this->BrowserDataTrait();
        return DataTables::of($BrowserDataTable)
        ->addColumn('action', function($PayrollHeaderMem){
            return '<a href="#" class="btn mr-1 btnEditRec3SIS editHeader" id="'.$PayrollHeaderMem->PGGPHUniqueId.'">Edit
                        <i class="fas fa-edit fa-xs"></i>
                    </a>';
        })

        ->make(true);
    }
    function BrowserPayrollDetailData(Request $request)
    {
        //Eloquent way - Model is must
        $BrowserDetailDataTable = $this->BrowserPayrollDetailDataTrait($request);
        return DataTables::of($BrowserDetailDataTable)
        ->addColumn('action', function($BrowserDetailDataTable){
            return '<a href="#" class="btn mr-1 btnEditRec3SIS editDetail" id="'.$BrowserDetailDataTable->PGGPDUniqueId.'">Edit
                        <i class="fas fa-edit fa-xs"></i>
                    </a>
                    <a href="#" class="btn btnDeleteRec3SIS deleteDetail" id="'.$BrowserDetailDataTable->PGGPDUniqueId.'">Del
                        <i class="far fa-trash-alt fa-xs"></i>
                    </a>';
        })
        ->make(true);
    }
    function FetchSubFormDataDetail(Request $request){        
        // Get Deduction Detail Info        
        $fethchedData = $this->FethchEditedDetailDataTrait($request);        
        echo json_encode($fethchedData);
    }
    function PostSubFormDetailData(Request $request){
        // echo 'Data Submitted.';
        // return $request->input();
        // die();
        
    }
}

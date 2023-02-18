<?php

namespace App\Http\Controllers\CommonMasters\FiscalYear;

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
use App\Traits\CommonMasters\FiscalYear\MaintainCalendarDbOperations;
use App\Traits\TablesSchema3SIS\tablesSchema3SIS;
use App\Traits\GetDescriptions3SIS\getDescriptions3SIS;
use App\Traits\DropDown3SIS\dropDowns3SIS;


class MaintainCalendarController extends Controller
{
    use MaintainCalendarDbOperations, getDescriptions3SIS, dropDowns3SIS,tablesSchema3SIS;
    protected  $gCompanyId = '1000'; 
    function Index()
    { 
        $data = $this->dataTableXLSchemaTrait();
        return view('CommonMasters.FiscalYear.populateCalendar')->with($data);
    }
    function BrowserData()
    {
        //Eloquent way - Model is must
        $BrowserDataTable = $this->BrowserDataTrait();        
        return DataTables::of($BrowserDataTable)
        ->editColumn('FYCOHOffDate', function ($BrowserDataTable) {
            return $BrowserDataTable->FYCOHOffDate ? with(new Carbon($BrowserDataTable->FYCOHOffDate))->format('d/m/Y') : '';
        })
        ->editColumn('OffDateSort', function ($BrowserDataTable) {
            return $BrowserDataTable->OffDateSort ? with(new Carbon($BrowserDataTable->OffDateSort))->format('Y/m/d') : '';
        })
        ->make(true);
    } 
    function GenerateCalendar(Request $request){
        // echo 'Data Submitted.1';
        // return $request->input();
        // die();
        $errorOutput = '';        
        $validator = Validator::make($request->all(), [
            'FYCOHCalendarId'       =>  'required',  
            'FYCOHFiscalYearId'     =>  'required',
        ]);
        if(!$validator->passes()){
            return response()->json(['status'=>0, 'error'=>$validator->errors()->toArray(), 'ErrorOutput'=>$errorOutput]);
        }
        $this->DeleteTablesTrait($request);
        $UniqueId = $this->PopulateCalendarTrait($request);
        return response()->json(['status'=>1, 'Id'=>$request->get('FYCOHFiscalYearId'), 
            'Desc1'=>'',
            'masterName'=>'Populate Calendar ', 'updateMode'=>'Added']);
    }
    public function GetFiscalYearDate(Request $request){        
        $FiscalYearDate = $this->getFiscalYearDateTrait($request); 
        return response()->json([
            'startDate'=>$FiscalYearDate[0]->FYFYHStartDate, 
            'endDate'=>$FiscalYearDate[0]->FYFYHEndDate, 
            
        ]);
    }

}
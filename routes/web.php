<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CommonMasters\FiscalYear\WeeklyOffController;
use App\Http\Controllers\CommonMasters\GeographicInfo\CountryController;
use App\Http\Controllers\CommonMasters\GeographicInfo\StateController;
use App\Http\Controllers\CommonMasters\GeographicInfo\CityController;
use App\Http\Controllers\CommonMasters\GeographicInfo\LocationController;
use App\Http\Controllers\CommonMasters\FiscalYear\FiscalYearController;
use App\Http\Controllers\SystemsMaster\FiscalYearPeriodController;
use App\Http\Controllers\CommonMasters\FiscalYear\CalendarController;
use App\Http\Controllers\CommonMasters\BankingMaster\AcctTypeController;
use App\Http\Controllers\CommonMasters\BankingMaster\BankController;
use App\Http\Controllers\CommonMasters\BankingMaster\BranchController;
use App\Http\Controllers\CommonMasters\BankingMaster\PaymentModeController;
use App\Http\Controllers\CommonMasters\FiscalYear\PublicHolidayController;
use App\Http\Controllers\CommonMasters\FiscalYear\MaintainCalendarController;
use App\Http\Controllers\CommonMasters\GeneralMaster\CompanyController;
use App\Http\Controllers\CommonMasters\GeneralMaster\CurrencyController;
// Payroll General Master
use App\Http\Controllers\Payroll\GeneralMaster\SalutationController;
use App\Http\Controllers\Payroll\GeneralMaster\GenderController;
use App\Http\Controllers\Payroll\GeneralMaster\BloodGroupController;
use App\Http\Controllers\Payroll\GeneralMaster\NationalityController;
use App\Http\Controllers\Payroll\GeneralMaster\RaceController;
use App\Http\Controllers\Payroll\GeneralMaster\ReligionMasterController;
use App\Http\Controllers\Payroll\GeneralMaster\MaritalStatusController;
use App\Http\Controllers\Payroll\GeneralMaster\PhysicalStatusController;
// Payroll General Master Ends*****
// Payroll Employee Status
use App\Http\Controllers\Payroll\EmployeeStatus\DepartmentController;
use App\Http\Controllers\Payroll\EmployeeStatus\DesignationController;
use App\Http\Controllers\Payroll\EmployeeStatus\GradeController;
use App\Http\Controllers\Payroll\EmployeeStatus\TypeController;
// Payroll Employee Status Ends*****
// Payroll Employee Credentials
use App\Http\Controllers\Payroll\Credentials\CertificatesController;
use App\Http\Controllers\Payroll\Credentials\QualificationController;
use App\Http\Controllers\Payroll\Credentials\SkillsController;
// Payroll Employee Credentials Ends*****
// Payroll Income Deduction Type Masters
use App\Http\Controllers\Payroll\IncomeDeductionType\IncomeTypeController;
use App\Http\Controllers\Payroll\IncomeDeductionType\DeductionTypeController;
// Payroll Income Deduction Type Master Ends*****

// Payroll Employee Earning Master
use App\Http\Controllers\Payroll\EmployeeEarnings\EmployeeEarningsController;
// Payroll Employee Earning Master Ends*****

// Employee Loan & Advances Master
use App\Http\Controllers\Payroll\LoanBook\LoanBookController;
// Employee Loan & Advances Master Ends*****

// Statutory Deduction Slab
use App\Http\Controllers\Payroll\StatutoryDeductionSlab\StatutoryDeductionSlabController;
// Statutory Deduction Slab Ends*****
//No Pay Days
use App\Http\Controllers\Payroll\PayrollGeneration\NoPayDaysController;
//No Pay Days Ends*****
//Salary Slash
use App\Http\Controllers\Payroll\PayrollGeneration\SalarySlashController;
//Salary Slash Ends*****
//Income Adjustment
use App\Http\Controllers\Payroll\PayrollGeneration\IncomeAdjustmentController;
//Income Adjustment Ends*****
//Adhoc Payment
use App\Http\Controllers\Payroll\PayrollGeneration\AdhocPaymentPeriodController;
//Adhoc Payment Ends*****
//Payroll Generation
use App\Http\Controllers\Payroll\PayrollGeneration\PayrollGenerationController;
//Payroll Generation Ends*****
//Maintain Payroll 
use App\Http\Controllers\Payroll\PayrollGeneration\MaintainPayrollController;
//Maintain Payroll Ends*****
// Employee Master : Gneral Info
use App\Http\Controllers\Payroll\EmployeeMaster\GeneralInfoController;
// Employee Master : Gneral Info Ends*****

use App\Http\Controllers\DropdownMasters\DropDownController;
use App\Http\Controllers\SystemsMaster\PaymentMaster\RuleDefinitionController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/analytics', function() {
    // $category_name = '';
    $data = [
        'category_name' => 'dashboard',
        'page_name' => 'analytics',
        'has_scrollspy' => 0,
        'scrollspy_offset' => '',
    ];
    // $pageName = 'analytics';
    return view('dashboard2')->with($data);
});

Route::group(['middleware' => 'auth'] , function() {
    //Route for Employee Master 3SIS
    //Route for GeneralInfo 
    Route::get('/generalInfo/index', [GeneralInfoController::class, 'Index']);
    Route::GET('/generalInfo/Master',[GeneralInfoController::class, 'BrowserData'])->name('generalInfo.browserData');
    Route::GET('/generalInfo/Master/Update',[GeneralInfoController::class, 'FetchData'])->name('generalInfo.fetchData');
    Route::POST('/generalInfo/Master/Add',[GeneralInfoController::class, 'PostData'])->name('generalInfo.postData');
    Route::GET('/generalInfo/Master/Delete',[GeneralInfoController::class, 'DeleteData'])->name('generalInfo.deleteData');
    Route::GET('/generalInfo/Master1',[GeneralInfoController::class, 'BrowserDeletedRecords'])->name('generalInfo.browserDeletedRecords');
    Route::GET('/generalInfo/Master/Undelete',[GeneralInfoController::class, 'RestoreDeletedRecord'])->name('generalInfo.restoreDeletedRecords');
    Route::GET('/generalInfo/getselectedLocation',[GeneralInfoController::class, 'GetSelectedLocation'])->name('generalInfo.getSelectedLocation');
    //Route for GeneralInfo 3SIS Ends*****
    //Route for Employee Master 3SIS Ends*****
    // No Pay Days
    Route::GET('/noPayDays/importform', [NoPayDaysController::class, 'ImportForm']);
    Route::POST('/noPayDays/importexcel',[NoPayDaysController::class, 'Import'])->name('noPayDays.import');
    Route::GET('/noPayDays/Master',[NoPayDaysController::class, 'BrowserData'])->name('noPayDays.browserData');
    Route::POST('/noPayDays/Master/Add',[NoPayDaysController::class, 'PostData'])->name('noPayDays.postData');
    Route::get('/noPayDays/index', [NoPayDaysController::class, 'Index']);
    Route::GET('/noPayDays/loadSubForm',[NoPayDaysController::class, 'LoadSubForm'])->name('noPayDays.loadSubForm');
    Route::POST('/noPayDays/postHeaderFormData',[NoPayDaysController::class, 'PostHeaderFormData'])->name('noPayDays.postHeaderFormData');
    Route::GET('/noPayDays/Master/Update',[NoPayDaysController::class, 'FetchData'])->name('noPayDays.fetchData');
    Route::GET('/noPayDays/Master/Delete',[NoPayDaysController::class, 'DeleteData'])->name('noPayDays.deleteData');





    // No Pay Days Ends*****
    // Payroll Generation
    Route::GET('/payrollGeneration/landingForm', [PayrollGenerationController::class, 'LandingForm']);
    Route::GET('/payrollGeneration/generatePayroll',[PayrollGenerationController::class, 'GeneratePayroll'])->name('payrollGeneration.generatePayroll');
    Route::GET('/payrollGeneration/Master',[PayrollGenerationController::class, 'BrowserData'])->name('payrollGeneration.browserData');
    Route::POST('/payrollGeneration/Master/Add',[PayrollGenerationController::class, 'PostData'])->name('payrollGeneration.postData');
    Route::GET('/payrollGeneration/updateMemEmployee',[PayrollGenerationController::class, 'UpdateMemEmployee'])->name('payrollGeneration.updateMemEmployee');
    Route::GET('/payrollGeneration/select_UnSelect',[PayrollGenerationController::class, 'Select_UnSelectEmployee'])->name('payrollGeneration.select_UnSelect');
    Route::GET('/payrollGeneration/employeeList',[PayrollGenerationController::class, 'BrowserEmployeeList'])->name('payrollGeneration.browserEmployeeList');
    Route::GET('/payrollGeneration/Detail',[PayrollGenerationController::class, 'BrowserPayrollDetailData'])->name('payrollGeneration.browserPayrollDetail');



    // Payroll Generation Ends*****
    // Maintain Payroll
    Route::GET('/maintainPayroll/index', [MaintainPayrollController::class, 'Index']);
    Route::GET('/maintainPayroll/Master',[MaintainPayrollController::class, 'BrowserData'])->name('maintainPayroll.browserData');
    Route::GET('/maintainPayroll/Detail',[MaintainPayrollController::class, 'BrowserPayrollDetailData'])->name('maintainPayroll.browserPayrollDetail');
    Route::GET('/maintainPayroll/fetchSubFormDataDetail',[MaintainPayrollController::class, 'FetchSubFormDataDetail'])->name('maintainPayroll.fetchSubFormDataDetail');
    Route::POST('/maintainPayroll/Master/DetailUpdate',[MaintainPayrollController::class, 'PostSubFormDetailData'])->name('maintainPayroll.postSubFormDetailData');


    // Maintain Payroll Ends*****

    // Salary Slash

    Route::GET('/salarySlash/index', [SalarySlashController::class, 'Index']);
    Route::POST('/salarySlash/importexcel',[SalarySlashController::class, 'Import'])->name('salarySlash.import');
    Route::GET('/salarySlash/Master',[SalarySlashController::class, 'BrowserData'])->name('salarySlash.browserData');
    Route::POST('/salarySlash/Master/Add',[SalarySlashController::class, 'PostData'])->name('salarySlash.postData');
    Route::GET('/salarySlash/select_UnSelect',[SalarySlashController::class, 'Select_UnSelect'])->name('salarySlash.select_UnSelect');
    Route::GET('/salarySlash/updateIncomeTypeMem',[SalarySlashController::class, 'UpdateIncomeTypeMem'])->name('salarySlash.updateIncomeTypeMem');
    Route::GET('/salarySlash/select_UnSelectIncomeType',[SalarySlashController::class, 'select_UnSelectIncomeType'])->name('salarySlash.select_UnSelectIncomeType');
    Route::GET('/salarySlash/IncomeTypeList',[SalarySlashController::class, 'BrowserIncomeTypeList'])->name('salarySlash.browserIncomeTypeList');
    Route::GET('/salarySlash/indexHed', [SalarySlashController::class, 'IndexHed']);
    Route::GET('/salarySlash/BrowserHeadData',[SalarySlashController::class, 'BrowserHeadData'])->name('salarySlash.browserHeadData');
    Route::GET('/salarySlash/browserDetailData',[SalarySlashController::class, 'BrowserDetailData'])->name('salarySlash.browserDetailData');
    Route::GET('/salarySlash/fetchSubFormDataIncome',[SalarySlashController::class, 'FetchSubFormDataIncome'])->name('salarySlash.fetchSubFormDataIncome');

    Route::POST('/salarySlash/Master/Update',[SalarySlashController::class, 'PostSubFormDataIncome'])->name('salarySlash.postSubFormDataIncome');
    Route::GET('/salarySlash/deleteSalarySlashDetail',[SalarySlashController::class, 'DeleteSalarySlashDetail'])->name('salarySlash.deleteSalarySlashDetail');



    // Salary Slash Ends*****
    
    // Income Adjustment

    Route::GET('/incomeAdjustment/index', [IncomeAdjustmentController::class, 'Index']);
    Route::POST('/incomeAdjustment/importexcel',[IncomeAdjustmentController::class, 'Import'])->name('incomeAdjustment.import');
    Route::GET('/incomeAdjustment/Master',[IncomeAdjustmentController::class, 'BrowserData'])->name('incomeAdjustment.browserData');
    Route::POST('/incomeAdjustment/Master/Add',[IncomeAdjustmentController::class, 'PostData'])->name('incomeAdjustment.postData');
    Route::GET('/incomeAdjustment/select_UnSelect',[IncomeAdjustmentController::class, 'Select_UnSelect'])->name('incomeAdjustment.select_UnSelect');
    Route::GET('/incomeAdjustment/updateDeductionTypeMem',[IncomeAdjustmentController::class, 'UpdateDeductionTypeMem'])->name('incomeAdjustment.updateDeductionTypeMem');
    Route::GET('/incomeAdjustment/select_UnSelectDeductionType',[IncomeAdjustmentController::class, 'select_UnSelectDeductionType'])->name('incomeAdjustment.select_UnSelectDeductionType');
    Route::GET('/incomeAdjustment/DeductionTypeList',[IncomeAdjustmentController::class, 'BrowserDeductionTypeList'])->name('incomeAdjustment.browserDeductionTypeList');

    Route::GET('/incomeAdjustment/indexHed', [IncomeAdjustmentController::class, 'IndexHed']);
    Route::GET('/incomeAdjustment/BrowserHeadData',[IncomeAdjustmentController::class, 'BrowserHeadData'])->name('incomeAdjustment.browserHeadData');
    Route::GET('/incomeAdjustment/browserDetailData',[IncomeAdjustmentController::class, 'BrowserDetailData'])->name('incomeAdjustment.browserDetailData');
    Route::GET('/incomeAdjustment/fetchSubFormDataDeduction',[IncomeAdjustmentController::class, 'FetchSubFormDataDeduction'])->name('incomeAdjustment.fetchSubFormDataDeduction');

    Route::POST('/incomeAdjustment/Master/Update',[IncomeAdjustmentController::class, 'PostSubFormDataDeduction'])->name('incomeAdjustment.postSubFormDataDeduction');
    Route::GET('/incomeAdjustment/deleteDeductionAdjustmentDetail',[IncomeAdjustmentController::class, 'DeleteDeductionAdjustmentDetail'])->name('incomeAdjustment.deleteDeductionAdjustmentDetail');



    // Income Adjustment Ends*****
    // Adhoc Payment Period

    Route::GET('/adhocPaymentPeriod/index', [AdhocPaymentPeriodController::class, 'Index']);
    Route::POST('/adhocPaymentPeriod/importexcel',[AdhocPaymentPeriodController::class, 'Import'])->name('adhocPaymentPeriod.import');
    Route::GET('/adhocPaymentPeriod/Master',[AdhocPaymentPeriodController::class, 'BrowserData'])->name('adhocPaymentPeriod.browserData');
    Route::POST('/adhocPaymentPeriod/Master/Add',[AdhocPaymentPeriodController::class, 'PostData'])->name('adhocPaymentPeriod.postData');
    Route::GET('/adhocPaymentPeriod/select_UnSelect',[AdhocPaymentPeriodController::class, 'Select_UnSelect'])->name('adhocPaymentPeriod.select_UnSelect');
    Route::GET('/adhocPaymentPeriod/updateIncomeTypeMem',[AdhocPaymentPeriodController::class, 'UpdateIncomeTypeMem'])->name('adhocPaymentPeriod.updateIncomeTypeMem');
    Route::GET('/adhocPaymentPeriod/select_UnSelectIncomeType',[AdhocPaymentPeriodController::class, 'select_UnSelectIncomeType'])->name('adhocPaymentPeriod.select_UnSelectIncomeType');
    Route::GET('/adhocPaymentPeriod/IncomeTypeList',[AdhocPaymentPeriodController::class, 'BrowserIncomeTypeList'])->name('adhocPaymentPeriod.browserIncomeTypeList');
    Route::GET('/adhocPaymentPeriod/indexHed', [AdhocPaymentPeriodController::class, 'IndexHed']);
    Route::GET('/adhocPaymentPeriod/browserDetailData',[AdhocPaymentPeriodController::class, 'BrowserDetailData'])->name('adhocPaymentPeriod.browserDetailData');
    Route::GET('/adhocPaymentPeriod/fetchSubFormDataIncome',[AdhocPaymentPeriodController::class, 'FetchSubFormDataIncome'])->name('adhocPaymentPeriod.fetchSubFormDataIncome');

    Route::POST('/adhocPaymentPeriod/Master/Update',[AdhocPaymentPeriodController::class, 'PostSubFormDataIncome'])->name('adhocPaymentPeriod.postSubFormDataIncome');
    Route::GET('/adhocPaymentPeriod/deleteAdhocPaymentPeriod',[AdhocPaymentPeriodController::class, 'DeleteAdhocPaymentPeriod'])->name('adhocPaymentPeriod.deleteAdhocPaymentPeriod');



    // Adhoc Payment Period Ends*****

    // Payroll Statutroty Deductions - Slab Master*****
    Route::get('/statutrotyDeductionSlab/index', [StatutoryDeductionSlabController::class, 'Index']);
    Route::GET('/statutrotyDeductionSlab/Master',[StatutoryDeductionSlabController::class, 'BrowserData'])->name('statutrotyDeductionSlab.browserData');
    Route::GET('/statutrotyDeductionSlab/Master/FetchData',[StatutoryDeductionSlabController::class, 'FetchData'])->name('statutrotyDeductionSlab.fetchData');
    Route::GET('/statutrotyDeductionSlab/Master/fetchSubformHeaderData',[StatutoryDeductionSlabController::class, 'FetchSubformHeaderData'])->name('statutrotyDeductionSlab.fetchSubformHeaderData');
    Route::GET('/statutrotyDeductionSlab/browserSubFormHeader',[StatutoryDeductionSlabController::class, 'BrowserSubFormHeader'])->name('statutrotyDeductionSlab.browserSubFormHeader');
    Route::GET('/statutrotyDeductionSlab/browserSubFormDeduction',[StatutoryDeductionSlabController::class, 'BrowserSubFormDeduction'])->name('statutrotyDeductionSlab.browserSubFormDeduction');
    Route::POST('/statutrotyDeductionSlab/postSubFormDataHeader',[StatutoryDeductionSlabController::class, 'PostSubFormDataHeader'])->name('statutrotyDeductionSlab.postSubFormDataHeader');
    Route::POST('/statutrotyDeductionSlab/postSubFormDataDetail',[StatutoryDeductionSlabController::class, 'PostSubFormDataDetail'])->name('statutrotyDeductionSlab.postSubFormDataDetail');
    Route::GET('/statutrotyDeductionSlab/deleteMemDataIncome',[StatutoryDeductionSlabController::class, 'DeleteMemDataIncome'])->name('statutrotyDeductionSlab.deleteMemDataIncome');
    Route::GET('/statutrotyDeductionSlab/deleteMemDataDeduction',[StatutoryDeductionSlabController::class, 'DeleteMemDataDeduction'])->name('statutrotyDeductionSlab.deleteMemDataDeduction');
    Route::GET('/statutrotyDeductionSlab/fetchSubFormDataIncome',[StatutoryDeductionSlabController::class, 'FetchSubFormDataIncome'])->name('statutrotyDeductionSlab.fetchSubFormDataIncome');
    Route::GET('/statutrotyDeductionSlab/fetchSubFormDataDeduction',[StatutoryDeductionSlabController::class, 'FetchSubFormDataDeduction'])->name('statutrotyDeductionSlab.fetchSubFormDataDeduction');
    Route::GET('/statutrotyDeductionSlab/browserSubFormDeductionSlab',[StatutoryDeductionSlabController::class, 'BrowserSubFormDeductionSlab'])->name('statutrotyDeductionSlab.browserSubFormDeductionSlab');    
    Route::POST('/statutrotyDeductionSlab/postHeaderDetailSubform',[StatutoryDeductionSlabController::class, 'PostHeaderDetailSubform'])->name('statutrotyDeductionSlab.postHeaderDetailSubform');
    Route::POST('/statutrotyDeductionSlab/dateChangeHeaderDetail',[StatutoryDeductionSlabController::class, 'DateChangeHeaderDetail'])->name('statutrotyDeductionSlab.dateChangeHeaderDetail');
    Route::GET('/statutrotyDeductionSlab/deleteSubFormHeaderDetail',[StatutoryDeductionSlabController::class, 'DeleteSubFormHeaderDetail'])->name('statutrotyDeductionSlab.deleteSubFormHeaderDetail');
    Route::GET('/statutrotyDeductionSlab/checkHeaderData',[StatutoryDeductionSlabController::class, 'CheckHeaderData'])->name('statutrotyDeductionSlab.checkHeaderData');    
    Route::GET('/statutrotyDeductionSlab/fetchSubformDetailData',[StatutoryDeductionSlabController::class, 'FetchSubformDetailData'])->name('statutrotyDeductionSlab.fetchSubformDetailData');    
    Route::GET('/statutrotyDeductionSlab/deleteSubFormDetail',[StatutoryDeductionSlabController::class, 'DeleteSubFormDetail'])->name('statutrotyDeductionSlab.deleteSubFormDetail');    
    Route::GET('/statutrotyDeductionSlab/fetchSubFormDataDeductionSlab',[StatutoryDeductionSlabController::class, 'FetchSubFormDataDeductionSlab'])->name('statutrotyDeductionSlab.fetchSubFormDataDeductionSlab');    
    // Payroll Statutroty Deductions - Slab Master Ends*****
    // Payroll Employee Earnings - Income/Deduction Master*****
    Route::get('/employeeEarnings/index', [EmployeeEarningsController::class, 'Index']);
    Route::GET('/employeeEarnings/Master',[EmployeeEarningsController::class, 'BrowserData'])->name('employeeEarnings.browserData');
    Route::GET('/employeeEarnings/Master/FetchData',[EmployeeEarningsController::class, 'FetchData'])->name('employeeEarnings.fetchData');
    Route::GET('/employeeEarnings/browserSubFormIncome',[EmployeeEarningsController::class, 'BrowserSubFormIncome'])->name('employeeEarnings.browserSubFormIncome');
    Route::GET('/employeeEarnings/browserSubFormDeduction',[EmployeeEarningsController::class, 'BrowserSubFormDeduction'])->name('employeeEarnings.browserSubFormDeduction');
    Route::POST('/employeeEarnings/postSubFormDataIncome',[EmployeeEarningsController::class, 'PostSubFormDataIncome'])->name('employeeEarnings.postSubFormDataIncome');
    Route::POST('/employeeEarnings/postSubFormDataDeduction',[EmployeeEarningsController::class, 'PostSubFormDataDeduction'])->name('employeeEarnings.postSubFormDataDeduction');
    Route::POST('/employeeEarnings/postHeaderSubformData',[EmployeeEarningsController::class, 'PostHeaderSubformData'])->name('employeeEarnings.postHeaderSubformData');
    Route::GET('/employeeEarnings/deleteMemDataIncome',[EmployeeEarningsController::class, 'DeleteMemDataIncome'])->name('employeeEarnings.deleteMemDataIncome');
    Route::GET('/employeeEarnings/deleteMemDataDeduction',[EmployeeEarningsController::class, 'DeleteMemDataDeduction'])->name('employeeEarnings.deleteMemDataDeduction');
    Route::GET('/employeeEarnings/fetchSubFormDataIncome',[EmployeeEarningsController::class, 'FetchSubFormDataIncome'])->name('employeeEarnings.fetchSubFormDataIncome');
    Route::GET('/employeeEarnings/fetchSubFormDataDeduction',[EmployeeEarningsController::class, 'FetchSubFormDataDeduction'])->name('employeeEarnings.fetchSubFormDataDeduction');
    // Payroll Employee Earnings - Income/Deduction Master Ends*****
    // Employee Loan Book Master*****
    Route::get('/loanBook/index', [LoanBookController::class, 'Index']);
    Route::GET('/loanBook/Master',[LoanBookController::class, 'BrowserData'])->name('loanBook.browserData');
    Route::GET('/loanBook/Master/FetchData',[LoanBookController::class, 'FetchData'])->name('loanBook.fetchData');
    Route::GET('/loanBook/browserSubFormLoan',[LoanBookController::class, 'BrowserSubFormLoan'])->name('loanBook.browserSubFormLoan');
    Route::POST('/loanBook/postHeaderSubformData',[LoanBookController::class, 'PostHeaderSubformData'])->name('loanBook.postHeaderSubformData');
    Route::GET('/employeeEarnings/deleteMemDataLoan',[LoanBookController::class, 'DeleteMemDataLoan'])->name('loanBook.deleteMemDataLoan');
    Route::GET('/loanBook/fetchSubFormDataLoanBook',[LoanBookController::class, 'FetchSubFormDataLoanBook'])->name('loanBook.fetchSubFormDataLoanBook');
    Route::POST('/loanBook/GetLocationDesc',[LoanBookController::class, 'GetLocationDesc'])->name('loanBook.getLocation');
    Route::POST('/loanBook/memDetailUpdate',[LoanBookController::class, 'MemDetailUpdate'])->name('loanBook.memDetailUpdate');
    Route::POST('/loanBook/postSubFormDataLoan',[LoanBookController::class, 'PostSubFormData'])->name('loanBook.postSubFormData');
    Route::GET('/loanBook/fetchSubFormDataEMI',[LoanBookController::class, 'FetchSubFormDataEMI'])->name('loanBook.fetchSubFormDataEMI');
    Route::GET('/loanBook/Master/Delete',[LoanBookController::class, 'DeleteData'])->name('loanBook.deleteData');


    // Employee Loan Book End*****
    
    //Payroll Employee Income, Deduction Type Master*****
    //Route for DeductionType Master
    Route::get('/deductionType/index', [DeductionTypeController::class, 'Index']);
    Route::GET('/deductionType/Master',[DeductionTypeController::class, 'BrowserData'])->name('deductionType.browserData');
    Route::POST('/deductionType/Master/SubForm/Append',[DeductionTypeController::class, 'AppendSubForm'])->name('deductionType.appendSubFormTable');
    Route::GET('/deductionType/Master/SubForm',[DeductionTypeController::class, 'BrowserSubForm'])->name('deductionType.browserSubForm');
    Route::GET('/deductionType/Master/Update',[DeductionTypeController::class, 'FetchData'])->name('deductionType.fetchData');
    Route::GET('/deductionType/Master/SubFormUpdate',[DeductionTypeController::class, 'FetchSubFormData'])->name('deductionType.fetchSubFormData');
    Route::POST('/deductionType/Master/Add',[DeductionTypeController::class, 'PostData'])->name('deductionType.postData');
    Route::POST('/deductionType/Master/SubFormAdd',[DeductionTypeController::class, 'PostSubFormData'])->name('deductionType.postSubFormData');
    Route::GET('/deductionType/Master/Delete',[DeductionTypeController::class, 'DeleteData'])->name('deductionType.deleteData');
    Route::GET('/deductionType/Master/DeleteSubForm',[DeductionTypeController::class, 'DeleteSubFormData'])->name('deductionType.deleteSubFormData');
    Route::GET('/deductionType/Master1',[DeductionTypeController::class, 'BrowserDeletedRecords'])->name('deductionType.browserDeletedRecords');
    Route::GET('/deductionType/Master/Undelete',[DeductionTypeController::class, 'RestoreDeletedRecord'])->name('deductionType.restoreDeletedRecords');
    Route::POST('/deductionType/Master/getPeriod',[DeductionTypeController::class, 'GetPeriod'])->name('deductionType.getPeriod');
    Route::GET('/deductionType/Master/getSelectedPeriod',[DeductionTypeController::class, 'GetSelectedPeriod'])->name('deductionType.getSelectedPeriod');
    Route::POST('/deductionType/Master/getBiDesc',[DeductionTypeController::class, 'GetBIDesc'])->name('deductionType.getBiDesc');
    Route::POST('/deductionType/Master/getSelectedBIDesc',[DeductionTypeController::class, 'GetSelectedBIDesc'])->name('deductionType.getSelectedBIDesc');
    Route::POST('/deductionType/Master/getDeductionRuleDef',[DeductionTypeController::class, 'GetRuleDef'])->name('deductionType.getDeductionRuleDef');
    Route::POST('/deductionType/Master/getSelectedDeductionRuleDef',[DeductionTypeController::class, 'GetSelectedRuleDef'])->name('deductionType.getSelectedDeductionRuleDef');
    //Route for DeductionType Master Ends
    //Route for IncomeType Master
    Route::get('/incomeType/index', [IncomeTypeController::class, 'Index']);
    Route::GET('/incomeType/Master',[IncomeTypeController::class, 'BrowserData'])->name('incomeType.browserData');
    Route::GET('/incomeType/Master/Update',[IncomeTypeController::class, 'FetchData'])->name('incomeType.fetchData');
    Route::POST('/incomeType/Master/Add',[IncomeTypeController::class, 'PostData'])->name('incomeType.postData');
    Route::GET('/incomeType/Master/Delete',[IncomeTypeController::class, 'DeleteData'])->name('incomeType.deleteData');
    Route::GET('/incomeType/Master1',[IncomeTypeController::class, 'BrowserDeletedRecords'])->name('incomeType.browserDeletedRecords');
    Route::GET('/incomeType/Master/Undelete',[IncomeTypeController::class, 'RestoreDeletedRecord'])->name('incomeType.restoreDeletedRecords');
    Route::POST('/incomeType/Master/getPeriod',[IncomeTypeController::class, 'GetPeriod'])->name('incomeType.getPeriod');
    Route::POST('/incomeType/Master/getSelectedPeriod',[IncomeTypeController::class, 'GetSelectedPeriod'])->name('incomeType.getSelectedPeriod');
    Route::POST('/incomeType/Master/getBiDesc',[IncomeTypeController::class, 'GetBIDesc'])->name('incomeType.getBiDesc');
    Route::POST('/incomeType/Master/getSelectedBIDesc',[IncomeTypeController::class, 'GetSelectedBIDesc'])->name('incomeType.getSelectedBIDesc');
    Route::POST('/incomeType/Master/getIncomeRuleDef',[IncomeTypeController::class, 'GetRuleDef'])->name('incomeType.getIncomeRuleDef');
    Route::POST('/incomeType/Master/getSelectedIncomeRuleDef',[IncomeTypeController::class, 'GetSelectedRuleDef'])->name('incomeType.getSelectedIncomeRuleDef');
    //Route for IncomeType Master Ends
    //Route for DeductionType Master
    Route::get('/deductionType/index', [DeductionTypeController::class, 'Index']);
    Route::GET('/deductionType/Master',[DeductionTypeController::class, 'BrowserData'])->name('deductionType.browserData');
    Route::GET('/deductionType/Master/Update',[DeductionTypeController::class, 'FetchData'])->name('deductionType.fetchData');
    Route::POST('/deductionType/Master/Add',[DeductionTypeController::class, 'PostData'])->name('deductionType.postData');
    Route::GET('/deductionType/Master/Delete',[DeductionTypeController::class, 'DeleteData'])->name('deductionType.deleteData');
    Route::GET('/deductionType/Master1',[DeductionTypeController::class, 'BrowserDeletedRecords'])->name('deductionType.browserDeletedRecords');
    Route::GET('/deductionType/Master/Undelete',[DeductionTypeController::class, 'RestoreDeletedRecord'])->name('deductionType.restoreDeletedRecords');
    //Route for DeductionType Master Ends
    //Payroll Employee Income, Deduction Type Master Ends*****
    //Payroll Employee Credentials**********
    //Route for Certificates Master 3SIS
    Route::get('/certificates/index', [CertificatesController::class, 'Index']);
    Route::GET('/certificates/Master',[CertificatesController::class, 'BrowserData'])->name('certificates.browserData');
    Route::GET('/certificates/Master/Update',[CertificatesController::class, 'FetchData'])->name('certificates.fetchData');
    Route::POST('/certificates/Master/Add',[CertificatesController::class, 'PostData'])->name('certificates.postData');
    Route::GET('/certificates/Master/Delete',[CertificatesController::class, 'DeleteData'])->name('certificates.deleteData');
    Route::GET('/certificates/Master1',[CertificatesController::class, 'BrowserDeletedRecords'])->name('certificates.browserDeletedRecords');
    Route::GET('/certificates/Master/Undelete',[CertificatesController::class, 'RestoreDeletedRecord'])->name('certificates.restoreDeletedRecords');
    //Route for Certificates Master 3SIS Ends
    //Route for Qualification Master 3SIS
    Route::get('/qualification/index', [QualificationController::class, 'Index']);
    Route::GET('/qualification/Master',[QualificationController::class, 'BrowserData'])->name('qualification.browserData');
    Route::GET('/qualification/Master/Update',[QualificationController::class, 'FetchData'])->name('qualification.fetchData');
    Route::POST('/qualification/Master/Add',[QualificationController::class, 'PostData'])->name('qualification.postData');
    Route::GET('/qualification/Master/Delete',[QualificationController::class, 'DeleteData'])->name('qualification.deleteData');
    Route::GET('/qualification/Master1',[QualificationController::class, 'BrowserDeletedRecords'])->name('qualification.browserDeletedRecords');
    Route::GET('/qualification/Master/Undelete',[QualificationController::class, 'RestoreDeletedRecord'])->name('qualification.restoreDeletedRecords');
    //Route for Qualification Master 3SIS Ends
    //Route for Skills Master 3SIS
    Route::get('/skills/index', [SkillsController::class, 'Index']);
    Route::GET('/skills/Master',[SkillsController::class, 'BrowserData'])->name('skills.browserData');
    Route::GET('/skills/Master/Update',[SkillsController::class, 'FetchData'])->name('skills.fetchData');
    Route::POST('/skills/Master/Add',[SkillsController::class, 'PostData'])->name('skills.postData');
    Route::GET('/skills/Master/Delete',[SkillsController::class, 'DeleteData'])->name('skills.deleteData');
    Route::GET('/skills/Master1',[SkillsController::class, 'BrowserDeletedRecords'])->name('skills.browserDeletedRecords');
    Route::GET('/skills/Master/Undelete',[SkillsController::class, 'RestoreDeletedRecord'])->name('skills.restoreDeletedRecords');
    //Route for Skills Master 3SIS Ends    
    //Payroll Employee Credentials Ends**********
    //Payroll Employee Status**********
    //Route for Type Master 3SIS
    Route::get('/type/index', [TypeController::class, 'Index']);
    Route::GET('/type/Master',[TypeController::class, 'BrowserData'])->name('type.browserData');
    Route::GET('/type/Master/Update',[TypeController::class, 'FetchData'])->name('type.fetchData');
    Route::POST('/type/Master/Add',[TypeController::class, 'PostData'])->name('type.postData');
    Route::GET('/type/Master/Delete',[TypeController::class, 'DeleteData'])->name('type.deleteData');
    Route::GET('/type/Master1',[TypeController::class, 'BrowserDeletedRecords'])->name('type.browserDeletedRecords');
    Route::GET('/type/Master/Undelete',[TypeController::class, 'RestoreDeletedRecord'])->name('type.restoreDeletedRecords');
    //Route for Type Master 3SIS Ends
    //Route for Department Master 3SIS
    Route::get('/department/index', [DepartmentController::class, 'Index']);
    Route::GET('/department/Master',[DepartmentController::class, 'BrowserData'])->name('department.browserData');
    Route::GET('/department/Master/Update',[DepartmentController::class, 'FetchData'])->name('department.fetchData');
    Route::POST('/department/Master/Add',[DepartmentController::class, 'PostData'])->name('department.postData');
    Route::GET('/department/Master/Delete',[DepartmentController::class, 'DeleteData'])->name('department.deleteData');
    Route::GET('/department/Master1',[DepartmentController::class, 'BrowserDeletedRecords'])->name('department.browserDeletedRecords');
    Route::GET('/department/Master/Undelete',[DepartmentController::class, 'RestoreDeletedRecord'])->name('department.restoreDeletedRecords');
    //Route for Department Master 3SIS Ends
    //Route for Grade Master 3SIS
    Route::get('/grade/index', [GradeController::class, 'Index']);
    Route::GET('/grade/Master',[GradeController::class, 'BrowserData'])->name('grade.browserData');
    Route::GET('/grade/Master/Update',[GradeController::class, 'FetchData'])->name('grade.fetchData');
    Route::POST('/grade/Master/Add',[GradeController::class, 'PostData'])->name('grade.postData');
    Route::GET('/grade/Master/Delete',[GradeController::class, 'DeleteData'])->name('grade.deleteData');
    Route::GET('/grade/Master1',[GradeController::class, 'BrowserDeletedRecords'])->name('grade.browserDeletedRecords');
    Route::GET('/grade/Master/Undelete',[GradeController::class, 'RestoreDeletedRecord'])->name('grade.restoreDeletedRecords');
    //Route for Grade Master 3SIS Ends
    //Route for Designation Master 3SIS
    Route::get('/designation/index', [DesignationController::class, 'Index']);
    Route::GET('/designation/Master',[DesignationController::class, 'BrowserData'])->name('designation.browserData');
    Route::GET('/designation/Master/Update',[DesignationController::class, 'FetchData'])->name('designation.fetchData');
    Route::POST('/designation/Master/Add',[DesignationController::class, 'PostData'])->name('designation.postData');
    Route::GET('/designation/Master/Delete',[DesignationController::class, 'DeleteData'])->name('designation.deleteData');
    Route::GET('/designation/Master1',[DesignationController::class, 'BrowserDeletedRecords'])->name('designation.browserDeletedRecords');
    Route::GET('/designation/Master/Undelete',[DesignationController::class, 'RestoreDeletedRecord'])->name('designation.restoreDeletedRecords');
    //Route for Designation Master 3SIS Ends
    //Payroll Employee Status Ends**********
    //Payroll General Masters**********
    //Route for Salutation Master 3SIS
    Route::get('/salutation/index', [SalutationController::class, 'Index']);
    Route::GET('/salutation/Master',[SalutationController::class, 'BrowserData'])->name('salutation.browserData');
    Route::GET('/salutation/Master/Update',[SalutationController::class, 'FetchData'])->name('salutation.fetchData');
    Route::POST('/salutation/Master/Add',[SalutationController::class, 'PostData'])->name('salutation.postData');
    Route::GET('/salutation/Master/Delete',[SalutationController::class, 'DeleteData'])->name('salutation.deleteData');
    Route::GET('/salutation/Master1',[SalutationController::class, 'BrowserDeletedRecords'])->name('salutation.browserDeletedRecords');
    Route::GET('/salutation/Master/Undelete',[SalutationController::class, 'RestoreDeletedRecord'])->name('salutation.restoreDeletedRecords');
    //Route for Salutation Master 3SIS Ends
    //Route for Gender Master 3SIS
    Route::get('/gender/index', [GenderController::class, 'Index']);
    Route::GET('/gender/Master',[GenderController::class, 'BrowserData'])->name('gender.browserData');
    Route::GET('/gender/Master/Update',[GenderController::class, 'FetchData'])->name('gender.fetchData');
    Route::POST('/gender/Master/Add',[GenderController::class, 'PostData'])->name('gender.postData');
    Route::GET('/gender/Master/Delete',[GenderController::class, 'DeleteData'])->name('gender.deleteData');
    Route::GET('/gender/Master1',[GenderController::class, 'BrowserDeletedRecords'])->name('gender.browserDeletedRecords');
    Route::GET('/gender/Master/Undelete',[GenderController::class, 'RestoreDeletedRecord'])->name('gender.restoreDeletedRecords');
    //Route for Gender Master 3SIS Ends
    //Route for BloodGroup Master 3SIS
    Route::get('/bloodGroup/index', [BloodGroupController::class, 'Index']);
    Route::GET('/bloodGroup/Master',[BloodGroupController::class, 'BrowserData'])->name('bloodGroup.browserData');
    Route::GET('/bloodGroup/Master/Update',[BloodGroupController::class, 'FetchData'])->name('bloodGroup.fetchData');
    Route::POST('/bloodGroup/Master/Add',[BloodGroupController::class, 'PostData'])->name('bloodGroup.postData');
    Route::GET('/bloodGroup/Master/Delete',[BloodGroupController::class, 'DeleteData'])->name('bloodGroup.deleteData');
    Route::GET('/bloodGroup/Master1',[BloodGroupController::class, 'BrowserDeletedRecords'])->name('bloodGroup.browserDeletedRecords');
    Route::GET('/bloodGroup/Master/Undelete',[BloodGroupController::class, 'RestoreDeletedRecord'])->name('bloodGroup.restoreDeletedRecords');
    //Route for BloodGroup Master 3SIS Ends
    //Route for Nationality Master 3SIS
    Route::get('/nationality/index', [NationalityController::class, 'Index']);
    Route::GET('/nationality/Master',[NationalityController::class, 'BrowserData'])->name('nationality.browserData');
    Route::GET('/nationality/Master/Update',[NationalityController::class, 'FetchData'])->name('nationality.fetchData');
    Route::POST('/nationality/Master/Add',[NationalityController::class, 'PostData'])->name('nationality.postData');
    Route::GET('/nationality/Master/Delete',[NationalityController::class, 'DeleteData'])->name('nationality.deleteData');
    Route::GET('/nationality/Master1',[NationalityController::class, 'BrowserDeletedRecords'])->name('nationality.browserDeletedRecords');
    Route::GET('/nationality/Master/Undelete',[NationalityController::class, 'RestoreDeletedRecord'])->name('nationality.restoreDeletedRecords');
    //Route for Nationality Master 3SIS Ends
    //Route for Race Master 3SIS
    Route::get('/race/index', [RaceController::class, 'Index']);
    Route::GET('/race/Master',[RaceController::class, 'BrowserData'])->name('race.browserData');
    Route::GET('/race/Master/Update',[RaceController::class, 'FetchData'])->name('race.fetchData');
    Route::POST('/race/Master/Add',[RaceController::class, 'PostData'])->name('race.postData');
    Route::GET('/race/Master/Delete',[RaceController::class, 'DeleteData'])->name('race.deleteData');
    Route::GET('/race/Master1',[RaceController::class, 'BrowserDeletedRecords'])->name('race.browserDeletedRecords');
    Route::GET('/race/Master/Undelete',[RaceController::class, 'RestoreDeletedRecord'])->name('race.restoreDeletedRecords');
    //Route for Race Master 3SIS Ends
    //Route for ReligionMaster Master 3SIS
    Route::get('/religion/index', [ReligionMasterController::class, 'Index']);
    Route::GET('/religionMaster/Master',[ReligionMasterController::class, 'BrowserData'])->name('religionMaster.browserData');
    Route::GET('/religionMaster/Master/Update',[ReligionMasterController::class, 'FetchData'])->name('religionMaster.fetchData');
    Route::POST('/religionMaster/Master/Add',[ReligionMasterController::class, 'PostData'])->name('religionMaster.postData');
    Route::GET('/religionMaster/Master/Delete',[ReligionMasterController::class, 'DeleteData'])->name('religionMaster.deleteData');
    Route::GET('/religionMaster/Master1',[ReligionMasterController::class, 'BrowserDeletedRecords'])->name('religionMaster.browserDeletedRecords');
    Route::GET('/religionMaster/Master/Undelete',[ReligionMasterController::class, 'RestoreDeletedRecord'])->name('religionMaster.restoreDeletedRecords');
    //Route for ReligionMaster Master 3SIS Ends 
    //Route for MaritalStatus Master 3SIS
    Route::get('/maritalStatus/index', [MaritalStatusController::class, 'Index']);
    Route::GET('/maritalStatus/Master',[MaritalStatusController::class, 'BrowserData'])->name('maritalStatus.browserData');
    Route::GET('/maritalStatus/Master/Update',[MaritalStatusController::class, 'FetchData'])->name('maritalStatus.fetchData');
    Route::POST('/maritalStatus/Master/Add',[MaritalStatusController::class, 'PostData'])->name('maritalStatus.postData');
    Route::GET('/maritalStatus/Master/Delete',[MaritalStatusController::class, 'DeleteData'])->name('maritalStatus.deleteData');
    Route::GET('/maritalStatus/Master1',[MaritalStatusController::class, 'BrowserDeletedRecords'])->name('maritalStatus.browserDeletedRecords');
    Route::GET('/maritalStatus/Master/Undelete',[MaritalStatusController::class, 'RestoreDeletedRecord'])->name('maritalStatus.restoreDeletedRecords');
    //Route for MaritalStatus Master 3SIS Ends
    //Route for PhysicalStatus Master 3SIS
    Route::get('/physicalStatus/index', [PhysicalStatusController::class, 'Index']);
    Route::GET('/physicalStatus/Master',[PhysicalStatusController::class, 'BrowserData'])->name('physicalStatus.browserData');
    Route::GET('/physicalStatus/Master/Update',[PhysicalStatusController::class, 'FetchData'])->name('physicalStatus.fetchData');
    Route::POST('/physicalStatus/Master/Add',[PhysicalStatusController::class, 'PostData'])->name('physicalStatus.postData');
    Route::GET('/physicalStatus/Master/Delete',[PhysicalStatusController::class, 'DeleteData'])->name('physicalStatus.deleteData');
    Route::GET('/physicalStatus/Master1',[PhysicalStatusController::class, 'BrowserDeletedRecords'])->name('physicalStatus.browserDeletedRecords');
    Route::GET('/physicalStatus/Master/Undelete',[PhysicalStatusController::class, 'RestoreDeletedRecord'])->name('physicalStatus.restoreDeletedRecords');
    //Route for PhysicalStatus Master 3SIS Ends
    //Payroll General Masters Ends**********
    //Route for System Masters**********
    //Period Master
    Route::get('/period/index', [FiscalYearPeriodController::class, 'Index']);
    Route::GET('/Period/Master',[FiscalYearPeriodController::class, 'BrowserData'])->name('period.browserData');
    Route::POST('/Period/Master/Add',[FiscalYearPeriodController::class, 'PostData'])->name('period.postdata');
    Route::GET('/Period/Master/Update',[FiscalYearPeriodController::class, 'FetchData'])->name('period.fetchdata');
    Route::GET('/Period/Master/Delete',[FiscalYearPeriodController::class, 'DeleteData'])->name('period.deleteData');
    //Period Master Ends
    //WeeklyOff Master
    Route::get('/weeklyOff/index', [WeeklyOffController::class, 'Index']);
    Route::GET('/weeklyOff/Master',[WeeklyOffController::class, 'BrowserData'])->name('weeklyOff.browserData');
    // Route::POST('/weeklyOff/Master/Add',[WeeklyOffController::class, 'PostData'])->name('weeklyOff.postdata');
    Route::GET('/weeklyOff/Master/Update',[WeeklyOffController::class, 'FetchData'])->name('weeklyOff.fetchData');
    Route::POST('/weeklyOff/postHeaderSubformData',[WeeklyOffController::class, 'PostHeaderSubformData'])->name('weeklyOff.postHeaderSubformData');
    Route::GET('/weeklyOff/Master1',[WeeklyOffController::class, 'BrowserDeletedRecords'])->name('weeklyOff.browserDeletedRecords');
    Route::GET('/weeklyOff/Master/Undelete',[WeeklyOffController::class, 'RestoreDeletedRecord'])->name('weeklyOff.restoreDeletedRecords');

    
    Route::GET('/weeklyOff/deleteDetailsMemTables',[WeeklyOffController::class, 'DeleteDetailsMemTables'])->name('weeklyOff.deleteDetailsMemTables');

    Route::GET('/weeklyOff/Master/Delete',[WeeklyOffController::class, 'DeleteData'])->name('weeklyOff.deleteData');
    Route::POST('/weeklyOff/Master/fiscalYearDate',[WeeklyOffController::class, 'GetFiscalYearDate'])->name('weeklyOff.getFiscalYearDate');
    Route::GET('/weeklyOff/dublicateCheckHeader',[WeeklyOffController::class, 'DublicateCheckHeader'])->name('weeklyOff.dublicateCheckHeader');

    Route::GET('/weeklyOff/browserSubFormWeeklyOff',[WeeklyOffController::class, 'BrowserSubFormWeeklyOff'])->name('weeklyOff.browserSubFormWeeklyOff');
    Route::GET('/weeklyOff/fetchSubFormData',[WeeklyOffController::class, 'FetchSubFormData'])->name('weeklyOff.fetchSubFormData');
    Route::POST('/weeklyOff/postSubFormData',[WeeklyOffController::class, 'PostSubFormData'])->name('weeklyOff.postSubFormData');
    Route::GET('/weeklyOff/fetchSubformDetailData',[WeeklyOffController::class, 'FetchSubformDetailData'])->name('weeklyOff.fetchSubformDetailData');    
    Route::GET('/weeklyOff/deleteSubFormDetail',[WeeklyOffController::class, 'DeleteSubFormDetail'])->name('weeklyOff.deleteSubFormDetail');   



    //WeeklyOff Master Ends
    //Route for System Masters Ends**********    
    //Route for Company Master 3SIS
    Route::get('/company/index', [CompanyController::class, 'Index']);
    Route::GET('/company/Master',[CompanyController::class, 'BrowserData'])->name('company.browserData');
    Route::GET('/company/Master/Update',[CompanyController::class, 'FetchData'])->name('company.fetchData');
    Route::POST('/company/Master/Add',[CompanyController::class, 'PostData'])->name('company.postData');
    Route::GET('/company/Master/Delete',[CompanyController::class, 'DeleteData'])->name('company.deleteData');
    Route::GET('/company/Master1',[CompanyController::class, 'BrowserDeletedRecords'])->name('company.browserDeletedRecords');
    Route::GET('/company/Master/Undelete',[CompanyController::class, 'RestoreDeletedRecord'])->name('company.restoreDeletedRecords');
    Route::POST('/company/Master/getGeoDesc',[CompanyController::class, 'GetGeoDesc'])->name('company.getGeoDesc');

    //Route for Company Master 3SIS Ends

    //Route for Currency Master 3SIS
    Route::get('/currency/index', [CurrencyController::class, 'Index']);
    Route::GET('/currency/Master',[CurrencyController::class, 'BrowserData'])->name('currency.browserData');
    Route::GET('/currency/Master/Update',[CurrencyController::class, 'FetchData'])->name('currency.fetchData');
    Route::POST('/currency/Master/Add',[CurrencyController::class, 'PostData'])->name('currency.postData');
    Route::GET('/currency/Master/Delete',[CurrencyController::class, 'DeleteData'])->name('currency.deleteData');
    Route::GET('/currency/Master1',[CurrencyController::class, 'BrowserDeletedRecords'])->name('currency.browserDeletedRecords');
    Route::GET('/currency/Master/Undelete',[CurrencyController::class, 'RestoreDeletedRecord'])->name('currency.restoreDeletedRecords');
    //Route for Currency Master 3SIS Ends


    //Route for Common Masters**********
    //Country Master
    Route::get('/country/index', [CountryController::class, 'Index']);
    Route::GET('/Country/Master',[CountryController::class, 'BrowserData'])->name('country.browserData');
    Route::POST('/Country/Master/Add',[CountryController::class, 'PostData'])->name('country.postdata');
    Route::GET('/Country/Master/Update',[CountryController::class, 'FetchData'])->name('country.fetchdata');
    Route::GET('/Country/Master/Delete',[CountryController::class, 'DeleteData'])->name('country.deleteData');
    Route::GET('/Country/Master1',[CountryController::class, 'BrowserDeletedRecords'])->name('country.browserDeletedRecords');
    Route::GET('/Country/Master/Undelete',[CountryController::class, 'RestoreDeletedRecord'])->name('country.restoreDeletedRecords');
    //Country Master Ends
    //State Master
    Route::GET('/state/index', [StateController::class, 'Index']);
    Route::GET('/State/Master',[StateController::class, 'BrowserData'])->name('state.browserData');
    Route::POST('/State/Master/Add',[StateController::class, 'PostData'])->name('state.postData');
    Route::GET('/State/Master/Update',[StateController::class, 'FetchData'])->name('state.fetchData');
    Route::GET('/State/Master/Delete',[StateController::class, 'DeleteData'])->name('state.deleteData');
    Route::POST('/State/Master/Select',[StateController::class, 'GetCountry'])->name('country.getcountry');
    Route::GET('/Country/getselectedCountry',[StateController::class, 'GetSelectedCountry'])->name('country.getSelectedCountry');
    Route::GET('/State/Master1',[StateController::class, 'BrowserDeletedRecords'])->name('state.browserDeletedRecords');
    Route::GET('/State/Master/Undelete',[StateController::class, 'RestoreDeletedRecord'])->name('state.restoreDeletedRecords');
    //State Master Ends
    //Route for City Master 3SIS
    Route::get('/city/index', [CityController::class, 'Index']);
    Route::GET('/city/Master',[CityController::class, 'browserData'])->name('city.browserData');
    Route::POST('/city/Master/Add',[CityController::class, 'postData'])->name('city.postdata');
    Route::GET('/city/Master/Update',[CityController::class, 'fetchData'])->name('city.fetchdata');
    Route::GET('/city/Master/Delete',[CityController::class, 'deleteData'])->name('city.deleteData');
    Route::POST('/City/Master/Select',[CityController::class, 'getState'])->name('state.getstate');
    Route::POST('/City/Master/SelectGet',[CityController::class,'getCountry'])->name('state.getCountry');
    Route::GET('/city/Master1',[CityController::class, 'BrowserDeletedRecords'])->name('city.browserDeletedRecords');
    Route::GET('/city/Master/Undelete',[CityController::class, 'RestoreDeletedRecord'])->name('city.restoreDeletedRecords');
    //Route for City Master 3SIS Ends
    //Location Master
    Route::GET('/location/index', [LocationController::class, 'Index']);
    Route::GET('/location/Master',[LocationController::class, 'BrowserData'])->name('location.browserData');
    Route::POST('/location/Master/Add',[LocationController::class, 'PostData'])->name('location.postData');
    Route::GET('/location/Master/Update',[LocationController::class, 'FetchData'])->name('location.fetchData');
    Route::GET('/location/Master/Delete',[LocationController::class, 'DeleteData'])->name('location.deleteData');
    Route::POST('/location/Master/SelectCity',[LocationController::class, 'GetCity'])->name('location.getCity');
    Route::POST('/location/Master/getGeoDesc',[LocationController::class, 'GetGeoDesc'])->name('location.getGeoDesc');
    //  Route::POST('/location/Master/SelectState',[LocationController::class, 'GetState'])->name('location.getstate');
    //  Route::POST('/location/Master/SelectCountry',[LocationController::class, 'GetCountry'])->name('location.getcountry');
     Route::GET('/location/getselectedCity',[LocationController::class, 'GetSelectedCity'])->name('location.getSelectedCity');
     Route::GET('/location/getselectedState',[LocationController::class, 'GetSelectedState'])->name('location.getSelectedState');
     Route::GET('/location/getselectedCountry',[LocationController::class, 'GetSelectedCountry'])->name('location.getSelectedCountry');
     Route::GET('/location/Master1',[LocationController::class, 'BrowserDeletedRecords'])->name('location.browserDeletedRecords');
     Route::GET('/location/Master/Undelete',[LocationController::class, 'RestoreDeletedRecord'])->name('location.restoreDeletedRecords');
     //Location Master Ends

    //Fiscal Year Master
    Route::GET('/fy/index', [FiscalYearController::class, 'Index']);
    Route::GET('/FY/Master',[FiscalYearController::class, 'BrowserData'])->name('fiscalyear.browserData');
    Route::POST('/FY/Master/Add',[FiscalYearController::class, 'PostData'])->name('fiscalyear.postData');
    Route::GET('/FY/Master/Update',[FiscalYearController::class, 'FetchData'])->name('fiscalyear.fetchData');
    Route::GET('/FY/Master/Delete',[FiscalYearController::class, 'DeleteData'])->name('fiscalyear.deleteData');    
    Route::GET('/period/getselectedperiod',[FiscalYearController::class, 'GetSelectedPeriod'])->name('period.getSelectedPeriod');;
    Route::GET('/FY/Master1',[FiscalYearController::class, 'BrowserDeletedRecords'])->name('fiscalyear.browserDeletedRecords');
    Route::GET('/FY/Master/Undelete',[FiscalYearController::class, 'RestoreDeletedRecord'])->name('fiscalyear.restoreDeletedRecords');
    //Fiscal Year Master Ends
    //Calendar Master
    Route::get('/calendar/index', [CalendarController::class, 'Index']);
    Route::GET('/calendar/Master',[CalendarController::class, 'BrowserData'])->name('calendar.browserData');
    Route::POST('/calendar/Master/Add',[CalendarController::class, 'PostData'])->name('calendar.postdata');
    Route::GET('/calendar/Master/Update',[CalendarController::class, 'FetchData'])->name('calendar.fetchData');
    Route::GET('/calendar/Master/Delete',[CalendarController::class, 'DeleteData'])->name('calendar.deleteData');
    Route::GET('/calendar/Master1',[CalendarController::class, 'BrowserDeletedRecords'])->name('calendar.browserDeletedRecords');
    Route::GET('/calendar/Master/Undelete',[CalendarController::class, 'RestoreDeletedRecord'])->name('calendar.restoreDeletedRecords');
    //Calendar Master Ends
    //Public Holiday Master
    
    Route::get('/publicHoliday/index', [PublicHolidayController::class, 'Index']);
    Route::GET('/publicHoliday/Master',[PublicHolidayController::class, 'BrowserData'])->name('publicHoliday.browserData');
    Route::GET('/publicHoliday/Master/Update',[PublicHolidayController::class, 'FetchData'])->name('publicHoliday.fetchData');
    Route::POST('/publicHoliday/postHeaderSubformData',[PublicHolidayController::class, 'PostHeaderSubformData'])->name('publicHoliday.postHeaderSubformData');
    Route::GET('/publicHoliday/Master1',[PublicHolidayController::class, 'BrowserDeletedRecords'])->name('publicHoliday.browserDeletedRecords');
    Route::GET('/publicHoliday/Master/Undelete',[PublicHolidayController::class, 'RestoreDeletedRecord'])->name('publicHoliday.restoreDeletedRecords');

    Route::GET('/publicHoliday/dublicateCheckHeader',[PublicHolidayController::class, 'DublicateCheckHeader'])->name('publicHoliday.dublicateCheckHeader');
    Route::GET('/publicHoliday/deleteDetailsMemTables',[PublicHolidayController::class, 'DeleteDetailsMemTables'])->name('publicHoliday.deleteDetailsMemTables');

    Route::GET('/publicHoliday/Master/Delete',[PublicHolidayController::class, 'DeleteData'])->name('publicHoliday.deleteData');
    
    Route::POST('/publicHoliday/Master/fiscalYearDate',[PublicHolidayController::class, 'GetFiscalYearDate'])->name('publicHoliday.getFiscalYearDate');
    Route::GET('/publicHoliday/browserSubFormPublicHoliday',[PublicHolidayController::class, 'BrowserSubFormPublicHoliday'])->name('publicHoliday.browserSubFormPublicHoliday');
    Route::GET('/publicHoliday/fetchSubFormData',[PublicHolidayController::class, 'FetchSubFormData'])->name('publicHoliday.fetchSubFormData');
    Route::POST('/publicHoliday/postSubFormData',[PublicHolidayController::class, 'PostSubFormData'])->name('publicHoliday.postSubFormData');
    Route::GET('/publicHoliday/fetchSubformDetailData',[PublicHolidayController::class, 'FetchSubformDetailData'])->name('publicHoliday.fetchSubformDetailData');    
    Route::GET('/publicHoliday/deleteSubFormDetail',[PublicHolidayController::class, 'DeleteSubFormDetail'])->name('publicHoliday.deleteSubFormDetail');   

    //Public Holiday Master Ends

    //Public Holiday Master
    Route::get('/populateCalendar/index', [MaintainCalendarController::class, 'Index']);
    Route::POST('/populateCalendar/generate',[MaintainCalendarController::class, 'GenerateCalendar'])->name('populateCalendar.generate');
    Route::POST('/populateCalendar/postData',[MaintainCalendarController::class, 'PostData'])->name('populateCalendar.postData');
    Route::GET('/populateCalendar/Master',[MaintainCalendarController::class, 'BrowserData'])->name('populateCalendar.browserData');


    //Public Holiday Master Ends

    
    //AcctType Master
    Route::GET('/acctType/index', [AcctTypeController::class, 'Index']);
    Route::GET('/acctType/Master',[AcctTypeController::class, 'BrowserData'])->name('acctType.browserData');
    Route::POST('/AcctType/Master/Add',[AcctTypeController::class, 'PostData'])->name('acctType.postData');
    Route::GET('/AcctType/Master/Update',[AcctTypeController::class, 'FetchData'])->name('acctType.fetchData');
    Route::GET('/AcctType/Master/Delete',[AcctTypeController::class, 'DeleteData'])->name('acctType.deleteData');
    Route::GET('/AcctType/Master1',[AcctTypeController::class, 'BrowserDeletedRecords'])->name('acctType.browserDeletedRecords');
    Route::GET('/AcctType/Master/Undelete',[AcctTypeController::class, 'RestoreDeletedRecord'])->name('acctType.restoreDeletedRecords');
    //AcctType Master Ends
    //Bank Master
    Route::GET('/bank/index', [BankController::class, 'Index']);
    Route::GET('/bank/Master',[BankController::class, 'BrowserData'])->name('bank.browserData');
    Route::POST('/Bank/Master/Add',[BankController::class, 'PostData'])->name('bank.postData');
    Route::GET('/Bank/Master/Update',[BankController::class, 'FetchData'])->name('bank.fetchData');
    Route::GET('/Bank/Master/Delete',[BankController::class, 'DeleteData'])->name('bank.deleteData');
    Route::GET('/Bank/Master1',[BankController::class, 'BrowserDeletedRecords'])->name('bank.browserDeletedRecords');
    Route::GET('/Bank/Master/Undelete',[BankController::class, 'RestoreDeletedRecord'])->name('bank.restoreDeletedRecords');
    //Bank Master Ends

    //Branch Master
    Route::GET('/branch/index', [BranchController::class, 'Index']);
    Route::GET('/Branch/Master',[BranchController::class, 'BrowserData'])->name('branch.browserData');
    Route::POST('/Branch/Master/Add',[BranchController::class, 'PostData'])->name('branch.postData');
    Route::GET('/Branch/Master/Update',[BranchController::class, 'FetchData'])->name('branch.fetchData');
    Route::GET('/Branch/Master/Delete',[BranchController::class, 'DeleteData'])->name('branch.deleteData');
    Route::POST('/Branch/Master/Select',[BranchController::class, 'GetBank'])->name('bank.getbank');
    Route::GET('/Bank/getselectedBank',[BranchController::class, 'GetSelectedBank'])->name('bank.getSelectedBank');
    Route::GET('/Branch/Master1',[BranchController::class, 'BrowserDeletedRecords'])->name('branch.browserDeletedRecords');
    Route::GET('/Branch/Master/Undelete',[BranchController::class, 'RestoreDeletedRecord'])->name('branch.restoreDeletedRecords');
    //Branch Master Ends

    //PaymentMode Master
    Route::GET('/paymentMode/index', [PaymentModeController::class, 'Index']);
    Route::GET('/paymentMode/Master',[PaymentModeController::class, 'BrowserData'])->name('paymentMode.browserData');
    Route::POST('/PaymentMode/Master/Add',[PaymentModeController::class, 'PostData'])->name('paymentMode.postData');
    Route::GET('/PaymentMode/Master/Update',[PaymentModeController::class, 'FetchData'])->name('paymentMode.fetchData');
    Route::GET('/PaymentMode/Master/Delete',[PaymentModeController::class, 'DeleteData'])->name('paymentMode.deleteData');
    Route::GET('/PaymentMode/Master1',[PaymentModeController::class, 'BrowserDeletedRecords'])->name('paymentMode.browserDeletedRecords');
    Route::GET('/PaymentMode/Master/Undelete',[PaymentModeController::class, 'RestoreDeletedRecord'])->name('paymentMode.restoreDeletedRecords');
    //PaymentMode Master Ends
    //DropDoen Master
    Route::POST('/DropDown/Master/SelectCity',[DropDownController::class, 'GetCityDropDown'])->name('dropDownMasters.getCity');
    Route::GET('/DropDown/Master/GetSelectedCity',[DropDownController::class, 'GetSelectedCity'])->name('dropDownMasters.getSelectedCity');
    Route::POST('/DropDown/Master/getGeoDesc',[DropDownController::class, 'GetGeoDesc'])->name('dropDownMasters.getGeoDesc');
    Route::POST('/DropDown/Master/SelectCurrency',[DropDownController::class, 'GetCurrencyDropDown'])->name('dropDownMasters.getCurrency');
    Route::GET('/DropDown/Master/SelectBranch1',[DropDownController::class, 'GetBranchDropDown'])->name('dropDownMasters.getBranch');
    Route::POST('/DropDown/Master/getBranchDetails',[DropDownController::class, 'GetBranchDetails'])->name('dropDownMasters.getBranchDetails');
    Route::GET('/DropDown/Master/GetSelectedPeriod',[DropDownController::class, 'GetSelectedPeriod'])->name('dropDownMasters.getSelectedPeriod');
    Route::GET('/DropDown/Master/getPeriodDropDown',[DropDownController::class, 'GetPeriodDropDown'])->name('dropDownMasters.getPeriodDropDown');
    Route::GET('/DropDown/Master/GetSelectedIncomeBiDesc',[DropDownController::class, 'GetSelectedIncomeBiDesc'])->name('dropDownMasters.getSelectedIncomeBiDesc');
    Route::GET('/DropDown/Master/GetSelectedDeductionBiDesc',[DropDownController::class, 'GetSelectedDeductionBiDesc'])->name('dropDownMasters.getSelectedDeductionBiDesc');
    Route::GET('/DropDown/Master/GetSelectedRuleDefDescIncome',[DropDownController::class, 'GetSelectedRuleDefDescIncome'])->name('dropDownMasters.getSelectedRuleDefDescIncome');
    Route::GET('/DropDown/Master/GetSelectedRuleDefDescDeduction',[DropDownController::class, 'GetSelectedRuleDefDescDeduction'])->name('dropDownMasters.getSelectedRuleDefDescDeduction');
    Route::GET('/DropDown/Master/GetSelectedIncomeTypes',[DropDownController::class, 'GetSelectedIncomeTypes'])->name('dropDownMasters.getSelectedIncomeTypes');
    Route::GET('/DropDown/Master/getSelectedIncomeTypeApartFromEarning',[DropDownController::class, 'GetSelectedIncomeTypeApartFromEarning'])->name('dropDownMasters.getSelectedIncomeTypeApartFromEarning');
    Route::GET('/DropDown/Master/GetSelectedDeductionTypes',[DropDownController::class, 'GetSelectedDeductionTypes'])->name('dropDownMasters.getSelectedDeductionTypes');
    Route::GET('/DropDown/Master/GetSelectedDeductionTypesLoan',[DropDownController::class, 'GetSelectedDeductionTypesLoan'])->name('dropDownMasters.getSelectedDeductionTypesLoan');
    Route::GET('/DropDown/Master/getSelectedCountry',[DropDownController::class, 'GetSelectedCountry'])->name('dropDownMasters.getSelectedCountry');
    Route::GET('/DropDown/Master/getSelectedState',[DropDownController::class, 'GetSelectedState'])->name('dropDownMasters.getSelectedState');
    // Route::GET('/DropDown/Master/getSelectedCity',[DropDownController::class, 'GetSelectedCity'])->name('dropDownMasters.getSelectedCity');
    Route::GET('/DropDown/Master/getSelectedLocation',[DropDownController::class, 'GetSelectedLocation'])->name('dropDownMasters.getSelectedLocation');
    Route::GET('/DropDown/Master/getSelectedGender',[DropDownController::class, 'GetSelectedGender'])->name('dropDownMasters.getSelectedGender');
    // Madhav
    Route::GET('/DropDown/Master/getAcctType',[DropDownController::class, 'GetAcctType'])->name('dropDownMasters.getAcctType');
    Route::GET('/DropDown/Master/getPaymentMode',[DropDownController::class, 'GetPaymentMode'])->name('dropDownMasters.getPaymentMode');

    Route::GET('/DropDown/Master/GetSelectedSalutation',[DropDownController::class, 'GetSelectedSalutation'])->name('dropDownMasters.getSelectedSalutation');
    Route::GET('/DropDown/Master/GetSelectedNationality',[DropDownController::class, 'GetSelectedNationality'])->name('dropDownMasters.getSelectedNationality');
    Route::GET('/DropDown/Master/GetSelectedReligionMaster',[DropDownController::class, 'GetSelectedReligionMaster'])->name('dropDownMasters.getSelectedReligionMaster');
    Route::GET('/DropDown/Master/GetSelectedRaceGroup',[DropDownController::class, 'GetSelectedRaceGroup'])->name('dropDownMasters.getSelectedRaceGroup');
    Route::GET('/DropDown/Master/GetSelectedBloodGroup',[DropDownController::class, 'GetSelectedBloodGroup'])->name('dropDownMasters.getSelectedBloodGroup');
    Route::GET('/DropDown/Master/GetSelectedPhysicalStatus',[DropDownController::class, 'GetSelectedPhysicalStatus'])->name('dropDownMasters.getSelectedPhysicalStatus');
    Route::GET('/DropDown/Master/GetSelectedMaritalStatus',[DropDownController::class, 'GetSelectedMaritalStatus'])->name('dropDownMasters.getSelectedMaritalStatus');
    
    Route::GET('/DropDown/Master/GetSelectedEmploymentType',[DropDownController::class, 'GetSelectedEmploymentType'])->name('dropDownMasters.getSelectedEmploymentType');
    Route::GET('/DropDown/Master/GetSelectedGradeType',[DropDownController::class, 'GetSelectedGradeType'])->name('dropDownMasters.getSelectedGradeType');
    Route::GET('/DropDown/Master/GetSelectedDesignation',[DropDownController::class, 'GetSelectedDesignation'])->name('dropDownMasters.getSelectedDesignation');
    Route::GET('/DropDown/Master/GetSelectedDepartment',[DropDownController::class, 'GetSelectedDepartment'])->name('dropDownMasters.getSelectedDepartment');
    Route::GET('/DropDown/Master/GetSelectedCalendar',[DropDownController::class, 'GetSelectedCalendar'])->name('dropDownMasters.getSelectedCalendar');
    Route::GET('/DropDown/Master/GetSelectedTaxRegim',[DropDownController::class, 'GetSelectedTaxRegim'])->name('dropDownMasters.getSelectedTaxRegim');
    Route::GET('/DropDown/Master/GetSelectedHierarchyId',[DropDownController::class, 'GetSelectedHierarchyId'])->name('dropDownMasters.getSelectedHierarchyId');
    Route::GET('/DropDown/Master/GetSelectedDeductionMethod',[DropDownController::class, 'GetSelectedDeductionMethod'])->name('dropDownMasters.getSelectedDeductionMethod');
    Route::GET('/DropDown/Master/GetSelectedFiscalYear',[DropDownController::class, 'GetSelectedFiscalYear'])->name('dropDownMasters.getSelectedFiscalYear');
    Route::GET('/DropDown/Master/getActiveFiscalYearParameater',[DropDownController::class, 'GetActiveFiscalYearParameater'])->name('dropDownMasters.getActiveFiscalYearParameater');
    Route::POST('/DropDown/Master/getFiscalYearParameater',[DropDownController::class, 'GetFiscalYearParameater'])->name('dropDownMasters.getFiscalYearParameater');
    Route::POST('/DropDown/Master/getFiscalYearPeriodDate',[DropDownController::class, 'GetFiscalYearPeriodDate'])->name('dropDownMasters.getFiscalYearPeriodDate');
    
    Route::GET('/DropDown/Master/GetSelectedEmployee',[DropDownController::class, 'GetSelectedEmployee'])->name('dropDownMasters.getSelectedEmployee');
    Route::POST('/DropDown/GetLocationDesc',[DropDownController::class, 'GetLocationDesc'])->name('dropDownMasters.getLocation');


    // Madhav Ends*****

    //RuleDefinition Master
    Route::GET('/ruleDefinition/index', [RuleDefinitionController::class, 'Index']);
    Route::GET('/ruleDefinition/Master',[RuleDefinitionController::class, 'BrowserData'])->name('ruleDefinition.browserData');
    Route::POST('/ruleDefinition/Master/Add',[RuleDefinitionController::class, 'PostData'])->name('ruleDefinition.postData');
    Route::GET('/ruleDefinition/Master/Update',[RuleDefinitionController::class, 'FetchData'])->name('ruleDefinition.fetchData');
    //RuleDefinition Master


    //DropDoen Master Ends
    //Route for Common Masters Ends**********
    Route::get('/sales', function() {
        // $category_name = '';
        $data = [
            'category_name' => 'dashboard',
            'page_name' => 'sales',
            'has_scrollspy' => 0,
            'scrollspy_offset' => '',
        ];
        // $pageName = 'sales';
        return view('dashboard')->with($data);
    });
    // $this->middleware
});

Auth::routes();

Route::get('/', 'HomeController@index');

Route::get('/register', function() {
    return redirect('/login');    
});
Route::get('/password/reset', function() {
    return redirect('/login');    
});

Route::get('/', function() {
    return redirect('/sales');    
});
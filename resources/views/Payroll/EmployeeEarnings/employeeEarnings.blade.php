@extends('layouts.app')

@section('content')
<div class="layout-px-spacing">
    <div>
        <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
            <div class=" br-6">
                <div style='float:right; padding-right:30px'>
                </div>
                <!-- Landing Page browser -->
                <div class="table-responsive">
                    <table id="html5-extension3SIS" class="table table-hover non-hover" style="width:100%">
                        <thead>
                            <tr>
                                <!--CopyChange-->  
                                <th title="Employee Id.">Emp.ID</th>
                                <th>Full Name</th>  
                                <th>Gend</th>  
                                <th>Company</th>
                                <th>Location</th>
                                <th>Designation</th>
                                <th title="Income Defined">Inc.Def.</th>
                                <th>Action</th>
                                <th style="visibility: hidden;">Unique Id</th>
                                <th style="visibility: hidden;">User Id</th>
                                <th style="visibility: hidden;">Last Updated</th>
                                <th  style="visibility: hidden;" title="Deduction Defined">DD</th>

                            </tr>
                        </thead> 
                    </table>
                </div>
                <!-- Landing Page browser Ends-->
                <!-- Header Level Data Entry -->
                <div id="entryModalSmall" class="modal fade UpdateModalBox3SIS" data-backdrop="static" 
                    data-keyboard="false" role="dialog" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered 3SISPro-modal-dialog modal-xl" role="document">
                        <div class='modal-content'> 
                            <!-- Modal Header -->
                            <div class="modal-header" id="registerModalLabel">
                                <h4 class="modal-title"></h4>
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                                    <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" 
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" 
                                    stroke-linecap="round" stroke-linejoin="round" 
                                    class="feather feather-x text-danger"><line x1="18" y1="6" x2="6" y2="18">                                            
                                    </line><line x1="6" y1="6" x2="18" y2="18"></line></svg></button>
                            </div>
                            <form  id='singleLevelDataEntryForm' autocomplete="off"
                                    method="post" action="{{ route('employeeEarnings.postHeaderSubformData') }}">
                                    <input type="hidden" name="_token" id="csrfToken" value="{{ csrf_token() }}">
                                <!-- Modal Body -->
                                <div class="modal-body">
                                    <div class="widget-content widget-content-area animated-underline-content">
                                        <!-- Nav Tabs -->
                                        <ul class="nav nav-tabs mb-3" id="animateLine" role="tablist">
                                            <li class="nav-item">
                                                <a class="nav-link active" id="animated-underline-home-tab" data-toggle="tab" 
                                                href="#animated-underline-home" role="tab" aria-controls="animated-underline-home" a
                                                ria-selected="true">Employee Info</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" id="animated-underline-selectIncome-tab" data-toggle="tab" 
                                                href="#animated-underline-selectIncome" role="tab" aria-controls="animated-underline-selectIncome" 
                                                aria-selected="false">Employee Income</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" id="animated-underline-selectDeduction-tab" data-toggle="tab" 
                                                href="#animated-underline-selectDeduction" role="tab" aria-controls="animated-underline-selectDeduction" 
                                                aria-selected="false">Employee Deduction</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" id="animated-underline-profile-tab" data-toggle="tab" 
                                                href="#animated-underline-profile" role="tab" aria-controls="animated-underline-profile" 
                                                aria-selected="false">Record Info</a>
                                            </li>
                                        </ul>
                                        <div class="tab-content" id="animateLineContent-4">
                                            <!-- Tab : Main Entry -->
                                            <div class="tab-pane fade show active" id="animated-underline-home" role="tabpanel" 
                                                aria-labelledby="animated-underline-home-tab">
                                                <div class="container-fluid">
                                                    <div class='form-group mb-0'>
                                                    <input type="hidden" name='EMGIHUniqueId' id='EMGIHUniqueId' class='form-control'>
                                                    </div>
                                                    <!-- Id, Name -->
                                                    <div class="row mt-0">
                                                        <div class="col-md-2">
                                                            <div class='form-group'>                                                
                                                                <label>Employee Id</label>
                                                                <input type="text"  name='EMGIHEmployeeId' id='EMGIHEmployeeId' 
                                                                    class='form-control' style='opacity:1' readonly>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class='form-group'>                                                
                                                                <label>Full Name</label>
                                                                <input type="text" name='EMGIHFullName' id="EMGIHFullName" class="form-control" readonly>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label> Joining Date</label>
                                                                <input type="date" name="EMGIHDateOfJoining" id="EMGIHDateOfJoining" 
                                                                class="form-control col-sm-6" readonly/>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- Location -->
                                                    <div class="row mt-0">                                                        
                                                        <div class="col-md-6">
                                                            <div class='form-group'>                                                
                                                                <label>Location</label>
                                                                <input type="text" name='LocationDesc' id="LocationDesc" class="form-control" readonly>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- Designation -->
                                                    <div class="row mt-0">                                                        
                                                        <div class="col-md-6">
                                                            <div class='form-group'>                                                
                                                                <label>Designation</label>
                                                                <input type="text" name='DesignationDesc' id="DesignationDesc" class="form-control" readonly>
                                                            </div>
                                                        </div>
                                                    </div>                       
                                                </div>
                                            </div>
                                            <!-- Tab : Income Type Selections -->
                                            <div class="tab-pane fade" id="animated-underline-selectIncome" role="tabpanel" 
                                                aria-labelledby="animated-underline-selectIncome-tab">
                                                <div style='float:right; padding-right:30px'>                                                    
                                                    <button type='button' name='add_Income' id='add_Data_Income' 
                                                        class='btn btnAddRec3SIS'>Add Income
                                                        <i class="fas fa-plus fa-sm ml-1"> </i>
                                                    </button>
                                                </div>
                                                <!-- Sub Form -->
                                                <div class="table-responsive">
                                                    <table id="html5-incomeTypeSubform3SIS" class="table table-hover non-hover" style="width:100%">
                                                        <thead>
                                                            <tr>
                                                                <th>Line#</th>
                                                                <th>Income Id</th>
                                                                <th>Description</th>
                                                                <th>payroll Income</th>
                                                                <th>Effective From</th>
                                                                <th>Effective To</th>
                                                                <th>Deleted</th>
                                                                <th>Action</th>
                                                                <th style="visibility: hidden;">User</th>
                                                                <th style="visibility: hidden;">Unique Id</th>
                                                            </tr>
                                                        </thead> 
                                                    </table>
                                                </div>
                                            </div>
                                            <!-- Tab : Deduction Type Selections -->
                                            <div class="tab-pane fade" id="animated-underline-selectDeduction" role="tabpanel" 
                                                aria-labelledby="animated-underline-selectDeduction-tab">
                                                <div style='float:right; padding-right:30px'>                                                    
                                                    <button type='button' name='add_Deduction' id='add_Data_Deduction' 
                                                        class='btn btnAddRec3SIS'>Add Deduction
                                                        <i class="fas fa-plus fa-sm ml-1"> </i>
                                                    </button>
                                                </div>
                                                <!-- Sub Form -->
                                                <div class="table-responsive">
                                                    <table id="html5-deductionTypeSubform3SIS" class="table table-hover non-hover" style="width:100%">
                                                        <thead>
                                                            <tr>
                                                                <th>Line#</th>
                                                                <th>Ded.Id</th>
                                                                <th>Description</th>
                                                                <th>payroll Ded.</th>
                                                                <th>Effective From</th>
                                                                <th>Effective To</th>
                                                                <th>Deleted</th>
                                                                <th>Action</th>
                                                                <th style="visibility: hidden;">User</th>
                                                                <th style="visibility: hidden;">Unique Id</th>
                                                                <th style="visibility: hidden;">Deduction Rule</th>
                                                            </tr>
                                                        </thead> 
                                                    </table>
                                                </div>
                                            </div>
                                            <!-- Tab : User Info Prodile Tab -->
                                            <div class="tab-pane fade" id="animated-underline-profile" role="tabpanel" 
                                                aria-labelledby="animated-underline-profile-tab">
                                                <div class="media">
                                                    <div class="media-body">
                                                        <div class="form-group">
                                                            <label> User</label>
                                                            <input type="text" name="EMGIHUser" id="EMGIHUser" 
                                                            class="form-control col-sm-6" readonly/>
                                                        </div>
                                                        <div class="form-group">
                                                            <label> Created Date</label>
                                                            <input type="date" name="EMGIHLastCreated" id="EMGIHLastCreated" 
                                                            class="form-control col-sm-6" readonly/>
                                                        </div>
                                                        <div class="form-group">
                                                            <label> Updated Date</label>
                                                            <input type="date" name="EMGIHLastUpdated" id="EMGIHLastUpdated" 
                                                            class="form-control col-sm-6" readonly />
                                                        </div>                                                        
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Modal Footer -->
                                <div class='modal-footer'>
                                    <!--To display success messages-->
                                    <span id='form_output' style='float:left; padding-left:0px' ></span> 
                                    <input type="hidden" name='button_action' id='button_action' value='insert'>
                                    <input type="submit" name='submit' id='action' value='Add' 
                                        class='btn btn-outline-success mb-2'>
                                </div>
                            </form>
                        </div>
                    </div>
            
                </div>
                <!-- Header Level Data Entry Ends**********-->
                <!-- Detail Level Data Entry : Income-->
                <div id="detailEntryModal1" class="modal fade" data-backdrop="static" 
                    data-keyboard="false" role="dialog" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered 3SISPro-modal-dialog modal-lg" role="document">
                        <div class='modal-content'> 
                            <!-- Modal Header -->
                            <div class="modal-header-detail3SIS" id="registerModalLabel" style='background-color: #343A40;'>
                                <h4 class="modal-title-detail1"></h4>
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                                    <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" 
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" 
                                    stroke-linecap="round" stroke-linejoin="round" 
                                    class="feather feather-x text-danger"><line x1="18" y1="6" x2="6" y2="18">                                            
                                    </line><line x1="6" y1="6" x2="18" y2="18"></line></svg></button>
                            </div>
                            <form  id='twoLevelDataEntryForm1' autocomplete="off"
                                    method="post" action="{{ route('employeeEarnings.postSubFormDataIncome') }}">
                                    <input type="hidden" name="_token" id="csrfTokenDetail" value="{{ csrf_token() }}">
                                    <input type="hidden" name='UniqueIdEmpI' id='UniqueIdEmpI' class='form-control'>
                                    <input type="hidden" name='EmployeeIdI' id='EmployeeIdI' class='form-control'>
                                <!-- Modal Body -->
                                <div class="modal-body">
                                    <div class="widget-content widget-content-area-detail3SIS animated-underline-content">
                                        <div class="container-fluid">
                                            <div class='form-group mb-0'>
                                                <input type="hidden" name='EEIMDUniqueId' id='EEIMDUniqueId' class='form-control-detail3SIS'>
                                            </div>
                                            <!-- Error Messages -->
                                            <div class='row mt-0' id='errorMessageId1'>
                                                <div class='col-md-12 alert alert-danger'>
                                                    <span id='detailEntryMessages1'></span>
                                                </div>
                                            </div>
                                            <!-- Id, Desc1, Percent -->
                                            <div class="row mt-0">
                                                <div class="col-md-4">
                                                    <div class='form-group'>                                                
                                                        <label>Income Id</label>
                                                        <span class="error-text EEIMDIncomeId_error text-danger" 
                                                                    style='float:right;'></span>
                                                        <select id='EEIMDIncomeId' name = 'EEIMDIncomeId' style='width: 100%;'>
                                                            <option value=''>-- Income Type --</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class='form-group'>                                                
                                                        <label>Effective From</label>
                                                        <span class="error-text EEIMDEffectiveFrom_error text-danger" 
                                                            style='float:right;'></span>
                                                        <input type="date" name='EEIMDEffectiveFrom' id="EEIMDEffectiveFrom"
                                                            class="form-control">
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class='form-group'>                                                
                                                        <label>Effective To</label>
                                                        <span class="error-text EEIMDEffectiveTo_error text-danger" 
                                                            style='float:right;'></span>
                                                        <input type="date" name='EEIMDEffectiveTo' id="EEIMDEffectiveTo"
                                                            class="form-control" value="9999-12-31">
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- Percent -->
                                            <div class="row mt-0">
                                                <div class="col-md-4">
                                                    <div class='form-group'>                                                
                                                        <label>Gross Income</label> 
                                                        <span class="error-text EEIMDGrossIncome_error text-danger" 
                                                            style='float:right;'></span>
                                                        <input type="number" name='EEIMDGrossIncome' id='EEIMDGrossIncome' 
                                                            class='form-control' step='any' style='opacity:1' value='0.00' step='any'>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class='form-group'>                                                
                                                        <label>Distributing %</label> 
                                                        <span class="error-text EEIMDIncomePercent_error text-danger" 
                                                            style='float:right;'></span>
                                                        <input type="number" name='EEIMDIncomePercent' id='EEIMDIncomePercent' 
                                                            class='form-control' step='any' style='opacity:1' value='100.00' step='any'>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class='form-group'>                                                
                                                        <label>Payroll Income</label> 
                                                        <span class="error-text EEIMDPayrollIncome_error text-danger" 
                                                            style='float:right;'></span>
                                                        <input type="number" name='EEIMDPayrollIncome' id='EEIMDPayrollIncome' 
                                                            class='form-control' step='any' style='opacity:1' value='0.00' step='any'>
                                                    </div>
                                                </div>
                                            </div>                   
                                        </div>
                                    </div>
                                </div>
                                <!-- Modal Footer -->
                                <div class='modal-footer-detail3SIS'>
                                    <!--To display success messages-->
                                    <span id='form_output_detail_entry1' style='float:left; padding-left:0px' ></span> 
                                    <input type="hidden" name='button_action_DetailEntry1' id='button_action_DetailEntry1' value='insert'>
                                    <input type="submit" name='submit_DetailEntry' id='action_DetailEntry1' value='Update' 
                                        class='btn btn-outline-success mb-2'>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- Detail Level Data Entry : Income Ends**********-->
                <!-- Detail Level Data Entry : Deduction-->
                <div id="detailEntryModal2" class="modal fade" data-backdrop="static" 
                    data-keyboard="false" role="dialog" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered 3SISPro-modal-dialog modal-lg" role="document">
                        <div class='modal-content'> 
                            <!-- Modal Header -->
                            <div class="modal-header-detail3SIS" id="registerModalLabel" style='background-color: #343A40;'>
                                <h4 class="modal-title-detail2"></h4>
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                                    <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" 
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" 
                                    stroke-linecap="round" stroke-linejoin="round" 
                                    class="feather feather-x text-danger"><line x1="18" y1="6" x2="6" y2="18">                                            
                                    </line><line x1="6" y1="6" x2="18" y2="18"></line></svg></button>
                            </div>
                            <form  id='twoLevelDataEntryForm2' autocomplete="off"
                                    method="post" action="{{ route('employeeEarnings.postSubFormDataDeduction') }}">
                                    <input type="hidden" name="_token" id="csrfTokenDetail" value="{{ csrf_token() }}">
                                    <input type="hidden" name='UniqueIdEmpD' id='UniqueIdEmpD' class='form-control'>
                                    <input type="hidden" name='EmployeeIdD' id='EmployeeIdD' class='form-control'>
                                <!-- Modal Body -->
                                <div class="modal-body">
                                    <div class="widget-content widget-content-area-detail3SIS animated-underline-content">
                                        <div class="container-fluid">
                                            <div class='form-group mb-0'>
                                                <input type="hidden" name='EEDMDUniqueId' id='EEDMDUniqueId' class='form-control-detail3SIS'>
                                            </div>
                                            <!-- Error Messages -->
                                            <div class='row mt-0' id='errorMessageId2'>
                                                <div class='col-md-12 alert alert-danger'>
                                                    <span id='detailEntryMessages2'></span>
                                                </div>
                                            </div>
                                            <!-- Id, Desc1, Percent -->
                                            <div class="row mt-0">
                                                <div class="col-md-4">
                                                    <div class='form-group'>                                                
                                                        <label>Deduction Id</label>
                                                        <span class="error-text EEDMDDeductionId_error text-danger" 
                                                                    style='float:right;'></span>
                                                        <select id='EEDMDDeductionId' name = 'EEDMDDeductionId' style='width: 100%;'>
                                                            <option value=''>-- Deduction Type --</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class='form-group'>                                                
                                                        <label>Effective From</label>
                                                        <span class="error-text EEDMDEffectiveFrom_error text-danger" 
                                                            style='float:right;'></span>
                                                        <input type="date" name='EEDMDEffectiveFrom' id="EEDMDEffectiveFrom"
                                                            class="form-control">
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class='form-group'>                                                
                                                        <label>Effective To</label>
                                                        <span class="error-text EEDMDEffectiveTo_error text-danger" 
                                                            style='float:right;'></span>
                                                        <input type="date" name='EEDMDEffectiveTo' id="EEDMDEffectiveTo"
                                                            class="form-control" value="9999-12-31">
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- Percent -->
                                            <div class="row mt-0">
                                                <div class="col-md-4">
                                                    <div class='form-group'>                                                
                                                        <label>Gross Deduction</label> 
                                                        <span class="error-text EEDMDGrossDeduction_error text-danger" 
                                                            style='float:right;'></span>
                                                        <input type="number" name='EEDMDGrossDeduction' id='EEDMDGrossDeduction' 
                                                            class='form-control' step='any' style='opacity:1' value='0.00' step='any'>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class='form-group'>                                                
                                                        <label>Distributing %</label> 
                                                        <span class="error-text EEDMDDeductionPercent_error text-danger" 
                                                            style='float:right;'></span>
                                                        <input type="number" name='EEDMDDeductionPercent' id='EEDMDDeductionPercent' 
                                                            class='form-control' step='any' style='opacity:1' value='100.00' step='any'>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class='form-group'>                                                
                                                        <label>Payroll Deduction</label> 
                                                        <span class="error-text EEDMDPayrollDeduction_error text-danger" 
                                                            style='float:right;'></span>
                                                        <input type="number" name='EEDMDPayrollDeduction' id='EEDMDPayrollDeduction' 
                                                            class='form-control' step='any' style='opacity:1' value='0.00' step='any'>
                                                    </div>
                                                </div>
                                            </div>                   
                                        </div>
                                    </div>
                                </div>
                                <!-- Modal Footer -->
                                <div class='modal-footer-detail3SIS'>
                                    <!--To display success messages-->
                                    <span id='form_output_detail_entry2' style='float:left; padding-left:0px' ></span> 
                                    <input type="hidden" name='button_action_DetailEntry2' id='button_action_DetailEntry2' value='insert'>
                                    <input type="submit" name='submit_DetailEntry' id='action_DetailEntry2' value='Update' 
                                        class='btn btn-outline-success mb-2'>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- Detail Level Data Entry : Deduction Ends**********-->
                @include('commonViews3SIS.modalCommon3SIS')
            </div>
        </div>
    </div>
</div>
<script>        
    $(document).ready(function(){
        $modalTitle = 'Employee Earnigs ';
        $modalTitleDetailEntry1 = 'Employee Incomes ' 
        $modalTitleDetailEntry2 = 'Employee Deductions ' 
        // Landing Page browser
        $('#html5-extension3SIS').DataTable( {
                dom: '<"row"<"col-md-12"<"row"<"col-md-6"B><"col-md-6"f> > ><"col-md-12"rt> \
                    <"col-md-12"<"row"<"col-md-5"i><"col-md-7"p>>> >',
                buttons: {
                    buttons: [
                        // { extend: 'copy', className: 'btn' },
                        // { extend: 'csv', className: 'btn' },
                        // { extend: 'excel', className: 'btn' },
                        // { extend: 'print', className: 'btn' }
                    ]
                },
                "oLanguage": {
                    "oPaginate": { "sPrevious": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" \
                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" \
                        class="feather feather-arrow-left"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5">\
                        </polyline></svg>', "sNext": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" \
                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" \
                        stroke-linejoin="round" class="feather feather-arrow-right"><line x1="5" y1="12" x2="19" y2="12"></line>\
                        <polyline points="12 5 19 12 12 19"></polyline></svg>' },
                    "sInfo": "Showing page _PAGE_ of _PAGES_",
                    "sSearch": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>',
                    "sSearchPlaceholder": "Search...",
                    "sLengthMenu": "Results :  _MENU_",
                },
                stripeClasses: [],
                pageLength: 6,
                lengthMenu: [6, 10, 20, 50],
                order: [ 0, "asc" ],
                processing: true,
                serverSide: true,
                autoWidth: false,
                "ajax": "{{ route('employeeEarnings.browserData')}}",
                "columns":[
                    // CopyChange
                    {data: "EMGIHEmployeeId"},
                    {data: "EMGIHFullName"},                    
                    {data: "EMGIHGenderId"},
                    {data: "GMCOHNickName"},
                    {data: "GMLMHDesc1"},
                    {data: "GMLMHDesc1"},
                    {data: "EEGIHIncomeDefined"},
                    {data: "action", orderable:false, searchable: false},
                    {data: "EMGIHUniqueId", "visible": false},
                    {data: "EMGIHUser", "visible": false},
                    {data: "EMGIHLastUpdated", "visible": false},
                    {data: "EEGIHDeductionDefined", "visible": false}, 
                ],                
                "columnDefs": [{
                    // Setting width of each column
                    width: "10%", "targets": 0,
                    width: "20%", "targets": 1,
                    width: "5%", "targets": 2,
                    width: "15%", "targets": 3,
                    width: "15%", "targets": 4,
                    width: "15%", "targets": 5,
                    width: "5%", "targets": 6,
                    width: "5%", "targets": 7,
                    width: "10%", "targets": 8,
                    "targets": 6,
                    data:   "EEGIHIncomeDefined",
                    render: function (data ,td, cellData, rowData, row, col) {

                        if(data==1){
                            return '<label class="columnDefs new-control new-checkbox checkbox-primary">\
                            <input type="checkbox" class="new-control-input chk-parent select-customers-info" checked>\
                            <span class="new-control-indicator"></span><span style="visibility:hidden">c</span></label>';
                        }else{
                            return '<label class="columnDefs new-control new-checkbox checkbox-primary">\
                            <input type="checkbox" class="new-control-input chk-parent select-customers-info">\
                            <span class="new-control-indicator"></span><span style="visibility:hidden">c</span></label>';
                        }
                    },
                    // "targets": 7,
                    // data:   "EEGIHDeductionDefined",
                    // render: function (data ,td, cellData, rowData, row, col) {

                    //     if(data==1){
                    //         return '<label class="columnDefs new-control new-checkbox checkbox-primary">\
                    //         <input type="checkbox" class="new-control-input chk-parent select-customers-info" checked>\
                    //         <span class="new-control-indicator"></span><span style="visibility:hidden">c</span></label>';
                    //     }else{
                    //         return '<label class="columnDefs new-control new-checkbox checkbox-primary">\
                    //         <input type="checkbox" class="new-control-input chk-parent select-customers-info">\
                    //         <span class="new-control-indicator"></span><span style="visibility:hidden">c</span></label>';
                    //     }
                    // },                
                }],
            });
        // Landing Page browser Ends
        // When edit button is pushed on Landing Browser
        $(document).on('click', '.edit', function(){
            var id = $(this).attr('id');
            $.ajax({
                // CopyChange
                url: "{{route('employeeEarnings.fetchData')}}",
                method: 'GET',
                data: {id:id},
                dataType: 'json',
                success: function(data)
                {
                    // Update Screen Variables
                    fnUpdateScreenVariables(data);
                    fnLoadIncomeSubForm();
                    fnLoadDeductionSubForm();
                    $titleSuffix = "<b style='color: #F5821F'>" + ' [ ' + $('#EMGIHFullName').val() + ' ]' + "</b>";                    
                    fnDataEntryFormHeader('1', 'Edit ', $titleSuffix);
                    $("#animated-underline-home-tab").trigger('click');  
                }
            });
        });
        // Edit Ends
        // Sub Form Events - Income
        // When Add button is pushed        
        $('#add_Data_Income').click(function(){
            $('#detailEntryMessages1').html('');
            $('#errorMessageId1').hide();
            fnDetailEntryOnSubForm1('0', 'Add ', 'Edit ');
            // All Dropdowns
            fnIncomeTypeDropdownsAddMode()

        });
        // Add button Income Ends*****
        // // When Edit button is pushed        
        // $(document).on('click', '.edit_income', function(){            
        //     $('#detailEntryMessages1').html('');
        //     $('#errorMessageId1').hide();
        //     var uniqueId = $(this).attr('id');
        //     $.ajax({
        //         // CopyChange
        //         url: "{{route('employeeEarnings.fetchSubFormDataIncome')}}",
        //         method: 'GET',
        //         data: {id:uniqueId},
        //         dataType: 'json',
        //         success: function(data)
        //         {
        //             // Update Screen Variables
        //             fnUpdateScreenVariablesIncome(data);
        //             // Update Dropdowns
        //             fnUpdateDropdownsIncome(data)
        //             fnDetailEntryOnSubForm1('1', 'Add ', 'Edit ');
        //         }
        //     });
        // });
        // // Edit button Income Ends*****
        // When submit button Income is pushed
        $('#twoLevelDataEntryForm1').on('submit', function(event){
            event.preventDefault();
            $.ajax({
                url: $(this).attr('action'),
                method: $(this).attr('method'),
                data: new FormData(this),
                processData: false,
                dataType: "json",
                contentType: false,
                beforeSend: function(){
                    $(document).find('span.error-text').text('');
                    // Reinstate Border Color
                    ReinstateBorderColorIncome();                    
                    $('#errorMessageId1').hide();
                },
                success:function(data)
                {
                    if(data.status == 0)
                    {
                        $.each(data.error, function(prefix,val){
                            $('span.' +prefix+ '_error').text(val[0]);
                            $('#' +prefix).css('border-color', '#dc3545');                            
                        });
                        if (data.ErrorOutput != '') {
                            $('#errorMessageId1').show();                        
                            $('#detailEntryMessages1').html(data.ErrorOutput); 
                        }                        
                    }else{
                        $finalMessage3SIS = fnSingleLevelFinalSave(data.masterName, data.Id, data.Desc1, data.updateMode);
                        $('#FinalSaveMessage').html($finalMessage3SIS);
                        fnDetailEntryOnSubForm1('0', 'Add ', 'Edit ');
                        $('#EEIMDIncomeId').val('-- Income Type --').trigger('change');
                        $('#html5-incomeTypeSubform3SIS').DataTable().ajax.reload();
                        if(data.updateMode=='Updated')
                        {
                            $('#detailEntryModal1').modal('hide');
                            $('#modalZoomFinalSave3SIS').modal('show');
                        }
                        else
                        {
                            $('#form_output_detail_entry1').html($finalMessage3SIS);
                        }
                    }
                    
                }
            })
        });
        // When submit button Income is pushed Ends*****
        // When delete button is pushed
        $(document).on('click', '.delete_income', function(){
            var UniqueId = $(this).attr('id');
            // Delete Mem Record : Income
            $.ajax({
                    // CopyChange
                    url:"{{route('employeeEarnings.deleteMemDataIncome')}}",
                    mehtod:"get",
                    data:{id:UniqueId},
                    success:function(data)
                    {
                        $('#html5-incomeTypeSubform3SIS').DataTable().ajax.reload();
                        UniqueId = 0;
                    }
            })
            // Delete Mem Record : Income Ends
        }); 
        // Sub Form Events - Income Ends*****
        // Sub Form Events - Deduction
        // When Add button is pushed        
        $('#add_Data_Deduction').click(function(){
            $('#detailEntryMessages2').html('');
            $('#errorMessageId2').hide();
            fnMakeFieldsEditable();
            fnDetailEntryOnSubForm2('0', 'Add ', 'Edit ');
            // All Dropdowns
            fnDeductionTypeDropdownsAddMode()
        });
        // Add button Deduction Ends*****
        // When submit button Deduction is pushed
        $('#twoLevelDataEntryForm2').on('submit', function(event){
            event.preventDefault();
            $.ajax({
                url: $(this).attr('action'),
                method: $(this).attr('method'),
                data: new FormData(this),
                processData: false,
                dataType: "json",
                contentType: false,
                beforeSend: function(){
                    $(document).find('span.error-text').text('');
                    // Reinstate Border Color
                    ReinstateBorderColorDeduction();                    
                    $('#errorMessageId2').hide();
                },
                success:function(data)
                {
                    if(data.status == 0)
                    {
                        $.each(data.error, function(prefix,val){
                            $('span.' +prefix+ '_error').text(val[0]);
                            $('#' +prefix).css('border-color', '#dc3545');                            
                        });
                        if (data.ErrorOutput != '') {
                            $('#errorMessageId2').show();                        
                            $('#detailEntryMessages2').html(data.ErrorOutput); 
                        }                        
                    }else{
                        $finalMessage3SIS = fnSingleLevelFinalSave(data.masterName, data.Id, data.Desc1, data.updateMode);
                        $('#FinalSaveMessage').html($finalMessage3SIS);
                        fnDetailEntryOnSubForm2('0', 'Add ', 'Edit ');
                        $('#EEDMDDeductionId').val('-- Deduction Type --').trigger('change');
                        $('#html5-deductionTypeSubform3SIS').DataTable().ajax.reload();
                        if(data.updateMode=='Updated')
                        {
                            $('#detailEntryModal2').modal('hide');
                            $('#modalZoomFinalSave3SIS').modal('show');
                        }
                        else
                        {
                            $('#form_output_detail_entry2').html($finalMessage3SIS);
                        }
                    }
                    
                }
            })
        });
        // When delete button is pushed - Deduction
        $(document).on('click', '.delete_deduction', function(){
            var UniqueId = $(this).attr('id');
            $.ajax({
                    // CopyChange
                    url:"{{route('employeeEarnings.deleteMemDataDeduction')}}",
                    mehtod:"get",
                    data:{id:UniqueId},
                    success:function(data)
                    {
                        $('#html5-deductionTypeSubform3SIS').DataTable().ajax.reload();
                        UniqueId = 0;
                    }
            })
        });
        // When Edit button is pushed        
        $(document).on('click', '.edit_deduction', function(){            
            $('#detailEntryMessages2').html('');
            $('#errorMessageId2').hide();
            var uniqueId = $(this).attr('id');
            $.ajax({
                // CopyChange
                url: "{{route('employeeEarnings.fetchSubFormDataDeduction')}}",
                method: 'GET',
                data: {id:uniqueId},
                dataType: 'json',
                success: function(data)
                {
                    // Update Screen Variables
                    fnUpdateScreenVariablesDeduction(data);
                    // Update Dropdowns
                    fnUpdateDropdownsDeduction(data);
                    // Statutory Deductions needs to be read only
                    fnMakeFieldsReadOnly(data);
                    fnDetailEntryOnSubForm2('1', 'Add ', 'Edit ');
                }
            });
        });
        // Edit button Deduction Ends*****
        // Sub Form Events - Deduction Ends*****
        // When Final Submit button is pushed to save header and details
        $('#singleLevelDataEntryForm').on('submit', function(event){            
            event.preventDefault();
            $.ajax({
                url: $(this).attr('action'),
                method: $(this).attr('method'),
                data: new FormData(this),
                processData: false,
                dataType: "json",
                contentType: false,
                success:function(data)
                {
                    $("#animated-underline-home-tab").trigger('click'); 
                    $finalMessage3SIS = fnSingleLevelFinalSave(data.masterName, data.Id, data.Desc1, data.updateMode);
                    $('#FinalSaveMessage').html($finalMessage3SIS);
                    fnReinstateFormControl('0');
                    $('#html5-extension3SIS').DataTable().ajax.reload();
                    if(data.updateMode=='Updated')
                    {
                        $('#html5-extension3SIS').DataTable().ajax.reload();
                        $('#entryModalSmall').modal('hide');
                        $('#modalZoomFinalSave3SIS').modal('show');
                    }                    
                }
            })
        });
        // Submit Ends
        function fnUpdateScreenVariables(data){
            var EMGIHDateOfJoining = formattedDate(new Date(data.EMGIHDateOfJoining));
            var lastCreated = formattedDate(new Date(data.EMGIHLastCreated));
            var lastUpdated = formattedDate(new Date(data.EMGIHLastUpdated));
            $('#EMGIHUniqueId').val(data.EMGIHUniqueId);                       
            $('#EMGIHEmployeeId').val(data.EMGIHEmployeeId);
            $('#EMGIHFullName').val(data.EMGIHFullName);
            $('#DesignationDesc').val(data.DesignationDesc);
            $('#LocationDesc').val(data.LocationDesc); 
            $('#EMGIHDateOfJoining').val(EMGIHDateOfJoining); 
            $('#EMGIHUser').val(data.EMGIHUser);
            $('#EMGIHLastCreated').val(lastCreated);
            $('#EMGIHLastUpdated').val(lastUpdated);
            // Income Form Submit fields
            $('#UniqueIdEmpI').val(data.EMGIHUniqueId);
            $('#EmployeeIdI').val(data.EMGIHEmployeeId);
            // Deduction Form Submit fields
            $('#UniqueIdEmpD').val(data.EMGIHUniqueId);
            $('#EmployeeIdD').val(data.EMGIHEmployeeId);
        }
        // Dropdown for Income and Deductions.
        $("#EEIMDIncomeId").select2();
        function fnIncomeTypeDropdownsAddMode(){
            $.ajax({
                url: "{{route('dropDownMasters.getSelectedIncomeTypes')}}",
                method: 'GET',
                data: {id:'00'},
                dataType: 'json',
                success: function(response) {
                    $('#EEIMDIncomeId').html(response.SelectedItem);
                },
                cache: true
            })
        }
        // Dropdown for Deduction and Deductions.
        $("#EEDMDDeductionId").select2();
        function fnDeductionTypeDropdownsAddMode(){
            $.ajax({
                url: "{{route('dropDownMasters.getSelectedDeductionTypes')}}",
                method: 'GET',
                data: {id:'00'},
                dataType: 'json',
                success: function(response) {
                    $('#EEDMDDeductionId').html(response.SelectedItem);
                },
                cache: true
            })
        };
    });
    // Income, Deduction Sub Forms
    function fnLoadIncomeSubForm(){
        // Income Type Selection browser
        $('#html5-incomeTypeSubform3SIS').DataTable( {
            dom: '<"row"<"col-md-12"<"row"<"col-md-6"B><"col-md-6"f> > ><"col-md-12"rt> \
                <"col-md-12"<"row"<"col-md-5"i><"col-md-7"p>>> >',
            buttons: {
                buttons: [
                    { extend: 'excel', className: 'btn' },
                    { extend: 'print', className: 'btn' }
                ]
            },
            "oLanguage": {
                "oPaginate": { "sPrevious": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" \
                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" \
                    class="feather feather-arrow-left"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5">\
                    </polyline></svg>', "sNext": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" \
                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" \
                    stroke-linejoin="round" class="feather feather-arrow-right"><line x1="5" y1="12" x2="19" y2="12"></line>\
                    <polyline points="12 5 19 12 12 19"></polyline></svg>' },
                "sInfo": "Showing page _PAGE_ of _PAGES_",
                "sSearch": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>',
                "sSearchPlaceholder": "Search...",
                "sLengthMenu": "Results :  _MENU_",
            },
            stripeClasses: [],
            pageLength: 9,
            lengthMenu: [6,10,25,50],
            order: [ 0, "desc" ],
            processing: true,
            serverSide: true,
            autoWidth: false,
            destroy: true,            
            "ajax": {
                "url": "{{ route('employeeEarnings.browserSubFormIncome')}}",
                "type": "GET",
                "data": function ( d ) {
                    d.id = $('#EMGIHUniqueId').val();
                }
            },
            "columns":[
                {data: "EEIMDLineNo"},
                {data: "EEIMDIncomeId"},
                {data: "EEIMDDesc1"},
                {data: "EEIMDPayrollIncome"},
                {data: "EEIMDEffectiveFrom"},
                {data: "EEIMDEffectiveTo"},                
                {data: "EEIMDMarkForDeletion"},                
                {data: "action", orderable:false, searchable: false},
                {data: "EEIMDUser", "visible": false},
                {data: "EEIMDUniqueId", "visible": false},
            ],
            columnDefs: [{
                // Setting width of each column
                width: "5%", "targets": 0,
                width: "10%", "targets": 1,
                width: "20%", "targets": 2,
                width: "15%", "targets": 3,
                width: "10%", "targets": 4,
                width: "10%", "targets": 5,
                width: "10%", "targets": 6,
                width: "10%", "targets": 7,
                "targets": 6,
                data:   "EEIMDMarkForDeletion",
                render: function (data ,td, cellData, rowData, row, col) {

                    if(data==1){
                        return '<label class="columnDefs new-control new-checkbox checkbox-primary">\
                        <input type="checkbox" class="new-control-input chk-parent select-customers-info" checked>\
                        <span class="new-control-indicator"></span><span style="visibility:hidden">c</span></label>';
                    }else{
                        return '<label class="columnDefs new-control new-checkbox checkbox-primary">\
                        <input type="checkbox" class="new-control-input chk-parent select-customers-info">\
                        <span class="new-control-indicator"></span><span style="visibility:hidden">c</span></label>';
                    }
                }
            }],
            // "rowCallback": function( row, data, index ){
            //     $('td', row).css('color', 'white');
            //     if ( data['PMDTDIsSelect'] == 1 )
            //     {
            //         $('td', row).css('color', '#ffc107');
            //     }
            // }
        });
        // Income Type Selection browser Ends
    }
    function fnLoadDeductionSubForm(){
        // Deduction Type Selection browser
        $('#html5-deductionTypeSubform3SIS').DataTable( {
            dom: '<"row"<"col-md-12"<"row"<"col-md-6"B><"col-md-6"f> > ><"col-md-12"rt> \
                <"col-md-12"<"row"<"col-md-5"i><"col-md-7"p>>> >',
            buttons: {
                buttons: [
                    // { extend: 'excel', className: 'btn' },
                    // { extend: 'print', className: 'btn' }
                ]
            },
            "oLanguage": {
                "oPaginate": { "sPrevious": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" \
                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" \
                    class="feather feather-arrow-left"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5">\
                    </polyline></svg>', "sNext": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" \
                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" \
                    stroke-linejoin="round" class="feather feather-arrow-right"><line x1="5" y1="12" x2="19" y2="12"></line>\
                    <polyline points="12 5 19 12 12 19"></polyline></svg>' },
                "sInfo": "Showing page _PAGE_ of _PAGES_",
                "sSearch": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>',
                "sSearchPlaceholder": "Search...",
                "sLengthMenu": "Results :  _MENU_",
            },
            stripeClasses: [],
            pageLength: 6,
            lengthMenu: [6,10,25,50],
            order: [ 0, "desc" ],
            processing: true,
            serverSide: true,
            autoWidth: false,
            destroy: true,            
            "ajax": {
                "url": "{{ route('employeeEarnings.browserSubFormDeduction')}}",
                "type": "GET",
                "data": function ( d ) {
                    d.id = $('#EMGIHUniqueId').val();
                }
            },
            "columns":[
                {data: "EEDMDLineNo"},
                {data: "EEDMDDeductionId"},
                {data: "EEDMDDesc1"},
                {data: "EEDMDPayrollDeduction"},
                {data: "EEDMDEffectiveFrom"},
                {data: "EEDMDEffectiveTo"},                
                {data: "EEDMDMarkForDeletion"},                
                {data: "action", orderable:false, searchable: false},
                {data: "EEDMDUser", "visible": false},
                {data: "EEDMDUniqueId", "visible": false},
                {data: "EEDMDDeductionRuleId", "visible": false},
            ],
            columnDefs: [{
                // Setting width of each column
                width: "5%", "targets": 0,
                width: "10%", "targets": 1,
                width: "20%", "targets": 2,
                width: "15%", "targets": 3,
                width: "10%", "targets": 4,
                width: "10%", "targets": 5,
                width: "10%", "targets": 6,
                width: "10%", "targets": 7,
                "targets": 6,
                data:   "EEDMDMarkForDeletion",
                render: function (data ,td, cellData, rowData, row, col) {

                    if(data==1){
                        return '<label class="columnDefs new-control new-checkbox checkbox-primary">\
                        <input type="checkbox" class="new-control-input chk-parent select-customers-info" checked>\
                        <span class="new-control-indicator"></span><span style="visibility:hidden">c</span></label>';
                    }else{
                        return '<label class="columnDefs new-control new-checkbox checkbox-primary">\
                        <input type="checkbox" class="new-control-input chk-parent select-customers-info">\
                        <span class="new-control-indicator"></span><span style="visibility:hidden">c</span></label>';
                    }
                }
            }],
            "rowCallback": function( row, data, index ){
                $('td', row).css('color', 'white');
                if ( data['EEDMDDeductionRuleId'] != '' &&  data['EEDMDDeductionRuleId'] != 'D5000' && data['EEDMDDeductionRuleId'] != 'Z1000')
                {
                    $('td', row).css('color', '#ffc107');
                }
            }
        });
        // Deduction Type Selection browser Ends
    }
    // Income, Deduction Sub Forms Ends*****
    $('#EEIMDGrossIncome').change(function(){
        $('#EEIMDPayrollIncome').val($('#EEIMDGrossIncome').val() * $('#EEIMDIncomePercent').val() / 100)
    });
    $('#EEIMDIncomePercent').change(function(){
        $('#EEIMDPayrollIncome').val($('#EEIMDGrossIncome').val() * $('#EEIMDIncomePercent').val() / 100)
    });
    $('#EEDMDGrossDeduction').change(function(){
        $('#EEDMDPayrollDeduction').val($('#EEDMDGrossDeduction').val() * $('#EEDMDDeductionPercent').val() / 100)
    });
    $('#EEDMDDeductionPercent').change(function(){
        $('#EEDMDPayrollDeduction').val($('#EEDMDGrossDeduction').val() * $('#EEDMDDeductionPercent').val() / 100)
    });
    function ReinstateBorderColorIncome(){
        $('#EEIMDEffectiveFrom').css('border-color', 'rgb(102, 175, 233)');
        $('#EEIMDEffectiveTo').css('border-color', 'rgb(102, 175, 233)');
        $('#EEIMDGrossIncome').css('border-color', 'rgb(102, 175, 233)');
        $('#EEIMDPayrollIncome').css('border-color', 'rgb(102, 175, 233)');
    }
    function ReinstateBorderColorDeduction(){
        $('#EEDMDEffectiveFrom').css('border-color', 'rgb(102, 175, 233)');
        $('#EEDMDEffectiveTo').css('border-color', 'rgb(102, 175, 233)');
        $('#EEDMDGrossDeduction').css('border-color', 'rgb(102, 175, 233)');
        $('#EEDMDPayrollDeduction').css('border-color', 'rgb(102, 175, 233)');
    }
    $(document).on('click', '.columnDefs', function(){
        return false;
    });
    function fnUpdateScreenVariablesIncome(data){
            var effectiveFrom   = formattedDate(new Date(data.EEIMDEffectiveFrom));
            var effectiveTo     = formattedDate(new Date(data.EEIMDEffectiveTo));
            $('#EEIMDUniqueId').val(data.EEIMDUniqueId);                       
            $('#UniqueIdEmpI').val(data.UniqueIdEmpI);
            $('#EmployeeIdI').val(data.EmployeeIdI);
            $('#EEIMDIncomeId').val(data.EEIMDIncomeId);
            $('#EEIMDGrossIncome').val(data.EEIMDGrossIncome);
            $('#EEIMDIncomePercent').val(data.EEIMDIncomePercent);
            $('#EEIMDPayrollIncome').val(data.EEIMDPayrollIncome);

            $('#EEIMDEffectiveFrom').val(effectiveFrom);
            $('#EEIMDEffectiveTo').val(effectiveTo);
    }
    function fnUpdateScreenVariablesDeduction(data){
            var effectiveFrom   = formattedDate(new Date(data.EEDMDEffectiveFrom));
            var effectiveTo     = formattedDate(new Date(data.EEDMDEffectiveTo));
            $('#EEDMDUniqueId').val(data.EEDMDUniqueId);                       
            $('#UniqueIdEmpD').val(data.UniqueIdEmpI);
            $('#EmployeeIdD').val(data.EmployeeIdI);
            $('#EEDMDDeductionId').val(data.EEDMDDeductionId);
            $('#EEDMDGrossDeduction').val(data.EEDMDGrossDeduction);
            $('#EEDMDDeductionPercent').val(data.EEDMDDeductionPercent);
            $('#EEDMDPayrollDeduction').val(data.EEDMDPayrollDeduction);

            $('#EEDMDEffectiveFrom').val(effectiveFrom);
            $('#EEDMDEffectiveTo').val(effectiveTo);
    }
    function fnUpdateDropdownsIncome(data) {
        var $EEIMDIncomeId = data.EEIMDIncomeId;
        fnIncomeDropdownsEditMode($EEIMDIncomeId)
    }
    function fnIncomeDropdownsEditMode($EEIMDIncomeId){
        $.ajax({
            url: "{{route('dropDownMasters.getSelectedIncomeTypes')}}",
            method: 'GET',
            data: {id:$EEIMDIncomeId},
            dataType: 'json',
            success: function(response) {                    
                $('#EEIMDIncomeId').html(response.SelectedItem);
            },
            cache: true
        })
    }
    function fnUpdateDropdownsDeduction(data) {
        var $EEDMDDeductionId = data.EEDMDDeductionId;
        fnDeductionDropdownsEditMode($EEDMDDeductionId)
    }
    function fnDeductionDropdownsEditMode($EEDMDDeductionId){
        $.ajax({
            url: "{{route('dropDownMasters.getSelectedDeductionTypes')}}",
            method: 'GET',
            data: {id:$EEDMDDeductionId},
            dataType: 'json',
            success: function(response) {                    
                $('#EEDMDDeductionId').html(response.SelectedItem);
            },
            cache: true
        })
    }
    function fnMakeFieldsReadOnly(data){
        if (data.EEDMDDeductionRuleId != 'Z1000') {
            $('#EEDMDDeductionId').prop('disabled', true);
            $("#EEDMDGrossDeduction").attr("readonly", true);
            $("#EEDMDDeductionPercent").attr("readonly", true);
            $("#EEDMDPayrollDeduction").attr("readonly", true);
            $("#EEDMDEffectiveFrom").attr("readonly", true);
            $("#EEDMDEffectiveTo").attr("readonly", true);
        }else {
            fnMakeFieldsEditable();
        }
    }
    function fnMakeFieldsEditable(){
        $('#EEDMDDeductionId').prop('disabled', false);
        $("#EEDMDDeductionId").attr("readonly", false);
        $("#EEDMDGrossDeduction").attr("readonly", false);
        $("#EEDMDDeductionPercent").attr("readonly", false);
        $("#EEDMDPayrollDeduction").attr("readonly", false);
        $("#EEDMDEffectiveFrom").attr("readonly", false);
        $("#EEDMDEffectiveTo").attr("readonly", false);
    }
    // When Edit button is pushed        
    $(document).on('click', '.edit_income', function(){            
            $('#detailEntryMessages1').html('');
            $('#errorMessageId1').hide();
            var uniqueId = $(this).attr('id');
            $.ajax({
                // CopyChange
                url: "{{route('employeeEarnings.fetchSubFormDataIncome')}}",
                method: 'GET',
                data: {id:uniqueId},
                dataType: 'json',
                success: function(data)
                {
                    // Update Screen Variables
                    fnUpdateScreenVariablesIncome(data);
                    // Update Dropdowns
                    fnUpdateDropdownsIncome(data)
                    fnDetailEntryOnSubForm1('1', 'Add ', 'Edit ');
                }
            });
        });
        // Edit button Income Ends*****
</script>
@endsection

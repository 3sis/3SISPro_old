@extends('layouts.app')

@section('content')
<div class="layout-px-spacing">
    <div>
        <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
            <div class=" br-6">
                <div style='float:right; padding-right:30px'>
                    <button type='button' name='Undo' id='Undelete_Data' class='btn btnUnDeleteRec3SIS'>Undo
                        <i class="fas fa-undo-alt fa-sm ml-1"> </i>
                    </button>
                    <button type='button' name='add' id='add_Data' class='btn btnAddRec3SIS'>Add
                        <i class="fas fa-plus fa-sm ml-1"> </i>
                    </button>
                </div>
                <!-- Landing Page browser -->
                <div class="table-responsive">
                    <table id="html5-extension3SIS" class="table table-hover non-hover" style="width:100%">
                        <thead>
                            <tr>
                                <!--CopyChange-->  
                                <th title="Deduction Type Id">ID</th>
                                <th>Deduction Type</th>
                                <th>Rule</th>
                                <th>Ded.Cycle</th>
                                <th title="Printing Sequence">P.Seq.</th>
                                <th>Rounding</th>
                                <th title="Income Dependent Deduction">IDD</th>
                                <th>Action</th>
                                <th style="visibility: hidden;">Unique Id</th>
                            </tr>
                        </thead> 
                    </table>
                </div>
                <!-- Landing Page browser Ends-->
                <!-- start undeletemodal -->
                <div id='dataTableModalSmall' class='modal fade  register-modal' role='dialog' 
                    aria-labelledby="registerModalLabel" aria-hidden="true" style='margin-top:40px' 
                    data-backdrop="static">
                    <div class='modal-dialog modal-dialog-centered modal-lg'role="document">
                        <div class='modal-content'>                              
                            <div class="modal-header" id="registerModalLabel">
                                <h4 class="modal-title"></h4>
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                                    <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" 
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" 
                                    stroke-linecap="round" stroke-linejoin="round" 
                                    class="feather feather-x text-danger"><line x1="18" y1="6" x2="6" y2="18">                                            
                                    </line><line x1="6" y1="6" x2="18" y2="18"></line></svg></button>
                            </div>
                            <!--CopyChange-->
                                <div class='modal-body'>
                                    <div class="container-fluid">
                                            <div class="table-responsive">
                                                <table id="html-extension3SIS" class="table table-hover non-hover" style="width:100%">
                                                    <thead>
                                                        <tr>                                                                
                                                            <th title="Deduction Type Id">ID</th>
                                                            <th>Deduction Type</th>
                                                            <th>Desc1</th>
                                                            <th>Action</th>
                                                            <th style="visibility: hidden;">Unique Id</th>
                                                        </tr>
                                                    </thead>   
                                                </table>
                                            </div>
                                        </div>
                                </div>
                        </div>
                    </div>
                </div>
                <!-- end undelete modal -->
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
                                    method="post" action="{{ route('deductionType.postData') }}">
                                    <input type="hidden" name="_token" id="csrfToken" value="{{ csrf_token() }}">
                                <!-- Modal Body -->
                                <div class="modal-body">
                                    <div class="widget-content widget-content-area animated-underline-content">
                                        <!-- Nav Tabs -->
                                        <ul class="nav nav-tabs mb-3" id="animateLine" role="tablist">
                                            <li class="nav-item">
                                                <a class="nav-link active" id="animated-underline-home-tab" data-toggle="tab" 
                                                href="#animated-underline-home" role="tab" aria-controls="animated-underline-home" a
                                                ria-selected="true"> Entry</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" id="animated-underline-selectIncome-tab" data-toggle="tab" 
                                                href="#animated-underline-selectIncome" role="tab" aria-controls="animated-underline-selectIncome" 
                                                aria-selected="false">Select Income</a>
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
                                                        <input type="hidden" name='PMDTHUniqueId' id='PMDTHUniqueId' class='form-control'>                                                  
                                                        <input type="hidden" name='PMDTHDeductionIdK' id='PMDTHDeductionIdK' class='form-control'>                                                 
                                                        <input type="hidden" name='PMDTHIsTaxExempted' id='PMDTHIsTaxExempted' class='form-control'>                                                 
                                                        <input type="hidden" name='PMDTHIsThisLoanLine' id='PMDTHIsThisLoanLine' class='form-control'>                                                 
                                                        <input type="hidden" name='PMDTHShowInTaxList' id='PMDTHShowInTaxList' class='form-control'>                                                 
                                                        <input type="hidden" name='PMDTHIsIncomeDependent' id='PMDTHIsIncomeDependent' class='form-control'>                                                 
                                                    </div>
                                                    <!-- Id, Desc1, Desc2, BI Id -->
                                                    <div class="row mt-0">
                                                        <div class="col-md-2">
                                                            <div class='form-group'>                                                
                                                                <label>Ded.Type Id</label> 
                                                                <span class="error-text PMDTHDeductionId_error text-danger" 
                                                                    style='float:right;'></span>
                                                                <input type="text"  name='PMDTHDeductionId' id='PMDTHDeductionId' 
                                                                    class='form-control few-options' maxlength="10" 
                                                                    placeholder="Deduction Id" style='opacity:1'>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class='form-group'>                                                
                                                                <label>Description</label> 
                                                                <span class="error-text PMDTHDesc1_error text-danger" 
                                                                    style='float:right;'></span>
                                                                <input type="text" name='PMDTHDesc1' id="PMDTHDesc1"  maxlength="100" placeholder="Deduction Description"
                                                                    class="form-control few-options">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-2">
                                                            <!-- BI Dropdown -->
                                                            <div class='form-group'>
                                                                <label>BI Desc</label>                                                
                                                                <span class="error-text biDescId_error text-danger" 
                                                                    style='float:right;'></span>
                                                                <select id='biDescId' name = 'biDescId' style='width: 100%;'>
                                                                    <option value=''>-- BI Code --</option>
                                                                </select>                                                
                                                            </div>                 
                                                        </div>
                                                            <div class="col-md-4">
                                                                <div class='form-group'>                                                
                                                                    <label>Description2</label>  
                                                                    <textarea name='PMDTHDesc2' id='PMDTHDesc2' class='form-control few-options' 
                                                                    maxlength="200" name="alloptions" id="alloptions1" placeholder="Additional Description" 
                                                                    aria-label="With textarea" 
                                                                    style='border-color: rgb(102, 175, 233); outline: 0px'></textarea>
                                                                </div>
                                                            </div>                                                            
                                                    </div>
                                                    <!-- Rounding, Printing Seq., Rule Id, Gender Specific, Deduction Strategy -->
                                                    <div class="row mt-0">                                                        
                                                        <div class="col-md-2">
                                                            <!-- Rounding Dropdown -->
                                                            <div class='form-group'>
                                                                <label>Rounding</label>                                                
                                                                <span class="error-text roundingId_error text-danger" 
                                                                    style='float:right;'></span>
                                                                <select id='roundingId' name = 'roundingId' style='width: 100%;'>
                                                                    <option value='1000'>No Round</option>
                                                                    <option value='1100'>Round</option>
                                                                    <option value='1200'>Round Up</option>
                                                                    <option value='1300'>Round Down</option>
                                                                </select>                                                
                                                            </div>                 
                                                        </div>
                                                        <div class="col-md-2">
                                                            <div class='form-group'>                                                
                                                                <label>Printing Seq.</label> 
                                                                <span class="error-text PMDTHPrintingSeq_error text-danger" 
                                                                    style='float:right;'></span>
                                                                <input type="number" name='PMDTHPrintingSeq' id="PMDTHPrintingSeq"
                                                                    class="form-control" step='1' value='0'>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-2">
                                                            <!-- Rule Definition Dropdown -->
                                                            <div class='form-group'>
                                                            <label>Rule Id</label>                                                                    
                                                                <select id='ruleDefId' name = 'ruleDefId' style='width: 100%;'>
                                                                    <option value=''>-Select Rule-</option>
                                                                </select>                                            
                                                            </div>                 
                                                        </div>
                                                        <div class="col-md-2">
                                                            <div class='form-group'>
                                                                <label>Gender Specific</label>                                                
                                                                <span class="error-text genderSpecificId_error text-danger" 
                                                                    style='float:right;'></span>
                                                                <select id='genderSpecificId' name = 'genderSpecificId' style='width: 100%;'>
                                                                    <option value='C'>Common</option>
                                                                    <option value='I'>Individual</option>
                                                                </select>                                                
                                                            </div>     
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class='form-group'>
                                                                <label>Deduction Strategy</label>                                                
                                                                <span class="error-text deductionStrategyId_error text-danger" 
                                                                    style='float:right;'></span>
                                                                <select id='deductionStrategyId' name = 'deductionStrategyId' style='width: 100%;'>
                                                                    <option value='C'>Cumulative</option>
                                                                    <option value='P'>This Period Only</option>
                                                                </select>                                                
                                                            </div>     
                                                        </div>
                                                    </div>
                                                    <!-- Is Loan, Tax Exempted, Consider In Tax, Income Dependent -->
                                                    <div class="row mt-0">
                                                        <div class="col-md-2 n-chk">
                                                            <label class="new-control new-checkbox new-checkbox-text checkbox-success">
                                                                <input type="checkbox" class="new-control-input" name='isTaxExempted' id='isTaxExempted'>
                                                                <span class="new-control-indicator"></span><span class="new-chk-content">Is Tax Exempted</span>
                                                            </label>
                                                        </div>
                                                        <div class="col-md-2 n-chk">
                                                            <label class="new-control new-checkbox new-checkbox-text checkbox-success">
                                                                <input type="checkbox" class="new-control-input" name='isLoanLine' id='isLoanLine'>
                                                                <span class="new-control-indicator"></span><span class="new-chk-content">Is Loan Line</span>
                                                            </label>
                                                        </div>
                                                        <div class="col-md-2 n-chk">
                                                            <label class="new-control new-checkbox new-checkbox-text checkbox-success">
                                                                <input type="checkbox" class="new-control-input" name='isShowInTaxList' id='isShowInTaxList'>
                                                                <span class="new-control-indicator"></span><span class="new-chk-content">Consider in IT</span>
                                                            </label>
                                                        </div>
                                                        <div class="col-md-3 n-chk">
                                                            <label class="new-control new-checkbox new-checkbox-text checkbox-success">
                                                                <input type="checkbox" class="new-control-input" name='isIncomeDependent' id='isIncomeDependent'>
                                                                <span class="new-control-indicator"></span><span class="new-chk-content">Income Dependent</span>
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <br>
                                                    <!-- Deduction Cycle -->
                                                    <div class="row mt-0">
                                                        <div class="col-md-2">                                                                
                                                            <div class='form-group'>
                                                                <label>Deduction Cycle</label>                                                
                                                                <span class="error-text paymentCycleId_error text-danger" 
                                                                    style='float:right;'></span>
                                                                <select id='deductionCycleId' name = 'deductionCycleId' style='width: 100%;'>
                                                                    <option value='M'>Monthly</option>
                                                                    <option value='P'>Periodic</option>
                                                                </select>                                                
                                                            </div>                 
                                                        </div>
                                                        <!-- Period Dropdown Multiselect -->
                                                        <div class="col-md-10">
                                                            <div class='form-group' id='periodDropdownId'>
                                                                <label>Period</label>                                                
                                                                <span class="error-text periodId_error text-danger" 
                                                                    style='float:right;'></span>
                                                                <select multiple="multiple" id='periodId' name = 'periodId[]' style='width: 100%;'>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                                                                
                                                </div>
                                            </div>
                                            <!-- Tab : Income Type Selections -->
                                            <div class="tab-pane fade" id="animated-underline-selectIncome" role="tabpanel" 
                                                aria-labelledby="animated-underline-selectIncome-tab">
                                                <!-- Sub Form -->
                                                <div class="table-responsive">
                                                    <table id="html5-incomeTypeSubform3SIS" class="table table-hover non-hover" style="width:100%">
                                                        <thead>
                                                            <tr>
                                                                <th>Line#</th>
                                                                <th>Income Id</th>
                                                                <th>Description</th>
                                                                <th>Select</th>
                                                                <th>Percent</th>
                                                                <th>Action</th>
                                                                <th style="visibility: hidden;">User</th>
                                                                <th style="visibility: hidden;">Unique Id</th>
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
                                                            <input type="text" name="PMDTHUser" id="PMDTHUser" 
                                                            class="form-control col-sm-6" readonly/>
                                                        </div>
                                                        <div class="form-group">
                                                            <label> Created Date</label>
                                                            <input type="date" name="PMDTHLastCreated" id="PMDTHLastCreated" 
                                                            class="form-control col-sm-6" readonly/>
                                                        </div>
                                                        <div class="form-group">
                                                            <label> Updated Date</label>
                                                            <input type="date" name="PMDTHLastUpdated" id="PMDTHLastUpdated" 
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
                <!-- Detail Level Data Entry -->
                <div id="detailEntryModal" class="modal fade" data-backdrop="static" 
                    data-keyboard="false" role="dialog" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered 3SISPro-modal-dialog modal-md" role="document">
                        <div class='modal-content'> 
                            <!-- Modal Header -->
                            <div class="modal-header-detail3SIS" id="registerModalLabel" style='background-color: #343A40;'>
                                <h4 class="modal-title-detail"></h4>
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                                    <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" 
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" 
                                    stroke-linecap="round" stroke-linejoin="round" 
                                    class="feather feather-x text-danger"><line x1="18" y1="6" x2="6" y2="18">                                            
                                    </line><line x1="6" y1="6" x2="18" y2="18"></line></svg></button>
                            </div>
                            <form  id='twoLevelDataEntryForm' autocomplete="off"
                                    method="post" action="{{ route('deductionType.postSubFormData') }}">
                                    <input type="hidden" name="_token" id="csrfTokenDetail" value="{{ csrf_token() }}">
                                <!-- Modal Body -->
                                <div class="modal-body">
                                    <div class="widget-content widget-content-area-detail3SIS animated-underline-content">
                                        <div class="container-fluid">
                                            <div class='form-group mb-0'>
                                                <input type="hidden" name='PMDTDUniqueId' id='PMDTDUniqueId' class='form-control-detail3SIS'>
                                            </div>
                                            <!-- Id, Desc1, Percent -->
                                            <div class="row mt-0">
                                                <div class="col-md-5">
                                                    <div class='form-group'>                                                
                                                        <label>Income Id</label>
                                                        <input type="text"  name='PMDTDIncomeId' id='PMDTDIncomeId' 
                                                            class='form-control' readonly>
                                                    </div>
                                                </div>
                                                <div class="col-md-7">
                                                    <div class='form-group'>                                                
                                                        <label>Description</label>
                                                        <input type="text" name='PMDTDDesc1' id="PMDTDDesc1"
                                                            class="form-control" readonly>
                                                    </div>
                                                </div>                                             
                                            </div>
                                            <!-- Percent -->
                                            <div class="row mt-0">
                                                <div class="col-md-5">
                                                    <div class='form-group'>                                                
                                                        <label>Percent</label> 
                                                        <span class="error-text PMDTDDedPercent_error text-danger" 
                                                            style='float:right;'></span>
                                                        <input type="number" name='PMDTDDedPercent' id='PMDTDDedPercent' 
                                                            class='form-control' step='any' placeholder="Percent" style='opacity:1'>
                                                    </div>
                                                </div>                                               
                                            </div>                   
                                        </div>
                                    </div>
                                </div>
                                <!-- Modal Footer -->
                                <div class='modal-footer-detail3SIS'>
                                    <!--To display success messages-->
                                    <span id='form_output_detail_entry' style='float:left; padding-left:0px' ></span> 
                                    <input type="hidden" name='button_action_DetailEntry' id='button_action_DetailEntry' value='insert'>
                                    <input type="submit" name='submit_DetailEntry' id='action_DetailEntry' value='Update' 
                                        class='btn btn-outline-success mb-2'>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- Detail Level Data Entry Ends**********-->
                @include('commonViews3SIS.modalCommon3SIS')
            </div>
        </div>
    </div>
</div>
<script>        
    $(document).ready(function(){
        $modalTitle = 'Deduction Type '
        $modalTitleDetailEntry = 'Income Type '        
        if ($('#deductionCycleId').val() == 'M') {
            $('#periodDropdownId').hide();
        }
        showHideSelectIncomeTab();
        // Landing Page browser
        $('#html5-extension3SIS').DataTable( {
            dom: '<"row"<"col-md-12"<"row"<"col-md-6"B><"col-md-6"f> > ><"col-md-12"rt> \
                <"col-md-12"<"row"<"col-md-5"i><"col-md-7"p>>> >',
            buttons: {
            buttons: [
                // { extend: 'copy', className: 'btn' },
                // { extend: 'csv', className: 'btn' },
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
            lengthMenu: [9, 10, 20, 50],
            order: [ 8, "desc" ],
            processing: true,
            serverSide: true,
            autoWidth: false,
            "ajax": "{{ route('deductionType.browserData')}}",
            "columns":[
                {data: "PMDTHDeductionId"},
                {data: "PMDTHDesc1"},
                {data: "PMRDHDesc1"},
                {data: "PMPCHDesc1"},
                {data: "PMDTHPrintingSeq"},
                {data: "RSRSHDesc1"},
                {data: "PMDTHIsIncomeDependent", orderable:false, searchable: false},
                {data: "action", orderable:false, searchable: false},                
                {data: "PMDTHUniqueId", "visible": false},
            ],
            
            columnDefs: [{
                // Setting width of each column
                width: "10%", "targets": 0,
                width: "15%", "targets": 1,
                width: "15%", "targets": 2,
                width: "15%", "targets": 3,
                width: "5%", "targets": 4,
                width: "15%", "targets": 5,
                width: "5%", "targets": 6,
                width: "20%", "targets": 7,
                // Displaying Checkbox based on IsIncomeDependent which is 6th coloumn
                targets: 6,
                data:   "PMDTHIsIncomeDependent",
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
            }],

            "rowCallback": function( row, data, index ){
                if ( data['PMPCHDesc1'] == "Periodic" )
                {
                    $('td', row).css('color', '#ffc107');
                }
            }
        });
        // Landing Page browser Ends        
        // When add buttonis pushed
        $('#add_Data').click(function(){
            // Fill the subform with Income Type Master in advance
            $.ajax({
                url: "{{route('deductionType.appendSubFormTable')}}",
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                method: 'POST',
                dataType: 'json'
            });
            $("#animated-underline-selectIncome-tab").hide();
            $("#PMDTHDeductionId").attr("readonly", false); 
            $("#animated-underline-home-tab").trigger('click'); 
            fnReinstateFormControl('0');
            // All dropdowns
            fnBiDeductionDropdownsAddMode()
            fnRuleDeductionDefDropdownsAddMode()
            // All dropdowns Ends
            fnLoadSubForm();
            fnReinstateDropDowns();
        });
        // Add Ends        
        // When submit button is pushed
        $('#singleLevelDataEntryForm').on('submit', function(event){
            fnUpdateCheckboxValues();
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
                },
                success:function(data)
                {
                    $("#animated-underline-home-tab").trigger('click'); 
                    if(data.status == 0)
                    {
                        $.each(data.error, function(prefix,val){
                            $('span.' +prefix+ '_error').text(val[0]);
                            $('#' +prefix).css('border-color', '#dc3545');
                        });
                    }else
                    { 
                        $finalMessage3SIS = fnSingleLevelFinalSave(data.masterName, data.Id, data.Desc1, data.updateMode);
                        $('#FinalSaveMessage').html($finalMessage3SIS);
                        fnReinstateFormControl('0');
                        fnReinstateDropDowns();
                        $('#html5-extension3SIS').DataTable().ajax.reload();
                        if(data.updateMode=='Updated')
                        {
                            $('#entryModalSmall').modal('hide');
                            $('#modalZoomFinalSave3SIS').modal('show');
                        }
                        else
                        {
                            $('#form_output').html($finalMessage3SIS);
                        }
                        
                    }
                }
            })
        });
        // Submit Ends  
        // When edit button is pushed
        $(document).on('click', '.edit', function(){
            var id = $(this).attr('id');
            $.ajax({
                // CopyChange
                url: "{{route('deductionType.fetchData')}}",
                method: 'GET',
                data: {id:id},
                dataType: 'json',
                success: function(data)
                {
                    // Update Screen Variables
                    fnUpdateScreenVariables(data);
                    // Update Checkboxes
                    fnUpdateCheckBoxes(data)
                    // Update Dropdowns
                    fnUpdateDropdowns(data)
                    fnLoadSubForm();
                    $("#PMDTHDeductionId").attr("readonly", true);                           
                    fnReinstateFormControl('1');
                    $("#animated-underline-home-tab").trigger('click');

                }
            });
        });
        // Edit Ends                  
        // When delete button is pushed
        $(document).on('click', '.delete', function(){
            var UniqueId = $(this).attr('id');
            // Fetch Record first that need to be deleted.
            $.ajax({
                url: "{{route('deductionType.fetchData')}}",
                method: 'GET',
                data: {id:UniqueId},
                dataType: 'json',
                success: function(data)
                {
                    $deleteMessage3SIS = fnSingleLevelDeleteConfirmation($modalTitle, data.PMDTHDeductionId, '');   
                    $('#DeleteRecord').html($deleteMessage3SIS);
                    $('#modalZoomDeleteRecord3SIS').modal('show');                   
                }
            });
            // Fetch Record Ends
            // Delete record only when OK is pressed on Modal.
            $(document).on('click', '.confirm', function(){
                $.ajax({
                    // CopyChange
                    url:"{{route('deductionType.deleteData')}}",
                    mehtod:"get",
                    data:{id:UniqueId},
                    success:function(data)
                    {
                        $finalMessage3SIS = fnSingleLevelFinalSave(data.masterName, data.Id, data.Desc1, data.updateMode);
                        $('#FinalSaveMessage').html($finalMessage3SIS);                            
                        $('#html5-extension3SIS').DataTable().ajax.reload();
                        // $('#html-extension3SIS').DataTable().ajax.reload();
                        UniqueId = 0;
                        $('#modalZoomDeleteRecord3SIS').modal('hide');
                        $('#modalZoomFinalSave3SIS').modal('show');
                    }
                })
            }); 
            $("#modalZoomDeleteRecord3SIS").on("hide.bs.modal", function () {
                UniqueId = 0;
            });                 
        }); 
        // Delete Ends
        // Whed undo button is pushed
        $('#Undelete_Data').click(function(){                    
            $('#html-extension3SIS').DataTable( {
            stripeClasses: [],
            pageLength: 6,
            lengthMenu: [6, 10, 20, 50],
            order: [[ 1, "desc" ]],
            processing: true,
            serverSide: true,
            destroy: true,                    
            // CopyChange                    
            "ajax": "{{ route('deductionType.browserDeletedRecords')}}",
            "columns":[
                // CopyChange
                {data: "PMDTHDeductionId"},
                {data: "PMDTHDesc1"},
                {data: "PMDTHDesc2"},
                {data: "action", orderable:false, searchable: false},
                {data: "PMDTHUniqueId", "visible": false},
            ]
            });
            fnReinstateDataTable('0');
        });
        // undo Ends 
        // When restore button is pushed
        $(document).on('click', '.restore', function(){
            var DeletedUniqueId = $(this).attr('id');
            // Fetch Record first that need to be restored.
            $.ajax({
                url: "{{route('deductionType.fetchData')}}",
                method: 'GET',
                data: {id:DeletedUniqueId},
                dataType: 'json',
                success: function(data)
                {
                    $restoreMessage3SIS = fnSingleLevelRestoreConfirmation($modalTitle, data.PMDTHDeductionId, '');   
                    $('#RestoreRecord').html($restoreMessage3SIS);
                    $('#modalZoomRestoreRecord3SIS').modal('show');  
                    $('#modalZoomRestoreRecord3SIS').modal('hide');                    
                }
            });
            // Fetch Record Ends
            // Restore record only when OK is pressed on Modal.
            $(document).on('click', '.confirmrestore', function(){
                $.ajax({
                    url:"{{route('deductionType.restoreDeletedRecords')}}",
                    mehtod:"get",
                    data:{id:DeletedUniqueId},
                    success:function(data)
                    {                       
                        $('#html5-extension3SIS').DataTable().ajax.reload();
                        $('#html-extension3SIS').DataTable().ajax.reload();
                        DeletedUniqueId = 0;
                        $('#modalZoomRestoreRecord3SIS').modal('hide');
                        // $('#dataTableModalSmall').modal('hide');
                    }
                })
            }); 
            $("#modalZoomRestoreRecord3SIS").on("hide.bs.modal", function () {
                DeletedUniqueId = 0;
            });                
        }); 
        // restore Ends
        // Rule Definition Dropdown
        $( "#ruleDefId" ).select2({                
            ajax: { 
                url: "{{route('deductionType.getDeductionRuleDef')}}",
                type: "POST",
                dataType: 'json',
                tags: true,
                // The number of milliseconds to wait for the user to stop typing before issuing the ajax request.
                delay: 250,
                // @param params The object containing the parameters used to generate the request.
                data: function (params) {
                    return {
                        _token: $('#csrfToken').val(),
                        search: params.term // search term
                    }
                },
                processResults: function (response) {
                    return {
                        results: response
                    }
                },
                cache: true
            }
            });
        // Rule Definition Dropdown Ends
        // Show Period Dropdown only when Deduction Cycle is P
        $('#deductionCycleId').change(function(){
            if ($('#deductionCycleId').val() == 'M') {
                $('#periodDropdownId').hide();
            }else{
                $('#periodDropdownId').show();
                fnPeroidDropdownsAddMode();
            }
        });
        
        // Period Dropdown Multiselect Ends        
        // Update DeductionIdK When DeductionId is changed
        $('#PMDTHDeductionId').change(function(){
            $('#PMDTHDeductionIdK').val('D'.concat($('#PMDTHDeductionId').val()));
        })
        // Show Select Income Tab only when Income Dependent is True
        $("#isIncomeDependent").on("click", function () {
            showHideSelectIncomeTab();
        })
        // Initialize all the dropdowns
        function fnReinstateDropDowns() {
            $('#biDescId').val(null).trigger('change');                        
            $('#roundingId').val('1000').trigger('change');                        
            $('#ruleDefId').val(null).trigger('change');                        
            $('#genderSpecificId').val('C').trigger('change');                        
            $('#deductionStrategyId').val('C').trigger('change');                        
            $('#deductionCycleId').val('M').trigger('change');                        
            $('#periodId').val(null).trigger('change');  
        }
        function fnUpdateScreenVariables(data){
            var lastCreated = formattedDate(new Date(data.PMDTHLastCreated));
            var lastUpdated = formattedDate(new Date(data.PMDTHLastUpdated));
            $('#PMDTHUniqueId').val(data.PMDTHUniqueId);                       
            $('#PMDTHDeductionId').val(data.PMDTHDeductionId);
            $('#PMDTHDeductionIdK').val(data.PMDTHDeductionIdK);
            $('#PMDTHDesc1').val(data.PMDTHDesc1);
            $('#PMDTHDesc2').val(data.PMDTHDesc2);
            $('#PMDTHPrintingSeq').val(data.PMDTHPrintingSeq); 
            $('#PMDTHUser').val(data.PMDTHUser);
            $('#PMDTHLastCreated').val(lastCreated);
            $('#PMDTHLastUpdated').val(lastUpdated);
        }
        function fnUpdateCheckBoxes(data) {
            $("#isTaxExempted").prop("checked", false);
            $('#PMDTHIsTaxExempted').val(0);
            $("#isLoanLine").prop("checked", false);
            $('#PMDTHIsThisLoanLine').val(0);
            $("#isShowInTaxList").prop("checked", false);
            $('#PMDTHShowInTaxList').val(0);
            $("#isIncomeDependent").prop("checked", false);
            $('#PMDTHIsIncomeDependent').val(0);

            if(data.PMDTHIsTaxExempted == 1)
            {
                $("#isTaxExempted").prop("checked", true);
                $('#PMDTHIsTaxExempted').val(1);
            }
            if(data.PMDTHIsThisLoanLine == 1)
            {
                $("#isLoanLine").prop("checked", true);
                $('#PMDTHIsThisLoanLine').val(1);
            }
            if(data.PMDTHShowInTaxList == 1)
            {
                $("#isShowInTaxList").prop("checked", true);
                $('#PMDTHShowInTaxList').val(1);
            }
            if(data.PMDTHIsIncomeDependent == 1)
            {
                $("#isIncomeDependent").prop("checked", true);
                $('#PMDTHIsIncomeDependent').val(1);
                $("#animated-underline-selectIncome-tab").show();
            }else{
                $("#animated-underline-selectIncome-tab").hide();
            }
        }
        function fnUpdateDropdowns(data) {
            $('#roundingId').val(data.PMDTHRoundingStrategy).trigger('change');
            $('#ruleDefId').val(data.PMDTHRuleId).trigger('change');
            $('#genderSpecificId').val(data.PMDTHApplicableFor).trigger('change');
            $('#deductionStrategyId').val(data.PMDTHDedStrategy).trigger('change');
            $('#deductionCycleId').val(data.PMDTHDeductionCycle).trigger('change');

            var $BiElementId = data.PMDTHBiElementId;
            fnBiDeductionDropdownsEditMode($BiElementId)
            var $DeductionRuleId = data.PMDTHRuleId;
            fnRuleDeductionDefDropdownsEditMode($DeductionRuleId)
            // Function to bring Periods if Deduction Cycle is Periodic
            var $DeductionCycle = data.PMDTHDeductionCycle;
            if ($DeductionCycle == 'P') {
                $deductionIdK = data.PMDTHDeductionIdK;
                fnPeroidDropdownsEditMode($deductionIdK)
            }
        }
        $( "#biDescId" ).select2();
        $( "#roundingId" ).select2();
        $( "#ruleDefId" ).select2();
        $( "#genderSpecificId" ).select2();
        $( "#deductionStrategyId" ).select2();
        $( "#deductionCycleId" ).select2();
        $( "#periodId" ).select2();        
        function fnBiDeductionDropdownsEditMode($BiElementId){
            $.ajax({
                url: "{{route('dropDownMasters.getSelectedDeductionBiDesc')}}",
                method: 'GET',
                data: {id:$BiElementId},
                dataType: 'json',
                success: function(response) {                    
                    $('#biDescId').html(response.SelectedItem);
                },
                cache: true
            })
        }
        function fnRuleDeductionDefDropdownsEditMode($DeductionRuleId){
            $.ajax({
                url: "{{route('dropDownMasters.getSelectedRuleDefDescDeduction')}}",
                method: 'GET',
                data: {id:$DeductionRuleId},
                dataType: 'json',
                success: function(response) {                    
                    $('#ruleDefId').html(response.SelectedItem);
                },
                cache: true
            })
        }
        function fnPeroidDropdownsEditMode($deductionIdK){
            $.ajax({
                url: "{{route('dropDownMasters.getSelectedPeriod')}}",
                method: 'GET',
                data: {id:$deductionIdK},
                dataType: 'json',
                success: function(response) {                    
                    $('#periodId').html(response.SelectedItem);
                },
                cache: true
            })
        }
        // Sub Form Events
        // When Pick button is pushed on Sub Form
        $(document).on('click', '.select', function(){
            var uniqueId = $(this).attr('id');
            $.ajax({
                // CopyChange
                url: "{{route('deductionType.fetchSubFormData')}}",
                method: 'GET',
                data: {id:uniqueId},
                dataType: 'json',
                success: function(data)
                { 
                    $('#PMDTDUniqueId').val(data.PMDTDUniqueId);                       
                    $('#PMDTDIncomeId').val(data.PMDTDIncomeId);
                    $('#PMDTDDesc1').val(data.PMDTDDesc1);
                    $('#PMDTDDedPercent').val(data.PMDTDDedPercent);
                    fnReinstateSubForm('1', 'Add ', 'Pick ');
                }
            });
        });
        // When submit button is pushed
        $('#twoLevelDataEntryForm').on('submit', function(event){
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
                    $('#html5-incomeTypeSubform3SIS').DataTable().ajax.reload();
                    $('#detailEntryModal').modal('hide');
                }
            })
        });
        // When delete button is pushed
        $(document).on('click', '.remove', function(){
            var UniqueId = $(this).attr('id');
            $.ajax({
                url: "{{route('deductionType.deleteSubFormData')}}",
                method: 'GET',
                data: {id:UniqueId},
                dataType: 'json',
                success: function(data)
                {
                    $('#html5-incomeTypeSubform3SIS').DataTable().ajax.reload();                  
                }
            });
        }); 
        // Delete Ends
        // Sub Form Events End**********
    });
    $(document).on('click', '.columnDefs', function(){
        return false;
    });
    function showHideSelectIncomeTab(){
        if($('#isIncomeDependent').prop('checked')==true) {
            $("#animated-underline-selectIncome-tab").show();
        }else {
            $("#animated-underline-selectIncome-tab").hide();
        }      
    }
    function fnLoadSubForm(){
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
            pageLength: 6,
            lengthMenu: [6,10,25,50],
            order: [ 3, "desc" ],
            processing: true,
            serverSide: true,
            autoWidth: false,
            destroy: true,
            "ajax": "{{ route('deductionType.browserSubForm')}}",
            // "ajax": {
            //     "url": "{{ route('deductionType.browserSubForm')}}",
            //     "type": "GET",
            //     "data": function ( d ) {
            //         d.id = $('#PMDTHUniqueId').val();
            //     }
            // },
            "columns":[
                {data: "PMDTDUniqueIdH"},
                {data: "PMDTDIncomeId"},
                {data: "PMDTDDesc1"},
                {data: "PMDTDIsSelect"},
                {data: "PMDTDDedPercent"},
                {data: "action", orderable:false, searchable: false},
                {data: "PMDTDUser", "visible": false},
                {data: "PMDTDUniqueId", "visible": false},
            ],
            columnDefs: [{
                // Setting width of each column
                width: "5%", "targets": 0,
                width: "15%", "targets": 1,
                width: "35%", "targets": 2,
                width: "10%", "targets": 3,
                width: "20%", "targets": 4,
                width: "15%", "targets": 5,
                // Displaying Checkbox based on IsIncomeDependent which is 6th coloumn
                targets: 3,
                data:   "PMDTDIsSelect",
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
            }],
            "rowCallback": function( row, data, index ){
                $('td', row).css('color', 'white');
                if ( data['PMDTDIsSelect'] == 1 )
                {
                    $('td', row).css('color', '#ffc107');
                }
            }
        });
        // Income Type Selection browser Ends
    }
    function fnUpdateCheckboxValues(){
        if($('#isTaxExempted').prop('checked')==true) {
            $('#PMDTHIsTaxExempted').val(1);
        }else {
            $('#PMDTHIsTaxExempted').val(0);
        }
        if($('#isLoanLine').prop('checked')==true) {
            $('#PMDTHIsThisLoanLine').val(1);
        }else {
            $('#PMDTHIsThisLoanLine').val(0);
        }
        if($('#isShowInTaxList').prop('checked')==true) {
            $('#PMDTHShowInTaxList').val(1);
        }else {
            $('#PMDTHShowInTaxList').val(0);
        }
        if($('#isIncomeDependent').prop('checked')==true) {
            $('#PMDTHIsIncomeDependent').val(1);
        }else {
            $('#PMDTHIsIncomeDependent').val(0);
        }
    }
    function fnBiDeductionDropdownsAddMode(){
        $.ajax({
            url: "{{route('dropDownMasters.getSelectedDeductionBiDesc')}}",
            method: 'GET',
            data: {id:'00'},
            dataType: 'json',
            success: function(response) {
                $('#biDescId').html(response.SelectedItem);
            },
            cache: true
        });
    }
    function fnRuleDeductionDefDropdownsAddMode(){
        $.ajax({
            url: "{{route('dropDownMasters.getSelectedRuleDefDescDeduction')}}",
            method: 'GET',
            data: {id:'00'},
            dataType: 'json',
            success: function(response) {
                $('#ruleDefId').html(response.SelectedItem);
            },
            cache: true
        });
    }
    function fnPeroidDropdownsAddMode(){
        $.ajax({
            url: "{{route('dropDownMasters.getSelectedPeriod')}}",
            method: 'GET',
            data: {id:'00'},
            dataType: 'json',
            success: function(response) {
                $('#periodId').html(response.SelectedItem);
            },
            cache: true
        });
    }
</script>
@endsection

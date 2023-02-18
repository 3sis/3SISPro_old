@extends('layouts.app')

@section('content')
<div class="layout-px-spacing">
    
    <div>
    
        <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
            <div class=" br-6">
                <div style='float:right; padding-right:30px'>
                    <button type='button' name='add' id='add_Data' class='btn btnAddRec3SIS'>Add
                        <i class="fas fa-plus fa-sm ml-1"> </i>
                    </button>
                </div>
                <div class="table-responsive">
                    <table id="html5-extension3SIS" class="table table-hover non-hover" style="width:100%">
                        <thead>
                            <tr>
                                <!--CopyChange-->  
                                <th title="Loan Id">ID</th>
                                <th>Employee</th>
                                <th>Location</th>  
                                <th title="Deduction">Desc</th>
                                <th>Recovery</th>                                    
                                <th>EMI Start</th>                                    
                                <th>EMI End</th>                                    
                                <th title="Paid Amount">PB</th>                                    
                                <th title="Balance Amount">BA</th>                                    
                                <th>Action</th>
                                <th style="visibility: hidden;">User</th>
                                <th style="visibility: hidden;">Updated</th>
                                <th style="visibility: hidden;">Unique Id</th>
                                <th style="visibility: hidden;">Company</th>
                            </tr>
                        </thead> 
                    </table>
                </div>
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
                                    method="POST" action="{{ route('loanBook.postHeaderSubformData') }}">
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
                                                <a class="nav-link" id="animated-underline-selectLoan-tab" data-toggle="tab" 
                                                href="#animated-underline-selectLoan" role="tab" aria-controls="animated-underline-selectLoan" 
                                                aria-selected="false">Loan Book</a>
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
                                                        <input type="hidden" name='LALBHUniqueId' id='LALBHUniqueId' class='form-control'>
                                                        <input type="hidden" name='LALBHLoanId' id='LALBHLoanId' class='form-control'>
                                                        <input type="hidden" name='LALBHLocationId' id='LALBHLocationId' class='form-control'>
                                                    </div>
                                                    <!-- Name -->
                                                    <div class="row mt-0">
                                                        <div class="col-md-4">
                                                            <div class='form-group'>                                                
                                                                <label>Employee Id</label>
                                                                <span class="error-text LALBHEmployeeId_error text-danger" 
                                                                            style='float:right;'></span>
                                                                <select id='LALBHEmployeeId' name = 'LALBHEmployeeId' style='width: 100%;'>
                                                                    <option value='0'>-- Employee Id --</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class='form-group'>                                                
                                                                <label>Location</label>
                                                                <input type="text" name='locationDesc' id="locationDesc" maxlength="100" placeholder=""
                                                                class="form-control few-options" readonly>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class='form-group'>                                                
                                                                <label>Deduction Id</label>
                                                                <span class="error-text LALBHDeductionId_error text-danger" 
                                                                            style='float:right;'></span>
                                                                <select id='LALBHDeductionId' name = 'LALBHDeductionId' style='width: 100%;'>
                                                                    <option value='0'>-- Deduction Id --</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- Location -->
                                                    <div class="row mt-0">                                                        
                                                        <div class="col-md-3">
                                                            <div class='form-group'>                                                
                                                                <label>Loan Amount</label>
                                                                <span class="error-text LALBHLoanAmount_error text-danger" 
                                                                style='float:right;'></span>
                                                                <input type="number" name='LALBHLoanAmount' id='LALBHLoanAmount' 
                                                                class='form-control floatNumberField' step='any' placeholder="Loan Amount" style='opacity:1' value='0.00'>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <div class='form-group'>                                                
                                                                <label>Interest Amount</label>
                                                                <input type="number" name='LALBHInterestAmount' id='LALBHInterestAmount' 
                                                                class='form-control floatNumberField' step='any' placeholder="Interest Amount" style='opacity:1' value='0.00'>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <div class='form-group'>                                                
                                                                <label>Recovery Amount</label>
                                                                <span class="error-text LALBHRecoveryAmount_error text-danger" 
                                                                style='float:right;'></span>
                                                                <input type="number" name='LALBHRecoveryAmount' id='LALBHRecoveryAmount' 
                                                                class='form-control' step='any' placeholder="Recovery Amount" style='opacity:1' value='0.00' readonly>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3 n-chk mt-4">
                                                            <label class="new-control new-checkbox new-checkbox-text checkbox-success">
                                                                <input type="checkbox" class="new-control-input" name='LALBHLoanPaidFully' id='LALBHLoanPaidFully'>
                                                                <span class="new-control-indicator"></span><span class="new-chk-content">Loan Paid Fully</span>
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <!-- Deduction -->
                                                    <div class="row mt-0">                                                        
                                                        <div class="col-md-3">
                                                            <div class='form-group'>                                                
                                                                <label>No Of EMI</label>
                                                                <span class="error-text LALBHNoOfEMI_error text-danger" 
                                                                style='float:right;'></span>
                                                                <input type="number" name='LALBHNoOfEMI' id='LALBHNoOfEMI' 
                                                                class='form-control' step='any' placeholder="No Of EMI" style='opacity:1' value='0'>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <div class='form-group'>                                                
                                                                <label>EMI Amount</label>
                                                                <span class="error-text LALBHEMIAmount_error text-danger" 
                                                                style='float:right;'></span>
                                                                <input type="number" name='LALBHEMIAmount' id='LALBHEMIAmount' 
                                                                class='form-control floatNumberField' step='any' placeholder="EMI Amount" style='opacity:1' value='0.00'>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <div class='form-group'>                                                
                                                                <label>Start Date EMI</label>
                                                                <span class="error-text LALBHStartDateEMI_error text-danger" 
                                                                style='float:right;'></span>
                                                                <input type="date" name='LALBHStartDateEMI' id="LALBHStartDateEMI" maxlength="100" placeholder=""
                                                                class="form-control">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <div class='form-group'>                                                
                                                                <label>End Date EMI</label>
                                                                <span class="error-text LALBHEndDateEMI_error text-danger" 
                                                                style='float:right;'></span>
                                                                <input type="date" name='LALBHEndDateEMI' id="LALBHEndDateEMI" maxlength="100" placeholder=""
                                                                class="form-control">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row mt-0">      
                                                        <div class="col-md-3">
                                                            <div class='form-group'>                                                
                                                                <label>Paid EMI</label>
                                                                <input type="number" name='LALBHPaidEMI' id='LALBHPaidEMI' 
                                                                class='form-control' step='any' placeholder="Paid EMI" style='opacity:1' value='0' readonly>
                                                            </div>
                                                        </div>	

                                                        <div class="col-md-3">
                                                            <div class='form-group'>                                                
                                                                <label>Balance EMI</label>
                                                                <input type="number" name='LALBHBalanceEMI' id='LALBHBalanceEMI' 
                                                                class='form-control' step='any' placeholder="Balance EMI" style='opacity:1' value='0' readonly>
                                                            </div>
                                                        </div>                                                  
                                                        <div class="col-md-3">
                                                            <div class='form-group'>                                                
                                                                <label>Paid Amount</label>
                                                                <input type="number" name='LALBHPaidAmount' id='LALBHPaidAmount' 
                                                                class='form-control' step='any' placeholder="Paid Amount" style='opacity:1' value='0.00' readonly>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <div class='form-group'>                                                
                                                                <label>Balance Amount</label>
                                                                <span class="error-text LALBHBalanceAmount_error text-danger" 
                                                                style='float:right;'></span>
                                                                <input type="number" name='LALBHBalanceAmount' id='LALBHBalanceAmount' 
                                                                class='form-control' step='any' placeholder="Balance Amount" style='opacity:1' value='0.00' readonly>
                                                            </div>
                                                        </div>
                                                        
                                                        
                                                    </div>
                                                    <div class="row mt-0">  
                                                        <div class="col-md-3">
                                                            {{-- <div class="col-md-3 mt-4"> --}}
                                                            {{-- <button type="continue" class="btn btn-primary" id="Continue">Continue</button> --}}
                                                            <button type='button' name='Continue' id='Continue' 
                                                            class='btn btn-primary'>Continue
                                                            {{-- <i class="fas fa-plus fa-sm ml-1"> </i> --}}
                                                        </button>
                                                        </div>                                                      
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- Tab : Loan Book Selections -->
                                            <div class="tab-pane fade" id="animated-underline-selectLoan" role="tabpanel" 
                                                aria-labelledby="animated-underline-selectLoan-tab">
                                                    <!-- Error Messages -->
                                                    <div class='col-md-9 alert alert-danger' id='errorMessageId2'>
                                                        <span id='detailEntryMessages2'></span>
                                                    </div>
                                                    <div style='float:right; padding-right:30px'>                                                    
                                                        <button type='button' name='add_LoanLine' id='add_Data_Loan' 
                                                            class='btn btnAddRec3SIS'>Add Loan Line
                                                            <i class="fas fa-plus fa-sm ml-1"> </i>
                                                        </button>
                                                    </div>
                                                <!-- Sub Form -->
                                                <div class="table-responsive">
                                                    <table id="html5-loanBookSubform3SIS" class="table table-hover non-hover" style="width:100%">
                                                        <thead>
                                                            <tr>
                                                                <th>Line#</th>
                                                                <th >EMI Amount</th>
                                                                <th>Paid Amount</th>
                                                                <th title="Balance Amount">B_Amt</th>
                                                                <th title="Start Date EMI">Start Date</th>
                                                                <th title="End Date EMI">End Date</th>
                                                                <th>Deleted</th>
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
                                                            <input type="text" name="LALBDUser" id="LALBDUser" 
                                                            class="form-control col-sm-6" readonly/>
                                                        </div>
                                                        <div class="form-group">
                                                            <label> Created Date</label>
                                                            <input type="date" name="LALBDLastCreated" id="LALBDLastCreated" 
                                                            class="form-control col-sm-6" readonly/>
                                                        </div>
                                                        <div class="form-group">
                                                            <label> Updated Date</label>
                                                            <input type="date" name="LALBDLastUpdated" id="LALBDLastUpdated" 
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
                <!-- Loan Detail Mem Data Entry -->
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
                                    method="post" action="{{ route('loanBook.postSubFormData') }}">
                                    <input type="hidden" name="_token" id="csrfTokenDetail" value="{{ csrf_token() }}">
                                <!-- Modal Body -->
                                <div class="modal-body">
                                    <div class="widget-content widget-content-area-detail3SIS animated-underline-content">
                                        <div class="container-fluid">
                                            <div class='form-group mb-0'>
                                                <input type="hidden" name='LALBDUniqueId' id='LALBDUniqueId' class='form-control-detail3SIS'>
                                                <input type="hidden" name='LALBDUniqueIdH' id='LALBDUniqueIdH' class='form-control-detail3SIS'>
                                            </div>
                                            <!-- Error Messages -->
                                            <div class='row mt-0' id='errorMessageId1'>
                                                <div class='col-md-12 alert alert-danger'>
                                                    <span id='detailEntryMessages1'></span>
                                                </div>
                                            </div>
                                            <div class="row mt-0">
                                                <div class="col-md-4">
                                                    <div class='form-group'>                                                
                                                        <label>EMI Amount</label> 
                                                        <span class="error-text LALBDEMIAmount_error text-danger" 
                                                            style='float:right;'></span>
                                                        <input type="number" name='LALBDEMIAmount' id='LALBDEMIAmount' 
                                                            class='form-control' step='any' style='opacity:1' value='0.00'>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class='form-group'>                                                
                                                        <label>Start Date</label>
                                                        <span class="error-text LALBDStartDateEMI_error text-danger" 
                                                            style='float:right;'></span>
                                                        <input type="date" name='LALBDStartDateEMI' id="LALBDStartDateEMI"
                                                            class="form-control">
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class='form-group'>                                                
                                                        <label>End Date</label>
                                                        <span class="error-text LALBDEndDateEMI_error text-danger" 
                                                            style='float:right;'></span>
                                                        <input type="date" name='LALBDEndDateEMI' id="LALBDEndDateEMI"
                                                            class="form-control">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row mt-0">
                                                <div class="col-md-4">
                                                    <div class='form-group'>                                                
                                                        <label>Paid Amount</label> 
                                                        <span class="error-text LALBDPaidAmount_error text-danger" 
                                                            style='float:right;'></span>
                                                        <input type="number" name='LALBDPaidAmount' id='LALBDPaidAmount' 
                                                            class='form-control' step='any' style='opacity:1' value='0.00' step='any' readonly>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class='form-group'>                                                
                                                        <label>Balance Amount</label> 
                                                        <span class="error-text LALBDBalanceAmount_error text-danger" 
                                                            style='float:right;'></span>
                                                        <input type="number" name='LALBDBalanceAmount' id='LALBDBalanceAmount' 
                                                            class='form-control' step='any' style='opacity:1' value='0.00' step='any' readonly>
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
                 <!-- Loan Detail Mem Data Entry Ends**********-->
                @include('commonViews3SIS.modalCommon3SIS')
            </div>
        </div>

    </div>

</div>
<script>        
    $(document).ready(function(){
        $modalTitle = 'Loan Book'
        $modalTitleDetailEntry1 = 'Loan EMI Line ' 
        $("#animated-underline-selectLoan-tab").hide();
        $('#detailEntryMessages2').html('');
        $('#errorMessageId2').hide();
        $("#LALBHEmployeeId").select2();
        $("#LALBHDeductionId").select2();
        $(".floatNumberField").change(function() {
			$(this).val(parseFloat($(this).val()).toFixed(2));
		});
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
            pageLength: 6,
            lengthMenu: [6, 10, 20, 50],
            order: [ 10, "desc" ],
            processing: true,
            serverSide: true,
            autoWidth: false,
            // CopyChange                    
            "ajax": "{{ route('loanBook.browserData')}}",
            "columns":[
                // CopyChange
                {data: "LALBHLoanId"},
                {data: "EMGIHFullName"},
                {data: "GMLMHDesc1"},                    
                {data: "PMDTHDesc1"},//Test only chenge with desc
                {data: "LALBHLoanAmount"},                    
                {data: "LALBHStartDateEMI"},                    
                {data: "LALBHEndDateEMI"},                    
                {data: "LALBHPaidAmount"},                    
                {data: "LALBHBalanceAmount"},                    
                {data: "action", orderable:false, searchable: false},
                {data: "LALBHUser", "visible": false},
                {data: "LALBHLastUpdated", "visible": false},
                {data: "LALBHUniqueId", "visible": false},
                {data: "LALBHCompanyId", "visible": false},
            ],                
            "columnDefs": [
                { "width": "5%", "targets": 0 },
                { "width": "10%", "targets": 1 },
                { "width": "10%", "targets": 2 },
                { "width": "5%", "targets": 3 },
                { "width": "5%", "targets": 4 },
                { "width": "5%", "targets": 5 },
                { "width": "5%", "targets": 6 },
                { "width": "5%", "targets": 7 },
                { "width": "5%", "targets": 8 },
                { "width": "15%", "targets": 9 },
            ]                
        });
        // Whed add buttonis pushed
        $('#add_Data').click(function(){       
            fnHideErrorMsg()
            $("#animated-underline-selectLoan-tab").hide();
            $("#LALBHLocationId").attr("readonly", false);
            fnReinstateFormControl('0');
            
            $("#animated-underline-home-tab").trigger('click');
            fnUpdateDropdownsAddMode();
            $('#html5-loanBookSubform3SIS').DataTable().ajax.reload();
            // fnLoadLoanSubForm();


            //    var $dts = new DateTime(); //this returns the current date time
            // alert(strlen(data.PMDTHLastUpdated));
        });
        // Add Ends   
        // When edit button is pushed on Landing Browser
        $(document).on('click', '.edit', function(){
            var id = $(this).attr('id');
            $.ajax({
                // CopyChange
                url: "{{route('loanBook.fetchData')}}",
                method: 'GET',
                data: {id:id},
                dataType: 'json',
                beforeSend: function(){
                    fnHideErrorMsg()
                },
                success: function(data)
                {
                    // Update Screen Variables
                    fnUpdateScreenVariables(data);
                    fnUpdateDropdownsEditMode(data);
                    fnLoadLoanSubForm();
                    // fnReinstateFormControl('1');
                    $titleSuffix = "<b style='color: #F5821F'>" + ' [ ' + data.LALBHLoanId + ' ]' + "</b>";                    
                    fnDataEntryFormHeader('1', 'Edit ', $titleSuffix);
                    $("#animated-underline-selectLoan-tab").show();
                    $("#animated-underline-home-tab").trigger('click'); 
                    //     $today = new DateTime(); 
                    //     $today = $today->format(DateTime::RFC7231));
                    //  alert($today);
                    
                }
            });
        });
        // Edit Ends
        function fnUpdateDropdownsAddMode(){
            $.ajax({
                url: "{{route('dropDownMasters.getSelectedEmployee')}}",
                method: 'GET',
                data: {id:'00'},
                dataType: 'json',
                success: function(response) {
                    $('#LALBHEmployeeId').html(response.SelectedItem);
                },
                cache: true
            })
            $.ajax({
                url: "{{route('dropDownMasters.getSelectedDeductionTypesLoan')}}",
                method: 'GET',
                data: {id:'00'},
                dataType: 'json',
                success: function(response) {
                    $('#LALBHDeductionId').html(response.SelectedItem);
                },
                cache: true
            })
        };
        // Loan Book browser Ends
        function fnUpdateScreenVariables(data){
            // alert(data.LALBHLocationId)
            var startDateEMI = formattedDate(new Date(data.LALBHStartDateEMI));
            var endDateEMI = formattedDate(new Date(data.LALBHEndDateEMI));
            var lastCreated = formattedDate(new Date(data.PMDTHLastCreated));
            var lastUpdated = formattedDate(new Date(data.PMDTHLastUpdated));
            $('#LALBHUniqueId').val(data.LALBHUniqueId);                       
            $('#LALBHLoanId').val(data.LALBHLoanId);
            $('#LALBHCompanyId').val(data.LALBHCompanyId);
            $('#LALBHLocationId').val(data.LALBHLocationId);
            $('#locationDesc').val(data.locationDesc);
            $('#LALBHEmployeeId').val(data.LALBHEmployeeId); 
            $('#LALBHDeductionId').val(data.LALBHDeductionId); 
            $('#LALBHLoanAmount').val(data.LALBHLoanAmount); 
            $('#LALBHNoOfEMI').val(data.LALBHNoOfEMI); 
            $('#LALBHEMIAmount').val(data.LALBHEMIAmount); 
            $('#LALBHInterestAmount').val(data.LALBHInterestAmount); 
            $('#LALBHStartDateEMI').val(startDateEMI); 
            $('#LALBHEndDateEMI').val(endDateEMI); 
            $('#LALBHTotalDeduction').val(data.LALBHTotalDeduction); 
            $('#LALBHRecoveryAmount').val(data.LALBHRecoveryAmount); 
            
            // $('#LALBHLoanPaidFully').val(data.LALBHLoanPaidFully); 
            $('#LALBHPaidEMI').val(data.LALBHPaidEMI); 
            $('#LALBHBalanceEMI').val(data.LALBHBalanceEMI); 
            $('#LALBHPaidAmount').val(data.LALBHPaidAmount); 
            $('#LALBHBalanceAmount').val(data.LALBHBalanceAmount); 

            $('#LALBHUser').val(data.LALBHUser);
            $('#LALBHLastCreated').val(lastCreated);
            $('#LALBHLastUpdated').val(lastUpdated);
            // LoanDetail Form Submit fields
            $('#LALBDUniqueIdH').val(data.LALBHUniqueId);
            if(data.LALBHLoanPaidFully == 1)
            {
                    $("#LALBHLoanPaidFully").prop("checked", true);
                }else{
                    $("#LALBHLoanPaidFully").prop("checked", false);
            }
        }
        $('#LALBHEmployeeId').change(function(){
            let id = $(this).val();
            $.ajax({
                url: "{{route('dropDownMasters.getLocation')}}",
                type:'post',
                data:'id=' + id + '&_token={{csrf_token()}}',
                success:function(response){
                    $('#LALBHLocationId').val(response.locationId);
                    $('#locationDesc').val(response.locationDesc);
                    
                }
            })
        });
       
        $('#LALBHLoanAmount').change(function(){
            $('#LALBHTotalDeduction').val(parseFloat($('#LALBHLoanAmount').val()) + parseFloat($('#LALBHInterestAmount').val()))
            $('#LALBHRecoveryAmount').val(parseFloat($('#LALBHLoanAmount').val()) + parseFloat($('#LALBHInterestAmount').val()))
            $('#LALBHEMIAmount').val($('#LALBHRecoveryAmount').val() / $('#LALBHNoOfEMI').val())
        });
        
        $('#LALBHNoOfEMI').change(function(){
            $('#LALBHEMIAmount').val($('#LALBHRecoveryAmount').val() / $('#LALBHNoOfEMI').val())
            // var result2 = myDate2.addMonths(1);
            // $('#LALBHEndDateEMI').val($('#LALBHStartDateEMI').val()+  $('#LALBHEMIAmount').val())
            //     var dt = $('#LALBHStartDateEMI').val()
            //  dt.setMonth( dt.getMonth() + 2 );
            //  document.write( dt );
            //  $('#LALBHEndDateEMI').val( dt)
            // var newDate = $('#LALBHStartDateEMI').val()
            // newDate1 = newDate.format('DD/MM/YYYY');
            // newDate1 =date("d-m-Y", newDate);
            // var newDate1 = moment(newDate, "DD-MM-YYYY").add(3, 'months').format('DD/MM/YYYY');
            // var formattedDate = [newDate.getMonth() + 1, newDate.getDate(), newDate.getFullYear()].join('/');
            // var newDate1=newDate.toISOString().split('T')[0]
            // var p = newDate.split(/\D/g)
            // newDate1 = [p[2],p[1],p[0] ].join("-")
            // var newDate3 = moment($('#LALBHStartDateEMI').val(), "YYYY-MM-DD").add($('#LALBHNoOfEMI').val(), 'months').format('YYYY-MM-DD');
            // $('#LALBHEndDateEMI').val(newDate3)
            // alert($('#LALBHStartDateEMI').val() + " 1 " + newDate3+ " 2 " +p+ " 2 " +newDate1);
            // alert(newDate1);
            var TotalMonth = parseInt($('#LALBHNoOfEMI').val())
            var MonthEndDay = moment($('#LALBHStartDateEMI').val(), "YYYY-MM-DD").add(TotalMonth, 'months').add(-1, 'days').format('YYYY-MM-DD');
            $('#LALBHEndDateEMI').val(MonthEndDay)
        });
        $('#LALBHStartDateEMI').change(function(){
            var TotalMonth = parseInt($('#LALBHNoOfEMI').val())
            var MonthEndDay = moment($('#LALBHStartDateEMI').val(), "YYYY-MM-DD").add(TotalMonth, 'months').add(-1, 'days').format('YYYY-MM-DD');
            $('#LALBHEndDateEMI').val(MonthEndDay)
            // alert(newDate3);

        }); 
        $('#LALBDStartDateEMI').change(function(){
            var newDate = $('#LALBDStartDateEMI').val()
            newDate =newDate -1;
            // var p = $('#LALBDStartDateEMI').val().split(/\D/g)
            // newDate4 = [p[2],p[1],p[0] ].join("-")
            // var monthEndDay = new Date(newDate.getFullYear(), newDate.getMonth() + 1, 0);
            var MonthEndDay = moment($('#LALBDStartDateEMI').val(), "YYYY-MM-DD").add(1, 'months').add(-1, 'days').format('YYYY-MM-DD');
            $('#LALBDEndDateEMI').val(MonthEndDay)
            // alert(newDate3);

        });
        $('#LALBHInterestAmount').change(function(){
            $('#LALBHTotalDeduction').val(parseFloat($('#LALBHLoanAmount').val()) + parseFloat($('#LALBHInterestAmount').val()))
            $('#LALBHRecoveryAmount').val(parseFloat($('#LALBHLoanAmount').val()) + parseFloat($('#LALBHInterestAmount').val()))
            $('#LALBHEMIAmount').val($('#LALBHRecoveryAmount').val() / $('#LALBHNoOfEMI').val());
        });
        
        // Loan Detail browser
        $('#html5-loanBookSubform3SIS').DataTable( {
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
            "ajax": "{{ route('loanBook.browserSubFormLoan')}}",
            "columns":[
                {data: "LALBDLineNo"},
                {data: "LALBDEMIAmount"},
                {data: "LALBDPaidAmount"},
                {data: "LALBDBalanceAmount"},
                {data: "LALBDStartDateEMI"},
                {data: "LALBDEndDateEMI"},                
                {data: "LALBDMarkForDeletion"},                
                {data: "action", orderable:false, searchable: false},
                {data: "LALBDUser", "visible": false},
                {data: "LALBDUniqueId", "visible": false},
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
                data:   "LALBDMarkForDeletion",
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
            
        });
        // When Add button is pushed        
        $('#add_Data_Loan').click(function(){
            fnHideErrorMsg()
            $('#detailEntryMessages1').html('');
            $('#errorMessageId1').hide();
            fnDetailEntryOnSubForm1('0', 'Add ', 'Edit ');
            

        });
        // Add button Income Ends*****
        // When Edit button is pushed        
        $(document).on('click', '.edit_loan', function(){      
            fnHideErrorMsg()      
            $('#detailEntryMessages1').html('');
            $('#errorMessageId1').hide();
            var uniqueId = $(this).attr('id');
            $.ajax({
                // CopyChange
                url: "{{route('loanBook.fetchSubFormDataEMI')}}",
                method: 'GET',
                data: {id:uniqueId},
                dataType: 'json',
                success: function(data)
                {
                    // Update Screen Variables
                    fnUpdateScreenVariablesLoanEMI(data);
                    // Update Dropdowns
                    fnDetailEntryOnSubForm1('1', 'Add ', 'Edit ');
                }
            });
        });
        // Edit button Ends*****
        // When delete button is pushed
        $(document).on('click', '.delete_loan', function(){
            var UniqueId = $(this).attr('id');
            // Delete Mem Record : Loan
            $.ajax({
                    // CopyChange
                    url:"{{route('loanBook.deleteMemDataLoan')}}",
                    mehtod:"get",
                    data:{id:UniqueId},
                    beforeSend: function(){
                        fnHideErrorMsg()
                    },
                    success:function(data)
                    {
                        $('#html5-loanBookSubform3SIS').DataTable().ajax.reload();
                        UniqueId = 0;
                    }
            })
        }); 
        // When Final Submit button is pushed to save header and details
        $('#singleLevelDataEntryForm').on('submit', function(event){            
            event.preventDefault();
            $.ajax({
                url: $(this).attr('action'),
                method: $(this).attr('method'),
                data: new FormData(this),
                processData: false,
                dataType: "json",
                cache: false,
                contentType: false,
                beforeSend: function(){
                    $(document).find('span.error-text').text('');
                    $("#animated-underline-selectLoan-tab").hide();
                    $('#detailEntryMessages2').html('');
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
                        }else
                        { 
                            $("#animated-underline-home-tab").trigger('click'); 
                            $finalMessage3SIS = fnSingleLevelFinalSave(data.masterName, data.Id, data.Desc1, data.updateMode);
                            $('#FinalSaveMessage').html($finalMessage3SIS);
                            fnReinstateFormControl('0');
                            $('#html5-extension3SIS').DataTable().ajax.reload();
                            if(data.updateMode=='Updated')
                            {
                                $('#entryModalSmall').modal('hide');
                                $('#modalZoomFinalSave3SIS').modal('show');
                            }
                        }


                                        
                }
            })
        });
        // Submit Ends
        // When delete button is pushed
        $(document).on('click', '.delete', function(){
            var UniqueId = $(this).attr('id');
            // Fetch Record first that need to be deleted.
            $.ajax({
                url: "{{route('loanBook.fetchData')}}",
                method: 'GET',
                data: {id:UniqueId},
                dataType: 'json',
                success: function(data)
                {
                    $deleteMessage3SIS = fnSingleLevelDeleteConfirmation($modalTitle, data.LALBHLoanId, data.DeductionDesc);   
                    $('#DeleteRecord').html($deleteMessage3SIS);
                    $('#modalZoomDeleteRecord3SIS').modal('show');                   
                }
            });
            // Fetch Record Ends
            // Delete record only when OK is pressed on Modal.
            $(document).on('click', '.confirm', function(){
                $.ajax({
                    url:"{{route('loanBook.deleteData')}}",
                    mehtod:"get",
                    data:{id:UniqueId},
                    success:function(data)
                    {
                        $finalMessage3SIS = fnSingleLevelFinalSave(data.masterName, data.Id, data.Desc1, data.updateMode);
                        $('#FinalSaveMessage').html($finalMessage3SIS);                            
                        $('#html5-extension3SIS').DataTable().ajax.reload();
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
    }); 
    $('#Continue').click(function(){
        var formData = new FormData(); 
        formData.append('LALBHLocationId', $('#LALBHLocationId').val());
        formData.append('LALBHEmployeeId', $('#LALBHEmployeeId').val());
        formData.append('LALBHDeductionId', $('#LALBHDeductionId').val());
        formData.append('LALBHLoanAmount', $('#LALBHLoanAmount').val());
        formData.append('LALBHEMIAmount', $('#LALBHEMIAmount').val());
        formData.append('LALBHNoOfEMI', $('#LALBHNoOfEMI').val());
        formData.append('LALBHStartDateEMI', $('#LALBHStartDateEMI').val());
        $.ajax({
            url: "{{route('loanBook.memDetailUpdate')}}",
            headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            method: 'POST',
            data:formData,
            processData: false,
            dataType: "json",
            contentType: false,
            beforeSend: function(){
                $('#errorMessageHeaderId').hide();
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
                        $("#animated-underline-selectLoan-tab").show();
                        fnLoadLoanSubForm();
                        $("#animated-underline-selectLoan-tab").trigger('click');   
                    }
                
            }
        })
    });  
    $('#twoLevelDataEntryForm1').on('submit', function(event){
        $LALBHUniqueId = $('#LALBHUniqueId').val();           
        $LALBHLoanId = $('#LALBHLoanId').val();           
        $LALBHLocationId = $('#LALBHLocationId').val();           
        $LALBHEmployeeId = $('#LALBHEmployeeId').val();           
        $LALBHDeductionId = $('#LALBHDeductionId').val();           
        event.preventDefault();
        var formData = new FormData(this);
        formData.append('LALBHUniqueId', $LALBHUniqueId );
        formData.append('LALBHLoanId', $LALBHLoanId );
        formData.append('LALBHLocationId', $LALBHLocationId );
        formData.append('LALBHEmployeeId', $LALBHEmployeeId );
        formData.append('LALBHDeductionId', $LALBHDeductionId );

        $.ajax({
            url: $(this).attr('action'),
            method: $(this).attr('method'),
            data: formData,
            processData: false,
            dataType: "json",
            contentType: false,
            beforeSend: function(){
                $('#errorMessageHeaderId').hide();
            },
            // success:function(data)
            // {
            //     $('#html5-loanBookSubform3SIS').DataTable().ajax.reload();
            //     // $("#animated-underline-home-tab").trigger('click'); 
            //     $finalMessage3SIS = fnSingleLevelFinalSave(data.masterName, data.Id, data.Desc1, data.updateMode);
            //     $('#FinalSaveMessage').html($finalMessage3SIS); 
            //     $('#modalZoomFinalSave3SIS').modal('show');

            // }

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
                        $('#html5-loanBookSubform3SIS').DataTable().ajax.reload();
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
    
    // Loan Detail browser
    function fnLoadLoanSubForm(){
        $('#html5-loanBookSubform3SIS').DataTable().ajax.reload();
     
        // $('#html5-loanBookSubform3SIS').DataTable( {
        //     dom: '<"row"<"col-md-12"<"row"<"col-md-6"B><"col-md-6"f> > ><"col-md-12"rt> \
        //         <"col-md-12"<"row"<"col-md-5"i><"col-md-7"p>>> >',
        //     buttons: {
        //         buttons: [
        //             // { extend: 'excel', className: 'btn' },
        //             // { extend: 'print', className: 'btn' }
        //         ]
        //     },
        //     "oLanguage": {
        //         "oPaginate": { "sPrevious": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" \
        //             fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" \
        //             class="feather feather-arrow-left"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5">\
        //             </polyline></svg>', "sNext": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" \
        //             viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" \
        //             stroke-linejoin="round" class="feather feather-arrow-right"><line x1="5" y1="12" x2="19" y2="12"></line>\
        //             <polyline points="12 5 19 12 12 19"></polyline></svg>' },
        //         "sInfo": "Showing page _PAGE_ of _PAGES_",
        //         "sSearch": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>',
        //         "sSearchPlaceholder": "Search...",
        //         "sLengthMenu": "Results :  _MENU_",
        //     },
        //     stripeClasses: [],
        //     pageLength: 6,
        //     lengthMenu: [6,10,25,50],
        //     order: [ 0, "desc" ],
        //     processing: true,
        //     serverSide: true,
        //     autoWidth: false,
        //     destroy: true,            
        //     "ajax": "{{ route('loanBook.browserSubFormLoan')}}",
        //     "columns":[
        //         {data: "LALBDLineNo"},
        //         {data: "LALBDEMIAmount"},
        //         {data: "LALBDPaidAmount"},
        //         {data: "LALBDBalanceAmount"},
        //         {data: "LALBDStartDateEMI"},
        //         {data: "LALBDEndDateEMI"},                
        //         {data: "LALBDMarkForDeletion"},                
        //         {data: "action", orderable:false, searchable: false},
        //         {data: "LALBDUser", "visible": false},
        //         {data: "LALBDUniqueId", "visible": false},
        //     ],
        //     columnDefs: [{
        //         // Setting width of each column
        //         width: "5%", "targets": 0,
        //         width: "10%", "targets": 1,
        //         width: "20%", "targets": 2,
        //         width: "15%", "targets": 3,
        //         width: "10%", "targets": 4,
        //         width: "10%", "targets": 5,
        //         width: "10%", "targets": 6,
        //         width: "10%", "targets": 7,
        //         "targets": 6,
        //         data:   "LALBDMarkForDeletion",
        //         render: function (data ,td, cellData, rowData, row, col) {

        //             if(data==1){
        //                 return '<label class="columnDefs new-control new-checkbox checkbox-primary">\
        //                 <input type="checkbox" class="new-control-input chk-parent select-customers-info" checked>\
        //                 <span class="new-control-indicator"></span><span style="visibility:hidden">c</span></label>';
        //             }else{
        //                 return '<label class="columnDefs new-control new-checkbox checkbox-primary">\
        //                 <input type="checkbox" class="new-control-input chk-parent select-customers-info">\
        //                 <span class="new-control-indicator"></span><span style="visibility:hidden">c</span></label>';
        //             }
        //         }
        //     }],
            
        // });
       
    }
    function fnUpdateDropdownsEditMode(data){
            //GetSelectedEmployee
            var $EmployeeId = data.LALBHEmployeeId;
            $.ajax({
                url: "{{route('dropDownMasters.getSelectedEmployee')}}",
                method: 'GET',
                data: {id:$EmployeeId},
                dataType: 'json',
                success: function(response) {
                    $('#LALBHEmployeeId').html(response.SelectedItem);
                },
                cache: true
            });
            $.ajax({
                url: "{{route('loanBook.getLocation')}}",
                type:'post',
                data:'id=' + $EmployeeId + '&_token={{csrf_token()}}',
                success:function(response){
                    $('#locationDesc').val(response.locationDesc);
                    
                }
            })
            var $DeductionId = data.LALBHDeductionId;
            $.ajax({
                url: "{{route('dropDownMasters.getSelectedDeductionTypesLoan')}}",
                method: 'GET',
                data: {id:$DeductionId},
                dataType: 'json',
                success: function(response) {
                    $('#LALBHDeductionId').html(response.SelectedItem);
                },
                cache: true
            });

    }
    function fnUpdateScreenVariablesLoanEMI(data){
            var startDateEMI   = formattedDate(new Date(data.LALBDStartDateEMI));
            var endDateEMI     = formattedDate(new Date(data.LALBDEndDateEMI));
            $('#LALBDUniqueId').val(data.LALBDUniqueId);                       
            $('#LALBDUniqueIdH').val(data.LALBHUniqueId);                       
            $('#LALBDEMIAmount').val(data.LALBDEMIAmount);
            $('#LALBDStartDateEMI').val(startDateEMI);
            $('#LALBDEndDateEMI').val(endDateEMI);
    }
    function fnHideErrorMsg(){
        $('#detailEntryMessages2').html('');
        $('#errorMessageId2').hide();
    }
</script>
@endsection

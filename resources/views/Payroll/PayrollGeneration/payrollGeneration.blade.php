@extends('layouts.app')
@section('content')
    <div class="layout-px-spacing">
        <div class="container">
            <div class="row layout-top-spacing">
                <div id="fuSingleFile" class="col-lg-12 layout-spacing">
                    <div class="card component-card_1">
                        <div class="card-body">
                            <ul class="nav nav-tabs mb-3" id="animateLine" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="animated-underline-home-tab" data-toggle="tab" 
                                    href="#animated-underline-home" role="tab" aria-controls="animated-underline-home" a
                                    ria-selected="true">Period Info</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="animated-underline-payroll-tab" data-toggle="tab" 
                                    href="#animated-underline-payroll" role="tab" aria-controls="animated-underline-payroll" 
                                    aria-selected="false">Payroll Info</a>
                                </li>
                            </ul>
                            <div class="tab-content" id="animateLineContent-4">
                                <div class="tab-pane fade show active" id="animated-underline-home" role="tabpanel" 
                                    aria-labelledby="animated-underline-home-tab">
                                    <div class="container-fluid">
                                        <form id='payrollGenerationForm' autocomplete="off">
                                            <input type="hidden" name='PGGPHFiscalPeriod' id="PGGPHFiscalPeriod" class="form-control">
                                            <input type="hidden" name='TotalNoOfDays' id="TotalNoOfDays" class="form-control">
                                            <div class="row mt-0">
                                                <div class="col-md-4">
                                                    <div class='form-group'>                                                
                                                        <label>Fiscal Year</label>
                                                        <input type="text" name='PGGPHFiscalYear' id="PGGPHFiscalYear"
                                                            class="form-control" readonly>
                                                    </div>                                               
                                                </div>
                                                <div class="col-md-4">
                                                    <div class='form-group'>                                                
                                                        <label>FY Start Date</label> 
                                                        <input type="date" name='FYFYHStartDate' id="FYFYHStartDate"
                                                            class="form-control" readonly>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class='form-group'>                                                
                                                        <label>FY End Date</label> 
                                                        <input type="date" name='FYFYHEndDate' id="FYFYHEndDate"
                                                            class="form-control" readonly>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row mt-0">
                                                <div class="col-md-4">
                                                    <div class='form-group'>                                                
                                                        <label>Current Period</label>
                                                        
                                                        <input type="Text" name='FYFYHCurrentPeriodDesc' id="FYFYHCurrentPeriodDesc"
                                                        class="form-control" readonly>
                                                    </div>                                               
                                                </div>
                                                <div class="col-md-4">
                                                    <div class='form-group'>                                                
                                                        <label>Period Start Date</label> 
                                                        <input type="date" name='FYFYHPeriodStartDate' id="FYFYHPeriodStartDate"
                                                            class="form-control" readonly>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class='form-group'>                                                
                                                        <label>Period End Date</label> 
                                                        <input type="date" name='FYFYHPeriodEndDate' id="FYFYHPeriodEndDate"
                                                            class="form-control" readonly>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row mt-0">
                                                <div class="col-md-4">
                                                    <div class='form-group'>                                                
                                                        <!-- For defining select2 -->
                                                        <label>Location</label>             
                                                        <span class="error-text PGGPHLocationId_error text-danger" 
                                                            style='float:right;'></span>   
                                                        <select id='PGGPHLocationId' name = 'PGGPHLocationId' class="form-control" style='width: 100%;'>
                                                            <option value=''>-- Select Location --</option>                                                                
                                                        </select>                                                
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class='form-group mt-3'> 
                                                        <div class="n-chk">                                                
                                                            <label class="new-control new-radio new-radio-text radio-success">
                                                                <input type="radio" name='SelectEmployee' id="allEmployee" 
                                                                    value="0" class="new-control-input" name="custom-radio-4" checked>
                                                                <span class="new-control-indicator"></span><span 
                                                                    class="new-radio-content">All Employee</span>
                                                            </label>
                                                        </div>
                                                        <div class="n-chk">                                                
                                                            <label class="new-control new-radio new-radio-text radio-success">
                                                                <input type="radio" name='SelectEmployee' id="pickEmployee" 
                                                                    value="1" class="new-control-input" name="custom-radio-4">
                                                                <span class="new-control-indicator"></span><span 
                                                                    class="new-radio-content">Selective Employee</span>
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-4 mt-4" id='selectEmployeesButton'>
                                                    <button type='button' name='Load' id='Load_Employee_Data' 
                                                       class='btn btn-primary'>Select Employees
                                                    </button>
                                                </div>
                                            </div>
                                            
                                            <div class="row mt-0">
                                                <div class="col-md-4">
                                                    <button type="button" class="btn btn-primary" id="submitPayroll">Submit</button>
                                                </div>
                                                
                                            </div>
                                        </form>                      
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="animated-underline-payroll" role="tabpanel" 
                                    aria-labelledby="animated-underline-payroll-tab">
                                    <div class="col-xl-12 col-lg-12 col-sm-12 layout-spacing">
                                        <div class="br-6">
                                            <form  id='singleLevelDataEntryForm' autocomplete="off"
                                                method="post" action="{{ route('payrollGeneration.postData') }}">
                                                <input type="hidden" name="_token" id="csrfTokenDetail" value="{{ csrf_token() }}">
                                                <div style='float:right; padding-right:30px'>
                                                    <button type='submit' name='submit_DetailEntry' id='action_DetailEntry1' value='Update'
                                                        class='btn btn-outline-success mb-2'>Save
                                                        <!-- <i class="fas fa-plus fa-sm ml-1"> </i> -->
                                                    </button>
                                                </div>       
                                                <div class="table-responsive">
                                                    <table id="html5-extension3SIS" class="table table-hover non-hover" style="width:100%">
                                                        <thead>
                                                            <tr>
                                                                <th>Emp Id</th>
                                                                <th>Name</th>
                                                                <th>Location </th>
                                                                <th>PaidDays</th>
                                                                <th>PayrollAmt</th>
                                                                <th>UserEditedAmt</th>
                                                                <th>GrossDeduction</th>
                                                                <th>Action</th>
                                                                <th style="visibility: hidden;">Unique Id</th>
                                                            </tr>
                                                        </thead> 
                                                    </table>
                                                </div>
                                                    <!-- <div>
                                                        <input type="submit" name='submit_DetailEntry' id='action_DetailEntry1' value='Update' 
                                                        class='btn btn-outline-success mb-2'>
                                                    </div> -->
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Payroll Detail Sub Form  -->
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
                    <div class="modal-body">
                        <div class="widget-content widget-content-area animated-underline-content">
                            <div class="tab-content" id="animateLineContent-4">
                                <!-- Sub Form -->
                                <div class="table-responsive">
                                    <table id="html5-PayrollDetailSubform3SIS" class="table table-hover non-hover" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th title="Income or Deduction Id">Id</th>
                                                <th title="Income or Deduction">I_D</th>
                                                <th>Desc</th>
                                                <th title="Gross Income">G_Inc</th>
                                                <th title="Gross Pay">G_Pay</th>
                                                <th title="Payroll Amt">P_Amt</th>
                                                <th title="User Edited Amt">U_Edited</th>
                                                <th title="Comp Contri Gross">C_Con_Gross</th>
                                                <th title="Comp Contri Net">C_Con_Net</th>
                                                <th title="Comp Contri User Edited Amt">C_Con_U_Edited</th>
                                            </tr>
                                        </thead> 
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Payroll Detail Sub Form Ends**********-->
        <!-- Header Level Data Entry -->
        <div id="detailEntryModal1" class="modal fade" data-backdrop="static" 
                data-keyboard="false" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered 3SISPro-modal-dialog modal-lg" role="document">
                <div class='modal-content'> 
                <!-- Modal Header -->
                <div class="modal-header-F4List3SIS" id="registerModalLabel">
                    <h4 class="modal-title"></h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                        <svg aria-hidden="true" width="24" height="24" 
                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" 
                        stroke-linecap="round" stroke-linejoin="round" 
                        class="feather feather-x text-success"><line x1="18" y1="6" x2="6" y2="18">                                            
                        </line><line x1="6" y1="6" x2="18" y2="18"></line></svg></button>
                </div>
                <div class="modal-body">
                    <div class="widget-content widget-content-area-F4List3SIS">
                        <div class="html5-F4List3SIS">
                            <table id="html5-employeeSubform3SIS" class="table table-hover" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>Select</th>
                                        <th>Location</th>
                                        <th>Employee Id</th>
                                        <th>Full Name</th>
                                    </tr>
                                </thead> 
                            </table>
                        </div>
                    </div>
                </div>
                </div>
            </div>
        </div>
        @include('commonViews3SIS.modalCommon3SIS')
    </div>
<script>
    $(document).ready(function(){
        $modalTitle = 'Employee Payroll Detail'
        $modalTitleDetailEntry1 = 'Select Employee ' 

        $( "#PGGPHLocationId" ).select2();
        $("#selectEmployeesButton").hide();
        $("#reloadEmployeesButton").hide();
        fnGetFiscalYearDetail();
        fnUpdateDropdownsAddMode();
        $(".new-control-input").change(function () {
            var employeeSelection = $('.new-control-input:checked').val();

            if (employeeSelection == 0) {
                $("#selectEmployeesButton").hide();
                $("#reloadEmployeesButton").hide();
            } else {
                $("#selectEmployeesButton").show();
                $("#reloadEmployeesButton").show();
            }
        });
        $('#html5-extension3SIS').DataTable( {
            dom: '<"row"<"col-md-12"<"row"<"col-md-6"B><"col-md-6"f> > ><"col-md-12"rt><"col-md-12"<"row"<"col-md-5"i><"col-md-7"p>>> >',
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
            pageLength: 5,
            lengthMenu: [5, 10, 20, 50],

            order: [ 0, "desc" ],
            processing: true,
            serverSide: true,
            autoWidth: false,
            destroy: true,
            searching: false,               
            "ajax": "{{ route('payrollGeneration.browserData')}}",        
            "columns":[                    
                {data: "PGGPHEmpCode"},
                {data: "EMGIHFullName"},
                {data: "GMLMHDesc1"},                
                {data: "PGGPHPaidDays"},
                {data: "PGGPHPayrollAmt"},                
                {data: "PGGPHUserEditedAmt"},                
                {data: "PGGPHGrossDeduction"}, 
                {data: "action", orderable:false, searchable: false},
                {data: "PGGPHUniqueId", "visible": false},


            ],
            "columnDefs": [
                { "width": "5%", "targets": 0 },
                { "width": "15%", "targets": 1 },
                { "width": "10%", "targets": 2 },
                { "width": "10%", "targets": 3 },
                { "width": "10%", "targets": 4 },
                { "width": "10%", "targets": 5 },
                { "width": "10%", "targets": 6 },
                { "width": "10%", "targets": 7 },
            ]        
        });
        $(document).on('click', '.columnDefs', function(){
            var currentRow = $(this).closest("tr");
            $EMGIHEmployeeId = currentRow.find("td:eq(2)").text();
            // alert($EMGIHEmployeeId);
            // alert($(this).attr('datacolumnDefs'));
            $.ajax({
                // CopyChange
                url: "{{route('payrollGeneration.select_UnSelect')}}",
                method: 'GET',
                data: {EMGIHEmployeeId: $EMGIHEmployeeId},
                dataType: 'json',
                success: function(data)
                {
                    fnReinstateFormControl('0');
                    fnLoadEmployeeListSubForm();
                }
            });
            return false;

        });
        // When edit button is pushed on Landing Browser
        $(document).on('click', '.edit', function(){
            var $UniqueIdH = $(this).attr('id');
            // alert(id);

            fnPayrollDetailSubForm($UniqueIdH);
            var currentRow = $(this).closest("tr");
            $EMGIHFullName = currentRow.find("td:eq(1)").text();
            $titleSuffix = "<b style='color: #F5821F'>" + ' [ ' + $EMGIHFullName + ' ]' + "</b>";                    
            fnDataEntryFormHeader('1', 'Edit ', $titleSuffix);
            // $titleSuffix = "<b style='color: #F5821F'>" + ' [ ' + $('#EMGIHFullName').val() + ' ]' + "</b>";                    
            // fnDataEntryFormHeader('1', 'Edit ', $titleSuffix);
                    // fnReinstateFormControl('1');
            
        });
        // Edit Ends
    });
    // Income, Deduction Sub Forms
    function fnPayrollDetailSubForm($UniqueIdH){
        // Income Type Selection browser
        $('#html5-PayrollDetailSubform3SIS').DataTable( {
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
            pageLength: 10,
            lengthMenu: [6,10,25,50],
            order: [ 10, "asc" ],
            processing: true,
            serverSide: true,
            autoWidth: false,
            destroy: true,            
            "ajax": {
                "url": "{{ route('payrollGeneration.browserPayrollDetail')}}",
                "type": "GET",
                "data": function ( d ) {
                    d.UniqueIdH = $UniqueIdH;
                }
            },
            "columns":[
                {data: "PGGPDIncDedId"},
                {data: "PGGPDIncOrDed"},
                {data: "PGGPDDesc"},
                {data: "PGGPDGrossIncome"},
                {data: "PGGPDGrossPay"},
                {data: "PGGPDPayrollAmt"},                
                {data: "PGGPDUserEditedAmt"},                
                {data: "PGGPDCompContriGross"},                
                {data: "PGGPDCompContriNet"},                
                {data: "PGGPDCompContriUserEditedAmt"}, 
                {data: "PGGPDUniqueId", "visible": false},
                {data: "PGGPDSysId", "visible": false},
                {data: "PGGPDUserSorting", "visible": false},
            ],
            columnDefs: [{
                // Setting width of each column
                width: "5%", "targets": 0,
                width: "10%", "targets": 1,
                width: "10%", "targets": 2,
                width: "10%", "targets": 3,
                width: "10%", "targets": 4,
                width: "10%", "targets": 5,
                width: "10%", "targets": 6,
                width: "10%", "targets": 7,
                width: "10%", "targets": 8,
                width: "10%", "targets": 9,
            }],
            "rowCallback": function( row, data, index ){
                $('td', row).css('color', 'white');
                if ( data['PGGPDSysId'] == 200 )
                {
                    $('td', row).css('color', '#ffc107');
                };
                if( data['PGGPDSysId'] == 600 )
                {
                    $('td', row).css('color', '#ff0707');
                };
                if( data['PGGPDSysId'] == 900 )
                {
                    $('td', row).css('color', '#24ff07');
                };
            }
        });
        // browser Ends
    }
    $('#submitPayroll').click(function(){
        $PGGPHFiscalYear = $('#PGGPHFiscalYear').val();
        $PGGPHFiscalPeriod = $('#PGGPHFiscalPeriod').val();
        $FYFYHPeriodStartDate = $('#FYFYHPeriodStartDate').val();
        $FYFYHPeriodEndDate = $('#FYFYHPeriodEndDate').val();
        $FYFYHCurrentPeriodDesc = $('#FYFYHCurrentPeriodDesc').val();
        $TotalNoOfDays = $('#TotalNoOfDays').val();
        $PGGPHLocationId = $('#PGGPHLocationId').val();
        $employeeSelection = $('.new-control-input:checked').val();

        $userMessage = ' This will generate PAYROLL based on your selection. Do you want to Proceed with this ACTION? ';
        $reloadMessage3SIS = fnUserConfirmationYesNo($userMessage);   
        $('#userConfirmation').html($reloadMessage3SIS);
        $('#modalConfirmationYesNo3SIS').modal('show');

        $('#userConfirmationNo').one('click', function(){
            $('#modalConfirmationYesNo3SIS').modal('hide');
            $('#userConfirmationNo').die("click");
        }); 
        $('#userConfirmationYes').one('click', function(){
            $.ajax({
                url: "{{route('payrollGeneration.generatePayroll')}}",
                method: 'GET',
                data: {PGGPHFiscalYear: $PGGPHFiscalYear,PGGPHFiscalPeriod: $PGGPHFiscalPeriod,
                       FYFYHPeriodStartDate: $FYFYHPeriodStartDate, FYFYHPeriodEndDate: $FYFYHPeriodEndDate,
                       TotalNoOfDays: $TotalNoOfDays, PGGPHLocationId: $PGGPHLocationId,
                       FYFYHCurrentPeriodDesc: $FYFYHCurrentPeriodDesc, employeeSelection: $employeeSelection},
                dataType: 'json',
                success: function(data)
                {
                    $PGGPHLocationId = '';
                    fnReinstateFormControl('0');
                    fnLoadEmployeeListSubForm();
                    $('#modalConfirmationYesNo3SIS').modal('hide');
                }
            })
            $('#userConfirmationYes').die("click");
        });
    });    
    function fnGetFiscalYearDetail(){
        $.ajax({
            url: "{{route('dropDownMasters.getActiveFiscalYearParameater')}}",
            method: 'GET',
            dataType: 'json',
            success: function(response) {
                var $fYStartDate = formattedDate(new Date(response.FYFYHStartDate));
                var $fYEndDate = formattedDate(new Date(response.FYFYHEndDate));
                var $periodStartDate = formattedDate(new Date(response.FYFYHPeriodStartDate));
                var $periodEndDate = formattedDate(new Date(response.FYFYHPeriodEndDate));
                
                $('#PGGPHFiscalYear').val(response.FYFYHFiscalYearId);
                $('#FYFYHStartDate').val($fYStartDate);
                $('#FYFYHEndDate').val($fYEndDate);
                $('#PGGPHFiscalPeriod').val(response.FYFYHCurrentPeriod);
                $('#FYFYHCurrentPeriodDesc').val(response.FYFYHCurrentPeriodDesc);
                $('#FYFYHPeriodStartDate').val($periodStartDate);
                $('#FYFYHPeriodEndDate').val($periodEndDate);
                // $('#TotalNoOfDays').val($Days);
            },
            cache: true
        });
    }
    function fnUpdateDropdownsAddMode(){
        //GetSelectedLocation
        $.ajax({
            url: "{{route('dropDownMasters.getSelectedLocation')}}",
            method: 'GET',
            data: {id:'00'},
            dataType: 'json',
            success: function(response) {
                $('#PGGPHLocationId').html(response.SelectedItem);
            },
            cache: true
        });
    }
    // When SelectEmployee button is pushed        
    $('#Load_Employee_Data').click(function(){
        $PGGPHLocationId = $('#PGGPHLocationId').val();
        $PGGPHFiscalYear = $('#PGGPHFiscalYear').val();
        $FYFYHPeriodStartDate = $('#FYFYHPeriodStartDate').val();
        $FYFYHPeriodEndDate = $('#FYFYHPeriodEndDate').val();
        $userMessage = ' Do you want to retain previously selected EMPLOYEES? ';
        $reloadMessage3SIS = fnUserConfirmationYesNo($userMessage);   
        $('#userConfirmation').html($reloadMessage3SIS);
        $('#modalConfirmationYesNo3SIS').modal('show');
        // Fetch Record Ends
        // Reload record only when Yes is pressed on Modal.
        $('#userConfirmationNo').one('click', function(){
            $.ajax({
                // CopyChange
                url: "{{route('payrollGeneration.updateMemEmployee')}}",
                mehtod:"get",
                data: {UpdateMode:1, PGGPHLocationId: $PGGPHLocationId, 
                    FYFYHPeriodStartDate: $FYFYHPeriodStartDate, FYFYHPeriodEndDate: $FYFYHPeriodEndDate},
                success:function(data)
                {
                    $PGGPHLocationId = '';
                    // fnReinstateFormControl('0');
                    fnDetailEntryOnSubForm1('1', 'Add ', 'Edit ');

                    fnLoadEmployeeListSubForm();
                    $('#modalConfirmationYesNo3SIS').modal('hide');
                }
            })
            $('#userConfirmationNo').die("click");
        }); 
        $('#userConfirmationYes').one('click', function(){
            $.ajax({
                url: "{{route('payrollGeneration.updateMemEmployee')}}",
                method: 'GET',
                data: {UpdateMode:0, PGGPHLocationId: $PGGPHLocationId,
                    FYFYHPeriodStartDate: $FYFYHPeriodStartDate, FYFYHPeriodEndDate: $FYFYHPeriodEndDate},
                dataType: 'json',
                success: function(data)
                {
                    $PGGPHLocationId = '';
                    fnDetailEntryOnSubForm1('1', 'Add ', 'Edit ');
                    fnLoadEmployeeListSubForm();
                    $('#modalConfirmationYesNo3SIS').modal('hide');
                }
            })
            $('#userConfirmationYes').die("click");
        }); 
    });
    // Employee List Selection browser
    function fnLoadEmployeeListSubForm(){
        $('#html5-employeeSubform3SIS').DataTable( {
            dom: '<"row"<"col-md-12"<"row"<"col-md-6"B><"col-md-6"f> > ><"col-md-12"rt><"col-md-12"<"row"<"col-md-5"i><"col-md-7"p>>> >',
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
            pageLength: 5,
            lengthMenu: [5, 10, 20, 50],

            order: [[ 1, "asc" ],[2, "asc"]],
            processing: true,
            serverSide: true,
            autoWidth: false,
            destroy: true,
            searching: false,               
            "ajax": "{{ route('payrollGeneration.browserEmployeeList')}}",        
            "columns":[                    
                {data: "EMGIHSelect"},
                {data: "EMGIHLocationId"},                
                {data: "EMGIHEmployeeId"},
                {data: "EMGIHFullName"},
            ],
            "columnDefs": [{
                width: "10%", "targets": 0,
                width: "20%", "targets": 1,
                width: "10%", "targets": 2,
                width: "20%", "targets": 3,
                
            "targets": 0,
                data:   "EMGIHSelect",
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
        });
    }
    // Employee List Selection browser Ends
    
</script>
@endsection
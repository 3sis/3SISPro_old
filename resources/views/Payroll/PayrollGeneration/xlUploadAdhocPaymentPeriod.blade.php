@extends('layouts.app')
@section('content')
    <div class="layout-px-spacing">
        <div class="container">
            <div class="row layout-top-spacing">
                <div id="fuSingleFile" class="col-lg-12 layout-spacing">
                    <div class="card component-card_1">
                        {{-- <div class="card-header">
                            <h4>File Upload</h4>
                        </div> --}}
                        <div class="card-body">
                            <!-- Nav Tabs -->
                            <ul class="nav nav-tabs mb-3" id="animateLine" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="animated-underline-home-tab" data-toggle="tab" 
                                    href="#animated-underline-home" role="tab" aria-controls="animated-underline-home" a
                                    ria-selected="true">File Info</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="animated-underline-adhocPaymentPeriod-tab" data-toggle="tab" 
                                    href="#animated-underline-adhocPaymentPeriod" role="tab" aria-controls="animated-underline-adhocPaymentPeriod" 
                                    aria-selected="false">Adhoc Payment</a>
                                </li>
                            </ul>
                            <div class="tab-content" id="animateLineContent-4">
                                
                                <div class="tab-pane fade show active" id="animated-underline-home" role="tabpanel" 
                                    aria-labelledby="animated-underline-home-tab">
                                    <div class="container-fluid">
                                        <div class='row mt-0' id='errorMessageId'>
                                            <div class='col-md-12 alert alert-danger'>
                                                <span id='detailEntryMessages1'></span>
                                            </div>
                                        </div>
                                        <form id='importDataForm' autocomplete="off"
                                             method="POST" enctype="multipart/form-data" action="{{route('adhocPaymentPeriod.import')}}">
                                            <input type="hidden" name="_token" id="csrfTokenMain" value="{{ csrf_token() }}">
                                            <input type="hidden" name='FYFYHCurrentPeriod' id="FYFYHCurrentPeriod" class="form-control">
                                            <div class="row mt-0">
                                                <div class="col-md-4">
                                                    <div class='form-group'>                                                
                                                        <label>Fiscal Year</label>
                                                        <input type="text" name='FYFYHFiscalYearId' id="FYFYHFiscalYearId"
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
                                                    <div class="form-group">
                                                    <span class="error-text file_error text-danger" 
                                                                    style='float:right;'></span>
                                                        <input type="file" name="file" id="file" class="form-control-upload">
                                                    </div>
                                                </div>

                                                <!-- <div class="col-md-4" id='selectEmployeesButton'>
                                                    <button type='button' id='SelectIncomeType' 
                                                       class='btn btn-primary'>Select Income Type
                                                    </button>
                                                </div> -->

                                                <div class="col-md-4">
                                                    <button type="submit" class="btn btn-primary" id="submit">Submit</button>
                                                </div>
                                                
                                            </div>
                                        </form>                      
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="animated-underline-adhocPaymentPeriod" role="tabpanel" 
                                    aria-labelledby="animated-underline-adhocPaymentPeriod-tab">
                                    <div class="col-xl-12 col-lg-12 col-sm-12 layout-spacing">
                                        <div class='row mt-0' id='errorMessageId2'>
                                            <div class='col-md-12 alert alert-danger'>
                                                <span id='detailEntryMessages2'></span>
                                            </div>
                                        </div>
                                        <div class="br-6">
                                            <div style="float: right; padding-left: 30px;">
                                                <button type='button' name='SelectIncomeType' id='SelectIncomeType' class='btn btn-primary'>Select Income Type
                                                        <i class="fa-solid fa-arrow-pointer"></i>
                                                </button>
                                            </div>
                                            <form  id='singleLevelDataEntryForm' autocomplete="off"
                                                method="post" action="{{ route('adhocPaymentPeriod.postData') }}">
                                                <input type="hidden" name="_token" id="csrfTokenDetail" value="{{ csrf_token() }}">
                                                <div class="table-responsive">
                                                    <table id="html5-extension3SIS" class="table table-hover non-hover" style="width:100%">
                                                        <thead>
                                                            <tr>
                                                                <th>Id</th>
                                                                <th>Employee Name</th>
                                                                <th>Effective From</th>
                                                                <th>Effective To</th>
                                                                <th>RevisedAmt</th>
                                                                <th>Select</th>
                                                                <th style="visibility: hidden;">User</th>
                                                                <th style="visibility: hidden;">Unique Id</th>
                                                            </tr>
                                                        </thead> 
                                                    </table>
                                                </div>
                                                <div>
                                                    <!--To display success messages-->
                                                <div style='float:right; padding-right:30px'>                                                    
                                                        <span id='form_output' style='float:left; padding-left:0px' ></span> 
                                                        <input type="hidden" name='button_action' id='button_action' value='insert'>
                                                        <input type="submit" name='save' id="action" value='save' 
                                                            class='btn btn-outline-success mb-2'>
                                                    </div>
                                                </div>
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
        <div id="entryModalSmall" class="modal fade UpdateModalBox3SIS" data-backdrop="static" 
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
                            </line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="widget-content widget-content-area-F4List3SIS">
                            <div class="html5-F4List3SIS">
                                <table id="html5-incomeTypeSubform3SIS" class="table table-hover" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>Select</th>
                                            <th>Income Type</th>
                                            <th>Desc</th>
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
        $modalTitle = 'Select Income Type'
        $('#errorMessageId').hide();
        $('#errorMessageId2').hide();
        $("#animated-underline-adhocPaymentPeriod-tab").hide();
        fnGetFiscalYearDetail();

        $('#html5-extension3SIS').DataTable( {
            dom: '<"row"<"col-md-12"<"row"<"col-md-6"B><"col-md-6"f> > ><"col-md-12"rt><"col-md-12"<"row"<"col-md-5"i><"col-md-7"p>>> >',
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
            pageLength: 5,
            lengthMenu: [5, 10, 20, 50],
            order: [ 0, "desc" ],
            processing: true,
            serverSide: true,
            autoWidth: false,
            destroy: true,
            searching: false,               
            "ajax": "{{ route('adhocPaymentPeriod.browserData')}}",
            "columns":[                    
                {data: "PGSRHEmployeeId"},
                {data: "EMGIHFullName"},
                {data: "PGSRHEffectiveFrom"},
                {data: "PGSRHEffectiveTo"},
                {data: "PGSRHRevisedAmt"},
                {data: "PGSRHSelect"},
                {data: "PGSRHUser", "visible": false},
                {data: "PGSRHUniqueId", "visible": false},
            ],
            columnDefs: [{
                // Setting width of each column
                width: "10%", "targets": 0,
                width: "20%", "targets": 1,
                width: "10%", "targets": 2,
                width: "10%", "targets": 3,
                width: "10%", "targets": 4,
                width: "10%", "targets": 5,
                width: "20%", "targets": 6,
                "targets": 5,
                data:   "PGSRHSelect",
                render: function (data ,td, cellData, rowData, row, col) {
                    if(data==1){
                        return '<label class="columnDefs columnSelect new-control new-checkbox checkbox-primary">\
                        <input type="checkbox" class="new-control-input chk-parent select-customers-info" checked>\
                        <span class="new-control-indicator"></span><span style="visibility:hidden">c</span></label>';
                    }else{
                        return '<label class="columnDefs columnSelect new-control new-checkbox checkbox-primary">\
                        <input type="checkbox" class="new-control-input chk-parent select-customers-info">\
                        <span class="new-control-indicator"></span><span style="visibility:hidden">c</span></label>';
                    }
                }
            }],       
        });
        
        // 
    });
    $(document).on('click', '.columnSelect', function(){
            var currentRow = $(this).closest("tr");
            $PGSRHEmployeeId = currentRow.find("td:eq(0)").text();
            // alert($PGSRHEmployeeId);
            // alert($(this).attr('datacolumnDefs'));
            $.ajax({
                // CopyChange
                url: "{{route('adhocPaymentPeriod.select_UnSelect')}}",
                method: 'GET',
                data: {PGSRHEmployeeId: $PGSRHEmployeeId},
                dataType: 'json',
                success: function(data)
                {
                    fnLoadSalaryRevisionSubForm();
                }
            });
            return false;
        });

        $(document).on('click', '.columnDefsIncome', function(){
            var currentRow = $(this).closest("tr");
            $PMSSHIncomeId = currentRow.find("td:eq(1)").text();
            // alert($PGSRHEmployeeId);
            // alert($(this).attr('datacolumnDefs'));
            $.ajax({
                // CopyChange
                url: "{{route('adhocPaymentPeriod.select_UnSelectIncomeType')}}",
                method: 'GET',
                data: {PMSSHIncomeId: $PMSSHIncomeId},
                dataType: 'json',
                success: function(data)
                {
                    // fnReinstateFormControl('0');
                    // $('#html5-incomeTypeSubform3SIS').DataTable().ajax.reload();

                    fnLoadIncomeTypeListSubForm();
                }
            });
            return false;

        });

    $('#importDataForm').on('submit', function(event){
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
                $('#errorMessageId').hide();
                $('#errorMessageId2').hide();

            },
            success:function(data)
            {
                if(data.status == 0)
                {
                    if (data.ErrorOutput != '') {
                        $('#errorMessageId').show();                        
                        $('#detailEntryMessages1').html(data.ErrorOutput); 
                    } 
                    
                }else
                { 
                    $finalMessage3SIS = fnSingleLevelFinalSave(data.masterName, data.Id, data.Desc1, data.updateMode);
                    $('#FinalSaveMessage').html($finalMessage3SIS);
                    // $('#modalZoomFinalSave3SIS').modal('show');
                    // $('#html5-extension3SIS').DataTable().ajax.reload();
                    fnLoadSalaryRevisionSubForm();
                    $("#animated-underline-adhocPaymentPeriod-tab").show();
                    $("#animated-underline-adhocPaymentPeriod-tab").trigger('click');
                }
            }
        })
    });    
    function fnLoadSalaryRevisionSubForm(){
        $('#html5-extension3SIS').DataTable( {
            dom: '<"row"<"col-md-12"<"row"<"col-md-6"B><"col-md-6"f> > ><"col-md-12"rt><"col-md-12"<"row"<"col-md-5"i><"col-md-7"p>>> >',
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
            pageLength: 5,
            lengthMenu: [5, 10, 20, 50],
            order: [ 0, "desc" ],
            processing: true,
            serverSide: true,
            autoWidth: false,
            destroy: true,
            searching: false,               
            "ajax": "{{ route('adhocPaymentPeriod.browserData')}}",
            "columns":[                    
                {data: "PGSRHEmployeeId"},
                {data: "EMGIHFullName"},
                {data: "PGSRHEffectiveFrom"},
                {data: "PGSRHEffectiveTo"},
                {data: "PGSRHRevisedAmt"},
                {data: "PGSRHSelect"},
                {data: "PGSRHUser", "visible": false},
                {data: "PGSRHUniqueId", "visible": false},
            ],
            columnDefs: [{
                // Setting width of each column
                width: "10%", "targets": 0,
                width: "20%", "targets": 1,
                width: "10%", "targets": 2,
                width: "10%", "targets": 3,
                width: "10%", "targets": 4,
                width: "10%", "targets": 5,
                width: "20%", "targets": 6,
                "targets": 5,
                data:   "PGSRHSelect",
                render: function (data ,td, cellData, rowData, row, col) {
                    if(data==1){
                        return '<label class="columnDefs columnSelect new-control new-checkbox checkbox-primary">\
                        <input type="checkbox" class="new-control-input chk-parent select-customers-info" checked>\
                        <span class="new-control-indicator"></span><span style="visibility:hidden">c</span></label>';
                    }else{
                        return '<label class="columnDefs columnSelect new-control new-checkbox checkbox-primary">\
                        <input type="checkbox" class="new-control-input chk-parent select-customers-info">\
                        <span class="new-control-indicator"></span><span style="visibility:hidden">c</span></label>';
                    }
                }
            }],       
        });
    }
    // When SelectEmployee button is pushed        
    $('#SelectIncomeType').click(function(){
        $userMessage = ' Do you want to retain previously selected Income Type? ';
        $reloadMessage3SIS = fnUserConfirmationYesNo($userMessage);   
        $('#userConfirmation').html($reloadMessage3SIS);
        $('#modalConfirmationYesNo3SIS').modal('show');
        // Fetch Record Ends
        // Reload record only when Yes is pressed on Modal.
        $('#userConfirmationNo').one('click', function(){
            $.ajax({
                // CopyChange
                url: "{{route('adhocPaymentPeriod.updateIncomeTypeMem')}}",
                mehtod:"get",
                data: {UpdateMode:1},
                success:function(data)
                {
                    fnReinstateFormControl('0');
                    fnLoadIncomeTypeListSubForm();
                    $('#modalConfirmationYesNo3SIS').modal('hide');
                }
            })
            // $('#userConfirmationNo').die("click");
        }); 
        $('#userConfirmationYes').one('click', function(){
            $.ajax({
                url: "{{route('adhocPaymentPeriod.updateIncomeTypeMem')}}",
                method: 'GET',
                data: {UpdateMode:0},
                dataType: 'json',
                success: function(data)
                {
                    fnReinstateFormControl('1');
                    fnLoadIncomeTypeListSubForm();
                    $('#modalConfirmationYesNo3SIS').modal('hide');
                }
            })
            $('#userConfirmationYes').die("click");
        }); 
    });
    // IncomeType List Selection browser
    function fnLoadIncomeTypeListSubForm(){
        $('#html5-incomeTypeSubform3SIS').DataTable( {
            dom: '<"row"<"col-md-12"<"row"<"col-md-6"B><"col-md-6"f> > ><"col-md-12"rt><"col-md-12"<"row"<"col-md-5"i><"col-md-7"p>>> >',
            buttons: {
            buttons: [
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
            "ajax": "{{ route('adhocPaymentPeriod.browserIncomeTypeList')}}",        
            "columns":[                    
                {data: "PMSSHSelect"},
                {data: "PMSSHIncomeId"},                
                {data: "PMSSHDesc1"},
            ],
            "columnDefs": [{
                width: "10%", "targets": 0,
                width: "20%", "targets": 1,
                width: "30%", "targets": 2,
                
            "targets": 0,
                data:   "PMSSHDesc1",
                render: function (data ,td, cellData, rowData, row, col) {

                    if(data==1){
                        return '<label class="columnDefsIncome new-control new-checkbox checkbox-primary">\
                        <input type="checkbox" class="new-control-input chk-parent select-customers-info" checked>\
                        <span class="new-control-indicator"></span><span style="visibility:hidden">c</span></label>';
                    }else{
                        return '<label class="columnDefsIncome new-control new-checkbox checkbox-primary">\
                        <input type="checkbox" class="new-control-input chk-parent select-customers-info">\
                        <span class="new-control-indicator"></span><span style="visibility:hidden">c</span></label>';
                    }
                },
            }],
        });
    }
    // IncomeType List Selection browser Ends
    $('#singleLevelDataEntryForm').on('submit', function(event){
        $FiscalYearId = $('#FYFYHFiscalYearId').val();           
        $CurrentPeriod = $('#FYFYHCurrentPeriod').val();           
        event.preventDefault();
        var formData = new FormData(this);
        formData.append('PGAIDFiscalYear', $FiscalYearId );
        formData.append('PGAIDPeriodId', $CurrentPeriod );

        $.ajax({
            url: $(this).attr('action'),
            method: $(this).attr('method'),
            data: formData,
            processData: false,
            dataType: "json",
            contentType: false,
            beforeSend: function(){
                $(document).find('span.error-text').text('');
                $('#errorMessageId').hide();
                $('#errorMessageId2').hide();
            },
            success:function(data)
            {
                if(data.status == 0)
                {
                    if (data.ErrorOutput != '') {
                        $('#errorMessageId2').show();                        
                        $('#detailEntryMessages2').html(data.ErrorOutput); 
                    }    
                }else
                { 
                    $finalMessage3SIS = fnSingleLevelFinalSave(data.masterName, data.Id, data.Desc1, data.updateMode);
                    $('#FinalSaveMessage').html($finalMessage3SIS);
                    $('#modalZoomFinalSave3SIS').modal('show');
                    $('#errorMessageId2').hide();
                    $("#animated-underline-adhocPaymentPeriod-tab").show();
                    $('#html5-extension3SIS').DataTable().ajax.reload();
                    $("#animated-underline-home-tab").trigger('click');
                }
            }
        })
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
                
                $('#FYFYHFiscalYearId').val(response.FYFYHFiscalYearId);
                $('#FYFYHStartDate').val($fYStartDate);
                $('#FYFYHEndDate').val($fYEndDate);
                $('#FYFYHCurrentPeriod').val(response.FYFYHCurrentPeriod);
                $('#FYFYHCurrentPeriodDesc').val(response.FYFYHCurrentPeriodDesc);
                $('#FYFYHPeriodStartDate').val($periodStartDate);
                $('#FYFYHPeriodEndDate').val($periodEndDate);
                // $('#TotalNoOfDays').val($Days);
            },
            cache: true
        });
    }
</script>
@endsection


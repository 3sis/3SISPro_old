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
                                    <a class="nav-link" id="animated-underline-incomeAdjustment-tab" data-toggle="tab" 
                                    href="#animated-underline-incomeAdjustment" role="tab" aria-controls="animated-underline-incomeAdjustment" 
                                    aria-selected="false">Deduction Adjustment</a>
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
                                             method="POST" enctype="multipart/form-data" action="{{route('incomeAdjustment.import')}}">
                                            <input type="hidden" name="_token" id="csrfTokenMain" value="{{ csrf_token() }}">
                                            
                                            <div class="row mt-0">
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                    <span class="error-text file_error text-danger" 
                                                                    style='float:right;'></span>
                                                        <input type="file" name="file" id="file" class="form-control-upload">
                                                    </div>
                                                </div>

                                                <!-- <div class="col-md-4" id='selectEmployeesButton'>
                                                    <button type='button' id='SelectDeductionType' 
                                                       class='btn btn-primary'>Select Deduction Type
                                                    </button>
                                                </div> -->

                                                <div class="col-md-4">
                                                    <button type="submit" class="btn btn-primary" id="submit">Submit</button>
                                                </div>
                                                
                                            </div>
                                        </form>                      
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="animated-underline-incomeAdjustment" role="tabpanel" 
                                    aria-labelledby="animated-underline-incomeAdjustment-tab">
                                    <div class="col-xl-12 col-lg-12 col-sm-12 layout-spacing">
                                        <div class='row mt-0' id='errorMessageId2'>
                                            <div class='col-md-12 alert alert-danger'>
                                                <span id='detailEntryMessages2'></span>
                                            </div>
                                        </div>
                                        <div class="br-6">
                                            <div style="float: right; padding-left: 30px;">
                                                <button type='button' name='SelectDeductionType' id='SelectDeductionType' class='btn btn-primary'>Select Deduction Type
                                                        <i class="fa-solid fa-arrow-pointer"></i>
                                                </button>
                                            </div>
                                            <form  id='singleLevelDataEntryForm' autocomplete="off"
                                                method="post" action="{{ route('incomeAdjustment.postData') }}">
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
                                                                <th>F/P</th>
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
                                <table id="html5-DeductionTypeSubform3SIS" class="table table-hover" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>Select</th>
                                            <th>Deduction Type</th>
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
        $modalTitle = 'Select Deduction Type'
        $('#errorMessageId').hide();
        $('#errorMessageId2').hide();
        $("#animated-underline-incomeAdjustment-tab").hide();

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
            "ajax": "{{ route('incomeAdjustment.browserData')}}",
            "columns":[                    
                {data: "PGSRHEmployeeId"},
                {data: "EMGIHFullName"},
                {data: "PGSRHEffectiveFrom"},
                {data: "PGSRHEffectiveTo"},
                {data: "PGSRHRevisedAmt"},
                {data: "PGSRHFixedOrPercent"},
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
                width: "10%", "targets": 6,
                width: "20%", "targets": 7,
                "targets": 6,
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
    });
    $(document).on('click', '.columnSelect', function(){
            var currentRow = $(this).closest("tr");
            $PGSRHEmployeeId = currentRow.find("td:eq(0)").text();
            // alert($PGSRHEmployeeId);
            // alert($(this).attr('datacolumnDefs'));
            $.ajax({
                // CopyChange
                url: "{{route('incomeAdjustment.select_UnSelect')}}",
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
            $PMDAHDeductionId = currentRow.find("td:eq(1)").text();
            // alert($PGSRHEmployeeId);
            // alert($(this).attr('datacolumnDefs'));
            $.ajax({
                // CopyChange
                url: "{{route('incomeAdjustment.select_UnSelectDeductionType')}}",
                method: 'GET',
                data: {PMDAHDeductionId: $PMDAHDeductionId},
                dataType: 'json',
                success: function(data)
                {
                    // fnReinstateFormControl('0');
                    // $('#html5-DeductionTypeSubform3SIS').DataTable().ajax.reload();

                    fnLoadDeductionTypeListSubForm();
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
                    $('#html5-extension3SIS').DataTable().ajax.reload();

                    // fnLoadSalaryRevisionSubForm();
                    $("#animated-underline-incomeAdjustment-tab").show();
                    $("#animated-underline-incomeAdjustment-tab").trigger('click');
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
            "ajax": "{{ route('incomeAdjustment.browserData')}}",
            "columns":[                    
                {data: "PGSRHEmployeeId"},
                {data: "EMGIHFullName"},
                {data: "PGSRHEffectiveFrom"},
                {data: "PGSRHEffectiveTo"},
                {data: "PGSRHRevisedAmt"},
                {data: "PGSRHFixedOrPercent"},
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
                width: "10%", "targets": 6,
                width: "20%", "targets": 7,
                "targets": 6,
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
    $('#SelectDeductionType').click(function(){
        $userMessage = ' Do you want to retain previously selected Deduction Type? ';
        $reloadMessage3SIS = fnUserConfirmationYesNo($userMessage);   
        $('#userConfirmation').html($reloadMessage3SIS);
        $('#modalConfirmationYesNo3SIS').modal('show');
        // Fetch Record Ends
        // Reload record only when Yes is pressed on Modal.
        $('#userConfirmationNo').one('click', function(){
            $.ajax({
                // CopyChange
                url: "{{route('incomeAdjustment.updateDeductionTypeMem')}}",
                mehtod:"get",
                data: {UpdateMode:1},
                success:function(data)
                {
                    fnReinstateFormControl('0');
                    fnLoadDeductionTypeListSubForm();
                    $('#modalConfirmationYesNo3SIS').modal('hide');
                }
            })
            // $('#userConfirmationNo').die("click");
        }); 
        $('#userConfirmationYes').one('click', function(){
            $.ajax({
                url: "{{route('incomeAdjustment.updateDeductionTypeMem')}}",
                method: 'GET',
                data: {UpdateMode:0},
                dataType: 'json',
                success: function(data)
                {
                    fnReinstateFormControl('1');
                    fnLoadDeductionTypeListSubForm();
                    $('#modalConfirmationYesNo3SIS').modal('hide');
                }
            })
            $('#userConfirmationYes').die("click");
        }); 
    });
    // DeductionType List Selection browser
    function fnLoadDeductionTypeListSubForm(){
        $('#html5-DeductionTypeSubform3SIS').DataTable( {
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
            "ajax": "{{ route('incomeAdjustment.browserDeductionTypeList')}}",        
            "columns":[                    
                {data: "PMDAHSelect"},
                {data: "PMDAHDeductionId"},                
                {data: "PMDAHDesc1"},
            ],
            "columnDefs": [{
                width: "10%", "targets": 0,
                width: "20%", "targets": 1,
                width: "30%", "targets": 2,
                
            "targets": 0,
                data:   "PMDAHDesc1",
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
    // DeductionType List Selection browser Ends
    $('#singleLevelDataEntryForm').on('submit', function(event){
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
                        $('#errorMessageId2').show();                        
                        $('#detailEntryMessages2').html(data.ErrorOutput); 
                    }    
                }else
                { 
                    $finalMessage3SIS = fnSingleLevelFinalSave(data.masterName, data.Id, data.Desc1, data.updateMode);
                    $('#FinalSaveMessage').html($finalMessage3SIS);
                    $('#modalZoomFinalSave3SIS').modal('show');
                    $('#errorMessageId2').hide();
                    $("#animated-underline-incomeAdjustment-tab").show();
                    // $('#html5-extension3SIS').DataTable().ajax.reload();
                    fnLoadSalaryRevisionSubForm();
                    $("#animated-underline-home-tab").trigger('click');
                }
            }
        })
    });

    
</script>
@endsection


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
                <div class="table-responsive">
                    <table id="html5-extension3SIS" class="table table-hover non-hover" style="width:100%">
                        <thead>
                            <tr>
                                <!--CopyChange-->                                    
                                <!-- <th>Company</th> -->
                                <th title="Fiscal Year">FY</th>
                                <th>Start Data</th>
                                <th>End Date</th>
                                <th title=" Active Fiscal Year">AFY</th>
                                <th title="Active Period">AP</th>
                                <th title="Active Month">AM</th>
                                <th>Period Start</th>
                                <th>Period End</th>                                    
                                <th>Action</th>
                                <th style="visibility: hidden;">User</th>
                                <th style="visibility: hidden;">Created</th>
                                <th style="visibility: hidden;">Updated</th>
                                <th style="visibility: hidden;">Unique Id</th>
                                <th style="visibility: hidden;">Company</th>
                            </tr>
                        </thead>                       
                        
                    </table>
                </div>
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
                                                            <!--CopyChange-->                                    
                                                            <!-- <th>Company</th> -->
                                                            <th title="Fiscal Year">FY</th>
                                                            <th>Start Data</th>
                                                            <th>End Date</th>
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
                <div id="entryModalSmall" class="modal fade UpdateModalBox3SIS" data-backdrop="static" 
                    data-keyboard="false" role="dialog" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered 3SISPro-modal-dialog modal-lg" role="document"> 
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
                            <form  id='singleLevelDataEntryForm' autocomplete="off"                                    
                                method="post" action="{{ route('fiscalyear.postData') }}">
                                <input type="hidden" name="_token" id="csrfToken" value="{{ csrf_token() }}">
                                <div class="modal-body">
                                    <div class="widget-content widget-content-area animated-underline-content">
                                        <ul class="nav nav-tabs mb-3" id="animateLine" role="tablist">
                                            <li class="nav-item">
                                                <a class="nav-link active" id="animated-underline-home-tab" data-toggle="tab" 
                                                href="#animated-underline-home" role="tab" aria-controls="animated-underline-home" a
                                                ria-selected="true"> Entry</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" id="animated-underline-profile-tab" data-toggle="tab" 
                                                href="#animated-underline-profile" role="tab" aria-controls="animated-underline-profile" 
                                                aria-selected="false">Record Info</a>
                                            </li>
                                        </ul>
                                        <div class="tab-content" id="animateLineContent-4">
                                            <div class="tab-pane fade show active" id="animated-underline-home" role="tabpanel" 
                                                aria-labelledby="animated-underline-home-tab">
                                                <div class="container-fluid">
                                                    <div class='form-group'>
                                                        <input type="hidden" name='FYFYHUniqueId' id='FYFYHUniqueId' 
                                                            class='form-control'>
                                                        <input type="hidden" name='FYFYHCompanyId' id='FYFYHCompanyId' 
                                                            class='form-control'>
                                                            <input type="hidden" name='activeFiscalYearId' id='activeFiscalYearId' 
                                                            class='form-control'>                                                
                                                    </div>
                                                    <!-- Fiscal Year -->
                                                    <div class="row mt-0">
                                                        <div class="col-md-6">
                                                            <div class='form-group'>                                                
                                                                <label>Fiscal Year</label> 
                                                                <span class="error-text FYFYHFiscalYearId_error text-danger" 
                                                                    style='float:right;'></span>
                                                                <input type="text"  name='FYFYHFiscalYearId' id='FYFYHFiscalYearId' 
                                                                    class='form-control few-options' maxlength="4" 
                                                                    placeholder="Fiscal Year" style='opacity:1'>
                                                            </div>
                                                        </div>
                                                        <!-- Active Period -->
                                                        
                                                        <div class="n-chk col-md-6 mt-4"> 
                                                            <span class="error-text FYFYHCurrentFY_error text-danger" 
                                                                style='float:right;'></span>
                                                            <label class="new-control new-checkbox new-checkbox-text checkbox-success">
                                                                <!-- <input type="hidden" class="new-control-input" name='FYFYHCurrentFY' id='FYFYHCurrentFY' value='0'> -->
                                                                <input type="checkbox" class="new-control-input" name='FYFYHCurrentFY' id='FYFYHCurrentFY'>
                                                                <span class="new-control-indicator"></span><span class="new-chk-content">Active Fiscal Year</span>
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <!-- Start End Date -->
                                                    <div class="row mt-0">
                                                        <div class="col-md-6">
                                                            <div class='form-group'>                                                
                                                                <label>FY Start Date</label> 
                                                                <span class="error-text FYFYHStartDate_error text-danger" 
                                                                    style='float:right;'></span>
                                                                <input type="date" name='FYFYHStartDate' id="FYFYHStartDate"
                                                                    class="form-control">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class='form-group'>                                                
                                                                <label>FY End Date</label> 
                                                                <span class="error-text FYFYHEndDate_error text-danger" 
                                                                    style='float:right;'></span>
                                                                <input type="date" name='FYFYHEndDate' id="FYFYHEndDate" 
                                                                    class="form-control" style='opacity:1'>
                                                            </div>
                                                        </div>
                                                    </div>                                                    
                                                    <!-- For defining select2 -->
                                                    <div>
                                                        <label>Active Period</label>                                                
                                                        <span class="error-text periodId_error text-danger" 
                                                            style='float:right;'></span>
                                                        <select id='periodId' name = 'periodId' style='width: 100%;'>
                                                            <option value='0'>-- Select Active Period --</option>                                                                
                                                        </select>                                                
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- User Info -->
                                            <div class="tab-pane fade" id="animated-underline-profile" role="tabpanel" 
                                                aria-labelledby="animated-underline-profile-tab">
                                                <div class="media">
                                                    <div class="media-body">
                                                        <div class="form-group">
                                                            <label> User</label>
                                                            <input type="text" name="FYFYHUser" id="FYFYHUser" 
                                                            class="form-control col-sm-6" readonly/>
                                                        </div>
                                                        <div class="form-group">
                                                            <label> Created Date</label>
                                                            <input type="date" name="FYFYHLastCreated" id="FYFYHLastCreated" 
                                                            class="form-control col-sm-6" readonly/>
                                                        </div>
                                                        <div class="form-group">
                                                            <label> Updated Date</label>
                                                            <input type="date" name="FYFYHLastUpdated" id="FYFYHLastUpdated" 
                                                            class="form-control col-sm-6" readonly />
                                                        </div>                                                        
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
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
                @include('commonViews3SIS.modalCommon3SIS')
            </div>
        </div>
    </div>
</div>
<script>        
    $(document).ready(function(){
        $modalTitle = 'Fiscal Year'
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
            oLanguage: {
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
            order: [[ 1, "desc" ]],
            processing: true,
            serverSide: true,
            // CopyChange                    
            ajax: "{{ route('fiscalyear.browserData')}}",
            columns:[
                // CopyChange
                {data: "FYFYHFiscalYearId"},
                {data: "FYFYHStartDate"},
                {data: "FYFYHEndDate"},
                {data: "FYFYHCurrentFY"},
                {data: "FYFYHCurrentPeriod"},
                {data: "FYPMHDesc1"},
                {data: "FYFYHPeriodStartDate"},
                {data: "FYFYHPeriodEndDate"},                    
                {data: "action", orderable:false, searchable: false},
                {data: "FYFYHUser", "visible": false},
                {data: "FYFYHLastUpdated", "visible": false},
                {data: "FYFYHLastUpdated", "visible": false},
                {data: "FYFYHLastCreated", "visible": false},
                {data: "FYFYHCompanyId", "visible": false},                    
            ],
            columnDefs: [{
                "targets": 3,
                data:   "FYFYHCurrentFY",
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
            }]
        });
        // Whed add buttonis pushed
        $('#add_Data').click(function(){                    
            $("#FYFYHFiscalYearId").attr("readonly", false);
            fnReinstateFormControl('0');
            $("#animated-underline-home-tab").trigger('click');
             // Madhav to Copy 
            fnUpdateDropdownsAddMode();
        });
        // Add Ends                   
        // When edit button is pushed
        $(document).on('click', '.edit', function(){
            var id = $(this).attr('id');
            $.ajax({
                // CopyChange
                url: "{{route('fiscalyear.fetchData')}}",
                method: 'GET',
                data: {id:id},
                dataType: 'json',
                success: function(data)
                {
                    // Update Screen Variables
                    fnUpdateScreenVariables(data);
                    // Update Dropdowns
                     // Madhav to Copy 
                    var $CurrentPeriod = data.FYFYHCurrentPeriod;
                    fnUpdateDropdownsEditMode($CurrentPeriod)
                    $("#FYFYHFiscalYearId").attr("readonly", true);
                    $("#animated-underline-home-tab").trigger('click');
                    fnReinstateFormControl('1');
                    
                }
            });
        });
        // Edit Ends
        // When submit button is pushed
        $('#singleLevelDataEntryForm').on('submit', function(event){
            
            if($('#FYFYHCurrentFY').prop('checked')==true) {
                $('#FYFYHCurrentFY').val(1);
            }else {
                $('#FYFYHCurrentFY').val(0);
            }
            event.preventDefault();
            $.ajax({
                url: $(this).attr('action'),
                method: $(this).attr('method'),
                data: new FormData(this),
                processData: false,
                dataType: "json",
                // headers : {
                //     "content-type": "application/json",
                //     "accept": "application/json",
                // },
                contentType: false,
                cache: false,
                beforeSend: function(){
                    $(document).find('span.error-text').text('');
                },
                success:function(data)
                {
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
        // When delete button is pushed
        $(document).on('click', '.delete', function(){
            var UniqueId = $(this).attr('id');
            // Fetch Record first that need to be deleted.
            $.ajax({
                url: "{{route('fiscalyear.fetchData')}}",
                method: 'GET',
                data: {id:UniqueId},
                dataType: 'json',
                success: function(data)
                {
                    $deleteMessage3SIS = fnSingleLevelDeleteConfirmation($modalTitle, data.FYFYHFiscalYearId, '');   
                    $('#DeleteRecord').html($deleteMessage3SIS);
                    $('#modalZoomDeleteRecord3SIS').modal('show');                   
                }
            });
            // Fetch Record Ends
            // Delete record only when OK is pressed on Modal.
            $(document).on('click', '.confirm', function(){
                $.ajax({
                    // CopyChange
                    url:"{{route('fiscalyear.deleteData')}}",
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
            "ajax": "{{ route('fiscalyear.browserDeletedRecords')}}",
            "columns":[
                // CopyChange
                {data: "FYFYHFiscalYearId"},
                {data: "FYFYHStartDate"},
                {data: "FYFYHEndDate"},
                {data: "action", orderable:false, searchable: false},
                {data: "FYFYHUniqueId", "visible": false},
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
                url: "{{route('fiscalyear.fetchData')}}",
                method: 'GET',
                data: {id:DeletedUniqueId},
                dataType: 'json',
                success: function(data)
                {
                    $restoreMessage3SIS = fnSingleLevelRestoreConfirmation($modalTitle, data.FYFYHFiscalYearId, '');   
                    $('#RestoreRecord').html($restoreMessage3SIS);
                    $('#modalZoomRestoreRecord3SIS').modal('show');  
                    $('#modalZoomRestoreRecord3SIS').modal('hide');                    
                }
            });
            // Fetch Record Ends
            // Restore record only when OK is pressed on Modal.
            $(document).on('click', '.confirmrestore', function(){
                $.ajax({
                    url:"{{route('fiscalyear.restoreDeletedRecords')}}",
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
        $( "#periodId" ).select2();
        // Update Screen Variables
        function fnUpdateScreenVariables(data) {

            var startDate = formattedDate(new Date(data.FYFYHStartDate));
            var endDate = formattedDate(new Date(data.FYFYHEndDate));
            var lastCreated = formattedDate(new Date(data.FYFYHLastCreated));
            var lastUpdated = formattedDate(new Date(data.FYFYHLastUpdated));
            
            $('#FYFYHUniqueId').val(data.FYFYHUniqueId);
            $('#FYFYHCompanyId').val(data.FYFYHCompanyId);
            $('#FYFYHFiscalYearId').val(data.FYFYHFiscalYearId);
            $('#FYFYHStartDate').val(startDate);
            $('#FYFYHEndDate').val(endDate);
            $("#FYFYHCurrentFY").prop("checked", false);
            $('#FYFYHUser').val(data.FYFYHUser);
            $('#FYFYHLastCreated').val(lastCreated);
            $('#FYFYHLastUpdated').val(lastUpdated);
            if(data.FYFYHCurrentFY == 1)
            {
                $("#FYFYHCurrentFY").prop("checked", true);
                $('#FYFYHCurrentFY').val(1);
            }else{
                $("#FYFYHCurrentFY").prop("checked", false);
                $('#FYFYHCurrentFY').val(0);
            }
            $('#activeFiscalYearId').val(data.activeFiscalYearId);
        }
        // Update Screen Variables Ends
        // Active Period Dropdown in Edit Mode
         // Madhav to Copy 
        function fnUpdateDropdownsEditMode($CurrentPeriod){
            $.ajax({
                url: "{{route('dropDownMasters.getSelectedPeriod')}}",
                method: 'GET',
                data: {id:$CurrentPeriod},
                dataType: 'json',
                success: function(response) {                    
                    $('#periodId').html(response.SelectedItem);
                },
                cache: true
            })
        }
        // Active Period Dropdown in Edit Mode Ends
    });
    $(document).on('click', '.columnDefs', function(){
        return false;
        // alert($(this).attr('datacolumnDefs'));
    });
    // Madhav to Copy 
    function fnUpdateDropdownsAddMode(){
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

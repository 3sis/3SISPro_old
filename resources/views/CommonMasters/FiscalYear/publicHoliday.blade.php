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
                                    <th title="Calendar Id">CID</th>
                                    <th title="Calendar Desc">CDesc</th>
                                    <th title="Fiscal Year">FY</th>
                                    <th>Start Data</th>
                                    <th>End Date</th>
                                    <th>User</th>
                                    <th>Updated</th>
                                    <th>Action</th>
                                    <th style="visibility: hidden;">Unique Id</th>
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
                                                            <th title="Calendar Id">CID</th>
                                                            <th title="Calendar Desc">CDesc</th>
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
                                    method="post" action="{{ route('publicHoliday.postHeaderSubformData') }}">
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
                                                    <a class="nav-link" id="animated-underline-Browser-tab" data-toggle="tab" 
                                                    href="#animated-underline-Browser" role="tab" aria-controls="animated-underline-Browser" 
                                                    aria-selected="false">Hoiday Entry</a>
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
                                                            <input type="hidden" name='FYPHHUniqueId' id='FYPHHUniqueId' 
                                                                class='form-control'>
                                                            <input type="hidden" name='transactionMode' id='transactionMode' 
                                                                class='form-control'>
                                                        </div>
                                                        <div class="row mt-0">
                                                            <!-- Error Messages -->
                                                            <div class='col-md-9 alert alert-danger' id='errorMessageId2'>
                                                                <span id='detailEntryMessages2'></span>
                                                            </div>
                                                        </div>
                                                         <!-- Fiscal Year -->
                                                         <div class="row mt-0">
                                                            <div class="col-md-6">
                                                                <div class='form-group'>
                                                                    <label>Calendar Id</label>                                                
                                                                    <span class="error-text FYPHHCalendarId_error text-danger" 
                                                                        style='float:right;'></span>
                                                                    <select id='FYPHHCalendarId' name = 'FYPHHCalendarId' style='width: 100%;'>
                                                                        <option value='0'>-- Select Calendar Id  --</option>
                                                                    </select>                                                
                                                                </div> 
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class='form-group'>
                                                                    <label>Fiscal Year</label>                                                
                                                                    <span class="error-text FYPHHFiscalYearId_error text-danger" 
                                                                        style='float:right;'></span>
                                                                    <select id='FYPHHFiscalYearId' name = 'FYPHHFiscalYearId' style='width: 100%;'>
                                                                        <option value='0'>-- Select Fiscal Year  --</option>
                                                                    </select>                                                
                                                                </div> 
                                                            </div>
                                                        </div>
                                                        <!-- Start End Date -->
                                                        <div class="row mt-0">
                                                            <div class="col-md-6">
                                                                <div class='form-group'>                                                
                                                                    <label>FY Start Date</label> 
                                                                    <input type="date" name='FYFYHStartDate' id="FYFYHStartDate"
                                                                        class="form-control" readonly>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class='form-group'>                                                
                                                                    <label>FY End Date</label> 
                                                                    <input type="date" name='FYFYHEndDate' id="FYFYHEndDate" 
                                                                        class="form-control" style='opacity:1' readonly>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- Tab : Public Holiday Browser -->
                                                <div class="tab-pane fade" id="animated-underline-Browser" role="tabpanel" 
                                                    aria-labelledby="animated-underline-Browser-tab">
                                                        <!-- Error Messages -->
                                                        {{-- <div class='col-md-9 alert alert-danger' id='errorMessageId2'>
                                                            <span id='detailEntryMessages2'></span>
                                                        </div> --}}
                                                        <div style='float:right; padding-right:30px'>                                                    
                                                            <button type='button' name='add_LoanLine' id='add_Data_PublicHoliday' 
                                                                class='btn btnAddRec3SIS'>Add Public Holiday
                                                                <i class="fas fa-plus fa-sm ml-1"> </i>
                                                            </button>
                                                        </div>
                                                    <!-- Sub Form -->
                                                    <div class="table-responsive">
                                                        <table id="html5-SubForm3SIS1" class="table table-hover non-hover" style="width:100%">
                                                            <thead>
                                                                <tr>
                                                                    <th>Holiday Date</th>
                                                                    <th>Desc</th>
                                                                    <th>Action</th>
                                                                    <th style="visibility: hidden;">User</th>
                                                                    <th style="visibility: hidden;">Unique Id</th>
                                                                </tr>
                                                            </thead> 
                                                        </table>
                                                    </div>
                                                </div>
                                                <!-- User Info -->
                                                <div class="tab-pane fade" id="animated-underline-profile" role="tabpanel" 
                                                    aria-labelledby="animated-underline-profile-tab">
                                                    <div class="media">
                                                        <div class="media-body">
                                                            <div class="form-group">
                                                                <label> User</label>
                                                                <input type="text" name="FYPHHUser" id="FYPHHUser" 
                                                                class="form-control col-sm-6" readonly/>
                                                            </div>
                                                            <div class="form-group">
                                                                <label> Created Date</label>
                                                                <input type="date" name="FYPHHLastCreated" id="FYPHHLastCreated" 
                                                                class="form-control col-sm-6" readonly/>
                                                            </div>
                                                            <div class="form-group">
                                                                <label> Updated Date</label>
                                                                <input type="date" name="FYPHHLastUpdated" id="FYPHHLastUpdated" 
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
                                        method="post" action="{{ route('publicHoliday.postSubFormData') }}">
                                        <input type="hidden" name="_token" id="csrfTokenDetail" value="{{ csrf_token() }}">
                                    <!-- Modal Body -->
                                    <div class="modal-body">
                                        <div class="widget-content widget-content-area-detail3SIS animated-underline-content">
                                            <div class="container-fluid">
                                                <div class='form-group mb-0'>
                                                    <input type="hidden" name='FYPHDUniqueId' id='FYPHDUniqueId' class='form-control-detail3SIS'>
                                                    <input type="hidden" name='FYPHDUniqueIdH' id='FYPHDUniqueIdH' class='form-control-detail3SIS'>
                                                </div>
                                                <!-- Error Messages -->
                                                <div class='row mt-0' id='errorMessageId1'>
                                                    <div class='col-md-12 alert alert-danger'>
                                                        <span id='detailEntryMessages1'></span>
                                                    </div>
                                                </div>
                                                <!-- Fiscal Year -->
                                                <div class="row mt-0">
                                                    <div class="col-md-4">
                                                        <div class='form-group'>                                                
                                                            <label>Holiday Date</label> 
                                                            <span class="error-text FYPHDHolidayDate_error text-danger" 
                                                                style='float:right;'></span>
                                                            <input type="date" name='FYPHDHolidayDate' id="FYPHDHolidayDate"
                                                                class="form-control">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-8">
                                                        <div class='form-group'>                                                
                                                            <label>Description</label> 
                                                            <span class="error-text FYPHDDesc1_error text-danger" 
                                                                style='float:right;'></span>
                                                            <input type="text" name='FYPHDDesc1' id="FYPHDDesc1"  maxlength="100"
                                                                class="form-control few-options">
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
            $modalTitle = 'Public Holiday'
            $modalTitleDetailEntry1 = 'Public Holiday Detail' 

            $( "#FYPHHCalendarId" ).select2();
            $( "#FYPHHFiscalYearId" ).select2();    
            $('#html5-extension3SIS').DataTable( {
                dom: '<"row"<"col-md-12"<"row"<"col-md-6"B><"col-md-6"f> > ><"col-md-12"rt> \
                    <"col-md-12"<"row"<"col-md-5"i><"col-md-7"p>>> >',
                buttons: {
                buttons: [
                    { extend: 'copy', className: 'btn' },
                    { extend: 'csv', className: 'btn' },
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
                order: [[ 0, "asc" ],[ 2, "desc" ]],
                processing: true,
                serverSide: true,
                // CopyChange                    
                ajax: "{{ route('publicHoliday.browserData')}}",
                columns:[
                    // CopyChange
                    {data: "FYPHHCalendarId"},
                    {data: "FYCAHDesc1"},
                    {data: "FYPHHFiscalYearId"},
                    {data: "FYFYHStartDate"},
                    {data: "FYFYHEndDate"},
                    {data: "FYPHHUser"},
                    {data: "FYPHHLastUpdated"},
                    {data: "action", orderable:false, searchable: false},
                    {data: "FYPHHUniqueId", "visible": false},
                ],
            });
            // When add buttonis pushed
            $('#add_Data').click(function(){      
                $.ajax({
                    // CopyChange
                    url:"{{route('publicHoliday.deleteDetailsMemTables')}}",
                    mehtod:"GET",
                    success:function()
                    {
                        $('#html5-SubForm3SIS1').DataTable().ajax.reload();
                    }
                })
                $("#transactionMode").val('AddMode');
                fnHideErrorMsg()
                $("#animated-underline-selectLoan-tab").hide();
                fnReinstateFormControl('0');
                $("#animated-underline-home-tab").trigger('click');
                fnUpdateDropdownsAddMode();
                $('#html5-SubForm3SIS1').DataTable().ajax.reload();
                // fnLoadLoanSubForm();
            });  
            // When edit button is pushed on Landing Browser
            $(document).on('click', '.edit', function(){
                var id = $(this).attr('id');
                $.ajax({
                    // CopyChange
                    url: "{{route('publicHoliday.fetchData')}}",
                    method: 'GET',
                    data: {id:id},
                    dataType: 'json',
                    beforeSend: function(){
                        fnHideErrorMsg()
                    },
                    success: function(data)
                    {
                        $("#transactionMode").val('EditMode');
                        // Update Screen Variables
                        fnUpdateScreenVariables(data);
                        fnUpdateDropdownsEditMode(data);
                        // fnReinstateFormControl('1');
                        $titleSuffix = "<b style='color: #F5821F'>" + ' [ ' + data.FYPHHFiscalYearId + ' ]' + "</b>";                    
                        fnDataEntryFormHeader('1', 'Edit ', $titleSuffix);
                        $("#animated-underline-Browser-tab").show();
                        $("#animated-underline-home-tab").trigger('click'); 
                        $('#html5-SubForm3SIS1').DataTable().ajax.reload();
                    }
                });
            });
            // Edit Ends
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
                        $('#detailEntryMessages2').html('');
                    },
                    success:function(data)
                    {
                        if(data.status == 0)
                            {
                                if (data.ErrorOutput != '') {
                                    $('#errorMessageId2').show();                        
                                    $('#detailEntryMessages2').html(data.ErrorOutput); 
                                    $("#animated-underline-home-tab").trigger('click'); 
                                } 
                                $.each(data.error, function(prefix,val){
                                    $('span.' +prefix+ '_error').text(val[0]);
                                    $('#' +prefix).css('border-color', '#dc3545');
                                    $('#errorMessageId2').hide();                        
                                });
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
                    url: "{{route('publicHoliday.fetchData')}}",
                    method: 'GET',
                    data: {id:UniqueId},
                    dataType: 'json',
                    success: function(data)
                    {
                        $deleteMessage3SIS = fnSingleLevelDeleteConfirmation($modalTitle, data.FYPHHFiscalYearId, '');   
                        $('#DeleteRecord').html($deleteMessage3SIS);
                        $('#modalZoomDeleteRecord3SIS').modal('show');                   
                    }
                });
                // Fetch Record Ends
                // Delete record only when OK is pressed on Modal.
                $(document).on('click', '.confirm', function(){
                    $.ajax({
                        // CopyChange
                        url:"{{route('publicHoliday.deleteData')}}",
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
            // Loan Detail browser
            $('#html5-SubForm3SIS1').DataTable( {
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
                order: [ 3, "desc" ],
                processing: true,
                serverSide: true,
                autoWidth: false,
                destroy: true,            
                "ajax": "{{ route('publicHoliday.browserSubFormPublicHoliday')}}",
                "columns":[
                    {data: "FYPHDHolidayDate"},
                    {data: "FYPHDDesc1"},
                    {data: "action", orderable:false, searchable: false},
                    {data: "HolidayDateSort", "visible": false},
                    {data: "FYPHDUser", "visible": false},
                    {data: "FYPHDUniqueId", "visible": false},
                ],
            });
            // When Add button is pushed PublicHoliday      
            $('#add_Data_PublicHoliday').click(function(){
                var $FYPHHCalendarId = $('#FYPHHCalendarId').val();
                var $FYPHHFiscalYearId = $('#FYPHHFiscalYearId').val();
                var $transactionMode = $("#transactionMode").val();
                var $button_action_DetailEntry1 = 'insert';
                $.ajax({
                    url: "{{route('publicHoliday.dublicateCheckHeader')}}",
                    method: 'GET',
                    data: {FYPHHCalendarId: $FYPHHCalendarId, FYPHHFiscalYearId: $FYPHHFiscalYearId, 
                        transactionMode: $transactionMode, button_action_DetailEntry1 : $button_action_DetailEntry1 },
                    dataType: 'json',
                    success:function(data)
                    {
                        if(data.status == 0)
                        {
                            $("#animated-underline-home-tab").trigger('click');
                            // $.each(data.error, function(prefix,val){
                            //     $('span.' +prefix+ '_error').text(val[0]);
                            //     $('#' +prefix).css('border-color', '#dc3545');                            
                            // });
                            if (data.ErrorOutput != '') {
                                $('#errorMessageId2').show();                        
                                $('#detailEntryMessages2').html(data.ErrorOutput); 
                            }  
                        }else
                        { 
                            fnHideErrorMsg()
                            $('#detailEntryMessages1').html('');
                            $('#errorMessageId1').hide(); 
                            $('#detailEntryMessages2').html('');
                            $('#errorMessageId2').hide();
                            fnDetailEntryOnSubForm1('0', 'Add ', 'Edit ');
                        }
                    }
                })

            });
            // Add button PublicHoliday Ends*****
            // When Edit button is pushed PublicHoliday       
            $(document).on('click', '.edit_PublicHoliday', function(){      
                fnHideErrorMsg()      
                $('#detailEntryMessages1').html('');
                $('#errorMessageId1').hide();
                var uniqueId = $(this).attr('id');
                $.ajax({
                    // CopyChange
                    url: "{{route('publicHoliday.fetchSubFormData')}}",
                    method: 'GET',
                    data: {id:uniqueId},
                    dataType: 'json',
                    success: function(data)
                    {
                        // Update Screen Variables
                        fnUpdateScreenVariablesPublicHoliday(data);
                        // Update Dropdowns
                        fnDetailEntryOnSubForm1('1', 'Add ', 'Edit ');
                    }
                });
            });
            // Edit button PublicHoliday Ends*****
            // When Delet button is pushed :  Sub Form
            $(document).on('click', '.delete_PublicHoliday', function(){
                var UniqueId = $(this).attr('id');
                // Fetch Record first that need to be deleted.
                $.ajax({
                    url: "{{route('publicHoliday.fetchSubformDetailData')}}",
                    method: 'GET',
                    data: {id:UniqueId},
                    dataType: 'json',
                    beforeSend: function(){                 
                        $('#errorMessageSubformDetailId1').hide();
                    },
                    success: function(data) {
                        $deleteMessage3SIS = fnSingleLevelDeleteConfirmation($modalTitle, data.FYPHDHolidayDate, '');   
                        $('#DeleteRecord').html($deleteMessage3SIS);
                        $('#modalZoomDeleteRecord3SIS').modal('show');
                    }
                });
                // Fetch Record Ends
                // Delete record only when OK is pressed on Modal.
                $(document).on('click', '.confirm', function(){
                    $.ajax({
                        url:"{{route('publicHoliday.deleteSubFormDetail')}}",
                        mehtod:"GET",
                        data:{id:UniqueId},
                        success:function(data)
                        {
                            $('#html5-SubForm3SIS1').DataTable().ajax.reload();
                            UniqueId = 0;
                            $('#modalZoomDeleteRecord3SIS').modal('hide');
                        }
                    })
                });
                $("#modalZoomDeleteRecord3SIS").on("hide.bs.modal", function () {
                    UniqueId = 0;
                });                   
            }); 
             // When undo button is pushed
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
                "ajax": "{{ route('publicHoliday.browserDeletedRecords')}}",
                "columns":[
                    // CopyChange
                    {data: "FYPHHCalendarId"},
                    {data: "FYCAHDesc1"},
                    {data: "FYPHHFiscalYearId"},
                    {data: "FYFYHStartDate"},
                    {data: "FYFYHEndDate"},
                    {data: "action", orderable:false, searchable: false},
                    {data: "FYPHHUniqueId", "visible": false},
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
                    url: "{{route('publicHoliday.fetchData')}}",
                    method: 'GET',
                    data: {id:DeletedUniqueId},
                    dataType: 'json',
                    success: function(data)
                    {
                        $restoreMessage3SIS = fnSingleLevelRestoreConfirmation($modalTitle, data.FYPHHFiscalYearId, '');   
                        $('#RestoreRecord').html($restoreMessage3SIS);
                        $('#modalZoomRestoreRecord3SIS').modal('show');  
                        $('#modalZoomRestoreRecord3SIS').modal('hide');                    
                    }
                });
                // Fetch Record Ends
                // Restore record only when OK is pressed on Modal.
                $(document).on('click', '.confirmrestore', function(){
                    $.ajax({
                        url:"{{route('publicHoliday.restoreDeletedRecords')}}",
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
            // Update Screen Variables
            function fnUpdateScreenVariables(data) {
                var startDate = formattedDate(new Date(data.FYFYHStartDate));
                var endDate = formattedDate(new Date(data.FYFYHEndDate));
                var lastCreated = formattedDate(new Date(data.FYPHHLastCreated));
                var lastUpdated = formattedDate(new Date(data.FYPHHLastUpdated));
                $('#FYPHHUniqueId').val(data.FYPHHUniqueId);
                $('#FYPHHCalendarId').val(data.FYPHHCalendarId);
                $('#FYPHHFiscalYearId').val(data.FYPHHFiscalYearId);
                $('#FYFYHStartDate').val(startDate);
                $('#FYFYHEndDate').val(endDate);
                $('#FYPHHUser').val(data.FYPHHUser);
                $('#FYPHHLastCreated').val(lastCreated);
                $('#FYPHHLastUpdated').val(lastUpdated);
                fnGetFYStartAndEndDate(data.FYPHHFiscalYearId);
            }
            // Update Screen Variables Ends
            // Active Period Dropdown in Edit Mode
            function fnUpdateDropdownsEditMode(data){
                // Fiscal Year Dropdown
                var $FYPHHFiscalYearId = data.FYPHHFiscalYearId;
                $.ajax({
                    url: "{{route('dropDownMasters.getSelectedFiscalYear')}}",
                    method: 'GET',
                    data: {id:$FYPHHFiscalYearId},
                    dataType: 'json',
                    success: function(response) {
                        $('#FYPHHFiscalYearId').html(response.SelectedItem);
                    },
                    cache: true
                });
                // Calendar Master Dropdown
                var $FYPHHCalendarId = data.FYPHHCalendarId;
                $.ajax({
                    url: "{{route('dropDownMasters.getSelectedCalendar')}}",
                    method: 'GET',
                    data: {id:$FYPHHCalendarId},
                    dataType: 'json',
                    success: function(response) {
                        $('#FYPHHCalendarId').html(response.SelectedItem);
                    },
                    cache: true
                });

            }
            // Active Period Dropdown in Edit Mode Ends
       
            $('#FYPHHFiscalYearId').change(function(){
                fnShowTab();
                let id = $(this).val();
                fnGetFYStartAndEndDate(id);
            });
            function fnGetFYStartAndEndDate(id){
                $.ajax({
                    url: "{{route('publicHoliday.getFiscalYearDate')}}",
                    type:'post',
                    data:'id=' + id + '&_token={{csrf_token()}}',
                    success:function(response){
                        var $fYStartDate = formattedDate(new Date(response.startDate));
                        var $fYEndDate = formattedDate(new Date(response.endDate));
                        $('#FYFYHStartDate').val($fYStartDate);
                        $('#FYFYHEndDate').val($fYEndDate);
                    }
                })
            }
            function fnShowTab(){
                if ($('#FYPHHCalendarId').val()!='-- Select Calendar --' && $('#FYPHHFiscalYearId').val()!='-- Select Fiscal Year --') {
                    $("#animated-underline-Browser-tab").show();
                }
            }
        });  
        $('#twoLevelDataEntryForm1').on('submit', function(event){
            event.preventDefault();
            var formData = new FormData(this);
            formData.append('FYPHHUniqueId', $('#FYPHHUniqueId').val() );
            formData.append('FYPHHCalendarId', $('#FYPHHCalendarId').val() );
            formData.append('FYPHHFiscalYearId', $('#FYPHHFiscalYearId').val() );
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
                            $('#html5-SubForm3SIS1').DataTable().ajax.reload();
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
        function fnUpdateDropdownsAddMode(){
            // Fiscal Year Dropdown
            $.ajax({
                url: "{{route('dropDownMasters.getSelectedFiscalYear')}}",
                method: 'GET',
                data: {id:'00'},
                dataType: 'json',
                success: function(response) {
                    $('#FYPHHFiscalYearId').html(response.SelectedItem);
                },
                cache: true
            });
            // Calendar Master Dropdown
            $.ajax({
                url: "{{route('dropDownMasters.getSelectedCalendar')}}",
                method: 'GET',
                data: {id:'00'},
                dataType: 'json',
                success: function(response) {
                    $('#FYPHHCalendarId').html(response.SelectedItem);
                },
                cache: true
            });
        } 
        function fnHideErrorMsg(){
            $('#detailEntryMessages2').html('');
            $('#errorMessageId2').hide();
        }   
        $(document).on('click', '.columnDefs', function(){
            return false;
            // alert($(this).attr('datacolumnDefs'));
        });
        function fnUpdateScreenVariablesPublicHoliday(data){
            var holidayDate = formattedDate(new Date(data.FYPHDHolidayDate));
                
                $('#FYPHDUniqueId').val(data.FYPHDUniqueId);                       
                $('#FYPHDUniqueIdH').val(data.FYPHHUniqueId);                       
                $('#FYPHDHolidayDate').val(holidayDate);
                $('#FYPHDDesc1').val(data.FYPHDDesc1);
        }    
    </script>
@endsection

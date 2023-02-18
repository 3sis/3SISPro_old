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
                              
                                <th title="Calendar Id">CID</th>
                                <th title="Calendar Desc">CDesc</th>
                                <th title="Fiscal Year">FY</th>
                                <th>Start Data</th>
                                <th>End Date</th>
                                <th title=" Monday">Mon</th>
                                <th title=" Tuesday">Tue</th>
                                <th title=" Wednesday">Wed</th>
                                <th title=" Thursday">Thu</th>
                                <th title=" Friday">Fri</th>
                                <th title=" Saturday">Sat</th>
                                <th title=" Sunday">Sun</th>
                                                                   
                                <th>Action</th>
                                <th style="visibility: hidden;">User</th>
                                <th style="visibility: hidden;">Created</th>
                                <th style="visibility: hidden;">Updated</th>
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
                                                            <!-- <th>Company</th> -->
                                                            <th title="Calendar Id">Cal Id</th>
                                                            <th>Desc</th>
                                                            <th title="Fiscal Year">FY</th>
                                                            <th>Start Data</th>
                                                            <th>End Date</th>
                                                            <th>Desc</th>
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
                                    </line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                                </button>
                            </div>
                            
                            <form  id='singleLevelDataEntryForm' autocomplete="off"                                  
                                method="post" action="{{ route('weeklyOff.postHeaderSubformData') }}">
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
                                                aria-selected="false">Off Day</a>
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
                                                        <input type="hidden" name='FYWOHUniqueId' id='FYWOHUniqueId' 
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
                                                                <span class="error-text FYWOHCalendarId_error text-danger" 
                                                                    style='float:right;'></span>
                                                                <select id='FYWOHCalendarId' name = 'FYWOHCalendarId' style='width: 100%;'>
                                                                    <option value='0'>-- Select Calendar Id  --</option>
                                                                </select>                                                
                                                            </div> 
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class='form-group'>
                                                                <label>Fiscal Year</label>                                                
                                                                <span class="error-text FYWOHFiscalYearId_error text-danger" 
                                                                    style='float:right;'></span>
                                                                <select id='FYWOHFiscalYearId' name = 'FYWOHFiscalYearId' style='width: 100%;'>
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
                                                    <div class="row mt-0">
                                                        <div class="col-md-6">
                                                            <div class='form-group'>                                                
                                                                <label>Description</label> 
                                                                <span class="error-text FYWOHDesc1_error text-danger" 
                                                                    style='float:right;'></span>
                                                                <input type="text" name='FYWOHDesc1' id="FYWOHDesc1"  maxlength="100"
                                                                    class="form-control few-options">
                                                            </div>
                                                        </div>
                                                       
                                                    </div>                                                    
                                                </div>
                                            </div>
                                            <!-- Tab : Weekly Off Browser -->
                                            <div class="tab-pane fade" id="animated-underline-Browser" role="tabpanel" 
                                                aria-labelledby="animated-underline-Browser-tab">
                                                    
                                                    <div style='float:right; padding-right:30px'>                                                    
                                                        <button type='button' name='add_WeeklyOff' id='add_Data_WeeklyOff' 
                                                            class='btn btnAddRec3SIS'>Add Weekly Off
                                                            <i class="fas fa-plus fa-sm ml-1"> </i>
                                                        </button>
                                                    </div>
                                                <!-- Sub Form -->
                                                <div class="table-responsive">
                                                    <table id="html5-SubForm3SIS1" class="table table-hover non-hover" style="width:100%">
                                                        <thead>
                                                            <tr>
                                                                <th>DayId</th>
                                                                <th>Desc</th>
                                                                <th>All</th>
                                                                <th>First</th>
                                                                <th>Second</th>
                                                                <th>Third</th>
                                                                <th>Fourth</th>
                                                                <th>Fifth</th>
                                                                <th>Deleted</th>
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
                                                            <input type="text" name="FYWOHUser" id="FYWOHUser" 
                                                            class="form-control col-sm-6" readonly/>
                                                        </div>
                                                        <div class="form-group">
                                                            <label> Created Date</label>
                                                            <input type="date" name="FYWOHLastCreated" id="FYWOHLastCreated" 
                                                            class="form-control col-sm-6" readonly/>
                                                        </div>
                                                        <div class="form-group">
                                                            <label> Updated Date</label>
                                                            <input type="date" name="FYWOHLastUpdated" id="FYWOHLastUpdated" 
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
                                    method="post" action="{{ route('weeklyOff.postSubFormData') }}">
                                    <input type="hidden" name="_token" id="csrfTokenDetail" value="{{ csrf_token() }}">
                                <!-- Modal Body -->
                                <div class="modal-body">
                                    <div class="widget-content widget-content-area-detail3SIS animated-underline-content">
                                        <div class="container-fluid">
                                            <div class='form-group mb-0'>
                                                <input type="hidden" name='FYWODUniqueId' id='FYWODUniqueId' class='form-control-detail3SIS'>
                                                <input type="hidden" name='FYWODUniqueIdH' id='FYWODUniqueIdH' class='form-control-detail3SIS'>
                                            </div>
                                            <!-- Error Messages -->
                                            <div class='row mt-0' id='errorMessageId1'>
                                                <div class='col-md-12 alert alert-danger'>
                                                    <span id='detailEntryMessages1'></span>
                                                </div>
                                            </div>
                                             <!-- Fiscal Year -->
                                             <div class="row mt-0">
                                                <div class="col-md-6">
                                                    <div class='form-group' id='otApplicableId'>                                                
                                                        <!-- For defining select2 -->
                                                        <label>Day</label>                                                
                                                        <span class="error-text FYWODDayId_error text-danger" 
                                                            style='float:right;'></span>
                                                            <select id='FYWODDayId' name = 'FYWODDayId' style='width: 100%;'>
                                                                <option value=''>-- Select --</option>
                                                                <option value='1'>Monday</option>
                                                                <option value='2'>Tuesday</option>
                                                                <option value='3'>Wednesday</option>
                                                                <option value='4'>Thursday</option>
                                                                <option value='5'>Friday</option>
                                                                <option value='6'>Saturday</option>
                                                                <option value='7'>Sunday</option>
                                                            </select>                                                
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class='form-group'>                                                
                                                        <label>Description</label> 
                                                        <span class="error-text FYWODDesc1_error text-danger" 
                                                            style='float:right;'></span>
                                                        <input type="text" name='FYWODDesc1' id="FYWODDesc1"  maxlength="100"
                                                            class="form-control few-options">
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- Start End Date -->
                                            <div class="row mt-0">
                                                <div class="col-md-4 n-chk mt-4">
                                                    <label class="new-control new-checkbox new-checkbox-text checkbox-success">
                                                        <input type="checkbox" class="new-control-input" name='FYWODAll' id='FYWODAll'>
                                                        <span class="new-control-indicator"></span><span class="new-chk-content">All</span>
                                                    </label>
                                                </div>
                                                <div class="col-md-4 n-chk mt-4">
                                                    <label class="new-control new-checkbox new-checkbox-text checkbox-success">
                                                        <input type="checkbox" class="new-control-input" name='FYWODFirst' id='FYWODFirst'>
                                                        <span class="new-control-indicator"></span><span class="new-chk-content">First</span>
                                                    </label>
                                                </div>
                                                <div class="col-md-4 n-chk mt-4">
                                                    <label class="new-control new-checkbox new-checkbox-text checkbox-success">
                                                        <input type="checkbox" class="new-control-input" name='FYWODSecond' id='FYWODSecond'>
                                                        <span class="new-control-indicator"></span><span class="new-chk-content">Second</span>
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="row mt-0">
                                                <div class="col-md-4 n-chk mt-4">
                                                    <label class="new-control new-checkbox new-checkbox-text checkbox-success">
                                                        <input type="checkbox" class="new-control-input" name='FYWODThird' id='FYWODThird'>
                                                        <span class="new-control-indicator"></span><span class="new-chk-content">Third</span>
                                                    </label>
                                                </div>
                                                <div class="col-md-4 n-chk mt-4">
                                                    <label class="new-control new-checkbox new-checkbox-text checkbox-success">
                                                        <input type="checkbox" class="new-control-input" name='FYWODFourth' id='FYWODFourth'>
                                                        <span class="new-control-indicator"></span><span class="new-chk-content">Fourth</span>
                                                    </label>
                                                </div>
                                                <div class="col-md-4 n-chk mt-4">
                                                    <label class="new-control new-checkbox new-checkbox-text checkbox-success">
                                                        <input type="checkbox" class="new-control-input" name='FYWODFifth' id='FYWODFifth'>
                                                        <span class="new-control-indicator"></span><span class="new-chk-content">Fifth</span>
                                                    </label>
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
        $modalTitle = 'Weekly Off'
        $modalTitleDetailEntry1 = 'Weekly Off Detail' 
        // $("#animated-underline-Browser-tab").hide();
        $( "#FYWOHCalendarId" ).select2();
        $( "#FYWOHFiscalYearId" ).select2();
        $( "#FYWODDayId" ).select2();
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
            order: [[ 0, "asc" ],[ 2, "desc" ]],
            processing: true,
            serverSide: true,
            autoWidth: false,
            // CopyChange                    
            ajax: "{{ route('weeklyOff.browserData')}}",
            columns:[
                // CopyChange
                {data: "FYWOHCalendarId"},
                {data: "FYCAHDesc1"},
                {data: "FYWOHFiscalYearId"},
                {data: "FYFYHStartDate"},
                {data: "FYFYHEndDate"},
                {data: "FYWOHMonday"},
                {data: "FYWOHTuesday"},
                {data: "FYWOHWednesday"},
                {data: "FYWOHThursday"},
                {data: "FYWOHFriday"},
                {data: "FYWOHSaturday"},
                {data: "FYWOHSunday"},                    
                {data: "action", orderable:false, searchable: false},
                {data: "FYWOHUser", "visible": false},
                {data: "FYWOHLastUpdated", "visible": false},
                {data: "FYWOHLastCreated", "visible": false},
            ],
            columnDefs: [
                { "width": "5%", "targets": 0 },
                { "width": "10%", "targets": 1 },
                { "width": "5%", "targets": 2 },
                { "width": "10%", "targets": 3 },
                { "width": "10%", "targets": 4 },
                {
                    targets: 5,
                    width: "2%",
                    data: "FYWOHMonday",
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
                },
                {
                    targets: 6,
                    width: "2%",
                    data: "FYWOHTuesday",
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
                },
                {
                    targets: 7,
                    width: "2%",
                    data: "FYWOHWednesday",
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
                },
                {
                    targets: 8,
                    width: "2%",
                    data: "FYWOHThursday",
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
                },
                {
                    targets: 9,
                    width: "2%",
                    data: "FYWOHFriday",
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
                },
                {
                    targets: 10,
                    width: "2%",
                    data: "FYWOHSaturday",
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
                },
                {
                    targets: 11,
                    width: "2%",
                    data: "FYWOHSunday",
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
                }
            ],
        });
        // When add buttonis pushed
        $('#add_Data').click(function(){      
            $.ajax({
                // CopyChange
                url:"{{route('weeklyOff.deleteDetailsMemTables')}}",
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
        // Add Ends 
        // When edit button is pushed on Landing Browser
        $(document).on('click', '.edit', function(){
            var id = $(this).attr('id');
            $.ajax({
                // CopyChange
                url: "{{route('weeklyOff.fetchData')}}",
                method: 'GET',
                data: {id:id},
                dataType: 'json',
                beforeSend: function(){
                    fnHideErrorMsg()
                },
                success: function(data)
                {
                    // Update Screen Variables
                    $("#transactionMode").val('EditMode');
                    fnUpdateScreenVariables(data);
                    fnUpdateDropdownsEditMode(data);
                    // fnReinstateFormControl('1');
                    $titleSuffix = "<b style='color: #F5821F'>" + ' [ ' + data.FYWOHFiscalYearId + ' ]' + "</b>";                    
                    fnDataEntryFormHeader('1', 'Edit ', $titleSuffix);
                    $("#animated-underline-Browser-tab").show();
                    $("#animated-underline-home-tab").trigger('click'); 
                    $('#html5-SubForm3SIS1').DataTable().ajax.reload();
                    //  $today = new DateTime(); 
                    //  $today = $today->format(DateTime::RFC7231));
                    //  alert($today);
                    
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
                    $('#errorMessageId2').hide();                        
                },
                success:function(data)
                {
                    if(data.status == 0)
                        {
                            if (data.ErrorOutput != '' && data.error == '') {
                                $('#errorMessageId2').show();                        
                                $('#detailEntryMessages2').html(data.ErrorOutput); 
                                $("#animated-underline-home-tab").trigger('click'); 
                            }  
                            $.each(data.error, function(prefix,val){
                                $('#errorMessageId2').hide();                        
                                $('span.' +prefix+ '_error').text(val[0]);
                                $('#' +prefix).css('border-color', '#dc3545');                            
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
                url: "{{route('weeklyOff.fetchData')}}",
                method: 'GET',
                data: {id:UniqueId},
                dataType: 'json',
                success: function(data)
                {
                    $deleteMessage3SIS = fnSingleLevelDeleteConfirmation($modalTitle, data.FYWOHFiscalYearId, '');   
                    $('#DeleteRecord').html($deleteMessage3SIS);
                    $('#modalZoomDeleteRecord3SIS').modal('show');                   
                }
            });
            // Fetch Record Ends
            // Delete record only when OK is pressed on Modal.
            $(document).on('click', '.confirm', function(){
                $.ajax({
                    // CopyChange
                    url:"{{route('weeklyOff.deleteData')}}",
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
            order: [ 0, "desc" ],
            processing: true,
            serverSide: true,
            autoWidth: false,
            destroy: true,            
            "ajax": "{{ route('weeklyOff.browserSubFormWeeklyOff')}}",
            "columns":[
                {data: "FYWODDayId"},
                {data: "FYWODDesc1"},
                {data: "FYWODAll"},
                {data: "FYWODFirst"},
                {data: "FYWODSecond"},
                {data: "FYWODThird"},                
                {data: "FYWODFourth"},                
                {data: "FYWODFifth"},                
                {data: "FYWODMarkForDeletion"},                
                {data: "action", orderable:false, searchable: false},
                {data: "FYWODUser", "visible": false},
                {data: "FYWODUniqueId", "visible": false},
            ],
            columnDefs: [
                {
                    // Setting width of each column
                    width: "5%", "targets": 0,
                    width: "10%", "targets": 1,
                    
                    },
                    {
                        targets: 2,
                        width: "10%",
                        data: "FYWODAll",
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
                    },
                    {
                        targets: 3,
                        width: "10%",
                        data: "FYWODFirst",
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
                    },
                    {
                        targets: 4,
                        width: "10%",
                        data: "FYWODSecond",
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
                    },
                    {
                        targets: 5,
                        width: "10%",
                        data: "FYWODThird",
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
                    },
                    {
                        targets: 6,
                        width: "10%",
                        data: "FYWODFourth",
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
                    },
                    {
                        targets: 7,
                        width: "10%",
                        data: "FYWODFifth",
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
                    },
                    {
                        targets: 7,
                        width: "10%",
                        data: "FYWODFifth",
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
                    },
                    {
                    targets: 8,
                    data: "FYWODMarkForDeletion",
                    // searchable: false,
                    // orderable: false,
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
                }
            ],
        });
        // When Add button is pushed WeeklyOff      
        $('#add_Data_WeeklyOff').click(function(){
            var $FYWOHCalendarId = $('#FYWOHCalendarId').val();
            var $FYWOHFiscalYearId = $('#FYWOHFiscalYearId').val();
            var $button_action_DetailEntry1 = 'insert';
            var $transactionMode = $("#transactionMode").val();
            $.ajax({
                url: "{{route('weeklyOff.dublicateCheckHeader')}}",
                method: 'GET',
                data: {FYWOHCalendarId: $FYWOHCalendarId, FYWOHFiscalYearId: $FYWOHFiscalYearId,
                 transactionMode: $transactionMode, button_action_DetailEntry1 : $button_action_DetailEntry1 },
                dataType: 'json',
                success:function(data)
                {
                    if(data.status == 0)
                    {
                        $("#animated-underline-home-tab").trigger('click');
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
        // Add button WeeklyOff Ends*****
        // When Edit button is pushed WeeklyOff       
        $(document).on('click', '.edit_WeeklyOff', function(){      
            fnHideErrorMsg()      
            $('#detailEntryMessages1').html('');
            $('#errorMessageId1').hide();
            var uniqueId = $(this).attr('id');
            $.ajax({
                // CopyChange
                url: "{{route('weeklyOff.fetchSubFormData')}}",
                method: 'GET',
                data: {id:uniqueId},
                dataType: 'json',
                success: function(data)
                {
                    // Update Screen Variables
                    fnUpdateScreenVariablesWeeklyOff(data);
                    fnUpdateCheckBoxes(data);
                    // Update Dropdowns
                    fnDetailEntryOnSubForm1('1', 'Add ', 'Edit ');
                }
            });
        });
        // Edit button WeeklyOff Ends*****
        // When Delet button is pushed :  Sub Form
        $(document).on('click', '.delete_WeeklyOff', function(){
            var UniqueId = $(this).attr('id');
            // Fetch Record first that need to be deleted.
            $.ajax({
                url: "{{route('weeklyOff.fetchSubformDetailData')}}",
                method: 'GET',
                data: {id:UniqueId},
                dataType: 'json',
                beforeSend: function(){                 
                    $('#errorMessageSubformDetailId1').hide();
                },
                success: function(data) {
                    $deleteMessage3SIS = fnSingleLevelDeleteConfirmation($modalTitle, data.FYWODDayId, '');   
                    $('#DeleteRecord').html($deleteMessage3SIS);
                    $('#modalZoomDeleteRecord3SIS').modal('show');
                }
            });
            // Fetch Record Ends
            // Delete record only when OK is pressed on Modal.
            $(document).on('click', '.confirm', function(){
                $.ajax({
                    url:"{{route('weeklyOff.deleteSubFormDetail')}}",
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
            "ajax": "{{ route('weeklyOff.browserDeletedRecords')}}",
            "columns":[
                // CopyChange
                {data: "FYWOHCalendarId"},
                {data: "FYCAHDesc1"},
                {data: "FYWOHFiscalYearId"},
                {data: "FYFYHStartDate"},
                {data: "FYFYHEndDate"},
                {data: "FYWOHDesc1"},
                {data: "action", orderable:false, searchable: false},
                {data: "FYWOHUniqueId", "visible": false},
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
                url: "{{route('weeklyOff.fetchData')}}",
                method: 'GET',
                data: {id:DeletedUniqueId},
                dataType: 'json',
                success: function(data)
                {
                    $restoreMessage3SIS = fnSingleLevelRestoreConfirmation($modalTitle, data.FYWOHFiscalYearId, '');   
                    $('#RestoreRecord').html($restoreMessage3SIS);
                    $('#modalZoomRestoreRecord3SIS').modal('show');  
                    $('#modalZoomRestoreRecord3SIS').modal('hide');                    
                }
            });
            // Fetch Record Ends
            // Restore record only when OK is pressed on Modal.
            $(document).on('click', '.confirmrestore', function(){
                $.ajax({
                    url:"{{route('weeklyOff.restoreDeletedRecords')}}",
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
            var lastCreated = formattedDate(new Date(data.FYWOHLastCreated));
            var lastUpdated = formattedDate(new Date(data.FYWOHLastUpdated));
            $('#FYWOHUniqueId').val(data.FYWOHUniqueId);
            $('#FYWOHCalendarId').val(data.FYWOHCalendarId);
            $('#FYWOHFiscalYearId').val(data.FYWOHFiscalYearId);
            $('#FYFYHStartDate').val(startDate);
            $('#FYFYHEndDate').val(endDate);
            $("#FYWOHDesc1").val(data.FYWOHDesc1);
            $('#FYWOHUser').val(data.FYWOHUser);
            $('#FYWOHLastCreated').val(lastCreated);
            $('#FYWOHLastUpdated').val(lastUpdated);
            fnGetFYStartAndEndDate(data.FYWOHFiscalYearId);
        }
        // Update Screen Variables Ends
        // Active Period Dropdown in Edit Mode
        function fnUpdateDropdownsEditMode(data){
            // Fiscal Year Dropdown
            var $FYWOHFiscalYearId = data.FYWOHFiscalYearId;
            $.ajax({
                url: "{{route('dropDownMasters.getSelectedFiscalYear')}}",
                method: 'GET',
                data: {id:$FYWOHFiscalYearId},
                dataType: 'json',
                success: function(response) {
                    $('#FYWOHFiscalYearId').html(response.SelectedItem);
                },
                cache: true
            });
            // Calendar Master Dropdown
            var $FYWOHCalendarId = data.FYWOHCalendarId;
            $.ajax({
                url: "{{route('dropDownMasters.getSelectedCalendar')}}",
                method: 'GET',
                data: {id:$FYWOHCalendarId},
                dataType: 'json',
                success: function(response) {
                    $('#FYWOHCalendarId').html(response.SelectedItem);
                },
                cache: true
            });

        }
        // Active Period Dropdown in Edit Mode Ends
        $('#FYWOHFiscalYearId').change(function(){
            fnShowTab();
            let id = $(this).val();
            fnGetFYStartAndEndDate(id);
        });

        $('#FYWODDayId').change(function(){
            fnUpdateDayIdDesc();
        });
        // Update Checkboxes
        function fnUpdateCheckBoxes(data) {
            //All
            if(data.FYWODAll == 1)
            {
                    $("#FYWODAll").prop("checked", true);
                }else{
                    $("#FYWODAll").prop("checked", false);
            }
            //First
            if(data.FYWODFirst == 1)
            {
                    $("#FYWODFirst").prop("checked", true);
                }else{
                    $("#FYWODFirst").prop("checked", false);
            }
            //Second
            if(data.FYWODSecond == 1)
            {
                    $("#FYWODSecond").prop("checked", true);
                }else{
                    $("#FYWODSecond").prop("checked", false);
            }
            //Third
            if(data.FYWODThird == 1)
            {
                    $("#FYWODThird").prop("checked", true);
                }else{
                    $("#FYWODThird").prop("checked", false);
            }
            //Fourth
            if(data.FYWODFourth == 1)
            {
                    $("#FYWODFourth").prop("checked", true);
                }else{
                    $("#FYWODFourth").prop("checked", false);
            }
            //Fifth
            if(data.FYWODFifth == 1)
            {
                    $("#FYWODFifth").prop("checked", true);
                }else{
                    $("#FYWODFifth").prop("checked", false);
            }
           
        } 
        // Update Checkboxes Ends
        function fnShowTab(){
            if ($('#FYWOHCalendarId').val()!='-- Select Calendar --' && $('#FYWOHFiscalYearId').val()!='-- Select Fiscal Year --') {
                $("#animated-underline-Browser-tab").show();
            }
        }
        function fnGetFYStartAndEndDate(id){
            $.ajax({
                url: "{{route('weeklyOff.getFiscalYearDate')}}",
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
    });
    $(document).on('click', '.columnDefs', function(){
        return false;
        // alert($(this).attr('datacolumnDefs'));
    });
    function fnConvertCheckBoxes() {
        if($('#FYWODAll').prop('checked')==true) {
                $('#FYWODAll').val(1);
            }else {
                $('#FYWODAll').val(0);
            }
        if($('#FYWODFirst').prop('checked')==true) {
                $('#FYWODFirst').val(1);
            }else {
                $('#FYWODFirst').val(0);
            }
        if($('#FYWODSecond').prop('checked')==true) {
                $('#FYWODSecond').val(1);
            }else {
                $('#FYWODSecond').val(0);
            }
        if($('#FYWODThird').prop('checked')==true) {
                $('#FYWODThird').val(1);
            }else {
                $('#FYWODThird').val(0);
            }
        if($('#FYWODFourth').prop('checked')==true) {
                $('#FYWODFourth').val(1);
            }else {
                $('#FYWODFourth').val(0);
            }
        if($('#FYWODFifth').prop('checked')==true) {
                $('#FYWODFifth').val(1);
            }else {
                $('#FYWODFifth').val(0);
            }
    }
    $('#twoLevelDataEntryForm1').on('submit', function(event){
        fnConvertCheckBoxes();        
        // $FYWOHUniqueId = $('#FYWOHUniqueId').val();           
        // $FYWOHCalendarId = $('#FYWOHCalendarId').val();           
        // $FYWOHFiscalYearId = $('#FYWOHFiscalYearId').val();           
        event.preventDefault();
        var formData = new FormData(this);
        formData.append('FYWOHUniqueId', $('#FYWOHUniqueId').val() );
        formData.append('FYWOHCalendarId', $('#FYWOHCalendarId').val() );
        formData.append('FYWOHFiscalYearId', $('#FYWOHFiscalYearId').val() );
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
                $('#FYWOHFiscalYearId').html(response.SelectedItem);
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
                $('#FYWOHCalendarId').html(response.SelectedItem);
            },
            cache: true
        });
    }
    function fnHideErrorMsg(){
        $('#detailEntryMessages2').html('');
        $('#errorMessageId2').hide();
    }
    function fnUpdateScreenVariablesWeeklyOff(data){
            
            $('#FYWODUniqueId').val(data.FYWODUniqueId);                       
            $('#FYWODUniqueIdH').val(data.FYWOHUniqueId);                       
            $('#FYWODDayId').val(data.FYWODDayId);
            $('#FYWODDesc1').val(data.FYWODDesc1);
            $('#FYWODAll').val(data.FYWODAll);
            $('#FYWODFirst').val(data.FYWODFirst);
            $('#FYWODSecond').val(data.FYWODSecond);
            $('#FYWODThird').val(data.FYWODThird);
            $('#FYWODFifth').val(data.FYWODFifth);
            $('#FYWODBiDesc').val(data.FYWODBiDesc);
    }
    function fnUpdateDayIdDesc() {
        var $DayId = $( "#FYWODDayId" ).val();
        var $Desc = $( "#FYWODDesc1" ).val();
        if ($DayId==7 && $Desc=="" ) {
            $( "#FYWODDesc1" ).val('Weekly off on Sunday')
        } 
        if ($DayId==1 && $Desc=="" ) {
            $( "#FYWODDesc1" ).val('Weekly off on Monday')
        } 
        if ($DayId==2 && $Desc=="" ) {
            $( "#FYWODDesc1" ).val('Weekly off on Thusday')
        } 
        if ($DayId==3 && $Desc=="" ) {
            $( "#FYWODDesc1" ).val('Weekly off on Wednesday')
        } 
        if ($DayId==4 && $Desc=="" ) {
            $( "#FYWODDesc1" ).val('Weekly off on Thursday')
        } 
        if ($DayId==5 && $Desc=="" ) {
            $( "#FYWODDesc1" ).val('Weekly off on Friday')
        } 
        if ($DayId==6 && $Desc=="" ) {
            $( "#FYWODDesc1" ).val('Weekly off on Satraday')
        } 

    }
</script>

@endsection

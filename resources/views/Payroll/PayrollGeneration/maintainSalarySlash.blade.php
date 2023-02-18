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
                                <th>Location</th>  
                                <th>From Date</th>
                                <th>To Date</th>
                                <th>User</th>
                                <th>Action</th>
                                <th style="visibility: hidden;">Unique Id</th>

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
                            <form  id='singleLevelDataEntryForm' autocomplete="off">
                                <!-- Modal Body -->
                                <div class="modal-body">
                                    <div class="widget-content widget-content-area animated-underline-content">
                                        <div class="tab-content" id="animateLineContent-4">
                                            <div style='float:right; padding-right:30px'>                                                    
                                                <button type='button' name='add_Income' id='add_Data_Income' 
                                                    class='btn btnAddRec3SIS'>Add Income
                                                    <i class="fas fa-plus fa-sm ml-1"> </i>
                                                </button>
                                            </div>
                                            <!-- Sub Form -->
                                            <div class="table-responsive">
                                                <table id="html5-salarySlashSubform3SIS" class="table table-hover non-hover" style="width:100%">
                                                    <thead>
                                                        <tr>                                                            
                                                            <th title="Income Id">Id</th>
                                                            <th>Desc</th>
                                                            <th title="Gross Income">Gross Income</th>
                                                            <th title="Fix Or Percent">F/P</th>
                                                            <th>%</th>
                                                            <th title="Gross Payment">Gross Payment</th>
                                                            <th title="Effective From">From</th>
                                                            <th title="Effective To">To</th>
                                                            <th>Deleted</th>
                                                            <th>Action</th>
                                                            <th style="visibility: hidden;">User</th>
                                                            <th style="visibility: hidden;">Unique Id</th>
                                                        </tr>
                                                    </thead> 
                                                </table>
                                            </div>
                                        </div>
                                    </div>
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
                                    method="post" action="{{ route('salarySlash.postSubFormDataIncome') }}">
                                    <input type="hidden" name="_token" id="csrfTokenDetail" value="{{ csrf_token() }}">
                                    <input type="hidden" name='PGSSDEmployeeId' id='PGSSDEmployeeId' class='form-control-detail3SIS'>
                                    <input type="hidden" name='PGSSDLocationId' id='PGSSDLocationId' class='form-control-detail3SIS'>
                                <!-- Modal Body -->
                                <div class="modal-body">
                                    <div class="widget-content widget-content-area-detail3SIS animated-underline-content">
                                        <div class="container-fluid">
                                            <div class='form-group mb-0'>
                                            <input type="hidden" name='PGSSDUniqueId' id='PGSSDUniqueId' class='form-control-detail3SIS'>
                                            <!-- <input type="hidden" name='PGSSDEmployeeId' id='PGSSDEmployeeId' class='form-control-detail3SIS'>
                                            <input type="hidden" name='PGSSDLocationId' id='PGSSDLocationId' class='form-control-detail3SIS'> -->
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
                                                        <span class="error-text PGSSDIncDedId_error text-danger" 
                                                                    style='float:right;'></span>
                                                        <select id='PGSSDIncDedId' name = 'PGSSDIncDedId' style='width: 100%;'>
                                                            <option value=''>-- Income Type --</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class='form-group'>                                                
                                                        <label>Effective From</label>
                                                        <span class="error-text PGSSDFromDate_error text-danger" 
                                                            style='float:right;'></span>
                                                        <input type="date" name='PGSSDFromDate' id="PGSSDFromDate"
                                                            class="form-control">
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class='form-group'>                                                
                                                        <label>Effective To</label>
                                                        <span class="error-text PGSSDToDate_error text-danger" 
                                                            style='float:right;'></span>
                                                        <input type="date" name='PGSSDToDate' id="PGSSDToDate"
                                                            class="form-control" value="9999-12-31">
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- Percent -->
                                            <div class="row mt-0">
                                                <div class="col-md-4">
                                                    <div class='form-group'>                                                
                                                        <label>Gross Income</label> 
                                                        <span class="error-text PGSSDGrossAmount_error text-danger" 
                                                            style='float:right;'></span>
                                                        <input type="number" name='PGSSDGrossAmount' id='PGSSDGrossAmount' 
                                                            class='form-control' step='any' style='opacity:1' value='0.00' step='any'>
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <div class='form-group'>                                                
                                                        <label>Fix Or %</label> 
                                                        <span class="error-text PGSSDIncomeFixOrPercent_error text-danger" 
                                                            style='float:right;'></span>
                                                        <input type="text" name='PGSSDIncomeFixOrPercent' id='PGSSDIncomeFixOrPercent' 
                                                            class='form-control' step='any' style='opacity:1'>
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <div class='form-group'>                                                
                                                        <label>Slash %</label> 
                                                        <span class="error-text PGSSDIncomePaymentPercent_error text-danger" 
                                                            style='float:right;'></span>
                                                        <input type="number" name='PGSSDIncomePaymentPercent' id='PGSSDIncomePaymentPercent' 
                                                            class='form-control' step='any' style='opacity:1' value='0.00' step='any'>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class='form-group'>                                                
                                                        <label>Gross Payment</label> 
                                                        <span class="error-text PGSSDGrossPayment_error text-danger" 
                                                            style='float:right;'></span>
                                                        <input type="number" name='PGSSDGrossPayment' id='PGSSDGrossPayment' 
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
                @include('commonViews3SIS.modalCommon3SIS')
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function(){
        $('#errorMessageId').hide();
        $modalTitle = 'Salary Slash'
        $modalTitleDetailEntry1 = 'Employee Incomes ' 
        $("#PGSSDIncDedId").select2();
        
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
            "ajax": "{{ route('salarySlash.browserHeadData')}}",
            "columns":[                    
                {data: "PGSSHEmployeeId"},
                {data: "EMGIHFullName"},
                {data: "GMLMHDesc1"},                
                {data: "PGSSHFromDate"},                
                {data: "PGSSHToDate"},                
                {data: "action", orderable:false, searchable: false},
                {data: "PGSSHUniqueId", "visible": false}, 
            ],
            "columnDefs": [
                { "width": "10%", "targets": 0 },
                { "width": "20%", "targets": 1 },
                { "width": "10%", "targets": 2 },
                { "width": "20%", "targets": 3 },
                { "width": "10%", "targets": 4 },
                { "width": "20%", "targets": 5 },
            ]        
        });
        // When Add button is pushed        
        $('#add_Data').click(function(){
            $('#detailEntryMessages').html('');
            $('#errorMessageId').hide();
            // fnDetailEntryOnSubForm1('0', 'Add ', 'Edit ');

            fnReinstateFormControl('0');
            fnUpdateDropdownsAddMode();

        });
        // Add button Ends*****
        // When edit button is pushed on Landing Browser
        $(document).on('click', '.editHeader', function(){
            var $Id = $(this).attr('id');
            fnUpdateScreenVariablesHeader($Id);
            fnSalarySlashSubform($Id);
            var currentRow = $(this).closest("tr");
            $EMGIHFullName = currentRow.find("td:eq(1)").text();
            $titleSuffix = "<b style='color: #F5821F'>" + ' [ ' + $EMGIHFullName + ' ]' + "</b>";                    
            fnDataEntryFormHeader('1', 'Edit ', $titleSuffix);
            // fnReinstateFormControl('1');
        });
        // Edit Ends
         // When Add button is pushed        
         $('#add_Data_Income').click(function(){
            $('#detailEntryMessages1').html('');
            $('#errorMessageId1').hide();
            fnDetailEntryOnSubForm1('0', 'Add ', 'Edit ');
            
            fnMakeFieldsEditable();
            // All Dropdowns
            fnIncomeTypeDropdownsAddMode()

        });
        // Add button Income Ends*****
        // When Edit button is pushed        
        $(document).on('click', '.editDetail', function(){ 
            $('#detailEntryMessages1').html('');
            $('#errorMessageId1').hide();
            var uniqueId = $(this).attr('id');

            $.ajax({
                // CopyChange
                url: "{{route('salarySlash.fetchSubFormDataIncome')}}",
                method: 'GET',
                data: {id:uniqueId},
                dataType: 'json',
                success: function(data)
                {
                    fnMakeFieldsReadOnly(data);
                    // Update Screen Variables
                    fnUpdateScreenVariablesIncome(data);
                    // Update Dropdowns
                    fnDropdownsEditMode(data.PGSSDIncDedId);
                    // fnReinstateFormControl('1');
                    fnDetailEntryOnSubForm1('1', 'Add ', 'Edit ');

                }
            });
        });
        // Edit button Income Ends*****
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
                        fnSalarySlashSubform(data.EmpId);
                        $('#detailEntryModal1').modal('hide');
                        $('#modalZoomFinalSave3SIS').modal('show');
                    }
                    
                }
            })
        });
        // When submit button Income is pushed Ends*****
        // When delete button is pushed
        $(document).on('click', '.deleteDetail', function(){
            var UniqueId = $(this).attr('id');
            // Delete Mem Record : Income
            $.ajax({
                    // CopyChange
                    url:"{{route('salarySlash.deleteSalarySlashDetail')}}",
                    mehtod:"get",
                    data:{id:UniqueId},
                    success:function(data)
                    {
                        fnSalarySlashSubform($('#PGSSDEmployeeId').val());
                        UniqueId = 0;
                    }
            })
            // Delete Mem Record : Income Ends
        }); 
        // Sub Form Events - Income Ends*****
        function fnIncomeTypeDropdownsAddMode(){
            $.ajax({
                url: "{{route('dropDownMasters.getSelectedIncomeTypes')}}",
                method: 'GET',
                data: {id:'00'},
                dataType: 'json',
                success: function(response) {
                    $('#PGSSDIncDedId').html(response.SelectedItem);
                },
                cache: true
            })
        }
       
    });
    function fnSalarySlashSubform($Id) {
        $('#html5-salarySlashSubform3SIS').DataTable( {
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
            "ajax": {
                "url": "{{ route('salarySlash.browserDetailData')}}",
                "type": "GET",
                "data": function ( d ) {
                    d.PGSSHEmployeeId = $Id;
                    
                }
            },
            "columns":[                    
                {data: "PGSSDIncDedId"},
                {data: "PGSSDDesc1"},
                {data: "PGSSDGrossAmount"},                
                {data: "PGSSDIncomeFixOrPercent"},                
                {data: "PGSSDIncomePaymentPercent"},                
                {data: "PGSSDGrossPayment"},                
                {data: "PGSSDFromDate"},                
                {data: "PGSSDToDate"},                
                {data: "PGSSDMarkForDeletion"},                
                {data: "action", orderable:false, searchable: false},
                {data: "PGSSDUniqueId", "visible": false}, 
            ],
            columnDefs: [{
                width: "10%", "targets": 0 ,
                width: "10%", "targets": 1 ,
                width: "10%", "targets": 2 ,
                width: "5%", "targets": 3 ,
                width: "10%", "targets": 4,
                width: "10%", "targets": 5,
                width: "10%", "targets": 6,
                width: "10%", "targets": 7,
                width: "5%", "targets": 8 ,
                width: "20%", "targets": 9,
                "targets": 8,
                data:   "PGSSDMarkForDeletion",
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
    }
    function fnDropdownsEditMode($PGSSDIncDedId){
        $.ajax({
            url: "{{route('dropDownMasters.getSelectedIncomeTypes')}}",
            method: 'GET',
            data: {id:$PGSSDIncDedId},
            dataType: 'json',
            success: function(response) {                    
                $('#PGSSDIncDedId').html(response.SelectedItem);
            },
            cache: true
        })
    }
    function fnUpdateScreenVariablesHeader(data){
                         
        $('#PGSSDEmployeeId').val(data);
        // $('#PGSSDLocationId').val(data.PGSSHLocationId);

    }
    function fnUpdateScreenVariablesIncome(data){
        var effectiveFrom   = formattedDate(new Date(data.PGSSDFromDate));
        var effectiveTo     = formattedDate(new Date(data.PGSSDToDate));
        $('#PGSSDUniqueId').val(data.PGSSDUniqueId);                       
        $('#PGSSDEmployeeId').val(data.PGSSDEmployeeId);
        $('#PGSSDLocationId').val(data.PGSSDLocationId);
        $('#PGSSDIncDedId').val(data.PGSSDIncDedId);
        $('#PGSSDDesc1').val(data.PGSSDDesc1);
        $('#PGSSDGrossAmount').val(data.PGSSDGrossAmount);
        $('#PGSSDIncomeFixOrPercent').val(data.PGSSDIncomeFixOrPercent);
        $('#PGSSDIncomePaymentPercent').val(data.PGSSDIncomePaymentPercent);
        $('#PGSSDGrossPayment').val(data.PGSSDGrossPayment);

        $('#PGSSDFromDate').val(effectiveFrom);
        $('#PGSSDToDate').val(effectiveTo);
    }
    function fnMakeFieldsReadOnly(data){
        $("#PGSSDGrossAmount").attr("readonly", true);
        $("#PGSSDToDate").attr("readonly", true);
        $("#PGSSDFromDate").attr("readonly", true);
    }
    function fnMakeFieldsEditable(){
        $("#PGSSDGrossAmount").attr("readonly", false);
        $("#PGSSDToDate").attr("readonly", false);
        $("#PGSSDFromDate").attr("readonly", false);
    }

</script>
@endsection


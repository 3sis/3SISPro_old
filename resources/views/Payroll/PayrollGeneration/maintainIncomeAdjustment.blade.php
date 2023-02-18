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
                                                    class='btn btnAddRec3SIS'>Add Deduction
                                                    <i class="fas fa-plus fa-sm ml-1"> </i>
                                                </button>
                                            </div>
                                            <!-- Sub Form -->
                                            <div class="table-responsive">
                                                <table id="html5-DeductionAdjustmentSubform3SIS" class="table table-hover non-hover" style="width:100%">
                                                    <thead>
                                                        <tr>                                                            
                                                            <th title="Income Id">Id</th>
                                                            <th>Desc</th>
                                                            <th title="Gross Deduction">Gross Deduction</th>
                                                            <th title="Net Deduction">Net Deduction</th>
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
                                    method="post" action="{{ route('incomeAdjustment.postSubFormDataDeduction') }}">
                                    <input type="hidden" name="_token" id="csrfTokenDetail" value="{{ csrf_token() }}">
                                    <input type="hidden" name='PGDADEmployeeId' id='PGDADEmployeeId' class='form-control-detail3SIS'>
                                    <input type="hidden" name='PGDADLocationId' id='PGDADLocationId' class='form-control-detail3SIS'>
                                <!-- Modal Body -->
                                <div class="modal-body">
                                    <div class="widget-content widget-content-area-detail3SIS animated-underline-content">
                                        <div class="container-fluid">
                                            <div class='form-group mb-0'>
                                            <input type="hidden" name='PGDADUniqueId' id='PGDADUniqueId' class='form-control-detail3SIS'>
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
                                                        <label>Deduction Id</label>
                                                        <span class="error-text PGDADIncDedId_error text-danger" 
                                                                    style='float:right;'></span>
                                                        <select id='PGDADIncDedId' name = 'PGDADIncDedId' style='width: 100%;'>
                                                            <option value=''>-- Deduction Type --</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class='form-group'>                                                
                                                        <label>Effective From</label>
                                                        <span class="error-text PGDADFromDate_error text-danger" 
                                                            style='float:right;'></span>
                                                        <input type="date" name='PGDADFromDate' id="PGDADFromDate"
                                                            class="form-control">
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class='form-group'>                                                
                                                        <label>Effective To</label>
                                                        <span class="error-text PGDADToDate_error text-danger" 
                                                            style='float:right;'></span>
                                                        <input type="date" name='PGDADToDate' id="PGDADToDate"
                                                            class="form-control" value="9999-12-31">
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- Percent -->
                                            <div class="row mt-0">
                                                <div class="col-md-4">
                                                    <div class='form-group'>                                                
                                                        <label>Gross Deduction</label> 
                                                        <span class="error-text PGDADGrossDeduction_error text-danger" 
                                                            style='float:right;'></span>
                                                        <input type="number" name='PGDADGrossDeduction' id='PGDADGrossDeduction' 
                                                            class='form-control' step='any' style='opacity:1' value='0.00' step='any'>
                                                    </div>
                                                </div>
                                                
                                                <div class="col-md-4">
                                                    <div class='form-group'>                                                
                                                        <label>Net Deduction</label> 
                                                        <span class="error-text PGDADNetDeduction_error text-danger" 
                                                            style='float:right;'></span>
                                                        <input type="number" name='PGDADNetDeduction' id='PGDADNetDeduction' 
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
        $modalTitle = 'Deduction Adjustment'
        $modalTitleDetailEntry1 = 'Employee Deduction ' 
        $("#PGDADIncDedId").select2();
        
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
            "ajax": "{{ route('incomeAdjustment.browserHeadData')}}",
            "columns":[                    
                {data: "PGDAHEmployeeId"},
                {data: "EMGIHFullName"},
                {data: "GMLMHDesc1"},                
                {data: "PGDAHFromDate"},                
                {data: "PGDAHToDate"},                
                {data: "action", orderable:false, searchable: false},
                {data: "PGDAHUniqueId", "visible": false}, 
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
            fnDeductionAdjustmentSubform($Id);
            var currentRow = $(this).closest("tr");
            $EMGIHFullName = currentRow.find("td:eq(1)").text();
            $titleSuffix = "<b style='color: #F5821F'>" + ' [ ' + $EMGIHFullName + ' ]' + "</b>";                    
            fnDataEntryFormHeader('1', 'Edit ', $titleSuffix);
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
                url: "{{route('incomeAdjustment.fetchSubFormDataDeduction')}}",
                method: 'GET',
                data: {id:uniqueId},
                dataType: 'json',
                success: function(data)
                {
                    fnMakeFieldsReadOnly(data);
                    // Update Screen Variables
                    fnUpdateScreenVariablesIncome(data);
                    // Update Dropdowns
                    fnDropdownsEditMode(data.PGDADIncDedId);
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
                        fnDeductionAdjustmentSubform(data.EmpId);
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
            alert($('#PGDADEmployeeId').val());
            // Delete Mem Record : Income
            $.ajax({
                    // CopyChange
                    url:"{{route('incomeAdjustment.deleteDeductionAdjustmentDetail')}}",
                    mehtod:"get",
                    data:{id:UniqueId},
                    success:function(data)
                    {
                        fnDeductionAdjustmentSubform($('#PGDADEmployeeId').val());
                        UniqueId = 0;
                    }
            })
            // Delete Mem Record : Income Ends
        }); 
        // Sub Form Events - Income Ends*****
        function fnIncomeTypeDropdownsAddMode(){
            $.ajax({
                url: "{{route('dropDownMasters.getSelectedDeductionTypes')}}",
                method: 'GET',
                data: {id:'00'},
                dataType: 'json',
                success: function(response) {
                    $('#PGDADIncDedId').html(response.SelectedItem);
                },
                cache: true
            })
        }
       
    });
    function fnDeductionAdjustmentSubform($Id) {
        $('#html5-DeductionAdjustmentSubform3SIS').DataTable( {
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
                "url": "{{ route('incomeAdjustment.browserDetailData')}}",
                "type": "GET",
                "data": function ( d ) {
                    d.PGDAHEmployeeId = $Id;
                    
                }
            },
            "columns":[                    
                {data: "PGDADIncDedId"},
                {data: "PGDADDesc1"},
                {data: "PGDADGrossDeduction"},                
                {data: "PGDADNetDeduction"},                
                {data: "PGDADFromDate"},                
                {data: "PGDADToDate"},                
                {data: "PGDADMarkForDeletion"},                
                {data: "action", orderable:false, searchable: false},
                {data: "PGDADUniqueId", "visible": false}, 
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
                "targets": 6,
                data:   "PGDADMarkForDeletion",
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
    function fnDropdownsEditMode($PGDADIncDedId){
        $.ajax({
            url: "{{route('dropDownMasters.getSelectedDeductionTypes')}}",
            method: 'GET',
            data: {id:$PGDADIncDedId},
            dataType: 'json',
            success: function(response) {                    
                $('#PGDADIncDedId').html(response.SelectedItem);
            },
            cache: true
        })
    }
    function fnUpdateScreenVariablesHeader(data){
                         
        $('#PGDADEmployeeId').val(data);
        // $('#PGDADLocationId').val(data.PGDAHLocationId);

    }
    function fnUpdateScreenVariablesIncome(data){
        var effectiveFrom   = formattedDate(new Date(data.PGDADFromDate));
        var effectiveTo     = formattedDate(new Date(data.PGDADToDate));
        $('#PGDADUniqueId').val(data.PGDADUniqueId);                       
        $('#PGDADEmployeeId').val(data.PGDADEmployeeId);
        $('#PGDADLocationId').val(data.PGDADLocationId);
        $('#PGDADIncDedId').val(data.PGDADIncDedId);
        $('#PGDADDesc1').val(data.PGDADDesc1);
        $('#PGDADGrossDeduction').val(data.PGDADGrossDeduction);
        $('#PGDADNetDeduction').val(data.PGDADNetDeduction);

        $('#PGDADFromDate').val(effectiveFrom);
        $('#PGDADToDate').val(effectiveTo);
    }
    function fnMakeFieldsReadOnly(data){
        $("#PGDADGrossDeduction").attr("readonly", true);
        $("#PGDADToDate").attr("readonly", true);
        $("#PGDADFromDate").attr("readonly", true);
    }
    function fnMakeFieldsEditable(){
        $("#PGDADGrossDeduction").attr("readonly", false);
        $("#PGDADToDate").attr("readonly", false);
        $("#PGDADFromDate").attr("readonly", false);
    }

</script>
@endsection


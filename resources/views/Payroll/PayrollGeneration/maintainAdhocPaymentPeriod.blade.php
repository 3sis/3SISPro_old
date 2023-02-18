@extends('layouts.app')

@section('content')
<div class="layout-px-spacing">
    <div>
        <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
            <div class=" br-6">
                <div style='float:right; padding-right:30px'>
                </div>
                <div style='float:right; padding-right:30px'>                                                    
                    <button type='button' name='add_Income' id='add_Data_Income' 
                        class='btn btnAddRec3SIS'>Add Income
                        <i class="fas fa-plus fa-sm ml-1"> </i>
                    </button>
                </div>
                <!-- Landing Page browser -->
                <div class="table-responsive">
                    <table id="html5-extension3SIS" class="table table-hover non-hover" style="width:100%">
                        <thead>
                            <tr>
                                <th title="Fiscal Year">FY</th>
                                <th title="Period Id">P</th>
                                <th title="Employee Name">Emp</th>
                                <th title="Location">Location</th>
                                <th title="Income Id">Id</th>
                                <th>Desc</th>
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
                                    method="post" action="{{ route('adhocPaymentPeriod.postSubFormDataIncome') }}">
                                    <input type="hidden" name="_token" id="csrfTokenDetail" value="{{ csrf_token() }}">
                                    <!-- <input type="hidden" name='PGAIDEmployeeId' id='PGAIDEmployeeId' class='form-control-detail3SIS'> -->
                                    <input type="hidden" name='PGAIDLocationId' id='PGAIDLocationId' class='form-control-detail3SIS'>
                                <!-- Modal Body -->
                                <div class="modal-body">
                                    <div class="widget-content widget-content-area-detail3SIS animated-underline-content">
                                        <div class="container-fluid">
                                            <div class='form-group mb-0'>
                                            <input type="hidden" name='PGAIDUniqueId' id='PGAIDUniqueId' class='form-control-detail3SIS'>
                                            <input type="hidden" name='PGAIDPeriodId' id="PGAIDPeriodId" class="form-control">
                                            <input type="hidden" name='PGAIDLocationId' id='PGAIDLocationId' class='form-control-detail3SIS'>
                                            </div>
                                            <!-- Error Messages -->
                                            <div class='row mt-0' id='errorMessageId1'>
                                                <div class='col-md-12 alert alert-danger'>
                                                    <span id='detailEntryMessages1'></span>
                                                </div> 
                                            </div>
                                            <div class="row mt-0">
                                                <div class="col-md-2">
                                                    <div class='form-group'>                                                
                                                        <label title="Fiscal Year">FY</label>
                                                        <input type="text" name='PGAIDFiscalYear' id="PGAIDFiscalYear"
                                                            class="form-control" readonly>
                                                    </div>                                               
                                                </div>
                                                <div class="col-md-2">
                                                    <div class='form-group'>                                                
                                                        <label title="Current Period">Period</label>
                                                        <input type="Text" name='FYFYHCurrentPeriodDesc' id="FYFYHCurrentPeriodDesc"
                                                        class="form-control" readonly>
                                                    </div>                                               
                                                </div>
                                                <div class="col-md-4">
                                                    <div class='form-group'>                                                
                                                        <label>Employee Id</label>
                                                        <span class="error-text PGAIDEmployeeId_error text-danger" 
                                                                    style='float:right;'></span>
                                                        <select id='PGAIDEmployeeId' name = 'PGAIDEmployeeId' style='width: 100%;'>
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
                                            </div>
                                            
                                            <!-- Id, Desc1, Percent -->
                                            <div class="row mt-0">
                                                <div class="col-md-4">
                                                    <div class='form-group'>                                                
                                                        <label>Income Id</label>
                                                        <span class="error-text PGAIDIncDedId_error text-danger" 
                                                                    style='float:right;'></span>
                                                        <select id='PGAIDIncDedId' name = 'PGAIDIncDedId' style='width: 100%;'>
                                                            <option value=''>-- Income Type --</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class='form-group'>                                                
                                                        <label>Effective From</label>
                                                        <span class="error-text PGAIDFromDate_error text-danger" 
                                                            style='float:right;'></span>
                                                        <input type="date" name='PGAIDFromDate' id="PGAIDFromDate"
                                                            class="form-control">
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class='form-group'>                                                
                                                        <label>Effective To</label>
                                                        <span class="error-text PGAIDToDate_error text-danger" 
                                                            style='float:right;'></span>
                                                        <input type="date" name='PGAIDToDate' id="PGAIDToDate"
                                                            class="form-control" value="9999-12-31">
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- Percent -->
                                            <div class="row mt-0">
                                                <!-- <div class="col-md-4">
                                                    <div class='form-group'>                                                
                                                        <label>Gross Income</label> 
                                                        <span class="error-text PGAIDGrossAmount_error text-danger" 
                                                            style='float:right;'></span>
                                                        <input type="number" name='PGAIDGrossAmount' id='PGAIDGrossAmount' 
                                                            class='form-control' step='any' style='opacity:1' value='0.00' step='any'>
                                                    </div>
                                                </div> -->
                                                <div class="col-md-4">
                                                    <div class='form-group'>                                                
                                                        <label>Gross Payment</label> 
                                                        <span class="error-text PGAIDGrossPayment_error text-danger" 
                                                            style='float:right;'></span>
                                                        <input type="number" name='PGAIDGrossPayment' id='PGAIDGrossPayment' 
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
        $modalTitle = 'Adhoc Payment'
        $modalTitleDetailEntry1 = 'Employee Incomes ' 
        $("#PGAIDEmployeeId").select2();
        $("#PGAIDIncDedId").select2();
        
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
            "ajax": "{{ route('adhocPaymentPeriod.browserDetailData')}}",
            "columns":[                    
                {data: "PGAIDFiscalYear"},
                {data: "PGAIDPeriodId"},
                {data: "EMGIHFullName"},
                {data: "GMLMHDesc1"},
                {data: "PGAIDIncDedId"},
                {data: "PGAIDDesc1"},
                {data: "PGAIDGrossPayment"},                
                {data: "PGAIDFromDate"},                
                {data: "PGAIDToDate"},                
                {data: "PGAIDMarkForDeletion"},                
                {data: "action", orderable:false, searchable: false},
                {data: "PGAIDUniqueId", "visible": false}, 
                {data: "PGAIDEmployeeId", "visible": false}, 
            ],
            columnDefs: [{
                width: "5%", "targets": 0 ,
                width: "5%", "targets": 1 ,
                width: "10%", "targets": 2 ,
                width: "10%", "targets": 3 ,
                width: "10%", "targets": 4,
                width: "10%", "targets": 5,
                width: "10%", "targets": 6,
                width: "10%", "targets": 7,
                width: "10%", "targets": 8,
                width: "2%", "targets": 9,
                width: "10%", "targets": 10,
                "targets": 9,
                data:   "PGAIDMarkForDeletion",
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
        $('#add_Data_Income').click(function(){
            $('#detailEntryMessages1').html('');
            $('#errorMessageId1').hide();
            fnDetailEntryOnSubForm1('0', 'Add ', 'Edit ');
            fnMakeFieldsEditable();
            fnGetFiscalYearDetail();
            // All Dropdowns
            fnUpdateDropdownsAddMode()
        });
        // Add button Income Ends*****
        // When Edit button is pushed        
        $(document).on('click', '.editDetail', function(){ 
            $('#detailEntryMessages1').html('');
            $('#errorMessageId1').hide();
            var uniqueId = $(this).attr('id');

            $.ajax({
                // CopyChange
                url: "{{route('adhocPaymentPeriod.fetchSubFormDataIncome')}}",
                method: 'GET',
                data: {id:uniqueId},
                dataType: 'json',
                success: function(data)
                {
                    fnMakeFieldsReadOnly(data);
                    // Update Screen Variables
                    fnUpdateScreenVariablesIncome(data);
                    // Update Dropdowns
                    fnDropdownsEditMode(data);
                    // fnReinstateFormControl('1');
                    fnDetailEntryOnSubForm1('1', 'Add ', 'Edit ');

                }
            });
        });
        // Edit button Income Ends*****
        $('#PGAIDEmployeeId').change(function(){
            let id = $(this).val();
            $.ajax({
                url: "{{route('dropDownMasters.getLocation')}}",
                type:'post',
                data:'id=' + id + '&_token={{csrf_token()}}',
                success:function(response){
                    $('#PGAIDLocationId').val(response.locationId);
                    $('#locationDesc').val(response.locationDesc);
                    
                }
            })
            $.ajax({
                url: "{{route('dropDownMasters.getSelectedIncomeTypeApartFromEarning')}}",
                method: 'GET',
                data: {id:'00', empId:id},
                dataType: 'json',
                success: function(response) {
                    $('#PGAIDIncDedId').html(response.SelectedItem);
                },
                cache: true
            })
        });
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
                        $('#html5-extension3SIS').DataTable().ajax.reload();
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
                    url:"{{route('adhocPaymentPeriod.deleteAdhocPaymentPeriod')}}",
                    mehtod:"get",
                    data:{id:UniqueId},
                    success:function(data)
                    {
                        $('#html5-extension3SIS').DataTable().ajax.reload();
                        UniqueId = 0;
                    }
            })
            // Delete Mem Record : Income Ends
        }); 
        // Sub Form Events - Income Ends*****
        function fnUpdateDropdownsAddMode(){
            $.ajax({
                url: "{{route('dropDownMasters.getSelectedEmployee')}}",
                method: 'GET',
                data: {id:'00'},
                dataType: 'json',
                success: function(response) {
                    $('#PGAIDEmployeeId').html(response.SelectedItem);
                },
                cache: true
            })
            // $.ajax({
            //     url: "{{route('dropDownMasters.getSelectedIncomeTypeApartFromEarning')}}",
            //     method: 'GET',
            //     data: {id:'00', empId:$("#PGAIDEmployeeId").val()},
            //     dataType: 'json',
            //     success: function(response) {
            //         $('#PGAIDIncDedId').html(response.SelectedItem);
            //     },
            //     cache: true
            // })
        };
    });
    function fnDropdownsEditMode(data){
        var $PGAIDEmployeeId = data.PGAIDEmployeeId;
        $.ajax({
            url: "{{route('dropDownMasters.getSelectedEmployee')}}",
            method: 'GET',
            data: {id:$PGAIDEmployeeId},
            dataType: 'json',
            success: function(response) {
                $('#PGAIDEmployeeId').html(response.SelectedItem);
            },
            cache: true
        });
        var $PGAIDIncDedId = data.PGAIDIncDedId;
        $.ajax({
            url: "{{route('dropDownMasters.getSelectedIncomeTypeApartFromEarning')}}",
            method: 'GET',
            data: {id:$PGAIDIncDedId, empId:$PGAIDEmployeeId},
            dataType: 'json',
            success: function(response) {                    
                $('#PGAIDIncDedId').html(response.SelectedItem);
            },
            cache: true
        })
    }
    function fnUpdateScreenVariablesHeader(data){
                         
        $('#PGAIDEmployeeId').val(data);
        // $('#PGAIDLocationId').val(data.PGSSHLocationId);

    }
    function fnUpdateScreenVariablesIncome(data){
        var effectiveFrom   = formattedDate(new Date(data.PGAIDFromDate));
        var effectiveTo     = formattedDate(new Date(data.PGAIDToDate));
        $('#PGAIDUniqueId').val(data.PGAIDUniqueId);                       
        $('#PGAIDFiscalYear').val(data.PGAIDFiscalYear);
        $('#PGAIDPeriodId').val(data.PGAIDPeriodId);
        $('#FYFYHCurrentPeriodDesc').val(data.FYFYHCurrentPeriodDesc);
        $('#PGAIDEmployeeId').val(data.PGAIDEmployeeId);
        $('#PGAIDLocationId').val(data.PGAIDLocationId);
        $('#locationDesc').val(data.locationDesc);
        $('#PGAIDIncDedId').val(data.PGAIDIncDedId);
        $('#PGAIDDesc1').val(data.PGAIDDesc1);
        $('#PGAIDGrossAmount').val(data.PGAIDGrossAmount);
        $('#PGAIDGrossPayment').val(data.PGAIDGrossPayment);

        $('#PGAIDFromDate').val(effectiveFrom);
        $('#PGAIDToDate').val(effectiveTo);
    }
    function fnMakeFieldsReadOnly(data){
        $("#PGAIDGrossAmount").attr("readonly", true);
        $("#PGAIDToDate").attr("readonly", true);
        $("#PGAIDFromDate").attr("readonly", true);
    }
    function fnMakeFieldsEditable(){
        $("#PGAIDGrossAmount").attr("readonly", false);
        $("#PGAIDToDate").attr("readonly", false);
        $("#PGAIDFromDate").attr("readonly", false);
    }
    function fnGetFiscalYearDetail(){
        $.ajax({
            url: "{{route('dropDownMasters.getActiveFiscalYearParameater')}}",
            method: 'GET',
            dataType: 'json',
            success: function(response) {
                $('#PGAIDFiscalYear').val(response.FYFYHFiscalYearId);
                $('#PGAIDPeriodId').val(response.FYFYHCurrentPeriod);
                $('#FYFYHCurrentPeriodDesc').val(response.FYFYHCurrentPeriodDesc);
            },
            cache: true
        });
    }
</script>
@endsection


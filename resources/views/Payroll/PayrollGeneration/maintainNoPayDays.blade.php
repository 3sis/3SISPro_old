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
                            <form  id='MainLandingForm' autocomplete="off"
                                                method="post" action="{{ route('noPayDays.postData') }}">
                                                <input type="hidden" name="_token" id="csrfTokenDetail" value="{{ csrf_token() }}">
                                <ul class="nav nav-tabs mb-3" id="animateLine" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" id="animated-underline-periodInfo-tab" data-toggle="tab" 
                                        href="#animated-underline-periodInfo" role="tab" aria-controls="animated-underline-periodInfo" a
                                        ria-selected="true">Period Info</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="animated-underline-noPayDays-tab" data-toggle="tab" 
                                        href="#animated-underline-noPayDays" role="tab" aria-controls="animated-underline-noPayDays" 
                                        aria-selected="false">No Pay Days Detail</a>
                                    </li>
                                </ul>
                                <div class="tab-content" id="animateLineContent-4">
                                    <div class="tab-pane fade show active" id="animated-underline-periodInfo" role="tabpanel" 
                                        aria-labelledby="animated-underline-periodInfo-tab">
                                        <div class="container-fluid">
                                            <input type="hidden" name='TotalNoOfDays' id="TotalNoOfDays" class="form-control">
                                            <div class="row mt-0">
                                                <div class="col-md-4">
                                                    <div class='form-group'>                                                
                                                        <label>Fiscal Year</label>
                                                        <input type="text" name='PGADHFiscalYearId' id="PGADHFiscalYearId"
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
                                                        <label>Period</label>                                                
                                                        <span class="error-text PGADHPeriodId_error text-danger" 
                                                            style='float:right;'></span>
                                                        <select id='PGADHPeriodId' name = 'PGADHPeriodId' style='width: 100%;'>
                                                            <option value='0'>-- Select Period --</option>                                                                
                                                        </select> 
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
                                                    <button type='button' name='Load' id='Load_NoPay_Data' 
                                                            class='btn btn-primary'>Load NoPay Days
                                                        </button>
                                                </div>
                                                
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="animated-underline-noPayDays" role="tabpanel" 
                                        aria-labelledby="animated-underline-noPayDays-tab">
                                        <div class="col-xl-12 col-lg-12 col-sm-12 layout-spacing">
                                            <div class="br-6">
                                                <div style='float:right; padding-right:30px'>                                                    
                                                    <button type='button' name='add' id='add_Data' class='btn btnAddRec3SIS'>Add
                                                        <i class="fas fa-plus fa-sm ml-1"> </i>
                                                    </button>
                                                    </button>
                                                </div>
                                                <div class="table-responsive">
                                                    <table id="html5-extension3SIS" class="table table-hover non-hover" style="width:100%">
                                                        <thead>
                                                            <tr>
                                                                <th>Id</th>
                                                                <th>Employee Name</th>
                                                                <th>Location Id</th>
                                                                <th>Location</th>
                                                                <th>Total Days</th>
                                                                <th>No Pay Days</th>
                                                                <th>Paid Days</th>
                                                            </tr>
                                                        </thead> 
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>                      
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Header Level Data Entry -->
        <div id="entryModalSmall" class="modal fade UpdateModalBox3SIS" data-backdrop="static" 
            data-keyboard="false" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered 3SISPro-modal-dialog modal-lg" role="document">
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
                            method="POST" action="{{ route('noPayDays.postHeaderFormData') }}">
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
                                        <a class="nav-link" id="animated-underline-profile-tab" data-toggle="tab" 
                                        href="#animated-underline-profile" role="tab" aria-controls="animated-underline-profile" 
                                        aria-selected="false">Record Info</a>
                                    </li>
                                </ul>
                                <!-- Error Messages -->
                                <div class='row mt-0' id='errorMessageId'>
                                    <div class='col-md-12 alert alert-danger'>
                                        <span id='detailEntryMessages'></span>
                                    </div>
                                </div>
                                <div class="tab-content" id="animateLineContent-4">
                                    <!-- Tab : Main Entry -->
                                    <div class="tab-pane fade show active" id="animated-underline-home" role="tabpanel" 
                                        aria-labelledby="animated-underline-home-tab">
                                        <div class="container-fluid">
                                            <div class='form-group mb-0'>
                                                <input type="hidden" name='PGADHUniqueId' id='PGADHUniqueId' class='form-control'>
                                                <input type="hidden" name='PGADHLocationId' id='PGADHLocationId' class='form-control'>
                                            </div>
                                            <!-- Name -->
                                            <div class="row mt-0">
                                                <div class="col-md-6">
                                                    <div class='form-group'>                                                
                                                        <label>Employee Id</label>
                                                        <span class="error-text PGADHEmployeeId_error text-danger" 
                                                                    style='float:right;'></span>
                                                        <select id='PGADHEmployeeId' name = 'PGADHEmployeeId' style='width: 100%;'>
                                                            <option value='0'>-- Employee Id --</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class='form-group'>                                                
                                                        <label>Location</label>
                                                        <input type="text" name='locationDesc' id="locationDesc" maxlength="100" placeholder=""
                                                        class="form-control few-options" readonly>
                                                    </div>
                                                </div>
                                               
                                            </div>
                                            <!-- Location -->
                                            <div class="row mt-0">                                                        
                                                <div class="col-md-4">
                                                    <div class='form-group'>                                                
                                                        <label>Total Days</label>
                                                        <span class="error-text PGADHTotalDays_error text-danger" 
                                                        style='float:right;'></span>
                                                        <input type="number" name='PGADHTotalDays' id='PGADHTotalDays' 
                                                        class='form-control floatNumberField' step='any' placeholder="Total Days" style='opacity:1' value='0' readonly>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class='form-group'>                                                
                                                        <label>No Pay Days</label>
                                                        <input type="number" name='PGADHNoPayDays' id='PGADHNoPayDays' 
                                                        class='form-control floatNumberField' step='any' placeholder="No Pay Days" style='opacity:1' value='0'>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class='form-group'>                                                
                                                        <label>Paid Days</label>
                                                        <span class="error-text PGADHPaidDays_error text-danger" 
                                                        style='float:right;'></span>
                                                        <input type="number" name='PGADHPaidDays' id='PGADHPaidDays' 
                                                        class='form-control' step='any' placeholder="Paid Days" style='opacity:1' value='0' readonly>
                                                    </div>
                                                </div>
                                            </div>
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
                            <input type="submit" name='submit' id='action' value='save' 
                                class='btn btn-outline-success mb-2'>
                        </div>

                    </form>
                </div>
            </div>
    
        </div>
     <!-- Header Level Data Entry Ends**********-->
        @include('commonViews3SIS.modalCommon3SIS')
    </div>
<script>
    $(document).ready(function(){
        $('#errorMessageId').hide();
        $modalTitle = 'No Pay Days'
        $( "#PGADHPeriodId" ).select2();
        $( "#PGADHEmployeeId" ).select2();
        fnGetFiscalYearDetail();
        $("#animated-underline-noPayDays-tab").hide();
        fnUpdateDropdowns();
        $('#PGADHPeriodId').change(function(){
                fnShowTab();
                let FiscalYearId = $('#PGADHFiscalYearId').val();
                let periodId = $(this).val();
                fnGetPeriodStartAndEndDate(periodId,FiscalYearId);
            });
        
        
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
            "ajax": {
                "url": "{{ route('noPayDays.loadSubForm')}}",
                "type": "GET",
                "data": function ( d ) {
                    d.PGADHFiscalYearId = $('#PGADHFiscalYearId').val();
                    d.PGADHPeriodId = $('#PGADHPeriodId').val();
                }
            },

            // "ajax": "{{ route('noPayDays.loadSubForm')}}",        
            "columns":[                    
                {data: "PGADHEmployeeId"},
                {data: "EMGIHFullName"},
                {data: "PGADHLocationId"},                
                {data: "GMLMHDesc1"},                
                {data: "PGADHTotalDays"},                
                {data: "PGADHNoPayDays"},                
                {data: "PGADHPaidDays"},   
                {data: "action", orderable:false, searchable: false},
                {data: "PGADHUniqueId", "visible": false}, 
            ],


            // 'PGADHEmployeeId',
            //     'PGADHFullName',
            //     'PGADHLocationId',
            //     'PGADHLocationDesc',
            //     'PGADHTotalDays',
            //     'PGADHNoPayDays',
            //     'PGADHPaidDays',
            
            "columnDefs": [
                { "width": "10%", "targets": 0 },
                { "width": "20%", "targets": 1 },
                { "width": "10%", "targets": 2 },
                { "width": "20%", "targets": 3 },
                { "width": "10%", "targets": 4 },
                { "width": "10%", "targets": 5 },
                { "width": "20%", "targets": 6 },
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
         $(document).on('click', '.edit', function(){

            $('#detailEntryMessages').html('');
            $('#errorMessageId').hide();
            var uniqueId = $(this).attr('id');
            $.ajax({
                // CopyChange
                url: "{{route('noPayDays.fetchData')}}",
                method: 'GET',
                data: {id:uniqueId},
                dataType: 'json',
                success: function(data)
                {
                    // Update Screen Variables
                    fnUpdateScreenVariables(data);
                    // Update Dropdowns
                    fnUpdateDropdownsEditMode(data);
                    fnReinstateFormControl('1');
                }
            });
                    // fnReinstateFormControl('1');
                    // $("#animated-underline-home-tab").trigger('click'); 
                   
        });
        // Edit Ends
         // When delete button is pushed
         $(document).on('click', '.delete', function(){
            var UniqueId = $(this).attr('id');
            // Fetch Record first that need to be deleted.
            $.ajax({
                url: "{{route('noPayDays.fetchData')}}",
                method: 'GET',
                data: {id:UniqueId},
                dataType: 'json',
                success: function(data)
                {
                    $deleteMessage3SIS = fnSingleLevelDeleteConfirmation($modalTitle, data.PGADHEmployeeId);   
                    $('#DeleteRecord').html($deleteMessage3SIS);
                    $('#modalZoomDeleteRecord3SIS').modal('show');                   
                }
            });
            // Delete record only when OK is pressed on Modal.
            $(document).on('click', '.confirm', function(){
                $.ajax({
                    url:"{{route('noPayDays.deleteData')}}",
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
        function fnUpdateDropdownsAddMode(){
            $.ajax({
                url: "{{route('dropDownMasters.getSelectedEmployee')}}",
                method: 'GET',
                data: {id:'00'},
                dataType: 'json',
                success: function(response) {
                    $('#PGADHEmployeeId').html(response.SelectedItem);
                },
                cache: true
            })
        };
        $('#PGADHEmployeeId').change(function(){
            let id = $(this).val();
            $.ajax({
                url: "{{route('dropDownMasters.getLocation')}}",
                type:'post',
                data:'id=' + id + '&_token={{csrf_token()}}',
                success:function(response){
                    $('#PGADHLocationId').val(response.locationId);
                    $('#locationDesc').val(response.locationDesc);
                    $('#PGADHTotalDays').val(31);
                }
            })
        });
        $('#PGADHNoPayDays').change(function(){
            $('#PGADHPaidDays').val(parseInt($('#PGADHTotalDays').val()) - parseInt($('#PGADHNoPayDays').val()))
        });
        // When Final Submit button is pushed to save header and details
        $('#singleLevelDataEntryForm').on('submit', function(event){   

            $PGADHFiscalYearId = $('#PGADHFiscalYearId').val();           
            $PGADHPeriodId = $('#PGADHPeriodId').val();           
            event.preventDefault();
            var formData = new FormData(this);
            formData.append('PGADHFiscalYearId', $PGADHFiscalYearId );
            formData.append('PGADHPeriodId', $PGADHPeriodId );
            $.ajax({
                url: $(this).attr('action'),
                method: $(this).attr('method'),
                data: formData,
                processData: false,
                dataType: "json",
                cache: false,
                contentType: false,
                beforeSend: function(){
                    $(document).find('span.error-text').text('');
                    $('#errorMessageId').hide();

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
                                $('#errorMessageId').show();                        
                                $('#detailEntryMessages').html(data.ErrorOutput); 
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
    });
    function fnUpdateDropdownsEditMode(data){
        //GetSelectedEmployee
        var $EmployeeId = data.PGADHEmployeeId;
        $.ajax({
            url: "{{route('dropDownMasters.getSelectedEmployee')}}",
            method: 'GET',
            data: {id:$EmployeeId},
            dataType: 'json',
            success: function(response) {
                $('#PGADHEmployeeId').html(response.SelectedItem);
            },
            cache: true
        });
        $.ajax({
                url: "{{route('dropDownMasters.getLocation')}}",
                type:'post',
                data:'id=' + $EmployeeId + '&_token={{csrf_token()}}',
                success:function(response){
                    $('#PGADHLocationId').val(response.locationId);
                    $('#locationDesc').val(response.locationDesc);
                }
            })
    }
    // When Add button is pushed        
    $('#Load_NoPay_Data').click(function(){
        $("#animated-underline-noPayDays-tab").show();
        $('#html5-extension3SIS').DataTable().ajax.reload();
        $("#animated-underline-noPayDays-tab").trigger('click');
    });
    $('#MainLandingForm').on('submit', function(event){
        $FiscalYearId = $('#PGADHFiscalYearId').val();           
        $CurrentPeriod = $('#PGADHPeriodId').val();           
        event.preventDefault();
        var formData = new FormData(this);
        formData.append('PGADHFiscalYearId', $FiscalYearId );
        formData.append('PGADHPeriodId', $CurrentPeriod );

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
                $('#html5-extension3SIS').DataTable().ajax.reload();
                $("#animated-underline-periodInfo-tab").trigger('click'); 
                $("#animated-underline-noPayDays-tab").hide();
                $finalMessage3SIS = fnSingleLevelFinalSave(data.masterName, data.Id, data.Desc1, data.updateMode);
                $('#FinalSaveMessage').html($finalMessage3SIS); 
                $('#modalZoomFinalSave3SIS').modal('show');

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
                
                $('#PGADHFiscalYearId').val(response.FYFYHFiscalYearId);
                $('#FYFYHStartDate').val($fYStartDate);
                $('#FYFYHEndDate').val($fYEndDate);
                $('#PGADHPeriodId').val(response.FYFYHCurrentPeriod);
                $('#FYFYHPeriodStartDate').val($periodStartDate);
                $('#FYFYHPeriodEndDate').val($periodEndDate);
                // $('#TotalNoOfDays').val($Days);
                var $CurrentPeriod = response.FYFYHCurrentPeriod;
                fnUpdateDropdownsEditMode($CurrentPeriod);
            },
            cache: true
        });
        function fnUpdateDropdownsEditMode($CurrentPeriod){
            $.ajax({
                url: "{{route('dropDownMasters.getPeriodDropDown')}}",
                method: 'GET',
                data: {id:$CurrentPeriod},
                dataType: 'json',
                success: function(response) {          
                    $('#PGADHPeriodId').html(response.SelectedItem);
                },
                cache: true
            })
        }
    }
    function fnShowTab(){
            if ($('#PGADHPeriodId').val()!='-- Select Active Period --' && $('#PGADHFiscalYearId').val()!='-- Select Fiscal Year --') {
                $("#animated-underline-Browser-tab").show();
            }
        }
    function fnGetPeriodStartAndEndDate(periodId,FiscalYearId){
            $.ajax({
                url: "{{route('dropDownMasters.getFiscalYearPeriodDate')}}",
                type:'post',
                data:'periodId=' + periodId + '&FiscalYearId=' + FiscalYearId + '&_token={{csrf_token()}}',
                success:function(response){
                    var $periodStartDate = formattedDate(new Date(response.startDate));
                    var $periodEndDate = formattedDate(new Date(response.endDate));
                    $('#FYFYHPeriodStartDate').val($periodStartDate);
                    $('#FYFYHPeriodEndDate').val($periodEndDate);
                }
            })
        }
    function fnUpdateDropdowns(){
        $.ajax({
            url: "{{route('dropDownMasters.getPeriodDropDown')}}",
            method: 'GET',
            data: {id:'00'},
            dataType: 'json',
            success: function(response) {
                $('#PGADHPeriodId').html(response.SelectedItem);
            },
            cache: true
        });
    }
    function fnUpdateScreenVariables(data){
            $('#PGADHUniqueId').val(data.PGADHUniqueId);                       
            $('#PGADHLocationId').val(data.PGADHLocationId);                       
            $('#PGADHEmployeeId').val(data.PGADHEmployeeId);
            $('#PGADHTotalDays').val(data.PGADHTotalDays);
            $('#PGADHNoPayDays').val(data.PGADHNoPayDays);
            $('#PGADHPaidDays').val(data.PGADHPaidDays);
    }
</script>
@endsection


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
                                <th title="Income Type Id">ID</th>
                                <th>Income Type</th>
                                <th>Rule</th>
                                <th>Income Cycle</th>
                                <th title="Printing Sequence">P.Seq.</th>
                                <th>Rounding</th>
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
                                                            <th title="Income Type Id">ID</th>
                                                            <th>Income Type</th>
                                                            <th>Desc1</th>
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
                                    method="post" action="{{ route('incomeType.postData') }}">
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
                                                    <div class='form-group mb-0'>
                                                        <input type="hidden" name='PMITHUniqueId' id='PMITHUniqueId' class='form-control'>                                                  
                                                        <input type="hidden" name='PMITHIncomeIdK' id='PMITHIncomeIdK' class='form-control'>                                                 
                                                        <input type="hidden" name='PMITHIsTaxable' id='PMITHIsTaxable' class='form-control'>                                                 
                                                    </div>
                                                    <!-- Id, Desc1, Desc2, BI Id -->
                                                    <div class="row mt-0">
                                                        <div class="col-md-2">
                                                            <div class='form-group'>                                                
                                                                <label>Income Type Id</label> 
                                                                <span class="error-text PMITHIncomeId_error text-danger" 
                                                                    style='float:right;'></span>
                                                                <input type="text"  name='PMITHIncomeId' id='PMITHIncomeId' 
                                                                    class='form-control few-options' maxlength="10" 
                                                                    placeholder="Income Id" style='opacity:1'>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class='form-group'>                                                
                                                                <label>Description</label> 
                                                                <span class="error-text PMITHDesc1_error text-danger" 
                                                                    style='float:right;'></span>
                                                                <input type="text" name='PMITHDesc1' id="PMITHDesc1"  maxlength="100" placeholder="Income Description"
                                                                    class="form-control few-options">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-2">
                                                            <!-- BI Dropdown -->
                                                            <div class='form-group'>
                                                                <label>BI Desc</label>                                                
                                                                <span class="error-text biDescId_error text-danger" 
                                                                    style='float:right;'></span>
                                                                <select id='biDescId' name = 'biDescId' style='width: 100%;'>
                                                                    <option value=''>-- BI Code --</option>
                                                                </select>                                                
                                                            </div>                 
                                                        </div>
                                                            <div class="col-md-4">
                                                                <div class='form-group'>                                                
                                                                    <label>Description2</label>  
                                                                    <textarea name='PMITHDesc2' id='PMITHDesc2' class='form-control few-options' 
                                                                    maxlength="200" name="alloptions" id="alloptions1" placeholder="Additional Description" 
                                                                    aria-label="With textarea" 
                                                                    style='border-color: rgb(102, 175, 233); outline: 0px'></textarea>
                                                                </div>
                                                            </div>                                                            
                                                    </div>
                                                    <!-- Is Tax, Printing Seq., Rule Id, Rent Exempt, City Exempt -->
                                                    <div class="row mt-0">
                                                        <div class="col-md-2 n-chk mt-4">
                                                            <label class="new-control new-checkbox new-checkbox-text checkbox-success">
                                                                <input type="checkbox" class="new-control-input" name='isTaxable' id='isTaxable'>
                                                                <span class="new-control-indicator"></span><span class="new-chk-content">Is Taxable</span>
                                                            </label>
                                                        </div>
                                                        <div class="col-md-2">
                                                            <!-- Rounding Dropdown -->
                                                            <div class='form-group'>
                                                                <label>Rounding</label>                                                
                                                                <span class="error-text roundingId_error text-danger" 
                                                                    style='float:right;'></span>
                                                                <select id='roundingId' name = 'roundingId' style='width: 100%;'>
                                                                    <option value='1000'>No Round</option>
                                                                    <option value='1100'>Round</option>
                                                                    <option value='1200'>Round Up</option>
                                                                    <option value='1300'>Round Down</option>
                                                                </select>                                                
                                                            </div>                 
                                                        </div>
                                                        <div class="col-md-2">
                                                            <div class='form-group'>                                                
                                                                <label>Printing Seq.</label> 
                                                                <span class="error-text PMITHPrintingSeq_error text-danger" 
                                                                    style='float:right;'></span>
                                                                <input type="number" name='PMITHPrintingSeq' id="PMITHPrintingSeq"
                                                                    class="form-control" step='1' value='0'>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-2">
                                                            <!-- Rule Definition Dropdown -->
                                                            <div class='form-group'>
                                                            <label>Rule Id</label>                                                                    
                                                                <select id='ruleDefId' name = 'ruleDefId' style='width: 100%;'>
                                                                    <option value=''>-Select Rule-</option>
                                                                </select>                                            
                                                            </div>                 
                                                        </div>
                                                        <div class="col-md-2">
                                                            <div class='form-group' id='rentExemptId'>                                                
                                                                <label>Rent Exempt %</label> 
                                                                <span class="error-text PMITHRentExemptPercent_error text-danger" 
                                                                    style='float:right;'></span>
                                                                <input type="number" name='PMITHRentExemptPercent' id="PMITHRentExemptPercent"
                                                                    class="form-control" value='0.00' step='any'>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-2">
                                                            <div class='form-group' id='cityExemptId'>                                                
                                                                <label>City Exempt %</label> 
                                                                <span class="error-text PMITHRentCityPercent_error text-danger" 
                                                                    style='float:right;'></span>
                                                                <input type="number" name='PMITHRentCityPercent' id="PMITHRentCityPercent"
                                                                    class="form-control" value='0.00' step='any'>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- Payment Cycle -->
                                                    <div class="row mt-0">
                                                        <div class="col-md-2">                                                                
                                                            <div class='form-group'>
                                                                <label>Payment Cycle</label>                                                
                                                                <span class="error-text paymentCycleId_error text-danger" 
                                                                    style='float:right;'></span>
                                                                <select id='incomeCycleId' name = 'incomeCycleId' style='width: 100%;'>
                                                                    <option value='M'>Monthly</option>
                                                                    <option value='P'>Periodic</option>
                                                                </select>                                                
                                                            </div>                 
                                                        </div>
                                                        <!-- Period Dropdown Multiselect -->
                                                        <div class="col-md-10">
                                                            <div class='form-group' id='periodDropdownId'>
                                                                <label>Period</label>                                                
                                                                <span class="error-text periodId_error text-danger" 
                                                                    style='float:right;'></span>
                                                                <select multiple="multiple" id='periodId' name = 'periodId[]' style='width: 100%;'>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                                                                
                                                </div>
                                            </div>
                                            <div class="tab-pane fade" id="animated-underline-profile" role="tabpanel" 
                                                aria-labelledby="animated-underline-profile-tab">
                                                <div class="media">
                                                    <div class="media-body">
                                                        <div class="form-group">
                                                            <label> User</label>
                                                            <input type="text" name="PMITHUser" id="PMITHUser" 
                                                            class="form-control col-sm-6" readonly/>
                                                        </div>
                                                        <div class="form-group">
                                                            <label> Created Date</label>
                                                            <input type="date" name="PMITHLastCreated" id="PMITHLastCreated" 
                                                            class="form-control col-sm-6" readonly/>
                                                        </div>
                                                        <div class="form-group">
                                                            <label> Updated Date</label>
                                                            <input type="date" name="PMITHLastUpdated" id="PMITHLastUpdated" 
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
        $modalTitle = 'Income Type '
        if ($('#incomeCycleId').val() == 'M') {
            $('#periodDropdownId').hide();
        }
        if ($('#ruleDefId').val() != 'I5000') {
            $('#rentExemptId').hide();
            $('#cityExemptId').hide();
        }
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
            pageLength: 9,
            lengthMenu: [9, 10, 20, 50],
            order: [ 7, "desc" ],
            processing: true,
            serverSide: true,
            autoWidth: false,             
            "ajax": "{{ route('incomeType.browserData')}}",
            "columns":[
                {data: "PMITHIncomeId"},
                {data: "PMITHDesc1"},
                {data: "PMRDHDesc1"},
                {data: "PMPCHDesc1"},
                {data: "PMITHPrintingSeq"},
                {data: "RSRSHDesc1"},
                {data: "action", orderable:false, searchable: false},
                {data: "PMITHUniqueId", "visible": false},
            ],
            columnDefs: [{
                // Setting width of each column
                width: "10%", "targets": 0,
                width: "20%", "targets": 1,
                width: "20%", "targets": 2,
                width: "10%", "targets": 3,
                width: "5%", "targets": 4,
                width: "15%", "targets": 5,
                width: "20%", "targets": 7,
            }],
            "rowCallback": function( row, data, index ){
                if ( data['PMPCHDesc1'] == "Periodic" )
                {
                    // $('td', row).css('background-color', '#343A40 ');
                    $('td', row).css('color', '#ffc107');
                }
            }
        });
        // Whed add buttonis pushed
        $('#add_Data').click(function(){                    
            $("#PMITHIncomeId").attr("readonly", false);
            fnReinstateFormControl('0');
            $("#animated-underline-home-tab").trigger('click');
            // All dropdowns
            fnBiIncomeDropdownsAddMode()
            fnRuleIncomeDefDropdownsAddMode()
            // All dropdowns Ends
        });
        // Add Ends
        // When submit button is pushed
        $('#singleLevelDataEntryForm').on('submit', function(event){
            if($('#isTaxable').prop('checked')==true) {
                    $('#PMITHIsTaxable').val(1);
            }else {
                $('#PMITHIsTaxable').val(0);
            }
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
                        $('#biDescId').val(null).trigger('change');
                        $('#roundingId').val('1000').trigger('change');
                        $('#ruleDefId').val(null).trigger('change');
                        $('#incomeCycleId').val('M').trigger('change');
                        $('#periodId').val(null).trigger('change');
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
        // When edit button is pushed
        $(document).on('click', '.edit', function(){
            
            var id = $(this).attr('id');
            $.ajax({
                // CopyChange
                url: "{{route('incomeType.fetchData')}}",
                method: 'GET',
                data: {id:id},
                dataType: 'json',
                success: function(data)
                {
                    // Update Screen Variables
                    fnUpdateScreenVariables(data);
                    // Update Checkboxes
                    fnUpdateCheckBoxes(data)
                    // Updae Dropdowns
                    var $BiElementId = data.PMITHBiElementId;
                    fnBiIncomeDropdownsEditMode($BiElementId)
                    var $IncomeRuleId = data.PMITHRuleId;
                    fnRuleIncomeDefDropdownsEditMode($IncomeRuleId)
                    var $IncomeCycle = data.PMITHIncomeCycle;
                    if ($IncomeCycle == 'P') {
                        $incomeIdK = data.PMITHIncomeIdK;
                        fnPeroidDropdownsEditMode($incomeIdK)
                    }
                    // Updae Dropdowns Ends
                    fnReinstateFormControl('1');
                    $("#animated-underline-home-tab").trigger('click');
                }
            });
        });
        // Edit Ends                  
        // When delete button is pushed
        $(document).on('click', '.delete', function(){
            var UniqueId = $(this).attr('id');
            // Fetch Record first that need to be deleted.
            $.ajax({
                url: "{{route('incomeType.fetchData')}}",
                method: 'GET',
                data: {id:UniqueId},
                dataType: 'json',
                success: function(data)
                {
                    $deleteMessage3SIS = fnSingleLevelDeleteConfirmation($modalTitle, data.PMITHIncomeId, '');   
                    $('#DeleteRecord').html($deleteMessage3SIS);
                    $('#modalZoomDeleteRecord3SIS').modal('show');                   
                }
            });
            // Fetch Record Ends
            // Delete record only when OK is pressed on Modal.
            $(document).on('click', '.confirm', function(){
                $.ajax({
                    // CopyChange
                    url:"{{route('incomeType.deleteData')}}",
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
            "ajax": "{{ route('incomeType.browserDeletedRecords')}}",
            "columns":[
                // CopyChange
                {data: "PMITHIncomeId"},
                {data: "PMITHDesc1"},
                {data: "PMITHDesc2"},
                {data: "action", orderable:false, searchable: false},
                {data: "PMITHUniqueId", "visible": false},
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
                url: "{{route('incomeType.fetchData')}}",
                method: 'GET',
                data: {id:DeletedUniqueId},
                dataType: 'json',
                success: function(data)
                {
                    $restoreMessage3SIS = fnSingleLevelRestoreConfirmation($modalTitle, data.PMITHIncomeId, '');   
                    $('#RestoreRecord').html($restoreMessage3SIS);
                    $('#modalZoomRestoreRecord3SIS').modal('show');  
                    $('#modalZoomRestoreRecord3SIS').modal('hide');                    
                }
            });
            // Fetch Record Ends
            // Restore record only when OK is pressed on Modal.
            $(document).on('click', '.confirmrestore', function(){
                $.ajax({
                    url:"{{route('incomeType.restoreDeletedRecords')}}",
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
        // Rounding Dropdown
        $( "#roundingId" ).select2();
        // Rounding Dropdown Ends
        // Show Period Dropdown only when Payment Cycle is P
        $('#incomeCycleId').change(function(){
            if ($('#incomeCycleId').val() == 'M') {
                $('#periodDropdownId').hide();
            }else{
                $('#periodDropdownId').show();
                fnPeroidDropdownsAddMode();
            }
        });        
        // Show Exempt % fileds only when HRA exemption rule is picked.
        $('#ruleDefId').change(function(){
            if ($('#ruleDefId').val() == 'I5000') {
                $('#rentExemptId').show();
                $('#cityExemptId').show();
            }else{
                $('#rentExemptId').hide();
                $('#cityExemptId').hide();
            }
        })
        // Update IncomeIdK When IncomeId is changed
        $('#PMITHIncomeId').change(function(){
            $('#PMITHIncomeIdK').val('I'.concat($('#PMITHIncomeId').val()));
        })
        // Update Screen Variables
        function fnUpdateScreenVariables(data) {
            var lastCreated = formattedDate(new Date(data.PMITHLastCreated));
            var lastUpdated = formattedDate(new Date(data.PMITHLastUpdated));
            $('#PMITHUniqueId').val(data.PMITHUniqueId);
            $('#PMITHIncomeId').val(data.PMITHIncomeId);
            $('#PMITHIncomeIdK').val(data.PMITHIncomeIdK);
            $('#PMITHDesc1').val(data.PMITHDesc1);
            $('#PMITHDesc2').val(data.PMITHDesc2);
            $('#PMITHRentExemptPercent').val(data.PMITHRentExemptPercent);
            $('#PMITHRentCityPercent').val(data.PMITHRentCityPercent);
            $('#PMITHPrintingSeq').val(data.PMITHPrintingSeq);
            $('#roundingId').val(data.PMITHRoundingStrategy).trigger('change');
            $('#incomeCycleId').val(data.PMITHIncomeCycle).trigger('change');

            $('#PMITHUser').val(data.PMITHUser);
            $('#PMITHLastCreated').val(lastCreated);
            $('#PMITHLastUpdated').val(lastUpdated);
            $("#PMITHIncomeId").attr("readonly", true);
        }
        // Update Screen Variables Ends
        // Update Checkboxes
        function fnUpdateCheckBoxes(data) {
            $("#isTaxable").prop("checked", false);
            $('#PMITHIsTaxable').val(0);
            if(data.PMITHIsTaxable == 1)
            {
                $("#isTaxable").prop("checked", true);
                $('#PMITHIsTaxable').val(1);
            }else{
                $("#isTaxable").prop("checked", false);
                $('#PMITHIsTaxable').val(0);
            }
        }
        // Update Checkboxes Ends
        $( "#biDescId" ).select2();
        $( "#ruleDefId" ).select2();
        $( "#incomeCycleId" ).select2();
        $( "#periodId" ).select2();        
        function fnBiIncomeDropdownsEditMode($BiElementId){
            $.ajax({
                url: "{{route('dropDownMasters.getSelectedIncomeBiDesc')}}",
                method: 'GET',
                data: {id:$BiElementId},
                dataType: 'json',
                success: function(response) {                    
                    $('#biDescId').html(response.SelectedItem);
                },
                cache: true
            })
        }
        function fnRuleIncomeDefDropdownsEditMode($IncomeRuleId){
            $.ajax({
                url: "{{route('dropDownMasters.getSelectedRuleDefDescIncome')}}",
                method: 'GET',
                data: {id:$IncomeRuleId},
                dataType: 'json',
                success: function(response) {                    
                    $('#ruleDefId').html(response.SelectedItem);
                },
                cache: true
            })
        }
        function fnPeroidDropdownsEditMode($incomeIdK){
            $.ajax({
                url: "{{route('dropDownMasters.getSelectedPeriod')}}",
                method: 'GET',
                data: {id:$incomeIdK},
                dataType: 'json',
                success: function(response) {                    
                    $('#periodId').html(response.SelectedItem);
                },
                cache: true
            })
        }
    });
    function fnBiIncomeDropdownsAddMode(){
        $.ajax({
            url: "{{route('dropDownMasters.getSelectedIncomeBiDesc')}}",
            method: 'GET',
            data: {id:'00'},
            dataType: 'json',
            success: function(response) {
                $('#biDescId').html(response.SelectedItem);
            },
            cache: true
        });
    }
    function fnRuleIncomeDefDropdownsAddMode(){
        $.ajax({
            url: "{{route('dropDownMasters.getSelectedRuleDefDescIncome')}}",
            method: 'GET',
            data: {id:'00'},
            dataType: 'json',
            success: function(response) {
                $('#ruleDefId').html(response.SelectedItem);
            },
            cache: true
        });
    }
    function fnPeroidDropdownsAddMode(){
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

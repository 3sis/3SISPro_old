@extends('layouts.app')

@section('content')
<div class="layout-px-spacing">
    
    <div>
    
        <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
            <div class=" br-6">
                <div class="table-responsive">
                    <table id="html5-extension3SIS" class="table table-hover non-hover" style="width:100%">
                        <thead>
                            <tr>
                                <!--CopyChange-->  
                                <th title="Rule Definition">ID</th>
                                <th>IncOrDed</th>  
                                <th>Desc1</th>
                                <th>Hierarchy Id</th>
                                <th>Slab Defined</th>                                    
                                <th>Deduction Eligibility</th>                                    
                                <th>Deduction Basis</th>                                    
                                <th>Action</th>
                                <th style="visibility: hidden;">Unique Id</th>
                                
                            </tr>
                        </thead> 
                    </table>
                </div>
                <div id='entryModalSmall' class='modal fade  register-modal' role='dialog' 
                    aria-labelledby="registerModalLabel" aria-hidden="true" style='margin-top:40px' data-backdrop="static">
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
                            <form  id='singleLevelDataEntryForm' autocomplete="off"
                                    method="post" action="{{ route('ruleDefinition.postData') }}">
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
                                                    <!-- CopyChange -->  
                                                    <div class='form-group mb-0'>
                                                        <input type="hidden" name='PMRDHUniqueId' id='PMRDHUniqueId' 
                                                            class='form-control'>   
                                                    </div>
                                                    <!-- CopyChange -->
                                                    <div class="row mt-0">
                                                        <div class="col-md-5">
                                                            <div class='form-group'>                                                
                                                                <label>Rule Id</label> 
                                                                <input type="text"  name='PMRDHRuleId' id='PMRDHRuleId' 
                                                                    class='form-control few-options' style='opacity:1'>
                                                            </div>
                                                        </div>
                                                        <!-- CopyChange -->
                                                        <div class="col-md-5">
                                                            <div class='form-group'>                                                
                                                                <label>Description</label> 
                                                                <input type="text" name='PMRDHDesc1' id="PMRDHDesc1" class="form-control few-options">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-2">
                                                            <div class='form-group'>                                                
                                                                <label>IncOrDed</label> 
                                                                <input type="text" name='PMRDHIncOrDed' id="PMRDHIncOrDed" class="form-control few-options">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- CopyChange -->
                                                    <div class="row mt-0">
                                                        <div class="col-md-6">
                                                            <div class='form-group'>
                                                                <label>Hierarchy</label>                                                
                                                                <span class="error-text PMRDHHierarchyId_error text-danger" 
                                                                    style='float:right;'></span>
                                                                <select id='PMRDHHierarchyId' name = 'PMRDHHierarchyId' style='width: 100%;'>
                                                                    <option value=''>-- Select Hierarchy Id --</option>
                                                                </select>                                                
                                                            </div>
                                                        </div>
                                                        <!-- CopyChange -->
                                                        <div class="col-md-6">
                                                            <div class='form-group'>
                                                                <label>Deduction Eligibility</label>                                                
                                                                <span class="error-text PMRDHDeductionEligibility_error text-danger" 
                                                                    style='float:right;'></span>
                                                                <select id='PMRDHDeductionEligibility' name = 'PMRDHDeductionEligibility' style='width: 100%;'>
                                                                    <option value=''>-- Select Deduction Eligibility --</option>
                                                                </select>                                                
                                                            </div>   
                                                        </div>                                                            
                                                    </div>                                                                                 
                                                    <!-- For defining select2 -->
                                                    <div class="row mt-0">
                                                        <div class="col-md-5">
                                                            <div class='form-group'>
                                                                <label>Deduction Basis</label>                                                
                                                                <span class="error-text PMRDHDeductionBasis_error text-danger" 
                                                                    style='float:right;'></span>
                                                                <select id='PMRDHDeductionBasis' name = 'PMRDHDeductionBasis' style='width: 100%;'>
                                                                    <option value=''>-- Select Deduction Basis --</option>
                                                                </select>                                                
                                                            </div>
                                                        </div>
                                                    </div>                                                    
                                                    <!-- End of dropdown -->                                         
                                                </div>
                                            </div>
                                            <div class="tab-pane fade" id="animated-underline-profile" role="tabpanel" 
                                                aria-labelledby="animated-underline-profile-tab">
                                                <div class="media">
                                                    <div class="media-body">
                                                        <div class="form-group">
                                                            <label> User</label>
                                                            <input type="text" name="PMRDHUser" id="PMRDHUser" 
                                                            class="form-control col-sm-6" readonly/>
                                                        </div>
                                                        <div class="form-group">
                                                            <label> Created Date</label>
                                                            <input type="date" name="PMRDHLastCreated" id="PMRDHLastCreated" 
                                                            class="form-control col-sm-6" readonly/>
                                                        </div>
                                                        <div class="form-group">
                                                            <label> Updated Date</label>
                                                            <input type="date" name="PMRDHLastUpdated" id="PMRDHLastUpdated" 
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
        $modalTitle = 'Rule Definition'
        $( "#PMRDHHierarchyId" ).select2();
        $( "#PMRDHDeductionEligibility" ).select2();
        $( "#PMRDHDeductionBasis" ).select2();

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
            pageLength: 6,
            lengthMenu: [6, 10, 20, 50],
            order: [ 10, "desc" ],
            processing: true,
            serverSide: true,
            // CopyChange                    
            "ajax": "{{ route('ruleDefinition.browserData')}}",
            "columns":[
                // CopyChange
                {data: "PMRDHRuleId"},
                {data: "PMRDHIncOrDed"},                    
                {data: "PMRDHDesc1"},
                {data: "PMRHHDesc1"},
                {data: "PMRDHSlabDefined"},                    
                {data: "DeductionEligibility"},                    
                {data: "PMRDHDeductionBasis"},                    
                {data: "action", orderable:false, searchable: false},
                {data: "PMRDHUser", "visible": false},
                {data: "PMRDHLastUpdated", "visible": false},
                {data: "PMRDHUniqueId", "visible": false},


            ],                
            columnDefs: [{
                // Setting width of each column
                width:  "10%", "targets": 0,
                width: "5%", "targets": 1,
                width: "15%", "targets": 2,
                width: "15%", "targets": 3,
                width: "10%", "targets": 4,
                width: "15%", "targets": 6,
                width: "15%", "targets": 7,
                width: "15%", "targets": 8,
                "targets": 4,
                data:   "PMRDHSlabDefined",
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
            
        
        // When edit button is pushed
        $(document).on('click', '.edit', function(){
            var id = $(this).attr('id');
            $.ajax({
                // CopyChange
                url: "{{route('ruleDefinition.fetchData')}}",
                method: 'GET',
                data: {id:id},
                dataType: 'json',
                success: function(data)
                {                       
                    fnReinstateFormControl('1');  
                    // Update Screen Variables
                    fnUpdateScreenVariables(data);
                    // Update Dropdowns
                    fnUpdateDropdownsEditMode(data)
                    // fnUpdateCheckBoxes(data);
                    $("#PMRDHRuleId").attr("readonly", true);
                    $("#PMRDHIncOrDed").attr("readonly", true);
                    $("#PMRDHDesc1").attr("readonly", true);
                }
            });
        });
        // Edit Ends
        // When submit button is pushed
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
                        $('#entryModalSmall').modal('hide');
                        $('#modalZoomFinalSave3SIS').modal('show');
                    }
                }
            })
        });
        // Submit Ends            
        // Update Screen Variables
        function fnUpdateScreenVariables(data) {

            var lastCreated = formattedDate(new Date(data.PMRDHLastCreated));
            var lastUpdated = formattedDate(new Date(data.PMRDHLastUpdated));
            $('#PMRDHUniqueId').val(data.PMRDHUniqueId); 
            $('#PMRDHRuleId').val(data.PMRDHRuleId);
            $('#PMRDHIncOrDed').val(data.PMRDHIncOrDed);
            $('#PMRDHDesc1').val(data.PMRDHDesc1);  
            $('#PMRDHHierarchyId').val(data.PMRDHHierarchyId);
            $('#PMRDHSlabDefined').val(data.PMRDHSlabDefined);
            $('#PMRDHDeductionEligibility').val(data.PMRDHDeductionEligibility);
            $('#PMRDHDeductionBasis').val(data.PMRDHDeductionBasis);
            $('#PMRDHUser').val(data.PMRDHUser);                        
            $('#PMRDHLastCreated').val(lastCreated);                        
            $('#PMRDHLastUpdated').val(lastUpdated);
        }
        // Update Screen Variables Ends   
        // Dropdown in Edit Mode
        function fnUpdateDropdownsEditMode(data){
            var $HierarchyId = data.PMRDHHierarchyId;
            $.ajax({
                url: "{{route('dropDownMasters.getSelectedHierarchyId')}}",
                method: 'GET',
                data: {id:$HierarchyId},
                dataType: 'json',
                success: function(response) {                    
                    $('#PMRDHHierarchyId').html(response.SelectedItem);
                },
                cache: true
            })
            var $DeductionEligibility = data.PMRDHDeductionEligibility;
            $.ajax({
                url: "{{route('dropDownMasters.getSelectedDeductionMethod')}}",
                method: 'GET',
                data: {id:$DeductionEligibility},
                dataType: 'json',
                success: function(response) {                    
                    $('#PMRDHDeductionEligibility').html(response.SelectedItem);
                },
                cache: true
            })
            var $DeductionBasis = data.PMRDHDeductionBasis;
            $.ajax({
                url: "{{route('dropDownMasters.getSelectedDeductionMethod')}}",
                method: 'GET',
                data: {id:$DeductionBasis},
                dataType: 'json',
                success: function(response) {                    
                    $('#PMRDHDeductionBasis').html(response.SelectedItem);
                },
                cache: true
            })
        }
        // Dropdown in Edit Mode Ends    
            
    }); 
</script>
@endsection

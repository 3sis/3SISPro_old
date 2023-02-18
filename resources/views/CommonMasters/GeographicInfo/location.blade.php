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
                                <th title="Location Master">ID</th>
                                <th>Location</th>  
                                <th>City</th>
                                <th>State</th>
                                <th>Country</th>                                    
                                <th>Action</th>
                                <th style="visibility: hidden;">User</th>
                                <th style="visibility: hidden;">Updated</th>
                                <th style="visibility: hidden;">Desc2</th>
                                <th style="visibility: hidden;">Bi Desc</th>
                                <th style="visibility: hidden;">Unique Id</th>
                                <th style="visibility: hidden;">Company</th>
                            </tr>
                        </thead> 
                    </table>
                </div>
                <!-- start undeletemodal -->
                <div></div>
                <div id='dataTableModalSmall' class='modal fade  register-modal' tabindex="-1"  role='dialog' 
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
                                                            <th title="Location Master">ID</th>
                                                            <th>Location Name</th>
                                                            <th>Desc2</th>
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
                                    method="post" action="{{ route('location.postData') }}">
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
                                                        <input type="hidden" name='GMLMHUniqueId' id='GMLMHUniqueId' 
                                                            class='form-control'>   
                                                        <input type="hidden" name='GMLMHCompanyId' id='GMLMHCompanyId' 
                                                        class='form-control'>                                               
                                                    </div>
                                                    <!-- CopyChange -->
                                                    <div class="row mt-0">
                                                        <div class="col-md-6">
                                                            <div class='form-group'>                                                
                                                                <label>Location Id</label> 
                                                                <span class="error-text GMLMHLocationId_error text-danger" 
                                                                    style='float:right;'></span>
                                                                <input type="text"  name='GMLMHLocationId' id='GMLMHLocationId' 
                                                                    class='form-control few-options' maxlength="4" 
                                                                    placeholder="Location Id" style='opacity:1'>
                                                            </div>
                                                        </div>
                                                        <!-- CopyChange -->
                                                        <div class="col-md-6">
                                                            <div class='form-group'>                                                
                                                                <label>Location Description</label> 
                                                                <span class="error-text GMLMHDesc1_error text-danger" 
                                                                    style='float:right;'></span>
                                                                <input type="text" name='GMLMHDesc1' id="GMLMHDesc1"  maxlength="100" placeholder="Location Description" 
                                                                    class="form-control few-options">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- CopyChange -->
                                                    <div class="row mt-0">
                                                        <div class="col-md-6">
                                                            <div class='form-group'>                                                
                                                                <label>Description2</label>
                                                                <textarea name='GMLMHDesc2' id='GMLMHDesc2' class='form-control few-options' 
                                                                maxlength="200" name="alloptions" id="alloptions1" placeholder="Location Description2" 
                                                                aria-label="With textarea" 
                                                                style='border-color: rgb(102, 175, 233); outline: 0px'></textarea>
                                                            </div>
                                                        </div>
                                                        <!-- CopyChange -->
                                                        <div class="col-md-6">
                                                            <div class='form-group '>
                                                                <label>BI Desc</label>
                                                                <span class="error-text GMLMHBiDesc_error text-danger" style='float:right;'></span>
                                                                <input type="text" name='GMLMHBiDesc' id='GMLMHBiDesc' 
                                                                    class='form-control few-options'maxlength="100"  placeholder="BI Description">
                                                            </div>        
                                                        </div>                                                            
                                                    </div>                                                                                 
                                                    <!-- For defining select2 -->
                                                    <div class="row mt-0">
                                                        <div class="col-md-4">
                                                            <div class='form-group'>
                                                                <label>City Id</label>                                                
                                                                <span class="error-text cityId_error text-danger" 
                                                                    style='float:right;'></span>
                                                                <select id='cityId' name = 'cityId' style='width: 100%;'>
                                                                    <option value=''>-- Select City Id --</option>
                                                                </select>                                                
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">                                               
                                                            <div class='form-group'>
                                                                <label>State</label> 
                                                                <input type="hidden" name='stateId' id='stateId' 
                                                                class='form-control'>                                               
                                                                <input type="text" name='stateDesc1' id='stateDesc1'value='' 
                                                                class='form-control' readonly>  
                                                                </select>                                                
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">                                               
                                                            <div class='form-group'>
                                                                <label>Country</label>  
                                                                <input type="hidden" name='countryId' id='countryId' 
                                                                class='form-control'>                                              
                                                                <input type="text" name='countryDesc1' id='countryDesc1'value='' 
                                                                class='form-control' readonly>                                          
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
                                                            <input type="text" name="GMLMHUser" id="GMLMHUser" 
                                                            class="form-control col-sm-6" readonly/>
                                                        </div>
                                                        <div class="form-group">
                                                            <label> Created Date</label>
                                                            <input type="date" name="GMLMHLastCreated" id="GMLMHLastCreated" 
                                                            class="form-control col-sm-6" readonly/>
                                                        </div>
                                                        <div class="form-group">
                                                            <label> Updated Date</label>
                                                            <input type="date" name="GMLMHLastUpdated" id="GMLMHLastUpdated" 
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
        $modalTitle = 'Location'
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
            "ajax": "{{ route('location.browserData')}}",
            "columns":[
                // CopyChange
                {data: "GMLMHLocationId"},
                {data: "GMLMHDesc1"},                    
                {data: "GMCTHDesc1"},
                {data: "GMSMHDesc1"},
                {data: "GMCMHDesc1"},                    
                {data: "action", orderable:false, searchable: false},
                {data: "GMLMHUser", "visible": false},
                {data: "GMLMHLastUpdated", "visible": false},
                {data: "GMLMHDesc2", "visible": false},
                {data: "GMLMHBiDesc", "visible": false},
                {data: "GMLMHUniqueId", "visible": false},
                {data: "GMLMHCompanyId", "visible": false},
            ],                
            "columnDefs": [
                { "width": "10%", "targets": 0 },
                { "width": "15%", "targets": 1 },
                { "width": "15%", "targets": 2 },
                { "width": "15%", "targets": 3 },
                { "width": "15%", "targets": 4 },
                { "width": "20%", "targets": 5 },
            ]                
            });
            
        // Whed add buttonis pushed
        $( "#cityId" ).select2();
        $('#add_Data').click(function(){                    
            $("#GMLMHLocationId").attr("readonly", false);
            fnReinstateFormControl('0');
            fnUpdateDropdownsAddMode();
            
        });
        // Add Ends                   
        // When edit button is pushed
        $(document).on('click', '.edit', function(){
            
            var id = $(this).attr('id');
            $.ajax({
                // CopyChange
                url: "{{route('location.fetchData')}}",
                method: 'GET',
                data: {id:id},
                dataType: 'json',
                success: function(data)
                {                       
                    // Update Screen Variables
                    fnUpdateScreenVariables(data);
                    // Update Dropdowns

                    var $CityId = data.GMLMHCityId;
                    fnUpdateDropdownsEditMode($CityId)
                    $("#GMLMHLocationId").attr("readonly", true);
                    // $("#animated-underline-home-tab").trigger('click');
                    // var $CityId = data.GMLMHCityId;
                    fnGetGeoDescEditMode($CityId)
                    fnReinstateFormControl('1');  
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
                url: "{{route('location.fetchData')}}",
                method: 'GET',
                data: {id:UniqueId},
                dataType: 'json',
                success: function(data)
                {
                    $deleteMessage3SIS = fnSingleLevelDeleteConfirmation($modalTitle, data.GMLMHLocationId, '');   
                    $('#DeleteRecord').html($deleteMessage3SIS);
                    $('#modalZoomDeleteRecord3SIS').modal('show');                   
                }
            });
            // Fetch Record Ends
            // Delete record only when OK is pressed on Modal.
            $(document).on('click', '.confirm', function(){
                $.ajax({
                    // CopyChange
                    url:"{{route('location.deleteData')}}",
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
            "ajax": "{{ route('location.browserDeletedRecords')}}",
            "columns":[
                // CopyChange
                {data: "GMLMHLocationId"},
                {data: "GMLMHDesc1"},
                {data: "GMLMHDesc2"},
                {data: "action", orderable:false, searchable: false},
                {data: "GMLMHUniqueId", "visible": false},
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
                url: "{{route('location.fetchData')}}",
                method: 'GET',
                data: {id:DeletedUniqueId},
                dataType: 'json',
                success: function(data)
                {
                    $restoreMessage3SIS = fnSingleLevelRestoreConfirmation($modalTitle, data.GMLMHLocationId, '');   
                    $('#RestoreRecord').html($restoreMessage3SIS);
                    $('#modalZoomRestoreRecord3SIS').modal('show');  
                    $('#modalZoomRestoreRecord3SIS').modal('hide');                    
                }
            });
            // Fetch Record Ends
            // Restore record only when OK is pressed on Modal.
            $(document).on('click', '.confirmrestore', function(){
                $.ajax({
                    url:"{{route('location.restoreDeletedRecords')}}",
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
        //  city Dropdown
        // $( "#cityId" ).select2({
        //     ajax: { 
        //         url: "{{route('location.getCity')}}",
        //         type: "POST",
        //         dataType: 'json',
        //         tags: true,
        //         // The number of milliseconds to wait for the user to stop typing before issuing the ajax request.
        //         delay: 250,
        //         // @param params The object containing the parameters used to generate the request.
        //         data: function (params) {
        //             return {
        //                 _token: $('#csrfToken').val(),
        //                 search: params.term // search term
        //             }
        //         },
        //         processResults: function (response) {
        //             return {
        //                 results: response
        //             }
        //         },
        //         cache: true
        //     }
        // });
        //  city Dropdown Ends
        // When City Id is selected, bring State and Country Desc
        $('#cityId').change(function(){
            let id = $(this).val();
            $.ajax({
                url: "{{route('location.getGeoDesc')}}",
                type:'post',
                data:'id=' + id + '&_token={{csrf_token()}}',
                success:function(response){
                    $('#stateId').val(response.stateId);
                    $('#stateDesc1').val(response.stateDesc1);
                    $('#countryId').val(response.countryId);
                    $('#countryDesc1').val(response.countryDesc1);
                }
            })
        });
        // Bringing Desc Ends 
        // Update Screen Variables
        function fnUpdateScreenVariables(data) {

            var lastCreated = formattedDate(new Date(data.GMLMHLastCreated));
            var lastUpdated = formattedDate(new Date(data.GMLMHLastUpdated));
            $('#GMLMHUniqueId').val(data.GMLMHUniqueId); 
            $('#GMLMHCompanyId').val(data.GMLMHCompanyId);
            $('#GMLMHLocationId').val(data.GMLMHLocationId);
            $('#GMLMHDesc1').val(data.GMLMHDesc1);
            $('#GMLMHDesc2').val(data.GMLMHDesc2);  
            $('#GMLMHBiDesc').val(data.GMLMHBiDesc);
            $('#GMLMHUser').val(data.GMLMHUser);                        
            $('#GMLMHLastCreated').val(lastCreated);                        
            $('#GMLMHLastUpdated').val(lastUpdated);
        }
        // Update Screen Variables Ends   
        // City Dropdown in Edit Mode
        function fnUpdateDropdownsEditMode($CityId){
            $.ajax({
                url: "{{route('dropDownMasters.getSelectedCity')}}",
                method: 'GET',
                data: {id:$CityId},
                dataType: 'json',
                success: function(response) {                    
                    $('#cityId').html(response.SelectedItem);
                },
                cache: true
            })
        }
        function fnGetGeoDescEditMode($CityId){
        // let id = $(this).val();
            $.ajax({
                url: "{{route('location.getGeoDesc')}}",
                type:'post',
                data:'id=' + $CityId + '&_token={{csrf_token()}}',
                success:function(response){
                    $('#stateId').val(response.stateId);
                    $('#stateDesc1').val(response.stateDesc1);
                    $('#countryId').val(response.countryId);
                    $('#countryDesc1').val(response.countryDesc1);
                }
            });
        }
        // City Dropdown in Edit Mode Ends    
            
    }); 
    
    function fnUpdateDropdownsAddMode(){
            $.ajax({
                url: "{{route('dropDownMasters.getSelectedCity')}}",
                method: 'GET',
                data: {id:'00'},
                dataType: 'json',
                success: function(response) {
                    $('#cityId').html(response.SelectedItem);
                },
                cache: true
            });
    }    
             
</script>
@endsection

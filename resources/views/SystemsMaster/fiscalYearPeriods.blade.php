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
                                    <th style="visibility: hidden;">Unique Id</th>
                                    <th>Period</th>
                                    <th>Month</th>
                                    <th>Desc2</th>
                                    <th>Month No.</th>
                                    <th>Add Int.</th>
                                    <th>User</th>
                                    <th>Updated</th>
                                    <th>Action</th>

                                </tr>
                            </thead>                       
                            
                        </table>
                    </div>
                    <div id="entryModalSmall" class="modal fade UpdateModalBox3SIS" tabindex="0" data-backdrop="static" 
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
                                  
                                <form  id='singleLevelDataEntryForm' autocomplete="off"
                                     method="post" action="{{ route('period.postdata') }}">
                                     <input type="hidden" name="_token" id="csrfToken" value="{{ csrf_token() }}">
                                    <div class='modal-body'>
                                        <div class="container-fluid">
                                            <!-- Hidden Fields -->
                                            <div class='form-group '>                           
                                                <input type="hidden" name='FYPMHUniqueId' id='FYPMHUniqueId' 
                                                    class='form-control'>
                                            </div>
                                            <!-- Id and Description -->
                                            <div class="row mt-0">
                                                <div class="col-md-6">
                                                    <div class='form-group '>
                                                        <label>Period Id</label> 
                                                        <span class="error-text FYPMHPeriodId_error text-danger" 
                                                            style='float:right;'></span>
                                                        <input step="any" type="number"  name='FYPMHPeriodId' id='FYPMHPeriodId' 
                                                            class='form-control few-options' maxlength="2" 
                                                            placeholder="Period Id" style='opacity:1' readonly>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class='form-group '>
                                                        <label>Month</label>
                                                        <span class="error-text FYPMHDesc1_error text-danger" 
                                                            style='float:right;'></span>
                                                        <input type="text" name='FYPMHDesc1' id='FYPMHDesc1' 
                                                            class='form-control few-options' maxlength="100" 
                                                                placeholder="Period Description">                                                    
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- Descriptin2 and BI -->
                                            <div class="row mt-0">
                                                <div class="col-md-6">
                                                    <div class='form-group '>
                                                        <label>Description2</label>
                                                        <span class="error-text FYPMHDesc2_error text-danger" style='float:right;'></span>                                            
                                                        <textarea name='FYPMHDesc2' id='FYPMHDesc2' class='form-control few-options' 
                                                            maxlength="200" name="alloptions" id="alloptions1" placeholder="Period Description2" 
                                                            aria-label="With textarea" 
                                                            style='border-color: rgb(102, 175, 233); outline: 0px'></textarea>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class='form-group '>
                                                        <label>BI Desc</label>
                                                        <input type="text" name='FYPMHBiDesc' id='FYPMHBiDesc' 
                                                            class='form-control few-options' maxlength="100"  
                                                            placeholder="BI Description" readonly>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- Month No. and Additional Integer -->
                                            <div class="row mt-0">
                                                <div class="col-md-6">
                                                    <div class='form-group '>
                                                        <label>Month No.</label>
                                                        <span class="error-text FYPMHNMonth_error text-danger" 
                                                            style='float:right;'></span>                                            
                                                        <input step="any" type="number" name='FYPMHNMonth' id='FYPMHNMonth' 
                                                            class='form-control few-options' maxlength="2" name="alloptions" 
                                                            id="alloptions1" placeholder="Month Number" readonly>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class='form-group '>
                                                        <label>Add Int.</label>
                                                        <span class="error-text FYPMHNAddInt_error text-danger" 
                                                            style='float:right;'></span>                                            
                                                        <input step="any" type="number" name='FYPMHNAddInt' id='FYPMHNAddInt' 
                                                            class='form-control few-options' maxlength="2" name="alloptions" 
                                                            id="alloptions1" placeholder="Add Integer" readonly>
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
                $modalTitle = 'Period'

                $('#html5-extension3SIS').DataTable( {
                    dom: '<"row"<"col-md-12"<"row"<"col-md-6"B><"col-md-6"f> > ><"col-md-12"rt> \
                        <"col-md-12"<"row"<"col-md-5"i><"col-md-7"p>>> >',
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
                    pageLength: 6,
                    lengthMenu: [6, 10, 20, 50],
                    order: [[ 1, "desc" ]],
                    processing: true,
                    serverSide: true,                    
                    "ajax": "{{ route('period.browserData')}}",
                    "columns":[
                        {data: "FYPMHUniqueId", "visible": false},
                        {data: "FYPMHPeriodId"},
                        {data: "FYPMHDesc1"},
                        {data: "FYPMHDesc2"},
                        {data: "FYPMHNMonth"},
                        {data: "FYPMHNAddInt"},
                        {data: "FYPMHUser"},
                        {data: "FYPMHLastUpdated"},
                        {data: "action", orderable:false, searchable: false}
                    ], 
                    });
                  
                // When edit button is pushed
                $(document).on('click', '.edit', function(){
                    
                    var id = $(this).attr('id');
                    $.ajax({
                        url: "{{route('period.fetchdata')}}",
                        method: 'GET',
                        data: {id:id},
                        dataType: 'json',
                        success: function(data)
                        {
                            $('#FYPMHUniqueId').val(data.FYPMHUniqueId);
                            $('#FYPMHPeriodId').val(data.FYPMHPeriodId);
                            $('#FYPMHDesc1').val(data.FYPMHDesc1);
                            $('#FYPMHDesc2').val(data.FYPMHDesc2);
                            $('#FYPMHNMonth').val(data.FYPMHNMonth);
                            $('#FYPMHNAddInt').val(data.FYPMHNAddInt);
                            $('#FYPMHBiDesc').val(data.FYPMHBiDesc);
                            // $("#FYPMHPeriodId").attr("readonly", true);                           
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
            });           
        </script>
@endsection

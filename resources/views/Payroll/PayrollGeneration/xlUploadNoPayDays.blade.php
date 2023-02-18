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
                            @if (session('status'))
                                <div class="alert alert-success" id="errorMessageHeaderId" role="alert">
                                    {{session('status')}}
                                </div>
                            @endif
                            @if(count($errors) > 0)
                                <div class="alert alert-danger">
                                    Upload Validation Error<br><br>
                                    <ul>
                                        @foreach($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            <!-- Nav Tabs -->
                            <ul class="nav nav-tabs mb-3" id="animateLine" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="animated-underline-home-tab" data-toggle="tab" 
                                    href="#animated-underline-home" role="tab" aria-controls="animated-underline-home" a
                                    ria-selected="true">Period Info</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="animated-underline-noPayDays-tab" data-toggle="tab" 
                                    href="#animated-underline-noPayDays" role="tab" aria-controls="animated-underline-noPayDays" 
                                    aria-selected="false">No Pay Days Detail</a>
                                </li>
                            </ul>
                            <div class="tab-content" id="animateLineContent-4">
                                <div class="tab-pane fade show active" id="animated-underline-home" role="tabpanel" 
                                    aria-labelledby="animated-underline-home-tab">
                                    <div class="container-fluid">
                                        <form id='importDataForm' autocomplete="off"
                                             method="POST" enctype="multipart/form-data" action="{{route('noPayDays.import')}}">
                                            <input type="hidden" name="_token" id="csrfTokenMain" value="{{ csrf_token() }}">
                                            <input type="hidden" name='FYFYHCurrentPeriod' id="FYFYHCurrentPeriod" class="form-control">
                                            <input type="hidden" name='TotalNoOfDays' id="TotalNoOfDays" class="form-control">
                                            <div class="row mt-0">
                                                <div class="col-md-4">
                                                    <div class='form-group'>                                                
                                                        <label>Fiscal Year</label>
                                                        <input type="text" name='FYFYHFiscalYearId' id="FYFYHFiscalYearId"
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
                                                        <label>Current Period</label>
                                                        
                                                        <input type="Text" name='FYFYHCurrentPeriodDesc' id="FYFYHCurrentPeriodDesc"
                                                        class="form-control" readonly>
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
                                                <div class="col-md-8">
                                                    <div class="form-group">
                                                        <input type="file" name="file" class="form-control-upload">
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <button type="submit" class="btn btn-primary" id="submit">Submit</button>
                                                </div>
                                                
                                            </div>
                                        </form>                      
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="animated-underline-noPayDays" role="tabpanel" 
                                    aria-labelledby="animated-underline-noPayDays-tab">
                                    <div class="col-xl-12 col-lg-12 col-sm-12 layout-spacing">
                                        <div class="br-6">
                                            <form  id='singleLevelDataEntryForm' autocomplete="off"
                                                method="post" action="{{ route('noPayDays.postData') }}">
                                                <input type="hidden" name="_token" id="csrfTokenDetail" value="{{ csrf_token() }}">
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
                                                <div>
                                                    <!--To display success messages-->
                                                <div style='float:right; padding-right:30px'>                                                    
                                                        <span id='form_output' style='float:left; padding-left:0px' ></span> 
                                                        <input type="hidden" name='button_action' id='button_action' value='insert'>
                                                        <input type="submit" name='save' id="action" value='save' 
                                                            class='btn btn-outline-success mb-2'>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @include('commonViews3SIS.modalCommon3SIS')
    </div>
<script>
    $(document).ready(function(){
        fnGetFiscalYearDetail();
        $("#animated-underline-noPayDays-tab").hide();
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
            "ajax": "{{ route('noPayDays.browserData')}}",        
            "columns":[                    
                {data: "PGADHEmployeeId"},
                {data: "PGADHFullName"},
                {data: "PGADHLocationId"},                
                {data: "PGADHLocationDesc"},                
                {data: "PGADHTotalDays"},                
                {data: "PGADHNoPayDays"},                
                {data: "PGADHPaidDays"},                
            ],
            "columnDefs": [
                { "width": "10%", "targets": 0 },
                { "width": "20%", "targets": 1 },
                { "width": "10%", "targets": 2 },
                { "width": "20%", "targets": 3 },
                { "width": "10%", "targets": 4 },
                { "width": "10%", "targets": 5 },
                { "width": "10%", "targets": 6 },
            ]        
        });
    });
    $('#importDataForm').on('submit', function(event){
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
                    
                }else
                { 
                    $finalMessage3SIS = fnSingleLevelFinalSave(data.masterName, data.Id, data.Desc1, data.updateMode);
                    $('#FinalSaveMessage').html($finalMessage3SIS);
                    $('#modalZoomFinalSave3SIS').modal('show');
                    $("#animated-underline-noPayDays-tab").show();
                    $('#html5-extension3SIS').DataTable().ajax.reload();
                    $("#animated-underline-home-tab").trigger('click');
                }
            }
        })
    });    
    $('#singleLevelDataEntryForm').on('submit', function(event){
        $FiscalYearId = $('#FYFYHFiscalYearId').val();           
        $CurrentPeriod = $('#FYFYHCurrentPeriod').val();           
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
                $("#animated-underline-home-tab").trigger('click'); 
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
                
                $('#FYFYHFiscalYearId').val(response.FYFYHFiscalYearId);
                $('#FYFYHStartDate').val($fYStartDate);
                $('#FYFYHEndDate').val($fYEndDate);
                $('#FYFYHCurrentPeriod').val(response.FYFYHCurrentPeriod);
                $('#FYFYHCurrentPeriodDesc').val(response.FYFYHCurrentPeriodDesc);
                $('#FYFYHPeriodStartDate').val($periodStartDate);
                $('#FYFYHPeriodEndDate').val($periodEndDate);
                // $('#TotalNoOfDays').val($Days);
            },
            cache: true
        });
    }
</script>
@endsection


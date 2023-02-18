@extends('layouts.app')
@section('content')
    <div class="layout-px-spacing">
        <div class="container">
            <div class="row layout-top-spacing">
                <div id="fuSingleFile" class="col-lg-12 layout-spacing">
                    <div class="card component-card_1">
                        <div class="card-body">
                            <!-- Nav Tabs -->
                            <ul class="nav nav-tabs mb-3" id="animateLine" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="animated-underline-home-tab" data-toggle="tab" 
                                    href="#animated-underline-home" role="tab" aria-controls="animated-underline-home" a
                                    ria-selected="true">Fiscal Year Info</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="animated-underline-populatedCalendar-tab" data-toggle="tab" 
                                    href="#animated-underline-populatedCalendar" role="tab" aria-controls="animated-underline-populatedCalendar" 
                                    aria-selected="false">Populated Calendar Detail</a>
                                </li>
                            </ul>
                            <div class="tab-content" id="animateLineContent-4">
                                <div class="tab-pane fade show active" id="animated-underline-home" role="tabpanel" 
                                    aria-labelledby="animated-underline-home-tab">
                                    <div class="container-fluid">
                                        <form id='mainDataForm' autocomplete="off"
                                                method="POST" enctype="multipart/form-data" action="{{route('populateCalendar.generate')}}">
                                            <input type="hidden" name="_token" id="csrfTokenMain" value="{{ csrf_token() }}">
                                            <div class="row mt-0">
                                                <div class="col-md-4">
                                                    <div class='form-group'>
                                                        <label>Fiscal Year</label>                                                
                                                        <select id='FYCOHFiscalYearId' name ='FYCOHFiscalYearId' style='width: 100%;'>
                                                            <option value='0'>-- Select Fiscal Year --</option>
                                                        </select>                                                
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
                                                        <label>Calendar Id</label>                                                
                                                        <select id='FYCOHCalendarId' name = 'FYCOHCalendarId' style='width: 100%;'>
                                                            <option value='0'>-- Select Calendar Id --</option>
                                                        </select>                                                
                                                    </div> 
                                                </div>
                                                <div class="col-md-4 n-chk mt-4">
                                                    <button type="submit" class="btn btn-primary" id="submit">Submit</button>
                                                </div>
                                            </div>
                                        </form>                      
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="animated-underline-populatedCalendar" role="tabpanel" 
                                    aria-labelledby="animated-underline-populatedCalendar-tab">
                                    <div class="col-xl-12 col-lg-12 col-sm-12 layout-spacing">
                                        <div class="br-6">
                                            <form  id='singleLevelDataEntryForm' autocomplete="off"
                                                method="post" action="{{ route('populateCalendar.postData') }}">
                                                <input type="hidden" name="_token" id="csrfTokenDetail" value="{{ csrf_token() }}">
                                                <div class="table-responsive">
                                                    <table id="html5-extension3SIS" class="table table-hover non-hover" style="width:100%">
                                                        <thead>
                                                            <tr>
                                                                <th>Off Date</th>
                                                                <th>Reason</th>
                                                                <th>Off Day</th>
                                                                <th>Desc</th>
                                                            </tr>
                                                        </thead> 
                                                    </table>
                                                </div>
                                                <div>
                                                    <!--To display success messages-->
                                                <div style='float:right; padding-right:30px'>                                                    
                                                        <span id='form_output' style='float:left; padding-left:0px' ></span> 
                                                        <input type="hidden" name='button_action' id='button_action' value='insert'>
                                                        {{-- <input type="submit" name='save' id="action" value='save' 
                                                            class='btn btn-outline-success mb-2'> --}}
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
        $modalTitle = 'Calendar';
        fnUpdateDropdowns();
        $( "#FYCOHFiscalYearId" ).select2();
        $( "#FYCOHCalendarId" ).select2();
        // $("#animated-underline-populatedCalendar-tab").hide();
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
            pageLength: 15,
            lengthMenu: [5, 10, 20, 50],

            order: [[ 2, "asc" ],[ 4, "asc" ]],
            processing: true,
            serverSide: true,
            autoWidth: false,
            destroy: true,
            searching: false,               
            "ajax": "{{ route('populateCalendar.browserData')}}",        
            "columns":[    
                {data: "FYCOHOffDate"},
                {data: "FYCOHOffDateReason"},
                {data: "FYCOHOffDayCode"},                
                {data: "FYCOHDesc"},  
                {data: "OffDateSort", "visible": false},

            ],
            "columnDefs": [
                { "width": "10%", "targets": 0 },
                { "width": "20%", "targets": 1 },
                { "width": "10%", "targets": 2 },
                { "width": "20%", "targets": 3 },
            ]        
        });
        $('#FYCOHFiscalYearId').change(function(){
            fnShowTab();
            let id = $(this).val();
            fnGetFYStartAndEndDate(id);
        });
        $('#mainDataForm').on('submit', function(event){            
                event.preventDefault();
                $.ajax({
                    url: $(this).attr('action'),
                    method: $(this).attr('method'),
                    data: new FormData(this),
                    processData: false,
                    dataType: "json",
                    cache: false,
                    contentType: false,
                    success:function(data)
                    {
                        $("#animated-underline-populatedCalendar-tab").trigger('click'); 
                        $finalMessage3SIS = fnSingleLevelFinalSave(data.masterName, data.Id, data.Desc1, data.updateMode);
                        $('#FinalSaveMessage').html($finalMessage3SIS);
                        fnReinstateFormControl('0');
                        $('#html5-extension3SIS').DataTable().ajax.reload();
                        $('#modalZoomFinalSave3SIS').modal('show');
                    }
                })
            });
        function fnGetFYStartAndEndDate(id){
            $.ajax({
                url: "{{route('publicHoliday.getFiscalYearDate')}}",
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
        function fnShowTab(){
            if ($('#FYCOHCalendarId').val()!='-- Select Calendar --' && $('#FYCOHFiscalYearId').val()!='-- Select Fiscal Year --') {
                $("#animated-underline-populatedCalendar-tab").show();
            }
        }
    });
    
    function fnUpdateDropdowns(){
        // Fiscal Year Dropdown
        $.ajax({
            url: "{{route('dropDownMasters.getSelectedFiscalYear')}}",
            method: 'GET',
            data: {id:'00'},
            dataType: 'json',
            success: function(response) {
                $('#FYCOHFiscalYearId').html(response.SelectedItem);
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
                $('#FYCOHCalendarId').html(response.SelectedItem);
            },
            cache: true
        });
    }
    
    
</script>
@endsection


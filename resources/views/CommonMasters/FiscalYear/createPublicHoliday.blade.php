@extends('layouts.app')

@section('content')
<div class="layout-px-spacing">
        
        <div>
        
            <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
                <div class=" br-6">
                    
                     <!-- card start -->
    <div class="card component-card_1" id='entryCard' >
                        <div class="card-body"> 
                            <form  id='singleLevelDataEntryForm' autocomplete="off" method="post"action="{{ route('fiscalyear.postData')}}">
                                <input type="hidden" name="_token" id="csrfToken" value="{{ csrf_token() }}">
                                    <div class="container-fluid">
                                    <div class="row mt-0">
                                   <div class="col-md-6">
                                        <div class='form-group'>
                                            <label>Fiscal Year</label>                                                
                                            <span class="error-text periodId_error text-danger" 
                                                style='float:right;'></span>
                                            <select id='fyId' name = 'fyId' style='width: 100%;'>
                                                <option value='0'>-- Select Fiscal Year --</option>
                                            </select>                                                
                                        </div> 
                                 </div>
                                <div class="col md-6"> 
                                        <div class='form-group '>
                                        <label>Calender Id</label> 
                                        <select id='selectCalender' style='width: 100%;'>
                                            <option value='0'>-- Select Calender --</option>
                                        </select>                                                
                                        </div>                                             
                                </div>
                                </div> 
                            </form> 
                                                                         
                        </div> 
    </div>
            </div>
                    <div class="code-section-container show-code">
                        <div class="code-section text-left">
                        </div>
                    </div>
                     <!-- card end  -->
                    @include('commonViews3SIS.modalCommon3SIS')
               
    <script>        
        $(document).ready(function(){
           
            // Fiscal Year Dropdown
            $( "#fyId" ).select2({
                ajax: { 
                    url: "{{route('publicHoliday.getFiscalYear')}}",
                    type: "POST",
                    dataType: 'json',
                    tags: true,
                    // The number of milliseconds to wait for the user to stop typing before issuing the ajax request.
                    delay: 250,
                    // @param params The object containing the parameters used to generate the request.
                    data: function (params) {
                        return {
                            _token: $('#csrfToken').val(),
                            search: params.term // search term
                        }
                    },
                    processResults: function (response) {
                        return {
                            results: response
                        }
                    },
                    cache: true
                }
            });
            // Calendar Master Dropdown Ends  
            $( "#selectCalender" ).select2({
                    ajax: { 
                        url: "{{route('publicHoliday.getcalender')}}",
                        type: "post",
                        dataType: 'json',
                        tags: true,
                        // The number of milliseconds to wait for the user to stop typing before issuing the ajax request.
                        delay: 250,
                        // @param params The object containing the parameters used to generate the request.
                        data: function (params) {
                            return {
                                _token: $('#csrfToken').val(),
                                search: params.term // search term
                            }
                        },
                        processResults: function (response) {
                            return {
                                results: response
                            }
                        },
                        cache: true
                    }
                 });          
        });           
    </script>
@endsection

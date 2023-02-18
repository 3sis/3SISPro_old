@include('inc.function')
<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ setTitle($page_name) }}</title>
    <link rel="icon" type="image/x-icon" href="{{asset('storage/img/favicon.ico')}}"/>
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">

    <!-- Styles -->
    @include('inc.styles') 
    
    <!-- Fontawsome CSS -->
    <link rel="stylesheet" href="/assets/fontawesome/css/all.css">

    <script src="{{asset('assets/js/libs/jquery-3.1.1.min.js')}}"></script>
    <script src="{{asset('plugins/jquery-ui/jquery-ui.min.js')}}"></script>
    <script src="{{asset('bootstrap/js/popper.min.js')}}"></script>
    <script src="{{asset('bootstrap/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('assets/js/scrollspyNav.js')}}"></script>
    <script src="{{asset('plugins/bootstrap-maxlength/bootstrap-maxlength.js')}}"></script>
    <script src="{{asset('plugins/bootstrap-maxlength/custom-bs-maxlength.js')}}"></script> --}}
    <script src="{{asset('plugins/fullcalendar/moment.min.js')}}"></script>

    <!-- Fontawsome JS -->
    <script src="{{asset('assets/fontawesome/js/all.js')}}"></script>    

    <!-- Select2 -->
    <link rel="stylesheet" type="text/css" href="{{asset('plugins/select2/select2.min.css')}}">
    <script src="{{asset('plugins/select2/select2.min.js')}}"></script>
    
    <!-- Date and Range Picker -->
    <!-- <script src="{{asset('plugins/flatpickr/flatpickr.js')}}"></script>
    <script src="{{asset('plugins/noUiSlider/nouislider.min.js')}}"></script>
    <script src="{{asset('plugins/flatpickr/custom-flatpickr.js')}}"></script>
    <script src="{{asset('plugins/noUiSlider/custom-nouiSlider.js')}}"></script>
    <script src="{{asset('plugins/bootstrap-range-Slider/bootstrap-rangeSlider.js')}}"></script>  -->
    <link href="{{asset('assets/css/components/tabs-accordian/custom-tabs.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('assets/css/scrollspyNav.css')}}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/forms/theme-checkbox-radio.css')}}">

    <!-- 3SIS CSS and JS -->
    <link rel="stylesheet" href="/assets/css/css3SIS/dataTable3SIS.css">
    <link rel="stylesheet" href="/assets/css/css3SIS/button3SIS.css">
    <script src="{{asset('assets/js/common3SIS/validation3SIS.js')}}"></script>
    
    
</head>
<body {{ ($has_scrollspy) ? scrollspy($scrollspy_offset) : '' }} class=" {{ ($page_name === 'alt_menu') ? 'alt-menu' : '' }} {{ ($page_name === 'error404') ? 'error404 text-center' : '' }} {{ ($page_name === 'error500') ? 'error500 text-center' : '' }} {{ ($page_name === 'error503') ? 'error503 text-center' : '' }} {{ ($page_name === 'maintenence') ? 'maintanence text-center' : '' }}">
    
    <!-- BEGIN LOADER -->
    <div id="load_screen"> <div class="loader"> <div class="loader-content">
        <div class="spinner-grow align-self-center"></div>
    </div></div></div>
    <!--  END LOADER -->

    @include('inc.navbar')
    
    <!--  BEGIN MAIN CONTAINER  -->
    <div class="main-container" id="container">

        <div class="overlay"></div>
        <div class="search-overlay"></div>

        @include('inc.sidebar')

        <!--  BEGIN CONTENT PART  -->
        <div id="content" class="main-content">

            @yield('content')

            @if ($page_name != 'account_settings')
                @include('inc.footer')
            @endif
        </div>
        <!--  END CONTENT PART  -->

    </div>
    <!-- END MAIN CONTAINER -->

    @include('inc.scripts')

</body>
</html>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">
    <title>#~@root; Custom Admin Panel </title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" type="image/x-icon" href="https://designreset.com/cork/html/src/assets/img/favicon.ico"/>
    <link href="{{ asset(('layouts/semi-dark-menu/css/light/loader.css')) }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset(('layouts/semi-dark-menu/css/dark/loader.css')) }}" rel="stylesheet" type="text/css" />
    <script src="{{ asset(('layouts/semi-dark-menu/loader.js')) }}"></script>
    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:400,600,700" rel="stylesheet" />
    <link href="{{ asset(('src/bootstrap/css/bootstrap.min.css')) }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset(('layouts/semi-dark-menu/css/light/plugins.css')) }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset(('layouts/semi-dark-menu/css/dark/plugins.css')) }}" rel="stylesheet" type="text/css" />
    <!-- END GLOBAL MANDATORY STYLES -->
       <!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM STYLES -->
    <link rel="stylesheet" type="text/css" href="{{ asset('src/assets/css/light/elements/alert.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('src/assets/css/dark/elements/alert.css') }}">
    <link href="{{ asset(('css/toastr.css')) }}" rel="stylesheet" type="text/css" />
        
        <style>
            table tbody tr td{
                white-space:normal !important;
            }

            .ts-wrapper{
            height:100% !important;
            }
            .fade:not(.show){
                display:none;
            }
        </style>
    <!-- END PAGE LEVEL PLUGINS/CUSTOM STYLES -->
    @stack('custom-css')    
    <!-- END PAGE LEVEL CUSTOM STYLES -->
</head>
<body class="layout-boxed ">
    <!-- BEGIN LOADER -->
    <div id="load_screen"> <div class="loader"> <div class="loader-content">
        <div class="spinner-grow align-self-center"></div>
    </div></div></div>
    <!--  END LOADER -->

    @include('admin.layouts.header')
    <!--  END NAVBAR  -->

    <!--  BEGIN MAIN CONTAINER  -->
    <div class="main-container " id="container">

        <div class="overlay"></div>
        <div class="cs-overlay"></div>
        <div class="search-overlay"></div>

        <!--  BEGIN SIDEBAR  -->
        @include('admin.layouts.sidebar')
        <!--  END SIDEBAR  -->

        <!--  BEGIN CONTENT AREA  -->
        <div id="content" class="main-content">
            <div class="layout-px-spacing">

                <div class="middle-content container-xxl p-0">
                   @yield('content')
                </div>
                
            </div>

            <!--  BEGIN FOOTER  -->
            <div class="footer-wrapper">
                <div class="footer-section f-section-1">
                    <p class="">Copyright © <span class="dynamic-year">2022</span> <a target="_blank" href="https://designreset.com/cork-admin/">DesignReset</a>, All rights reserved.</p>
                </div>
                <div class="footer-section f-section-2">
                    <p class="">Coded with <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-heart"><path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"></path></svg></p>
                </div>
            </div>
            <!--  END CONTENT AREA  -->
        </div>
        <!--  END CONTENT AREA  -->
    </div>
    <!-- END MAIN CONTAINER -->
    
    
    
     <!-- BEGIN GLOBAL MANDATORY SCRIPTS -->
     
    <script src="//code.jquery.com/jquery-3.6.3.min.js"></script>
    <script src="{{ asset('src/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{ asset('src/plugins/src/perfect-scrollbar/perfect-scrollbar.min.js') }}"></script>
    <script src="{{ asset('src/plugins/src/mousetrap/mousetrap.min.js') }}"></script>
    <script src="{{ asset('src/plugins/src/waves/waves.min.js') }}"></script>
    <script src="{{ asset('layouts/semi-dark-menu/app.js') }}"></script>
    <script src="{{ asset(('js/toastr.min.js')) }}"></script>
    <script src="{{ asset('src/assets/js/custom.js') }}"></script>
    <!-- END GLOBAL MANDATORY SCRIPTS -->

    <script type='text/javascript'>
     @if(Session::has('message'))
        toastr.{{Session::get('type')}}("{{Session::get('message')}}","{{Session::get('title')}}");
    @endif
        
          @if($errors->any())
            @foreach($errors->all() as $err)
                toastr.error("{{ $err }}");
            @endforeach
        @endif
    
    </script>
    
    @stack('custom-js')
    
    <script type="text/javascript">
        $(function(){
        
            $tabdiv = $(".tabdiv");
            $(".tabdiv:not(.active)").hide();
            $link = $(".simple-tab .nav-item .nav-link");
            $link.click(function(){
                $link_id = $(this).attr("data-bs-target");
                $tabdiv.hide();
                $($link_id).fadeIn()

            });
        });
    </script>
    
    <!-- BEGIN PAGE LEVEL SCRIPTS -->
    
    <!-- END PAGE LEVEL SCRIPTS -->  
</body>

</html>
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

    <head>
        <meta charset="utf-8">
        <meta content="width=device-width, initial-scale=1.0" name="viewport">
        <title>{{isset($title)?$title:'Taskboard'}}</title>
        <meta name="csrf-token" content="{{ csrf_token() }}"> 
        <link rel="icon" type="image/png" href="{{asset('web/img/index_logo.jpg')}}" />
        <!-- START: Template CSS-->
        @include('web.layouts.links')
        @yield('css')
        <!-- END: Custom CSS-->
        <style>
            .novel-section img{
                width: 100% !important;    
                height: 500px !important;
                object-fit: cover !important;
            }
            
        </style>
    </head>
    <!-- END Head-->

    <!-- START: Body-->
    
    <body id="main-container" class="default semi-dark">
        <div class="main-body">
        <input type="hidden" id="web_url" value="{{url('/')}}"/>
        <!-- START: Pre Loader-->
        <div class="se-pre-con">
            <div class="loader"></div>
        </div>
        <!-- END: Pre Loader-->
        <!-- START: Header-->
        @include('web.layouts.header')
        <!-- END: Header-->
        
        @auth
        <!-- START: Main Menu-->
        @include('web.layouts.sidebar')
        
        <!-- END: Main Menu-->
        @endauth
        <!-- START: Main Content-->
        @yield('content')
        <!-- END: Content-->
        <!-- START: Footer-->
        @include('web.layouts.footer')
        <!-- END: Footer-->

        <!-- START: Back to top-->
        <a href="#" class="scrollup text-center"> 
            <i class="icon-arrow-up"></i>
        </a>
        <!-- END: Back to top-->



        <!-- START: Template JS-->
        @include('web.layouts.scripts')
        
        @yield('js')
        
        </div>
    </body>
    <!-- END: Body-->
</html>

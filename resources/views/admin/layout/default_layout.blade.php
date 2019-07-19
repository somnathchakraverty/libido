<?php
header("Cache-Control: no-cache, no-store, must-revalidate"); // HTTP 1.1.
header("Pragma: no-cache"); // HTTP 1.0.
header("Expires: 0 "); // Proxies.
?>

<!DOCTYPE html>
<html lang="en" class='app'>
    <head>
        @include('admin.layout.header_include')
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script>        
        <script>
            var SITE_URL = "{{url('')}}";
        </script>
    </head>
    <body class="skin-blue sidebar-mini">
        <div id="loader_div" class="col-lg-12 loader-div checkborder">
            <img class="center-block" src="{{URL::asset('assets/img/loader.gif')}}">
        </div>
        <div id="app" v-cloak>
            <div class="wrapper">

                @include('admin.layout.menu_header')

                @include('admin.layout.sidebar')
                <!-- Content Wrapper. Contains page content -->
                <div class="content-wrapper" style="background-color: #C0C0C0" !important;>

                    <!-- Main content -->
                    <section class="content">
                        <!-- Your Page Content Here -->
                        @yield('main-content')
                    </section><!-- /.content -->
                </div><!-- /.content-wrapper -->


                @include('admin.layout.footer_include')

            </div><!-- ./wrapper -->
        </div>
        @yield('scriptjs')
        <div class="loader" id="divLoading"></div>
        <!-- jQuery 3 -->
    </body>
    
</html>
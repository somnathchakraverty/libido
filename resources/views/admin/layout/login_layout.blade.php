<?php
header("Cache-Control: no-cache, no-store, must-revalidate"); // HTTP 1.1.
header("Pragma: no-cache"); // HTTP 1.0.
header("Expires: 0 "); // Proxies.
?>

<!DOCTYPE html>
<html lang="en" class='app'>
    <head>
        @include('admin.layout.header_include')
        <script>
            var SITE_URL = "{{url('')}}";
        </script>
    </head>
    <body class="hold-transition login-page">
        <div class="loading-overpay">
            <div class="loading">
                <div class="loading-bar"></div>
            </div>
        </div>
        <!-- loading Html -->
        @yield('content')
        @yield('scriptjs')
        <script src="{{URL::asset('assets/bower_components/jquery/dist/jquery.min.js')}}"></script>
        <!-- Bootstrap 3.3.7 -->
        <script src="{{URL::asset('assets/bower_components/bootstrap/dist/js/bootstrap.min.js')}}"></script>
    </body>
</html>
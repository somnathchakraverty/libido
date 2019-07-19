

<!-- Main Header -->
<header class="main-header">

    <div class="logo" style="background-color: #101115 !important">
        <a href="{{ url('/home') }}"><img style="margin-left: -10px;" src="{{asset('images/logo@2x.png')}}" /></a>
    </div>
    <!-- Header Navbar -->
    <nav class="navbar navbar-static-top" style="background-color: #101115 !important" role="navigation">
        <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
            <!--<span class="sr-only">{{ trans('adminlte_lang::message.togglenav') }}</span>-->
        </a>
        <!-- Navbar Right Menu -->
        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
                @if (Auth::guest())
                <li><a href="{{ url('/register') }}">{{ trans('adminlte_lang::message.register') }}</a></li>
                <li><a href="{{ url('/login') }}">{{ trans('adminlte_lang::message.login') }}</a></li>
                @else
                <!-- User Account Menu -->
                <li class="dropdown user user-menu" id="user_menu">
                    <!-- Menu Toggle Button -->
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <!-- The user image in the navbar-->
                        <img src="{{asset('assets/img/dummy.jpg')}}" class="user-image" alt="User Image"/>
                        <!-- hidden-xs hides the username on small devices so only the image appears. -->
                        <span class="hidden-xs">Admin</span>
                    </a>
                    <ul class="dropdown-menu">
                        <!-- The user image in the menu -->
                        <li class="user-header" style="background-color: #343434" !important;>
                            <img src="{{asset('assets/img/dummy.jpg')}}" class="img-circle" alt="User Image" />
                            <p>
                                {{ Auth::user()->user_first_name }}
                                Admin
                            </p>
                        </li>

                        <!-- Menu Footer-->
                        <li class="user-footer">
                            <div class="pull-left">
                                <a href="{{ url('/change-password') }}" class="btn btn-default btn-flat" id="logout">
                                    Change Password
                                </a>
                            </div>
                            <div class="pull-right">
                                <a href="javascript:void(0);" onclick="askLogout()" class="btn btn-default btn-flat" id="logout">
                                    Signout
                                </a>
                            </div>
                        </li>
                    </ul>
                </li>
                @endif
            </ul>
        </div>
    </nav>


    <script>
        function askLogout() {
            var r = confirm("Do you really want to logout?");
            if (r == true) {
                window.location.href = "/logout";
            }
        }
    </script>

</header>

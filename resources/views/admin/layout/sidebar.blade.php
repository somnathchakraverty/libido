<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar" style="background-color: #343434 !important">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar Menu -->
        <ul class="sidebar-menu">
            <li class="header"></li>
            <!-- Optionally, you can add icons to the links -->
            <li id="toy-list" class="{{ Request::is('home') ? 'active' : ''}} sidebar-in"><a href="{{ url('home')}}"><i class='fa fa-link'></i><span>Home</span></a></li>
            <li id="advertiser-list" class="{{ Request::is('advertiser/*') ? 'active' : ''}} sidebar-in"><a href="{{ url('advertiser/advertiser-list')}}"><i class='fa fa-link'></i><span>Advertiser</span></a></li>
            <li id="toy-list" class="{{ Request::is('toy/*') ? 'active' : ''}} sidebar-in"><a href="{{ url('toy/toy-list')}}"><i class='fa fa-link'></i><span>Toy</span></a></li>
            <li id="condom-list" class="{{ Request::is('condom/*') ? 'active' : ''}} sidebar-in"><a href="{{ url('condom/condom-list')}}"><i class='fa fa-link'></i><span>Protection Brand</span></a></li>
            <li id="survey-list" class="{{ Request::is('survey/*','question/*') ? 'active' : ''}} sidebar-in"><a href="{{ url('survey/survey-list')}}"><i class='fa fa-link'></i><span>Survey</span></a></li>
            <li id="survey-list" class="{{ Request::is('challenge') ? 'active' : ''}} sidebar-in"><a href="{{ url('challenge')}}"><i class='fa fa-link'></i><span>Challenge Report</span></a></li>

        </ul><!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
</aside>

  
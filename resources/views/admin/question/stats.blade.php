@extends('admin.layout.default_layout')
@section('main-content')
<div class="container-fluid spark-screen">
    <div class="row">
        @include('admin.layout.flash_msg')
        <div class="col-md-12 ">
            <div class="box box-info">
                
                <!-- /.box-header -->
                <div class="box-body">
                <a href="/survey/survey-list/" class="btn btn-primary pull-right" style="margin-right: 20px;" id="add_diagram_button" >Survey List</a>   
                <a href="{{ URL::previous() }}" class="btn btn-primary pull-right" style="margin-right: 20px;" id="add_diagram_button" >Back</a>   
                    <div class="col-md-10 col-md-offset-1" id="add_new_diagram_form">
                        <h3 class="text-center">{{$ques}}</h3>
                        <br>
                        <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
                        <script type="text/javascript">
google.charts.load('current', {'packages': ['corechart']});
google.charts.setOnLoadCallback(drawChart);

function drawChart() {

    var data = google.visualization.arrayToDataTable([
        ['Task', 'Hours per Day'],
        ['Interested', <?php echo $a; ?>],
        ['Interested if partner is', <?php echo $b; ?>],
        ['Not Interested', <?php echo $c; ?>]
    ]);

    var options = {
        title: '',
        is3D: true,
    };

    var chart = new google.visualization.PieChart(document.getElementById('piechart'));

    chart.draw(data, options);
}
                        </script>
                        <div id="piechart" style="width: 1000px; height: 500px;"></div>
                    </div>
<!--                    <div class="col-lg-4 col-xs-6">
                        <div class="dropdown">
                            <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">Select City
                                <span class="caret"></span></button>
                            <ul class="dropdown-menu">
                                @foreach ($city as $a)
                                <li><a href="/question/stats/{{$quesId}}?city={{$a->city}}">{{$a->city}}</a></li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-4 col-xs-6">
                        <div class="dropdown">
                            <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">Select Country
                                <span class="caret"></span></button>
                            <ul class="dropdown-menu">
                                @foreach ($country as $a)
                                <li><a href="/question/stats/{{$quesId}}?country={{$a->country}}">{{$a->country}}</a></li>
                                @endforeach
                            </ul>
                        </div>
                    </div>-->


                </div>
                <!-- /.box-body -->
            </div>
        </div>
    </div>
</div>
@stop


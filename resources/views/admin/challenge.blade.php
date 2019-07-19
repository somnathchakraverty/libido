@extends('admin.layout.default_layout')

@section('main-content')

<link href="{{URL::asset('css/monthpicker.css')}}" rel="stylesheet" type="text/css">
<input id="demo-1" type="text">
<script src="//code.jquery.com/jquery-1.11.3.min.js"></script>
<script src="{{URL::asset('js/monthpicker.min.js')}}"></script>
<script>$('#demo-1').Monthpicker({

  // default values
  // format: mm/yyyy
  minYear: null,
  maxYear: null,
  minValue: null,
  maxValue: null,

  // i18n
  monthLabels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jui", "Aug", "Sep", "Oct", "Nov", "Dec"],

  // Callback events
  onSelect: function() {        
 
 var data =$('#demo-1').val();
var arr = data.split('/');
//alert(arr[0]);
//alert(arr[1]);
window.location.replace('/challenge?month='+arr[0]+'&year='+arr[1]);
  },
  onClose: function() { return; }

});</script>
<br>
<div class="container-fluid spark-screen">
    <div class="row">

        <div class="col-lg-4 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-aqua">
                <div class="inner">
                    <h3></h3>

                    <p>Solo Percentage</p>
                </div>

            </div>
            <div class="admin-home">
                {{$soloPer}} %
            </div>
        </div>
        <div class="col-lg-4 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-yellow">
                <div class="inner">
                    <h3></h3>

                    <p>Partner Percentage</p>
                </div>

            </div>
            <div class="admin-home">
                {{$partPer}} %
            </div>

        </div>
    </div>
    </div>
@stop
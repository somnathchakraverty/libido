@extends('admin.layout.default_layout')

@section('main-content')
<div class="container-fluid spark-screen">
    <b>{{$detail['cityName']}}{{$detail['countryName']}}   </b>
    <div class="row">
        <div class="col-lg-4 col-xs-6">
            <div class="dropdown">
                <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">Select City
                    <span class="caret"></span></button>
                <ul class="dropdown-menu">
                    @foreach ($detail['city'] as $a)
                    <li><a href="/home?city={{$a->city}}">{{$a->city}}</a></li>
                    @endforeach
                </ul>
            </div>
        </div>
        <div class="col-lg-4 col-xs-6">
            <div class="dropdown">
                <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">Select Country
                    <span class="caret"></span></button>
                <ul class="dropdown-menu">
                    @foreach ($detail['country'] as $a)
                    <li><a href="/home?country={{$a->country}}">{{$a->country}}</a></li>
                    @endforeach
                </ul>
            </div>
        </div>
        <div class="col-lg-4 col-xs-6">
            <div class="dropdown">
                
                <a class="btn btn-primary dropdown-toggle" href="/home" >Clear Filter</a>
            </div>
        </div>
        <div class="col-lg-4 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-aqua">
                <div class="inner">
                    <h3></h3>

                    <p>Average Sessions</p>
                </div>

            </div>
            <div class="admin-home">
                {{$detail['avgSession']}}
            </div>
        </div>
        <div class="col-lg-4 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-yellow">
                <div class="inner">
                    <h3></h3>

                    <p>Day Since an encounter(Solo)</p>
                </div>

            </div>
            <div class="admin-home">
                {{$detail['enc']['solo']}}
            </div>

        </div>
        <div class="col-lg-4 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-maroon">
                <div class="inner">
                    <h3></h3>
                    <p>Day Since an encounter(Partner)</p>
                </div>
            </div>
            <div class="admin-home">
                {{$detail['enc']['partner']}}
            </div>

        </div>
    </div>
    <div class="row">
        <div class="col-lg-4 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-blue">
                <div class="inner">
                    <h3></h3>

                    <p>Best Streak</p>
                </div>

            </div>
            <div class="admin-home">
                {{$detail['enc']['bestStreak']}}
            </div>

        </div>
        <div class="col-lg-4 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-green">
                <div class="inner">
                    <h3></h3>

                    <p>Longest Dry Spell</p>
                </div>

            </div>
            <div class="admin-home">
                {{$detail['enc']['longestWithoutIntercourse']}}
            </div>

        </div>
        <div class="col-lg-4 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-red">
                <div class="inner">
                    <h3></h3>

                    <p>Longest Duration</p>
                </div>
            </div>
            <div class="admin-home">
                {{$detail['enc']['longestDuration']}}
            </div>

        </div>
        <div class="col-lg-4 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-purple">
                <div class="inner">
                    <h3></h3>

                    <p>Favourite Position</p>
                </div>
            </div>
            @foreach($detail['fav']['position'] as $pos)
            <div class="admin-home-down">
                {{$pos['name']}}   &nbsp;&nbsp;&nbsp;&nbsp; : &nbsp;&nbsp; &nbsp;&nbsp;  {{$pos['c']}}
            </div>
            @endforeach

        </div>
        <div class="col-lg-4 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-orange">
                <div class="inner">
                    <h3></h3>

                    <p>Favourite Room</p>
                </div>
            </div>
            @foreach($detail['fav']['room'] as $pos)
            <div class="admin-home-down">
                {{$pos['name']}}   &nbsp;&nbsp;&nbsp;&nbsp; : &nbsp;&nbsp; &nbsp;&nbsp;  {{$pos['c']}}
            </div>
            @endforeach

        </div>
        <div class="col-lg-4 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-navy">
                <div class="inner">
                    <h3></h3>

                    <p>% Breakdown of Position</p>
                </div>
            </div>
            @foreach($detail['fav']['position'] as $pos)
            <div class="admin-home-down">
                {{$pos['name']}}   &nbsp;&nbsp;&nbsp;&nbsp; : &nbsp;&nbsp; &nbsp;&nbsp;  {{$pos['p']}}%
            </div>
            @endforeach

        </div>


    </div>
</div>
@stop
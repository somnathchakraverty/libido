@extends('admin.layout.login_layout')
@section('title') {{'Admin Login'}}  @parent @stop {{-- Content --}}
@section('content')
<div class="login-box">
    <div class="login-logo">
        <img src="{{asset('web/assets/img/on-the-ball-logo-text-final.png')}}" />
    </div>
    <!-- /.login-logo -->
    <div class="login-box-body">
        <p class="login-box-msg">Forgot password ?</p>
        @include('admin.layout.flash_msg')
        <form action="{{url('password/email')}}" id="admin-forgot-password" class="panel-body wrapper-lg admin-forgot-password" method="post">
            {!! csrf_field() !!}
            <div class="form-group has-feedback">
                <input type="hidden" name="userType" id="user_type" class="user_type" value="1" />
                <input type="email" name="email" id="forgot-email"  class="form-control" placeholder="Email">
                <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
            </div>
            <div class="row">
                <!-- /.col -->
                <div class="col-xs-12">
                    <button type="submit" class="btn btn-primary btn-block btn-flat" id="forgot-password">Submit</button>
                </div>
                <!-- /.col -->
            </div>
        </form>
        <a style="margin-left: 15px;" href="{{url('auth/login')}}">Login</a><br>
    </div>
    <!-- /.login-box-body -->
</div>
@stop


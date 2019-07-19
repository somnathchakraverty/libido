@extends('admin.layout.login_layout')
@section('title') {{'Admin Login'}}  @parent @stop {{-- Content --}}
@section('content')
<div class="login-box">
    <div class="login-logo">
        <img src="{{asset('web/assets/img/on-the-ball-logo-text-final.png')}}" />
    </div>
    <!-- /.login-logo -->
    <div class="login-box-body">
        <p class="login-box-msg">Sign in to start your session</p>
        @include('admin.layout.flash_msg')
        <form action="{{url('auth/login')}}" id="admin_login" class="panel-body wrapper-lg admin_login" method="post">
            {!! csrf_field() !!}
            <div class="form-group has-feedback">
                <input type="hidden" name="userType" id="user_type" class="user_type" value="1" />
                <input type="email" name="email" class="form-control" placeholder="Email">
                <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
            </div>
            <div class="form-group has-feedback">
                <input type="password" name="password" class="form-control" placeholder="Password">
                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
            </div>
            <div class="row">
                <div class="col-xs-8">
                    <div class="checkbox icheck">
                        <a href="{{url('password/email')}}">Forgot Password ?</a><br>
                    </div>
                </div>
                <!-- /.col -->
                <div class="col-xs-4">
                    <button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
                </div>
                <!-- /.col -->
            </div>
        </form>
    </div>
    <!-- /.login-box-body -->
</div>
@stop
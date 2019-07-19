@extends('admin.layout.login_layout')
@section('title') {{'Admin Login'}}  @parent @stop {{-- Content --}}
@section('content')
<div class="login-box">
    <div class="login-logo">
        <img src="{{asset('web/assets/img/on-the-ball-logo-text-final.png')}}" />
    </div>
    <!-- /.login-logo -->
    <div class="login-box-body">
        <p class="login-box-msg">Reset Password</p>
        @include('admin.layout.flash_msg')
        @if(isset($reset_error_msg) && !Session::get('success_msg'))
        <h2 class="text-center">{{ $reset_error_msg }}</h2>
        @else
        @if(!Session::get('success_msg'))
        <form action="{{url('password/reset')}}" id="admin-forgot-password" class="panel-body wrapper-lg admin-forgot-password" method="post">
            {!! csrf_field() !!}
            <input type="hidden" name="token" value="{{ $token }}">
            <input type="hidden" name="user_type" value="{{config('constants.USER_TYPE.admin')}}">
            <div class="form-group has-feedback">
                <input type="password" id="new_password" value="" class="form-control tb-big band_name" name="password" placeholder="New Password">
            </div>
            <div class="form-group has-feedback">
                <input type="password" id="confirm_password" value="" class="form-control tb-big band_name" name="password_confirmation" placeholder="Confirm New Password">
            </div>
            <div class="row">
                <!-- /.col -->
                <div class="col-xs-12">
                    <button type="submit" class="btn btn-primary btn-block btn-flat" id="forgot-password">Reset Password</button>
                </div>
                <!-- /.col -->
            </div>
        </form>
        @endif
        @endif
        <a style="margin-left: 15px;" href="{{url('auth/login')}}">Login</a><br>
    </div>
    <!-- /.login-box-body -->
</div>
@stop


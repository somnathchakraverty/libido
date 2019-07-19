@extends('admin.layout.default_layout')

@section('main-content')
<div class="container-fluid spark-screen">
    <div class="row">
        <div class="col-md-6 col-md-offset-3">

            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">Change Password</h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->
                <form class="form-horizontal " method="POST" action="{{url('change-password')}}">
                    {!! csrf_field() !!}
                    <div class="box-body">
                        @include('admin.layout.flash_msg')
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="user_name" class="col-sm-5 control-label">Current Password: <span class="required" style="color:red">*</span></label>
                                <div class="col-sm-7">
                                    <input type="password" value=""  autocomplete="new-password" class="form-control " name="oldPassword">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="new_password" class="col-sm-5 control-label">New Password: <span class="required" style="color:red">*</span></label>
                                <div class="col-sm-7">
                                    <input type="password" value=""  autocomplete="new-password" class="form-control " name="password">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="password" class="col-sm-5 control-label">Confirm Password: <span class="required" style="color:red">*</span></label>
                                <div class="col-sm-7">
                                    <input type="password" value=""  autocomplete="new-password" class="form-control " name="password_confirmation">
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer">
                        <button type="submit" class="btn btn-info pull-right">Submit</button>
                    </div>
                    <!-- /.box-footer -->
                </form>
            </div>

        </div>


    </div>

</div>


@include ('admin.user.popup')
@include ('admin.user.delete_popup')
<!-- /#page-wrapper -->
<!--END PAGE WRAPPER-->
@stop


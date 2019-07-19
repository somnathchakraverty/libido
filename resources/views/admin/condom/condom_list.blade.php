@extends('admin.layout.default_layout')
@section('main-content')
<div class="container-fluid spark-screen">
    <div class="row">
        @include('admin.layout.flash_msg')
        <div class="col-md-12 ">
            <div class="box box-info">
                @include('admin.condom.condom_list_header')
<!--                <div class="box-header">
                    <h3 class="box-title">Condom List</h3>
                </div>-->
                <!-- /.box-header -->
                <div class="box-body">
                    <div id="example1_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
                        <table id="basicDataTable" class="table table-bordered table-striped dataTable no-footer">
                            <thead class="custom-head">
                                <tr>
                                    <th >S. No.</th>
                                    <th>Name</th>
<!--                                    <th style="text-align: center;">Image</th>-->
                                    <th>Action</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
                <!-- /.box-body -->
            </div>

        </div>
    </div>

</div>
@include ('admin.condom.delete_popup')
<!-- /#page-wrapper -->
<!--END PAGE WRAPPER-->
@section('scriptjs')
<script src="{{URL::asset('assets/js/condom_list.js')}}"></script>
<script>
function deleteCondom(id) {
    $("#condom_delete_id").val(id);
    $('#delete_popup_modal').modal('show');
}
</script>
@stop
@stop

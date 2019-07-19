@extends('admin.layout.default_layout')
@section('main-content')
<div class="container-fluid spark-screen">
    <div class="row">
        
        @include('admin.layout.flash_msg')
        <div class="col-md-12 ">
            <div class="box box-info">
                @include('admin.question.question_list_header')
<!--                <div class="box-header">
                    <h3 class="box-title">Question List</h3>
                </div>-->
                <!-- /.box-header -->
                <div class="box-body">
                    <div id="example1_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
                        <input type="hidden" name="question_id" id="question_id" value="{{$id}}">
                        <table id="basicDataTable" class="table table-bordered table-striped dataTable no-footer">
                            <thead class="custom-head">
                                <tr>
                                    <th >S. No.</th>
                                    <th>Question</th>
<!--                                    <th>Is Active</th>-->
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
@include ('admin.question.delete_popup')
<!-- /#page-wrapper -->
<!--END PAGE WRAPPER-->
@section('scriptjs')
<script src="{{URL::asset('assets/js/question_list.js')}}"></script>
<script>
function deleteQuestion(id) {
    $("#question_delete_id").val(id);
    $('#delete_popup_modal').modal('show');
}
function changeStatus(id) {
    $("#change_status_id").val(id);
    $('#change_status_popup_modal').modal('show');
}
</script>
@stop
@stop

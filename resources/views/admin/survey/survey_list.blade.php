@extends('admin.layout.default_layout')
@section('main-content')
<div class="container-fluid spark-screen">
    <div class="row">
        @include('admin.layout.flash_msg')
        <div class="col-md-12 ">
            <div class="box box-info">
                @include('admin.survey.survey_list_header')
<!--                <div class="box-header">
                    <h3 class="box-title">Survey List</h3>
                </div>-->
                <!-- /.box-header -->
                <div class="box-body">
                    <div id="example1_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
                        <table id="basicDataTable" class="table table-bordered table-striped dataTable no-footer">
                            <thead class="custom-head">
                                <tr>
                                    <th >S. No.</th>
                                    <th>Name</th>
                                    <th>Question Count</th>
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
@include ('admin.survey.delete_popup')
<!-- /#page-wrapper -->
<!--END PAGE WRAPPER-->
@section('scriptjs')
<script src="{{URL::asset('assets/js/survey_list.js')}}"></script>
<script>
function deleteSurvey(id) {
    $("#survey_delete_id").val(id);
    $('#delete_popup_modal').modal('show');
}
function changeStatus(id, status) {
    console.log(status);
    if(status == 1){
        $('.delete_modal_text').html("Changing the status from ACTIVE to INACTIVE will hide this survey for the users who haven’t responded to this survey. Are you sure you want to continue?");
    }else{
        $('.delete_modal_text').html("Changing the status from INACTIVE to ACTIVE will show this survey for the users who haven’t responded to this survey. Are you sure you want to continue?");
    }
    $("#change_status_id").val(id);
    $('#change_status_popup_modal').modal('show');
}
</script>
@stop
@stop

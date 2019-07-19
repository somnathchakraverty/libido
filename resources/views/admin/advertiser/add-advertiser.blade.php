@extends('admin.layout.default_layout')
@section('main-content')
<div class="container-fluid spark-screen">
    <div class="row">
        @include('admin.layout.flash_msg')
        <div class="col-md-12 ">
            <div class="box box-info">
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="col-md-10 col-md-offset-1" id="add_new_diagram_form">
                        <h3 class="text-center">Add Advertiser</h3>
                        <br>
                        <form autocomplete="off" enctype="multipart/form-data" class="form-horizontal" action="{{route('post_add_advertiser')}}" method="post" id="add_diagram_form">
                            {!! csrf_field() !!}
                            <div class="form-group">
                                <label class="control-label col-sm-2" for="name">Name: <span class="required" style="color:red">*</span></label>
                                <div class="col-sm-10">
                                    <input required type="text" name = "name" class="form-control" id="name" placeholder="Enter Name">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-sm-2" for="name">Image: <span class="required" style="color:red">*</span></label>
                                <div class="col-sm-10">
                                    <input type="file" accept="image/*"  name = "image" class="form-control" id="image" placeholder="Enter Name">
                                </div>
                            </div>
                            <br>
                            <div class="modal-footer">
                                <button id="create_diagram_button" type="submit" class="btn btn-info" >Add Advertiser</button>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- /.box-body -->
            </div>
        </div>
    </div>
</div>
<!--@section('scriptjs')
<script src="{{URL::asset('assets/js/diagrams/all_diagrams.js')}}"></script>
<script>
                                    function cancelAdd($category_id) {
                                    window.location.href = SITE_URL + '/admin/diagrams/list/' + $category_id;
                                    }
</script>
@stop-->
@stop


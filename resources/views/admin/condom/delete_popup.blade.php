
<!-- Modal -->

<div class="modal modal-danger fade" id="delete_popup_modal" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span></button>
                <h4 class="modal-title">Warning!</h4>
            </div>
            <div class="modal-body">
                <p id="delete_modal_text">Are you sure you want to delete this protection brand?</p>
            </div>
            <form class="form-horizontal" action="{{url('condom/remove-condom')}}" method="post" id="delete_training_pack_modal_form">
                {!! csrf_field() !!}

                <input type="hidden" name="condom_delete_id" value="" id="condom_delete_id">

                <div class="modal-footer">
                    <button id="yes_button_delete" type="submit" class="btn btn-danger" >Yes</button>
                </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>


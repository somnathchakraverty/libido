@if (isset($errors) && $errors->any())
<div class="alert alert-danger alert-dismissable server-error alert-dismissable">
    <button type="button" class="close" data-dismiss="alert" aria-label="close">×</button>
    <h4><i class="icon fa fa-ban"></i> Error!</h4>
    @foreach($errors->all() as $key=>$message)
    <label class="error-msg">* {{$message}}</label><br/>
    @endforeach
</div>
@elseif (Session::has('status'))
<div class="alert alert-danger alert-dismissable server-error alert-dismissable">
    <button type="button" class="close" data-dismiss="alert" aria-label="close">×</button>
    <h4><i class="icon fa fa-ban"></i> Error!</h4>
    <label class="text-success">{{Session::get('status')}}</label><br/>
</div>
@endif

@if(Session::get('error_msg')) 
<div class="alert alert-danger alert-dismissable">
    <button type="button" class="close" data-dismiss="alert" aria-label="close">×</button>
    <h4><i class="icon fa fa-ban"></i> Error!</h4>
    {{Session::get('error_msg')}}
</div>
@elseif(Session::get('success_msg'))
<div class="alert alert-success alert-dismissable">
    <button type="button" class="close" data-dismiss="alert" aria-label="close">×</button>
    <h4><i class="icon fa fa-check"></i> Success !</h4>
    {{Session::get('success_msg')}}
</div>
@endif 
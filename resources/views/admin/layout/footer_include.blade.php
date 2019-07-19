

<footer class="main-footer">
    <div class="pull-right hidden-xs">
        <b>Version</b> 1.0.0
    </div>
    <strong>Copyright &copy;  <a href="{{URL::asset('')}}">Libido</a>.</strong> All rights
    reserved.
</footer>
        <script src="{{URL::asset('assets/bower_components/jquery/dist/jquery.min.js')}}"></script>
        <!-- Bootstrap 3.3.7 -->
        <script src="{{URL::asset('assets/bower_components/bootstrap/dist/js/bootstrap.min.js')}}"></script>
        <!-- Select2 -->
        <script src="{{URL::asset('assets/bower_components/select2/dist/js/select2.full.min.js')}}"></script>
        <!-- InputMask -->
        <script src="{{URL::asset('assets/plugins/input-mask/jquery.inputmask.js')}}"></script>
        <script src="{{URL::asset('assets/plugins/input-mask/jquery.inputmask.date.extensions.js')}}"></script>
        <script src="{{URL::asset('assets/plugins/input-mask/jquery.inputmask.extensions.js')}}"></script>
        <!-- date-range-picker -->
        <script src="{{URL::asset('assets/bower_components/moment/min/moment.min.js')}}"></script>
<!--        <script src="{{URL::asset('assets/bower_components/bootstrap-daterangepicker/daterangepicker.js')}}"></script>-->
        <!-- bootstrap datepicker -->
<!--        <script src="{{URL::asset('assets/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js')}}"></script>-->
        <!-- bootstrap color picker -->
        <script src="{{URL::asset('assets/bower_components/bootstrap-colorpicker/dist/js/bootstrap-colorpicker.min.js')}}"></script>
        <!-- bootstrap time picker -->
        <script src="{{URL::asset('assets/plugins/timepicker/bootstrap-timepicker.min.js')}}"></script>
        
        <script src="{{URL::asset('assets/bower_components/datatables.net/js/jquery.dataTables.min.js')}}"></script>
        
        <script src="{{URL::asset('assets/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js')}}"></script>
        <!-- SlimScroll -->
        <script src="{{URL::asset('assets/bower_components/jquery-slimscroll/jquery.slimscroll.min.js')}}"></script>
        <!-- iCheck 1.0.1 -->
        <script src="{{URL::asset('assets/plugins/iCheck/icheck.min.js')}}"></script>
        <!-- FastClick -->
        <script src="{{URL::asset('assets/bower_components/fastclick/lib/fastclick.js')}}"></script>
        <!-- AdminLTE App -->
        <script src="{{URL::asset('assets/dist/js/adminlte.js')}}"></script>
        <!-- AdminLTE for demo purposes -->
        <script src="{{URL::asset('assets/dist/js/demo.js')}}"></script>
        <script src="{{URL::asset('assets/dist/js/custom.js')}}"></script>
        <script src="{{URL::asset('assets/admin/meo-master/meo.js')}}"></script>
        
        
        
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.7.5/css/bootstrap-select.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.7.5/js/bootstrap-select.min.js"></script>
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/js/bootstrap-datepicker.min.js"></script>
     <script>
                                               $('document').ready(function () {
                                                   $('.select-month').datepicker({
                                                       autoclose: true,
                                                       minViewMode: 1,
                                                       format: 'mm/yyyy'
                                                   }).on('changeDate', function (selected) {
                                                       var startDate = new Date(selected.date);
                                                       var Month = startDate.getMonth() +1 ;
                                                       var Year = startDate.getFullYear();
                                                       var newDate = Month+'-'+Year;
                                                       console.log(newDate);
                                                       changeValueViaDate(newDate);
                                                   });
                                               });

        </script>
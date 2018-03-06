<!-- BEGIN CORE PLUGINS -->
<script src="{{ asset('template/global/plugins/jquery.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('template/global/plugins/bootstrap/js/bootstrap.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('template/global/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('template/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('template/global/plugins/uniform/jquery.uniform.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('template/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js') }}" type="text/javascript"></script>
<!-- END CORE PLUGINS -->
<!-- BEGIN PAGE LEVEL PLUGINS -->
<script src="{{ asset('template/global/plugins/bootstrap-daterangepicker/moment.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('template/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('template/global/plugins/bootstrap-datepicker/locales/bootstrap-datepicker.pt-BR.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('template/global/plugins/morris/morris.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('template/global/plugins/bootbox/bootbox.min.js') }}" type="text/javascript"></script>

<!-- BEGIN PAGE LEVEL PLUGINS -->
<script src="{{ asset('template/global/scripts/datatable.js') }}" type="text/javascript"></script>
<script src="{{ asset('template/global/plugins/datatables/datatables.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('template/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js') }}" type="text/javascript"></script>
<script src="{{ asset('template/global/plugins/select2/js/select2.full.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('plugins/mask/src/jquery.mask.js') }}" type="text/javascript"></script>
<script src="{{ asset('template/global/plugins/jquery.blockui.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('template/global/plugins/bootstrap-maxlength/bootstrap-maxlength.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('template/global/plugins/bootstrap-touchspin/bootstrap.touchspin.js') }}" type="text/javascript"></script>
<script src="{{ asset('template/global/plugins/bootstrap-pwstrength/pwstrength-bootstrap.min.js') }}" type="text/javascript"></script>
<!-- END PAGE LEVEL PLUGINS -->

<!-- BEGIN THEME GLOBAL SCRIPTS -->
<script src="{{ asset('template/global/scripts/app.min.js') }}" type="text/javascript"></script>
<!-- END THEME GLOBAL SCRIPTS -->
<script src="{{ asset('template/pages/scripts/table-datatables-managed.min.js') }}" type="text/javascript"></script>
<!-- BEGIN PAGE LEVEL SCRIPTS -->
<script src="{{ asset('template/pages/scripts/dashboard.min.js') }}" type="text/javascript"></script>
<!-- END PAGE LEVEL SCRIPTS -->

<!-- BEGIN UI-BLOCK -->
<!--<script src="{{ asset('template/pages/scripts/ui-blockui.min.js') }}" type="text/javascript"></script>-->


<script src="{{ asset('template/pages/scripts/ui-toastr.min.js') }}" type="text/javascript"></script>

<!-- BEGIN THEME LAYOUT SCRIPTS -->
<script src="{{ asset('template/layouts/layout4/scripts/layout.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('template/layouts/layout4/scripts/demo.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('template/layouts/global/scripts/quick-sidebar.min.js') }}" type="text/javascript"></script>

<script type="text/javascript" >
    var APP = {
        base_url: "{{ asset('/') }}",
        controller: "<?php print $_SESSION['CONTROLLER']; ?>",
        controller_url: "{{ asset('/') }}<?php print $_SESSION['CONTROLLER']; ?>",
        action: "<?php print $_SESSION['ACTION']; ?>",
        action_url: "{{ url()->current() }}",
        token: "{{ csrf_token() }}",
        resultados_datatable: 10
    };
</script>

{!!Html::script('resources/assets/js/config.js')!!}
{!!Html::script('resources/assets/js/app-validation.js')!!}
{!!Html::script('resources/assets/js/app-format.js')!!}
{!!Html::script('resources/assets/js/app-util.js')!!}
{!!Html::script('resources/assets/js/app-custom.js')!!}

@yield('javascript')


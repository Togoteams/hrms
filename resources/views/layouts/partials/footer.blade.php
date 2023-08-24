<!-- ========== END SECONDARY CONTENTS ========== -->

<!-- JS Global Compulsory  -->
<script src="{{ asset('assets/vendor/jquery/dist/jquery.min.js') }}"></script>
<script src="{{ asset('assets/vendor/jquery-migrate/dist/jquery-migrate.min.js') }}"></script>
<script src="{{ asset('assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>

<!-- JS Implementing Plugins -->
<script src="{{ asset('assets/vendor/hs-navbar-vertical-aside/dist/hs-navbar-vertical-aside.min.js') }}"></script>
<script src="{{ asset('assets/vendor/hs-form-search/dist/hs-form-search.min.js') }}"></script>

<script src="{{ asset('assets/vendor/chartjs-chart-matrix/dist/chartjs-chart-matrix.min.js') }}"></script>
<script src="{{ asset('assets/vendor/chartjs-plugin-datalabels/dist/chartjs-plugin-datalabels.min.js') }}"></script>
<script src="{{ asset('assets/vendor/daterangepicker/moment.min.js') }}"></script>
<script src="{{ asset('assets/vendor/daterangepicker/daterangepicker.js') }}"></script>
<script src="{{ asset('assets/vendor/tom-select/dist/js/tom-select.complete.min.js') }}"></script>
<script src="{{ asset('assets/vendor/clipboard/dist/clipboard.min.js') }}"></script>
<script src="{{ asset('assets/vendor/datatables/media/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('assets/vendor/datatables.net.extensions/select/select.min.js') }}"></script>
<!-- JS HRMS -->
<script src="{{ asset('assets/js/theme.min.js') }}"></script>
<script src="{{ asset('assets/js/hs.theme-appearance-charts.js') }}"></script>
<!-- JS Plugins Init. -->

<script src="//ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.min.js"></script>
@stack('script')

<script>
    $('#datatable').DataTable();
    
</script>
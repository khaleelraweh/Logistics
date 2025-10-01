
@php
    $defaults = [
        'rtl' => false,
        'mode' => 'light',
    ];

    $userPrefs = is_array(auth()->user()->layout_preferences)
        ? auth()->user()->layout_preferences
        : json_decode(auth()->user()->layout_preferences, true) ?? [];

    $prefs = array_merge($defaults, $userPrefs);

    $isRtl = $prefs['rtl'];
    $isDark = $prefs['mode'] === 'dark';
@endphp

<!-- JAVASCRIPT -->
<script src="{{ asset('admin/assets/libs/jquery/jquery.min.js')}}"></script>
<script src="{{ asset('admin/assets/libs/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{ asset('admin/assets/libs/metismenu/metisMenu.min.js')}}"></script>
<script src="{{ asset('admin/assets/libs/simplebar/simplebar.min.js')}}"></script>
<script src="{{ asset('admin/assets/libs/node-waves/waves.min.js')}}"></script>

<!-- Select2 js (khaleel for product create)-->
<script src="{{ asset('admin/assets/libs/select2/js/select2.min.js')}}"></script>

<!-- Sweet Alerts js (khaleel for confirm delete message in index pages)-->
<script src="{{ asset('admin/assets/libs/sweetalert2/sweetalert2.min.js')}}"></script>

<!-- Sweet alert init js (khaleel for confirm delete message in index pages)-->
<script src="{{ asset('admin/assets/js/pages/sweet-alerts.init.js')}}"></script>


<!-- apexcharts -->
<script src="{{ asset('admin/assets/libs/apexcharts/apexcharts.min.js')}}"></script>

<!-- jquery.vectormap map -->
<script src="{{ asset('admin/assets/libs/admin-resources/jquery.vectormap/jquery-jvectormap-1.2.2.min.js')}}"></script>
<script src="{{ asset('admin/assets/libs/admin-resources/jquery.vectormap/maps/jquery-jvectormap-us-merc-en.js')}}"></script>

<!-- Required datatable js -->
<script src="{{ asset(app()->getLocale()==='ar' ? 'admin/assets/libs/datatables.net/js/jquery.dataTables.ar.min.js' : 'admin/assets/libs/datatables.net/js/jquery.dataTables.min.js')}}"></script>
<script src="{{ asset('admin/assets/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js')}}"></script>

<!-- Responsive examples -->
<script src="{{ asset('admin/assets/libs/datatables.net-responsive/js/dataTables.responsive.min.js')}}"></script>
<script src="{{ asset('admin/assets/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js')}}"></script>

<!-- Datatable init js (khaleel merchant tables)-->
<script src="{{ asset('admin/assets/js/pages/datatables.init.js')}}"></script>


<!-- form mask init (khaleel merchant create input eamil mask)-->
<script src="{{ asset('admin/assets/libs/inputmask/jquery.inputmask.min.js')}}"></script>
<script src="{{ asset('admin/assets/js/pages/form-mask.init.js')}}"></script>

<script src="{{ asset('admin/assets/js/pages/dashboard.init.js')}}"></script>


<!-- Feather Fonts style -->
<script src="{{ asset('admin/assets/libs/feather-icons/feather.js') }}"></script>

<!-- Add Counter lib -->
<script src="{{ asset('admin/assets/js/jquery.counterup.min.js')}}"></script>
<script src="{{ asset('admin/assets/js/jquery.waypoints.min.js')}}"></script>

<!-- Add wow js lib -->
<script src="{{ asset('admin/assets/js/wow.min.js')}}"></script>

<!-- Responsive fileInput js start -->
<script src="{{ asset('admin/assets/libs/bootstrap-fileinput/js/plugins/piexif.min.js') }}"></script>
<script src="{{ asset('admin/assets/libs/bootstrap-fileinput/js/plugins/sortable.min.js') }}"></script>
<script src="{{ asset('admin/assets/libs/bootstrap-fileinput/js/fileinput.min.js') }}"></script>
<script src="{{ asset('admin/assets/libs/bootstrap-fileinput/themes/fa5/theme.min.js') }}"></script>


<!-- toastr plugin -->
<script src="{{ asset('admin/assets/libs/toastr/build/toastr.min.js')}}"></script>

<!-- toastr init -->
 <script src="{{ asset('admin/assets/js/pages/toastr.init.js')}}"></script>


<!-- Change status in index pages -->
<script src="{{ asset('admin/assets/js/change-status.js')}}"></script>


<!-- Plugin js for Tinymce (khaleel for product page  description textarea input )-->
<script src="{{ asset('admin/assets/libs/tinymce/tinymce.min.js') }}"></script>

<script>
    var tinymceLanguage = '{{ app()->getLocale() }}'; // Get the current locale from Laravel config
    var flatPickrLanguage = '{{ app()->getLocale() }}';
</script>
<!-- custom tinymce by khaleel -->
<script src="{{ asset('admin/assets/js/tinymce.js') }}"></script>
<!-- End  Tinymce plugin-->


<!-- for select in product  -->
<script src="{{  asset('admin/assets/js/pages/form-advanced.init.js')}}"></script>

 <!-- materialdesign icon js by khaleel for materialdesign icon (in vertical menu items )-->
<script src="{{ asset('admin/assets/js/pages/materialdesign.init.js')}}"></script>


<!-- twitter-bootstrap-wizard js -->
<script src="{{  asset('admin/assets/libs/twitter-bootstrap-wizard/jquery.bootstrap.wizard.min.js')  }}"></script>

<script src="{{  asset('admin/assets/libs/twitter-bootstrap-wizard/prettify.js')  }}"></script>


<!-- form wizard init -->
<script src="{{  asset('admin/assets/js/pages/form-wizard.init.js')}}"></script>


<!-- App js -->
<script src="{{ asset('admin/assets/js/app.js')}}"></script>

<!-- Custom general script -->
<script src="{{ asset('admin/assets/js/custom-general-script.js')}}"></script>

<script>
    var tinymceLanguage = '{{ app()->getLocale() }}'; // Get the current locale from Laravel config
    var flatPickrLanguage = '{{ app()->getLocale() }}';
</script>

 <!-- Plugin js for this page -->
 @if ($isRtl)
    <!-- Plugin css for this page -->
    <script src="{{ asset('admin/assets/libs/flatpickr/flatpickr-rtl.min.js') }}"></script>
@else
    <!-- Plugin css for this page -->
    <script src="{{ asset('admin/assets/libs/flatpickr/flatpickr.min.js') }}"></script>
@endif

<script src="{{ asset('admin/assets/js/flatpickr.js') }}"></script>
<script src="https://npmcdn.com/flatpickr/dist/l10n/ar.js"></script>
<script src="{{ asset('admin/assets/libs/apexcharts/apexcharts.min.js') }}"></script>


@livewireScripts
@yield('script')

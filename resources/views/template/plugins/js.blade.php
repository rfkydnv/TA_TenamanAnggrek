
<script>
    var KTAppOptions = {
        "colors": {
            "state": {
                "brand": "#5d78ff",
                "dark": "#282a3c",
                "light": "#ffffff",
                "primary": "#5867dd",
                "success": "#34bfa3",
                "info": "#36a3f7",
                "warning": "#ffb822",
                "danger": "#fd3995"
            },
            "base": {
                "label": ["#c5cbe3", "#a1a8c3", "#3d4465", "#3e4466"],
                "shape": ["#f0f3ff", "#d9dffa", "#afb4d4", "#646c9a"]
            }
        }
    };
</script>

<!-- end::Global Config -->

<!--begin:: Global Mandatory Vendors -->
{{--<script src="//cdnjs.cloudflare.com/ajax/libs/jquery.pjax/2.0.1/jquery.pjax.min.js" type="text/javascript"></script>--}}

<!--end:: Global Mandatory Vendors -->

<!--begin:: Global Optional Vendors -->

<!--end:: Global Optional Vendors -->

<!--begin::Global Theme Bundle(used by all pages) -->
<script src="{{asset('assets/js/demo1/scripts.bundle.js')}}" type="text/javascript"></script>

<!--end::Global Theme Bundle -->

<!--begin::Page Vendors(used by this page) -->
{{-- <script src="{{asset('metronic/vendors/general/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js')}}" type="text/javascript"></script>
<script src="{{asset('metronic/vendors/custom/js/vendors/bootstrap-datepicker.init.js')}}" type="text/javascript"></script> --}}
<script src="{{asset('metronic/vendors/custom/fullcalendar/fullcalendar.bundle.js')}}" type="text/javascript"></script>
{{-- <script src="//maps.google.com/maps/api/js?key=AIzaSyBTGnKT7dt597vo9QgeQ7BFhvSRP4eiMSM" type="text/javascript"></script> --}}
<script src="{{asset('metronic/vendors/custom/gmaps/gmaps.js')}}" type="text/javascript"></script>

<!--end::Page Vendors -->

<!--begin::Page Scripts(used by this page) -->
{{-- <script src="{{asset('assets/js/demo1/pages/dashboard.js')}}" type="text/javascript"></script> --}}

{{-- <script src="{{mix('js/app.js')}}" type="text/javascript"></script> --}}
<script src="{{asset('js/core-library.js')}}" type="text/javascript"></script>

<script src="//cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
<script src="//stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>

{{-- <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" rel="stylesheet" type="text/css" /> --}}

<!-- sweatAlert-->
<script src="{{asset('metronic/vendors/custom/datatables/datatables.bundle.js')}}"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/validate.js/0.13.1/validate.min.js"></script>
<script defer src="{{asset('js/core.js')}}" type="text/javascript"></script>

<!--begin::Global Theme Bundle(used by all pages) -->
{{--<script src="{{ asset('metronic/js/demo1/scripts.bundle.js') }}" type="text/javascript"></script>--}}

<!--begin::Page Scripts(used by this page) -->
{{--<script src="{{ asset('assets/js/demo1/pages/crud/forms/widgets/select2.js') }}" type="text/javascript"></script>--}}
{{--<script src="{{ asset('assets/vendors/general/select2/dist/js/select2.full.js') }}" type="text/javascript"></script>--}}

<script src="{{ asset('assets/plugins/jquery-nestable/jquery.nestable.js') }}" type="text/javascript"></script>
<script src="{{ asset('metronic/js/demo1/pages/components/extended/toastr.js') }}" type="text/javascript"></script>
<script src="{{ asset('metronic/vendors/general/block-ui/jquery.blockUI.js') }}" type="text/javascript"></script>
<script src="{{ asset('metronic/js/demo1/pages/components/extended/blockui.js') }}" type="text/javascript"></script>
<script src="{{ asset('js/AppTools.js') }}"></script>
<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false&libraries=places&key=AIzaSyCRrMkZdZBb_e_R2-iUqscyfJtl2USBSXY" type="text/javascript"></script>
<script src="{{ asset('assets/plugins/gmaps/gmaps.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/plugins/gmaps/markerclusterer.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/plugins/epolys/epolys.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/custom/gmaps.custom.js') }}" type="text/javascript"></script>
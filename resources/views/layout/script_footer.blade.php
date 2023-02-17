
<!-- BEGIN: Vendor JS-->
<script src="{{ asset('assets/template/app-assets/vendors/js/vendors.min.js')}}"></script>
<!-- BEGIN Vendor JS-->

<!-- BEGIN: Page Vendor JS-->
<script src="{{ asset('assets/template/app-assets/vendors/js/ui/jquery.sticky.js')}}"></script>
<script src="{{ asset('assets/template/app-assets/vendors/js/extensions/wNumb.min.js')}}"></script>
<script src="{{ asset('assets/template/app-assets/vendors/js/extensions/nouislider.min.js')}}"></script>
<script src="{{ asset('assets/template/app-assets/vendors/js/extensions/toastr.min.js')}}"></script>
<!-- END: Page Vendor JS-->

<!-- BEGIN: Theme JS-->
<script src="{{ asset('assets/template/app-assets/js/core/app-menu.js')}}"></script>
<script src="{{ asset('assets/template/app-assets/js/core/app.js')}}"></script>
<script src="{{ asset('assets/js/mustache.js')}}"></script>
<!-- END: Theme JS-->

<!-- BEGIN: Page JS-->
<script src="{{ asset('assets/template/app-assets/js/scripts/pages/app-ecommerce.js')}}"></script>



<!-- END: Page JS-->

<script>
    $(window).on('load', function() {
        if (feather) {
            feather.replace({
                width: 14,
                height: 14
            });
        }
    })
</script>
{{--<script src=="{{ mix('/mix/js/resources.js') }}"></script>--}}

<script>
    var baseUrl =  '<?php echo e(asset('')); ?>';
</script>

@stack('scripts')

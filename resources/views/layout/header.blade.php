<html class="loading" lang="en" data-textdirection="ltr">
<!-- BEGIN: Head-->

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="description" content="Marketplace">
    <meta name="keywords" content="marketplace,crm">
    <meta name="author" content="PIXINVENT">
    <title>{{env('APP_NAME')}}</title>
    <link rel="apple-touch-icon" href="{{ env('LOGO_SOURCE').env('LOGO_ICON') }}">
    <link rel="shortcut icon" type="image/x-icon" href="{{ env('LOGO_SOURCE').env('LOGO_ICON') }}">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,300;0,400;0,500;0,600;1,400;1,500;1,600" rel="stylesheet">

{{--    <!-- BEGIN: Vendor CSS-->--}}
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/template/app-assets/vendors/css/vendors.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/template/app-assets/vendors/css/extensions/nouislider.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/template/app-assets/vendors/css/extensions/toastr.min.css')}}">
{{--    <!-- END: Vendor CSS-->--}}

{{--    <!-- BEGIN: Theme CSS-->--}}
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/template/app-assets/css/bootstrap.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/template/app-assets/css/bootstrap-extended.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/template/app-assets/css/colors.css')}}">    <link rel="stylesheet" type="text/css" href="{{ asset('assets/template/app-assets/css/components.css')}}">
　　　　　<link rel="stylesheet" type="text/css" href="{{ asset('assets/template/app-assets/css/themes/dark-layout.css')}}">
    　　<link rel="stylesheet" type="text/css" href="{{ asset('assets/template/app-assets/css/themes/bordered-layout.css')}}">

    {{--<!-- BEGIN: Page CSS-->--}}
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/template/app-assets/css/core/menu/menu-types/horizontal-menu.css')}}">
   <link rel="stylesheet" type="text/css" href="{{ asset('assets/template/app-assets/css/plugins/extensions/ext-component-sliders.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/template/app-assets/css/pages/app-ecommerce.css')}}">
   <link rel="stylesheet" type="text/css" href="{{ asset('assets/template/app-assets/css/plugins/extensions/ext-component-toastr.css')}}">
{{--    <!-- END: Page CSS-->--}}

{{--    <!-- BEGIN: Custom CSS-->--}}
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/template/assets/css/style.css')}}">

{{--    <link rel="stylesheet" href="{{ mix('/mix/css/resources.css') }}">--}}

    <!-- END: Custom CSS-->
    @stack('styles')

</head>
<!-- end::Head -->

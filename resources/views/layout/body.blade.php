<!-- BEGIN: Body-->

<body class="horizontal-layout horizontal-menu content-detached-left-sidebar navbar-floating footer-static  " data-open="hover" data-menu="horizontal-menu" data-col="content-detached-left-sidebar">


        @include('layout.topbar')
        @include('layout.menu')

        <!-- BEGIN: Content-->
            <div class="app-content content ecommerce-application">
                <div class="content-overlay"></div>
                <div class="header-navbar-shadow"></div>

                @yield('container')
            </div>
            <!-- END: Content-->


            @include('layout.footer')

    <!-- begin::Scroll Top -->
    <div class="m-scroll-top m-scroll-top--skin-top" data-toggle="m-scroll-top" data-scroll-offset="500" data-scroll-speed="300">
        <i class="la la-arrow-up"></i>
    </div>

    @include('layout.script_footer')
</body>
<!-- END: Body-->


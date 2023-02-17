@push('styles')
    {{--    <link href="{{ URL::asset('/assets/global/plugins/sweetalert/dist/sweetalert.css') }}" rel="stylesheet"/>--}}

    <style type="text/css">

        .radio label::before {
            border: 2px solid rgba(120, 130, 140, 0.53);
        }

        label.radio-label {
            font-weight: 300;
        }

        .form-horizontal .control-label {
            text-align: left !important;
        }

        .highlight {
            color: #00c292;
            font-weight: 600;
        }

        #split_file_upload_file_data_show .panel .panel-heading {
            text-transform: none;
        }

        #split_file_upload_file_data_show table td,
        #split_file_upload_file_data_show table th {
            padding: 10px 6px;
        }

        .panel-wrapper table tr th:first-child, .panel-wrapper table tr td:first-child {
        }

        .panel-wrapper table tr th:last-child, .panel-wrapper table tr td:last-child {
        }

        .panel-inverse .panel-wrapper {
            border: 3px solid #b4bccb;
        }

        .panel-inverse .panel-heading {
            padding: 13px 25px;
            background: #b4bccb;
            border-color: #b4bccb;
        }

        .swal2-modal .swal2-content {
            word-wrap: break-word;
        }

        .connectedSortable {
            float: left;
            width: 200px;
        }

        .connectedSortable > li {
            height: 50px;
        }

        .item2 {
            display: none;
        }

        .table-rotated tr {
            /*float: left;*/
            display: table-cell;
            vertical-align: top;
        }

        .table-rotated tr th, .table-rotated tr td {
            display: block;
            white-space: nowrap;
            height: 39px;
            padding: 9px 10px 0 10px !important;
        }

        .table-rotated tr:first-child {
            font-weight: 500;
        }

        .filePreviewParent .table-responsive {
            border: 1px solid #e4e7ea !important;
        }

        .filePreviewParent .table {
            border: none !important;
        }

        .filePreviewParent .table-responsive::-webkit-scrollbar {
            height: 10px;
        }

        .filePreviewParent .table-responsive::-webkit-scrollbar-track {
            background: #ccc;
        }

        .filePreviewParent .table-responsive::-webkit-scrollbar-thumb {
            background: #9c9c9c;
        }

        .sortableColumnListParent {
            width: 225px;
        }

        .sortableColumnListParent .add-new-file-alternative {
            height: 45px;
            margin-bottom: 14px;
            margin-top: 9px;
            font-size: 115%;
        }

        .filePreviewParent {
            width: calc(100% - 225px);
        }

        .filePreviewParent .table td.file-names {
            white-space: nowrap;
        }

        @media (max-width: 425px) {
            .sortableColumnListParent {
                width: 170px;
            }

            .filePreviewParent {
                width: calc(100% - 170px);
            }
        }

        .columnSource, .sortableColumnList {
            width: 100%;
            background: #eee;
            display: block;
            float: left;
        }

        .columnSource {
            padding: 5px;
            min-height: 53px;
            margin-bottom: 10px;
        }

        .sortableColumnList {
            background: none;
            margin-top: 1px;
        }

        .columnSource .item, .sortableColumnList .item {
            height: 33px;
            margin: 5px;
            padding: 10px 15px 5px 15px;
            /*border:1px solid gray;*/
            background: #7e8292;
            position: relative;
            line-height: 1;
            display: inline-block;
            color: #f2f2f2;
            overflow: hidden;
            border-radius: 4px;
            font-weight: 400;
            float: none;
        }

        .columnSource .item {
            padding-left: 31px;
            background: #4f5467;
            float: left;
        }

        .columnSource .item .sorter, .columnSource .item .closer, .columnSource .item .dropper {
            display: none;
        }

        .columnSource .item .mover {
            position: absolute;
            top: 0;
            left: 0;
            bottom: 0;
            right: 0;
            font-size: 12px;
            padding-top: 11px;
            padding-left: 10px;
        }

        .sortableColumnList .blank:before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            border: 1px dashed #999;
            border-radius: 4px;
        }

        .sortableColumnList .blank,
        .sortableColumnList .placeholder-c,
        .sortableColumnList .highlight {
            height: 31px;
            margin-top: 3px;
            margin-bottom: 3px;
            background: #eee;
            border: none;
            position: relative;
            border-radius: 4px;
            float: left;
            width: 100%;
        }

        .sortableColumnList .placeholder-c,
        .sortableColumnList .highlight {
            background: #cdd7f5;
            border: 1px dashed #001296;
        }

        .sortableColumnList .placeholder-c .closer,
        .sortableColumnList .highlight .closer {
            display: none;
        }

        .sortableColumnList .blank.highlight:before {
            display: none;
        }

        .sortableColumnList .blank.hasItem {
            border: none;
        }

        .sortableColumnList .mover, .sortableColumnList .sorter, .sortableColumnList .closer, .sortableColumnList .dropper {
            cursor: pointer;
            color: #f2f2f2;
            position: absolute;
            left: 0;
            top: 0;
            right: auto;
            bottom: 0;
            width: 25px;
            padding: 10px 0;
            text-align: center;
            font-size: 12px;
        }

        .columnSource .mover, .sortableColumnList .mover {
            cursor: move;
        }

        .sortableColumnList .sorter {
            cursor: n-resize;
            left: 25px;
        }

        .sortableColumnList .closer {
            left: auto;
            right: 25px;
            font-size: 9px;
            padding: 12px 0;
        }

        .sortableColumnList .dropper {
            left: auto;
            right: 0px;
            font-size: 9px;
            padding: 12px 0;
        }

        .sortableColumnList .blank.hasOnlyDropper .dropper {
            right: 0px;
            color: #4f5467;
        }

        .sortableColumnList .mover:hover, .sortableColumnList .sorter:hover, .sortableColumnList .closer:hover, .sortableColumnList .dropper:hover,
        .ui-draggable-dragging .mover,
        .is-sorting .sorter {
            color: #f2f2f2;
            background: rgba(0, 0, 0, .1);
        }

        .sortableColumnList .blank > .dropper, .sortableColumnList .dropper > .closer:hover,
        .sortableColumnList .blank.hasOnlyDropper > .dropper, .sortableColumnList .blank.hasOnlyDropper > .dropper:hover {

            border-radius: 0px 4px 4px 0px;
        }

        .sortableColumnList .blank > .closer, .sortableColumnList .blank > .closer:hover,
        .sortableColumnList .blank > .dropper, .sortableColumnList .blank > .dropper:hover {
            color: #4f5467;
        }

        .sortableColumnList .blank .item {
            margin: 0;
            display: block;
            padding-left: 60px;
            padding-right: 30px;
            white-space: nowrap;
        }

        .ui-draggable-dragging {
            z-index: 99;
            opacity: 1 !important;
        }

        .filePreviewManagement {
            margin-right: 0px;
            margin-left: 0px;
        }

        .columnSourceDropdown {
            position: absolute;
            top: 0;
            left: 0;
            width: 0;
            height: auto;
            display: none;
            padding: 0px;
            background: #6f7796;
            border-radius: 3px;
            box-shadow: 1px 1px 5px rgba(0, 0, 0, .4);
            overflow: hidden;
            margin-top: -2px;
            opacity: 0;
            transition: .1s ease-in;
        }

        .columnSourceDropdown.hasNoItem {
            padding: 10px 15px;
            text-align: center;
            color: #f2f2f2;
            font-weight: 400;
        }

        .columnSourceDropdown.animated {
            opacity: 1;
        }

        .columnSourceDropdown .sorter, .columnSourceDropdown .mover, .columnSourceDropdown .closer, .columnSourceDropdown .dropper {
            display: none;
        }

        .columnSourceDropdown .item {
            height: 21px;
            padding: 4px 15px 0px 15px;
            position: relative;
            line-height: 1;
            display: block;
            color: #f2f2f2;
            font-weight: 400;
            float: none;
            background: #626a88;
            margin-top: -10px;
            cursor: pointer;
            transition: .2s ease-in;
        }

        .columnSourceDropdown.animated .item {
            height: 28px;
            padding: 8px 15px 1px 15px;
            margin-top: 3px;
        }

        .columnSourceDropdown .item:first-child {
            margin-top: 0;
        }

        .columnSourceDropdown .item:hover {
            background: #6f7796;
        }

        @media (max-width: 425px) {
            .filePreviewManagement {
                margin-right: -7.5px;
                margin-left: -7.5px;
            }

            .columnSource .item .mover {
                font-size: 11px;
                padding-top: 12px;
            }

            .sortableColumnList .mover, .sortableColumnList .sorter, .sortableColumnList .closer {
                width: 20px;
                padding: 11px 0;
                font-size: 11px;
            }

            .sortableColumnList .sorter {
                left: 20px;
            }

            .sortableColumnList .closer {
                font-size: 7px;
                padding: 13px 0;
            }

            .sortableColumnList .blank .item {
                padding-left: 44px;
                padding-right: 20px;
            }

            .columnSource .item, .sortableColumnList .item {
                padding-top: 12px;
                font-size: 11px;
            }

        }

        .bulk-file-table td {
            padding: 9px 10px 9px 10px !important;
            white-space: nowrap;
        }

        .bulk-file-table td.no-data {
            background: #fff0f0;
        }

        .bulk-file-table td.file-end {
            border-right: 1px solid #bbbdcc !important;
        }

        .bulk-file-table td.file-end:last-child {
            border-right: 1px solid #e4e7ea !important
        }

        .bulk-file-table .file-name-header-row .file-names {
            border: none !important;
            background: #eeeeee;
            padding: 0px !important;
            border-right: 1px solid #abafc1 !important;
        }

        .bulk-file-table .file-name-header-row .file-names:last-child {

            border-right: 1px solid #dbdcde !important;
        }

        .bulk-file-table .file-name-header-row .file-name-header {
            position: relative;
            display: block;
            background: #dbdcde;
            padding: 5px 10px 10px 10px;
        }

        .bulk-file-table .file-name-header-row .file-name-header .file-remover {
            position: absolute;
            top: 3px;
            right: 4px;
            padding: 5px;
            font-size: 14px;
            color: #999;
            cursor: pointer;
        }

        .bulk-file-table .file-name-header-row .file-name-header .file-remover:hover,
        .bulk-file-table .file-name-header-row .file-name-header .file-remover:focus {
            color: #333;
        }

        .bulk-file-table .file-name-header-row .file-name-text {
            color: #4f5467;
            font-size: 14px;
            font-weight: 500;
            margin-bottom: 3px;
            display: block;
            padding-right: 20px;
            white-space: nowrap;
        }

        .bulk-file-table .file-name-header-row .file-name-input-container {
            display: block;
        }

        .bulk-file-table .file-name-header-row .file-name-input-container .file-name-input {
            width: 100%;
            border: none;
            padding: 5px 10px;
            height: 30px;
            font-size: 12px;
            background: #f7f8fc;
        }

        .bulk-file-table .file-name-header-row {
        }

        .mask-file-input {
            position: relative;
            cursor: pointer;
        }

        .mask-file-input .mask-input {
            position: absolute;
            cursor: pointer;
            opacity: 0;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: 10;
        }

        .file-uploader-dropzone {
            position: relative;
        }

        .file-uploader-dropzone .dropzone-frontdrop {
            position: absolute;
            top: -10px;
            left: -10px;
            right: -10px;
            bottom: -10px;
            border: 2px dashed #4f5467;
            z-index: 100;
            background: rgba(255, 255, 255, .8);
            opacity: 0;
            visibility: hidden;
            transition: 0.05s ease .3s;
        }

        .file-uploader-dropzone .dropzone-frontdrop .icon {
            font-size: 40px;
            padding: 15px;
            position: absolute;
            transform: translateX(-50%) translateY(-50%);
            top: 50%;
            left: 50%;
            background: #eef6f7;
            border: 2px dashed #60b0e2;
            color: #60b0e2;
            border-radius: 13px;
        }

        .file-uploader-dropzone.dragover .dropzone-frontdrop {
            opacity: 1;
            visibility: visible;
            transition: 0.05s ease 0s;
        }

        .filePreviewAndMappingCon .loader {
            z-index: 100;
            background: rgba(255, 255, 255, .4);
            position: absolute;
            top: -10px;
            left: -10px;
            right: -10px;
            bottom: -10px;
            opacity: 0;
            visibility: hidden;
        }

        .filePreviewAndMappingCon.loading .loader {
            opacity: 1;
            visibility: visible;
        }

        .filePreviewAndMappingCon .loader .icon {
            font-size: 30px;
            padding: 15px;
            position: absolute;
            transform: translateX(-50%) translateY(-50%);
            top: 50%;
            left: 50%;
        }

        .file-check-status-modal .modal-body .contact_details_style {
            /*padding: 15px 25px;*/
            box-shadow: 0px 0px 0px rgba(0, 0, 0, 0);
            /*margin-bottom: 25px;*/
        }

        .audio_recorde_li {
            list-style: none;
            margin: 2px;
            padding: 2px;
        }

        .upload-btn {
            margin-bottom: 16px;
            padding: 8px;
            margin-top: -20px;
        }

        .lds-dual-ring {
            display: inline-block;
            width: 64px;
            height: 64px;
        }
        .lds-dual-ring:after {
            content: " ";
            display: block;
            width: 46px;
            height: 46px;
            margin: 1px;
            border-radius: 50%;
            border: 5px solid #fff;
            border-color: #fff transparent #fff transparent;
            animation: lds-dual-ring 1.2s linear infinite;
        }
        .split_file_upload_form .mask-file-input {
            position: relative;
            display: block;
            width: 100%;
            border: 2px dashed #ddd;
            padding: 25px 15px;
            text-align: center;
            background: #fcfcfe;
            border-radius: 4px;
            color: #999;
        }
        .form-group.m-form__group.icon.cardField .m-input-icon.m-input-icon--right #card {
            background: #ddd;
            padding: 13px 10px 12px;
            border-radius: 4px;
        }

        .form-group.m-form__group.icon.cardField .m-input-icon.m-input-icon--right #card .CardBrandIcon-container {
            top: -3px;
        }
        @keyframes lds-dual-ring {
            0% {
                transform: rotate(0deg);
            }
            100% {
                transform: rotate(360deg);
            }
        }


        .text-info{
            overflow-wrap: break-word;
        }
    </style>
@endpush
@extends('layout.authmain')
@section('container')
    <!-- <div class="js-fullheight"> -->
    <div class="hero-wrap js-fullheight">
        <div class="overlay"></div>
        <div id="particles-js"></div>
        <div class="container">
            <div class="row no-gutters slider-text align-items-center justify-content-center" data-scrollax-parent="true">
                <div class="col-md-6 ftco-animate text-center" data-scrollax=" properties: { translateY: '70%' }">
                    <h1 class="mb-4" data-scrollax="properties: { translateY: '30%', opacity: 1.6 }"><strong>Login</strong> </h1>
                </div>
            </div>
        </div>
    </div>
    <section class="ftco-section">
        <div class="container">
            <div class="white-box tab-pane active" id="">
                @if(\App\Http\Helpers\ViewHelper::get_login_error_message(false) != '')
                    <div class="m-alert m-alert--icon m-alert--icon-solid m-alert--outline alert alert-danger alert-dismissible fade show"  role="alert">
                        <div class="m-alert__icon">
                            <i class="flaticon-exclamation-1"></i>
                            <span></span>
                        </div>
                        <div class="m-alert__text">
                            <strong>
                                Oh snap!
                            </strong>
                            {!! \App\Http\Helpers\ViewHelper::get_login_error_message() !!}
                        </div>
                        <div class="m-alert__close">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"></button>
                        </div>
                    </div>
                @endif
                <div class="row">
                    <div class="col-xs-12 col-md-12 col-lg-12">
                            <form class="m-login__form m-form" method="POST" action="{{ route('login') }}">
                                <div class="row " id="" >
                                    {{ csrf_field() }}

                                    <div class="col-xs-6 col-md-6 col-lg-6">
                                        <h4>Login</h4>

                                        <div class="form-group m-form__group icon">
                                            <label class="control-label">
                                                <i class="icon icon-envelope"></i>  Email
                                            </label>

                                            <input class="form-control m-input" type="email" placeholder="Enter Email" name="email" autocomplete="off" required />
                                        </div>
                                        <div class="form-group m-form__group icon">
                                            <label class="control-label">
                                                <i class="icon icon-unlock"></i>  Password
                                            </label>
                                            <input class="form-control m-input m-login__form-input--last" type="Password" placeholder="Enter Password" name="password" autocomplete="off" required />
                                        </div>

                                    </div>
                                </div>
                                <br>


                                <div class="form-group">
                                    <input id="m_login_signin_submit" type="submit" value="Login" class="btn btn-outline-success py-3 px-5 submit_btn_audio_manager">
                                </div>

                            </form>
                        </div>

                </div>
            </div>
            </div>
    </section>


@endsection

@push('scripts')
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.js"></script>

{{--    <script src="{{ URL::asset('/custom/enjoyhint/enjoyhint.min.js')}}" type="text/javascript"></script>--}}

    <script>
        $(function () {
            $(document).ready(function () {
                var login = $('#m_login');
                var displaySignUpForm = function() {
                    login.removeClass('m-login--forget-password');
                    login.removeClass('m-login--signin');

                    login.addClass('m-login--signup');
                    login.find('.m-login__signup').animateClass('flipInX animated');
                };
                var displaySignInForm = function() {
                    login.removeClass('m-login--forget-password');
                    login.removeClass('m-login--signup');

                    login.addClass('m-login--signin');
                    login.find('.m-login__signin').animateClass('flipInX animated');
                };
                var displayForgetPasswordForm = function() {
                    login.removeClass('m-login--signin');
                    login.removeClass('m-login--signup');

                    login.addClass('m-login--forget-password');
                    login.find('.m-login__forget-password').animateClass('flipInX animated');
                };
                $('#m_login_forget_password').click(function(e) {
                    e.preventDefault();
                    displayForgetPasswordForm();
                });
                $('#m_login_forget_password_cancel').click(function(e) {
                    e.preventDefault();
                    displaySignInForm();
                });
                $('#m_login_signup').click(function(e) {
                    e.preventDefault();
                    displaySignUpForm();
                });
                $('#m_login_signup_cancel').click(function(e) {
                    e.preventDefault();
                    displaySignInForm();
                });

                var showErrorMsg = function(form, type, title = 'Well Done', msg) {
                    var alert = $('<div class="m-alert m-alert--icon m-alert--icon-solid m-alert--outline alert alert-'+type+' alert-dismissible fade show" role="alert">\n' +
                        '                <div class="m-alert__icon">\n' +
                        '                    <i class="flaticon-exclamation-1"></i>\n' +
                        '                    <span></span>\n' +
                        '                </div>\n' +
                        '                <div class="m-alert__text">\n' +
                        '                    <strong>'+title+'</strong>\n' +
                        '                    '+msg+'\n' +
                        '                </div>\n' +
                        '                <div class="m-alert__close">\n' +
                        '                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"></button>\n' +
                        '                </div>\n' +
                        '            </div>');

                    form.find('.alert').remove();
                    alert.prependTo(form);
                    alert.animateClass('fadeIn animated');
                    // alert.find('span').html(msg);
                };
                setTimeout(function() {
                    $('.m-alert').fadeOut();
                }, 10000);





            });
        });
    </script>

    <script>
        @if(\Illuminate\Support\Facades\Session::has('active_help'))
        {{ \Illuminate\Support\Facades\Session::forget('active_help') }}
        var enjoyhint_instance = new EnjoyHint({});
        var enjoyhint_script_steps = [
            {
                'click .help-button' : 'Click Here To Create New Account',
            }
        ];
        enjoyhint_instance.set(enjoyhint_script_steps);
        enjoyhint_instance.run();

        @endif
    </script>

    <script>
        $(document).on('click','#register_next', function (event) {
            event.preventDefault();
            $('.payment').removeClass('hide_o');
            $('.basic-info').addClass('hide_o');
            $('#m_login_signup_cancel').addClass('hide_o');
            $('#register_next').addClass('hide_o');
            $('#register_prev').removeClass('hide_o');
            $('#m_login_signup_submit').removeClass('hide_o');
        });
        $(document).on('click','#register_prev', function (event) {
            event.preventDefault();
            $('.payment').addClass('hide_o');
            $('.basic-info').removeClass('hide_o');
            $('#m_login_signup_cancel').removeClass('hide_o');
            $('#register_next').removeClass('hide_o');
            $('#register_prev').addClass('hide_o');
            $('#m_login_signup_submit').addClass('hide_o');
        });
    </script>


    {{-- Card validation --}}


@endpush

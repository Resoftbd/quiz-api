@extends('auth.layouts.main')

@push('style')

@endpush
@section('content')
    <div class="m-login__contanier">
        <div class="m-stack m-stack--hor m-stack--desktop">
    <div class="m-stack__item m-stack__item--fluid">
        <div class="m-login__wrapper">
{{--            <div class="m-login__logo">--}}
{{--                <a href="#">--}}
{{--                    <img style="width: 300px" src="{{ URL::asset(env('LOGO_SOURCE').env('LOGO_FULL_SIZE')) }}">--}}
{{--                </a>--}}
{{--            </div>--}}
            <div class="m-login__signin" id="login_form_panel">
                <div class="m-login__head">
                    <h3 class="m-login__title">
                        Change your password
                    </h3>
                </div>
                <form class="m-login__form m-form" method="" action="" id="forget_password_change_form">
                    {{ csrf_field() }}
                    @if($status == 'success')
                        <input type="hidden" name="email" value="{{ $user_data[0]['email'] }}">
                        <input type="hidden" name="id" value="{{ $user_data[0]['id'] }}">
                        <input type="hidden" name="token" value="{{ $token }}">

                        <div class="form-group m-form__group">
                            <input class="form-control m-input m-login__form-input--last"
                                   type="password" placeholder="Password" name="password" required autocomplete="off">
                            <span class="help-block" id="password_error_message">
                                <strong></strong>
                            </span>
                        </div>

                        <div class="form-group m-form__group">
                            <input class="form-control m-input m-login__form-input--last"
                                   type="password" placeholder="Confirm Password" name="password_confirmation" required autocomplete="off">
                            <span class="help-block" id="confirm_password_error_message">
                                <strong></strong>
                            </span>
                        </div>

                    @else
                        <div class="row m-login__form-sub">
                            <div class="col m--align-left m-login__form-left">
                                <h3 class="text-danger">
                                    May be your link in invalid. Try again later.
                                </h3>
                            </div>
                        </div>
                    @endif

                    <div class="row m-login__form-sub">
                        <div class="col m--align-left m-login__form-left">
                            <a href="{{ route('register') }}" id="" class="m-link">
                                Create new account?
                            </a>
                        </div>
                        <div class="col m--align-right m-login__form-right">
                            <a href="{{ route('home') }}" id="" class="m-link">
                                Log in Now
                            </a>
                        </div>
                    </div>
                    @if($status == 'success')
                    <div class="m-login__form-action">
                        <button type="submit" class="btn btn-focus m-btn m-btn--pill m-btn--custom m-btn--air  m-login__btn" id="forget_password_form_submit_button">
                            Change Password
                        </button>
                    </div>
                    @endif
                </form>
            </div>
        </div>
    </div>

</div>
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function(){

            $("#forget_password_form_submit_button").click(function(event){
                event.preventDefault();
                $.ajax({
                    url: "{{ route('forget-password-change-get-form-submit') }}",
                    "type" : 'POST',
                    data : $('#forget_password_change_form').serialize(),
                    success: function(result){
                        if (result.status == 'success'){
                            $('#forget_password_form_submit').trigger('reset');
                            // $(".m-login__title").css('color', 'red');
                            $(".m-login__title").html(result.html);

                            setTimeout(function() {
                                window.location.href = '/';
                            }, 3000);
                        }
                        else if(result.status == 'validation-error')
                        {
                            if(result.html.password){
                                $("#password_error_message strong").html(result.html.password);
                                $("#password_error_message").slideDown();
                                setTimeout(function() {
                                    $("#password_error_message").slideUp();
                                }, 3000);
                            }

                            if(result.html.confirm_password){
                                $("#confirm_password_error_message strong").html(result.html.confirm_password);
                                $("#confirm_password_error_message").slideDown();
                                setTimeout(function() {
                                    $("#confirm_password_error_message").slideUp();
                                }, 3000);
                            }

                            if(result.error_type){
                                $("#confirm_password_error_message strong").html(result.html);
                                $("#confirm_password_error_message").slideDown();
                                setTimeout(function() {
                                    $("#confirm_password_error_message").slideUp();
                                }, 3000);
                            }
                        }
                        else{
                            $('#forget_password_form_submit').trigger('reset');
                            $(".m-login__title").css('color', 'red');
                            $(".m-login__title").html(result.html);

                            setTimeout(function() {
                                window.location.href = '/';
                            }, 3000);
                        }

                    }
                });
            });
        });
    </script>
@endpush

@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row" id="registration_form_panel">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Register</div>

                <div class="panel-body">
{{--                    <form class="form-horizontal" method="POST" action="{{ route('register') }}">--}}
                    <form class="form-horizontal" method="" action="" id="registration_form">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autocomplete="off">

                                <span class="help-block" id="email_message" style="display:none;color:darkred">
                                    <strong></strong>
                                </span>
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-4 control-label">Password</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password" required autocomplete="off">

                                <span class="help-block" id="password_message" style="display:none;color:darkred">
                                    <strong></strong>
                                </span>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="password-confirm" class="col-md-4 control-label">Confirm Password</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="off">

                                <span class="help-block" id="confirm_password_message" style="display:none;color:darkred">
                                    <strong></strong>
                                </span>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="name" class="col-md-4 control-label">Referral Code</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="referral_code" value="" autocomplete="off">

                                <span class="help-block" id="referral_code_message" style="display:none;color:darkred">
                                    <strong></strong>
                                </span>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="button" class="btn btn-primary" id="submit-register-form">
                                    Register
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="row" id="registration_welcome_panel" style="display : none;">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-body">
                    Welcome to our system. We sent an email to your provided email. Check and confirm your email.
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
{{--    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>--}}

    <script>
        $(document).ready(function(){
            $("#submit-register-form").click(function(event){
                event.preventDefault();
                if($("#email").val() == ''){
                    $("#email_message strong").html("Email can not null");
                    $("#email_message").css('display','block');
                    setTimeout(function() {
                        $('#email_message').fadeOut('fast');
                    }, 3000);
                    return false;
                }
                $.ajax({
                    url: "{{ route('register') }}",
                    "type" : 'POST',
                    data : $('#registration_form').serialize(),
                    success: function(result){
                        console.log(result);
                        if (result.status == 'success'){
                            $("#registration_form_panel").slideUp();
                            $("#registration_welcome_panel").slideDown();
                            $('#registration_form').trigger('reset');
                        }
                        else{
                            if(result.error_type == 'referral-coder-error'){
                                $("#referral_code_message strong").html(result.html);
                                $("#referral_code_message").css('display','block');
                                setTimeout(function() {
                                    $('#referral_code_message').fadeOut('fast');
                                }, 3000);
                            }
                            else if(result.status == 'validation-error'){
                                if(result.html.email){
                                    $("#email_message strong").html(result.html.email);
                                    $("#email_message").css('display','block');
                                    setTimeout(function() {
                                        $('#email_message').fadeOut('fast');
                                    }, 3000);
                                }

                                if(result.html.password){
                                    if(result.html.password[0] == 'The password confirmation does not match.'){
                                        $("#confirm_password_message strong").html(result.html.password[0]);
                                        $("#confirm_password_message").css('display','block');
                                        setTimeout(function() {
                                            $('#confirm_password_message').fadeOut('fast');
                                        }, 3000);
                                    }
                                    else{
                                        if($("#password").val().length < 6){
                                            $("#password_message strong").html("The password must be at least 6 characters");
                                            $("#password_message").css('display','block');
                                            setTimeout(function() {
                                                $('#password_message').fadeOut('fast');
                                            }, 3000);
                                        }
                                        else{
                                            $("#confirm_password_message strong").html(result.html.password);
                                            $("#confirm_password_message").css('display','block');
                                            setTimeout(function() {
                                                $('#confirm_password_message').fadeOut('fast');
                                            }, 3000);
                                        }

                                    }

                                }
                            }
                        }

                    }
                });
            });
        });
    </script>
@endpush

var SnippetLogin = function (){

	var login = $('#m_login');

	var showErrorMsg = function(form, type, msg) {
		var alert = $('<div class="m-alert m-alert--outline alert alert-' + type + ' alert-dismissible" role="alert">\
			<button type="button" class="close" data-dismiss="alert" aria-label="Close"></button>\
			<span></span>\
		</div>');

		form.find('.alert').remove();
		alert.prependTo(form);
		//alert.animateClass('fadeIn animated');
		mUtil.animateClass(alert[0], 'fadeIn animated');
		alert.find('span').html(msg);
	}

	//== Private Functions

	var displaySignUpForm = function() {
		login.removeClass('m-login--forget-password');
		login.removeClass('m-login--signin');

		login.addClass('m-login--signup');
		window.mUtil.animateClass(login.find('.m-login__signup')[0], 'flipInX animated');
	}

	var displaySignInForm = function() {
		login.removeClass('m-login--forget-password');
		login.removeClass('m-login--signup');

		login.addClass('m-login--signin');
		mUtil.animateClass(login.find('.m-login__signin')[0], 'flipInX animated');
		//login.find('.m-login__signin').animateClass('flipInX animated');
	}

	var displayForgetPasswordForm = function() {
		login.removeClass('m-login--signin');
		login.removeClass('m-login--signup');

		login.addClass('m-login--forget-password');
		//login.find('.m-login__forget-password').animateClass('flipInX animated');
		mUtil.animateClass(login.find('.m-login__forget-password')[0], 'flipInX animated');

	}

	var handleFormSwitch = function() {
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
	}

	var handleSignInFormSubmit = function() {
		$('#m_login_signin_submit').click(function(e) {
			e.preventDefault();
			var btn = $(this);
			var form = $(this).closest('form');

			form.validate({
				rules: {
					email: {
						required: true,
						email: true
					},
					password: {
						required: true
					}
				}
			});

			if (!form.valid()) {
				return;
			}

			btn.addClass('m-loader m-loader--right m-loader--light').attr('disabled', true);

			form.ajaxSubmit({
				url: '/login/submit',
				dataType: 'json',
				type:'post',
				success: function(response, status, xhr, $form) {
					console.log(response);
					if(response.status == 'success'){
						//return window.nbUtility.redirect('/');
						window.location.href = "/";
						//setTimeout(location.reload.bind(location), 1000);

					}else{
						setTimeout(function() {
							btn.removeClass('m-loader m-loader--right m-loader--light').attr('disabled', false);
							showErrorMsg(form, 'danger', response.html);
						}, 2000);
					}
				},
				error: function (r) {
					console.log(r);
				}
			});
		});
	}

	var handleSignInFormSubmitAdmin = function() {
		$('#m-login__btn').click(function(e) {
			e.preventDefault();
			var btn = $(this);
			var form = $(this).closest('form');

			form.validate({
				rules: {
					username: {
						required: true
					},
					password: {
						required: true
					}
				}
			});

			if (!form.valid()) {
				return;
			}

			btn.addClass('m-loader m-loader--right m-loader--light').attr('disabled', true);

			form.ajaxSubmit({
				url: '/admin/login',
				dataType: 'json',
				type:'post',
				success: function(response, status, xhr, $form) {
					//console.log(response);
					if(response.status == 'success'){
						window.nbUtility.redirect('/admin/home');
						setTimeout(location.reload.bind(location), 1000);

					}else{
						setTimeout(function() {
							btn.removeClass('m-loader m-loader--right m-loader--light').attr('disabled', false);
							showErrorMsg(form, 'danger', response.html);
						}, 2000);
					}
				},
				error: function (r) {
					console.log(r);
				}
			});
		});
	}


	var handleSignInFormForAdminSubmit = function() {
		$('#m_admin_login_signin_submit').click(function(e) {

			e.preventDefault();
			var btn = $(this);
			var form = $(this).closest('form');

			form.validate({
				rules: {
					username: {
						required: true,
					},
					password: {
						required: true
					}
				}
			});

			if (!form.valid()) {
				return;
			}

			btn.addClass('m-loader m-loader--right m-loader--light').attr('disabled', true);

			form.ajaxSubmit({
				url: form.attr('action'),
				dataType: 'json',
				type:'post',
				success: function(response, status, xhr, $form) {

					if(response.status == 'success'){
						window.nbUtility.redirect('/admin/home');
						setTimeout(location.reload.bind(location), 1000);

					}else{
						setTimeout(function() {
							btn.removeClass('m-loader m-loader--right m-loader--light').attr('disabled', false);
							showErrorMsg(form, 'danger', 'Incorrect username or password. Please try again.');
						}, 2000);
					}
				}
			});
		});
	}

	var handleSignUpFormSubmit = function() {
		$('#m_login_signup_submit').click(function(e) {
			e.preventDefault();

			var btn = $(this);
			var form = $(this).closest('form');

			form.validate({
				rules: {
					full_name: {
						required: true
					},
					phone: {
						required: true
					},email: {
						required: true,
						email: true
					},
					agree: {
						required: true
					}
				}
			});

			if (!form.valid()) {
				return;
			}

			btn.addClass('m-loader m-loader--right m-loader--light').attr('disabled', true);

			form.ajaxSubmit({
				url: '/register',
				dataType: 'json',
				type:'post',
				success: function(response, status, xhr, $form) {
					// similate 2s delay
					setTimeout(function() {
						if(response.status == 'success'){
							btn.removeClass('m-loader m-loader--right m-loader--light').attr('disabled', false);
							form.clearForm();
							form.validate().resetForm();
							showErrorMsg(form, 'success', 'Thank you. To complete your registration please check your email.');

							// display signup form
							displaySignInForm();
							var signInForm = login.find('.m-login__signin form');
							signInForm.clearForm();
							signInForm.validate().resetForm();

							showErrorMsg(signInForm, 'success', 'Thank you. To complete your registration please check your email.');
						} else if(response.status == 'validation-error')
						{
							if(response.html.email != ''){
								showErrorMsg(form, 'error', response.html.email);
							}

							if(response.html.phone != ''){
								showErrorMsg(form, 'error', response.html.phone);
							}

							btn.removeClass('m-loader m-loader--right m-loader--light').attr('disabled', false);
						}
						else{
							btn.removeClass('m-loader m-loader--right m-loader--light').attr('disabled', false);
							showErrorMsg(form, 'error', 'Something went wrong! please try again later');
						}

					}, 1000);
				}
			});
		});
	}

	var handleForgetPasswordFormSubmit = function() {
		$('#m_login_forget_password_submit').click(function(e) {
			e.preventDefault();

			var btn = $(this);
			var form = $(this).closest('form');

			form.validate({
				rules: {
					email: {
						required: true,
						email: true
					}
				}
			});

			if (!form.valid()) {
				return;
			}

			btn.addClass('m-loader m-loader--right m-loader--light').attr('disabled', true);

			form.ajaxSubmit({
				url: '/reset/url/submit',
				dataType: 'json',
				type:'post',
				success: function(response, status, xhr, $form) {

					if(response.status == 'success'){
						btn.removeClass('m-loader m-loader--right m-loader--light').attr('disabled', false); // remove
						showErrorMsg(form, 'success', response.html);
					}else{
						setTimeout(function() {
							btn.removeClass('m-loader m-loader--right m-loader--light').attr('disabled', false); // remove
							showErrorMsg(form, 'error', response.html);
						}, 2000);
					}

				}
			});
		});
	}

	//== Public Functions
	return {
		// public functions
		init: function() {
			handleFormSwitch();
			handleSignInFormSubmit();
			handleSignInFormSubmitAdmin();
			handleSignUpFormSubmit();
			handleForgetPasswordFormSubmit();
			handleSignInFormForAdminSubmit();
		}
	};
}(jQuery,window);

//== Class Initialization
jQuery(document).ready(function() {
	SnippetLogin.init();
});
<?php
namespace TenUpLogin\CustomLogin;

function init() {
	echo do_shortcode('[login_form]');
}

add_action( 'login_form', __NAMESPACE__ . '\init');

function forgot_pw_init() {
	echo do_shortcode('[lost_pw_form]');
}

add_action( 'lostpassword_form' , __NAMESPACE__ . '\forgot_pw_init');

//override default wordpress styles for login page and enqueue new stylesheet
function override_styles() {

	wp_dequeue_style( 'login' );
	wp_enqueue_style(
		'10up_custom_login',
		TENUP_LOGIN_URL . 'dist/css/style.min.css',
		[],
		TENUP_LOGIN_VERSION
	);
}

add_action( 'login_enqueue_scripts', __NAMESPACE__ . '\override_styles', 20 );

function scripts() {
	wp_enqueue_script(
		'10up_login_frontend',
		TENUP_LOGIN_URL . 'dist/js/frontend.min.js',
		[],
		TENUP_LOGIN_VERSION,
		true
	);
}

add_action( 'login_enqueue_scripts', __NAMESPACE__ . '\scripts' );

//add custom fonts to login form
function custom_add_google_fonts() {
	wp_enqueue_style( 'custom-google-fonts', 'https://fonts.googleapis.com/css?family=EB+Garamond:400i|Raleway:400,600', false );
}

add_action( 'wp_enqueue_scripts', __NAMESPACE__ . '\custom_add_google_fonts' );

//update logo link and URL to direct to 10up with filters
function logo_url() {
	return get_bloginfo( 'url' );
}

add_filter( 'login_headerurl', __NAMESPACE__ . '\logo_url' );

function logo_url_title() {
	return '';
}

add_filter( 'login_headertitle', __NAMESPACE__ . '\logo_url_title' );

//edit login error message
function login_error_override() {
	global $errors;
	$err_codes = $errors->get_error_codes();

	// Invalid username.
	// Default: '<strong>ERROR</strong>: Invalid username. <a href="%s">Lost your password</a>?'
	if ( in_array( 'invalid_username', $err_codes ) ) {
		$error = '<strong>ERROR</strong>: Invalid username.';
	}

	// Incorrect password.
	// Default: '<strong>ERROR</strong>: The password you entered for the username <strong>%1$s</strong> is incorrect. <a href="%2$s">Lost your password</a>?'
	if ( in_array( 'incorrect_password', $err_codes ) ) {
		$error = '<strong>ERROR</strong>: The password you entered is incorrect.';
	}

	return $error;
}

add_filter('login_errors', __NAMESPACE__ . '\login_error_override');

// login form fields
function login_form_fields() {

	ob_start(); ?>
		<form id="login_form"  class="form" action="">
			<fieldset>
				<p>
					<label for="custom_user_login">Enter your <span>Username</span></label>
					<input name="custom_user_login" id="custom_user_login" class="required" type="text" aria-required="true" aria-label="Username"/>
				</p>
				<p>
					<label for="custom_user_pass">Enter your <span>Password</span></label>
					<input name="custom_user_pass" id="custom_user_pass" class="required" type="password" aria-required="true" aria-label="Password"/>
				</p>
				<p>
					<input id="custom_login_submit" type="submit" value="LOGIN"/>
				</p>
			</fieldset>
		</form>
	<?php
	return ob_get_clean();
}

// user login form
function custom_login_form() {
	if( !is_user_logged_in() ) {
		$output = login_form_fields();
	} else {
		//do nothing
	}
	return $output;
}
add_shortcode('login_form', __NAMESPACE__ . '\custom_login_form');

//lost password form field
function lost_pw_form_fields() {

	ob_start(); ?>
		<form id="lost_pw_form" class="form" action="">
			<fieldset>
				<p>
					<label for="custom_lost_password">Enter your <span>Email</span></label>
					<input name="custom_lost_password" id="custom_lost_password" class="required" type="email" aria-required="true" aria-label="Email"/>
				</p>
				<p>
					<input id="lost_pw_submit" type="submit" value="SUBMIT"/>
				</p>
			</fieldset>
		</form>
	<?php
	return ob_get_clean();
}

//lost password form
function custom_lost_pw_form() {
	if ( !is_user_logged_in() ) {
		$lost_output = lost_pw_form_fields();
	} else {
		//do nothing
	}
	return $lost_output;
}

add_shortcode('lost_pw_form', __NAMESPACE__ . '\custom_lost_pw_form');

<?php
namespace TenUpLogin\CustomLogin;

function init() {
	echo do_shortcode('[login_form]');
}

add_action( 'login_form', __NAMESPACE__ . '\init');

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
	return '10up.com';
}

add_filter( 'login_headertitle', __NAMESPACE__ . '\logo_url_title' );

//edit login error message
function login_error_override() {
		return 'Incorrect email or password.';
}

add_filter('login_errors', __NAMESPACE__ . '\login_error_override');

// login form fields
function login_form_fields() {

	ob_start(); ?>
		<form id="login_form"  class="form" action="">
			<fieldset>
				<p>
					<label for="custom_user_login">Enter your <span>Username</span></label>
					<input name="custom_user_login" id="custom_user_login" class="required" type="text"/>
				</p>
				<p>
					<label for="custom_user_pass">Enter your <span>Password</span></label>
					<input name="custom_user_pass" id="custom_user_pass" class="required" type="password"/>
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

<?php

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

add_action( 'wp_enqueue_scripts', 'custom_add_google_fonts' );

//update logo link and URL to direct to 10up with filters
function logo_url() {
	return get_bloginfo( 'https://10up.com/' );
}

add_filter( 'login_headerurl', 'logo_url' );

function logo_url_title() {
	return '10up.com';
}

add_filter( 'login_headertitle', 'logo_url_title' );

//edit login error message
function login_error_override() {
    return 'Incorrect email or password.';
}

add_filter('login_errors', 'login_error_override');

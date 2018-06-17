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

function custom_login_markup() {

}

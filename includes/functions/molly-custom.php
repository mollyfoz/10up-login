<?php
namespace TenUpLogin\MollyCustom;

function login_styles() {
	wp_enqueue_style(
		'10up_custom_login',
		TENUP_LOGIN_URL . 'dist/css/style.min.css',
		[],
		TENUP_LOGIN_VERSION
	);
}

add_action('login_enqueue_scripts', __NAMESPACE__ . '\login_styles');

function custom_login_markup() {
	
}

add_action()

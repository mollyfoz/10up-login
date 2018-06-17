<?php
namespace 10upLogin\Core;

/**
 * Default setup routine
 *
 * @return void
 */
function setup() {
	$n = function( $function ) {
		return __NAMESPACE__ . "\\$function";
	};

	add_action( 'init', $n( 'i18n' ) );
	add_action( 'init', $n( 'init' ) );
	add_action( 'wp_enqueue_scripts', $n( 'scripts' ) );
	add_action( 'wp_enqueue_scripts', $n( 'styles' ) );
	add_action( 'admin_enqueue_scripts', $n( 'admin_scripts' ) );
	add_action( 'admin_enqueue_scripts', $n( 'admin_styles' ) );

	// Editor styles. add_editor_style() doesn't work outside of a theme.
	add_filter( 'mce_css', $n( 'mce_css' ) );

	do_action( '10up_login_loaded' );
}

/**
 * Registers the default textdomain.
 *
 * @return void
 */
function i18n() {
	$locale = apply_filters( 'plugin_locale', get_locale(), '10up-login' );
	load_textdomain( '10up-login', WP_LANG_DIR . '/10up-login/10up-login-' . $locale . '.mo' );
	load_plugin_textdomain( '10up-login', false, plugin_basename( 10UP_LOGIN_PATH ) . '/languages/' );
}

/**
 * Initializes the plugin and fires an action other plugins can hook into.
 *
 * @return void
 */
function init() {
	do_action( '10up_login_init' );
}

/**
 * Activate the plugin
 *
 * @return void
 */
function activate() {
	// First load the init scripts in case any rewrite functionality is being loaded
	init();
	flush_rewrite_rules();
}

/**
 * Deactivate the plugin
 *
 * Uninstall routines should be in uninstall.php
 *
 * @return void
 */
function deactivate() {

}

/**
 * Generate an URL to a script, taking into account whether SCRIPT_DEBUG is enabled.
 *
 * @param string $script Script file name (no .js extension)
 * @param string $context Context for the script ('admin', 'frontend', or 'shared')
 *
 * @return string|WP_Error URL
 */
function script_url( $script, $context ) {

	if( !in_array( $context, ['admin', 'frontend', 'shared'], true) ) {
		error_log('Invalid $context specfied in 10upLogin script loader.');
		return '';
	}

	return ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) ?
		10UP_LOGIN_URL . "assets/js/${context}/{$script}.js" :
		10UP_LOGIN_URL . "dist/js/${context}.min.js" ;

}

/**
 * Generate an URL to a stylesheet, taking into account whether SCRIPT_DEBUG is enabled.
 *
 * @param string $stylesheet Stylesheet file name (no .css extension)
 * @param string $context Context for the script ('admin', 'frontend', or 'shared')
 *
 * @return string URL
 */
function style_url( $stylesheet, $context ) {

	if( !in_array( $context, ['admin', 'frontend', 'shared'], true) ) {
		error_log('Invalid $context specfied in 10upLogin stylesheet loader.');
		return '';
	}

	return ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) ?
		10UP_LOGIN_URL . "assets/css/${context}/{$stylesheet}.css" :
		10UP_LOGIN_URL . "dist/css/${stylesheet}.min.css" ;

}

/**
 * Enqueue scripts for front-end.
 *
 * @return void
 */
function scripts() {

	wp_enqueue_script(
		'10up_login_shared',
		script_url( 'shared', 'shared' ),
		[],
		10UP_LOGIN_VERSION,
		true
	);

	wp_enqueue_script(
		'10up_login_frontend',
		script_url( 'frontend', 'frontend' ),
		[],
		10UP_LOGIN_VERSION,
		true
	);

}

/**
 * Enqueue scripts for admin.
 *
 * @return void
 */
function admin_scripts() {

	wp_enqueue_script(
		'10up_login_shared',
		script_url( 'shared', 'shared' ),
		[],
		10UP_LOGIN_VERSION,
		true
	);

	wp_enqueue_script(
		'10up_login_admin',
		script_url( 'admin', 'admin' ),
		[],
		10UP_LOGIN_VERSION,
		true
	);

}

/**
 * Enqueue styles for front-end.
 *
 * @return void
 */
function styles() {

	wp_enqueue_style(
		'10up_login_shared',
		style_url( 'shared-style', 'shared' ),
		[],
		10UP_LOGIN_VERSION
	);

	if( is_admin() ) {
		wp_enqueue_script(
			'10up_login_admin',
			style_url( 'admin-style', 'admin' ),
			[],
			10UP_LOGIN_VERSION,
			true
		);
	}
	else {
		wp_enqueue_script(
			'10up_login_frontend',
			style_url( 'style', 'frontend' ),
			[],
			10UP_LOGIN_VERSION,
			true
		);
	}

}

/**
 * Enqueue styles for admin.
 *
 * @return void
 */
function admin_styles() {

	wp_enqueue_style(
		'10up_login_shared',
		style_url( 'shared-style', 'shared' ),
		[],
		10UP_LOGIN_VERSION
	);

	wp_enqueue_script(
		'10up_login_admin',
		style_url( 'admin-style', 'admin' ),
		[],
		10UP_LOGIN_VERSION,
		true
	);

}

/**
 * Enqueue editor styles. Filters the comma-delimited list of stylesheets to load in TinyMCE.
 *
 * @param string $stylesheets Comma-delimited list of stylesheets.
 * @return string
 */
function mce_css( $stylesheets ) {
	if ( ! empty( $stylesheets ) ) {
		$stylesheets .= ',';
	}

	return $stylesheets . 10UP_LOGIN_URL . ( ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) ?
			'assets/css/frontend/editor-style.css' :
			'dist/css/editor-style.min.css' );
}

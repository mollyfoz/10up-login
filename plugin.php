<?php
/**
 * Plugin Name: 10upLogin
 * Plugin URI:
 * Description:
 * Version:     0.1.0
 * Author:      10up
 * Author URI:  https://10up.com
 * Text Domain: 10up-login
 * Domain Path: /languages
 */

// Useful global constants
define( '10UP_LOGIN_VERSION', '0.1.0' );
define( '10UP_LOGIN_URL',     plugin_dir_url( __FILE__ ) );
define( '10UP_LOGIN_PATH',    dirname( __FILE__ ) . '/' );
define( '10UP_LOGIN_INC',     10UP_LOGIN_PATH . 'includes/' );

// Include files
require_once 10UP_LOGIN_INC . 'functions/core.php';


// Activation/Deactivation
register_activation_hook( __FILE__, '\10upLogin\Core\activate' );
register_deactivation_hook( __FILE__, '\10upLogin\Core\deactivate' );

// Bootstrap
10upLogin\Core\setup();

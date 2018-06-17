<?php
/**
 * Plugin Name: TenUpLogin
 * Plugin URI:  https://github.com/mollyfoz/10up-login
 * Description: 10up Custom Login Plugin
 * Version:     0.1.0
 * Author:      Molly Magnifico
 * Author URI:  https://github.com/mollyfoz/
 * Text Domain: 10up-login
 * Domain Path: /languages
 */

// Useful global constants
define( 'TENUP_LOGIN_VERSION', '0.1.0' );
define( 'TENUP_LOGIN_URL',     plugin_dir_url( __FILE__ ) );
define( 'TENUP_LOGIN_PATH',    dirname( __FILE__ ) . '/' );
define( 'TENUP_LOGIN_INC',     TENUP_LOGIN_PATH . 'includes/' );

// Include files, add custom login plugin php partial
require_once TENUP_LOGIN_INC . 'functions/core.php';
require_once TENUP_LOGIN_INC . 'functions/molly-custom.php';


// Activation/Deactivation
register_activation_hook( __FILE__, '\TenUpLogin\Core\activate' );
register_deactivation_hook( __FILE__, '\TenUpLogin\Core\deactivate' );

// Bootstrap
TenUpLogin\Core\setup();

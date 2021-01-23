<?php
/**
* @package HideOutbrain
* Plugin Name: Hide Outbrain
* Plugin URI: https://hire.jonathangrover.com
* Description: Custom plugin built for FabOverFifty. Allows user to pass titles of existing posts where Outbrain Ads should be hidden.
* Version: 1.0.0
* Author: Jonathan Grover
* Author URI: https://hire.jonathangrover.com
* License: GPLv2 or later
* Text Domain: hide-outbrain
*/

if( !defined('ABSPATH') ) : exit(); endif;

define( 'MYPLUGIN_PATH', trailingslashit( plugin_dir_path(__FILE__) ) );
define( 'MYPLUGIN_URL', trailingslashit( plugins_url('/', __FILE__) ) );

// Plugin Settings Link
function add_action_links ( $actions ) {
  $mylinks = array(
    '<a href="' . admin_url( 'admin.php?page=hideoutbrain-settings-page' ) . '">Settings</a>',
  );
  $actions = array_merge( $actions, $mylinks );
  return $actions;
}
add_filter( 'plugin_action_links_' . plugin_basename(__FILE__), 'add_action_links' );

// Settings Page & Sidebar Link
require_once MYPLUGIN_PATH . '/settings.php';

// Store Options In JavaScript
require_once MYPLUGIN_PATH . '/store.php';

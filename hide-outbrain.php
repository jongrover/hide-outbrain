<?php
/**
* @package HideOutbrain
* Plugin Name: Hide Outbrain Plugin
* Plugin URI: https://hire.jonathangrover.com
* Description: Custom plugin built for FabOverFifty. Allows user to ass titles of existing posts where Outbrain Ads should be hidden.
* Version: 1.0.0
* Author: Jonathan Grover
* Author URI: https://hire.jonathangrover.com
* License: GPLv2 or later
* Text Domain: hide-outbrain
*/

defined('ABSPATH') or die('You do not have permission to access this file!');

if (!class_exists('HideOutbrain')) {

  class HideOutbrain {

    public $plugin_name;

    function __construct() {
      $this->plugin_name = plugin_basename(__FILE__);
    }

    function register() {
      add_action('admin_menu', array($this, 'add_plugin_ui_page'));
      add_filter("plugin_action_links_$this->plugin_name", array($this, 'add_plugin_link'));
    }

    function activate() {
      // create db table
      global $wpdb;
      global $table_prefix;
      $table_name = $table_prefix."hide_outbrain";
      $query = $wpdb->prepare('SHOW TABLES LIKE %s', $wpdb->esc_like( $table_name ));
      if ( !$wpdb->get_var( $query ) == $table_name ) {
        $charset_collate = $wpdb->get_charset_collate();
        $sql = "CREATE TABLE $table_name (id mediumint(9) NOT NULL AUTO_INCREMENT, title varchar(255) DEFAULT '' NOT NULL, PRIMARY KEY (id)) $charset_collate;";
        require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
        dbDelta( $sql );
      }
      flush_rewrite_rules();
    }

    function deactivate() {
      flush_rewrite_rules();
    }

    function add_plugin_ui_page() {
      add_menu_page('Hide Outbrain', 'Hide Outbrain', 'manage_options', 'hide_outbrain', array($this, 'build_index'), 'dashicons-forms', 110);
    }

    function build_index() {
      require_once plugin_dir_path(__FILE__).'templates/index.php';
    }

    function add_plugin_link($links) {
      $settings_link = '<a href="admin.php?page=hide_outbrain">Settings</a>';
      array_push($links, $settings_link);
      return $links;
    }
  }

  $hideOutbrain = new HideOutbrain();
  $hideOutbrain->register();

  register_activation_hook(__FILE__, array($hideOutbrain, 'activate'));
  register_deactivation_hook(__FILE__, array($hideOutbrain, 'deactivate'));
}

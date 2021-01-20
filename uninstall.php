<?php

 if (!defined('WP_UNINSTALL_PLUGIN')) {
   die;
 }

global $wpdb;
global $table_prefix;
$table_name = $table_prefix."hide_outbrain";
$wpdb->query( "DROP TABLE IF EXISTS $table_name" );

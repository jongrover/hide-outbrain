<?php

function my_scripts_style() {
  wp_enqueue_script(
    'hide-outbrain-store',
    plugins_url('store.js', __FILE__),
    array('jquery'),
    null,
    true
  );
  wp_localize_script(
    'hide-outbrain-store',
    'myAjax',
    array(
      'url' =>admin_url( 'admin-ajax.php' ),
      'nonce' => wp_create_nonce( "ajax_call_nonce" )
    )
  );
}
add_action( 'wp_enqueue_scripts','my_scripts_style');

function execute_ajax() {
  global $wpdb;
  // global $table_prefix;
  // $table_name = $table_prefix."options";
  $table_name = "wp_2_options";
  $nonce = check_ajax_referer( 'ajax_call_nonce', 'nonce' );
  if($nonce == true) {
    $result = $wpdb->get_results("SELECT * FROM $table_name WHERE option_name = 'hideoutbrain_settings_titles_field'");
    echo json_encode($result[0], JSON_FORCE_OBJECT);
    die;
  }
}
add_action( 'wp_ajax_execute_ajax', 'execute_ajax');

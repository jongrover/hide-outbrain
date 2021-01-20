<?php
/**
* @package HideOutbrain
*/
global $wpdb;
global $table_prefix;
$table_name = $table_prefix."hide_outbrain";
$post_title = $_POST['post-title'];
echo var_dump($wpdb);
//$wpdb->query("INSERT INTO $table_name (title) VALUES ('$post_title')");
// $id = $wpdb->insert_id;
// $base = dirname(__FILE__);
// $path = dirname(dirname($base))."/admin.php?page=hide-outbrain";
// if (!is_null($id)) {
//   header('Location: '.$path);
// } else {
//   die('Title not added to database! Check server log.');
// }

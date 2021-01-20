<?php
global $wpdb;
global $table_prefix;
$table_name = $table_prefix."hide_outbrain";
$rows = $wpdb->get_results("SELECT * FROM $table_name");
?>

<h1>Hide Outbrain</h1>

<table>
  <tbody>
    <tr>
      <th>Title</th>
    </tr>
    <?php foreach ( $rows as $row ) { ?>
    <tr>
      <td><?php echo $row->title; ?></td>
    </tr>
    <?php } ?>
  </tbody>
</table>

<form action="../wp-content/plugins/hide-outbrain/includes/process.php" method="post">
  <input type="text" name="post-title" id="post-title" required>
  <input type="submit" value="submit">
</form>

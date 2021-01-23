jQuery(document).ready(function () {

  // This script will hide Outbrain ads on certain posts based on the post title.
  // Below in the titles variable insert each post title you want to hide Outbrain for.
  // Make sure to insert all "titles" as strings and end each line inside the array with a comma,
  // unless it is the last title in the array.
  // This script also requires the following html be inserted in the single.php:
  // <div class="outbrain-sidebar-target" data-type="below"></div>
  // or templates/sidebar.php, templates/search-sidebar.php pages:
  // <div class="outbrain-sidebar-target" data-type="sidebar"></div>
  // email: hello@jonathangrover.com for questions.

  jQuery.post( myAjax.url, { action: 'execute_ajax', nonce: myAjax.nonce }, function( response ) {

    var json = JSON.parse(response),
        titles = json.option_value.split("\n"); // seperate on line returns into new array.
        query = jQuery('.entry-title a').eq(0).text(),
        match = false,
        i = 0;

    function compare(title) {
     if (query !== title) {
       match = false;
       i++;
     } else {
       match = true;
     }
    }

    function displayOutbrain() {
     if (jQuery('.outbrain-sidebar-target[data-type="sidebar"]')) {
       jQuery('.outbrain-sidebar-target[data-type="sidebar"]').html('<div class="OUTBRAIN" data-widget-id="TS_1" data-src="" data-ob-template="faboverfifty"></div>');
     }
     if (jQuery('.outbrain-sidebar-target[data-type="below"]')) {
       jQuery('.outbrain-sidebar-target[data-type="below"]').html('<div class="OUTBRAIN" data-widget-id= "TF_6" data-src="" data-ob-template="faboverfifty"></div>');
     }
    }

    while(!match && i < titles.length) {
     compare(titles[i]);
    }

    if (!match) {
     console.log('no match so display ads');
     displayOutbrain();
    } else {
     console.log('title matched so do not display ads');
    }

  }).fail(function(xhr, status, error) {
    console.log(xhr, status, error);
  });;

});

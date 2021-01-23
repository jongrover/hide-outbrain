<?php

/**
 * Create Settings Menu
 */
function hideoutbrain_settings_menu() {

    add_menu_page(
        __( 'Hide Outbrain Titles', 'my-plugin' ),
        __( 'Hide Outbrain', 'my-plugin' ),
        'manage_options',
        'hideoutbrain-settings-page',
        'hideoutbrain_settings_template_callback',
        'dashicons-forms',
        null
    );

}
add_action('admin_menu', 'hideoutbrain_settings_menu');

/**
 * Settings Template Page
 */
function hideoutbrain_settings_template_callback() {
    ?>
    <div class="wrap">
        <h1><?php echo esc_html( get_admin_page_title() ); ?></h1>
        <p>Please insert each title on a seperate line with no surrounding quotes and no comma separation. Remember to click the button below to save your changes.</p>
        <form action="options.php" method="post">
            <?php
                // security field
                settings_fields( 'hideoutbrain-settings-page' );

                // output settings section here
                do_settings_sections('hideoutbrain-settings-page');

                // save settings button
                submit_button( 'Save Changes' );
            ?>
        </form>
    </div>
    <?php
}

/**
 * Settings Template
 */
function hideoutbrain_settings_init() {

    // Setup settings section
    add_settings_section(
        'hideoutbrain_settings_section',
        '',
        '',
        'hideoutbrain-settings-page'
    );

    // Register textarea field
    register_setting(
        'hideoutbrain-settings-page',
        'hideoutbrain_settings_titles_field',
        array(
            'type' => 'string',
            'sanitize_callback' => 'sanitize_textarea_field',
            'default' => ''
        )
    );

     // Add textarea fields
     add_settings_field(
        'hideoutbrain_settings_titles_field',
        __( 'Titles', 'my-plugin' ),
        'hideoutbrain_settings_titles_field_callback',
        'hideoutbrain-settings-page',
        'hideoutbrain_settings_section'
    );

}
add_action( 'admin_init', 'hideoutbrain_settings_init' );


/**
 * textarea template
 */
function hideoutbrain_settings_titles_field_callback() {
    $hideoutbrain_textarea_field = get_option('hideoutbrain_settings_titles_field');
    ?>
    <textarea name="hideoutbrain_settings_titles_field" class="large-text" rows="10"><?php echo isset($hideoutbrain_textarea_field) ? esc_textarea( $hideoutbrain_textarea_field ) : ''; ?></textarea>
    <?php
}

<?php

/**
 * Plugin Name: Gift Card Magic
 * Plugin URI: Plugin page URL (if any)
 * Description: Brief description of your plugin
 * Version: Plugin version
 * Author: Plugin author
 * Author URI: Author's personal website URL (if any)
 * License: Plugin license (e.g., GPL-2.0+)
 * License URI: License page URL (if any)
 */

// Register and initialize the plugin
function gift_card_magic_initialize()
{
    // Place your code here to initialize the plugin

    // Example: Register actions and filters
    add_action('init', 'gift_card_magic_custom_function');
    add_filter('the_content', 'gift_card_magic_custom_filter');
}


$plugin_dir = plugin_dir_path(__FILE__);

// Load the action files
require_once $plugin_dir . 'admin.php';


function gift_card_magic_register_styles() {
    // Đăng ký file CSS
    wp_enqueue_style('gift-card-magic-admin', plugin_dir_url(__FILE__) . 'assets/css/admin.css', array(), '1.0.0', 'all');
}

add_action('admin_enqueue_scripts', 'gift_card_magic_register_styles');



// Callback function for plugin activation
function gift_card_magic_activate()
{
    global $wpdb;
    $table_settings = $wpdb->prefix . 'gcm_settings';
    $table_settings_frontend = $wpdb->prefix . 'gcm_settings_frontend';
    $table_payment = $wpdb->prefix . 'gcm_settings_payment';

    // Check if the table 'gcm_settings' already exists in the database
    if ($wpdb->get_var("SHOW TABLES LIKE '$table_settings'") != $table_settings) {
        // Define the SQL statement for creating the table 'gcm_settings'
        $sql_settings = "CREATE TABLE $table_settings (
            id INT(11) NOT NULL AUTO_INCREMENT,
            minimum_voucher_value INT(11),
            maximum_voucher_value INT(11),
            voucher_expiry_value INT(11),
            expiry_date_format VARCHAR(255),
            hide_voucher_first_step INT(1),
            hide_price_from_voucher INT(1),
            voucher_preview_button INT(1),
            custom_loader_url LONGTEXT,
            PRIMARY KEY (id)
        )";
        // Include the necessary WordPress file
        require_once(ABSPATH . 'wp-admin/includes/upgrade.php');

        // Execute the SQL statement to create the table 'gcm_settings'
        dbDelta($sql_settings);
        $wpdb->insert(
            $table_settings,
            array(
                'minimum_voucher_value' => 0,
                'maximum_voucher_value' => 100,
                'voucher_expiry_value' => 60,
                'expiry_date_format' => 'd.m.Y',
                'hide_voucher_first_step' => 0,
                'hide_price_from_voucher' => 0,
                'voucher_preview_button' => 0,
                'custom_loader_url' => '',
            )
        );
    }

    // Check if the table 'gcm_settings_frontend' already exists in the database
    if ($wpdb->get_var("SHOW TABLES LIKE '$table_settings_frontend'") != $table_settings_frontend) {
        // Define the SQL statement for creating the table 'gcm_settings_frontend'
        $sql_settings_frontend = "CREATE TABLE $table_settings_frontend (
            id INT(11) NOT NULL AUTO_INCREMENT,
            show_name VARCHAR(255),
            show_recipient_name VARCHAR(255),
            show_voucher_value VARCHAR(255),
            show_personal_message VARCHAR(255),
            background_color VARCHAR(255),
            text_color VARCHAR(255),
            terms VARCHAR(255),
            email_company VARCHAR(255),
            link_company VARCHAR(255),
            currency VARCHAR(255),
            currency_position VARCHAR(255),
            price_display_format VARCHAR(255),
            company_logo LONGTEXT,
            company_name VARCHAR(255),
            PRIMARY KEY (id)
        )";


        // Include the necessary WordPress file
        require_once(ABSPATH . 'wp-admin/includes/upgrade.php');

        // Execute the SQL statement to create the table 'gcm_settings_frontend'
        dbDelta($sql_settings_frontend);
        $wpdb->insert(
            $table_settings_frontend,
            array(
                'show_name' => '1',
                'show_recipient_name' => '1',
                'show_voucher_value' => '1',
                'show_personal_message' => '1',
                'background_color' => '#FFFFFF',
                'text_color' => '#000000',
                'terms' => 'Terms and conditions apply.',
                'email_company' => 'company@gmail.com',
                'link_company' => 'example.com',
                'company_logo' => '',
                'company_name' => '',
            )
        );
    }

    // Check if the table 'gcm_settings' already exists in the database
    if ($wpdb->get_var("SHOW TABLES LIKE '$table_payment'") != $table_payment) {
        // Define the SQL statement for creating the table 'gcm_settings'
        $sql_payment = "CREATE TABLE $table_payment (
            id INT(11) NOT NULL AUTO_INCREMENT,
            paypal_standar VARCHAR(255),
            stripe VARCHAR(255),
            currency VARCHAR(10),
            currency_position VARCHAR(10),
            price_display_format VARCHAR(10),
            test_mode VARCHAR(255),
            paypal_client_id VARCHAR(255),
            payPal_secret_key VARCHAR(255),
            stripe_publishable_key VARCHAR(255),
            stripe_secret_key VARCHAR(255),
            stripe_webhook_url VARCHAR(255),
            stripe_webhook_secret_key VARCHAR(255),
            PRIMARY KEY (id)
        )";
        

        // Include the necessary WordPress file
        require_once(ABSPATH . 'wp-admin/includes/upgrade.php');

        // Execute the SQL statement to create the table 'gcm_payment'
        dbDelta($sql_payment);     

        
        $wpdb->insert(
            $table_payment,
            array(
                'paypal_standar' => '0',
                'stripe' => '0',
                'currency' => '',
                'currency_position' => '',
                'price_display_format' => '',
                'test_mode' => '0',
                'paypal_client_id' => '',
                'payPal_secret_key' => '',
                'stripe_publishable_key' => '',
                'stripe_secret_key' => '',
                'stripe_webhook_url' => '',
                'stripe_webhook_secret_key' => '',
            )
        );
    }
    
}
register_activation_hook(__FILE__, 'gift_card_magic_activate');





// Custom function of the plugin
function gift_card_magic_custom_function()
{
    // Handle the plugin's logic here
}

// Custom filter of the plugin
function gift_card_magic_custom_filter($content)
{
    // Handle the plugin's filter here
    return $content;
}

require_once $plugin_dir . 'includes/backend/shortcode.php';
// Call the plugin initialization function
add_action('plugins_loaded', 'gift_card_magic_initialize');






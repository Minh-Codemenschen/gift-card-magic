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



// Callback function for plugin activation
function gift_card_magic_activate()
{
    global $wpdb;
    $table_name = $wpdb->prefix . 'gcm_settings';

    // Check if the table already exists in the database
    if ($wpdb->get_var("SHOW TABLES LIKE '$table_name'") != $table_name) {
        // Define the SQL statement for creating the table
        $sql = "CREATE TABLE $table_name (
                id INT(11) NOT NULL AUTO_INCREMENT,
                column1 VARCHAR(255),
                column2 VARCHAR(255),
                PRIMARY KEY (id)
            )";

        // Include the necessary WordPress file
        require_once(ABSPATH . 'wp-admin/includes/upgrade.php');

        // Execute the SQL statement to create the table
        dbDelta($sql);
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

// Call the plugin initialization function
add_action('plugins_loaded', 'gift_card_magic_initialize');



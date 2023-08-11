<?php

require_once $plugin_dir . 'includes/backend/cpt_gift_card_magic.php';

// Add menu for the plugin
function gift_card_magic_add_menu()
{
    // Add main menu
    $menu_slug = add_menu_page(
        __("Gift Card Magic","gift-card-magic"),      // Page title
        __("Gift Card Magic","gift-card-magic"),      // Menu name
        'manage_options',       // Required capability to view the menu
        'gift-card-magic',      // Menu slug
        'gift_card_magic_page', // Callback function to display the menu page content
        '',                     // Icon URL (if any)
        20                       // Position of the menu
    );

    // Add submenus
    add_submenu_page(
        'gift-card-magic',      // Parent menu slug
        __("Dashboard","gift-card-magic"),            // Submenu page title
        __("Dashboard","gift-card-magic"),            // Submenu name
        'manage_options',       // Required capability to view the submenu
        'gift-card-dashboard',  // Submenu slug
        'gift_card_magic_dashboard_page' // Callback function to display the submenu page content
    );

    // Add submenu (if needed)
    add_submenu_page(
        'gift-card-magic',      // Parent menu slug
        __("Settings","gift-card-magic"),             // Submenu page title
        __("Settings","gift-card-magic"),             // Submenu name
        'manage_options',       // Required capability to view the submenu
        'gift-card-settings',    // Submenu slug
        'gift_card_magic_settings_page' // Callback function to display the submenu page content
    );

    // Add submenu "Gift Card Magic" cho custom post type "Gift Card Magic"
    add_submenu_page(
        'gift-card-magic',                         // Parent menu slug
        __("Gift Card Magic","gift-card-magic"),                        // Submenu page title
        __("Gift Card Magic","gift-card-magic"),                        // Submenu name
        'manage_options',                         // Required capability to view the submenu
        'edit.php?post_type=gift_card_magic'       // Submenu slug
    );

    // Add submenu "Categories" cho custom post type "Gift Card Magic"
    add_submenu_page(
        'gift-card-magic',                         // Parent menu slug
        __("Categories","gift-card-magic"),                             // Submenu page title
        __("Categories","gift-card-magic"),                             // Submenu name
        'manage_options',                         // Required capability to view the submenu
        'edit-tags.php?taxonomy=gift_card_category' // Submenu slug
    );

    // Remove the unwanted submenu head
    global $submenu;
    if (isset($submenu['gift-card-magic'])) {
        unset($submenu['gift-card-magic'][0]);
    }
}

// Call the menu adding function
add_action('admin_menu', 'gift_card_magic_add_menu');

// Remove custom post type "Gift Card Magic" from main menu
function gift_card_magic_remove_from_main_menu()
{
    global $menu;
    $post_type = 'gift_card_magic'; // Replace with your custom post type name

    foreach ($menu as $index => $item) {
        if (isset($item[2]) && $item[2] === 'edit.php?post_type=' . $post_type) {
            unset($menu[$index]);
            break;
        }
    }
}

add_action('admin_menu', 'gift_card_magic_remove_from_main_menu');

// Register and enqueue the JavaScript file
function gift_card_magic_enqueue_scripts()
{
    wp_enqueue_media();
    // Register the script
    wp_register_script(
        'gift-card-magic-backend', // Handle/slug for the script
        plugin_dir_url(__FILE__) . 'assets/js/backend.js', // Path to the JavaScript file
        array('jquery'), // Dependencies (if any)
        '1.0', // Version number (optional)
        true // Enqueue the script in the footer
    );
    wp_localize_script('gift-card-magic-backend', 'pluginData', array(
        'siteUrl' => esc_url(site_url())
    )); 

    // Enqueue the script
    wp_enqueue_script('gift-card-magic-backend');
}
add_action('admin_enqueue_scripts', 'gift_card_magic_enqueue_scripts');


// Callback function to display the submenu page content - Dashboard
function gift_card_magic_dashboard_page()
{
    // Code to display the dashboard submenu page content
}

// Callback function to display the submenu page content - Settings
function gift_card_magic_settings_page_old()
{
    // Xử lý khi người dùng submit form
    if (isset($_POST['save-giftcardMagic']) && wp_verify_nonce($_POST['_wpnonce'], 'save-giftcardMagic')) {
        // Kiểm tra quyền trước khi xử lý
        if (!current_user_can('manage_options')) {
            wp_die('Unauthorized access', 'Unauthorized', array('response' => 403));
        }

        // Lấy dữ liệu từ form và chuyển đổi sang dạng dữ liệu phù hợp
        $minimum_voucher_value = intval($_POST['minimum_voucher_value']);
        $maximum_voucher_value = intval($_POST['maximum_voucher_value']);
        $voucher_expiry_value = intval($_POST['voucher_expiry_value']);
        $expiry_date_format = sanitize_text_field($_POST['expiry_date_format']);
        $hide_voucher_first_step = isset($_POST['hide_voucher_first_step']) ? intval($_POST['hide_voucher_first_step']) : 0;
        $hide_price_from_voucher = isset($_POST['hide_price_from_voucher']) ? intval($_POST['hide_price_from_voucher']) : 0;
        $voucher_preview_button = isset($_POST['voucher_preview_button']) ? intval($_POST['voucher_preview_button']) : 0;
        $custom_loader_url = sanitize_text_field($_POST['custom_loader_url']);
        // Tiến hành cập nhật dữ liệu vào bảng wp_gcm_settings

        global $wpdb;
        $table_name = $wpdb->prefix . 'gcm_settings';

        $data = array(
            'minimum_voucher_value' => $minimum_voucher_value,
            'maximum_voucher_value' => $maximum_voucher_value,
            'voucher_expiry_value' => $voucher_expiry_value,
            'expiry_date_format' => $expiry_date_format,
            'hide_voucher_first_step' => $hide_voucher_first_step,
            'hide_price_from_voucher' => $hide_price_from_voucher,
            'voucher_preview_button' => $voucher_preview_button,
            'custom_loader_url' => $custom_loader_url
        );

        $where = array(
            'id' => 1 // Điều kiện WHERE
        );

        $check = $wpdb->update($table_name, $data, $where);
        if ($check !== false) {
            add_settings_error('settings_saved', 'settings_saved', 'Dữ liệu settings lưu thành công.', 'updated');
        }



    }
    // Get the plugin directory path
    $plugin_dir = plugin_dir_path(__FILE__);

    // Load the action files
    require_once $plugin_dir . 'includes/backend/settings_file.php';
    require_once $plugin_dir . 'includes/backend/frontend_file.php';
    require_once $plugin_dir . 'includes/backend/payment_file.php';
?>
    <div class="wrap">
        <form action="<?php echo admin_url('admin.php?page=gift-card-settings'); ?>" method="post" id="setting-giftcardMagic" class="wrap-giftcardMagic">
            <?php wp_nonce_field('save-giftcardMagic'); ?>
            <h1>Settings</h1>
            <?php settings_errors(); ?> <!-- Hiển thị thông báo -->
            <h2 class="nav-tab-wrapper">
                <a href="#" class="nav-tab nav-tab-active" data-tab="settings">Settings</a>
                <a href="#" class="nav-tab" data-tab="frontend">Frontend</a>
                <a href="#" class="nav-tab" data-tab="payment">Payment</a>
            </h2>
            <div id="tab-content">
                <div id="tab-settings" class="tab-panel">
                    <?php do_action('gift_card_magic_settings_tab'); ?>
                </div>
                <div id="tab-frontend" class="tab-panel" style="display:none">
                    <?php do_action('gift_card_magic_frontend_tab'); ?>
                </div>
                <div id="tab-payment" class="tab-panel" style="display:none">
                    <?php do_action('gift_card_magic_payment_tab'); ?>
                </div>
            </div>
            <div class="sidebar-giftcardMagic">
                <p class="submit"><input type="submit" value="Save" name="save-giftcardMagic" id="save-giftcardMagic"></p>
            </div>
        </form>
    </div>
<?php
}
function gift_card_magic_settings_page()
{
    // Get the plugin directory path
    $plugin_dir = plugin_dir_path(__FILE__);

    // Load the action files
    require_once $plugin_dir . 'includes/backend/settings_file.php';
    require_once $plugin_dir . 'includes/backend/frontend_file.php';
    require_once $plugin_dir . 'includes/backend/payment_file.php';
    $current_admin_url = esc_url( home_url( $_SERVER['REQUEST_URI'] ) );
?>
    <div class="wrap">
        <form action="<?php echo $current_admin_url; ?>" method="POST" id="setting-giftcardMagic" class="wrap-giftcardMagic">
            <h1><?php _e('Settings','gift-card-magic'); ?></h1>
            <h2 class="nav-tab-wrapper">
                <a href="#" class="nav-tab nav-tab-active" data-tab="settings"><?php _e('Settings','gift-card-magic'); ?></a>
                <a href="#" class="nav-tab" data-tab="frontend"><?php _e('Frontend','gift-card-magic'); ?></a>
                <a href="#" class="nav-tab" data-tab="payment"><?php _e('Payment','gift-card-magic'); ?></a>
            </h2>
            <div id="tab-content">
                <div id="tab-settings" class="tab-panel">
                    <?php do_action('gift_card_magic_settings_tab'); ?>
                </div>
                <div id="tab-frontend" class="tab-panel" style="display:none">
                    <?php do_action('gift_card_magic_frontend_tab'); ?>
                </div>
                <div id="tab-payment" class="tab-panel" style="display:none">
                    <?php do_action('gift_card_magic_payment_tab'); ?>
                </div>
            </div>
            <div class="sidebar-giftcardMagic">
                <p class="submit"><input type="submit" value="<?php _e('Save','gift-card-magic'); ?>" id="save-giftcardMagic"></p>
            </div>
        </form>
    </div>
    <div class="display-loading-giftcardMagic">
        <div class="wrap-loading-giftcardMagic">
            <span class="loader-giftcardMagic"></span>
        </div>
    </div>
<?php
}
// AJAX handler function
function save_giftcard_settings() {
    parse_str($_POST['form_data'], $form_data);
    global $wpdb;

    // Update data in gcm_settings_payment table
    $wpdb->update(
        $wpdb->prefix . 'gcm_settings_payment', // Replace with your actual table name
        $form_data['gcm_settings_payment'], // Data to update
        array('id' => 1) // Update condition, change as per your needs
    );

    // Update data in gcm_settings_frontend table
    $wpdb->update(
        $wpdb->prefix . 'gcm_settings_frontend', // Replace with your actual table name
        $form_data['gcm_settings_frontend'], // Data to update
        array('id' => 1) // Update condition, change as per your needs
    );

    // Update data in gcm_settings table
    $wpdb->update(
        $wpdb->prefix . 'gcm_settings', // Replace with your actual table name
        $form_data['gcm_settings'], // Data to update
        array('id' => 1) // Update condition, change as per your needs
    );
    echo 'Settings saved successfully!';
    wp_die();
}

add_action('wp_ajax_save_giftcard_settings', 'save_giftcard_settings');
add_action('wp_ajax_nopriv_save_giftcard_settings', 'save_giftcard_settings'); // For non-logged-in users
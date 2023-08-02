<?php
// Add menu for the plugin
function gift_card_magic_add_menu()
{
    // Add main menu
    $menu_slug = add_menu_page(
        'Gift Card Magic',      // Page title
        'Gift Card Magic',      // Menu name
        'manage_options',       // Required capability to view the menu
        'gift-card-magic',      // Menu slug
        'gift_card_magic_page', // Callback function to display the menu page content
        '',                     // Icon URL (if any)
        20                       // Position of the menu
    );

    // Add submenus
    add_submenu_page(
        'gift-card-magic',      // Parent menu slug
        'Dashboard',            // Submenu page title
        'Dashboard',            // Submenu name
        'manage_options',       // Required capability to view the submenu
        'gift-card-dashboard',  // Submenu slug
        'gift_card_magic_dashboard_page' // Callback function to display the submenu page content
    );

    // Add submenu (if needed)
    add_submenu_page(
        'gift-card-magic',      // Parent menu slug
        'Settings',             // Submenu page title
        'Settings',             // Submenu name
        'manage_options',       // Required capability to view the submenu
        'gift-card-settings',    // Submenu slug
        'gift_card_magic_settings_page' // Callback function to display the submenu page content
    );

    // Add submenu "Gift Card Magic" cho custom post type "Gift Card Magic"
    add_submenu_page(
        'gift-card-magic',                         // Parent menu slug
        'Gift Card Magic',                        // Submenu page title
        'Gift Card Magic',                        // Submenu name
        'manage_options',                         // Required capability to view the submenu
        'edit.php?post_type=gift_card_magic'       // Submenu slug
    );

    // Add submenu "Categories" cho custom post type "Gift Card Magic"
    add_submenu_page(
        'gift-card-magic',                         // Parent menu slug
        'Categories',                             // Submenu page title
        'Categories',                             // Submenu name
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


// Register and enqueue the JavaScript file
function gift_card_magic_enqueue_scripts()
{
    // Register the script
    wp_register_script(
        'gift-card-magic-backend', // Handle/slug for the script
        plugin_dir_url(__FILE__) . 'assets/js/backend.js', // Path to the JavaScript file
        array('jquery'), // Dependencies (if any)
        '1.0', // Version number (optional)
        true // Enqueue the script in the footer
    );

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
function gift_card_magic_settings_page()
{
    // Get the plugin directory path
    $plugin_dir = plugin_dir_path(__FILE__);

    // Load the action files
    require_once $plugin_dir . 'includes/backend/settings_file.php';
    require_once $plugin_dir . 'includes/backend/frontend_file.php';
    require_once $plugin_dir . 'includes/backend/payment_file.php';
?>
    <div class="wrap">
        <form action="" method="" id="setting-giftcardMagic" class="wrap-giftcardMagic">
            <h1>Settings</h1>
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
                <p class="submit"><input type="submit" value="Save" id="save-giftcardMagic"></p>
            </div>
        </form>
    </div>
<?php
}



// Register Custom Post Type
function gift_card_magic_custom_post_type()
{

    $labels = array(
        'name'                  => _x('Gift Card Magic', 'Post Type General Name', 'gift-card-magic'),
        'singular_name'         => _x('Gift Card', 'Post Type Singular Name', 'gift-card-magic'),
        'menu_name'             => __('Gift Card Magic', 'gift-card-magic'),
        'name_admin_bar'        => __('Gift Card', 'gift-card-magic'),
        'archives'              => __('Gift Card Archives', 'gift-card-magic'),
        'attributes'            => __('Gift Card Attributes', 'gift-card-magic'),
        'parent_item_colon'     => __('Parent Gift Card:', 'gift-card-magic'),
        'all_items'             => __('All Gift Cards', 'gift-card-magic'),
        'add_new_item'          => __('Add New Gift Card', 'gift-card-magic'),
        'add_new'               => __('Add New', 'gift-card-magic'),
        'new_item'              => __('New Gift Card', 'gift-card-magic'),
        'edit_item'             => __('Edit Gift Card', 'gift-card-magic'),
        'update_item'           => __('Update Gift Card', 'gift-card-magic'),
        'view_item'             => __('View Gift Card', 'gift-card-magic'),
        'view_items'            => __('View Gift Cards', 'gift-card-magic'),
        'search_items'          => __('Search Gift Card', 'gift-card-magic'),
        'not_found'             => __('Not found', 'gift-card-magic'),
        'not_found_in_trash'    => __('Not found in Trash', 'gift-card-magic'),
        'featured_image'        => __('Featured Image', 'gift-card-magic'),
        'set_featured_image'    => __('Set featured image', 'gift-card-magic'),
        'remove_featured_image' => __('Remove featured image', 'gift-card-magic'),
        'use_featured_image'    => __('Use as featured image', 'gift-card-magic'),
        'insert_into_item'      => __('Insert into Gift Card', 'gift-card-magic'),
        'uploaded_to_this_item' => __('Uploaded to this Gift Card', 'gift-card-magic'),
        'items_list'            => __('Gift Cards list', 'gift-card-magic'),
        'items_list_navigation' => __('Gift Cards list navigation', 'gift-card-magic'),
        'filter_items_list'     => __('Filter Gift Cards list', 'gift-card-magic'),
    );
    $args = array(
        'label'                 => __('Gift Card', 'gift-card-magic'),
        'description'           => __('Custom post type for Gift Card Magic', 'gift-card-magic'),
        'labels'                => $labels,
        'supports'              => array('title', 'editor', 'thumbnail'),
        'taxonomies'            => array('category', 'post_tag'),
        'hierarchical'          => false,
        'public'                => true,
        'show_ui'               => true,
        'show_in_menu'          => true,
        'menu_position'         => 5,
        'show_in_admin_bar'     => true,
        'show_in_nav_menus'     => true,
        'can_export'            => true,
        'has_archive'           => true,
        'exclude_from_search'   => false,
        'publicly_queryable'    => true,
        'capability_type'       => 'post',
    );
    register_post_type('gift_card_magic', $args);
    // Đăng ký custom taxonomy
    $taxonomy_labels = array(
        'name'              => _x('Gift Card Categories', 'taxonomy general name', 'gift-card-magic'),
        'singular_name'     => _x('Gift Card Category', 'taxonomy singular name', 'gift-card-magic'),
        'search_items'      => __('Search Gift Card Categories', 'gift-card-magic'),
        'all_items'         => __('All Gift Card Categories', 'gift-card-magic'),
        'parent_item'       => __('Parent Gift Card Category', 'gift-card-magic'),
        'parent_item_colon' => __('Parent Gift Card Category:', 'gift-card-magic'),
        'edit_item'         => __('Edit Gift Card Category', 'gift-card-magic'),
        'update_item'       => __('Update Gift Card Category', 'gift-card-magic'),
        'add_new_item'      => __('Add New Gift Card Category', 'gift-card-magic'),
        'new_item_name'     => __('New Gift Card Category Name', 'gift-card-magic'),
        'menu_name'         => __('Categories', 'gift-card-magic'),
    );

    $taxonomy_args = array(
        'hierarchical'      => true,
        'labels'            => $taxonomy_labels,
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => array('slug' => 'gift_card_category'), // Đặt slug cho taxonomy
    );

    register_taxonomy('gift_card_category', array('gift_card_magic'), $taxonomy_args);
}
add_action('init', 'gift_card_magic_custom_post_type', 0);


// Hàm callback để hiển thị nội dung của trường tùy chỉnh
function gift_card_magic_custom_field_callback()
{
    // Lấy giá trị của trường tùy chỉnh nếu đã có
    $custom_field_value = get_post_meta(get_the_ID(), 'gcmagic_price', true);
?>
    <label for="gcmagic_price">Gift Card Price:</label>
    <input type="number" id="gcmagic_price" name="gcmagic_price" value="<?php echo esc_attr($custom_field_value); ?>">
<?php
}

// Hàm để đăng ký trường tùy chỉnh
function gift_card_magic_add_custom_meta_box()
{
    add_meta_box(
        'gcmagic_price', // ID của trường tùy chỉnh
        'Gift Card Price', // Tiêu đề của trường tùy chỉnh
        'gift_card_magic_custom_field_callback', // Callback function để hiển thị nội dung của trường tùy chỉnh
        'gift_card_magic', // Loại post type mà trường tùy chỉnh sẽ xuất hiện
        'normal', // Vị trí xuất hiện của trường tùy chỉnh ('normal', 'advanced', 'side')
        'high' // Ưu tiên hiển thị của trường tùy chỉnh ('high', 'core', 'default', 'low')
    );
}
add_action('add_meta_boxes', 'gift_card_magic_add_custom_meta_box');

function gift_card_magic_save_custom_meta_box($post_id)
{

    if (isset($_POST['gcmagic_price'])) {
        $gcmagic_price = sanitize_text_field($_POST['gcmagic_price']);
        update_post_meta($post_id, 'gcmagic_price', $gcmagic_price);
    }
}
add_action('save_post_gift_card_magic', 'gift_card_magic_save_custom_meta_box');



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

function enqueue_media_scripts() {
    // Enqueue media uploader scripts
    wp_enqueue_media();
}
add_action('admin_enqueue_scripts', 'enqueue_media_scripts');


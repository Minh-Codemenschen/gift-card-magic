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

    // Add submenu (if needed)
    add_submenu_page(
        'gift-card-magic',      // Parent menu slug
        'Gift Cards',             // Submenu page title
        'Gift Cards',             // Submenu name
        'manage_options',       // Required capability to view the submenu
        'gift-card-items',    // Submenu slug
        'gift_card_magic_items_page' // Callback function to display the submenu page content
    );

    add_submenu_page(
        'gift-card-items',                              // Parent menu slug
        'Add New',            // Submenu page title
        'Add New',                                        // Submenu name
        'manage_options',                              // Required capability to view the submenu
        'new-gift-card-template',                 // Submenu slug
        'gift_card_magic_add_new_template_page' // Callback function to display the "Add New" page
    );

    add_submenu_page(
        'gift-card-items',      // Parent menu slug
        'Edit Gift Card Template',   // Submenu page title
        'Edit Gift Card Template',   // Submenu name
        'manage_options',       // Required capability to view the submenu
        'edit-gift-card-template',  // Submenu slug
        'gift_card_magic_edit_template_page' // Callback function to display the submenu page content
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
    </div>
<?php
}

// Callback function to display the submenu page content
function gift_card_magic_items_page()
{
    global $wpdb;
    $table_templates = $wpdb->prefix . 'gcm_templates';

    // Process bulk action
    if (isset($_POST['action']) && $_POST['action'] === 'delete' && isset($_POST['template'])) {
        $template_ids = $_POST['template'];

        // Perform the necessary actions for the selected templates
        foreach ($template_ids as $template_id) {
            // Implement the logic to delete or perform other actions on the template
            // For example: $wpdb->delete($table_templates, array('id' => $template_id));
        }

        // Redirect back to the template list page
        wp_redirect(admin_url('admin.php?page=gift-card-items'));
        exit();
    }

    // Retrieve data from the 'gcm_templates' table
    $templates = $wpdb->get_results("SELECT * FROM $table_templates");

    $total_templates = count($templates);
    $templates_per_page = 10;
    $current_page = isset($_GET['paged']) ? max(1, intval($_GET['paged'])) : 1;
    $offset = ($current_page - 1) * $templates_per_page;
    $paged_templates = array_slice($templates, $offset, $templates_per_page);

?>
    <div class="wrap" id="gcm_gift_card_items">
        <h1>Gift Card Templates <a href="<?php echo admin_url('admin.php?page=new-gift-card-template'); ?>" class="page-title-action">Add New</a></h1>

        <form method="post" action="">
            <div class="tablenav">
                <div class="alignleft actions">
                    <label for="bulk-action-selector-top" class="screen-reader-text">Select bulk action</label>
                    <select name="action" id="bulk-action-selector-top">
                        <option value="-1">Bulk Actions</option>
                        <option value="delete">Delete</option>
                        <!-- Add more bulk actions if needed -->
                    </select>
                    <input type="submit" id="doaction" class="button action" value="Apply">
                </div>
            </div>

            <table class="wp-list-table widefat fixed striped">
                <thead>
                    <tr>
                        <th scope="col" class="manage-column column-cb check-column">
                            <input type="checkbox">
                        </th>
                        <th>ID</th>
                        <th>Template Name</th>
                        <th>Template Content</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($paged_templates as $template) : ?>
                        <tr>
                            <th scope="row" class="check-column">
                                <input type="checkbox" name="template[]" value="<?php echo $template->id; ?>">
                            </th>
                            <td><?php echo $template->id; ?></td>
                            <td class="gcm_actions">
                                <?php echo $template->template_name; ?>
                                <span class="gcm_edit gcm_hidden">
                                    <a href="<?php echo admin_url('admin.php?page=edit-gift-card-template&id=' . $template->id); ?>">
                                        Edit
                                    </a>
                                </span>
                                <span class="gcm_line gcm_hidden">|</span>
                                <span class="gcm_delete gcm_hidden">
                                    <a href="#" class="delete-template" data-template-id="<?php echo $template->id; ?>">
                                        Delete
                                    </a>
                                </span>
                            </td>
                            <td><?php echo $template->template_content; ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>

            <?php
            $total_pages = ceil($total_templates / $templates_per_page);
            if ($total_pages > 1) {
                $page_links = paginate_links(array(
                    'base' => add_query_arg('paged', '%#%'),
                    'format' => '',
                    'prev_text' => '&laquo;',
                    'next_text' => '&raquo;',
                    'total' => $total_pages,
                    'current' => $current_page,
                    'show_all' => false,
                    'end_size' => 1,
                    'mid_size' => 2
                ));
                if ($page_links) {
            ?>
                    <div class="tablenav">
                        <div class="tablenav-pages">
                            <span class="displaying-num"><?php echo sprintf(_n('%s item', '%s items', $total_templates), $total_templates); ?></span>
                            <?php echo $page_links; ?>
                        </div>
                    </div>
            <?php
                }
            }
            ?>
        </form>
    </div>
    <script>
        jQuery(function($) {
            $('#doaction').on('click', function(e) {
                e.preventDefault();
                var action = $('#bulk-action-selector-top').val();
                if (action === 'delete') {
                    var selectedIds = $('input[name="template[]"]:checked').map(function() {
                        return this.value;
                    }).get();
                    if (selectedIds.length > 0 && confirm('Are you sure you want to delete the selected templates?')) {
                        $.ajax({
                            url: '<?php echo admin_url('admin-ajax.php'); ?>',
                            type: 'POST',
                            data: {
                                action: 'delete_templates',
                                template_ids: selectedIds
                            },
                            success: function(response) {
                                if (response.success) {
                                    location.reload();
                                } else {
                                    alert('An error occurred. Please try again.');
                                }
                            },
                            error: function() {
                                alert('An error occurred. Please try again.');
                            }
                        });
                    }
                }
            });
            jQuery(function($) {
                $('.delete-template').on('click', function(e) {
                    e.preventDefault();
                    var templateId = $(this).data('template-id');
                    if (confirm('Are you sure you want to delete this template?')) {
                        $.ajax({
                            url: '<?php echo admin_url('admin-ajax.php'); ?>',
                            type: 'POST',
                            data: {
                                action: 'delete_template',
                                template_id: templateId
                            },
                            success: function(response) {
                                if (response.success) {
                                    location.reload();
                                } else {
                                    alert('An error occurred. Please try again.');
                                }
                            },
                            error: function() {
                                alert('An error occurred. Please try again.');
                            }
                        });
                    }
                });
            });
        });
    </script>

    <?php
}



// Callback function to display the "Add New" page
function gift_card_magic_add_new_template_page()
{
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $template_name = $_POST['template-name'];
        $template_content = $_POST['template-content'];

        // Upload and save the image file
        if (isset($_FILES['template-image']) && !empty($_FILES['template-image']['name'])) {
            $image_id = gift_card_magic_upload_template_image($_FILES['template-image']);
            if ($image_id) {
                // Insert the template data into the 'gcm_templates' table
                global $wpdb;
                $table_templates = $wpdb->prefix . 'gcm_templates';
                $wpdb->insert($table_templates, array(
                    'template_name' => $template_name,
                    'template_content' => $template_content,
                    'template_image' => $image_id
                ));

                // Display success message
                echo '<div class="notice notice-success is-dismissible"><p>Template added successfully.</p></div>';

                // Get the ID of the newly inserted template
                $template_id = $wpdb->insert_id;
                ob_start();
    ?>
                <script>
                    // Redirect to the edit page of the newly created template using JavaScript
                    window.location.href = "<?php echo admin_url('admin.php?page=gift-card-items&id=' . $template_id); ?>";
                </script>
            <?php
                ob_end_flush();
                return; // Stop further execution of the page
            } else {
                // Display error message if image upload failed
                echo '<div class="notice notice-error is-dismissible"><p>Failed to upload the template image. Please try again.</p></div>';
            }
        } else {
            // Insert the template data into the 'gcm_templates' table without image
            global $wpdb;
            $table_templates = $wpdb->prefix . 'gcm_templates';
            $wpdb->insert($table_templates, array(
                'template_name' => $template_name,
                'template_content' => $template_content
            ));

            // Display success message
            echo '<div class="notice notice-success is-dismissible"><p>Template added successfully.</p></div>';

            // Get the ID of the newly inserted template
            $template_id = $wpdb->insert_id;
            ob_start();
            ?>
            <script>
                // Redirect to the edit page of the newly created template using JavaScript
                window.location.href = "<?php echo admin_url('admin.php?page=gift-card-items&id=' . $template_id); ?>";
            </script>
    <?php
            ob_end_flush();
            return; // Stop further execution of the page
        }
    }
    ?>
    <div class="wrap">
        <h1 class="wp-heading-inline">Add New Gift Card Template</h1>

        <div class="template-form-wrapper">
            <form id="add-new-template-form" method="post" action="" enctype="multipart/form-data">
                <div class="postbox">
                    <h2 class="hndle"><span>Template Details</span></h2>
                    <div class="inside">
                        <div class="postbox-content">
                            <div class="editor-post-title">
                                <label class="screen-reader-text" for="template-name">Template Name</label>
                                <input type="text" name="template-name" id="template-name" placeholder="Enter template name" required>
                            </div>
                            <div class="editor-post-content">
                                <label class="screen-reader-text" for="template-content">Template Content</label>
                                <?php wp_editor('', 'template-content', array('textarea_name' => 'template-content', 'media_buttons' => false)); ?>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="postbox">
                    <h2 class="hndle"><span>Template Image</span></h2>
                    <div class="inside">
                        <div class="postbox-content">
                            <label for="template-image">Upload Template Image:</label>
                            <input type="file" name="template-image" id="template-image">
                            <div id="image-preview-container"></div>
                            <p class="image-format-info">Supported image formats: JPEG, JPG, PNG, and WebP</p>
                        </div>
                    </div>
                </div>

                <div class="submit-container">
                    <button type="submit" class="button button-primary button-large">Save Template</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        // Function to preview the uploaded image
        function previewImage(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    var previewContainer = document.getElementById('image-preview-container');
                    previewContainer.innerHTML = '<img src="' + e.target.result + '" alt="Uploaded Image">';
                }
                reader.readAsDataURL(input.files[0]);
            }
        }

        // Attach event listener to the file input element
        var templateImageInput = document.getElementById('template-image');
        templateImageInput.addEventListener('change', function() {
            previewImage(this);
        });
    </script>
    <?php
}




// Function to handle template image upload and return the attachment ID
function gift_card_magic_upload_template_image($file)
{
    $upload_dir = wp_upload_dir();
    $target_dir = $upload_dir['path'] . '/';
    $target_file = $target_dir . basename($file['name']);
    $image_type = wp_check_filetype($target_file);

    // Check if file format is allowed
    $allowed_formats = array('image/jpeg', 'image/jpg', 'image/png', 'image/webp');
    if (!in_array($image_type['type'], $allowed_formats)) {
        return false;
    }

    // Generate unique file name
    $timestamp = time();
    $unique_file_name = $timestamp . '_' . wp_unique_filename($target_dir, $file['name']);

    $uploaded = move_uploaded_file($file['tmp_name'], $target_dir . $unique_file_name);
    if ($uploaded) {
        $attachment = array(
            'guid' => $upload_dir['url'] . '/' . $unique_file_name,
            'post_mime_type' => $image_type['type'],
            'post_title' => preg_replace('/\.[^.]+$/', '', $file['name']),
            'post_content' => '',
            'post_status' => 'inherit'
        );
        $attach_id = wp_insert_attachment($attachment, $target_dir . $unique_file_name);
        return $attach_id;
    }
    return false;
}



function gift_card_magic_edit_template_page()
{
    global $wpdb;
    $table_templates = $wpdb->prefix . 'gcm_templates';

    if (isset($_GET['id'])) {
        $template_id = $_GET['id'];

        // Truy vấn thông tin của template từ bảng gcm_templates dựa trên $template_id
        $template = $wpdb->get_row($wpdb->prepare("SELECT * FROM $table_templates WHERE id = %d", $template_id));

        if ($template) {
            // Xử lý cập nhật template khi người dùng nhấn nút "Update Template"
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $template_name = isset($_POST['template-name']) ? $_POST['template-name'] : '';
                $template_content = isset($_POST['template-content']) ? $_POST['template-content'] : '';

                // Cập nhật dữ liệu template trong bảng gcm_templates
                $wpdb->update($table_templates, array(
                    'template_name' => $template_name,
                    'template_content' => $template_content
                ), array('id' => $template_id));

                // Xử lý cập nhật ảnh template nếu người dùng chọn ảnh mới
                if (isset($_FILES['template-image']) && !empty($_FILES['template-image']['name'])) {
                    $image_id = gift_card_magic_upload_template_image($_FILES['template-image']);
                    if ($image_id) {
                        $wpdb->update($table_templates, array('template_image' => $image_id), array('id' => $template_id));
                        $template->template_image = $image_id;
                    }
                }

                // Xử lý xóa ảnh template nếu người dùng nhấn nút đóng
                if (isset($_POST['close-image-preview'])) {
                    $wpdb->update($table_templates, array('template_image' => null), array('id' => $template_id));
                    $template->template_image = null;
                }

                // Hiển thị thông báo cập nhật thành công
                echo '<div class="notice notice-success is-dismissible"><p>Template updated successfully.</p></div>';
                
                // Làm mới dữ liệu template để hiển thị ảnh mới hoặc không có ảnh
                $template = $wpdb->get_row($wpdb->prepare("SELECT * FROM $table_templates WHERE id = %d", $template_id));
            }

            // Hiển thị form chỉnh sửa template với dữ liệu hiện có
            ?>
            <div class="wrap">
                <h1>Edit Gift Card Template</h1>
                <a href="<?php echo admin_url('admin.php?page=new-gift-card-template'); ?>" class="page-title-action">Add New</a>
                <form id="edit-template-form" method="post" action="" enctype="multipart/form-data">
                    <div class="postbox">
                        <h2 class="hndle"><span>Template Details</span></h2>
                        <div class="inside">
                            <div class="postbox-content">
                                <div class="editor-post-title">
                                    <label class="screen-reader-text" for="template-name">Template Name</label>
                                    <input type="text" name="template-name" id="template-name" placeholder="Enter template name" value="<?php echo esc_attr($template->template_name); ?>" required>
                                </div>
                                <div class="editor-post-content">
                                    <label class="screen-reader-text" for="template-content">Template Content</label>
                                    <?php wp_editor(esc_textarea($template->template_content), 'template-content', array('textarea_name' => 'template-content', 'media_buttons' => false)); ?>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="postbox">
                        <h2 class="hndle"><span>Template Image</span></h2>
                        <div class="inside">
                            <div class="postbox-content">
                                <label for="template-image">Upload Template Image:</label>
                                <input type="file" name="template-image" id="template-image">
                                <div id="image-preview-container" style="position: relative;">
                                    <?php if ($template->template_image) : ?>
                                        <img src="<?php echo esc_url(wp_get_attachment_url($template->template_image)); ?>" alt="Template Image" style="max-width: 100%;">
                                        <button type="submit" name="close-image-preview" style="position: absolute; top: 10px; right: 10px; background: none; border: none; cursor: pointer;"><span class="dashicons dashicons-dismiss"></span></button>
                                    <?php endif; ?>
                                </div>
                                <p class="image-format-info">Supported image formats: JPEG, JPG, PNG, and WebP</p>
                            </div>
                        </div>
                    </div>

                    <div class="submit-container">
                        <button type="submit" class="button button-primary button-large">Update Template</button>
                    </div>
                </form>
            </div>

            <script>
                // Function to preview the uploaded image
                function previewImage(input) {
                    if (input.files && input.files[0]) {
                        var reader = new FileReader();
                        reader.onload = function(e) {
                            var previewContainer = document.getElementById('image-preview-container');
                            previewContainer.innerHTML = '<img src="' + e.target.result + '" alt="Template Image" style="max-width: 100%;">' +
                                '<button type="submit" name="close-image-preview" style="position: absolute; top: 10px; right: 10px; background: none; border: none; cursor: pointer;"><span class="dashicons dashicons-dismiss"></span></button>';
                        }
                        reader.readAsDataURL(input.files[0]);
                    }
                }

                // Attach event listener to the file input element
                var templateImageInput = document.getElementById('template-image');
                templateImageInput.addEventListener('change', function() {
                    previewImage(this);
                });
            </script>
<?php
        } else {
            // Hiển thị thông báo nếu không tìm thấy template
            echo 'Template not found.';
        }
    } else {
        // Hiển thị thông báo nếu không có tham số id
        echo 'Template ID is missing.';
    }
}



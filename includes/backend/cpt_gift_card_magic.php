<?php

// Register Custom Post Type
function gift_card_magic_custom_post_type()
{

    $labels = array(
        'name'                  => _x('Gift Card Magic', 'Post Type General Name', 'gift-card-magic'),
        'singular_name'         => _x('Gift Card Magic', 'Post Type Singular Name', 'gift-card-magic'),
        'menu_name'             => __('Gift Card Magic', 'gift-card-magic'),
        'name_admin_bar'        => __('Gift Card Magic', 'gift-card-magic'),
        'archives'              => __('Gift Card Magic Archives', 'gift-card-magic'),
        'attributes'            => __('Gift Card Magic Attributes', 'gift-card-magic'),
        'parent_item_colon'     => __('Parent Gift Card Magic:', 'gift-card-magic'),
        'all_items'             => __('All Gift Cards Magic', 'gift-card-magic'),
        'add_new_item'          => __('Add New Gift Card Magic', 'gift-card-magic'),
        'add_new'               => __('Add New', 'gift-card-magic'),
        'new_item'              => __('New Gift Card Magic', 'gift-card-magic'),
        'edit_item'             => __('Edit Gift Card Magic', 'gift-card-magic'),
        'update_item'           => __('Update Gift Card Magic', 'gift-card-magic'),
        'view_item'             => __('View Gift Card Magic', 'gift-card-magic'),
        'view_items'            => __('View Gift Cards Magic', 'gift-card-magic'),
        'search_items'          => __('Search Gift Card Magic', 'gift-card-magic'),
        'not_found'             => __('Not found', 'gift-card-magic'),
        'not_found_in_trash'    => __('Not found in Trash', 'gift-card-magic'),
        'featured_image'        => __('Background Gift Card Magic', 'gift-card-magic'),
        'set_featured_image'    => __('Set background Gift Card Magic', 'gift-card-magic'),
        'remove_featured_image' => __('Remove background Gift Card Magic', 'gift-card-magic'),
        'use_featured_image'    => __('Use as background Gift Card Magic', 'gift-card-magic'),
        'insert_into_item'      => __('Insert into Gift Card Magic', 'gift-card-magic'),
        'uploaded_to_this_item' => __('Uploaded to this Gift Card Magic', 'gift-card-magic'),
        'items_list'            => __('Gift Cards Magic list', 'gift-card-magic'),
        'items_list_navigation' => __('Gift Cards Magic list navigation', 'gift-card-magic'),
        'filter_items_list'     => __('Filter Gift Cards Magic list', 'gift-card-magic'),
    );
    $args = array(
        'label'                 => __('Gift Card Magic', 'gift-card-magic'),
        'description'           => __('Custom post type for Gift Card Magic', 'gift-card-magic'),
        'labels'                => $labels,
        'supports'              => array('title', 'editor', 'thumbnail'),
        'taxonomies'            => array('category', 'post_tag'),
        'hierarchical'          => true,
        'public'                => true,
        'show_ui'               => true,
        'show_in_menu'          => true,
        'menu_position'         => 5,
        'show_in_admin_bar'     => true,
        'show_in_nav_menus'     => true,
        'can_export'            => true,
        'has_archive'           => true,
        'exclude_from_search'   => true,
        'publicly_queryable'    => true,
        'capability_type'       => 'post',
    );
    register_post_type('gift_card_magic', $args);

    // Register custom taxonomy
    $taxonomy_labels = array(
        'name'              => _x('Categories', 'taxonomy general name', 'gift-card-magic'),
        'singular_name'     => _x('Category', 'taxonomy singular name', 'gift-card-magic'),
        'search_items'      => __('Search Categories', 'gift-card-magic'),
        'all_items'         => __('All Categories', 'gift-card-magic'),
        'parent_item'       => __('Parent Category', 'gift-card-magic'),
        'parent_item_colon' => __('Parent Category:', 'gift-card-magic'),
        'edit_item'         => __('Edit Category', 'gift-card-magic'),
        'update_item'       => __('Update Category', 'gift-card-magic'),
        'add_new_item'      => __('Add New Category', 'gift-card-magic'),
        'new_item_name'     => __('New Category Name', 'gift-card-magic'),
        'menu_name'         => __('Categories', 'gift-card-magic'),
    );

    $taxonomy_args = array(
        'hierarchical'      => true,
        'labels'            => $taxonomy_labels,
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => array('slug' => 'gift_card_category'), // Set taxonomy slug
    );

    register_taxonomy('gift_card_category', array('gift_card_magic'), $taxonomy_args);
}
add_action('init', 'gift_card_magic_custom_post_type', 0);


// Callback function to display the content of the custom field
function gift_card_magic_custom_field_callback()
{
    $fields = array(
        array(
            'label' => 'Price:',
            'name'  => 'gcmagic_price',
            'type'  => 'number',
            'min'   => 0,
            'max'   => 100000,
        ),
        array(
            'label' => 'Special Price:',
            'name'  => 'gcmagic_special_price',
            'type'  => 'number',
            'min'   => 0,
            'max'   => 100000,
        ),
        array(
            'label' => 'Description:',
            'name'  => 'gcmagic_description',
            'type'  => 'text',
        ),
    );

    foreach ($fields as $field) {
        $value = get_post_meta(get_the_ID(), $field['name'], true);
?>
        <div class="wrap-gift-card-details">
            <label for="<?php echo $field['name']; ?>"><?php echo $field['label']; ?></label>
            <input type="<?php echo $field['type']; ?>" id="<?php echo $field['name']; ?>" name="<?php echo $field['name']; ?>" value="<?php echo esc_attr($value); ?>" <?php if ($field['type'] === 'number') echo 'min="' . $field['min'] . '" max="' . $field['max'] . '"'; ?>>
        </div>
<?php
    }
}

// Function to register custom field
function gift_card_magic_add_custom_meta_box()
{
    add_meta_box(
        'gcmagic_price',
        'Gift Card Magic Details',
        'gift_card_magic_custom_field_callback',
        'gift_card_magic',
        'normal',
        'high'
    );
}
add_action('add_meta_boxes', 'gift_card_magic_add_custom_meta_box');

function gift_card_magic_save_custom_meta_box($post_id)
{

    // Kiểm tra tính xác thực của dữ liệu
    if (!isset($_POST['_wpnonce'])) {
        return;
    }

    // Kiểm tra quyền truy cập trước khi lưu dữ liệu
    if (!current_user_can('edit_post', $post_id)) {
        return;
    }

    $fields = array('gcmagic_price', 'gcmagic_special_price', 'gcmagic_description');

    foreach ($fields as $field) {
        if (isset($_POST[$field])) {
            $value = sanitize_text_field($_POST[$field]);
            update_post_meta($post_id, $field, $value);
        } else {
            delete_post_meta($post_id, $field);
        }
    }
}
add_action('save_post', 'gift_card_magic_save_custom_meta_box');


// Move Background Gift Card to advanced-sortables
function move_background_gift_card_to_advanced_sortables()
{
    global $post_type, $wp_meta_boxes;

    // Check if we are on the post-new.php?post_type=gift_card_magic screen
    if ('gift_card_magic' === $post_type && isset($wp_meta_boxes['gift_card_magic']['normal']['high']['gcmagic_price'])) {
        $background_gift_card_box = $wp_meta_boxes['gift_card_magic']['normal']['high']['gcmagic_price'];
        unset($wp_meta_boxes['gift_card_magic']['normal']['high']['gcmagic_price']);
        $wp_meta_boxes['gift_card_magic']['advanced']['high']['gcmagic_price'] = $background_gift_card_box;
    }
}
add_action('do_meta_boxes', 'move_background_gift_card_to_advanced_sortables');


// Customizing columns in the taxonomy interface
function custom_manage_taxonomy_columns($columns) {
    // Add the 'ID' column after 'cb' and before 'name'
    $new_columns = array(
        'cb' => '<input type="checkbox" />',
        'id' => '<label class="taxonomyid-column">ID</label>',
        'name' => 'Name',
        'description' => 'Description',
        'slug' => 'Slug',
        'count' => 'Count',
    );

    return $new_columns;
}
add_filter('manage_edit-gift_card_category_columns', 'custom_manage_taxonomy_columns');

// Custom function to display content in the custom column for taxonomy
function custom_manage_taxonomy_custom_column($content, $column_name, $term_id) {
    if ($column_name === 'id') {
        // Display the term ID in the 'ID' column
        return $term_id;
    }
    return $content;
}
add_action('manage_gift_card_category_custom_column', 'custom_manage_taxonomy_custom_column', 10, 3);

// Customizing columns in the post interface
function custom_manage_posts_columns($columns) {
    $columns = array(
        'cb' => '<input type="checkbox" />',
        'idpost' => '<label class="postid-column">ID</label>',
        'title' => 'Title',
        'categories' => 'Categories',
        'tag' => 'Tags',
        'categories_2' => 'Categories',
        'date' => 'Date',

    );
    unset($columns['categories']);
    unset($columns['tag']);
    return $columns;
}
add_filter('manage_gift_card_magic_posts_columns', 'custom_manage_posts_columns');

// Custom function to display content in the custom column
function custom_manage_posts_custom_column($column, $post_id)
{
    if ($column === 'idpost') {
        // Display the post ID in the 'idpost' column
        echo $post_id;
    }
    if ($column === 'categories_2') {
        // Display the categories from the "gift_card_category" taxonomy
        $categories = get_the_terms($post_id, 'gift_card_category');
        
        if (is_array($categories) && !empty($categories)) {
            $category_links = array();
            foreach ($categories as $category) {
                $term_link = add_query_arg(
                    array(
                        'taxonomy' => 'gift_card_category',
                        'tag_ID' => $category->term_id,
                        'post_type' => 'post',
                        'wp_http_referer' => urlencode(wp_unslash($_SERVER['REQUEST_URI'])),
                    ),
                    admin_url('term.php')
                );

                $category_links[] = '<a href="' . esc_url($term_link) . '">' . $category->name . '</a>';
            }
            echo implode(', ', $category_links);
        } else {
            echo '_';
        }
    }
}
add_action('manage_gift_card_magic_posts_custom_column', 'custom_manage_posts_custom_column', 10, 2);





<?php

function giftcardmagic_shortcode($atts)
{
    $atts = shortcode_atts(array(
        'style' => 'default', // Giá trị mặc định của tham số style
    ), $atts);

    ob_start();
    if ($atts['style'] === 'list') {
        // Mã HTML cho style "list"
    } elseif ($atts['style'] === 'slide') {
        // Mã HTML cho style "slide"
        echo '<div class="container">';
        echo '<form id="contact" action="#">';
        echo '<div>';
        echo '<h3>Step1</h3>';
        echo '<section class="step1">';
        echo '<div class="slide-tep-1">';
        $gift_cards = new WP_Query(array(
            'post_type' => 'gift_card_magic',
            'posts_per_page' => -1, // Lấy tất cả bài viết
        ));

        if ($gift_cards->have_posts()) {
            while ($gift_cards->have_posts()) {
                $gift_cards->the_post();
                $image_url = get_the_post_thumbnail_url(get_the_ID(), 'thumbnail');
                if (empty($image_url)) {
                    // Đường dẫn ảnh demo từ plugin
                    $demo_image_url = plugins_url('gift-card-magic/assets/images/background-demo-2.jpg');
                    echo '<label>';
                    echo '<input type="radio" name="gift_card" value="' . get_the_ID() . '" class="required">';
                    echo '<img src="' . $demo_image_url . '" alt="' . get_the_title() . '">';
                    echo '</label>';
                } else {
                    echo '<label>';
                    echo '<input type="radio" name="gift_card" value="' . get_the_ID() . '" class="required">';
                    echo '<img src="' . $image_url . '" alt="' . get_the_title() . '">';
                    echo '</label>';
                }
            }
            wp_reset_postdata();
        } else {
            echo 'No gift cards found.';
        }
        echo '</div>';
        echo '</section>';
        echo '<h3>Step3</h3>';
        echo '<section class="step2">';
        echo '<h1>Step2</h1>';
        echo '<label for="name">First name *</label>';
        echo '<input id="name" name="name" type="text" class="required">';
        echo '<label for="surname">Last name *</label>';
        echo '<input id="surname" name="surname" type="text" class="required">';
        echo '<label for="email">Email *</label>';
        echo '<input id="email" name="email" type="text" class="required email">';
        echo '<label for="address">Address</label>';
        echo '<input id="address" name="address" type="text">';
        echo '<p>(*) Mandatory</p>';
        echo '</section>';
        echo '<h3>Step3</h3>';
        echo '<section class="step3">';
        echo '<h1>Step3</h1>';
        echo '<ul>';
        echo '<li>Foo</li>';
        echo '<li>Bar</li>';
        echo '<li>Foobar</li>';
        echo '</ul>';
        echo '</section>';
        echo '<h3>Step4</h3>';
        echo '<section>';
        echo '<h1>Step4</h1>';
        echo '<input id="acceptTerms" name="acceptTerms" type="checkbox" class="required"> <label for="acceptTerms">I agree with the Terms and Conditions.</label>';
        echo '</section>';
        echo '</div>';
        echo '</form>';
        echo '</div>';
    } else {
        // Mã HTML mặc định
    }
    return ob_get_clean();
}
add_shortcode('giftcardmagic', 'giftcardmagic_shortcode');

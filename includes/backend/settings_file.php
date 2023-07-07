<?php

// Add action for gift_card_magic_settings_tab
function gift_card_magic_settings_tab_action() {
    ?>
    <h3>Settings Content minh</h3>
    <p>Here you can configure the settings for your gift card plugin.</p>
    <?php
}
add_action('gift_card_magic_settings_tab', 'gift_card_magic_settings_tab_action');

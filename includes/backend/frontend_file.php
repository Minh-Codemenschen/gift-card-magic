<?php

// Add action for gift_card_magic_frontend_tab
function gift_card_magic_frontend_tab_action() {
    ?>
    <h3>Frontend Content</h3>
    <p>Here you can customize the frontend appearance and behavior of the gift card plugin.</p>
    <?php
}
add_action('gift_card_magic_frontend_tab', 'gift_card_magic_frontend_tab_action');

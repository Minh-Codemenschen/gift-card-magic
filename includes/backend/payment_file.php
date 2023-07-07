<?php

// Add action for gift_card_magic_payment_tab
function gift_card_magic_payment_tab_action() {
    ?>
    <h3>Payment Content</h3>
    <p>Here you can set up the payment options for your gift card plugin.</p>
    <?php
}
add_action('gift_card_magic_payment_tab', 'gift_card_magic_payment_tab_action');

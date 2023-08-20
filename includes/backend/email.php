<?php

// Add action for gift_card_magic_frontend_tab
function gift_card_magic_email_tab_action() {
    global $wpdb;
    $table_settings_email = $wpdb->prefix . 'gcm_settings_email'; 
    $sql_select_settings_email = "SELECT * FROM $table_settings_email";
    $results_email = $wpdb->get_results($sql_select_settings_email);
    if ($results_email) {
        $result_email = $results_email[0];
        $sender_name = $result_email->sender_name;
        $sender_email = $result_email->sender_email;
        $send_customer_receipt = $result_email->send_customer_receipt;
        $buyer_email_subject = $result_email->buyer_email_subject;
        $buyer_email_body = $result_email->buyer_email_body;
    }
    ?>
    <div class="box-giftcardMagic">
        <div class="top-giftcardMagic">
            <h2><?php _e('Email Setting','gift-card-magic'); ?></h2>
            <p><?php _e('Here you can configure the email for your gift card plugin.','gift-card-magic'); ?></p>
        </div>
    </div>
    <div class="box-giftcardMagic">
        <div class="inner-box-giftcardMagic">
            <div class="group-setting-giftcardMagic">
                <label class="text-label"><?php _e('Sender Name','gift-card-magic'); ?><br>
                <span><?php _e('For emails send by this plugin.','gift-card-magic'); ?></span></label>
                <div class="wrap-field">
                    <input type="text" class="field-giftcardMagic" name="gcm_email[sender_name]" value="<?php echo $sender_name; ?>" required>
                </div>
            </div>
            <div class="group-setting-giftcardMagic">
                <label class="text-label"><?php _e('Sender Email','gift-card-magic'); ?><br>
                <span><?php _e('For emails send by this plugin.','gift-card-magic'); ?></span></label>
                <div class="wrap-field">
                    <input type="email" class="field-giftcardMagic" name="gcm_email[sender_email]" value="<?php echo $sender_email; ?>" required>
                </div>
            </div>
            <div class="group-setting-giftcardMagic">
                <label class="text-label"><?php _e('Send Customer Receipt','gift-card-magic'); ?></label>
                <div class="wrap-select-giftcardMagic wrap-field">
                    <select class="select-setting-giftcardMagic field-giftcardMagic" name="gcm_email[send_customer_receipt]">
                        <option value="1" <?php echo $send_customer_receipt == "1" ? 'selected' : ''; ?>><?php _e('Enable','gift-card-magic'); ?></option>
                        <option value="0" <?php echo $send_customer_receipt == "0" ? 'selected' : ''; ?>><?php _e('Disable','gift-card-magic'); ?></option>
                    </select>
                </div>
            </div>
            <div class="group-setting-giftcardMagic">
                <label class="text-label"><?php _e('Buyer Email Subject','gift-card-magic'); ?><br>
                <span><?php _e('Subject for emails send to customers.','gift-card-magic'); ?></span></label>
                <div class="wrap-field">
                    <?php
                        $editor_subject = 'buyer_email_subject';                
                        wp_editor($buyer_email_subject, $editor_subject, array(
                            'media_buttons' => false,
                            'textarea_name' => 'gcm_email[buyer_email_subject]',
                            'editor_height' => 300,
                        ));
                     ?>
                     <p>{company_name} {website_url} {sender_email} {sender_name} {order_number} {order_type} {amount}
                         {customer_name} {recipient_name} {customer_email} {coupon_code} {pdf_link} {payment_method} {payment_status} {receipt_link}</p>
                </div>
            </div>
            <div class="group-setting-giftcardMagic">
                <label class="text-label"><?php _e('Buyer Email Body','gift-card-magic'); ?><br>
                <span><?php _e('Body message for emails send to customers.','gift-card-magic'); ?></span></label>
                <div class="wrap-field">
                    <?php
                        $editor_body = 'buyer_email_body';                
                        wp_editor($buyer_email_body, $editor_body, array(
                            'media_buttons' => false,
                            'textarea_name' => 'gcm_email[buyer_email_body]',
                            'editor_height' => 300,
                        ));
                     ?>
                     <p>{company_name} {website_url} {sender_email} {sender_name} {order_number} {order_type} {amount} {customer_name} {recipient_name} 
                        {customer_email} {coupon_code} {pdf_link} {payment_method} {payment_status} {receipt_link}</p>
                </div>
            </div>
        </div>
    </div>

    <?php
}
add_action('gift_card_magic_email_tab', 'gift_card_magic_email_tab_action');

<?php

// Add action for gift_card_magic_frontend_tab
function gift_card_magic_email_tab_action() {
    $sender_name = '';
    $sender_email = '';
    $send_customer_receipt = 1;
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
                    <input type="number" class="field-giftcardMagic" name="gcm_email[sender_name]" value="<?php echo $sender_name; ?>" required>
                </div>
            </div>
            <div class="group-setting-giftcardMagic">
                <label class="text-label"><?php _e('Sender Email','gift-card-magic'); ?><br>
                <span><?php _e('For emails send by this plugin.','gift-card-magic'); ?></span></label>
                <div class="wrap-field">
                    <input type="number" class="field-giftcardMagic" name="gcm_email[sender_email]" value="<?php echo $sender_email; ?>" required>
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
                <textarea id="custom_editor" name="custom_editor"></textarea>
                </div>
            </div>
            <div class="group-setting-giftcardMagic">
                <label class="text-label"><?php _e('Buyer Email Body','gift-card-magic'); ?><br>
                <span><?php _e('Body message for emails send to customers.','gift-card-magic'); ?></span></label>
                <div class="wrap-field">
                    <textarea class="custom_editor" name="gcm_email[buyer_email_body]"></textarea>
                </div>
            </div>
        </div>
    </div>

    <?php
}
add_action('gift_card_magic_email_tab', 'gift_card_magic_email_tab_action');

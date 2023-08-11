<?php

// Add action for gift_card_magic_settings_tab
function gift_card_magic_settings_tab_action() {
    global $wpdb;
    $table_settings = $wpdb->prefix . 'gcm_settings'; 
    $sql_select_settings = "SELECT * FROM $table_settings";
    $results = $wpdb->get_results($sql_select_settings);
    if ($results) {
        $result = $results[0];
        $minimum_voucher_value = $result->minimum_voucher_value;
        $maximum_voucher_value = $result->maximum_voucher_value;
        $voucher_expiry_value = $result->voucher_expiry_value;
        $expiry_date_format = $result->expiry_date_format;
        $hide_voucher_first_step = $result->hide_voucher_first_step;
        $hide_price_from_voucher = $result->hide_price_from_voucher;
        $voucher_preview_button = $result->voucher_preview_button;
        $custom_loader_url = $result->custom_loader_url;
    } 
    ?>
    <div class="box-giftcardMagic">
        <div class="top-giftcardMagic">
            <h2><?php _e('Settings','gift-card-magic'); ?></h2>
            <p><?php _e('Here you can configure the settings for your gift card plugin.','gift-card-magic'); ?></p>
        </div>
    </div>
    <div class="box-giftcardMagic">
        <div class="inner-box-giftcardMagic">
            <div class="group-setting-giftcardMagic">
                <label class="text-label"><?php _e('Minimum Voucher Value','gift-card-magic'); ?><br>
                <span><?php _e('Leave 0 if no minimum value','gift-card-magic'); ?></span></label>
                <div class="wrap-field">
                    <input type="number" class="field-giftcardMagic" name="gcm_settings[minimum_voucher_value]" value="<?php echo $minimum_voucher_value; ?>" required>
                </div>
            </div>
            <div class="group-setting-giftcardMagic">
                <label class="text-label"><?php _e('Maximum Voucher Value','gift-card-magic'); ?></label>
                <div class="wrap-field">
                    <input type="number" class="field-giftcardMagic" name="gcm_settings[maximum_voucher_value]" value="<?php echo $maximum_voucher_value; ?>" required>
                </div>
            </div>
            <div class="group-setting-giftcardMagic">
                <label class="text-label"><?php _e('Expiry date format','gift-card-magic'); ?></label>
                <div class="wrap-field">
                    <input type="text" class="field-giftcardMagic" name="gcm_settings[expiry_date_format]" value="<?php echo $expiry_date_format; ?>" required>
                </div>
            </div>
            <div class="group-setting-giftcardMagic">
                <label class="text-label"><?php _e('Voucher Expiry Value','gift-card-magic'); ?><br>
                <span><?php _e('Example: (Days: 60, Fixed Date: 21.02.2021)','gift-card-magic'); ?></span></label>
                <div class="wrap-field">
                    <input type="number" class="field-giftcardMagic" name="gcm_settings[voucher_expiry_value]" value="<?php echo $voucher_expiry_value; ?>">
                </div>
            </div>
            <div class="group-setting-giftcardMagic">
                <label class="text-label"><?php _e('Hide voucher First step','gift-card-magic'); ?><br>
                <span><?php _e('This will hide the first "Select Template" step','gift-card-magic'); ?></span></label>
                <div class="wrap-field">
                    <select class="select-setting-giftcardMagic field-giftcardMagic" name="gcm_settings[hide_voucher_first_step]">
                        <option value="0" <?php echo $hide_voucher_first_step == 0 ? 'selected' : ''; ?>>No</option>
                        <option value="1" <?php echo $hide_voucher_first_step == 1 ? 'selected' : ''; ?>>Yes</option>
                    </select>
                </div>
            </div>
            <div class="group-setting-giftcardMagic">
                <label class="text-label"><?php _e('Hide Price from voucher','gift-card-magic'); ?></label>
                <div class="wrap-field">
                    <select class="select-setting-giftcardMagic field-giftcardMagic" name="gcm_settings[hide_price_from_voucher]">
                        <option value="0" <?php echo $hide_price_from_voucher == 0 ? 'selected' : ''; ?>>No</option>
                        <option value="1" <?php echo $hide_price_from_voucher == 1 ? 'selected' : ''; ?>>Yes</option>
                    </select>
                </div>
            </div>
            <div class="group-setting-giftcardMagic">
                <label class="text-label"><?php _e('Voucher preview Button','gift-card-magic'); ?></label>
                <div class="wrap-field">
                    <select class="select-setting-giftcardMagic field-giftcardMagic" name="gcm_settings[voucher_preview_button]">
                        <option value="0" <?php echo $voucher_preview_button == 0 ? 'selected' : ''; ?>>Disable</option>
                        <option value="1" <?php echo $voucher_preview_button == 1 ? 'selected' : ''; ?>>Enable</option>
                    </select>
                </div>
            </div>
            <div class="group-setting-giftcardMagic">
                <label class="text-label"><?php _e('Add your custom loader url','gift-card-magic'); ?></label>
                <div class="wrap-field">
                    <input type="text" class="field-giftcardMagic" name="gcm_settings[custom_loader_url]" value="<?php echo $custom_loader_url; ?>" max="250">
                </div>
            </div>
        </div>
    </div>
    <?php 
}
add_action('gift_card_magic_settings_tab', 'gift_card_magic_settings_tab_action');

<?php

// Add action for gift_card_magic_settings_tab
function gift_card_magic_settings_tab_action() {
    global $wpdb;
    $table_settings = $wpdb->prefix . 'gcm_settings'; 
    $sql_select_settings = "SELECT * FROM $table_settings";
    $results = $wpdb->get_results($sql_select_settings);
    $minimum_voucher_value = 0;
    $maximum_voucher_value = 0;
    $voucher_expiry_value = 0;
    $expiry_date_format = 0;
    $hide_voucher_first_step = 0;
    $hide_price_from_voucher = 0;
    $voucher_preview_button = 0;
    if ($results) {
        $result = $results[0];
        $id = $result->id;
        $minimum_voucher_value = $result->minimum_voucher_value;
        $maximum_voucher_value = $result->maximum_voucher_value;
        $voucher_expiry_value = $result->voucher_expiry_value;
        $expiry_date_format = $result->expiry_date_format;
        $hide_voucher_first_step = $result->hide_voucher_first_step;
        $hide_price_from_voucher = $result->hide_price_from_voucher;
        $voucher_preview_button = $result->voucher_preview_button;
    } else {
        echo "No results found.";
    }

    ?>
    <div class="box-giftcardMagic">
        <div class="top-giftcardMagic">
            <h2>Settings</h2>
            <p>Here you can configure the settings for your gift card plugin.</p>
        </div>
    </div>
    <div class="box-giftcardMagic">
        <div class="inner-box-giftcardMagic">
            <div class="group-setting-giftcardMagic">
                <label class="text-label">Minimum Voucher Value<br>
                <span>Leave 0 if no minimum value</span></label>
                <div class="wrap-field">
                    <input type="number" class="field-giftcardMagic" name="minimum_voucher_value" value="<?php echo $minimum_voucher_value; ?>" required>
                </div>
            </div>
            <div class="group-setting-giftcardMagic">
                <label class="text-label">Maximum Voucher Value</label>
                <div class="wrap-field">
                    <input type="number" class="field-giftcardMagic" name="maximum_voucher_value" value="<?php echo $maximum_voucher_value; ?>" required>
                </div>
            </div>
            <div class="group-setting-giftcardMagic">
                <label class="text-label">Expiry date format</label>
                <div class="wrap-field">
                    <input type="text" class="field-giftcardMagic" name="expiry_date_format" value="<?php echo $expiry_date_format; ?>" required>
                </div>
            </div>
            <div class="group-setting-giftcardMagic">
                <label class="text-label">Voucher Expiry Value<br>
                <span>Example: (Days: 60, Fixed Date: 21.02.2021)</span></label>
                <div class="wrap-field">
                    <input type="number" class="field-giftcardMagic" name="voucher_expiry_value" value="<?php echo $voucher_expiry_value; ?>">
                </div>
            </div>
            <div class="group-setting-giftcardMagic">
                <label class="text-label">Hide voucher First step<br>
                <span>This will hide the first "Select Template" step</span></label>
                <div class="wrap-field">
                    <select class="select-setting-giftcardMagic field-giftcardMagic" name="hide_voucher_first_step">
                        <option value="0">No</option>
                        <option value="1">Yes</option>
                    </select>
                </div>
            </div>
            <div class="group-setting-giftcardMagic">
                <label class="text-label">Hide Price from voucher</label>
                <div class="wrap-field">
                    <select class="select-setting-giftcardMagic field-giftcardMagic" name="hide_price_from_voucher">
                        <option value="0">No</option>
                        <option value="1">Yes</option>
                    </select>
                </div>
            </div>
            <div class="group-setting-giftcardMagic">
                <label class="text-label">Voucher preview Button</label>
                <div class="wrap-field">
                    <select class="select-setting-giftcardMagic field-giftcardMagic" name="voucher_preview_button">
                        <option value="0">Disable</option>
                        <option value="1">Enable</option>
                    </select>
                </div>
            </div>
            <div class="group-setting-giftcardMagic">
                <label class="text-label">Add your custom loader url</label>
                <div class="wrap-field">
                    <input type="text" class="field-giftcardMagic" name="custom_loader_url" value="">
                </div>
            </div>
        </div>
    </div>
    <?php 
}
add_action('gift_card_magic_settings_tab', 'gift_card_magic_settings_tab_action');

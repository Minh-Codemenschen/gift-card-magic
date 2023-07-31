<?php

// Add action for gift_card_magic_settings_tab
function gift_card_magic_settings_tab_action() {
    ?>
    <div class="box-giftcardMagic">
        <div class="top-giftcardMagic">
            <h2>Settings</h2>
            <p>Here you can configure the settings for your gift card plugin.</p>
        </div>
        <div class="inner-box-giftcardMagic">
            <div class="group-setting-giftcardMagic">
                <label class="text-label">Minimum Voucher Value<br>
                <span>Leave 0 if no minimum value</span></label>
                <div class="wrap-field">
                    <input type="number" class="field-giftcardMagic" name="minimum_voucher_value" value="0">
                </div>
            </div>
            <div class="group-setting-giftcardMagic">
                <label class="text-label">Maximum Voucher Value</label>
                <div class="wrap-field">
                    <input type="number" class="field-giftcardMagic" name="maximum_voucher_value" value="100">
                </div>
            </div>
            <div class="group-setting-giftcardMagic">
                <label class="text-label">Voucher Expiry Value<br>
                <span>Example: (Days: 60, Fixed Date: 21.02.2021)</span></label>
                <div class="wrap-field">
                    <input type="number" class="field-giftcardMagic" name="voucher_expiry_value" value="60">
                </div>
            </div>
            <div class="group-setting-giftcardMagic">
                <label class="text-label">Expiry date format</label>
                <div class="wrap-field">
                    <input type="text" class="field-giftcardMagic" name="expiry_date_format" value="d.m.Y">
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
        </div>
    </div>
    <?php 
}
add_action('gift_card_magic_settings_tab', 'gift_card_magic_settings_tab_action');

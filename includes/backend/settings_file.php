<?php

// Add action for gift_card_magic_settings_tab
function gift_card_magic_settings_tab_action() {
    ?>
    <div class="box-giftcardMagic">
        <h3>Settings</h3>
        <p>Here you can configure the settings for your gift card plugin.</p>
        <div class="table-setting-giftcardMagic">
            <div class="wrap-item-giftcardMagic">
                <div class="image-giftcardMagic">
                    <img src="<?php echo plugins_url( 'gift-card-magic/assets/images/demo.png'); ?>">
                    <button id="edit-images-giftcardMagic" class="btn-setting-giftcardMagic"><span class="dashicons dashicons-admin-generic"></span></button>
                </div>
                <div class="content-giftcardMagic">
                    <button id="edit-input-giftcardMagic" class="btn-setting-giftcardMagic"><span class="dashicons dashicons-admin-generic"></span></button>
                    <div class="group-giftcardMagic">
                        <label>Your Name </label>
                        <input type="text" value="" class="input-giftcardMagic" name="your_name">
                    </div>
                    <div class="group-giftcardMagic">
                        <label>Recipient Name</label>
                        <input type="text" name="from_name" class="input-giftcardMagic">
                    </div>
                    <div class="group-giftcardMagic full-width-giftcardMagic">
                        <label>Voucher Value</label>
                        <div class="wrap-input-giftcardMagic">
                            <span class="currencySymbol"> $ </span>
                            <input type="text" name="voucher_value" class="input-giftcardMagic">
                        </div>
                    </div>
                    <div class="group-giftcardMagic full-width-giftcardMagic">
                        <label>Personal Message</label>
                        <textarea name="message" class="input-giftcardMagic"></textarea>
                    </div>
                    <div class="group-giftcardMagic">
                        <label>Date of Expiry</label>
                        <input type="text" name="expiryCard" class="input-giftcardMagic" value="16.09.2023">
                    </div>
                    <div class="group-giftcardMagic">
                        <label>Coupon Code</label>
                        <input type="text" name="coupon_code" class="input-giftcardMagic" value="6234256841004311">
                    </div>
                    <div class="info-giftcardMagic">
                        <a href="https://www.codemenschen.at">https://www.codemenschen.at</a> | <a href="mailto:gdpr@codemenschen.at">gdpr@codemenschen.at</a>
                    </div>
                    <div class="terms-giftcardMagic">* Cash payment is not possible. The terms and conditions apply.</div>
                </div>
            </div>
        </div>

    </div>
    <?php 
}
add_action('gift_card_magic_settings_tab', 'gift_card_magic_settings_tab_action');

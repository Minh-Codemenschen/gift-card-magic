<?php

// Add action for gift_card_magic_settings_tab
function gift_card_magic_settings_tab_action() {
    ?>
    <div class="box-giftcardMagic">
        <div class="top-giftcardMagic">
            <h3>Settings</h3>
            <p>Here you can configure the settings for your gift card plugin.</p>
        </div>
        <div class="inner-box-giftcardMagic">
            <div class="table-setting-giftcardMagic">
                <div class="wrap-item-giftcardMagic" style="background-color:#fff">
                    <div class="image-giftcardMagic">
                        <img src="<?php echo plugins_url( 'gift-card-magic/assets/images/demo.jpg'); ?>">
                    </div>
                    <div class="content-giftcardMagic">
                        <div class="group-giftcardMagic">
                            <label style="color:#000;">Your Name </label>
                            <input type="text" value="" class="input-giftcardMagic" name="your_name">
                        </div>
                        <div class="group-giftcardMagic">
                            <label style="color:#000;">Recipient Name</label>
                            <input type="text" name="from_name" class="input-giftcardMagic">
                        </div>
                        <div class="group-giftcardMagic full-width-giftcardMagic">
                            <label style="color:#000;">Voucher Value</label>
                            <div class="wrap-input-giftcardMagic">
                                <span class="currencySymbol"> $ </span>
                                <input type="text" name="voucher_value" class="input-giftcardMagic">
                            </div>
                        </div>
                        <div class="group-giftcardMagic full-width-giftcardMagic">
                            <label style="color:#000;">Personal Message</label>
                            <textarea name="message" class="input-giftcardMagic"></textarea>
                        </div>
                        <div class="group-giftcardMagic">
                            <label style="color:#000;">Date of Expiry</label>
                            <input type="text" name="expiryCard" class="input-giftcardMagic" value="16.09.2023">
                        </div>
                        <div class="group-giftcardMagic">
                            <label style="color:#000;">Coupon Code</label>
                            <input type="text" name="coupon_code" class="input-giftcardMagic" value="6234256841004311">
                        </div>
                        <div class="info-giftcardMagic">
                            <a href="company@gmail.com">company@gmail.com</a> | <a href="mailto:example.com">example.com</a>
                        </div>
                        <div class="terms-giftcardMagic">Terms and conditions apply..</div>
                    </div>
                </div>
            </div>
            <div class="setting-field">
                <h3>Display Field</h3>
                <div class="group-setting-giftcardMagic">
                    <div class="group-setting-giftcardMagic">
                        <label class="text-label">Your Name</label>
                        <label class="toggle-giftcardMagic ">
                            <input type="checkbox" class="toogle-slider-giftcardMagic" name="show_name" checked> 
                            <span class="toggle-slider-giftcardMagic"></span>
                        </label>
                    </div>
                    <div class="group-setting-giftcardMagic">
                        <label class="text-label">Recipient Name</label>
                        <label class="toggle-giftcardMagic">
                            <input type="checkbox" class="toogle-slider-giftcardMagic" name="show_recipient_name" checked>
                            <span class="toggle-slider-giftcardMagic"></span>
                        </label>
                    </div>
                    <div class="group-setting-giftcardMagic">
                        <label class="text-label">Voucher Value</label>
                        <label class="toggle-giftcardMagic ">
                            <input type="checkbox" class="toogle-slider-giftcardMagic" name="show_voucher_value" checked>
                            <span class="toggle-slider-giftcardMagic"></span>
                        </label>
                    </div>
                    <div class="group-setting-giftcardMagic">
                        <label class="text-label">Personal Message</label>
                        <label class="toggle-giftcardMagic ">
                            <input type="checkbox" class="toogle-slider-giftcardMagic" name="show_personal_message" checked>
                            <span class="toggle-slider-giftcardMagic"></span>
                        </label>
                    </div>
                </div>
                <h3>Style</h3>
                <div class="group-setting-giftcardMagic">
                    <label class="text-label">Background Color</label>
                    <input type="color" name="background_color" value="#ffffff">
                </div>
                <div class="group-setting-giftcardMagic">
                    <label class="text-label">Text Color</label>
                    <input type="color" name="text_color" value="#000000">
                </div>                
                <h3>Information</h3>
                <div class="group-setting-giftcardMagic">
                    <label class="text-label">Terms Content</label>
                    <input type="text" class="field-giftcardMagic" name="terms" value="Terms and conditions apply." maxlength="200">
                </div>
                <div class="group-setting-giftcardMagic">
                    <label class="text-label">Email company</label>
                    <input type="text" class="field-giftcardMagic" name="email_company" value="company@gmail.com">
                </div>
                <div class="group-setting-giftcardMagic">
                    <label class="text-label">Link company</label>
                    <input type="text" class="field-giftcardMagic" name="link_company" value="example.com">
                </div>
            </div>

        </div>
    </div>
    <?php 
}
add_action('gift_card_magic_settings_tab', 'gift_card_magic_settings_tab_action');

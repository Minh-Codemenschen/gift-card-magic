<?php
// Define the shortcode function
function gift_itemMagic_shortcode_function($atts, $content = null) {
    $html = '<div class="wrap-item-giftcardMagic" style="background:url(http://localhost/giftcard-product/wp-content/plugins/gift-card-magic/assets/images/background-demo-2.jpg) no-repeat;">
        <div class="image-giftcardMagic">
        </div>
        <div class="content-giftcardMagic">
            <div style="color:#000000" class="group-giftcardMagic">
                <label>Your Name </label>
                <input type="text" value="" class="input-giftcardMagic" name="your_name">
            </div>
            <div style="color:#000000" class="group-giftcardMagic">
                <label>Recipient Name</label>
                <input type="text" name="from_name" class="input-giftcardMagic">
            </div>
            <div style="color:#000000" class="group-giftcardMagic full-width-giftcardMagic">
                <label>Voucher Value</label>
                <div class="wrap-input-giftcardMagic">
                    <span class="currencySymbol"> $ </span>
                    <input type="text" name="voucher_value" class="input-giftcardMagic">
                </div>
            </div>
            <div style="color:#000000" class="group-giftcardMagic full-width-giftcardMagic">
                <label>Personal Message</label>
                <textarea name="message" class="input-giftcardMagic"></textarea>
            </div>
            <div style="color:#000000" class="group-giftcardMagic">
                <label>Date of Expiry</label>
                <input type="text" name="expiryCard" class="input-giftcardMagic" value="16.09.2023">
            </div>
            <div style="color:#000000" class="group-giftcardMagic">
                <label>Coupon Code</label>
                <input type="text" name="coupon_code" class="input-giftcardMagic" value="6234256841004311">
            </div>
            <div class="info-giftcardMagic">
                <a href="company@gmail.com">
                company@gmail.com</a> | <a href="mailto:example.com">example.com</a>
            </div>
            <div class="terms-giftcardMagic">Terms and conditions apply.</div>
        </div>
    </div>';
    return '<div id="item-giftcardMagic">' . $html . '</div>';
}
add_shortcode('gift_itemMagic', 'gift_itemMagic_shortcode_function');

 ?>
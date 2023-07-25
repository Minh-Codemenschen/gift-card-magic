<?php

// Add action for gift_card_magic_payment_tab
function gift_card_magic_payment_tab_action() {
    ?>
    <div class="box-giftcardMagic">
        <h3>Payment Content</h3>
        <p>Here you can set up the payment options for your gift card plugin.</p>
    </div>
    <div class="box-giftcardMagic">
        <h4>Payment config</h4>
        <div class="group-setting-giftcardMagic">
            <label class="text-label">PayPal Standar</label>
            <label class="toggle-giftcardMagic ">
                <input type="checkbox" class="toogle-slider-giftcardMagic" name="paypal_standar"> 
                <span class="toggle-slider-giftcardMagic"></span> Safe and secure payments handle by PayPal
            </label>
        </div>
        <div class="group-setting-giftcardMagic">
            <label class="text-label">Stripe</label>
            <label class="toggle-giftcardMagic">
                <input type="checkbox" class="toogle-slider-giftcardMagic" name="stripe"> 
                <span class="toggle-slider-giftcardMagic"></span> Connet your existing Stripe Account or create a new one to start accepting payments.
            </label>
        </div>
    </div>
    <div class="box-giftcardMagic" id="config-payment">
        <h4>Curreny config</h4>
        <div class="group-setting-giftcardMagic">
            <label class="text-label">Currency</label>
            <div class="wrap-select-giftcardMagic wrap-field">
                <select class="select-setting-giftcardMagic field-giftcardMagic" name="currency">
                    <option value="usd">US Dollar (USD)</option>
                    <option value="euro">Euro</option>
                </select>
            </div>
            <div class="caption-giftcardMagic">Select your currency. Please note that some payment gateways can have currency restrictions</div>
        </div>
        <div class="group-setting-giftcardMagic">
            <label class="text-label">Currency Position</label>
            <div class="wrap-select-giftcardMagic wrap-field" name="currency_position">
                <select class="select-setting-giftcardMagic field-giftcardMagic">
                    <option value="before">Before</option>
                    <option value="after">After</option>
                </select>
            </div>
            <div class="caption-giftcardMagic">Select whether the currency symbol should appear before the price or after the price</div>
        </div>
        <div class="group-setting-giftcardMagic">
            <label class="text-label">Price Display Format</label>
            <div class="wrap-select-giftcardMagic wrap-field">
                <select class="select-setting-giftcardMagic field-giftcardMagic" name="price_display_format">
                    <option value="">$100</option>
                </select>
            </div>
            <div class="caption-giftcardMagic">Select how to price displayed</div>
        </div>
    </div>
    <?php
}
add_action('gift_card_magic_payment_tab', 'gift_card_magic_payment_tab_action');

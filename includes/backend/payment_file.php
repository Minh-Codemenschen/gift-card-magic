<?php

// Add action for gift_card_magic_payment_tab
function gift_card_magic_payment_tab_action() {
    ?>
    <div class="box-giftcardMagic">
        <h3>Payment Content</h3>
        <p>Here you can set up the payment options for your gift card plugin.</p>
    </div>
    <div class="box-giftcardMagic">
        <h4>Curreny config</h4>
        <div class="group-setting-giftcardMagic">
            <label class="text-label">Currency</label>
            <div class="wrap-select-giftcardMagic wrap-field">
                <select class="select-setting-giftcardMagic field-giftcardMagic" name="currency">
                    <option value="usd">US Dollar (USD)</option>
                    <option value="euro">Euro</option>
                </select>
                <div class="caption-giftcardMagic">Select your currency. Please note that some payment gateways can have currency restrictions</div>
            </div>
        </div>
        <div class="group-setting-giftcardMagic">
            <label class="text-label">Currency Position</label>
            <div class="wrap-select-giftcardMagic wrap-field" name="currency_position">
                <select class="select-setting-giftcardMagic field-giftcardMagic">
                    <option value="before">Before</option>
                    <option value="after">After</option>
                </select>
                <div class="caption-giftcardMagic">Select whether the currency symbol should appear before the price or after the price</div>
            </div>
        </div>
        <div class="group-setting-giftcardMagic">
            <label class="text-label">Price Display Format</label>
            <div class="wrap-select-giftcardMagic wrap-field">
                <select class="select-setting-giftcardMagic field-giftcardMagic" name="price_display_format">
                    <option value="">$100</option>
                </select>
                <div class="caption-giftcardMagic">Select how to price displayed</div>
            </div>
        </div>    
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
    <div class="box-giftcardMagic hide" id="paypal_standar">
        <h4>Paypal config</h4>
        <div class="group-setting-giftcardMagic">
            <label class="text-label">Paypal Testmode</label>
            <label class="toggle-giftcardMagic">
                <input type="checkbox" class="toogle-slider-giftcardMagic" name="test_mode"> 
                <span class="toggle-slider-giftcardMagic"></span>
            </label>
        </div>
        <div class="group-setting-giftcardMagic">
            <label class="text-label">PayPal Client ID<br>
            <span>Read the documentation of how to create PayPal live client ID.</span><br>
            <a href="https://www.wp-giftcard.com/docs/documentation/plugin-settings/payment-settings/" target="_blank">Click Here</a>
            </label>
            <div class="wrap-field">
                <input type="text" class="field-giftcardMagic" name="paypal_client_id" value="">
            </div>
        </div>       
        <div class="group-setting-giftcardMagic">
            <label class="text-label">PayPal Secret Key	</label>
            <div class="wrap-field">
                <input type="text" class="field-giftcardMagic" name="payPal_secret_key" value="">
            </div>
        </div>
    </div>
    <div class="box-giftcardMagic hide" id="stripe">
        <h4>Stripe config</h4>          
        <div class="group-setting-giftcardMagic">
            <label class="text-label">Stripe Publishable key<br>
            <span>Collect the Publishable API key from below link.</span><br>
            <a href="https://dashboard.stripe.com/account/apikeys" target="_blank">Click Here</a>
            </label>
            <div class="wrap-field">
                <input type="text" class="field-giftcardMagic" name="stripe_publishable_key" value="">
            </div>
        </div> 
        <div class="group-setting-giftcardMagic">
            <label class="text-label">Stripe Secret Key<br>
            <span>Collect the Secret API key from below link.</span><br>
            <a href="https://dashboard.stripe.com/account/apikeys" target="_blank">Click Here</a>
            </label>
            <div class="wrap-field">
                <input type="text" class="field-giftcardMagic" name="stripe_secret_key" value="">
            </div>
        </div>   
        <div class="group-setting-giftcardMagic">
            <label class="text-label">Stripe Webhook URL</label>
            <div class="wrap-field">
                <input type="text" class="field-giftcardMagic" name="stripe_webhook_url" value="">
            </div>
        </div>
        <div class="group-setting-giftcardMagic">
            <label class="text-label">Stripe Webhook Signing secret key<br>
            <span>Collect the Webhook Signing secret key from below link.</span><br>
            <a href="https://dashboard.stripe.com/account/webhooks" target="_blank">Click Here</a>
            </label>
            <div class="wrap-field">
                <input type="text" class="field-giftcardMagic" name="stripe_webhook_secret_key" value="">
            </div>
        </div>   
    </div>
    <?php
}
add_action('gift_card_magic_payment_tab', 'gift_card_magic_payment_tab_action');

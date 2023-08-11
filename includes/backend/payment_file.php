<?php

// Add action for gift_card_magic_payment_tab
function gift_card_magic_payment_tab_action() {
    global $wpdb;
    $table_payments = $wpdb->prefix . 'gcm_settings_payment'; 
    $sql_select_payments = "SELECT * FROM $table_payments";
    $results_payment = $wpdb->get_results($sql_select_payments);
    if ($results_payment) {
        $result_payment = $results_payment[0];
        $currency = $result_payment->currency;
        $currency_position = $result_payment->currency_position;
        $paypal_standar = $result_payment->paypal_standar;
        $stripe = $result_payment->stripe;
        $price_display_format = $result_payment->price_display_format;
        $test_mode = $result_payment->test_mode;
        $paypal_client_id = $result_payment->paypal_client_id;
        $payPal_secret_key = $result_payment->payPal_secret_key;
        $stripe_publishable_key = $result_payment->stripe_publishable_key;
        $stripe_secret_key = $result_payment->stripe_secret_key;
        $stripe_webhook_url = $result_payment->stripe_webhook_url;
        $stripe_webhook_secret_key = $result_payment->stripe_webhook_secret_key;
    } ?>
    <div class="box-giftcardMagic">
        <h2>Payment Content</h2>
        <p>Here you can set up the payment options for your gift card plugin.</p>
    </div>
    <div class="box-giftcardMagic">
        <h4>Curreny config</h4>
        <div class="group-setting-giftcardMagic">
            <label class="text-label">Currency</label>
            <div class="wrap-select-giftcardMagic wrap-field">
                <select class="select-setting-giftcardMagic field-giftcardMagic" name="gcm_settings_payment[currency]">
                    <option value="$" <?php echo $currency == "$" ? 'selected' : ''; ?>>US Dollar (USD)</option>
                    <option value="€" <?php echo $currency == "€" ? 'selected' : ''; ?>>Euro</option>
                </select>
                <div class="caption-giftcardMagic">Select your currency. Please note that some payment gateways can have currency restrictions</div>
            </div>
        </div>
        <div class="group-setting-giftcardMagic">
            <label class="text-label">Currency Position</label>
            <div class="wrap-select-giftcardMagic wrap-field">
                <select class="select-setting-giftcardMagic field-giftcardMagic" name="gcm_settings_payment[currency_position]">
                    <option value="0" <?php echo $currency_position == "0" ? 'selected' : ''; ?>>Before</option>
                    <option value="1" <?php echo $currency_position == "1" ? 'selected' : ''; ?>>After</option>
                </select>
                <div class="caption-giftcardMagic">Select whether the currency symbol should appear before the price or after the price</div>
            </div>
        </div>
        <div class="group-setting-giftcardMagic">
            <label class="text-label">Price Display Format</label>
            <div class="wrap-select-giftcardMagic wrap-field">
                <select class="select-setting-giftcardMagic field-giftcardMagic" name="gcm_settings_payment[price_display_format]">
                    <option value="0" <?php echo $price_display_format == "0" ? 'selected' : ''; ?>><?php echo $currency; ?>100</option>
                    <option value="1" <?php echo $price_display_format == "1" ? 'selected' : ''; ?>><?php echo $currency; ?> 100</option>
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
                <input type="checkbox" class="toogle-slider-giftcardMagic" name="gcm_settings_payment[paypal_standar]" <?php echo $paypal_standar == 1 ? 'checked' : ''; ?>> 
                <span class="toggle-slider-giftcardMagic"></span> Safe and secure payments handle by PayPal
            </label>
        </div>
        <div class="group-setting-giftcardMagic">
            <label class="text-label">Stripe</label>
            <label class="toggle-giftcardMagic">
                <input type="checkbox" class="toogle-slider-giftcardMagic" name="gcm_settings_payment[stripe]" <?php echo $stripe == 1 ? 'checked' : ''; ?>> 
                <span class="toggle-slider-giftcardMagic"></span> Connet your existing Stripe Account or create a new one to start accepting payments.
            </label>
        </div>
    </div>
    <div class="box-giftcardMagic hide" id="paypal_standar">
        <h4>Paypal config</h4>
        <div class="group-setting-giftcardMagic">
            <label class="text-label">Paypal Testmode</label>
            <label class="toggle-giftcardMagic">
                <input type="checkbox" class="toogle-slider-giftcardMagic" name="gcm_settings_payment[test_mode]" <?php echo $test_mode == 1 ? 'checked' : ''; ?>> 
                <span class="toggle-slider-giftcardMagic"></span>
            </label>
        </div>
        <div class="group-setting-giftcardMagic">
            <label class="text-label">PayPal Client ID<br>
            <span>Read the documentation of how to create PayPal live client ID.</span><br>
            <a href="https://www.wp-giftcard.com/docs/documentation/plugin-settings/payment-settings/" target="_blank">Click Here</a>
            </label>
            <div class="wrap-field">
                <input type="text" class="field-giftcardMagic" name="gcm_settings_payment[paypal_client_id]" value="<?php echo $paypal_client_id; ?>">
            </div>
        </div>       
        <div class="group-setting-giftcardMagic">
            <label class="text-label">PayPal Secret Key	</label>
            <div class="wrap-field">
                <input type="text" class="field-giftcardMagic" name="gcm_settings_payment[payPal_secret_key]" value="<?php echo $payPal_secret_key; ?>">
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
                <input type="text" class="field-giftcardMagic" name="gcm_settings_payment[stripe_publishable_key]" value="<?php echo $payPal_secret_key; ?>">
            </div>
        </div> 
        <div class="group-setting-giftcardMagic">
            <label class="text-label">Stripe Secret Key<br>
            <span>Collect the Secret API key from below link.</span><br>
            <a href="https://dashboard.stripe.com/account/apikeys" target="_blank">Click Here</a>
            </label>
            <div class="wrap-field">
                <input type="text" class="field-giftcardMagic" name="gcm_settings_payment[stripe_secret_key]" value="<?php echo $stripe_secret_key; ?>">
            </div>
        </div>   
        <div class="group-setting-giftcardMagic">
            <label class="text-label">Stripe Webhook URL</label>
            <div class="wrap-field">
                <input type="text" class="field-giftcardMagic" name="gcm_settings_payment[stripe_webhook_url]" value="<?php echo $stripe_webhook_url; ?>">
            </div>
        </div>
        <div class="group-setting-giftcardMagic">
            <label class="text-label">Stripe Webhook Signing secret key<br>
            <span>Collect the Webhook Signing secret key from below link.</span><br>
            <a href="https://dashboard.stripe.com/account/webhooks" target="_blank">Click Here</a>
            </label>
            <div class="wrap-field">
                <input type="text" class="field-giftcardMagic" name="gcm_settings_payment[stripe_webhook_secret_key]" value="<?php echo $stripe_webhook_secret_key; ?>">
            </div>
        </div>   
    </div>
    <?php
}
add_action('gift_card_magic_payment_tab', 'gift_card_magic_payment_tab_action');

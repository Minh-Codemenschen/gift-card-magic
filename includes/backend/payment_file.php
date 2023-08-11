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
        <h2><?php _e('Payment Content','gift-card-magic'); ?></h2>
        <p><?php _e('Here you can set up the payment options for your gift card plugin.','gift-card-magic'); ?></p>
    </div>
    <div class="box-giftcardMagic">
        <h4><?php _e('Curreny config','gift-card-magic'); ?></h4>
        <div class="group-setting-giftcardMagic">
            <label class="text-label"><?php _e('Currency','gift-card-magic'); ?></label>
            <div class="wrap-select-giftcardMagic wrap-field">
                <select class="select-setting-giftcardMagic field-giftcardMagic" name="gcm_settings_payment[currency]">
                    <option value="$" <?php echo $currency == "$" ? 'selected' : ''; ?>><?php _e('US Dollar (USD)','gift-card-magic'); ?></option>
                    <option value="€" <?php echo $currency == "€" ? 'selected' : ''; ?>><?php _e('Euro','gift-card-magic'); ?></option>
                </select>
                <div class="caption-giftcardMagic"><?php _e('Select your currency. Please note that some payment gateways can have currency restrictions','gift-card-magic'); ?></div>
            </div>
        </div>
        <div class="group-setting-giftcardMagic">
            <label class="text-label"><?php _e('Currency Position','gift-card-magic'); ?></label>
            <div class="wrap-select-giftcardMagic wrap-field">
                <select class="select-setting-giftcardMagic field-giftcardMagic" name="gcm_settings_payment[currency_position]">
                    <option value="0" <?php echo $currency_position == "0" ? 'selected' : ''; ?>><?php _e('Before','gift-card-magic'); ?></option>
                    <option value="1" <?php echo $currency_position == "1" ? 'selected' : ''; ?>><?php _e('After','gift-card-magic'); ?></option>
                </select>
                <div class="caption-giftcardMagic"><?php _e('Select whether the currency symbol should appear before the price or after the price','gift-card-magic'); ?></div>
            </div>
        </div>
        <div class="group-setting-giftcardMagic">
            <label class="text-label"><?php _e('Price Display Format','gift-card-magic'); ?></label>
            <div class="wrap-select-giftcardMagic wrap-field">
                <select class="select-setting-giftcardMagic field-giftcardMagic" name="gcm_settings_payment[price_display_format]">
                    <option value="0" <?php echo $price_display_format == "0" ? 'selected' : ''; ?>><?php echo $currency; ?>100</option>
                    <option value="1" <?php echo $price_display_format == "1" ? 'selected' : ''; ?>><?php echo $currency; ?> 100</option>
                </select>
                <div class="caption-giftcardMagic"><?php _e('Select how to price displayed','gift-card-magic'); ?></div>
            </div>
        </div>    
    </div>
    <div class="box-giftcardMagic">
        <h4><?php _e('Payment config','gift-card-magic'); ?></h4>
        <div class="group-setting-giftcardMagic">
            <label class="text-label"><?php _e('PayPal Standar','gift-card-magic'); ?></label>
            <label class="toggle-giftcardMagic ">
                <input type="checkbox" class="toogle-slider-giftcardMagic" name="gcm_settings_payment[paypal_standar]" <?php echo $paypal_standar == 1 ? 'checked' : ''; ?>> 
                <span class="toggle-slider-giftcardMagic"></span> <?php _e('Safe and secure payments handle by PayPal','gift-card-magic'); ?>
            </label>
        </div>
        <div class="group-setting-giftcardMagic">
            <label class="text-label"><?php _e('Stripe','gift-card-magic'); ?></label>
            <label class="toggle-giftcardMagic">
                <input type="checkbox" class="toogle-slider-giftcardMagic" name="gcm_settings_payment[stripe]" <?php echo $stripe == 1 ? 'checked' : ''; ?>> 
                <span class="toggle-slider-giftcardMagic"></span> <?php _e('Connet your existing Stripe Account or create a new one to start accepting payments.','gift-card-magic'); ?>
            </label>
        </div>
    </div>
    <div class="box-giftcardMagic hide" id="paypal_standar">
        <h4><?php _e('Paypal config','gift-card-magic'); ?></h4>
        <div class="group-setting-giftcardMagic">
            <label class="text-label"><?php _e('Paypal Testmode','gift-card-magic'); ?></label>
            <label class="toggle-giftcardMagic">
                <input type="checkbox" class="toogle-slider-giftcardMagic" name="gcm_settings_payment[test_mode]" <?php echo $test_mode == 1 ? 'checked' : ''; ?>> 
                <span class="toggle-slider-giftcardMagic"></span>
            </label>
        </div>
        <div class="group-setting-giftcardMagic">
            <label class="text-label"><?php _e('PayPal Client ID','gift-card-magic'); ?><br>
            <span><?php _e('Read the documentation of how to create PayPal live client ID.','gift-card-magic'); ?></span><br>
            <a href="https://www.wp-giftcard.com/docs/documentation/plugin-settings/payment-settings/" target="_blank"><?php _e('Click Here','gift-card-magic'); ?></a>
            </label>
            <div class="wrap-field">
                <input type="text" class="field-giftcardMagic" name="gcm_settings_payment[paypal_client_id]" value="<?php echo $paypal_client_id; ?>">
            </div>
        </div>       
        <div class="group-setting-giftcardMagic">
            <label class="text-label"><?php _e('PayPal Secret Key','gift-card-magic'); ?></label>
            <div class="wrap-field">
                <input type="text" class="field-giftcardMagic" name="gcm_settings_payment[payPal_secret_key]" value="<?php echo $payPal_secret_key; ?>">
            </div>
        </div>
    </div>
    <div class="box-giftcardMagic hide" id="stripe">
        <h4><?php _e('Stripe config','gift-card-magic'); ?></h4>          
        <div class="group-setting-giftcardMagic">
            <label class="text-label"><?php _e('Stripe Publishable key','gift-card-magic'); ?><br>
            <span><?php _e('Collect the Publishable API key from below link.','gift-card-magic'); ?></span><br>
            <a href="https://dashboard.stripe.com/account/apikeys" target="_blank"><?php _e('Click Here','gift-card-magic'); ?></a>
            </label>
            <div class="wrap-field">
                <input type="text" class="field-giftcardMagic" name="gcm_settings_payment[stripe_publishable_key]" value="<?php echo $payPal_secret_key; ?>">
            </div>
        </div> 
        <div class="group-setting-giftcardMagic">
            <label class="text-label"><?php _e('Stripe Secret Key','gift-card-magic'); ?><br>
            <span><?php _e('Collect the Secret API key from below link.','gift-card-magic'); ?></span><br>
            <a href="https://dashboard.stripe.com/account/apikeys" target="_blank"><?php _e('Click Here','gift-card-magic'); ?></a>
            </label>
            <div class="wrap-field">
                <input type="text" class="field-giftcardMagic" name="gcm_settings_payment[stripe_secret_key]" value="<?php echo $stripe_secret_key; ?>">
            </div>
        </div>   
        <div class="group-setting-giftcardMagic">
            <label class="text-label"><?php _e('Stripe Webhook URL','gift-card-magic'); ?></label>
            <div class="wrap-field">
                <input type="text" class="field-giftcardMagic" name="gcm_settings_payment[stripe_webhook_url]" value="<?php echo $stripe_webhook_url; ?>">
            </div>
        </div>
        <div class="group-setting-giftcardMagic">
            <label class="text-label"><?php _e('Stripe Webhook Signing secret key','gift-card-magic'); ?><br>
            <span><?php _e('Collect the Webhook Signing secret key from below link.','gift-card-magic'); ?></span><br>
            <a href="https://dashboard.stripe.com/account/webhooks" target="_blank"><?php _e('Click Here','gift-card-magic'); ?></a>
            </label>
            <div class="wrap-field">
                <input type="text" class="field-giftcardMagic" name="gcm_settings_payment[stripe_webhook_secret_key]" value="<?php echo $stripe_webhook_secret_key; ?>">
            </div>
        </div>   
    </div>
    <?php
}
add_action('gift_card_magic_payment_tab', 'gift_card_magic_payment_tab_action');

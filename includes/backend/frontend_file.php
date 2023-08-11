<?php

// Add action for gift_card_magic_frontend_tab
function gift_card_magic_frontend_tab_action() { 
    global $wpdb;
    $table_settings_frontend = $wpdb->prefix . 'gcm_settings_frontend'; 
    $sql_select_settings_frontend = "SELECT * FROM $table_settings_frontend";
    $results_fr = $wpdb->get_results($sql_select_settings_frontend);
    if ($results_fr) {
        $result_fr = $results_fr[0];
        $show_name = $result_fr->show_name;
        $show_recipient_name = $result_fr->show_recipient_name;
        $show_personal_message = $result_fr->show_personal_message;
        $show_voucher_value = $result_fr->show_voucher_value;
        $background_color = $result_fr->background_color;
        $text_color = $result_fr->text_color;
        $terms = $result_fr->terms;
        $email_company = $result_fr->email_company;
        $link_company = $result_fr->link_company;
        $company_logo = $result_fr->company_logo;
        $company_name = $result_fr->company_name;
    } ?>
    <div class="box-giftcardMagic">
        <div class="top-giftcardMagic">
            <h2>Frontend Content</h2>
            <p>Here you can customize the frontend appearance and behavior of the gift card plugin.</p>
        </div>
    </div>
    <div class="box-giftcardMagic">
        <div class="inner-box-giftcardMagic">
            <div class="table-setting-giftcardMagic">
                <div class="wrap-item-giftcardMagic" style="background:url(<?php echo plugins_url( 'gift-card-magic/assets/images/background-demo-2.jpg'); ?>) no-repeat;">
                    <div class="image-giftcardMagic">
                    </div>
                    <div class="content-giftcardMagic">
                        <div style="color:<?php echo $text_color; ?>" <?php echo $show_name == 1 ? '' : 'style="display:none;"'; ?> class="group-giftcardMagic">
                            <label">Your Name </label>
                            <input type="text" value="" class="input-giftcardMagic" name="your_name">
                        </div>
                        <div style="color:<?php echo $text_color; ?>" <?php echo $show_recipient_name == 1 ? '' : 'style="display:none;"'; ?> class="group-giftcardMagic">
                            <label">Recipient Name</label>
                            <input type="text" name="from_name" class="input-giftcardMagic">
                        </div>
                        <div style="color:<?php echo $text_color; ?>" <?php echo $show_voucher_value == 1 ? '' : 'style="display:none;"'; ?> class="group-giftcardMagic full-width-giftcardMagic">
                            <label">Voucher Value</label>
                            <div class="wrap-input-giftcardMagic">
                                <span class="currencySymbol"> $ </span>
                                <input type="text" name="voucher_value" class="input-giftcardMagic">
                            </div>
                        </div>
                        <div style="color:<?php echo $text_color; ?>" <?php echo $show_personal_message == 1 ? '' : 'style="display:none;"'; ?> class="group-giftcardMagic full-width-giftcardMagic">
                            <label">Personal Message</label>
                            <textarea name="message" class="input-giftcardMagic"></textarea>
                        </div>
                        <div style="color:<?php echo $text_color; ?>" class="group-giftcardMagic">
                            <label">Date of Expiry</label>
                            <input type="text" name="expiryCard" class="input-giftcardMagic" value="16.09.2023">
                        </div>
                        <div style="color:<?php echo $text_color; ?>" class="group-giftcardMagic">
                            <label">Coupon Code</label>
                            <input type="text" name="coupon_code" class="input-giftcardMagic" value="6234256841004311">
                        </div>
                        <div class="info-giftcardMagic">
                            <a href="<?php echo $email_company; ?>">
                            <?php echo $email_company; ?></a> | <a href="mailto:<?php echo $link_company; ?>"><?php echo $link_company; ?>
                        </a>
                        </div>
                        <div class="terms-giftcardMagic"><?php echo $terms; ?></div>
                    </div>
                </div>
            </div>
            <div class="setting-field">
                <h3>Display Field</h3>
                <div class="group-setting-giftcardMagic">
                    <div class="group-setting-giftcardMagic">
                        <label class="text-label">Your Name</label>
                        <label class="toggle-giftcardMagic ">
                            <input type="checkbox" class="toogle-slider-giftcardMagic" name="gcm_settings_frontend[show_name]" value="1" <?php echo $show_name == 1 ? 'checked' : ''; ?>> 
                            <span class="toggle-slider-giftcardMagic"></span>
                        </label>
                    </div>
                    <div class="group-setting-giftcardMagic">
                        <label class="text-label">Recipient Name</label>
                        <label class="toggle-giftcardMagic">
                            <input type="checkbox" class="toogle-slider-giftcardMagic" name="gcm_settings_frontend[show_recipient_name]" value="1" <?php echo $show_recipient_name == 1 ? 'checked' : ''; ?>>
                            <span class="toggle-slider-giftcardMagic"></span>
                        </label>
                    </div>
                    <div class="group-setting-giftcardMagic">
                        <label class="text-label">Voucher Value</label>
                        <label class="toggle-giftcardMagic ">
                            <input type="checkbox" class="toogle-slider-giftcardMagic" name="gcm_settings_frontend[show_voucher_value]" value="1" <?php echo $show_voucher_value == 1 ? 'checked' : ''; ?>>
                            <span class="toggle-slider-giftcardMagic"></span>
                        </label>
                    </div>
                    <div class="group-setting-giftcardMagic">
                        <label class="text-label">Personal Message</label>
                        <label class="toggle-giftcardMagic ">
                            <input type="checkbox" class="toogle-slider-giftcardMagic" name="gcm_settings_frontend[show_personal_message]" value="1" <?php echo $show_personal_message == 1 ? 'checked' : ''; ?>>
                            <span class="toggle-slider-giftcardMagic"></span>
                        </label>
                    </div>
                </div>
                <h3>Style</h3>
                <div class="group-setting-giftcardMagic">
                    <label class="text-label">Background Color</label>
                    <input type="color" name="gcm_settings_frontend[background_color]" value="<?php echo $background_color; ?>">
                </div>   
                <div class="group-setting-giftcardMagic">
                    <label class="text-label">Text Color</label>
                    <input type="color" name="gcm_settings_frontend[text_color]" value="<?php echo $text_color; ?>">
                </div>                
                <h3>Information</h3>                
                <div class="group-setting-giftcardMagic">
                    <label class="text-label">Company Logo (Required)</label>
                    <label class="field-file-giftcardMagic">
                        <input type="text" class="field-giftcardMagic" name="gcm_settings_frontend[company_logo]" value="<?php echo $company_logo; ?>" id="upload-logo">
                        <span class="text-file">Upload Logo</span>
                        <div class="preview-logo <?php echo $company_logo == '' ? '' : 'show'; ?>">
                            <img src="#" id="image_url">
                        </div>
                    </label>
                </div>
                <div class="group-setting-giftcardMagic">
                    <label class="text-label">Company Name (Required)</label>
                    <input type="text" class="field-giftcardMagic" name="gcm_settings_frontend[company_name]" value="<?php echo $company_name; ?>">
                </div>
                <div class="group-setting-giftcardMagic">
                    <label class="text-label">Terms Content</label>
                    <input type="text" class="field-giftcardMagic" name="gcm_settings_frontend[terms]" value="<?php echo $terms; ?>" maxlength="200">
                </div>
                <div class="group-setting-giftcardMagic">
                    <label class="text-label">Email company</label>
                    <input type="text" class="field-giftcardMagic" name="gcm_settings_frontend[email_company]" value="<?php echo $email_company; ?>">
                </div>
                <div class="group-setting-giftcardMagic">
                    <label class="text-label">Link company</label>
                    <input type="text" class="field-giftcardMagic" name="gcm_settings_frontend[link_company]" value="<?php echo $link_company; ?>">
                </div>
            </div>

        </div>
    </div>
    <?php
}
add_action('gift_card_magic_frontend_tab', 'gift_card_magic_frontend_tab_action');

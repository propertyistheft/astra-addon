<hr>
<div class="pafe-bottom">
    <div class="pafe-bottom__left">
        <h3><?php _e('Settings','pafe'); ?></h3>
    </div>
    <div class="pafe-bottom__right">
        <div class="pafe-license">
            <form method="post" action="options.php">
                <?php settings_fields( 'piotnet-addons-for-elementor-pro-settings-group' ); ?>
                <?php do_settings_sections( 'piotnet-addons-for-elementor-pro-settings-group' ); ?>
                <?php
                $disable_ssl_verify_license = esc_attr( get_option( 'piotnet_addons_for_elementor_pro_disable_ssl_verify_license' ) );
                $beta_version = esc_attr( get_option( 'piotnet_addons_for_elementor_pro_beta_version' ) );
                ?>
                <table class="form-table">
                    <tr valign="top">
                        <th scope="row"><?php _e('Disable verify SSL when validate License','pafe'); ?></th>
                        <td><input type="checkbox" name="piotnet_addons_for_elementor_pro_disable_ssl_verify_license" value="true" <?php if ($disable_ssl_verify_license == 'true') {echo 'checked';}; ?>/>Only use it when you have trouble with validating license (SSL certificate problem)</td>
                    </tr>
                    <tr valign="top">
                        <th scope="row"><?php _e('Subscribe to Beta updates','pafe'); ?></th>
                        <td><input type="checkbox" name="piotnet_addons_for_elementor_pro_beta_version" value="yes" <?php if ($beta_version == 'yes') {echo 'checked';}; ?>/></td>
                    </tr>
                </table>
                <?php submit_button(__('Save Settings','pafe')); ?>
            </form>
        </div>
    </div>
</div>

<?php if( get_option( 'pafe-features-form-google-sheets-connector', 2 ) == 2 || get_option( 'pafe-features-form-google-sheets-connector', 2 ) == 1 ) : ?>

    <hr>
    <div class="pafe-bottom">
        <div class="pafe-bottom__left">
            <h3><?php _e('Google Sheets Integration','pafe'); ?></h3>
            <iframe width="100%" height="250" src="https://www.youtube.com/embed/NidLGA0k8mI" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
        </div>
        <div class="pafe-bottom__right">
            <div class="pafe-license">
                <form method="post" action="options.php">
                    <?php settings_fields( 'piotnet-addons-for-elementor-pro-google-sheets-group' ); ?>
                    <?php do_settings_sections( 'piotnet-addons-for-elementor-pro-google-sheets-group' ); ?>
                    <?php

                    $client_id     = esc_attr( get_option( 'piotnet-addons-for-elementor-pro-google-sheets-client-id' ) );
                    $client_secret = esc_attr( get_option( 'piotnet-addons-for-elementor-pro-google-sheets-client-secret' ) );
                    $redirect =  get_admin_url(null,'admin.php?page=piotnet-addons-for-elementor&connect_type=google_sheets'); //For PAFE

                    if ( ! empty( $_GET['connect_type'] ) && $_GET['connect_type'] == 'google_sheets' && ! empty( $_GET['code'] ) ) {
                        // Authorization
                        $code = $_GET['code'];
                        // Token
                        $url  = 'https://accounts.google.com/o/oauth2/token';
                        $curl = curl_init();
                        $data = "code=$code&client_id=$client_id&client_secret=$client_secret&redirect_uri=" . urlencode($redirect) . "&grant_type=authorization_code";

                        curl_setopt_array($curl, array(
                            CURLOPT_URL => "https://accounts.google.com/o/oauth2/token",
                            CURLOPT_RETURNTRANSFER => true,
                            CURLOPT_TIMEOUT => 30,
                            CURLOPT_CUSTOMREQUEST => "POST",
                            CURLOPT_POSTFIELDS => $data,
                            CURLOPT_SSL_VERIFYPEER => false,
                            CURLOPT_HTTPHEADER => array(
                                "Content-Type: application/x-www-form-urlencoded"
                            ),
                        ));

                        $response = curl_exec($curl);
                        curl_close($curl);
                        //echo $response;
                        $array = json_decode( $response );

                        if ( ! empty( $array->access_token ) && ! empty( $array->refresh_token ) && ! empty( $array->expires_in ) ) {
                            $pafe_ggsheets_expired_at = time() + $array->expires_in;
                            update_option( 'piotnet-addons-for-elementor-pro-google-sheet-expires', $array->expires_in );
                            update_option( 'piotnet-addons-for-elementor-pro-google-sheets-expired-token', $pafe_ggsheets_expired_at );
                            update_option( 'piotnet-addons-for-elementor-pro-google-sheets-access-token', $array->access_token );
                            update_option( 'piotnet-addons-for-elementor-pro-google-sheets-refresh-token', $array->refresh_token );
                        }
                    }
                    ?>
                    <div style="padding-top: 30px;">
                        <b><a href="https://console.developers.google.com/flows/enableapi?apiid=sheets.googleapis.com" target="_blank"><?php _e('Click here to Sign into your Gmail account and access Google Sheets’s application registration','pafe'); ?></a></b>
                    </div>
                    <table class="form-table">
                        <tr valign="top">
                            <th scope="row"><?php _e('Client ID','pafe'); ?></th>
                            <td><input type="text" name="piotnet-addons-for-elementor-pro-google-sheets-client-id" value="<?php echo $client_id; ?>" class="regular-text"/></td>
                        </tr>
                        <tr valign="top">
                            <th scope="row"><?php _e('Client Secret','pafe'); ?></th>
                            <td><input type="text" name="piotnet-addons-for-elementor-pro-google-sheets-client-secret" value="<?php echo $client_secret; ?>" class="regular-text"/></td>
                        </tr>
                        <tr valign="top">
                            <th scope="row"><?php _e('Authorized redirect URI','pafe'); ?></th>
                            <td><input type="text" readonly="readonly" value="<?php echo $redirect; ?>" class="regular-text"/></td>
                        </tr>
                        <tr valign="top">
                            <th scope="row"><?php _e('Authorizaion','pafe'); ?></th>
                            <td>
                                <?php if ( !empty($client_id) && !empty($client_secret) ) : ?>
                                    <a class="pafe-toggle-features__button" href="https://accounts.google.com/o/oauth2/auth?redirect_uri=<?php echo urlencode($redirect); ?>&client_id=<?php echo $client_id; ?>&response_type=code&scope=https://www.googleapis.com/auth/spreadsheets&approval_prompt=force&access_type=offline">Authorize</a>
                                <?php else : ?>
                                    <?php _e('To setup Gmail integration properly you should save Client ID and Client Secret.','pafe'); ?>
                                <?php endif; ?>
                            </td>
                        </tr>
                    </table>
                    <?php submit_button(__('Save Settings','pafe')); ?>
                </form>
            </div>
        </div>
    </div>

<?php endif; ?>

<?php if( get_option( 'pafe-features-form-google-calendar-connector', 2 ) == 2 || get_option( 'pafe-features-form-google-calendar-connector', 2 ) == 1 ) : ?>
    <hr>
    <div class="pafe-bottom">
        <div class="pafe-bottom__left">
            <h3><?php esc_html_e( 'Google Calendar Integration', 'pafe' ); ?></h3>
        </div>

        <div class="pafe-bottom__right">
            <div class="pafe-license">
                <form method="post" action="options.php">
                    <?php settings_fields( 'piotnet-addons-for-elementor-pro-google-calendar-group' ); ?>
                    <?php do_settings_sections( 'piotnet-addons-for-elementor-pro-google-calendar-group' ); ?>
                    <?php
                    $redirect      =  get_admin_url(null,'admin.php?page=piotnet-addons-for-elementor&connect_type=google_calendar');
                    //$redirect      = "http://localhost/wp-admin/admin.php?page=piotnet-addons-for-elementor&connect_type=google_calendar";
                    $gg_cld_client_id     = esc_attr( get_option( 'piotnet-addons-for-elementor-pro-google-calendar-client-id' ) );
                    $gg_cld_client_secret = esc_attr( get_option( 'piotnet-addons-for-elementor-pro-google-calendar-client-secret' ) );
                    $client_api_key = esc_attr( get_option( 'piotnet-addons-for-elementor-pro-google-calendar-client-api-key' ) );

                    if ( ! empty( $_GET['connect_type'] ) && $_GET['connect_type'] == 'google_calendar' && ! empty( $_GET['code'] ) ) {
                        // Authorization
                        $code = $_GET['code'];
                        // Token
                        $curl = curl_init();
                        $data = "code=$code&client_id=$gg_cld_client_id&client_secret=$gg_cld_client_secret&redirect_uri=" . urlencode($redirect) . "&grant_type=authorization_code";

                        curl_setopt_array($curl, array(
                            CURLOPT_URL => "https://accounts.google.com/o/oauth2/token",
                            CURLOPT_RETURNTRANSFER => true,
                            CURLOPT_TIMEOUT => 30,
                            CURLOPT_CUSTOMREQUEST => "POST",
                            CURLOPT_POSTFIELDS => $data,
                            CURLOPT_SSL_VERIFYPEER => false,
                            CURLOPT_HTTPHEADER => array(
                                "Content-Type: application/x-www-form-urlencoded"
                            ),
                        ));
                        $response = curl_exec($curl);
                        curl_close($curl);
                        //echo $response;
                        $array = json_decode( $response );
                        if ( ! empty( $array->access_token ) && ! empty( $array->refresh_token ) && ! empty( $array->expires_in ) ) {
                            $piotnetforms_ggcalendar_expired_at = time() + $array->expires_in;
                            update_option( 'piotnet-addons-for-elementor-pro-google-calendar-expires', $array->expires_in );
                            update_option( 'piotnet-addons-for-elementor-pro-google-calendar-expired-token', $piotnetforms_ggcalendar_expired_at );
                            update_option( 'piotnet-addons-for-elementor-pro-google-calendar-access-token', $array->access_token );
                            update_option( 'piotnet-addons-for-elementor-pro-google-calendar-refresh-token', $array->refresh_token );
                            function pafe_google_calendar_get_calendar_id($access_token, $client_api_key) {
                                $curl = curl_init();

                                curl_setopt_array( $curl, array(
                                    CURLOPT_URL            => "https://www.googleapis.com/calendar/v3/users/me/calendarList?minAccessRole=writer&key=$client_api_key",
                                    CURLOPT_RETURNTRANSFER => true,
                                    CURLOPT_TIMEOUT        => 30,
                                    CURLOPT_CUSTOMREQUEST  => "GET",
                                    CURLOPT_SSL_VERIFYPEER => false,
                                    CURLOPT_HTTPHEADER     => array(
                                        "Authorization: Bearer $access_token",
                                        "Accept: application/json"
                                    ),
                                ));
                                $response = curl_exec( $curl );
                                curl_close( $curl );

                                $response = json_decode($response);
                                //print_r($response);
                                $gg_calendar_items = $response->items;
                                $gg_calendar_id = null;
                                foreach ( $gg_calendar_items as $gg_calendar_item ) {
                                    $gg_calendar_item_id = $gg_calendar_item->id;
                                    if (empty($gg_calendar_id)) {
                                        $gg_calendar_id = $gg_calendar_item_id;
                                    }
                                    if ( !empty($gg_calendar_item->primary) && $gg_calendar_item->primary == 1 ) {
                                        $gg_calendar_id = $gg_calendar_item_id;
                                        break;
                                    }
                                }
                                return $gg_calendar_id;
                            }
                            $gg_calendar_id = pafe_google_calendar_get_calendar_id($array->access_token, $client_api_key);
                            update_option('piotnet-addons-for-elementor-pro-google-calendar-id', $gg_calendar_id);
                        }
                    }
                    ?>
                    <div style="padding-top: 30px;">
                        <b><a href="https://console.developers.google.com/" target="_blank"><?php esc_html_e( 'Click here to Sign into your Gmail account and access Google Calendar’s application registration', 'piotnetforms' ); ?></a></b>
                    </div>
                    <table class="form-table">
                        <tr valign="top">
                            <th scope="row"><?php esc_html_e( 'Client ID', 'pafe' ); ?></th>
                            <td><input type="text" name="piotnet-addons-for-elementor-pro-google-calendar-client-id" value="<?php echo $gg_cld_client_id; ?>" class="regular-text"/></td>
                        </tr>
                        <tr valign="top">
                            <th scope="row"><?php esc_html_e( 'Client Secret', 'pafe' ); ?></th>
                            <td><input type="text" name="piotnet-addons-for-elementor-pro-google-calendar-client-secret" value="<?php echo $gg_cld_client_secret; ?>" class="regular-text"/></td>
                        </tr>
                        <tr valign="top">
                            <th scope="row"><?php esc_html_e( 'API Key', 'pafe' ); ?></th>
                            <td><input type="text" name="piotnet-addons-for-elementor-pro-google-calendar-client-api-key" value="<?php echo $client_api_key; ?>" class="regular-text"/></td>
                        </tr>
                        <tr valign="top">
                            <th scope="row"><?php esc_html_e( 'Authorized redirect URI', 'pafe' ); ?></th>
                            <td><input type="text" readonly="readonly" value="<?php echo $redirect; ?>" class="regular-text"/></td>
                        </tr>
                        <tr valign="top">
                            <th scope="row"><?php esc_html_e( 'Authorize', 'pafe' ); ?></th>
                            <td>
                                <?php if ( ! empty( $gg_cld_client_id ) && ! empty( $gg_cld_client_secret ) ) : ?>
                                    <a class="piotnetforms-toggle-features__button" href="https://accounts.google.com/o/oauth2/auth?redirect_uri=<?php echo urlencode($redirect); ?>&client_id=<?php echo $gg_cld_client_id; ?>&response_type=code&scope=https://www.googleapis.com/auth/calendar.readonly https://www.googleapis.com/auth/calendar.events&approval_prompt=force&access_type=offline">Authorize</a>
                                <?php else : ?>
                                    <?php esc_html_e( 'To setup Gmail integration properly you should save Client ID and Client Secret.', 'pafe' ); ?>
                                <?php endif; ?>
                            </td>
                        </tr>
                    </table>
                    <?php submit_button( __( 'Save Settings', 'pafe' ) ); ?>
                </form>
            </div>
        </div>
    </div>


<?php endif; ?>

<?php if( get_option( 'pafe-features-address-autocomplete-field', 2 ) == 2 || get_option( 'pafe-features-address-autocomplete-field', 2 ) == 1 ) : ?>

    <hr>
    <div class="pafe-bottom">
        <div class="pafe-bottom__left">
            <h3><?php _e('Google Maps Integration','pafe'); ?></h3>
            <iframe width="100%" height="250" src="https://www.youtube.com/embed/_YhQWreCZwA" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
        </div>
        <div class="pafe-bottom__right">
            <div class="pafe-license">
                <form method="post" action="options.php">
                    <?php settings_fields( 'piotnet-addons-for-elementor-pro-google-maps-group' ); ?>
                    <?php do_settings_sections( 'piotnet-addons-for-elementor-pro-google-maps-group' ); ?>
                    <?php
                    $google_maps_api_key = esc_attr( get_option('piotnet-addons-for-elementor-pro-google-maps-api-key') );
                    ?>
                    <div style="padding-top: 30px;">
                        <b><a href="https://cloud.google.com/maps-platform/?apis=maps,places" target="_blank"><?php _e('Click here to get Google Maps API Key','pafe'); ?></a></b>
                    </div>
                    <table class="form-table">
                        <tr valign="top">
                            <th scope="row"><?php _e('Google Maps API Key','pafe'); ?></th>
                            <td><input type="text" name="piotnet-addons-for-elementor-pro-google-maps-api-key" value="<?php echo $google_maps_api_key; ?>" class="regular-text"/></td>
                        </tr>
                    </table>
                    <?php submit_button(__('Save Settings','pafe')); ?>
                </form>
            </div>
        </div>
    </div>
    <br>
<?php endif; ?>

<?php if( get_option( 'pafe-features-stripe-payment', 2 ) == 2 || get_option( 'pafe-features-stripe-payment', 2 ) == 1 ) : ?>

    <hr>
    <div class="pafe-bottom">
        <div class="pafe-bottom__left">
            <h3><?php _e('Stripe Integration','pafe'); ?></h3>
        </div>
        <div class="pafe-bottom__right">
            <div class="pafe-license">
                <form method="post" action="options.php">
                    <?php settings_fields( 'piotnet-addons-for-elementor-pro-stripe-group' ); ?>
                    <?php do_settings_sections( 'piotnet-addons-for-elementor-pro-stripe-group' ); ?>
                    <?php
                    $publishable_key = esc_attr( get_option('piotnet-addons-for-elementor-pro-stripe-publishable-key') );
                    $secret_key = esc_attr( get_option('piotnet-addons-for-elementor-pro-stripe-secret-key') );
                    ?>
                    <table class="form-table">
                        <tr valign="top">
                            <th scope="row"><?php _e('Publishable Key','pafe'); ?></th>
                            <td><input type="text" name="piotnet-addons-for-elementor-pro-stripe-publishable-key" value="<?php echo $publishable_key; ?>" class="regular-text"/></td>
                        </tr>
                        <tr valign="top">
                            <th scope="row"><?php _e('Secret Key','pafe'); ?></th>
                            <td><input type="text" name="piotnet-addons-for-elementor-pro-stripe-secret-key" value="<?php echo $secret_key; ?>" class="regular-text"/></td>
                        </tr>
                    </table>
                    <?php submit_button(__('Save Settings','pafe')); ?>
                </form>
            </div>
        </div>
    </div>

<?php endif; ?>

<?php if( get_option( 'pafe-features-paypal-payment', 2 ) == 2 || get_option( 'pafe-features-paypal-payment', 2 ) == 1 ) : ?>

    <hr>
    <div class="pafe-bottom">
        <div class="pafe-bottom__left">
            <h3><?php _e('Paypal Integration','pafe'); ?></h3>
        </div>
        <div class="pafe-bottom__right">
            <div class="pafe-license">
                <form method="post" action="options.php">
                    <?php settings_fields( 'piotnet-addons-for-elementor-pro-paypal-group' ); ?>
                    <?php do_settings_sections( 'piotnet-addons-for-elementor-pro-paypal-group' ); ?>
                    <?php
                    $client_id = esc_attr( get_option('piotnet-addons-for-elementor-pro-paypal-client-id') );
                    ?>
                    <table class="form-table">
                        <div style="padding-top: 30px;">
                            <b><a href="https://developer.paypal.com/developer/applications/" target="_blank"><?php _e('Click here to Create app and get the Client ID','pafe'); ?></a></b>
                        </div>
                        <tr valign="top">
                            <th scope="row"><?php _e('Client ID','pafe'); ?></th>
                            <td><input type="text" name="piotnet-addons-for-elementor-pro-paypal-client-id" value="<?php echo $client_id; ?>" class="regular-text"/></td>
                        </tr>
                    </table>
                    <?php submit_button(__('Save Settings','pafe')); ?>
                </form>
            </div>
        </div>
    </div>

<?php endif; ?>
    <!-- Mollie Payment -->
    <hr>
    <div class="pafe-bottom">
        <div class="pafe-bottom__left">
            <h3><?php _e('Mollie Payment','pafe'); ?></h3>
        </div>
        <div class="pafe-bottom__right">
            <div class="pafe-license">
                <form method="post" action="options.php">
                    <?php settings_fields( 'piotnet-addons-for-elementor-pro-mollie-group' ); ?>
                    <?php do_settings_sections( 'piotnet-addons-for-elementor-pro-mollie-group' ); ?>
                    <?php
                    $mollie_api_key = esc_attr( get_option('piotnet-addons-for-elementor-pro-mollie-api-key') );
                    ?>
                    <table class="form-table">
                        <tr valign="top">
                            <th scope="row"><?php _e('API Key','pafe'); ?></th>
                            <td><input type="text" name="piotnet-addons-for-elementor-pro-mollie-api-key" value="<?php echo $mollie_api_key; ?>" class="regular-text"/></td>
                        </tr>
                    </table>
                    <?php submit_button(__('Save Settings','pafe')); ?>
                </form>
            </div>
        </div>
    </div>
    <!-- End -->
<?php if( get_option( 'pafe-features-hubspot', 2 ) == 2 || get_option( 'pafe-features-hubspot', 2 ) == 1 ) : ?>
    <hr>
    <div class="pafe-bottom">
        <div class="pafe-bottom__left">
            <h3><?php _e('Hubspot Integration','pafe'); ?></h3>
        </div>
        <div class="pafe-bottom__right">
            <div class="pafe-license">
                <form method="post" action="options.php">
                    <?php settings_fields( 'piotnet-addons-for-elementor-pro-hubspot-group' ); ?>
                    <?php do_settings_sections( 'piotnet-addons-for-elementor-pro-hubspot-group' ); ?>
                    <?php $hubspot_api = esc_attr( get_option( 'piotnet-addons-for-elementor-pro-hubspot-api-key' ) ); ?>

                    <div style="padding-top: 30px;">
                        <b><a href="https://app.hubspot.com/api-key/14540594/call-log" target="_blank"><?php _e('Click here to get the API key','pafe'); ?></a></b>
                    </div>
                    <table class="form-table">
                        <tr valign="top">
                            <th scope="row"><?php _e('API Key','pafe'); ?></th>
                            <td><input type="text" name="piotnet-addons-for-elementor-pro-hubspot-api-key" value="<?php echo $hubspot_api; ?>" class="regular-text"/></td>
                        </tr>
                    </table>
                    <?php submit_button(__('Save Settings','pafe')); ?>
                </form>
            </div>
        </div>
    </div>

<?php endif; ?>

    <hr>
    <div class="pafe-bottom">
        <div class="pafe-bottom__left">
            <h3><?php _e('MailChimp Integration','pafe'); ?></h3>
        </div>
        <div class="pafe-bottom__right">
            <div class="pafe-license">
                <form method="post" action="options.php">
                    <?php settings_fields( 'piotnet-addons-for-elementor-pro-mailchimp-group' ); ?>
                    <?php do_settings_sections( 'piotnet-addons-for-elementor-pro-mailchimp-group' ); ?>
                    <?php
                    $api_key = esc_attr( get_option('piotnet-addons-for-elementor-pro-mailchimp-api-key') );
                    ?>
                    <table class="form-table">
                        <tr valign="top">
                            <th scope="row"><?php _e('API Key','pafe'); ?></th>
                            <td><input type="text" name="piotnet-addons-for-elementor-pro-mailchimp-api-key" value="<?php echo $api_key; ?>" class="regular-text"/></td>
                        </tr>
                    </table>
                    <?php submit_button(__('Save Settings','pafe')); ?>
                </form>
            </div>
        </div>
    </div>

    <hr>
    <div class="pafe-bottom">
        <div class="pafe-bottom__left">
            <h3><?php _e('MailerLite Integration','pafe'); ?></h3>
        </div>
        <div class="pafe-bottom__right">
            <div class="pafe-license">
                <form method="post" action="options.php">
                    <?php settings_fields( 'piotnet-addons-for-elementor-pro-mailerlite-group' ); ?>
                    <?php do_settings_sections( 'piotnet-addons-for-elementor-pro-mailerlite-group' ); ?>
                    <?php
                    $api_key = esc_attr( get_option('piotnet-addons-for-elementor-pro-mailerlite-api-key') );
                    ?>
                    <table class="form-table">
                        <tr valign="top">
                            <th scope="row"><?php _e('API Key','pafe'); ?></th>
                            <td><input type="text" name="piotnet-addons-for-elementor-pro-mailerlite-api-key" value="<?php echo $api_key; ?>" class="regular-text"/></td>
                        </tr>
                    </table>
                    <?php submit_button(__('Save Settings','pafe')); ?>
                </form>
            </div>
        </div>
    </div>

    <hr>
    <div class="pafe-bottom">
        <div class="pafe-bottom__left">
            <h3><?php _e('Sendinblue Integration','pafe'); ?></h3>
        </div>
        <div class="pafe-bottom__right">
            <div class="pafe-license">
                <form method="post" action="options.php">
                    <?php settings_fields( 'piotnet-addons-for-elementor-pro-sendinblue-group' ); ?>
                    <?php do_settings_sections( 'piotnet-addons-for-elementor-pro-sendinblue-group' ); ?>
                    <?php
                    $sendinblue_api_key = esc_attr( get_option('piotnet-addons-for-elementor-pro-sendinblue-api-key') );
                    ?>
                    <table class="form-table">
                        <tr valign="top">
                            <th scope="row"><?php _e('API Key','pafe'); ?></th>
                            <td><input type="text" name="piotnet-addons-for-elementor-pro-sendinblue-api-key" value="<?php echo $sendinblue_api_key; ?>" class="regular-text"/></td>
                        </tr>
                    </table>
                    <?php submit_button(__('Save Settings','pafe')); ?>
                </form>
            </div>
        </div>
    </div>

    <hr>
    <div class="pafe-bottom">
        <div class="pafe-bottom__left">
            <h3><?php _e('ActiveCampaign Integration','pafe'); ?></h3>
        </div>
        <div class="pafe-bottom__right">
            <div class="pafe-license">
                <form method="post" action="options.php">
                    <?php settings_fields( 'piotnet-addons-for-elementor-pro-activecampaign-group' ); ?>
                    <?php do_settings_sections( 'piotnet-addons-for-elementor-pro-activecampaign-group' ); ?>
                    <?php
                    $api_key = esc_attr( get_option('piotnet-addons-for-elementor-pro-activecampaign-api-key') );
                    $api_url = esc_attr( get_option('piotnet-addons-for-elementor-pro-activecampaign-api-url') );
                    ?>
                    <table class="form-table">
                        <tr valign="top">
                            <th scope="row"><?php _e('API Key','pafe'); ?></th>
                            <td><input type="text" name="piotnet-addons-for-elementor-pro-activecampaign-api-key" value="<?php echo $api_key; ?>" class="regular-text"/></td>
                        </tr>
                        <tr valign="top">
                            <th scope="row"><?php _e('API URL','pafe'); ?></th>
                            <td><input type="text" name="piotnet-addons-for-elementor-pro-activecampaign-api-url" value="<?php echo $api_url; ?>" class="regular-text"/></td>
                        </tr>
                    </table>
                    <?php submit_button(__('Save Settings','pafe')); ?>
                </form>
            </div>
        </div>
    </div>

    <hr>
    <div class="pafe-bottom">
        <div class="pafe-bottom__left">
            <h3><?php _e('GetResponse Integration','pafe'); ?></h3>
        </div>
        <div class="pafe-bottom__right">
            <div class="pafe-license">
                <form method="post" action="options.php">
                    <?php settings_fields( 'piotnet-addons-for-elementor-pro-getresponse-group' ); ?>
                    <?php do_settings_sections( 'piotnet-addons-for-elementor-pro-getresponse-group' ); ?>
                    <?php
                    $getresponseapi_key = esc_attr( get_option('piotnet-addons-for-elementor-pro-getresponse-api-key') );
                    ?>
                    <table class="form-table">
                        <tr valign="top">
                            <th scope="row"><?php _e('API Key','pafe'); ?></th>
                            <td><input type="text" name="piotnet-addons-for-elementor-pro-getresponse-api-key" value="<?php echo $getresponseapi_key; ?>" class="regular-text"/></td>
                        </tr>
                    </table>
                    <?php submit_button(__('Save Settings','pafe')); ?>
                </form>
            </div>
        </div>
    </div>

<?php if( get_option( 'pafe-features-form-builder', 2 ) == 2 || get_option( 'pafe-features-form-builder', 2 ) == 1 ) : ?>

    <hr>
    <div class="pafe-bottom">
        <div class="pafe-bottom__left">
            <h3><?php _e('reCAPTCHA (v3) Integration','pafe'); ?></h3>
        </div>
        <div class="pafe-bottom__right">
            <div class="pafe-license">
                <form method="post" action="options.php">
                    <?php settings_fields( 'piotnet-addons-for-elementor-pro-recaptcha-group' ); ?>
                    <?php do_settings_sections( 'piotnet-addons-for-elementor-pro-recaptcha-group' ); ?>
                    <?php
                    $site_key = esc_attr( get_option('piotnet-addons-for-elementor-pro-recaptcha-site-key') );
                    $secret_key = esc_attr( get_option('piotnet-addons-for-elementor-pro-recaptcha-secret-key') );
                    ?>
                    <div style="padding-top: 30px;" data-pafe-dropdown>
                        <b><a href="#" data-pafe-dropdown-trigger><?php _e('Click here to view tutorial','pafe'); ?></a></b>
                        <div data-pafe-dropdown-content>
                            <p>Very first thing you need to do is register your website on Google reCAPTCHA to do that click <a href="https://www.google.com/recaptcha/admin" target="_blank">here</a>.</p>

                            <p>Login to your Google account and create the app by filling the form. Select the reCAPTCHA v3 and in that select “I am not a robot” checkbox option.</p>
                            <div>
                                <img src="<?php echo plugin_dir_url( __FILE__ ); ?>google-recaptcha-1.jpg">
                            </div>

                            <p>Once submitted, Google will provide you with the following two information: Site key, Secret key.</p>
                            <div>
                                <img src="<?php echo plugin_dir_url( __FILE__ ); ?>google-recaptcha-2.jpg">
                            </div>
                        </div>
                    </div>
                    <table class="form-table">
                        <tr valign="top">
                            <th scope="row"><?php _e('Site Key','pafe'); ?></th>
                            <td><input type="text" name="piotnet-addons-for-elementor-pro-recaptcha-site-key" value="<?php echo $site_key; ?>" class="regular-text"/></td>
                        </tr>
                        <tr valign="top">
                            <th scope="row"><?php _e('Secret Key','pafe'); ?></th>
                            <td><input type="text" name="piotnet-addons-for-elementor-pro-recaptcha-secret-key" value="<?php echo $secret_key; ?>" class="regular-text"/></td>
                        </tr>
                    </table>
                    <?php submit_button(__('Save Settings','pafe')); ?>
                </form>
            </div>
        </div>
    </div>

    <hr>
    <div class="pafe-bottom">
        <div class="pafe-bottom__left">
            <h3><?php _e('Twilio Integration','pafe'); ?></h3>
        </div>
        <div class="pafe-bottom__right">
            <div class="pafe-license">
                <form method="post" action="options.php">
                    <?php settings_fields( 'piotnet-addons-for-elementor-pro-twilio-group' ); ?>
                    <?php do_settings_sections( 'piotnet-addons-for-elementor-pro-twilio-group' ); ?>
                    <?php
                    $account_sid = esc_attr( get_option('piotnet-addons-for-elementor-pro-twilio-account-sid') );
                    $author_token = esc_attr( get_option('piotnet-addons-for-elementor-pro-twilio-author-token') );
                    ?>
                    <table class="form-table">
                        <tr valign="top">
                            <th scope="row"><?php _e('Account SID','pafe'); ?></th>
                            <td><input type="text" name="piotnet-addons-for-elementor-pro-twilio-account-sid" value="<?php echo $account_sid; ?>" class="regular-text"/></td>
                        </tr>
                        <tr valign="top">
                            <th scope="row"><?php _e('Author Token','pafe'); ?></th>
                            <td><input type="text" name="piotnet-addons-for-elementor-pro-twilio-author-token" value="<?php echo $author_token; ?>" class="regular-text"/></td>
                        </tr>
                    </table>
                    <?php submit_button(__('Save Settings','pafe')); ?>
                </form>
            </div>
        </div>
    </div>

    <hr>
    <div class="pafe-bottom">
        <div class="pafe-bottom__left">
            <h3><?php _e('Sendfox Integration','pafe'); ?></h3>
        </div>
        <div class="pafe-bottom__right">
            <div class="pafe-license">
                <form method="post" action="options.php">
                    <?php settings_fields( 'piotnet-addons-for-elementor-pro-sendfox-group' ); ?>
                    <?php do_settings_sections( 'piotnet-addons-for-elementor-pro-sendfox-group' ); ?>
                    <?php
                    $sendfox_access_token = esc_attr( get_option('piotnet-addons-for-elementor-pro-sendfox-access-token') );
                    ?>
                    <table class="form-table">
                        <tr valign="top">
                            <th scope="row"><?php _e('SendFox Personal Aceess Token','pafe'); ?></th>
                            <td><input type="text" name="piotnet-addons-for-elementor-pro-sendfox-access-token" value="<?php echo $sendfox_access_token; ?>" class="regular-text"/></td>
                        </tr>
                    </table>
                    <?php submit_button(__('Save Settings','pafe')); ?>
                </form>
            </div>
        </div>
    </div>
    <hr>
    <div class="pafe-bottom">
        <div class="pafe-bottom__left">
            <h3><?php _e('Constant contact','pafe'); ?></h3>
        </div>
        <div class="pafe-bottom__right">
            <div class="pafe-license">
                <?php
                $c_ID = esc_attr( get_option('piotnet-addons-for-elementor-pro-constant-contact-client-id') );
                $app_secret = get_option('piotnet-addons-for-elementor-pro-constant-contact-app-secret-id');
                $redirectURI = admin_url('admin.php?page=piotnet-addons-for-elementor');
                $baseURL = "https://authz.constantcontact.com/oauth2/default/v1/authorize";
                $authURL = $baseURL . "?client_id=" . $c_ID . "&scope=contact_data+campaign_data+account_update+account_read+offline_access&response_type=code" . "&redirect_uri=" . urlencode($redirectURI).'&state=piotnet';
                ?>
                <form method="post" action="options.php">
                    <?php settings_fields( 'piotnet-addons-for-elementor-pro-constant-contact-group' ); ?>
                    <?php do_settings_sections( 'piotnet-addons-for-elementor-pro-constant-contact-group' ); ?>
                    <table class="form-table">
                        <tr valign="top">
                            <th scope="row"><?php _e('API Key','pafe'); ?></th>
                            <td><input type="text" name="piotnet-addons-for-elementor-pro-constant-contact-client-id" value="<?php echo $c_ID; ?>" class="regular-text"/></td>
                        </tr>
                        <tr valign="top">
                            <th scope="row"><?php _e('App Secret','pafe'); ?></th>
                            <td><input type="text" name="piotnet-addons-for-elementor-pro-constant-contact-app-secret-id" value="<?php echo $app_secret; ?>" class="regular-text"/></td>
                        </tr>
                        <tr valign="top">
                            <th scope="row"><?php _e('Authorization Redirect URI','pafe'); ?></th>
                            <td><input type="text" value="<?php echo $redirectURI; ?>" class="regular-text" readonly/></td>
                        </tr>
                    </table>
                    <div class="piotnet-addons-zoho-admin-api">
                        <?php submit_button(__('Save Settings','pafe')); ?>
                        <p class="submit"><a class="button button-primary" href="<?php echo $authURL; ?>" authenticate-zoho-crm disabled>Authenticate Constant Contact</a></p>
                    </div>
                </form>
                <?php

                function PAFE_constantcontact_get_token($code, $redirect_uri, $api_key, $app_secret){
                    $curl = curl_init();
                    curl_setopt_array($curl, array(
                        CURLOPT_URL => 'https://authz.constantcontact.com/oauth2/default/v1/token?code='.$code.'&redirect_uri='.urlencode($redirect_uri).'&grant_type=authorization_code',
                        CURLOPT_RETURNTRANSFER => true,
                        CURLOPT_ENCODING => '',
                        CURLOPT_MAXREDIRS => 10,
                        CURLOPT_TIMEOUT => 0,
                        CURLOPT_FOLLOWLOCATION => true,
                        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                        CURLOPT_CUSTOMREQUEST => 'POST',
                        CURLOPT_HTTPHEADER => array(
                            'Content-Type: application/x-www-form-urlencoded',
                            'Authorization: Basic '.base64_encode($api_key.':'.$app_secret)
                        ),
                    ));
                    $response = curl_exec($curl);
                    curl_close($curl);
                    return json_decode($response);
                }

                if(!empty($_GET['code']) && $_GET['state'] == 'piotnet'){
                    $token_data = PAFE_constantcontact_get_token($_GET['code'], $redirectURI, $c_ID, $app_secret);
                    if(!empty($token_data->access_token)){
                        update_option('piotnet-constant-contact-access-token', $token_data->access_token);
                        update_option('piotnet-constant-contact-refresh-token', $token_data->refresh_token);
                        update_option('piotnet-constant-contact-time-get-token', time());
                    }
                }
                ?>
            </div>
        </div>
    </div>
    <hr>
    <div class="pafe-bottom">
        <div class="pafe-bottom__left">
            <h3><?php _e('Convertkit Integration','pafe'); ?></h3>
        </div>
        <div class="pafe-bottom__right">
            <div class="pafe-license">
                <form method="post" action="options.php">
                    <?php settings_fields( 'piotnet-addons-for-elementor-pro-convertkit-group' ); ?>
                    <?php do_settings_sections( 'piotnet-addons-for-elementor-pro-convertkit-group' ); ?>
                    <?php
                    $convertkit_api_key = esc_attr( get_option('piotnet-addons-for-elementor-pro-convertkit-api-key') );
                    ?>
                    <table class="form-table">
                        <tr valign="top">
                            <th scope="row"><?php _e('API Key','pafe'); ?></th>
                            <td><input type="text" name="piotnet-addons-for-elementor-pro-convertkit-api-key" value="<?php echo $convertkit_api_key; ?>" class="regular-text"/></td>
                        </tr>
                    </table>
                    <?php submit_button(__('Save Settings','pafe')); ?>
                </form>
            </div>
        </div>
    </div>

    <hr>
    <div class="pafe-bottom">
        <div class="pafe-bottom__left">
            <h3><?php _e('Zoho Integration','pafe'); ?></h3>
        </div>
        <div class="pafe-bottom__right">
            <div class="pafe-license">
                <form method="post" action="options.php">
                    <?php settings_fields( 'piotnet-addons-for-elementor-pro-zoho-group' ); ?>
                    <?php do_settings_sections( 'piotnet-addons-for-elementor-pro-zoho-group' ); ?>
                    <?php
                    $zoho_domain = esc_attr( get_option('piotnet-addons-for-elementor-pro-zoho-domain') );
                    $client_id = esc_attr( get_option('piotnet-addons-for-elementor-pro-zoho-client-id') );
                    $redirect_url = admin_url('admin.php?page=piotnet-addons-for-elementor');
                    $client_secret = esc_attr( get_option('piotnet-addons-for-elementor-pro-zoho-client-secret') );
                    $token = esc_attr( get_option('piotnet-addons-for-elementor-pro-zoho-token') );
                    $refresh_token = esc_attr( get_option('piotnet-addons-for-elementor-pro-zoho-refresh-token') );
                    $zoho_domains = ["accounts.zoho.com", "accounts.zoho.com.au", "accounts.zoho.eu", "accounts.zoho.in", "accounts.zoho.com.cn"]
                    ?>
                    <table class="form-table">
                        <tr valign="top">
                            <th scope="row"><?php _e('Domain','pafe'); ?></th>
                            <td>
                                <select name="piotnet-addons-for-elementor-pro-zoho-domain">
                                    <?php foreach($zoho_domains as $zoho){
                                        if($zoho_domain == $zoho){
                                            echo '<option value="'.$zoho.'" selected>'.$zoho.'</option>';
                                        }else{
                                            echo '<option value="'.$zoho.'">'.$zoho.'</option>';
                                        }
                                    }
                                    ?>
                                </select>
                            </td>
                        </tr>
                        <tr valign="top">
                            <th scope="row"><?php _e('Client ID','pafe'); ?></th>
                            <td>
                                <input type="text" name="piotnet-addons-for-elementor-pro-zoho-client-id" value="<?php echo $client_id; ?>" class="regular-text"/>
                                <a target="_blank" href="https://accounts.zoho.com/developerconsole">How to create client id and Screct key</a>
                            </td>
                        </tr>
                        <tr valign="top">
                            <th scope="row"><?php _e('Client Secret','pafe'); ?></th>
                            <td><input type="text" name="piotnet-addons-for-elementor-pro-zoho-client-secret" value="<?php echo $client_secret; ?>" class="regular-text"/></td>
                        </tr>
                        <tr valign="top">
                            <th scope="row"><?php _e('Authorization Redirect URI','pafe'); ?></th>
                            <td><input type="text" name="piotnet-addons-for-elementor-pro-zoho-redirect-url" value="<?php echo $redirect_url; ?>" class="regular-text" readonly/></td>
                        </tr>
                    </table>
                    <div class="piotnet-addons-zoho-admin-api">
                        <?php submit_button(__('Save Settings','pafe')); ?>
                        <?php
                        $scope_module = 'ZohoCRM.modules.all,ZohoCRM.settings.all';
                        $oauth = 'https://'.$zoho_domain.'/oauth/v2/auth?scope='.$scope_module.'&client_id='.$client_id.'&response_type=code&access_type=offline&redirect_uri='.$redirect_url.'';
                        echo '<p class="piotnet-addons-zoho-admin-api-authenticate submit"><a class="button button-primary" href="'.$oauth.'" authenticate-zoho-crm disabled>Authenticate Zoho CRM</a></p>';
                        ?>
                        <?php if(!empty($_REQUEST['code']) && !empty($_REQUEST['accounts-server'])):
                        $url_get_token = 'https://'.$zoho_domain.'/oauth/v2/token?client_id='.$client_id.'&grant_type=authorization_code&client_secret='.$client_secret.'&redirect_uri='.$redirect_url.'&code='.$_REQUEST['code'].'';
                        $zoho_response = wp_remote_post($url_get_token, array());
                        if(!empty($zoho_response['body'])){
                            $zoho_response = json_decode($zoho_response['body']);
                            if(empty($zoho_response->error)){
                                update_option('zoho_access_token', $zoho_response->access_token);
                                update_option('zoho_refresh_token', $zoho_response->refresh_token);
                                update_option('zoho_api_domain', $zoho_response->api_domain);
                                echo "Success";
                            }else{
                                echo $zoho_response->error;
                            }
                        }

                        ?>
                    </div>
                    <script type="text/javascript">
                        window.history.pushState({}, '','<?php echo admin_url('admin.php?page=piotnet-addons-for-elementor'); ?>' );
                    </script>
                <?php endif; ?>
                </form>
            </div>
        </div>
    </div>

<?php endif; ?>


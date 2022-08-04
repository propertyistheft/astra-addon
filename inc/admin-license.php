<div class="pafe-bottom">
    <div class="pafe-bottom__left">
        <h3><?php _e('Tutorials','pafe'); ?></h3>
        <a href="https://pafe.piotnet.com/?wpam_id=1" target="_blank">https://pafe.piotnet.com</a>
        <h3><?php _e('Support','pafe'); ?></h3>
        <a href="mailto:support@piotnet.com">support@piotnet.com</a>
        <h3><?php _e('Version','pafe'); ?></h3>
        <?php
        $pro_version = 'Pro v' . PAFE_PRO_VERSION;
        if (defined('PAFE_VERSION')) {
            $free_version = 'Free v' . constant('PAFE_VERSION');
            echo "$free_version - $pro_version";
        } else {
            echo $pro_version;
        }
        ?>
    </div>
    <div class="pafe-bottom__right">
        <div class="pafe-license">
            <h3><?php _e('License','pafe'); ?></h3>
            <div class="pafe-license__description">
                <?php
                if (!empty($message)) {
                    ?>
                    <div class="pafe-license__description">Status: <?php echo $message; ?></div>
                    <?php
                }
                ?>
            </div>

            <?php if (!$has_key) {
                $home_url = urlencode( get_option( 'home' ) );
                $active_nonce = wp_create_nonce('active_nonce');
                $redirect_url =  urlencode( get_admin_url(null, "admin.php?page=piotnet-addons-for-elementor&action=active_license&nonce=$active_nonce") );
                $active_url = PAFE_License_Service::HOMEPAGE_URL . "/dashboard/active/?type=2&pluginId=1&v=" . PAFE_PRO_VERSION ."&h={$home_url}&r={$redirect_url}";
            ?>
                <?php _e('Please activate your license to enable all features and receive new updates.','pafe'); ?>
                <br>
                <br>
                <a class="pafe-header__button pafe-header__button--gradient" href="<?php echo $active_url;?>" target="_blank"><?php _e('Activate','pafe'); ?></a>
                <?php
            }

            if ($has_key) {
                $license_status = isset($license_data['status']) ? $license_data['status'] : "INVALID";
                $license_display_name = isset($license_data['displayName']) ? $license_data['displayName'] : 'Noname';

                if ($license_status == "VALID" && isset($license_data['expiredAt'])) {
                    if ($license_data['expiredAt'] === false) {
                        $license_status = "CAN'T GET THE EXPIRED DATE";
                    } else if (new DateTime() > $license_data['expiredAt']) {
                        $license_status = 'EXPIRED';
                    }
                }

                if ($license_status == "VALID") {
                    $status_html = '<strong><a style="color:green">' . $license_status . '</a></strong>';
                } else {
                    $license_status = str_replace("_", " ", $license_status);
                    $status_html = '<strong><a style="color:red">' . $license_status . '</a></strong>';
                }
                ?>
                <div class="pafe-license__description">
                    License status: <?php echo $status_html; ?></strong><br>
                    Connected as: <div class="pafe-tooltip">
                        <strong><?php echo $license_display_name; ?></strong>
                        <span class="pafe-tooltiptext">You can change display name in <strong>Manage Licenses</strong></span>
                    </div>
                    <br>
                </div>
                <a class="button button-secondary" href="<?php echo PAFE_License_Service::HOMEPAGE_URL . '/dashboard/licenses'?>" target="_blank"><?php _e('Manage licenses','pafe'); ?></a>
                <form method="post" action="#">
                    <input type="hidden" name="action" value="remove_license">
                    <p class="submit">
                        <input type="submit" name="submit" id="submit" class="button button-primary" value="Remove license">
                    </p>
                    <br>
                </form>
            <?php
            }?>
        </div>
    </div>
</div>
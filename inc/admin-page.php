<?php
if ( ! empty( $_GET['action'] ) && $_GET['action'] == 'active_license' && ! empty( $_GET['siteKey'] ) && ! empty( $_GET['licenseKey'] ) ) {
    if (isset($_GET['nonce']) && wp_verify_nonce( $_GET['nonce'], "active_nonce" )) {
        PAFE_License_Service::set_key( $_GET['siteKey'], $_GET['licenseKey'] );
        $share_data = isset($_GET['shareData']) && $_GET['shareData'] == 'yes';
        PAFE_License_Service::set_share_data($share_data ? 'yes' : 'no');
        PAFE_License_Service::clean_get_info_cache();
    }
    echo '<meta http-equiv="refresh" content="0; url=' . get_admin_url(null,'admin.php?page=piotnet-addons-for-elementor') . '" />';
    return;
}

$has_key = PAFE_License_Service::has_key();
$message = '';

if (isset($_POST['action']) && $_POST['action'] == 'remove_license'){
    if ($has_key) {
        $res = PAFE_License_Service::remove_license();
        if (isset($res['data']) && isset($res['data']['status']) && $res['data']['status'] == "S") {
            $message = "Deactivate license successfully.";
        }
    }
    PAFE_License_Service::clear_license_data();
    PAFE_License_Service::clear_key();
    $has_key = false;
}

$license_data = PAFE_License_Service::get_license_data(true);

if (isset($license_data) && isset($license_data['error'])) {
    $license_error = $license_data['error'];
    $res_msg = isset($license_error['message']) ? $license_error['message'] : 'Unknown message';
    $res_code = isset($license_error['code']) ? $license_error['code'] : '9999';
    $message = "$res_msg [$res_code]";
}

$license_data = PAFE_License_Service::get_license_data();
$has_valid_license = PAFE_License_Service::has_valid_license();

?>
<div class="wrap">
	<div class="pafe-header">
		<div class="pafe-header__left">
			<div class="pafe-header__logo">
				<img src="<?php echo plugin_dir_url( __FILE__ ) . '../assets/images/piotnet-logo.png'; ?>" alt="">
			</div>
			<h2 class="pafe-header__headline"><?php _e('Piotnet Addons For Elementor Settings (PAFE PRO)','pafe'); ?></h2>
		</div>
		<div class="pafe-header__right">
            <a class="pafe-header__button pafe-header__button--gradient" href="https://pafe.piotnet.com/?wpam_id=1" target="_blank"><?php if( !$has_valid_license ) { _e('GO PRO NOW','pafe'); } else { _e('GO TO PAFE','pafe'); } ?></a>
		</div>
	</div>
	<div class="pafe-wrap">
        <?php require_once "admin-license.php"; ?>
		<hr>
        <?php require_once "admin-features.php"; ?>
        <?php require_once "admin-settings.php"; ?>
	</div>
</div>

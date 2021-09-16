<?php
/**
 * White Lable Form
 *
 * @package Astra Addon
 */

?>

<form method="post" class="wrap ast-clear" action="" >
<div class="wrap ast-addon-wrap ast-clear ast-container">
	<input type="hidden" name="action" value="ast_save_general_settings">
	<h1 class="screen-reader-text"><?php esc_html_e( 'White Label', 'astra-addon' ); ?></h1>

	<?php
		// Settings update message.
	if ( isset( $_REQUEST['message'] ) && ( 'saved' == $_REQUEST['message'] || 'saved_ext' == $_REQUEST['message'] ) ) { // phpcs:ignore WordPress.Security.NonceVerification.Recommended
		?>
			<span id="message" class="notice notice-success is-dismissive astra-notice"><p> <?php esc_html_e( 'Settings saved successfully.', 'astra-addon' ); ?> </p></span>
			<?php
	}
	?>

	<div id="poststuff">
		<div id="post-body" class="columns-2">
			<div id="post-body-content">

				<div class="notice ast-white-label-notice"><p><span class="dashicons dashicons-info"></span><?php esc_html_e( 'White Label removes any links to Astra website and change the identity in the dashboard. This setting is mostly used by agencies and developers who are building websites for clients.', 'astra-addon' ); ?></p></div>

				<ul class="ast-branding-list">
					<li>
						<div class="branding-form postbox">
							<h2 class="hndle ast-normal-cusror ui-sortable-handle">
								<span><?php esc_html_e( 'Agency Details', 'astra-addon' ); ?></span>
							</h2>

							<div class="inside">
								<div class="form-wrap">
									<div class="form-field">
										<label for="ast-wl-agency-author"><?php esc_html_e( 'Agency Author:', 'astra-addon' ); ?></label>
										<input type="text" 
											name="ast_white_label[astra-agency][author]" 
											id="ast-wl-agency-author" 
											class="placeholder placeholder-active" 
											<?php disabled( defined( Astra_Ext_White_Label_Markup::branding_key_to_constant( 'astra-agency', 'author' ) ), true, true ); ?> 
											<?php echo 'value="' . esc_attr( Astra_Ext_White_Label_Markup::get_whitelabel_string( 'astra-agency', 'author' ) ) . '"'; ?>
										>
									</div>
									<div class="form-field">
										<label for="ast-wl-agency-author-url"><?php esc_html_e( 'Agency Author URL:', 'astra-addon' ); ?></label>
										<input type="url" 
											name="ast_white_label[astra-agency][author_url]" 
											id="ast-wl-agency-author-url" 
											class="placeholder placeholder-active" 
											<?php disabled( defined( Astra_Ext_White_Label_Markup::branding_key_to_constant( 'astra-agency', 'author_url' ) ), true, true ); ?> 
											<?php echo 'value="' . esc_url( Astra_Ext_White_Label_Markup::get_whitelabel_string( 'astra-agency', 'author_url' ) ) . '"'; ?>
										>
									</div>
									<div class="form-field">
										<label for="ast-wl-agency-lic"><?php esc_html_e( 'Agency Licence Link:', 'astra-addon' ); ?></label>
										<input type="url" 
											name="ast_white_label[astra-agency][licence]" 
											id="ast-wl-agency-lic" 
											class="placeholder placeholder-active" 
											<?php disabled( defined( Astra_Ext_White_Label_Markup::branding_key_to_constant( 'astra-agency', 'licence' ) ), true, true ); ?> 
											<?php echo 'value="' . esc_url( Astra_Ext_White_Label_Markup::get_whitelabel_string( 'astra-agency', 'licence' ) ) . '"'; ?>
										>
										<p class="description"><?php esc_html_e( 'Get license link will be displayed in the license form when the purchase key is expired / not valid.', 'astra-addon' ); ?></p>
									</div>
									<div class="clear"></div>
								</div>
							</div>
						</div>
					</li>
					<li>
						<div class="branding-form postbox">
							<h2 class="hndle ast-normal-cusror ui-sortable-handle">
								<span><?php esc_html_e( 'Astra Theme Branding', 'astra-addon' ); ?></span>
							</h2>
							<div class="inside">
								<div class="form-wrap">
									<div class="form-field">
										<label for="ast-wl-theme-name"><?php esc_html_e( 'Theme Name:', 'astra-addon' ); ?></label>
										<input type="text" 
											name="ast_white_label[astra][name]" 
											id="ast-wl-theme-name" 
											class="placeholder placeholder-active" 
											<?php disabled( defined( Astra_Ext_White_Label_Markup::branding_key_to_constant( 'astra', 'name' ) ), true, true ); ?> 
											<?php echo 'value="' . esc_attr( Astra_Ext_White_Label_Markup::get_whitelabel_string( 'astra', 'name' ) ) . '"'; ?>
										>
									</div>
									<div class="form-field">
										<label for="ast-wl-theme-desc"><?php esc_html_e( 'Theme Description:', 'astra-addon' ); ?></label>
										<textarea name="ast_white_label[astra][description]" 
											id="ast-wl-theme-desc" 
											<?php disabled( defined( Astra_Ext_White_Label_Markup::branding_key_to_constant( 'astra', 'description' ) ), true, true ); ?>
											class="placeholder placeholder-active" 
											rows="3"><?php echo esc_attr( Astra_Ext_White_Label_Markup::get_whitelabel_string( 'astra', 'description' ) ); ?></textarea>
									</div>
									<div class="form-field">
										<label for="ast-wl-theme-screenshot"><?php esc_html_e( 'Theme Screenshot URL:', 'astra-addon' ); ?>
											<i class="ast-white-label-help dashicons dashicons-editor-help" title="<?php echo esc_attr__( 'The recommended image size is 1200px wide by 900px tall.', 'astra-addon' ); ?>"></i>
										</label>
										<input type="url" 
											name="ast_white_label[astra][screenshot]" 
											id="ast-wl-theme-screenshot" 
											class="placeholder placeholder-active" 
											<?php disabled( defined( Astra_Ext_White_Label_Markup::branding_key_to_constant( 'astra', 'screenshot' ) ), true, true ); ?>
											<?php echo 'value="' . esc_url( Astra_Ext_White_Label_Markup::get_whitelabel_string( 'astra', 'screenshot' ) ) . '"'; ?>
										>
									</div>
									<div class="clear"></div>
								</div>
							</div>
						</div>
					</li>
					<li>
						<div class="branding-form postbox">
							<h2 class="hndle ast-normal-cusror ui-sortable-handle">
								<span><?php esc_html_e( 'Astra Pro Branding', 'astra-addon' ); ?></span>
							</h2>

							<div class="inside">
								<div class="form-wrap">
									<div class="form-field">
										<label for="ast-wl-plugin-name"><?php esc_html_e( 'Plugin Name:', 'astra-addon' ); ?></label>
										<input type="text" 
											name="ast_white_label[astra-pro][name]" 
											id="ast-wl-plugin-name" 
											class="placeholder placeholder-active" 
											<?php disabled( defined( Astra_Ext_White_Label_Markup::branding_key_to_constant( 'astra-pro', 'name' ) ), true, true ); ?>
											<?php echo 'value="' . esc_attr( Astra_Ext_White_Label_Markup::get_whitelabel_string( 'astra-pro', 'name' ) ) . '"'; ?>
										>
									</div>
									<div class="form-field">
										<label for="ast-wl-plugin-desc"><?php esc_html_e( 'Plugin Description:', 'astra-addon' ); ?></label>
										<textarea 
											name="ast_white_label[astra-pro][description]" 
											id="ast-wl-plugin-desc" class="placeholder placeholder-active" 
											<?php disabled( defined( Astra_Ext_White_Label_Markup::branding_key_to_constant( 'astra-pro', 'description' ) ), true, true ); ?>
											rows="2"><?php echo esc_attr( Astra_Ext_White_Label_Markup::get_whitelabel_string( 'astra-pro', 'description' ) ); ?></textarea>
									</div>
									<div class="clear"></div>
								</div>
							</div>
						</div>
					</li>
					<?php
					// Add form for white label with <li> element.
					do_action( 'astra_pro_white_label_add_form', Astra_Ext_White_Label_Markup::get_white_labels() );
					?>
				</ul>
			</div>
			<div class="postbox-container" id="postbox-container-1">
				<div id="side-sortables">
					<div class="postbox ast-enable-white-label-wrapper">
						<h2 class="hndle ast-normal-cusror"><span><?php esc_html_e( 'Enable White Label', 'astra-addon' ); ?></span>
						</h2>
						<div class="inside">
							<div class="form-wrap">
								<div class="form-field">
									<label for="ast-wl-hide-branding">
										<input type="checkbox" id="ast-wl-hide-branding" name="ast_white_label[astra-agency][hide_branding]" value="1" <?php checked( Astra_Ext_White_Label_Markup::get_whitelabel_string( 'astra-agency', 'hide_branding' ), '1' ); ?>>
										<?php esc_html_e( 'Enable White Label', 'astra-addon' ); ?>
									</label>
									<div class="ast-white-label-desc-wrap" style="display: none;">
										<p class="admin-help"><?php esc_attr_e( 'You\'re about to enable the white label. This will remove the white label settings.', 'astra-addon' ); ?></p>
										<p class="admin-help"><?php esc_attr_e( 'If you want to access while label settings in future, simply deactivate the Astra Pro plugin and activate it again.', 'astra-addon' ); ?></p>
										<?php
										$astra_support_link = astra_get_pro_url( 'https://wpastra.com/docs/how-to-white-label-astra/', 'astra-dashboard', 'white-label', 'welcome-page' );
										?>

										<a href="<?php echo esc_url( $astra_support_link ); ?>" target="_blank" rel="noopener"><?php esc_html_e( 'Read More', 'astra-addon' ); ?></a>
									</div>
								</div>
							</div>

							<?php submit_button( __( 'Save Changes', 'astra-addon' ), 'ast-white-label-save-btn button-primary button button-hero' ); ?>
							<?php if ( is_multisite() ) : ?>
								<p class="install-help"><strong><?php esc_html_e( 'Note:', 'astra-addon' ); ?></strong>  <?php esc_html_e( 'Whitelabel settings are applied to all the sites in the Network.', 'astra-addon' ); ?></p>
							<?php endif; ?>
							<?php wp_nonce_field( 'white-label', 'ast-white-label-nonce' ); ?>
						</div>
					</div>

				</div>
			</div>
		</div>
		<!-- /post-body -->
		<br class="clear">
	</div>
</div>
</form>

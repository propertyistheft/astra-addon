<?php
/**
 * Header Account Markup
 *
 * @package Astra Addon
 */

if ( ! class_exists( 'Astra_Addon_Header_Account_Markup' ) ) {

	/**
	 * Header Account Markup Initial Setup
	 *
	 * @since 4.3.1
	 */
	class Astra_Addon_Header_Account_Markup {
		/**
		 * Member Variable
		 *
		 * @var object instance
		 */
		private static $instance;

		/**
		 *  Initiator
		 */
		public static function get_instance() {
			if ( ! isset( self::$instance ) ) {
				self::$instance = new self();
			}
			return self::$instance;
		}

		/**
		 * Constructor
		 */
		public function __construct() {
			add_filter( 'astra_addon_js_localize', array( $this, 'localize_variables' ) );
			add_action( 'astra_footer', array( $this, 'login_popup_form_markup' ) );
		}

		/**
		 * Add Localize variables
		 *
		 * @since 4.3.1
		 * @param  array $localize_vars Localize variables array.
		 * @return array
		 */
		public function localize_variables( $localize_vars ) {

			$localize_vars['hf_account_show_menu_on'] = astra_get_option( 'header-account-action-menu-display-on' );
			$localize_vars['hf_account_action_type']  = astra_get_option( 'header-account-action-type' );

			return $localize_vars;
		}

		/**
		 * Markup method for the header account login popup form. Splitted from Astra_Builder_UI_Controller::render_account().
		 *
		 * @since 4.6.5
		 * @return void
		 */
		public function login_popup_form_markup() {

			if ( 'login' !== astra_get_option( 'header-account-logout-action' ) ) {
				return;
			}

			$show_lost_password = astra_get_option( 'header-account-login-lostpass' );
			$show_register      = ( get_option( 'users_can_register' ) && astra_get_option( 'header-account-login-register' ) );

			?>
			<div id="ast-hb-account-login-wrap" class="ast-hb-account-login-wrapper">
				<div class="ast-hb-account-login-bg"></div>
				<div class="ast-hb-account-login">
					<div class="ast-hb-login-header">
						<button id="ast-hb-login-close" class="ast-hb-login-close" aria-label="<?php esc_attr_e( 'Close popup', 'astra-addon' ); ?>">
							<span class="ast-svg-iconset">
								<?php
								if ( is_callable( 'Astra_Builder_UI_Controller', 'fetch_svg_icon' ) ) {
									echo Astra_Builder_UI_Controller::fetch_svg_icon( 'close' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
								}
								?>
							</span>
						</button>
					</div>
					<div class="ast-hb-login-body">
						<div class="ast-hb-account-login-form">
							<?php
							wp_login_form(
								array(
									'echo'           => true,
									'remember'       => true,
									'value_remember' => true,
								)
							);
							?>
						</div>

						<?php if ( $show_register || $show_lost_password ) { ?>
							<div class="ast-hb-account-login-form-footer">
								<?php
								if ( $show_register ) {
									$register_url = wp_registration_url();
									?>
									<a class="ast-header-account-footer-link" href="<?php echo esc_url( $register_url ); ?>" >
										<span class="ast-header-account-register"><?php echo esc_html( __( 'Register', 'astra-addon' ) ); ?></span>
									</a>
									<?php
								}

								if ( $show_lost_password ) {
									$lostpass_url = wp_lostpassword_url();
									?>
									<a class="ast-header-account-footer-link" href="<?php echo esc_url( $lostpass_url ); ?>" >
										<span class="ast-header-account-lostpass"><?php echo esc_html( __( 'Lost your password?', 'astra-addon' ) ); ?></span>
									</a>
									<?php
								}
								?>
							</div>
						<?php } ?>
					</div>
				</div>
			</div>
			<?php
		}
	}
}

/**
 *  Kicking this off by calling 'get_instance()' method
 */
Astra_Addon_Header_Account_Markup::get_instance();

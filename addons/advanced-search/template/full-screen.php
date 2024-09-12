<?php
/**
 * Advanced Search - Full Screen Template
 *
 * @package Astra Addon
 */

?>
<div class="ast-search-box full-screen ast-full-search-style--<?php echo esc_attr( astra_get_option( 'fullsearch-modal-color-mode', 'dark' ) ); ?>" id="ast-seach-full-screen-form">
<span id="close" class="close" tabindex="3"><?php Astra_Icons::get_icons( 'close', true ); ?></span>
	<div class="ast-search-wrapper">
		<div class="ast-container">
			<?php
			$heading_tag = apply_filters( 'astra_fullscreen_modal_heading_tag', 'h3' );
			if ( astra_get_option( 'full-screen-modal-heading', true ) ) {
				echo '<' . esc_attr( $heading_tag ) . ' class="large-search-text">' . esc_html( astra_get_option( 'fullscreen-modal-heading-text' ) ) . '</' . esc_attr( $heading_tag ) . '>';
			}
			?>
			<form class="search-form" action="<?php echo esc_url( home_url() ); ?>/" method="get">
				<fieldset>
					<span class="text">
						<label for="search-field" class="screen-reader-text"><?php echo esc_html( astra_default_strings( 'string-full-width-search-placeholder', false ) ); ?></label>
						<input id="search-field" name="s" class="search-field" autocomplete="off" type="text" value="" placeholder="<?php echo esc_attr( astra_default_strings( 'string-full-width-search-placeholder', false ) ); ?>" tabindex="1">
					</span>
					<button aria-label="<?php esc_attr_e( 'Search', 'astra-addon' ); ?>" id="search_submit" class="button search-submit" tabindex="2"><i class="astra-search-icon"> <?php Astra_Icons::get_icons( 'search', true ); ?> </i></button>
				</fieldset>
			</form>
		</div>
	</div>
</div>

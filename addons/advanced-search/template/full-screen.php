<?php
/**
 * Advanced Search - Full Screen Template
 *
 * @package Astra Addon
 */

?>
<div class="ast-search-box full-screen" id="ast-seach-full-screen-form">
	<span id="close" class="close"><?php Astra_Icons::get_icons( 'close', true ); ?></span>
	<div class="ast-search-wrapper">
		<div class="ast-container">
			<h3 class="large-search-text"><?php echo esc_html( astra_default_strings( 'string-full-width-search-message', false ) ); ?></h3>
			<form class="search-form" action="<?php echo esc_url( home_url() ); ?>/" method="get">
				<fieldset>
					<span class="text">
						<label for="search-field" class="screen-reader-text"><?php echo esc_html( astra_default_strings( 'string-full-width-search-placeholder', false ) ); ?></label>
						<input id="search-field" name="s" class="search-field" autocomplete="off" type="text" value="" placeholder="<?php echo esc_attr( astra_default_strings( 'string-full-width-search-placeholder', false ) ); ?>">
					</span>
					<button aria-label="<?php esc_attr_e( 'Search', 'astra-addon' ); ?>" class="button search-submit"><i class="astra-search-icon"> <?php Astra_Icons::get_icons( 'search', true ); ?> </i></button>
				</fieldset>
			</form>
		</div>
	</div>
</div>

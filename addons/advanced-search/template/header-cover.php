<?php
/**
 * Advanced Search - Header Cover Template
 *
 * @package Astra Addon
 */

?>
<div class="ast-search-box header-cover" id="ast-search-form">
	<div class="ast-search-wrapper">
		<div class="ast-container">
			<form class="search-form" action="<?php echo esc_url( home_url() ); ?>/" method="get">
				<span class="search-text-wrap">
					<label for="s" class="screen-reader-text"><?php echo esc_html( astra_default_strings( 'string-header-cover-search-placeholder', false ) ); ?></label>
					<input name="s" class="search-field" type="text" autocomplete="off" value="" placeholder="<?php echo esc_attr( astra_default_strings( 'string-header-cover-search-placeholder', false ) ); ?>">
				</span>
				<span id="close" class="close"><?php Astra_Icons::get_icons( 'close', true ); ?></span>
			</form>
		</div>
	</div>
</div>

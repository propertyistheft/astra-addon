<?php
/**
 * The title bar style 1 for our theme.
 *
 * This template generates markup required for the title bar style 1
 *
 * @todo Update this template for Default Advanced Headers Style
 *
 * @package Astra Addon
 */

$show_breadcrumb       = Astra_Ext_Advanced_Headers_Loader::astra_advanced_headers_layout_option( 'breadcrumb' );
$is_breadcrumb_enabled = '';
$ast_adv_title         = apply_filters( 'astra_advanced_header_title', astra_get_the_title() );
$description           = apply_filters( 'astra_advanced_header_description', get_the_archive_description() );

if ( $show_breadcrumb ) {
	$is_breadcrumb_enabled = $show_breadcrumb;
}

?>
<div class="ast-inside-advanced-header-content">
	<div class="ast-advanced-headers-layout ast-advanced-headers-layout-1" >
		<div class="ast-container">
			<div class="ast-advanced-headers-wrap">
				<?php do_action( 'astra_advanced_header_layout_1_wrap_top' ); ?>
				<?php
				if ( $ast_adv_title ) {
					echo sprintf(
						'<%1$s class="ast-advanced-headers-title">
							%2$s
							%3$s
							%4$s
						</%1$s>',
						/**
						 * Filters the tags for Advanced Header Title - Layout 1.
						 *
						 * @since 2.1.3
						 *
						 * @param string $tags string containing the HTML tags for Advanced Header title.
						 */
						esc_html( apply_filters( 'astra_advanced_header_layout_1_title_tag', 'h1' ) ),
						do_action( 'astra_advanced_header_layout_1_before_title' ), // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
						apply_filters( 'astra_advanced_header_layout_1_title', $ast_adv_title ), // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
						do_action( 'astra_advanced_header_layout_1_after_title' ) // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
					);
				}
				do_action( 'astra_advanced_header_layout_1_after_title_tag' );
				if ( $description ) {
					?>
				<div class="taxonomy-description">
					<?php do_action( 'astra_advanced_header_layout_1_before_description' ); ?>
					<?php echo apply_filters( 'astra_advanced_header_layout_1_description', wp_kses_post( $description ) ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
					<?php do_action( 'astra_advanced_header_layout_1_after_description' ); ?>
				</div>
				<?php } ?>

				<?php do_action( 'astra_advanced_header_layout_1_wrap_bottom' ); ?>
			</div>
	<?php if ( $is_breadcrumb_enabled ) { ?>
			<div class="ast-advanced-headers-breadcrumb">
				<?php Astra_Ext_Advanced_Headers_Markup::advanced_headers_breadcrumbs_markup(); ?>
			</div><!-- .ast-advanced-headers-breadcrumb -->
	<?php } ?>
		</div>
	</div>
</div>

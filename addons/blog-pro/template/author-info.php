<?php
/**
 * Author Info.
 *
 * @package     Astra Addon
 * @since       1.0.0
 */

do_action( 'astra_author_info_before' );

$author_box_alignment   = astra_get_option( 'author-box-alignment' );
$author_box_placement   = astra_get_option( 'author-box-placement' );
$author_box_open_target = astra_get_option( 'author-box-in-new-tab' );
$customizer_shortcut    = '';

if ( is_customize_preview() && is_callable( 'Astra_Builder_UI_Controller::render_customizer_edit_button' ) ) {
	ob_start();
	Astra_Builder_UI_Controller::render_customizer_edit_button( 'row-editor-shortcut' );
	$customizer_shortcut = ob_get_clean();
}

/**
 * Filters the Author box on single posts.
 *
 * @since 1.5.0
 *
 * @param string the auhtor box markup on single post.
 */
echo do_shortcode(
	apply_filters(
		'astra_post_author_output',
		sprintf(
			'<div class="%6$s ast-single-author-box ast-author-container--%4$s ast-author-box-position--%5$s" %2$s itemscope itemtype="https://schema.org/Person" %7$s>%8$s %1$s</div>',
			sprintf(
				'<div class="ast-author-meta"> <div class="about-author-title-wrapper"> <%10$s class="about-author">%1$s</%10$s> </div> <div class="ast-author-details"> <div class="post-author-avatar">%2$s</div> <div class="post-author-bio"> <a class="url fn n" href="%3$s" %6$s rel="author" target="%9$s"> <%11$s class="author-title" %7$s>%4$s</%11$s> </a> <div class="post-author-desc">%5$s</div> %8$s </div> </div> </div>',
				esc_html__( 'About The Author', 'astra-addon' ),
				get_avatar( get_the_author_meta( 'email' ), 100 ),
				esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
				esc_html( get_the_author() ),
				wp_kses_post( get_the_author_meta( 'description' ) ),
				astra_attr(
					'author-url-info',
					array(
						'class' => '',
					)
				),
				astra_attr(
					'author-name-info',
					array(
						'class' => '',
					)
				),
				Astra_Ext_Blog_Pro_Markup::get_instance()->astra_render_author_box_sharing(),
				true === $author_box_open_target ? '_blank' : '_self',
				apply_filters( 'astra_addon_author_box_heading_tag', 'h3' ),
				apply_filters( 'astra_addon_author_title_heading_tag', 'h4' )
			),
			astra_attr(
				'author-item-info',
				array(
					'class' => '',
				)
			),
			astra_attr(
				'author-desc-info',
				array(
					'class' => '',
				)
			),
			$author_box_alignment,
			$author_box_placement,
			is_customize_preview() ? 'customizer-item-block-preview customizer-navigate-on-focus' : '',
			is_customize_preview() ? 'data-section="ast-sub-section-author-box" data-type="section"' : '',
			$customizer_shortcut
		)
	)
);

do_action( 'astra_author_info_after' );

<?php
/**
 * Author Info.
 *
 * @package     Astra Addon
 * @since       1.0.0
 */

do_action( 'astra_author_info_before' );

/**
 * Filters the Author box on single posts.
 *
 * @since 1.5.0
 *
 * @param string the auhtor box markup on single post.
 */
echo apply_filters( // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	'astra_post_author_output',
	sprintf(
		'<div class="ast-single-author-box" %2$s itemscope itemtype="https://schema.org/Person">%1$s</div>',
		sprintf(
			'<div class="ast-author-meta"> <div class="about-author-title-wrapper"> <h3 class="about-author">%1$s</h3> </div> <div class="ast-author-details"> <div class="post-author-avatar">%2$s</div> <div class="post-author-bio"> <a class="url fn n" href="%3$s" %6$s rel="author"> <h4 class="author-title" %7$s>%4$s</h4> </a> <div class="post-author-desc">%5$s</div> </div> </div> </div>',
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
			)
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
		)
	)
);

do_action( 'astra_author_info_after' );

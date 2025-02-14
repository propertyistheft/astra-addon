<?php
/**
 * Blog Pro - Blog Layout 2 Template
 *
 * @todo Update this template for Default Blog Style
 *
 * @package Astra Addon
 */

?>
<div <?php astra_blog_layout_class( 'blog-layout-2' ); ?>>

	<div class="post-content <?php echo esc_html( apply_filters( 'astra_attr_ast-grid-col-6_output', 'ast-grid-col-6' ) ); ?>">

		<?php astra_blog_post_thumbnail_and_title_order( array( 'image' ) ); ?>

		<div class="entry-content clear"
		<?php
				echo wp_kses_post(
					astra_attr(
						'article-entry-content-blog-layout-2',
						array(
							'class' => '',
						)
					)
				);
				?>
				>

			<?php astra_entry_content_before(); ?>
			<?php astra_entry_content_after(); ?>

			<?php
				wp_link_pages(
					array(
						'before'      => '<div class="page-links">' . esc_html( astra_default_strings( 'string-blog-page-links-before', false ) ),
						'after'       => '</div>',
						'link_before' => '<span class="page-link">',
						'link_after'  => '</span>',
					)
				);
				?>
		</div><!-- .entry-content .clear -->
	</div><!-- .post-content -->

	<?php $astra_addon_featured_item = apply_filters( 'astra_featured_image_enabled', true ); ?>
	<?php if ( $astra_addon_featured_item ) { ?>
		<?php
		// Blog Post Featured Image.
			astra_get_post_thumbnail( '<div class="ast-blog-featured-section post-thumb ' . esc_html( apply_filters( 'astra_attr_ast-grid-col-6_output', 'ast-grid-col-6' ) ) . '">', '</div>' );
		?>
	<?php } ?>

</div> <!-- .blog-layout-2 -->

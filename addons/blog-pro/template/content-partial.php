<?php
/**
 * Blog Pro partial content template.
 *
 * @package     Astra Addon
 * @author      Brainstorm Force
 * @copyright   Copyright (c) 2020, Brainstorm Force
 * @link        https://www.brainstormforce.com
 * @since       1.0.0
 */

if ( have_posts() ) :

	// Load content before the loop.
	do_action( 'astra_before_content_partial_loop' );

	while ( have_posts() ) :
		the_post();

		get_template_part( 'template-parts/content', 'single' );

		// If comments are open or we have at least one comment, load up the comment template.
		if ( comments_open() || get_comments_number() ) :
			comments_template();
		endif;
	endwhile;

	// Load content after the loop.
	do_action( 'astra_after_content_partial_loop' );

	else :

		// Load content if there are no more posts.
		do_action( 'astra_no_more_posts_content_partial' );

endif; // END if have_posts().

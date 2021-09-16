<?php
/**
 * The template for displaying all single posts.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Astra Addon
 * @since 1.0.0
 */

get_header();

while ( have_posts() ) :
	the_post();
	do_action( 'astra_advanced_hook_template' );
	endwhile;

get_footer();

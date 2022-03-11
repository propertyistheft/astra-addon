<?php
/**
 * Typography - Dynamic CSS
 *
 * @package Astra Addon
 */

add_filter( 'astra_addon_dynamic_css', 'astra_addon_learndash_dynamic_css' );

/**
 * Dynamic CSS
 *
 * @param  string $dynamic_css          Astra Dynamic CSS.
 * @param  string $dynamic_css_filtered Astra Dynamic CSS Filters.
 * @since  1.8.6
 * @return string
 */
function astra_addon_learndash_dynamic_css( $dynamic_css, $dynamic_css_filtered = '' ) {

	$active_theme = '';

	if ( is_callable( 'LearnDash_Theme_Register::get_active_theme_key' ) ) {
		$active_theme = LearnDash_Theme_Register::get_active_theme_key();
	}

	if ( 'ld30' === $active_theme ) {
		return $dynamic_css;
	}

	$border_radius         = astra_get_option( 'learndash-table-border-radius' );
	$heading_color         = astra_get_option( 'learndash-table-heading-color' );
	$heading_bg_color      = astra_get_option( 'learndash-table-heading-bg-color' );
	$title_color           = astra_get_option( 'learndash-table-title-color' );
	$title_bg_color        = astra_get_option( 'learndash-table-title-bg-color' );
	$separator_color       = astra_get_option( 'learndash-table-title-separator-color' );
	$complete_icon_color   = astra_get_option( 'learndash-complete-icon-color' );
	$incomplete_icon_color = astra_get_option( 'learndash-incomplete-icon-color' );

	$table_heading_font_size      = astra_get_option( 'font-size-learndash-table-heading' );
	$table_heading_font_weight    = astra_get_option( 'font-weight-learndash-table-heading' );
	$table_heading_font_family    = astra_get_option( 'font-family-learndash-table-heading' );
	$table_heading_text_transform = astra_get_option( 'text-transform-learndash-table-heading' );

	$table_content_font_size      = astra_get_option( 'font-size-learndash-table-content' );
	$table_content_font_weight    = astra_get_option( 'font-weight-learndash-table-content' );
	$table_content_font_family    = astra_get_option( 'font-family-learndash-table-content' );
	$table_content_text_transform = astra_get_option( 'text-transform-learndash-table-content' );

	$differentiate_row = astra_get_option( 'learndash-differentiate-rows' );

	$css_output = array(
		'body #learndash_lessons #lesson_heading, body #learndash_profile .learndash_profile_heading, body #learndash_quizzes #quiz_heading, body #learndash_lesson_topics_list div > strong, body #learndash_profile .learndash_profile_quiz_heading' => array(
			'color'            => $heading_color,
			'background-color' => $heading_bg_color,
		),
		'body #learndash_lessons a, body #learndash_quizzes a, body .learndash_topic_dots a, body .learndash_topic_dots a > span, body #learndash_lesson_topics_list span a, body #learndash_profile a, body #learndash_profile a span, #lessons_list .list-count, #quiz_list .list-count, #learndash_profile .list_arrow.collapse' => array(
			'color' => $title_color,
		),
		'body #course_list > div, body #lessons_list > div, body #quiz_list > div, body #learndash_lesson_topics_list .learndash_topic_dots ul > li' => array(
			'background-color' => $title_bg_color,
		),
		'body #course_list > div:nth-of-type(odd), body #lessons_list > div:nth-of-type(odd), body #quiz_list > div:nth-of-type(odd), body #learndash_lesson_topics_list .learndash_topic_dots ul > li.nth-of-type-odd' => array(
			'background-color' => ( $differentiate_row && ! empty( $title_bg_color ) ) ? astra_hex_to_rgba( $title_bg_color, .8 ) : $title_bg_color,
		),
		'body #learndash_lessons #quiz_list, body #learndash_lessons .lessons_list, body #learndash_quizzes #quiz_list, body #learndash_quizzes .lessons_list, #lessons_list > div h4, #course_list > div h4, #quiz_list > div h4, #learndash_lesson_topics_list ul > li > span.topic_item, #lessons_list > div > div, #course_list > div > div, #quiz_list > div > div, .single-sfwd-lessons #learndash_lesson_topics_list ul > li > span.sn, .singular-sfwd-lessons #learndash_lesson_topics_list ul > li > span.sn, body #learndash_profile .profile_info, body #learndash_profile #course_list, body #learndash_lesson_topics_list .learndash_topic_dots .topic-completed, body #learndash_lesson_topics_list .learndash_topic_dots .topic-notcompleted, body #learndash_lesson_topics_list div > strong' => array(
			'border-color' => $separator_color,
		),
		'.learndash .completed:before, #learndash_profile .completed:before, .learndash_topic_dots ul .topic-completed span:before, .learndash_navigation_lesson_topics_list .topic-completed span:before, .learndash_navigation_lesson_topics_list ul .topic-completed span:before, .learndash .topic-completed span:before, body .list_arrow.lesson_completed:before' => array(
			'color' => $complete_icon_color,
		),
		'.learndash .notcompleted:before, #learndash_profile .notcompleted:before, .learndash_topic_dots ul .topic-notcompleted span:before, .learndash_navigation_lesson_topics_list .topic-notcompleted span:before, .learndash_navigation_lesson_topics_list ul .topic-notcompleted span:before, .learndash .topic-notcompleted span:before, body .list_arrow.lesson_incomplete:before' => array(
			'color' => $incomplete_icon_color,
		),
		/**
		 * Table Heading
		 */
		'body #learndash_lessons #lesson_heading, body #learndash_profile .learndash_profile_heading, body #learndash_quizzes #quiz_heading, body #learndash_lesson_topics_list div > strong' => array(
			'font-size'      => astra_responsive_font( $table_heading_font_size, 'desktop' ),
			'font-weight'    => astra_get_css_value( $table_heading_font_weight, 'font' ),
			'font-family'    => astra_get_css_value( $table_heading_font_family, 'font' ),
			'text-transform' => esc_attr( $table_heading_text_transform ),
		),

		/**
		 * Table Content
		 */
		'body #learndash_lessons #quiz_list, body #learndash_lessons .lessons_list, body #learndash_quizzes #quiz_list, body #learndash_quizzes .lessons_list, body #learndash_lesson_topics_list .learndash_topic_dots ul, body #learndash_profile .profile_info, body #learndash_profile #course_list, #learndash_lessons a, #learndash_quizzes a, .learndash_topic_dots a, .learndash_topic_dots a > span, #learndash_lesson_topics_list span a, #learndash_profile a, #learndash_profile a span' => array(
			'font-size'      => astra_responsive_font( $table_content_font_size, 'desktop' ),
			'font-weight'    => astra_get_css_value( $table_content_font_weight, 'font' ),
			'text-transform' => esc_attr( $table_content_text_transform ),
		),
		'body #learndash_lessons #quiz_list, body #learndash_lessons .lessons_list, body #learndash_quizzes #quiz_list, body #learndash_quizzes .lessons_list, body #learndash_lesson_topics_list .learndash_topic_dots ul, body #learndash_profile .profile_info, body #learndash_profile #course_list, body #learndash_lessons a, body #learndash_quizzes a, .learndash_topic_dots a, .learndash_topic_dots a > span, #learndash_lesson_topics_list span a, #learndash_profile a, #learndash_profile a span, body #learndash_profile a, body #learndash_profile .learndash_profile_heading.course_overview_heading, body #learndash_profile #course_list .flip > div .right, body .learndash_topic_dots a > span' => array(
			'font-family' => astra_get_css_value( $table_content_font_family, 'font' ),
		),
	);

	/* Parse CSS from array() */
	$css_output = astra_parse_css( $css_output );

	$tablet_css = array(
		'body #learndash_lessons #lesson_heading, body #learndash_profile .learndash_profile_heading, body #learndash_quizzes #quiz_heading, body #learndash_lesson_topics_list div > strong' => array(
			'font-size' => astra_responsive_font( $table_heading_font_size, 'tablet' ),
		),
		'body #learndash_lessons #quiz_list, body #learndash_lessons .lessons_list, body #learndash_quizzes #quiz_list, body #learndash_quizzes .lessons_list, body #learndash_lesson_topics_list .learndash_topic_dots ul, body #learndash_profile .profile_info, body #learndash_profile #course_list, #learndash_lessons a, #learndash_quizzes a, .expand_collapse a, .learndash_topic_dots a, .learndash_topic_dots a > span, #learndash_lesson_topics_list span a, #learndash_profile a, #learndash_profile a span' => array(
			'font-size' => astra_responsive_font( $table_content_font_size, 'tablet' ),
		),
	);

	/* Parse CSS from array() */
	$css_output .= astra_parse_css( $tablet_css, '', astra_addon_get_tablet_breakpoint() );

	$mobile_css = array(
		'body #learndash_lessons #lesson_heading, body #learndash_profile .learndash_profile_heading, body #learndash_quizzes #quiz_heading, body #learndash_lesson_topics_list div > strong' => array(
			'font-size' => astra_responsive_font( $table_heading_font_size, 'mobile' ),
		),
		'body #learndash_lessons #quiz_list, body #learndash_lessons .lessons_list, body #learndash_quizzes #quiz_list, body #learndash_quizzes .lessons_list, body #learndash_lesson_topics_list .learndash_topic_dots ul, body #learndash_profile .profile_info, body #learndash_profile #course_list, #learndash_lessons a, #learndash_quizzes a, .expand_collapse a, .learndash_topic_dots a, .learndash_topic_dots a > span, #learndash_lesson_topics_list span a, #learndash_profile a, #learndash_profile a span' => array(
			'font-size' => astra_responsive_font( $table_content_font_size, 'mobile' ),
		),
	);

	/* Parse CSS from array() */
	$css_output .= astra_parse_css( $mobile_css, '', astra_addon_get_mobile_breakpoint() );

	if ( $border_radius ) {

		$css_border_radius = array();

		$css_border_radius['body #learndash_lessons #lesson_heading, body #learndash_profile .learndash_profile_heading, body #learndash_quizzes #quiz_heading, body #learndash_lesson_topics_list div > strong'] = array(
			'border-top-left-radius'  => astra_get_css_value( $border_radius, 'px' ),
			'border-top-right-radius' => astra_get_css_value( $border_radius, 'px' ),
		);

		$css_border_radius['body #learndash_lessons #quiz_list, body #learndash_lessons .lessons_list, body #learndash_quizzes #quiz_list, body #learndash_quizzes .lessons_list, body #learndash_lesson_topics_list .learndash_topic_dots ul, body #learndash_profile .profile_info, body #learndash_profile #course_list, #learndash_lessons a, #learndash_quizzes a, .expand_collapse a, .learndash_topic_dots li:last-child a, .learndash_topic_dots a > span, #learndash_lesson_topics_list li:last-child span a, #learndash_profile a, #learndash_profile a span'] = array(
			'border-bottom-left-radius'  => astra_get_css_value( $border_radius, 'px' ),
			'border-bottom-right-radius' => astra_get_css_value( $border_radius, 'px' ),
		);
		$css_output .= astra_parse_css( $css_border_radius );
	}

	return $dynamic_css . $css_output;
}

/**
 * Dynamic CSS generation for learndash version 3
 *
 * @return string
 */
function astra_addon_ldrv3_dynamic_css() {

	$active_ld_theme = '';
	$css_output      = '';

	if ( is_callable( 'LearnDash_Theme_Register::get_active_theme_key' ) ) {
		$active_ld_theme = LearnDash_Theme_Register::get_active_theme_key();
	}

	if ( 'ld30' !== $active_ld_theme ) {
		return '';
	}

	$ld_overwrite_colors = astra_get_option( 'learndash-overwrite-colors' );
	$ld_progress_color   = astra_get_option( 'learndash-course-progress-color' );

	if ( $ld_overwrite_colors ) {

		$css_output = array(
			'.learndash-wrapper .ld-secondary-color'      => array(
				'color' => esc_attr( $ld_progress_color ) . ' !important',
			),
			'.learndash-wrapper .ld-secondary-background' => array(
				'background-color' => esc_attr( $ld_progress_color ) . ' !important',
			),
		);

		$css_output = astra_parse_css( $css_output );
	}

	// Learndash post types.
	$post_types = array(
		'sfwd-courses',
		'sfwd-lessons',
		'sfwd-topic',
		'sfwd-quiz',
	);

	// Bail if not Learndash page rendering.
	if ( ! in_array( get_post_type(), $post_types ) ) {
		return $css_output;
	}

	if ( $ld_overwrite_colors ) {

		$ld_link_color           = astra_get_option( 'learndash-course-link-color' );
		$ld_highlight_text_color = astra_get_option( 'learndash-course-highlight-text-color' );
		$ld_highlight_color      = astra_get_option( 'learndash-course-highlight-color' );

		$css_style_output = array(

			'.learndash-wrapper .ld-item-list .ld-item-list-item .ld-item-name, .learndash-wrapper .ld-table-list a.ld-table-list-item-preview, .learndash-wrapper .ld-course-navigation .ld-lesson-item-preview a.ld-lesson-item-preview-heading' => array(
				'color' => esc_attr( $ld_link_color ),
			),
			'.learndash-wrapper .ld-table-list .ld-table-list-header, .learndash-wrapper .ld-item-list-actions .ld-expand-button, .learndash-wrapper .ld-focus .ld-focus-sidebar .ld-course-navigation-heading h3 a,.learndash-wrapper .ld-course-status .ld-status.ld-status-complete, .learndash-wrapper .ld-button, .learndash-wrapper .ld-breadcrumbs .ld-status.ld-status-complete, .learndash-wrapper .ld-focus-header .ld-user-menu .ld-user-menu-items a, #learndash-tooltips .ld-tooltip, .learndash-wrapper .ld-tertiary-background, .learndash-wrapper .btn-join, .learndash-wrapper #btn-join, .learndash-wrapper .learndash_mark_complete_button, .learndash-wrapper .ld-primary-background.ld-status' => array(
				'color' => esc_attr( $ld_highlight_text_color ) . ' !important',
			),
			'.learndash-wrapper .ld-topic-list.ld-table-list .ld-table-list-lesson-details .ld-lesson-list-progress' => array(
				'border-color' => esc_attr( $ld_highlight_text_color ),
			),
			'.learndash-wrapper .ld-primary-background,.learndash-wrapper .ld-focus .ld-focus-sidebar .ld-course-navigation-heading, .learndash-wrapper .ld-focus .ld-focus-sidebar .ld-focus-sidebar-trigger, .learndash-wrapper .ld-expand-button.ld-button-alternate .ld-icon, .learndash-wrapper .ld-button:not(.ld-js-register-account):not(.learndash-link-previous-incomplete):not(.ld-button-transparent), .learndash-wrapper .ld-focus .ld-focus-header .ld-user-menu .ld-user-menu-items a, #learndash-tooltips .ld-tooltip, #learndash-tooltips .ld-tooltip:after, .learndash-wrapper .btn-join, .learndash-wrapper #btn-join, .learndash-wrapper .wpProQuiz_content .wpProQuiz_button, .learndash-wrapper .wpProQuiz_content a#quiz_continue_link' => array(
				'background-color' => esc_attr( $ld_highlight_color ) . ' !important',
			),
			'.learndash-wrapper .ld-primary-color, .learndash-wrapper .ld-item-list .ld-item-list-item a.ld-item-name:hover, .learndash-wrapper .ld-primary-color, .learndash-wrapper .ld-breadcrumbs a,.learndash-wrapper .ld-button.ld-button-transparent, .learndash-wrapper .ld-lesson-item.ld-is-current-lesson .ld-lesson-title, .learndash-wrapper .ld-primary-color-hover:hover, .learndash-wrapper .ld-table-list a.ld-table-list-item-preview .ld-primary-color-hover:hover' => array(
				'color' => esc_attr( $ld_highlight_color ) . ' !important',
			),
			' .learndash-wrapper .wpProQuiz_content .wpProQuiz_questionListItem label:focus-within' => array(
				'border-color' => esc_attr( $ld_highlight_color ),
			),
			'.learndash-wrapper #quiz_continue_link, .learndash-wrapper .ld-secondary-background, .learndash-wrapper .learndash_mark_complete_button,  .learndash-wrapper #learndash_mark_complete_button, .learndash-wrapper .ld-status-complete, .learndash-wrapper .ld-alert-success .ld-button, .learndash-wrapper .ld-alert-success .ld-alert-icon, .learndash-wrapper .course_progress .sending_progress_bar' => array(
				'background-color' => esc_attr( $ld_progress_color ) . ' !important',
			),
			'.learndash-wrapper .ld-secondary-color, .learndash-wrapper .ld-focus .ld-focus-header .sfwd-mark-complete .learndash_mark_complete_button, .learndash-wrapper .ld-focus .ld-focus-header .sfwd-mark-complete:after' => array(
				'color' => esc_attr( $ld_progress_color ) . ' !important',
			),
			'.learndash-wrapper .ld-focus .ld-focus-header .ld-user-menu .ld-user-menu-items:before' => array(
				'border-bottom-color' => esc_attr( $ld_highlight_color ) . ' !important',
			),
		);

		$css_output .= astra_parse_css( $css_style_output );
		$login_model = 'no';

		if ( is_callable( 'LearnDash_Settings_Section::get_section_setting' ) ) {
			$login_model = LearnDash_Settings_Section::get_section_setting( 'LearnDash_Settings_Theme_LD30', 'login_mode_enabled' );
		}

		if ( 'yes' === $login_model ) {

			$login_model_style = array(
				".learndash-wrapper .ld-login-modal .ld-login-modal-register, .learndash-wrapper .ld-login-modal input[type='submit'], .learndash-wrapper .ld-button:hover:not(.learndash-link-previous-incomplete):not(.ld-button-transparent)" => array(
					'background-color' => esc_attr( $ld_highlight_color ) . ' !important',
				),
				'.learndash-wrapper .ld-login-modal .ld-login-modal-login .ld-modal-heading, .learndash-wrapper .ld-button.ld-button-reverse' => array(
					'color' => esc_attr( $ld_highlight_color ) . ' !important',
				),
			);

			$css_output .= astra_parse_css( $login_model_style );

		}
	}

	return $css_output;
}


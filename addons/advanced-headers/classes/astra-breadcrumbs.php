<?php
/**
 * Breadcrumnbs
 *
 * @package Astra Addon
 */

if ( ! function_exists( 'astra_breadcrumb' ) ) {

	/**
	 * Get the Breadcrumb.
	 *
	 * @since 1.0.0
	 */
	function astra_breadcrumb() {

		/* Set up the arguments for the breadcrumb. */
		$args = apply_filters(
			'astra_breadcrumb_defaults',
			array(
				'prefix'         => null,
				'suffix'         => null,
				'title'          => null,
				'home'           => __( 'Home', 'astra-addon' ),
				'delimiter'      => null,
				'front_page'     => false,
				'show_blog'      => false,
				'echo'           => true,
				'archive-prefix' => __( 'Archives for ', 'astra-addon' ),
				'author-prefix'  => __( 'Archives for ', 'astra-addon' ),
				'search-prefix'  => __( 'You searched for ', 'astra-addon' ),
				'404-title'      => __( 'Error 404: Page not found', 'astra-addon' ),
			)
		);

		/* Format the title. */
		$title     = ( ! empty( $args['title'] ) ? '<span class="breadcrumbs-title">' . $args['title'] . '</span>' : '' );
		$delimiter = ( ! empty( $args['delimiter'] ) ) ? "<span class='separator'>{$args['delimiter']}</span>" : "<span class='separator'>»</span>";
		/* Get the items. */

		$items = astra_breadcrumb_get_items( $args );
		if ( ! empty( $items ) ) {
			$breadcrumbs  = '<!-- Ast Breadcrumbs start -->';
			$breadcrumbs .= '<div class="ast-breadcrumbs" itemscope itemtype="https://schema.org/BreadcrumbList">';
			$breadcrumbs .= $args['prefix'];
			$breadcrumbs .= $title;
			$breadcrumbs .= join( " {$delimiter} ", $items );
			$breadcrumbs .= $args['suffix'];
			$breadcrumbs .= '</div>';
			$breadcrumbs .= '<!-- Ast breadcrumbs end -->';
			$breadcrumbs  = apply_filters( 'astra_breadcrumb', $breadcrumbs );
			if ( ! $args['echo'] ) {
				return $breadcrumbs;
			} else {
				echo wp_kses_post( $breadcrumbs );
			}
		}
	}

	/**
	 * Gets the items for the RDFa Breadcrumb.
	 *
	 * @param array $args Mixed arguments for the menu.
	 * @since 1.0.0
	 */
	function astra_breadcrumb_get_items( $args ) {
		global $wp_query;
		$item          = array();
		$show_on_front = get_option( 'show_on_front' );
		/* Link to front page. */
		if ( ! is_front_page() ) {
			$item[] = '<span class="ast-breadcrumbs-link-wrap" itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem"><a itemprop="item" rel="v:url" property="v:title" href="' . esc_url( home_url( '/' ) ) . '"><span itemprop="name">' . $args['home'] . '</span><meta itemprop="position" content="${content}"/></a></span>';
		}

		/* If woocommerce is installed and we're on a woocommerce page. */
		if ( function_exists( 'is_woocommerce' ) && is_woocommerce() ) {
			woocommerce_breadcrumb();
			return false;
		}
		/* Front page. */
		if ( is_home() && ! ( is_front_page() && is_home() ) ) {
			// Blog page.
			$id           = astra_get_post_id();
			$home_page    = get_page( $wp_query->get_queried_object_id() );
			$item         = array_merge( $item, astra_breadcrumb_get_parents( $home_page->post_parent ) );
			$item['last'] = '<span itemprop="name">' . get_the_title( $id ) . '</span>';
		} elseif ( function_exists( 'is_bbpress' ) && is_bbpress() ) {
			$item = array_merge( $item, astra_breadcrumb_get_bbpress_items() );
			// If viewing a singular post.
		} elseif ( is_singular() ) {
			$post             = $wp_query->get_queried_object();
			$post_id          = (int) $wp_query->get_queried_object_id();
			$post_type        = $post->post_type;
			$post_type_object = get_post_type_object( $post_type );
			if ( 'post' === $post_type && $args['show_blog'] ) {
				$item[] = '<span class="ast-breadcrumbs-link-wrap" itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem"><a itemprop="item" rel="v:url" property="v:title" href="' . get_permalink( get_option( 'page_for_posts' ) ) . '"><span itemprop="name">' . get_the_title( get_option( 'page_for_posts' ) ) . '</span></a></span>';
			}
			if ( 'page' !== $post_type ) {
				/* If there's an archive page, add it. */
				if ( function_exists( 'get_post_type_archive_link' ) && ! empty( $post_type_object->has_archive ) ) {
					$item[] = '<span class="ast-breadcrumbs-link-wrap" itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem"><a itemprop="item" rel="v:url" property="v:title" href="' . get_post_type_archive_link( $post_type ) . '" title="' . esc_attr( $post_type_object->labels->name ) . '"><span itemprop="name">' . $post_type_object->labels->name . '</span></a></span>';
				}
				if ( isset( $args[ "singular_{$post_type}_taxonomy" ] ) && is_taxonomy_hierarchical( $args[ "singular_{$post_type}_taxonomy" ] ) ) {
					$terms = wp_get_object_terms( $post_id, $args[ "singular_{$post_type}_taxonomy" ] );
					if ( isset( $terms[0] ) ) {
						$item = array_merge( $item, astra_breadcrumb_get_term_parents( $terms[0], $args[ "singular_{$post_type}_taxonomy" ] ) );
					}
				} elseif ( isset( $args[ "singular_{$post_type}_taxonomy" ] ) ) {
					$item[] = get_the_term_list( $post_id, $args[ "singular_{$post_type}_taxonomy" ], '', ', ', '' );
				}
			}
			$post_parent = ( isset( $wp_query->post->post_parent ) ) ? $wp_query->post->post_parent : '';
			$parents     = astra_breadcrumb_get_parents( $post_parent );
			if ( ( is_post_type_hierarchical( $wp_query->post->post_type ) || 'attachment' === $wp_query->post->post_type ) && $parents ) {
				$item = array_merge( $item, $parents );
			}
			$item['last'] = '<span itemprop="name">' . get_the_title() . '</span>';
			// If viewing any type of archive.
		} elseif ( is_archive() ) {
			if ( is_category() || is_tag() || is_tax() ) {
				$term     = $wp_query->get_queried_object();
				$taxonomy = get_taxonomy( $term->taxonomy );
				$parents  = astra_breadcrumb_get_term_parents( $term->parent, $term->taxonomy );
				if ( ( is_taxonomy_hierarchical( $term->taxonomy ) && $term->parent ) && $parents ) {
					$item = array_merge( $item, $parents );
				}
				$item['last'] = '<span itemprop="name">' . $term->name . '</span>';
			} elseif ( function_exists( 'is_post_type_archive' ) && is_post_type_archive() ) {
				$post_type_object = get_post_type_object( get_query_var( 'post_type' ) );
				$item['last']     = '<span itemprop="name">' . $post_type_object->labels->name . '</span>';
			} elseif ( is_date() ) {
				if ( is_day() ) {
					$item['last'] = '<span itemprop="name">' . $args['archive-prefix'] . get_the_time( 'F j, Y' ) . '</span>';
				} elseif ( is_month() ) {
					$item['last'] = '<span itemprop="name">' . $args['archive-prefix'] . single_month_title( ' ', false ) . '</span>';
				} elseif ( is_year() ) {
					$item['last'] = '<span itemprop="name">' . $args['archive-prefix'] . get_the_time( 'Y' ) . '</span>';
				}
			} elseif ( is_author() ) {
				$item['last'] = '<span itemprop="name">' . $args['author-prefix'] . get_the_author_meta( 'display_name', ( isset( $wp_query->post->post_author ) ) ? $wp_query->post->post_author : '' ) . '</span>';
			}
			// If viewing search results.
		} elseif ( is_search() ) {
			$item['last'] = '<span itemprop="name">' . $args['search-prefix'] . stripslashes( wp_strip_all_tags( get_search_query() ) ) . '</span>';
			// If viewing a 404 error page.
		} elseif ( is_404() ) {
			$item['last'] = '<span itemprop="name">' . $args['404-title'] . '</span>';
		}

		$keys      = array_keys( $item );
		$index_max = count( $item );
		for ( $index = 0;  $index < $index_max; $index++ ) {
			$item[ $keys[ $index ] ] = str_replace( '${content}', $index + 1, $item[ $keys[ $index ] ] );
		}

		return apply_filters( 'astra_breadcrumb_items', $item );
	}

	/**
	 * Gets the items for the breadcrumb item if bbPress is installed.
	 *
	 * @since 1.0.0
	 *
	 * @param array $args Mixed arguments for the menu.
	 *
	 * @return array List of items to be shown in the item.
	 */
	function astra_breadcrumb_get_bbpress_items( $args = array() ) {
		$item             = array();
		$post_type_object = get_post_type_object( bbp_get_forum_post_type() );
		if ( ! empty( $post_type_object->has_archive ) && ! bbp_is_forum_archive() ) {
			$item[] = '<span class="ast-breadcrumbs-link-wrap" itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem"><a itemprop="item" rel="v:url" property="v:title" href="' . get_post_type_archive_link( bbp_get_forum_post_type() ) . '"><span itemprop="name">' . bbp_get_forum_archive_title() . '</span></a></span>';
		}
		if ( bbp_is_forum_archive() ) {
			$item[] = bbp_get_forum_archive_title();
		} elseif ( bbp_is_topic_archive() ) {
			$item[] = bbp_get_topic_archive_title();
		} elseif ( bbp_is_single_view() ) {
			$item[] = bbp_get_view_title();
		} elseif ( bbp_is_single_topic() ) {
			$topic_id = get_queried_object_id();
			$item     = array_merge( $item, astra_breadcrumb_get_parents( bbp_get_topic_forum_id( $topic_id ) ) );
			if ( bbp_is_topic_split() || bbp_is_topic_merge() || bbp_is_topic_edit() ) {
				$item[] = '<span class="ast-breadcrumbs-link-wrap" itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem"><a itemprop="item" rel="v:url" property="v:title" href="' . bbp_get_topic_permalink( $topic_id ) . '"><span itemprop="name">' . bbp_get_topic_title( $topic_id ) . '</span></a></span>';
			}
			if ( bbp_is_topic_split() ) {
				$item[] = __( 'Split', 'astra-addon' );
			} elseif ( bbp_is_topic_merge() ) {
				$item[] = __( 'Merge', 'astra-addon' );
			} elseif ( bbp_is_topic_edit() ) {
				$item[] = __( 'Edit', 'astra-addon' );
			}
		} elseif ( bbp_is_single_reply() ) {
			$reply_id = get_queried_object_id();
			$item     = array_merge( $item, astra_breadcrumb_get_parents( bbp_get_reply_topic_id( $reply_id ) ) );
			if ( ! bbp_is_reply_edit() ) {
				$item[] = bbp_get_reply_title( $reply_id );
			} else {
				$item[] = '<span class="ast-breadcrumbs-link-wrap" itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem"><a itemprop="item" rel="v:url" property="v:title" href="' . esc_url( bbp_get_reply_url( $reply_id ) ) . '"><span itemprop="name">' . bbp_get_reply_title( $reply_id ) . '</span></a></span>';
				$item[] = __( 'Edit', 'astra-addon' );
			}
		} elseif ( bbp_is_single_forum() ) {
			$forum_id        = get_queried_object_id();
			$forum_parent_id = bbp_get_forum_parent( $forum_id );
			if ( 0 !== $forum_parent_id ) {
				$item = array_merge( $item, astra_breadcrumb_get_parents( $forum_parent_id ) );
			}
			$item[] = bbp_get_forum_title( $forum_id );
		} elseif ( bbp_is_single_user() || bbp_is_single_user_edit() ) {
			if ( bbp_is_single_user_edit() ) {
				$item[] = '<span class="ast-breadcrumbs-link-wrap" itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem"><a itemprop="item" rel="v:url" property="v:title" href="' . esc_url( bbp_get_user_profile_url() ) . '"><span itemprop="name">' . bbp_get_displayed_user_field( 'display_name' ) . '</span></a></span>';
				$item[] = __( 'Edit', 'astra-addon' );
			} else {
				$item[] = bbp_get_displayed_user_field( 'display_name' );
			}
		}

		return apply_filters( 'astra_breadcrumb_get_bbpress_items', $item, $args );
	}

	/**
	 * Gets parent pages of any post type.
	 *
	 * @since 1.0.0
	 *
	 * @param int    $post_id ID of the post whose parents we want.
	 * @param string $delimiter .
	 *
	 * @return string $html String of parent page links.
	 */
	function astra_breadcrumb_get_parents( $post_id = '', $delimiter = '/' ) {
		$parents = array();
		if ( 0 == $post_id ) {
			return $parents;
		}
		while ( $post_id ) {
			$page      = get_page( $post_id );
			$parents[] = '<span class="ast-breadcrumbs-link-wrap" itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem"><a itemprop="item" rel="v:url" property="v:title" href="' . esc_url( get_permalink( $post_id ) ) . '" title="' . esc_attr( get_the_title( $post_id ) ) . '"><span itemprop="name">' . get_the_title( $post_id ) . '</span>  <meta itemprop="position" content="${content}"/> </a></span>';
			$post_id   = $page->post_parent;
		}
		if ( $parents ) {
			$parents = array_reverse( $parents );
		}

		return $parents;
	}

	/**
	 * Searches for term parents of hierarchical taxonomies.
	 *
	 * @since 1.0.0
	 *
	 * @param int           $parent_id The ID of the first parent.
	 * @param object|string $taxonomy The taxonomy of the term whose parents we want.
	 * @param string        $delimiter The separator.
	 *
	 * @return string $html String of links to parent terms.
	 */
	function astra_breadcrumb_get_term_parents( $parent_id = '', $taxonomy = '', $delimiter = '/' ) {
		$html    = array();
		$parents = array();
		if ( empty( $parent_id ) || empty( $taxonomy ) ) {
			return $parents;
		}
		while ( $parent_id ) {
			$parent    = get_term( $parent_id, $taxonomy );
			$term_link = get_term_link( $parent, $taxonomy );
			if ( ! is_string( $term_link ) ) {
				$parents[] = '<span class="ast-breadcrumbs-link-wrap" itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem"><a itemprop="item" rel="v:url" property="v:title" href="' . esc_url( $term_link ) . '" title="' . esc_attr( $parent->name ) . '">' . $parent->name . '</a></span>';
			}
			$parent_id = $parent->parent;
		}
		if ( $parents ) {
			$parents = array_reverse( $parents );
		}

		return $parents;
	}
}

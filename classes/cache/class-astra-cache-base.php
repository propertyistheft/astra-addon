<?php
/**
 * Astra Cache
 *
 * @package     Astra
 * @link        https://www.brainstormforce.com
 * @since       Astra 2.1.0
 */

/**
 * Class Astra_Cache_Base.
 */
// @codingStandardsIgnoreStart
class Astra_Cache_Base {
	// @codingStandardsIgnoreEnd

	/**
	 * Member Variable
	 *
	 * @var array instance
	 */
	private static $dynamic_css_files = array();

	/**
	 * Asset slug for filename.
	 *
	 * @since 2.1.0
	 * @var string
	 */
	private $asset_slug = '';

	/**
	 * Check if we are on a single or archive query page.
	 *
	 * @since 2.1.0
	 * @var string
	 */
	private $asset_query_var = '';

	/**
	 * Asset Type - archive/post
	 *
	 * @since 2.1.0
	 * @var string
	 */
	private $asset_type = '';

	/**
	 * Uploads directory.
	 *
	 * @since 2.1.0
	 * @var array
	 */
	private $uploads_dir = array();

	/**
	 * Cache directory from uploads folder.
	 *
	 * @since 2.1.0
	 * @var String
	 */
	private $cache_dir;

	/**
	 * Set priority for add_action call for action `wp_enqueue_scripts`
	 *
	 * @since 2.1.0
	 * @var string
	 */
	protected $asset_priority = '';

	/**
	 * Constructor
	 *
	 * @since 2.1.0
	 * @param String $cache_dir Base cache directory in the uploads directory.
	 */
	public function __construct( $cache_dir ) {
		if ( true === is_admin() ) {
			return false;
		}

		$this->cache_dir = $cache_dir;

		add_action( 'wp', array( $this, 'init_cache' ) );
		add_action( 'wp_enqueue_scripts', array( $this, 'setup_cache' ), $this->asset_priority );
	}

	/**
	 * Setup class variables.
	 *
	 * @since 2.1.0
	 * @return void
	 */
	public function init_cache() {
		$this->asset_type      = $this->asset_type();
		$this->asset_query_var = $this->asset_query_var();
		$this->asset_slug      = $this->asset_slug();
		$this->uploads_dir     = astra_addon_filesystem()->get_uploads_dir( $this->cache_dir );

		// Create uploads directory.
		astra_addon_filesystem()->maybe_create_uploads_dir( $this->uploads_dir['path'] );
	}

	/**
	 * Get Current query type. single|archive.
	 *
	 * @since 2.1.0
	 * @return String
	 */
	private function asset_query_var() {
		if ( 'post' === $this->asset_type || 'home' === $this->asset_type || 'frontpage' === $this->asset_type ) {
			$slug = 'single';
		} else {
			$slug = 'archive';
		}

		return apply_filters( 'astra_addon_cache_asset_query_var', $slug );
	}

	/**
	 * Get current asset slug.
	 *
	 * @since 2.1.0
	 * @return String
	 */
	private function asset_slug() {
		if ( 'home' === $this->asset_type || 'frontpage' === $this->asset_type ) {
			return $this->asset_type;
		}

		return $this->asset_type . $this->cache_key_suffix();
	}

	/**
	 * Append queried object ID to cache if it is not `0`
	 *
	 * @since 2.1.0
	 * @return Mixed queried object id if that is not 0; else false.
	 */
	private function cache_key_suffix() {
		return get_queried_object_id() !== 0 ? '-' . get_queried_object_id() : false;
	}

	/**
	 * Get the archive title.
	 *
	 * @since  2.1.0
	 * @return $title Returns the archive title.
	 */
	private function asset_type() {
		$title = 'post';

		if ( is_category() ) {
			$title = 'category';
		} elseif ( is_tag() ) {
			$title = 'tag';
		} elseif ( is_author() ) {
			$title = 'author';
		} elseif ( is_year() ) {
			$title = 'year-' . get_query_var( 'year' );
		} elseif ( is_month() ) {
			$title = 'month-' . get_query_var( 'monthnum' );
		} elseif ( is_day() ) {
			$title = 'day-' . get_query_var( 'day' );
		} elseif ( is_tax( 'post_format' ) ) {
			if ( is_tax( 'post_format', 'post-format-aside' ) ) {
				$title = 'asides';
			} elseif ( is_tax( 'post_format', 'post-format-gallery' ) ) {
				$title = 'galleries';
			} elseif ( is_tax( 'post_format', 'post-format-image' ) ) {
				$title = 'images';
			} elseif ( is_tax( 'post_format', 'post-format-video' ) ) {
				$title = 'videos';
			} elseif ( is_tax( 'post_format', 'post-format-quote' ) ) {
				$title = 'quotes';
			} elseif ( is_tax( 'post_format', 'post-format-link' ) ) {
				$title = 'links';
			} elseif ( is_tax( 'post_format', 'post-format-status' ) ) {
				$title = 'statuses';
			} elseif ( is_tax( 'post_format', 'post-format-audio' ) ) {
				$title = 'audio';
			} elseif ( is_tax( 'post_format', 'post-format-chat' ) ) {
				$title = 'chats';
			}
		} elseif ( is_post_type_archive() ) {
			// Allowing paths for custom post type archives.
			$title = get_query_var( 'post_type' ) . '-archives';
		} elseif ( is_tax() ) {
			$queried_object = get_queried_object();
			if ( $queried_object && is_a( $queried_object, 'WP_Term' ) ) {
				$tax   = get_taxonomy( $queried_object->taxonomy );
				$title = sanitize_key( $tax->name );
			}
		}

		if ( is_search() ) {
			$title = 'search';
		}

		if ( is_404() ) {
			$title = '404';
		}

		if ( is_front_page() ) {
			$title = 'post';
		}

		if ( is_home() ) {
			$title = 'home';
		}

		return apply_filters( 'astra_addon_cache_asset_type', $title );
	}

	/**
	 * Create an array of all the files that needs to be merged in dynamic CSS file.
	 *
	 * @since 2.1.0
	 * @param array $file file path.
	 * @return void
	 */
	public static function add_css_file( $file ) {
	}

	/**
	 * Append CSS style to the theme dynamic css.
	 *
	 * @since 2.1.0
	 * @param Array $dynamic_css_files Array of file paths to be to be added to minify cache.
	 * @return String CSS from the CSS files passed.
	 */
	public function get_css_from_files( $dynamic_css_files ) {
		$dynamic_css_data = '';

		foreach ( $dynamic_css_files as $value ) {
			// Get file contents.
			$get_contents = astra_addon_filesystem()->get_contents( $value );
			if ( $get_contents ) {
				$dynamic_css_data .= $get_contents;
			}
		}

		return $dynamic_css_data;
	}

	/**
	 * Refresh Assets, called through ajax
	 *
	 * @since 2.1.0
	 * @param String $cache_dir dirname of the cache.
	 * @return void
	 */
	public function ajax_refresh_assets( $cache_dir ) {
		if ( ! current_user_can( 'edit_theme_options' ) ) {
			wp_die();
		}

		check_ajax_referer( 'astra_addon_update_admin_setting', 'security' );

		$this->init_cache();
		astra_addon_filesystem()->reset_filesystem_access_status();

		$this->delete_cache_files( $cache_dir );
	}

	/**
	 * Refresh Assets
	 *
	 * @since 2.1.0
	 * @param String $cache_dir dirname of the cache.
	 * @return void
	 */
	public function refresh_assets( $cache_dir ) {
		if ( ! current_user_can( 'edit_theme_options' ) ) {
			return;
		}

		$this->init_cache();
		astra_addon_filesystem()->reset_filesystem_access_status();

		$this->delete_cache_files( $cache_dir );
	}

	/**
	 * Deletes cache files
	 *
	 * @since 2.1.0
	 * @param String $cache_dir dirname of the cache.
	 * @return void
	 */
	private function delete_cache_files( $cache_dir ) {
		$cache_dir   = astra_addon_filesystem()->get_uploads_dir( $cache_dir );
		$cache_files = astra_addon_filesystem()->get_filesystem()->dirlist( $cache_dir['path'], false, true );

		if ( is_array( $cache_files ) ) {

			foreach ( $cache_files as $file ) {
				// don't delete index.php file.
				if ( 'index.php' === $file['name'] ) {
					continue;
				}

				// Delete only dynamic CSS files.
				if ( false === strpos( $file['name'], 'dynamic-css' ) ) {
					continue;
				}

				astra_addon_filesystem()->delete( trailingslashit( $cache_dir['path'] ) . $file['name'], true, 'f' );
			}
		}
	}

	/**
	 * Fetch theme CSS data to be added in the dynamic CSS file.
	 *
	 * @since 2.1.0
	 * @return void
	 */
	public function setup_cache() {
	}

	/**
	 * Write dynamic asset files.
	 *
	 * @param String $style_data Dynamic CSS.
	 * @param String $type Asset type.
	 * @return void
	 */
	protected function write_assets( $style_data, $type ) {
		$allow_file_generation = get_option( '_astra_file_generation', 'disable' );

		if ( 'disable' === $allow_file_generation || is_customize_preview() ) {
			return;
		}

		$assets_info    = $this->get_asset_info( $type );
		$post_timestamp = $this->get_post_timestamp( $assets_info );

		// Check if we need to create a new file or override the current file.
		if ( ! empty( $style_data ) && true === $post_timestamp['create_new_file'] ) {
			$this->file_write( $style_data, $post_timestamp['timestamp'], $assets_info );
		}
	}

	/**
	 * Get Dynamic CSS.
	 *
	 * @since 2.1.0
	 * @return void
	 */
	protected function get_dynamic_css() {
	}

	/**
	 * Enqueue CSS files.
	 *
	 * @param  string $type         Gets the type theme/addon.
	 * @since  2.1.0
	 * @return void
	 */
	public function enqueue_styles( $type ) {

		if ( self::inline_assets() ) {
			wp_add_inline_style( 'astra-' . $type . '-css', $this->get_dynamic_css() );
		} else {
			$assets_info    = $this->get_asset_info( $type );
			$post_timestamp = $this->get_post_timestamp( $assets_info );
			if ( isset( $this->uploads_dir['url'] ) ) {
				wp_enqueue_style( 'astra-' . $type . '-dynamic', $this->uploads_dir['url'] . 'astra-' . $type . '-dynamic-css-' . $this->asset_slug . '.css', array( 'astra-' . $type . '-css' ), $post_timestamp['timestamp'] );
			}
		}
	}

	/**
	 * Enqueue the assets inline.
	 *
	 * @since 2.1.0
	 * @return bool
	 */
	public static function inline_assets() {
		$inline                = false;
		$allow_file_generation = get_option( '_astra_file_generation', 'disable' );

		if ( ( defined( 'SCRIPT_DEBUG' ) && true === SCRIPT_DEBUG ) || ! astra_addon_filesystem()->can_access_filesystem()
			|| 'disable' === $allow_file_generation || is_customize_preview() ) {
			$inline = true;
		}

		return apply_filters( 'astra_addon_load_dynamic_css_inline', $inline );
	}

	/**
	 * Returns the current Post Meta/ Option Timestamp.
	 *
	 * @since  2.1.0
	 * @param  string $assets_info  Gets the assets path info.
	 * @return array $timestamp_data.
	 */
	public function get_post_timestamp( $assets_info ) {
		// Check if current page is a post/ archive page. false states that the current page is a post.
		if ( 'single' === $this->asset_query_var ) {
			$post_timestamp = get_post_meta( get_the_ID(), 'astra_style_timestamp_css', true );
		} else {
			$post_timestamp = get_option( 'astra_get_dynamic_css' );
		}

		return $this->maybe_get_new_timestamp( $post_timestamp, $assets_info );
	}

	/**
	 * Gets the current timestamp.
	 *
	 * @since 2.1.0
	 * @return string $timestamp Timestamp.
	 */
	private function get_current_timestamp() {
		$date = new DateTime();
		return $date->getTimestamp();
	}

	/**
	 * Returns the current Post Meta/ Option Timestamp or creates a new timestamp.
	 *
	 * @since  2.1.0
	 * @param  string $post_timestamp Timestamp of the post meta/ option.
	 * @param  string $assets_info  Gets the assets path info.
	 * @return array $data.
	 */
	public function maybe_get_new_timestamp( $post_timestamp, $assets_info ) {
		// Creates a new timestamp if the file does not exists or the timestamp is empty.
		// If post_timestamp is empty that means it is an new post or the post is updated and a new file needs to be created.
		// If a file does not exists then we need to create a new file.
		if ( '' == $post_timestamp || ( isset( $assets_info['path'] ) && ! empty( $assets_info['path'] ) && ! file_exists( $assets_info['path'] ) ) ) {
			$timestamp = $this->get_current_timestamp();

			$data = array(
				'create_new_file' => true,
				'timestamp'       => $timestamp,
			);
		} else {
			$timestamp = $post_timestamp;
			$data      = array(
				'create_new_file' => false,
				'timestamp'       => $timestamp,
			);
		}

		return $data;
	}

	/**
	 * Returns an array of paths for the CSS assets
	 * of the current post.
	 *
	 * @param  string $type         Gets the type theme/addon.
	 * @since 2.1.0
	 * @return array
	 */
	public function get_asset_info( $type ) {
		$css_suffix = 'astra-' . $type . '-dynamic-css';
		$info       = array();

		if ( ! isset( $this->uploads_dir['path'] ) || ! isset( $this->uploads_dir['url'] ) ) {
			return $info;
		}

		$info['path']    = $this->uploads_dir['path'] . $css_suffix . '-' . $this->asset_slug . '.css';
		$info['css_url'] = $this->uploads_dir['url'] . $css_suffix . '-' . $this->asset_slug . '.css';

		return $info;
	}

	/**
	 * Updates the Post Meta/ Option Timestamp.
	 *
	 * @param  string $timestamp    Gets the current timestamp.
	 * @since  2.1.0
	 * @return void
	 */
	public function update_timestamp( $timestamp ) {
		// Check if current page is a post/ archive page. false states that the current page is a post.
		if ( 'single' === $this->asset_query_var ) {
			update_post_meta( get_the_ID(), 'astra_style_timestamp_css', $timestamp );
		} else {
			update_option( 'astra_get_dynamic_css', $timestamp );
		}
	}

	/**
	 * Creates CSS files.
	 *
	 * @param  string $style_data   Gets the CSS for the current Page.
	 * @param  string $timestamp    Gets the current timestamp.
	 * @param  string $assets_info  Gets the assets path info.
	 * @since  2.1.0
	 * @return void
	 */
	public function file_write( $style_data, $timestamp, $assets_info ) {
		astra_addon_filesystem()->put_contents( $assets_info['path'], $style_data );
		$this->update_timestamp( $timestamp );
	}
}

<?php
/**
 * Theme setup.
 *
 * @package the7
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

if ( ! function_exists( 'presscore_load_theme_modules' ) ) :

	/**
	 * Load supported modules.
	 *
	 * @since 3.0.0
	 */
	function presscore_load_theme_modules() {
		$supported_modules = get_theme_support( 'presscore-modules' );
		if ( empty( $supported_modules[0] ) ) {
			return;
		}

		foreach ( $supported_modules[0] as $module ) {
			locate_template( "inc/mods/{$module}/{$module}.php", true );
		}
	}

	add_action( 'after_setup_theme', 'presscore_load_theme_modules', 10 );

endif;

if ( ! function_exists( 'presscore_setup' ) ) :

	/**
	 * Theme setup.
	 *
	 * @since 1.0.0
	 */
	function presscore_setup() {
		/**
		 * Load child theme text domain.
		 */
		if ( is_child_theme() ) {
			load_child_theme_textdomain( 'the7mk2', get_stylesheet_directory() . '/languages' );
		}

		/**
		 * Load theme text domain.
		 */
		load_theme_textdomain( 'the7mk2', get_template_directory() . '/languages' );

		/**
		 * Register custom menu.
		 */
		register_nav_menus( array(
			'primary'             => _x( 'Primary Menu', 'backend', 'the7mk2' ),
			'split_left'          => _x( 'Split Menu Left', 'backend', 'the7mk2' ),
			'split_right'         => _x( 'Split Menu Right', 'backend', 'the7mk2' ),
			'mobile'              => _x( 'Mobile Menu', 'backend', 'the7mk2' ),
			'top'                 => _x( 'Header Microwidget 1', 'backend', 'the7mk2' ),
			'header_microwidget2' => _x( 'Header Microwidget 2', 'backend', 'the7mk2' ),
			'bottom'              => _x( 'Bottom Menu', 'backend', 'the7mk2' ),
		) );

		/**
		 * Load editor style.
		 */
		add_editor_style();

		/**
		 * Add default posts and comments RSS feed links to head.
		 */
		add_theme_support( 'automatic-feed-links' );

		/**
		 * Enable support for Post Thumbnails.
		 */
		add_theme_support( 'post-thumbnails' );

		/**
		 * Add title tag support.
		 */
		add_theme_support( 'title-tag' );

		/**
		 * Enable support for various theme modules.
		 */
		presscore_enable_theme_modules();

		/**
		 * Allow shortcodes in widgets.
		 */
		add_filter( 'widget_text', 'do_shortcode' );

		/**
		 * Create upload dir.
		 */
		wp_upload_dir();

		/**
		 * Register theme template parts dir.
		 */
		presscore_template_manager()->add_path( 'theme', 'template-parts' );

		wp_cache_add_non_persistent_groups( array( 'the7-tmp' ) );
	}

	add_action( 'after_setup_theme', 'presscore_setup', 5 );

endif;

/**
 * Flush rewrite rules after theme switch.
 *
 * @since 1.0.0
 */
add_action( 'after_switch_theme', 'flush_rewrite_rules' );

if ( ! function_exists( 'presscore_turn_off_custom_fields_meta' ) ) :

	/**
	 * Removes support of custom-fields for pages and posts.
	 *
	 * @since 3.0.0
	 */
	function presscore_turn_off_custom_fields_meta() {

		/**
		 * Custom fields significantly increases db load because of theme heavily uses meta fields. It's a simplest way to reduce db load.
		 */
		remove_post_type_support( 'post', 'custom-fields' );
		remove_post_type_support( 'page', 'custom-fields' );
	}

	add_action( 'init', 'presscore_turn_off_custom_fields_meta' );

endif;

if ( ! function_exists( 'presscore_enable_theme_modules' ) ) :

	/**
	 * This function add support for various theme modules.
	 *
	 * @since 3.1.4
	 */
	function presscore_enable_theme_modules() {
		$modules = array(
			'admin-icons-bar',
			'archive-ext',
			'compatibility',
			'mega-menu',
			'theme-update',
			'tgmpa',
			'demo-content',
			'bundled-content',
		    'posts-defaults',
			'dev-mode',
			'options-wizard',
			'dev-tools',
			'remove-customizer',
			'custom-fonts',
		);

		$pt_modules = array(
			'portfolio',
			'albums',
			'team',
			'testimonials',
			'slideshow',
			'benefits',
			'logos',
		);

		// Enable post type modules.
		foreach ( $pt_modules as $module_name ) {
			// Very important to set default value explicitly and so options cache will be not generated!
			if ( The7_Admin_Dashboard_Settings::get( $module_name ) ) {
				$modules[] = $module_name;
			}
		}

		/**
		 * Allow to manage theme active modules.
		 *
		 * @since 6.4.1
		 */
		$modules = apply_filters( 'the7_active_modules', $modules );

		add_theme_support( 'presscore-modules', $modules );
	}

endif;

if ( ! function_exists( 'presscore_add_theme_options' ) ) :

	/**
	 * Set theme options path.
	 *
	 * @since 1.0.0
	 */
	function presscore_add_theme_options() {
		return array( 'inc/admin/load-theme-options.php' );
	}

endif;

if ( ! function_exists('presscore_widgets_init') ) :

	/**
	 * Register widgetized areas.
	 *
	 * @since 1.0.0
	 */
	function presscore_widgets_init() {
		if ( function_exists( 'of_get_option' ) ) {
			$w_params = array(
				'before_widget' => '<section id="%1$s" class="widget %2$s">',
				'after_widget' => '</section>',
				'before_title' => '<div class="widget-title">',
				'after_title' => '</div>',
			);

			$w_areas = apply_filters( 'presscore_widgets_init-sidebars', of_get_option( 'widgetareas' ) );

			if ( ! empty( $w_areas ) && is_array( $w_areas ) ) {
				$prefix = 'sidebar_';

				foreach( $w_areas as $sidebar_id=>$sidebar ) {
					$sidebar_args = array(
						'name'          => ( isset( $sidebar['sidebar_name'] ) ? $sidebar['sidebar_name'] : '' ),
						'id'            => $prefix . $sidebar_id,
						'description'   => ( isset( $sidebar['sidebar_desc'] ) ? $sidebar['sidebar_desc'] : '' ),
						'before_widget' => $w_params['before_widget'],
						'after_widget'  => $w_params['after_widget'],
						'before_title'  => $w_params['before_title'],
						'after_title'   => $w_params['after_title'],
					);

					$sidebar_args = apply_filters( 'presscore_widgets_init-sidebar_args', $sidebar_args, $sidebar_id, $sidebar );

					register_sidebar( $sidebar_args );
				}
			}
		}
	}

	add_action( 'widgets_init', 'presscore_widgets_init' );

endif;

if ( ! function_exists( 'presscore_post_types_author_archives' ) ) :

	/**
	 * Add custom post types to author archives.
	 *
	 * @since 1.0.0
	 *
	 * @param object $query
	 */
	function presscore_post_types_author_archives( $query ) {
		/**
		 * To avoid conflicts, run this hack in frontend only.
		 */
		if ( is_admin() ) {
			return;
		}

		if ( $query->is_main_query() && $query->is_author ) {
			$new_post_types = (array) apply_filters( 'presscore_author_archive_post_types', array() );
			if ( $new_post_types ) {
				array_unshift( $new_post_types, 'post' );
				$post_type = $query->get( 'post_type' );
				if( ! $post_type ) {
					$post_type = array();
				}
				$query->set( 'post_type', array_merge( (array) $post_type, $new_post_types ) );
			}
		}
	}

	add_action( 'pre_get_posts', 'presscore_post_types_author_archives' );

endif;

if ( ! function_exists( 'optionsframework_get_presets_list' ) ) :

	/**
	 * Add theme options presets.
	 *
	 * @return array
	 */
	function optionsframework_get_presets_list() {
		// noimage - /images/noimage-small.jpg

		$presets_names = array(
			'skin11r',
			'skin12r',
			'skin15r',
			'skin14r',
			'skin09r',
			'skin03r',
			'skin05r',
			'skin02r',
			'skin11b',
			'skin16r',
			'skin19b',
			'skin19r',
			'skin10r',
			'skin07c',
			'skin06r',

			'wizard01',
			'wizard02',
			'wizard03',
			'wizard05',
			'wizard07',
			'wizard08',
			'wizard09',
		);

		$presets = array();
		foreach( $presets_names as $preset_name ) {
			$presets[ $preset_name ] = array(
				'src'   => '/inc/presets/icons/' . $preset_name . '.gif',
				'title' => $preset_name,
			);
		}

		return $presets;
	}

endif;


if ( ! function_exists('presscore_set_first_run_skin') ) :

	/**
	 * Set first run skin.
	 *
	 * @since 1.0.0
	 *
	 * @param string $skin_name
	 * @return string
	 */
	function presscore_set_first_run_skin( $skin_name = '' ) {
		return 'skin11r';
	}

	add_filter( 'options_framework_first_run_skin', 'presscore_set_first_run_skin' );

endif;

if ( ! function_exists( 'presscore_set_default_contact_form_email' ) ) :

	/**
	 * Set default email for contact forms if it's not empty.
	 * See theme options General->Advanced.
	 *
	 * @since 1.1.0
	 *
	 * @param  string $email
	 * @return string
	 */
	function presscore_set_default_contact_form_email( $email = '' ) {
		$default_email = of_get_option( 'general-contact_form_send_mail_to', '' );
		if ( $default_email ) {
			$email = $default_email;
		}

		return $email;
	}

	add_filter( 'dt_core_send_mail-to', 'presscore_set_default_contact_form_email' );

endif;

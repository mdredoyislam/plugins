<?php
/**
 * Plugin Name: DesVert Extensions
 * Description: Extend Elementor Page Builder with 40+ Creative Widgets and exciting extensions.
 * Plugin URI:  https://redoyislam.xyz/picchi-extension
 * Version:     1.0.0
 * Author:      MD REDOY ISLAM
 * Author URI:  https://redoyislam.xyz
 * Text Domain: picchi-extension
 * Domain Path: /languages
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 *
 * The main class that initiates and runs the plugin.
 *
 * @since 1.0.0
 */
final class Desvert_Extension {

	/**
	 * Plugin Version
	 *
	 * @since 1.0.0
	 *
	 * @var string The plugin version.
	 */
	const VERSION = '1.0.0';

	/**
	 * Minimum Elementor Version
	 *
	 * @since 1.0.0
	 *
	 * @var string Minimum Elementor version required to run the plugin.
	 */
	const MINIMUM_ELEMENTOR_VERSION = '2.0.0';

	/**
	 * Minimum PHP Version
	 *
	 * @since 1.0.0
	 *
	 * @var string Minimum PHP version required to run the plugin.
	 */
	const MINIMUM_PHP_VERSION = '7.0';

	/**
	 * Instance
	 *
	 * @since 1.0.0
	 *
	 * @access private
	 * @static
	 *
	 * @var Elementor_Picchi_Extension The single instance of the class.
	 */
	private static $_instance = null;

	/**
	 * Instance
	 *
	 * Ensures only one instance of the class is loaded or can be loaded.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 * @static
	 *
	 * @return Elementor_Picchi_Extension An instance of the class.
	 */
	public static function instance() {

		if ( is_null( self::$_instance ) ) {
			self::$_instance = new self();
		}
		return self::$_instance;

	}

	/**
	 * Constructor
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 */
	public function __construct() {

		add_action( 'init', [ $this, 'i18n' ] );
		add_action( 'plugins_loaded', [ $this, 'init' ] );

	}

	/**
	 * Load Textdomain
	 *
	 * Load plugin localization files.
	 *
	 * Fired by `init` action hook.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 */
	public function i18n() {

		load_plugin_textdomain( 'picchi-extension', FALSE, basename( dirname( __FILE__ ) ) . '/languages/' );

	}

	/**
	 * Initialize the plugin
	 *
	 * Load the plugin only after Elementor (and other plugins) are loaded.
	 * Checks for basic plugin requirements, if one check fail don't continue,
	 * if all check have passed load the files required to run the plugin.
	 *
	 * Fired by `plugins_loaded` action hook.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 */
	public function init() {
		// Enqueue styles and scripts
		function my_elementor_addons_enqueue_scripts() {
			wp_enqueue_style('my-elementor-addons-style', plugin_dir_url(__FILE__) . 'css/style.css');
			wp_enqueue_script('my-elementor-addons-script', plugin_dir_url(__FILE__) . 'js/script.js', array('jquery'), '1.0.0', true);
		}
		add_action('elementor/frontend/after_enqueue_scripts', 'my_elementor_addons_enqueue_scripts');

		// Check if Elementor installed and activated
		if ( ! did_action( 'elementor/loaded' ) ) {
			add_action( 'admin_notices', [ $this, 'admin_notice_missing_main_plugin' ] );
			return;
		}

		// Check for required Elementor version
		if ( ! version_compare( ELEMENTOR_VERSION, self::MINIMUM_ELEMENTOR_VERSION, '>=' ) ) {
			add_action( 'admin_notices', [ $this, 'admin_notice_minimum_elementor_version' ] );
			return;
		}

		// Check for required PHP version
		if ( version_compare( PHP_VERSION, self::MINIMUM_PHP_VERSION, '<' ) ) {
			add_action( 'admin_notices', [ $this, 'admin_notice_minimum_php_version' ] );
			return;
		}

		// Register Widget Styles
		add_action( 'elementor/frontend/after_enqueue_styles', [ $this, 'widget_styles' ] );

		add_action('elementor/frontend/after_enqueue_scripts', [ $this, 'widget_scripts' ] );

		// Add Plugin actions
		add_action( 'elementor/widgets/widgets_registered', [ $this, 'init_widgets' ] );
		add_action( 'elementor/controls/controls_registered', [ $this, 'init_controls' ] );

        // Category Init
		add_action( 'elementor/init', [ $this, 'elementor_common_category' ] );

		// Add custom category to Elementor
		function add_custom_elementor_category($elements_manager) {
			$elements_manager->add_category(
				'desvert-elements',
				array(
					'title' => 'DesVert Elements',
					'icon' => 'fa fa-plug',
				)
			);
		}
		add_action('elementor/elements/categories_registered', 'add_custom_elementor_category');


	}

	/**
	 * Admin notice
	 *
	 * Warning when the site doesn't have Elementor installed or activated.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 */
	public function admin_notice_missing_main_plugin() {

		if ( isset( $_GET['activate'] ) ) unset( $_GET['activate'] );

		$message = sprintf(
			/* translators: 1: Plugin name 2: Elementor */
			esc_html__( '"%1$s" requires "%2$s" to be installed and activated.', 'picchi-extension' ),
			'<strong>' . esc_html__( 'Picchi Elementor Extension', 'picchi-extension' ) . '</strong>',
			'<strong>' . esc_html__( 'Elementor', 'picchi-extension' ) . '</strong>'
		);

		printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );

	}

	/**
	 * Admin notice
	 *
	 * Warning when the site doesn't have a minimum required Elementor version.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 */
	public function admin_notice_minimum_elementor_version() {

		if ( isset( $_GET['activate'] ) ) unset( $_GET['activate'] );

		$message = sprintf(
			/* translators: 1: Plugin name 2: Elementor 3: Required Elementor version */
			esc_html__( '"%1$s" requires "%2$s" version %3$s or greater.', 'picchi-extension' ),
			'<strong>' . esc_html__( 'Picchi Elementor Extension', 'picchi-extension' ) . '</strong>',
			'<strong>' . esc_html__( 'Elementor', 'picchi-extension' ) . '</strong>',
			 self::MINIMUM_ELEMENTOR_VERSION
		);

		printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );

	}

	/**
	 * Admin notice
	 *
	 * Warning when the site doesn't have a minimum required PHP version.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 */
	public function admin_notice_minimum_php_version() {

		if ( isset( $_GET['activate'] ) ) unset( $_GET['activate'] );

		$message = sprintf(
			/* translators: 1: Plugin name 2: PHP 3: Required PHP version */
			esc_html__( '"%1$s" requires "%2$s" version %3$s or greater.', 'picchi-extension' ),
			'<strong>' . esc_html__( 'Picchi Elementor Extension', 'picchi-extension' ) . '</strong>',
			'<strong>' . esc_html__( 'PHP', 'picchi-extension' ) . '</strong>',
			 self::MINIMUM_PHP_VERSION
		);

		printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );

	}

	/**
	 * Init Widgets
	 *
	 * Include widgets files and register them
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 */
	public function init_widgets() {

		require_once( __DIR__ . '/widgets/banner_widgets.php' );
		require_once( __DIR__ . '/widgets/headding_widgets.php' );
		require_once( __DIR__ . '/widgets/slider_widgets.php' );
		//require_once( __DIR__ . '/widgets/bannar-widget.php' );
		//require_once( __DIR__ . '/widgets/heading-widget.php' );
		//require_once( __DIR__ . '/widgets/about-widget.php' );
		//require_once( __DIR__ . '/widgets/features-widget.php' );
		//require_once( __DIR__ . '/widgets/services-widget.php' );
		//require_once( __DIR__ . '/widgets/process-widget.php' );
		//require_once( __DIR__ . '/widgets/projects-widget.php' );
		//require_once( __DIR__ . '/widgets/counter-widget.php' );
		//require_once( __DIR__ . '/widgets/team-widget.php' );

		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Banner_Widget() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Heading_Widget() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Slider_Widget() );
		//\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Bannar_Widget() );
		//\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Heading_Widget() );
		//\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \About_Widget() );
		//\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Features_Widget() );
		//\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Services_Widget() );
		//\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Process_Widget() );
		//\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Projects_Widget() );
		//\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Counter_Widget() );
		//\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Team_Widget() );

	}

	/**
	 * Init Controls
	 *
	 * Include controls files and register them
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 */
	public function init_controls() {

		/*
		* Todo: this block needs to be commented out when the custom control is ready
		*
		*
		// Include Control files
		require_once( __DIR__ . '/controls/test-control.php' );
		// Register control
		\Elementor\Plugin::$instance->controls_manager->register_control( 'control-type-', new \Test_Control() );
		*/

	}

	// Custom CSS
	public function widget_styles() {

		wp_register_style( 'owl-carousel-main-css', plugins_url( 'https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css', __FILE__ ) );
		wp_enqueue_style('owl-carousel-main-css');

	}	

    // Custom JS
	public function widget_scripts() {
		wp_register_script( 'owl-carousel-main-js', plugins_url( 'https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js', __FILE__ ) );
		wp_enqueue_script('owl-carousel-main-js');
	}

    // Custom Category
    public function elementor_common_category () {

	   \Elementor\Plugin::$instance->elements_manager->add_category( 
	   	'picchi-category',
	   	[
	   		'title' => __( 'Picchi Category', 'picchi-extension' ),
	   		'icon' => 'fa fa-plug', //default icon
	   	]
	   );

	}


}

Desvert_Extension::instance();
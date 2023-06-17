<?php
/*
Plugin Name: Gymat Core
Plugin URI: https://www.desvert.com
Description: Gymat Core Plugin for Gymat Theme
Version: 1.7.0
Author: DesVertTheme
Author URI: https://www.desvert.com
*/

if ( ! defined( 'ABSPATH' ) ) exit;

if ( ! defined( 'GYMAT_CORE' ) ) {
	define( 'GYMAT_CORE',                   ( WP_DEBUG ) ? time() : '1.0' );
	define( 'GYMAT_CORE_THEME_PREFIX',      'gymat' );
	define( 'GYMAT_CORE_THEME_PREFIX_VAR',  'gymat' );
	define( 'GYMAT_CORE_CPT_PREFIX',        'gymat' );
	define( 'GYMAT_CORE_BASE_DIR',      plugin_dir_path( __FILE__ ) );
	//for tween max added code
	define( 'GYMAT_CORE_BASE_URL',      plugin_dir_url( __FILE__ ) );

}

class Gymat_Core {

	public $plugin  = 'gymat-core';
	public $action  = 'gymat_theme_init';

	public function __construct() {
		$prefix = GYMAT_CORE_THEME_PREFIX_VAR;

		add_action( 'plugins_loaded', array( $this, 'demo_importer' ), 15 );
		add_action( 'plugins_loaded', array( $this, 'load_textdomain' ), 16 );
		add_action( 'after_setup_theme', array( $this, 'post_meta' ), 15 );
		add_action( 'after_setup_theme', array( $this, 'elementor_widgets' ) );
		add_action( $this->action,       array( $this, 'after_theme_loaded' ) );

		add_shortcode('gymat-single-class-info', array( $this, 'gymat_single_class_info' ) );


		require_once 'module/rt-post-share.php';
		require_once 'module/rt-post-views.php';
		require_once 'module/rt-post-length.php';

		// Widgets
		require_once 'widget/advertisement-widget.php';
		require_once 'widget/address-widget.php';
		require_once 'widget/social-widget.php';
		require_once 'widget/rt-recent-post-widget.php';
		require_once 'widget/rt-post-box.php';
		require_once 'widget/rt-post-tab.php';
		require_once 'widget/rt-feature-post.php';
		require_once 'widget/search-widget.php'; 
		require_once 'widget/rt-download-widget.php';
		require_once 'widget/rt-specific-opening-widget.php';
		require_once 'widget/rt-working-hours-widget.php';
		require_once 'widget/rt-class-widget.php';
		
		//
		require_once 'widget/widget-settings.php';
		require_once 'lib/optimization/__init__.php';
	}


	//for tween max code end

	/**
	 * Removes the demo link and the notice of integrated demo from the redux-framework plugin
	*/

	public function demo_importer() {
		require_once 'demo-importer.php';
	}
	public function load_textdomain() {
		load_plugin_textdomain( $this->plugin , false, dirname( plugin_basename( __FILE__ ) ) . '/languages' );
	}
	public function post_meta(){
		if ( !did_action( $this->action ) || ! defined( 'RT_FRAMEWORK_VERSION' ) ) {
			return;
		}
		require_once 'post-meta.php';
		require_once 'post-types.php';
	}
	public function elementor_widgets(){
		if ( did_action( $this->action ) && did_action( 'elementor/loaded' ) ) {

			require_once 'elementor/init.php';
		}
	}
	public function after_theme_loaded() {
		require_once GYMAT_CORE_BASE_DIR . 'lib/wp-svg/init.php'; // SVG support
		//require_once 'widget/sidebar-generator.php'; // sidebar widget generator
	}

	public function get_base_url(){

		$file = dirname( dirname(__FILE__) );

		// Get correct URL and path to wp-content
		$content_url = untrailingslashit( dirname( dirname( get_stylesheet_directory_uri() ) ) );
		$content_dir = untrailingslashit( WP_CONTENT_DIR );

		// Fix path on Windows
		$file = wp_normalize_path( $file );
		$content_dir = wp_normalize_path( $content_dir );

		$url = str_replace( $content_dir, $content_url, $file );

		return $url;
	}

	/*class Info Single Shortcode*/
	public function gymat_single_class_info() {
		ob_start();
		$gymat_class_price   	    = get_post_meta( get_the_ID(), 'gymat_class_price', true );
		$gymat_class_unit           = get_post_meta( get_the_ID(), 'gymat_class_unit', true );
		$gymat_class_duration       = get_post_meta( get_the_ID(), 'gymat_class_duration', true );
		$gymat_class_intensity   	= get_post_meta( get_the_ID(), 'gymat_class_intensity', true );
		$gymat_class_button_text 	= get_post_meta( get_the_ID(), 'gymat_class_button_text', true );
		$gymat_class_button_link 	= get_post_meta( get_the_ID(), 'gymat_class_button_url', true ) ? get_post_meta( get_the_ID(),'gymat_class_button_url', true ):'#';
		?>
		<?php if((GymatTheme::$options['single_class_ar_info']) && (!empty($gymat_class_price) || !empty($gymat_class_unit) || !empty($gymat_class_duration) || !empty($gymat_class_intensity))){ ?>
			<div class="class-info-wrap widget">
				<h3 class="info-title"><?php _e('Course Info','gymat-core'); ?></h3>
				<ul class="class-info-list">
					<?php if(!empty($gymat_class_price) || !empty($gymat_class_unit)){ ?>
						<li>
							<h4><?php if($gymat_class_price):?>
								<?php _e('Course Price:','gymat-core').':'; ?>
								<span class="price"><?php echo esc_html($gymat_class_price); ?></span>
							<?php endif; ?>
							<?php if($gymat_class_unit):?>
								<sub class="unit"><?php echo esc_html($gymat_class_unit); ?></sub>
							<?php endif; ?></h4>
						</li>
					<?php } ?>
					<?php if(!empty($gymat_class_duration)){ ?>	
					<li><h4><?php _e('Course Duration:','gymat-core').':'; ?><span class="item"><?php echo esc_html($gymat_class_duration); ?></span></h4></li>
					<?php } ?>
					<?php if(!empty($gymat_class_intensity)){ ?>			
					<li><h4><?php _e('Class Intensity:','gymat-core').':'; ?><span class="item"><?php echo esc_html($gymat_class_intensity); ?></span></h4></li>
					<?php } ?>	
					<li><h4><?php _e('Class Name:','gymat-core').':'; ?><span class="item"><?php the_title(); ?></span></h4></li>		
				</ul>
				<?php if(GymatTheme::$options['single_class_ar_button']){ ?>
					<div class="single-class-button">
						<a href="<?php echo esc_url( $gymat_class_button_link); ?>"><?php if($gymat_class_button_text) echo esc_html($gymat_class_button_text);  ?><svg width="21" height="12" viewBox="0 0 21 12" fill="none" xmlns="http://www.w3.org/2000/svg">
						<path fill-rule="evenodd" clip-rule="evenodd" d="M0 6C0 6.22729 0.087059 6.44527 0.242027 6.60598C0.396994 6.7667 0.607174 6.85699 0.82633 6.85699H18.1774L14.6292 10.5352C14.5523 10.6149 14.4914 10.7095 14.4498 10.8136C14.4082 10.9177 14.3868 11.0292 14.3868 11.1419C14.3868 11.2546 14.4082 11.3662 14.4498 11.4703C14.4914 11.5744 14.5523 11.669 14.6292 11.7487C14.706 11.8284 14.7972 11.8916 14.8976 11.9347C14.998 11.9778 15.1056 12 15.2142 12C15.3229 12 15.4304 11.9778 15.5308 11.9347C15.6312 11.8916 15.7224 11.8284 15.7992 11.7487L20.7572 6.60675C20.8342 6.52714 20.8952 6.43257 20.9369 6.32846C20.9786 6.22434 21 6.11272 21 6C21 5.88728 20.9786 5.77566 20.9369 5.67154C20.8952 5.56743 20.8342 5.47286 20.7572 5.39325L15.7992 0.251323C15.6441 0.0904038 15.4336 0 15.2142 0C14.9948 0 14.7843 0.0904038 14.6292 0.251323C14.474 0.412243 14.3868 0.630497 14.3868 0.858071C14.3868 1.08565 14.474 1.3039 14.6292 1.46482L18.1774 5.14301H0.82633C0.607174 5.14301 0.396994 5.2333 0.242027 5.39402C0.087059 5.55474 0 5.77271 0 6Z" fill="white"/>
						</svg></a>
					</div>
				<?php } ?>
			</div>
		<?php } ?>
		<?php 
		return ob_get_clean();
	} 

}

new Gymat_Core;

<?php
/**
 * @author  DesVertTheme
 * @since   1.0
 * @version 1.0
 */

namespace desvertTheme\Gymat_Core;
use Elementor\Plugin;
use GymatTheme_Helper;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Custom_Widget_Init {

	public function __construct() {
		add_action( 'elementor/widgets/register', array( $this, 'init' ) );
		add_action( 'elementor/elements/categories_registered', array( $this, 'widget_categoty' ) );
		add_action( 'elementor/editor/after_enqueue_styles', array( $this, 'editor_style' ) );
		
		/*ajax actions*/
		add_filter( 'elementor/icons_manager/additional_tabs',  [$this, 'additional_tabs'], 10, 1 );
		add_action( 'elementor/editor/after_enqueue_styles', array( $this, 'after_enqueue_styles_elementor_editor' ), 10, 1 );

		/*Elementor image scroll parallex*/
		add_action( 'elementor/element/section/section_background/before_section_end', array($this,'add_elementor_section_background_controls') );
		add_action( 'elementor/frontend/section/before_render', array($this,'render_elementor_section_parallax_background') );
	}
	
	public function after_enqueue_styles_elementor_editor()	{
		wp_enqueue_style( 'flaticon', \GymatTheme_Helper::get_font_css( 'flaticon' ) );		
	}

	public function editor_style() {
		$img = plugins_url( 'icon.png', __FILE__ );
		wp_add_inline_style( 'elementor-editor', '.elementor-element .icon .rdtheme-el-custom{content: url( '.$img.');width: 28px;}' );
		wp_add_inline_style( 'elementor-editor', '.select2-container--default .select2-selection--single {min-width: 126px !important; min-height: 30px !important;}' );
	}

	public function init() {
		require_once __DIR__ . '/base.php';
		
		// Widgets -- filename=>classname /@dev
		$widgets1 = array(
			'title'           		=> 'Title',
			'text-with-button'      => 'Text_With_Button',
			'about-image-text'      => 'About_Image_Text',
			'info-box'        		=> 'Info_Box',
			'woo-info-box'        	=> 'Woo_Info_Box',
			'cta'             		=> 'CTA',
			'contact-info'         	=> 'Contact_Info',
			'post-grid'       		=> 'Post_Grid',
			'rt-trainer'       	    => 'RT_Trainer',
			'rt-single-gallery'     => 'RT_Single_Gallery',
			'rt-gallery'            => 'RT_Gallery',
			'testimonial'       	=> 'Testimonial',
			'logo-slider'       	=> 'Logo_Slider',
			'image'      			=> 'Image',
			'rt-banner'		        =>'RT_Banner',
			'pricing-plan'		    =>'Pricing_Plan',
			'rt-button'		        =>'RT_Button',
			'video'		        	=>'Video',
			'rt-bmi-calculator'		=>'RT_BMI_Calculator',
			'rt-upcomming-class'	=>'RT_Upcomming_Class',
			'rt-class'				=>'RT_Class',
			'rt-feature-class'		=>'RT_Feature_Class',
			'rt-routine'			=>'RT_Routine',
			'rt-schedule'			=>'RT_Schedule',
			'rt-manual-class'		=>'RT_Manual_Class',
			'rt-counter'		    =>'RT_Counter',
			'pricing-switcher'		=>'RT_Pricing_Swicher',
		);
		$widgets2 = array();
		if ( class_exists( 'WooCommerce' ) ) {
			$widgets2 = array(
				'woo-product-grid'      		=> 'Woo_Product_Grid',
				'woo-product-category'      	=> 'Woo_Product_Category',
				'woo-product-slider'      		=> 'Woo_Product_Slider',
				'woo-single-product'      		=> 'Woo_Single_Product',
				'woo-best-deal-product'      	=> 'Woo_Best_Deal_Product',
			);
		}

		$widgets = array_merge( $widgets1, $widgets2 );
		
		foreach ( $widgets as $widget => $class ) {
			$template_name = "/elementor-custom/widgets/{$widget}.php";
			if ( file_exists( STYLESHEETPATH . $template_name ) ) {
				$file = STYLESHEETPATH . $template_name;
			}
			elseif ( file_exists( TEMPLATEPATH . $template_name ) ) {
				$file = TEMPLATEPATH . $template_name;
			}
			else {
				$file = __DIR__ . '/widgets/' . $widget. '.php';
			}

			require_once $file;
			
			$classname = __NAMESPACE__ . '\\' . $class;
			Plugin::instance()->widgets_manager->register( new $classname );
		}
	}

	public function widget_categoty( $class ) {
		$id         = GYMAT_CORE_THEME_PREFIX . '-widgets'; // Category /@dev
		$properties = array(
			'title' => __( 'DesVert Theme Elements', 'gymat-core' ),
		);

		Plugin::$instance->elements_manager->add_category( $id, $properties );
	}
	
	public function custom_icon_for_elementor( $controls_registry )
	{
		// Get existing icons
		$icons = $controls_registry->get_control( 'icon' )->get_settings( 'options' );
		// Append new icons		
		$flaticons = GymatTheme_Helper::get_flaticon_icons();

		// Then we set a new list of icons as the options of the icon control
		$new_icons = array_merge($flaticons, $icons);
		$controls_registry->get_control( 'icon' )->set_settings( 'options', $new_icons );
	}

	public function additional_tabs($tabs)
      {
        $json_url = GymatTheme_Helper::get_asset_file('json/flaticon.json');

        $flaticon = [
          'name'          => 'flaticon',
          'label'         => esc_html__( 'Gymat Icon', 'gymat-core' ),
          'url'           => false,
          'enqueue'       => false,
          'prefix'        => '',
          'displayPrefix' => '',
          'labelIcon'     => 'fab fa-font-awesome-alt',
          'ver'           => '1.0.0',
          'fetchJson'     => $json_url,
        ];
        array_push( $tabs, $flaticon);

        return $tabs;
      }
	  function add_elementor_section_background_controls( \Elementor\Element_Section $section ) {

		$section->add_control(
			'rt_section_parallax',
			[
				'label' => __( 'Parallax', 'gymat-core' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_off' => __( 'Off', 'gymat-core' ),
				'label_on' => __( 'On', 'gymat-core' ),
				'default' => 'no',
				'prefix_class' => 'rt-parallax-bg-',
			]
		);

		$section->add_control(
			'rt_parallax_speed',
			[
				'label' => __( 'Speed', 'gymat-core' ),
				'type' => \Elementor\Controls_Manager::NUMBER,
				'min' => 0.1,
				'max' => 5,
				'step' => 0.1,
				'default' => 0.5,
				'condition' => [
					'rt_section_parallax' => 'yes'
				]
			]
		);

		$section->add_control(
			'rt_parallax_transition',
			[
				'label' => __( 'Parallax Transition off?', 'gymat-core' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_off' => __( 'on', 'gymat-core' ),
				'label_on' => __( 'Off', 'gymat-core' ),
				'default' => 'off',
				'return_value' => 'off',
				'prefix_class' => 'rt-parallax-transition-',
				'condition' => [
					'rt_section_parallax' => 'yes'
				]
			]
		);

	}

	// Render section backgrou]d parallax
	function render_elementor_section_parallax_background( \Elementor\Element_Base $element ) {

		if('section' === $element->get_name()){
			if ( 'yes' === $element->get_settings_for_display( 'rt_section_parallax' ) ) {
				$rt_background = $element->get_settings_for_display( 'background_image' );
				$rt_background_URL = $rt_background['url'];
				$data_speed = $element->get_settings_for_display( 'rt_parallax_speed' );

				$element->add_render_attribute( '_wrapper', [
					'data-speed' => $data_speed,
					'data-bg-image' => $rt_background_URL,
				] ) ;
			}
		}
	}


}

new Custom_Widget_Init();


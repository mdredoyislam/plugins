<?php
/**
 * @author  desvertTheme
 * @since   1.0
 * @version 1.0
 */
 
namespace desvertTheme\Gymat_Core;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Image_Size;
use Elementor\Utils;

if ( ! defined( 'ABSPATH' ) ) exit;

class Woo_Product_Category extends Custom_Widget_Base {

	public function __construct( $data = [], $args = null ){
		$this->rt_name = esc_html__( 'DV Woo Category', 'gymat-core' );
		$this->rt_base = 'rt-woo-category';
		parent::__construct( $data, $args );
	}
	 
	public function rt_fields(){
		
		/*For woo category*/
		$woo_categories = get_terms( 'product_cat', 'orderby=count&hide_empty=0' );
		
		$woo_category_dropdown = array( '0' => esc_html__( 'Select Categories', 'gymat-core' ) );

		foreach ( $woo_categories as $woo_category ) {
			$woo_category_dropdown[$woo_category->term_id] = $woo_category->name;
		}

		$repeater = new \Elementor\Repeater();

        $repeater->add_control(
			'category_name',
			[
				'label'   => __( 'Select Category', 'gymat-core' ),
				'type'    => Controls_Manager::SELECT2,
                'options' => $this->rt_get_categories_by_id('product_cat'),
				'multiple' => false,
				'label_block' => true,
				'show_label' => false,
			]
		);
		$repeater->add_control(
			'category_subtitle',
			[
				'label'   => __( 'Subtitle', 'gymat-core' ),
				'type'    => Controls_Manager::TEXTAREA,
				'label_block' => true,
				'default' =>esc_html__('Free Shipping & Save Up To 15%','gymat-core')
			]
		);
		$repeater->add_control(
			'category_btn_text',
			[
				'label'   => __( 'Button Text', 'gymat-core' ),
				'type'    => Controls_Manager::TEXT,
				'label_block' => true,
				'default' =>esc_html__('Shop Now','gymat-core')
			]
		);
		$fields = array(
			array(
				'mode'    => 'section_start',
				'id'      => 'sec_general',
				'label'   => esc_html__( 'General', 'gymat-core' ),
			),			

			
			array (
				'type'    => Controls_Manager::REPEATER,
				'id'      => 'product_cat_infos',
				'label'   => esc_html__( 'Add Category', 'gymat-core' ),
				'fields' => $repeater->get_controls(),
			),

			array(
				'mode' => 'section_end',
			),
			// Slider options
			array(
				'mode'        => 'section_start',
				'id'          => 'sec_slider',
				'label'       => esc_html__( 'Slider Options', 'gymat-core' ),
			),
			array(
				'type'        => Controls_Manager::SWITCHER,
				'id'          => 'slider_autoplay',
				'label'       => esc_html__( 'Autoplay', 'gymat-core' ),
				'default'     => 'off',
			),
			array(
				'type'        => Controls_Manager::SWITCHER,
				'id'          => 'slider_loop',
				'label'       => esc_html__( 'Loop', 'gymat-core' ),
				'default'     => 'off',
			),
			array(
				'type'        => Controls_Manager::SWITCHER,
				'id'          => 'navigation',
				'label'       => esc_html__( 'Navigation', 'gymat-core' ),
				'default'     => 'off',
			),
			array(
				'type'        => Controls_Manager::SWITCHER,
				'id'          => 'centered_slide',
				'label'       => esc_html__( 'Center Slide', 'gymat-core' ),
				'default'     => 'false',
			),
			array(
				'type'        => Controls_Manager::SLIDER,
				'id'          => 'slider_per_group',
				'label'       => esc_html__( 'Slides Per Group', 'gymat-core' ),
                'range' => [
                    'px' => [
                        'min' => 1,
                        'max' => 6,
                    ],
                ],
                'size_units' => [ 'px'],
                'default' => [
                    'size' => 1,
                ],
			),
			array(
				'type'        => Controls_Manager::SLIDER,
				'id'          => 'autoplayspeed',
				'label'       => esc_html__( 'Autoplay speed', 'gymat-core' ),
				'condition'   => array( 'slider_autoplay' => 'yes' ),
                'range' => [
                    'px' => [
                        'min' => 1,
                        'max' => 10000,
                        'step' => 500,
                    ],
                ],
                'size_units' => [ 'px'],
                'default' => [
                    'size' => 2000,
                ],
			),
			array(
				'type'        => Controls_Manager::SLIDER,
				'id'          => 'speed',
				'label'       => esc_html__( 'Slider Speed', 'gymat-core' ),
                'range' => [
                    'px' => [
                        'min' => 1,
                        'max' => 10000,
                        'step' => 500,
                    ],
                ],
                'size_units' => [ 'px'],
                'default' => [
                    'size' => 2000,
                ],
			),
			array(
				'type'        => Controls_Manager::SLIDER,
				'id'          => 'space',
				'label'       => esc_html__( 'Inter slider spacing', 'gymat-core' ),
                'range' => [
                    'px' => [
                        'min' => 1,
                        'max' => 100,
                        'step' => 1,
                    ],
                ],
                'size_units' => [ 'px'],
                'default' => [
                    'size' => 30,
                ],
			),

			array(
				'type'        => Controls_Manager::SLIDER,
				'id'          => 'item',
				'label'       => esc_html__( 'Desktop items', 'gymat-core' ),
                'range' => [
                    'px' => [
                        'min' => 1,
                        'max' => 6,
                        'step' => 1,
                    ],
                ],
                'size_units' => [ ''],
                'default' => [
                    'size' => 3,
                ],
			),
			array(
				'type'        => Controls_Manager::SLIDER,
				'id'          => 'medium_item',
				'label'       => esc_html__( 'Medium Desktop items', 'gymat-core' ),
                'range' => [
                    'px' => [
                        'min' => 1,
                        'max' => 6,
                        'step' => 1,
                    ],
                ],
                'size_units' => [ ''],
                'default' => [
                    'size' => 2,
                ],
			),
			array(
				'type'        => Controls_Manager::SLIDER,
				'id'          => 'item_tablet',
				'label'       => esc_html__( 'Tablet items', 'gymat-core' ),
                'range' => [
                    'px' => [
                        'min' => 1,
                        'max' => 10,
                        'step' => 1,
                    ],
                ],
                'size_units' => [ ''],
                'default' => [
                    'size' => 2,
                ],
			),
			array(
				'type'        => Controls_Manager::SLIDER,
				'id'          => 'item_mobile',
				'label'       => esc_html__( 'Mobile items', 'gymat-core' ),
                'range' => [
                    'px' => [
                        'min' => 1,
                        'max' => 10,
                        'step' => 1,
                    ],
                ],
                'size_units' => [ ''],
                'default' => [
                    'size' => 1,
                ],
			),
			array(
				'mode' => 'section_end',
			),
			// Option
			array(
				'mode'    => 'section_start',
				'id'      => 'sec_style',
				'label'   => esc_html__( 'Style', 'gymat-core' ),
				'tab'     => Controls_Manager::TAB_STYLE,
			),	
	        array(
				'mode'    => 'group',
				'type'    => Group_Control_Typography::get_type(),
				'name'    => 'title_typo',
				'label'   => esc_html__( 'Title Typo', 'gymat-core' ),
				'selector' => '{{WRAPPER}} .el-category-box .category-box .category-title',
			),
			array(
				'mode'    => 'group',
				'type'    => Group_Control_Typography::get_type(),
				'name'    => 'sub_title_typo',
				'label'   => esc_html__( 'Subtitle Typo', 'gymat-core' ),
				'selector' => '{{WRAPPER}} .el-category-box .category-box .category-subtitle',
			),		
			array(
				'type'    => Controls_Manager::COLOR,
				'id'      => 'title_color',
				'label'   => esc_html__( 'Title Color', 'gymat-core' ),
				'default' => '',
				'selectors' => array(
					'{{WRAPPER}} .el-category-box .category-box .category-title a' => 'color: {{VALUE}}',
				),
			),
			array(
				'type'    => Controls_Manager::COLOR,
				'id'      => 'subtitle_color',
				'label'   => esc_html__( 'Subtitle Color', 'gymat-core' ),
				'default' => '',
				'selectors' => array(
					'{{WRAPPER}} .el-category-box .category-box .category-subtitle' => 'color: {{VALUE}}',
				),
			),
			array(
	            'type'    => Controls_Manager::DIMENSIONS,
	            'mode'          => 'responsive',
	            'size_units' => [ 'px', '%', 'em' ],
	            'id'      => 'title_padding',
	            'label'   => __( 'Title Space', 'gymat-core' ),                 
	            'selectors' => array(
	                '{{WRAPPER}} .el-category-box .category-box .category-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',                    
	            ),
	            'separator' => 'before',
	        ),					
			array(
				'mode' => 'section_end',
			),

			// Animation style
			array(
	            'mode'    => 'section_start',
	            'id'      => 'sec_animation_style',
	            'label'   => esc_html__( 'Animation', 'gymat-core' ),
	            'tab'     => Controls_Manager::TAB_STYLE,
	        ),
			array(
				'type'    => Controls_Manager::SELECT2,
				'id'      => 'animation',
				'label'   => esc_html__( 'Animation', 'gymat-core' ),
				'options' => array(
					'wow'        => esc_html__( 'On', 'gymat-core' ),
					'hide'        => esc_html__( 'Off', 'gymat-core' ),
				),
				'default' => 'wow',
			),
			array(
				'type'    => Controls_Manager::SELECT2,
				'id'      => 'animation_effect',
				'label'   => esc_html__( 'Entrance Animation', 'gymat-core' ),
				'options' => array(
                    'none' => esc_html__( 'none', 'gymat-core' ),
					'bounce' => esc_html__( 'bounce', 'gymat-core' ),
					'flash' => esc_html__( 'flash', 'gymat-core' ),
					'pulse' => esc_html__( 'pulse', 'gymat-core' ),
					'rubberBand' => esc_html__( 'rubberBand', 'gymat-core' ),
					'shakeX' => esc_html__( 'shakeX', 'gymat-core' ),
					'shakeY' => esc_html__( 'shakeY', 'gymat-core' ),
					'headShake' => esc_html__( 'headShake', 'gymat-core' ),
					'swing' => esc_html__( 'swing', 'gymat-core' ),					
					'fadeIn' => esc_html__( 'fadeIn', 'gymat-core' ),
					'fadeInDown' => esc_html__( 'fadeInDown', 'gymat-core' ),
					'fadeInLeft' => esc_html__( 'fadeInLeft', 'gymat-core' ),
					'fadeInRight' => esc_html__( 'fadeInRight', 'gymat-core' ),
					'fadeInUp' => esc_html__( 'fadeInUp', 'gymat-core' ),					
					'bounceIn' => esc_html__( 'bounceIn', 'gymat-core' ),
					'bounceInDown' => esc_html__( 'bounceInDown', 'gymat-core' ),
					'bounceInLeft' => esc_html__( 'bounceInLeft', 'gymat-core' ),
					'bounceInRight' => esc_html__( 'bounceInRight', 'gymat-core' ),
					'bounceInUp' => esc_html__( 'bounceInUp', 'gymat-core' ),			
					'slideInDown' => esc_html__( 'slideInDown', 'gymat-core' ),
					'slideInLeft' => esc_html__( 'slideInLeft', 'gymat-core' ),
					'slideInRight' => esc_html__( 'slideInRight', 'gymat-core' ),
					'slideInUp' => esc_html__( 'slideInUp', 'gymat-core' ), 
                ),
				'default' => 'fadeInUp',
				'condition'   => array('animation' => array( 'wow' ) ),
			),
			array(
				'type'    => Controls_Manager::TEXT,
				'id'      => 'delay',
				'label'   => esc_html__( 'Delay', 'gymat-core' ),
				'default' => '0.2',
				'condition'   => array( 'animation' => array( 'wow' ) ),
			),
			array(
				'type'    => Controls_Manager::TEXT,
				'id'      => 'duration',
				'label'   => esc_html__( 'Duration', 'gymat-core' ),
				'default' => '1.2',
				'condition'   => array( 'animation' => array( 'wow' ) ),
			),
			array(
				'mode' => 'section_end',
			),	
		);
		return $fields;
	}

	protected function render() {
		
		$data = $this->get_settings();
		
	
		$template = 'woo-category';
		
		
		
		return $this->rt_template( $template, $data );
		
	}
	
}
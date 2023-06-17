<?php
/**
 * @author  desvertTheme
 * @since   1.0
 * @version 1.0
 */

namespace desvertTheme\Gymat_Core;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Image_Size;
use Elementor\Group_Control_Typography;
use Elementor\Utils;

if ( ! defined( 'ABSPATH' ) ) exit;

class Testimonial extends Custom_Widget_Base {

	public function __construct( $data = [], $args = null ){
		$this->rt_name = esc_html__( 'DV Testimonial', 'gymat-core' );
		$this->rt_base = 'rt-testimonial';
		parent::__construct( $data, $args );
	}
	private function rt_load_scripts(){
		wp_enqueue_style(  'swiper-slider' );
		wp_enqueue_script('swiper-slider');
	}
	public function rt_fields(){
		$cpt = GYMAT_CORE_CPT_PREFIX;
		$terms  = get_terms( array( 'taxonomy' => "{$cpt}_testimonial_category", 'fields' => 'id=>name' ) );
		$category_dropdown = array( '0' => esc_html__( 'All Categories', 'gymat-core' ) );
		foreach ( $terms as $id => $name ) {
			$category_dropdown[$id] = $name;
		}
		$fields = array(
			array(
				'mode'    => 'section_start',
				'id'      => 'sec_general',
				'label'   => esc_html__( 'General', 'gymat-core' ),
			),
			array(
				'type'    => Controls_Manager::SELECT2,
				'id'      => 'style',
				'label'   => esc_html__( 'Style', 'gymat-core' ),
				'options' => array(
					'style1' => esc_html__( 'Style 1', 'gymat-core' ),
					'style2' => esc_html__( 'Style 2', 'gymat-core' ),
					'style3' => esc_html__( 'Style 3', 'gymat-core' ),
					'style4' => esc_html__( 'Style 4', 'gymat-core' ),
				),
				'default' => 'style1',
			),
			array(
				'type'    => Controls_Manager::SELECT2,
				'id'      => 'cat',
				'label'   => esc_html__( 'Categories', 'gymat-core' ),
				'options' => $category_dropdown,
				'default' => '0',
			),
			array(
				'type'    => Controls_Manager::SELECT2,
				'id'      => 'orderby',
				'label'   => esc_html__( 'Order By', 'gymat-core' ),
				'options' => array(
					'date'        => esc_html__( 'Date (Recents comes first)', 'gymat-core' ),
					'title'       => esc_html__( 'Title', 'gymat-core' ),
				),
				'default' => 'date',
			),
			array(
				'type'    => Controls_Manager::NUMBER,
				'id'      => 'count',
				'label'   => esc_html__( 'Word count', 'gymat-core' ),
				'default' => 34,
				'description' => esc_html__( 'Maximum number of words', 'gymat-core' ),
			),
			array(
				'type'    => Controls_Manager::NUMBER,
				'id'      => 'number',
				'label'   => esc_html__( 'Total number of items', 'gymat-core' ),
				'default' => 5,
				'description' => esc_html__( 'Write -1 to show all', 'gymat-core' ),
			),
			array(
				'type'        => Controls_Manager::SWITCHER,
				'id'          => 'designation_display',
				'label'       => esc_html__( 'Designation Display', 'gymat-core' ),
				'label_on'    => esc_html__( 'On', 'gymat-core' ),
				'label_off'   => esc_html__( 'Off', 'gymat-core' ),
				'default'     => 'yes',
				'description' => esc_html__( 'Show or Hide Designation. Default: On', 'gymat-core' ),
			),
			array(
				'type'        => Controls_Manager::SWITCHER,
				'id'          => 'ratting_display',
				'label'       => esc_html__( 'Ratting Display', 'gymat-core' ),
				'label_on'    => esc_html__( 'On', 'gymat-core' ),
				'label_off'   => esc_html__( 'Off', 'gymat-core' ),
				'default'     => 'off',
				'description' => esc_html__( 'Show or Hide Ratting. Default: Off', 'gymat-core' ),
			),
			array(
				'type'        => Controls_Manager::SWITCHER,
				'id'          => 'thumbs_display',
				'label'       => esc_html__( 'Thumbs Display', 'gymat-core' ),
				'label_on'    => esc_html__( 'On', 'gymat-core' ),
				'label_off'   => esc_html__( 'Off', 'gymat-core' ),
				'default'     => 'yes',
				'description' => esc_html__( 'Show or Hide Thumbs. Default: Off', 'gymat-core' ),
			),
			array(
				'type'        => Controls_Manager::SLIDER,
				'mode'      => 'responsive',
				'id'          => 'arrow_prev_positon',
				'label'       => esc_html__( 'Prev Arrow Position', 'gymat-core' ),
				'default' => [
					'unit' => '%',
				],
				'tablet_default' => [
					'unit' => '%',
				],
				'mobile_default' => [
					'unit' => '%',
				],
				'range' => [
					'%' => [
						'min' => 0,
						'max' => 100,
					],
					'px' => [
						'min' => 0,
						'max' => 1000,
					],
					
				],
                'size_units' => [ '%', 'px'],
                'selectors' => [
                    '{{WRAPPER}} .testimonial-style1 .swiper-button-prev' => 'left: {{SIZE}}{{UNIT}};',
                ],
				'condition'   => array( 'style' => array( 'style1')),
			),
			array(
				'type'        => Controls_Manager::SLIDER,
				'mode'      => 'responsive',
				'id'          => 'arrow_next_positon',
				'label'       => esc_html__( 'Next Arrow Position', 'gymat-core' ),
				'default' => [
					'unit' => '%',
				],
				'tablet_default' => [
					'unit' => '%',
				],
				'mobile_default' => [
					'unit' => '%',
				],
				'range' => [
					'%' => [
						'min' => 0,
						'max' => 100,
					],
					'px' => [
						'min' => 0,
						'max' => 1000,
					],
					
				],
                'size_units' => [ '%', 'px'],
                'selectors' => [
                    '{{WRAPPER}} .testimonial-style1 .swiper-button-next' => 'left: {{SIZE}}{{UNIT}};',
                ],
				'condition'   => array( 'style' => array( 'style1')),
			),
			array(
				'type'    => Controls_Manager::MEDIA,
				'id'      => 'rt_image',
				'label'   => esc_html__( 'Image', 'gymat-core' ),
				'default' => array(
                    'url' => Utils::get_placeholder_image_src(),
                ),
				'description' => esc_html__( 'Recommended 641x470 image size', 'gymat-core' ),
			),
			array(
				'type'    => Group_Control_Image_Size::get_type(),
				'mode'    => 'group',				
				'label'   => esc_html__( 'image size', 'gymat-core' ),	
				'name' => 'icon_image_size', 
				'separator' => 'none',		
			),
			array(
				'mode' => 'section_end',
			),
			// Style
			array(
				'mode'    => 'section_start',
				'id'      => 'sec_style',
				'label'   => esc_html__( 'Style', 'gymat-core' ),
				'tab'     => Controls_Manager::TAB_STYLE,
			),
			array (
				'mode'    => 'group',
				'type'    => Group_Control_Typography::get_type(),
				'name'    => 'title_typo',
				'label'   => esc_html__( 'Title Typro', 'gymat-core' ),
				'selector' => '{{WRAPPER}} .default-testimonial .testimonial-item .testimonial-title',
			),
			array (
				'mode'    => 'group',
				'type'    => Group_Control_Typography::get_type(),
				'name'    => 'desig_title_typo',
				'label'   => esc_html__( 'Designation Typro', 'gymat-core' ),
				'selector' => '{{WRAPPER}} .default-testimonial .testimonial-item .testimonial-designation',
			),
			array (
				'mode'    => 'group',
				'type'    => Group_Control_Typography::get_type(),
				'name'    => 'content_typo',
				'label'   => esc_html__( 'Content Typro', 'gymat-core' ),
				'selector' => '{{WRAPPER}} .default-testimonial .testimonial-item .testimonial-content p',
			),
			array (
				'type'    => Controls_Manager::COLOR,
				'id'      => 'item_bg_color',
				'label'   => esc_html__( 'Item Background Color', 'gymat-core' ),
				'default' => '',
				'selectors' => array( 
					'{{WRAPPER}} .testimonial-style4 .inner-testimonial' => 'background-color: {{VALUE}}',
				),
				'condition'=>array('style'=>array('style4'))
			),
			array (
				'type'    => Controls_Manager::COLOR,
				'id'      => 'item_title_color',
				'label'   => esc_html__( 'Title Color', 'gymat-core' ),
				'default' => '',
				'selectors' => array( 
					'{{WRAPPER}} .default-testimonial .testimonial-item .testimonial-title' => 'color: {{VALUE}}',
				),
			),
			array (
				'type'    => Controls_Manager::COLOR,
				'id'      => 'item_designa_color',
				'label'   => esc_html__( 'Designation Color', 'gymat-core' ),
				'default' => '',
				'selectors' => array(
					'{{WRAPPER}} .default-testimonial .testimonial-item .testimonial-designation' => 'color: {{VALUE}}',
				),
			),
			array (
				'type'    => Controls_Manager::COLOR,
				'id'      => 'item_content_color',
				'label'   => esc_html__( 'Content Color', 'gymat-core' ),
				'default' => '',
				'selectors' => array(
					'{{WRAPPER}} .default-testimonial .testimonial-item .testimonial-content p' => 'color: {{VALUE}}',
					'{{WRAPPER}} .testimonial-multi-layout .testimonial-item p' => 'color: {{VALUE}}',
					'{{WRAPPER}} .testimonial-style4 .testimonial-item p' => 'color: {{VALUE}}',
				),
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
                'size_units' => [ 'px'],
                'default' => [
                    'size' => 1,
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
                'size_units' => [ 'px'],
                'default' => [
                    'size' => 1,
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
                'size_units' => [ 'px'],
                'default' => [
                    'size' => 1,
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
                'size_units' => [ 'px'],
                'default' => [
                    'size' => 1,
                ],
			),
			array(
				'mode' => 'section_end',
			),
		);
		return $fields;
	}

	protected function render() {
		$data = $this->get_settings();
		$this->rt_load_scripts();
		switch ( $data['style'] ) {
			case 'style4':
			$template = 'testimonial-4';
			break;
			case 'style3':
			$template = 'testimonial-3';
			break;
			case 'style2':
			$template = 'testimonial-2';
			break;
			default:
			$template = 'testimonial-1';
			break;
		}
		return $this->rt_template( $template, $data );
	}
}
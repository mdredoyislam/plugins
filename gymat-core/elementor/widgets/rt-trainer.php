<?php
/**
 * @author  desvertTheme
 * @since   1.0
 * @version 1.0
 */

namespace desvertTheme\Gymat_Core;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Utils;
if ( ! defined( 'ABSPATH' ) ) exit;

class RT_Trainer extends Custom_Widget_Base {
	public function __construct( $data = [], $args = null ){
		$this->rt_name = esc_html__( 'DV Trainer', 'gymat-core' );
		$this->rt_base = 'rt-trainer';
		$this->rt_translate = array(
			'cols'  => array(
				'12' => esc_html__( '1 Col', 'gymat-core' ),
				'6'  => esc_html__( '2 Col', 'gymat-core' ),
				'4'  => esc_html__( '3 Col', 'gymat-core' ),
				'3'  => esc_html__( '4 Col', 'gymat-core' ),
				'2'  => esc_html__( '6 Col', 'gymat-core' ),
			),
		);
		parent::__construct( $data, $args );
	}

	public function rt_fields(){
		$terms = get_terms( array( 'taxonomy' => 'gymat_trainer_category', 'fields' => 'id=>name' ) );
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
					'style1' => esc_html__( 'Trainer Grid Layout 1', 'gymat-core' ),
					'style2' => esc_html__( 'Trainer Grid Layout 2', 'gymat-core' ),
					'style4' => esc_html__( 'Trainer Grid Layout 3', 'gymat-core' ),
					'style3' => esc_html__( 'Trainer Slider Layout', 'gymat-core' ),
				),
				'default' => 'style1',
			),
			array(
				'type'    => Controls_Manager::NUMBER,
				'id'      => 'number',
				'label'   => esc_html__( 'Total number of items', 'gymat-core' ),
				'default' => 6,
				'description' => esc_html__( 'Write -1 to show all', 'gymat-core' ),
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
					'menu_order'  => esc_html__( 'Custom Order (Available via Order field inside Page Attributes box)', 'gymat-core' ),
				),
				'default' => 'date',
			),
			
			array(
				'type'        => Controls_Manager::SWITCHER,
				'id'          => 'content_display',
				'label'       => esc_html__( 'Content Display', 'gymat-core' ),
				'label_on'    => esc_html__( 'On', 'gymat-core' ),
				'label_off'   => esc_html__( 'Off', 'gymat-core' ),
				'default'     => 'no',
				'description' => esc_html__( 'Show or Hide Content. Default: off', 'gymat-core' ),
				'condition'   => array( 'style' => array('style1','style2'))
			),
			array(
				'type'    => Controls_Manager::NUMBER,
				'id'      => 'count',
				'label'   => esc_html__( 'Content Word count', 'gymat-core' ),
				'default' => 15,
				'description' => esc_html__( 'Maximum number of words', 'gymat-core' ),
				'condition'   => array( 'style' => array('style1','style2'))
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
				'id'          => 'social_display',
				'label'       => esc_html__( 'Social Media Display', 'gymat-core' ),
				'label_on'    => esc_html__( 'On', 'gymat-core' ),
				'label_off'   => esc_html__( 'Off', 'gymat-core' ),
				'default'     => 'yes',
				'description' => esc_html__( 'Show or Hide Social Medias. Default: On', 'gymat-core' ),
			),
			array(
				'type'        => Controls_Manager::SWITCHER,
				'id'          => 'more_button_display',
				'label'       => esc_html__( 'More Button Display', 'gymat-core' ),
				'label_on'    => esc_html__( 'On', 'gymat-core' ),
				'label_off'   => esc_html__( 'Off', 'gymat-core' ),
				'default'     => 'no',
				'description' => esc_html__( 'Show or Hide More Button . Default: On', 'gymat-core' ),
				'condition'   => array( 'style' => array('style1','style2'))
			),
			array(
				'type'    => Controls_Manager::SELECT2,
				'id'      => 'more_button',
				'label'   => esc_html__( 'More Button', 'gymat-core' ),
				'options' => array(
					'show'        => esc_html__( 'Show Read More', 'gymat-core' ),
					'hide'        => esc_html__( 'Show Pagination', 'gymat-core' ),
				),
				'default' => 'show',
				'condition'   => array( 'style' => array( 'style1','style2'),'more_button_display'=>'yes' ),
			),
			array (
				'type'    => Controls_Manager::TEXT,
				'id'      => 'see_button_text',
				'label'   => esc_html__( 'Button Text', 'gymat-core' ),
				'condition'   => array( 'more_button' => array( 'show' ) ),
				'default' => esc_html__( 'MORE TEAMS', 'gymat-core' ),
				'condition'   => array( 'more_button' => array( 'show' ), 'style' => array( 'style1','style2'), 'more_button_display'=>'yes' ),
			),
			array (
				'type'    => Controls_Manager::TEXT,
				'id'      => 'see_button_link',
				'label'   => esc_html__( 'Button Link', 'gymat-core' ),
				'condition'   => array( 'more_button' => array( 'show' ), 'style' => array( 'style1','style2'),'more_button_display'=>'yes'  ),
			),
			array(
				'type'    => Controls_Manager::MEDIA,
				'id'      => 'trainer_shape_image',
				'label'   => esc_html__( 'Shape Image', 'gymat-core' ),
				'description' => esc_html__( 'Recommended  image 353 x 412', 'gymat-core' ),
				'condition'   => array( 'style' => array('style2') ),
			),
			array(
				'type'        => Controls_Manager::SWITCHER,
				'id'          => 'trainer_style_shape',
				'label'       => esc_html__( 'Background Shape Display', 'gymat-core' ),
				'label_on'    => esc_html__( 'On', 'gymat-core' ),
				'label_off'   => esc_html__( 'Off', 'gymat-core' ),
				'default'     => 'yes',
				'description' => esc_html__( 'Show or Hide Shape .Default: On', 'gymat-core' ),
				'condition'   =>array('style'=>array('style2'))
			),
			array(
				'type'    => Controls_Manager::SLIDER,
				'id'      => 'trainer_box_height',
				'label'   => esc_html__( 'Trainer Box Min Height', 'gymat-core' ),
				'mode'	=>'responsive',
				'description' => esc_html__( 'Size Unit Px', 'gymat-core' ),
				'default'    => [
					'unit' => 'px',
					'size' => 362,
				],
				'range' => [
					'px' => [
						'max' => 1000,
						'min' => 200,
					],
					
				],
				'selectors' => [
					'{{WRAPPER}} .trainer-grid-style4 .trainer-item' => 'min-height: {{SIZE}}px;',
				],
				'condition'   =>array('style'=>array('style4'))
			),
			array(
				'mode' => 'section_end',
			),

			//Style Option Start

			/*Trainer Title Style*/
			array(
				'mode'    => 'section_start',
				'id'      => 'sec_style',
				'label'   => esc_html__( 'Trainer Title', 'gymat-core' ),
				'tab'     => Controls_Manager::TAB_STYLE,
			),
			array (
				'mode'    => 'group',
				'type'    => Group_Control_Typography::get_type(),
				'name'    => 'trainer_title_typo',
				'label'   => esc_html__( 'Title Typo', 'gymat-core' ),
				'selector' => '{{WRAPPER}} .trainer-default .trainer-title',
			),
			array(
				'type'    => Controls_Manager::COLOR,
				'id'      => 'title_color',
				'label'   => esc_html__( 'Title Color', 'gymat-core' ),
				'default' => '',
				'selectors' => array(
					'{{WRAPPER}} .trainer-default .trainer-title' => 'color: {{VALUE}}',
					'{{WRAPPER}} .trainer-default .trainer-title a' => 'color: {{VALUE}}',
				),
			),
			array(
				'type'    => Controls_Manager::COLOR,
				'id'      => 'title_hover_color',
				'label'   => esc_html__( 'Title Hover Color', 'gymat-core' ),
				'default' => '',
				'selectors' => array(
					'{{WRAPPER}} .trainer-default .trainer-title a:hover' => 'color: {{VALUE}}',
				),
			),
			
			array(
				'mode' => 'section_end',
			),

			/*Trainer Desingnation Style*/
			array(
				'mode'    => 'section_start',
				'id'      => 'designation_style',
				'label'   => esc_html__( 'Trainer Designation', 'gymat-core' ),
				'tab'     => Controls_Manager::TAB_STYLE,
			),
			array (
				'mode'    => 'group',
				'type'    => Group_Control_Typography::get_type(),
				'name'    => 'trainer_designation_typo',
				'label'   => esc_html__( 'Designation Typo', 'gymat-core' ),
				'selector' => '{{WRAPPER}} .trainer-default .trainer-designation',
			),
			array(
				'type'    => Controls_Manager::COLOR,
				'id'      => 'trainer_designation_color',
				'label'   => esc_html__( 'Designation Color', 'gymat-core' ),
				'default' => '',
				'selectors' => array(
					'{{WRAPPER}} .trainer-default .trainer-designation' => 'color: {{VALUE}}',
					
				),
			),
			array(
				'type'    => Controls_Manager::COLOR,
				'id'      => 'trainer_shape_color',
				'label'   => esc_html__( 'Shape Color', 'gymat-core' ),
				'default' => '',
				'selectors' => array(
					'{{WRAPPER}} .trainer-grid-style4 .trainer-item .item-icon-shape-1 svg path' => 'fill: {{VALUE}}',
				),
				'condition' =>array('style'=>'style4')
			),
			array(
				'type'    => Controls_Manager::COLOR,
				'id'      => 'trainer_bg_color',
				'label'   => esc_html__( 'Box Background', 'gymat-core' ),
				'default' => '',
				'selectors' => array(
					'{{WRAPPER}} .trainer-grid-style4 .trainer-item' => 'background: {{VALUE}}',
				),
				'condition' =>array('style'=>'style4')
			),
			array(
				'mode' => 'section_end',
			),

			/*Trainer Content Style*/
			array(
				'mode'    => 'section_start',
				'id'      => 'content_style',
				'label'   => esc_html__( 'Trainer Content', 'gymat-core' ),
				'tab'     => Controls_Manager::TAB_STYLE,
				'condition'   => array( 'style' => array('style1','style2'))
			),
			array (
				'mode'    => 'group',
				'type'    => Group_Control_Typography::get_type(),
				'name'    => 'trainer_content_typo',
				'label'   => esc_html__( 'Content Typo', 'gymat-core' ),
				'selector' => '{{WRAPPER}} .trainer-default .trainer-item .trainer-content p',
			),
			array(
				'type'    => Controls_Manager::COLOR,
				'id'      => 'trainer_content_color',
				'label'   => esc_html__( 'Content Color', 'gymat-core' ),
				'default' => '',
				'selectors' => array(
					'{{WRAPPER}} .trainer-default .trainer-item .trainer-content p' => 'color: {{VALUE}}',
					
				),
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
					'zoomIn' => esc_html__( 'zoomIn', 'gymat-core' ), 
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
				'default' => '0.8',
				'condition'   => array( 'animation' => array( 'wow' ) ),
			),
			array(
				'mode' => 'section_end',
			),

			// Responsive Columns
			array(
				'mode'    => 'section_start',
				'id'      => 'sec_responsive',
				'label'   => esc_html__( 'Number of Responsive Columns', 'gymat-core' ),
				'condition'   => array( 'style' => array('style1','style2','style4') ),
			),
			array(
				'type'    => Controls_Manager::SELECT2,
				'id'      => 'col_lg',
				'label'   => esc_html__( 'Desktops: > 1199px', 'gymat-core' ),
				'options' => $this->rt_translate['cols'],
				'default' => '4',
				
			),
			array(
				'type'    => Controls_Manager::SELECT2,
				'id'      => 'col_md',
				'label'   => esc_html__( 'Desktops: > 767px', 'gymat-core' ),
				'options' => $this->rt_translate['cols'],
				'default' => '6',
			),
			array(
				'type'    => Controls_Manager::SELECT2,
				'id'      => 'col_sm',
				'label'   => esc_html__( 'Tablets: < 767px', 'gymat-core' ),
				'options' => $this->rt_translate['cols'],
				'default' => '6',
			),
			array(
				'type'    => Controls_Manager::SELECT2,
				'id'      => 'col_xs',
				'label'   => esc_html__( 'Phones: < 575px', 'gymat-core' ),
				'options' => $this->rt_translate['cols'],
				'default' => '12',
			),
			array(
				'type'    => Controls_Manager::SELECT2,
				'id'      => 'col_mobile',
				'label'   => esc_html__( 'Small Phones: < 480px', 'gymat-core' ),
				'options' => $this->rt_translate['cols'],
				'default' => '12',
			),
			array(
				'mode' => 'section_end',
			),
			
			// Slider options
			array(
				'mode'        => 'section_start',
				'id'          => 'sec_slider',
				'label'       => esc_html__( 'Slider Options', 'gymat-core' ),
				'condition'   => array( 'style' => array('style3' ) ),
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
				'id'          => 'slider_pagination',
				'label'       => esc_html__( 'Pagination', 'gymat-core' ),
				'default'     => 'no',
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
                'size_units' => [ 'px'],
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
                'size_units' => [ 'px'],
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
		
		switch ( $data['style'] ) {
			case 'style4':
			$template = 'trainer-grid-3';
			break;
			case 'style3':
			$template = 'trainer-slider';
			break;
			case 'style2':
			$template = 'trainer-grid-2';
			break;
			default:
			$template = 'trainer-grid-1';
			break;
		}
		
		return $this->rt_template( $template, $data );
	}
}
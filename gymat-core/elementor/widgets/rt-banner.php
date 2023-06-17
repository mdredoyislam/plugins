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
use Elementor\Group_Control_Background;
use Elementor\Utils;

if ( ! defined( 'ABSPATH' ) ) exit;

class RT_Banner extends Custom_Widget_Base {

	public function __construct( $data = [], $args = null ){
		$this->rt_name = esc_html__( 'DV Banner', 'gymat-core' );
		$this->rt_base = 'rt-banner';
		parent::__construct( $data, $args );
	}
	public function rt_fields(){
		$repeater = new \Elementor\Repeater();
		$repeater->add_control(
			'feature',
			 [
				'type'    => Controls_Manager::TEXT,
				'label'   => esc_html__( 'Title', 'finbuzz-core' ),
				'default' => 'Basic Plan',
			]
		);
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
					'style5' => esc_html__( 'Style 5', 'gymat-core' ),
					'style6' => esc_html__( 'Style 6', 'gymat-core' ),
				),
				'default' => 'style1',
			),
			array(
				'type'    => Controls_Manager::TEXTAREA,
				'id'      => 'title',
				'label'   => esc_html__( 'Title', 'gymat-core' ),
				'default' => esc_html__( 'Make Your Body Fit & Perfect', 'gymat-core' ),
			),
			array(
				'type'    => Controls_Manager::TEXTAREA,
				'id'      => 'sub_title',
				'label'   => esc_html__( 'Subtitle', 'gymat-core' ),
				'default' => esc_html__( 'Find Your Energy', 'gymat-core' ),
			),
			array(
				'type'    => Controls_Manager::TEXT,
				'id'      => 'day_off',
				'label'   => esc_html__( 'Discount Percentage', 'gymat-core' ),
				'default' => esc_html__( '30%', 'gymat-core' ),
				'condition' =>array('style'=>array('style3','style5'))
			),
			array(
				'type'    => Controls_Manager::TEXT,
				'id'      => 'price',
				'label'   => esc_html__( 'Price', 'gymat-core' ),
				'default' => esc_html__( '45', 'gymat-core' ),
				'condition' =>array('style'=>array('style6'))
			),
			array (
				'type'    => Controls_Manager::REPEATER,
				'id'      => 'features_list',
				'label'   => esc_html__( 'Add Feature List', 'gymat-core' ),
				'fields' => $repeater->get_controls(),
				'default' => array(
					['feature' => 'Weekly Class Schedule', ],
					['feature' => 'Modern Equipment', ],
					['feature' => 'Modern Equipment', ],
					['feature' => 'Student Free Access', ],
				),
				'condition' =>array('style'=>array('style3'))
			),
			array(
				'type'    => Controls_Manager::TEXTAREA,
				'id'      => 'content',
				'label'   => esc_html__( 'Content', 'gymat-core' ),
				'default' => esc_html__( 'Gymhen an unknown printer took a galley of type and scrambled.It has survived nknown printercenturies.', 'gymat-core' ),
				'condition' =>array('style'=>array('style1','style2','style4','style5','style6'))
			),
			array(
				'type'    => Controls_Manager::SLIDER,
				'id'      => 'banner_1_height',
				'label'   => esc_html__( 'Banner Min Height', 'gymat-core' ),
				'mode'	=>'responsive',
				'description' => esc_html__( 'Size Unit Px', 'gymat-core' ),
				'default'    => [
					'unit' => 'px',
					'size' => 750,
				],
				'range' => [
					'px' => [
						'max' => 1000,
						'min' => 200,
					],
					
				],
				'condition' =>[
					'style!'=>['style5','style6']
				],
				'selectors' => [
					'{{WRAPPER}} .rt-banner-addon ' => 'min-height: {{SIZE}}px;',
				],
			),
			array(
				'type'    => Controls_Manager::DIMENSIONS,
				'id'      => 'banner_margin',
				'mode'    => 'responsive',
				'label'   => esc_html__( 'Banner Content Space', 'gymat-core' ),
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .banner-content-wrap' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition' =>array('style'=>array('style1','style2','style4'))
			),
			array(
				'type'    => Controls_Manager::TEXT,
				'id'      => 'buttontext',
				'label'   => esc_html__( 'Button Text', 'gymat-core' ),
				'default' => esc_html__( 'Our Services', 'gymat-core' ),
				'condition' =>array('style'=>array('style1','style2','style4','style6'))
			),
			array(
				'type'    => Controls_Manager::URL,
				'id'      => 'url',
				'label'   => esc_html__( 'Button URL', 'gymat-core' ),
				'placeholder' => 'https://button-link.com',
				'condition' =>array('style'=>array('style1','style2','style4','style6'))
			),

            array(
				'type'        => Controls_Manager::SWITCHER,
				'id'          => 'follow_display',
				'label'       => esc_html__( 'Social Icon  Display', 'gymat-core' ),
				'label_on'    => esc_html__( 'On', 'gymat-core' ),
				'label_off'   => esc_html__( 'Off', 'gymat-core' ),
				'default'     => 'no',
				'description' => esc_html__( 'Show or Hide Content. Default: On', 'gymat-core' ),
				'condition' =>array('style'=>array('style1','style2'))
			),
            array(
				'type'        => Controls_Manager::SWITCHER,
				'id'          => 'shape_display',
				'label'       => esc_html__( 'Shape Image  Display', 'gymat-core' ),
				'label_on'    => esc_html__( 'On', 'gymat-core' ),
				'label_off'   => esc_html__( 'Off', 'gymat-core' ),
				'default'     => false,
				'description' => esc_html__( 'Show or Hide Content. Default: Off', 'gymat-core' ),
			),
			array(
				'type'    => Controls_Manager::MEDIA,
				'id'      => 'rt_image',
				'label'   => esc_html__( 'Banner Image', 'gymat-core' ),
				'default' => array(
                    'url' => Utils::get_placeholder_image_src(),
                ),
				'description' => esc_html__( 'Recommended full image', 'gymat-core' ),
				'condition'   => array( 'style' => array( 'style3','style4','style5','style6')),
			),
			array(
				'type'    => Group_Control_Image_Size::get_type(),
				'mode'    => 'group',				
				'label'   => esc_html__( 'image size', 'gymat-core' ),	
				'name' => 'icon_image_size', 
				'separator' => 'none',
				'condition'   => array( 'style' => array( 'style3','style5','style6')),		
			),
			array(
				'type'    => Controls_Manager::SLIDER,
				'id'      => 'gym_text_position',
				'label'   => esc_html__( 'Gym Text position', 'gymat-core' ),
				'mode'	=>'responsive',
				'description' => esc_html__( 'Size Unit Px', 'gymat-core' ),
				'size_units' => ['px','%'],
				'range' => [
					'px' => [
						'max' => 1000,
						'min' => -500,
					],
					'%'=>[
						'max' =>100,
						'min' =>-50
					]
					
				],
				'selectors' => [
					'{{WRAPPER}} .rt-banner-addon.style1 .gym-text-shape' => 'bottom: {{SIZE}}px;',
				],
				'condition'   => array( 'style' => array( 'style1')),
			), 
			array(
				'mode' => 'section_end',
			),
			array(
				'mode'    => 'section_start',
				'id'      => 'sec_image_position',
				'label'   => esc_html__( 'Image Position', 'gymat-core' ),
				'condition' =>[
					'style' =>['style5']
				]
			),
			array(
				'type'    => Controls_Manager::SLIDER,
				'id'      => 'image_position',
				'label'   => esc_html__( 'Image position 1', 'gymat-core' ),
				'mode'	=>'responsive',
				'description' => esc_html__( 'Size Unit Px', 'gymat-core' ),
				'size_units' => ['px','%'],
				'range' => [
					'px' => [
						'max' => 1000,
						'min' => -500,
					],
					'%'=>[
						'max' =>100,
						'min' =>-50
					]
					
				],
				'selectors' => [
					'{{WRAPPER}} .rt-discount-banner-addon .item-img' => 'top: {{SIZE}}px;',
				],
			),
			array(
				'type'    => Controls_Manager::SLIDER,
				'id'      => 'image_position2',
				'label'   => esc_html__( 'Image position 2', 'gymat-core' ),
				'mode'	=>'responsive',
				'description' => esc_html__( 'Size Unit Px', 'gymat-core' ),
				'size_units' => ['px','%'],
				'range' => [
					'px' => [
						'max' => 1000,
						'min' => -500,
					],
					'%'=>[
						'max' =>100,
						'min' =>-50
					]
				],
				'selectors' => [
					'{{WRAPPER}} .rt-discount-banner-addon .item-img' => 'right: {{SIZE}}px;',
				],
			),  
			array(
				'mode' => 'section_end',
			),
			// Title style
			array(
				'mode'    => 'section_start',
				'id'      => 'sec_title_style',
				'label'   => esc_html__( 'Title Style', 'gymat-core' ),
				'tab'     => Controls_Manager::TAB_STYLE,
				'condition'=>[
					'style!'=>['style5']
				]
			),
			array (
				'mode'    => 'group',
				'type'    => Group_Control_Typography::get_type(),
				'name'    => 'title_typo',
				'label'   => esc_html__( 'Title Typo', 'gymat-core' ),
				'selector' => '{{WRAPPER}} .rt-banner-addon .banner-content .banner-title',
			),
			array(
				'type'    => Controls_Manager::COLOR,
				'id'      => 'title_color',
				'label'   => esc_html__( 'Title Color', 'gymat-core' ),
				'default' => '',
				'selectors' => array(
					'{{WRAPPER}} .rt-banner-addon .banner-content .banner-title' => 'color: {{VALUE}}',
				),
			),
			array(
				'type'    => Controls_Manager::DIMENSIONS,
				'id'      => 'title_margin',
				'mode'    => 'responsive',
				'label'   => esc_html__( 'Title Space', 'gymat-core' ),
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .rt-banner-addon .banner-content .banner-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			),
			array(
				'mode' => 'section_end',
			),
			// SubTitle style
			array(
				'mode'    => 'section_start',
				'id'      => 'sec_subtitle_style',
				'label'   => esc_html__( 'Subtitle Style', 'gymat-core' ),
				'tab'     => Controls_Manager::TAB_STYLE,
				'condition'=>[
					'style!'=>['style5']
				]
			),
			array (
				'mode'    => 'group',
				'type'    => Group_Control_Typography::get_type(),
				'name'    => 'subtitle_typo',
				'label'   => esc_html__( 'Subtitle Typo', 'gymat-core' ),
				'selector' => '{{WRAPPER}} .rt-banner-addon .subtitle',
			),
			array(
				'type'    => Controls_Manager::COLOR,
				'id'      => 'subtitle_color',
				'label'   => esc_html__( 'Subtitle Color', 'gymat-core' ),
				'default' => '',
				'selectors' => array(
					'{{WRAPPER}} .rt-banner-addon .subtitle' => 'color: {{VALUE}}',
				),
			),
			array(
				'type'    => Controls_Manager::COLOR,
				'id'      => 'subtitle_shape_color',
				'label'   => esc_html__( 'Subtitle Shape Color', 'gymat-core' ),
				'default' => '',
				'selectors' => array(
					'{{WRAPPER}} .rt-banner-addon .subtitle' => 'background-color: {{VALUE}}',
				),
			),
			array(
				'type'    => Controls_Manager::DIMENSIONS,
				'id'      => 'subtitle_margin',
				'mode'    => 'responsive',
				'label'   => esc_html__( 'Subtitle Space', 'gymat-core' ),
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .rt-banner-addon .subtitle' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			),
			array(
				'mode' => 'section_end',
			),
			// Content style
			array(
				'mode'    => 'section_start',
				'id'      => 'sec_content_style',
				'label'   => esc_html__( 'Content Style', 'gymat-core' ),
				'tab'     => Controls_Manager::TAB_STYLE,
				'condition' =>array('style'=>array('style1','style2','style4','style6'))
			),
			array (
				'mode'    => 'group',
				'type'    => Group_Control_Typography::get_type(),
				'name'    => 'content_typo',
				'label'   => esc_html__( 'Content Typo', 'gymat-core' ),
				'selector' => '{{WRAPPER}} .rt-banner-addon .banner-content p ',
			),
			array(
				'type'    => Controls_Manager::COLOR,
				'id'      => 'content_color',
				'label'   => esc_html__( 'Content Color', 'gymat-core' ),
				'default' => '',
				'selectors' => array(
					'{{WRAPPER}} .rt-banner-addon .banner-content p ' => 'color: {{VALUE}}',
				),
			),
			array(
				'type'    => Controls_Manager::DIMENSIONS,
				'id'      => 'content_margin',
				'mode'    => 'responsive',
				'label'   => esc_html__( 'Content Space', 'gymat-core' ),
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .rt-banner-addon .banner-content p ' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			),
			array(
				'mode' => 'section_end',
			),
			array(
				'mode'    => 'section_start',
				'id'      => 'sec_social_style',
				'label'   => esc_html__( 'Social Share Style', 'gymat-core' ),
				'tab'     => Controls_Manager::TAB_STYLE,
				'condition'   =>array('style'=>array('style1','style2'))
			),
			array(
				'type'        => Controls_Manager::COLOR,
				'id'          => 'share_text_color',
				'label'       => esc_html__( 'Social Share Text', 'gymat-core' ),
				'default'     => '',
				'selectors' => array(
					'{{WRAPPER}} .rt-banner-addon .banner-social-section .text' => 'color: {{VALUE}}',
				),
			),
			array(
				'type'        => Controls_Manager::COLOR,
				'id'          => 'share_text_Link_color',
				'label'       => esc_html__( 'Social Share Link', 'gymat-core' ),
				'default'     => '',
				'selectors' => array(
					'{{WRAPPER}} .rt-banner-addon .banner-social-section a' => 'color: {{VALUE}}',
				),
			),
			array(
				'type'        => Controls_Manager::SLIDER,
				'id'          => 'share_position',
				'mode'		  =>'responsive',
				'label'       => esc_html__( 'Share Positioning', 'gymat-core' ),
				'size_units' => [ 'px', '%' ],
                'range' => [
                    'px' => [
                        'min' => -200,
                        'max' => 1000, 
                    ],
					'%' => [
						'min' => -50,
						'max' => 100,
					],
                ],
				
                'default' => [
					'unit' => '%',
				],
				'tablet_default' => [
					'unit' => '%',
				],
				'mobile_default' => [
					'unit' => '%',
				],
				'selectors' => array(
					'{{WRAPPER}} .rt-banner-addon.style1 .banner-social-section' => 'left: {{SIZE}}{{UNIT}}',
				),
				'condition' =>array('style'=>'style1')
			),
			array(
				'mode' => 'section_end',
			),
			// Feature List style
			array(
				'mode'    => 'section_start',
				'id'      => 'sec_feature_style',
				'label'   => esc_html__( 'Feature List Style', 'gymat-core' ),
				'tab'     => Controls_Manager::TAB_STYLE,
				'condition' =>array('style'=>'style3')
			),
			array(
				'type'        => Controls_Manager::COLOR,
				'id'          => 'percentage_text_color',
				'label'       => esc_html__( 'Percentage Text Color', 'gymat-core' ),
				'default'     => '',
				'selectors' => array(
					'{{WRAPPER}} .rt-banner-addon.style3 .item-discount' => 'color: {{VALUE}}',
					'{{WRAPPER}} .rt-banner-addon.style3 .item-off' => 'color: {{VALUE}}',
					'{{WRAPPER}} .rt-banner-addon.style3 .item-way-member' => 'color: {{VALUE}}',
				),
			),
			array(
				'type'        => Controls_Manager::COLOR,
				'id'          => 'feature_list_color',
				'label'       => esc_html__( 'Feature List Text Color', 'gymat-core' ),
				'default'     => '',
				'selectors' => array(
					'{{WRAPPER}} .rt-banner-addon.style3 .feature-list ul li' => 'color: {{VALUE}}',
				),
			),
			array(
				'mode' => 'section_end',
			),

			// rt discount banner addon title
			//style 5
			array(
				'mode'    => 'section_start',
				'id'      => 'sec_box_style_5',
				'label'   => esc_html__( 'Box Style', 'gymat-core' ),
				'tab'     => Controls_Manager::TAB_STYLE,
				'condition'=>[
					'style'=>['style5']
				]
			),
			array(
				'mode'    => 'group',
				'type'    => Group_Control_Background::get_type(),
				'name'      => 'box_bgcolor',
				'label'   => esc_html__( 'Box Color', 'gymat-core' ),
				'default' => '',
				'selector' => '{{WRAPPER}} .rt-discount-banner-addon'
			),
			array(
				'type'    => Controls_Manager::DIMENSIONS,
				'id'      => 'box_padding',
				'mode'    => 'responsive',
				'label'   => esc_html__( 'Box Padding', 'gymat-core' ),
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .rt-discount-banner-addon ' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			),
			array(
				'type'        => Controls_Manager::COLOR,
				'id'          => 'percentage5_text_color',
				'label'       => esc_html__( 'Percentage Text Color', 'gymat-core' ),
				'default'     => '',
				'selectors' => array(
					'{{WRAPPER}} .rt-discount-banner-addon .inner-banner .saving-part .discount' => 'color: {{VALUE}}',
				),
			),
			array(
				'type'        => Controls_Manager::COLOR,
				'id'          => 'content5_color',
				'label'       => esc_html__( 'Content Text Color', 'gymat-core' ),
				'default'     => '',
				'selectors' => array(
					'{{WRAPPER}} .rt-discount-banner-addon .inner-banner .saving-part .save' => 'color: {{VALUE}}',
				),
			),
			array(
				'mode' => 'section_end',
			),
			array(
				'mode'    => 'section_start',
				'id'      => 'sec_title_style_5',
				'label'   => esc_html__( 'Title Style', 'gymat-core' ),
				'tab'     => Controls_Manager::TAB_STYLE,
				'condition'=>[
					'style'=>['style5']
				]
			),
			array (
				'mode'    => 'group',
				'type'    => Group_Control_Typography::get_type(),
				'name'    => 'title_typo_5',
				'label'   => esc_html__( 'Title Typo', 'gymat-core' ),
				'selector' => '{{WRAPPER}} .rt-discount-banner-addon .inner-banner .title-part .title',
			),
			array(
				'type'    => Controls_Manager::COLOR,
				'id'      => 'title_color_5',
				'label'   => esc_html__( 'Title Color', 'gymat-core' ),
				'default' => '',
				'selectors' => array(
					'{{WRAPPER}} .rt-discount-banner-addon .inner-banner .title-part .title' => 'color: {{VALUE}}',
				),
			),
			array(
				'mode' => 'section_end',
			),
			array(
				'mode'    => 'section_start',
				'id'      => 'sec_subtitle_style_5',
				'label'   => esc_html__( 'Subtitle Style', 'gymat-core' ),
				'tab'     => Controls_Manager::TAB_STYLE,
				'condition'=>[
					'style'=>['style5']
				]
			),
			array (
				'mode'    => 'group',
				'type'    => Group_Control_Typography::get_type(),
				'name'    => 'subtitle_typo_5',
				'label'   => esc_html__( 'Subtitle Typo', 'gymat-core' ),
				'selector' => '{{WRAPPER}} .rt-discount-banner-addon .inner-banner .title-part .banner-subtitle',
			),
			array(
				'type'    => Controls_Manager::COLOR,
				'id'      => 'subtitle_color_5',
				'label'   => esc_html__('Subtitle Color', 'gymat-core' ),
				'default' => '',
				'selectors' => array(
					'{{WRAPPER}} .rt-discount-banner-addon .inner-banner .title-part .banner-subtitle' => 'color: {{VALUE}}',
				),
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
			case 'style6':
			$template = 'banner-6';
			break;
			case 'style5':
			$template = 'banner-5';
			break;
			case 'style4':
			$template = 'banner-4';
			break;
			case 'style3':
			$template = 'banner-3';
			break;
			case 'style2':
			$template = 'banner-2';
			break;
			default:
			$template = 'banner';
			break;
		}
		return $this->rt_template( $template, $data );
	}
}
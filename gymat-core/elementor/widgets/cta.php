<?php
/**
 * @author  desvertTheme
 * @since   1.0
 * @version 1.0
 */

namespace desvertTheme\Gymat_Core;
use Elementor\Group_Control_Image_Size;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;

if ( ! defined( 'ABSPATH' ) ) exit;

class CTA extends Custom_Widget_Base {

	public function __construct( $data = [], $args = null ){
		$this->rt_name = esc_html__( 'DV Call to Action', 'gymat-core' );
		$this->rt_base = 'rt-cta';
		parent::__construct( $data, $args );
	}
	
	public function rt_fields(){
		$fields = array(
			array(
				'mode'    => 'section_start',
				'id'      => 'sec_general',
				'label'   => esc_html__( 'General', 'gymat-core' ),
			),
			array(
				'type'    => Controls_Manager::SELECT2,
				'id'      => 'style',
				'label'   => esc_html__( 'CTA Style', 'gymat-core' ),
				'options' => array(
					'style1' => esc_html__( 'Style 1' , 'gymat-core' ),
					'style2' => esc_html__( 'Style 2', 'gymat-core' ),
					'style3' => esc_html__( 'Style 3', 'gymat-core' ),
				),
				'default' => 'style1',
			),
			array(
				'type' => Controls_Manager::CHOOSE,
				'id'      => 'content_align',
				'mode'    => 'responsive',
				'label'   => esc_html__( 'Alignment', 'gymat-core' ),
				'options' => array(
					'left' => array(
						'title' => __( 'Left', 'elementor' ),
						'icon' => 'eicon-text-align-left',
					),
					'center' => array(
						'title' => __( 'Center', 'elementor' ),
						'icon' => 'eicon-text-align-center',
					),
					'right' => array(
						'title' => __( 'Right', 'elementor' ),
						'icon' => 'eicon-text-align-right',
					),
					'justify' => array(
						'title' => __( 'Justified', 'elementor' ),
						'icon' => 'eicon-text-align-justify',
					),
				),
				'default' => 'center',
				'selectors' => array(
					'{{WRAPPER}}' => 'text-align: {{VALUE}};',
				),
				'condition'   => array('style' => array( 'style2')),
			),
			array(
				'type'    => Controls_Manager::ICONS,
				'id'      => 'icon_class',
				'label'   => esc_html__( 'Icon', 'gymat-core' ),
				'default' => array(
			      'value' => '',
			      'library' => 'fa-solid',
				),
                'condition' =>array('style'=>array('style3'))
			),
			array(
				'type'    => Controls_Manager::TEXTAREA,
				'id'      => 'title',
				'label'   => esc_html__( 'Title', 'gymat-core' ),
				'default' => esc_html__( 'We Are Always Provide Best Fitness Service For You', 'gymat-core' ),
			),
			array(
				'type'    => Controls_Manager::TEXT,
				'id'      => 'sub_title',
				'label_block'=>true,
				'label'   => esc_html__( 'Subtitle', 'gymat-core' ),
				'default' =>'',
				'condition' =>array('style'=>'style3')
			),
			array(
				'type'    => Controls_Manager::TEXTAREA,
				'id'      => 'pho_number',
				'label_block'=>true,
				'label'   => esc_html__( 'Phone Number', 'gymat-core' ),
				'default' => 'Call:+130-4044888',
				'condition'   => array( 'style' => array( 'style2') ),
			),
			array(
				'type'    => Controls_Manager::MEDIA,
				'id'      => 'image',
				'label'   => esc_html__( 'Image', 'gymat-core' ),
				'description' => esc_html__( 'Recommended full image size', 'gymat-core' ),
				'condition'   => array( 'style' => array('style3' ) ),
			),
			array(
				'type'    => Group_Control_Image_Size::get_type(),
				'mode'    => 'group',				
				'label'   => esc_html__( 'image size', 'gymat-core' ),	
				'name' => 'image_size', 
				'separator' => 'none',
				'condition'   => array( 'style' => array('style3' ) ),		
			),
			array(
				'type'    	  => Controls_Manager::TEXT,
				'id'      	  => 'buttontext',
				'label_block'=>true,
				'label'   	  => esc_html__( 'Button Text', 'gymat-core' ),
				'default' 	  => esc_html__( 'Join Our Team', 'gymat-core' ),
			),
			array(
				'type'    => Controls_Manager::URL,
				'id'      => 'buttonurl',
				'label'   => esc_html__( 'Button URL', 'gymat-core' ),
				'placeholder' => 'https://your-link.com',	
			),
			array(
				'type'        => Controls_Manager::SWITCHER,
				'id'          => 'shape1_display',
				'label'       => esc_html__( 'Shape 1', 'gymat-core' ),
				'label_on'    => esc_html__( 'On', 'gymat-core' ),
				'label_off'   => esc_html__( 'Off', 'gymat-core' ),
				'default'     => 'yes',
				'description' => esc_html__( 'Show or Hide Content. Default: On', 'gymat-core' ),
				'condition'   => array( 'style' => array('style1')),
			),
			array(
				'type'        => Controls_Manager::SWITCHER,
				'id'          => 'shape2_display',
				'label'       => esc_html__( 'Shape 2', 'gymat-core' ),
				'label_on'    => esc_html__( 'On', 'gymat-core' ),
				'label_off'   => esc_html__( 'Off', 'gymat-core' ),
				'default'     => 'yes',
				'description' => esc_html__( 'Show or Hide Content. Default: On', 'gymat-core' ),
				'condition'   => array( 'style' => array('style1')),
			),
			array(
				'type'    => Controls_Manager::SLIDER,
				'id'      => 'image-box_width',
				'label'   => esc_html__( 'Image Box Width', 'gymat-core' ),
				'mode'	=>'responsive',
				'description' => esc_html__( 'Size Unit Px', 'gymat-core' ),
				'default'    => [
					'unit' => 'px',
					'size' => 315,
				],
				'range' => [
					'px' => [
						'max' => 1000,
						'min' => 0,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .cta-default.cta-style3 .cta-img' => 'flex-basis: {{SIZE}}px;',
				],
				'condition'   => array( 'style' => array('style3')),
			),
			array(
				'type'    => Controls_Manager::SLIDER,
				'id'      => 'image-box_position',
				'label'   => esc_html__( 'Image Box Shape 1 Position', 'gymat-core' ),
				'mode'	=>'responsive',
				'description' => esc_html__( 'Size Unit Px', 'gymat-core' ),
				'default'    => [
					'unit' => 'px',
				],
				'range' => [
					'px' => [
						'max' => 1000,
						'min' => 0,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .cta-default.cta-style3 .cta-img:after' => 'left: {{SIZE}}px;',
				],
				'condition'   => array( 'style' => array('style3')),
			),
			array(
				'type'    => Controls_Manager::SLIDER,
				'id'      => 'image-box_position2',
				'label'   => esc_html__( 'Image Box Shape 2 Position', 'gymat-core' ),
				'mode'	=>'responsive',
				'description' => esc_html__( 'Size Unit Px', 'gymat-core' ),
				'default'    => [
					'unit' => 'px',
				],
				'range' => [
					'px' => [
						'max' => 1000,
						'min' => 0,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .cta-default.cta-style3 .cta-img:before' => 'left: {{SIZE}}px;',
				],
				'condition'   => array( 'style' => array('style3')),
			),
			array(
				'type'    => Controls_Manager::DIMENSIONS,
				'id'      => 'cta_padding',
				'mode'    => 'responsive',
				'label'   => esc_html__( 'CTA Padding', 'gymat-core' ),
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .cta-default.cta-style1 .action-box .call-to-action-box-1' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition'   => array( 'style' => array('style1')),
			),

			array(
				'mode' => 'section_end',
			),
			// Title style
			array(
				'mode'    => 'section_start',
				'id'      => 'sec_title_style',
				'label'   => esc_html__( 'CTA Style', 'gymat-core' ),
				'tab'     => Controls_Manager::TAB_STYLE,
			),
			array (
				'mode'    => 'group',
				'type'    => Group_Control_Typography::get_type(),
				'name'    => 'title_typo',
				'label'   => esc_html__( 'Title Typo', 'gymat-core' ),
				'selector' => '{{WRAPPER}} .cta-default .action-box h2',
			),			
			array(
				'type'    => Controls_Manager::COLOR,
				'id'      => 'title_color',
				'label'   => esc_html__( 'Title Color', 'gymat-core' ),
				'default' => '',
				'selectors' => array(
					'{{WRAPPER}} .cta-default .action-box h2' => 'color: {{VALUE}}',
				),
			),
			array (
				'mode'    => 'group',
				'type'    => Group_Control_Typography::get_type(),
				'name'    => 'phone_title_typo',
				'label'   => esc_html__( 'Phone Typo', 'gymat-core' ),
				'selector' => '{{WRAPPER}} .cta-default.cta-style2 .cta-phone',
				'condition'   => array( 'style' => array( 'style2') ),
			),
			array(
				'type'    => Controls_Manager::COLOR,
				'id'      => 'info6_phone_color',
				'label'   => esc_html__( 'Phone Text Color', 'gymat-core' ),
				'default' => '',
				'selectors' => array(
					'{{WRAPPER}} .cta-default.cta-style2 .cta-phone' => 'color: {{VALUE}}',
				),
				'condition'   => array( 'style' => array( 'style2' ) ),
			),
			array(
				'type'    => Controls_Manager::COLOR,
				'id'      => 'icon_color',
				'label'   => esc_html__( 'Icon Color', 'gymat-core' ),
				'default' => '',
				'selectors' => array(
					'{{WRAPPER}} .cta-default.cta-style3 .action-box .cta-content.has-icon .icon' => 'color: {{VALUE}}',
				),
				'condition'   => array( 'style' => array( 'style3' ) ),
			),			
			array(
				'type'    => Controls_Manager::COLOR,
				'id'      => 'button_color',
				'label'   => esc_html__( 'Button Color', 'gymat-core' ),
				'default' => '',
				'selectors' => array(
					'{{WRAPPER}} .cta-default .btn-style2 span' => 'color: {{VALUE}}',
					'{{WRAPPER}}  .cta-default .btn-style1 span' => 'color: {{VALUE}}',
				),
				'condition'   => array( 'style' => array('style1','style2' ) ),
			),
			array(
				'type'    => Controls_Manager::COLOR,
				'id'      => 'button_icon_color',
				'label'   => esc_html__( 'Button Icon Color', 'gymat-core' ),
				'default' => '',
				'selectors' => array(
					'{{WRAPPER}} .cta-default.cta-style1 .action-box .call-to-action-box-1 .item-button .btn-style2 svg path' => 'fill: {{VALUE}}',
					'{{WRAPPER}} .cta-default.cta-style2 .action-box  .btn-style1 svg path' => 'fill: {{VALUE}}',
				),
				'condition'   => array( 'style' => array('style1','style2' ) ),
			),
			array(
				'type'    => Controls_Manager::DIMENSIONS,
				'id'      => 'title_margin',
				'mode'    => 'responsive',
				'label'   => esc_html__( 'Title Space', 'finbuzz-core' ),
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .cta-default .cta-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			),
			array(
				'type'    => Controls_Manager::DIMENSIONS,
				'id'      => 'subtitle_margin',
				'mode'    => 'responsive',
				'label'   => esc_html__( 'Subtitle Space', 'finbuzz-core' ),
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .cta-default.cta-style3 .sub-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition'   => array( 'style' => array('style3') ),
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
			case 'style3':
			$template = 'cta-3';
			break;
			case 'style2':
			$template = 'cta-2';
			break;
			default:
			$template = 'cta-1';
			break;
		}
		return $this->rt_template( $template, $data );
	}
}
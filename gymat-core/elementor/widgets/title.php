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

class Title extends Custom_Widget_Base {

	public function __construct( $data = [], $args = null ){
		$this->rt_name = esc_html__( 'DV Section Title', 'gymat-core' );
		$this->rt_base = 'rt-title';
		parent::__construct( $data, $args );
	}

	public function rt_fields(){
		$fields = array(
			array(
				'mode'    => 'section_start',
				'id'      => 'sec_general',
				'label'   => esc_html__( 'Section Title', 'gymat-core' ),
			),
			/*box title*/
			array(
				'type'    => Controls_Manager::SELECT2,
				'id'      => 'style',
				'label'   => esc_html__( 'Title Style', 'gymat-core' ),
				'options' => array(
					'style1' => esc_html__( 'Title Style 1' , 'gymat-core' ),
					'style2' => esc_html__( 'Title Style 2', 'gymat-core' ),
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
				'default' => '',
				'selectors' => array(
					'{{WRAPPER}}' => 'text-align: {{VALUE}};',
				),
				'condition'   => array( 'style' => array( 'style1', 'style2' ) ),
			),
			
			/*Icon Start*/
			array(					 
			   'type'    => Controls_Manager::CHOOSE,
			   'options' => array(
			     'icon' => array(
			       'title' => esc_html__( 'Left', 'gymat-core' ),
			       'icon' => 'fas fa-smile',
			     ),
			     'image' => array(
			       'title' => esc_html__( 'Center', 'gymat-core' ),
			       'icon' => 'fas fa-image',
			     ),		     
			   ),
			   'id'      => 'icontype',
			   'label'   => esc_html__( 'Media Type', 'gymat-core' ),
			   'default' => 'icon',
			   'label_block' => false,
			   'toggle' => false,
			),
			array(
				'type'    => Controls_Manager::ICONS,
				'id'      => 'icon_class',
				'label'   => esc_html__( 'Icon', 'gymat-core' ),
				'default' => array(
			      'value' => 'fas fa-smile-wink',
			      'library' => 'fa-solid',
			  ),	
			  	'condition'   => array('icontype' => array( 'icon' ) ),
			),	
			array(
				'type'    => Controls_Manager::MEDIA,
				'id'      => 'icon_image',
				'label'   => esc_html__( 'Image', 'gymat-core' ),
				'default' => array(
                    'url' => Utils::get_placeholder_image_src(),
                ),
				'condition'   => array('icontype' => array( 'image' ) ),
				'description' => esc_html__( 'Recommended full image', 'gymat-core' ),
			),
			array(
				'type'    => Group_Control_Image_Size::get_type(),
				'mode'    => 'group',				
				'label'   => esc_html__( 'image size', 'gymat-core' ),	
				'name' => 'icon_image_size', 
				'separator' => 'none',		
				'condition'   => array('icontype' => array( 'image' ) ),
			),
			/*Icon end*/
			array(
				'type'    => Controls_Manager::TEXTAREA,
				'id'      => 'title',
				'label'   => esc_html__( 'Title', 'gymat-core' ),
				'default' => 'Wellcome To Gymat',
			),
			array(
				'type'    => Controls_Manager::TEXTAREA,
				'id'      => 'sub_title',
				'label'   => esc_html__( 'Sub Title', 'gymat-core' ),
				'default' => esc_html__( 'SUB TITLE', 'gymat-core' ),
				'condition'   => array( 'style' => array('style2') ),
			),			
			array(
				'type'    => Controls_Manager::WYSIWYG,
				'id'      => 'content',
				'label'   => esc_html__( 'Content', 'gymat-core' ),
				'default' => esc_html__( 'Our agency can only be as strong as our people our team agenhave run their businesses designed.', 'gymat-core' ),
				'condition'   => array( 'style' => array( 'style1','style2' ) ),
			),
			array(
				'mode' => 'section_end',
			),


			/***Style Option * */
			
			/*Title Style Option*/
			
			array (
				'mode'    => 'section_start',
				'id'      => 'section_title_style',
				'label'   => esc_html__( 'Title Style', 'gymat-core' ),
				'tab'     => Controls_Manager::TAB_STYLE,
				
			),
			array (
				'mode'    => 'group',
				'type'    => Group_Control_Typography::get_type(),
				'name'    => 'section_title_typo',
				'label'   => esc_html__( 'Title Typo', 'gymat-core' ),
				'selector' => '{{WRAPPER}} .sec-title .rtin-title',
			),
			array(
				'type'    => Controls_Manager::COLOR,
				'id'      => 'section_title_color',
				'label'   => esc_html__( 'Title Color', 'gymat-core' ),
				'default' => '',
				'selectors' => array(
					'{{WRAPPER}} .sec-title .rtin-title' => 'color: {{VALUE}}',
				),
			),
			array(
				'type'    => Controls_Manager::DIMENSIONS,
				'id'      => 'title_margin',
				'mode'    => 'responsive',
				'label'   => esc_html__( 'Title Space', 'gymat-core' ),
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .sec-title .sec-title-holder .rtin-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			),
			array(
				'type'        => Controls_Manager::SLIDER,
				'id'          => 'title_shape_position',
				'mode'		  =>'responsive',
				'label'       => esc_html__( 'Title Shape Positioning 1', 'gymat-core' ),
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
					'{{WRAPPER}} .sec-title.style2 .title-shape' => 'right: {{SIZE}}{{UNIT}}',
				),
				'condition' =>array('style'=>'style2')
			),
			array(
				'type'        => Controls_Manager::SLIDER,
				'id'          => 'title_shape_position2',
				'mode'		  =>'responsive',
				'label'       => esc_html__( 'Title Shape Positioning 2', 'gymat-core' ),
				'size_units' => [ 'px', '%' ],
                'range' => [
                    'px' => [
                        'min' => -500,
                        'max' => 1000, 
                    ],
					'%' => [
						'min' => -50,
						'max' => 100,
					],
                ],
                'default' => [
					'unit' => 'px',
				],
				'tablet_default' => [
					'unit' => 'px',
				],
				'mobile_default' => [
					'unit' => 'px',
				],
				'selectors' => array(
					'{{WRAPPER}} .sec-title.style2 .title-shape' => 'bottom: {{SIZE}}{{UNIT}}',
				),
				'condition' =>array('style'=>'style2')
			),
			array(
				'mode' => 'section_end',
			),

			/**Subtitle Style */
			array(
				'mode'    => 'section_start',
				'id'      => 'section_subtitle',
				'label'   => esc_html__( 'Subtitle Text', 'gymat-core' ),
				'tab'     => Controls_Manager::TAB_STYLE,
				'condition'   => array( 'style' => array('style2' ) ),
				
			),
			array (
				'mode'    => 'group',
				'type'    => Group_Control_Typography::get_type(),
				'name'    => 'sub_title_typo',
				'label'   => esc_html__( 'Sub Title Style', 'gymat-core' ),
				'selector' => '{{WRAPPER}} .sec-title .sub-title',
				'condition'   => array( 'style' => array('style2' ) ),
			),
			array(
				'type'    => Controls_Manager::COLOR,
				'id'      => 'section_subtitle_color',
				'label'   => esc_html__( 'Sub Title Color', 'gymat-core' ),
				'default' => '',
				'selectors' => array(
					'{{WRAPPER}} .sec-title .sub-title' => 'color: {{VALUE}}',
				),
			),
			array(
				'type'    => Controls_Manager::DIMENSIONS,
				'id'      => 'subtitle_margin',
				'mode'    => 'responsive',
				'label'   => esc_html__( 'Subtitle Space', 'gymat-core' ),
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .sec-title .sub-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			),
			array(
				'mode' => 'section_end',
			),

			/**Content Style  */

			array(
				'mode'    => 'section_start',
				'id'      => 'section_content',
				'label'   => esc_html__( 'Content Text', 'gymat-core' ),
				'tab'     => Controls_Manager::TAB_STYLE,
			),
			array (
				'mode'    => 'group',
				'type'    => Group_Control_Typography::get_type(),
				'name'    => 'content',
				'label'   => esc_html__( 'Content Title Style', 'gymat-core' ),
				'selector' => '{{WRAPPER}} .rtin-text',
				
			),
			array(
				'type'    => Controls_Manager::COLOR,
				'id'      => 'content_color',
				'label'   => esc_html__( 'Content Color', 'gymat-core' ),
				'default' => '',
				'selectors' => array(
					'{{WRAPPER}} .content' => 'color: {{VALUE}}',
				),
				
			),
			array(
				'mode' => 'section_end',
			),


			/**Icon Style */

			array(
				'mode'    => 'section_start',
				'id'      => 'section_icon',
				'label'   => esc_html__( 'Icon Style', 'gymat-core' ),
				'tab'     => Controls_Manager::TAB_STYLE,
			),
			array(
				'type'    => Controls_Manager::COLOR,
				'id'      => 'icon_color',
				'label'   => esc_html__( 'Icon Color', 'gymat-core' ),
				'default' => '',
				'selectors' => array(
					'{{WRAPPER}} .sec-title .rtin-icon i' => 'color: {{VALUE}}',
				),
			),
			array(
				'type'    => Controls_Manager::DIMENSIONS,
				'id'      => 'icon_margin',
				'mode'    => 'responsive',
				'label'   => esc_html__( 'Icon Space', 'gymat-core' ),
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .sec-title .rtin-icon i' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
			
			case 'style2':
			$template = 'title-2';
			break;
			default:
			$template = 'title-1';
			break;
		}

		return $this->rt_template( $template, $data );
	}
}
<?php
/**
 * @author  desvertTheme
 * @since   1.0
 * @version 1.0
 */

namespace desvertTheme\Gymat_Core;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Background;

if ( ! defined( 'ABSPATH' ) ) exit;

class RT_Button extends Custom_Widget_Base{
    public function __construct( $data = [], $args = null ){
		$this->rt_name = esc_html__( 'DV Button', 'gymat-core' );
		$this->rt_base = 'button';
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
				'label'   => esc_html__( 'Button Style', 'gymat-core' ),
				'options' => array(
					'style1' => esc_html__( 'Button 1' , 'gymat-core' ),
					'style2' => esc_html__( 'Button 2', 'gymat-core' ),
					'style3' => esc_html__( 'Button 3', 'gymat-core' ),
				),
				'default' => 'style1',
			),
			array(
				'type' => Controls_Manager::CHOOSE,
				'id'      => 'content_align',
				'mode'	  => 'responsive',
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
				),
				'default' => '',
				'selectors' => array(
					'{{WRAPPER}}' => 'text-align: {{VALUE}};',
				),
			),
			array(
				'type'    => Controls_Manager::ICONS,
				'id'      => 'icon_class',
				'label'   => esc_html__( 'Icon', 'gymat-core' ),
				'default' => array(
			      'value' => 'fas fa-smile-wink',
			      'library' => 'fa-solid',
				),	
			),
			array(
				'type'    => Controls_Manager::SELECT2,
				'id'      => 'icon_position',
				'label'   => esc_html__( 'Icon Position', 'gymat-core' ),
				'options' => array(
					'icon-left'   => esc_html__( 'Icon Left', 'gymat-core' ),
					'icon-right'   => esc_html__( 'Icon Right', 'gymat-core' ),
				),
				'default' => 'icon-left',
			),
			array(
				'type'    	  => Controls_Manager::TEXT,
				'id'      	  => 'buttontext',
				'label'   	  => esc_html__( 'Button Text', 'gymat-core' ),
				'default' 	  => esc_html__( 'Read More', 'gymat-core' ),
			),
			array(
				'type'    => Controls_Manager::URL,
				'id'      => 'buttonurl',
				'label'   => esc_html__( 'Button URL', 'gymat-core' ),
				'placeholder' => 'https://your-link.com',
			),
			array(
				'mode' => 'section_end',
			),

			// Button style 1
			array(
				'mode'    => 'section_start',
				'id'      => 'sec_button_style',
				'label'   => esc_html__( 'Button Style', 'gymat-core' ),
				'tab'     => Controls_Manager::TAB_STYLE,
			),
			// Tab For Normal view.
			array(
				'mode' => 'tabs_start',
				'id'   => 'icon_tabs_start',
			),			
			array(
				'mode'  => 'tab_start',
				'id'    => 'rt_tab_normal_post',
				'label' => esc_html__( 'Normal', 'gymat-core' ),
			),
			array (
				'mode'    => 'group',
				'type'    => Group_Control_Typography::get_type(),
				'name'    => 'button_typo',
				'label'   => esc_html__( 'Button Typo', 'gymat-core' ),
				'selector' => '{{WRAPPER}} .rt-button a',
			),
			array(
				'type'    => Controls_Manager::COLOR,
				'id'      => 'button_text_color',
				'label'   => esc_html__( 'Button Text Color', 'gymat-core' ),
				'default' => '',
				'selectors' => array(
					'{{WRAPPER}} .rt-button .btn-style1 span' => 'color: {{VALUE}}',
					'{{WRAPPER}} .rt-button .btn-style2 span' => 'color: {{VALUE}}',
					'{{WRAPPER}} .rt-button .btn-style3 span' => 'color: {{VALUE}}',
				),
			),
			array(
				'type'    => Controls_Manager::COLOR,
				'id'      => 'button_bg_color',
				'label'   => esc_html__( 'Button Background Color', 'gymat-core' ),
				'default' => '',
				'selectors' => array(
					'{{WRAPPER}} .rt-button .btn-style1 span' => 'background-color: {{VALUE}}',
					'{{WRAPPER}} .rt-button .btn-style2 span' => 'background-color: {{VALUE}}',
					'{{WRAPPER}} .rt-button .btn-style3 span' => 'background-color: {{VALUE}}',
				),
			),
			array(
				'type'    => Controls_Manager::COLOR,
				'id'      => 'icon_color',
				'label'   => esc_html__( 'Icon Color', 'gymat-core' ),
				'default' => '',
				'selectors' => array(
					'{{WRAPPER}} .rt-button .btn-style1 span i' => 'color: {{VALUE}}',
					'{{WRAPPER}} .rt-button .btn-style2 span i' => 'color: {{VALUE}}',
					'{{WRAPPER}} .rt-button .btn-style3 span i' => 'color: {{VALUE}}',
				),
			),			
			array (
				'mode'    => 'group',
				'type'    => Group_Control_Typography::get_type(),
				'name'    => 'Icon_typo',
				'label'   => esc_html__( 'Icon Typo', 'gymat-core' ),
				'selector' => '{{WRAPPER}} .rt-button a span i',
			),
			array(
				'type'    => Controls_Manager::DIMENSIONS,
				'id'      => 'icon_space',
				'mode'    => 'responsive',
				'label'   => esc_html__( 'Icon Spacing', 'gymat-core' ),
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .rt-button .btn-style1 span' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .rt-button .btn-style1 span img' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .rt-button .btn-style2 span' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .rt-button .btn-style2 span img' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .rt-button .btn-style3 span img' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .rt-button .btn-style3 span' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'separator'  => 'before',
			),
			array(
				'type'    => Controls_Manager::DIMENSIONS,
				'id'      => 'button_space',
				'mode'    => 'responsive',
				'label'   => esc_html__( 'Button Spacing', 'gymat-core' ),
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .rt-button .btn-style1' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .rt-button .btn-style2' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .rt-button .btn-style3' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'separator'  => 'before',
			),
			array(
				'mode' => 'tab_end',
			),
			// Tab For hover view.
			array(
				'mode'  => 'tab_start',
				'id'    => 'rt_tab_hover_post',
				'label' => esc_html__( 'Hover', 'gymat-core' ),
			),
			array(
				'type'    => Controls_Manager::COLOR,
				'id'      => 'button_text_hover_color',
				'label'   => esc_html__( 'Button Text Hover Color', 'gymat-core' ),
				'default' => '',
				'selectors' => array(
					'{{WRAPPER}} .rt-button .btn-style1 span:hover' => 'color: {{VALUE}}',
					'{{WRAPPER}} .rt-button .btn-style2 span:hover' => 'color: {{VALUE}}',
					'{{WRAPPER}} .rt-button .btn-style3 span:hover' => 'color: {{VALUE}}',
				),
			),
			array(
				'type'    => Controls_Manager::COLOR,
				'id'      => 'button_bg_hover_color',
				'label'   => esc_html__( 'Button Background Hover Color', 'gymat-core' ),
				'default' => '',
				'selectors' => array(
					'{{WRAPPER}} .rt-button .btn-style1:hover span' => 'background-color: {{VALUE}}',
					'{{WRAPPER}} .rt-button .btn-style2:hover span' => 'background-color: {{VALUE}}',
					'{{WRAPPER}} .rt-button .btn-style3:hover span' => 'background-color: {{VALUE}}',
				),
			),
			array(
				'type'    => Controls_Manager::COLOR,
				'id'      => 'icon_hover_color',
				'label'   => esc_html__( 'Icon Hover Color', 'gymat-core' ),
				'default' => '',
				'selectors' => array(
					'{{WRAPPER}} .rt-button .btn-style1:hover i' => 'color: {{VALUE}}',
					'{{WRAPPER}} .rt-button .btn-style2:hover i' => 'color: {{VALUE}}',
					'{{WRAPPER}} .rt-button .btn-style3:hover i' => 'color: {{VALUE}}',
				),
			),
			array(
				'mode' => 'tab_end',
			),
			array(
				'mode' => 'tabs_end',
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
			$template = 'button-3';
			break;
			case 'style2':
			$template = 'button-2';
			break;
			default:
			$template = 'button';
			break;
		}
		return $this->rt_template( $template, $data );
	}
}
<?php
/**
 * @author  desvertTheme
 * @since   1.0
 * @version 1.0
 */

namespace desvertTheme\Gymat_Core;

use GymatTheme;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Utils;


if ( ! defined('ABSPATH' ) ) exit;

class RT_Feature_Class extends Custom_Widget_Base {

    public function __construct( $data = [], $args = null ) {
        $this->rt_name  = __( 'DV Feature Class', 'gymat-core' );
        $this->rt_base  = 'rt-feature-class';
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
    public function rt_fields() {

        $fields = array(
            array(
                'mode'  => 'section_start',
                'id'    => 'section_general',
                'label' => __( 'General', 'gymat-core' )
            ),
            array(
				'type'    => Controls_Manager::NUMBER,
				'id'      => 'schedule_number',
				'label'   => esc_html__( 'Number of schedule to show', 'gymat-core' ),
				'default' => '',
				'description' => esc_html__( 'Write 1 to show only 1 day schedule', 'gymat-core' ),
			),
            array(
                'id'      => 'postid',
                'label'  => esc_html__( 'Selects posts', 'gymat-core' ),
                'type'   => Controls_Manager::SELECT2,
                'options' => $this->get_all_posts('gymat_class'),
                'label_block' => true,
                'multiple' => false,
            ),
            array(
				'type'    => Controls_Manager::NUMBER,
				'id'      => 'title_count',
				'label'   => esc_html__( 'Title Word count', 'gymat-core' ),
				'default' => 5,
				'description' => esc_html__( 'Maximum number of words', 'gymat-core' ),				
			),
            array(
				'type'        => Controls_Manager::SWITCHER,
				'id'          => 'icon_display',
				'label'       => esc_html__( 'Icon Display', 'gymat-core' ),
				'label_on'    => esc_html__( 'On', 'gymat-core' ),
				'label_off'   => esc_html__( 'Off', 'gymat-core' ),
				'default'     => 'yes',
				'description' => esc_html__( 'Show or Hide More Button . Default: On', 'gymat-core' ),
				
			),
            array(
				'type' 				=> Controls_Manager::SLIDER,
				'mode' 				=> 'responsive',
				'id'      		=> 'box_height',
				'label'   		=> esc_html__( 'Height', 'consalty-core' ),
				'size_units' => array( 'px' ),
				 'range' => [
				 'px' => [
				   'min' => 0,
				   'max' => 900,
				 ],
			   ],
				'default' => array(
				'unit' => 'px',
				'size' => 550,
				),
				'selectors' => array(
					'{{WRAPPER}} .class-multilayout-3.feature-class .class-thumbnail' => 'height: {{SIZE}}{{UNIT}};',	
					'{{WRAPPER}} .class-multilayout-3.feature-class .class-thumbnail > a > img' => 'height: {{SIZE}}{{UNIT}};;object-fit:cover;',		
				),
			),
            array(
                'mode'  => 'section_end'
            ),
            
            //  style
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
				'label'   => esc_html__( 'Item Title Typo', 'gymat-core' ),
                'selector' => '{{WRAPPER}} .class-default .class-title',
			),
            array (
				'mode'    => 'group',
				'type'    => Group_Control_Typography::get_type(),
				'name'    => 'schedule_typo',
				'label'   => esc_html__( 'Schedule Typo', 'gymat-core' ),
                'selector' => '{{WRAPPER}} .class-multilayout-3 .class-item .schedule',
			),
            array(
				'type'    => Controls_Manager::NUMBER,
				'id'      => 'icon_size',
				'label'   => esc_html__( 'Icon Size', 'gymat-core' ),
				'default' => '',
				'selectors' => array(
					'{{WRAPPER}} .class-multilayout-3 .class-media .class-icon i' => 'font-size: {{VALUE}}px',
				),
			),
            array (
				'type'    => Controls_Manager::COLOR,
				'id'      => 'class_title_color',
				'label'   => esc_html__( 'Title Color', 'gymat-core' ),
				'default' => '',
				'selectors' => array( 
					'{{WRAPPER}} .class-default .class-title a' => 'color: {{VALUE}}',
				),
			),
            array (
				'type'    => Controls_Manager::COLOR,
				'id'      => 'class_title_hover_color',
				'label'   => esc_html__( 'Title Hover Color', 'gymat-core' ),
				'default' => '',
				'selectors' => array( 
					'{{WRAPPER}} .class-default .class-title a:hover' => 'color: {{VALUE}}',
				),
			),
			array (
				'type'    => Controls_Manager::COLOR,
				'id'      => 'class_icon_color',
				'label'   => esc_html__( 'Icon Color', 'gymat-core' ),
				'default' => '',
				'selectors' => array( 
					'{{WRAPPER}} .class-multilayout-3 .class-media .class-icon i' => 'color: {{VALUE}}',
				),
			),
            array (
				'type'    => Controls_Manager::COLOR,
				'id'      => 'class_icon_hover_color',
				'label'   => esc_html__( 'Icon Hover Color', 'gymat-core' ),
				'default' => '',
				'selectors' => array( 
					'{{WRAPPER}} .class-multilayout-3 .class-item:hover .class-thumbnail .class-media .class-icon i' => 'color: {{VALUE}}',
				),
			),
            array (
				'type'    => Controls_Manager::COLOR,
				'id'      => 'schedule_color',
				'label'   => esc_html__( 'Schedule Color', 'gymat-core' ),
				'default' => '',
				'selectors' => array( 
					'{{WRAPPER}} .class-multilayout-3 .class-item .schedule' => 'color: {{VALUE}}',
				),
			),
            array(
				'type'    => Controls_Manager::DIMENSIONS,
				'id'      => 'schedule_padding',
				'mode'    => 'responsive',
				'label'   => esc_html__( 'Schedule Box Padding', 'finbuzz-core' ),
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .class-multilayout-3 .class-item .schedule' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
		$template = 'rt-feature-class';
        return $this->rt_template( $template, $data );
    }

}

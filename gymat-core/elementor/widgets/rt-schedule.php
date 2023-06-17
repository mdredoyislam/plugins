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

class RT_Schedule extends Custom_Widget_Base {

    public function __construct( $data = [], $args = null ) {
        $this->rt_name  = __( 'DV Schedule', 'gymat-core' );
        $this->rt_base  = 'rt-schedule';
        parent::__construct( $data, $args );
    }

    public function sort_by_time( $a, $b ) {
        return (int)( strtotime( $a['start_time'] ) > strtotime( $b['start_time'] ) );
    }
    public function rt_fields() {
        $fields = array(
            array(
                'mode'  => 'section_start',
                'id'    => 'section_general',
                'label' => __( 'General', 'gymat-core' )
            ),
            array(
				'type'    => Controls_Manager::SELECT2,
				'id'      => 'schedule_by',
				'label'   => __( 'Schedule By', 'gymat-core' ),
				'options' => array(
					'weekday'   => __( 'Weekday', 'gymat-core' ),
					'class'     => __( 'Class', 'gymat-core' ),
				),
				'default' => 'weekday',
			),
            array(
                'id'      => 'query_type',
                'label' => esc_html__( 'Query type', 'gymat-core' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'posts',
                'options' => array(
                    'category'  => esc_html__( 'Category', 'gymat-core' ),
                    'posts' => esc_html__( 'Posts', 'gymat-core' ),
                ),
            ),
            array(
                'id'      => 'postid',
                'label' => esc_html__( 'Selects posts', 'gymat-core' ),
                'type' => Controls_Manager::SELECT2,
                'options' => $this->get_all_posts('gymat_class'),
                'label_block' => true,
                'multiple' => true,
                'condition' => array(
                    'query_type' => 'posts',
                ),
            ),
            array(
                'id'    => 'category',
                'label' => __( 'Class Categories', 'gymat-core' ),
                'type'  =>  Controls_Manager::SELECT2,
                'options' => $this->get_taxonomy_drops('gymat_class_category'),
                'multiple' => true,
                'condition' => array(
                    'query_type' => 'category',
                ),
            ),
            array(
                'type'        => Controls_Manager::SWITCHER,
                'id'          => 'btn_display',
                'label'       => esc_html__( 'Display Button', 'gymat-core' ),
                'label_on'    => esc_html__( 'On', 'gymat-core' ),
                'label_off'   => esc_html__( 'Off', 'gymat-core' ),
                'default'     => 'yes',
                'description' => esc_html__( 'Show or Hide Button. Default: On', 'gymat-core' ),
            ),
            array(
                'mode'  => 'section_end'
            ),
            //  style
			array(
	            'mode'    => 'section_start',
	            'id'      => 'sec_style-typo',
	            'label'   => esc_html__( 'Typohraphy', 'gymat-core' ),
	            'tab'     => Controls_Manager::TAB_STYLE,
	        ),
            array (
				'mode'    => 'group',
				'type'    => Group_Control_Typography::get_type(),
				'name'    => 'week_title_typo',
				'label'   => esc_html__( 'Week Title Typo', 'gymat-core' ),
                'selector' => '{{WRAPPER}} .rt-defualt-schedule .nav-tabs li a',
			),
            array (
				'mode'    => 'group',
				'type'    => Group_Control_Typography::get_type(),
				'name'    => 'label_typo',
				'label'   => esc_html__( 'Label Title Typo', 'gymat-core' ),
                'selector' => '{{WRAPPER}} .rt-class-schedule-1 .class-schedule-tab ul li h3',
			),
            array(
				'mode' => 'section_end',
			),
            array(
	            'mode'    => 'section_start',
	            'id'      => 'sec_style-color',
	            'label'   => esc_html__( 'Color', 'gymat-core' ),
	            'tab'     => Controls_Manager::TAB_STYLE,
	        ),
            array (
				'type'    => Controls_Manager::COLOR,
				'id'      => 'label_title_color',
				'label'   => esc_html__( 'Label Title Color', 'gymat-core' ),
				'default' => '',
				'selectors' => array( 
					'{{WRAPPER}} .rt-class-schedule-1 .class-schedule-tab ul li h3' => 'color: {{VALUE}}',
				),
			),
            array (
				'type'    => Controls_Manager::COLOR,
				'id'      => 'label_sub_title_color',
				'label'   => esc_html__( 'Label Sub Title Color', 'gymat-core' ),
				'default' => '',
				'selectors' => array( 
					'{{WRAPPER}} .rt-class-schedule-1 .class-schedule-tab ul li span' => 'color: {{VALUE}}',
				),
			),
            array (
				'type'    => Controls_Manager::COLOR,
				'id'      => 'label_bg_color',
				'label'   => esc_html__( 'Label Background Color', 'gymat-core' ),
				'default' => '',
				'selectors' => array( 
					'{{WRAPPER}} .rt-class-schedule-1 .class-schedule-tab ul' => 'background-color: {{VALUE}}',
				),
			),
            array (
				'type'    => Controls_Manager::COLOR,
				'id'      => 'btn_bg_color',
				'label'   => esc_html__( 'Button Background Color', 'gymat-core' ),
				'default' => '',
				'selectors' => array( 
					'{{WRAPPER}} .rt-class-schedule-1 .class-schedule-tab ul li.rtin-btn a' => 'background-color: {{VALUE}}',
				),
			),
            array (
				'type'    => Controls_Manager::COLOR,
				'id'      => 'btn_text_color',
				'label'   => esc_html__( 'Button Text Color', 'gymat-core' ),
				'default' => '',
				'selectors' => array( 
					'{{WRAPPER}} .rt-class-schedule-1 .class-schedule-tab ul li.rtin-btn a' => 'color: {{VALUE}}',
				),
			),
            array (
				'type'    => Controls_Manager::COLOR,
				'id'      => 'btn_bg_hover_color',
				'label'   => esc_html__( 'Button Background Hover Color', 'gymat-core' ),
				'default' => '',
				'selectors' => array( 
					'{{WRAPPER}} .rt-class-schedule-1 .class-schedule-tab ul li.rtin-btn a:hover' => 'background-color: {{VALUE}}',
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
        switch ( $data['schedule_by'] ) {
            case 'class':
                $template = 'rt-schedule-2';
                break;
            default:
                $template = 'rt-schedule';
        }
        return $this->rt_template( $template, $data );
    }

}

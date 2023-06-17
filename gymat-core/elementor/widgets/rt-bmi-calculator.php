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

class RT_BMI_Calculator extends Custom_Widget_Base{
    public function __construct( $data = [], $args = null ){
		$this->rt_name = esc_html__( 'DV BMI Calculator', 'gymat-core' );
		$this->rt_base = 'rt-bmi-calculator';
		parent::__construct( $data, $args );
	}
    public function rt_fields(){
        $fields = array(
			array(
				'mode'    => 'section_start',
				'id'      => 'sec_general',
				'label'   => __( 'General', 'gymat-core' ),
			),
            array(
				'type'    => Controls_Manager::SELECT2,
				'id'      => 'style',
				'label'   => esc_html__( 'Style', 'gymat-core' ),
				'options' => array(
					'style1' => esc_html__( 'Style 1', 'gymat-core' ),
					'style2' => esc_html__( 'Style 2', 'gymat-core' ),
					'style3' => esc_html__( 'Style 3', 'gymat-core' ),
				),
				'default' => 'style1',
			),
            array(
                'type'    => Controls_Manager::TEXT,
                'id'      => 'title',
                'label'   => __( 'Title', 'gymat-core' ),
                'default' => 'What is Your BMI?',
            ),
            array(
                'type'    => Controls_Manager::WYSIWYG,
                'id'      => 'content',
                'label'   => __( 'Content', 'gymat-core' ),
                'default' => 'Lorem ipsum dolor sit amet, consectet ad elit sed diam nonummy nibh euismod tincidunt ut laoreet dolore magnaLorem ipsum dolor sit amet',
            ),
            array(
                'type'          => Controls_Manager::TEXT,
                'id'            => 'subtitle',
                'label_block'   =>true,
                'label'         => __( 'Subtitle', 'gymat-core' ),
                'default'       => ' CALCULATE BODY',
                'condition'     =>array('style'=>array('style2'))
            ),
            array(
                'type'    => Controls_Manager::SELECT2,
                'id'      => 'unit_default',
                'label'   => __( 'Default Calculation Unit', 'gymat-core' ),
                'options' => array(
                    'metric' => __( 'Metric', 'gymat-core' ),
                    'imperial' => __( 'Imperial', 'gymat-core' ),
                ),
                'default' => 'metric',
            ),
            array(
                'type'        => Controls_Manager::SWITCHER,
                'id'          => 'unit_display',
                'label'       => esc_html__( 'Allow users to change between Calculation Units', 'gymat-core' ),
                'label_on'    => esc_html__( 'On', 'gymat-core' ),
                'label_off'   => esc_html__( 'Off', 'gymat-core' ),
                'default'     => 'yes',
                'description' => esc_html__( 'Show or Hide Calculation Units. Default: On', 'gymat-core' ),
            ),
            array(
                'type'        => Controls_Manager::TEXT,
                'id'          => 'btn_text',
                'label_block'   =>true,
                'label'       => esc_html__( 'Button Text', 'gymat-core' ),
                'default' 	  => esc_html__('CALCULATE', 'gymat-core' ),
            ),
			array(
                'type'        => Controls_Manager::SWITCHER,
                'id'          => 'block_display',
                'label'       => esc_html__( 'Display Flex', 'gymat-core' ),
                'label_on'    => esc_html__( 'On', 'gymat-core' ),
                'label_off'   => esc_html__( 'Off', 'gymat-core' ),
                'default'     => 'yes',
                'description' => esc_html__( 'Show or Hide Calculation Units. Default: On', 'gymat-core' ),
				'condition'   =>array('style'=>array('style3'))
            ),
            array(
                'mode' => 'section_end',
            ),
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
				'selector' => '{{WRAPPER}} .rt-bmi-calculator .rt-title',
			),
            array (
				'type'    => Controls_Manager::COLOR,
				'id'      => 'bmi_title_color',
				'label'   => esc_html__( 'Title Color', 'gymat-core' ),
				'default' => '',
				'selectors' => array( 
					'{{WRAPPER}} .rt-bmi-calculator .rt-title' => 'color: {{VALUE}}',
				),
			),
            array (
				'type'    => Controls_Manager::DIVIDER,
				'id'      => 'divider',
			),
            array (
				'mode'    => 'group',
				'type'    => Group_Control_Typography::get_type(),
				'name'    => 'content_typo',
				'label'   => esc_html__( 'Content Typro', 'gymat-core' ),
				'selector' => '{{WRAPPER}} .rt-bmi-calculator .rt-subtitle',
			),
            array (
				'type'    => Controls_Manager::COLOR,
				'id'      => 'bmi_content_color',
				'label'   => esc_html__( 'Content Color', 'gymat-core' ),
				'default' => '',
				'selectors' => array( 
					'{{WRAPPER}} .rt-bmi-calculator .rt-subtitle' => 'color: {{VALUE}}',
				),
			),
            array (
				'type'    => Controls_Manager::DIVIDER,
				'id'      => 'divider2',
                'condition' =>array('style'=>array('style1'))
			),
            array(
				'type'    => Controls_Manager::DIMENSIONS,
				'id'      => 'bmi_form_space',
				'mode'    => 'responsive',
				'label'   => esc_html__( 'BMI Form Space', 'gymat-core' ),
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .rt-bmi-calculator .rt-bmi-form' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				],
                'condition' =>array('style'=>array('style1'))
			),
            array (
				'type'    => Controls_Manager::DIVIDER,
				'id'      => 'divider3',
                'condition' =>array('style'=>array('style1'))
			),
            array (
				'type'    => Controls_Manager::COLOR,
				'id'      => 'bmi_chart_bg_color',
				'label'   => esc_html__( 'BMI Chart Background', 'gymat-core' ),
				'default' => '',
				'selectors' => array( 
					'{{WRAPPER}} .rt-bmi-calculator .bmi-chart' => 'background-color: {{VALUE}}',
				),
                'condition' =>array('style'=>array('style1'))
			),
            array (
				'type'    => Controls_Manager::COLOR,
				'id'      => 'bmi_chart_text_color',
				'label'   => esc_html__( 'BMI Chart Text', 'gymat-core' ),
				'default' => '',
				'selectors' => array( 
					'{{WRAPPER}} .rt-bmi-calculator .bmi-chart tr td' => 'color: {{VALUE}}',
				),
                'condition' =>array('style'=>array('style1'))
			),
            array (
				'type'    => Controls_Manager::DIVIDER,
				'id'      => 'divider4',
                'condition' =>array('style'=>array('style2'))
			),
            array (
				'mode'    => 'group',
				'type'    => Group_Control_Typography::get_type(),
				'name'    => 'subtitle_typo',
				'label'   => esc_html__( 'Subtitle Typro', 'gymat-core' ),
				'selector' => '{{WRAPPER}} .rt-bmi-calculator .sec-subtitle',
                'condition' =>array('style'=>array('style2'))
			),
            array (
				'type'    => Controls_Manager::COLOR,
				'id'      => 'bmi_subtitle_color',
				'label'   => esc_html__( 'Subtitle Color', 'gymat-core' ),
				'default' => '',
				'selectors' => array( 
					'{{WRAPPER}} .rt-bmi-calculator .sec-subtitle' => 'color: {{VALUE}}',
				),
                'condition' =>array('style'=>array('style2'))
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
			$template = 'bmi-calculator-3';
			break;
            case 'style2':
            $template = 'bmi-calculator-2';
            break;
            default:
			$template = 'bmi-calculator';
			break;
        }
		return $this->rt_template( $template, $data );
	}
}
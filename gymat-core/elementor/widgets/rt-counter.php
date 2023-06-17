<?php
/**
 * @author  desvertTheme
 * @since   1.0
 * @version 1.0
 */

namespace desvertTheme\Gymat_Core;
use Elementor\Utils;
use Elementor\Controls_Manager;

if ( ! defined( 'ABSPATH' ) ) exit;

class RT_Counter extends Custom_Widget_Base {

	public function __construct( $data = [], $args = null ){
		$this->rt_name = __( 'DV Counter', 'gymat-core' );
		$this->rt_base = 'rt-counter';
		parent::__construct( $data, $args );
	}

	private function rt_load_scripts(){
		wp_enqueue_script( 'appear' );
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
				'label'   => esc_html__( 'Style', 'gymat-core' ),
				'options' => array(
					'style1' => esc_html__( 'Style 1', 'gymat-core' ),
					'style2' => esc_html__( 'Style 2', 'gymat-core' ),
				),
				'default' => 'style1',
			),
			
            array(
				'type'    => Controls_Manager::SELECT2,
				'id'      => 'iconalign',
				'label'   => esc_html__( 'Counter Align', 'gymat-core' ),
				'options' => array(
					'left' => esc_html__( 'Left', 'gymat-core' ),
					'center' => esc_html__( 'Center', 'gymat-core' ),
					'right' => esc_html__( 'Right', 'gymat-core' ),
				),
				'default' => 'left',
			),
            array(
				'type'    => Controls_Manager::ICONS,
				'id'      => 'icon_class',
				'label'   => esc_html__( 'Icon', 'gymat-core' ),
				'default' => array(
			      'value' => 'flaticon-heart',
			      'library' => 'fa-solid',
				),
                'condition' =>array('style'=>array('style1'))
			),
			
			array(
				'type'    => Controls_Manager::TEXT,
				'id'      => 'title',
				'label_block'=>true,
				'label'   => esc_html__( 'Title', 'gymat-core' ),
				'default' => esc_html__( 'Trained People', 'gymat-core' ),
			),
			array(
				'type'    => Controls_Manager::NUMBER,
				'id'      => 'number',
				'label'   => esc_html__( 'Counter Number', 'gymat-core' ),
				'default' => 300,
			),
            array(
				'type'    => Controls_Manager::TEXT,
				'id'      => 'after_number_text',
				'label'   => esc_html__( 'After Number Text', 'gymat-core' ),
				'default' => 'K',
                'condition' =>array('style'=>array('style2'))
			),
			array(
				'type'    => Controls_Manager::NUMBER,
				'id'      => 'speed',
				'label'   => esc_html__( 'Animation Speed', 'gymat-core' ),
				'default' => 2000,
				'description' => esc_html__( 'The total duration of the count animation in milisecond eg. 5000', 'gymat-core' ),
			),
            array(
				'type'    => Controls_Manager::DIMENSIONS,
				'id'      => 'padding',
				'mode'    => 'responsive',
				'label'   => esc_html__( 'Padding', 'gymat-core' ),
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .counter-style1' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .counter-style2' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			),
            array(
				'type'        => Controls_Manager::SWITCHER,
				'id'          => 'border_right',
				'label'       => esc_html__( 'Border Right', 'gymat-core' ),
				'label_on'    => esc_html__( 'On', 'gymat-core' ),
				'label_off'   => esc_html__( 'Off', 'gymat-core' ),
				'default'     => 'yes',
				'description' => esc_html__( 'Show or Hide Content. Default: onn', 'gymat-core' ),
                'condition' =>array('style'=>array('style1'))
			),
			array(
				'mode' => 'section_end',
			),
			array(
				'mode'    => 'section_start',
				'id'      => 'sec_colors',
				'label'   => esc_html__( 'Colors', 'gymat-core' ),
				'tab'     => Controls_Manager::TAB_STYLE,
			),
			array(
				'type'    => Controls_Manager::COLOR,
				'id'      => 'title_color',
				'label'   => esc_html__( 'Title Color', 'gymat-core' ),
				'default' => '',
				'selectors' => array(
					'{{WRAPPER}} .counter-style1 .count-title h4' => 'color: {{VALUE}}',
					'{{WRAPPER}} .counter-style2 .count-title h4' => 'color: {{VALUE}}',
				),
			),
			array(
				'type'    => Controls_Manager::COLOR,
				'id'      => 'counter_color',
				'label'   => esc_html__( 'Counter Color', 'gymat-core' ),
				'default' => '',
				'selectors' => array(
					'{{WRAPPER}} .counter-default .counterUp' => 'color: {{VALUE}}',
					'{{WRAPPER}} .counter-style2 .count .after-counter-text' => 'color: {{VALUE}}',
				),
			),
			array(
				'type'    => Controls_Manager::COLOR,
				'id'      => 'icon_color',
				'label'   => esc_html__( 'Icon Color', 'gymat-core' ),
				'default' => '',
				'selectors' => array(
					'{{WRAPPER}} .counter-style1 .counter-media .icon' => 'color: {{VALUE}}',
				),
                'condition' =>array('style'=>array('style1'))
			),
			array(
				'type'    => Controls_Manager::NUMBER,
				'id'      => 'title_size',
				'mode'       => 'responsive',
				'label'   => esc_html__( 'Title Font Size', 'gymat-core' ),
				'default' => '',
				'selectors' => array(
					'{{WRAPPER}} .counter-style1 .count-title h4' => 'font-size: {{VALUE}}px',
					'{{WRAPPER}} .counter-style2 .count-title h4' => 'font-size: {{VALUE}}px',
				),
			),
			array(
				'type'    => Controls_Manager::NUMBER,
				'id'      => 'counter_size',
				'mode'    => 'responsive',
				'label'   => esc_html__( 'Counter Font Size', 'gymat-core' ),
				'default' => '',
				'selectors' => array(
					'{{WRAPPER}} .counter-default .counterUp' => 'font-size: {{VALUE}}px',
					'{{WRAPPER}} .counter-style2 .count .after-counter-text' => 'font-size: {{VALUE}}px',
				),
			),
            array(
				'type'    => Controls_Manager::NUMBER,
				'id'      => 'icon_size',
				'mode'    => 'responsive',
				'label'   => esc_html__( 'Icon Size', 'gymat-core' ),
				'default' => '',
				'selectors' => array(
					'{{WRAPPER}} .counter-style1 .counter-media .icon' => 'font-size: {{VALUE}}px',
				),
                'condition' =>array('style'=>array('style1'))
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
			case 'style2':
			$template = 'rt-counter-2';
			break;
			default:
			$template = 'rt-counter';
			break;
		}

		return $this->rt_template( $template, $data );
	}
}
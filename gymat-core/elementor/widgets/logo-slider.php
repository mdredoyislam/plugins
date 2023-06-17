<?php
/**
 * @author  desvertTheme
 * @since   1.0
 * @version 1.0
 */

namespace desvertTheme\Gymat_Core;
use Elementor\Controls_Manager;

if ( ! defined( 'ABSPATH' ) ) exit;

class Logo_Slider extends Custom_Widget_Base {

	public function __construct( $data = [], $args = null ){
		$this->rt_name = esc_html__( 'DV Logo Slider and Grid', 'gymat-core' );
		$this->rt_base = 'rt-logo-slider';
		$this->rt_translate = array(
			'cols'  => array(
				'1'  => esc_html__( '1 Col', 'gymat-core' ),
				'2'  => esc_html__( '2 Col', 'gymat-core' ),
				'3'  => esc_html__( '3 Col', 'gymat-core' ),
				'4'  => esc_html__( '4 Col', 'gymat-core' ),
				'5'  => esc_html__( '5 Col', 'gymat-core' ),
				'6'  => esc_html__( '6 Col', 'gymat-core' ),
			),
		);
		parent::__construct( $data, $args );
	}

	private function rt_load_scripts(){
		wp_enqueue_style(  'swiper-slider' );
		wp_enqueue_script('swiper-slider');
	}

	public function rt_fields(){
		$repeater = new \Elementor\Repeater();
		
		$repeater->add_control(
			'image', [
				'type'  => Controls_Manager::MEDIA,
				'label' => esc_html__( 'Image', 'gymat-core' ),
				'label_block' => true,
			]
		);
		$repeater->add_control(
			'url', [
				'type'  => Controls_Manager::TEXT,
				'label' => esc_html__( 'URL(optional)', 'gymat-core' ),
				'label_block' => true,
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
				'id'      => 'layout',
				'label'   => esc_html__( 'Logo Layout', 'gymat-core' ),
				'options' => array(
					'layout1' => esc_html__( 'Logo Slider', 'gymat-core' ),
					'layout2' => esc_html__( 'Logo Gird', 'gymat-core' ),
					
				),
				'default' => 'layout2',
			),
			array (
				'type'        => Controls_Manager::SWITCHER,
				'id'          => 'logos_gray_scale',
				'label'       => esc_html__( 'Logos Gray Scale', 'gymat-core' ),
				'label_on'    => esc_html__( 'Enable', 'gymat-core' ),
				'label_off'   => esc_html__( 'Disable', 'gymat-core' ),
				'default'     => 'yes',
			),
			array (
				'type'    => Controls_Manager::REPEATER,
				'id'      => 'logos',
				'label'   => esc_html__( 'Add as many logos as you want', 'gymat-core' ),
				'fields' => $repeater->get_controls(),				
			),
			array(
				'mode' => 'section_end',
			),

			// Responsive Columns
			array(
				'mode'    => 'section_start',
				'id'      => 'sec_responsive',
				'label'   => esc_html__( 'Number of Responsive Columns', 'gymat-core' ),
				'condition'=>array('layout'=>array('layout2'))
			),
			array(
				'type'    => Controls_Manager::SELECT2,
				'id'      => 'col_lg',
				'label'   => esc_html__( 'Desktops: > 992px', 'gymat-core' ),
				'options' => $this->rt_translate['cols'],
				'default' => '6',
			),
			array(
				'type'    => Controls_Manager::SELECT2,
				'id'      => 'col_md',
				'label'   => esc_html__( 'Tablets: > 767px', 'gymat-core' ),
				'options' => $this->rt_translate['cols'],
				'default' => '3',
			),
			array(
				'type'    => Controls_Manager::SELECT2,
				'id'      => 'col_sm',
				'label'   => esc_html__( 'Phones: < 768px', 'gymat-core' ),
				'options' => $this->rt_translate['cols'],
				'default' => '2',
			),
			array(
				'type'    => Controls_Manager::SELECT2,
				'id'      => 'col_mobile',
				'label'   => esc_html__( 'Small Phones: < 480px', 'gymat-core' ),
				'options' => $this->rt_translate['cols'],
				'default' => '1',
			),
			array(
				'mode' => 'section_end',
			),

			// Slider options
			array(
				'mode'        => 'section_start',
				'id'          => 'sec_slider',
				'label'       => esc_html__( 'Slider Options', 'gymat-core' ),
				'condition'   => array( 'layout' => array('layout1') ),
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
                    'size' => 6,
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
                    'size' => 4,
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
                    'size' => 3,
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
		switch ( $data['layout'] ) {
			case 'layout2':
			$template = 'logo-grid';
			break;
			default:
			$template = 'logo-slider';
			$this->rt_load_scripts();
			break;
		}
		return $this->rt_template( $template, $data );
	}
}
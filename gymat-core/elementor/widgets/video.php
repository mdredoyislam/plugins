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
use Elementor\Utils;
use Elementor\Group_Control_Background;

if ( ! defined( 'ABSPATH' ) ) exit;

class Video extends Custom_Widget_Base {

	public function __construct( $data = [], $args = null ){
		$this->rt_name = esc_html__( 'DV Video', 'gymat-core' );
		$this->rt_base = 'rt-video';
		parent::__construct( $data, $args );
	}
	
	private function rt_load_scripts(){
		wp_enqueue_script( 'magnific-popup' );
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
				'type'    => Controls_Manager::COLOR,
				'id'      => 'bag_color',
				'label'   => esc_html__( 'Image Overlay Color', 'gymat-core' ),
				'default' => '',
				'selectors' => array(
					'{{WRAPPER}} .rt-video.video-style1 .rt-video-img:after' => 'background-color: {{VALUE}}',
				),
				'condition'   => array( 'style' => array('style1')),
			),
			array(
				'type'    => Controls_Manager::SLIDER,
				'id'      => 'image_overlay_size',
				'label'   => esc_html__( 'Percentage', 'gymat-core' ),
				'default' => [
					'size' => .6,
				],
				'range' => [
					'px' => [
						'max' => 1,
						'min' => 0.10,
						'step' => 0.01,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .rt-video.video-style1 .rt-video-img:after' => 'opacity: {{SIZE}};',
				],
				'condition'   => array( 'style' => array('style1')),
			),
			array(
				'type'    => Controls_Manager::URL,
				'id'      => 'videourl',
				'label'   => esc_html__( 'Video URL', 'gymat-core' ),
				'placeholder' => 'https://your-link.com',
			),
			array(
				'type'    => Controls_Manager::MEDIA,
				'id'      => 'video_image',
				'label'   => esc_html__( 'Video Thumbnail', 'gymat-core' ),
				'default' => array(
                    'url' => Utils::get_placeholder_image_src(),
                ),
				'description' => esc_html__( 'Recommended full image', 'gymat-core' ),
			),
			array(
				'type'    => Group_Control_Image_Size::get_type(),
				'mode'    => 'group',				
				'label'   => esc_html__( 'image size', 'gymat-core' ),	
				'name' => 'icon_image_size', 
				'separator' => 'none',	
			),
			array(
				'type'        => Controls_Manager::SWITCHER,
				'id'          => 'shape_display',
				'label'       => esc_html__( 'Shape Display', 'gymat-core' ),
				'label_on'    => esc_html__( 'On', 'gymat-core' ),
				'label_off'   => esc_html__( 'Off', 'gymat-core' ),
				'default'     => 'off',
				'description' => esc_html__( 'Show or Hide More Button . Default: Off', 'gymat-core' ),
				'condition'   	=> array( 'style' => array( 'style2') ),
			),
			array(
				'type'    => Controls_Manager::NUMBER,
				'id'      => 'shape2_angle',
				'label'   => esc_html__( 'Shape 2 Angle', 'gymat-core' ),
				'default' => '',
				'description' => esc_html__( 'Use only number value.you don\'t have to use unit. Default: 174deg', 'gymat-core' ),
				'selectors' => array(
					'{{WRAPPER}}  .rt-video.video-style2 .rt-video-img.has-shape::before' => 'transform: translateY(-50%) rotate({{VALUE}}deg);',
				),
				'condition'   	=> array( 'style' => array( 'style2') ),
			),
			array(
				'mode' => 'section_end',
			),
			
			/*Style Option*/
			
			// Button style 1
			array(
				'mode'    => 'section_start',
				'id'      => 'sec_button_style',
				'label'   => esc_html__( 'Button Style', 'panpie-core' ),
				'tab'     => Controls_Manager::TAB_STYLE,
			),
						
			array(
				'type'    => Controls_Manager::NUMBER,
				'id'      => 'video_icon_size',
				'label'   => esc_html__( 'Icon Size', 'gymat-core' ),
				'default' => '',
				'selectors' => array(
					'{{WRAPPER}}  .video-style1 .play-button .play-btn' => 'font-size: {{VALUE}}px',
					'{{WRAPPER}}  .video-style2 .play-button .play-btn' => 'font-size: {{VALUE}}px',
				),
			),
			array(
				'type'    => Controls_Manager::COLOR,
				'id'      => 'video_icon_bg_color',
				'label'   => esc_html__( 'Icon Background', 'gymat-core' ),
				'default' => '',
				'selectors' => array(
					'{{WRAPPER}}  .video-style1 .play-button .play-btn' => 'background-color: {{VALUE}}',
					'{{WRAPPER}}  .video-style2 .play-button .play-btn' => 'background-color: {{VALUE}}',
				),
			),
			array(
				'type'    => Controls_Manager::COLOR,
				'id'      => 'video_icon_color',
				'label'   => esc_html__( 'Icon Color', 'gymat-core' ),
				'default' => '',
				'selectors' => array(
					'{{WRAPPER}}  .video-style1 .play-button .play-btn' => 'color: {{VALUE}}',
					'{{WRAPPER}}  .video-style2 .play-button .play-btn' => 'color: {{VALUE}}',
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
		$this->rt_load_scripts();
		switch ( $data['style'] ) { 
			case 'style2':
			$template = 'video-2';
			break;
			default:
			$template = 'video';
			break;
		}
		return $this->rt_template( $template, $data );
	}
}
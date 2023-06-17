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

if ( ! defined( 'ABSPATH' ) ) exit;

class Image extends Custom_Widget_Base {

	public function __construct( $data = [], $args = null ){
		$this->rt_name = esc_html__( 'DV Image', 'gymat-core' );
		$this->rt_base = 'rt-image';
		parent::__construct( $data, $args );
	}
		
	private function rt_wow_load_scripts(){
		wp_enqueue_script( 'rt-wow' );
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
				'label'   => esc_html__( 'Image Style', 'gymat-core' ),
				'options' => array(
					'style1' => esc_html__( 'Style 1' , 'gymat-core' ),
					'style2' => esc_html__( 'Style 2', 'gymat-core' ),
					'style3' => esc_html__( 'Style 3', 'gymat-core' ),
					'style4' => esc_html__( 'Style 4', 'gymat-core' ),
					'style5' => esc_html__( 'Style 5', 'gymat-core' ),
					'style6' => esc_html__( 'Style 6', 'gymat-core' ),
					'style7' => esc_html__( 'Style 7', 'gymat-core' ),
					'style8' => esc_html__( 'Style 8', 'gymat-core' ),
					'style9' => esc_html__( 'Style 9', 'gymat-core' ),
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
				'condition'  =>array('style'=>array('style1','style2','style3'))
			),
			
			array(
                'type'        => Controls_Manager::TEXTAREA,
                'id'          => 'since_title',
                'label'       => esc_html__( 'Since Title', 'gymat-core' ),
                'default'     => "Since 1995",
				'condition'  =>array('style'=>array('style7'))
            ),
			array(
				'id'      	=> 'icon_f_heading',
				'type' 		=>  Controls_Manager::HEADING,
				'label'   	=> __( 'please use 440x453 image size', 'bizcon-core' ),
				'condition' =>array('style'=>array('style7'))
			 ),
			 
			array(
				'type'    => Controls_Manager::MEDIA,
				'id'      => 'rt_image',
				'label'   => esc_html__( 'Image', 'gymat-core' ),
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
				'type'    => Controls_Manager::MEDIA,
				'id'      => 'rt_image_2',
				'label'   => esc_html__( 'Thumb Image 1', 'gymat-core' ),
				'default' => array(
                    'url' => Utils::get_placeholder_image_src(),
                ),
				'description' => esc_html__( 'Recommended image 245x241 image size', 'gymat-core' ),
				'condition'  =>array('style'=>array('style6'))
			),
			array(
				'type'    => Controls_Manager::MEDIA,
				'id'      => 'rt_image_3',
				'label'   => esc_html__( 'Thumb Image 2', 'gymat-core' ),
				'default' => array(
                    'url' => Utils::get_placeholder_image_src(),
                ),
				'description' => esc_html__( 'Recommended full image', 'gymat-core' ),
				'condition'  =>array('style'=>array('style6'))
			),
			array(
				'type'    => Group_Control_Image_Size::get_type(),
				'mode'    => 'group',				
				'label'   => esc_html__( 'image size', 'gymat-core' ),	
				'name' => 'thumb_image_size', 
				'separator' => 'none',
				'condition'  =>array('style'=>array('style6'))		
			),

			array(
				'type'  => Controls_Manager::URL,
				'id'    => 'url',
				'label' => esc_html__( 'Link (Optional)', 'gymat-core' ),
				'placeholder' => 'https://your-link.com',
			),
			array(
				'type'    => Controls_Manager::DIMENSIONS,
				'id'      => 'border_radius',
				'label'   => esc_html__( 'Border Radius', 'gymat-core' ),
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .image-default .image-box a > img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .image-default .image-box > img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .image-default .image-box' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					
				],
				'condition'  =>array('style'=>array('style1'))
			),			
			array(
				'type'    => Controls_Manager::SELECT2,
				'id'      => 'paralax_animation',
				'label'   => esc_html__( 'Image Animation', 'gymat-core' ),
				'options' => array(
					'paralax' => esc_html__( 'Paralax' , 'gymat-core' ),
					'spin' => esc_html__( 'Spin', 'gymat-core' ),
				),
				'condition'   => array( 'style' => array('style8') ),
				'default' => 'spin',
			),
			array(
				'mode' => 'section_end',
			),

			/*Style Option*/
	
		);
		return $fields;
	}

	protected function render() {
		$data = $this->get_settings();
		switch ( $data['style'] ) {
			case 'style9':
			$template = 'image-9';
			break;
			case 'style8':
			$template = 'image-8';
			break;
			case 'style7':
			$template = 'image-7';
			break;
			case 'style6':
			$template = 'image-6';
			break;
			case 'style5':
			$template = 'image-5';
			break;
			case 'style4':
			$template = 'image-4';
			break;
			case 'style3':
			$template = 'image-3';
			break;
			case 'style2':
			$template = 'image-2';
			break;
			default:
			$template = 'image-1';
			break;
		}
	
		return $this->rt_template( $template, $data );
	}
}
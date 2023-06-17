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

class About_Image_Text extends Custom_Widget_Base {

	public function __construct( $data = [], $args = null ){
		$this->rt_name = esc_html__( 'DV About Image Text', 'gymat-core' );
		$this->rt_base = 'rt-About-image-text';
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
				'type'    => Controls_Manager::TEXT,
				'id'      => 'section_subtitle',
				'label'   => esc_html__( 'Section Subtitle', 'gymat-core' ),
				'default' => esc_html__( 'Let\'s Introduces', 'gymat-core' ),
			),
			array(
				'type'    => Controls_Manager::TEXTAREA,
				'id'      => 'section_title',
				'label'   => esc_html__( 'Section Title', 'gymat-core' ),
				'default' => esc_html__( 'Take Your Health And Fitness To New Level of Heights!', 'gymat-core' ),
			),
			array(
				'type'    => Controls_Manager::TEXTAREA,
				'id'      => 'title',
				'label'   => esc_html__( 'Founder Name', 'gymat-core' ),
				'default' => esc_html__( 'Mr. Robert Smith', 'gymat-core' ),
			),
			array(
				'type'    => Controls_Manager::TEXT,
				'id'      => 'designation',
				'label'   => esc_html__( 'Designation', 'gymat-core' ),
				'default' => esc_html__('Founder', 'gymat-core' ),
			),

			array(
				'type'    => Controls_Manager::TEXTAREA,
				'id'      => 'blockqoute_text2',
				'label'   => esc_html__( 'Blockqoute Text', 'gymat-core' ),
				'default' => esc_html__('We can help you to overcome the fears and obstacles in your life.', 'gymat-core' ),
			),
			array(
				'type'    => Controls_Manager::WYSIWYG,
				'id'      => 'author_about_text',
				'label'   => esc_html__( 'Author About Text', 'gymat-core' ),
				'default' => esc_html__('Gymat an unknown printer took a galley of type and scr arsry mbled it to make a type specimen book. It has survived notte only five centuries, but also the leap into electronic types ear tting rey emaining essentially unchanged. It was popularised in the 1960s with the release of Letraset.', 'gymat-core' ),
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
				'type'    => Controls_Manager::MEDIA,
				'id'      => 'signature_image',
				'label'   => esc_html__( 'Signature Image', 'gymat-core' ),
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
				'mode' => 'section_end',
			),
			// Style
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
				'label'   => esc_html__( 'Title Style', 'gymat-core' ),
				'selector' => '{{WRAPPER}} .about-image-text .about-info-box .heading-title',
			),
			array (
				'mode'    => 'group',
				'type'    => Group_Control_Typography::get_type(),
				'name'    => 'sub_title_typo',
				'label'   => esc_html__( 'Sub Title Style', 'gymat-core' ),
				'selector' => '{{WRAPPER}} .about-image-text .subtitle',
			),
			array(
				'type'    => Controls_Manager::COLOR,
				'id'      => 'title_color',
				'label'   => esc_html__( 'Title Color', 'gymat-core' ),
				'default' => '',
				'selectors' => array(
					'{{WRAPPER}} .about-image-text .about-info-box .heading-title' => 'color: {{VALUE}}',
				),
			),
			array(
				'type'    => Controls_Manager::COLOR,
				'id'      => 'sub_title_color',
				'label'   => esc_html__( 'Sub Title Color', 'gymat-core' ),
				'default' => '',
				'selectors' => array(
					'{{WRAPPER}} .about-image-text .subtitle' => 'color: {{VALUE}}',
				),
			),
			array(
				'type'    => Controls_Manager::DIMENSIONS,
				'id'      => 'title_space',
				'label'   => esc_html__( 'Title Space', 'gymat-core' ),
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .about-image-text .about-info-box .heading-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			),
			array(
				'type'    => Controls_Manager::DIMENSIONS,
				'id'      => 'signature_space',
				'mode'    =>'responsive',
				'label'   => esc_html__( 'Signature Space', 'consalty-core' ),
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .about-image-text .about-info-box .founder-sign' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
		$template = 'about-image-text-1';
		return $this->rt_template( $template, $data );
	}
}
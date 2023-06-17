<?php
/**
 * @author  desvertTheme
 * @since   1.0
 * @version 1.0
 */

namespace desvertTheme\Gymat_Core;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;

if ( ! defined( 'ABSPATH' ) ) exit;

class Contact_Info extends Custom_Widget_Base {

	public function __construct( $data = [], $args = null ){
		$this->rt_name = esc_html__( 'DV Contact Info', 'gymat-core' );
		$this->rt_base = 'rt-info';
		parent::__construct( $data, $args );
	}

	public function rt_fields(){

		$repeater = new \Elementor\Repeater();
		$repeater->add_control(
			'address_icon',
			 [
				'type'  => Controls_Manager::ICONS,
				'label' => esc_html__( 'Icon', 'consalty-core' ),
				'label_block' => true,
				'default' => array(
					'value' => 'fas fa-map-marker-alt',
					'library' => 'fa-solid',
				),	
				
			]
		);
		$repeater->add_control(
			'address_infos', [
				'type'  => Controls_Manager::TEXTAREA,
				'label_block' => true,
				'label'   => esc_html__( 'Contact Info', 'gymat-core' ),
				'default' => '85 Briston Mint Street',
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
				'id'      => 'style',
				'label'   => esc_html__( 'Address Style', 'gymat-core' ),
				'options' => array(
					'style1' => esc_html__( 'Style 1' , 'gymat-core' ),
					'style2' => esc_html__( 'Style 2', 'gymat-core' ),
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
				),
				'default' => '',
				'selectors' => array(
					'{{WRAPPER}}' => 'text-align: {{VALUE}};',
				),
				'condition'   => array('style' => array('style1')),
			),
			array(
				'type'    => Controls_Manager::TEXT,
				'id'    => 'address_title',
				'label'   => esc_html__( 'Contact Title', 'gymat-core' ),
				'default' => esc_html__( 'Our Office Address', 'gymat-core' ),
			),			
			array (
				'type'    => Controls_Manager::REPEATER,
				'id'      => 'address_info',
				'label'   => esc_html__( 'Add Address', 'gymat-core' ),
				'fields' => $repeater->get_controls(),
				'condition'   => array('style' => array('style1')),
			),
			array(
				'type'    => Controls_Manager::URL,
				'id'      => 'fb_url',
				'label'   => esc_html__( 'Facebook URL', 'gymat-core' ),
				'placeholder' => 'https://facebook-link.com',
				
				'condition'  =>array('style'=>'style2')
			),
			array(
				'type'    => Controls_Manager::URL,
				'id'      => 'twitter_url',
				'label'   => esc_html__( 'Twitter URL', 'gymat-core' ),
				'placeholder' => 'https://twitter-link.com',
				'condition'  =>array('style'=>'style2')
			),
			array(
				'type'    => Controls_Manager::URL,
				'id'      => 'skype_url',
				'label'   => esc_html__( 'Skype URL', 'gymat-core' ),
				'placeholder' => 'https://skype-link.com',
				'condition'  =>array('style'=>'style2')
			),
			array(
				'type'    => Controls_Manager::URL,
				'id'      => 'instragram_url',
				'label'   => esc_html__( 'Instragram URL', 'gymat-core' ),
				'placeholder' => 'https://instragram-link.com',
				'condition'  =>array('style'=>'style2')
			),
			array(
				'type'    => Controls_Manager::URL,
				'id'      => 'printerest_url',
				'label'   => esc_html__( 'Printerest URL', 'gymat-core' ),
				'placeholder' => 'https://printerest-link.com',
				'condition'  =>array('style'=>'style2')
			),
			array(
				'type'    => Controls_Manager::URL,
				'id'      => 'whats_url',
				'label'   => esc_html__( 'What\'s App URL', 'gymat-core' ),
				'placeholder' => 'https://what\'s-app-link.com',
				'condition'  =>array('style'=>'style2')
			),
			array(
				'type'    => Controls_Manager::URL,
				'id'      => 'youtube_url',
				'label'   => esc_html__( 'Youtube URL', 'gymat-core' ),
				'placeholder' => 'https://youtube-link.com',
				'condition'  =>array('style'=>'style2')
			),
			array(
				'mode' => 'section_end',
			),			
			/*Style Option*/
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
				'label'   => esc_html__( 'Contact Title Typo', 'gymat-core' ),
				'selector' => '{{WRAPPER}} .contact-info-default .contact-title',
			),
			array(
				'type'    => Controls_Manager::COLOR,
				'id'      => 'title_color',
				'label'   => esc_html__( 'Contact Title Color', 'gymat-core' ),
				'default' => '',
				'selectors' => array(
					'{{WRAPPER}} .contact-info-default .contact-title' => 'color: {{VALUE}}',
				),
			),
			array(
				'type'    => Controls_Manager::COLOR,
				'id'      => 'icon_color',
				'label'   => esc_html__( 'Icon Color', 'gymat-core' ),
				'default' => '',
				'selectors' => array(
					'{{WRAPPER}} .contact-info-default.info-style2 ul li a' => 'color: {{VALUE}}',
				),
				'condition'   => array( 'style' => array( 'style2') ),
			),			
			array(
				'type'    => Controls_Manager::COLOR,
				'id'      => 'icon_bg_color',
				'label'   => esc_html__( 'Icon Background', 'gymat-core' ),
				'default' => '',
				'selectors' => array(
					'{{WRAPPER}} .contact-info-default.info-style2 ul li a' => 'background-color: {{VALUE}}',
				),
				'condition'   => array( 'style' => array( 'style2') ),
			),
			array (
				'mode'    => 'group',
				'type'    => Group_Control_Typography::get_type(),
				'name'    => 'info_typo',
				'label'   => esc_html__( 'Contact Info Typo', 'gymat-core' ),
				'selector' => '{{WRAPPER}} .contact-info-default .contact-info .list-item span ',
				'condition'   => array( 'style' => array( 'style1')),
			),
			array(
				'type'    => Controls_Manager::COLOR,
				'id'      => 'info_color',
				'label'   => esc_html__( 'Contact Info Color', 'gymat-core' ),
				'default' => '',
				'selectors' => array(
					'{{WRAPPER}} .contact-info-default .contact-info .list-item span' => 'color: {{VALUE}}',
					'{{WRAPPER}} .contact-info-default .contact-info .list-item span a' => 'color: {{VALUE}}',
				),
				'condition'   => array( 'style' => array( 'style1')),
			),
			array(
				'type'    => Controls_Manager::COLOR,
				'id'      => 'icon_hover_color',
				'label'   => esc_html__( 'Icon Hover Color', 'consalty-core' ),
				'default' => '',
				'selectors' => array(
					'{{WRAPPER}} .contact-info-default.info-style2 ul li a:hover' => 'color: {{VALUE}}',
				),
				'condition'   => array( 'style' => array( 'style2')),
			),
			array(
				'type'    => Controls_Manager::COLOR,
				'id'      => 'icon_hover_bg_color',
				'label'   => esc_html__( 'Icon Hover Background', 'consalty-core' ),
				'default' => '',
				'selectors' => array(
					'{{WRAPPER}} .contact-info-default.info-style2 ul li a:hover' => 'background-color: {{VALUE}}',
				),
				'condition'   => array( 'style' => array( 'style2')),
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
			$template = 'contact-info-2';
			break;
			default:
			$template = 'contact-info-1';
			break;
		}

		return $this->rt_template( $template, $data );
	}
}
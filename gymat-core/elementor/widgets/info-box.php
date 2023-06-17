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

class Info_Box extends Custom_Widget_Base {

	public function __construct( $data = [], $args = null ){
		$this->rt_name = esc_html__( 'DV Info Box', 'gymat-core' );
		$this->rt_base = 'rt-info-box';
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
				'label'   => esc_html__( 'Style', 'gymat-core' ),
				'options' => array(
					'style1' => esc_html__( 'Style 1', 'gymat-core' ),
					'style2' => esc_html__( 'Style 2', 'gymat-core' ),
					'style3' => esc_html__( 'Style 3', 'gymat-core' ),
					'style4' => esc_html__( 'Style 4', 'gymat-core' ),
					'style5' => esc_html__( 'Style 5', 'gymat-core' ),
					'style6' => esc_html__( 'Style 6', 'gymat-core' ),
					'style7' => esc_html__( 'Style 7', 'gymat-core' ),
				),
				'default' => 'style1',
			),
			/*Icon Start*/
			array(					 
			   'type'    => Controls_Manager::CHOOSE,
			   'options' => array(
			     'icon' => array(
			       'title' => esc_html__( 'Left', 'gymat-core' ),
			       'icon' => 'fa fa-smile',
			     ),
			     'image' => array(
			       'title' => esc_html__( 'Center', 'gymat-core' ),
			       'icon' => 'fa fa-image',
			     ),		     
			   ),
			   'id'      => 'icontype',
			   'label'   => esc_html__( 'Media Type', 'gymat-core' ),
			   'default' => 'icon',
			   'label_block' => false,
			   'toggle' => false,
			),
			array(
				'type'    => Controls_Manager::ICONS,
				'id'      => 'icon_class',
				'label'   => esc_html__( 'Icon', 'gymat-core' ),
				'default' => array(
			      'value' => 'flaticon-heart',
			      'library' => 'fa-solid',
				),	
			  	'condition'   => array('icontype' => array( 'icon' )),
			),	
			array(
				'type'    => Controls_Manager::MEDIA,
				'id'      => 'icon_image',
				'label'   => esc_html__( 'Image', 'gymat-core' ),
				'default' => array(
                    'url' => Utils::get_placeholder_image_src(),
                ),
				'description' => esc_html__( 'Recommended full image', 'gymat-core' ),
				'condition'   => array('icontype' => array( 'image' )),
			),
			array(
				'type'    => Group_Control_Image_Size::get_type(),
				'mode'    => 'group',				
				'label'   => esc_html__( 'image size', 'gymat-core' ),	
				'name' => 'icon_image_size', 
				'separator' => 'none',		
				'condition'   => array('icontype' => array( 'image' )),
			),
			array(
				'type'    => Controls_Manager::CHOOSE,
				'id'      => 'icon_position',
				'label'   => esc_html__( 'Icon Position', 'gymat-core' ),
				'options'   => [
					'icon-left'                                                      => [
						'title' => __( 'Left', 'gymat-core' ),
						'icon'  => 'eicon-h-align-left',
					],
					'float: none; display: block; padding: 0;'                       => [
						'title' => __( 'Top', 'gymat-core' ),
						'icon'  => 'eicon-v-align-top',
					],
					'float: right !important; padding-right: 0; padding-left: 30px;' => [
						'title' => __( 'Right', 'gymat-core' ),
						'icon'  => 'eicon-h-align-right',
					],
				],
				'selectors' => [
					'{{WRAPPER}} .info-box.multi-infobox-3 .info-item .info-media' => '{{VALUE}}',
				],
				'toggle'    => true,
				'condition'=>[
					'style'=>['style7']
				]
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
				'condition'   => array('style' => array( 'style2','style4')),
			),
			/*Icon end*/

			array(
				'type' => Controls_Manager::SELECT2,
				'id'      => 'border_right',
				'mode'    => 'responsive',
				'label'   => esc_html__( 'Info box border right', 'gymat-core' ),
				'options' => array(
					'hide' =>'Hide',
					'show' =>'Show',
				),
				'default' => 'hide',
				'condition'   => array( 'style' => array('style2','style6','style7')),
			),
			
			array(
				'type'    => Controls_Manager::TEXT,
				'id'      => 'title',
				'label'   => esc_html__( 'Title', 'gymat-core' ),
				'label_block' =>true,
				'default' => esc_html__( 'Free Fitness Training', 'gymat-core' ),
			),
			array(
				'type'    => Controls_Manager::TEXTAREA,
				'id'      => 'content',
				'label'   => esc_html__( 'Content', 'gymat-core' ),
				'default' => esc_html__( 'Your logo is the very heart of your identity designers deliver the perfect.', 'gymat-core' ),
			),

			/**title url */
			array(
				'type'    => Controls_Manager::URL,
				'id'      => 'title_url',
				'label'   => esc_html__( 'Title URL (Optional)', 'gymat-core' ),
				'placeholder' => 'https://title-link.com',
			),
			array(
				'type'        => Controls_Manager::SWITCHER,
				'id'          => 'button_display',
				'label'       => esc_html__( 'Button Display', 'gymat-core' ),
				'label_on'    => esc_html__( 'On', 'gymat-core' ),
				'label_off'   => esc_html__( 'Off', 'gymat-core' ),
				'default'     => false,
				'description' => esc_html__( 'Show or Hide Content. Default: off', 'gymat-core' ),
				'condition'   => array( 'style' => array('style1','style2','style3','style4','style5')),
			),
			array(
				'type'  => Controls_Manager::URL,
				'id'    => 'url',
				'label' => esc_html__( 'Button Link (Optional)', 'gymat-core' ),
				'placeholder' => 'https://your-link.com',
				'condition'   => array( 'button_display' => array( 'yes'),'style' => array('style1','style2','style3','style4','style5')),
			),
			array(
				'type'    => Controls_Manager::TEXT,
				'id'      => 'buttontext',
				'label'   => esc_html__( 'Button Text', 'gymat-core' ),
				'default' => esc_html__( 'Read More', 'gymat-core' ),
				'condition'   => array( 'button_display' => array( 'yes' ),'style' => array('style1','style2','style3','style4','style5')),
			),
			array(
				'type'    => Controls_Manager::DIMENSIONS,
				'id'      => 'info_spaceing',
				'mode'    => 'responsive',
				'label'   => esc_html__( 'Info Box Padding', 'gymat-core' ),
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .info-box.info-style2' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .info-box.info-style6 .info-item .media-wrap' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition'   => array( 'style' => array( 'style2','style6')),
			),
			array(
				'type'    => Controls_Manager::DIMENSIONS,
				'id'      => 'info_border_radius',
				'mode'    => 'responsive',
				'label'   => esc_html__( 'Info Box Border', 'gymat-core' ),
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .info-box.info-style5 .info-item' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition'   => array( 'style' => array( 'style5')),
			),
			array(
				'type'    => Controls_Manager::MEDIA,
				'id'      => 'info_bg_image',
				'label'   => esc_html__( 'Info Background Image', 'finbuzz-core' ),
				'default' => array(
                    'url' => Utils::get_placeholder_image_src(),
                ),
				'description' => esc_html__( 'Recommended full image', 'finbuzz-core' ),
				'condition'   => array( 'style' => array('style5') ),
			),
			array(
				'type'    => Group_Control_Image_Size::get_type(),
				'mode'    => 'group',				
				'label'   => esc_html__( 'image size', 'finbuzz-core' ),	
				'name' => 'info_bg_image_size', 
				'separator' => 'none',
				'condition'   => array( 'style' => array('style5') ),		
			),			
			array(
				'mode' => 'section_end',
			),
	
			/*Style Option*/
			array(
				'mode'    => 'section_start',
				'id'      => 'sec_style',
				'label'   => esc_html__( 'Title', 'gymat-core' ),
				'tab'     => Controls_Manager::TAB_STYLE,
			),
			array(
				'mode'    => 'group',
				'type'    => Group_Control_Typography::get_type(),
				'name'    => 'title_typo',
				'label'   => esc_html__( 'Title Typo', 'gymat-core' ),
				'selector' => '{{WRAPPER}} .info-box .info-title',
			),
			array(
				'type'    => Controls_Manager::COLOR,
				'id'      => 'title_color',
				'label'   => esc_html__( 'Title Color', 'gymat-core' ),
				'default' => '',
				'selectors' => array(
					'{{WRAPPER}} .info-box .info-title' => 'color: {{VALUE}}',
					'{{WRAPPER}} .info-box .info-title a' => 'color: {{VALUE}}',
					
				),
			),
			array(
				'mode' => 'section_end',
			),

			// Content text style
			array(
				'mode'    => 'section_start',
				'id'      => 'sec_sub_title',
				'label'   => esc_html__( 'Content Text', 'gymat-core' ),
				'tab'     => Controls_Manager::TAB_STYLE,
			),
			array (
				'mode'    => 'group',
				'type'    => Group_Control_Typography::get_type(),
				'name'    => 'sub_title_typo',
				'label'   => esc_html__( 'Content Text Typo', 'gymat-core' ),
				'selector' => '{{WRAPPER}} .info-box .info-item .info-text',
			),
			array(
				'type'    => Controls_Manager::COLOR,
				'id'      => 'conent_color',
				'label'   => esc_html__( 'Content Color', 'gymat-core' ),
				'default' => '',
				'selectors' => array(
					'{{WRAPPER}} .info-box .info-item .info-text' => 'color: {{VALUE}}',
					'{{WRAPPER}} .service-grid-layout1 .rtin-content .service-text' => 'color: {{VALUE}}',
					'{{WRAPPER}} .info-style11 .info-item .info-content .info-heading .ex-text' => 'color: {{VALUE}}',
					'{{WRAPPER}} .info-style11 .info-item .info-content .info-content p' => 'color: {{VALUE}}',
				),
			),
			
			array(
				'mode' => 'section_end',
			),

			
			// Icon style
			
			array(
				'mode'    => 'section_start',
				'id'      => 'sec_icon',
				'label'   => esc_html__( 'Icon Style', 'gymat-core' ),
				'tab'     => Controls_Manager::TAB_STYLE,
				'condition'   => array('style' => array( 'style1','style2','style3','style4')),
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
			array(
				'id'      => 'icon_f_heading',
				'type' =>        Controls_Manager::HEADING,
				'label'   => __( 'Full Icon Box', 'gymat-core' ),
				'description' => esc_html__( 'Use same height and width size', 'gymat-core' ),
				'separator' => 'none',
				'condition' =>array('style'=>'style1')
			 ),
			 array(
				'type'    => Controls_Manager::NUMBER,
				'id'      => 'icon_box_size_width',
				'label'   => esc_html__( 'Icon Box Width', 'gymat-core' ),
				'default' => '',
				'description' => esc_html__( 'Use same height and width size', 'gymat-core' ),
				'selectors' => array(
					'{{WRAPPER}} .info-box.info-style1 .info-item .info-media' => 'width: {{VALUE}}px',
				),
				'condition' =>array('style'=>'style1')
			),
			array(
				'type'    => Controls_Manager::NUMBER,
				'id'      => 'icon_box_size_height',
				'label'   => esc_html__( 'Icon Box Height', 'gymat-core' ),
				'default' => '',
				'description' => esc_html__( 'Use same height and width size', 'gymat-core' ),
				'selectors' => array(
					'{{WRAPPER}} .info-box.info-style1 .info-item .info-media' => 'height: {{VALUE}}px',
				),
				'condition' =>array('style'=>'style1')
			),			
			array(
				'type'    => Controls_Manager::NUMBER,
				'id'      => 'icon_size',
				'label'   => esc_html__( 'Icon Size', 'gymat-core' ),
				'default' => '',
				'selectors' => array(
					'{{WRAPPER}} .info-box .info-item .info-icon i' => 'font-size: {{VALUE}}px',
				),
			),
			array(
				'type'    => Controls_Manager::COLOR,
				'id'      => 'icon_color',
				'label'   => esc_html__( 'Icon Color', 'gymat-core' ),
				'default' => '',
				'selectors' => array(
					'{{WRAPPER}} .info-box.info-style2 .info-media .info-icon i' => 'color: {{VALUE}}',
					'{{WRAPPER}} .info-box.info-style1 .info-media .info-icon i' => 'color: {{VALUE}}',
					'{{WRAPPER}} .info-box.info-style3 .info-media .info-icon i' => 'color: {{VALUE}}',
					'{{WRAPPER}} .info-box.info-style4 .info-media .info-icon i' => 'color: {{VALUE}}',
				),
			),
			array(
				'type'    => Controls_Manager::COLOR,
				'id'      => 'icon_shape_color',
				'label'   => esc_html__( 'Icon Shape Color', 'gymat-core' ),
				'default' => '',
				'selectors' => array(
					'{{WRAPPER}} .info-box.multi-infobox-2 .info-media .info-icon:after' => 'background-color: {{VALUE}}',
				),
				'condition' =>array('style'=>array('style3','style4'))
			),
			array(
				'type'    => Controls_Manager::COLOR,
				'id'      => 'icon_box_color',
				'label'   => esc_html__( 'Icon Box Color', 'gymat-core' ),
				'default' => '',
				'selectors' => array(
					'{{WRAPPER}} .info-box.info-style1 .info-item .info-media' => 'background-color: {{VALUE}}',
				),
				'condition' =>array('style'=>'style1')
			),
			array(
				'type'    => Controls_Manager::DIMENSIONS,
				'id'      => 'icon_spaceing',
				'mode'    => 'responsive',
				'label'   => esc_html__( 'Icon Spaceing', 'gymat-core' ),
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .info-box.info-style2 .info-media' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .info-box.info-style4 .info-media' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition'   => array( 'style' => array( 'style2','style4')),
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
				'id'      => 'icon_hover_color',
				'label'   => esc_html__( 'Icon Color', 'gymat-core' ),
				'default' => '',
				'selectors' => array(
					'{{WRAPPER}} .info-box.info-style1 .info-item:hover .info-media .info-icon i' => 'color: {{VALUE}}',
					'{{WRAPPER}} .info-box.info-style2 .info-item:hover .info-media .info-icon i' => 'color: {{VALUE}}',
					'{{WRAPPER}} .info-box.info-style3 .info-item:hover .info-media .info-icon i' => 'color: {{VALUE}}',
					'{{WRAPPER}} .info-box.info-style4 .info-item:hover .info-media .info-icon i' => 'color: {{VALUE}}',
				),
			),
			array(
				'type'    => Controls_Manager::COLOR,
				'id'      => 'icon_box_hover_color',
				'label'   => esc_html__( 'Icon Box Color', 'gymat-core' ),
				'default' => '',
				'selectors' => array(
					'{{WRAPPER}} .info-box.info-style1 .info-item:hover .info-media' => 'background-color: {{VALUE}}',
				),
				'condition' =>array('style'=>'style1')
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
			array(
				'mode'    => 'section_start',
				'id'      => 'sec_icon_2',
				'label'   => esc_html__( 'Icon Style', 'gymat-core' ),
				'tab'     => Controls_Manager::TAB_STYLE,
				'condition'   => array('style' => array( 'style5','style6')),
			),
			array(
				'type'    => Controls_Manager::NUMBER,
				'id'      => 'icon_size_2',
				'label'   => esc_html__( 'Icon Size', 'gymat-core' ),
				'default' => '',
				'selectors' => array(
					'{{WRAPPER}} .info-box.info-style5 .info-item .info-hover-content .info-icon i' => 'font-size: {{VALUE}}px',
					'{{WRAPPER}} .info-box.info-style5 .info-item .info-content .info-icon i' => 'font-size: {{VALUE}}px',
					'{{WRAPPER}} .info-box.info-style6 .info-item .info-media .info-icon i' => 'font-size: {{VALUE}}px',
				),
			),
			array(
				'type'    => Controls_Manager::COLOR,
				'id'      => 'icon_color_2',
				'label'   => esc_html__( 'Icon Color', 'gymat-core' ),
				'default' => '',
				'selectors' => array(
					'{{WRAPPER}} .info-box.info-style5 .info-item .info-hover-content .info-icon i' => 'color: {{VALUE}}',
					'{{WRAPPER}} .info-box.info-style5 .info-item .info-content .info-icon i' => 'color: {{VALUE}}',
					'{{WRAPPER}} .info-box.info-style6 .info-item .info-media .info-icon i' => 'color: {{VALUE}}',
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
		
		switch ( $data['style'] ) {
			case 'style7':
			$template = 'info-box-7';
			break;
			case 'style6':
			$template = 'info-box-5';
			break;
			case 'style5':
			$template = 'info-box-4';
			break;
			case 'style4':
			$template = 'info-box-3';
			break;
			case 'style3':
			$template = 'info-box-3';
			break;
			case 'style2':
			$template = 'info-box-2';
			break;
			default:
			$template = 'info-box-1';
			break;
		}

		return $this->rt_template( $template, $data );
	}
}
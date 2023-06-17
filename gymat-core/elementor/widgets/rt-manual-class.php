<?php
/**
 * @author  desvertTheme
 * @since   1.0
 * @version 1.0
 */

namespace desvertTheme\Gymat_Core;

use GymatTheme;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Image_Size;
use Elementor\Group_Control_Typography;
use Elementor\Utils;


if ( ! defined('ABSPATH' ) ) exit;

class RT_Manual_Class extends Custom_Widget_Base {

    public function __construct( $data = [], $args = null ) {
        $this->rt_name  = __( 'DV Manual Class', 'gymat-core' );
        $this->rt_base  = 'rt-manual-class';
        parent::__construct( $data, $args );
    }
	/**Today's Class get method end*/
    public function rt_fields() {
        $fields = array(
            /*Icon Start*/
            //class
            array(
                'mode'  => 'section_start',
                'id'    => 'class_general',
                'label' => __( 'Class', 'gymat-core' )
            ),
            array(
				'type'    => Controls_Manager::SELECT2,
				'id'      => 'style',
				'label'   => esc_html__( 'Class Layout', 'gymat-core' ),
				'options' => array(
					'style1' => esc_html__( 'Manual Class Layout 1', 'gymat-core' ),
					'style2' => esc_html__( 'Manual Class Layout 2 ', 'gymat-core' ),
				),
				'description' => esc_html__( 'Manually type means you insert the show data',
					'gymat-core' ),
				'default' => 'style1',
			),
            array(
				'type'    => Controls_Manager::TEXT,
				'id'      => 'title',
				'label'   => esc_html__( 'Class Name', 'gymat-core' ),
				'label_block' =>true,
				'default' => esc_html__( 'Boxing', 'gymat-core' ),
			),
            array(
				'type'    => Controls_Manager::URL,
				'id'      => 'title_url',
				'label'   => esc_html__( 'Class Title URL (Optional)', 'gymat-core' ),
				'placeholder' => 'https://title-link.com',
			),
            array(
				'type'    => Controls_Manager::TEXTAREA,
				'id'      => 'content',
				'label'   => esc_html__( 'Class Content', 'gymat-core' ),
				'label_block' =>true,
				'default' => esc_html__( 'Sed ut perspiciatis unde omnis iste natus errort voluptatem accus antium mque', 'gymat-core' ),
			),
			array(
				'type'    		=> Controls_Manager::TEXT,
				'id'      		=> 'start_time',
				'label'   		=> esc_html__( 'Start Time', 'gymat-core' ),
				'label_block' 	=>true,
				'default' => esc_html__( '12:00pm', 'gymat-core' ),
				'condition'		=>array('style'=>array('style2'))
			),
			array(
				'type'    		=> Controls_Manager::TEXT,
				'id'      		=> 'end_time',
				'label'   		=> esc_html__( 'End Time', 'gymat-core' ),
				'label_block' 	=>true,
				'default' => esc_html__( '1:00pm', 'gymat-core' ),
				'condition'		=>array('style'=>array('style2'))
			),
			array(
				'type'    		=> Controls_Manager::TEXT,
				'id'      		=> 'weekday',
				'label'   		=> esc_html__( 'Week Day', 'gymat-core' ),
				'label_block' 	=>true,
				'default' => esc_html__( 'Sat-Mon', 'gymat-core' ),
				'condition'		=>array('style'=>array('style2'))
			),
            array(
				'type'    => Controls_Manager::MEDIA,
				'id'      => 'class_bg_image',
				'label'   => esc_html__( 'Class  Image', 'gymat-core' ),
				'default' => array(
                    'url' => Utils::get_placeholder_image_src(),
                ),
				'description' => esc_html__( 'Recommended full image', 'gymat-core' ),
			),

			array(
				'type'    => Group_Control_Image_Size::get_type(),
				'mode'    => 'group',				
				'label'   => esc_html__( 'image size', 'gymat-core' ),	
				'name' => 'class_bg_image_size', 
				'separator' => 'none',
			),
            array(
                'mode'  => 'section_end'
            ),
            array(
                'mode'  => 'section_start',
                'id'    => 'section_icon',
                'label' => __( 'Icon', 'gymat-core' )
            ),
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
                'condition'   => array('icontype' => array( 'icon' ) ),
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
				'type'        => Controls_Manager::SWITCHER,
				'id'          => 'icon_display',
				'label'       => esc_html__( 'Icon Display', 'gymat-core' ),
				'label_on'    => esc_html__( 'On', 'gymat-core' ),
				'label_off'   => esc_html__( 'Off', 'gymat-core' ),
				'default'     => 'yes',
				'description' => esc_html__( 'Show or Hide More Button . Default: On', 'gymat-core' ),
				
			),
            array(
                'mode'  => 'section_end'
            ),
            //icon end

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
				'type'    => Controls_Manager::COLOR,
				'id'      => 'class_title_color',
				'label'   => esc_html__( 'Title Color', 'gymat-core' ),
				'default' => '',
				'selectors' => array( 
					'{{WRAPPER}} .class-default .class-title' => 'color: {{VALUE}}',
					'{{WRAPPER}} .class-manual-layout2 .class-item .class-title a' => 'color: {{VALUE}}',
					'{{WRAPPER}} .class-manual-layout2 .class-item .class-title' => 'color: {{VALUE}}',
				),
			),
            array (
				'type'    => Controls_Manager::COLOR,
				'id'      => 'class_title_hover_color',
				'label'   => esc_html__( 'Title Hover Color', 'gymat-core' ),
				'default' => '',
				'selectors' => array( 
					'{{WRAPPER}} .class-default .class-title:hover' => 'color: {{VALUE}}',
					'{{WRAPPER}} .class-manual-layout2 .class-item .class-title a:hover' => 'color: {{VALUE}}',
					'{{WRAPPER}} .class-manual-layout2 .class-item .class-title:hover' => 'color: {{VALUE}}',
				),
			),
            array (
				'type'    => Controls_Manager::COLOR,
				'id'      => 'class_content_color',
				'label'   => esc_html__( 'Content Color', 'gymat-core' ),
				'default' => '',
				'selectors' => array( 
					'{{WRAPPER}} .class-grid-layout1 .class-content p' => 'color: {{VALUE}}',
					'{{WRAPPER}} .class-grid-layout2 .class-content p' => 'color: {{VALUE}}',
				),
				'condition' =>array('style'=>array('style1'))
			),
            array (
				'type'    => Controls_Manager::COLOR,
				'id'      => 'class_content_bg_color',
				'label'   => esc_html__( 'Content Background', 'gymat-core' ),
				'default' => '',
				'selectors' => array( 
					'{{WRAPPER}} .class-grid-layout1 .class-item' => 'background-color: {{VALUE}}',
					'{{WRAPPER}} .class-grid-layout2 .class-item .class-box-content' => 'background-color: {{VALUE}}',
				),
				'condition' =>array('style'=>array('style1'))
			),
			array (
				'type'    => Controls_Manager::COLOR,
				'id'      => 'class_icon_bg_color',
				'label'   => esc_html__( 'Icon Background', 'gymat-core' ),
				'default' => '',
				'selectors' => array( 
					'{{WRAPPER}} .class-grid-layout2 .class-item .class-media' => 'background-color: {{VALUE}}',
				),
				'condition' =>array('style'=>array('style1'))
			),
			array (
				'type'    => Controls_Manager::COLOR,
				'id'      => 'class_icon_color',
				'label'   => esc_html__( 'Icon Color', 'gymat-core' ),
				'default' => '',
				'selectors' => array( 
					'{{WRAPPER}} .class-grid-layout2 .class-item .class-media .class-icon i' => 'color: {{VALUE}}',
					'{{WRAPPER}} .class-manual-layout2 .class-media .class-icon i' => 'color: {{VALUE}}',
				),
			),
			array (
				'type'    => Controls_Manager::COLOR,
				'id'      => 'class_icon_hover_color',
				'label'   => esc_html__( 'Icon Hover Color', 'gymat-core' ),
				'default' => '',
				'selectors' => array( 
					'{{WRAPPER}} .class-manual-layout2 .class-item:hover .class-thumbnail .class-media .class-icon i' => 'color: {{VALUE}}',
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
			case 'style2':
			$template = 'rt-manual-class-2';
			break;
			default:
			$template = 'rt-manual-class';
			break;
		}
        return $this->rt_template( $template, $data );
    }

}

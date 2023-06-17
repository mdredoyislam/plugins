<?php
/**
 * @author  desvertTheme
 * @since   1.0
 * @version 1.0
 */

namespace desvertTheme\Gymat_Core;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Image_Size;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Typography;
use Elementor\Utils;

if ( ! defined( 'ABSPATH' ) ) exit;
class RT_Pricing_Swicher extends Custom_Widget_Base {
    public function __construct( $data = [], $args = null ){
        $this->rt_name = esc_html__( 'DV Pricing Swicher', 'gymat-core' );
        $this->rt_base = 'rt-pricing-swicher';
        parent::__construct( $data, $args );
    }
    public function rt_fields(){
        $repeater = new \Elementor\Repeater();
		$repeater2 = new \Elementor\Repeater();

		$repeater->add_control(
			'package_name',
			 [
				'type'    => Controls_Manager::TEXT,
				'label'   => esc_html__( 'Package Name', 'gymat-core' ),
				'default' => 'Basic Plan',
			]
		);
		$repeater->add_control(
			'monthly_price',
			 [
				'type'    => Controls_Manager::TEXT,
				'label'   => esc_html__( 'Monthly Price', 'gymat-core' ),
				'default' => '$19',
			]
		);
        $repeater->add_control(
			'monthly_duration',
			 [
				'type'    => Controls_Manager::TEXT,
				'label'   => esc_html__( 'Duration', 'gymat-core' ),
				'default' => 'Month',
			]
		);
		$repeater->add_control(
			'monthly_list_item',
			 [
				'type'    => Controls_Manager::WYSIWYG,
				'label'   => esc_html__( 'Unlimited Access to Home Club', 'gymat-core' ),
			]
		);
        $repeater->add_control(
			'monthly_btn_text',
			 [
				'type'    => Controls_Manager::TEXT,
				'label'   => esc_html__( 'Button Text', 'gymat-core' ),
				'default' => 'Purchase Now',
			]
		);
		$repeater->add_control(
			'monthly_btn_link',
			 [
				'type'    => Controls_Manager::URL,
				'label'   => esc_html__( 'Button Link', 'gymat-core' ),
			]
		);
        $repeater->add_control(
			'monthly_icon', 
            array(
                'type'  => Controls_Manager::ICONS,
				'label' => esc_html__( 'Icon', 'gymat-core' ),
				'description' => esc_html__( 'Icon use only for layout 1', 'gymat-core' ),
				'label_block' => true,
            ),
		);
		$repeater->add_control(
            'img1',
            [
                'type' => Controls_Manager::MEDIA,
                'label' =>   esc_html__('Image', 'gymat-core'),
				'description' => esc_html__( 'Image use only for layout 2', 'gymat-core' ),
				'default' => [
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				],                
            ]
        );
        
        //yearly repeater control
        $repeater2->add_control(
			'yearly_package_name',
			 [
				'type'    => Controls_Manager::TEXT,
				'label'   => esc_html__( 'Package Name', 'gymat-core' ),
				'default' => 'Basic Plan',
			]
		);
		$repeater2->add_control(
			'yearly_price',
			 [
				'type'    => Controls_Manager::TEXT,
				'label'   => esc_html__( 'Monthly Price', 'gymat-core' ),
				'default' => '$39',
			]
		);
        $repeater2->add_control(
			'yearly_duration',
			 [
				'type'    => Controls_Manager::TEXT,
				'label'   => esc_html__( 'Duration', 'gymat-core' ),
				'default' => 'Year',
			]
		);
		$repeater2->add_control(
			'yearly_list_item',
			 [
				'type'    => Controls_Manager::WYSIWYG,
				'label'   => esc_html__( 'Unlimited Access to Home Club', 'gymat-core' ),
			]
		);
        $repeater2->add_control(
			'yearly_btn_text',
			 [
				'type'    => Controls_Manager::TEXT,
				'label'   => esc_html__( 'Button Text', 'gymat-core' ),
				'default' => 'Purchase Now',
			]
		);
		$repeater2->add_control(
			'yearly_btn_link',
			 [
				'type'    => Controls_Manager::URL,
				'label'   => esc_html__( 'Button Link', 'gymat-core' ),
			]
		);
        $repeater2->add_control(
			'yearly_icon', 
            array(
                'type'  => Controls_Manager::ICONS,
				'label' => esc_html__( 'Icon', 'gymat-core' ),
				'label_block' => true,
            ),
		);
		$repeater2->add_control(
            'img2',
            [
                'type' => Controls_Manager::MEDIA,
                'label' =>   esc_html__('Image', 'gymat-core'),
				'description' => esc_html__( 'Image use only for layout 2', 'gymat-core' ),
				'default' => [
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				],                
            ]
        );
        
        $fields=array(
            array(
                'mode'    => 'section_start',
                'id'      => 'sec_general',
                'label'   => esc_html__( 'General', 'gymat-core' ),
            ),
			array(
				'type'    => Controls_Manager::SELECT2,
				'id'      => 'style',
				'label'   => esc_html__( 'Layout', 'gymat-core' ),
				'options' => array(
					'style1' => esc_html__( 'Pricing Table 1', 'gymat-core' ),
					'style2' => esc_html__( 'Pricing Table 2', 'gymat-core' ),
				),
				'default' => 'style1',
			),
            array(
                'type'        => Controls_Manager::TEXT,
                'id'          => 'section_title',
                'label'       => esc_html__( 'Section Title', 'gymat-core' ),
                'default'     => "Our Simple Pricing plans ",
                'condition'   =>array('style'=>array('style2'))
            ),
            array(
                'type'        => Controls_Manager::TEXT,
                'id'          => 'section_subtitle',
                'label'       => esc_html__( 'Section Subtitle', 'gymat-core' ),
                'default'     => "Pricing Chart",
                'condition'   =>array('style'=>array('style2'))
            ),
            array(
                'type'        => Controls_Manager::TEXTAREA,
                'id'          => 'section_content',
                'label'       => esc_html__( 'Section Content', 'gymat-core' ),
                'default'     => "",
                'condition'   =>array('style'=>array('style2'))
            ),
            array(
                'type'        => Controls_Manager::TEXT,
                'id'          => 'monthly_title',
                'label'       => esc_html__( 'Monthly Title', 'gymat-core' ),
                'default'     => "Monthly",
            ),
            array(
                'type'        => Controls_Manager::TEXT,
                'id'          => 'yearly_title',
                'label'       => esc_html__( 'Yearly Title', 'gymat-core' ),
                'default'     => "Yearly",
            ),
            array (
				'type'    => Controls_Manager::REPEATER,
				'id'      => 'monthly_features',
				'label'   => esc_html__( 'Monthly Feature List', 'neeon-core' ),
				'fields' => $repeater->get_controls(),
				'default' => array(
					[
                        'monthly_list_item' => 'Unlimited Access to Home Club',
                    ],
					[
                        'monthly_list_item' => 'Unlimited Access to Home Club',
                    ],
					[
                        'monthly_list_item' => 'Unlimited Access to Home Club',
                    ],
				),
                
			),
            array (
				'type'    => Controls_Manager::REPEATER,
				'id'      => 'yearly_features',
				'label'   => esc_html__( 'Yearly Feature List', 'neeon-core' ),
				'fields' => $repeater2->get_controls(),
				'default' => array(
					[
                        'yearly_list_item' => 'Unlimited Access to Home Club',
                    ],
					[
                        'yearly_list_item' => 'Unlimited Access to Home Club',
                    ],
					[
                        'yearly_list_item' => 'Unlimited Access to Home Club',
                    ],
				),
                
			),
            array(
                'mode' => 'section_end',
            ),
            array(
                'mode'    => 'section_start',
                'id'      => 'package_name_style',
                'label'   => esc_html__( 'Package Name Style', 'gymat-core' ),
                'tab'     => Controls_Manager::TAB_STYLE,
            ),
            array (
				'mode'    => 'group',
				'type'    => Group_Control_Typography::get_type(),
				'name'    => 'package_name_typo',
				'label'   => esc_html__( 'Package Name Typography', 'gymat-core' ),
				'selector' => '{{WRAPPER}} .rt-pricing-table__plan-name',
			),
			array(
				'type'    => Controls_Manager::COLOR,
				'id'      => 'section_title_color',
				'label'   => esc_html__( 'Section Title Color', 'gymat-core' ),
				'default' => '',
				'selectors' => array(
					'{{WRAPPER}} .pricing-style2 .section-title h2' => 'color: {{VALUE}}',
				),
				'condition' =>array('style'=>array('style2'))
			),
            array(
				'type'    => Controls_Manager::COLOR,
				'id'      => 'package_name_color',
				'label'   => esc_html__( 'Package Name Color', 'gymat-core' ),
				'default' => '',
				'selectors' => array(
					'{{WRAPPER}} .rt-pricing-table__plan-name' => 'color: {{VALUE}}',
				)
			),
            array(
				'type'    => Controls_Manager::COLOR,
				'id'      => 'duration_color',
				'label'   => esc_html__( 'Duration Color', 'gymat-core' ),
				'default' => '',
				'selectors' => array(
					'{{WRAPPER}} .rt-pricing-table__item-price sub' => 'color: {{VALUE}}',
				)
			),
            array(
				'type'    => Controls_Manager::COLOR,
				'id'      => 'package_price_color',
				'label'   => esc_html__( 'Package Price Color', 'gymat-core' ),
				'default' => '',
				'selectors' => array(
					'{{WRAPPER}} .rt-pricing-table__item-price h4' => 'color: {{VALUE}}',
				)
			),
            array (
				'mode'    => 'group',
				'type'    => Group_Control_Typography::get_type(),
				'name'    => 'package_feature_typo',
				'label'   => esc_html__( 'Feature List Typography', 'gymat-core' ),
				'selector' => '{{WRAPPER}} .rt-pricing-table ul li',
			),
            array(
				'type'    => Controls_Manager::COLOR,
				'id'      => 'package_feature_color',
				'label'   => esc_html__( 'Feature List Text Color', 'gymat-core' ),
				'default' => '',
				'selectors' => array(
					'{{WRAPPER}} .rt-pricing-table ul li' => 'color: {{VALUE}}',
				)
			),
            array(
				'type'    => Controls_Manager::COLOR,
				'id'      => 'package_feature_icon_color',
				'label'   => esc_html__( 'Feature List Icon Color', 'gymat-core' ),
				'default' => '',
				'selectors' => array(
					'{{WRAPPER}} .rt-pricing-table ul li:after' => 'color: {{VALUE}}',
				)
			),
            array(
				'type'    => Controls_Manager::COLOR,
				'id'      => 'package_feature_box_color',
				'label'   => esc_html__( 'Pricing Box Background', 'gymat-core' ),
				'default' => '',
				'selectors' => array(
					'{{WRAPPER}} .rt-pricing-table' => 'background-color: {{VALUE}}',
				),
			),
            array(
                'mode' => 'section_end',
            )

        );
        return $fields;
    }
    protected function render(){
        $data = $this->get_settings();
		switch ( $data['style'] ) {
			case 'style2':
			$template = 'pricing-switcher-2';
			break;
			default:
			$template = 'pricing-switcher';
		}
        
        return $this->rt_template( $template, $data );
    } 
}    

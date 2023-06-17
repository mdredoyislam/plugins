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
class Pricing_Plan extends Custom_Widget_Base {
    public function __construct( $data = [], $args = null ){
        $this->rt_name = esc_html__( 'DV Pricing Plan', 'gymat-core' );
        $this->rt_base = 'rt-pricing-plan';
        parent::__construct( $data, $args );
    }
    public function rt_fields(){
        $repeater = new \Elementor\Repeater();
		
		$repeater->add_control(
			'text', 
            array(
                'type'  => Controls_Manager::TEXT,
				'label' => esc_html__( 'Feature Content', 'gymat-core' ),
				'label_block' => true,
            ),
		);
        $repeater->add_control(
			'feature_icon', 
            array(
                'type'  => Controls_Manager::ICONS,
				'label' => esc_html__( 'Icon', 'gymat-core' ),
				'label_block' => true,
            ),
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
                'id'          => 'package_name',
                'label'       => esc_html__( 'Package Name', 'gymat-core' ),
                'default'     => "Starter Plan",
            ),
			array(
                'type'        => Controls_Manager::TEXTAREA,
                'id'          => 'package_text',
                'label'       => esc_html__( 'Package Text', 'gymat-core' ),
                'default'     => "Financa dummy text of the printing and typesetting industry.",
				'condition'   =>array('style'=>array('style2'))
            ),
            array(
                'type'        => Controls_Manager::TEXT,
                'id'          => 'currency_icon',
                'label'       => esc_html__( 'Currency Icon', 'gymat-core' ),
                'default'     => "$",
            ),
            array(
                'type'        => Controls_Manager::TEXT,
                'id'          => 'price',
                'label'       => esc_html__( 'Price', 'gymat-core' ),
                'description' => esc_html__( 'Prefix of currency.', 'gymat-core' ),
                'default'     => "39",
            ),
            array(
                'type'        => Controls_Manager::TEXT,
                'id'          => 'duration',
                'label'       => esc_html__( 'Duration', 'gymat-core' ),
                'description' => esc_html__( 'Use postfix if you want', 'gymat-core' ),
                'default'     => "Per Month",
            ),
            array(
                'type'        => Controls_Manager::TEXT,
                'id'          => 'button_text',
                'label'       => esc_html__( 'Button Text', 'gymat-core' ),
                'default'     => "Purchase Now",
            ),
            array(
                'type'        => Controls_Manager::URL,
                'id'          => 'button_url',
                'label'       => esc_html__( 'Button URL', 'gymat-core' ),
                'default'     => ['url' => '#'],
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
            array (
				'type'    => Controls_Manager::REPEATER,
				'id'      => 'features',
				'label'   => esc_html__( 'Feature List', 'neeon-core' ),
				'fields' => $repeater->get_controls(),
				'default' => array(
					[
                        'text' => 'Free Hand',
                    ],
					[
                        'text' => 'Gym Fitness',
                    ],
					[
                        'text' => 'Weight Loss',
                    ],
                    [
                        'text' => 'Personal Trainer',
                    ],
                    [
                        'text' => 'Cycling',
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
				'selector' => '{{WRAPPER}} .default-pricing  .item-title',
			),
            array(
				'type'    => Controls_Manager::COLOR,
				'id'      => 'package_name_color',
				'label'   => esc_html__( 'Package Name Color', 'gymat-core' ),
				'default' => '',
				'selectors' => array(
					'{{WRAPPER}} .pricing-box-1 .item-img .item-title' => 'color: {{VALUE}}',
					'{{WRAPPER}} .pricing-box-2 .item-content .item-title ' => 'color: {{VALUE}}',
				)
			),
            array (
				'mode'    => 'group',
				'type'    => Group_Control_Typography::get_type(),
				'name'    => 'package_text_typo',
				'label'   => esc_html__( 'Package Text Typography', 'gymat-core' ),
				'selector' => '{{WRAPPER}} .pricing-box-2 .item-content p',
			),
            array(
				'type'    => Controls_Manager::COLOR,
				'id'      => 'package_text_color',
				'label'   => esc_html__( 'Package Text Color', 'gymat-core' ),
				'default' => '',
				'selectors' => array(
					'{{WRAPPER}} .pricing-box-2 .item-content p' => 'color: {{VALUE}}',
				)
			),
            array(
				'type'    => Controls_Manager::COLOR,
				'id'      => 'currency_color',
				'label'   => esc_html__( 'Currency Color', 'gymat-core' ),
				'default' => '',
				'selectors' => array(
					'{{WRAPPER}} .pricing-box-1 .item-content .rt-price-box .dollar-sign' => 'color: {{VALUE}}',
					'{{WRAPPER}} .pricing-box-1 .item-content .rt-price-box .month-price' => 'color: {{VALUE}}',
					'{{WRAPPER}} .pricing-box-2 .item-content .rt-price-box span' => 'color: {{VALUE}}',
				)
			),
            array(
				'type'    => Controls_Manager::COLOR,
				'id'      => 'package_price_color',
				'label'   => esc_html__( 'Package Price Color', 'gymat-core' ),
				'default' => '',
				'selectors' => array(
					'{{WRAPPER}} .pricing-box-1 .item-content .rt-price-box' => 'color: {{VALUE}}',
					'{{WRAPPER}} .pricing-box-2 .item-content .rt-price-box' => 'color: {{VALUE}}',
				)
			),
            array (
				'mode'    => 'group',
				'type'    => Group_Control_Typography::get_type(),
				'name'    => 'package_feature_typo',
				'label'   => esc_html__( 'Feature List Typography', 'gymat-core' ),
				'selector' => '{{WRAPPER}} .default-pricing .item-content .feature-list li',
			),
            array(
				'type'    => Controls_Manager::COLOR,
				'id'      => 'package_feature_color',
				'label'   => esc_html__( 'Feature List Text Color', 'gymat-core' ),
				'default' => '',
				'selectors' => array(
					'{{WRAPPER}} .pricing-box-1 .item-content .feature-list li ' => 'color: {{VALUE}}',
					'{{WRAPPER}} .pricing-box-2 .item-content .feature-list li ' => 'color: {{VALUE}}',
				)
			),
            array(
				'type'    => Controls_Manager::COLOR,
				'id'      => 'package_feature_icon_color',
				'label'   => esc_html__( 'Feature List Icon Color', 'gymat-core' ),
				'default' => '',
				'selectors' => array(
					'{{WRAPPER}} .default-pricing .feature-list i' => 'color: {{VALUE}}',
				)
			),
            array(
				'type'    => Controls_Manager::COLOR,
				'id'      => 'package_feature_box_color',
				'label'   => esc_html__( 'Pricing Box Background', 'gymat-core' ),
				'default' => '',
				'selectors' => array(
					'{{WRAPPER}} .pricing-box-1' => 'background-color: {{VALUE}}',
				),
				'condition' =>array('style'=>array('style1'))
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
			$template = 'pricing-plan-2';
			break;
			default:
			$template = 'pricing-plan';
		}
        
        return $this->rt_template( $template, $data );
    } 
}    

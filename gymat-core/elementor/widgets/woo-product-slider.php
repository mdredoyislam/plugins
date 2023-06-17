<?php
/**
 * @author  desvertTheme
 * @since   1.0
 * @version 1.0
 */
namespace desvertTheme\Gymat_Core;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Scheme_Typography;

if ( ! defined('ABSPATH' ) ) exit;

class Woo_Product_Slider extends Custom_Widget_Base {

    public function __construct( $data = [], $args = null ){
		$this->rt_name = esc_html__( 'Product Slider', 'gymat-core' );
		$this->rt_base = 'rt-product-slider';
		parent::__construct( $data, $args );
	}
    public function rt_fields(){
        $terms = get_terms( array('taxonomy' => 'product_cat' ) );
        $category_dropdown = array( '0' => __( 'All Categories', 'gymat-core' ) );
        foreach ( $terms as $category ) {
            $category_dropdown[$category->term_id] = $category->name;
        }
		$sortby = array(
            'ASC'       => __( 'Ascending', 'gymat-core' ),
            'DESC'      =>  __( 'Descending', 'gymat-core' ),
        ); 
        $fields = array(
			array(
				'mode'    => 'section_start',
				'id'      => 'sec_general',
				'label'   => esc_html__( 'Section', 'gymat-core' ),
			),
			array(
				'type'    => Controls_Manager::SELECT2,
				'id'      => 'style',
				'label'   => esc_html__( 'Style', 'gymat-core' ),
				'options' => array(
					'style1' => esc_html__( 'Layout 1', 'gymat-core' ),
					'style2' => esc_html__( 'Layout 2', 'gymat-core' ),
				),
				'default' => 'style1',
			),
            array(
				'type'          => Controls_Manager::TEXT,
				'id'            => 'section_title',
				'label'         => esc_html__( 'Section Title', 'gymat-core' ),
                'label_block'   =>true,
				'default'       => __('Wellcome To Gymat','gymat-core'),
			),
            array(
                'id'        => 'cat',
                'label'     => __( 'Categories', 'gymat-core' ),
                'type'      => Controls_Manager::SELECT,
                'options'   => $category_dropdown,
                'default'   => '0',
            ),
            array(
				'type'    => Controls_Manager::SELECT2,
				'id'      => 'filter',
				'label'   => esc_html__( 'Filter Product', 'gymat-core' ),
				'options' => array(
					'normal'              => esc_html__( 'All Products', 'gymat-core' ),
					'featured'              => esc_html__( 'Featured Product', 'gymat-core' ),
					'onsale'                => esc_html__( 'Onsale Product', 'gymat-core' ),
				),
				'default' => 'normal',
			),
            array(
				'type'    => Controls_Manager::SELECT2,
				'id'      => 'orderby',
				'label'   => esc_html__( 'Orderby', 'gymat-core' ),
				'options' => array(
                    'date'        => __('Date', 'medimall-core'),
                    'title'       => __('Title', 'medimall-core'),
                    'bestseller'  => __('Best Seller', 'gymat-core'),
					'rand'        => esc_html__( 'Rand', 'gymat-core' ),
                    'price_l'     => __('Price(Low-High)', 'gymat-core'),
                    'price_h'     => __('Price(High-Low)', 'gymat-core'),
				),
				'default' => 'title',
			),
			array(
                'id'        => 'sortby',
                'label'     => __( 'Sort by', 'gymedge-core' ),
                'type'      => Controls_Manager::SELECT,
                'options'   => $sortby,
                'default'   => 'ASC',
				'conditions' => [
					'relation' => 'or',
					'terms' => [
						[
							'name' => 'orderby',
							'operator' => '==',
							'value' => 'date',
						],
						[
							'name' => 'orderby',
							'operator' => '==',
							'value' => 'title',
						],
					],
				],
            ),
            array(
                'id'            => 'item_no',
                'label'         => __( 'Total number of items', 'gymat-core' ),
                'type'          => Controls_Manager::NUMBER,
                'default'       =>16,
                'description'   => __( 'Write -1 to show all', 'gymat-core' ),
            ),
            array(
				'type'        => Controls_Manager::SWITCHER,
				'id'          => 'cat_display',
				'label'       => __( 'Category Name Display', 'gymat-core' ),
				'label_on'    => __( 'On', 'gymat-core' ),
				'label_off'   => __( 'Off', 'gymat-core' ),
				'default'     => 'yes',
			),
            array(
				'type'        => Controls_Manager::SWITCHER,
				'id'          => 'rating_display',
				'label'       => __( 'Rating Display', 'gymat-core' ),
				'label_on'    => __( 'On', 'gymat-core' ),
				'label_off'   => __( 'Off', 'gymat-core' ),
				'default'     => 'yes',
				'condition'   =>array('style'=>array('style1'))
			),
            array(
				'type'        => Controls_Manager::SWITCHER,
				'id'          => 'quick_view_display',
				'label'       => __( 'Quick View Display', 'gymat-core' ),
				'label_on'    => __( 'On', 'gymat-core' ),
				'label_off'   => __( 'Off', 'gymat-core' ),
				'default'     => 'yes',
				'condition'   =>array('style'=>array('style1'))
			),
            array(
				'type'        => Controls_Manager::SWITCHER,
				'id'          => 'wishlist_display',
				'label'       => __( 'Wishlist Display', 'gymat-core' ),
				'label_on'    => __( 'On', 'gymat-core' ),
				'label_off'   => __( 'Off', 'gymat-core' ),
				'default'     => 'yes',
				'condition'   =>array('style'=>array('style1'))
			),
            
            array(
                'mode'  => 'section_end'
            ),
			// Slider options
			array(
				'mode'        => 'section_start',
				'id'          => 'sec_slider',
				'label'       => esc_html__( 'Slider Options', 'gymat-core' ),
			),			
			array(
				'type'        => Controls_Manager::SWITCHER,
				'id'          => 'slider_autoplay',
				'label'       => esc_html__( 'Autoplay', 'gymat-core' ),
				'label_on'    => esc_html__( 'On', 'gymat-core' ),
				'label_off'   => esc_html__( 'Off', 'gymat-core' ),
				'default'     => false,
				'description' => esc_html__( 'Enable or disable autoplay. Default: On', 'gymat-core' ),
			),
			array(
				'type'        => Controls_Manager::SWITCHER,
				'id'          => 'display_arrow',
				'label'       => esc_html__( 'Navigation Arrow', 'gymat-core' ),
				'label_on'    => esc_html__( 'On', 'gymat-core' ),
				'label_off'   => esc_html__( 'Off', 'gymat-core' ),
				'default'     => 'yes',
				'description' => esc_html__( 'Navigation Arrow. Default: On', 'gymat-core' ),
			),
			array(
				'type'        => Controls_Manager::SWITCHER,
				'id'          => 'centered_slides',
				'label'       => esc_html__( 'Centered Slides', 'gymat-core' ),
				'label_on'    => esc_html__( 'On', 'gymat-core' ),
				'label_off'   => esc_html__( 'Off', 'gymat-core' ),
				'default'     => 'no',
				'description' => esc_html__( 'Centered Slides. Default: Off', 'gymat-core' ),
			),
			array(
				'type'    => Controls_Manager::SLIDER,
				'mode' 			=> 'responsive',
				'id'      => 'slides_per_group',
				'label'   => esc_html__( 'slides Per Group', 'gymat-core' ),
				'default' => array(
					'size' => 1,
				),
				'description' => esc_html__( 'slides Per Group. Default: 1', 'gymat-core' ),
			),
			
			array(
				'type'    => Controls_Manager::SLIDER,
				'mode' 			=> 'responsive',
				'id'      => 'slides_space',
				'label'   => esc_html__( 'Slides Space', 'gymat-core' ),
				'size_units' => array( 'px', '%' ),
				'default' => array(
					'unit' => 'px',
					'size' => 24,
				),
				'description' => esc_html__( 'Slides Space. Default: 24', 'gymat-core' ),
			),
			array(
				'type'    => Controls_Manager::NUMBER,
				'id'      => 'slider_autoplay_delay',
				'label'   => esc_html__( 'Autoplay Slide Delay', 'gymat-core' ),
				'default' => 2000,
				'description' => esc_html__( 'Set any value for example 5 seconds to play it in every 5 seconds. Default: 5 Seconds', 'gymat-core' ),
				'condition'   => array( 'slider_autoplay' => 'yes' ),
			),
			array(
				'type'    => Controls_Manager::NUMBER,
				'id'      => 'slider_autoplay_speed',
				'label'   => esc_html__( 'Autoplay Slide Speed', 'gymat-core' ),
				'default' => 1000,
				'description' => esc_html__( 'Set any value for example .8 seconds to play it in every 2 seconds. Default: .8 Seconds', 'gymat-core' ),
				'condition'   => array( 'slider_autoplay' => 'yes' ),
			),
			
			array(
				'type'        => Controls_Manager::SLIDER,
				'id'          => 'slidesPerColumn',
				'label'       => esc_html__( 'Slider Rows', 'gymat-core' ),
                'range' => [
                    'px' => [
                        'min' => 1,
                        'max' => 6,
                        'step' => 1,
                    ],
                ],
                'size_units' => [''],
                'default' => [
                    'size' => 3,
                ],
			),
			array(
				'id'      => 'slider_item_heading',
				'type' =>        Controls_Manager::HEADING,
				'label'   => __( 'Responsive items', 'gymat-core' ),
				'separator' => 'before',
			 ),
			 
			array(
				'type'        => Controls_Manager::SLIDER,
				'id'          => 'desktop',
				'label'       => esc_html__( 'Desktop items', 'gymat-core' ),
                'range' => [
                    'px' => [
                        'min' => 1,
                        'max' => 6,
                        'step' => 1,
                    ],
                ],
                'size_units' => [''],
                'default' => [
                    'size' => 4,
                ],
			),
			array(
				'type'        => Controls_Manager::SLIDER,
				'id'          => 'laptop',
				'label'       => esc_html__( 'Laptop items', 'gymat-core' ),
                'range' => [
                    'px' => [
                        'min' => 1,
                        'max' => 6,
                        'step' => 1,
                    ],
                ],
                'size_units' => [ ''],
                'default' => [
                    'size' => 3,
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
                'size_units' => [ ''],
                'default' => [
                    'size' => 2,
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
                'size_units' => [ ''],
                'default' => [
                    'size' => 2,
                ],
			),
			array(
				'type'        => Controls_Manager::SLIDER,
				'id'          => 'item_mobile',
				'label'       => esc_html__( 'Mobile items', 'gymat-core' ),
                'range' => [
                    'px' => [
                        'min' => 1,
                        'max' => 6,
                        'step' => 1,
                    ],
                ],
                'size_units' => [ ''],
                'default' => [
                    'size' => 1,
                ],
			),
			array(
				'mode' => 'section_end',
			),
			// Action Button style
			array(
	            'mode'    => 'section_start',
	            'id'      => 'sec_action_style',
	            'label'   => esc_html__( 'Action Button Style', 'gymat-core' ),
	            'tab'     => Controls_Manager::TAB_STYLE,
				'condition'   =>array('style'=>array('style1'))
	        ),
	        array(
				'mode'    => 'group',
				'type'    => Group_Control_Typography::get_type(),
				'name'    => 'add_to_cart_typo',
				'label'   => esc_html__( 'Text', 'gymat-core' ),
				'selector' => '{{WRAPPER}} .product-slider-addon .rt-thumb-wrapper .add-to-cart a',
			),
			array(
				'type'    => Controls_Manager::COLOR,
				'id'      => 'Color',
				'label'   => esc_html__( 'Color', 'gymat-core' ),
				'default' => '',
				'selectors' => array(
					'{{WRAPPER}} .product-slider-addon .rt-thumb-wrapper .add-to-cart a' => 'color: {{VALUE}}',
					'{{WRAPPER}} .product-slider-addon .rt-thumb-wrapper .rt-buttons-area .rt-buttons a' => 'color: {{VALUE}}',
				),
			),
			array(
				'mode' => 'section_end',
			),
			// Action Button style
			array(
	            'mode'    => 'section_start',
	            'id'      => 'sec_content_style',
	            'label'   => esc_html__( 'Content Style', 'gymat-core' ),
	            'tab'     => Controls_Manager::TAB_STYLE,
	        ),
	        array(
				'mode'    => 'group',
				'type'    => Group_Control_Typography::get_type(),
				'name'    => 'cat_typo',
				'label'   => esc_html__( 'Category Typo', 'gymat-core' ),
				'selector' => '{{WRAPPER}} .woocommerce .product-slider-addon .product-content-box .product-cat a',
			),
			array(
				'mode'    => 'group',
				'type'    => Group_Control_Typography::get_type(),
				'name'    => 'title_typo',
				'label'   => esc_html__( 'Title Typo', 'gymat-core' ),
				'selector' => '{{WRAPPER}} .product-slider-addon .product-content-box .rt-title',
			),
			array(
				'mode'    => 'group',
				'type'    => Group_Control_Typography::get_type(),
				'name'    => 'price_typo',
				'label'   => esc_html__( 'Price Typo', 'gymat-core' ),
				'selector' => '{{WRAPPER}} .woocommerce .product-slider-addon .rt-price',
			),
			array(
				'type'    => Controls_Manager::COLOR,
				'id'      => 'cat_cololor',
				'label'   => esc_html__( 'Category Color', 'gymat-core' ),
				'default' => '',
				'selectors' => array(
					'{{WRAPPER}} .woocommerce .product-slider-addon .product-content-box .product-cat a' => 'color: {{VALUE}}',
				),
			),
			array(
				'type'    => Controls_Manager::COLOR,
				'id'      => 'cat__hover_cololor',
				'label'   => esc_html__( 'Category Hover Color', 'gymat-core' ),
				'default' => '',
				'selectors' => array(
					'{{WRAPPER}} .woocommerce .product-slider-addon .product-content-box .product-cat a:hover' => 'color: {{VALUE}}',
				),
			),
			array(
				'type'    => Controls_Manager::COLOR,
				'id'      => 'title_color',
				'label'   => esc_html__( 'Title Color', 'gymat-core' ),
				'default' => '',
				'selectors' => array(
					'{{WRAPPER}} .product-slider-addon .product-content-box .rt-title a' => 'color: {{VALUE}}',
				),
			),
			array(
				'type'    => Controls_Manager::COLOR,
				'id'      => 'title_hover_color',
				'label'   => esc_html__( 'Title Hover Color', 'gymat-core' ),
				'default' => '',
				'selectors' => array(
					'{{WRAPPER}} .product-slider-addon .product-content-box .rt-title a:hover' => 'color: {{VALUE}}',
				),
			),
			array(
				'type'    => Controls_Manager::COLOR,
				'id'      => 'price_color',
				'label'   => esc_html__( 'Price Color', 'gymat-core' ),
				'default' => '',
				'selectors' => array(
					'{{WRAPPER}} .woocommerce .product-slider-addon .rt-price' => 'color: {{VALUE}}',
				),
			),
			array(
				'mode' => 'section_end',
			),
			// Animation style
			array(
	            'mode'    => 'section_start',
	            'id'      => 'sec_animation_style',
	            'label'   => esc_html__( 'Animation', 'gymat-core' ),
	            'tab'     => Controls_Manager::TAB_STYLE,
	        ),
			array(
				'type'    => Controls_Manager::SELECT2,
				'id'      => 'animation',
				'label'   => esc_html__( 'Animation', 'gymat-core' ),
				'options' => array(
					'wow'        => esc_html__( 'On', 'gymat-core' ),
					'hide'        => esc_html__( 'Off', 'gymat-core' ),
				),
				'default' => 'wow',
			),
			array(
				'type'    => Controls_Manager::SELECT2,
				'id'      => 'animation_effect',
				'label'   => esc_html__( 'Entrance Animation', 'gymat-core' ),
				'options' => array(
                    'none' => esc_html__( 'none', 'gymat-core' ),
					'bounce' => esc_html__( 'bounce', 'gymat-core' ),
					'flash' => esc_html__( 'flash', 'gymat-core' ),
					'pulse' => esc_html__( 'pulse', 'gymat-core' ),
					'rubberBand' => esc_html__( 'rubberBand', 'gymat-core' ),
					'shakeX' => esc_html__( 'shakeX', 'gymat-core' ),
					'shakeY' => esc_html__( 'shakeY', 'gymat-core' ),
					'headShake' => esc_html__( 'headShake', 'gymat-core' ),
					'swing' => esc_html__( 'swing', 'gymat-core' ),					
					'fadeIn' => esc_html__( 'fadeIn', 'gymat-core' ),
					'fadeInDown' => esc_html__( 'fadeInDown', 'gymat-core' ),
					'fadeInLeft' => esc_html__( 'fadeInLeft', 'gymat-core' ),
					'fadeInRight' => esc_html__( 'fadeInRight', 'gymat-core' ),
					'fadeInUp' => esc_html__( 'fadeInUp', 'gymat-core' ),					
					'bounceIn' => esc_html__( 'bounceIn', 'gymat-core' ),
					'bounceInDown' => esc_html__( 'bounceInDown', 'gymat-core' ),
					'bounceInLeft' => esc_html__( 'bounceInLeft', 'gymat-core' ),
					'bounceInRight' => esc_html__( 'bounceInRight', 'gymat-core' ),
					'bounceInUp' => esc_html__( 'bounceInUp', 'gymat-core' ),			
					'slideInDown' => esc_html__( 'slideInDown', 'gymat-core' ),
					'slideInLeft' => esc_html__( 'slideInLeft', 'gymat-core' ),
					'slideInRight' => esc_html__( 'slideInRight', 'gymat-core' ),
					'slideInUp' => esc_html__( 'slideInUp', 'gymat-core' ), 
                ),
				'default' => 'fadeInUp',
				'condition'   => array('animation' => array( 'wow' ) ),
			),
			array(
				'type'    => Controls_Manager::TEXT,
				'id'      => 'delay',
				'label'   => esc_html__( 'Delay', 'gymat-core' ),
				'default' => '0.5',
				'condition'   => array( 'animation' => array( 'wow' ) ),
			),
			array(
				'type'    => Controls_Manager::TEXT,
				'id'      => 'duration',
				'label'   => esc_html__( 'Duration', 'gymat-core' ),
				'default' => '1',
				'condition'   => array( 'animation' => array( 'wow' ) ),
			),
			array(
				'mode' => 'section_end',
			),
			
		);
		return $fields;
    }
   
    protected function render() {
        $data = $this->get_settings();
		if($data['slider_autoplay']=='yes'){
			$data['slider_autoplay']=true;
		}
		else{
			$data['slider_autoplay']=false;
		}

		$swiper_data = array(
			'slidesPerView' 	=>2,
			'spaceBetween'		=>$data['slides_space']['size'],
			'slidesPerGroup'	=>$data['slides_per_group']['size'],
			'centeredSlides'	=>$data['centered_slides']=='yes' ? true:false ,
			'slideToClickedSlide' =>false,
			'autoplay'				=>array(
				'delay'  => $data['slider_autoplay_delay'],
			),
			'speed'      =>$data['slider_autoplay_speed'],
			'breakpoints' =>array(
				'0'    =>array(
					'slidesPerView' =>1,
					'slidesPerColumn' =>$data['slidesPerColumn']['size']
				),
				'576'    =>array(
					'slidesPerView' =>$data['item_mobile']['size'],
					'slidesPerColumn' =>$data['slidesPerColumn']['size']
				),
				'768'    =>array(
					'slidesPerView' =>$data['item_tablet']['size'],
					'slidesPerColumn' =>$data['slidesPerColumn']['size']
				),
				'992'    =>array(
					'slidesPerView' =>$data['medium_item']['size'],
					'slidesPerColumn' =>$data['slidesPerColumn']['size']
				),
				'1200'    =>array(
					'slidesPerView' =>$data['laptop']['size'],
					'slidesPerColumn' =>$data['slidesPerColumn']['size']
				),				
				'1600'    =>array(
					'slidesPerView' =>$data['desktop']['size'],
					'slidesPerColumn' =>$data['slidesPerColumn']['size']
				)
			),
			'auto'   =>$data['slider_autoplay']
		);

		$data['swiper_data'] = json_encode( $swiper_data ); 
		switch ( $data['style'] ) {
			case 'style2':
				$template = 'woo-product-slider-2';
				break;
			default:
				$template = 'woo-product-slider';
				break;
		}
        return $this->rt_template( $template, $data );
    }

}

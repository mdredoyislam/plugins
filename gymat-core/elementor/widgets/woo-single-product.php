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

class Woo_Single_Product extends Custom_Widget_Base {

    public function __construct( $data = [], $args = null ){
		$this->rt_name = esc_html__( 'Singel Product', 'gymat-core' );
		$this->rt_base = 'rt-single-product';
		parent::__construct( $data, $args );
	}
    public function rt_fields(){
        $terms = get_terms( array('taxonomy' => 'product_cat' ) );
        $category_dropdown = array( '0' => __( 'All Categories', 'gymat-core' ) );
        foreach ( $terms as $category ) {
            $category_dropdown[$category->term_id] = $category->name;
        }
		$posts = get_posts( 
					[
						'post_type' => "product", 
						'posts_per_page' => -1,
						'orderby' => 'date',
						'order' => 'ASC',
						'post_status' => 'publish',
						'suppress_filters' => false
					]
				);
	    $posts_dropdown= array( '0' => __( 'Please Selecet Posts ', 'gymat-core' ) );
		
		
	    foreach ( $posts as $post ) {
	      $posts_dropdown[$post->ID] = $post->post_title;
	    }

        $fields = array(
			array(
				'mode'    => 'section_start',
				'id'      => 'sec_general',
				'label'   => esc_html__( 'Section', 'gymat-core' ),
			),
			array(
                'type'     => Controls_Manager::SELECT2,
                'id'       => 'single_post',
                'label'    => esc_html__('Select Post By Name', 'gymat-core'),
                'options'  =>$posts_dropdown,
                'default'  => '0',
                'multiple' => false,
                'label_block' => true,
            ),
            array(
                'id'            => 'item_no',
                'label'         => __( 'Total number of items', 'gymat-core' ),
                'type'          => Controls_Manager::NUMBER,
                'default'       =>8,
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
			),
			array(
				'type'        => Controls_Manager::SWITCHER,
				'id'          => 'product_box_width',
				'label'       => __( 'Product Box Full Width', 'gymat-core' ),
				'label_on'    => __( 'On', 'gymat-core' ),
				'label_off'   => __( 'Off', 'gymat-core' ),
				'return_value'=>'yes',
				'default'     => false,
			),
            array(
                'mode'  => 'section_end'
            ),
			// Content Button style
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
				'selector' => '{{WRAPPER}} .single-product-addon .product-item .product-cat a',
			),
			array(
				'mode'    => 'group',
				'type'    => Group_Control_Typography::get_type(),
				'name'    => 'title_typo',
				'label'   => esc_html__( 'Title Typo', 'gymat-core' ),
				'selector' => '{{WRAPPER}} .single-product-addon .product-item .rt-title',
			),
			array(
				'mode'    => 'group',
				'type'    => Group_Control_Typography::get_type(),
				'name'    => 'price_typo',
				'label'   => esc_html__( 'Price Typo', 'gymat-core' ),
				'selector' => '{{WRAPPER}} .single-product-addon .product-item .rt-price > ins > span',
			),
			array(
				'type'    => Controls_Manager::COLOR,
				'id'      => 'cat_color',
				'label'   => esc_html__( 'Category Color', 'gymat-core' ),
				'default' => '',
				'selectors' => array(
					'{{WRAPPER}} .single-product-addon .product-item .product-cat a' => 'color: {{VALUE}}',
				),
			),
			array(
				'type'    => Controls_Manager::COLOR,
				'id'      => 'cat__hover_cololor',
				'label'   => esc_html__( 'Category Hover Color', 'gymat-core' ),
				'default' => '',
				'selectors' => array(
					'{{WRAPPER}} .single-product-addon .product-item .product-cat a:hover' => 'color: {{VALUE}}',
				),
			),
			array(
				'type'    => Controls_Manager::COLOR,
				'id'      => 'title_color',
				'label'   => esc_html__( 'Title Color', 'gymat-core' ),
				'default' => '',
				'selectors' => array(
					'{{WRAPPER}} .single-product-addon .product-item .rt-title a' => 'color: {{VALUE}}',
				),
			),
			array(
				'type'    => Controls_Manager::COLOR,
				'id'      => 'title_hover_color',
				'label'   => esc_html__( 'Title Hover Color', 'gymat-core' ),
				'default' => '',
				'selectors' => array(
					'{{WRAPPER}} .single-product-addon .product-item .rt-title a:hover' => 'color: {{VALUE}}',
				),
			),
			array(
				'type'    => Controls_Manager::COLOR,
				'id'      => 'price_color',
				'label'   => esc_html__( 'Price Color', 'gymat-core' ),
				'default' => '',
				'selectors' => array(
					'{{WRAPPER}} .single-product-addon .product-item .rt-price > ins > span' => 'color: {{VALUE}}',
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


		$template = 'woo-single-product';

        return $this->rt_template( $template, $data );
    }

}

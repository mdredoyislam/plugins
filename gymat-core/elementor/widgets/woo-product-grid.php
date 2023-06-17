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

class Woo_Product_Grid extends Custom_Widget_Base {

    public function __construct( $data = [], $args = null ){
		$this->rt_name = esc_html__( 'Product Grid', 'gymat-core' );
		$this->rt_base = 'rt-product-grid';
		$this->rt_translate = array(
			'cols'  => array(
				'12' => esc_html__( '1 Col', 'gymat-core' ),
				'6'  => esc_html__( '2 Col', 'gymat-core' ),
				'4'  => esc_html__( '3 Col', 'gymat-core' ),
				'3'  => esc_html__( '4 Col', 'gymat-core' ),
				'2'  => esc_html__( '6 Col', 'gymat-core' ),
			),
		);
		parent::__construct( $data, $args );
	}
    public function rt_fields(){
        $terms = get_terms( array('taxonomy' => 'product_cat' ) );
        $category_dropdown = array( '0' => __( 'All Categories', 'gymat-core' ) );
        foreach ( $terms as $category ) {
            $category_dropdown[$category->term_id] = $category->name;
        } 
        $fields = array(
			array(
				'mode'    => 'section_start',
				'id'      => 'sec_general',
				'label'   => esc_html__( 'Section Title', 'gymat-core' ),
			),
            array(
                'id'        => 'cat',
                'label'     => __( 'Categories', 'gymat-core' ),
                'type'      => Controls_Manager::SELECT,
                'options'   => $category_dropdown,
                'default'   => '0',
            ),
            array(
                'id'            => 'item_no',
                'label'         => __( 'Total number of items', 'gymat-core' ),
                'type'          => Controls_Manager::NUMBER,
                'default'       => 5,
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
				'id'          => 'quick_view_display',
				'label'       => __( 'Quick View Display', 'gymat-core' ),
				'label_on'    => __( 'On', 'gymat-core' ),
				'label_off'   => __( 'Off', 'gymat-core' ),
				'default'     => 'yes',
			),
            array(
				'type'        => Controls_Manager::SWITCHER,
				'id'          => 'wishlist_display',
				'label'       => __( 'Wishlist Display', 'gymat-core' ),
				'label_on'    => __( 'On', 'gymat-core' ),
				'label_off'   => __( 'Off', 'gymat-core' ),
				'default'     => 'yes',
			),
            array(
				'type'        => Controls_Manager::SWITCHER,
				'id'          => 'more_btn_display',
				'label'       => __( 'More Button', 'gymat-core' ),
				'label_on'    => __( 'On', 'gymat-core' ),
				'label_off'   => __( 'Off', 'gymat-core' ),
				'default'     => 'no',
			),
            array(
				'type'        => Controls_Manager::TEXT,
				'id'          => 'more_btn_text',
				'label'       => __( 'More Button Text', 'gymat-core' ),
                'label_block' =>true,
				'label_on'    => __( 'On', 'gymat-core' ),
				'label_off'   => __( 'Off', 'gymat-core' ),
				'default'     => __('See More','gymat-core'),
                'condition'   =>array('more_btn_display'=>'yes')
			),
            array(
                'mode'  => 'section_end'
            ),
			// Responsive Columns
			array(
				'mode'    => 'section_start',
				'id'      => 'sec_responsive',
				'label'   => esc_html__( 'Number of Responsive Columns', 'gymat-core' ),
			),
			array(
				'type'    => Controls_Manager::SELECT2,
				'id'      => 'col_lg',
				'label'   => esc_html__( 'Desktops: > 1199px', 'gymat-core' ),
				'options' => $this->rt_translate['cols'],
				'default' => '4',
				
			),
			array(
				'type'    => Controls_Manager::SELECT2,
				'id'      => 'col_md',
				'label'   => esc_html__( 'Desktops: > 767px', 'gymat-core' ),
				'options' => $this->rt_translate['cols'],
				'default' => '6',
			),
			array(
				'type'    => Controls_Manager::SELECT2,
				'id'      => 'col_sm',
				'label'   => esc_html__( 'Tablets: < 767px', 'gymat-core' ),
				'options' => $this->rt_translate['cols'],
				'default' => '6',
			),
			array(
				'type'    => Controls_Manager::SELECT2,
				'id'      => 'col_xs',
				'label'   => esc_html__( 'Phones: < 575px', 'gymat-core' ),
				'options' => $this->rt_translate['cols'],
				'default' => '12',
			),
			array(
				'type'    => Controls_Manager::SELECT2,
				'id'      => 'col_mobile',
				'label'   => esc_html__( 'Small Phones: < 480px', 'gymat-core' ),
				'options' => $this->rt_translate['cols'],
				'default' => '12',
			),
			array(
				'mode' => 'section_end',
			),
			
		);
		return $fields;
    }
   
    protected function render() {
        $data = $this->get_settings();
        $template = 'woo-product-grid';
        return $this->rt_template( $template, $data );
    }

}

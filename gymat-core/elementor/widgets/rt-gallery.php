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

class RT_Gallery extends Custom_Widget_Base {

    public function __construct( $data = [], $args = null ){
        $this->rt_name = esc_html__( 'DV Gallery', 'gymat-core' );
        $this->rt_base = 'rt-gallery';
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
        $terms  = get_terms( array( 'taxonomy' => 'gymat_gallery_category', 'fields' => 'id=>name' ) );

        $category_dropdown = array( '0' => __( 'Please Selecet category', 'gymat-core' ) );

        foreach ( $terms as $id => $name ) {
            $category_dropdown[$id] = $name;
        }

        $posts = get_posts( ['post_type' => "gymat_gallery", 'posts_per_page' => -1, 'orderby' => 'title','order' => 'ASC','post_status' => 'publish','suppress_filters' => false]);
        $posts_dropdown= array( '0' => __( 'Please Selecet Posts ', 'consalty-core' ) );


        foreach ( $posts as $post ) {
            $posts_dropdown[$post->ID] = $post->post_title;
        }

        $fields = array(
            array(
                'mode'    => 'section_start',
                'id'      => 'sec_general',
                'label'   => esc_html__( 'General', 'gymat-core' ),
            ),
            array(
                'type'    => Controls_Manager::NUMBER,
                'id'      => 'number',
                'label'   => esc_html__( 'Total number of items', 'gymat-core' ),
                'default' => 6,
                'description' => esc_html__( 'Write -1 to show all', 'gymat-core' ),
            ),
            array(
                'type'    => Controls_Manager::SELECT2,
                'id'      => 'cat',
                'label'   => esc_html__( 'Categories', 'gymat-core' ),
                'options' => $category_dropdown,
                'default' => '0',
            ),
            array(
                'type'    => Controls_Manager::SELECT2,
                'id'      => 'orderby',
                'label'   => esc_html__( 'Order By', 'gymat-core' ),
                'options' => array(
                    'date'        => esc_html__( 'Date (Recents comes first)', 'gymat-core' ),
                    'title'       => esc_html__( 'Title', 'gymat-core' ),
                    'menu_order'  => esc_html__( 'Custom Order (Available via Order field inside Page Attributes box)', 'gymat-core' ),
                ),
                'default' => 'date',
            ),
            array(
                'type'    => Controls_Manager::NUMBER,
                'id'      => 'title_count',
                'label'   => esc_html__( 'Title Word count', 'gymat-core' ),
                'default' => 5,
                'description' => esc_html__( 'Maximum number of words', 'gymat-core' ),
            ),
            array (
                'type'        => Controls_Manager::SWITCHER,
                'id'          => 'cat_display',
                'label'       => esc_html__( 'Category Name Display', 'gymat-core' ),
                'label_on'    => esc_html__( 'Show', 'gymat-core' ),
                'label_off'   => esc_html__( 'Hide', 'gymat-core' ),
                'default'     => 'yes',
            ),
            array (
                'type'        => Controls_Manager::SWITCHER,
                'id'          => 'excerpt_display',
                'label'       => esc_html__( 'Excerpt/Content Display', 'gymat-core' ),
                'label_on'    => esc_html__( 'Show', 'gymat-core' ),
                'label_off'   => esc_html__( 'Hide', 'gymat-core' ),
                'default'     => 'no',
            ),
            array(
                'type'    => Controls_Manager::NUMBER,
                'id'      => 'excerpt_count',
                'label'   => esc_html__( 'Word count', 'gymat-core' ),
                'default' => 15,
                'description' => esc_html__( 'Maximum number of words', 'gymat-core' ),
                'condition'   => array( 'excerpt_display' =>'yes' ),
            ),
            array (
                'type'        => Controls_Manager::SWITCHER,
                'id'          => 'view_project_link_btn',
                'label'       => esc_html__( 'Show Link Button', 'gymat-core' ),
                'label_on'    => esc_html__( 'Show', 'gymat-core' ),
                'label_off'   => esc_html__( 'Hide', 'gymat-core' ),
                'default'     => 'yes',
            ),
            array (
                'mode'    => 'group',
                'type'    => Group_Control_Typography::get_type(),
                'name'    => 'title_typo',
                'label'   => esc_html__( 'Item Title Typo', 'gymat-core' ),
                'selector' => '{{WRAPPER}} .gallery-default  .gallery-item .gallery-title',
            ),
            array(
                'type'        => Controls_Manager::SWITCHER,
                'id'          => 'more_button_display',
                'label'       => esc_html__( 'More Button Display', 'gymat-core' ),
                'label_on'    => esc_html__( 'On', 'gymat-core' ),
                'label_off'   => esc_html__( 'Off', 'gymat-core' ),
                'default'     => 'no',
                'description' => esc_html__( 'Show or Hide More Button . Default: On', 'gymat-core' ),
            ),
            array(
                'type'    => Controls_Manager::SELECT2,
                'id'      => 'more_button',
                'label'   => esc_html__( 'More Button', 'gymat-core' ),
                'options' => array(
                    'show'        => esc_html__( 'Show Read More', 'gymat-core' ),
                    'hide'        => esc_html__( 'Show Pagination', 'gymat-core' ),
                ),
                'default' => 'show',
                'condition'   => array('more_button_display'=>'yes' ),
            ),
            array (
                'type'    => Controls_Manager::TEXT,
                'id'      => 'see_button_text',
                'label'   => esc_html__( 'Button Text', 'gymat-core' ),
                'condition'   => array( 'more_button' => array( 'show' ) ),
                'default' => esc_html__( 'MORE GALLERIES', 'gymat-core' ),
                'condition'   => array( 'more_button' => array( 'show' ), 'more_button_display'=>'yes' ),
            ),
            array (
                'type'    => Controls_Manager::TEXT,
                'id'      => 'see_button_link',
                'label'   => esc_html__( 'Button Link', 'gymat-core' ),
                'condition'   => array( 'more_button' => array( 'show' ),'more_button_display'=>'yes'  ),
            ),
            array(
                'mode' => 'section_end',
            ),

            // Style
            array(
                'mode'    => 'section_start',
                'id'      => 'layout_4_style',
                'label'   => esc_html__( 'Style', 'gymat-core' ),
                'tab'     => Controls_Manager::TAB_STYLE,

            ),
            array (
                'type'    => Controls_Manager::COLOR,
                'id'      => 'item_title_color',
                'label'   => esc_html__( 'Item Title Color', 'gymat-core' ),
                'default' => '',
                'selectors' => array(
                    '{{WRAPPER}} .gallery-multi-layout-1 .gallery-content .gallery-title' => 'color: {{VALUE}}',
                ),
            ),
            array (
                'type'    => Controls_Manager::COLOR,
                'id'      => 'item_cat_color',
                'label'   => esc_html__( 'Item Category Color', 'gymat-core' ),
                'default' => '',
                'selectors' => array(
                    '{{WRAPPER}} .gallery-multi-layout-1 .gallery-content .gallery-cat a' => 'color: {{VALUE}}',
                ),
            ),
            array (
                'type'    => Controls_Manager::COLOR,
                'id'      => 'item_content_color',
                'label'   => esc_html__( 'Item Content Color', 'gymat-core' ),
                'default' => '',
                'selectors' => array(
                    '{{WRAPPER}} .gallery-multi-layout-1 .gallery-content p' => 'color: {{VALUE}}',
                ),
            ),


            array(
                'mode' => 'section_end',
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

        $template = 'rt-gallery';

        return $this->rt_template( $template, $data );
    }
}
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

class RT_Single_Gallery extends Custom_Widget_Base {

	public function __construct( $data = [], $args = null ){
		$this->rt_name = esc_html__( 'DV Single Gallery Post', 'gymat-core' );
		$this->rt_base = 'gallery';
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
                'type'     => Controls_Manager::SELECT2,
                'id'       => 'single_post',
                'label'    => esc_html__('Select Post By Name', 'consalty-core'),
                'options'  =>$posts_dropdown,
                'default'  => '0',
                'multiple' => false,
                'label_block' => true,
            ),
			array(
				'type' 				=> Controls_Manager::SLIDER,
				'mode' 				=> 'responsive',
				'id'      		=> 'box_height',
				'label'   		=> esc_html__( 'Height', 'consalty-core' ),
				'size_units' => array( 'px' ),
				 'range' => [
				 'px' => [
				   'min' => 0,
				   'max' => 900,
				 ],
			   ],
				'default' => array(
				'unit' => 'px',
				'size' => '',
				),
				'selectors' => array(
					'{{WRAPPER}} .gallery-default .gallery-item .gallery-figure' => 'height: {{SIZE}}{{UNIT}};',	
					'{{WRAPPER}} .gallery-default .gallery-item .gallery-figure img' => 'height: inherit;object-fit:cover;',						
				),
				
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
			
		);
		return $fields;
	}

	protected function render() {
		$data = $this->get_settings();
		
		$template = 'gallery-1';
		
		return $this->rt_template( $template, $data );
	}
}
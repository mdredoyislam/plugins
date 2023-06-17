<?php
/**
 * @author  desvertTheme
 * @since   1.0
 * @version 1.0
 */
namespace desvertTheme\Gymat_Core;
use Elementor\Controls_Manager;

if ( ! defined( 'ABSPATH' ) ) exit;

class Post_Grid extends Custom_Widget_Base {

	public function __construct( $data = [], $args = null ){
		$this->rt_name = esc_html__( 'DV Post Grid', 'gymat-core' );
		$this->rt_base = 'rt-post-grid';
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
		$categories = get_categories();
		$category_dropdown = array( '0' => esc_html__( 'All Categories', 'gymat-core' ) );

		foreach ( $categories as $category ) {
			$category_dropdown[$category->term_id] = $category->name;
		}
		$fields = array(
			array(
				'mode'    => 'section_start',
				'id'      => 'sec_general',
				'label'   => esc_html__( 'General', 'gymat-core' ),
			),
			array(
				'type'    => Controls_Manager::SELECT2,
				'id'      => 'layout',
				'label'   => esc_html__( 'Layout', 'gymat-core' ),
				'options' => array(
					'layout1' => esc_html__( 'Post Grid Style 1', 'gymat-core' ),
					'layout2' => esc_html__( 'Post Grid Style 2', 'gymat-core' ),
					'layout3' => esc_html__( 'Post Grid Style 3', 'gymat-core' ),
				),
				'default' => 'layout1',
			),
			/*Post Order*/
			array(
				'type'    => Controls_Manager::SELECT2,
				'id'      => 'post_ordering',
				'label'   => esc_html__( 'Post Ordering', 'gymat-core' ),
				'options' => array(
					'DESC'	=> esc_html__( 'Desecending', 'gymat-core' ),
					'ASC'	=> esc_html__( 'Ascending', 'gymat-core' ),
				),
				'default' => 'DESC',
			),
			array(
				'type'    => Controls_Manager::SELECT2,
				'id'      => 'post_orderby',
				'label'   => esc_html__( 'Post Sorting', 'gymat-core' ),				
				'options' => array(
					'recent' 		=> esc_html__( 'Recent Post', 'gymat-core' ),
					'rand' 			=> esc_html__( 'Random Post', 'gymat-core' ),
					'menu_order' 	=> esc_html__( 'Custom Order', 'gymat-core' ),
					'title' 		=> esc_html__( 'By Name', 'gymat-core' ),
				),
				'default' => 'recent',
			),
			array(
				'type'    => Controls_Manager::SELECT2,
				'id'      => 'cat',
				'label'   => esc_html__( 'Categories', 'gymat-core' ),
				'options' => $category_dropdown,
				'default' => '0',
			),
			array(
				'type'    => Controls_Manager::NUMBER,
				'id'      => 'count',
				'label'   => esc_html__( 'Word count', 'gymat-core' ),
				'default' => 10,
				'description' => esc_html__( 'Maximum number of words', 'gymat-core' ),
			),
			array(
				'type'    => Controls_Manager::NUMBER,
				'id'      => 'itemlimit',
				'label'   => esc_html__( 'Item Limit', 'gymat-core' ),
				'default' => 4,
				'description' => esc_html__( 'Maximum number of words', 'gymat-core' ),
			),
			array(
				'type'    => Controls_Manager::NUMBER,
				'id'      => 'title_count',
				'label'   => esc_html__( 'Title count', 'gymat-core' ),
				'default' => 10,
				'description' => esc_html__( 'Maximum number of words', 'gymat-core' ),
			),
			array (
				'type'        => Controls_Manager::SWITCHER,
				'id'          => 'content_display',
				'label'       => esc_html__( 'Content Display', 'gymat-core' ),
				'label_on'    => esc_html__( 'Show', 'gymat-core' ),
				'label_off'   => esc_html__( 'Hide', 'gymat-core' ),
				'default'     => 'no',
			),
			array (
				'type'        => Controls_Manager::SWITCHER,
				'id'          => 'read_display',
				'label'       => esc_html__( 'Read More Display', 'finbuzz-core' ),
				'label_on'    => esc_html__( 'Show', 'finbuzz-core' ),
				'label_off'   => esc_html__( 'Hide', 'finbuzz-core' ),
				'default'     => 'no',
			),
			array(
				'type'    => Controls_Manager::TEXT,
				'id'      => 'buttontext',
				'label'   => esc_html__( 'Button Text', 'finbuzz-core' ),
				'default' => esc_html__( 'READ MORE', 'finbuzz-core' ),
			),
			array(
				'mode' => 'section_end',
			),
			// Option
			array(
				'mode'    => 'section_start',
				'id'      => 'sec_style',
				'label'   => esc_html__( 'Option', 'gymat-core' ),
				'tab'     => Controls_Manager::TAB_STYLE,
				'condition' =>array('style'=>array('style1','style2'))
			),
			array (
				'type'        => Controls_Manager::SWITCHER,
				'id'          => 'post_grid_author',
				'label'       => esc_html__( 'Show Author Name', 'gymat-core' ),
				'label_on'    => esc_html__( 'Show', 'gymat-core' ),
				'label_off'   => esc_html__( 'Hide', 'gymat-core' ),
				'default'     => 'yes',
			),
			array (
				'type'        => Controls_Manager::SWITCHER,
				'id'          => 'post_grid_date',
				'label'       => esc_html__( 'Show Date', 'gymat-core' ),
				'label_on'    => esc_html__( 'Show', 'gymat-core' ),
				'label_off'   => esc_html__( 'Hide', 'gymat-core' ),
				'default'     => 'yes',
			),
			array (
				'type'        => Controls_Manager::SWITCHER,
				'id'          => 'post_grid_category',
				'label'       => esc_html__( 'Show Categories', 'gymat-core' ),
				'label_on'    => esc_html__( 'Show', 'gymat-core' ),
				'label_off'   => esc_html__( 'Hide', 'gymat-core' ),
				'default'     => 'yes',
			),
			array (
				'type'        => Controls_Manager::SWITCHER,
				'id'          => 'post_grid_comment',
				'label'       => esc_html__( 'Show Comment Number', 'gymat-core' ),
				'label_on'    => esc_html__( 'Show', 'gymat-core' ),
				'label_off'   => esc_html__( 'Hide', 'gymat-core' ),
				'default'     => 'no',
			),
			array (
				'type'        => Controls_Manager::SWITCHER,
				'id'          => 'post_grid_view',
				'label'       => esc_html__( 'Show Views', 'gymat-core' ),
				'label_on'    => esc_html__( 'Show', 'gymat-core' ),
				'label_off'   => esc_html__( 'Hide', 'gymat-core' ),
				'default'     => 'no',
			),
			array (
				'type'        => Controls_Manager::SWITCHER,
				'id'          => 'post_grid_read',
				'label'       => esc_html__( 'Show Reading Length', 'gymat-core' ),
				'label_on'    => esc_html__( 'Show', 'gymat-core' ),
				'label_off'   => esc_html__( 'Hide', 'gymat-core' ),
				'default'     => 'no',
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
				'default' => '0.3',
				'condition'   => array( 'animation' => array( 'wow' ) ),
			),
			array(
				'type'    => Controls_Manager::TEXT,
				'id'      => 'duration',
				'label'   => esc_html__( 'Duration', 'gymat-core' ),
				'default' => '0.8',
				'condition'   => array( 'animation' => array( 'wow' ) ),
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
				'id'      => 'col_xl',
				'label'   => esc_html__( 'Desktops: > 1199px', 'gymat-core' ),
				'options' => $this->rt_translate['cols'],
				'default' => '6',
			),
			array(
				'type'    => Controls_Manager::SELECT2,
				'id'      => 'col_lg',
				'label'   => esc_html__( 'Desktops: > 991px', 'gymat-core' ),
				'options' => $this->rt_translate['cols'],
				'default' => '6',
			),
			array(
				'type'    => Controls_Manager::SELECT2,
				'id'      => 'col_md',
				'label'   => esc_html__( 'Tablets: > 767px', 'gymat-core' ),
				'options' => $this->rt_translate['cols'],
				'default' => '6',
			),
			array(
				'type'    => Controls_Manager::SELECT2,
				'id'      => 'col_sm',
				'label'   => esc_html__( 'Phones: > 576px', 'gymat-core' ),
				'options' => $this->rt_translate['cols'],
				'default' => '12',
			),
			array(
				'type'    => Controls_Manager::SELECT2,
				'id'      => 'col',
				'label'   => esc_html__( 'Phones: < 576px', 'gymat-core' ),
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
		switch ( $data['layout'] ) {
			case 'layout3':
			$template = 'post-grid-3';
			break;
			case 'layout2':
			$template = 'post-grid-2';
			break;
			default:
			$template = 'post-grid-1';
			break;
		}
		return $this->rt_template( $template, $data );
	}
}
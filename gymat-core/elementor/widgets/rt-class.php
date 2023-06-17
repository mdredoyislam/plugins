<?php
/**
 * @author  desvertTheme
 * @since   1.0
 * @version 1.0
 */

namespace desvertTheme\Gymat_Core;

use GymatTheme;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Utils;


if ( ! defined('ABSPATH' ) ) exit;

class RT_Class extends Custom_Widget_Base {

    public function __construct( $data = [], $args = null ) {
        $this->rt_name  = __( 'DV Class', 'gymat-core' );
        $this->rt_base  = 'rt-class';
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

	public function sort_by_time( $a, $b ) {
		return $a['timestamp'] - $b['timestamp'];
	}
	/**Next 2 Day's Class get method */
	public function get_schedule( $number ) {
		$weeknames = array(
			'mon' => __( 'Monday', 'gymat-core' ),
			'tue' => __( 'Tuesday', 'gymat-core' ),
			'wed' => __( 'Wednesday', 'gymat-core' ),
			'thu' => __( 'Thursday', 'gymat-core' ),
			'fri' => __( 'Friday', 'gymat-core' ),
			'sat' => __( 'Saturday', 'gymat-core' ),
			'sun' => __( 'Sunday', 'gymat-core' ),
		);

		$args = array(
			'posts_per_page'   => -1,
			'post_type'        => 'gymat_class',
			'suppress_filters' => false
		);
		$classes = get_posts( $args );
		$schedule = array();
		foreach ( $classes as $class ) {
			$gymat_class_icon   = get_post_meta( $class->ID, 'gymat_class_icon', true );
            $gymat_class_img   	= get_post_meta( $class->ID, 'gymat_class_img', true );
			$metas              = get_post_meta( $class->ID, 'gymat_class_schedule', true );
			$metas              = ( $metas != '' ) ? $metas : array();
			foreach ( $metas as $meta ) {
				if ( empty( $meta['week'] ) || empty( $meta['start_time'] ) ) {
					continue;
				}
				$timestamp = $meta['week'] . ' ' . $meta['start_time'];
				$timestamp = strtotime($timestamp);
				$meta_week_timestamp=strtotime($meta['week']);
				$current_week = date('D');
				$current_week_timestamp = strtotime($current_week);
				if($meta_week_timestamp==$current_week_timestamp){
					continue;
				}
				$start_time = strtotime( $meta['start_time'] );
				$end_time   = !empty( $meta['end_time'] ) ? strtotime( $meta['end_time'] ) : false;

				if ( GymatTheme::$options['class_time_format'] == '24' ) {
					$start_time = date( "H:i", $start_time );
					$end_time   = $end_time ? date( "H:i", $end_time ) : '';
				}
				else {
					$start_time = date( "g:i a", $start_time );
					$end_time   = $end_time ? date( "g:i a", $end_time ) : '';
				}
				$today=date("D");
				$next_2_days_timestamp = strtotime("+3 day",strtotime($today));
				if($timestamp <= $next_2_days_timestamp){
					$schedule[] = array(
						'class'         => $class->post_title,
						'thumbnail'     =>get_the_post_thumbnail_url( $class->ID,'full'),
						'content'       =>get_the_excerpt($class->ID),
						'gymat_icon'    =>$gymat_class_icon,
						'gymat_img'     =>$gymat_class_img,
						'week'          => $meta['week'],
						'weekname'      => $weeknames[$meta['week']],
						'start_time'    => $start_time,
						'timestamp'     => $timestamp,
					);
				}     
			}
		}
		usort( $schedule, array( $this, 'sort_by_time' ));
		return array_slice( $schedule, 0, $number );
	}

	/**Next 2 Day's Class get method end*/

	/**Today's Class get method */
	public function get_todays_schedule( $number ) {
		$weeknames = array(
			'mon' => __( 'Monday', 'gymat-core' ),
			'tue' => __( 'Tuesday', 'gymat-core' ),
			'wed' => __( 'Wednesday', 'gymat-core' ),
			'thu' => __( 'Thursday', 'gymat-core' ),
			'fri' => __( 'Friday', 'gymat-core' ),
			'sat' => __( 'Saturday', 'gymat-core' ),
			'sun' => __( 'Sunday', 'gymat-core' ),
		);

		$args = array(
			'posts_per_page'   => -1,
			'post_type'        => 'gymat_class',
			'suppress_filters' => false
		);
		$classes = get_posts( $args );
		$schedule = array();
		foreach ( $classes as $class ) {
			$gymat_class_icon   = get_post_meta( $class->ID, 'gymat_class_icon', true );
            $gymat_class_img   	= get_post_meta( $class->ID, 'gymat_class_img', true );
			$metas              = get_post_meta( $class->ID, 'gymat_class_schedule', true );
			$metas              = ( $metas != '' ) ? $metas : array();
			foreach ( $metas as $meta ) {
				if ( empty( $meta['week'] ) || empty( $meta['start_time'] ) ) {
					continue;
				}
				$timestamp = $meta['week'] . ' ' . $meta['start_time'];
				$timestamp = strtotime($timestamp);
				$start_time = strtotime( $meta['start_time'] );
				$end_time   = !empty( $meta['end_time'] ) ? strtotime( $meta['end_time'] ) : false;
				if ( GymatTheme::$options['class_time_format'] == '24' ) {
					$start_time = date( "H:i", $start_time );
					$end_time   = $end_time ? date( "H:i", $end_time ) : '';
				}
				else {
					$start_time = date( "g:i a", $start_time );
					$end_time   = $end_time ? date( "g:i a", $end_time ) : '';
				}
				$today=strtolower(date('D'));
				if($meta['week']==$today){
					$schedule[] = array(
						'class'         => $class->post_title,
						'thumbnail'     =>get_the_post_thumbnail_url( $class->ID,'full'),
						'content'       =>get_the_excerpt($class->ID),
						'gymat_icon'    =>$gymat_class_icon,
						'gymat_img'     =>$gymat_class_img,
						'week'          => $meta['week'],
						'weekname'      => $weeknames[$meta['week']],
						'start_time'    => $start_time,
						'timestamp'     => $timestamp,
					);
				}     
			}
		}
		usort( $schedule, array( $this, 'sort_by_time' ));
		return array_slice( $schedule, 0, $number );
	}
	/**Today's Class get method end*/
    public function rt_fields() {
        $terms = get_terms( array('taxonomy' => 'gymat_class_category' ) );
        $category_dropdown = array( '0' => __( 'All Categories', 'gymat-core' ) );
        foreach ( $terms as $category ) {
            $category_dropdown[$category->term_id] = $category->name;
        }

        $orderby = array(
            'date'          => __( 'Date (Recents comes first)', 'gymat-core' ),
            'title'         =>  __( 'Title', 'gymat-core' ),
            'menu_order'    => __( 'Custom Order (Available via Order field inside Post Attributes box)', 'gymat-core' ),
        );

        $sortby = array(
            'ASC'       => __( 'Ascending', 'gymat-core' ),
            'DESC'      =>  __( 'Descending', 'gymat-core' ),
        );

        $fields = array(
            array(
                'mode'  => 'section_start',
                'id'    => 'section_general',
                'label' => __( 'General', 'gymat-core' )
            ),
            array(
				'type'    => Controls_Manager::SELECT2,
				'id'      => 'style',
				'label'   => esc_html__( 'Class Layout', 'gymat-core' ),
				'options' => array(
					'style1' => esc_html__( 'All Classes Layout 1', 'gymat-core' ),
					'style4' => esc_html__( 'All Classes Layout 2', 'gymat-core' ),
					'style5' => esc_html__( 'All Classes Layout 3', 'gymat-core' ),
					'style2' => esc_html__( 'Today\'s Class', 'gymat-core' ),
					'style3' => esc_html__( 'Next 2 Day\'s Class', 'gymat-core' ),
				),
				'default' => 'style1',
			),
            array(
				'type'    => Controls_Manager::NUMBER,
				'id'      => 'number',
				'label'   => esc_html__( 'Total number of items', 'gymat-core' ),
				'default' => 6,
				'description' => esc_html__( 'Write -1 to show all', 'gymat-core' ),
			),
			array(
				'type'    => Controls_Manager::NUMBER,
				'id'      => 'schedule_number',
				'label'   => esc_html__( 'Number of schedule to show', 'gymat-core' ),
				'default' => '',
				'description' => esc_html__( 'Write 1 to show only 1 day schedule', 'gymat-core' ),
				'condition' =>array('style'=>array('style1','style5'))
			),
            array(
                'id'        => 'cat',
                'label'     => __( 'Categories', 'gymedge-core' ),
                'type'      => Controls_Manager::SELECT,
                'options'   => $category_dropdown,
                'default'   => '0',
				'condition' =>array('style'=>array('style1','style4','style5'))
            ),
            array(
                'id'        => 'orderby',
                'label'     => __( 'Order by', 'gymedge-core' ),
                'type'      => Controls_Manager::SELECT,
                'options'   => $orderby,
                'default'   => 'date',
				'condition' =>array('style'=>array('style1','style4','style5'))
            ),
            array(
                'id'        => 'sortby',
                'label'     => __( 'Sort by', 'gymedge-core' ),
                'type'      => Controls_Manager::SELECT,
                'options'   => $sortby,
                'default'   => 'DESC',
				'condition' =>array('style'=>array('style1','style4','style5'))
            ),
            array(
				'type'    => Controls_Manager::SLIDER,
				'id'      => 'content_limit',
				'label'   => esc_html__( 'Excpert Limit', 'gymat-core' ),
				'default' => [
					'size' => 10,
				],
				'range' => [
					'px' => [
						'max' => 20,
						'min' => 5,
					],
				],
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
				'type'        => Controls_Manager::SWITCHER,
				'id'          => 'join_now_button',
				'label'       => esc_html__( 'Join Now Button', 'gymat-core' ),
				'label_on'    => esc_html__( 'On', 'gymat-core' ),
				'label_off'   => esc_html__( 'Off', 'gymat-core' ),
				'default'     => 'yes',
				'description' => esc_html__( 'Show or Hide More Button . Default: On', 'gymat-core' ),
				'condition'   =>array('style'=>array('style5'))
			),
            array(
				'type'        => Controls_Manager::SWITCHER,
				'id'          => 'more_button_display',
				'label'       => esc_html__( 'More Button Display', 'gymat-core' ),
				'label_on'    => esc_html__( 'On', 'gymat-core' ),
				'label_off'   => esc_html__( 'Off', 'gymat-core' ),
				'default'     => 'no',
				'description' => esc_html__( 'Show or Hide More Button . Default: On', 'gymat-core' ),
				'condition' =>array('style'=>array('style1','style4','style5'))
			),
			array(
				'type'    => Controls_Manager::SELECT2,
				'id'      => 'more_button',
				'label'   => esc_html__( 'More Button', 'gymat-core' ),
				'options' => array(
					'show'        => esc_html__( 'Show Read More', 'gymat-core' ),
					'hide'        => esc_html__( 'Show Pagination', 'gymat-core' ),
				),
				'condition' =>array('style'=>array('style1','style4','style5'),'more_button_display'=>'yes'),
				'default' => 'show',
				
			),
			array (
				'type'    => Controls_Manager::TEXT,
				'id'      => 'see_button_text',
				'label'   => esc_html__( 'Button Text', 'gymat-core' ),
				'default' => esc_html__( 'MORE CLASS', 'gymat-core' ),
				'condition'   => array( 'more_button' => array( 'show' ),'more_button_display'=>'yes','style'=>array('style1','style4','style5') ),
			),
			array (
				'type'    => Controls_Manager::TEXT,
				'id'      => 'see_button_link',
				'label'   => esc_html__( 'Button Link', 'gymat-core' ),
				'condition'   => array( 'more_button' => array( 'show' ),'more_button_display'=>'yes' ,'style'=>array('style1','style4','style5') ),
			),
			array(
				'type'        => Controls_Manager::SWITCHER,
				'id'          => 'new_more_button_display',
				'label'       => esc_html__( 'More Button Display', 'gymat-core' ),
				'label_on'    => esc_html__( 'On', 'gymat-core' ),
				'label_off'   => esc_html__( 'Off', 'gymat-core' ),
				'default'     => 'no',
				'description' => esc_html__( 'Show or Hide More Button . Default: Off', 'gymat-core' ),
				'condition' =>array('style'=>array('style2','style3'))
			),
			array (
				'type'    => Controls_Manager::TEXT,
				'id'      => 'new_see_button_text',
				'label'   => esc_html__( 'Button Text', 'gymat-core' ),
				'default' => esc_html__( 'MORE CLASS', 'gymat-core' ),
				'condition'   => array( 'new_more_button_display' => array( 'yes' ),'style'=>array('style2','style3') ),
			),
			array (
				'type'    => Controls_Manager::TEXT,
				'id'      => 'new_see_button_link',
				'label'   => esc_html__( 'Button Link', 'gymat-core' ),
				'condition'   => array( 'new_more_button_display' => array( 'yes' ),'style'=>array('style2','style3') ),
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
					'{{WRAPPER}} .class-default .class-title a' => 'color: {{VALUE}}',
				),
			),
            array (
				'type'    => Controls_Manager::COLOR,
				'id'      => 'class_title_hover_color',
				'label'   => esc_html__( 'Title Hover Color', 'gymat-core' ),
				'default' => '',
				'selectors' => array( 
					'{{WRAPPER}} .class-default .class-title a:hover' => 'color: {{VALUE}}',
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
					'{{WRAPPER}} .class-grid-style5 .class-item .schedule-time p' => 'color: {{VALUE}}',
				),
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
				'condition' =>array('style'=>array('style1','style2','style3','style4'))
			),
			array (
				'type'    => Controls_Manager::COLOR,
				'id'      => 'class_icon_bg_color',
				'label'   => esc_html__( 'Icon Background', 'gymat-core' ),
				'default' => '',
				'selectors' => array( 
					'{{WRAPPER}} .class-grid-layout2 .class-item .class-media' => 'background-color: {{VALUE}}',
				),
				'condition' =>array('style'=>array('style4'))
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
				'default' => '0.2',
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

        );

        return $fields;

    }

    protected function render() {
        $data = $this->get_settings();
        switch ( $data['style'] ) {
			case 'style5':
			$template = 'rt-class-5';
			break;
			case 'style4':
			$template = 'rt-class-4';
			break;
			case 'style3':
			$template = 'rt-class-3';
			break;
			case 'style2':
			$template = 'rt-class-2';
			break;
			default:
			$template = 'rt-class';
			break;
		}
        return $this->rt_template( $template, $data );
    }

}

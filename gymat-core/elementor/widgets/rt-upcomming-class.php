<?php
/**
 * @author  desvertTheme
 * @since   1.0
 * @version 1.0
 */

namespace desvertTheme\Gymat_Core;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Utils;
use GymatTheme;

if ( ! defined('ABSPATH' ) ) exit;

class RT_Upcomming_Class extends Custom_Widget_Base {

    public function __construct( $data = [], $args = null ) {
        $this->rt_name  = __( 'Upcomming Class', 'gymat-core' );
        $this->rt_base  = 'rt-upcomming-class';
        parent::__construct( $data, $args );
    }

    private function rt_load_scripts(){
		wp_enqueue_style(  'swiper-slider' );
		wp_enqueue_script('swiper-slider');
	}

    public function sort_by_time( $a, $b ) {
        return $a['timestamp'] - $b['timestamp'];
    }

    public function get_schedule( $number ) {
        $weeknames = array(
            'mon' => __( 'Mon', 'gymat-core' ),
            'tue' => __( 'Tue', 'gymat-core' ),
            'wed' => __( 'Wed', 'gymat-core' ),
            'thu' => __( 'Thur', 'gymat-core' ),
            'fri' => __( 'Fri', 'gymat-core' ),
            'sat' => __( 'Sat', 'gymat-core' ),
            'sun' => __( 'Sun', 'gymat-core' ),
        );

        $args = array(
            'posts_per_page'   => -1,
            'post_type'        => 'gymat_class',
            'suppress_filters' => false
        );
        $classes = get_posts( $args );

        $schedule = array();

        $time = current_time( 'timestamp' );
        foreach ( $classes as $class ) {
            $metas              = get_post_meta( $class->ID, 'gymat_class_schedule', true );
            $gymat_class_icon   = get_post_meta( $class->ID, 'gymat_class_icon', true );
            $gymat_class_img   	= get_post_meta( $class->ID, 'gymat_class_img', true );
            $button_text 		= get_post_meta( $class->ID, 'gymat_class_button_text', true );
            $button_link 		= get_post_meta( $class->ID, 'gymat_class_button_url', true ) ? get_post_meta( $class->ID, 		'gymat_class_button_url', true ):'#';
            $metas              = ( $metas != '' ) ? $metas : array();
            foreach ( $metas as $meta ) {
                if ( empty( $meta['week'] ) || empty( $meta['start_time'] ) ) {
                    continue;
                }
                $timestamp = $meta['week'] . ' ' . $meta['start_time'];
               
                $timestamp = strtotime($timestamp);
                if ( $timestamp < $time ) {
                    $timestamp = $timestamp + $time;
                }

                $start_time = strtotime( $meta['start_time'] );
                $end_time   = !empty( $meta['end_time'] ) ? strtotime( $meta['end_time'] ) : false;

                if ( GymatTheme::$options['class_time_format'] == '24' ) {
                    $start_time = date( "H:i", $start_time );
                    $end_time   = $end_time ? date( "H:i", $end_time ) : '';
                }
                else {
                    $start_time = date( "g:ia", $start_time );
                    $end_time   = $end_time ? date( "g:ia", $end_time ) : '';
                }
				$gymat_trainer_name='';
                if(!empty( $meta['trainer'] ) && get_post_status( $meta['trainer'] )){
					$gymat_trainer_name = get_the_title( $meta['trainer'] );
				} 
                $schedule[] = array(
                    'class'         => $class->post_title,
                    'thumbnail'     =>get_the_post_thumbnail_url( $class->ID,'full'),
                    'trainer'       =>$gymat_trainer_name,
                    'content'       =>get_the_excerpt($class->ID),
                    'button_text'   =>$button_text,
                    'button_link'   =>$button_link,
                    'gymat_icon'    =>$gymat_class_icon,
					'gymat_img'     =>$gymat_class_img,
                    'week'          => $meta['week'],
                    'weekname'      => $weeknames[$meta['week']],
                    'start_time'    => $start_time,
                    'end_time'      => $end_time,
                    'timestamp'     => $timestamp,
                );     
            }
        }
        usort( $schedule, array( $this, 'sort_by_time' ));
        return array_slice( $schedule, 0, $number );
    }

    public function rt_fields() {

        $fields = array(
            array(
                'mode'  => 'section_start',
                'id'    => 'section_general',
                'label' => __( 'General', 'gymat-core' )
            ),
            array(
				'type'    => Controls_Manager::SELECT2,
				'id'      => 'style',
				'label'   => esc_html__( 'Style', 'gymat-core' ),
				'options' => array(
					'style1' => esc_html__( 'Upcomming Class Layout 1', 'gymat-core' ),
					'style2' => esc_html__( 'Upcomming Class Layout 2', 'gymat-core' ),
				),
				'default' => 'style1',
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
                'condition' =>array('style'=>array('style1'))
			),
            array(
                'id'        => 'item_no',
                'label'     => __( 'Total number of items', 'gymat-core' ),
                'type'      => Controls_Manager::NUMBER,
                'default'   => 7,
                'description' => __( 'Write -1 to show all', 'gymat-core' ),
            ),
            array(
				'type'    => Controls_Manager::TEXT,
				'id'      => 'section_title',
				'label_block' =>true,
				'label'   => esc_html__( 'Section Title', 'gymat-core' ),
				'default' =>"We Offer Body Changes Classes",
				'condition'   => array('style' => array('style2')),
			),
            array(
				'type'    => Controls_Manager::TEXT,
				'id'      => 'section_subtitle',
				'label_block' =>true,
				'label'   => esc_html__( 'Section Sub Title', 'gymat-core' ),
				'default' =>"Gym Class",
				'condition'   => array('style' => array('style2')),
			),
            array(
				'type'    => Controls_Manager::TEXTAREA,
				'id'      => 'section_content',
				'label_block' =>true,
				'label'   => esc_html__( 'Section Content', 'gymat-core' ),
				'default' =>"Gymat an unknown printer took galle type anscr aey aretea bled make a type specimen bookay survived not onlyive centuries.",
				'condition'   => array('style' => array('style2')),
			),
            array(
				'type'        => Controls_Manager::SWITCHER,
				'id'          => 'button_display',
				'label'       => esc_html__( 'Button', 'gymat-core' ),
				'label_on'    => esc_html__( 'On', 'gymat-core' ),
				'label_off'   => esc_html__( 'Off', 'gymat-core' ),
				'default'     => 'yes',
				'description' => esc_html__( 'Show or Hide Content. Default: onn', 'gymat-core' ),
                'condition' =>array('style'=>array('style1'))
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
				'default'     => 'off',
			),
			array(
				'type'        => Controls_Manager::SWITCHER,
				'id'          => 'slider_loop',
				'label'       => esc_html__( 'Loop', 'gymat-core' ),
				'default'     => 'off',
			),
			
			array(
				'type'        => Controls_Manager::SWITCHER,
				'id'          => 'centered_slide',
				'label'       => esc_html__( 'Center Slide', 'gymat-core' ),
				'default'     => 'false',
			),
			array(
				'type'        => Controls_Manager::SLIDER,
				'id'          => 'slider_per_group',
				'label'       => esc_html__( 'Slides Per Group', 'gymat-core' ),
                'range' => [
                    'px' => [
                        'min' => 1,
                        'max' => 6,
                    ],
                ],
                'size_units' => [ 'px'],
                'default' => [
                    'size' => 1,
                ],
			),
			array(
				'type'        => Controls_Manager::SLIDER,
				'id'          => 'autoplayspeed',
				'label'       => esc_html__( 'Autoplay speed', 'gymat-core' ),
				'condition'   => array( 'slider_autoplay' => 'yes' ),
                'range' => [
                    'px' => [
                        'min' => 1,
                        'max' => 10000,
                        'step' => 500,
                    ],
                ],
                'size_units' => [ 'px'],
                'default' => [
                    'size' => 2000,
                ],
			),
			array(
				'type'        => Controls_Manager::SLIDER,
				'id'          => 'speed',
				'label'       => esc_html__( 'Slider Speed', 'gymat-core' ),
                'range' => [
                    'px' => [
                        'min' => 1,
                        'max' => 10000,
                        'step' => 500,
                    ],
                ],
                'size_units' => [ 'px'],
                'default' => [
                    'size' => 2000,
                ],
				
			),
			array(
				'type'        => Controls_Manager::SLIDER,
				'id'          => 'space',
				'label'       => esc_html__( 'Inter slider spacing', 'gymat-core' ),
                'range' => [
                    'px' => [
                        'min' => 1,
                        'max' => 100,
                        'step' => 1,
                    ],
                ],
                'size_units' => [ 'px'],
                'default' => [
                    'size' => 30,
                ],
				
			),

			array(
				'type'        => Controls_Manager::SLIDER,
				'id'          => 'item',
				'label'       => esc_html__( 'Desktop items', 'gymat-core' ),
                'range' => [
                    'px' => [
                        'min' => 1,
                        'max' => 6,
                        'step' => 1,
                    ],
                ],
                'size_units' => [ 'px'],
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
                'size_units' => [ 'px'],
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
                'size_units' => [ 'px'],
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
                        'max' => 10,
                        'step' => 1,
                    ],
                ],
                'size_units' => [ 'px'],
                'default' => [
                    'size' => 1,
                ],
			),
			
			array(
				'mode' => 'section_end',
			),
            // Style
			array(
				'mode'    => 'section_start',
				'id'      => 'section_style',
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
				),
			),
            array (
				'type'    => Controls_Manager::COLOR,
				'id'      => 'class_meta_icon_color',
				'label'   => esc_html__( 'Meta Icon Color', 'gymat-core' ),
				'default' => '',
				'selectors' => array( 
					'{{WRAPPER}} .class-multi-layout2 .schedule-meta li i' => 'color: {{VALUE}}',
					'{{WRAPPER}} .upcomming-class-layout2 .class-item .schedule-meta li i' => 'color: {{VALUE}}',
				),
			),
            array (
				'type'    => Controls_Manager::COLOR,
				'id'      => 'class_meta_color',
				'label'   => esc_html__( 'Meta  Color', 'gymat-core' ),
				'default' => '',
				'selectors' => array( 
					'{{WRAPPER}} .class-multi-layout2 .schedule-meta li' => 'color: {{VALUE}}',
					'{{WRAPPER}} .upcomming-class-layout2 .class-item .schedule-meta li' => 'color: {{VALUE}}',
				),
			),
            array (
				'type'    => Controls_Manager::COLOR,
				'id'      => 'class_content_color',
				'label'   => esc_html__( 'Content Color', 'gymat-core' ),
				'default' => '',
				'selectors' => array( 
					'{{WRAPPER}} .class-multi-layout2 .class-item .schedule-time p' => 'color: {{VALUE}}',
				),
                'condition'  =>array('style'=>array('style1'))
			),						
			array(
				'mode' => 'section_end',
			),
            // Style
			array(
				'mode'    => 'section_start',
				'id'      => 'section_heading_style',
				'label'   => esc_html__( 'Section Style', 'gymat-core' ),
				'tab'     => Controls_Manager::TAB_STYLE,
                'condition'=>array('style'=>array('style2'))
			),
            array (
				'mode'    => 'group',
				'type'    => Group_Control_Typography::get_type(),
				'name'    => 'section_title_typo',
				'label'   => esc_html__( 'Section Title Typo', 'gymat-core' ),
                'selector' => '{{WRAPPER}} .upcomming-class-layout2 .section-heading .heading-title',
			),
            array (
				'mode'    => 'group',
				'type'    => Group_Control_Typography::get_type(),
				'name'    => 'section_subtitle_typo',
				'label'   => esc_html__( 'Section SubTitle Typo', 'gymat-core' ),
                'selector' => '{{WRAPPER}} .upcomming-class-layout2 .section-heading .subtitle',
			),
            array (
				'type'    => Controls_Manager::COLOR,
				'id'      => 'section_title_color',
				'label'   => esc_html__( 'Section Title  Color', 'gymat-core' ),
				'default' => '',
				'selectors' => array( 
					'{{WRAPPER}} .upcomming-class-layout2 .section-heading .heading-title' => 'color: {{VALUE}}',
				),
			),
            array (
				'type'    => Controls_Manager::COLOR,
				'id'      => 'section_subtitle_color',
				'label'   => esc_html__( 'Section Subtitle  Color', 'gymat-core' ),
				'default' => '',
				'selectors' => array( 
					'{{WRAPPER}} .upcomming-class-layout2 .section-heading .subtitle' => 'color: {{VALUE}}',
				),
			),
            array (
				'type'    => Controls_Manager::COLOR,
				'id'      => 'section_content_color',
				'label'   => esc_html__( 'Section Content  Color', 'gymat-core' ),
				'default' => '',
				'selectors' => array( 
					'{{WRAPPER}} .upcomming-class-layout2 .section-heading p' => 'color: {{VALUE}}',
				),
			),
            array(
				'type'    => Controls_Manager::DIMENSIONS,
				'id'      => 'title_margin',
				'mode'    => 'responsive',
				'label'   => esc_html__( 'Section Titile Space', 'finbuzz-core' ),
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .upcomming-class-layout2 .section-heading .heading-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			),
            array(
				'mode' => 'section_end',
			),

        );

        return $fields;

    }

    protected function render() {
        $data = $this->get_settings();
        $this->rt_load_scripts();
        switch ( $data['style'] ) {
			case 'style2':
			$template = 'rt-upcomming-class-2';
			break;
			default:
			$template = 'rt-upcomming-class';
			break;
		}
        return $this->rt_template( $template, $data );
    }

}

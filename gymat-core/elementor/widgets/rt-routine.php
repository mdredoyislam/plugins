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

class RT_Routine extends Custom_Widget_Base {

    public function __construct( $data = [], $args = null ) {
        $this->rt_name  = __( 'DV Routine', 'gymat-core' );
        $this->rt_base  = 'rt-routine';
        parent::__construct( $data, $args );
    }

    public function sort_by_time_as_key( $a, $b ) {
        return (int)( strtotime( $a ) > strtotime( $b ) );
    }

    public function sort_by_end_time( $a, $b ) {
        return ( strtotime( $a['end_time'] ) > strtotime( $b['end_time'] ) );
    }

    public function print_routine( $routine, $link, $trainer ) {
        usort( $routine, array( $this, 'sort_by_end_time' ) );
        $tag = ( $trainer == 'yes' );
        ?>
        <?php foreach ( $routine as $each_routine ): ?>
            <?php
            $class             ='rt-item tab-pane fade show rt-routine-id-' . $each_routine['id'];
            $style             = $each_routine['color'] ? ' style="color:'.esc_attr( $each_routine['color'] ).';"' : '';
            $permalink         = get_the_permalink( $each_routine['id'] );
            $trainer_id        =$each_routine['trainer_id'];
            $trainer_permalink =$each_routine['trainer_link'];
            $trainer_position  =$each_routine['position'];
            $start_tag         = '<div class="'.$class.'">';
            $end_tag           = '</div>';
            ?>
            <?php echo $start_tag;?>
            <?php if($trainer_id || $trainer_permalink || $trainer_position ){ 
                if ( $trainer == 'yes' ): ?>
                <div class="trainer-thumb">
                    <div class="trainer-profile">
                      <?php echo get_the_post_thumbnail($trainer_id ,'full',array( "class" => "img-fluid rounded-circle" ) ); ?>
                    </div>
                    <div class="media-body">
			            <h3 class="trainer-title"><?php echo esc_html( $each_routine['trainer'] );?></h3>
                        <div class="trainer-position"><?php echo wp_kses_post($trainer_position); ?></div>
                        <?php if($link=='yes'){ ?>
			            <a href="<?php echo esc_url( $trainer_permalink); ?>" class="trainer-btn"><?php esc_html_e( 'View Profile', 'gymat-core' )?></a>
                        <?php } ?>
			        </div>
                </div>
            <?php endif; 
                    }
            ?>
            <div class="rt-item-time">
                <span><?php echo esc_html( $each_routine['start_time'] );?></span>
                <?php if ( !empty( $each_routine['end_time'] ) ): ?>
                    <span>- <?php echo esc_html( $each_routine['end_time'] );?></span>
                <?php endif;?>
            </div>
            <h4 class="rt-item-title"><a href="<?php echo esc_url($permalink); ?>" <?php echo $style; ?>><?php echo esc_html( $each_routine['class'] );?></a></h4>
            <?php echo $end_tag;?>
        <?php endforeach; ?>
        <?php
    }
    public function print_routine2( $routine, $link, $trainer ) {
        usort( $routine, array( $this, 'sort_by_end_time' ) );
        $tag = ( $trainer == 'yes' );
        ?>
        <?php foreach ( $routine as $each_routine ): ?>
            <?php
            $class ='rt-item tab-pane fade show rt-routine-id-' . $each_routine['id'];
            $style = $each_routine['color'] ? ' style="background-color:'.esc_attr( $each_routine['color'] ).';"' : '';
            if ( $link == 'yes' ) {
                $permalink = get_the_permalink( $each_routine['id'] );
                $start_tag = '<a href="'.$permalink.'" class="'.$class.'"'.$style.'>';
                $end_tag   = '</a>';
            }
            else {
                $start_tag = '<div class="'.$class.'"'.$style.'>';
                $end_tag   = '</div>';
            }
            ?>
            <?php echo $start_tag;?>
            <div class="rt-item-title"><?php echo esc_html( $each_routine['class'] );?></div>
            <div class="rt-item-time">
                <span><?php echo esc_html( $each_routine['start_time'] );?></span>
                <?php if ( !empty( $each_routine['end_time'] ) ): ?>
                    <span>- <?php echo esc_html( $each_routine['end_time'] );?></span>
                <?php endif;?>
            </div>
            <?php if ( $trainer == 'yes' ): ?>
                <div class="rt-item-trainer"><?php echo esc_html( $each_routine['trainer'] );?></div>
            <?php endif;?>
            <?php echo $end_tag;?>
        <?php endforeach; ?>
        <?php
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
				'label'   => esc_html__( 'Class Layout', 'gymat-core' ),
				'options' => array(
					'style1' => esc_html__( 'Routine Layout 1', 'gymat-core' ),
					'style2' => esc_html__( 'Routine Layout 2', 'gymat-core' ),
				),
				'default' => 'style1',
			),
            array(
                'id'      => 'query_type',
                'label' => esc_html__( 'Query type', 'gymat-core' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'posts',
                'options' => array(
                    'category'  => esc_html__( 'Category', 'gymat-core' ),
                    'posts' => esc_html__( 'Posts', 'gymat-core' ),
                ),
            ),
            array(
                'id'      => 'postid',
                'label' => esc_html__( 'Selects posts', 'gymat-core' ),
                'type' => Controls_Manager::SELECT2,
                'options' => $this->get_all_posts('gymat_class'),
                'label_block' => true,
                'multiple' => true,
                'condition' => array(
                    'query_type' => 'posts',
                ),
            ),
            array(
                'id'    => 'category',
                'label' => __( 'Class Categories', 'gymat-core' ),
                'type'  =>  Controls_Manager::SELECT2,
                'options' => $this->get_taxonomy_drops('gymat_class_category'),
                'multiple' => true,
                'condition' => array(
                    'query_type' => 'category',
                ),
            ),
            array(
                'type'        => Controls_Manager::SWITCHER,
                'id'          => 'trainer_profile_link',
                'label'       => esc_html__( 'Trainer Linkable Button', 'gymat-core' ),
                'label_on'    => esc_html__( 'On', 'gymat-core' ),
                'label_off'   => esc_html__( 'Off', 'gymat-core' ),
                'default'     => 'yes',
                'description' => esc_html__( 'Linked to Trainer Profile page or not', 'gymat-core' ),
                'condition'   => array( 'style' => array('style1'))
            ),
            array(
                'type'        => Controls_Manager::SWITCHER,
                'id'          => 'link',
                'label'       => esc_html__( 'Linkable', 'gymat-core' ),
                'label_on'    => esc_html__( 'On', 'gymat-core' ),
                'label_off'   => esc_html__( 'Off', 'gymat-core' ),
                'default'     => 'no',
                'description' => esc_html__( 'Linked to class page or not', 'gymat-core' ),
                'condition'   => array( 'style' => array('style2'))
            ),
            array(
                'type'        => Controls_Manager::SWITCHER,
                'id'          => 'trainer',
                'label'       => esc_html__( 'Trainer Display', 'gymat-core' ),
                'label_on'    => esc_html__( 'On', 'gymat-core' ),
                'label_off'   => esc_html__( 'Off', 'gymat-core' ),
                'default'     => 'no',
                'description' => esc_html__( 'Show or Hide Trainer Name', 'gymat-core' ),
            ),
            array(
                'type'        => Controls_Manager::SWITCHER,
                'id'          => 'nav',
                'label'       => esc_html__( 'Navigation Menu Display', 'gymat-core' ),
                'label_on'    => esc_html__( 'On', 'gymat-core' ),
                'label_off'   => esc_html__( 'Off', 'gymat-core' ),
                'default'     => 'no',
                'description' => esc_html__( 'Show or Hide Navigation Menu', 'gymat-core' ),
                'condition' => array(
                    'style'    => array( 'style1' ),
                ),
            ),
            array(
                'mode'  => 'section_end'
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
				'label'   => esc_html__( 'Table Date Title Typo', 'gymat-core' ),
                'selector' => '{{WRAPPER}} .rt-routine .rt-col-title > h3',
                'condition'   => array( 'style' => array('style1'))
			),
            array (
				'type'    => Controls_Manager::COLOR,
				'id'      => 'class_title_color',
				'label'   => esc_html__( 'Table Row Date Color', 'gymat-core' ),
				'default' => '',
				'selectors' => array( 
					'{{WRAPPER}} .rt-routine .rt-col-title > h3' => 'color: {{VALUE}}',
					'{{WRAPPER}} .rt-routine-2 .rt-col-title' => 'color: {{VALUE}}',
				),
			),
            array (
				'type'    => Controls_Manager::COLOR,
				'id'      => 'table_time',
				'label'   => esc_html__( 'Table Column Time Color', 'gymat-core' ),
				'default' => '',
				'selectors' => array( 
					'{{WRAPPER}} .rt-routine .rt-item-time' => 'color: {{VALUE}}',
					'{{WRAPPER}} .rt-routine .rt-row-title' => 'color: {{VALUE}}',
					'{{WRAPPER}} .rt-routine-2 .rt-row-title' => 'color: {{VALUE}}',
				),
			),
            array (
				'type'    => Controls_Manager::COLOR,
				'id'      => 'class_title_color2',
				'label'   => esc_html__( 'Class Title Color', 'gymat-core' ),
				'default' => '',
				'selectors' => array( 
					'{{WRAPPER}} .rt-routine-2 .rt-item .rt-item-title' => 'color: {{VALUE}}',
				),
                'condition'   => array( 'style' => array('style2'))
			),
            array (
				'type'    => Controls_Manager::COLOR,
				'id'      => 'class_time_color',
				'label'   => esc_html__( 'Time Color', 'gymat-core' ),
				'default' => '',
				'selectors' => array( 
					'{{WRAPPER}} .rt-routine-2 .rt-item .rt-item-time' => 'color: {{VALUE}}',
				),
                'condition'   => array( 'style' => array('style2'))
			),
            array (
				'type'    => Controls_Manager::COLOR,
				'id'      => 'trainer_color',
				'label'   => esc_html__( 'Trainer Color', 'gymat-core' ),
				'default' => '',
				'selectors' => array( 
					'{{WRAPPER}} .rt-routine-2 .rt-item .rt-item-trainer' => 'color: {{VALUE}}',
				),
                'condition'   => array( 'style' => array('style2'))
			),
            array (
				'type'    => Controls_Manager::COLOR,
				'id'      => 'table_bg_color',
				'label'   => esc_html__( 'Table Background', 'gymat-core' ),
				'default' => '',
				'selectors' => array( 
					'{{WRAPPER}} .rt-routine table' => 'background-color: {{VALUE}}',
					'{{WRAPPER}} .rt-routine-2 th' => 'background-color: {{VALUE}}',
					'{{WRAPPER}} .rt-routine-2 td' => 'background-color: {{VALUE}}',
				),
			),
            array (
				'type'    => Controls_Manager::COLOR,
				'id'      => 'table_active_row_color',
				'label'   => esc_html__( 'Table Active Row Box', 'gymat-core' ),
				'default' => '',
				'selectors' => array( 
					'{{WRAPPER}} .rt-routine .rt-item' => 'background-color: {{VALUE}}',
				),
                'condition'   => array( 'style' => array('style1'))
			),
            array (
				'type'    => Controls_Manager::COLOR,
				'id'      => 'table_border_color',
				'label'   => esc_html__( 'Table Border Color', 'gymat-core' ),
				'default' => '',
				'selectors' => array( 
					'{{WRAPPER}} .rt-routine table td' => 'border-color: {{VALUE}}',
					'{{WRAPPER}} .rt-routine table th' => 'border-color: {{VALUE}}',
                    '{{WRAPPER}} .rt-routine-2 table td' => 'border-color: {{VALUE}}',
					'{{WRAPPER}} .rt-routine-2 table th' => 'border-color: {{VALUE}}',
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
        switch ( $data['style'] ) {
            case 'style2':
			$template = 'rt-routine-2';
			break;
			default:
			$template = 'rt-routine';
			break;
		}
        return $this->rt_template( $template, $data );
    }

}

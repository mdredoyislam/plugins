<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

namespace radiustheme\Gymat_Core;

use GymatTheme;
use GymatTheme_Helper;
use \WP_Query;

$thumb_size = 'full';

$number_of_post = 1;
$title_count = $data['title_count'];
$args = array(
    'post_type'      => 'gymat_class',
    'post_status'    => 'publish',
    'posts_per_page' => $number_of_post,
    'p'              => $data['postid'],
);

$query = new WP_Query( $args );
$temp = GymatTheme_Helper::wp_set_temp_query( $query );

?>
<div class="class-default class-multilayout-3 feature-class">
    <?php 
        if ( $query->have_posts() ) {
        while ( $query->have_posts() ) {
        $query->the_post();
        $id            	= get_the_id();
        $content = apply_filters( 'the_content', get_the_content() );
        $weeknames = array(
            'mon' => esc_html__( 'Monday', 'gymat' ),
            'tue' => esc_html__( 'Tuesday', 'gymat' ),
            'wed' => esc_html__( 'Wednesday', 'gymat' ),
            'thu' => esc_html__( 'Thursday', 'gymat' ),
            'fri' => esc_html__( 'Friday', 'gymat' ),
            'sat' => esc_html__( 'Saturaday', 'gymat' ),
            'sun' => esc_html__( 'Sunday', 'gymat' ),
        );
        $weeknames = apply_filters( 'gymat_weeknames_short', $weeknames );
        $gymat_class_icon   = get_post_meta( get_the_ID(), 'gymat_class_icon', true );
        $gymat_class_img   	= get_post_meta( get_the_ID(), 'gymat_class_img', true );
        $title = wp_trim_words( get_the_title(), $title_count, '' );
        $id = get_the_ID();
        $schedule = get_post_meta( $id, 'gymat_class_schedule', true );
        $schedule = ( $schedule != '' ) ? $schedule : array();
        $schedule_limit = apply_filters( 'gymat_schedule_limit', $data['schedule_number']);
        if ( $schedule_limit ) {
            $schedule = array_slice( $schedule, 0, $schedule_limit );
        }
    ?>
        <div class="class-item">
            <div class="class-thumbnail">
                <a href="<?php the_permalink(); ?>">
                    <?php
                        if ( has_post_thumbnail() ){
                            the_post_thumbnail( $thumb_size, ['class' => 'img-fluid mb-10 width-100'] );
                        } else {
                            if ( !empty( GymatTheme::$options['no_preview_image']['id'] ) ) {
                                echo wp_get_attachment_image( GymatTheme::$options['no_preview_image']['id'], $thumb_size );
                            } else {
                                echo '<img class="wp-post-image" src="' . GymatTheme_Helper::get_img( 'noimage_370X328.jpg' ) . '" alt="'.get_the_title().'">';
                            }
                        }
                    ?>
                </a>
                <div class="class-content">
                    <h3 class="class-title"><a href="<?php the_permalink(); ?>"><?php echo wp_kses($title,'alltext_allow');?></a></h3>
                    <div class="schedule">
                        <?php foreach ( $schedule as $time ): ?>
                            <?php if ( !empty( $time['week'] ) && !empty( $time['start_time'] ) && !empty( $time['end_time'] ) ): ?>
                                <?php
                                $start_time = !empty( $time['start_time'] ) ? strtotime( $time['start_time'] ) : false;
                                $end_time = !empty( $time['end_time'] ) ? strtotime( $time['end_time'] ) : false;

                                if ( GymatTheme::$options['class_time_format'] == '24' ) {
                                    $start_time = $start_time ? date( "H:i", $start_time ) : '';
                                }
                                else {
                                    $start_time = $start_time ? date( "g:ia", $start_time ) : '';
                                }
                                if ( GymatTheme::$options['class_time_format'] == '24' ) {
                                    $end_time = $end_time ? date( "H:i", $end_time ) : '';
                                }
                                else {
                                    $end_time = $end_time ? date( "g:ia", $end_time ) : '';
                                }
                                $full_time     = $start_time."-".$end_time;
                                ?>
                                <div>
                                    <span class="day"><?php echo esc_html( $weeknames[$time['week']] );?>:</span>
                                    <span class="time"><?php echo esc_html( $full_time );?></span>
                                </div>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </div>
                </div>
                <?php if($data['icon_display']=='yes'){ ?>
                    <div class="class-media">
                        <?php if($gymat_class_img){ ?>
                            <div class="class-img">
                                <?php echo wp_get_attachment_image( $gymat_class_img );?> 
                            </div>
                        <?php } else { ?>
                            <div class="class-icon">
                                    <i class="<?php echo wp_kses_post( $gymat_class_icon  );?>"></i>
                            </div>
                        <?php } ?>	
                    </div>
                <?php } ?>
            </div>
        </div>
    <?php } } ?>
	<?php GymatTheme_Helper::wp_reset_temp_query( $temp ); ?>
</div>

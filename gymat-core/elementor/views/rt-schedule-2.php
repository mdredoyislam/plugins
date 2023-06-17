<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

// css classes
$schedule_class  = '';
$schedule_class .= ( $data['btn_display'] != 'yes' ) ? ' schedule-no-button' : ' schedule-has-button';

// week names array
$weeknames = array(
    'mon' => __( 'Monday', 'gymat-core' ),
    'tue' => __( 'Tuesday', 'gymat-core' ),
    'wed' => __( 'Wednesday', 'gymat-core' ),
    'thu' => __( 'Thursday', 'gymat-core' ),
    'fri' => __( 'Friday', 'gymat-core' ),
    'sat' => __( 'Saturday', 'gymat-core' ),
    'sun' => __( 'Sunday', 'gymat-core' ),
);
$weeknames = apply_filters( 'gymat_schedule2_weeknames', $weeknames );

// class post types array
$args = array(
    'posts_per_page'   => -1,
    'post_type'        => 'gymat_class',
    'suppress_filters' => false
);

if ( !empty( $data['cat'] ) ) {
    $args['tax_query'] = array(
        array(
            'taxonomy' => 'gymat_class_category',
            'field' => 'term_id',
            'terms' => $data['cat'],
        )
    );
}
if(!empty($data['postid'])){
    if( $data['query_type'] == 'posts'){
        $args['post__in'] = $data['postid'];
    }
}

$classes = get_posts( $args );
$uniqid = (int) rand();

$class_schedules = array();

foreach ( $classes as $key => $class ) {
    $button_text = get_post_meta( $class->ID, 'gymat_class_button_text', true );
    $button_url  = get_post_meta( $class->ID, 'gymat_class_button_url', true );
    $metas = get_post_meta( $class->ID, 'gymat_class_schedule', true );
    $metas = ( $metas != '' ) ? $metas : array();
    if ( !$metas ) {
        unset( $classes[$key] );
        continue;
    }

    foreach ( $metas as $meta ) {
        if ( empty( $meta['week'] ) || $meta['week'] == 'none' ) {
            continue;
        }

        $start_time = !empty( $meta['start_time'] ) ? strtotime( $meta['start_time'] ) : false;
        $end_time   = !empty( $meta['end_time'] ) ? strtotime( $meta['end_time'] ) : false;

        if ( GymatTheme::$options['class_time_format'] == '24' ) {
            $start_time = $start_time ? date( "H:i", $start_time ) : '';
            $end_time   = $end_time ? date( "H:i", $end_time ) : '';
        }
        else {
            $start_time = $start_time ? date( "g:ia", $start_time ) : '';
            $end_time   = $end_time ? date( "g:ia", $end_time ) : '';
        }

        $class_schedules[$class->ID][] = array(
            'weekday'     => $meta['week'],
            'trainer'     => !empty( $meta['trainer'] ) ? get_the_title( $meta['trainer'] ) : '',
            'start_time'  => $start_time,
            'end_time'    => $end_time,
            'button_text' => $button_text,
            'button_url'  => $button_url,
        );
    }
}
?>
<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12">
        <div class="rt-class-schedule-1<?php echo esc_attr( $schedule_class );?> rt-defualt-schedule">
            <ul class="nav nav-tabs">
                <?php
                $count = 1;
                ?>
                <?php foreach ( $classes as $class ): ?>
                    <?php
                    $id = $class->ID . '-' . $uniqid;
                    $active_class = ( 1 == $count ) ? 'active' : '';
                    $count++;
                    ?>
                    <li><a class="<?php echo esc_attr( $active_class ); ?>" href="#t<?php echo esc_attr( $id );?>" data-bs-toggle="tab"><?php echo esc_html( $class->post_title );?></a></li>
                <?php endforeach; ?>
            </ul>
            <div class="tab-content class-schedule-tab">
                <?php
                $count = 1;
                ?>
                <?php foreach ( $class_schedules as $class_id => $class_array ): ?>
                    <?php
                    $id = $class_id . '-' . $uniqid;
                    $active_class = ( 1 == $count ) ? ' show active' : '';
                    $count++;
                    ?>
                    <div class="tab-pane fade<?php echo esc_attr( $active_class );?>" id="t<?php echo esc_attr( $id );?>">
                        <?php foreach ( $class_array as $value ): ?>
                            <?php
                            $time = $value['start_time'];
                            if ( !empty( $value['end_time'] ) ) {
                                $time .=  " - {$value['end_time']}";
                            }
                            ?>
                            <ul>
                                <li class="rtin-class-name">
                                    <span><?php echo esc_html('Weekday','gymat-core') ?></span>
                                    <h3><?php echo esc_html( $weeknames[$value['weekday']] ); ?></h3>
                                </li>
                                <li class="rtin-class-time">
                                    <span><?php echo esc_html('Time','gymat-core') ?></span>
                                    <h3><?php echo esc_html( $time );?></h3>
                                </li>
                                <li class="rtin-class-trainer">
                                    <span><?php echo esc_html('Trainer','gymat-core') ?></span>
                                    <h3><?php echo esc_html( $value['trainer'] ); ?></h3>
                                </li>
                                <?php if ( $data['btn_display'] == 'yes' && !empty( $value['button_text'] ) && !empty( $value['button_url'] ) ): ?>
                                    <li class="rtin-btn"><a href="<?php echo esc_url( $value['button_url'] ); ?>"><?php echo esc_html( $value['button_text'] ); ?></a></li>
                                <?php endif; ?>
                            </ul>
                        <?php endforeach; ?>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</div>
<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

// week names array
$weeknames = array(
    'mon' => __( 'MON', 'gymat-core' ),
    'tue' => __( 'TUE', 'gymat-core' ),
    'wed' => __( 'WED', 'gymat-core' ),
    'thu' => __( 'THUR', 'gymat-core' ),
    'fri' => __( 'FRI', 'gymat-core' ),
    'sat' => __( 'SAT', 'gymat-core' ),
    'sun' => __( 'SUN', 'gymat-core' ),
);
$weeknames = apply_filters( 'gymat_routine1_weeknames', $weeknames );

// class post types array
$args = array(
    'posts_per_page'   => -1,
    'post_type'        => 'gymat_class',
    'suppress_filters' => false,
    'orderby'          => 'title',
    'order'            => 'ASC',
);

if ( !empty( $data['category'] ) ) {
    $args['tax_query'] = array(
        array(
            'taxonomy' => 'gymat_class_category',
            'field' => 'term_id',
            'terms' => $data['category'],
        )
    );
}
if(!empty($data['postid'])){
    if( $data['query_type'] == 'posts'){
        $args['post__in'] = $data['postid'];
    }
}

$classes = get_posts( $args );
$schedule = array();
$available_weeks = array();

foreach ( $classes as $class ) {
    $color = get_post_meta( $class->ID, 'gymat_class_color', true );
    $metas = get_post_meta( $class->ID, 'gymat_class_schedule', true );
    $metas = ( $metas != '' ) ? $metas : array();
    foreach ( $metas as $meta ) {

        if ( empty( $meta['week'] ) || $meta['week'] == 'none' || empty( $meta['start_time'] ) ) {
            continue;
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

        if ( !in_array( $meta['week'], $available_weeks ) ) {
            $available_weeks[] = $meta['week'];
        }
        $position=get_post_meta( $meta['trainer'], 'gymat_trainer_designation', true );
        $position=$position ? $position:'';
        $schedule[$start_time][$meta['week']][] = array(
            'id'              => $class->ID,
            'class'           => $class->post_title,
            'color'           => $color,
            'start_time'      => $start_time,
            'end_time'        => $end_time,
            'trainer'         => !empty( $meta['trainer'] ) ? get_the_title( $meta['trainer'] ) : '',
            'trainer_id'      => $meta['trainer']  ? $meta['trainer'] : '',
            'position'   	  =>$position, 
            'trainer_link'    => !empty( $meta['trainer'] ) ? get_the_permalink( $meta['trainer'] ) : '',
        );
    }
}

// remove empty fields
foreach ( $weeknames as $key => $value ){
    if ( !in_array( $key, $available_weeks ) ) {
        unset( $weeknames[$key] );
    }
}

uksort( $schedule, array( $this, 'sort_by_time_as_key' ) );
?>
<div class="table-responsive rt-routine">
    <?php if ( $data['nav'] == 'yes' ): ?>
        <div class="rt-routine-nav">
            <ul class="nav nav-tabs">
                <li class="active"><a href="#" data-id="all"><?php _e( 'All', 'gymat-core' );?></a></li>
                <?php foreach ( $classes as $class ): ?>
                    <li><a data-id="<?php echo esc_attr( $class->ID );?>" href="#"><?php echo esc_html( $class->post_title );?></a></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>
    <table class="tab-content">
        <tr>
            <th></th>
            <?php foreach ( $weeknames as $weekname ): ?>
                <th class="rt-col-title"><span><?php echo esc_html( $weekname );?></span></th>
            <?php endforeach; ?>
        </tr>
        <?php foreach ( $schedule as $schedule_time => $schedule_value ): ?>
            <tr>
                <th class="rt-row-title"><?php echo $schedule_time;?></th>
                <?php
                // each week slot(cell)
                foreach ( $weeknames as $weekname => $weekvalue ) {
                    $has_cell = false;
                    // iterate over each week array
                    foreach ( $schedule_value as $schedule_week => $routine ) {
                        if ( $weekname == $schedule_week ) {
                            echo '<td>';
                            $this->print_routine( $routine, $data['trainer_profile_link'], $data['trainer'] );
                            echo '</td>';
                            $has_cell = true;
                        }
                    }
                    if ( !$has_cell ) {
                        echo '<td></td>';
                    }
                }
                ?>
            </tr>
        <?php endforeach; ?>
    </table>
</div>
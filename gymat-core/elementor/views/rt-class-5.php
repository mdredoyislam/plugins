<?php
namespace radiustheme\Gymat_Core;
use GymatTheme;
use GymatTheme_Helper;
use \WP_Query;

$thumb_size='gymat-size5';
if ( get_query_var('paged') ) {
	$paged = get_query_var('paged');
}
else if ( get_query_var('page') ) {
	$paged = get_query_var('page');
}
else {
	$paged = 1;
}
$weeknames = array(
    'mon' => esc_html__( 'Mon', 'gymat' ),
    'tue' => esc_html__( 'Tue', 'gymat' ),
    'wed' => esc_html__( 'Wed', 'gymat' ),
    'thu' => esc_html__( 'Thur', 'gymat' ),
    'fri' => esc_html__( 'Fri', 'gymat' ),
    'sat' => esc_html__( 'Sat', 'gymat' ),
    'sun' => esc_html__( 'Sun', 'gymat' ),
);
$args = array(
	'post_type'      => 'gymat_class',
	'posts_per_page' => $data['number'],
	'orderby'        => $data['orderby'],
    'order'          => $data['sortby'],
	'paged'          => $paged,
    'post_status'   =>'publish'
);
$weeknames = apply_filters( 'gymat_weeknames_short', $weeknames );
if ( !empty( $data['cat'] ) ) {
	$args['tax_query'] = array(
		array(
			'taxonomy' => 'gymat_class_category',
			'field' => 'term_id',
			'terms' => $data['cat'],
		)
	);
}

switch ( $data['orderby'] ) {
	case 'title':
	case 'menu_order':
	$args['order'] = 'ASC';
	break;
}

$query = new WP_Query( $args );
$temp = GymatTheme_Helper::wp_set_temp_query( $query );

$col_class = "col-lg-{$data['col_lg']} col-md-{$data['col_md']} col-sm-{$data['col_sm']} col-{$data['col_xs']} col-{$data['col_mobile']}";
?>
<div class="class-default class-multi-layout2 class-grid-<?php echo esc_attr( $data['style'] );?>">
    <div class="row">
        <?php 
            $i = $data['delay']; $j = $data['duration'];
            if ( $query->have_posts() ) {
                while ( $query->have_posts() ) {
                $query->the_post();
                $id            	= get_the_id();
                $schedule = get_post_meta( $id, 'gymat_class_schedule', true );
                $schedule = ( $schedule != '' ) ? $schedule : array();
                $button_text 		= get_post_meta( $id, 'gymat_class_button_text', true );
                $button_link 		= get_post_meta( $id, 'gymat_class_button_url', true ) ? get_post_meta( $id, 		'gymat_class_button_url', true ):'#';
                $schedule_limit = apply_filters( 'gymat_schedule_limit',$data['schedule_number']);
                if ( $schedule_limit ) {
                    $schedule = array_slice( $schedule, 0, $schedule_limit );
                }
                $content = apply_filters( 'the_content', get_the_content() );
                $content = wp_trim_words( $content, $data['content_limit']['size'], '' );
        ?>
            <div class="<?php echo esc_attr( $col_class );?>">
                <div class="class-item rt-animate <?php echo esc_attr( $data['animation'] );?> <?php echo esc_attr( $data['animation_effect'] );?>" data-wow-delay="<?php echo esc_attr( $i );?>s" data-wow-duration="<?php echo esc_attr( $j );?>s">
                    <?php
                        $thumbnail1="";
                        $thumbnail2=""; 
                        if ( has_post_thumbnail($id) ){
                            $thumbnail1=wp_get_attachment_image_src( get_post_thumbnail_id( $id ), $thumb_size  );
                        } else {
                            
                            $thumbnail2=GymatTheme_Helper::get_img( 'noimage_390X340.jpg' );
                        }
                        if(isset($thumbnail1) && !empty($thumbnail1)){
                            $thumbnail=$thumbnail1[0];
                        }
                        if(isset($thumbnail2) && !empty($thumbnail2)){
                            $thumbnail=$thumbnail2;
                        }
                    ?>
                    <div class="class-box-content" data-bg-image=<?php echo esc_attr( $thumbnail ); ?>>
                        <div class="schedule-time">
                            <h3 class="class-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                            <ul class="schedule-meta">
                                <?php foreach ( $schedule as $schedule_info ): ?>
                                    <?php if ( !empty( $schedule_info['week'] ) && !empty( $schedule_info['start_time'] ) ): ?>
                                        <?php
                                        $start_time = !empty( $schedule_info['start_time'] ) ? strtotime( $schedule_info['start_time'] ) : false;
                                        $type = !empty( $schedule_info['trainer'] ) ? get_post_type( $schedule_info['trainer'] ) : '';
                                        if ( $type == 'gymat_trainer' ) {
                                            $trainer_name= get_the_title( $schedule_info['trainer'] );
                                        }
                                        if ( GymatTheme::$options['class_time_format'] == '24' ) {
                                            $start_time = $start_time ? date( "H:i", $start_time ) : '';
                                        }
                                        else {
                                            $start_time = $start_time ? date( "g:i a", $start_time ) : '';
                                        }
                                        ?>
                                        <li>
                                            <?php if(!empty($trainer_name)):?><span class="author"><i class="flaticon-user"></i><?php echo esc_html($trainer_name);?></span><?php endif; ?>
                                            <span class="day"><i class="flaticon-clock-1"></i><?php echo esc_html( $weeknames[$schedule_info['week']] );?>:</span>
                                            <span class="time"><?php echo esc_html( $start_time );?></span>
                                    </li>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            </ul>
                            <p><?php echo wp_kses( $content , 'alltext_allow' ); ?></p>
                            <?php if($data['join_now_button']){ ?>
                                <div class="join-button">
                                    <a class="btn-style1" href="<?php echo esc_url( $button_link); ?>"><span><?php if($button_text) echo esc_html($button_text);  ?>
                                    <svg width="21" height="12" viewBox="0 0 21 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M0 6C0 6.22729 0.087059 6.44527 0.242027 6.60598C0.396994 6.7667 0.607174 6.85699 0.82633 6.85699H18.1774L14.6292 10.5352C14.5523 10.6149 14.4914 10.7095 14.4498 10.8136C14.4082 10.9177 14.3868 11.0292 14.3868 11.1419C14.3868 11.2546 14.4082 11.3662 14.4498 11.4703C14.4914 11.5744 14.5523 11.669 14.6292 11.7487C14.706 11.8284 14.7972 11.8916 14.8976 11.9347C14.998 11.9778 15.1056 12 15.2142 12C15.3229 12 15.4304 11.9778 15.5308 11.9347C15.6312 11.8916 15.7224 11.8284 15.7992 11.7487L20.7572 6.60675C20.8342 6.52714 20.8952 6.43257 20.9369 6.32846C20.9786 6.22434 21 6.11272 21 6C21 5.88728 20.9786 5.77566 20.9369 5.67154C20.8952 5.56743 20.8342 5.47286 20.7572 5.39325L15.7992 0.251323C15.6441 0.0904038 15.4336 0 15.2142 0C14.9948 0 14.7843 0.0904038 14.6292 0.251323C14.474 0.412243 14.3868 0.630497 14.3868 0.858071C14.3868 1.08565 14.474 1.3039 14.6292 1.46482L18.1774 5.14301H0.82633C0.607174 5.14301 0.396994 5.2333 0.242027 5.39402C0.087059 5.55474 0 5.77271 0 6Z" fill="white"/>
                                    </svg>
                                </span></a>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
            <?php $i = $i + 0.2; } ?>
		<?php } ?>   
    </div>
    <?php  if ( $data['more_button_display']  == 'yes' ) : ?>	
		<?php if ( $data['more_button'] == 'show' ) { ?>
			<?php if ( !empty( $data['see_button_text'] ) ) { ?>
			<div class="class-button wow fadeInUp rt-animate" data-wow-delay="1.4s" data-wow-duration="0.8s"><a class="btn-style1" href="<?php echo esc_url( $data['see_button_link'] );?>"><span><?php echo esc_html( $data['see_button_text'] );?>
            <svg width="21" height="12" viewBox="0 0 21 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" clip-rule="evenodd" d="M0 6C0 6.22729 0.087059 6.44527 0.242027 6.60598C0.396994 6.7667 0.607174 6.85699 0.82633 6.85699H18.1774L14.6292 10.5352C14.5523 10.6149 14.4914 10.7095 14.4498 10.8136C14.4082 10.9177 14.3868 11.0292 14.3868 11.1419C14.3868 11.2546 14.4082 11.3662 14.4498 11.4703C14.4914 11.5744 14.5523 11.669 14.6292 11.7487C14.706 11.8284 14.7972 11.8916 14.8976 11.9347C14.998 11.9778 15.1056 12 15.2142 12C15.3229 12 15.4304 11.9778 15.5308 11.9347C15.6312 11.8916 15.7224 11.8284 15.7992 11.7487L20.7572 6.60675C20.8342 6.52714 20.8952 6.43257 20.9369 6.32846C20.9786 6.22434 21 6.11272 21 6C21 5.88728 20.9786 5.77566 20.9369 5.67154C20.8952 5.56743 20.8342 5.47286 20.7572 5.39325L15.7992 0.251323C15.6441 0.0904038 15.4336 0 15.2142 0C14.9948 0 14.7843 0.0904038 14.6292 0.251323C14.474 0.412243 14.3868 0.630497 14.3868 0.858071C14.3868 1.08565 14.474 1.3039 14.6292 1.46482L18.1774 5.14301H0.82633C0.607174 5.14301 0.396994 5.2333 0.242027 5.39402C0.087059 5.55474 0 5.77271 0 6Z" fill="white"/>
            </svg>
            </span></a></div>
			<?php } ?>
		<?php } else { ?>
			<?php GymatTheme_Helper::pagination(); ?>
		<?php } ?>
	<?php endif; ?>
    <?php GymatTheme_Helper::wp_reset_temp_query( $temp ); ?>
</div>




  
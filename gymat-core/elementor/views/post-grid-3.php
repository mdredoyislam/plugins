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




$gymat_has_entry_meta  = ( $data['post_grid_author'] || $data['post_grid_category'] == 'yes' || $data['post_grid_comment'] == 'yes' || $data['post_grid_view'] == 'yes' && function_exists( 'gymat_views' ) || $data['post_grid_read'] == 'yes' && function_exists( 'gymat_reading_time' ) ) ? true : false;

$thumb_size = 'full';

$args = array(
	'posts_per_page' 	=> $data['itemlimit'],
	'cat'            	=> (int) $data['cat'],
	'order' 			=> $data['post_ordering'],
	'orderby' 			=> $data['post_orderby'],
);

$query = new WP_Query( $args );
$temp = GymatTheme_Helper::wp_set_temp_query( $query );

$col_class = "col-xl-{$data['col_xl']} col-lg-{$data['col_lg']} col-md-{$data['col_md']} col-sm-{$data['col_sm']} col-{$data['col']}";

?>
<div class="post-default post-grid-style3">
	<div class="row justify-content-center">
	<?php $i = 1;
	 $j = $data['delay']; $k = $data['duration'];
	 

	if ( $query->have_posts() ) :?>
		<?php while ( $query->have_posts() ) : $query->the_post();?>
			<?php
			$content = GymatTheme_Helper::get_current_post_content();
			$content = wp_trim_words( get_the_excerpt(), $data['count'], '' );
			$content = "<p>$content</p>";
			$title = wp_trim_words( get_the_title(), $data['title_count'], '' );
			if( $i%2 == 0 ) {
				$flip_class='rt-3d-flip-x-reverse';
			}
			else{
				$flip_class='';
			}		 
			$gymat_comments_number = number_format_i18n( get_comments_number() );
			$gymat_comments_html = $gymat_comments_number == 1 ? esc_html__( 'Comment: ' , 'gymat-core' ) : esc_html__( 'Comments: ' , 'gymat-core' );
			$gymat_comments_html = $gymat_comments_html . '<span class="comment-number">'. $gymat_comments_number . '</span> ';
			
			$gymat_time_html = sprintf( '<span>%s</span> <span>%s</span>', get_the_time( 'd' ), get_the_time( 'M' ), get_the_time( 'Y' ) );

			if ( empty(has_post_thumbnail() ) ) {
				$img_class ='no_image';
			}else {
				$img_class ='show_image';
			}

			?>
			<?php
			$id=get_the_ID();
				$thumbnail1="";
				$thumbnail2=""; 
				if ( has_post_thumbnail($id ) ){
					$thumbnail1=wp_get_attachment_image_src( get_post_thumbnail_id( $id ), $thumb_size  );
				} else {
					
					$thumbnail2=FinbuzzTheme_Helper::get_img( 'noimage_390X340.jpg' );
					
				}
				if(isset($thumbnail1) && !empty($thumbnail1)){
					$thumbnail=$thumbnail1[0];
				}
				if(isset($thumbnail2) && !empty($thumbnail2)){
					$thumbnail=$thumbnail2;
				}
			?>
			<div class="<?php  echo esc_attr( $col_class );?> rt-animate <?php echo esc_attr( $data['animation'] );?> <?php echo esc_attr( $data['animation_effect'] );?>" data-wow-delay="<?php echo esc_attr( $j );?>s" data-wow-duration="<?php echo esc_attr( $k );?>s">
				<div class="radius-block-3d-flip-container <?php echo esc_attr($flip_class); ?>">
					<div class="rt-flip-front">
						<div class="rt-flip-inner">
							<?php  if ( $data['post_grid_date'] == 'yes' ) { ?>
								<div class="date"><?php the_time( 'd.m.y' );?></div>
							<?php } ?>
							<h3 class="entry-title"><a href="<?php the_permalink();?>"><?php echo esc_html( $title );?></a></h3>
							<?php if ( $data['content_display'] == 'yes' ) { ?>
								<div class="content">
									<?php echo wp_kses_post( $content );?>
								</div>
							<?php } ?>
							<?php if($data['read_display']=='yes'){ ?>
								<div class="post-btn">
									<a href="<?php the_permalink(); ?>"><span><?php echo wp_kses_post($data['buttontext']); ?><svg width="21" height="12" viewBox="0 0 21 12" fill="none" xmlns="http://www.w3.org/2000/svg">
									<path fill-rule="evenodd" clip-rule="evenodd" d="M0 6C0 6.22729 0.087059 6.44527 0.242027 6.60598C0.396994 6.7667 0.607174 6.85699 0.82633 6.85699H18.1774L14.6292 10.5352C14.5523 10.6149 14.4914 10.7095 14.4498 10.8136C14.4082 10.9177 14.3868 11.0292 14.3868 11.1419C14.3868 11.2546 14.4082 11.3662 14.4498 11.4703C14.4914 11.5744 14.5523 11.669 14.6292 11.7487C14.706 11.8284 14.7972 11.8916 14.8976 11.9347C14.998 11.9778 15.1056 12 15.2142 12C15.3229 12 15.4304 11.9778 15.5308 11.9347C15.6312 11.8916 15.7224 11.8284 15.7992 11.7487L20.7572 6.60675C20.8342 6.52714 20.8952 6.43257 20.9369 6.32846C20.9786 6.22434 21 6.11272 21 6C21 5.88728 20.9786 5.77566 20.9369 5.67154C20.8952 5.56743 20.8342 5.47286 20.7572 5.39325L15.7992 0.251323C15.6441 0.0904038 15.4336 0 15.2142 0C14.9948 0 14.7843 0.0904038 14.6292 0.251323C14.474 0.412243 14.3868 0.630497 14.3868 0.858071C14.3868 1.08565 14.474 1.3039 14.6292 1.46482L18.1774 5.14301H0.82633C0.607174 5.14301 0.396994 5.2333 0.242027 5.39402C0.087059 5.55474 0 5.77271 0 6Z" fill="white"/>
									</svg></span></a>
								</div>
							<?php } ?>
						</div>
					</div>
					<div class="rt-flip-back" data-bg-image="<?php echo esc_attr( $thumbnail ); ?>">
						<div class="rt-flip-inner">
							<?php  if ( $data['post_grid_date'] == 'yes' ) { ?>
								<div class="date"><?php the_time( 'd.m.y' );?></div>
							<?php } ?>
							<h3 class="entry-title"><a href="<?php the_permalink();?>"><?php echo esc_html( $title );?></a></h3>
							<?php if ( $data['content_display'] == 'yes' ) { ?>
								<div class="content">
									<?php echo wp_kses_post( $content );?>
								</div>
							<?php } ?>
							<?php if($data['read_display']=='yes'){ ?>
								<div class="post-btn">
									<a href="<?php the_permalink(); ?>"><span><?php echo wp_kses_post($data['buttontext']); ?><svg width="21" height="12" viewBox="0 0 21 12" fill="none" xmlns="http://www.w3.org/2000/svg">
									<path fill-rule="evenodd" clip-rule="evenodd" d="M0 6C0 6.22729 0.087059 6.44527 0.242027 6.60598C0.396994 6.7667 0.607174 6.85699 0.82633 6.85699H18.1774L14.6292 10.5352C14.5523 10.6149 14.4914 10.7095 14.4498 10.8136C14.4082 10.9177 14.3868 11.0292 14.3868 11.1419C14.3868 11.2546 14.4082 11.3662 14.4498 11.4703C14.4914 11.5744 14.5523 11.669 14.6292 11.7487C14.706 11.8284 14.7972 11.8916 14.8976 11.9347C14.998 11.9778 15.1056 12 15.2142 12C15.3229 12 15.4304 11.9778 15.5308 11.9347C15.6312 11.8916 15.7224 11.8284 15.7992 11.7487L20.7572 6.60675C20.8342 6.52714 20.8952 6.43257 20.9369 6.32846C20.9786 6.22434 21 6.11272 21 6C21 5.88728 20.9786 5.77566 20.9369 5.67154C20.8952 5.56743 20.8342 5.47286 20.7572 5.39325L15.7992 0.251323C15.6441 0.0904038 15.4336 0 15.2142 0C14.9948 0 14.7843 0.0904038 14.6292 0.251323C14.474 0.412243 14.3868 0.630497 14.3868 0.858071C14.3868 1.08565 14.474 1.3039 14.6292 1.46482L18.1774 5.14301H0.82633C0.607174 5.14301 0.396994 5.2333 0.242027 5.39402C0.087059 5.55474 0 5.77271 0 6Z" fill="white"/>
									</svg></span></a>
								</div>
							<?php } ?>
						</div>
					</div>
					</div>
				</div>
		<?php $i++; $j = $j + 0.3; $k = $k + 0.2; endwhile;?>
	</div>
	<?php endif;?>
	<?php GymatTheme_Helper::wp_reset_temp_query( $temp );?>
</div>

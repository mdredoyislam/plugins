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

$thumb_size = 'gymat-size2';

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
<div class="post-default post-grid-style1">
	<div class="row auto-clear">
	<?php $i = 1;
	 $j = $data['delay']; $k = $data['duration'];
	 if ( $query->have_posts() ) :?>
		<?php while ( $query->have_posts() ) : $query->the_post();?>
			<?php
			$content = GymatTheme_Helper::get_current_post_content();
			$content = wp_trim_words( get_the_excerpt(), $data['count'], '' );
			$content = "<p>$content</p>";
			$title = wp_trim_words( get_the_title(), $data['title_count'], '' );
			
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
			<div class="<?php  echo esc_attr( $col_class );?>">
				<div class="post-grid-item <?php echo esc_attr($img_class);?> rt-animate <?php echo esc_attr( $data['animation'] );?> <?php echo esc_attr( $data['animation_effect'] );?>" data-wow-delay="<?php echo esc_attr( $j );?>s" data-wow-duration="<?php echo esc_attr( $k );?>s">
					<div class="post-thumbnail">
						<?php if ( has_post_thumbnail() ) { ?>
							<a href="<?php the_permalink(); ?>">
								<?php
									if ( has_post_thumbnail() ){
										the_post_thumbnail( $thumb_size );
									}
								?>
							</a>
						<?php } else {
										
							echo '<img class="wp-post-image" src="' . GymatTheme_Helper::get_img( 'noimage_560X570.jpg' ) . '" alt="'.get_the_title().'">';
										
						} ?>
						<?php if ($data['post_grid_date'] == 'yes'  ) { ?>			
							<div class="blog-date">
								<?php echo the_time('d'); ?>
								<span class="month"><?php echo the_time('M') ?></span>	
							</div>	
						<?php } ?>
						<div class="entry-content">
							<?php  if ( $data['post_grid_category'] == 'yes' ) { ?>
								<div class="blog-cat"><?php echo the_category( ' ' );?></div>
							<?php } ?>
							<h3 class="entry-title"><a href="<?php the_permalink();?>"><?php echo esc_html( $title );?></a></h3>
							<?php if ( $gymat_has_entry_meta ) { ?>
							<ul class="post-grid-meta">
								<?php  if ( $data['post_grid_author'] == 'yes' ) { ?>
								<li class="post-author"><?php esc_html_e( 'by ', 'gymat-core' );?><?php the_author_posts_link(); ?></li>
								<?php } ?>
								<?php  if ( $data['post_grid_comment'] == 'yes' ) { ?>
									<li class="post-comment"><a href="<?php echo get_comments_link( get_the_ID() ); ?>"><?php echo wp_kses_post( $gymat_comments_html );?></a></li>
								<?php } if ( $data['post_grid_view'] == 'yes' && function_exists( 'gymat_views' ) ) { ?>
									<li><span class="meta-views meta-item "><?php echo gymat_views(); ?></span></li>
								<?php } if ( $data['post_grid_read'] == 'yes' && function_exists( 'gymat_reading_time' ) ) { ?>
									<li class="meta-reading-time"><?php echo gymat_reading_time(); ?></li>
								<?php } ?>
							</ul>
							<?php } ?>
							<?php if ( $data['content_display'] == 'yes' ) { ?>
								<?php echo wp_kses_post( $content );?>
							<?php } ?>
						</div>
					</div>
				</div>
			</div>
		<?php $i++; $j = $j + 0.2;  endwhile;?>
	</div>
	<?php endif;?>
	<?php GymatTheme_Helper::wp_reset_temp_query( $temp );?>
</div>
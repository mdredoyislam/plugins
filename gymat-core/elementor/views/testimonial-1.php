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

$args = array(
	'post_type'      => 'gymat_testim',
	'posts_per_page' => $data['number'],
	'orderby'        => $data['orderby'],
);

if ( !empty( $data['cat'] ) ) {
	$args['tax_query'] = array(
		array(
			'taxonomy' => 'gymat_testimonial_category',
			'field' => 'term_id',
			'terms' => $data['cat'],
		)
	);
}

switch ( $data['orderby'] ) {
	case 'title':
	$args['order'] = 'ASC';
	break;
}
$query = new WP_Query( $args );
/**
 * swiper slider data
 */
if($data['slider_autoplay']=='yes'){
	$data['slider_autoplay']=true;
}
else{
	$data['slider_autoplay']=false;
}

$swiper_data = array(
	'slidesPerView' 	=>2,
	'loop'				=>$data['slider_loop']=='yes' ? true:false,
	'spaceBetween'		=>$data['space']['size'],
	'slidesPerGroup'	=>$data['slider_per_group']['size'],
	'centeredSlides'	=>$data['centered_slide']=='yes' ? true:false ,
	'slideToClickedSlide' =>true,
	'autoplay'				=>array(
		'delay'  => $data['autoplayspeed']['size'],
	),
	'speed'      =>$data['speed']['size'],
	'breakpoints' =>array(
		'0'    =>array('slidesPerView' =>1),
		'576'    =>array('slidesPerView' =>$data['item_mobile']['size']),
		'768'    =>array('slidesPerView' =>$data['item_tablet']['size']),
		'992'    =>array('slidesPerView' =>$data['medium_item']['size']),
		'1200'    =>array('slidesPerView' =>$data['item']['size']),				
		'1600'    =>array('slidesPerView' =>$data['item']['size'])
	),
	'auto'   =>$data['slider_autoplay']
);
$swiper_data = json_encode( $swiper_data );

?>
<div class="default-testimonial testimonial-<?php echo esc_attr( $data['style'] ); ?>">
	<div class="rt-related-slider" data-xld = '<?php echo esc_attr( $swiper_data );?>'>
		<div class="swiper-wrapper">
			<?php 
			if ( $query->have_posts() ) : ?>
				<?php while ( $query->have_posts() ) : $query->the_post(); ?>
					<?php
					$id 			= get_the_id();
					$designation 	= get_post_meta( $id, 'gymat_tes_designation', true );
					$content 		= GymatTheme_Helper::get_current_post_content();
					$content 		= wp_trim_words( $content, $data['count'], '' );
					$content 		= "<p>$content</p>";
					$ratting	 	= get_post_meta( $id, 'gymat_tes_rating', true );
					$rest_testimonial_rating = 5- intval( $ratting ) ;
					?>
						<div class="swiper-slide">
							<div class="testimonial-item">
								<div class="testimonial-content">
									<?php echo wp_kses_post( $content ); ?>
									<div class="testimonial-figure">
										<?php if ( $data['thumbs_display']  == 'yes' ) { ?>
											<?php if ( has_post_thumbnail() ) { ?>
												<div class="testimonial-thumb"><?php the_post_thumbnail( 'full' );?></div>
											<?php } ?>
											
										<?php } ?>
									</div>
									<?php if ( $data['ratting_display']  == 'yes' ) { ?>
										<ul class="rating">
											<?php for ($i=0; $i < $ratting; $i++) { ?>
												<li class="star-rate"><i class="fa fa-star" aria-hidden="true"></i></li>
											<?php } ?>			
											<?php for ($i=0; $i < $rest_testimonial_rating; $i++) { ?>
												<li><i class="fa fa-star" aria-hidden="true"></i></li>
											<?php } ?>
										</ul>
									<?php } ?>
									</div>
								<div class="testimonial-client-info">
									<div class="designation-area">
										<?php if ( $data['designation_display']  == 'yes' && $designation ) { ?>
											<div class="testimonial-designation"> <?php echo esc_html( $designation );?>
											</div>
										<?php } ?>
										<h3 class="testimonial-title"><?php the_title(); ?></h3>
									</div>
								</div>
								<div class="testimonial-qoute">
									<img width="206" height="173" src="<?php echo GYMAT_ASSETS_URL . 'element/shape-55.png'; ?>" alt="shape">
								</div>
							</div>
						</div>
				<?php endwhile; ?>
			<?php endif; ?>
			<?php wp_reset_query();?>
		</div>
        <?php if($data['navigation']=='yes'){ ?>
            <div class="swiper-button">
                <div class="swiper-button-prev swiper-button-arrow">
					<svg width="21" height="12" viewBox="0 0 21 12" fill="none" xmlns="http://www.w3.org/2000/svg">
						<path fill-rule="evenodd" clip-rule="evenodd" d="M21 6C21 6.22729 20.9129 6.44527 20.758 6.60598C20.603 6.7667 20.3928 6.85699 20.1737 6.85699H2.82257L6.37083 10.5352C6.44766 10.6149 6.50861 10.7095 6.55019 10.8136C6.59177 10.9177 6.61317 11.0292 6.61317 11.1419C6.61317 11.2546 6.59177 11.3662 6.55019 11.4703C6.50861 11.5744 6.44766 11.669 6.37083 11.7487C6.29401 11.8284 6.2028 11.8916 6.10242 11.9347C6.00203 11.9778 5.89444 12 5.78579 12C5.67714 12 5.56955 11.9778 5.46917 11.9347C5.36879 11.8916 5.27758 11.8284 5.20075 11.7487L0.242766 6.60675C0.165812 6.52714 0.104758 6.43257 0.0631004 6.32846C0.0214427 6.22434 0 6.11272 0 6C0 5.88728 0.0214427 5.77566 0.0631004 5.67154C0.104758 5.56743 0.165812 5.47286 0.242766 5.39325L5.20075 0.251323C5.35591 0.0904038 5.56636 0 5.78579 0C6.00523 0 6.21567 0.0904038 6.37083 0.251323C6.526 0.412243 6.61317 0.630497 6.61317 0.858071C6.61317 1.08565 6.526 1.3039 6.37083 1.46482L2.82257 5.14301H20.1737C20.3928 5.14301 20.603 5.2333 20.758 5.39402C20.9129 5.55474 21 5.77271 21 6Z" fill="#484848"/>
					</svg>
				</div>
                <div class="swiper-button-next swiper-button-arrow active">
					<svg width="21" height="12" viewBox="0 0 21 12" fill="none" xmlns="http://www.w3.org/2000/svg">
						<path fill-rule="evenodd" clip-rule="evenodd" d="M0 6C0 6.22729 0.087059 6.44527 0.242027 6.60598C0.396994 6.7667 0.607174 6.85699 0.82633 6.85699H18.1774L14.6292 10.5352C14.5523 10.6149 14.4914 10.7095 14.4498 10.8136C14.4082 10.9177 14.3868 11.0292 14.3868 11.1419C14.3868 11.2546 14.4082 11.3662 14.4498 11.4703C14.4914 11.5744 14.5523 11.669 14.6292 11.7487C14.706 11.8284 14.7972 11.8916 14.8976 11.9347C14.998 11.9778 15.1056 12 15.2142 12C15.3229 12 15.4304 11.9778 15.5308 11.9347C15.6312 11.8916 15.7224 11.8284 15.7992 11.7487L20.7572 6.60675C20.8342 6.52714 20.8952 6.43257 20.9369 6.32846C20.9786 6.22434 21 6.11272 21 6C21 5.88728 20.9786 5.77566 20.9369 5.67154C20.8952 5.56743 20.8342 5.47286 20.7572 5.39325L15.7992 0.251323C15.6441 0.0904038 15.4336 0 15.2142 0C14.9948 0 14.7843 0.0904038 14.6292 0.251323C14.474 0.412243 14.3868 0.630497 14.3868 0.858071C14.3868 1.08565 14.474 1.3039 14.6292 1.46482L18.1774 5.14301H0.82633C0.607174 5.14301 0.396994 5.2333 0.242027 5.39402C0.087059 5.55474 0 5.77271 0 6Z" fill="#484848"/>
					</svg>
				</div>
            </div>
        <?php } ?>
	</div>
</div>
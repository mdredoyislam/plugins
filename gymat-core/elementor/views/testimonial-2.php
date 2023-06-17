<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

namespace radiustheme\Gymat_Core;

use GymatTheme;
use Elementor\Group_Control_Image_Size;
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
$getimg = Group_Control_Image_Size::get_attachment_image_html( $data, 'icon_image_size', 'rt_image' );
?>
<div class="default-testimonial testimonial-multi-layout testimonial-<?php echo esc_attr($data['style']); ?>">
	<div class="container">
		<div class="row align-items-center">
			<div class="col-lg-7">
				<div class="testimonial-box-img">
					<div class="item-img">
						<?php if($getimg){
							echo wp_kses_post($getimg);
						} ?>
					</div>
				</div>
			</div>
			<div class="col-lg-5">
				<div class="testimonial-slider-wrapper">
					<div class="rt-related-slider testimonial-info" data-xld = '<?php echo esc_attr( $swiper_data );?>'>
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
												<div class="testimonial-content-wrapper">
													<?php if ( $data['thumbs_display']  == 'yes' ) { ?>
														<?php if ( has_post_thumbnail() ) { ?>
															<div class="testimonial-thumb"><?php the_post_thumbnail( 'thumbnail' );?></div>
														<?php } ?>
													<?php } ?>
													<div class="testimonial-content">
														<h3 class="testimonial-title"><?php the_title(); ?></h3>
														<div class="testimonial-designation">
															<?php if($data['designation_display']  == 'yes'){ ?>
																<span><?php echo esc_html( $designation );?></span>
															<?php } ?>
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
														
														<div class="testimonial-qoute">
															<img width="96" height="83" src="<?php echo GYMAT_ASSETS_URL . 'element/shape-3.png'; ?>" alt="shape">
														</div>
													</div>
												</div>
												<?php echo wp_kses_post( $content ); ?>
											</div>
										</div>
								<?php endwhile; ?>
							<?php endif; ?>
							<?php wp_reset_query();?>
						</div>
						<?php if($data['navigation']=='yes'){ ?>
                			<div class="swiper-pagination"></div>
        				<?php } ?>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

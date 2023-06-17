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

$prefix      = GYMAT_CORE_THEME_PREFIX;
$thumb_size  = 'gymat-size4';

if ( get_query_var('paged') ) {
	$paged = get_query_var('paged');
}
else if ( get_query_var('page') ) {
	$paged = get_query_var('page');
}
else {
	$paged = 1;
}

$args = array(
	'post_type'      => 'gymat_trainer',
	'posts_per_page' => $data['number'],
	'orderby'        => $data['orderby'],
	'paged'         => $paged,
    'post_status'   =>'publish'
);

if ( !empty( $data['cat'] ) ) {
	$args['tax_query'] = array(
		array(
			'taxonomy' => 'gymat_trainer_category',
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
<div class="trainer-default trainer-multi-layout-3 trainer-grid-<?php echo esc_attr( $data['style'] );?>">
	<div class="rt-related-slider" data-xld = '<?php echo esc_attr( $swiper_data )  ;?>'>
		<?php 
		$i = $data['delay']; $j = $data['duration'];
		 if ( $query->have_posts() ) { ?>
            <div class="swiper-wrapper">
                <?php while ( $query->have_posts() ) {
                $query->the_post();
                $id            	= get_the_id();
                $position   	= get_post_meta( $id, 'gymat_trainer_designation', true );
                $socials       	= get_post_meta( $id, 'gymat_trainer_socials', true );
                $social_fields 	= GymatTheme_Helper::trainer_socials();
                $content = apply_filters( 'the_content', get_the_content() );
                $content = wp_trim_words( $content, $data['count'], '' );
                $content = "<p>$content</p>";
		?>
                <div class="swiper-slide">
                    <div class="trainer-item rt-animate <?php echo esc_attr( $data['animation'] );?> <?php echo esc_attr( $data['animation_effect'] );?>" data-wow-delay="<?php echo esc_attr( $i );?>s" data-wow-duration="<?php echo esc_attr( $j );?>s">
                        <div class="trainer-content-wrap">
                            <div class="trainer-thumb">
                                <figure>
                                    <a href="<?php the_permalink();?>">
                                    <?php
                                    if ( has_post_thumbnail() ){
                                        the_post_thumbnail( $thumb_size );
                                    }
                                    else {
                                        if ( !empty( GymatTheme::$options['no_preview_image']['id'] ) ) {
                                            echo wp_get_attachment_image( GymatTheme::$options['no_preview_image']['id'], $thumb_size );
                                        }
                                        else {
                                            echo '<img class="wp-post-image" src="' . GymatTheme_Helper::get_img( 'noimage_400X400.jpg' ) . '" alt="'.get_the_title().'">';
                                        }
                                    }
                                    ?>
                                    </a>
                                </figure>
                            </div>
                            <div class="trainer-content">
                                <div class="trainer-info">
                                    <h3 class="trainer-title"><a href="<?php the_permalink();?>"><?php the_title();?></a></h3>
                                    <?php if ( $position && $data['designation_display']  == 'yes' ) { ?>
                                        <div class="trainer-designation"><?php echo esc_html( $position );?></div>
                                    <?php } ?>
                                </div>
                                <?php if ( !empty( $socials ) && $data['social_display']  == 'yes' ) { ?>
                                    <div class="trainer-social">
                                        <ul>
                                            <li>
                                                <a href="#" class="share-icon"><i class="fas fa-share-alt"></i></a>
                                                <ul class="trainer-multi-social-icon">
                                                    <?php foreach ( $socials as $key => $social ): ?>
                                                        <?php if ( !empty( $social ) ): ?>
                                                            <li><a target="_blank" href="<?php echo esc_url( $social );?>"><i class="fab <?php echo esc_attr( $social_fields[$key]['icon'] );?>" aria-hidden="true"></i></a>
                                                            </li>
                                                        <?php endif; ?>
                                                    <?php endforeach; ?>
                                                </ul>
                                            </li>
                                        </ul> 
                                    </div>   
                                <?php } ?>
                            </div>
                        </div>
                    </div>	
                </div>
                <?php $i = $i + 0.2; } ?>
            </div>
            <?php  if($data['slider_pagination']=='yes'){  ?>
                    <div class="swiper-pagination"></div>
            <?php } ?>
		<?php } ?>
	</div>
	<?php GymatTheme_Helper::wp_reset_temp_query( $temp ); ?>
</div>
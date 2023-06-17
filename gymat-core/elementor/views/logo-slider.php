<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

namespace radiustheme\Gymat_Core;

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
	'slideToClickedSlide' =>true,
	'autoplay'				=>array(
		'delay'  => $data['autoplayspeed']['size'],
	),
	'speed'      =>$data['speed']['size'],
	'breakpoints' =>array(
		'0'    =>array('slidesPerView' =>$data['item_mobile']['size']),
		'576'    =>array('slidesPerView' =>$data['item_mobile']['size']),
		'768'    =>array('slidesPerView' =>$data['item_tablet']['size']),
		'992'    =>array('slidesPerView' =>$data['medium_item']['size']),
		'1200'    =>array('slidesPerView' =>$data['item']['size']),				
		'1600'    =>array('slidesPerView' =>$data['item']['size'])
	),
	'auto'   =>$data['slider_autoplay']
);
$swiper_data = json_encode( $swiper_data );
if($data['logos_gray_scale']=='yes'){
	$logos_gray='has-gray';
}else{
	$logos_gray='no-gray';
}

?>
<div class="logo-slider logo-brand">
	<div class="rt-related-slider" data-xld = '<?php echo esc_attr( $swiper_data )  ;?>'>
		<div class="swiper-wrapper">
			<?php foreach ( $data['logos'] as $logo ): ?>
				<?php if ( empty( $logo['image']['id'] ) ) continue; ?>
				<div class="swiper-slide">
					<div class="logo-item <?php echo esc_attr($logos_gray); ?>">
						<?php if ( !empty( $logo['url'] ) ): ?>
							<a href="<?php echo esc_url( $logo['url'] );?>" target="_blank"><?php echo wp_get_attachment_image( $logo['image']['id'], 'full' )?></a>
						<?php else: ?>
							<?php echo wp_get_attachment_image( $logo['image']['id'], 'full' )?>
						<?php endif; ?>
					</div>
				</div>
			<?php endforeach; ?>                      
		</div>
	</div>
	
</div>
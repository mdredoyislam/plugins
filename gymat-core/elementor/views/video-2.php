<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

namespace radiustheme\Gymat_Core;
use GymatTheme_Helper;
use Elementor\Group_Control_Image_Size;

//title url


// image
$getimg = Group_Control_Image_Size::get_attachment_image_html( $data, 'icon_image_size', 'video_image' );

$shape='';
if($data['shape_display']=='yes'){
	$shape='has-shape';
}


?>
<div class="rt-video video-<?php echo esc_attr( $data['style'] );?>">
    <div class="rt-video-img <?php echo esc_attr($shape); ?>">
		<?php echo wp_kses_post($getimg);?>
		<div class="play-button">
			<a href="<?php echo esc_url($data['videourl']['url'] );?>" class="play-btn rt-video-popup">
				<i class="fas fa-play"></i>
			</a>
		</div>
	</div>
</div>
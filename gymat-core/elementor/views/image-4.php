<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

namespace radiustheme\Gymat_Core;

use GymatTheme_Helper;
use Elementor\Utils;
use Elementor\Group_Control_Image_Size;
extract($data);

$attr = '';
if ( !empty( $data['url']['url'] ) ) {
	$attr  = 'href="' . $data['url']['url'] . '"';
	$attr .= !empty( $data['url']['is_external'] ) ? ' target="_blank"' : '';
	$attr .= !empty( $data['url']['nofollow'] ) ? ' rel="nofollow"' : '';
	
}
//image
if ( $attr ) {
  $getimg = '<a ' . $attr . '>' .Group_Control_Image_Size::get_attachment_image_html( $data, 'icon_image_size' , 'rt_image' ).'</a>';
}
else {
	$getimg = Group_Control_Image_Size::get_attachment_image_html( $data, 'icon_image_size', 'rt_image' );
}


?>

<div class="image-default image-<?php echo esc_attr( $data['style'] );?>">
	<div class="image-box wow  fadeInUp rt-animate" data-wow-delay="400ms" data-wow-duration="1200ms">
		<div class="item-element wow fadeInUp rt-animate" data-wow-delay="400ms" data-wow-duration="1200ms">
		</div>
		<div class="item-image wow fadeInLeft rt-animate" data-wow-delay="600ms" data-wow-duration="1200ms">
			<?php echo wp_kses_post($getimg);?>
			<div class="image-shape-element">
				<ul class="d-none d-xl-block">
					<li><img width="344" height="236" src="<?php echo GYMAT_ASSETS_URL . 'element/shape-96.png'; ?>" alt="shape"></li>
					<li class="motion-effects1">
						<img width="155" height="150" src="<?php echo GYMAT_ASSETS_URL . 'element/shape-97.png'; ?>" alt="shape" >
					</li>
				</ul>
			</div>
		</div>
	</div>
</div>
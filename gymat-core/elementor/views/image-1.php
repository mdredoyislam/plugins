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

<div class="image-default image-<?php echo esc_attr( $data['style'] );?> ">
	<div class="image-box">
		<?php echo wp_kses_post($getimg);?>
		<div class="image-shape-element">
			<ul class="d-none d-xl-block">
				<li class="motion-effects1">
					<img width="122" height="124" src="<?php echo GYMAT_ASSETS_URL . 'element/shape-26.png'; ?>" alt="shape">
				</li>
				<li class="motion-effects3">
					<img width="346" height="184" src="<?php echo GYMAT_ASSETS_URL . 'element/shape-27.png'; ?>" alt="shape">
				</li>
			</ul>
		</div>
		<div class="image-shape-element-2">
			<ul>
				<li>
					<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" preserveAspectRatio="xMidYMid" width="267" height="545" viewBox="0 0 267 545">
						<path d="M-0.005,32.272 L267.000,-0.012 L267.000,544.999 L-0.005,464.999 L-0.005,32.272 Z" class="cls-2"></path>
					</svg>
				</li>
				<li>
					<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" preserveAspectRatio="xMidYMid" width="267" height="530.87" viewBox="0 0 267 530.87">
						<path d="M-0.005,67.273 L267.000,-0.009 L267.000,530.878 L-0.005,435.279 L-0.005,67.273 Z" class="cls-3"></path>
					</svg>													  
				</li>
			</ul>
		</div>
	</div>
</div>
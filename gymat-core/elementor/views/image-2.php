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

$js_tilt='js-tilt';

?>

<div class="image-default image-<?php echo esc_attr( $data['style'] );?> ">
	<div class="image-box wow fadeInRight rt-animate" data-wow-delay="400ms" data-wow-duration="1200ms">
		<div class="item-image <?php echo esc_attr( $js_tilt); ?>">
			<?php echo wp_kses_post($getimg);?>
		</div>
		<div class="image-shape-element">
			<ul class="d-none d-xl-block">
				<li></li>
				<li class="motion-effects1"><img width="114" height="47" src="<?php echo GYMAT_ASSETS_URL . 'element/shape-84.png'; ?>" alt="shape"></li>
				<li class="motion-effects1"><img width="96" height="100" src="<?php echo GYMAT_ASSETS_URL . 'element/shape-85.png'; ?>" alt="shape" ></li>
				<li><img width="81" height="565" src="<?php echo GYMAT_ASSETS_URL . 'element/shape-86.png'; ?>" alt="shape"></li>
			</ul>
		</div>
	</div>
</div>
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
	<div class="image-box wow fadeInLeft rt-animate" data-wow-delay="400ms" data-wow-duration="1200ms">
		<div class="item-image  <?php echo esc_attr( $js_tilt); ?>">
			<?php echo wp_kses_post($getimg);?>
		</div>
		<div class="image-shape-element">
			<ul class="d-none d-xl-block">
				<li>
					<svg width="278" height="576" viewBox="0 0 278 576" fill="none" xmlns="http://www.w3.org/2000/svg">
					   <path d="M278 -1.21518e-05L278 576C124.204 576 -5.64329e-06 446.897 -1.25889e-05 288C-1.95345e-05 129.103 124.204 -5.42913e-06 278 -1.21518e-05Z" fill="#FF0336"/>
					</svg>
			    </li>
				<li class="motion-effects1"><img width="84" height="76" src="<?php echo GYMAT_ASSETS_URL . 'element/shape-102.png'; ?>" alt="shape"></li>
				<li>
					<img  width="81" height="576" src="<?php echo GYMAT_ASSETS_URL . 'element/shape-86.png'; ?>" alt="shape" >
				</li>
				<li class="motion-effects3">
					<img width="95" height="53" src="<?php echo GYMAT_ASSETS_URL . 'element/shape-104.png'; ?>" alt="shape" >
				</li>
			</ul>
		</div>
	</div>
</div>
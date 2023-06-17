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

//thumb image

$get_thumb_img1=Group_Control_Image_Size::get_attachment_image_html( $data, 'thumb_image_size' , 'rt_image_2' );
$get_thumb_img2=Group_Control_Image_Size::get_attachment_image_html( $data, 'thumb_image_size' , 'rt_image_3' );

?>

<div class="image-default image-<?php echo esc_attr( $data['style'] );?>">
	<div class="image-box"> 
			<?php echo wp_kses_post($getimg);?>
	</div>
    <ul class="thumb-image">
        <li class="wow">
        <?php echo wp_kses_post($get_thumb_img1);?>
        </li>
        <li class="wow">
        <?php echo wp_kses_post($get_thumb_img2);?>
        </li>
    </ul>
   
</div>
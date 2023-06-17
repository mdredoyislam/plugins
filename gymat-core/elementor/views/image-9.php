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

<div class="image-default image-<?php echo esc_attr( $data['style'] );?> motion-effects-wrap">
    <ul class="shape-element">
        <li class="motion-effects3">
            <svg width="360" height="281" viewBox="0 0 360 281" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M167.759 280.008C163.083 280.008 158.417 280.008 153.74 280.008C152.669 278.992 151.287 279.043 149.976 278.982C138.28 278.48 126.925 276.107 115.721 272.889C44.0171 252.348 -7.11977 182.912 0.810595 107.171C2.75313 88.5704 11.1141 82.2863 29.2778 86.9416C42.8856 90.4305 55.1716 97.2977 67.718 103.411C89.3964 113.978 111.075 124.576 134.666 130.317C148.764 133.745 163.003 136.198 177.642 134.268C194.414 132.056 208.993 124.545 222.781 115.335C248.084 98.4238 269.101 76.7061 289.898 54.7672C303.907 39.9972 317.264 24.5937 332.334 10.8492C336.399 7.13911 340.605 3.54965 345.701 1.28739C351.99 -1.50775 355.995 0.241727 357.747 6.87769C358.838 11 359.269 15.3033 360 19.5262C360 20.8635 360 22.2007 360 23.538C359.67 25.4885 359.109 27.4391 359.039 29.3997C358.608 41.0931 356.435 52.515 353.151 63.6755C332.835 132.79 296.557 192.172 243.708 241.127C225.614 257.888 205.178 271.18 180.806 277.424C176.49 278.53 171.894 278.097 167.759 280.008Z" fill="#FF0537"/>
            </svg>
        </li>
    </ul>
	<div class="image-box">
		<?php echo wp_kses_post($getimg);?>
	</div>
</div>
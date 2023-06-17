<?php 
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
    <div class="image-box motion-effects-wrap">
        <div class="rt-about-layout">
            <div class="item-shape wow fadeInLeft rt-animate" data-wow-delay="1.2s" data-wow-duration="1.5s"><img width="445" height="622" src="<?php echo GYMAT_ASSETS_URL . 'element/about-14.svg'; ?>" alt="shape"></div>
            <div class="img-inner">
                <div class="item-img wow fadeInUp rt-animate" data-wow-delay="1.2s" data-wow-duration="1.5s">
                    <?php echo wp_kses_post($getimg);?>
                    <div class="item-rt-shape">
                        <ul>
                            <li><h3 class="strok-text"><?php echo wp_kses_post($data['since_title']); ?></h3></li>
                            <li class="motion-effects1"><img width="84" height="76" src="<?php echo GYMAT_ASSETS_URL . 'element/shape-116.png'; ?>" alt="shape" ></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>    
</div>
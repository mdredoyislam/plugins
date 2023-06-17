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
if ( !empty( $data['buttontext'] ) ) {
	
	$btn = '<a class="btn-style1" ' . $attr . '>' .'<span>'. $data['buttontext'] . '<i class="fas fa-arrow-right"></i>' . '</span>'.'</a>';
	
}
//title url

$title_attr = '';
if ( !empty( $data['title_url']['url'] ) ) {
	$title_attr  = 'href="' . $data['title_url']['url'] . '"';
	$title_attr .= !empty( $data['title_url']['is_external'] ) ? ' target="_blank"' : '';
	$title_attr .= !empty( $data['title_url']['nofollow'] ) ? ' rel="nofollow"' : '';
	$title = '<a ' . $title_attr . '>' . $data['title'] . '</a>';
	
}
else {
	$title = $data['title'];
}

$shape_image =  Group_Control_Image_Size::get_attachment_image_html( $data, 'shape_image_size' , 'shape_image' );
$get_image =  Group_Control_Image_Size::get_attachment_image_html( $data, 'info_bg_image_size' , 'info_bg_image' );
?>
<div class="woocommerce-info-box">
    <div class="info-item">
        <div class="info-inner">
            <div class="info-content">
                <div class="woo-info-subtitle"><?php echo esc_html($data['sub_title']); ?></div>
                <h3 class="woo-info-title"><?php echo esc_html($data['title']); ?></h3>
                <div class="woo-discount"><?php echo wp_kses_post($data['content']); ?></div>
                <?php if($data['button_display']=='yes'){ ?>
                    <div class="woo-item-button">
                        <?php echo wp_kses_post($btn); ?>
                    </div>
                <?php } ?>
            </div>
            <?php if($shape_image){?>
                <div class="gmat-shape"><?php echo wp_kses_post($shape_image); ?></div>
            <? } ?>
        </div>
        <?php if($get_image){?>
            <div class="banner-img"><?php echo wp_kses_post($get_image); ?></div>
        <?php }?> 
    </div>
</div>

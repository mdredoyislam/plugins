<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */
namespace radiustheme\Gymat_Core;
use GymatTheme_Helper;
use Elementor\Group_Control_Image_Size;
use Elementor\Utils;
extract($data);
$img=Group_Control_Image_Size::get_attachment_image_html( $data, 'icon_image_size' , 'rt_image');
?>
<div class="rt-discount-banner-addon <?php echo esc_attr( $data['style'] ); ?>">
    <div class="inner-banner">
        <div class="saving-part">
            <div class="save"><?php echo wp_kses_post($data['content']); ?></div>
            <div class="discount"><?php echo wp_kses_post($data['day_off']); ?></div>
        </div>
        <div class="title-part">
            <span class="banner-subtitle"><?php echo esc_html($data['sub_title']); ?></span>
            <h3 class="title"><?php echo esc_html($data['title']); ?></h3>
            <?php if($data['shape_display']=='yes'){?>
                <div class="shape"><img src="<?php echo GYMAT_ASSETS_URL . 'img/banner-6-shape.svg'; ?>" alt="banner"></div>
            <?php } ?>
        </div>
    </div>
    <?php if($img){ ?>
        <div class="item-img"><?php echo wp_kses_post($img); ?></div>
    <?php } ?>
</div>
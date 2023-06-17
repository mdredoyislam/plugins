<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

namespace radiustheme\Gymat_Core;
use Elementor\Utils;
use Elementor\Group_Control_Image_Size;
extract($data);
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

// icon , image

//image
$class_img = Group_Control_Image_Size::get_attachment_image_html( $data, 'class_bg_image_size', 'class_bg_image' );

// icon 
$getimg = Group_Control_Image_Size::get_attachment_image_html( $data, 'icon_image_size' , 'icon_image' );


$final_icon_class       = "flaticon-heart";
$final_icon_image_url   = '';
if ( is_string( $icon_class['value'] ) && $dynamic_icon_class =  $icon_class['value']  ) {
  $final_icon_class     = $dynamic_icon_class;
}
if ( is_array( $icon_class['value'] ) ) {
  $final_icon_image_url = $icon_class['value']['url'];
}

?>
<div class="class-default class-multilayout-3 class-manual-layout2 class-manual-<?php echo esc_attr( $data['style'] );?>">
    <div class="class-item">
        <div class="class-thumbnail">   
            <?php echo wp_kses_post($class_img);?>
                <div class="class-content">
                    <?php if ( !empty( $data['title'] ) ) { ?>
                        <h3 class="class-title"><?php echo wp_kses_post( $title );?></h3>
                    <?php }  ?>
                    <?php if($data['start_time'] || $data['end_time'] || $data['weekday'] ){ 
                           $time=$data['start_time'];
                           $time .=" - ".$data['end_time'];  
                        ?>
                         <div class="schedule">
                             <span class="day"><?php echo wp_kses_post($data['weekday']); ?>:</span>
                             <span class="time"><?php echo wp_kses_post($time); ?></span>
                        </div>
                    <?php } ?>   
                </div>
                <?php if($data['icon_display']=='yes'){ ?>
                    <div class="class-media">
                        <?php if ( !empty( $data['icontype']== 'image' ) ) { ?>		            
                            <div class="class-img">
                                <?php echo wp_kses_post($getimg);?>
                            </div>  
                        <?php } else {?> 	
                        <?php if ( $final_icon_image_url ): ?>
                            <div class="class-icon">
                                <img src="<?php echo esc_url( $final_icon_image_url ); ?>" alt="SVG Icon">
                            </div>
                        <?php else: ?>
                            <div class="class-icon">
                                <i class="<?php  echo esc_attr( $final_icon_class ); ?>"></i>
                            </div>
                        <?php endif; ?>
                        <?php }  ?>	
                    </div>
                <?php } ?>
        </div>  
    </div>	
</div>
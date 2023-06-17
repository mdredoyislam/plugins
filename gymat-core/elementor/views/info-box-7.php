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

if ( !empty( $data['buttontext'] ) ) {
	
	$btn = '<a class="button" ' . $attr . '>' . $data['buttontext'] . '<i class="fas fa-arrow-right"></i>' . '</a>';
	
}

// icon , image
if ( $attr ) {
  $getimg = '<a ' . $attr . '>' .Group_Control_Image_Size::get_attachment_image_html( $data, 'icon_image_size' , 'icon_image' ).'</a>';
}
else {
	$getimg = Group_Control_Image_Size::get_attachment_image_html( $data, 'icon_image_size', 'icon_image' );
}

$final_icon_class       = "flaticon-heart";
$final_icon_image_url   = '';
if ( is_string( $icon_class['value'] ) && $dynamic_icon_class =  $icon_class['value']  ) {
  $final_icon_class     = $dynamic_icon_class;
}
if ( is_array( $icon_class['value'] ) ) {
  $final_icon_image_url = $icon_class['value']['url'];
}
$has_border=$data['border_right']=='show' ? 'has-border':'no-border';
?>
<div class="info-box multi-infobox multi-infobox-3 info-<?php echo esc_attr( $data['style'] );?>">
	<div class="info-item  media-<?php echo esc_attr( $data['icontype']." ".$has_border );?>">
		<div class="info-media">
			<?php if ( !empty( $data['icontype']== 'image' ) ) { ?>		            
				<span class="info-img"><?php echo wp_kses_post($getimg);?></span>  
			<?php }else{?> 	
			<?php if ( $final_icon_image_url ): ?>
				<span class="info-icon"><img  src="<?php echo esc_url( $final_icon_image_url ); ?>" alt="SVG Icon"></span>
			<?php else: ?>
				<span class="info-icon"><i class="<?php  echo esc_attr( $final_icon_class ); ?>"></i></span>
			<?php endif ?>
			<?php }  ?>	
		</div>
		<div class="info-content media-body">
			<?php if ( !empty( $data['title'] ) ) { ?>
				<h3 class="info-title"><?php echo wp_kses_post( $title );?></h3>
			<?php } ?>
			<?php  if ( !empty( $data['content'] ) ) { ?>
				<div class="info-text"><?php echo wp_kses_post( $data['content'] ); ?></div>
			<?php } ?>
			<?php if ( $data['button_display']  == 'yes' ) { ?>
			<?php if ( !empty( $btn ) ){ ?>
				<div class="info-button"><?php echo wp_kses_post( $btn );?></div>		
			<?php } } ?>
		</div>
	</div>
</div>
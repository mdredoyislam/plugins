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

$attr = '';
if ( !empty( $data['url']['url'] ) ) {
	$attr  = 'href="' . $data['url']['url'] . '"';
	$attr .= !empty( $data['url']['is_external'] ) ? ' target="_blank"' : '';
	$attr .= !empty( $data['url']['nofollow'] ) ? ' rel="nofollow"' : '';
}
//Icon, image
if ( $attr ) {
  $getimg = '<a ' . $attr . '>' .Group_Control_Image_Size::get_attachment_image_html( $data, 'icon_image_size' , 'icon_image' ).'</a>';
}
else {
	$getimg = Group_Control_Image_Size::get_attachment_image_html( $data, 'icon_image_size', 'icon_image' );
}
$final_icon_class       = "";
$final_icon_image_url   = '';
if ( is_string( $icon_class['value'] ) && $dynamic_icon_class =  $icon_class['value']  ) {
  $final_icon_class     = $dynamic_icon_class;
}
if ( is_array( $icon_class['value'] ) ) {
  $final_icon_image_url = $icon_class['value']['url'];
}

?>
<div class="sec-title <?php echo esc_attr( $data['style'] ); ?>">
	<div class="sec-title-holder">
		<?php if ( !empty( $data['icontype']== 'image' ) ) { ?>		            
			<span class="rtin-img"><?php echo wp_kses_post($getimg);?></span>  
		<?php }else{?> 	
		<?php if ( $final_icon_image_url ): ?>
			<span class="rtin-icon"><img src="<?php echo esc_url( $final_icon_image_url ); ?>" alt="SVG Icon"></span>
		<?php else: ?>
			<span class="rtin-icon"><i class="<?php  echo esc_attr( $final_icon_class ); ?>"></i></span>
		<?php endif ?>
		<?php }  ?>
		<h2 class="rtin-title"><?php echo wp_kses_post( $data['title'] ); ?></h2>
		<?php if( !empty ( $data['content'] ) ) { ?>
		<div class="content"><?php echo wp_kses_post( $data['content'] ); ?></div>
		<?php } ?>
	</div>
</div>

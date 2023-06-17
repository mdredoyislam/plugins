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

$svg='<svg width="21" height="12" viewBox="0 0 21 12" fill="none" xmlns="http://www.w3.org/2000/svg">
<path fill-rule="evenodd" clip-rule="evenodd" d="M0 6C0 6.22729 0.087059 6.44527 0.242027 6.60598C0.396994 6.7667 0.607174 6.85699 0.82633 6.85699H18.1774L14.6292 10.5352C14.5523 10.6149 14.4914 10.7095 14.4498 10.8136C14.4082 10.9177 14.3868 11.0292 14.3868 11.1419C14.3868 11.2546 14.4082 11.3662 14.4498 11.4703C14.4914 11.5744 14.5523 11.669 14.6292 11.7487C14.706 11.8284 14.7972 11.8916 14.8976 11.9347C14.998 11.9778 15.1056 12 15.2142 12C15.3229 12 15.4304 11.9778 15.5308 11.9347C15.6312 11.8916 15.7224 11.8284 15.7992 11.7487L20.7572 6.60675C20.8342 6.52714 20.8952 6.43257 20.9369 6.32846C20.9786 6.22434 21 6.11272 21 6C21 5.88728 20.9786 5.77566 20.9369 5.67154C20.8952 5.56743 20.8342 5.47286 20.7572 5.39325L15.7992 0.251323C15.6441 0.0904038 15.4336 0 15.2142 0C14.9948 0 14.7843 0.0904038 14.6292 0.251323C14.474 0.412243 14.3868 0.630497 14.3868 0.858071C14.3868 1.08565 14.474 1.3039 14.6292 1.46482L18.1774 5.14301H0.82633C0.607174 5.14301 0.396994 5.2333 0.242027 5.39402C0.087059 5.55474 0 5.77271 0 6Z" fill="white"/>
</svg>';

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
	$btn = '<a class="btn-style1" ' . $attr . '>'.'<span>' . $data['buttontext'] . $svg . '</span>'.'</a>';
}

//get bg image

$get_bg_img = Group_Control_Image_Size::get_attachment_image_html( $data, 'info_bg_image_size', 'info_bg_image' );
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

?>
<div class="info-box  info-<?php echo esc_attr( $data['style'] );?>">
	<div class="info-item  media-<?php echo esc_attr( $data['icontype'] );?>">
        <div class="info-bg">
			<?php if ( $getimg) { ?>		            
				<?php echo wp_kses_post($get_bg_img);?>  
			<?php } ?> 
		</div>
		<div class="info-content">
            <?php if ( !empty( $data['icontype']== 'image' ) ) { ?>		            
				<div class="info-icon-img"><?php echo wp_kses_post($getimg);?></div>  
			<?php }else{?> 	
			<?php if ( $final_icon_image_url ): ?>
				<div class="info-icon"><img src="<?php echo esc_url( $final_icon_image_url ); ?>" alt="SVG Icon"></div>
			<?php else: ?>
				<div class="info-icon"><i class="<?php  echo esc_attr( $final_icon_class ); ?>"></i></div>
			<?php endif ?>
			<?php }  ?>	
			<?php if ( !empty( $data['title'] ) ) { ?>
				<h3 class="info-title"><?php echo wp_kses_post( $title );?></h3>
			<?php } ?>
			<?php  if ( !empty( $data['content'] ) ) { ?>
				<div class="info-text"><?php echo wp_kses_post( $data['content'] ); ?></div>
			<?php } ?>
		</div>
		<div class="info-hover-content">
			<?php if ( !empty( $data['icontype']== 'image' ) ) { ?>		            
				<div class="info-icon-img"><?php echo wp_kses_post($getimg);?></div>  
			<?php }else{?> 	
			<?php if ( $final_icon_image_url ): ?>
				<div class="info-icon"><img src="<?php echo esc_url( $final_icon_image_url ); ?>" alt="SVG Icon"></div>
			<?php else: ?>
				<div class="info-icon"><i class="<?php  echo esc_attr( $final_icon_class ); ?>"></i></div>
			<?php endif ?>
			<?php }  ?>
			<?php if ( !empty( $data['title'] ) ) { ?>
				<h3 class="info-title"><?php echo wp_kses_post( $title );?></h3>
			<?php } ?>
			<?php if ( $data['button_display']  == 'yes' ) { ?>
			    <?php if ( !empty( $btn ) ){ ?>
				    <div class="info-button"><?php echo wp_kses_post( $btn );?></div>		
			<?php } } ?>
		</div>
	</div>
</div>
<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

namespace radiustheme\Gymat_Core;
use Elementor\Utils;
extract($data);

$final_icon_class       = "flaticon-heart";
$final_icon_image_url   = '';
if ( is_string( $icon_class['value'] ) && $dynamic_icon_class =  $icon_class['value']  ) {
  $final_icon_class     = $dynamic_icon_class;
}
if ( is_array( $icon_class['value'] ) ) {
  $final_icon_image_url = $icon_class['value']['url'];
}
$border_right= $data['border_right'] ? 'has-border':'no-border';

?>

<div class="counter-appear counter-default counter-<?php echo esc_attr( $data['style'] );?> rtin-<?php echo esc_attr( $data['iconalign'] );?> <?php echo esc_attr($border_right); ?>">
    <div class="success-count-wrap">
        <div class="counter-media">
			<?php if ( $final_icon_image_url ): ?>
				<div class="icon"><img src="<?php echo esc_url( $final_icon_image_url ); ?>" alt="SVG Icon"></div>
			<?php else: ?>
				<div class="icon"><i class="<?php  echo esc_attr( $final_icon_class ); ?>"></i></div>
			<?php endif ?>
		</div>
        
        <div class="count">
            <h3 class="counterUp" data-duration=<?php echo esc_attr( $data['speed'] ); ?> data-counter="<?php echo esc_attr( $data['number'] );?>"><?php echo esc_html( $data['number'] );?></h3>
            <div class="count-plus">+</div>
        </div>
        
        <div class="count-title">
            <h4><?php echo wp_kses_post($data['title'] );?></h4>
        </div>
    </div>
</div>
<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

namespace radiustheme\Gymat_Core;
extract($data);

$final_icon_class       = " fas fa-thumbs-up";
$final_icon_image_url   = '';
if ( is_string( $icon_class['value'] ) && $dynamic_icon_class =  $icon_class['value']  ) {
  $final_icon_class     = $dynamic_icon_class;
}
if ( is_array( $icon_class['value'] ) ) {
	$final_icon_image_url = $icon_class['value']['url'];
  }
$attr = '';
if ( empty( $data['buttonurl']['url'] ) ) {
	$data['buttonurl']['url']="#";
}

$attr .= !empty( $data['buttonurl']['is_external'] ) ? ' target="_blank"' : '';
$attr .= !empty( $data['buttonurl']['nofollow'] ) ? ' rel="nofollow"' : '';

?>
<div class="rt-button rt-button-<?php echo esc_attr( $data['style'] ); ?>">
	<?php if( !empty( $data['buttontext'] ) ) { ?>
		<a class="btn-style2 <?php echo esc_attr( $data['icon_position'] ); ?>" <?php echo esc_attr($attr); ?> href="<?php echo esc_url( $data['buttonurl']['url'] );?>"><span>
            <?php if($data['icon_position'] == 'icon-left') { ?>
				<?php if ( $final_icon_image_url ): ?>
					<img width="21" height="12" src="<?php echo esc_url( $final_icon_image_url ); ?>" alt="SVG Icon">
			    <?php else: ?>
					<i class="<?php  echo esc_attr( $final_icon_class ); ?>"></i>
				<?php endif; ?>		
			<?php } ?>

            <?php echo esc_html( $data['buttontext'] );?>

            <?php if($data['icon_position'] == 'icon-right') { ?>
				<?php if ( $final_icon_image_url ): ?>
					<img width="21" height="12" src="<?php echo esc_url( $final_icon_image_url ); ?>" alt="SVG Icon">
			    <?php else: ?>
					<i class="<?php  echo esc_attr( $final_icon_class ); ?>"></i>
				<?php endif; ?>
			<?php } ?>
			</span>
      	</a>
	<?php } ?>
</div>
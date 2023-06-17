<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

namespace radiustheme\Gymat_Core;


$lg_item=$data['col_lg'];
$md_item=$data['col_md'];
$sm_item=$data['col_sm'];
$mobile_item=$data['col_mobile'];

$col_class = "row-cols-lg-{$lg_item} row-cols-md-{$md_item} row-cols-sm-{$sm_item} row-cols-{$mobile_item}";
if($data['logos_gray_scale']=='yes'){
	$logos_gray='has-gray';
}else{
	$logos_gray='no-gray';
}
?>
<div class="logo-grid logo-brand">
	<div class="row no-gutters <?php echo esc_attr( $col_class ); ?>">
		<?php foreach ( $data['logos'] as $logo ): ?>
			<?php if ( empty( $logo['image']['id'] ) ) continue; ?>
			<div class="col">
				<div class="logo-item <?php echo esc_attr($logos_gray); ?>">
				<figure>
				<?php if ( !empty( $logo['url'] ) ): ?>
					<a href="<?php echo esc_url( $logo['url'] );?>" target="_blank"><?php echo wp_get_attachment_image( $logo['image']['id'], 'full' )?></a>
				<?php else: ?>
					<?php echo wp_get_attachment_image( $logo['image']['id'], 'full' )?>
				<?php endif; ?>
				</figure>
				</div>
			</div>
		<?php endforeach; ?> 
	</div>
</div>
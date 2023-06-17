<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

namespace radiustheme\Gymat_Core;
extract($data);

?>

<div class="contact-info-default info-<?php echo esc_attr( $data['style'] ); ?>">
	<div class="contact-info">
		<div class="contact-address">
			<h3 class="contact-title"><?php echo esc_html($data['address_title']); ?></h3>
			<div class="section-line-wrap">
				<span class="section-line section-line-one"></span>
			</div>
			<?php if ( !empty( $data['address_info'] )  ) { ?>  
				<?php foreach ( $data['address_info'] as $index => $address ) { ?>
					<?php
							$data_type = $address['address_infos'];
							if(filter_var($data_type, FILTER_VALIDATE_EMAIL)){
								$href_value = 'mailto:'. sanitize_email( $data_type );
							} elseif ( preg_match('/^[0-9\-\(\)\/\+\s]*$/', $data_type ) ) {
								$href_value = 'tel:'.esc_attr($data_type);
							} elseif (filter_var($data_type, FILTER_VALIDATE_URL)) {
								$href_value = "esc_url($data_type)";
							} else {
								$href_value = '';
							}
							$link_key = 'link_' . $index;
							$this->add_render_attribute( $link_key, 'href', $href_value );
					?>
					<div class="list-item">
						<?php if (!empty( $address['address_infos']) ) { ?>
						<div class="list-content">
							<span>
								<?php if (!empty( $href_value ) ) { ?>
									<a <?php echo $this->get_render_attribute_string( $link_key ); ?>>
										<?php echo $address['address_infos']; ?>
									</a>
								
								<?php } else { ?>
									<?php echo $address['address_infos']; ?>
								<?php } ?>
							</span>
						</div>
						<?php } ?>
					</div>
				<?php } ?>
			<?php } ?>
		</div>
	</div>
	
</div>
<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

namespace radiustheme\Gymat_Core;
extract($data);

$fb_attr 		= '';
$twitter_attr    = '';
$skype_attr      = '';
$instragram_attr = '';
$printerest_attr = '';
$whats_attr      = '';
$youtube_attr    = '';


$fb_attr 	.= !empty( $data['fb_url']['is_external'] ) ? ' target="_blank"' : '';
$fb_attr 	.= !empty( $data['fb_url']['nofollow'] ) ? ' rel="nofollow"' : '';
$twitter_attr .= !empty( $data['twitter_url']['is_external'] ) ? ' target="_blank"' : '';
$twitter_attr .= !empty( $data['twitter_url']['nofollow'] ) ? ' rel="nofollow"' : '';
$skype_attr 	 .= !empty( $data['skype_url']['is_external'] ) ? ' target="_blank"' : '';
$skype_attr 	 .= !empty( $data['skype_url']['nofollow'] ) ? ' rel="nofollow"' : '';
$instragram_attr .= !empty( $data['instragram_url']['is_external'] ) ? ' target="_blank"' : '';
$instragram_attr .= !empty( $data['instragram_url']['nofollow'] ) ? ' rel="nofollow"' : '';
$printerest_attr .= !empty( $data['printerest_url']['is_external'] ) ? ' target="_blank"' : '';
$printerest_attr .= !empty( $data['printerest_url']['nofollow'] ) ? ' rel="nofollow"' : '';
$whats_attr   .= !empty( $data['printerest_url']['is_external'] ) ? ' target="_blank"' : '';
$whats_attr 	 .= !empty( $data['printerest_url']['nofollow'] ) ? ' rel="nofollow"' : '';
$youtube_attr .= !empty( $data['printerest_url']['is_external'] ) ? ' target="_blank"' : '';
$youtube_attr .= !empty( $data['printerest_url']['nofollow'] ) ? ' rel="nofollow"' : '';

?>
<div class="contact-info-default info-<?php echo esc_attr( $data['style'] ); ?>">
	<div class="contact-info">
		<?php if ( !empty( $data['address_title'] ) ) { ?>
			<h2 class="contact-title"><?php echo wp_kses_post( $data['address_title'] );?></h2>
		<?php } ?>
		<div class="section-line-wrap">
			<span class="section-line section-line-one"></span>
		</div>
		<ul class="social-icons">
			<?php if(!empty($data['fb_url']['url'])){ ?>
				<li>
					<a href="<?php echo esc_url( $data['fb_url']['url'] ); ?>" <?php echo esc_attr($fb_attr); ?>><i class="fab fa-facebook-f"></i></a>
				</li>
			<?php } ?>
			<?php if(!empty($data['twitter_url']['url'])){ ?>
				<li>
					<a href="<?php echo esc_url( $data['twitter_url']['url'] ); ?>" <?php echo esc_attr($twitter_attr); ?>><i class="fab fa-twitter"></i></a>
				</li>
			<?php } ?>
			<?php if(!empty($data['skype_url']['url'])){ ?>
				<li>
					<a href="<?php echo esc_url( $data['skype_url']['url'] ); ?>" <?php echo esc_attr($skype_attr); ?>><i class="fab fa-skype"></i></a>
				</li>
			<?php } ?>
			<?php if(!empty($data['instragram_url']['url'])){ ?>
				<li>
					<a href="<?php echo esc_url( $data['instragram_url']['url'] ); ?>" <?php echo esc_attr($instragram_attr); ?>><i class="fab fa-instagram"></i></a>
				</li>
			<?php } ?>
			<?php if(!empty($data['printerest_url']['url'])){ ?>
				<li>
					<a href="<?php echo esc_url( $data['printerest_url']['url'] ); ?>" <?php echo esc_attr($printerest_attr); ?>><i class="fab fa-pinterest-p"></i></a>
				</li>
			<?php } ?>
			<?php if(!empty($data['whats_url']['url'])){ ?>
				<li>
					<a href="<?php echo esc_url( $data['whats_url']['url'] ); ?>" <?php echo esc_attr($whats_attr); ?>><i class="fab fa-whatsapp"></i></a>
				</li>
			<?php } ?>
			<?php if(!empty($data['youtube_url']['url'])){ ?>
				<li>
					<a href="<?php echo esc_url( $data['youtube_url']['url'] ); ?>" <?php echo esc_attr($youtube_attr); ?>><i class="fab fa-youtube"></i></a>
				</li>
			<?php } ?>
		</ul>
	</div>
</div>
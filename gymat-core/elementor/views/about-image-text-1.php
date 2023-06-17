<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

namespace radiustheme\Gymat_Core;

use GymatTheme;
use GymatTheme_Helper;
use Elementor\Group_Control_Image_Size;
use Elementor\Utils;
extract($data);


//image
$getimg = Group_Control_Image_Size::get_attachment_image_html( $data, 'icon_image_size', 'rt_image' );
$signature_image = wp_get_attachment_image( $data['signature_image']['id'], 'full' );

?>
<div class="about-image-text motion-effects-wrap">
	<div class="row">
		<div class="col-lg-6">
			<div class="about-img-box wow fadeInLeft rt-animate" data-wow-delay="200ms" data-wow-duration="800ms">
				<div class="item-img">
					<?php if($getimg){ ?>
						<?php echo wp_kses_post($getimg);?>	
					<?php } ?>
					<div class="item-shape">
						<img width="184" height="190" class="motion-effects1" src="<?php echo GYMAT_ASSETS_URL . 'element/shape-68.png'; ?>" alt="shape">
					</div>
					<div class="item-content wow fadeInUp rt-animate" data-wow-delay="600ms" data-wow-duration="800ms">
						<div class="item-icon"><img width="27" height="23" src="<?php echo GYMAT_ASSETS_URL . 'element/shape-70.png'; ?>" alt="shape"></div>
						<h4 class="item-quote">
							<?php echo wp_kses_post($data['blockqoute_text2']); ?>
						</h4>
					</div>
				</div>
			</div>
		</div>
		<div class="col-lg-6">
			<div class="about-info-box wow fadeInRight animated" data-wow-delay="400ms" data-wow-duration="800ms">
				<div class="section-heading">
					<div class="subtitle rt-subtitle">
						<?php echo wp_kses_post($data['section_subtitle']); ?>	
					</div>
					<h2 class="heading-title"><?php echo wp_kses_post($data['section_title']); ?></h2>
					<div class="about-author-text">
						<?php echo wp_kses_post($data['author_about_text']); ?>
					</div>
				</div>
				<div class="item-sign-wrap">
					<div class="founder-sign">
						<?php if($signature_image){
							echo wp_kses_post($signature_image);
						} else { ?>
							<img src="<?php echo GYMAT_ASSETS_URL . 'element/shape-69.png'; ?>" width="157" height="27" alt="">
						<?php } ?>
					</div>
					<div class="rt-designation">
						<?php echo wp_kses_post( $data['title'] );?>
						<?php $designation=$data['designation']; ?>
						<span><?php printf(" - %s",wp_kses_post($designation)); ?></span>
					</div>
				</div>
			</div>
		</div>
		
	</div>
</div>
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


//image
$getimg = Group_Control_Image_Size::get_attachment_image_html( $data, 'icon_image_size', 'rt_image' );
  
?>  
<!-- Start Banner -->
<section class="rt-banner-addon <?php echo esc_attr( $data['style'] ); ?>">
            <div class="container">
                <div class="banner-content-wrap">
                    <div class="row align-items-center">
                        <div class="col-lg-5 wow fadeInLeft rt-animate" data-wow-delay="200ms" data-wow-duration="1200ms">
                            <div class="banner-content style-3">
                                <h1 class="banner-title">
                                    <?php echo wp_kses_post( $data['title'] );?>
                                </h1>
                                <div class="item-banner-content">
                                    <div class="item-clip-shape">
                                        <div class="clip-content">
                                            <div class="item-discount"><?php echo wp_kses_post($data['day_off']); ?></div>
                                            <div class="item-off"><?php _e('off','gymat-core'); ?></div>
                                            <div class="item-way-member"><?php echo wp_kses_post($data['sub_title']); ?></div>
                                        </div>
                                    </div>
                                    <?php if(!empty($data['features_list'])){ ?>
                                        <div class="feature-list">
                                            <ul>
                                                <?php foreach($data['features_list'] as $index=>$feature){ ?>
                                                    <li><i class="fas fa-check-circle"></i><?php echo wp_kses_post($feature['feature']); ?></li>
                                                <?php } ?>
                                            </ul>
                                        </div>
                                   <?php } ?>
								</div>
                            </div>
                        </div>
                        <div class="col-lg-7 wow fadeInRight rt-animate">
                            <div class="image-box-layout">
                                <div class="banner-image">
                                    <?php if($getimg){ ?>
                                        <?php echo wp_kses_post($getimg); ?>
                                    <?php } ?>
                                    <?php if($data['shape_display']=='yes'){?>
                                        <div class="rouded-shape">
                                            <svg width="747" height="747" viewBox="0 0 747 747" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <circle cx="373.5" cy="373.5" r="328.5" stroke="url(#paint0_linear_321_1202)" stroke-width="90"/>
                                                <defs>
                                                <linearGradient id="paint0_linear_321_1202" x1="747" y1="-2.22623e-05" x2="-6.6787e-05" y2="747" gradientUnits="userSpaceOnUse">
                                                <stop stop-color="#E50130" offset="0.1"/>
                                                <stop offset="1" stop-color="#150C0E" stop-opacity="0.2"/>
                                                </linearGradient>
                                                </defs>
                                            </svg>
                                        </div>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>					
</section>
<!-- End Banner -->
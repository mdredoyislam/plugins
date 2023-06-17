<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

namespace radiustheme\Gymat_Core;
use GymatTheme;
use Elementor\Group_Control_Image_Size;
extract( $data );

$svg='<svg width="21" height="12" viewBox="0 0 21 12" fill="none" xmlns="http://www.w3.org/2000/svg">
<path fill-rule="evenodd" clip-rule="evenodd" d="M0 6C0 6.22729 0.087059 6.44527 0.242027 6.60598C0.396994 6.7667 0.607174 6.85699 0.82633 6.85699H18.1774L14.6292 10.5352C14.5523 10.6149 14.4914 10.7095 14.4498 10.8136C14.4082 10.9177 14.3868 11.0292 14.3868 11.1419C14.3868 11.2546 14.4082 11.3662 14.4498 11.4703C14.4914 11.5744 14.5523 11.669 14.6292 11.7487C14.706 11.8284 14.7972 11.8916 14.8976 11.9347C14.998 11.9778 15.1056 12 15.2142 12C15.3229 12 15.4304 11.9778 15.5308 11.9347C15.6312 11.8916 15.7224 11.8284 15.7992 11.7487L20.7572 6.60675C20.8342 6.52714 20.8952 6.43257 20.9369 6.32846C20.9786 6.22434 21 6.11272 21 6C21 5.88728 20.9786 5.77566 20.9369 5.67154C20.8952 5.56743 20.8342 5.47286 20.7572 5.39325L15.7992 0.251323C15.6441 0.0904038 15.4336 0 15.2142 0C14.9948 0 14.7843 0.0904038 14.6292 0.251323C14.474 0.412243 14.3868 0.630497 14.3868 0.858071C14.3868 1.08565 14.474 1.3039 14.6292 1.46482L18.1774 5.14301H0.82633C0.607174 5.14301 0.396994 5.2333 0.242027 5.39402C0.087059 5.55474 0 5.77271 0 6Z" fill="white"/>
</svg>';
$attr = '';
if ( !empty( $data['button_url']['url'] ) ) {
	$attr  = 'href="' . $data['button_url']['url'] . '"';
	$attr .= !empty( $data['button_url']['is_external'] ) ? ' target="_blank"' : '';
	$attr .= !empty( $data['button_url']['nofollow'] ) ? ' rel="nofollow"' : '';
}

if ( !empty( $data['button_text'] ) ) {
	$btn = '<a class="btn-style1" ' . $attr . '>' .'<span>'. $data['button_text'] .$svg.'</span>'.'</a>';
}
$getimg = Group_Control_Image_Size::get_attachment_image_html( $data, 'icon_image_size', 'rt_image' );
?>
<div class="pricing-box-1 default-pricing">
    <div class="item-img">
      <?php echo wp_kses_post($getimg);?>
      <h3 class="item-title"><?php echo wp_kses_post($data['package_name']); ?></h3>	
    </div>
    <div class="item-content">
      <h2 class="rt-price-box">
        <sup class="dollar-sign"><?php echo wp_kses_post($data['currency_icon']); ?></sup>
        <?php echo wp_kses_post($data['price']); ?>
        <span class="month-price"><?php echo wp_kses_post($data['duration']); ?></span>
      </h2>
      <?php if($data['features']){ ?>
        <ul class="feature-list">
          <?php foreach ($data['features'] as  $feature) { ?>
               <?php  
                    extract($feature);
                    $final_icon_class='';
                    $final_icon_image_url='';
                    if ( is_string( $feature_icon['value'] ) && $dynamic_icon_class = $feature_icon['value']  ) {
                      $final_icon_class     = $dynamic_icon_class;
                    }
                    if ( is_array( $feature_icon['value'] ) ) {
                      $final_icon_image_url = $feature_icon['value']['url'];
                    }
               ?>
              <li><?php if($final_icon_class) { ?> <i class='<?php echo esc_attr($final_icon_class); ?>'></i> <?php } ?><?php echo wp_kses_post( $feature['text'] ); ?></li>
          <?php } ?>
        </ul>
      <?php } ?>
      <div class="item-button">
        <?php echo wp_kses_post( $btn ); ?>
      </div>
    </div>
</div>


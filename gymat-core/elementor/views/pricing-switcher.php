<?php 
namespace radiustheme\Gymat_Core;
use Elementor\Utils;
extract($data);

?>

<div class="rt-pricing-section--style-1 pricing-wrapper rt-switcher-pricing-section">
  <div class="row justify-content-center text-center">
      <div class="col-xl-8 col-lg-9">
          <div class="rt-pricing-box-title-wrapper">
            <div class="rt-pricing-switch-wrapper">
              <div class="price-switch-box price-switch-box--style-1">
                <span class="pack-name"><?php echo wp_kses_post($data['monthly_title']); ?></span>
                <div class="pricing-switch-container">
                  <div class="pricing-switch"></div>
                  <div class="pricing-switch pricing-switch-active"></div>
                  <div class="switch-button"></div>
                </div>
                <span class="pack-name"><?php echo wp_kses_post($data['yearly_title']); ?></span>
              </div>
            </div>
          </div>
      </div>
  </div>
  <div class="rt-tab-content" id="myTabContent">
      <div class="rt-tab-pane rtTabFadeInUp monthly">
      <?php if($data['monthly_features']){ ?>
        <div class="row g-4 justify-content-center">
            <?php foreach($data['monthly_features'] as $key=>$feature){ ?>
              <?php  
                    extract($feature);
                    $final_icon_class='';
                    $final_icon_image_url='';
                    if ( is_string( $monthly_icon['value'] ) && $dynamic_icon_class = $monthly_icon['value']  ) {
                      $final_icon_class     = $dynamic_icon_class;
                    }
                    if ( is_array( $monthly_icon['value'] ) ) {
                      $final_icon_image_url = $monthly_icon['value']['url'];
                    }
               ?>
            <div class="col-lg-4  col-md-6">
              <div class="rt-pricing-table">
                <div class="rt-pricing-table__header">
                    <h3 class="rt-pricing-table__plan-name"><?php echo wp_kses_post($feature['package_name']); ?></h3>
                    <div class="pricing-media">	
                      <?php if ( $final_icon_image_url ): ?>
                        <div class="price-icon"><img src="<?php echo esc_url( $final_icon_image_url ); ?>" alt="SVG Icon"></div>
                      <?php else: ?>
                        <div class="price-icon"><i class="<?php  echo esc_attr( $final_icon_class ); ?>"></i></div>
                      <?php endif ?>
                    </div>
                </div>
                <div class="rt-pricing-table__content">
                    <?php echo wp_kses_post($feature['monthly_list_item']); ?>
                </div>
                <div class="rt-pricing-table__item-price">
                    <h4><?php echo wp_kses_post($feature['monthly_price']); ?> <sub><?php echo wp_kses_post($feature['monthly_duration']); ?></sub></h4>
                </div>
                <div class="rt-pricing-table__footer">
                    <?php if($feature['monthly_btn_text']){ ?>
                        <a href="<?php echo esc_attr($feature['monthly_btn_link']['url']); ?>" class="btn-style1" target="_blank">
                        <span>
                          <?php echo wp_kses_post($feature['monthly_btn_text']); ?>
                          <svg width="21" height="12" viewBox="0 0 21 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                          <path fill-rule="evenodd" clip-rule="evenodd" d="M0 6C0 6.22729 0.087059 6.44527 0.242027 6.60598C0.396994 6.7667 0.607174 6.85699 0.82633 6.85699H18.1774L14.6292 10.5352C14.5523 10.6149 14.4914 10.7095 14.4498 10.8136C14.4082 10.9177 14.3868 11.0292 14.3868 11.1419C14.3868 11.2546 14.4082 11.3662 14.4498 11.4703C14.4914 11.5744 14.5523 11.669 14.6292 11.7487C14.706 11.8284 14.7972 11.8916 14.8976 11.9347C14.998 11.9778 15.1056 12 15.2142 12C15.3229 12 15.4304 11.9778 15.5308 11.9347C15.6312 11.8916 15.7224 11.8284 15.7992 11.7487L20.7572 6.60675C20.8342 6.52714 20.8952 6.43257 20.9369 6.32846C20.9786 6.22434 21 6.11272 21 6C21 5.88728 20.9786 5.77566 20.9369 5.67154C20.8952 5.56743 20.8342 5.47286 20.7572 5.39325L15.7992 0.251323C15.6441 0.0904038 15.4336 0 15.2142 0C14.9948 0 14.7843 0.0904038 14.6292 0.251323C14.474 0.412243 14.3868 0.630497 14.3868 0.858071C14.3868 1.08565 14.474 1.3039 14.6292 1.46482L18.1774 5.14301H0.82633C0.607174 5.14301 0.396994 5.2333 0.242027 5.39402C0.087059 5.55474 0 5.77271 0 6Z" fill="white"/>
                          </svg>
                        </span></a>
                    <?php } ?>
                </div>
              </div>
            </div>
          <!-- end col -->
          <?php } ?>
        </div>
        <?php } ?>
        <!-- end row -->
      </div>
      <div class="rt-tab-pane rtTabFadeInUp yearly">
      <?php if($data['monthly_features']){ ?>
        <div class="row g-4 justify-content-center">
        <?php foreach($data['yearly_features'] as $key=>$yearly_feature){ ?>
          <?php  
                extract($yearly_feature);
                $yearly_final_icon_class='';
                $yearly_final_icon_image_url='';
                if ( is_string( $yearly_icon['value'] ) && $dynamic_icon_class = $yearly_icon['value']  ) {
                  $yearly_final_icon_class     = $dynamic_icon_class;
                }
                if ( is_array( $yearly_icon['value'] ) ) {
                  $yearly_final_icon_image_url = $yearly_icon['value']['url'];
                }
          ?>
          <div class="col-lg-4 col-md-6">
            <div class="rt-pricing-table">
              <div class="rt-pricing-table__header">
                <h3 class="rt-pricing-table__plan-name"><?php echo wp_kses_post($yearly_feature['yearly_package_name']); ?></h3>
                <div class="pricing-media">	
                    <?php if ( $yearly_final_icon_image_url ): ?>
                      <div class="price-icon"><img src="<?php echo esc_url( $yearly_final_icon_image_url ); ?>" alt="SVG Icon"></div>
                    <?php else: ?>
                      <div class="price-icon"><i class="<?php  echo esc_attr( $yearly_final_icon_class ); ?>"></i></div>
                    <?php endif; ?>
                </div>
              </div>
              <div class="rt-pricing-table__content">
                  <?php echo wp_kses_post($yearly_feature['yearly_list_item']); ?>
              </div>
              <div class="rt-pricing-table__item-price">
                   <h4><?php echo wp_kses_post($yearly_feature['yearly_price']); ?> <sub><?php echo wp_kses_post($yearly_feature['yearly_duration']); ?></sub></h4>
              </div>
              <div class="rt-pricing-table__footer">
                  <?php if($yearly_feature['yearly_btn_text']){ ?>
                        <a href="<?php echo esc_attr($yearly_feature['yearly_btn_link']['url']); ?>" class="btn-style1" target="_blank">
                        <span>
                          <?php echo wp_kses_post($yearly_feature['yearly_btn_text']); ?>
                          <svg width="21" height="12" viewBox="0 0 21 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                          <path fill-rule="evenodd" clip-rule="evenodd" d="M0 6C0 6.22729 0.087059 6.44527 0.242027 6.60598C0.396994 6.7667 0.607174 6.85699 0.82633 6.85699H18.1774L14.6292 10.5352C14.5523 10.6149 14.4914 10.7095 14.4498 10.8136C14.4082 10.9177 14.3868 11.0292 14.3868 11.1419C14.3868 11.2546 14.4082 11.3662 14.4498 11.4703C14.4914 11.5744 14.5523 11.669 14.6292 11.7487C14.706 11.8284 14.7972 11.8916 14.8976 11.9347C14.998 11.9778 15.1056 12 15.2142 12C15.3229 12 15.4304 11.9778 15.5308 11.9347C15.6312 11.8916 15.7224 11.8284 15.7992 11.7487L20.7572 6.60675C20.8342 6.52714 20.8952 6.43257 20.9369 6.32846C20.9786 6.22434 21 6.11272 21 6C21 5.88728 20.9786 5.77566 20.9369 5.67154C20.8952 5.56743 20.8342 5.47286 20.7572 5.39325L15.7992 0.251323C15.6441 0.0904038 15.4336 0 15.2142 0C14.9948 0 14.7843 0.0904038 14.6292 0.251323C14.474 0.412243 14.3868 0.630497 14.3868 0.858071C14.3868 1.08565 14.474 1.3039 14.6292 1.46482L18.1774 5.14301H0.82633C0.607174 5.14301 0.396994 5.2333 0.242027 5.39402C0.087059 5.55474 0 5.77271 0 6Z" fill="white"/>
                          </svg>
                        </span></a>
                    <?php } ?>
              </div>
            </div>
          </div>
          <!-- end col -->
          <?php } ?>
        </div>
        <!-- end row -->
        <?php } ?>
      </div>
  </div>
</div>
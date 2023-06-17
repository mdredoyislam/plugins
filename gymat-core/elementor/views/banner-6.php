<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */
namespace radiustheme\Gymat_Core;
use GymatTheme_Helper;
use Elementor\Group_Control_Image_Size;
use Elementor\Utils;
extract($data);
$attr = '';
$svg='<svg width="21" height="12" viewBox="0 0 21 12" fill="none" xmlns="http://www.w3.org/2000/svg">
        <path fill-rule="evenodd" clip-rule="evenodd" d="M0 6C0 6.22729 0.087059 6.44527 0.242027 6.60598C0.396994 6.7667 0.607174 6.85699 0.82633 6.85699H18.1774L14.6292 10.5352C14.5523 10.6149 14.4914 10.7095 14.4498 10.8136C14.4082 10.9177 14.3868 11.0292 14.3868 11.1419C14.3868 11.2546 14.4082 11.3662 14.4498 11.4703C14.4914 11.5744 14.5523 11.669 14.6292 11.7487C14.706 11.8284 14.7972 11.8916 14.8976 11.9347C14.998 11.9778 15.1056 12 15.2142 12C15.3229 12 15.4304 11.9778 15.5308 11.9347C15.6312 11.8916 15.7224 11.8284 15.7992 11.7487L20.7572 6.60675C20.8342 6.52714 20.8952 6.43257 20.9369 6.32846C20.9786 6.22434 21 6.11272 21 6C21 5.88728 20.9786 5.77566 20.9369 5.67154C20.8952 5.56743 20.8342 5.47286 20.7572 5.39325L15.7992 0.251323C15.6441 0.0904038 15.4336 0 15.2142 0C14.9948 0 14.7843 0.0904038 14.6292 0.251323C14.474 0.412243 14.3868 0.630497 14.3868 0.858071C14.3868 1.08565 14.474 1.3039 14.6292 1.46482L18.1774 5.14301H0.82633C0.607174 5.14301 0.396994 5.2333 0.242027 5.39402C0.087059 5.55474 0 5.77271 0 6Z" fill="white"/>
        </svg>';
if ( !empty( $data['url']['url'] ) ) {
	$attr  = 'href="' . $data['url']['url'] . '"';
	$attr .= !empty( $data['url']['is_external'] ) ? ' target="_blank"' : '';
	$attr .= !empty( $data['url']['nofollow'] ) ? ' rel="nofollow"' : '';
}
if ( !empty( $data['buttontext'] ) ) {
    $btn = '<a class="btn-style1" ' . $attr . '>' .'<span>'.  $data['buttontext'] .$svg .'</span>'.'</a>';
}


$img=Group_Control_Image_Size::get_attachment_image_html( $data, 'icon_image_size' , 'rt_image');

?>
<div class="rt-banner-addon <?php echo esc_attr( $data['style'] ); ?> ">
    <div class="container">
        <div class="banner-content-wrap">
            <div class="row">
                <div class="col-xl-5 col-lg-6">
                    <div class="banner-content">
                        <?php if($data['sub_title']) { ?>
                            <div class="subtitle wow fadeInUp rt-animate" data-wow-delay="1s" data-wow-duration="1s">
                                <?php echo wp_kses_post($data['sub_title']) ?>
                            </div>
                        <?php } ?>
                        <h2 class="banner-title wow fadeInUp rt-animate" data-wow-delay="1.2s" data-wow-duration="1s">
                            <?php echo wp_kses_post($data['title']); ?>
                        </h2>
                        <p class="wow fadeInUp rt-animate" data-wow-delay="1.4s" data-wow-duration="1s">
                        <?php echo wp_kses_post( $data['content'] );?>
                        </p>
                        <?php if ( !empty( $btn ) ){ ?>
                        <div class="btn-wrap wow fadeInUp rt-animate" data-wow-delay="1.6s" data-wow-duration="1s">
                            <?php echo wp_kses_post( $btn );?>
                        </div>
                        <?php } ?>
                    </div>
                </div>
                <div class="col-xl-6 col-lg-6">
                    <div class="hero__img__Wrap">
                        <?php if($img){
                            echo wp_kses_post($img);
                        } ?>
                        <?php if($data['shape_display']=='yes'){?>
                            <div class="shape-img">
                                <svg width="459" height="629" viewBox="0 0 459 629" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <mask id="mask0_101_12" style="mask-type:alpha" maskUnits="userSpaceOnUse" x="0" y="0" width="459" height="629">
                                <rect width="459" height="629" fill="#D9D9D9"/>
                                </mask>
                                <g mask="url(#mask0_101_12)">
                                <path d="M-180.465 678.915C-195.046 715.985 -176.85 758.444 -138.001 767.249C-89.4417 778.256 -39.3044 781.592 10.5746 776.997C84.4782 770.189 155.758 746.158 218.699 706.831C281.639 667.504 334.488 613.976 373.009 550.539C411.53 487.101 434.649 415.521 440.514 341.536C446.379 267.552 434.826 193.222 406.781 124.509C378.736 55.7948 334.98 -5.39148 279.022 -54.1436C223.064 -102.896 156.46 -137.857 84.5525 -156.224C36.0204 -168.62 -14.0164 -173.225 -63.7037 -170.007C-103.455 -167.432 -128.113 -128.37 -119.555 -89.4664V-89.4664C-110.997 -50.5624 -72.3246 -26.8089 -32.4905 -26.7475C-5.14651 -26.7053 22.1796 -23.2724 48.853 -16.4593C98.9232 -3.67008 145.3 20.6739 184.264 54.6206C223.229 88.5672 253.697 131.172 273.224 179.018C292.752 226.864 300.797 278.621 296.713 330.137C292.629 381.653 276.531 431.496 249.709 475.668C222.886 519.84 186.087 557.112 142.26 584.496C98.4343 611.879 48.8012 628.612 -2.65867 633.353C-30.0723 635.879 -57.598 634.963 -84.6071 630.697C-123.953 624.482 -165.885 641.846 -180.465 678.915V678.915Z" fill="#FF0336"/>
                                </g>
                                </svg>
                            </div>
                            <div class="item-element motion-effects1"><img src="<?php echo GYMAT_ASSETS_URL . 'element/banner-6-shape.svg'; ?>" alt="banner"></div>
                        <?php } ?>
                    </div>			
                </div>
            </div>
            <div class="round--shape--red motion-effects2">
                <div class="shape wow rt-animate zoomInDown" data-wow-delay=".7s" data-wow-duration="1s">
                    <span class="label"><?php esc_html_e('Start From','gymat-core'); ?></span>
                    <span class="price"><?php echo esc_html($data['price']); ?></span>
                </div>
            </div>
        </div>
    </div>		
</div>


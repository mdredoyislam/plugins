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

$gymat_socials = GymatTheme_Helper::socials();

?>

<section class="rt-banner-addon <?php echo esc_attr( $data['style'] ); ?>">
        <?php if($data['shape_display']=='yes'){?>
            <div class="element-list d-none d-xl-block" >
                <img  width="1920" height="414" src="<?php echo GYMAT_ASSETS_URL . 'element/shape-32.png'; ?>" alt="">	
            </div>  
        <?php  } ?>
        <?php if ( $gymat_socials && $data['follow_display']=='yes' ) { ?>
            <ul class="banner-social-section">
                <li class="banner-social">
                    <div class="social-icon">
                        <?php $count=1; ?>
                    <?php foreach ( $gymat_socials as $gymat_social ): ?>
                        <?php if($count==1):?><span class="line"><span class="text"><?php _e("Share","gymat-core"); ?></span></span> <?php endif ?><a target="_blank" href="<?php echo esc_url( $gymat_social['url'] );?>"><i class="fab <?php echo esc_attr( $gymat_social['icon'] );?>"></i></a>
                    <?php $count++; endforeach; ?>
                    </div>
                </li>
            </ul>
        <?php } ?>	
        <div class="container">
            <div class="banner-content-wrap">
                <div class="row">
                    <div class="col-xl-7 col-lg-8 col-md-10">
                        <div class="banner-content">
                            <?php if($data['sub_title']) { ?>
                                <div class="subtitle wow fadeInUp rt-animate" data-wow-delay="1s" data-wow-duration="1s">
                                    <?php echo wp_kses_post($data['sub_title']) ?>
                                </div>
                            <?php } ?>
                            <?php 
                            
                            $full_title_str=$data['title'];
                            $array_title=explode(" ",$full_title_str);
                            $last_three_title_arr=array_splice($array_title,-3);
                            $first_title_str=implode(" ",$array_title);
                            $last_three_title_str=implode(" ",$last_three_title_arr);
                            
                            ?>
                            <h2 class="banner-title wow fadeInUp rt-animate" data-wow-delay="1.2s" data-wow-duration="1s">
                                <?php echo wp_kses_post($first_title_str);?>
                                <span><?php echo wp_kses_post($last_three_title_str); ?></span>
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
                </div>
            </div>
            <?php if($data['shape_display']=='yes'){?>
                <div class="gym-text-shape d-none d-xl-block">
                    <img  width="1192" height="216" src="<?php echo GYMAT_ASSETS_URL . 'element/gym-text.png'; ?>" alt="">
                </div>
            <?php  }  ?>
        </div>		

</section>








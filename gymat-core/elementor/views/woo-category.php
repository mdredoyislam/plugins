<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

namespace radiustheme\Gymat_Core;
use Elementor\Group_Control_Image_Size;

/**
 * swiper slider data
 */
if($data['slider_autoplay']=='yes'){
	$data['slider_autoplay']=true;
}
else{
	$data['slider_autoplay']=false;
}

$swiper_data = array(
	'slidesPerView' 	=>2,
	'loop'				=>$data['slider_loop']=='yes' ? true:false,
	'spaceBetween'		=>$data['space']['size'],
	'slidesPerGroup'	=>$data['slider_per_group']['size'],
	'centeredSlides'	=>$data['centered_slide']=='yes' ? true:false ,
	'slideToClickedSlide' =>true,
	'autoplay'				=>array(
		'delay'  => $data['autoplayspeed']['size'],
	),
	'speed'      =>$data['speed']['size'],
	'breakpoints' =>array(
		'0'    =>array('slidesPerView' =>1),
		'576'    =>array('slidesPerView' =>$data['item_mobile']['size']),
		'768'    =>array('slidesPerView' =>$data['item_tablet']['size']),
		'992'    =>array('slidesPerView' =>$data['medium_item']['size']),
		'1200'    =>array('slidesPerView' =>$data['item']['size']),				
		'1600'    =>array('slidesPerView' =>$data['item']['size'])
	),
	'auto'   =>$data['slider_autoplay']
);
$swiper_data = json_encode( $swiper_data );

if(is_array($data['product_cat_infos']) && !empty($data['product_cat_infos'])){ ?>
    <div class="el-category-box slider">
        <div class="rt-related-slider swiper" data-xld = '<?php echo esc_attr( $swiper_data );?>'>
            <div class="swiper-wrapper">
                <?php 
                    extract( $data );
                     $i = $data['delay']; $j = $data['duration']; 
                 ?>
                <?php foreach ($data['product_cat_infos'] as $item ) {

                    $term = get_term( $item['category_name'], 'product_cat' );
                    $thumbnail_id = get_term_meta( $term->term_id, 'thumbnail_id', true ); 

                    $term_img = wp_get_attachment_image( $thumbnail_id,'full' ); 

                    if ( $term && !is_wp_error( $term ) ) {
                        $item['title']     = $term->name;
                    } else {
                        $item['title'] = esc_html__( 'Product Category', 'clproperty-core' );
                    } ?>
                    <div class="swiper-slide">
                        <div class="category-box rt-animate <?php echo esc_attr( $data['animation'] );?> <?php echo esc_attr( $data['animation_effect'] );?>" data-wow-delay="<?php echo esc_attr( $i );?>s" data-wow-duration="<?php echo esc_attr( $j );?>s">
                            <?php if($term_img){ ?>
                                <div class="category-image">
                                    <?php echo wp_kses_post($term_img); ?>
                                </div>
                            <?php } ?>
                            <div class="category-content">
                                <div class="category-subtitle"><?php echo esc_html($item['category_subtitle']); ?></div>
                                <h3 class="category-title">
                                    <a href="<?php echo esc_url(get_term_link($term)); ?>"><?php 
                                    echo esc_html($item['title']);
                                    ?></a>
                                </h3>
                                <div class="shop-btn">
                                    <a href="<?php echo esc_url(get_term_link($term)); ?>" class="btn-style1"><span><?php echo esc_html($item['category_btn_text']); ?><svg width="21" height="12" viewBox="0 0 21 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M0 6C0 6.22729 0.087059 6.44527 0.242027 6.60598C0.396994 6.7667 0.607174 6.85699 0.82633 6.85699H18.1774L14.6292 10.5352C14.5523 10.6149 14.4914 10.7095 14.4498 10.8136C14.4082 10.9177 14.3868 11.0292 14.3868 11.1419C14.3868 11.2546 14.4082 11.3662 14.4498 11.4703C14.4914 11.5744 14.5523 11.669 14.6292 11.7487C14.706 11.8284 14.7972 11.8916 14.8976 11.9347C14.998 11.9778 15.1056 12 15.2142 12C15.3229 12 15.4304 11.9778 15.5308 11.9347C15.6312 11.8916 15.7224 11.8284 15.7992 11.7487L20.7572 6.60675C20.8342 6.52714 20.8952 6.43257 20.9369 6.32846C20.9786 6.22434 21 6.11272 21 6C21 5.88728 20.9786 5.77566 20.9369 5.67154C20.8952 5.56743 20.8342 5.47286 20.7572 5.39325L15.7992 0.251323C15.6441 0.0904038 15.4336 0 15.2142 0C14.9948 0 14.7843 0.0904038 14.6292 0.251323C14.474 0.412243 14.3868 0.630497 14.3868 0.858071C14.3868 1.08565 14.474 1.3039 14.6292 1.46482L18.1774 5.14301H0.82633C0.607174 5.14301 0.396994 5.2333 0.242027 5.39402C0.087059 5.55474 0 5.77271 0 6Z" fill="white"/>
                                    </svg></span></a>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php 
                $i = $i + 0.2;   
                } 
                ?>
            </div>
        </div>
    </div>
<?php } ?>
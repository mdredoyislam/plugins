<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

$args = array(
        'post_type'      => 'product',
        'post_status'    => 'publish',
        'posts_per_page' => 1,
        'p'       => $data['single_post'],
    );

$product_id      = intval( $data['single_post'] );

$product = wc_get_product( $product_id );

$query = new WP_Query( $args );

$attachment_ids = $product->get_gallery_image_ids();


/**button */
$attr = '';
if ( empty( $data['buttonurl']['url'] ) ) {
	$data['buttonurl']['url']="#";
}

$attr .= !empty( $data['buttonurl']['is_external'] ) ? ' target="_blank"' : '';
$attr .= !empty( $data['buttonurl']['nofollow'] ) ? ' rel="nofollow"' : '';


if ( !is_woocommerce() ){
    echo '<div class="woocommerce">';
}
?>
<div class="woo-best-deal-product-wraper">
    <div class="rt-section-top">
        <div class="rt-section-title">
            <h2><?php echo esc_html($data['section_title']); ?></h2>
            <div class="title-shape">
                <svg width="40" height="17" viewBox="0 0 40 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M3 5H36.6364L40 8.5L36.6364 12H3V5Z" fill="#FF0336"></path>
                    <path d="M0 14.5714L6.25 8.5L0 2.42857L1.25 0L10 8.5L1.25 17L0 14.5714Z" fill="white"></path>
                    <path d="M10 14.5714L15.625 8.5L10 2.42857L11.125 0L19 8.5L11.125 17L10 14.5714Z" fill="white"></path>
                    <path d="M19 14.5714L25.25 8.5L19 2.42857L20.25 0L29 8.5L20.25 17L19 14.5714Z" fill="white"></path>
                    <path d="M28 14.5714L33.625 8.5L28 2.42857L29.125 0L37 8.5L29.125 17L28 14.5714Z" fill="white"></path>
                </svg>
            </div>
        </div>
        <div class="deal-counter-wrap">
            <div class="count-down-style-1" data-time="<?php echo esc_attr( $data['date'] ); ?>">
                <div class="countdown"></div>
            </div>
	    </div>
    </div>

    <div class="slider-wraper-data">
        <div class="row">
            <div class="col-lg-6">
                <div class="best-deal-slider">
                        <div class="swiper product-gallery-slider">
                            <div class="swiper-wrapper">
                                <?php if(!empty( $attachment_ids ) ){ ?>
                                    <?php foreach($attachment_ids as $thumb_id): 
                                        $thumb_img = wp_get_attachment_image($thumb_id, 'medium');
                                        ?>
                                        <div class="swiper-slide">
                                            <div class="gallery-image">
                                                <?php echo wp_kses_post( $thumb_img );?>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                <?php } else{ ?>
                                    <div class="gallery-image">
                                        <?php the_post_thumbnail()?>
                                    </div>
                                <?php }?>
                            </div>
                            <div class="swiper-navigation">
                                <div class="swiper-button-prev">
                                    <svg width="17" height="10" viewBox="0 0 17 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M17 5C17 5.18941 16.9295 5.37106 16.8041 5.50499C16.6786 5.63892 16.5085 5.71416 16.3311 5.71416H2.28494L5.15734 8.77932C5.21954 8.84572 5.26887 8.92454 5.30253 9.0113C5.33619 9.09805 5.35352 9.19104 5.35352 9.28494C5.35352 9.37884 5.33619 9.47183 5.30253 9.55858C5.26887 9.64534 5.21954 9.72416 5.15734 9.79056C5.09515 9.85696 5.02131 9.90963 4.94005 9.94557C4.85879 9.9815 4.77169 10 4.68374 10C4.59578 10 4.50868 9.9815 4.42742 9.94557C4.34616 9.90963 4.27233 9.85696 4.21013 9.79056L0.196525 5.50562C0.134229 5.43928 0.0848042 5.36048 0.0510813 5.27371C0.0173583 5.18695 0 5.09394 0 5C0 4.90606 0.0173583 4.81305 0.0510813 4.72629C0.0848042 4.63952 0.134229 4.56072 0.196525 4.49438L4.21013 0.209436C4.33574 0.0753365 4.5061 0 4.68374 0C4.86137 0 5.03173 0.0753365 5.15734 0.209436C5.28295 0.343536 5.35352 0.525414 5.35352 0.715059C5.35352 0.904705 5.28295 1.08658 5.15734 1.22068L2.28494 4.28584H16.3311C16.5085 4.28584 16.6786 4.36108 16.8041 4.49502C16.9295 4.62895 17 4.81059 17 5Z" fill="currentColor">
                                        </path>
                                    </svg>
                                </div>
                                <div class="swiper-button-next">
                                    <svg width="17" height="10" viewBox="0 0 17 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M0 5C0 5.18941 0.0704765 5.37106 0.195927 5.50499C0.321377 5.63892 0.491522 5.71416 0.668934 5.71416H14.7151L11.8427 8.77932C11.7805 8.84572 11.7311 8.92454 11.6975 9.0113C11.6638 9.09805 11.6465 9.19104 11.6465 9.28494C11.6465 9.37884 11.6638 9.47183 11.6975 9.55858C11.7311 9.64534 11.7805 9.72416 11.8427 9.79056C11.9049 9.85696 11.9787 9.90963 12.0599 9.94557C12.1412 9.9815 12.2283 10 12.3163 10C12.4042 10 12.4913 9.9815 12.5726 9.94557C12.6538 9.90963 12.7277 9.85696 12.7899 9.79056L16.8035 5.50562C16.8658 5.43928 16.9152 5.36048 16.9489 5.27371C16.9826 5.18695 17 5.09394 17 5C17 4.90606 16.9826 4.81305 16.9489 4.72629C16.9152 4.63952 16.8658 4.56072 16.8035 4.49438L12.7899 0.209436C12.6643 0.0753365 12.4939 0 12.3163 0C12.1386 0 11.9683 0.0753365 11.8427 0.209436C11.717 0.343536 11.6465 0.525414 11.6465 0.715059C11.6465 0.904705 11.717 1.08658 11.8427 1.22068L14.7151 4.28584H0.668934C0.491522 4.28584 0.321377 4.36108 0.195927 4.49502C0.0704765 4.62895 0 4.81059 0 5Z" fill="currentColor">
                                        </path>
                                    </svg>
                                </div>
                            </div>
                        </div>
                        <?php if(!empty( $attachment_ids ) ){ ?>
                            <div class="swiper prouduct-thumb-slider">
                                    <div class="swiper-wrapper">
                                        <?php foreach($attachment_ids as $thumb_gallery_id): 
                                            $thumb_img = wp_get_attachment_image($thumb_gallery_id, 'thumbnail');
                                            ?>
                                            <div class="swiper-slide">
                                                <div class="gallery-image">
                                                    <?php echo wp_kses_post( $thumb_img );?>
                                                </div>
                                            </div>
                                        <?php endforeach; ?>
                                    </div>
                            </div>
                        <?php }?>
                </div>
            </div>
            <div class="col-lg-6">
                <?php if($query->have_posts()): ?>
                    <div class="product-content">
                        <?php while($query->have_posts()):$query->the_post(); 
                            $cat = '';
                            $id = get_the_ID();
                            $product = wc_get_product( $id );
                            $terms = get_the_terms( $id, 'product_cat' );
                            if ( $terms ) {
                                $term = array_pop( $terms );
                                $cat  = $term->name;
                                $cat_link=get_term_link( $term );
                            }
                            
                            $price = $product->get_price_html();
                        ?>
                            <?php if ( $cat && $data['cat_display']=='yes'): ?>
                                <div class="product-cat"><a href="<?php echo esc_url($cat_link) ?>"><?php echo wp_kses_post($cat); ?></a>
                                </div>
                            <?php endif; ?>
                                <h3 class="rt-title"><a href="<?php the_permalink();?>"><?php the_title();?></a></h3>
                            <?php if($data['rating_display']=='yes'){ ?>
                                <div class="rating-custom">
                                    <?php WC_Functions::gymat_product_rating(true); ?>
                                </div>
                            <?php } ?>
                            <div class="rt-price"><?php echo wp_kses_post( $price );?></div>
                            <?php if($data['buttontext']){ ?>
                                <div class="shop-btn">
                                    <a class="btn-style1" <?php echo esc_attr($attr); ?> href="<?php echo esc_url( $data['buttonurl']['url'] );?>"><span><?php echo esc_html($data['buttontext']); ?><svg width="21" height="12" viewBox="0 0 21 12" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M0 6C0 6.22729 0.087059 6.44527 0.242027 6.60598C0.396994 6.7667 0.607174 6.85699 0.82633 6.85699H18.1774L14.6292 10.5352C14.5523 10.6149 14.4914 10.7095 14.4498 10.8136C14.4082 10.9177 14.3868 11.0292 14.3868 11.1419C14.3868 11.2546 14.4082 11.3662 14.4498 11.4703C14.4914 11.5744 14.5523 11.669 14.6292 11.7487C14.706 11.8284 14.7972 11.8916 14.8976 11.9347C14.998 11.9778 15.1056 12 15.2142 12C15.3229 12 15.4304 11.9778 15.5308 11.9347C15.6312 11.8916 15.7224 11.8284 15.7992 11.7487L20.7572 6.60675C20.8342 6.52714 20.8952 6.43257 20.9369 6.32846C20.9786 6.22434 21 6.11272 21 6C21 5.88728 20.9786 5.77566 20.9369 5.67154C20.8952 5.56743 20.8342 5.47286 20.7572 5.39325L15.7992 0.251323C15.6441 0.0904038 15.4336 0 15.2142 0C14.9948 0 14.7843 0.0904038 14.6292 0.251323C14.474 0.412243 14.3868 0.630497 14.3868 0.858071C14.3868 1.08565 14.474 1.3039 14.6292 1.46482L18.1774 5.14301H0.82633C0.607174 5.14301 0.396994 5.2333 0.242027 5.39402C0.087059 5.55474 0 5.77271 0 6Z" fill="white"></path>
                                        </svg></span></a>
                                </div>
                            <?php } ?>    
                        <?php endwhile; ?>
                    </div>
                <?php endif;?>
            </div>
        </div>
    </div>
    
</div>
<?php
if ( !is_woocommerce() ){
    echo '</div>';
}
?>
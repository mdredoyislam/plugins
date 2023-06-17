<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

$args = array(
        'posts_per_page'      => $data['item_no'],
        'post_status'         => 'publish',
        'post_type'           => 'product',
        'no_found_rows'       => 1,
        'suppress_filters'    => false,
        'tax_query'           => array(
                    'relation' => 'AND',
                ),
    ); 
 
$shop_permalink = get_permalink( wc_get_page_id( 'shop' ) );

if ( !empty( $data['cat'] ) ) {
    $args['tax_query'] = array(
        array(
            'taxonomy' => 'product_cat',
            'field' => 'term_id',
            'terms' => $data['cat'],
        )
    );
}

if(!empty($data['filter'])){
    switch($data['filter']){
        case 'featured':
            $args['tax_query'][] = array(
                'taxonomy' => 'product_visibility',
                'field'    => 'slug',
                'terms'    => 'featured',
            );
            break;
        case 'onsale':
                $product_ids_on_sale    = wc_get_product_ids_on_sale();
				$args['post__in'] = $product_ids_on_sale;
				break;
    }
}
// Order
if(!empty($data['orderby'])){
    switch ($data['orderby']) {
        case 'title':
            $args['orderby'] ='title';
            $args['order']   =$data['sortby'];
            break;
        case 'rand':
            $args['orderby'] = 'rand';
            break;
        case 'bestseller':
            $args['meta_key'] = 'total_sales';
            $args['orderby']  = 'meta_value_num';
            $args['order']   =$data['sortby'];
            break;

        case 'price_l':
            $args['orderby']  = 'meta_value_num';
            $args['order']    = 'ASC';
            $args['meta_key'] = '_price';
            break;

        case 'price_h':
            $args['orderby']  = 'meta_value_num';
            $args['meta_key'] = '_price';
            break;
        default:
            $args['orderby'] ='date';
            $args['order']   =$data['sortby'];
            break;   
    }
}

$query = new WP_Query( $args );

if ( !is_woocommerce() ){
    echo '<div class="woocommerce">';
}
?>
<div class="product-slider-addon">
    <?php if ( $query->have_posts() ) { ?>
        <div class="product-list-slider" data-xld ="<?php echo esc_attr( $data['swiper_data'] );?>">
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
                <?php if($data['display_arrow']=='yes'){ ?>
                    <div class="swiper-button">
                        <div class="swiper-grid-button-prev">
                            <svg width="21" height="12" viewBox="0 0 21 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M21 6C21 6.22729 20.9129 6.44527 20.758 6.60598C20.603 6.7667 20.3928 6.85699 20.1737 6.85699H2.82257L6.37083 10.5352C6.44766 10.6149 6.50861 10.7095 6.55019 10.8136C6.59177 10.9177 6.61317 11.0292 6.61317 11.1419C6.61317 11.2546 6.59177 11.3662 6.55019 11.4703C6.50861 11.5744 6.44766 11.669 6.37083 11.7487C6.29401 11.8284 6.2028 11.8916 6.10242 11.9347C6.00203 11.9778 5.89444 12 5.78579 12C5.67714 12 5.56955 11.9778 5.46917 11.9347C5.36879 11.8916 5.27758 11.8284 5.20075 11.7487L0.242766 6.60675C0.165812 6.52714 0.104758 6.43257 0.0631004 6.32846C0.0214427 6.22434 0 6.11272 0 6C0 5.88728 0.0214427 5.77566 0.0631004 5.67154C0.104758 5.56743 0.165812 5.47286 0.242766 5.39325L5.20075 0.251323C5.35591 0.0904038 5.56636 0 5.78579 0C6.00523 0 6.21567 0.0904038 6.37083 0.251323C6.526 0.412243 6.61317 0.630497 6.61317 0.858071C6.61317 1.08565 6.526 1.3039 6.37083 1.46482L2.82257 5.14301H20.1737C20.3928 5.14301 20.603 5.2333 20.758 5.39402C20.9129 5.55474 21 5.77271 21 6Z" fill="currentColor"></path>
                            </svg>
                        </div>
                        <div class="swiper-grid-button-next">
                            <svg width="21" height="12" viewBox="0 0 21 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M0 6C0 6.22729 0.0870602 6.44527 0.242027 6.60598C0.396994 6.7667 0.607174 6.85699 0.82633 6.85699H18.1774L14.6292 10.5352C14.5523 10.6149 14.4914 10.7095 14.4498 10.8136C14.4082 10.9177 14.3868 11.0292 14.3868 11.1419C14.3868 11.2546 14.4082 11.3662 14.4498 11.4703C14.4914 11.5744 14.5523 11.669 14.6292 11.7487C14.706 11.8284 14.7972 11.8916 14.8976 11.9347C14.998 11.9778 15.1056 12 15.2142 12C15.3229 12 15.4304 11.9778 15.5308 11.9347C15.6312 11.8916 15.7224 11.8284 15.7992 11.7487L20.7572 6.60675C20.8342 6.52714 20.8952 6.43257 20.9369 6.32846C20.9786 6.22434 21 6.11272 21 6C21 5.88728 20.9786 5.77566 20.9369 5.67154C20.8952 5.56743 20.8342 5.47286 20.7572 5.39325L15.7992 0.251323C15.6441 0.0904038 15.4336 0 15.2142 0C14.9948 0 14.7843 0.0904038 14.6292 0.251323C14.474 0.412243 14.3868 0.630497 14.3868 0.858071C14.3868 1.08565 14.474 1.3039 14.6292 1.46482L18.1774 5.14301H0.82633C0.607174 5.14301 0.396994 5.2333 0.242027 5.39402C0.0870602 5.55474 0 5.77271 0 6Z" fill="currentColor"></path>
                            </svg>
                        </div>
                    </div>
                <?php } ?>
            </div>
            <div class="swiper-wrapper">
                <?php $i = $data['delay']; $j = $data['duration']; ?>
                <?php while ( $query->have_posts() ) : $query->the_post();?>
                    <?php
                    $cat = '';
                    $id = get_the_ID();
                    $product = wc_get_product( $id );
                    $terms = get_the_terms( $id, 'product_cat' );
                    //
                    if ( $terms ) {
                        $term = array_pop( $terms );
                        $cat  = $term->name;
                        $cat_link=get_term_link( $term );
                    }
                    
                    $price = $product->get_price_html();
                    ?>
                    <div class="swiper-slide">
                        <div class="woocommerce-layout-2 rt-animate <?php echo esc_attr( $data['animation'] );?> <?php echo esc_attr( $data['animation_effect'] );?>" data-wow-delay="<?php echo esc_attr( $i );?>s" data-wow-duration="<?php echo esc_attr( $j );?>s">
                            <div class="rt-thumb-wrapper">
                                <div class="rt-thumb">
                                    <a  href="<?php the_permalink();?>">
                                        <?php
                                            if ( has_post_thumbnail() ) {
                                                the_post_thumbnail('medium');
                                            }
                                        ?>
                                    </a>
                                    <?php woocommerce_show_product_loop_sale_flash();?>
                                    <div class="rt-buttons-area">		
                                        <?php
                                        if ( GymatTheme::$options['wc_shop_cart_icon'] ){?>
                                                <div class="add-to-cart">
                                                    <?php WC_Functions::print_add_to_cart_icon( $id, true, true ); ?>
                                                </div>
                                        <?php } ?>
                                        <div class="rt-buttons">
                                            <?php if ( $data['wishlist_display']=='yes' ){ ?>
                                                <div class="wishlist-icon">
                                                    <?php WC_Functions::print_add_to_wishlist_icon(); ?>
                                                </div>
                                            <?php }      
                                            if ( $data['quick_view_display']=='yes' ){ ?>
                                                <div class="quick-view-icon">
                                                    <?php WC_Functions::print_quickview_icon(); ?>
                                                </div>
                                            <?php } 
                                            ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="product-content-box">
                                <div class="content-top-area">
                                    <?php if ( $cat && $data['cat_display']=='yes'): ?>
                                        <div class="product-cat"><a href="<?php echo esc_url($cat_link) ?>"><?php echo wp_kses_post($cat); ?></a></div>
                                    <?php endif; ?>
                                    <?php if($data['rating_display']=='yes'){ ?>
                                        <div class="rating-custom">
                                            <?php wc_get_template( 'rating.php' ); ?>
                                        </div>
                                    <?php } ?>
                                </div>
                                <h3 class="rt-title"><a href="<?php the_permalink();?>"><?php the_title();?></a></h3>
                                <div class="rt-price"><?php echo wp_kses_post( $price );?></div>
                            </div>
                        </div>
                    </div>
                <?php 
                    $i = $i + 0.2;
                    endwhile;
                ?>
            </div>
        </div>
    <?php } else{ ?>
        <div><?php esc_html_e( 'No products available', 'gymat-core' ); ?></div>
    <?php } ?>
    <?php wp_reset_query(); ?>
</div>
<?php
if ( !is_woocommerce() ){
    echo '</div>';
}

?>

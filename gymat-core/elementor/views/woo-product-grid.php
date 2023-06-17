<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

$args = array(
    'post_type'      => 'product',
    'posts_per_page' => $data['item_no'],
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
$col_class = "col-lg-{$data['col_lg']} col-md-{$data['col_md']} col-sm-{$data['col_sm']} col-{$data['col_xs']} col-{$data['col_mobile']}";
$query = new WP_Query( $args );

if ( !is_woocommerce() ){
    echo '<div class="woocommerce">';
}
?>
<div class="product-grid-addon">
    <?php if ( $query->have_posts() ) { ?>
        <ul class="product-list-wrap row">
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
            <li class="<?php echo esc_attr( $col_class );?>">
                <div class="rt-product-block rt-product-block-1">
                    <div class="rt-thumb-wrapper">
                        <div class="rt-thumb">
                            <a  href="<?php the_permalink();?>">
                                <?php
                                if ( has_post_thumbnail() ) {
                                    the_post_thumbnail('thumbnail');
                                }
                                ?>
                            </a>
                        </div>
                        <?php woocommerce_show_product_loop_sale_flash();?>
                        <div class="rt-buttons-area">
                            <div class="rt-buttons">				
                                <div class="btn-icons">
                                    <?php
                                        if ( $data['wishlist_display']=='yes' )  WC_Functions::print_add_to_wishlist_icon();
                                        if ( $data['quick_view_display']=='yes' ) WC_Functions::print_quickview_icon();
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="price-title-box">
                        <div class="rt-title-area">
                            <h3 class="rt-title"><a href="<?php the_permalink();?>"><?php the_title();?></a></h3>
                        </div>
                        <?php if ( $cat && $data['cat_display']=='yes'): ?>
                            <div class="rtin-cat"><a href="<?php echo esc_url($cat_link) ?>"><?php echo wp_kses_post($cat); ?></a></div>
                        <?php endif; ?>
                        <?php if($data['rating_display']=='yes'){ ?>
                            <div class="rating-custom">
                                <?php wc_get_template( 'rating.php' ); ?>
                            </div>
                        <?php } ?>
                        <div class="rt-price-area">
                            
                            <div class="rt-price"><?php echo wp_kses_post( $price );?></div>
                            
                        </div>
                        <div class="add-to-cart">
                            <?php 
                                if ( GymatTheme::$options['wc_shop_cart_icon'] ) WC_Functions::print_add_to_cart_icon( $id, true, true );
                            ?>
                        </div>
                    </div>
                    
                </div>
            </li>
        <?php endwhile;?>
        <?php if($data['more_btn_display']=='yes'){ ?>
            <div class="shop-page-link"><a class="btn-style1" href="<?php echo esc_url( $shop_permalink ); ?>"><span><?php echo wp_kses_post($data['more_btn_text']);?><svg width="21" height="12" viewBox="0 0 21 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" clip-rule="evenodd" d="M0 6C0 6.22729 0.087059 6.44527 0.242027 6.60598C0.396994 6.7667 0.607174 6.85699 0.82633 6.85699H18.1774L14.6292 10.5352C14.5523 10.6149 14.4914 10.7095 14.4498 10.8136C14.4082 10.9177 14.3868 11.0292 14.3868 11.1419C14.3868 11.2546 14.4082 11.3662 14.4498 11.4703C14.4914 11.5744 14.5523 11.669 14.6292 11.7487C14.706 11.8284 14.7972 11.8916 14.8976 11.9347C14.998 11.9778 15.1056 12 15.2142 12C15.3229 12 15.4304 11.9778 15.5308 11.9347C15.6312 11.8916 15.7224 11.8284 15.7992 11.7487L20.7572 6.60675C20.8342 6.52714 20.8952 6.43257 20.9369 6.32846C20.9786 6.22434 21 6.11272 21 6C21 5.88728 20.9786 5.77566 20.9369 5.67154C20.8952 5.56743 20.8342 5.47286 20.7572 5.39325L15.7992 0.251323C15.6441 0.0904038 15.4336 0 15.2142 0C14.9948 0 14.7843 0.0904038 14.6292 0.251323C14.474 0.412243 14.3868 0.630497 14.3868 0.858071C14.3868 1.08565 14.474 1.3039 14.6292 1.46482L18.1774 5.14301H0.82633C0.607174 5.14301 0.396994 5.2333 0.242027 5.39402C0.087059 5.55474 0 5.77271 0 6Z" fill="white"/>
                </svg></span></a>
            </div>
        <?php } ?>
        </ul>
    <?php } else{ ?>
        <div><?php esc_html_e( 'No products available', 'gymat-core' ); ?></div>
    <?php } ?>
    <?php wp_reset_query(); ?>
</div>
<?php
if ( !is_woocommerce() ){
    echo '</div>';
}
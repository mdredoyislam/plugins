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
 
$shop_permalink = get_permalink( wc_get_page_id( 'shop' ) );


$query = new WP_Query( $args );
$full_width=$data['product_box_width']=='yes' ?'full-width':'no-full-width';
if ( !is_woocommerce() ){
    echo '<div class="woocommerce">';
}
?>
<?php if ( $query->have_posts() ) { ?>
    <div class="single-product-addon">
        <?php while ( $query->have_posts() ) : $query->the_post();?>
            <?php
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
            <div class="product-item <?php echo esc_attr($full_width);?>">
                <div class="product-content-box">
                    <?php if ( $cat && $data['cat_display']=='yes'): ?>
                        <div class="product-cat"><a href="<?php echo esc_url($cat_link) ?>"><?php echo wp_kses_post($cat); ?></a></div>
                    <?php endif; ?>
                    <h3 class="rt-title"><a href="<?php the_permalink();?>"><?php the_title();?></a></h3>
                    <?php if($data['rating_display']=='yes'){ ?>
                        <div class="rating-custom">
                            <?php WC_Functions::gymat_product_rating(true); ?>
                        </div>
                    <?php } ?>
                    <div class="rt-price"><?php echo wp_kses_post( $price );?></div>
                </div>
                <div class="rt-thumb">
                    <a  href="<?php the_permalink();?>">
                        <?php
                            if ( has_post_thumbnail() ) {
                                the_post_thumbnail(['120','120']);
                            }
                        ?>
                    </a>
                </div>
            </div>
        <?php endwhile;?>
        <?php wp_reset_query(); ?>
    </div>
<?php } else{ ?>
        <div><?php esc_html_e( 'No products available', 'gymat-core' ); ?></div>
    <?php } ?>
<?php
if ( !is_woocommerce() ){
    echo '</div>';
}

?>
 
<?php
/**
 *
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

namespace radiustheme\Gymat_Core;

use GymatTheme;
use GymatTheme_Helper;
use \WP_Query;

extract( $data );

if ( get_query_var('paged') ) {
    $paged = get_query_var('paged');
}
else if ( get_query_var('page') ) {
    $paged = get_query_var('page');
}
else {
    $paged = 1;
}

$args = array(
    'post_type'      => 'gymat_gallery',
    'posts_per_page' => $data['number'],
    'orderby'        => $data['orderby'],
    'paged' 		 => $paged,
    'post_status'    =>'publish'
);
if ( !empty( $data['cat'] ) ) {
    $args['tax_query'] = array(
        array(
            'taxonomy' => 'gymat_gallery_category',
            'field' => 'term_id',
            'terms' => $data['cat'],
        )
    );
}

switch ( $data['orderby'] ) {
    case 'title':
    case 'menu_order':
        $args['order'] = 'ASC';
        break;
}
$grid_query = new WP_Query($args);

$temp = GymatTheme_Helper::wp_set_temp_query( $grid_query );

$col_class = "col-lg-{$data['col_lg']} col-md-{$data['col_md']} col-sm-{$data['col_sm']} col-{$data['col_xs']} col-{$data['col_mobile']}";
?>

<?php if ( $grid_query->have_posts() ):

    ?>
    <div class="gallery-default gallery-multi-layout-1 ">
        <div class="row auto-clear">
            <?php
            while ( $grid_query->have_posts() ) : $grid_query->the_post();
                $id            	= get_the_id();
                $content = apply_filters( 'the_content', get_the_content() );
                $gallery_title = wp_trim_words( get_the_title(), $title_count, '' );
                $content = wp_trim_words( $content, $data['excerpt_count'], '' );
                ?>
                <div class="<?php echo esc_attr( $col_class );?>">
                    <div class="gallery-item">
                        <div class="gallery-figure">

                            <?php
                            if ( has_post_thumbnail() ){
                                the_post_thumbnail( 'full', ['class' => 'img-fluid mb-10 width-100'] );
                            } else {
                                if ( !empty( GymatTheme::$options['no_preview_image']['id'] ) ) {
                                    echo wp_get_attachment_image( GymatTheme::$options['no_preview_image']['id'], 'full' );
                                } else {
                                    echo '<img class="wp-post-image" src="' . GymatTheme_Helper::get_img( 'noimage_370X328.jpg' ) . '" alt="'.get_the_title().'">';
                                }
                            }
                            ?>

                            <div class="gallery-content">
                                <h3 class="gallery-title"><?php the_title();?></h3>
                                <?php if ( $data['cat_display']=='yes') { ?>
                                    <div class="gallery-cat"><?php
                                        $i = 1;
                                        $term_lists = get_the_terms( get_the_ID(), 'gymat_gallery_category' );
                                        if($term_lists){
                                            foreach ( $term_lists as $term_list ){
                                                $link = get_term_link( $term_list->term_id, 'gymat_gallery_category' ); ?><?php if ( $i > 1 ){ echo esc_html( ', ' ); } ?><a href="<?php echo esc_url( $link ); ?>"><?php echo esc_html( $term_list->name ); ?></a><?php $i++; }
                                        } ?>
                                    </div>
                                <?php } ?>
                                <?php if ($data['excerpt_display']=='yes' ) { ?>
                                    <p><?php echo wp_kses( $content , 'alltext_allow' ); ?></p>
                                <?php } ?>
                            </div>
                            <?php if ( $data['view_project_link_btn'] ) { ?>
                                <div class="gallery-button">
                                    <a href="<?php echo wp_get_attachment_url( get_post_thumbnail_id() ); ?>" class="gallery-btn img-popup-icon" data-elementor-open-lightbox="yes" data-elementor-lightbox-slideshow="1" data-elementor-lightbox-title="<?php echo get_the_title(); ?>"><i class="fas fa-long-arrow-alt-right"></i></a>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            <?php endwhile; ?>
        </div>
        <?php  if ( $data['more_button_display']  == 'yes' ) : ?>
            <?php if ( $data['more_button'] == 'show' ) { ?>
                <?php if ( !empty( $data['see_button_text'] ) ) { ?>
                    <div class="trainer-button wow fadeInUp mt-5 text-center rt-animate" data-wow-delay="1.4s" data-wow-duration="0.8s"><a class="btn-style1" href="<?php echo esc_url( $data['see_button_link'] );?>"><span><?php echo esc_html( $data['see_button_text'] );?><i class="fas fa-long-arrow-alt-right"></i></span></a></div>
                <?php } ?>
            <?php } else { ?>
                <?php GymatTheme_Helper::pagination(); ?>
            <?php } ?>
        <?php endif; ?>
        <?php GymatTheme_Helper::wp_reset_temp_query( $temp ); ?>
    </div>
    
<?php endif; ?>


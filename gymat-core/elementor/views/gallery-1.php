<?php
/**
 *
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

namespace radiustheme\Consalty_Core;

use GymatTheme;
use GymatTheme_Helper;
use \WP_Query;

extract( $data );


$grid_query = null;
$args = array(
    'post_type'      => 'gymat_gallery',
    'post_status'    => 'publish',
    'posts_per_page' => 1,
    'p'       => $data['single_post'],
);

$grid_query = new WP_Query($args);

?>

<?php if ( $grid_query->have_posts() ): 

?>
<div class="gallery-default gallery-multi-layout-1 ">
	<?php
	    while ( $grid_query->have_posts() ) : $grid_query->the_post();
            $id            	= get_the_id();
			$content = apply_filters( 'the_content', get_the_content() );
			$gallery_title = wp_trim_words( get_the_title(), $title_count, '' );
			$content = wp_trim_words( $content, $data['excerpt_count'], '' );
	 ?>
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
    
	<?php endwhile; wp_reset_postdata(); ?>
</div>

<?php endif; ?>


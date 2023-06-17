<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

namespace radiustheme\Gymat_Core;

use GymatTheme;
use GymatTheme_Helper;
use \WP_Query;

$prefix      = GYMAT_CORE_THEME_PREFIX;
$thumb_size  = 'full';

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
	'post_type'      => 'gymat_trainer',
	'posts_per_page' => $data['number'],
	'orderby'        => $data['orderby'],
	'paged'          => $paged,
	'post_status'    =>'publish'
);

if ( !empty( $data['cat'] ) ) {
	$args['tax_query'] = array(
		array(
			'taxonomy' => 'gymat_trainer_category',
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

$query = new WP_Query( $args );
$temp = GymatTheme_Helper::wp_set_temp_query( $query );

$trainer_shape_image=wp_get_attachment_image($data['trainer_shape_image']['id'],'full');

$col_class = "col-lg-{$data['col_lg']} col-md-{$data['col_md']} col-sm-{$data['col_sm']} col-{$data['col_xs']} col-{$data['col_mobile']}";
?>
<div class="trainer-default trainer-multi-layout-4 trainer-grid-<?php echo esc_attr( $data['style'] );?>">
	<div class="row auto-clear">
		<?php 
		$i = $data['delay']; $j = $data['duration'];
		 if ( $query->have_posts() ) {
			while ( $query->have_posts() ) {
			$query->the_post();
			$id            	= get_the_id();
			$position   	= get_post_meta( $id, 'gymat_trainer_designation', true );
			$socials       	= get_post_meta( $id, 'gymat_trainer_socials', true );
			$social_fields 	= GymatTheme_Helper::trainer_socials();
			$content = apply_filters( 'the_content', get_the_content() );
			$content = wp_trim_words( $content, $data['count'], '' );
			$content = "<p>$content</p>";
		?>
			<div class="<?php echo esc_attr( $col_class );?>">
			    
                <div class="trainer-item rt-animate <?php echo esc_attr( $data['animation'] );?> <?php echo esc_attr( $data['animation_effect'] );?>" data-wow-delay="<?php echo esc_attr( $i );?>s" data-wow-duration="<?php echo esc_attr( $j );?>s">
                    <div class="item-content">
                        <h3 class="trainer-title wow fadeInLeft rt-animate" data-wow-delay="400ms" data-wow-duration="1200ms"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                        <?php if ( $position && $data['designation_display']  == 'yes' ) { ?>
                            <h4 class="trainer-designation wow fadeInLeft rt-animate" data-wow-delay="600ms" data-wow-duration="1200ms"><?php echo esc_html( $position );?></h4>
						<?php } ?>
                        <div class="item-social wow fadeInLeft rt-animate" data-wow-delay="800ms" data-wow-duration="1200ms" >
                        <?php if ( !empty( $socials ) && $data['social_display']  == 'yes' ) { ?>
                            <div class="trainer-socials">
                                <ul class="trainer-social-icon">
                                    <?php foreach ( $socials as $key => $social ): ?>
                                        <?php if ( !empty( $social ) ): ?>
                                            <li><a target="_blank" href="<?php echo esc_url( $social );?>"><i class="fab <?php echo esc_attr( $social_fields[$key]['icon'] );?>" aria-hidden="true"></i></a>
                                            </li>
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                </ul>
                            </div>
                        <?php } ?>
                        </div>
                    </div>
                    <div class="item-img wow fadeInUp rt-animate" data-wow-delay="400ms" data-wow-duration="1200ms">
                    <?php
                        if ( has_post_thumbnail() ){
                            the_post_thumbnail( $thumb_size );
                        }
                        else {
                            if ( !empty( GymatTheme::$options['no_preview_image']['id'] ) ) {
                                echo wp_get_attachment_image( GymatTheme::$options['no_preview_image']['id'], $thumb_size );
                            }
                            else {
                                echo '<img class="wp-post-image" src="' . GymatTheme_Helper::get_img( 'noimage_400X400.jpg' ) . '" alt="'.get_the_title().'">';
                            }
                        }
                        ?>
                    </div>
                    <div class="item-icon-shape-1">
                        <svg width="420" height="248" viewBox="0 0 420 248" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M166.5 170.989C45.5 164.989 30.5 230.656 0.5 264.489C19.6667 280.156 61.7 313.089 76.5 319.489C95 327.489 148 330.989 186 330.989C224 330.989 363.5 313.989 408.5 311.489C444.5 309.489 470.5 288.322 479 277.989L528.5 80.989L420 0.489014C420 0.489014 350.787 180.127 166.5 170.989Z" fill="#E1002E"></path>
                        </svg>
                    </div>
                    <div class="item-icon-shape-2">
                        <svg width="430" height="258" viewBox="0 0 430 258" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M166.5 170.989C45.5 164.989 30.5 230.656 0.5 264.489C19.6667 280.156 61.7 313.089 76.5 319.489C95 327.489 148 330.989 186 330.989C224 330.989 363.5 313.989 408.5 311.489C444.5 309.489 470.5 288.322 479 277.989L528.5 80.989L420 0.489014C420 0.489014 350.787 180.127 166.5 170.989Z" fill="#FF0336"></path>
                        </svg>
                    </div>
                </div>
			</div>
			<?php $i = $i + 0.2; } ?>
		<?php } ?>
	</div>
	<?php  if ( $data['more_button_display']  == 'yes' ) : ?>	
		<?php if ( $data['more_button'] == 'show' ) { ?>
			<?php if ( !empty( $data['see_button_text'] ) ) { ?>
			<div class="trainer-button wow fadeInUp rt-animate" data-wow-delay="1.4s" data-wow-duration="0.8s"><a class="btn-style1" href="<?php echo esc_url( $data['see_button_link'] );?>"><span><?php echo esc_html( $data['see_button_text'] );?><i class="fas fa-long-arrow-alt-right"></i></span></a></div>
			<?php } ?>
		<?php } else { ?>
			<?php GymatTheme_Helper::pagination(); ?>
		<?php } ?>
	<?php endif; ?>
	<?php GymatTheme_Helper::wp_reset_temp_query( $temp ); ?>
</div>
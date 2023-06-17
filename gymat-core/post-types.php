<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

namespace radiustheme\Gymat_Core;
use \RT_Posts;
use GymatTheme;


if ( !class_exists( 'RT_Posts' ) ) {
	return;
}

$post_types = array(
	'gymat_trainer'       => array(
		'title'           => __( 'Trainer Member', 'gymat-core' ),
		'plural_title'    => __( 'Trainers', 'gymat-core' ),
		'menu_icon'       => 'dashicons-businessman',
		'labels_override' => array(
			'menu_name'   => __( 'Trainer', 'gymat-core' ),
		),
		'rewrite'         => GymatTheme::$options['trainer_slug'],
		'supports'        => array( 'title', 'thumbnail', 'editor', 'excerpt', 'page-attributes' )
	),
	'gymat_class' => array(
		'title'           => __( 'Class', 'gymat-core' ),
		'plural_title'    => __( 'Classes', 'gymat-core' ),
		'menu_icon'       => 'dashicons-portfolio',
		'rewrite'         => GymatTheme::$options['class_slug'],
		'supports'        => array( 'title', 'thumbnail', 'editor', 'excerpt', 'page-attributes' ),
	),
	'gymat_testim'     => array(
		'title'           => __( 'Testimonial', 'gymat-core' ),
		'plural_title'    => __( 'Testimonials', 'gymat-core' ),
		'menu_icon'       => 'dashicons-awards',
		'rewrite'         => GymatTheme::$options['testimonial_slug'],
		'supports'        => array( 'title', 'thumbnail', 'editor', 'page-attributes' )
	),
	'gymat_gallery'     => array(
		'title'           => __( 'Gallery', 'gymat-core' ),
		'plural_title'    => __( 'Galleries', 'gymat-core' ),
		'menu_icon'       => 'dashicons-format-gallery',
		'rewrite'         => GymatTheme::$options['gallery_slug'],
		'supports'     => array( 'title', 'thumbnail', 'editor','excerpt', 'page-attributes' ),
	),
);

$taxonomies = array(
	'gymat_trainer_category' => array(
		'title'        => __( 'Trainer Category', 'gymat-core' ),
		'plural_title' => __( 'Trainers Categories', 'gymat-core' ),
		'post_types'   => 'gymat_trainer',
		'rewrite'      => array( 'slug' => GymatTheme::$options['trainer_cat_slug'] ),
	),
	'gymat_class_category' => array(
		'title'        => __( 'Class Category', 'gymat-core' ),
		'plural_title' => __( 'Classes Categories', 'gymat-core' ),
		'post_types'   => 'gymat_class',
		'rewrite'      => array( 'slug' => GymatTheme::$options['class_cat_slug'] ),
	),
	'gymat_testimonial_category' => array(
		'title'        => __( 'Testimonial Category', 'gymat-core' ),
		'plural_title' => __( 'Testimonial Categories', 'gymat-core' ),
		'post_types'   => 'gymat_testim',
		'rewrite'      => array( 'slug' => GymatTheme::$options['testim_cat_slug'] ),
	),
	'gymat_gallery_category' => array(
		'title'        => __( 'Gallery Category', 'gymat-core' ),
		'plural_title' => __( 'Gallery Categories', 'gymat-core' ),
		'post_types'   => 'gymat_gallery',
		'rewrite'      => array( 'slug' => GymatTheme::$options['gallery_cat_slug'] ),
	),
);

$Posts = RT_Posts::getInstance();
$Posts->add_post_types( $post_types );
$Posts->add_taxonomies( $taxonomies );
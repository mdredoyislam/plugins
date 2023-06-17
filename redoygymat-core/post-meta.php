<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

namespace radiustheme\Gymat_Core;

use GymatTheme;
use GymatTheme_Helper;
use \RT_Postmeta;

if ( ! defined( 'ABSPATH' ) ) exit;

if ( !class_exists( 'RT_Postmeta' ) ) {
	return;
}

$Postmeta = RT_Postmeta::getInstance();

$prefix = GYMAT_CORE_CPT_PREFIX;

/*-------------------------------------
#. Layout Settings
---------------------------------------*/
$nav_menus = wp_get_nav_menus( array( 'fields' => 'id=>name' ) );
$nav_menus = array( 'default' => __( 'Default', 'gymat-core' ) ) + $nav_menus;
$sidebars  = array( 'default' => __( 'Default', 'gymat-core' ) ) + GymatTheme_Helper::custom_sidebar_fields();

$Postmeta->add_meta_box( "{$prefix}_page_settings", __( 'Layout Settings', 'gymat-core' ), array( 'page', 'post', 'gymat_trainer', 'gymat_class',  'gymat_testim' ), '', '', 'high', array(
	'fields' => array(
	
		"{$prefix}_layout_settings" => array(
			'label'   => __( 'Layouts', 'gymat-core' ),
			'type'    => 'group',
			'value'  => array(	
			
				"{$prefix}_layout" => array(
					'label'   => __( 'Layout', 'gymat-core' ),
					'type'    => 'select',
					'options' => array(
						'default'       => __( 'Default', 'gymat-core' ),
						'full-width'    => __( 'Full Width', 'gymat-core' ),
						'left-sidebar'  => __( 'Left Sidebar', 'gymat-core' ),
						'right-sidebar' => __( 'Right Sidebar', 'gymat-core' ),
					),
					'default'  => 'default',
				),		
				'gymat_sidebar' => array(
					'label'    => __( 'Custom Sidebar', 'gymat-core' ),
					'type'     => 'select',
					'options'  => $sidebars,
					'default'  => 'default',
				),
				"{$prefix}_page_menu" => array(
					'label'    => __( 'Main Menu', 'gymat-core' ),
					'type'     => 'select',
					'options'  => $nav_menus,
					'default'  => 'default',
				),
				"{$prefix}_tr_header" => array(
					'label'    	  => __( 'Transparent Header', 'gymat-core' ),
					'type'     	  => 'select',
					'options'  	  => array(
						'default' => __( 'Default', 'gymat-core' ),
						'on'      => __( 'Enabled', 'gymat-core' ),
						'off'     => __( 'Disabled', 'gymat-core' ),
					),
					'default'  => 'default',
				),
				"{$prefix}_top_bar" => array(
					'label' 	  => __( 'Top Bar', 'gymat-core' ),
					'type'  	  => 'select',
					'options' => array(
						'default' => __( 'Default', 'gymat-core' ),
						'on'      => __( 'Enabled', 'gymat-core' ),
						'off'     => __( 'Disabled', 'gymat-core' ),
					),
					'default'  	  => 'default',
				),
				"{$prefix}_top_bar_style" => array(
					'label' 	=> __( 'Top Bar Layout', 'gymat-core' ),
					'type'  	=> 'select',
					'options'	=> array(
						'default' => __( 'Default', 'gymat-core' ),
						'1'       => __( 'Layout 1', 'gymat-core' ),
						'2'       => __( 'Layout 2', 'gymat-core' ),
						'3'       => __( 'Layout 3', 'gymat-core' ),
						'4'       => __( 'Layout 4', 'gymat-core' ),
					),
					'default'   => 'default',
				),
				"{$prefix}_header_opt" => array(
					'label' 	  => __( 'Header On/Off', 'gymat-core' ),
					'type'  	  => 'select',
					'options' => array(
						'default' => __( 'Default', 'gymat-core' ),
						'on'      => __( 'Enabled', 'gymat-core' ),
						'off'     => __( 'Disabled', 'gymat-core' ),
					),
					'default'  	  => 'default',
				),
				"{$prefix}_header" => array(
					'label'   => __( 'Header Layout', 'gymat-core' ),
					'type'    => 'select',
					'options' => array(
						'default' => __( 'Default', 'gymat-core' ),
						'1'       => __( 'Layout 1', 'gymat-core' ),
						'2'       => __( 'Layout 2', 'gymat-core' ),
						'3'       => __( 'Layout 3', 'gymat-core' ),
						'4'       => __( 'Layout 4', 'gymat-core' ),
						'5'       => __( 'Layout 5', 'gymat-core' ),
					),
					'default'  => 'default',
				),
				"{$prefix}_footer" => array(
					'label'   => __( 'Footer Layout', 'gymat-core' ),
					'type'    => 'select',
					'options' => array(
						'default' => __( 'Default', 'gymat-core' ),
						'1'       => __( 'Layout 1', 'gymat-core' ),
						'2'       => __( 'Layout 2', 'gymat-core' ),
						'3'       => __( 'Layout 3', 'gymat-core' ),
						'4'       => __( 'Layout 4', 'gymat-core' ),
					),
					'default'  => 'default',
				),
				"{$prefix}_footer_area" => array(
					'label' 	  => __( 'Footer Area', 'gymat-core' ),
					'type'  	  => 'select',
					'options' => array(
						'default' => __( 'Default', 'gymat-core' ),
						'on'      => __( 'Enabled', 'gymat-core' ),
						'off'     => __( 'Disabled', 'gymat-core' ),
					),
					'default'  	  => 'default',
				),
				"{$prefix}_copyright_area" => array(
					'label' 	  => __( 'Copyright Area', 'gymat-core' ),
					'type'  	  => 'select',
					'options' => array(
						'default' => __( 'Default', 'gymat-core' ),
						'on'      => __( 'Enabled', 'gymat-core' ),
						'off'     => __( 'Disabled', 'gymat-core' ),
					),
					'default'  	  => 'default',
				),
				"{$prefix}_top_padding" => array(
					'label'   => __( 'Content Padding Top', 'gymat-core' ),
					'type'    => 'select',
					'options' => array(
						'default' => __( 'Default', 'gymat-core' ),
						'0px'     => __( '0px', 'gymat-core' ),
						'10px'    => __( '10px', 'gymat-core' ),
						'20px'    => __( '20px', 'gymat-core' ),
						'30px'    => __( '30px', 'gymat-core' ),
						'40px'    => __( '40px', 'gymat-core' ),
						'50px'    => __( '50px', 'gymat-core' ),
						'60px'    => __( '60px', 'gymat-core' ),
						'70px'    => __( '70px', 'gymat-core' ),
						'80px'    => __( '80px', 'gymat-core' ),
						'90px'    => __( '90px', 'gymat-core' ),
						'100px'   => __( '100px', 'gymat-core' ),
						'110px'   => __( '110px', 'gymat-core' ),
						'120px'   => __( '120px', 'gymat-core' ),
					),
					'default'  => 'default',
				),
				"{$prefix}_bottom_padding" => array(
					'label'   => __( 'Content Padding Bottom', 'gymat-core' ),
					'type'    => 'select',
					'options' => array(
						'default' => __( 'Default', 'gymat-core' ),
						'0px'     => __( '0px', 'gymat-core' ),
						'10px'    => __( '10px', 'gymat-core' ),
						'20px'    => __( '20px', 'gymat-core' ),
						'30px'    => __( '30px', 'gymat-core' ),
						'40px'    => __( '40px', 'gymat-core' ),
						'50px'    => __( '50px', 'gymat-core' ),
						'60px'    => __( '60px', 'gymat-core' ),
						'70px'    => __( '70px', 'gymat-core' ),
						'80px'    => __( '80px', 'gymat-core' ),
						'90px'    => __( '90px', 'gymat-core' ),
						'100px'   => __( '100px', 'gymat-core' ),
						'110px'   => __( '110px', 'gymat-core' ),
						'120px'   => __( '120px', 'gymat-core' ),
					),
					'default'  => 'default',
				),
				"{$prefix}_banner" => array(
					'label'   => __( 'Banner', 'gymat-core' ),
					'type'    => 'select',
					'options' => array(
						'default' => __( 'Default', 'gymat-core' ),
						'on'	  => __( 'Enable', 'gymat-core' ),
						'off'	  => __( 'Disable', 'gymat-core' ),
					),
					'default'  => 'default',
				),
				"{$prefix}_breadcrumb" => array(
					'label'   => __( 'Breadcrumb', 'gymat-core' ),
					'type'    => 'select',
					'options' => array(
						'default' => __( 'Default', 'gymat-core' ),
						'on'      => __( 'Enable', 'gymat-core' ),
						'off'	  => __( 'Disable', 'gymat-core' ),
					),
					'default'  => 'default',
				),
				"{$prefix}_banner_type" => array(
					'label'   => __( 'Banner Background Type', 'gymat-core' ),
					'type'    => 'select',
					'options' => array(
						'default' => __( 'Default', 'gymat-core' ),
						'bgimg'   => __( 'Background Image', 'gymat-core' ),
						'bgcolor' => __( 'Background Color', 'gymat-core' ),
					),
					'default' => 'default',
				),
				"{$prefix}_banner_bgimg" => array(
					'label' => __( 'Banner Background Image', 'gymat-core' ),
					'type'  => 'image',
					'desc'  => __( 'If not selected, default will be used', 'gymat-core' ),
				),
				"{$prefix}_banner_bgcolor" => array(
					'label' => __( 'Banner Background Color', 'gymat-core' ),
					'type'  => 'color_picker',
					'desc'  => __( 'If not selected, default will be used', 'gymat-core' ),
				),		
				"{$prefix}_page_bgimg" => array(
					'label' => __( 'Page/Post Background Image', 'gymat-core' ),
					'type'  => 'image',
					'desc'  => __( 'If not selected, default will be used', 'gymat-core' ),
				),
				"{$prefix}_page_bgcolor" => array(
					'label' => __( 'Page/Post Background Color', 'gymat-core' ),
					'type'  => 'color_picker',
					'desc'  => __( 'If not selected, default will be used', 'gymat-core' ),
				),
			)
		)
	),
) );

/*-------------------------------------
#. Trainer
---------------------------------------*/
$Postmeta->add_meta_box( 'gymat_trainer_info', __( 'Trainer Info', 'gymat-core' ), array( 'gymat_trainer' ), '', '', 'high', array(
	'fields' => array(
		'gymat_trainer_designation' => array(
			'label' => __( 'Designation', 'gymat-core' ),
			'type'  => 'text',
		),
		'gymat_trainer_contact_form' => array(
			'label' => __( 'Contact Shortcode', 'gymat-core' ),
			'type'  => 'text',
		),
	)
) );

$Postmeta->add_meta_box( 'gymat_trainer_settings', __( 'Trainer Socials', 'gymat-core' ), array( 'gymat_trainer' ), '', '', 'high', array(
	'fields' => array(
		'gymat_trainer_socials_header' => array(
			'label' => __( 'Socials', 'gymat-core' ),
			'type'  => 'header',
			'desc'  => __( 'Enter your social links here', 'gymat-core' ),
		),
		'gymat_trainer_socials' => array(
			'type'  => 'group',
			'value'  => GymatTheme_Helper::trainer_socials()
		),
	)
) );

$Postmeta->add_meta_box( 'trainer_skills', __( 'Trainer Skills', 'gymat-core' ), array( 'gymat_trainer' ), '', '', 'high', array(
	'fields' => array(
		'gymat_trainer_skill' => array(
			'type'  => 'repeater',
			'button' => __( 'Add New Skill', 'gymat-core' ),
			'value'  => array(
				'skill_name' => array(
					'label' => __( 'Skill Name', 'gymat-core' ),
					'type'  => 'text',
					'desc'  => __( 'eg. Yoga', 'gymat-core' ),
				),
				'skill_value' => array(
					'label' => __( 'Skill Percentage (%)', 'gymat-core' ),
					'type'  => 'text',
					'desc'  => __( 'eg. 75', 'gymat-core' ),
				),
			)
		),
	)
) );


/*-------------------------------------
#. Class
---------------------------------------*/

$Postmeta->add_meta_box('gymat_class_info',__( 'Class Info', 'gymat-core' ),array( 'gymat_class' ),'','','high',array(
	'fields'=>array(
		'gymat_class_price'=>array(
			'label' => __( 'Course Price', 'gymat-core' ),
			'type'  => 'text',
			'desc'  => __( 'Only Used in class single page(ex:$40)', 'gymat-core' ),
		),
		'gymat_class_unit'=>array(
			'label' => __( 'Course Price Unit', 'gymat-core' ),
			'type'  => 'text',
			'desc'  => __( 'Only Used in class single page(ex:per month/per year)', 'gymat-core' ),
		),
		'gymat_class_duration'=>array(
			'label' => __( 'Course Duration', 'gymat-core' ),
			'type'  => 'text',
			'desc'  => __( 'Only Used in class single page(ex:60mins/120mins)', 'gymat-core' ),
		),
		'gymat_class_intensity'=>array(
			'label' => __( 'Course Intensity', 'gymat-core' ),
			'type'  => 'text',
			'desc'  => __( 'Only Used in class single page', 'gymat-core' ),
		),
		'gymat_class_video'=>array(
			'label' => __( 'Course Video Link', 'gymat-core' ),
			'type'  => 'text',
			'desc'  => __( 'Only Used in class single page', 'gymat-core' ),
		),
	)
));


$time_picker_format = ( GymatTheme::$options['class_time_format'] == 24 ) ? 'time_picker_24' : 'time_picker';

$Postmeta->add_meta_box( 'gymat_class_schedule', __( 'Schedule', 'gymat-core' ), array( 'gymat_class' ), '', '', 'high', array(
	'fields' => array(
		'gymat_class_color' => array(
			'label' => __( 'Color', 'gymat-core' ),
			'type'  => 'color_picker',
			'desc'  => __( 'Used in Routine Style', 'gymat-core' ),
		),
		'gymat_class_button_text' => array(
			'label' => __( 'Button Text', 'gymat-core' ),
			'type'  => 'text',
			'desc'  => __( 'Enter button text eg. Join Now!', 'gymat-core' ),
		),
		'gymat_class_button_url' => array(
			'label' => __( 'Button URL', 'gymat-core' ),
			'type'  => 'text',
			'desc'  => __( 'Enter button url', 'gymat-core' ),
		),
		'gymat_class_schedule_table_text' => array(
			'label' => __( 'Schedule Table Text', 'gymat-core' ),
			'type'  => 'textarea',
			'desc'  => __( 'Used only class single page on the after  schedule table title', 'gymat-core' ),
		),
		'gymat_class_schedule' => array(
			'type'  => 'repeater',
			'button' => __( 'Add New Schedule', 'gymat-core' ),
			'value'  => array(
				'trainer' => array(
					'label' => __( 'Trainer', 'gymat-core' ),
					'type'  => 'select',
					'options' => GymatTheme_Helper::get_trainers(),
					'default'  => 'default',
				),
				'week' => array(
					'label' => __( 'Weekday', 'gymat-core' ),
					'type'  => 'select',
					'options' => array(
						'none' => __( 'Select a Weekday', 'gymat-core' ),
						'mon'  => __( 'Monday', 'gymat-core' ),
						'tue'  => __( 'Tuesday', 'gymat-core' ),
						'wed'  => __( 'Wednesday', 'gymat-core' ),
						'thu'  => __( 'Thursday', 'gymat-core' ),
						'fri'  => __( 'Friday', 'gymat-core' ),
						'sat'  => __( 'Saturday', 'gymat-core' ),
						'sun'  => __( 'Sunday', 'gymat-core' ),
					),
				),				
				'start_time' => array(
					'label' => __( 'Start Time', 'gymat-core' ),
					'type'  => $time_picker_format,
				),
				'end_time' => array(
					'label' => __( 'End Time', 'gymat-core' ),
					'type'  => $time_picker_format,
				),
			)
		),
	)
) );

//Flat icon uses metabox
$Postmeta->add_meta_box( 'gymat_class_media', __( 'Class Icon image', 'gymat-core' ),array( "gymat_class" ),'',
		'side',
		'default', array(
		'fields' => array(
			"gymat_class_icon" => array(
			  'label' => __( 'Class Icon', 'gymat-core' ),
			  'type'  => 'icon_select',
			  'desc'  => __( "Choose a Icon for your class", 'gymat-core' ),
			  'options' => GymatTheme_Helper::get_icons(),
			),
			"gymat_class_img" => array(
				'label' => __( 'Class Icon Image ', 'insurex-core' ),
				'type'  => 'image',
				'desc'  => __( "Upload Servie image in case of icon not selected", 'gymat-core' ),
			),
		)
) );

/*-------------------------------------
#. Gallery
---------------------------------------*/
$Postmeta->add_meta_box( 'gymat_gallery_info', __( 'Gallery Info', 'gymat-core' ), array( 'gymat_gallery' ), '', '', 'high', array(
	'fields' => array(
		'gymat_port_gallery' => array(
			'label' => __( 'Gallery', 'gymat-core' ),
			'type'  => 'gallery',
		),
	),
) );



/*-------------------------------------
#. Testimonial
---------------------------------------*/
$Postmeta->add_meta_box( 'gymat_testimonial_info', __( 'Testimonial Info', 'gymat-core' ), array( 'gymat_testim' ), '', '', 'high', array(
	'fields' => array(
		'gymat_tes_designation' => array(
			'label' => __( 'Designation', 'gymat-core' ),
			'type'  => 'text',
		),		
		'gymat_tes_rating' => array(
			'label' => __( 'Select the Rating', 'gymat-core' ),
			'type'  => 'select',
			'options' => array(
				'default' => __( 'Default', 'gymat-core' ),
				'1'    => '1',
				'2'    => '2',
				'3'    => '3',
				'4'    => '4',
				'5'    => '5'
				),
			'default'  => 'default',
		),
	)
) );
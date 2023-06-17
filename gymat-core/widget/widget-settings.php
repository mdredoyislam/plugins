<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

add_action( 'widgets_init', 'gymat_widgets_init' );
function gymat_widgets_init() {

	// Register Custom Widgets
	register_widget( 'GymatTheme_Advertisement' );
	register_widget( 'GymatTheme_Address_Widget' );
	register_widget( 'GymatTheme_Social_Widget' );
	register_widget( 'GymatTheme_Recent_Posts_With_Image_Widget' );
	register_widget( 'GymatTheme_Post_Box' );
	register_widget( 'GymatTheme_Post_Tab' );
	register_widget( 'GymatTheme_Feature_Post' );
	register_widget( 'GymatTheme_Download' );
	register_widget( 'GymatTheme_Specific_Opening_Hour' );
	register_widget( 'GymatTheme_Working_Hours' );
	register_widget( 'GymatTheme_Class_Widget' );
}
<?php
/*
Plugin Name: Redoy Gymat Core
Plugin URI: https://www.desvert.com
Description: Gymat Core Plugin for Gymat Theme
Version: 1.7.0
Author: RedoyTheme
Author URI: https://www.redoyislam.com
*/

if ( ! defined( 'ABSPATH' ) ) exit;

class Gymat_Core {

	public $plugin  = 'gymat-core';
	public $action  = 'gymat_theme_init';


}

new Gymat_Core;

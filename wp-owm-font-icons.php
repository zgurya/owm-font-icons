<?php 
/**
 * Plugin Name: Open Weather Map font icons
 * Plugin URI: https://github.com/zgurya/wp-owm-font-icons
 * Description: This plugin adds generate shortcodes for dysplaying weather information.
 * Version: 1.0
 * Author: Zgurya Andrey
 * Author URI: https://github.com/zgurya
 * License: GPL2
 */

add_action('admin_menu', 'owm_font_icons');
require_once ('includes/api.php');
require_once ('includes/shortcode.php');

add_action( 'plugins_loaded', 'owm_font_icons_textdomain' );
function owm_font_icons_textdomain() {
	load_plugin_textdomain( 'owm-ficons', FALSE, basename( dirname( __FILE__ ) ) . '/languages/' );
}
function owm_font_icons(){
	add_menu_page( __('Football Data Shortcode settings', 'owm-ficons'), __('Football Data Shortcode','owm-ficons'), 'manage_options', 'owm_font_icons', 'owm_font_icons_init' );
	add_submenu_page('owm_font_icons', __('Generate your shortcode', 'owm-ficons'), __('Generate Shortcode','owm-ficons'),'manage_options','owm_font_icons', 'owm_font_icons_init');
}

function owm_font_icons_init() {
	echo '<h1>'.__('Generate your shortcode', 'fdscode-data-plugin').'</h1>';
	require_once ('includes/form.php');
}
?>
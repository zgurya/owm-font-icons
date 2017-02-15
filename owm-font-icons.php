<?php 
/**
 * Plugin Name: OWM Font Icons
 * Plugin URI: https://github.com/zgurya/owm-font-icons
 * Description: This plugin allows you to create shortcodes to display the weather information using font icons. Weather information provided by OpenWeatherMap API.
 * Version: 1.0
 * Author: Zgurya Andrey
 * Author URI: https://github.com/zgurya
 * License: GPL2
 */

add_action('admin_menu', 'owm_font_icons');
add_action('init', 'owm_font_icons_styles');
add_filter( 'plugin_action_links_' . plugin_basename(__FILE__), 'owm_font_icons_settings' );
register_activation_hook(__FILE__, 'owm_font_icons_activation');
register_deactivation_hook(__FILE__, 'owm_font_icons_deactivation');
register_uninstall_hook( __FILE__, 'owm_font_icons_uninstall' );

require_once ('includes/api.php');
require_once ('includes/shortcode.php');

add_action( 'plugins_loaded', 'owm_font_icons_textdomain' );
function owm_font_icons_textdomain() {
	load_plugin_textdomain( 'owm-font-icons', FALSE, basename( dirname( __FILE__ ) ) . '/languages/' );
}

function owm_font_icons(){
	add_menu_page( __('OpenWeatherMap', 'owm-font-icon'), __('OWM Font Icons','owm-font-icon'), 'manage_options', 'owm_font_icons', 'owm_font_icons_init','dashicons-cloud' );
	add_submenu_page('owm_font_icons', __('Informers', 'owm-font-icon'), __('Informers','owm-font-icon'),'manage_options','owm_font_icons', 'owm_font_icons_init');
	add_submenu_page('owm_font_icons', __('Open Weather Map Settings', 'owm-font-icon'), __('Settings','owm-font-icon'),'manage_options','owm_font_icons_settings', 'owm_font_icons_settings_init');
}

function owm_font_icons_init() {
	echo '<h1>'.__('Open Weather Map Informers', 'owm-font-icon').'</h1>';
	require_once ('includes/informers.php');
}

function owm_font_icons_settings_init() {
	echo '<h1>'.__('Open Weather Map Settings', 'owm-font-icon').'</h1>';
	require_once ('includes/settings.php');
}

function owm_font_icons_styles() {
	wp_enqueue_style('owm_font_icons_styles', plugin_dir_url( __FILE__ ).('css/general.css'));
}

function owm_font_icons_settings($links) {
	array_push($links, '<a href="'. esc_url( get_admin_url(null, 'admin.php?page=owm_font_icons_settings') ) .'">Settings</a>');
	return $links;
}

function owm_font_icons_activation(){
	if ( get_transient('owm_font_icons'))  {
		delete_transient('owm_font_icons');
	}
}

function owm_font_icons_deactivation() {
	delete_transient('owm_font_icons');
}

function owm_font_icons_uninstall() {
	delete_option('owm_font_icons_api');
	delete_transient('owm_font_icons');
}
?>

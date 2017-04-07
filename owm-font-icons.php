<?php
/**
 * Plugin Name: OWM Font Icons
 * Plugin URI: https://github.com/zgurya/owm-font-icons
 * Description: This plugin allows you to create shortcodes to display the weather information using font icons. Weather information provided by OpenWeatherMap API.
 * Version: 0.1
 * Author: Zgurya Andrey
 * Author URI: https://github.com/zgurya
 * License: GPL2
 */

require_once ('includes/helper.php');
require_once ('includes/shortcode.php');
require_once ('includes/widget.php');
add_action('admin_menu', 'owm_font_icons');
add_action('admin_enqueue_scripts', 'owm_font_icons_admin_scripts');
add_action('wp_enqueue_scripts', 'owm_font_icons_site_styles');
add_filter( 'plugin_action_links_'. plugin_basename(__FILE__),'owm_font_icons_settings');
add_action( 'widgets_init', 'owm_font_icons_load_widget' );
register_activation_hook(__FILE__,'owm_font_icons_activation');
register_deactivation_hook(__FILE__,'owm_font_icons_deactivation');
register_uninstall_hook( __FILE__,'owm_font_icons_uninstall');

add_action('plugins_loaded','owm_font_icons_textdomain');
function owm_font_icons_textdomain() {
	load_plugin_textdomain( 'owm-font-icons', FALSE, basename( dirname( __FILE__ ) ) . '/languages/' );
}

function owm_font_icons() {
	add_menu_page( __('OpenWeatherMap', 'owm-font-icons'), __('OWM Font Icons','owm-font-icons'), 'manage_options', 'owm_font_icons', 'owm_font_icons_init','dashicons-cloud' );
	add_submenu_page('owm_font_icons', __('Informers', 'owm-font-icons'), __('Informers','owm-font-icons'),'manage_options','owm_font_icons', 'owm_font_icons_init');
	add_submenu_page('owm_font_icons', __('Open Weather Map Settings', 'owm-font-icon'), __('Settings','owm-font-icon'),'manage_options','owm_font_icons_settings', 'owm_font_icons_settings_init');

}

function owm_font_icons_init() {
	if(isset($_GET['informer_action'])&&($_GET['informer_action']=='create'||$_GET['informer_action']=='edit')){
		if($_GET['informer_action']=='create'){
			echo '<h1>'.__('Create Open Weather Map Informer', 'owm-font-icons').'</h1>';
			require_once 'includes/informer_edit.php';
		}
		if($_GET['informer_action']=='edit'&&isset($_GET['informer_id'])){
			echo '<h1>'.__('Edit Open Weather Map Informer', 'owm-font-icons').'</h1>';
			require_once 'includes/informer_edit.php';
		}
	}else{
		echo '<h1>'.__('Open Weather Map Informers', 'owm-font-icons').'</h1>';
		require_once ('includes/informers.php');;
	}
}

function owm_font_icons_settings_init() {
	echo '<h1>'.__('Open Weather Map Settings', 'owm-font-icons').'</h1>';
	require_once ('includes/settings.php');
}

function owm_font_icons_admin_scripts(){
	wp_enqueue_style( 'wp-color-picker' );
	wp_enqueue_script( 'owm-font-icons-admin', plugin_dir_url( __FILE__ ).('js/admin.js'), array( 'wp-color-picker' ), false, true );
	wp_enqueue_script( 'owm-font-icons-google-map', 'https://maps.googleapis.com/maps/api/js?v=3.exp&libraries=places');
	wp_enqueue_style('owm-font-icons-admin-styles', plugin_dir_url( __FILE__ ).('css/admin.css'));
}

function owm_font_icons_site_styles() {
	wp_enqueue_style('owm-font-icons-site-styles', plugin_dir_url( __FILE__ ).('css/site.css'));
}

function owm_font_icons_settings($links) {
	array_push($links, '<a href="'. esc_url( get_admin_url(null, 'admin.php?page=owm_font_icons') ) .'">Informers</a>');
	array_push($links, '<a href="'. esc_url( get_admin_url(null, 'admin.php?page=owm_font_icons_settings') ) .'">Settings</a>');
	return $links;
}

// Register and load the widget
function owm_font_icons_load_widget() {
	register_widget( 'owm_font_icons_widget' );
}

function owm_font_icons_activation(){
	if (get_transient('owm_font_icons_informers')) {
		delete_transient('owm_font_icons_informers');
	}
}

function owm_font_icons_deactivation() {
	delete_transient('owm_font_icons_informers');
}

function owm_font_icons_uninstall() {
	delete_option('owm_font_icons_api');
	delete_option('owm_font_icons_informers');
	delete_transient('owm_font_icons_informers');
}
?>

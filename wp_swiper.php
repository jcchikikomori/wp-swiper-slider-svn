<?php
	/*
		Plugin Name: WP Swiper
		Plugin URI: https://wordpress.org/plugins/wp-swiper-slider/
		Description: Swiper Most Modern Mobile Touch Slider for WordPress
		Author: Webévasion
		Author URI: http://www.webevasion.net/
		Version: 0.1.6.1
		License: GPLv2 or later
	*/

	require_once(plugin_dir_path(__FILE__).'gallery_metabox.php');
	require_once(plugin_dir_path(__FILE__).'assets/metabox_helper/meta-box.php');
	require_once(plugin_dir_path(__FILE__).'wp_swiper_admin_functions.php');
	require_once(plugin_dir_path(__FILE__).'wp_swiper_shortcodes.php');

	class WPSwiper{
		protected $pluginPath;

		public function __construct(){
			$this->pluginPath = dirname(__FILE__);
			add_action('admin_enqueue_scripts', array($this, 'wp_swiper_init_assets_admin'));
			add_action('wp_enqueue_scripts', array($this, 'wp_swiper_init_assets'));
		}

		public function wp_swiper_init_assets_admin(){
			wp_enqueue_script('media-upload');
			wp_enqueue_script('thickbox');

			//Gallery metabox script
			wp_enqueue_media();
			wp_enqueue_script('gallery_metabox_script', plugin_dir_url(__FILE__).'assets/js/gallery_metabox.js', array('jquery', 'jquery-ui-sortable'));
			wp_enqueue_script('wp_swiper_script', plugin_dir_url(__FILE__).'assets/js/wp_swiper_script.js', array('jquery'));

			//Module style
			wp_register_style('wp_swiper_style', plugin_dir_url(__FILE__).'assets/css/wp_swiper_style.css');
			wp_enqueue_style('wp_swiper_style');
		}

		public function wp_swiper_init_assets(){
			//Swiper scripts
			wp_register_style('wp_swiper_swiper_style', plugin_dir_url(__FILE__).'assets/css/swiper.min.css');
			wp_enqueue_style('wp_swiper_swiper_style');
			wp_enqueue_script('wp_swiper_swiper_script', plugin_dir_url(__FILE__)."assets/js/swiper.jquery.min.js", array('jquery'));
		}
	}

	$WPSwiper = new WPSwiper();

?>
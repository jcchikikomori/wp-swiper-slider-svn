<?php

	class WPSwiper_admin{

		public function __construct(){
			add_action('init', array($this, 'init_swiper_post_type'));
			add_action('init', array($this, 'init_remove_editor'));
			add_filter('rwmb_meta_boxes', array($this, 'wp_swiper_config_metabox'));
		}

		function init_remove_editor(){
			remove_post_type_support('wp_swiper', 'editor');
		}

		/*===== custom post type =====*/
		function init_swiper_post_type(){
			register_post_type(
				'wp_swiper',
				array(
					'label' => 'Swiper',
					'menu_icon' => 'dashicons-slides',
					'labels' => array(
						'name' => 'WP Swiper',
						'all_items' => 'All sliders',
						'add_new_item' => 'Add new slider',
						'edit_item' => 'Edit slider',
						'new_item' => 'New slider',
						'view_item' => 'View slider',
						'search_items' => 'Search slider',
						'not_found' => 'Slider not found',
						'not_found_in_trash'=> 'Slider not found in trash'
					),
					'public' => true,
					'capability_type' => 'post',
					'supports' => array(
						'title',
						'editor',
						'thumbnail',
						'page-attributes'
					),
					'has_archive' => true,
					'hierarchical' => true
				)
			);
			flush_rewrite_rules();
		}

		function wp_swiper_config_metabox($meta_boxes){
			$meta_boxes[] = array(
				'title'			=> __('Configuration', 'wp_swiper'),
				'post_types'	=> 'wp_swiper',
				'fields'		=> array(
					//Metabox tabs buttons//
					array('class' => 'tab_trigger general', 'name' => '', 'type' => 'button', 'std' => __('General', 'wp_swiper')),
					array('class' => 'tab_trigger navigation', 'name' => '', 'type' => 'button', 'std' => __('Navigation', 'wp_swiper')),
					array('class' => 'tab_trigger advanced', 'name' => '', 'type' => 'button', 'std' => __('Advanced', 'wp_swiper')),

					//General//
					array(
						'id'			=> '_wp_swiper_autoplay',
						'class'			=> 'tab_general',
						'name'			=> __('Enable autoplay', 'wp_swiper'),
						'type'			=> 'checkbox',
					),
					array(
						'id'			=> '_wp_swiper_autoplay_speed',
						'class'			=> 'tab_general',
						'name'			=> __('Autoplay speed', 'wp_swiper'),
						'type'			=> 'number',
						'min'			=> '100',
						'desc'			=> __('in milliseconds', 'wp_swiper'),
					),
					array(
						'type'			=> 'custom_html',
						'class'			=> 'tab_general',
						'std'			=> '<hr>',
					),
					array(
						'id'			=> '_wp_swiper_speed',
						'class'			=> 'tab_general',
						'name'			=> __('Speed', 'wp_swiper'),
						'type'			=> 'number',
						'min'			=> '100',
						'desc'			=> __('in milliseconds', 'wp_swiper'),
					),

					//Nav buttons//
					array(
						'id'			=> '_wp_swiper_nav_enable',
						'class'			=> 'tab_navigation',
						'name'			=> __('Enable nav buttons', 'wp_swiper'),
						'type'			=> 'checkbox',
					),
					array(
						'id'			=> '_wp_swiper_nav_pos',
						'class'			=> 'tab_navigation',
						'name'			=> __('Nav buttons position', 'wp_swiper'),
						'type'			=> 'select',
						'options' => array(
							'top'		=> __('Top', 'wp_swiper'),
							'middle'	=> __('Middle', 'wp_swiper'),
							'bottom'	=> __('Bottom', 'wp_swiper'),
						),
					),
					array(
						'id'			=> '_wp_swiper_nav_height',
						'class'			=> 'tab_navigation',
						'name'			=> __('Buttons height', 'wp_swiper'),
						'type'			=> 'number',
						'min'			=> '1',
						'desc'			=> __('in px', 'wp_swiper'),
					),
					array(
						'id'			=> '_wp_swiper_nav_width',
						'class'			=> 'tab_navigation',
						'name'			=> __('Buttons width', 'wp_swiper'),
						'type'			=> 'number',
						'min'			=> '1',
						'desc'			=> __('in px', 'wp_swiper'),
					),
					array(
						'type'			=> 'custom_html',
						'class'			=> 'tab_navigation',
						'std'			=> '<hr>',
					),
					array(
						'id'			=> '_wp_swiper_nav_prev_css',
						'class'			=> 'tab_navigation',
						'name'			=> __('Additionnal prev button CSS', 'wp_swiper'),
						'type'			=> 'textarea',
						'desc'			=> __('Here you can add a background image or color for example', 'wp_swiper'),
					),
					array(
						'id'			=> '_wp_swiper_nav_next_css',
						'class'			=> 'tab_navigation',
						'name'			=> __('Additionnal next button CSS', 'wp_swiper'),
						'type'			=> 'textarea',
					),

					//ADVANCED//
					array(
						'id'			=> '_wp_swiper_wrapper_css',
						'class'			=> 'tab_advanced',
						'name'			=> __('Additionnal wrapper CSS', 'wp_swiper'),
						'type'			=> 'textarea',
					),
					array(
						'type'			=> 'custom_html',
						'class'			=> 'tab_advanced',
						'std'			=> '<hr>',
					),
					array(
						'id'			=> '_wp_swiper_custom_config',
						'class'			=> 'tab_advanced',
						'name'			=> __('Custom Swiper configuration', 'wp_swiper'),
						'type'			=> 'textarea',
						'placeholder'	=> __('Example : direction: "vertical",', 'wp_swiper'),
						'desc'			=> __('See <a href="http://idangero.us/swiper/api/">http://idangero.us/swiper/api/</a> ', 'wp_swiper'),
					),
				),
			);
			return $meta_boxes;
		}
		
	}

	$WPSwiper_admin = new WPSwiper_admin();

?>
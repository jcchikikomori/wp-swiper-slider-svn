<?php

	class WPSwiper_shortcodes{

		function __construct(){
			add_shortcode('wp_swiper', array($this, 'wp_swiper_shortcode'));
		}

		function wp_swiper_shortcode($atts){
			$params = ''; $html = '';
			$slider_id = $atts['id'];

			//Init variables//
			$nav_enabled = false;
			$nav_buttons_height = 30;
			$nav_buttons_pos_css = 'position: absolute; z-index: 99;';
			$nav_prev_css = ''; //additionnal prev nav btn css
			$nav_next_css = ''; //additionnal next nav btn css
			$wrapper_additionnal_css = '';

			//Params//
			//General
			if(get_post_meta($slider_id, '_wp_swiper_autoplay', true) !== ''){
				if(get_post_meta($slider_id, '_wp_swiper_autoplay', true) == 1){
					if(get_post_meta($slider_id, '_wp_swiper_autoplay_speed', true) !== ''){
						$params .= 'autoplay: '.get_post_meta($slider_id, '_wp_swiper_autoplay_speed', true).',';
					}else{
						$params .= 'autoplay: 2000,';
					}
				}
			}
			if(get_post_meta($slider_id, '_wp_swiper_speed', true) !== ''){
				$params .= 'speed: '.get_post_meta($slider_id, '_wp_swiper_speed', true).',';
			}
			//Navigation
			if(get_post_meta($slider_id, '_wp_swiper_nav_enable', true) !== ''){
				if(get_post_meta($slider_id, '_wp_swiper_nav_enable', true) == true){
					$nav_enabled = true;
				}
			}else{
				$nav_enabled = false;
			}
			if(get_post_meta($slider_id, '_wp_swiper_nav_height', true) !== ''){
				$nav_buttons_height = get_post_meta($slider_id, '_wp_swiper_nav_height', true);
			}else{
				$nav_buttons_height = 30;
			}
			if(get_post_meta($slider_id, '_wp_swiper_nav_width', true) !== ''){
				$nav_buttons_width = get_post_meta($slider_id, '_wp_swiper_nav_width', true);
			}else{
				$nav_buttons_width = 30;
			}
			if(get_post_meta($slider_id, '_wp_swiper_nav_pos', true) !== ''){
				switch(get_post_meta($slider_id, '_wp_swiper_nav_pos', true)){
					case 'top':
						$nav_buttons_pos_css .= 'top: 0;';
						break;
					case 'middle':
						$nav_buttons_pos_css .= 'top: calc(50% - '.($nav_buttons_width / 2).'px);';
						break;
					case 'bottom':
						$nav_buttons_pos_css .= 'bottom: 0;';
						break;
				}
			}
			$nav_css = 'height: '.$nav_buttons_height.'px; width: '.$nav_buttons_width.'px; '.$nav_buttons_pos_css;
			if(get_post_meta($slider_id, '_wp_swiper_nav_prev_css', true) !== ''){
				$nav_prev_css = get_post_meta($slider_id, '_wp_swiper_nav_prev_css', true);
			}
			if(get_post_meta($slider_id, '_wp_swiper_nav_next_css', true) !== ''){
				$nav_next_css = get_post_meta($slider_id, '_wp_swiper_nav_next_css', true);
			}

			//Advanced params//
			if(get_post_meta($slider_id, '_wp_swiper_wrapper_css', true) !== ''){
				$wrapper_additionnal_css = get_post_meta($slider_id, '_wp_swiper_wrapper_css', true);
			}

			// /Params//


			//HTML
			$html .= '<div class="wp_swiper_slider_wrapper" style="position: relative; overflow: hidden; '.$wrapper_additionnal_css.'">';
			if($nav_enabled == true){$html .= '<div class="wp_swiper_nav_prev" style="left: 0; '.$nav_css.' '.$nav_prev_css.'"></div>';}
			$html .= '<div class="swiper-wrapper">';

			$images = get_post_meta($slider_id, 'vdw_gallery_id', true);
			if(isset($images)){
				foreach($images as $image){
					$html .= "
					<img class='swiper-slide' src='".wp_get_attachment_url($image, 'large')."' />";
				}
			}

			$html .= '</div>';
			if($nav_enabled == true){$html .= '<div class="wp_swiper_nav_next" style="right: 0; '.$nav_css.' '.$nav_next_css.'"></div>';}
			$html .= '</div>';


			//JS
			if(get_post_meta($slider_id, '_wp_swiper_nav_enable', true) !== ''){
				$params .= 'prevButton: ".wp_swiper_nav_prev",';
				$params .= 'nextButton: ".wp_swiper_nav_next",';
			}

			//Custom config -- Always last !
			if(get_post_meta($slider_id, '_wp_swiper_custom_config', true) !== ''){
				$params .= get_post_meta($slider_id, '_wp_swiper_custom_config', true);
			}

			$script = '<script>
				jQuery(document).ready(function($){
					var wp_swiper = new Swiper(".wp_swiper_slider_wrapper", {
						'.$params.'
					});
				});
			</script>';


			return $html.$script;
		}

	}

	$WPSwiper_shortcodes = new WPSwiper_shortcodes();


?>
jQuery(document).ready(function($){

	var duration = 400;

	/*===== Tabs system =====*/
	$('.rwmb-meta-box > .rwmb-field:not(.tab_trigger)').hide();
	$('.rwmb-meta-box > .tab_general').fadeIn(duration);
	$('.rwmb-meta-box > .tab_trigger.general a').css({'background': '#ddd'});

	$('.rwmb-meta-box > .tab_trigger').click(function(){
		$('.rwmb-meta-box > .tab_trigger a').css({'background': '#f7f7f7'});
		$(this).find('a').css({'background': '#ddd'});

		$('.rwmb-meta-box > .rwmb-field:not(.tab_trigger)').slideUp(duration);
		if($(this).hasClass('general')){
			if($('.rwmb-meta-box > .tab_general').css('display') != 'block'){
				$('.rwmb-meta-box > .tab_general').slideDown(duration);
			}
		}
		if($(this).hasClass('navigation')){
			if($('.rwmb-meta-box > .tab_navigation').css('display') != 'block'){
				$('.rwmb-meta-box > .tab_navigation').slideDown(duration);
			}
		}
		if($(this).hasClass('advanced')){
			if($('.rwmb-meta-box > .tab_advanced').css('display') != 'block'){
				$('.rwmb-meta-box > .tab_advanced').slideDown(duration);
			}
		}
		if($(this).hasClass('pagination')){
			if($('.rwmb-meta-box > .tab_pagination').css('display') != 'block'){
				$('.rwmb-meta-box > .tab_pagination').slideDown(duration);
			}
		}

		return false;
	});
});
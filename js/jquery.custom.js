/**
 * call sliders
 */
jQuery(document).ready(function($) { 
	jQuery(".carousel").each(function() {
	var objectID = jQuery(this).attr('id');
	var items = objectID.replace('_rtp_carousel','');
		$(this).owlCarousel({
			items : items,
			itemsDesktop : [1199,items],
			itemsDesktopSmall : [979,3],
			navigation : true,
			pagination : false,
		});
	});
	
	jQuery(".slider-carousel").each(function() {
		$(this).owlCarousel({
			items : 1,
			itemsDesktop : [1199,1],
			itemsDesktopSmall : [979,1],
			navigation : false,
			pagination : true,
		});
	});	
});
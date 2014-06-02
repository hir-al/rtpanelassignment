/**
 * call sliders
 */
jQuery(document).ready(function($) {
	 $("#owl-demo").owlCarousel({
        items : 6,
        itemsDesktop : [1199,5],
        itemsDesktopSmall : [979,3],
		navigation : true,
		pagination : false,
    });
});
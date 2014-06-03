/**
 * call sliders
 */
jQuery(document).ready(function($) { 
	
	jQuery(".rtp-nav-wrapper .rtp-nav-container:first > li").each(function (i) {
        jQuery(this).addClass("main-li");
    });
	
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

	/**
	* navigation.js
	*
	* Handles toggling the navigation menu for small screens.
	*/
	( function() {
		var nav = document.getElementById( 'rtp-primary-menu' ), button, menu;
		if ( ! nav )
			return;
		button = nav.getElementsByTagName( 'h3' )[0];
		menu   = nav.getElementsByTagName( 'ul' )[0];
		if ( ! button )
			return;

		// Hide button if menu is missing or empty.
		if ( ! menu || ! menu.childNodes.length ) {
			button.style.display = 'none';
			return;
		}

		button.onclick = function() {			
			if ( -1 == nav.className.indexOf( 'toggled-on' ) ) {
				nav.className += ' toggled-on';
			} else {			
				nav.className = nav.className.replace( ' toggled-on', '' );
			}			
		};
	} )();
	
	function mobileToggleColumn(){	
		if (jQuery(window).width() < 1000){
			jQuery('.secondary-sidebar .widget ul, #sidebar .widget ul, .footer-main .widget ul').css('display','none');		
			jQuery('#sidebar .widget .widgettitle .mobile_togglecolumn, .secondary-sidebar .widget .widgettitle .mobile_togglecolumn, .footer-main .widget .widgettitle .mobile_togglecolumn').removeClass('clearfix');
			jQuery('#sidebar .widget .widgettitle .mobile_togglecolumn, .secondary-sidebar .widget .widgettitle .mobile_togglecolumn, .footer-main .widget .widgettitle .mobile_togglecolumn').remove();
			jQuery('#sidebar .widget .widgettitle, .secondary-sidebar .widget .widgettitle, .footer-main .widget .widgettitle').append( "<span class='mobile_togglecolumn'>&nbsp;</span>" );
			jQuery('#sidebar .widget .widgettitle, .secondary-sidebar .widget .widgettitle, .footer-main .widget .widgettitle').addClass('toggle');
			jQuery('#sidebar .widget .widgettitle .mobile_togglecolumn, .secondary-sidebar .widget .widgettitle .mobile_togglecolumn, .footer-main .widget .widgettitle .mobile_togglecolumn').click(function(){
				jQuery(this).parent().toggleClass('active').parent().find('ul').toggle('slow');
			});	
		}
		else{
			jQuery('#sidebar .widget ul, .secondary-sidebar .widget ul, .footer-main .widget ul').css('display','block');	
			jQuery('#sidebar .widget .widgettitle .mobile_togglecolumn, .secondary-sidebar .widget .widgettitle .mobile_togglecolumn, .footer-main .widget .widgettitle .mobile_togglecolumn').css('display','none');
			jQuery('#sidebar .widget .widgettitle, .secondary-sidebar .widget .widgettitle, .footer-main .widget .widgettitle').removeClass('toggle active');
			jQuery('#sidebar .widget .widgettitle .mobile_togglecolumn, .secondary-sidebar .widget .widgettitle .mobile_togglecolum, .footer-main .widget .widgettitle .mobile_togglecolumnn').remove();	
			
		}
	}
	jQuery(document).ready(function() { mobileToggleColumn();});
	jQuery(window).resize(function() { mobileToggleColumn();});
	
	function mobileToggleMenu(){
		if (jQuery(window).width() < 1000)
		{
			jQuery( ".menu-item-has-children .mobile_togglemenu" ).remove();
			jQuery( ".menu-item-has-children.main-li" ).prepend( "<span class='mobile_togglemenu'>&nbsp;</span>" );
			jQuery( ".menu-item-has-children" ).addClass('toggle');
			jQuery( ".menu-item-has-children .mobile_togglemenu" ).click(function(){
				jQuery(this).parent().toggleClass('active').find('ul.sub-menu').toggle('slow');
			});

		}else{
			jQuery( ".menu-item-has-children" ).parent().find('ul.sub-menu').removeAttr('style');
			jQuery( ".menu-item-has-children" ).removeClass('active');
			jQuery( ".menu-item-has-children" ).removeClass('toggle');
			jQuery( ".menu-item-has-children .mobile_togglemenu" ).remove();
		}	
	}
	jQuery(document).ready(function(){mobileToggleMenu();});
	jQuery(window).resize(function(){mobileToggleMenu();});
});
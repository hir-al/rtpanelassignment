var upload_image_button=false;
jQuery(document).ready(function() {
	
	// Add/Remove input fields
	jQuery(function() {
        var addImageDiv = jQuery('#slider_images_div');
		var j = jQuery('#slider_images_div div.single-image').size();
        var i = jQuery('#slider_images_div div.single-image').size() + 1;
        
        jQuery('#addImage').live('click', function() {
                jQuery('<div class="single-image"><table><tr><td>Image ' + i +':</td><td><input type="text" id="image_' + i +'" name="rtp_general[slider_images][' + j +']" value=""/><input id="' + i +'_btn" class="upload_image_button button" type="button" value="Upload Image"/></td></tr></table><a href="#" class="removeImage" id="removeImage">Remove</a></div>').appendTo(addImageDiv);
                j++;
				i++;
                return false;
        });
        
        jQuery('#removeImage').live('click', function() { 
                if( i > 2 ) {
                        jQuery(this).parents('div.single-image').remove();
                        i--;
                }
                return false;
        });
	});
	
	jQuery('.upload_image_button').click(function() {
		upload_image_button = true;
		formfieldID=jQuery(this).prev().attr("id");		
		formfield = jQuery("#"+formfieldID).attr('name');
		tb_show('', 'media-upload.php?type=image&amp;TB_iframe=true');
		if(upload_image_button==true){

				var oldFunc = window.send_to_editor;
				window.send_to_editor = function(html) {

				imgurl = jQuery('img', html).attr('src');
				jQuery("#"+formfieldID).val(imgurl);
				 tb_remove();
				window.send_to_editor = oldFunc;
				}
		}
		upload_image_button=false;
	});
})
jQuery(document).ready(function() {
	"use strict";
	var imgsrc = "";
	var altertext = "";
	var openedImages = "";
	jQuery(".image_description").click(function() {
		
		openedImages = jQuery(this);
		imgsrc = jQuery(this).parent().find("img").attr("src");
		altertext = jQuery(this).parent().find("img").attr("alt");
		if (jQuery(openedImages).parent().is(':last-child')) {
			jQuery(".next_image_btn").hide();
		} else {
			jQuery(".next_image_btn").show();
		}
		if (jQuery(openedImages).parent().is(':first-child')) {
			jQuery(".previous_image_btn").hide();
		} else {
			jQuery(".previous_image_btn").show();
		}
	});
	jQuery('#image_lightbox').on('show.bs.modal', function(e) {
		jQuery("#image_lightbox").find("img").attr("src", imgsrc);
		jQuery(".image_lightbox_label").html(altertext);
	});
	jQuery(".next_image_btn").click(function() {
		openedImages = jQuery(openedImages).parent().next();
		jQuery(".previous_image_btn").show();
		if (jQuery(openedImages).is(':last-child')) {
			jQuery(this).hide();
		} else {
			jQuery(this).show();
		}
		imgsrc = jQuery(openedImages).find("img").attr("src");
		altertext = jQuery(openedImages).find("img").attr("alt");
		openedImages = jQuery(openedImages).find(".image_description");
		jQuery("#image_lightbox").find("img").fadeOut("slow", function() {
			jQuery("#image_lightbox").find("img").attr("src", imgsrc);
			jQuery(".image_lightbox_label").html(altertext);
			jQuery("#image_lightbox").find("img").fadeIn("slow");
		});
	});
	jQuery(".previous_image_btn").click(function() {
		jQuery(".next_image_btn").show();
		openedImages = jQuery(openedImages).parent().prev();
		if (jQuery(openedImages).is(':first-child')) {
			jQuery(this).hide();
		} else {
			jQuery(this).show();
		}
		imgsrc = jQuery(openedImages).find("img").attr("src");
		altertext = jQuery(openedImages).find("img").attr("alt");
		openedImages = jQuery(openedImages).find(".image_description");
		jQuery("#image_lightbox").find("img").fadeOut("slow", function() {
			jQuery("#image_lightbox").find("img").attr("src", imgsrc);
			jQuery(".image_lightbox_label").html(altertext);
			jQuery("#image_lightbox").find("img").fadeIn("slow");
		});
	});
}); 
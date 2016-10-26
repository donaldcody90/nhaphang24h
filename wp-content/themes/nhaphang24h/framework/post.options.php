<?php

//Layer slider
$sliders = array();
if( class_exists( 'LS_Sliders' ) ) {
$sliders_list = LS_Sliders::find(array('limit' => 100));
if(!empty($sliders_list)) {
    foreach($sliders_list as $item) {
		$sliders[$item['id']] = array( 'label' => $item['name'] , 'value' => $item['id']  );
    }
}
}

				
$prefix = 'page_';
$fields_page = array(		
	array( 
		'label'	=> 'Header Slider', 
		'desc'	=> '', 
		'id'	=> $prefix.'header_slider', 
		'type'	=> 'select',
		'options' => $sliders,
	),
	array( 
		'label'	=> 'Header Image', 
		'desc'	=> '', 
		'id'	=> $prefix.'header_image', 
		'type'	=> 'image',
	),
	/*array( 
		'label'	=> 'Sub Title', 
		'desc'	=> '', 
		'id'	=> $prefix.'sub_title', 
		'type'	=> 'editor',
	),*/
	
);	
$prefix_ourteam = 'ourteam_';
$fields_ourteam=array(
   array( 
		'label'	=> 'Email', 
		'desc'	=> '', 
		'id'	=> $prefix_ourteam.'email', 
		'type'	=> 'email',
	),
	 array( 
		'label'	=> 'Phone', 
		'desc'	=> '', 
		'id'	=> $prefix_ourteam.'phone', 
		'type'	=> 'text',
	),
	array( 
		'label'	=> 'Twitter', 
		'desc'	=> '', 
		'id'	=> $prefix_ourteam.'twitter', 
		'type'	=> 'text',
	),
);

$prefix = 'post_';
$fields_manufacturer = array(	
	array( // Image ID field
		'label'	=> 'Link', // <label>
		'desc'	=> 'Link website.', // description
		'id'	=> $prefix.'manufacturer_link', // field id and name
		'type'	=> 'text' // type of field
	),
    
);

$fields_gallery=array(
	array( // Image ID field
		'label'	=> 'Text Description', // <label>
		'desc'	=> 'Text show on hover effect.', // description
		'id'	=> 'photogallery_text_desc', // field id and name
		'type'	=> 'text' // type of field
	),	
);

/**
 * Instantiate the class with all variables to create a meta box
 * var $id string meta box id
 * var $title string title
 * var $fields array fields
 * var $page string|array post type to add meta box to
 * var $js bool including javascript or not
 */
require_once (THEME_PATH . "/framework/metaboxes/meta_box.php");
//$restaurent_meta_box = new custom_add_meta_box( 'restaurant_meta_box', 'Restaurant info', $fields, 'restaurant', true );
//$product_meta_box = new custom_add_meta_box( 'product_meta_box', 'Product Restaurant info', $fields_product, 'product', true );
$post_meta_box = new custom_add_meta_box( 'post_meta_box', 'Post/Page options', $fields_page, array('page','post'), true );
$post_meta_box = new custom_add_meta_box( 'post_meta_box', 'Photo Gallery options', $fields_gallery, array('photogallery'), true );
$post_meta_box = new custom_add_meta_box( 'post_meta_box', 'Post/Page options', $fields_ourteam, array('ourteam'), true );
$post_meta_box = new custom_add_meta_box( 'post_meta_box', 'Options', $fields_manufacturer, array('member','product_feature') , true );

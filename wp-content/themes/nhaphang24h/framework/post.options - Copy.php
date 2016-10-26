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

$sliders = array();
global $wpdb;
$results = $wpdb->get_results( 'SELECT * FROM '.$wpdb->prefix.'revslider_sliders',  ARRAY_A );
foreach($results as $item) {
		$sliders[$item['title']] = array( 'label' => $item['title'] , 'value' => $item['title']  );
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
	array( 
		'label'	=> 'Sub Title', 
		'desc'	=> '', 
		'id'	=> $prefix.'sub_title', 
		'type'	=> 'text',
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
$restaurent_meta_box = new custom_add_meta_box( 'restaurant_meta_box', 'Restaurant info', $fields, 'restaurant', true );
$product_meta_box = new custom_add_meta_box( 'product_meta_box', 'Product Restaurant info', $fields_product, 'product', true );
$post_meta_box = new custom_add_meta_box( 'post_meta_box', 'Post/Page options', $fields_page, array('page','post'), true );


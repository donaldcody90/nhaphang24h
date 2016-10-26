<?php


				
$prefix = 'post_';
$fields_page = array(		
	array( 
		'label'	=> 'Link CN', 
		'desc'	=> 'Đường dẫn trang trung quốc', 
		'id'	=> $prefix.'sitecn_linkcn', 
		'type'	=> 'text'
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
$post_meta_box = new custom_add_meta_box( 'post_meta_box', 'Link options', $fields_page, array('sitecn'), true );


<?php
/**
 * Clean up the_excerpt()
 */
 

function get_theme_option($field1,$field2="") {

    global $theme_options;
    if($field2 != "") {
        $output = isset($theme_options[$field1][$field2]) ? $theme_options[$field1][$field2] : false;
    }else{
        $output = isset($theme_options[$field1]) ? $theme_options[$field1] : false;
    }
    return $output;

}

function roots_excerpt_more() {
  return ' &hellip; <a href="' . get_permalink() . '">' . __('Continued', 'roots') . '</a>';
}
add_filter('excerpt_more', 'roots_excerpt_more');

function create_posttype() {

	register_taxonomy(
		'sites',
		'sites',
		array(
			'label' => __( 'Sites' ),
			'rewrite' => array( 'slug' => 'sites' ),
			'hierarchical' => true,
		)
	);

	register_post_type( 'sitecn',
	// CPT Options
		array(
			'labels' => array(
				'name' => __( 'Site China' ),
				'singular_name' => __( 'Site China' )
			),
			'public' => true,
			'has_archive' => false,
			'rewrite' => array('slug' => 'sitecn'), 
			'supports' => array(
            'title',
            'thumbnail',
            'page-attributes'),
			'taxonomies'  => array( 'sites' ),


		)
	);
	
}
// Hooking up our function to theme setup
add_action( 'init', 'create_posttype' );


// Shorcode các bước đặt hàng
function short_code_buy_step($atts, $content = null) {
    $output = '';
    ob_start();
	include(get_template_directory().'/templates/sc-buy-step.php');
    $output .= ob_get_contents();
    ob_end_clean();
    return $output;
}
add_shortcode('buy_step', 'short_code_buy_step');

// Shorcode HomePage Block Content
function short_code_hompage_block($atts, $content = null) {
    $output = '';
    ob_start();
	include(get_template_directory().'/templates/sc-homepage-block.php');
    //get_template_part('templates/wp','ourteam');
    $output .= ob_get_contents();
    ob_end_clean();
    return $output;
}
add_shortcode('homepage_block', 'short_code_hompage_block');

// Apply filter
//add_filter('body_class', 'page_full_width_classes');
function page_full_width_classes($classes) {
		global $post;
		$force_full_width = get_post_meta($post->ID,'page_force_full_width',true);		
        if($force_full_width == 1) $classes[] = 'force-full-width';
        return $classes;
}


function add_my_favicon() {   
   $new_favi = get_theme_option('favi', 'url');
   if($new_favi == "") $new_favi = get_template_directory_uri() . '/images/favi.ico';
   echo '<link rel="shortcut icon" href="' . $new_favi . '" />';
}

add_action( 'wp_head', 'add_my_favicon' ); //front end
add_action( 'admin_head', 'add_my_favicon' ); //admin end

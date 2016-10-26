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

/** Register Post type **/

/* Custom Post Type Brand */

// Our custom post type function
function create_posttype() {

	register_post_type( 'photogallery',
	// CPT Options
		array(
			'labels' => array(
				'name' => __( 'Photo Gallery' ),
				'singular_name' => __( 'Photo Gallery' )
			),
			'public' => true,
			'has_archive' => true,
			'rewrite' => array('slug' => 'photogallery'), 
			'supports' => array(
            'title',
            //'editor',
			//'custom-fields',
            'thumbnail',
            'page-attributes',)

		)
	);
	
}
// Hooking up our function to theme setup
add_action( 'init', 'create_posttype' );


function short_code_photogallery($atts, $content = null) {
    $output = '';
    ob_start();
	include(get_template_directory().'/templates/sc-photogallery.php');
    //get_template_part('templates/wp','ourteam');
    $output .= ob_get_contents();
    ob_end_clean();
    return $output;
}
add_shortcode('photogallery', 'short_code_photogallery');

function short_code_nearbyplace($atts, $content = null) {
    $output = '';
    ob_start();
	include(get_template_directory().'/templates/sc-nearbyplace.php');
    //get_template_part('templates/wp','ourteam');
    $output .= ob_get_contents();
    ob_end_clean();
    return $output;
}
add_shortcode('nearbyplace', 'short_code_nearbyplace');

function short_code_location_contact($atts, $content = null) {
    $output = '';
    ob_start();
	include(get_template_directory().'/templates/sc-location-contact.php');
    //get_template_part('templates/wp','ourteam');
    $output .= ob_get_contents();
    ob_end_clean();
    return $output;
}
add_shortcode('location-contact', 'short_code_location_contact');



function short_code_ourteam($atts, $content = null) {
    $output = '';
    ob_start();
	include(get_template_directory().'/templates/wp-ourteam.php');
    //get_template_part('templates/wp','ourteam');
    $output .= ob_get_contents();
    ob_end_clean();
    return $output;
}
add_shortcode('ourteam', 'short_code_ourteam');



// Apply filter
//add_filter('body_class', 'page_full_width_classes');
function page_full_width_classes($classes) {
		global $post;
		$force_full_width = get_post_meta($post->ID,'page_force_full_width',true);		
        if($force_full_width == 1) $classes[] = 'force-full-width';
        return $classes;
}

function get_meta_banner($id) {
    $image = wp_get_attachment_image_src( intval( $id ), 'full' );
    $image = $image[0];
    return $image;
}


//add_filter('wp_nav_menu_items','add_search_box_to_menu', 10, 2);
function add_search_box_to_menu( $items, $args ) {
    if( $args->theme_location == 'primary_navigation' )
        return $items." <li class='menu-header-search'>
    						<div class='header-search-wrap'>
    							<a href='#' class='search_icon'><i class='fa fa-search'></i> </a>
    							<div class='search-form-wrap' style='display:none;'>
		    						<form action='".site_url()."' id='searchform' method='get'>
		    							<input type='text' name='s' id='s' placeholder='Search Our Website'>
		    							<input type='submit' value='Search' name='Submit' class='btn-s-submit' />
		    						</form>
	    						</div>
    						</div>
    					</li>";

    return $items;
}

// ajax function for multi download
add_action( 'wp_ajax_download_multi',  'download_multi' );
add_action( 'wp_ajax_nopriv_download_multi',  'download_multi' );
function download_multi() {
	if($_POST['task'] == 'create_zip') {
		$files = $_POST['files'];
		$files = explode(",",$files);
		$upload_dir = wp_upload_dir();
		$subfix = rand(0,100000);
		$file_name = "spectra_forms_download_".$subfix.".zip";
		$zip_array = array();
		foreach($files as $file) {
				$data = wpdm_custom_data($file);
				$afiles = $data['files'];
				$afile = is_array($afiles)?$afiles[0]:'';
				if(file_exists(UPLOAD_DIR.'/'.$afile)){
					$zip_array[$afile] = UPLOAD_DIR.'/'.$afile;
				}
				else if(file_exists($afile)) {
					$zip_array[$afile] = UPLOAD_DIR.'/'.$afile;
				}
		}
		$download_path = $upload_dir['basedir']."/".$file_name;
		$download_url = $upload_dir['baseurl']."/".$file_name;
		if(!empty($zip_array)) {
			$rs = create_zip($zip_array,$download_path,true);
			if($rs) echo json_encode(array('rs' => true , 'url' => $download_url , 'path' => $download_path ));
			else echo json_encode(array('rs' => false , 'url' => $download_url , 'path' => $download_path ));
		}
	}else if($_POST['task'] == 'unlink') {
		$download_path = $_POST['download_path'];
		unlink($download_path);
	}
	die;
}

function create_zip($files = array(),$destination = '',$overwrite = false) {
	//if the zip file already exists and overwrite is false, return false
	if(file_exists($destination) && !$overwrite) { return false; }
	//vars
	$valid_files = array();
	//if files were passed in...
	if(is_array($files)) {
		//cycle through each file
		foreach($files as $file_name=>$file) {
			//make sure the file exists
			if(file_exists($file)) {
				$valid_files[$file_name] = $file;
			}
		}
	}
	//if we have good files...
	if(count($valid_files)) {
		//create the archive
		$zip = new ZipArchive();
		if($zip->open($destination,$overwrite ? ZIPARCHIVE::OVERWRITE : ZIPARCHIVE::CREATE) !== true) {
			return false;
		}
		//add the files
		foreach($valid_files as $file_name=>$file) {
			$zip->addFile($file,$file_name);
		}
		//debug
		//echo 'The zip archive contains ',$zip->numFiles,' files with a status of ',$zip->status;
		//close the zip -- done!
		$zip->close();
		//check to make sure the file exists
		return file_exists($destination);
	}
	else
	{
		return false;
	}
}


// Store active font size
add_action( 'wp_ajax_change_font_size',  'change_font_size' );
add_action( 'wp_ajax_nopriv_change_font_size',  'change_font_size' );
function change_font_size(){
	$_SESSION['font-size'] = $_POST['font-size'];
	die('Font size changed');
}


function add_my_favicon() {   
   $new_favi = get_theme_option('favi', 'url');
   if($new_favi == "") $new_favi = get_template_directory_uri() . '/images/favi.ico';
   echo '<link rel="shortcut icon" href="' . $new_favi . '" />';
}

add_action( 'wp_head', 'add_my_favicon' ); //front end
add_action( 'admin_head', 'add_my_favicon' ); //admin end

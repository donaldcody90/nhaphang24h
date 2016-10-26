<?php
define('GETTEXT_DOMAIN','roots');
function vc_manufacter_widget_func( $atts, $content = null ) { // New function parameter $content is added!
   extract( shortcode_atts( array(
      	'post_type' => 'member',
		'columns' => '',
		'caption_type' => '',
		'caption_align' => '',
		'thumbnail' => '',
		'metadata' => '',
		'items' => '',
		'filtertype' => '',
		'category_filter' => '',
		'animationtype' => '',
		'gaphorizontal' => '',
		'gapvertical' => '',
		'caption' => '',
		'displaytype' => '',
		'displaytypespeed' => '',
		'no_more_works' => '',
		'disable_load_more' => ''
   ), $atts ) );
   
   global $shortcode_atts;
   
   $shortcode_atts = array(
		'animationtype' => $animationtype,
		'gaphorizontal' => $gaphorizontal,
		'gapvertical' => $gapvertical,
		'caption' => $caption,
		'displaytype' => $displaytype,
		'displaytypespeed' => $displaytypespeed,
		'no_more_works' => $no_more_works,
   );
   
    if($post_type=="manufacturer"){
		$post_type="manufacturer";
		$cat_terms="manufacturer_category";
	}
	else if($post_type=="portfolio"){
		$post_type="portfolio";
		$cat_terms="portfolio_category";
	} elseif($post_type=="team"){
		$post_type="team";
		$cat_terms="team_category";
	} elseif($post_type=="product"){
		$post_type="product";
		$cat_terms="product_cat";
	} elseif($post_type=="member"){
		$post_type="member";
		$cat_terms="member_category";
	} else{
		$post_type="post";
		$cat_terms="category";
	}
	
	if(!$items){
		$items='9999';
	}
	
	//$thumbnail_filter = ot_get_option('thumbnail_filter');
	$thumbnail_filter = true;
   
	global $wpdb, $woocommerce;
	
	$args = array(
		'orderby'           => 'menu_order', 
		'order'             => 'ASC',
		'hide_empty'        => false, 
	); 

	$terms = get_terms($cat_terms, $args);	
	$art = array();
	if(!empty($terms)) foreach($terms as $t) {
		$art[] = $t->term_id;
	}	

	global $the_cube_t_ID;
	$the_cube_t_ID = get_the_ID();	
	$filtertype = 'alignLeft';
	ob_start();?>
	

		        <div class="lpd-cbp-wrapper " id="lpd-cbp-wrapper">
		 
		            
		            <div id="filters-container" class="cbp-l-filters-<?php echo $filtertype; ?>">		            
		                <button data-filter="*" class="btn btn-primary btn-warning cbp-filter-item-active cbp-filter-item cbp-filter-item-all"><?php _e('All', GETTEXT_DOMAIN) ?> (<span class="cbp-filter-counter"></span>)</button>
		                <?php wp_list_categories(array('title_li' => '', 'style' => '', 'taxonomy' => $cat_terms, 'include' => implode(",",$art), 'walker' => new lpd_portfolio_walker1())); ?>		                
		            </div>
		            
		
		            <div id="grid-container-<?php echo $the_cube_t_ID ?>" class="<?php if($caption_type=='view_post'){?>cbp-l-grid-projects <?php }?>lpd-cbp-project cbp-<?php if($columns) { echo $columns; } else{ echo '4';}?>-columns <?php if($metadata) {?> cbp-no-meta<?php }?><?php if($thumbnail=="square") {?> cbp-square<?php } else if($thumbnail=="portrait"){?> cbp-portrait<?php }?>">
		                <ul>
							<?php $query = new WP_Query();?>
							<?php if($category_filter){?>
							    <?php $query->query('post_type='. $post_type .'&'. $cat_terms .'='. $category_filter .'&posts_per_page='. $items .'&orderby=menu_order&order=ASC');?>
							<?php }else{?>
							    <?php $query->query('post_type='. $post_type .'&posts_per_page='. $items .'&orderby=menu_order&order=ASC');?>
							<?php }?>
							<?php if ($query->have_posts()) : while ($query->have_posts()) : $query->the_post();?>
							<?php $video_raw = get_post_meta(get_the_ID(), 'video_post_meta', true);?>
							<?php $link = get_post_meta(get_the_ID(), 'link_post_meta', true); ?>
							<?php $terms = get_the_terms(get_the_ID(), $cat_terms );  ?>
		                    <li class="cbp-item col-md-3 <?php echo 'item_'.get_the_ID(); ?> <?php if($terms) : foreach ($terms as $term) { echo ' lpd_'.$term->slug.''; } endif; ?>">                        
		                            <div class="cbp-caption-defaultWrap1">		                            
		                            	<?php //$banner_id = get_post_meta(get_the_ID(),'post_banner',true); $image = get_meta_banner( $banner_id ); //var_dump($image); ?>										
										<?php $post_thumbnail_id = get_post_thumbnail_id( $post_id ); $image = wp_get_attachment_thumb_url( $post_thumbnail_id ); ?>
										<?php $link = get_post_meta(get_the_ID(),'post_manufacturer_link',true);  ?>
										<a href="<?php echo $link; ?>">
											<img src="<?php echo $image; ?>" alt="" width="100%">										
										</a>
										<h3><a href="<?php echo $link; ?>"><?php echo get_the_title(); ?></a></h3>
		                            </div>											                           		                        
		                    </li>
					        <?php endwhile; else: ?>
						        <li class="no-post-matched"><?php _e('Sorry, no posts matched your criteria.', GETTEXT_DOMAIN) ?></li>
					        <?php endif; wp_reset_query();?>
		                </ul>
		            </div>
		
					<?php $count_posts = wp_count_posts($post_type);
					$count_posts = $count_posts->publish; ?>
					
					<?php if(!$disable_load_more){?>
						<?php if($count_posts > $items){?>
			            <div class="cbp-l-loadMore-button">
			                <a target="_blank" href="<?php echo get_template_directory_uri(). '/assets/cbp-plugin/ajax/vc-more.php?id='. $the_cube_t_ID .'&post_type='. $post_type.'&category_filter='. $category_filter.'&items='. $items.'&metadata='. $metadata.'&thumbnail='. $thumbnail.'&caption_type='. $caption_type.'&filtertype='. $filtertype.'&caption_align='. $caption_align; ?>" class="cbp-l-loadMore-button-link btn-default btn"><?php _e('LOAD MORE', GETTEXT_DOMAIN) ?></a>
			            </div>
			            <?php }?>
		            <?php }?>
		
		        </div>
	
	<?php 
	$cube_widget_js = new cube_widget_class();
	
	$cube_widget_js->cube_widget_callback();	
	?>
											
	<?php return ob_get_clean();
    
    
}
add_shortcode( 'vc_team_member_widget', 'vc_manufacter_widget_func' );



class cube_widget_class
{
    protected static $var = '';

    public static function cube_widget_callback() 
    {
    
	global $the_cube_t_ID;

	global $shortcode_atts;
	
	$animationtype = 'moveLeft';
	$gaphorizontal = 5;
	$gapvertical = 10;
	$caption = 'pushTop';
	$displaytype = 'sequentially';
	$displaytypespeed = $shortcode_atts['displaytypespeed'];
	$no_more_works = $shortcode_atts['no_more_works'];

	
ob_start();?>

<script>

$(window).load(function() { 
	var container_id = '#grid-container-<?php echo $the_cube_t_ID; ?>';
	var jQuerycontainer = jQuery(container_id).isotope({
		itemSelector: '.cbp-item',
		layoutMode: 'fitRows'
	});
	
	//jQuerycontainer.imagesLoaded( function() {
        //jQuerycontainer.isotope('reLayout');
    //});
	
	jQuery('.cbp-filter-item').click(function(){
		jQuery('.cbp-filter-item').removeClass('btn-warning');
		jQuery(this).addClass('btn-warning');
		var filterx = jQuery(this).attr('data-filter');
		jQuerycontainer.isotope({ filter: filterx });	
	});
	
	
});  
(function (jQuery, window, document, undefined) {
	
	var container_id = '#grid-container-<?php echo $the_cube_t_ID; ?>';	
	lpd_total = jQuery(container_id + " .cbp-item").length;
	jQuery('.cbp-filter-item-all .cbp-filter-counter').html(lpd_total);	
	jQuery('#filters-container .cbp-filter-item ').each(function(){
		var id = jQuery(this).attr('id');
		var cls = jQuery(this).attr('data-filter');
		var count = jQuery(container_id +' '+cls).length;
		jQuery('#' + id + ' .cbp-filter-counter').html(count);
	});

})(jQuery, window, document); 
       
</script>

<?php $script = ob_get_clean();

        self::$var[] = $script;

        add_action( 'wp_footer', array ( __CLASS__, 'footer' ), 20 );         
    }

	public static function footer() 
	{
	    foreach( self::$var as $script ){
	        echo $script;
	    }
	}

}





class lpd_portfolio_walker extends Walker_Category {

	function start_el(&$output, $category, $depth = 0, $args = array(), $id = 0) {
	
		extract($args);
		
		$cat_slug = esc_attr( $category->slug);
		$cat_name = esc_attr( $category->name);
		
		$cat_slug = apply_filters( 'list_cats', $cat_slug, $category );
		$cat_name = apply_filters( 'list_cats', $cat_name, $category );
		
		$link = '<button data-filter=".lpd_'.$cat_slug.'" class="cbp-filter-item">';
		
		$link .= $cat_name;
		
		$link .= ' (<span class="cbp-filter-counter"></span> items)</button>';
	  
		//if ( isset($current_category) && $current_category ){
			//$current_category = get_category( $current_category );
		//}
		
		if ( 'list' == $args['style'] ) {
		  $output .= "<li class='cat-item cat-item-".$category->term_id;
		  $output .= "'>$link\n";
		} else {
		  $output .= "\t$link\n";
		}
		
	}
   
}

class lpd_portfolio_walker1 extends Walker_Category {

	function start_el(&$output, $category, $depth = 0, $args = array(), $id = 0) {
	
		extract($args);
		
		$cat_slug = esc_attr( $category->slug);
		$cat_name = esc_attr( $category->name);
		
		$cat_slug = apply_filters( 'list_cats', $cat_slug, $category );
		$cat_name = apply_filters( 'list_cats', $cat_name, $category );
		
		$link = '<button data-filter=".lpd_'.$cat_slug.'" class="btn btn-primary cbp-filter-item" id="id-cpb-filter-'.$cat_slug.'">';
		
		$link .= $cat_name;
		
		$link .= ' (<span class=" cbp-filter-counter"></span>)</button>';
	  
		//if ( isset($current_category) && $current_category ){
			//$current_category = get_category( $current_category );
		//}
		
		if ( 'list' == $args['style'] ) {
		  $output .= "<li class='cat-item cat-item-".$category->term_id;
		  $output .= "'>$link\n";
		} else {
		  $output .= "\t$link\n";
		}
		
	}
   
}

class lpd_portfolio_walker2 extends Walker_Category {

	function start_el(&$output, $category, $depth = 0, $args = array(), $id = 0) {
	
		extract($args);
		
		$cat_slug = esc_attr( $category->slug);
		$cat_name = esc_attr( $category->name);
		
		$cat_slug = apply_filters( 'list_cats', $cat_slug, $category );
		$cat_name = apply_filters( 'list_cats', $cat_name, $category );
		
		$link = '<button data-filter=".lpd_'.$cat_slug.'" class="cbp-filter-item">';
		
		$link .= $cat_name;
		
		$link .= '<div class="cbp-filter-counter"></div></button>';
	  
		//if ( isset($current_category) && $current_category ){
			//$current_category = get_category( $current_category );
		//}
		
		if ( 'list' == $args['style'] ) {
		  $output .= "<li class='cat-item cat-item-".$category->term_id;
		  $output .= "'>$link\n";
		} else {
		  $output .= "\t$link<span class='faction'>/</span>\n";
		}
		
	}
   
}

class lpd_portfolio_walker3 extends Walker_Category {

	function start_el(&$output, $category, $depth = 0, $args = array(), $id = 0) {
	
		extract($args);
		
		$cat_slug = esc_attr( $category->slug);
		$cat_name = esc_attr( $category->name);
		
		$cat_slug = apply_filters( 'list_cats', $cat_slug, $category );
		$cat_name = apply_filters( 'list_cats', $cat_name, $category );
		
		$link = '<button data-filter=".lpd_'.$cat_slug.'" class="cbp-filter-item">';
		
		$link .= $cat_name;
		
		$link .= '<div class="cbp-filter-counter"></div></button>';
	  
		//if ( isset($current_category) && $current_category ){
			//$current_category = get_category( $current_category );
		//}
		
		if ( 'list' == $args['style'] ) {
		  $output .= "<li class='cat-item cat-item-".$category->term_id;
		  $output .= "'>$link\n";
		} else {
		  $output .= "\t$link\n";
		}
		
	}
   
}

class lpd_portfolio_walker_colio extends Walker_Category {

	function start_el(&$output, $category, $depth = 0, $args = array(), $id = 0) {
	
		extract($args);
		
		$cat_slug = esc_attr( $category->slug);
		$cat_name = esc_attr( $category->name);
		
		$cat_slug = apply_filters( 'list_cats', $cat_slug, $category );
		$cat_name = apply_filters( 'list_cats', $cat_name, $category );
		
		$link = '<a href="#lpd_colio_'.$cat_slug.'">';
		
		$link .= $cat_name;
		
		$link .= '</a>';
	  
		//if ( isset($current_category) && $current_category ){
			//$current_category = get_category( $current_category );
		//}
		
		if ( 'list' == $args['style'] ) {
		  $output .= "<li class='cat-item cat-item-".$category->term_id;
		  $output .= "'>$link\n";
		} else {
		  $output .= "\t$link\n";
		}
		
	}
   
}




?>
<?php
/*
Template Name: Template Resource Multi Download
*/
?>

<?php while (have_posts()) : the_post(); ?>
  <?php get_template_part('templates/page', 'header'); ?>
  <?php get_template_part('templates/content', 'page'); ?>
<?php endwhile; wp_reset_postdata(); ?>

<div class="multi-download">
							
<div id="wpdmmydls">	
	<div class="col-md-12">						
		<div class="row row-header">
		
			<div class="col-md-5 col-sm-5 col-xs-8">
				<p>Title</p>
			</div>	
			<div class="col-md-5 col-sm-5 col-xs-5 hidden-xs">
				<p>Description</p>
			</div>
			<div class="col-md-2 col-sm-2 col-xs-4">
				<p>Download</p>
			</div>
			<div class="clear"></div>
		</div>
	</div>	
	<div class="download-table">
	
		<?php 
			$output = _download_html();
			if($output[0]) echo $output[1];
			else echo "No forms & files found.";
		?>
		
		
	</div>	
</div>					

<?php 	
wp_reset_postdata();
?>
</div>
<div id="file_download_queue">
	<form id="download_multi_form" name="download_multi_form" action="#" method="post">
		<input type="hidden" value="" id="files" name="files" />
		<input type="hidden" value="download_multi" name="action" />
		<input type="hidden" value="create_zip" name="task" />
		<div class="pull-left  file-selected-text" style="display:none;" >
			<p> You have <span class="selected_file"></span> selected </p>
		</div>
		<div class="pull-right">			
			<button id="start_download_button" type="button" disabled="disabled" class="button" value="Download" onclick="start_download_multi()"  name="start_download" >Download</button>			
		</div>
		<div class="clear"></div>
	</form>
</div>

<?php 


function _download_html(){
	$taxonomies = array( 		
		'wpdmcategory',
	);	
	$args = array(
		'orderby'           => 'id', 
		'order'             => 'ASC',
		'hide_empty'        => true, 		
	); 
	$cates  = get_terms( $taxonomies, $args );
	$output = '
		
	';
	foreach($cates as $t) {  
		$child = _download_html_term($t);
		$output .= '
			<div class="row-download row-parent-download">
			<div class="col-md-5 col-sm-5 col-xs-9 col-1">
				<a  class="download-title collapsed" aria-expanded="false" data-toggle="collapse" data-id="'.$t->term_id.'"  href="#collapse'.$t->term_id.'"> <span class="title-icon"><i class="fa fa-plus-square"></i></span> '.$t->name.'</a>
			</div>	
			<div class="col-md-5 col-sm-5  hidden-xs col-2">
				'.$t->description.'
			</div>
			<div class="col-md-2 col-sm-2 col-xs-3 col-3">
				<input id="file_cat_'.$t->term_id.'" type="checkbox" value="'.$t->term_id.'" data-id="'.$t->term_id.'"  class="css-checkbox file_download_cate"  onclick="add_term_file('.$t->term_id.')"  />
				<label for="file_cat_'.$t->term_id.'" name="file_cat_'.$t->term_id.'_lbl" class="css-label lite-x-gray"><span class="all-form hidden-xs">All forms</span></label>												
			</div>
			<div class="clear"></div>
			</div>
			<div class="child-content">
			<div id="collapse'.$t->term_id.'" class=" panel-download-items panel-collapse collapse">
			 '.$child.'
				<div class="clear"></div>
			</div>
			<div class="clear"></div>
			</div>
			
		';
		
		
	}
	return array(true,$output);
}

function _download_html_term($term) {
		$output = "";		
		$count = 0;
		$args = array(
            'post_type' => 'wpdmpro',
            'orderby' => 'id',
			'order' => 'ASC',
			'posts_per_page'    => -1,
			'tax_query' => array(
				array(
					'taxonomy' => 'wpdmcategory',
					'field' => 'id',
					'terms' => array( $term->term_id ),					
					'operator' => 'IN'
				)
			),
        );
		$document = new WP_Query( $args );		
		//ob_start();
		while ( $document->have_posts() ) {
			$document->the_post();			
				$ext = "_blank";
                $data = wpdm_custom_data(get_the_ID());				
                if(isset($data['files'])&&count($data['files'])){
                $tmpvar = explode(".",$data['files'][0]);
                $ext = count($tmpvar) > 1 ? end($tmpvar) : $ext;
                } else $data['files'] = array();

				$ext = strtolower($ext);	
                $data['ID'] = $data['id'] = get_the_ID();
                $data['title'] = get_the_title();
				$afiles = $data['files'];
				$afile = is_array($afiles)?$afiles[0]:'';
				if(file_exists(UPLOAD_DIR.'/'.$afile))
					$filesize = number_format(filesize(UPLOAD_DIR.'/'.$afile)/1025,2);
				else if(file_exists($afile))
					$filesize = number_format(filesize($afile)/1025,2);
				if( $count%2 == 0 ) $ex_cls = 'row-even';else $ex_cls = 'row-odd';	

				$output .= '
					<div class="row-download row-download-child">
					<div class="col-md-5 col-sm-5 col-xs-9 col-1">
						'.get_the_title().'
					</div>	
					<div class="col-md-5 col-sm-5  hidden-xs col-2">						
					</div>
					<div class="col-md-2 col-sm-2 col-xs-3 col-3">
						<input data-parent="'.$term->term_id.'" type="checkbox" value="'.get_the_ID().'"  class="css-checkbox file_download_m" id="file_id_'.get_the_ID().'" onclick="add_file()" name="file_id[]" />
						<label for="file_id_'.get_the_ID().'" id="file_id_'.get_the_ID().'_lbl" class="css-label lite-x-gray"></label>						
					</div>
					<div class="clear"></div>
					</div>
				';
				
				$count ++;
		}		
		wp_reset_postdata();
		return $output;
}

?>
<style>
.table-striped-child, .table-striped-child tr td  {
	background:#fff;
}
.table-parent, #wpdmmydls .table-parent tbody tr  td {
	border:none;
	padding:0;
	margin:0px;
}
.row-empty {
	border:none !important;
	padding:0 !important;
	margin:0 !important;
}
#wpdmmydls .row-empty  td {
	padding:0 !important;
	margin:0 !important;
}
#wpdmmydls .row-empty  .table-striped-child tr td {
	padding: 20px 8px 15px !important;
	border-width: 1px medium medium;
	border-style: solid none none;
	border-color: #E0E7E9 -moz-use-text-color -moz-use-text-color;
	-moz-border-top-colors: none;
	-moz-border-right-colors: none;
	-moz-border-bottom-colors: none;
	-moz-border-left-colors: none;
	border-image: none;
}
</style>
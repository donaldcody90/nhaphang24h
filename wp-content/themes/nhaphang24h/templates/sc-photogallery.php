<?php 
$type = 'photogallery';
$args=array(
  'post_type' => $type,
  'orderby'=>'title',
  'order'=>'asc',
  'post_status' => 'publish',
  'posts_per_page'=>-1, 

  );
$photos=get_posts($args);

if($photos){
?>
<ul class="photogalary">
	<?php 
		foreach ($photos as $key=>$photo) {
			$text_desc=get_post_meta($photo->ID,'photogallery_text_desc',true);
			$feature_url = wp_get_attachment_image_src( get_post_thumbnail_id( $photo->ID ), 'single-post-thumbnail' );
			$photo_img=$feature_url[0];
		
			if($photo_img !=""){

			?>
			<li>
				<a href="<?php echo $photo_img; ?>" title="<?php echo $photo->post_title; ?>" rel="prettyPhoto[1]">
					<img src="<?php echo $photo_img; ?>" alt="<?php echo $photo->post_title; ?>"
					 class="img-responsive">
					
						<div class="image_description text-center">
							<div class="icon">
								<img src="<?php echo get_template_directory_uri()  ?>/assets/img/gallary_image_hover_icon.png" alt="+">
							</div>
							<?php 
							if(	$text_desc !="")
							  {
							?>
								<p class="text-center"><?php echo $text_desc; ?></p>
							<?php } ?>
						</div>
					</a>
				</li>	
			<?php 
			}
		}
	?>
<?php } ?>
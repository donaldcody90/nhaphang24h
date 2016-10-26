<?php 
$cols=$atts['cols'];
$custom_class="col-md-3 col-sm-6";
$title="";
$subtitle="";
if(isset($atts['title'])){
$title=$atts['title'];
}
if(isset($atts['subtitle'])){
$subtitle=$atts['subtitle'];
}
if($cols==3)
{
	$custom_class="col-md-4 col-sm-6";
}
$cat_id=$atts['cat'];

$args = array(
	'orderby'          => 'title',
	'order'            => 'ASC',
	'post_type'        => 'ourteam',
	'post_status'      => 'publish',
	'tax_query' => array(
        array(
            'taxonomy' => 'ourteam-cat',
            'terms' => $cat_id,
            'field' => 'term_id',
        )
    )
);
$posts_array = get_posts( $args ); 
//var_dump($posts_array);
if($posts_array){
?>
<div class="ourteam_boxes">
	<h3 class="text-center title-style1 title-bottom-line"><?php echo $title; ?><span class="text-green"><?php echo $subtitle; ?></span></h3>

	<div class="row ourteam_box">
	<?php foreach($posts_array as $post){ 
	
	$feat_image = wp_get_attachment_url( get_post_thumbnail_id($post->ID) );

	?>
		<div class="<?php echo $custom_class; ?>">
			<div class="person_image">
				<img src="<?php echo $feat_image; ?>" />
			</div>
			<div class="person_info">
				<h3><?php echo $post->post_title; ?></h3>
				<p class="email"><?php echo get_post_meta($post->ID,'ourteam_email',true); ?></p>
				<p class="phone"><?php echo get_post_meta($post->ID,'ourteam_phone',true); ?></p>
				<div class="social">
					<a href="<?php echo get_post_meta($post->ID,'ourteam_twitter',"#"); ?>"><img src="<?php echo get_bloginfo('template_directory').'/assets/img/linked_in.png' ?>" /></a>
				</div>
			</div>
	   </div>
	<?php } ?>
</div>
</div>
<?php  
wp_reset_postdata();
} ?>
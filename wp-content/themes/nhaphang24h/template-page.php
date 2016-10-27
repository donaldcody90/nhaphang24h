<?php
/*
Template Name: Page 2 Cols Template
*/
?>
<?php custom_breadcrumbs(); ?>
<span class="nh-divide"></span>
<?php while (have_posts()) : the_post(); ?>
<div class="blog-pages">
  <div class="blog-pages-right blog-page">
    <div class="blog-list">
      <h1 style="text-align: center;margin:0 10px 15px 10px;"><?php echo $post->post_title; ?></h1>
      <div class="contentx">
		<?php get_template_part('templates/content', 'page'); ?>
	  </div>	
	</div>
	
	<!-- Right side Bar -->
	<?php get_template_part('templates/sidebar', 'page'); ?>
  </div>	
  <div style="clear: both"></div>
</div>	
<?php endwhile; ?>

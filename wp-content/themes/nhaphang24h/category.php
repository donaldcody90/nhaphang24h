<?php get_template_part('templates/page', 'header'); ?>



<div class="blog-pages category-blog-pages">
<?php //Echo submenu  ?>
<?php // wp_nav_menu( array( 'theme_location' => 'header-menu' ,'container' => 'div','container_class' => 'menu-left-container') ); ?>
<!-- Start Menu --> 
<div class="blog-pages-left">
    <?php $args = array(
		'child_of' => 0,
		'hide_empty' => 0,
		); 
		echo wp_list_categories($args);
	?>
    <div style="clear: both"></div>
</div>
<!-- End menu -->
  

<div class="blog-pages-right">
<?php if (!have_posts()) : ?>
<div class="blog-list">
  <div class="alert alert-warning">
    <?php _e('Sorry, no results were found.', 'roots'); ?>
  </div>
  <?php get_search_form(); ?>
</div>  
<?php endif; ?>
<?php while (have_posts()) : the_post(); ?>
  <?php get_template_part('templates/content','blog', get_post_format()); ?>
<?php endwhile; ?>
<?php get_template_part('templates/sidebar','page');?>
</div>
<div style="clear: both"></div>

<?php if ($wp_query->max_num_pages > 1) : ?>
  <nav class="post-nav">
    <ul class="pager">
      <li class="previous"><?php next_posts_link(__('&larr; Older posts', 'roots')); ?></li>
      <li class="next"><?php previous_posts_link(__('Newer posts &rarr;', 'roots')); ?></li>
    </ul>
  </nav>
<?php endif; ?>
</div>

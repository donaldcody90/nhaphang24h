<?php get_template_part('templates/page', 'header'); ?>
<div class="blog-pages category-blog-pages">
<?php //Echo submenu  ?>
<?php // wp_nav_menu( array( 'theme_location' => 'header-menu' ,'container' => 'div','container_class' => 'menu-left-container') ); ?>
<!-- Start Menu --> 
 <div class="blog-pages-left">
    <ul class="blog-categories">
      <li class="blog-category ">
        <span class="blog-icon blog-category-icon"></span>
        <span class="blog-category-name" value="/blog?cat=1">Kinh Nghiệm Nhập Hàng<i class="fa fa-angle-right blog-angle-right"></i></span>
      </li>
      <li class="blog-category active active2">
        <span class="blog-icon blog-category-icon"></span>
        <span class="blog-category-name" value="/blog?cat=5">Marketing Online </span>
        <ul class="cate-child">
          <li class="cate-child-item " value="/blog?cat=6"><i class="fa fa-circle"></i>Quảng Cáo Facebook<i class="fa fa-angle-right" style="display: none"></i></li>
          <li class="cate-child-item " value="/blog?cat=7"><i class="fa fa-circle"></i>Quảng Cáo Google<i class="fa fa-angle-right" style="display: none"></i></li>
        </ul>
        <i class="fa fa-angle-right blog-angle-right"></i>
      </li>
    </ul>
    <div style="clear: both"></div>
  </div>
  <!-- End menu -->
  
<?php if (!have_posts()) : ?>
  <div class="alert alert-warning">
    <?php _e('Sorry, no results were found.', 'roots'); ?>
  </div>
  <?php get_search_form(); ?>
<?php endif; ?>
<div class="blog-pages-right">
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
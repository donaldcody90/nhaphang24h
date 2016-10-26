<?php
if(!is_front_page() && !is_home()) { ?>
<div class="page-header visible-xs visible-sm">
  <h1>
    <?php echo roots_title(); ?>
  </h1>
</div>
<?php
  if (post_password_required() ) { 
  global $post;
  ?>
	<h3 class="title hidden-xs hidden-sm">Protected : <span><?php echo $post->post_title; ?></span></h3> 
  <?php
  }
 }
?>

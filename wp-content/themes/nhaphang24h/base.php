<?php 

get_template_part('templates/head'); ?>
<body <?php body_class(); ?>>

  <div class="wrapper">
  <!--[if lt IE 8]>
    <div class="alert alert-warning">
      <?php _e('You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.', 'roots'); ?>
    </div>
  <![endif]-->

  <?php
    do_action('get_header');
    get_template_part('templates/header');
  ?>

  <div class="wrap" role="document">
    <div class="container">
      <div class="row">
          <div class="content">
            <?php include roots_template_path(); ?>
        </div><!-- /.main -->
        <?php if (roots_display_sidebar()) : ?>
          <div class="sidebar" role="complementary">
             <?php include roots_sidebar_path(); ?>
          </div><!-- /.sidebar -->
        <?php endif; ?>
      </div>
    </div>
  </div><!-- /.wrap -->

  <?php get_template_part('templates/footer'); ?>

  <?php wp_footer(); ?>
  <script>
    $(document).ready(function () {
        $('.dropdown-toggle').dropdown();
    });
</script>
  </div>
</body>
</html>

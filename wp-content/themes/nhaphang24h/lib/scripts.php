<?php
/**
 * Scripts and stylesheets
 *
 * Enqueue stylesheets in the following order:
 * 1. /theme/assets/css/main.css
 *
 * Enqueue scripts in the following order:
 * 1. jquery-1.11.1.min.js via Google CDN
 * 2. /theme/assets/js/vendor/modernizr.min.js
 * 3. /theme/assets/js/scripts.js
 *
 * Google Analytics is loaded after enqueued scripts if:
 * - An ID has been defined in config.php
 * - You're not logged in as an administrator
 */
function roots_scripts() {
  /**
   * The build task in Grunt renames production assets with a hash
   * Read the asset names from assets-manifest.json
   */
  if (WP_ENV === 'development') {
    $assets = array(
      'css'       => '/assets/css/main.css',
      'js'        => '/assets/js/scripts.js',
      'modernizr' => '/assets/vendor/modernizr/modernizr.js',
      'jquery'    => '//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.js'
    );
  } else {
    $get_assets = file_get_contents(get_template_directory() . '/assets/manifest.json');
    $assets     = json_decode($get_assets, true);
    $assets     = array(
      'css'       => '/assets/css/main.min.css?' . $assets['assets/css/main.min.css']['hash'],
      'js'        => '/assets/js/scripts.min.js?' . $assets['assets/js/scripts.min.js']['hash'],
      'modernizr' => '/assets/js/vendor/modernizr.min.js',
      'jquery'    => '//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js'
    );
  }

   $assets['isotope']   = '/assets/js/isotope.min.js';   
   $assets['hoajs']   = '/assets/js/hoa.js';   
   $assets['fileDownload']   = '/assets/js/jquery.fileDownload.js'; 
     
   $assets['custom_style1'] = '/assets/css/custom_style1.css';
   $assets['custom_style2'] = '/assets/css/custom_style2.css';   
   $assets['bootstrap'] = '/assets/css/bootstrap.css';   

   $assets['custom_style3'] = '/assets/css/custom_style3.css';   
   $assets['hoacss'] = '/assets/css/hoa.css';   
   if(get_the_ID()==434){
      $assets['theme_css'] = '/assets/css/theme.min-color.css'; 
      $assets['responsive'] = '/assets/css/responsive-color.css';   
   }else{
      $assets['theme_css'] = '/assets/css/theme.min.css'; 
      $assets['responsive'] = '/assets/css/responsive.css';   
   }
   
   $assets['light_box'] = '/wp-content/plugins/js_composer/assets/lib/prettyphoto/css/prettyPhoto.css';


   
   //$assets['gg_fonts'] = 'http://fonts.googleapis.com/css?family=Open+Sans:300,400,600';
   $assets['font_awsome'] = '//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css';

  //wp_enqueue_style('gg_fonts', $assets['gg_fonts'], false, null);
  wp_enqueue_style('font_awsome', $assets['font_awsome'], false, null);
  wp_enqueue_style('roots_css', get_template_directory_uri() . $assets['css'], false, null);    
  //wp_enqueue_style('light_box', $assets['light_box'], false, null);   

  wp_enqueue_style('theme_css', get_template_directory_uri() . $assets['theme_css'], false, null);   
  #wp_enqueue_style('custom_style1', get_template_directory_uri() . $assets['custom_style1'], false, null);
  #wp_enqueue_style('custom_style2', get_template_directory_uri() . $assets['custom_style2'], false, null);
  #wp_enqueue_style('custom_style3', get_template_directory_uri() . $assets['custom_style3'], false, null);
  wp_enqueue_style('bootstrap', get_template_directory_uri() . $assets['bootstrap'], false, null);
  wp_enqueue_style('hoacss', get_template_directory_uri() . $assets['hoacss'], false, null);
  wp_enqueue_style('responsive', get_template_directory_uri() . $assets['responsive'], false, null);

  /**
   * jQuery is loaded using the same method from HTML5 Boilerplate:
   * Grab Google CDN's latest jQuery with a protocol relative URL; fallback to local if offline
   * It's kept in the header instead of footer to avoid conflicts with plugins.
   */
  if (!is_admin() && current_theme_supports('jquery-cdn')) {
    wp_deregister_script('jquery');
    wp_register_script('jquery', $assets['jquery'], array(), null, true);
    add_filter('script_loader_src', 'roots_jquery_local_fallback', 10, 2);
  }

  if (is_single() && comments_open() && get_option('thread_comments')) {
    wp_enqueue_script('comment-reply');
  }
  //$assets['image_light_box_js'] = '/assets/js/jquery.prettyPhoto.js';

  wp_enqueue_script('modernizr', get_template_directory_uri() . $assets['modernizr'], array(), null, true);
  wp_enqueue_script('jquery');
  //wp_enqueue_script('isotope', get_template_directory_uri() . $assets['isotope'], array(), null, true);  wp_enqueue_script('fileDownload', get_template_directory_uri() . $assets['fileDownload'], array(), null, true);
  
  //wp_enqueue_script('image_light_box_js', get_template_directory_uri() . $assets['image_light_box_js'], array(), null, true);

  wp_enqueue_script('roots_js', get_template_directory_uri() . $assets['js'], array(), null, true);
  wp_enqueue_script('hoajs', get_template_directory_uri() . $assets['hoajs'], array(), null, true);
  //Add wp-ajax url 
  $translation_array = array( 'ajax_url' => admin_url('admin-ajax.php') , 'site_url' => site_url() );
  wp_localize_script( 'roots_js', 'jsdata', $translation_array );
}
add_action('wp_enqueue_scripts', 'roots_scripts', 100);

// http://wordpress.stackexchange.com/a/12450
function roots_jquery_local_fallback($src, $handle = null) {
  static $add_jquery_fallback = false;

  if ($add_jquery_fallback) {
    echo '<script>window.jQuery || document.write(\'<script src="' . get_template_directory_uri() . '/assets/vendor/jquery/dist/jquery.min.js?1.11.1"><\/script>\')</script>' . "\n";
    $add_jquery_fallback = false;
  }

  if ($handle === 'jquery') {
    $add_jquery_fallback = true;
  }

  return $src;
}
add_action('wp_head', 'roots_jquery_local_fallback');

/**
 * Google Analytics snippet from HTML5 Boilerplate
 *
 * Cookie domain is 'auto' configured. See: http://goo.gl/VUCHKM
 */
function roots_google_analytics() { ?>
<script>
  <?php if (WP_ENV === 'production') : ?>
    (function(b,o,i,l,e,r){b.GoogleAnalyticsObject=l;b[l]||(b[l]=
    function(){(b[l].q=b[l].q||[]).push(arguments)});b[l].l=+new Date;
    e=o.createElement(i);r=o.getElementsByTagName(i)[0];
    e.src='//www.google-analytics.com/analytics.js';
    r.parentNode.insertBefore(e,r)}(window,document,'script','ga'));
  <?php else : ?>
    function ga() {
      console.log('GoogleAnalytics: ' + [].slice.call(arguments));
    }
  <?php endif; ?>
  ga('create','<?php echo GOOGLE_ANALYTICS_ID; ?>','auto');ga('send','pageview');
</script>

<?php }
if (GOOGLE_ANALYTICS_ID && (WP_ENV !== 'production' || !current_user_can('manage_options'))) {
  add_action('wp_footer', 'roots_google_analytics', 20);
}

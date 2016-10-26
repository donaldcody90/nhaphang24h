<?php 
$site_id=$atts['site_id'];

$links = get_posts(array(
  'post_type' => 'sitecn',
  'numberposts' => -1,
  'tax_query' => array(
    array(
      'taxonomy' => 'sites',
      'field' => 'id',
      'terms' => $site_id, // Where term_id of Term 1 is "1".
      'include_children' => false
    )
  )
));
//echo "<pre>";
//print_r($pages);
if($links){
?>

<div class="origin-block">
    <div class="origin-header">
      <span class="origin-title">
      <i>Đặt hàng từ</i>
      <a href="<?php echo $atts['site_link']; ?>" target="_blank"><strong><?php echo $atts['site_name']; ?></strong></a>
      </span>
    </div>
    <ul class="list-category">
    <?php foreach($links as $link) { ?>  
	  <li>
        <a href="<?php echo  get_post_meta($link->ID, 'post_sitecn_linkcn', true ); ?>" class="image-link" target="_blank">
			<?php $image = get_the_post_thumbnail($link->ID,'full'); echo $image; ?>
        <span class="category-title"><?php echo $link->post_title; ?></span>
        </a>
        <a class="view-more" href="<?php echo  get_post_meta($link->ID, 'post_sitecn_linkcn', true ); ?>" target="_blank">xem thêm</a>
      </li>
	<?php } ?>
    </ul>
	<?php /*
    <div class="search-block">
      <input type="text" class="origin-keyword" placeholder="Nhập tên sản phẩm tiếng Việt để tìm kiếm từ Taobao.com">
      <a href="javascript:;" class="origin-search-btn" web-name="Taobao"><i class="fa fa-search"></i></a>
    </div>
    */ ?>
  </div>
<?php 
}

?>
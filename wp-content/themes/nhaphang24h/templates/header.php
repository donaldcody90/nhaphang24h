<div class="top-header"> <!-- top header  -->
	<div class="container">
			<div class="row">
					<div class="pull-left top-text col-sm-6">
						<p><?php echo get_theme_option('top-text'); ?></p>
					</div>
					<div class="pull-right socials col-sm-6">
						<ul class="socials_menu">
							<?php if(get_theme_option('facebook-link') !="") { ?>
									<li class="facebook_icon"><a target="_blank" href="<?php echo get_theme_option('facebook-link'); ?>"><i class="fa fa-facebook"></i></a></li>
							<?php } ?>
							<?php if(get_theme_option('twitter-link') !="") { ?>
									<li class="twitter_icon"><a target="_blank" href="<?php echo get_theme_option('twitter-link'); ?>"><i class="fa fa-twitter"></i></a></li>
							<?php } ?>
							<?php if(get_theme_option('google-link') !="") { ?>
									<li class="google_plus_icon"><a target="_blank" href="<?php echo get_theme_option('google-link'); ?>"><i class="fa fa-google-plus"></i></a></li>
							<?php } ?>
							<?php if(get_theme_option('pinterest-link') !="") { ?>
									<li class="pinterest_icon"><a target="_blank" href="<?php echo get_theme_option('pinterest-link'); ?>"><i class="fa fa-pinterest"></i></a></li>
							<?php } ?>
							<?php if(get_theme_option('youtube-link') !="") { ?>
									<li class="youtube_icon"><a target="_blank" href="<?php echo get_theme_option('youtube-link'); ?>"><i class="fa fa-youtube-play"></i></a></li>
							<?php } ?>
						
						</ul>
					</div>
			</div>
	</div>
</div> <!-- end top header -->

<div class="header">
		<div class="container">
				<div class="row top-header-container">
					<div class="pull-left col-md-3">
						<a class="logo	" href="<?php echo get_home_url() ?>">
							<img src="<?php echo get_theme_option('logo','url'); ?>" alt="logo">
						</a>
					</div>
					<div class="col-sm-6 search-block">
						<div class="search-box">
						<div class="select-site-container">
							<select name="site">
								<option value="Taobao">Taobao</option>
								<option value="Tmall">Tmall</option>
								<option value="1688">1688</option>
								<option value="vipshop">VipShop</option>
							</select>
						</div>
						<input type="text" class="search-input header-search" placeholder="Nhập tên sản phẩm tiếng Việt">
						<input type="submit" class="btn-search" value="" />
						<div class="current-rate">
							<span class="rate"><strong>Tỉ giá:</strong> 1 NDT = <?php echo get_theme_option('currentrate'); ?> VNĐ </span>
						</div>
					</div>
					</div>
					<div class="pull-right  col-sm-3 link-user">
						<a class="logo" href="<?php echo get_home_url() ?>">
							Đăng nhập
						</a>
						<a class="logo" href="<?php echo get_home_url() ?>">
							Đăng ký
						</a>
					</div>
					
				</div>
				
		</div>
		
			<div class="main-menu">
				<div class=" collapse navbar-collapse " role="navigation">
				<div class="container">
				<?php
					if (has_nav_menu('primary_navigation')) :
					wp_nav_menu(array('theme_location' => 'primary_navigation', 'walker' => new Roots_Nav_Walker(), 'menu_class' => 'nav navbar-nav'));
					endif;
				?>
				</div>				
				</div>				
			</div>
	
</div>
<?php
	 if(is_front_page() || is_home()) {
?>
<div class="nh-description">
	<div class="container">
	<div class="row">
	  <div class="row nh-description-container">
		<ul class="list-description">
		  <li class="description-item-1">
			<span class="description-item-content">
			<span class="description-hight-light-text">DỄ DÀNG</span>
			TẠO VÀ QUẢN LÝ ĐƠN HÀNG, TÌM NGUỒN HÀNG,
			<span class="description-hight-light-text">TƯ VẤN MIỄN PHÍ</span>
			</span>
		  </li>
		  <li class="description-item-2">
			<span class="description-item-content">
			<span class="description-hight-light-text">ĐẢM BẢO 100% </span>
			HÀNG HÓA, ĐỀN BÙ KHI CÓ SAI SÓT, THẤT LẠC
			</span>
		  </li>
		  <li class="description-item-3">
			<span class="description-item-content">
			GIAO HÀNG TẬN NƠI,<span class="description-hight-light-text"> NHANH CHÓNG </span>DÙ ĐƠN HÀNG <span class="description-hight-light-text">CHỈ 1 SẢN PHẨM</span>
			</span>
		  </li>
		</ul>
	  </div>
	</div>
	</div>
</div>
<?php } ?>
<div class="slider-banner">
	<?php
	 if(is_front_page() || is_home()) {
			echo do_shortcode('[layerslider id="1"]'); 	
	} ?>
</div>
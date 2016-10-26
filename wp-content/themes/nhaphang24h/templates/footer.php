<div class="footer">
		<div class="container">
			<div class="row">
				<div class="footer-wrapper">
					<div class="footer-menu">
						<?php
						if (has_nav_menu('footer_navigation')) :
							  wp_nav_menu(array('theme_location' => 'footer_navigation', 'walker' => new Roots_Nav_Walker(), 'menu_class' => 'nav-footer'));
						endif;
						?>	
					</div>
					<div class="copyright">
						<p><?php echo get_theme_option('copyright-text'); ?></p>
					</div>
				</div>
			</div>
		</div>
</div>
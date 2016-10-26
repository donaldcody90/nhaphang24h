<div class="location-detail">
		<img src="<?php echo get_theme_option('background-contact','url'); ?>" class="footer_background_image" alt="Footer background image">
		<div class="location-detail-inner">
				<div class="container">
					<div class="row">
							<div class="col-md-8 col-sm-7 col-xs-12 locations">
								<h1 class="location-title">Location Details</h1>
								<div class="location-map">
								<img src="<?php echo get_theme_option('contact-map','url'); ?>" />
								</div>
								<div class="row">
											<div class="col-md-6 col-sm-6 col-xs-6 address-area">
												<div class="address">
													<?php echo get_theme_option('contact-address'); ?>
												</div>
												<div class="contact-detail">
													<p><span>Toll Free</span> : <a href="tel:<?php echo get_theme_option('contact-tollfree'); ?>"><?php echo get_theme_option('contact-tollfree'); ?></a></p>
													<p><span>Phone</span> : <a href="tel:<?php echo get_theme_option('contact-phone'); ?>"><?php echo get_theme_option('contact-phone'); ?></a></p>										
													<p><span>Email</span> : <a href="mailto:<?php echo get_theme_option('contact-email'); ?>"><?php echo get_theme_option('contact-email'); ?></a></p>								</div>
											</div>
											<div class="col-md-4 col-sm-4 col-xs-6 time-detail">
												<h6>Opening Hours : </h6>
												<?php echo get_theme_option('contact-openhour'); ?>							
												<div class="schedule_visit">
													<a href="<?php echo get_theme_option('contact-button-link'); ?>" ><?php echo get_theme_option('contact-button-text'); ?></a>
												</div>
											</div>
										</div>
							</div>


							<div class="col-md-4 col-sm-5 col-xs-12" id="contact-part">						
									<div class="contact-agent">
										<h1>Contact our agent</h1>
										<div class="row agent-row">
											<div class="col-md-4 col-xs-4">
												<img src="<?php echo get_theme_option('contact-person-image','url'); ?>" alt="post-image">
											</div>
											<div class="col-md-8 col-xs-8">
												<h3 class="agent-name"><?php echo get_theme_option('contact-person-name'); ?></h3>
												<p class="certified-agent">
													<?php echo get_theme_option('contact-person-desc'); ?>									</p>
												<p><span class="glyphicon glyphicon-earphone"></span> <?php echo get_theme_option('contact-person-phone'); ?></p>
												<p><span class="glyphicon glyphicon-envelope"></span> <a href="mailto:<?php echo get_theme_option('contact-person-email'); ?>"><?php echo get_theme_option('contact-person-email'); ?></a></p>
											</div>
										</div>
																								<div class="agent-form">
											<div class="inner-page-shortcodes" id="agent-contact-area" style="margin:0;"><div class="message_area_bottom"></div></div>
											<h3>SEND MESSAGE TO <?php echo get_theme_option('contact-person-name') ?></h3>
											<?php echo do_shortcode('[contact-form-7 id="417" title="Contact Form"]'); ?>
											
										</div>
									</div>
								</div>
					</div>

				</div>
		</div>
</div>
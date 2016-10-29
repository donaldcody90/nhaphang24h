	<div class="single-blogs">
		<div class="single-blog">
        <a class="thumbnail-img" href="<?php the_permalink(); ?>" alt="<?php the_title(); ?>" title="<?php the_title(); ?>">
		<?php the_post_thumbnail( 'full' ); ?>
		</a>
        <div class="single-blog-title">
			<a href="<?php the_permalink(); ?>" alt="<?php the_title(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a>
		</div>
		<div class="block-date-time">
            <span class="date"><?php echo get_the_date(); ?></span>
		</div>		
		<div class="nh-row"></div>
        <div class="single-blog-content">
          <?php the_content(); ?>             
        </div>
        </div>
    </div>
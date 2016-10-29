    <div class="blog-list">
      <div class="blog-item">
        <a class="thumbnail-img" href="<?php the_permalink(); ?>" alt="<?php the_title(); ?>" title="<?php the_title(); ?>">
		<?php the_post_thumbnail( 'full' ); ?>
		</a>
        <div class="blog-title"><a href="<?php the_permalink(); ?>" alt="<?php the_title(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></div>
        <div class="blog-content">
          <?php the_excerpt(); ?>             
        </div>
        <div style="clear: both"></div>
      </div>
    </div>


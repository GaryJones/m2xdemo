<?php if ( have_posts() ) : ?>
	<ul class="widget-posts-list">
		<?php while( have_posts() ) : the_post(); ?>
			<li <?php echo post_class( 'widget-post' ); ?>>
				<?php if ( has_post_thumbnail() ) : ?>
					<div class="widget-post-thumbnail">
						<div class="post-thumbnail">
							<img src="<?php echo willow_aq_resize( get_post_thumbnail_id(), 110, 70, true, true ); ?>" alt="<?php echo esc_url( get_the_title() ); ?>" />
						</div>
					</div>
				<?php endif; ?>
				<a href="<?php the_permalink(); ?>" class="widget-post-title"><?php the_title(); ?></a>
				<?php if ( $show_date ) : ?>
					<small class="widget-post-date"><?php echo get_the_date(); ?></small>
				<?php endif; ?>
			</li>
		<?php endwhile; ?>
	</ul>
<?php endif; ?>
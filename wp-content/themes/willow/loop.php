<div class="blog-loop">
	<?php if ( have_posts() ) : while( have_posts() ) : the_post() ; ?>

		<article id="post-<?php the_ID(); ?>" <?php post_class( 'content-post' ); ?>>

			<?php if ( has_post_thumbnail() ) : ?>
				
				<div class="post-thumbnail">
					<img src="<?php echo willow_aq_resize( get_post_thumbnail_id(), 790, 500, true, true ); ?>" alt="<?php echo esc_attr( get_the_title() ); ?>" />
				</div>
			<?php else : ?>
				<div class="post-thumbnail blank"></div>
			<?php endif; ?>

			<div class="post-author">
				<?php echo get_avatar( get_the_author_meta( 'ID' ), 80, '', get_the_author_meta( 'display_name' ) ); ?>
			</div>

			<h2 class="post-title">
				<?php if ( ! is_single( get_the_ID() ) ) : ?>
					<a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a>
				<?php else : ?>
					<?php the_title(); ?>
				<?php endif; ?>
			</h2>

			<ul class="post-meta">
				<?php
				$twitter_account = get_the_author_meta( 'twitter' );
				$twitter_link = ( ! empty( $twitter_account ) ) ? ' <a class="twitter-link" href="http://twitter.com/' . $twitter_account . '"><span class="fa fa-twitter"></span>' . $twitter_account . '</a>' : '';
				?>
				<li class="post-meta-author"><?php printf( __( 'By %s', 'willow' ), get_the_author_link() . $twitter_link ); ?></li>
				<li class="post-meta-date"><?php echo get_the_date(); ?></li>
				<li class="post-meta-category"><?php the_category( ',' );; ?></li>
			</ul>

			<div class="post-content">
				<?php ob_start(); ?>
				<p class="read-more text-center">
					<a href="<?php the_permalink(); ?>" class="btn btn-black"><?php _e( 'Read More', 'willow' ); ?></a>
				</p>
				<?php $read_more = ob_get_clean(); ?>

				<?php the_content( $read_more ); ?>
				
			</div>

			<?php if ( is_single() ) : ?>

					<?php wp_link_pages(array(
						'before' => '<p class="post-pagination">',
						'after ' => '</p>',
						'link_before' => '',
						'link_after' => '',
						'next_or_number' => 'next',
						'nextpagelink' => '<span class="next">' . __( 'Next Page &raquo;', 'willow' ) . '</span>',
						'previouspagelink' => '<span class="prev">' . __( '&laquo; Previous Page', 'willow' ) . '</span>',
					)); ?>

				<div class="post-tags tagcloud">
					<?php the_tags( '', '', '' ); ?>
				</div>
			<?php endif; ?>

		</article>

	<?php endwhile; endif; ?>
</div>
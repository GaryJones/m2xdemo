<?php get_header(); ?>

<section id="content" class="content-section section">
	<div class="container container-table">

		<div class="main-section" role="main">
					
			<div class="search-info">
				<div class="row">
					<div class="keyword col-sm-6"><?php printf( __( 'Search results for "%s"', 'willow' ), '<strong>' . get_search_query() . '</strong>' ); ?></div>

					<?php
					global $wp_query, $paged, $posts_per_page; //var_dump($wp_query);
					$start = ( ( $paged == 0 ) ? 0 : $paged - 1 ) * $posts_per_page + 1;
					$end = $start + $wp_query->post_count - 1;
					?>
					<div class="count col-sm-6"><?php printf( __( 'Showing results %s - %s of %s results found', 'willow' ), $start, $end, $wp_query->found_posts ); ?></div>
				</div>
			</div>

			<div class="search-loop">

				<?php if ( have_posts() ) : while( have_posts() ) : the_post() ; ?>

					<article id="post-<?php the_ID(); ?>" <?php post_class( 'search-post' ); ?>>

						<h4 class="post-title">
							<a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a>
						</h4>

						<div class="post-link"><?php the_permalink(); ?></div>

						<div class="post-content"><?php the_excerpt(); ?></div>

						<div class="post-meta"><?php echo get_the_date(); ?></div>

					</article>

				<?php endwhile; else: ?>

					<p><?php _e( 'Sorry, no results found, please try another keyword', 'willow' ); ?></p>

				<?php endif; ?>

			</div>

			<?php
			$prev = get_previous_posts_link( __( '&laquo; Newer Posts', 'willow' ) );
			$next = get_next_posts_link( __( 'Older Posts &raquo;', 'willow' ) );
			?>

			<?php if ( ! empty( $prev ) || ! empty( $next ) ) : ?>
				<ul class="search-pagination pager">
					<?php if ( ! empty( $prev ) ) : ?>
						<li class="previous"><?php echo $prev; ?></li>
					<?php endif; ?>

					<?php if ( ! empty( $next ) ) : ?>
						<li class="next"><?php echo $next; ?></li>
					<?php endif; ?>
				</ul>
			<?php endif; ?>

			<?php comments_template(); ?>

		</div>

		<?php get_sidebar(); ?>

	</div>
</section>

<?php get_footer(); ?>
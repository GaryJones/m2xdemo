<?php

/*
 * Template Name: Blog Full Width
 * Description: This page template works as blog post index page with Sidebar disabled.
 */

?>

<?php get_header(); ?>

<?php if ( have_posts() ) : while( have_posts() ) : the_post(); ?>

	<section id="content" class="content-section section">
		<div class="container container-table">

			<?php global $wp_query, $more, $paged, $page; $temp = $wp_query; $more = 0;
			$paged    = max( $paged , $page );
			$wp_query = new WP_Query( array(
				'post_type' => 'post',
				'paged'     => $paged,
			) ); ?>

			<div class="main-section" role="main">

				<?php get_template_part( 'loop' ); ?>

				<?php
				$prev = get_previous_posts_link( __( '&laquo; Newer Posts', 'willow' ) );
				$next = get_next_posts_link( __( 'Older Posts &raquo;', 'willow' ) );
				?>

				<?php if ( ! empty( $prev ) || ! empty( $next ) ) : ?>
					<ul class="blog-pagination pager">
						<?php if ( ! empty( $prev ) ) : ?>
							<li class="previous"><?php echo $prev; ?></li>
						<?php endif; ?>

						<?php if ( ! empty( $next ) ) : ?>
							<li class="next"><?php echo $next; ?></li>
						<?php endif; ?>
					</ul>
				<?php endif; ?>

			</div>

			<?php $wp_query = $temp; wp_reset_postdata(); ?>

		</div>
	</section>


<?php endwhile; endif; ?>

<?php get_footer(); ?>
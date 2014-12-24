<?php get_header(); ?>

<section id="content" class="content-section section">
	<div class="container container-table">

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

		<?php get_sidebar(); ?>

	</div>
</section>

<?php get_footer(); ?>
<?php get_header(); ?>

<?php $is_using_vc = get_post_meta( get_the_ID(), '_wpb_vc_js_status', true ); ?>

<?php if ( have_posts() ) : while( have_posts() ) : the_post(); ?>

	<?php if ( $is_using_vc === 'true' ) : ?>

		<div id="content" <?php post_class( 'visual-composer-page' ); ?>>

			<?php the_content(); ?>

		</div>

	<?php else : ?>

		<section id="content" class="content-section section">
			<div class="container container-table">

				<div class="main-section" role="main">
					
					<div class="page-loop">

						<article id="page-<?php the_ID(); ?>" <?php post_class(); ?>>
							<?php the_content(); ?>
						</article>

					</div>

					<?php comments_template(); ?>

				</div>

				<?php get_sidebar(); ?>

			</div>
		</section>

	<?php endif; ?>

<?php endwhile; endif; ?>

<?php get_footer(); ?>
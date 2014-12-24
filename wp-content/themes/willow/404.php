<?php get_header(); ?>

<section id="content" class="content-section section">
	<div class="container">

		<div class="page-not-found">
			<h1><?php _e( 'Ooops, Page Not Found', 'willow' ); ?></h1>
			<p><?php _e( 'Sorry the page you\'re looking for could not be found. Try using the search box below.', 'willow' ); ?></p>

			<div class="search-form row">
				<?php the_widget( 'WP_Widget_Search', array(), array(
					'before_widget' => '<div class="col-sm-6 col-sm-offset-3 widget_search">',
					'after_widget' => '</div>',
					'before_title' => '<h5 class="widget-title">',
					'after_title' => '</h5>',
				) ); ?>
			</div>
		</div>

	</div>
</section>

<?php get_footer(); ?>
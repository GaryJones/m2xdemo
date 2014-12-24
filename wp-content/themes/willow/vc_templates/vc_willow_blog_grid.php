<?php

extract( shortcode_atts( array(
	'count'         => '',
	'columns'       => '',
	'el_class'      => '',
	'css_animation' => '',
	'category'      => '',
), $atts ) );

if ( ! class_exists( 'VP_Portfolio' ) ) return null;

wp_enqueue_script( 'isotope' );

global $wp_query, $more; $more = 0; $temp = $wp_query;
$wp_query = new WP_Query(array_merge(
	array(
		'post_type'           => 'post',
		'posts_per_page'      => $count,
		'ignore_sticky_posts' => 1,
	),
	(empty($category)) ? array() : array(
		'tax_query' => array(
			'relation' => 'AND',
			array(
				'taxonomy' => 'category',
				'field'    => 'slug',
				'terms'    => array_map('trim', explode(',', $category)),
				'operator' => 'IN'
			)
		)
	)
));

$el_class = $this->getExtraClass( $el_class );
$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'wpb_willow_blog_grid wpb_content_element js-isotope-grid ' . $el_class, $this->settings['base'] );
?>

<?php if ( have_posts() ) : ?>

	<div class="<?php echo $css_class; ?>">
		<div class="wpb_wrapper">

			<div class="portfolio-grid-loop row">

				<?php while( have_posts() ) : the_post(); ?>

					<div id="blog-grid-<?php the_ID(); ?>" <?php post_class( 'blog-grid-post col-md-' . 12 / $columns . ' col-sm-6 ' . $this->getCSSAnimation( $css_animation ) ); ?>>

						<div class="blog-grid-post-wrapper">

							<?php if ( has_post_thumbnail() ) : ?>
								<div class="blog-grid-post-thumbnail">
									<a href="<?php the_permalink(); ?>">
										<img src="<?php echo willow_aq_resize( get_post_thumbnail_id(), 570, null, true, true ); ?>" alt="<?php echo esc_attr( get_the_title() ); ?>" />
									</a>
								</div>
							<?php endif; ?>

							<?php $categories = get_the_terms( get_the_ID(), 'category' );

							$cat_string = array();
							foreach ( $categories as $category ) {
								$cat_string[] = $category->name;
							} ?>
							
							<div class="blog-grid-post-category"><?php echo implode( ' / ', $cat_string ); ?></div>
							
							<h4 class="blog-grid-post-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
							
							<div class="blog-grid-post-content"><?php the_excerpt(); ?></div>

							<small class="blog-grid-post-date"><?php echo get_the_date(); ?></small>
						</div>
					</div>
				<?php endwhile; ?>

			</div>

		</div>
	</div>
	<?php echo $this->endBlockComment( 'willow_blog_grid' ); ?>

<?php endif; ?>

<?php $wp_query = $temp; wp_reset_postdata(); ?>
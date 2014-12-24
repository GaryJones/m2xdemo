<?php

extract( shortcode_atts( array(
	'count'         => '',
	'columns'       => '',
	'filter'        => 'true',
	'el_class'      => '',
	'css_animation' => '',
	'pagination'    => 'true',
	'category'      => '',
), $atts ) );

if ( ! class_exists( 'VP_Portfolio' ) ) return null;

// generate unique id
$uid = willow_generate_id('pf-');

wp_enqueue_script( 'isotope' );
wp_enqueue_script( 'jquery-magnific-popup' );

global $wp_query, $paged, $page; $temp = $wp_query;

// discover current page number
if ( get_query_var('paged') )
	$paged = get_query_var('paged');
elseif ( get_query_var('page') )
	$paged = get_query_var('page');
else
	$paged = 1;

$wp_query = new WP_Query(array_merge(
	array(
		'post_type'           => 'portfolio',
		'posts_per_page'      => $count,
		'ignore_sticky_posts' => 1,
		'paged'               => max( $paged, $page )
	),
	(empty($category)) ? array() : array(
		'tax_query' => array(
			'relation' => 'AND',
			array(
				'taxonomy' => 'portfolio_category',
				'field'    => 'slug',
				'terms'    => explode(',', $category),
				'operator' => 'IN'
			)
		)
	)
));

// get selected categorie id's
$cats = (empty($category)) ? array() : explode(',', $category);
$all_categories = array();
foreach ( $cats as $cat ) {                     
    $term  = get_term_by('slug', $cat, 'portfolio_category');
    $all_categories[] = $term->term_id;
}

$el_class  = $this->getExtraClass( $el_class );
$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'wpb_willow_portfolio_grid wpb_content_element js-isotope-grid ' . $el_class, $this->settings['base'] );
?>

<?php if ( have_posts() ) : ?>

<?php

// discover next url
$next_link = get_next_posts_link();
$next_url  = '';
if (!empty($next_link)) {
	preg_match_all('/href="([^\s"]+)/', $next_link, $match);
	$next_url = $match[1][0];
}

?>

	<div class="<?php echo $css_class; ?>" id="<?php echo $uid; ?>" data-next="<?php echo (!empty($next_url) ? $next_url : "false"); ?>">
		<div class="wpb_wrapper">

			<?php if ( $filter == 'true' ) : ?>
				<div class="portfolio-grid-filter">
					<a href="#" data-filter="*" class="active"><?php _e( 'All', 'willow' ); ?></a>
					<?php $all_categories = get_terms( 'portfolio_category', array(
						'hide_empty' => false,
						'include'    => $all_categories
					) );

					foreach ( $all_categories as $category) : ?>
					<a href="#" data-filter=".filter-<?php echo $category->slug; ?>"><?php echo $category->name; ?></a>
					<?php endforeach; ?>
				</div>
			<?php endif; ?>

			<div class="portfolio-grid-loop row">

				<?php while( have_posts() ) : the_post(); ?>

					<?php $categories = get_the_terms( get_the_ID(), 'portfolio_category' );

					$cat_string = array();
					$filter_string = array();
					if ( ! empty( $categories ) ) {
						foreach ( $categories as $category ) {
							$cat_string[] = $category->name;
							$filter_string[] = 'filter-' . $category->slug;
						}
					} ?>

					<div id="portfolio-grid-<?php the_ID(); ?>" <?php post_class( 'portfolio-grid-post ' . implode( ' ', $filter_string ) . ' col-md-' . 12 / $columns . ' col-sm-6 ' . $this->getCSSAnimation( $css_animation ) ); ?>>

						<div class="portfolio-grid-post-wrapper text-center">

							<?php if ( has_post_thumbnail() ) : ?>
								<div class="portfolio-grid-post-thumbnail">
									<a href="<?php the_permalink(); ?>" class="js-ajax-popup">
										<img src="<?php echo willow_aq_resize( get_post_thumbnail_id(), 570, 340, true, true ); ?>" alt="<?php the_title(); ?>" />
									</a>
								</div>
							<?php endif; ?>
							
							<h4 class="portfolio-grid-post-title"><?php the_title(); ?></h4>
							
							<?php if ( ! empty( $cat_string ) ) : ?>
								<small class="portfolio-grid-post-category"><?php echo implode( ' / ', $cat_string ); ?></small>
							<?php endif; ?>
							
							<a href="<?php the_permalink(); ?>" class="portfolio-grid-post-view-project-button js-ajax-popup btn"><?php _e( 'View Project', 'willow' ); ?></a>

						</div>
					</div>
				<?php endwhile; ?>
			</div>
			
			<?php if ($pagination == 'true') : ?>
			<div class="portfolio-pagination text-center">
				<?php if (!empty($next_url)) : ?>
				<div class="load-more">
					<a href="<?php echo $next_url; ?>" class="btn btn-icon btn-lg btn-black"><b></b><i class="fa fa-refresh"></i><span class="button-label"><?php _e('Load More', 'willow'); ?></span></a>
				</div>
				<?php endif; ?>
			</div>
			<?php endif; ?>

		</div>
	</div>
	<?php echo $this->endBlockComment( 'willow_portfolio_grid' ); ?>

<?php endif; ?>

<?php $wp_query = $temp; wp_reset_postdata(); ?>
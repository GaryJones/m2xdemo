<?php
/**
 * VP_PF_Shortcodes class.
 *
 * @class           VP_PF_Shortcodes
 * @since           0.1
 * @category        Class
 * @author          Vafpress
 */

if( ! defined( 'ABSPATH' ) ) exit; // exit on direct access

if( ! class_exists( 'VP_PF_Shortcodes' ) ) :

class VP_PF_Shortcodes {

	public static function init() {
		// Define shortcodes
		$shortcodes = array(
			'portfolio' => __CLASS__ . '::render_portfolio'
		);
		foreach ( $shortcodes as $shortcode => $render_func ) {
			add_shortcode( $shortcode, $render_func );
		}

		// Filter content to format shortcodes
		add_filter( 'the_content', array(__CLASS__, 'format_shortcodes') );
	}

	public static function render_portfolio( $atts, $content = null )
	{
		extract(shortcode_atts(array(
			'columns'        => 4,
			'posts_per_page' => 10,
			'mode'           => 'default',
			'pagination'     => 'page',
			'class'          => '',
			'category'       => '',
		), $atts));

		// Enqueue Style
		wp_enqueue_style( 'vp-portfolio' );

		// Temporary replace the global WP Query
		global $wp_query, $paged, $more;
		$temp_query = $wp_query;
		$temp_more  = $more;
		$more       = 0;
		$wp_query   = new WP_Query(array_merge(
			array(
				'post_type'      => 'portfolio',
				'posts_per_page' => $posts_per_page,
				'paged'          => $paged,
			),
			(empty($category)) ? array() : array(
				'tax_query' => array(
					'relation' => 'AND',
					array(
						'taxonomy' => 'portfolio_category',
						'field'    => 'id',
						'terms'    => explode(',', $category),
						'operator' => 'IN'
					)
				)
			)
		));

		// Begin Render
		ob_start(); ?>
		<div<?php echo ' class = "' . trim( implode( " ", array("vp-portfolio", "vp-mode-$mode", $class) ) ) . '"'; ?>>

			<?php if (have_posts()) : ?>
			<div class="vp-portfolio-loop">
			<?php while (have_posts()) : the_post(); ?>
				<div <?php post_class("vp-portfolio-post vp-clear"); ?>>
					<?php if (has_post_thumbnail()) : ?>
					<div class="vp-portfolio-post-thumbnail vp-left">
						<?php the_post_thumbnail(); ?>
					</div>
					<?php endif; ?>
					
					<div class="vp-portfolio-post-summary vp-fill-rest">
						<h2 class="vp-portfolio-post-title">
							<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a>
						</h2>
						<div class="vp-portfolio-post-excerpt">
							<?php echo do_shortcode(self::strip_shortcodes('portfolio', get_the_content(__('Read More...', 'vp_portfolio')))); ?>
						</div>
						<div class="vp-portfolio-post-meta vp-meta">
							<?php printf(__('Posted on %s, by %s, under %s, %s comment(s)', 'vp_portfolio'),
								get_the_time('F j, Y'),
								get_the_author_link(),
								get_the_term_list(get_the_ID(), 'portfolio_category', '', ', ', ''),
								get_the_term_list(get_the_ID(), 'portfolio_tag', '', ', ', ''),
								get_comments_number()); ?>
							 | <?php comments_number(__('No Comments', 'vp_portfolio'), __('1 Comment', 'vp_portfolio'), __('% Comments', 'vp_portfolio')); ?>
							<br/>
							<?php the_terms(get_the_ID(), 'portfolio_tag', __('Tags: ', 'vp_portfolio'), ', ', ''); ?>
						</div>
					</div>
				</div>
			<?php endwhile; ?>
			</div>
			<?php endif; ?>

			<?php if ($pagination == 'page') : ?>
			<div class="vp-portfolio-pagination vp-clear">
				<div class="vp-left"><?php previous_posts_link(); ?></div>
				<div class="vp-right"><?php next_posts_link(); ?></div>
			</div>
			<?php endif; ?>

		</div>
		<?php $wp_query = $temp_query; wp_reset_postdata(); $more = $temp_more;
		$html = ob_get_clean();
		// End Render

		return apply_filters('vp_pf_sc_render_portfolio', $html, $atts, $content);
	}

	public static function strip_shortcodes( $codes, $content ) {
		global $shortcode_tags;

		$backup         = $shortcode_tags;
		foreach ( (array) $codes as $code ) {
			$shortcode_tags[$code] = 1;
		}
		$content        = strip_shortcodes($content);
		$shortcode_tags = $backup;

		return $content;
	}

	public static function format_shortcodes($content) {

		// inline shortcodes
		$tags = 'portfolio';
		// opening tag
		$content = preg_replace("/(<p>)?\[($tags)(\s[^\]]+)?\](<\/p>|<br \/>)?/", "[$2$3]", $content);
		// closing tag
		$content = preg_replace("/(<p>)?\[\/($tags)](<\/p>|<br \/>)?/", "[/$2]", $content);

		return $content;
	}

}

endif;

VP_PF_Shortcodes::init();

/**
 * EOF
 */
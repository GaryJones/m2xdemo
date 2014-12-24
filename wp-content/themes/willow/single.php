<?php get_header(); ?>

<section id="content" class="content-section section">
	<div class="container container-table">

		<div class="main-section" role="main">

			<?php get_template_part( 'loop' ); ?>

			<?php if ( willow_option( 'enable_social_share' ) ) : ?>
				<div class="social-share">
					<h3 class="separator-title"><span><?php _e( 'Share the Love', 'willow' ); ?></span></h3>
					<ul class="social-share-links js-social-share" data-sharrre="<?php echo WILLOW_ADMIN . 'script/sharrre.php'; ?>" data-thumbnail="<?php echo willow_get_share_thumbnail(); ?>">
						<?php wp_enqueue_script( 'jquery-sharrre' );

						$links = willow_option( 'social_share_links' );
						if ( empty( $links ) ) $links = array();

						foreach ( $links as $type ) : ?>
							<li class="social-share-item <?php echo strtolower( $type ); ?>" data-icon="fa-<?php echo strtolower( $type ); ?>" data-type="<?php echo $type; ?>" data-url="<?php the_permalink(); ?>" data-text="<?php the_title(); ?>"></li>
						<?php endforeach; ?>

						<li class="dummy hidden">
							<a class="share-button" href="#">
								<span class="icon fa"></span>
								<span class="count">{total}</span>
							</a>
						</li>
					</ul>
				</div>
			<?php endif; ?>
			
			<div class="author-box">
				<h3 class="separator-title"><span><?php _e( 'About the Author', 'willow' ); ?></span></h3>
				<div class="post-author">
					<div class="author-avatar"><?php echo get_avatar( get_the_author_meta( 'ID' ), 80 , '', get_the_author_meta( 'display_name' ) ); ?></div>

					<h5 class="author-name"><?php the_author_posts_link(); ?></h5>
					<div class="author-bio"><?php the_author_meta( 'description' ); ?></div>

					<?php $socmed = array();

					if ( get_the_author_meta( 'facebook' ) ) $socmed['facebook'] = get_the_author_meta( 'facebook' );
					if ( get_the_author_meta( 'twitter' ) ) $socmed['twitter'] = get_the_author_meta( 'twitter' );
					if ( get_the_author_meta( 'googleplus' ) ) $socmed['googleplus'] = get_the_author_meta( 'googleplus' );

					if ( count( $socmed ) > 0 ) : ?>
						<ul class="social-media-links author-socmed clearfix">
							<?php if ( array_key_exists( 'facebook', $socmed ) ) : ?><li><a href="http://facebook.com/<?php echo $socmed['facebook']; ?>"><i class="fa fa-facebook"></i><span class="hidden">facebook</span></a></li><?php endif; ?>
							<?php if ( array_key_exists( 'twitter', $socmed ) ) : ?><li><a href="http://twitter.com/<?php echo $socmed['twitter']; ?>"><i class="fa fa-twitter"></i><span class="hidden">twitter</span></a></li><?php endif; ?>
							<?php if ( array_key_exists( 'googleplus', $socmed ) ) : ?><li><a href="http://plus.google.com/<?php echo $socmed['googleplus']; ?>?rel=author"><i class="fa fa-googleplus"></i><span class="hidden">googleplus</span></a></li><?php endif; ?>
						</ul>
					<?php endif; ?>
				</div>
			</div>
			
			<?php if ( willow_option( 'enable_related_posts' ) ) : ?>
			
				<?php global $wp_query;
				$cat_arr = array();
				foreach ( get_the_category() as $category ) {
					array_push( $cat_arr, $category->term_id );
				}

				$temp = $wp_query;
				$wp_query = new WP_Query( array(
					'orderby'        => 'rand',
					'order'          => 'DESC',
					'post_type'      => 'post',
					'posts_per_page' => 3,
					'post__not_in'   => array( get_the_ID() ),
					'category__in'   => $cat_arr,
					'post_status'    => 'publish',
				) );

				if ( have_posts() ) : ?>
					<div class="related-posts">
						<h3 class="separator-title"><span><?php _e( 'You Might Also Like', 'willow' ); ?></span></h3>
						<ul class="related-posts-list row">
							<?php while ( have_posts() ) : the_post(); ?>
								<li <?php post_class( 'grid-post col-sm-4' ); ?>>
									<a class="grid-post-thumbnail" href="<?php the_permalink(); ?>" rel="bookmark">
										<img src="<?php echo willow_aq_resize( get_post_thumbnail_id(), 240, 180, true, true ); ?>" alt="<?php echo esc_attr( get_the_title() ); ?>" />
									</a>
									<a class="grid-post-title" href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
									<small class="grid-post-date"><?php echo get_the_date(); ?></small>
								</li>
							<?php endwhile; ?>
						</ul>
					</div>
				<?php endif;

				$wp_query = $temp;
				wp_reset_postdata(); ?>

			<?php endif; ?>

			<?php comments_template(); ?>

		</div>

		<?php get_sidebar(); ?>

	</div>
</section>

<?php get_footer(); ?>
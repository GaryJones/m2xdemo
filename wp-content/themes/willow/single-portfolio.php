<?php if ( ( defined( 'DOING_AJAX' ) && DOING_AJAX ) || isset( $_GET['iframe'] ) ) {
	get_header( 'portfolio-ajax' );
}
else {
	get_header();
} ?>

<?php $is_using_vc = get_post_meta( get_the_ID(), '_wpb_vc_js_status', true ); ?>

<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

	<?php if ( $is_using_vc === 'true' ) : ?>

		<div id="content" <?php post_class( 'visual-composer-page' ); ?>>

			<?php the_content(); ?>

		</div>

	<?php else : ?>

		<section id="content" class="content-section section">
			<div class="container container-table">

				<div id="portfolio-<?php the_ID(); ?>" <?php post_class( 'portfolio-post clearfix' ); ?>>

					<?php $media = VP_PF_Portfolio::instance()->get_media(); ?>

					<div class="portfolio-images-section">

						<?php if ( $media['mode'] == 'video' ) : ?>

							<?php $video = $media['media'][0]; ?>

							<div class="video">
								<div class="video-wrapper <?php echo $video['mode']; ?>">
									<?php if ( $video['mode'] === 'external' ) : ?>
										<?php echo do_shortcode( $video['external'] ); ?>
									<?php elseif ( $video['mode'] === 'internal' ) : ?>
										<video controls="controls" preload="metadata" poster="<?php echo $video['internal_poster']; ?>">
											<source src="<?php echo $video['internal']; ?>" type="video/mp4" />
											<source src="<?php echo $video['internal_webm']; ?>" type="video/webm" />
											<source src="<?php echo $video['internal_ogg']; ?>" type="video/ogg" />
										</video>
									<?php endif; ?>
								</div>
							</div>

						<?php else : ?>

							<?php $images = $media['media'];
							$images_layout = willow_portfolio_option( 'images_layout', 'default' ); ?>

							<?php if ( 'slider' == $images_layout ) wp_enqueue_script( 'jquery-caroufredsel' ); ?>

							<?php if ( count( $images ) ) : ?>

								<div class="portfolio-images images-layout-<?php echo $images_layout; ?>">
									<div <?php echo ( 'slider' == $images_layout ) ? 'class="portfolio-images-slider caroufredsel js-caroufredsel" data-caroufredsel="portfolio-images-slider"' : 'class="row"'; ?>>
										<?php foreach( $images as $i => $image ) : ?>

											<?php
											$col_class = 'col-md-12';
											if ( 'tiled' == $images_layout ) {
												$x = ( $i + 1 ) % 3;

												if ( 1 == $x ) $col_class = 'col-md-12';
												elseif ( 2 == $x && count( $images ) == $i + 1 ) $col_class = 'col-md-12';
												else $col_class = 'col-md-6';
											}
											elseif ( 'slider' == $images_layout ) {
												$col_class = '';
											}
											?>

											<div class="portfolio-image <?php echo $col_class; ?>">
												<?php $image_id = willow_get_attachment_id_by_url( $image['src'] ); ?>
												<img src="<?php echo willow_aq_resize( $image_id, 740, 0, true, true ); ?>" alt="<?php echo esc_attr( get_the_title() ); ?>" />
											</div>
										<?php endforeach; ?>
									</div>
									<?php if ( 'slider' == $images_layout ) : ?>
										<div class="portfolio-images-control caroufredsel-control">
											<a class="prev" href="#"></a>
											<a class="next" href="#"></a>
										</div>
										<div class="portfolio-images-pagination caroufredsel-pagination">
											<?php foreach( $images as $i => $image ) : ?>
												<a href="#"></a>
											<?php endforeach; ?>
										</div>
									<?php endif; ?>
										
								</div>

							<?php endif; ?>

						<?php endif; ?>
						
					</div>

					<div class="portfolio-details-section">

						<div class="js-portfolio-details-floating">
							<h1 class="portfolio-title heading"><?php the_title(); ?></h1>

							<div class="portfolio-content">
								<?php the_content(); ?>
							</div>

							<dl class="portfolio-metadata">
								<?php foreach ( vp_metabox( '_vp_portfolio_info.info' ) as $info ) : ?>
									<dt><?php echo $info['title']; ?></dt>
									<dd><?php echo apply_filters( 'meta_content', $info['content'] ); ?></dd>
								<?php endforeach; ?>
							</dl>
						</div>

					</div>

				</div>

			</div>
		</section>

	<?php endif; ?>

<?php endwhile; endif; ?>

<?php if ( ( defined( 'DOING_AJAX' ) && DOING_AJAX ) || isset( $_GET['iframe'] ) ) {
	get_footer( 'portfolio-ajax' );
}
else {
	get_footer();
} ?>
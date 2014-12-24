			<section id="share-project" class="social-share-project content-section section">
				<div class="container">

					<h3 class="small heading text-center"><?php _e( 'Share This Project', 'willow' ); ?></h3>
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
			</section>

			<footer id="footer" class="made-by-section section footer-group-section" role="contentinfo">
				<div class="container">
					
					<h3 class="small heading text-center"><?php _e( 'Proudly Made by', 'willow' ); ?></h3>
					<div class="text-center">
						<a class="made-by-logo site-logo" href="<?php echo home_url(); ?>">
							<?php $logo = willow_option( 'portfolio_project_logo' ); ?>

							<?php if ( ! empty( $logo ) ) : ?>
								<img src="<?php echo $logo; ?>" alt="<?php bloginfo( 'name' ); ?>" />
							<?php else : ?>
								<span><?php bloginfo( 'name' ); ?></span>
							<?php endif ?>
						</a>
					</div>

				</div>
			</footer>

		</div>

		<script type="text/javascript">
		;(function( $ ) {
			"use strict";

			$( document ).on( 'ready', function() {

				var inIframe = function() {
					try {
						return window.self !== window.top;
					} catch (e) {
						return true;
					}
				};

				if ( inIframe() ) {

					$( '.js-close-magnificpopup' ).on( 'click', function(e) {
						e.preventDefault();
						window.parent.closeMagnificPopup( window.frameElement );
					})

					$( window ).on( 'load', function() {
						window.parent.animateMagnificPopup( window.frameElement );
					});
				};
			});

		})( jQuery );
		</script>

	</body>

	<?php wp_footer(); ?>

</html>
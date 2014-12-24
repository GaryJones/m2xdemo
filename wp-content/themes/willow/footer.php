			
			<?php if ( willow_option( 'enable_footer_widgets' ) ) : ?>
				<footer id="footer" class="footer-section section footer-group-section" role="contentinfo">
					<div class="container">
						<div class="row">
							<?php for ( $i = 1; $i <= willow_option( 'footer_number_of_columns' );  $i++ ) : ?>
								<div class="col-md-<?php echo willow_option( 'footer_grid_column_' . $i ); ?>">
									<?php if ( is_active_sidebar( 'footer-sidebar-' . $i ) ) {
										dynamic_sidebar( 'footer-sidebar-' . $i );
									} ?>
								</div>
							<?php endfor; ?>
						</div>
					</div>
				</footer>
			<?php endif; ?>

			<footer id="bottom-logo" class="bottom-logo-section section footer-group-section">
				<div class="container">
					<div class="text-center">
						<a class="footer-logo site-logo" href="<?php echo home_url(); ?>">
							<?php if ( willow_option( 'footer_logo' ) ) : ?>
								<img src="<?php echo willow_option( 'footer_logo' ); ?>" alt="<?php bloginfo( 'name' ); ?>" />
							<?php else : ?>
								<span><?php bloginfo( 'name' ); ?></span>
							<?php endif ?>
						</a>
					</div>
				</div>
			</footer>

			<footer id="copyright" class="copyright-section section footer-group-section">
				<div class="container">
					<?php $copyright_tagline_text = willow_option( 'copyright_tagline_text' ); if ( ! empty( $copyright_tagline_text ) ) : ?>
						<div class="copyright-tagline">
							<?php echo $copyright_tagline_text; ?>
						</div>
					<?php endif; ?>
					<?php $copyright_legal_text = willow_option( 'copyright_legal_text' ); if ( ! empty( $copyright_legal_text ) ) : ?>
						<div class="copyright-legal">
							<?php echo $copyright_legal_text; ?>
						</div>
					<?php endif; ?>
				</div>
			</footer>

		</div>

		<div id="popup-document" class="popup-document">
			<div class="markup hidden">
				<div class="mfp-iframe-scaler">
					<iframe src="" class="mfp-iframe" frameborder="0" allowfullscreen></iframe>
				</div>
			</div>
		</div>

		<!-- BEGIN CUSTOM FOOTER SCRIPTS -->
		<?php echo willow_kses( willow_option( 'foot_script' ) ); ?>
		<!-- END CUSTOM FOOTER SCRIPTS -->

		<?php wp_footer(); ?>

	</body>

</html>
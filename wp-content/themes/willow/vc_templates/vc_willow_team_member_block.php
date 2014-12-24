<?php

extract( shortcode_atts( array(
	'name'          => '',
	'photo'         => '',
	'position'      => '',
	'socmed'        => '',
	'el_class'      => '',
	'css_animation' => '',
), $atts ) );

$socmed = preg_split( "/\\r\\n|\\r|\\n/", $socmed );

$links = array();
foreach ( $socmed as $sm ) {
	if ( empty( $sm ) ) continue;
	$sm = preg_replace( "/(^)?(<br\s*\/?>\s*)+$/", "", $sm );
	$arr = explode( ':' , $sm, 2 );
	$arr = array_map( 'trim', $arr );
	$links[ $arr[0] ] = $arr[1];
}

$el_class = $this->getExtraClass( $el_class );
$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'wpb_willow_team_member_block wpb_content_element ' . $el_class, $this->settings['base'] );
$css_class .= $this->getCSSAnimation( $css_animation );
?>

<div class="<?php echo $css_class; ?>">
	<div class="wpb_wrapper">

		<?php if ( ! empty( $photo ) ) : ?>
			<div class="team-member-photo">
				<img src="<?php echo willow_aq_resize( $photo, 600, null, true, true ); ?>" alt="<?php echo esc_attr( $name ); ?>" />

				<?php if ( ! empty( $links ) ) : ?>
					<div class="team-member-photo-overlay">
						<div class="team-member-links">
							<label><?php _e( 'Find me on', 'willow' ); ?></label>
							<ul class="social-media-links">
								<?php foreach ( $links as $key => $link ) : ?>
									<?php if ( empty( $key ) || empty( $link ) ) continue; ?>
									<li>
										<a href="<?php echo $link; ?>">
											<i class="fa fa-<?php echo $key; ?>"></i><span class="hidden"><?php echo $key; ?></span>
										</a>
									</li>
								<?php endforeach; ?>
							</ul>
						</div>
					</div>
				<?php endif; ?>

			</div>
		<?php endif; ?>

		<h4 class="team-member-name"><?php echo $name; ?></h4>

		<small class="team-member-position"><?php echo $position; ?></small>

		<div class="team-member-content"><?php echo wpb_js_remove_wpautop( $content ); ?></div>

	</div>
</div>
<?php echo $this->endBlockComment( 'willow_team_member_block' ); ?>
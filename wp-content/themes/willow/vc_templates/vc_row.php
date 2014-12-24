<?php
$output = $el_class = $bg_images = $bg_color = $bg_image_repeat = $font_color = $padding = $margin_bottom = '';

extract( shortcode_atts( array(
	'el_class'            => '',
	'bg_mode'             => 'images',
	'gmap_lat_lng'        => '-7.9812985, 112.6319264',
	'gmap_zoom'           => '2',
	'gmap_marker_lat_lng' => '-7.9812985, 112.6319264',
	'gmap_style_json'     => '',
	'bg_images'           => '',
	'bg_color'            => '',
	'bg_image_repeat'     => '',
	'font_color'          => '',
	'padding'             => '',
	'margin_bottom'       => '',
	'css'                 => '',
	'id'                  => '',
	'separator'           => 'none',
	'parallax'            => 'false',
	'bg_overlay'          => '',
), $atts ) );

wp_enqueue_style( 'js_composer_front' );
wp_enqueue_script( 'wpb_composer_front_js' );
wp_enqueue_style( 'js_composer_custom_css' );

$bg_images = explode( ',', $bg_images );

$el_class = $this->getExtraClass( $el_class );
$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'wpb_row ' . get_row_css_class(), $this->settings['base'] );

$style = $this->buildStyle( '', $bg_color, '', $font_color, $padding, $margin_bottom );

if ( $this->settings['base'] == 'vc_row' ) : ?>

	<?php if ( empty( $id ) ) $id = willow_generate_id( 'section-' ); ?>

	<section id="<?php echo $id; ?>" class="<?php echo $el_class . vc_shortcode_custom_css_class( $css, ' ' ) . ' content-section section vc-section separator-' . $separator; ?>"<?php echo $style; ?>>

		<div class="section-anchor section-top-anchor" data-anchor="top" data-section="#<?php echo $id; ?>"></div>
		
		<?php if ( $parallax == 'true' ) wp_enqueue_script( 'jquery-parallax' ); ?>

		<?php if ( $bg_mode == 'googlemap' ) : ?>

			<?php
			wp_enqueue_script( 'jquery-gmap3' );

			$latlng = explode( ',' , $gmap_lat_lng, 2 );
			$latlng = array_map( 'trim', $latlng );

			$marker_latlng = explode( ',' , $gmap_marker_lat_lng, 2 );
			$marker_latlng = array_map( 'trim', $marker_latlng );
			?>
			<div class="section-background-gmap">
				<div class="js-gmap gmap <?php echo $parallax == 'true' ? 'parallax js-parallax' : ''; ?>" data-parallax="element" data-zoom="<?php echo $gmap_zoom; ?>" data-lat="<?php echo $latlng[0]; ?>" data-lng="<?php echo $latlng[1]; ?>" data-markerlat="<?php echo $marker_latlng[0]; ?>" data-markerlng="<?php echo $marker_latlng[1]; ?>" data-style="<?php echo $gmap_style_json; ?>"></div>
			</div>

		<?php else : ?>

			<?php if ( count( $bg_images ) > 1 ) : ?>

				<?php wp_enqueue_script( 'jquery-caroufredsel' ); ?>
				
				<ul class="section-background-slider caroufredsel js-caroufredsel <?php echo ( ! empty( $bg_overlay ) ) ? $bg_overlay : ''; ?>" data-caroufredsel="section-background-slider">
					<?php foreach ( $bg_images as $i => $image_id ) : $image_src = wp_get_attachment_image_src( $image_id, 'full' ); ?>
						<li class="<?php echo $parallax == 'true' ? 'parallax-background js-parallax' : ''; ?>"<?php echo $this->buildStyle( $image_id, '', $bg_image_repeat, '', '', '' ); ?> data-parallax="background"></li>
					<?php endforeach; ?>
				</ul>

				<div class="section-background-pagination caroufredsel-pagination">
					<?php foreach ( $bg_images as $i => $image_id ) : ?>
						<a href="#"></a>
					<?php endforeach; ?>
				</div>

			<?php elseif ( count( $bg_images ) == 1 ) : ?>

				<?php $image_src = wp_get_attachment_image_src( $bg_images[0], 'full' ); ?>
				<div class="section-background <?php echo $parallax == 'true' ? 'parallax-background js-parallax' : ''; ?> <?php echo ( ! empty( $bg_overlay ) ) ? $bg_overlay : ''; ?>"<?php echo $this->buildStyle( $bg_images[0], '', $bg_image_repeat, '', '', '' ); ?> data-parallax="background"></div>

			<?php endif; ?>

		<?php endif; ?>

		<?php $css_arr = array_values( willow_extract_css( $css ) ); $css_arr = reset( $css_arr ); ?>
		<div class="separator" style="background-color: <?php echo empty( $font_color ) ? '#000000' : $font_color; ?>; color: <?php echo empty( $css_arr['background-color'] ) ? '#ffffff' : $css_arr['background-color']; ?>;"></div>

		<div class="container">
			<div class="<?php echo $css_class; ?>">
				<?php echo wpb_js_remove_wpautop( $content ); ?>
			</div>
		</div>

		<div class="section-anchor section-bottom-anchor" data-anchor="bottom" data-section="#<?php echo $id; ?>"></div>

	</section>
	<?php echo $this->endBlockComment( 'row' ); ?>

<?php else :

	$output = '';
	$output .= '<div class="'.$css_class.vc_shortcode_custom_css_class( $css, ' ' ).' '.$el_class.'"'.$style.'>';
	$output .= wpb_js_remove_wpautop($content);
	$output .= '</div>'.$this->endBlockComment('row');

	echo $output;

endif;
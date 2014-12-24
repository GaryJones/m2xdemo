<?php

extract( shortcode_atts( array(
	'auto_rotate' => 0,
	'align'       => 'center',
	'el_class'    => '',
), $atts ) );

$auto_rotate = absint( $auto_rotate );

wp_enqueue_script( 'jquery-caroufredsel' );

// Get quotes
global $shortcode_tags;
$temp = $shortcode_tags;
$shortcode_tags = array( 'vc_willow_quote' => '' );
$content = preg_replace( '/\[vc_willow_quote/', '[vc_willow_quote active="1"', $content, 1 );
preg_match_all( '/' . get_shortcode_regex() . '/s', $content, $matches );
$quotes = array();
foreach ( $matches[3] as $atts ) {
	$quotes[] = shortcode_parse_atts( $atts );
}
$shortcode_tags = $temp;

$el_class = $this->getExtraClass( $el_class );
$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'wpb_willow_quotes_carousel wpb_content_element ' . $el_class, $this->settings['base'] );
?>

<div class="<?php echo $css_class; ?>">
	<div class="wpb_wrapper">

		<ul class="quotes-carousel caroufredsel js-caroufredsel" data-caroufredsel="quotes-carousel" data-interval="<?php echo $auto_rotate; ?>">
			<?php echo wpb_js_remove_wpautop( $content ); ?>
		</ul>

		<div class="quotes-carousel-pagination caroufredsel-pagination">
			<?php foreach( $quotes as $i => $quote ) : ?>
				<a href="#"></a>
			<?php endforeach; ?>
		</div>

	</div>
</div>
<?php echo $this->endBlockComment( 'willow_quotes_carousel' ); ?>
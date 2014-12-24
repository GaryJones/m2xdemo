<?php

extract( shortcode_atts( array(
	'cite'     => 0,
	'el_class' => '',
	'active'   => 0,
), $atts ) );

$el_class = $this->getExtraClass( $el_class );
$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'wpb_willow_quote quote ' .  ( ( $active ) ? 'active ' : '' ) . $el_class, $this->settings['base'] );
?>

<li class="<?php echo $css_class; ?>">
	<div class="quote-content">
		<?php echo wpb_js_remove_wpautop( $content ); ?>
	</div>
	<div class="quote-cite">
		<?php echo $cite; ?>
	</div>
</li>
<?php echo $this->endBlockComment( 'willow_quote' ); ?>
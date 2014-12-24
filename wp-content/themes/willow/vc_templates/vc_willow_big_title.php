<?php

extract( shortcode_atts( array(
	'title'         => '',
	'el_class'      => '',
), $atts ) );

$el_class = $this->getExtraClass( $el_class );
$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'wpb_willow_big_title wpb_content_element text-center ' . $el_class, $this->settings['base'] );
?>

<div class="<?php echo $css_class; ?>">
	<div class="wpb_wrapper">
		<span><?php echo $title; ?></span>
	</div>
</div><?php echo $this->endBlockComment( 'willow_big_title' ); ?>
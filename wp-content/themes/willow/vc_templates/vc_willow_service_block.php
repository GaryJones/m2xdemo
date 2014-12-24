<?php

extract( shortcode_atts( array(
	'heading'       => '',
	'style'         => 'style-1',
	'icon'          => '',
	'el_class'      => '',
	'css_animation' => '',
), $atts ) );

$el_class = $this->getExtraClass( $el_class );
$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'wpb_willow_service_block wpb_content_element ' . $style . ' ' . $el_class, $this->settings['base'] );
$css_class .= $this->getCSSAnimation( $css_animation );
?>

<div class="<?php echo $css_class; ?>">
	<div class="wpb_wrapper">
		<?php if ( ! empty( $icon ) ) : ?>
			<div class="service-icon"><span class="<?php echo $icon; ?>"></span></div>
		<?php endif; ?>
		<h3 class="small heading service-heading"><?php echo $heading; ?></h3>
		<div class="service-content"><?php echo wpb_js_remove_wpautop( $content ); ?></div>
	</div>
</div>
<?php echo $this->endBlockComment( 'willow_service_block' ); ?>
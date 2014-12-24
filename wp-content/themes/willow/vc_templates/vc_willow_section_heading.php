<?php

extract( shortcode_atts( array(
	'large_heading' => '',
	'small_heading' => '',
	'align'         => 'center',
	'el_class'      => '',
), $atts ) );

$el_class = $this->getExtraClass( $el_class );
$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'wpb_willow_section_heading wpb_content_element text-' . $align . ' ' . $el_class, $this->settings['base'] );
?>

<div class="<?php echo $css_class; ?>">
	<div class="wpb_wrapper">
		<?php if ( ! empty( $small_heading ) ) : ?>
			<h4 class="small section-title"><span><?php echo $small_heading; ?></span></h4>
		<?php endif; ?>

		<?php if ( ! empty( $large_heading ) ) : ?>
			<h2 class="large section-title"><span><?php echo $large_heading; ?></span></h2>
		<?php endif; ?>
	</div>
</div>
<?php echo $this->endBlockComment( 'willow_section_heading' ); ?>
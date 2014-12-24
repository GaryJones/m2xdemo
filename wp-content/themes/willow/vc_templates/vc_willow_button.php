<?php

extract( shortcode_atts( array(
	'text'          => '',
	'link'          => '#',
	'icon'          => '',
	'style'         => '',
	'size'          => '',
	'el_class'      => '',
	'css_animation' => '',
), $atts ) );

$el_class = $this->getExtraClass( $el_class );
$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, "wpb_willow_button wpb_content_element btn $size $style $el_class " . ( ! empty( $icon ) ? 'btn-icon' : '' ) . $this->getCSSAnimation( $css_animation ), $this->settings['base'] );
?>

<a href="<?php echo $link; ?>" class="<?php echo $css_class; ?>">
	<?php if ( ! empty( $icon ) ) : ?>
	<i class="<?php echo $icon; ?>"></i>
	<b></b>
	<?php endif; ?>
	<?php echo $text; ?>
</a>
<?php echo $this->endBlockComment( 'willow_button' ); ?>
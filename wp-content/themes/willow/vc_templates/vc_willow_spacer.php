<?php

extract( shortcode_atts( array(
	'size'     => '',
	'el_class' => '',
), $atts ) );

$el_class = $this->getExtraClass( $el_class );
$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'wpb_willow_spacer wpb_content_element ' . $el_class, $this->settings['base'] );
?>

<div class="<?php echo $css_class; ?>" style="padding-top: <?php echo $size; ?>;"></div>
<?php echo $this->endBlockComment( 'willow_spacer' ); ?>
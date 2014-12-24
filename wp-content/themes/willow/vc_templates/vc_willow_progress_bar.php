<?php

extract( shortcode_atts( array(
	'caption'       => '',
	'value'         => '100',
	'color'         => '',
	'el_class'      => '',
), $atts ) );

$value = min( max( absint( $value ), 0 ), 100 );

$el_class = $this->getExtraClass( $el_class );
$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'wpb_willow_progress_bar wpb_content_element ' . $el_class, $this->settings['base'] );
?>

<div class="<?php echo $css_class; ?> js-progress-bar" data-value="<?php echo $value; ?>">
	<div class="wpb_wrapper">
		<div class="progress-bar-text">
			<span class="progress-bar-caption"><?php echo $caption; ?></span>
			<span class="progress-bar-value"><?php echo $value; ?>%</span>			
		</div>
		<div class="progress-bar-track"></div>
		<div class="progress-bar-thumb" style="width: <?php echo $value; ?>%;<?php echo ! empty( $color ) ? ' border-color: ' . $color . ';' : ''; ?>"></div>
	</div>
</div>
<?php echo $this->endBlockComment( 'willow_progress_bar' ); ?>
<?php

extract( shortcode_atts( array(
	'caption'       => '',
	'start'         => 0,
	'end'           => 100,
	'icon'          => '',
	'prefix'        => '',
	'suffix'        => '',
	'decimals'      => 0,
	'el_class'      => '',
	'css_animation' => '',
), $atts ) );

$start = floatval( $start );
$end = floatval( $end );
$decimals = absint( $decimals );

wp_enqueue_script( 'countup' );

$id = willow_generate_id( 'counter-' );

$el_class = $this->getExtraClass( $el_class );
$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'wpb_willow_counter wpb_content_element text-center ' . $el_class, $this->settings['base'] );
?>

<div class="<?php echo $css_class; ?> js-countup" data-counter="<?php echo $id; ?>" data-start="<?php echo $start; ?>" data-end="<?php echo $end; ?>" data-decimals="<?php echo $decimals; ?>">
	<div class="wpb_wrapper">
		<?php if ( ! empty( $icon ) ) : ?>
			<div class="counter-icon <?php echo $this->getCSSAnimation( $css_animation ); ?>"><span class="<?php echo $icon; ?>"></span></div>
		<?php endif; ?>
		<div class="counter-value">
			<span class="prefix"><?php echo $prefix; ?></span><span id="<?php echo $id; ?>" class="number"><?php echo $end; ?></span><span class="suffix"><?php echo $suffix; ?></span>
		</div>
		<div class="counter-caption"><?php echo $caption; ?></div>
	</div>
</div>
<?php echo $this->endBlockComment( 'willow_counter' ); ?>
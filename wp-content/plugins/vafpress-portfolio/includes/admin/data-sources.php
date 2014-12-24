<?php

// Data Sources
function vp_pf_sc_source_pagination_mode() {
	$source = array(
		array(
			'label' => __('disabled', 'vp_portfolio'),
			'value' => __('disabled', 'vp_portfolio')
		),
		array(
			'label' => __('page', 'vp_portfolio'),
			'value' => __('page', 'vp_portfolio')
		),
	);
	return apply_filters( 'vp_pf_sc_source_pagination_mode', $source );
}

function vp_pf_sc_source_mode() {
	$source = array(
		array(
			'label' => __('default', 'vp_portfolio'),
			'value' => __('default', 'vp_portfolio')
		),
	);
	return apply_filters( 'vp_pf_sc_source_mode', $source );
}

function vp_pf_sc_category() {
	$source = array();
	foreach (get_terms('portfolio_category') as $term) {
		$source[] = array( 'value' => $term->term_id, 'label' => $term->name );
	}
	return apply_filters( 'vp_pf_sc_category', $source );
}

function vp_pf_dep_portfolio_images_mode_image($value) {
	if ($value === 'image') return true;
	return false;
}

function vp_pf_dep_portfolio_images_mode_video($value) {
	if ($value === 'video') return true;
	return false;
}

function vp_pf_dep_portfolio_images_mode_video_external($value) {
	if ($value === 'external') return true;
	return false;
}

function vp_pf_dep_portfolio_images_mode_video_internal($value) {
	if ($value === 'internal') return true;
	return false;
}

/**
 * EOF
 */
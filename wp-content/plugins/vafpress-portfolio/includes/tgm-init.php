<?php

include_once VP_PF_DIR . '/libs/class-tgm-plugin-activation.php';

function vp_pf_tgmpa() {

	$plugins = array(
		array(
			'name'     => 'Vafpress Framework Plugin',
			'slug'     => 'vafpress-framework-plugin',
			'source'   => 'https://github.com/vafour/vafpress-framework-plugin/releases/download/1.0-RC1/vafpress-framework-plugin.zip',
			'required' => true,
		),
	);

	$config = array(
		'domain'		   => 'vp_portfolio',
		'parent_menu_slug' => 'plugins.php',
		'parent_url_slug'  => 'plugins.php',
		'strings'		   => array(
			'menu_title'   => __('Required Plugins', 'vp_sc_td'),
		)
	);

	tgmpa($plugins, $config);
}

add_action('tgmpa_register', 'vp_pf_tgmpa');

/**
 * EOF
 */
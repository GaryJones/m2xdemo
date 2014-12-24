<?php

return array(
	'id'          => '_portfolio_options',
	'types'       => array( 'portfolio' ),
	'title'       => __( 'Portfolio Options', 'willow' ),
	'context'     => 'side',
	'template'    => array(
		array(
			'type'        => 'toggle',
			'name'        => 'enable_custom_layout',
			'label'       => __( 'Enable Custom Layout', 'willow' ),
			'description' => __( 'Using custom layout, you can freely create your own portfolio page with Page Builder. Please make sure you have already checked "Portfolio" post type in Visual Composer Settings page.', 'willow' ),
			'default'     => 0,
		),
		array(
			'type'        => 'radiobutton',
			'name'        => 'images_layout',
			'label'       => __( 'Images Layout', 'willow' ),
			'items'       => array(
				array(
					'label' => __( 'Default', 'willow' ),
					'value' => 'default',
				),
				array(
					'label' => __( 'Tiled Layout', 'willow' ),
					'value' => 'tiled',
				),
				array(
					'label' => __( 'Slider', 'willow' ),
					'value' => 'slider',
				),
			),
			'default'     => array(
				'default',
			),
			'dependency'  => array(
				'field'    => 'enable_custom_layout',
				'function' => 'willow_dependency_portfolio_default_layout',
			),
		),
	),
);
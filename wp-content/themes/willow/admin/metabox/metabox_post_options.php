<?php

return array(
	'id'          => '_post_options',
	'types'       => array_merge( array( 'post' ) ),
	'title'       => __( 'Post Options', 'willow' ),
	'template'    => array(
		array(
			'type'        => 'radiobutton',
			'name'        => 'enable_sidebar',
			'label'       => __( 'Enable Sidebar', 'willow' ),
			'items'       => array(
				array(
					'label' => __( 'Inherit from Theme Options', 'willow' ),
					'value' => -1,
				),
				array(
					'label' => __( 'Disabled', 'willow' ),
					'value' => 0,
				),
				array(
					'label' => __( 'Enabled', 'willow' ),
					'value' => 1,
				),
			),
			'default'     => array(
				-1,
			),
		),
	),
);
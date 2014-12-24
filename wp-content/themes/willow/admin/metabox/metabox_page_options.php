<?php

return array(
	'id'          => '_page_options',
	'types'       => array_merge( array( 'page' ) ),
	'title'       => __( 'Page Options', 'willow' ),
	'template'    => array(
		array(
			'type'        => 'radiobutton',
			'name'        => 'enable_page_title_section',
			'label'       => __( 'Page Title Section', 'willow' ),
			'description' => __( 'If you set this page as "Posts Page" in your Reading Settings, this option will be overrided by Default Settings in Theme Options', 'willow' ),
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
		array(
			'type'    => 'toggle',
			'name'    => 'enable_hero_section',
			'label'   => __( 'Enable Hero Section', 'willow' ),
			'default' => 0,
		),
		array(
			'type'      => 'group',
			'repeating' => false,
			'length'    => 1,
			'name'      => 'hero_section',
			'title'     => __( 'Hero Section', 'willow' ),
			'fields'    => array(
				array(
					'type'        => 'toggle',
					'name'        => 'enable_hero_logo',
					'label'       => __( 'Enable Hero Logo', 'willow' ),
					'default'     => 0,
				),
				array(
					'type'        => 'sorter',
					'name'        => 'slides',
					'label'       => __( 'Pick Slides', 'willow' ),
					'items'       => array(
						'data' => array(
							array(
								'source' => 'function',
								'value'  => 'willow_data_source_hero_slides',
							),
						),
					),
				),
				array(
					'type'        => 'radiobutton',
					'name'        => 'background_overlay',
					'label'       => __( 'Background Overlay', 'willow' ),
					'items'       => array(
						'data' => array(
							array(
								'source' => 'function',
								'value'  => 'willow_data_source_background_overlay',
							),
						),
					),
					'default'     => array(
						'',
					),
				),
				array(
					'type'       => 'textbox',
					'name'       => 'interval',
					'label'      => __( 'Autoslide Interval (ms)', 'willow' ),
					'default'    => 0,
					'validation' => 'numeric'
				),
				array(
					'type'    => 'toggle',
					'name'    => 'enable_parallax',
					'label'   => __( 'Enable Parallax', 'willow' ),
					'default' => 1,
				),
			),
			'dependency' => array(
				'field'    => 'enable_hero_section',
				'function' => 'vp_dep_boolean',
			),
		),
	),
);
<?php

return array(
	array(
		'type'      => 'radiobutton',
		'name'      => 'mode',
		'label'     => __('Mode', 'vp_portfolio'),
		'items'     => array(
			array(
				'label' => __('Image', 'vp_portfolio'),
				'value' => 'image',
			),
			array(
				'label' => __('Video', 'vp_portfolio'),
				'value' => 'video',
			),
		),
		'default' => array(
			'image',
		),
	),
	array(
		'type'      => 'group',
		'repeating' => false,
		'length'    => 1,
		'name'      => 'video',
		'priority'  => 'high',
		'title'     => __('Video', 'vp_portfolio'),
		'fields'    => array(
			array(
				'type' => 'radiobutton',
				'name' => 'mode',
				'label' => __('Embed Mode', 'vp_portfolio'),
				'items' => array(
					array(
						'label' => 'External',
						'value' => 'external',
					),
					array(
						'label' => 'Internal',
						'value' => 'internal',
					),
				),
			),
			array(
				'type' => 'textarea',
				'name' => 'external',
				'label' => __('Video Embed Code', 'vp_portfolio'),
				'dependency' => array(
					'field' => 'mode',
					'function' => 'vp_pf_dep_portfolio_images_mode_video_external',
				),
			),
			array(
				'type' => 'upload',
				'name' => 'internal',
				'label' => __('Video Source (.mp4)', 'vp_portfolio'),
				'dependency' => array(
					'field' => 'mode',
					'function' => 'vp_pf_dep_portfolio_images_mode_video_internal',
				),
			),
			array(
				'type' => 'upload',
				'name' => 'internal_webm',
				'label' => __('Video Source (.webm)', 'vp_portfolio'),
				'dependency' => array(
					'field' => 'mode',
					'function' => 'vp_pf_dep_portfolio_images_mode_video_internal',
				),
			),
			array(
				'type' => 'upload',
				'name' => 'internal_ogg',
				'label' => __('Video Source (.ogg)', 'vp_portfolio'),
				'dependency' => array(
					'field' => 'mode',
					'function' => 'vp_pf_dep_portfolio_images_mode_video_internal',
				),
			),
			array(
				'type' => 'upload',
				'name' => 'internal_poster',
				'label' => __('Poster', 'vp_portfolio'),
				'description' => __('Optional. Define specific poster image to replace the default from the video', 'vp_portfolio'),
				'dependency' => array(
					'field' => 'mode',
					'function' => 'vp_pf_dep_portfolio_images_mode_video_internal',
				),
			),
		),
		'dependency' => array(
			'field'    => 'mode',
			'function' => 'vp_pf_dep_portfolio_images_mode_video',
		),
	),
	array(
		'type'      => 'group',
		'repeating' => true,
		'sortable'  => true,
		'name'      => 'image',
		'priority'  => 'high',
		'title'     => __('Image', 'vp_portfolio'),
		'fields'    => array(
			array(
				'type'  => 'upload',
				'name'  => 'src',
				'label' => __('Image Source', 'vp_portfolio'),
			),
		),
		'dependency' => array(
			'field'    => 'mode',
			'function' => 'vp_pf_dep_portfolio_images_mode_image',
		),
	),
);
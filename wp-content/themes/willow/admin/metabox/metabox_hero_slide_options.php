<?php

return array(
	'id'          => '_hero_slide_options',
	'types'       => array( 'willow-hero-slide' ),
	'title'       => __( 'Hero Slide Options', 'willow' ),
	'template'    => array(
		array(
			'type'        => 'radiobutton',
			'name'        => 'background_media',
			'label'       => __( 'Background Media', 'willow' ),
			'items'       => array(
				array(
					'label' => __( 'image', 'willow' ),
					'value' => 'image',
				),
				array(
					'label' => __( 'video', 'willow' ),
					'value' => 'video',
				),
			),
			'default'     => 'image',
		),
		array(
			'type'        => 'upload',
			'name'        => 'background_image',
			'label'       => __( 'Background Image', 'willow' ),
			'dependency'  => array(
				'field'    => 'background_media',
				'function' => 'willow_dependency_hero_slide_background_image',
			),
		),
		array(
			'type'        => 'radiobutton',
			'name'        => 'background_repeat',
			'label'       => __( 'Background Repeat', 'willow' ),
			'items'       => array(
				'data' => array(
					array(
						'source' => 'function',
						'value'  => 'willow_data_source_background_repeat',
					),
				),
			),
			'default'     => array(
				'',
			),
			'dependency'  => array(
				'field'    => 'background_media',
				'function' => 'willow_dependency_hero_slide_background_image',
			),
		),
		array(
			'type'        => 'upload',
			'name'        => 'video_source',
			'label'       => __( 'Video Source (.mp4)', 'willow' ),
			'dependency'  => array(
				'field'    => 'background_media',
				'function' => 'willow_dependency_hero_slide_background_video',
			),
		),
		array(
			'type'        => 'upload',
			'name'        => 'video_source_webm',
			'label'       => __( 'Video Source (.webm)', 'willow' ),
			'dependency'  => array(
				'field'    => 'background_media',
				'function' => 'willow_dependency_hero_slide_background_video',
			),
		),
		array(
			'type'        => 'upload',
			'name'        => 'video_source_ogg',
			'label'       => __( 'Video Source (.ogg)', 'willow' ),
			'dependency'  => array(
				'field'    => 'background_media',
				'function' => 'willow_dependency_hero_slide_background_video',
			),
		),
		array(
			'type'        => 'upload',
			'name'        => 'video_poster',
			'label'       => __( 'Fallback Image Poster', 'willow' ),
			'dependency'  => array(
				'field'    => 'background_media',
				'function' => 'willow_dependency_hero_slide_background_video',
			),
			'description' => __( 'jpg, png, gif is recommended', 'willow' ),
		),
		array(
			'type'    => 'radiobutton',
			'name'    => 'video_ratio',
			'label'   => __( 'Video Ratio', 'willow' ),
			'items'   => array(
				array(
					'label' => __( '4:3', 'willow' ),
					'value' => '4:3',
				),
				array(
					'label' => __( '16:9', 'willow' ),
					'value' => '16:9',
				),
			),
			'dependency'  => array(
				'field'    => 'background_media',
				'function' => 'willow_dependency_hero_slide_background_video',
			),
			'default' => array(
				'16:9',
			),
		),
		array(
			'type'    => 'toggle',
			'name'    => 'video_mute',
			'label'   => __( 'Video Mute by Default', 'willow' ),
			'dependency'  => array(
				'field'    => 'background_media',
				'function' => 'willow_dependency_hero_slide_background_video',
			),
			'default' => '1',
		),
		array(
			'type'    => 'radiobutton',
			'name'    => 'color_scheme',
			'label'   => __( 'Color Scheme', 'willow' ),
			'items'   => array(
				'data' => array(
					array(
						'source' => 'function',
						'value'  => 'willow_data_source_color_scheme',
					),
				),
			),
			'default' => array(
				'dark',
			),
		),
		array(
			'type'    => 'radiobutton',
			'name'    => 'text_style',
			'label'   => __( 'Slide Text Style', 'willow' ),
			'items'   => array(
				array(
					'value' => 'style-0',
					'label' => __( 'No Text', 'willow' ),
				),
				array(
					'value' => 'style-1',
					'label' => __( 'Style 1', 'willow' ),
				),
				array(
					'value' => 'style-2',
					'label' => __( 'Style 2', 'willow' ),
				),
				array(
					'value' => 'style-3',
					'label' => __( 'Style 3', 'willow' ),
				),
			),
			'default' => array(
				'style-1',
			),
		),
		array(
			'type'        => 'textbox',
			'name'        => 'top_text',
			'label'       => __( 'Top Text', 'willow' ),
			'dependency'  => array(
				'field'    => 'text_style',
				'function' => 'willow_dependency_hero_slide_top_text',
			),
		),
		array(
			'type'        => 'textarea',
			'name'        => 'middle_text',
			'label'       => __( 'Middle Text', 'willow' ),
			'dependency'  => array(
				'field'    => 'text_style',
				'function' => 'willow_dependency_hero_slide_middle_text',
			),
			'description' => __( 'To enable text rotator, please input some lines separated with line break', 'willow' ),
		),
		array(
			'type'       => 'textbox',
			'name'       => 'mt_interval',
			'label'      => __( 'Middle Text Rotation Interval (ms)', 'willow' ),
			'default'    => 5000,
			'validation' => 'numeric'
		),
		array(
			'type'        => 'textbox',
			'name'        => 'bottom_text',
			'label'       => __( 'Bottom Text', 'willow' ),
			'dependency'  => array(
				'field'    => 'text_style',
				'function' => 'willow_dependency_hero_slide_bottom_text',
			),
		),
		array(
			'type'        => 'textbox',
			'name'        => 'button_text',
			'label'       => __( 'Button Text', 'willow' ),
			'dependency'  => array(
				'field'    => 'text_style',
				'function' => 'willow_dependency_hero_slide_button',
			),
		),
		array(
			'type'        => 'textbox',
			'name'        => 'button_link',
			'label'       => __( 'Button Link', 'willow' ),
			'dependency'  => array(
				'field'    => 'text_style',
				'function' => 'willow_dependency_hero_slide_button',
			),
		),
		array(
			'type'        => 'textbox',
			'name'        => 'button_2_text',
			'label'       => __( 'Button Text', 'willow' ),
			'dependency'  => array(
				'field'    => 'text_style',
				'function' => 'willow_dependency_hero_slide_button_2',
			),
		),
		array(
			'type'        => 'textbox',
			'name'        => 'button_2_link',
			'label'       => __( 'Button Link', 'willow' ),
			'dependency'  => array(
				'field'    => 'text_style',
				'function' => 'willow_dependency_hero_slide_button_2',
			),
		),
		array(
			'type'        => 'select',
			'name'        => 'css_animation',
			'label'       => __( 'Enter Animation', 'willow' ),
			'items'       => array(
				'data' => array(
					array(
						'source' => 'function',
						'value'  => 'willow_data_source_animate_css',
					),
				),
			),
			'dependency'  => array(
				'field'    => 'text_style',
				'function' => 'willow_dependency_hero_slide_css_animation',
			),
		),
	),
);
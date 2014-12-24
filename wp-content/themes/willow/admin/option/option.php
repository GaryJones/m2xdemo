<?php

/**
 * ======================================================================================
 * Functions
 * ======================================================================================
 */

global $willow_data;

function willow_theme_options_scheme_all_typography() {
	$return = array();

	global $willow_data;
	$fields = array();
	foreach ( $willow_data['typography_types'] as $type => $label ) {
		$fields[] = array(
			'type'       => 'select',
			'name'       => $type . '_font_face',
			'label'      => $label,
			'items'      => array(
				'data' => array(
					array(
						'source' => 'function',
						'value'  => 'willow_data_source_regular_font_faces',
					),
					array(
						'source' => 'function',
						'value'  => 'vp_get_gwf_family',
					),
				),
			),
			'default'    => array(
				$willow_data['default_value'][ $type . '_font_face'],
			),
			'validation' => 'required',
		);
	}

	$return[] = array(
		'type'   => 'section',
		'title'  =>	__( 'Typography', 'willow' ),
		'fields' => $fields,
	);

	return $return;
}

function willow_theme_options_scheme_footer_column( $key ) {
	return array(
		'type' => 'section',
		'title' => sprintf( __( 'Column %s', 'willow' ), $key ),
		'fields' => array(
			array(
				'type' => 'slider',
				'name' => 'footer_grid_column_' . $key,
				'label' => sprintf( __( 'Grid of Column %s', 'willow' ), $key ),
				'min' => '1',
				'max' => '12',
				'default' => '3',
			),
			array(
				'type' => 'slider',
				'name' => 'footer_offset_column_' . $key,
				'label' => sprintf( __( 'Offset of Column %s', 'willow' ), $key ),
				'min' => '0',
				'max' => '11',
				'default' => '0',
			),
		),
	);
}

function willow_theme_options_scheme_social_media_links() {
	$return = array();

	foreach ( willow_data_source_social_media_links() as $link ) {
		$return[] = array(
			'type'       => 'textbox',
			'name'       => 'social_media_' . $link['value'],
			'label'      => $link['label'],
		);
	}

	return $return;
}

/**
 * ======================================================================================
 * Scheme
 * ======================================================================================
 */

return array(
	'title' => __( 'Willow Theme Options', 'willow' ),
	'logo'  => ( willow_option( 'header_logo' ) ) ? willow_option( 'header_logo' ) : WILLOW_IMAGES . 'willow-default-logo.png',
	'menus' => array(
		array(
			'title'    => __( 'General', 'willow' ),
			'icon'     => 'font-awesome:fa-globe',
			'controls' => array(
				array(
					'type'   => 'section',
					'title'  => __( 'Logo', 'willow' ),
					'fields' => array(
						array(
							'type'        => 'upload',
							'name'        => 'header_logo',
							'label'       => __( 'Header Logo', 'willow' ),
						),
						array(
							'type'        => 'upload',
							'name'        => 'header_logo_retina',
							'label'       => __( 'Header Logo (Retina Version)', 'willow' ),
							'description' => __( 'Please name your file following the normal version (e.g. logo.png) with a suffix @2x (e.g. logo@2x.png)', 'willow' ),
						),
						array(
							'type'        => 'upload',
							'name'        => 'footer_logo',
							'label'       => __( 'Footer Logo', 'willow' ),
						),
						array(
							'type'        => 'upload',
							'name'        => 'footer_logo_retina',
							'label'       => __( 'Footer Logo (Retina Version)', 'willow' ),
							'description' => __( 'Please name your file following the normal version (e.g. logo.png) with a suffix @2x (e.g. logo@2x.png)', 'willow' ),
						),
						array(
							'type'        => 'upload',
							'name'        => 'portfolio_project_logo',
							'label'       => __( 'Portfolio Project Footer Logo', 'willow' ),
						),
						array(
							'type'        => 'upload',
							'name'        => 'portfolio_project_logo_retina',
							'label'       => __( 'Portfolio Project Footer Logo (Retina Version)', 'willow' ),
							'description' => __( 'Please name your file following the normal version (e.g. logo.png) with a suffix @2x (e.g. logo@2x.png)', 'willow' ),
						),
						array(
							'type'        => 'upload',
							'name'        => 'hero_logo',
							'label'       => __( 'Hero Logo', 'willow' ),
						),
						array(
							'type'        => 'upload',
							'name'        => 'hero_logo_retina',
							'label'       => __( 'Hero Logo (Retina Version)', 'willow' ),
							'description' => __( 'Please name your file following the normal version (e.g. logo.png) with a suffix @2x (e.g. logo@2x.png)', 'willow' ),
						),
						array(
							'type'        => 'upload',
							'name'        => 'preloader_logo',
							'label'       => __( 'Preloader Logo', 'willow' ),
						),
						array(
							'type'        => 'upload',
							'name'        => 'preloader_logo_retina',
							'label'       => __( 'Preloader Logo (Retina Version)', 'willow' ),
							'description' => __( 'Please name your file following the normal version (e.g. logo.png) with a suffix @2x (e.g. logo@2x.png)', 'willow' ),
						),
					),
				),
				array(
					'type'   => 'section',
					'title'  => __( 'Favicon', 'willow' ),
					'fields' => array(
						array(
							'type'        => 'upload',
							'name'        => 'favicon',
							'description' => __( 'Recommended: .ICO 64x64px size', 'willow' ),
							'label'       => __( 'General Site Icon', 'willow' ),
						),
						array(
							'type'        => 'upload',
							'name'        => 'favicon_iphone',
							'description' => __( 'Recommended: .PNG 60x60px size', 'willow' ),
							'label'       => __( 'Icon for iPhone', 'willow' ),
						),
						array(
							'type'        => 'upload',
							'name'        => 'favicon_iphone_retina',
							'description' => __( 'Recommended: .PNG 120x120px size', 'willow' ),
							'label'       => __( 'Icon for iPhone Retina', 'willow' ),
						),
						array(
							'type'        => 'upload',
							'name'        => 'favicon_ipad',
							'description' => __( 'Recommended: .PNG 76x76px size', 'willow' ),
							'label'       => __( 'Icon for iPad', 'willow' ),
						),
						array(
							'type'        => 'upload',
							'name'        => 'favicon_ipad_retina',
							'description' => __( 'Recommended: .PNG 152x152px size', 'willow' ),
							'label'       => __( 'Icon for iPad Retina', 'willow' ),
						),
					),
				),
			),
		),
		array(
			'title'    => __( 'Styles', 'willow' ),
			'icon'     => 'font-awesome:fa-adjust',
			'controls' => array_merge(
				willow_theme_options_scheme_all_typography(),
				array(
					array(
						'type'    => 'color',
						'name'    => 'accent_color',
						'label'   => __( 'Accent Color', 'willow' ),
						'format'  => 'hex',
						'default' => $willow_data['default_value']['accent_color'],
					),
					array(
						'type'    => 'toggle',
						'name'    => 'enable_preloader',
						'label'   => __( 'Page Preloader', 'willow' ),
						'default' => 1,
					),
					array(
						'type'        => 'toggle',
						'name'        => 'enable_wpml_language_switcher',
						'label'       => __( 'WPML Language Switcher', 'willow' ),
						'description' => __( 'Only works if you have WPML installed', 'willow' ),
						'default'     => 1,
					),
					array(
						'type'        => 'textarea',
						'name'        => 'gmap_style_json',
						'label'       => __( 'Global Google Map Color Scheme (JSON)', 'willow' ),
						'description' => __( 'You can use any Google Map style JSON online generator out there, like [this](http://gmaps-samples-v3.googlecode.com/svn/trunk/styledmaps/wizard/index.html)', 'willow' ),
					),
				)
			),
		),
		array(
			'title'    => __( 'Page Title', 'willow' ),
			'icon'     => 'font-awesome:fa-align-center',
			'controls' => array(
				array(
					'type'    => 'checkbox',
					'name'    => 'pages_with_title_section',
					'label'   => __( 'Enable Page Title Section in', 'willow' ),
					'items'   => array_merge(
						array(
							array(
								'label' => __( 'Blog Index (default Posts page)', 'willow' ),
								'value' => 'blog_index',
							),
							array(
								'label' => __( 'Blog Archive (category, tag, author, date archive)', 'willow' ),
								'value' => 'blog_archive',
							),
							array(
								'label' => __( 'Blog Single', 'willow' ),
								'value' => 'blog_single',
							),
							array(
								'label' => __( 'Single Page (can be overrided via single page editor\'s metabox)', 'willow' ),
								'value' => 'page_single',
							),
							array(
								'label' => __( 'Search Result', 'willow' ),
								'value' => 'search',
							),
						),
						class_exists( 'VP_Portfolio' ) ? array(
							array(
								'label' => __( 'Portfolio Single', 'willow' ),
								'value' => 'portfolio_single',
							),
							array(
								'label' => __( 'Portfolio Archive', 'willow' ),
								'value' => 'portfolio_index',
							),
						) : array()
					),
					'default' => array(
						'{{all}}',
					),
				),
				array(
					'type'   => 'section',
					'title'  => __( 'Default Style', 'willow' ),
					'fields' => array(
						array(
							'type'    => 'toggle',
							'name'    => 'title_section_enable_parallax',
							'label'   => __( 'Enable Parallax', 'willow' ),
							'default' => 0,
						),
						array(
							'type'    => 'radiobutton',
							'name'    => 'title_section_color_scheme',
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
							'type'    => 'upload',
							'name'    => 'title_section_background_image',
							'label'   => __( 'Background Image', 'willow' ),
						),
						array(
							'type'    => 'radiobutton',
							'name'    => 'title_section_background_overlay',
							'label'   => __( 'Background Overlay', 'willow' ),
							'items'   => array(
								'data' => array(
									array(
										'source' => 'function',
										'value'  => 'willow_data_source_background_overlay',
									),
								),
							),
							'default' => array(
								'',
							),
						),
						array(
							'type'    => 'radiobutton',
							'name'    => 'title_section_background_repeat',
							'label'   => __( 'Background Repeat', 'willow' ),
							'items'   => array(
								'data' => array(
									array(
										'source' => 'function',
										'value'  => 'willow_data_source_background_repeat',
									),
								),
							),
							'default' => array(
								'',
							),
						),
					),
				),
			),
		),
		array(
			'title'    => __( 'Sidebar', 'willow' ),
			'icon'     => 'font-awesome:fa-columns',
			'controls' => array(
				array(
					'type'    => 'checkbox',
					'name'    => 'pages_with_sidebar',
					'label'   => __( 'Enable Sidebar in', 'willow' ),
					'items'   => array(
						array(
							'label' => __( 'Blog Index (default Posts page)', 'willow' ),
							'value' => 'blog_index',
						),
						array(
							'label' => __( 'Blog Archive (category, tag, author, date archive)', 'willow' ),
							'value' => 'blog_archive',
						),
						array(
							'label' => __( 'Blog Single (can be overrided via single post editor\'s metabox)', 'willow' ),
							'value' => 'blog_single',
						),
						array(
							'label' => __( 'Search Result', 'willow' ),
							'value' => 'search',
						),
					),
					'default' => array(
						'{{all}}',
					),
				),
				array(
					'type'        => 'notebox',
					'name'        => 'note_sidebar_for_page',
					'label'       => __( 'Enable / Disable sidebar on Pages', 'willow' ),
					'description' => __( 'On your Page Editor page, you can select the corresponding Page Template to enable / disable Sidebar. The Default Page Template means you will have sidebar (and if your page builder is turned off).', 'willow' ),
					'status'      => 'info',
				),
			),
		),
		array(
			'title'    => __( 'Footer', 'willow' ),
			'icon'     => 'font-awesome:fa-arrow-circle-down',
			'controls' => array(
				array(
					'type'    => 'toggle',
					'name'    => 'enable_footer_widgets',
					'label'   => __( 'Enable Footer Widgets', 'willow' ),
					'default' => 1,
				),
				array(
					'type'    => 'slider',
					'name'    => 'footer_number_of_columns',
					'label'   => __( 'Number of Columns', 'willow' ),
					'min'     => 1,
					'max'     => 6,
					'default' => 4,
				),
				willow_theme_options_scheme_footer_column( 1 ),
				willow_theme_options_scheme_footer_column( 2 ),
				willow_theme_options_scheme_footer_column( 3 ),
				willow_theme_options_scheme_footer_column( 4 ),
				willow_theme_options_scheme_footer_column( 5 ),
				willow_theme_options_scheme_footer_column( 6 ),
			),
		),
		array(
			'title'    => __( 'Copyright', 'willow' ),
			'icon'     => 'font-awesome:fa-bookmark',
			'controls' => array(
				array(
					'type'    => 'textarea',
					'name'    => 'copyright_tagline_text',
					'label'   => __( 'Bottom Tagline Text', 'willow' ),
					'default' => 'Made with <span class="fa fa-heart color-accent"></span> in Seattle',
				),
				array(
					'type'    => 'textarea',
					'name'    => 'copyright_legal_text',
					'label'   => __( 'Legal Text', 'willow' ),
					'default' => '&copy; 2014 Solo Pine Designs - All Rights Reserved',
				),
			),
		),
		array(
			'title'    => __( 'Blog Settings', 'willow' ),
			'icon'     => 'font-awesome:fa-cogs',
			'controls' => array(
				array(
					'type'    => 'toggle',
					'name'    => 'enable_social_share',
					'label'   => __( 'Enable Social Share', 'willow' ),
					'default' => 1,
				),
				array(
					'type'    => 'toggle',
					'name'    => 'enable_related_posts',
					'label'   => __( 'Enable Related Posts', 'willow' ),
					'default' => 1,
				),
			),
		),
		array(
			'title'    => __( 'Social Media', 'willow' ),
			'icon'     => 'font-awesome:fa-twitter',
			'controls' => array(
				array(
					'type'    => 'sorter',
					'name'    => 'social_media_links',
					'label'   => __( 'Active Links', 'willow' ),
					'items'   => array(
						'data' => array(
							array(
								'source' => 'function',
								'value'  => 'willow_data_source_social_media_links',
							),
						),
					),
				),
				array(
					'type'   => 'section',
					'title'  => __( 'Social Media Links', 'willow' ),
					'fields' => willow_theme_options_scheme_social_media_links(),
				),
			),
		),
		array(
			'title'    => __( 'Social Share', 'willow' ),
			'icon'     => 'font-awesome:fa-share-square',
			'controls' => array(
				array(
					'type'    => 'sorter',
					'name'    => 'social_share_links',
					'label'   => __( 'Active Links', 'willow' ),
					'items'   => array(
						'data' => array(
							array(
								'source' => 'function',
								'value'  => 'willow_data_source_social_share_links',
							),
						),
					),
				),
				array(
					'type'        => 'notebox',
					'name'        => 'note_social_share',
					'label'       => __( 'What is Social Share', 'willow' ),
					'description' => __( 'Social Share Links will appear below your single post content. It lets users to share your blog post into some social media sites.', 'willow' ),
					'status'      => 'info',
				),
			),
		),
		array(
			'title' => __( 'Custom Scripts', 'willow' ),
			'name' => 'menu_scripts',
			'icon' => 'font-awesome:fa-code',
			'controls' => array(
				array(
					'type' => 'section',
					'title' => __( 'Document Scripts', 'willow' ),
					'fields' => array(
						array(
							'type' => 'textarea',
							'name' => 'head_script',
							'label' => __( 'Head Script', 'willow' ),
						),
						array(
							'type' => 'textarea',
							'name' => 'foot_script',
							'label' => __( 'Foot Script', 'willow' ),
						),
					),
				),
				array(
					'type' => 'section',
					'title' => __( 'Custom CSS', 'willow' ),
					'fields' => array(
						array(
							'type' => 'textarea',
							'name' => 'custom_css',
							'label' => __( 'Custom CSS', 'willow' ),
						),
					),
				),
			),
		),
	),
);
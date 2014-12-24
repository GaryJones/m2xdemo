<?php

function willow_custom_visual_composer() {

	$add_css_animation = array(
		'type' => 'dropdown',
		'heading' => __( 'CSS Animation', 'js_composer' ),
		'param_name' => 'css_animation',
		'admin_label' => true,
		'value' => array_merge( array(
			__( 'No', 'js_composer' ) => '',
			__( 'Top to bottom', 'js_composer' ) => 'top-to-bottom',
			__( 'Bottom to top', 'js_composer' ) => 'bottom-to-top',
			__( 'Left to right', 'js_composer' ) => 'left-to-right',
			__( 'Right to left', 'js_composer' ) => 'right-to-left',
			__( 'Appear from center', 'js_composer' ) => 'appear',
		), willow_get_animate_css() ),
		'description' => __( 'Select type of animation if you want this element to be animated when it enters into the browsers viewport. Note: Works only in modern browsers.', 'js_composer' ),
	);

	$add_icon = array(
		'type' => 'dropdown',
		'holder' => 'div',
		'heading' => __( 'Icon', 'willow' ),
		'param_name' => 'icon',
		'value' => array_merge( array(
			__( 'No Icon', 'willow' ) => '',
		), willow_get_icons() ),
	);

	/**
	 * Edit Content Element: Row
	 */
	vc_add_param( 'vc_row', array(
		'type' => 'textfield',
		'heading' => __( 'Section ID', 'willow' ),
		'description' => __( 'Used in One Page Scrolling Navigation. Please fill without "#".', 'willow' ),
		'param_name' => 'id',
	) );
	vc_add_param( 'vc_row', array(
		'type' => 'dropdown',
		'heading' => __( 'Background Mode', 'willow' ),
		'param_name' => 'bg_mode',
		'value' => array(
			__( 'Image', 'willow' ) => 'images',
			__( 'Google Map', 'willow' ) => 'googlemap',
		),
	) );
	vc_add_param( 'vc_row', array(
		'type' => 'textfield',
		'heading' => __( 'Google Map Latitude / Longitude', 'willow' ),
		'description' => __( 'Comma separated, e.g. "-7.9812985, 112.6319264"', 'willow' ),
		'param_name' => 'gmap_lat_lng',
		'value' => '-7.9812985, 112.6319264',
		'dependency' => array( 'element' => 'bg_mode', 'value' => array( 'googlemap' ) ),
	) );
	vc_add_param( 'vc_row', array(
		'type' => 'dropdown',
		'heading' => __( 'Google Map Zoom', 'willow' ),
		'param_name' => 'gmap_zoom',
		'value' => array(
			'2' => '2',
			'3' => '3',
			'4' => '4',
			'5' => '5',
			'6' => '6',
			'7' => '7',
			'8' => '8',
			'9' => '9',
			'10' => '10',
			'11' => '11',
			'12' => '12',
			'13' => '13',
			'14' => '14',
			'15' => '15',
			'16' => '16',
			'17' => '17',
			'18' => '18',
			'19' => '19',
			'20' => '20',
			'21' => '21',
		),
		'dependency' => array( 'element' => 'bg_mode', 'value' => array( 'googlemap' ) ),
	) );
	vc_add_param( 'vc_row', array(
		'type' => 'textfield',
		'heading' => __( 'Google Map Marker Latitude / Longitude', 'willow' ),
		'description' => __( 'Comma separated, e.g. "-7.9812985, 112.6319264". Leave if blank to disable marker', 'willow' ),
		'param_name' => 'gmap_marker_lat_lng',
		'value' => '-7.9812985, 112.6319264',
		'dependency' => array( 'element' => 'bg_mode', 'value' => array( 'googlemap' ) ),
	) );
	vc_add_param( 'vc_row', array(
		'type' => 'attach_image',
		'heading' => __( 'Background Images', 'willow' ),
		'param_name' => 'bg_images',
		'description' => __( 'It is recommended not to configure the Background Image on the Design Options Tab, please configure your background image here instead.', 'willow' ),
		'dependency' => array( 'element' => 'bg_mode', 'value' => array( 'images' ) ),
	) );
	vc_add_param( 'vc_row', array(
		'type' => 'dropdown',
		'heading' => __( 'Background Repeat', 'willow' ),
		'param_name' => 'bg_image_repeat',
		'value' => array(
			__( 'Default', 'willow' ) => '',
			__( 'Cover', 'willow' ) => 'cover',
			__( 'Contain', 'willow' ) => 'contain',
			__( 'No Repeat', 'willow' ) => 'no-repeat',
		),
		'description' => __( 'It is recommended not to configure the Background Repeat on the Design Options Tab, please configure your background repeat here instead.', 'willow' ),
		'dependency' => array( 'element' => 'bg_mode', 'value' => array( 'images' ) ),
	) );
	vc_add_param( 'vc_row', array(
		'type' => 'dropdown',
		'heading' => __( 'Background Overlay', 'willow' ),
		'param_name' => 'bg_overlay',
		'value' => array(
			__( 'none', 'willow' ) => '',
			__( 'black overlay', 'willow' ) => 'black-overlay',
			__( 'dotted overlay', 'willow' ) => 'dotted-overlay',
		),
		'dependency' => array( 'element' => 'bg_mode', 'value' => array( 'images' ) ),
	) );
	vc_add_param( 'vc_row', array(
		'type' => 'dropdown',
		'heading' => __( 'Enable Parallax Background', 'willow' ),
		'param_name' => 'parallax',
		'value' => array(
			__( 'false', 'willow' ) => 'false',
			__( 'true', 'willow' ) => 'true',
		),
	) );
	vc_add_param( 'vc_row', array(
		'type' => 'dropdown',
		'heading' => __( 'Separator', 'willow' ),
		'param_name' => 'separator',
		'value' => array(
			__( 'none', 'willow' ) => 'none',
			__( 'single-line', 'willow' ) => 'single-line',
			__( 'triangle-in', 'willow' ) => 'triangle-in',
			__( 'triangle-out', 'willow' ) => 'triangle-out',
		),
	) );
	// vc_map_update( 'vc_row', array(
	// 	'admin_enqueue_js' => array( get_template_directory_uri() . '/vc_extends/assets/js/vc-willow-row.js' ),
	// 	'js_view'          => 'VcWillowRowView'
	// ) );

	$vc_column_text_css_animation = WPBMap::getParam( 'vc_column_text', 'css_animation' );
	$vc_column_text_css_animation = $add_css_animation;
	WPBMap::mutateParam( 'vc_column_text', $vc_column_text_css_animation );

	$vc_message_css_animation = WPBMap::getParam( 'vc_message', 'css_animation' );
	$vc_message_css_animation = $add_css_animation;
	WPBMap::mutateParam( 'vc_message', $vc_message_css_animation );

	$vc_toggle_css_animation = WPBMap::getParam( 'vc_toggle', 'css_animation' );
	$vc_toggle_css_animation = $add_css_animation;
	WPBMap::mutateParam( 'vc_toggle', $vc_toggle_css_animation );

	$vc_single_image_css_animation = WPBMap::getParam( 'vc_single_image', 'css_animation' );
	$vc_single_image_css_animation = $add_css_animation;
	WPBMap::mutateParam( 'vc_single_image', $vc_single_image_css_animation );

	$vc_cta_button_css_animation = WPBMap::getParam( 'vc_cta_button', 'css_animation' );
	$vc_cta_button_css_animation = $add_css_animation;
	WPBMap::mutateParam( 'vc_cta_button', $vc_cta_button_css_animation );

	$vc_cta_button2_css_animation = WPBMap::getParam( 'vc_cta_button2', 'css_animation' );
	$vc_cta_button2_css_animation = $add_css_animation;
	WPBMap::mutateParam( 'vc_cta_button2', $vc_cta_button2_css_animation );
	
	/**
	 * Add Content Element: Big Title
	 */
	require_once( get_template_directory() . '/vc_extends/willow_big_title.php' );
	vc_map( array(
		'name' => __( 'Big Title', 'willow' ),
		'base' => 'vc_willow_big_title',
		'category' => __( 'Content', 'js_composer' ),
		'params' => array(
			array(
				'type' => 'textfield',
				'holder' => 'div',
				'heading' => __( 'Title', 'willow' ),
				'param_name' => 'title',
			),
			array(
				'type' => 'textfield',
				'heading' => __( 'Extra class name', 'js_composer' ),
				'param_name' => 'el_class',
				'description' => __( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'js_composer' ),
			),
		),
	) );

	/**
	 * Add Content Element: Blog Grid
	 */
	require_once( get_template_directory() . '/vc_extends/willow_blog_grid.php' );
	vc_map( array(
		'name' => __( 'Blog Grid', 'willow' ),
		'base' => 'vc_willow_blog_grid',
		'category' => __( 'Content', 'js_composer' ),
		'params' => array(
			array(
				'type' => 'textfield',
				'holder' => 'div',
				'heading' => __( 'Number of items', 'willow' ),
				'param_name' => 'count',
				'value' => 8,
				'description' => __( '-1 to show all', 'willow' ),
			),
			array(
				'type' => 'textarea',
				'holder' => 'div',
				'heading' => __( 'Only shows specified categori(es)', 'willow' ),
				'param_name' => 'category',
				'description' => __( 'Comma separated SLUG of the categori(es).', 'js_composer' ),
			),
			array(
				'type' => 'dropdown',
				'holder' => 'div',
				'heading' => __( 'Number of columns', 'willow' ),
				'param_name' => 'columns',
				'value' => array(
					'2' => 2,
					'3' => 3,
					'4' => 4,
				),
			),
			$add_css_animation,
			array(
				'type' => 'textfield',
				'heading' => __( 'Extra class name', 'js_composer' ),
				'param_name' => 'el_class',
				'description' => __( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'js_composer' ),
			),
		),
	) );

	/**
	 * Add Content Element: Button
	 */
	require_once( get_template_directory() . '/vc_extends/willow_button.php' );
	vc_map( array(
		'name' => __( 'Button (Willow Style)', 'willow' ),
		'base' => 'vc_willow_button',
		'category' => __( 'Content', 'js_composer' ),
		'params' => array(
			array(
				'type' => 'textfield',
				'holder' => 'div',
				'heading' => __( 'Text', 'willow' ),
				'param_name' => 'text',
				'value' => __( 'Anchor Text', 'willow' ),
			),
			array(
				'type' => 'textfield',
				'holder' => 'div',
				'heading' => __( 'Link URL', 'willow' ),
				'param_name' => 'link',
				'value' => '#',
			),
			$add_icon,
			array(
				'type' => 'dropdown',
				'holder' => 'div',
				'heading' => __( 'Style', 'willow' ),
				'param_name' => 'style',
				'value' => array(
					__( 'default', 'willow' ) => 'btn-default',
					__( 'black', 'willow' ) => 'btn-black',
					__( 'white', 'willow' ) => 'btn-white',
					__( 'primary', 'willow' ) => 'btn-primary',
					__( 'success', 'willow' ) => 'btn-success',
					__( 'info', 'willow' ) => 'btn-info',
					__( 'warning', 'willow' ) => 'btn-warning',
					__( 'danger', 'willow' ) => 'btn-danger',
					__( 'link', 'willow' ) => 'btn-link',
				),
			),
			array(
				'type' => 'dropdown',
				'holder' => 'div',
				'heading' => __( 'Size', 'willow' ),
				'param_name' => 'size',
				'value' => array(
					__( 'normal', 'willow' ) => '',
					__( 'large', 'willow' ) => 'btn-lg',
					__( 'small', 'willow' ) => 'btn-sm',
					__( 'xs', 'willow' ) => 'btn-xs',
				),
			),
			$add_css_animation,
			array(
				'type' => 'textfield',
				'heading' => __( 'Extra class name', 'js_composer' ),
				'param_name' => 'el_class',
				'description' => __( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'js_composer' ),
			),
		),
	) );

	/**
	 * Add Content Element: Counter
	 */
	require_once( get_template_directory() . '/vc_extends/willow_counter.php' );
	vc_map( array(
		'name' => __( 'Counter', 'willow' ),
		'base' => 'vc_willow_counter',
		'category' => __( 'Content', 'js_composer' ),
		'params' => array(
			array(
				'type' => 'textfield',
				'holder' => 'div',
				'heading' => __( 'Caption', 'willow' ),
				'param_name' => 'caption',
			),
			array(
				'type' => 'textfield',
				'holder' => 'div',
				'heading' => __( 'Start', 'willow' ),
				'param_name' => 'start',
				'value' => 0,
			),
			array(
				'type' => 'textfield',
				'holder' => 'div',
				'heading' => __( 'End (Value)', 'willow' ),
				'param_name' => 'end',
				'value' => 100,
			),
			array(
				'type' => 'textfield',
				'holder' => 'div',
				'heading' => __( 'Prefix', 'willow' ),
				'param_name' => 'prefix',
				'description' => __( 'String before number', 'willow' ),
			),
			array(
				'type' => 'textfield',
				'holder' => 'div',
				'heading' => __( 'Suffix', 'willow' ),
				'param_name' => 'suffix',
				'description' => __( 'String after number', 'willow' ),
			),
			array(
				'type' => 'textfield',
				'holder' => 'div',
				'heading' => __( 'Decimals', 'willow' ),
				'param_name' => 'decimals',
				'value' => 0,
				'description' => __( 'Number of decimals. Positive integer only', 'willow' ),
			),
			$add_icon,
			$add_css_animation,
			array(
				'type' => 'textfield',
				'heading' => __( 'Extra class name', 'js_composer' ),
				'param_name' => 'el_class',
				'description' => __( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'js_composer' ),
			),
		),
	) );

	/**
	 * Add Content Element: Portfolio Grid
	 */
	if ( class_exists( 'VP_Portfolio' ) ) {

		require_once( get_template_directory() . '/vc_extends/willow_portfolio_grid.php' );
		vc_map( array(
			'name' => __( 'Portfolio Grid', 'willow' ),
			'base' => 'vc_willow_portfolio_grid',
			'category' => __( 'Content', 'js_composer' ),
			'params' => array(
				array(
					'type' => 'textfield',
					'holder' => 'div',
					'heading' => __( 'Number of items', 'willow' ),
					'param_name' => 'count',
					'value' => 9,
					'description' => __( '-1 to show all', 'willow' ),
				),
				array(
					'type' => 'dropdown',
					'holder' => 'div',
					'heading' => __( 'Number of columns', 'willow' ),
					'param_name' => 'columns',
					'value' => array(
						'2' => 2,
						'3' => 3,
						'4' => 4,
					),
				),
				array(
					'type' => 'dropdown',
					'holder' => 'div',
					'heading' => __( 'Enable Category Filter', 'willow' ),
					'param_name' => 'filter',
					'value' => array(
						__( 'true', 'willow' ) => 'true',
						__( 'false', 'willow' ) => 'false',
					),
				),
				array(
					'type' => 'textarea',
					'holder' => 'div',
					'heading' => __( 'Only shows specified categori(es)', 'willow' ),
					'param_name' => 'category',
					'description' => __( 'Comma separated SLUG of the categori(es).', 'js_composer' ),
				),
				array(
					'type' => 'dropdown',
					'holder' => 'div',
					'heading' => __( 'Enable Pagination', 'willow' ),
					'param_name' => 'pagination',
					'value' => array(
						__( 'false', 'willow' ) => 'false',
						__( 'true', 'willow' ) => 'true',
					),
				),
				$add_css_animation,
				array(
					'type' => 'textfield',
					'heading' => __( 'Extra class name', 'js_composer' ),
					'param_name' => 'el_class',
					'description' => __( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'js_composer' ),
				),
			),
		) );

	}

	/**
	 * Add Content Element: Progress Bar
	 */
	require_once( get_template_directory() . '/vc_extends/willow_progress_bar.php' );
	vc_map( array(
		'name' => __( 'Progress Bar', 'willow' ),
		'base' => 'vc_willow_progress_bar',
		'category' => __( 'Content', 'js_composer' ),
		'params' => array(
			array(
				'type' => 'textfield',
				'holder' => 'div',
				'heading' => __( 'Caption', 'willow' ),
				'param_name' => 'caption',
			),
			array(
				'type' => 'textfield',
				'holder' => 'div',
				'heading' => __( 'Value', 'willow' ),
				'param_name' => 'value',
				'description' => __( 'Valid value from 0 to 100, and without "%"', 'willow' ),
			),
			array(
				'type' => 'colorpicker',
				'holder' => 'div',
				'heading' => __( 'Custom Color', 'willow' ),
				'param_name' => 'color',
			),
			array(
				'type' => 'textfield',
				'heading' => __( 'Extra class name', 'js_composer' ),
				'param_name' => 'el_class',
				'description' => __( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'js_composer' ),
			),
		),
	) );

	/**
	 * Add Content Element: Quotes Carousel
	 */
	require_once( get_template_directory() . '/vc_extends/willow_quotes_carousel.php' );
	require_once( get_template_directory() . '/vc_extends/willow_quote.php' );
	vc_map( array(
		'name' => __( 'Quotes Carousel', 'willow' ),
		'base' => 'vc_willow_quotes_carousel',
		'admin_enqueue_js' => array( get_template_directory_uri() . '/vc_extends/assets/js/vc-willow-quotes-carousel.js' ),
		'admin_enqueue_css' => array( get_template_directory_uri() . '/vc_extends/assets/css/quotes-carousel.css' ),
		'category' => __( 'Content', 'js_composer' ),
		'show_settings_on_create' => false,
		'is_container' => true,
		'params' => array(
			array(
				'type' => 'textfield',
				'heading' => __( 'Auto Rotate Duration (mili seconds)', 'willow' ),
				'param_name' => 'auto_rotate',
				'description' => __( 'Fill 0 to disable', 'willow' ),
				'value' => 0,
			),
			array(
				'type' => 'textfield',
				'heading' => __( 'Extra class name', 'js_composer' ),
				'param_name' => 'el_class',
				'description' => __( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'js_composer' ),
			),
		),
		'custom_markup' => '
			<div class="wpb_holder clearfix vc_container_for_children">
				%content%
			</div>
			<div class="tab_controls">
				<button class="add_tab" title="' . __( 'Add quote', 'willow' ) . '">' . __( 'Add quote', 'willow' ) . '</button>
			</div>
		',
		'default_content' => '
			[vc_willow_quote cite="John Doe - Company, Inc."]' . __( '<p>This is quote content. Click edit button to change this text.</p>', 'willow' ) . '[/vc_willow_quote]
			[vc_willow_quote cite="Jane Doe - Company, Inc."]' . __( '<p>This is quote content. Click edit button to change this text.</p>', 'willow' ) . '[/vc_willow_quote]
		',
		'js_view' => 'WillowQuotesCarousel',
	) );
	vc_map( array(
		'name' => __( 'Quote', 'willow' ),
		'base' => 'vc_willow_quote',
		'content_element' => false,
		'params' => array(
			array(
				'type' => 'textarea_html',
				'holder' => 'div',
				'heading' => __( 'Content', 'willow' ),
				'param_name' => 'content',
				'value' => __( '<p>This is quote content. Click edit button to change this text.</p>', 'willow' ),
			),
			array(
				'type' => 'textfield',
				'heading' => __( 'Cite', 'willow' ),
				'param_name' => 'cite',
				'description' => __( 'Cite.', 'willow' ),
			),
			array(
				'type' => 'textfield',
				'heading' => __( 'Extra class name', 'js_composer' ),
				'param_name' => 'el_class',
				'description' => __( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'js_composer' ),
			),
		),
	) );

	/**
	 * Add Content Element: Section Heading
	 */
	require_once( get_template_directory() . '/vc_extends/willow_section_heading.php' );
	vc_map( array(
		'name' => __( 'Section Heading', 'willow' ),
		'base' => 'vc_willow_section_heading',
		'category' => __( 'Content', 'js_composer' ),
		'params' => array(
			array(
				'type' => 'textfield',
				'holder' => 'div',
				'heading' => __( 'Large Heading', 'willow' ),
				'param_name' => 'large_heading',
			),
			array(
				'type' => 'textfield',
				'holder' => 'div',
				'heading' => __( 'Small Heading', 'willow' ),
				'param_name' => 'small_heading',
			),
			array(
				'type' => 'dropdown',
				'holder' => 'div',
				'heading' => __( 'Text Alignment', 'willow' ),
				'param_name' => 'align',
				'value' => array(
					__( 'center', 'willow' ) => 'center',
					__( 'left', 'willow' ) => 'left',
					__( 'right', 'willow' ) => 'right',
				),
			),
			$add_css_animation,
			array(
				'type' => 'textfield',
				'heading' => __( 'Extra class name', 'js_composer' ),
				'param_name' => 'el_class',
				'description' => __( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'js_composer' ),
			),
		),
	) );

	/**
	 * Add Content Element: Service Block
	 */
	require_once( get_template_directory() . '/vc_extends/willow_service_block.php' );
	vc_map( array(
		'name' => __( 'Service Block', 'willow' ),
		'base' => 'vc_willow_service_block',
		'category' => __( 'Content', 'js_composer' ),
		'params' => array(
			array(
				'type' => 'textfield',
				'holder' => 'div',
				'heading' => __( 'Heading Text', 'willow' ),
				'param_name' => 'heading',
				'value' => __( 'Service Heading', 'willow' ),
			),
			array(
				'type' => 'dropdown',
				'holder' => 'div',
				'heading' => __( 'Style', 'willow' ),
				'param_name' => 'style',
				'value' => array(
					'style-1' => 'style-1',
					'style-2' => 'style-2',
				),
			),
			$add_icon,
			array(
				'type' => 'textarea_html',
				'holder' => 'div',
				'heading' => __( 'Content', 'willow' ),
				'param_name' => 'content',
				'value' => __( '<p>I am a service block. Click edit button to change this text. Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>', 'willow' ),
			),
			$add_css_animation,
			array(
				'type' => 'textfield',
				'heading' => __( 'Extra class name', 'js_composer' ),
				'param_name' => 'el_class',
				'description' => __( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'js_composer' ),
			),
		),
	) );

	/**
	 * Add Content Element: Spacer
	 */
	require_once( get_template_directory() . '/vc_extends/willow_spacer.php' );
	vc_map( array(
		'name' => __( 'Spacer', 'willow' ),
		'base' => 'vc_willow_spacer',
		'category' => __( 'Content', 'js_composer' ),
		'params' => array(
			array(
				'type' => 'textfield',
				'holder' => 'div',
				'heading' => __( 'Size (px / em / %)', 'willow' ),
				'param_name' => 'size',
			),
			array(
				'type' => 'textfield',
				'heading' => __( 'Extra class name', 'js_composer' ),
				'param_name' => 'el_class',
				'description' => __( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'js_composer' ),
			),
		),
	) );

	/**
	 * Add Content Element: Team Member Block
	 */
	require_once( get_template_directory() . '/vc_extends/willow_team_member_block.php' );
	vc_map( array(
		'name' => __( 'Team Member Block', 'willow' ),
		'base' => 'vc_willow_team_member_block',
		'category' => __( 'Content', 'js_composer' ),
		'params' => array(
			array(
				'type' => 'textfield',
				'holder' => 'div',
				'heading' => __( 'Name', 'willow' ),
				'param_name' => 'name',
				'value' => __( 'John Doe', 'willow' ),
			),
			array(
				'type' => 'attach_image',
				'holder' => 'div',
				'heading' => __( 'Photo', 'willow' ),
				'param_name' => 'photo',
				'description' => __( 'Minimum size recommended: 600px width image', 'willow' ),
			),
			array(
				'type' => 'textfield',
				'holder' => 'div',
				'heading' => __( 'Position', 'willow' ),
				'param_name' => 'position',
			),
			array(
				'type' => 'textarea_html',
				'holder' => 'div',
				'heading' => __( 'Content', 'willow' ),
				'param_name' => 'content',
				'value' => __( '<p>John Doe is a designer who works remotely from Birmingham, AL. A graduate of Ole Miss, where he played.</p>', 'willow' ),
			),
			array(
				'type' => 'textarea',
				'holder' => 'div',
				'heading' => __( 'Social Media', 'willow' ),
				'description' => __( 'Line break separated. See all available social media types <a href="http://fontawesome.io/icons/#brand">here</a>. Input format is social_media_type: your_url. For example, facebook: http://facebook.com.', 'willow' ),
				'param_name' => 'socmed',
				'value' => __( "facebook : http://facebook.com\ntwitter : http://twitter.com\nlinkedin : http://linkedin.com", 'willow' ),
			),
			$add_css_animation,
			array(
				'type' => 'textfield',
				'heading' => __( 'Extra class name', 'js_composer' ),
				'param_name' => 'el_class',
				'description' => __( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'js_composer' ),
			),
		),
	) );
}
add_action( 'init', 'willow_custom_visual_composer' );

/**
 * Visual Composer Custom Styling
 */
function willow_admin_print_styles() {
	?>
	<style type="text/css">
	.wpb-select.icon .fa{
		display: block;
		font-family: inherit;
	}
	.wpb-select.icon option[class*='fa-']:before{
		content: '';
	}
	</style>
	<?php
}
add_action( 'admin_print_styles-post-new.php', 'willow_admin_print_styles' );
add_action( 'admin_print_styles-post.php', 'willow_admin_print_styles' );
<?php

return array(
	'title' => __('Vafpress Portfolio Options', 'vp_textdomain'),
	'logo' => VP_PF_ADMIN_URI . '/public/vp_pf_logo.png',
	'menus' => array(
		array(
			'name' => 'meta_data',
			'title' => __('Meta Data', 'vp_portfolio'),
			'icon' => 'font-awesome:fa-briefcase',
			'controls' => array(
				array(
					'type'   => 'section',
					'title'  => __('Archive', 'vp_portfolio'),
					'fields' => array(
						array(
							'type' => 'textbox',
							'name' => 'queryable_titles',
							'label' => __('Queryable Titles', 'vp_portfolio'),
							'description' => __('Please use case-sensitive comma seperated list.', 'vp_portfolio'),
						),
						array(
							'type' => 'notebox',
							'name' => 'portfoliogenerate_note',
							'label' => __('Re-generate Queryable Titles', 'vp_portfolio'),
							'description' => __('Re-generate portfolio meta after changing `Queryable Titles`, please **don\'t forget to SAVE options first**.', 'vp_portfolio'),
						),
						array(
							'type' => 'portfoliogenerate',
							'name' => 'portfoliogenerate',
							'label' => __('Queryable Titles', 'vp_portfolio'),
						),
					),
				),
			),
		),
		array(
			'name' => 'url_rewriting',
			'title' => __('URL Rewriting', 'vp_portfolio'),
			'icon' => 'font-awesome:fa-gears',
			'controls' => array(
				array(
					'type' => 'notebox',
					'label' => __('Save Permalinks', 'vp_portfolio'),
					'status' => 'warning',
					'description' => __('Please do save under [**Permalinks Setting**](' . admin_url( 'options-permalink.php' ) . ') page in order to applied your changes here.', 'vp_portfolio'),
				),
				array(
					'type' => 'section',
					'title' => __('Portfolio Post URL Rewrite', 'vp_portfolio'),
					'fields' => array(
						array(
							'type' => 'textbox',
							'name' => 'post_rewrite_slug',
							'label' => __('Slug', 'vp_portfolio'),
							'description' => __('Default to &quot;portfolio&quot;.', 'vp_portfolio'),
							'default' => 'portfolio',
						),
						array(
							'type' => 'toggle',
							'name' => 'post_rewrite_with_front',
							'label' => __('With Front', 'vp_portfolio'),
							'default' => 0,
						),
					)
				),
				array(
					'type' => 'section',
					'title' => __('Category URL Rewrite', 'vp_portfolio'),
					'fields' => array(
						array(
							'type' => 'textbox',
							'name' => 'category_rewrite_slug',
							'label' => __('Slug', 'vp_portfolio'),
							'description' => __('Default to &quot;portfolio-category&quot;.', 'vp_portfolio'),
							'default' => 'portfolio-category',
							'validation' => 'required',
						),
						array(
							'type' => 'toggle',
							'name' => 'category_rewrite_with_front',
							'label' => __('With Front', 'vp_portfolio'),
							'default' => 0,
						),
					)
				),
				array(
					'type' => 'section',
					'title' => __('Tag URL Rewrite', 'vp_portfolio'),
					'fields' => array(
						array(
							'type' => 'textbox',
							'name' => 'tag_rewrite_slug',
							'label' => __('Slug', 'vp_portfolio'),
							'description' => __('Default to &quot;portfolio-tag&quot;.', 'vp_portfolio'),
							'default' => 'portfolio-tag',
							'validation' => 'required',
						),
						array(
							'type' => 'toggle',
							'name' => 'tag_rewrite_with_front',
							'label' => __('With Front', 'vp_portfolio'),
							'default' => 0,
						),
					)
				),
			),
		),
	)
);

/**
 *EOF
 */
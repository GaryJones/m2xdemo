<?php

$nl = "</p><p>";
$ol = "<p>";
$cl = "</p>";

return array(

	'Data Presentation' => array(
		'elements' => array(

			'portfolio' => array(
				'title'      => __('Portfolio', 'vp_portfolio'),
				'code'       => apply_filters('vp_pf_sc_code_portfolio', $ol.'[portfolio]'),
				'attributes' => apply_filters('vp_pf_sc_attributes_portfolio', array(
					array(
						'name'    => 'posts_per_page',
						'type'    => 'textbox',
						'label'   => __('Posts per Page', 'vp_portfolio'),
						'default' => 10,
					),
					array(
						'name'    => 'mode',
						'type'    => 'radiobutton',
						'label'   => __('Mode', 'vp_portfolio'),
						'items'   => array(
							'data' => array(
								array(
									'source' => 'function',
									'value'  => 'vp_pf_sc_source_mode',
								),
							),
						),
						'default' => array(
							'default',
						),
					),
					array(
						'name'    => 'pagination',
						'type'    => 'radiobutton',
						'label'   => __('Pagination', 'vp_portfolio'),
						'items'   => array(
							'data' => array(
								array(
									'source' => 'function',
									'value'  => 'vp_pf_sc_source_pagination_mode',
								),
							),
						),
						'default' => array(
							'page',
						),
					),
					'category' => array(
						'name'    => 'category',
						'type'    => 'multiselect',
						'label'   => __('IN Category', 'qualia_td'),
						'items'   => array(
							'data' => array(
								array(
									'source' => 'function',
									'value'  => 'vp_pf_sc_category',
								),
							),
						),
					),
				)),
			),

		),
	),

);

/**
 * EOF
 */
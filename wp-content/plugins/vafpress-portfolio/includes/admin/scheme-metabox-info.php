<?php

return array(
	array(
		'type'      => 'group',
		'repeating' => true,
		'sortable'  => true,
		'name'      => 'info',
		'priority'  => 'high',
		'title'     => __('Info', 'vp_portfolio'),
		'fields'    => array(
			array(
				'type'  => 'textbox',
				'name'  => 'title',
				'label' => __('Title', 'vp_portfolio'),
			),
			array(
				'type'  => 'wpeditor',
				'name'  => 'content',
				'label' => __('Content', 'vp_portfolio'),
			),
		),
	),
);
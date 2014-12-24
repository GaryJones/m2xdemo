<?php

/**
 *  Regular Font
 */
function willow_get_regular_font_faces() {
	return array(
		"'Helvetica Neue', Helvetica, Arial, sans-serif",
		"Georgia, 'Times New Roman', Times, serif",
		"Menlo, Monaco, Consolas, 'Courier New', monospace",
	);
}
function willow_data_source_regular_font_faces() {
	$ret = array();

	foreach ( willow_get_regular_font_faces() as $font ) {
		$ret[] = array( 'label' => sprintf( __( 'Standard : %s', 'willow' ), $font ), 'value' => $font );
	}
	return $ret;
}

/**
 * Social Media Links
 */
function willow_data_source_social_media_links() {
	return array(
		array( 'value' => 'behance', 'label' => 'Behance' ),
		array( 'value' => 'delicious', 'label' => 'Delicious' ),
		array( 'value' => 'deviantart', 'label' => 'DeviantArt' ),
		array( 'value' => 'digg', 'label' => 'Digg' ),
		array( 'value' => 'dribbble', 'label' => 'Dribbble' ),
		array( 'value' => 'dropbox', 'label' => 'Dropbox' ),
		array( 'value' => 'email', 'label' => 'Email' ),
		array( 'value' => 'facebook', 'label' => 'Facebook' ),
		array( 'value' => 'flickr', 'label' => 'Flickr' ),
		array( 'value' => 'foursquare', 'label' => 'Foursquare' ),
		array( 'value' => 'github', 'label' => 'Github' ),
		array( 'value' => 'googleplus', 'label' => 'Google+' ),
		array( 'value' => 'instagram', 'label' => 'Instagram' ),
		array( 'value' => 'linkedin', 'label' => 'LinkedIn' ),
		array( 'value' => 'myspace', 'label' => 'MySpace' ),
		array( 'value' => 'pinterest', 'label' => 'Pinterest' ),
		array( 'value' => 'reddit', 'label' => 'Reddit' ),
		array( 'value' => 'rss', 'label' => 'RSS' ),
		array( 'value' => 'skype', 'label' => 'Skype' ),
		array( 'value' => 'soundcloud', 'label' => 'SoundCloud' ),
		array( 'value' => 'stumbleupon', 'label' => 'StumbleUpon' ),
		array( 'value' => 'tumblr', 'label' => 'Tumblr' ),
		array( 'value' => 'twitter', 'label' => 'Twitter' ),
		array( 'value' => 'vimeo', 'label' => 'Vimeo' ),
		array( 'value' => 'wordpress', 'label' => 'WordPress' ),
		array( 'value' => 'xing', 'label' => 'Xing' ),
		array( 'value' => 'yahoo', 'label' => 'Yahoo' ),
		array( 'value' => 'youtube', 'label' => 'Youtube' ),
	);
}

/**
 * Social Share Links
 */
function willow_data_source_social_share_links() {
	return array(
		array( 'value' => 'delicious', 'label' => 'Delicious' ),
		array( 'value' => 'facebook', 'label' => 'Facebook' ),
		array( 'value' => 'googlePlus', 'label' => 'Google+' ),
		array( 'value' => 'linkedin', 'label' => 'LinkedIn' ),
		array( 'value' => 'pinterest', 'label' => 'Pinterest' ),
		array( 'value' => 'stumbleupon', 'label' => 'StumbleUpon' ),
		array( 'value' => 'twitter', 'label' => 'Twitter' ),
	);
}

/**
 * Hero Slides
 */
function willow_data_source_hero_slides() {
	$slides = get_posts( array(
		'post_type'      => 'willow-hero-slide',
		'posts_per_page' => -1,
	) );

	$return = array();
	foreach ( $slides as $slide ) {
		$return[] = array(
			'value' => $slide->ID,
			'label' => $slide->post_title,
		);
	}

	return $return;
}

/**
 * Background Overlay
 */
function willow_data_source_background_overlay() {
	return array(
		array(
			'label' => __( 'none', 'willow' ),
			'value' => '',
		),
		array(
			'label' => __( 'black overlay', 'willow' ),
			'value' => 'black-overlay',
		),
		array(
			'label' => __( 'dotted overlay', 'willow' ),
			'value' => 'dotted-overlay',
		),
	);
}

/**
 * Background Repeat
 */
function willow_data_source_background_repeat() {
	return array(
		array(
			'label' => __( 'default', 'wpb' ),
			'value' => '',
		),
		array(
			'label' => __( 'cover', 'wpb' ),
			'value' => 'cover',
		),
		array(
			'label' => __( 'contain', 'wpb' ),
			'value' => 'contain',
		),
		array(
			'label' => __( 'no repeat', 'wpb' ),
			'value' => 'no-repeat',
		),
	);
}

/**
 * Color Scheme
 */
function willow_data_source_color_scheme() {
	return array(
		array(
			'label' => __( 'light background / dark text color', 'willow' ),
			'value' => 'light',
		),
		array(
			'label' => __( 'dark background / light text color', 'willow' ),
			'value' => 'dark',
		),
	);
}

/**
 * Animate CSS
 */
function willow_get_animate_css() {
	return array(
		__( 'animate.css: bounce', 'willow' ) => 'animate_css animated bounce',
		__( 'animate.css: flash', 'willow' ) => 'animate_css animated flash',
		__( 'animate.css: pulse', 'willow' ) => 'animate_css animated pulse',
		__( 'animate.css: rubberBand', 'willow' ) => 'animate_css animated rubberBand',
		__( 'animate.css: shake', 'willow' ) => 'animate_css animated shake',
		__( 'animate.css: swing', 'willow' ) => 'animate_css animated swing',
		__( 'animate.css: tada', 'willow' ) => 'animate_css animated tada',
		__( 'animate.css: wobble', 'willow' ) => 'animate_css animated wobble',
		__( 'animate.css: bounceIn', 'willow' ) => 'animate_css animated bounceIn',
		__( 'animate.css: bounceInDown', 'willow' ) => 'animate_css animated bounceInDown',
		__( 'animate.css: bounceInLeft', 'willow' ) => 'animate_css animated bounceInLeft',
		__( 'animate.css: bounceInRight', 'willow' ) => 'animate_css animated bounceInRight',
		__( 'animate.css: bounceInUp', 'willow' ) => 'animate_css animated bounceInUp',
		__( 'animate.css: bounceOut', 'willow' ) => 'animate_css animated bounceOut',
		__( 'animate.css: bounceOutDown', 'willow' ) => 'animate_css animated bounceOutDown',
		__( 'animate.css: bounceOutLeft', 'willow' ) => 'animate_css animated bounceOutLeft',
		__( 'animate.css: bounceOutRight', 'willow' ) => 'animate_css animated bounceOutRight',
		__( 'animate.css: bounceOutUp', 'willow' ) => 'animate_css animated bounceOutUp',
		__( 'animate.css: fadeIn', 'willow' ) => 'animate_css animated fadeIn',
		__( 'animate.css: fadeInDown', 'willow' ) => 'animate_css animated fadeInDown',
		__( 'animate.css: fadeInDownBig', 'willow' ) => 'animate_css animated fadeInDownBig',
		__( 'animate.css: fadeInLeft', 'willow' ) => 'animate_css animated fadeInLeft',
		__( 'animate.css: fadeInLeftBig', 'willow' ) => 'animate_css animated fadeInLeftBig',
		__( 'animate.css: fadeInRight', 'willow' ) => 'animate_css animated fadeInRight',
		__( 'animate.css: fadeInRightBig', 'willow' ) => 'animate_css animated fadeInRightBig',
		__( 'animate.css: fadeInUp', 'willow' ) => 'animate_css animated fadeInUp',
		__( 'animate.css: fadeInUpBig', 'willow' ) => 'animate_css animated fadeInUpBig',
		__( 'animate.css: fadeOut', 'willow' ) => 'animate_css animated fadeOut',
		__( 'animate.css: fadeOutDown', 'willow' ) => 'animate_css animated fadeOutDown',
		__( 'animate.css: fadeOutDownBig', 'willow' ) => 'animate_css animated fadeOutDownBig',
		__( 'animate.css: fadeOutLeft', 'willow' ) => 'animate_css animated fadeOutLeft',
		__( 'animate.css: fadeOutLeftBig', 'willow' ) => 'animate_css animated fadeOutLeftBig',
		__( 'animate.css: fadeOutRight', 'willow' ) => 'animate_css animated fadeOutRight',
		__( 'animate.css: fadeOutRightBig', 'willow' ) => 'animate_css animated fadeOutRightBig',
		__( 'animate.css: fadeOutUp', 'willow' ) => 'animate_css animated fadeOutUp',
		__( 'animate.css: fadeOutUpBig', 'willow' ) => 'animate_css animated fadeOutUpBig',
		__( 'animate.css: flip', 'willow' ) => 'animate_css animated flip',
		__( 'animate.css: flipInX', 'willow' ) => 'animate_css animated flipInX',
		__( 'animate.css: flipInY', 'willow' ) => 'animate_css animated flipInY',
		__( 'animate.css: flipOutX', 'willow' ) => 'animate_css animated flipOutX',
		__( 'animate.css: flipOutY', 'willow' ) => 'animate_css animated flipOutY',
		__( 'animate.css: lightSpeedIn', 'willow' ) => 'animate_css animated lightSpeedIn',
		__( 'animate.css: lightSpeedOut', 'willow' ) => 'animate_css animated lightSpeedOut',
		__( 'animate.css: rotateIn', 'willow' ) => 'animate_css animated rotateIn',
		__( 'animate.css: rotateInDownLeft', 'willow' ) => 'animate_css animated rotateInDownLeft',
		__( 'animate.css: rotateInDownRight', 'willow' ) => 'animate_css animated rotateInDownRight',
		__( 'animate.css: rotateInUpLeft', 'willow' ) => 'animate_css animated rotateInUpLeft',
		__( 'animate.css: rotateInUpRight', 'willow' ) => 'animate_css animated rotateInUpRight',
		__( 'animate.css: rotateOut', 'willow' ) => 'animate_css animated rotateOut',
		__( 'animate.css: rotateOutDownLeft', 'willow' ) => 'animate_css animated rotateOutDownLeft',
		__( 'animate.css: rotateOutDownRight', 'willow' ) => 'animate_css animated rotateOutDownRight',
		__( 'animate.css: rotateOutUpLeft', 'willow' ) => 'animate_css animated rotateOutUpLeft',
		__( 'animate.css: rotateOutUpRight', 'willow' ) => 'animate_css animated rotateOutUpRight',
		__( 'animate.css: slideInDown', 'willow' ) => 'animate_css animated slideInDown',
		__( 'animate.css: slideInLeft', 'willow' ) => 'animate_css animated slideInLeft',
		__( 'animate.css: slideInRight', 'willow' ) => 'animate_css animated slideInRight',
		__( 'animate.css: slideOutLeft', 'willow' ) => 'animate_css animated slideOutLeft',
		__( 'animate.css: slideOutRight', 'willow' ) => 'animate_css animated slideOutRight',
		__( 'animate.css: slideOutUp', 'willow' ) => 'animate_css animated slideOutUp',
		__( 'animate.css: hinge', 'willow' ) => 'animate_css animated hinge',
		__( 'animate.css: rollIn', 'willow' ) => 'animate_css animated rollIn',
		__( 'animate.css: rollOut', 'willow' ) => 'animate_css animated rollOut',
	);
}

function willow_data_source_animate_css() {
	return array(
		array(
			'value' => 'bounce',
			'label' => 'bounce',
		),
		array(
			'value' => 'flash',
			'label' => 'flash',
		),
		array(
			'value' => 'pulse',
			'label' => 'pulse',
		),
		array(
			'value' => 'rubberBand',
			'label' => 'rubberBand',
		),
		array(
			'value' => 'shake',
			'label' => 'shake',
		),
		array(
			'value' => 'swing',
			'label' => 'swing',
		),
		array(
			'value' => 'tada',
			'label' => 'tada',
		),
		array(
			'value' => 'wobble',
			'label' => 'wobble',
		),
		array(
			'value' => 'bounceIn',
			'label' => 'bounceIn',
		),
		array(
			'value' => 'bounceInDown',
			'label' => 'bounceInDown',
		),
		array(
			'value' => 'bounceInLeft',
			'label' => 'bounceInLeft',
		),
		array(
			'value' => 'bounceInRight',
			'label' => 'bounceInRight',
		),
		array(
			'value' => 'bounceInUp',
			'label' => 'bounceInUp',
		),
		array(
			'value' => 'bounceOut',
			'label' => 'bounceOut',
		),
		array(
			'value' => 'bounceOutDown',
			'label' => 'bounceOutDown',
		),
		array(
			'value' => 'bounceOutLeft',
			'label' => 'bounceOutLeft',
		),
		array(
			'value' => 'bounceOutRight',
			'label' => 'bounceOutRight',
		),
		array(
			'value' => 'bounceOutUp',
			'label' => 'bounceOutUp',
		),
		array(
			'value' => 'fadeIn',
			'label' => 'fadeIn',
		),
		array(
			'value' => 'fadeInDown',
			'label' => 'fadeInDown',
		),
		array(
			'value' => 'fadeInDownBig',
			'label' => 'fadeInDownBig',
		),
		array(
			'value' => 'fadeInLeft',
			'label' => 'fadeInLeft',
		),
		array(
			'value' => 'fadeInLeftBig',
			'label' => 'fadeInLeftBig',
		),
		array(
			'value' => 'fadeInRight',
			'label' => 'fadeInRight',
		),
		array(
			'value' => 'fadeInRightBig',
			'label' => 'fadeInRightBig',
		),
		array(
			'value' => 'fadeInUp',
			'label' => 'fadeInUp',
		),
		array(
			'value' => 'fadeInUpBig',
			'label' => 'fadeInUpBig',
		),
		array(
			'value' => 'fadeOut',
			'label' => 'fadeOut',
		),
		array(
			'value' => 'fadeOutDown',
			'label' => 'fadeOutDown',
		),
		array(
			'value' => 'fadeOutDownBig',
			'label' => 'fadeOutDownBig',
		),
		array(
			'value' => 'fadeOutLeft',
			'label' => 'fadeOutLeft',
		),
		array(
			'value' => 'fadeOutLeftBig',
			'label' => 'fadeOutLeftBig',
		),
		array(
			'value' => 'fadeOutRight',
			'label' => 'fadeOutRight',
		),
		array(
			'value' => 'fadeOutRightBig',
			'label' => 'fadeOutRightBig',
		),
		array(
			'value' => 'fadeOutUp',
			'label' => 'fadeOutUp',
		),
		array(
			'value' => 'fadeOutUpBig',
			'label' => 'fadeOutUpBig',
		),
		array(
			'value' => 'flip',
			'label' => 'flip',
		),
		array(
			'value' => 'flipInX',
			'label' => 'flipInX',
		),
		array(
			'value' => 'flipInY',
			'label' => 'flipInY',
		),
		array(
			'value' => 'flipOutX',
			'label' => 'flipOutX',
		),
		array(
			'value' => 'flipOutY',
			'label' => 'flipOutY',
		),
		array(
			'value' => 'lightSpeedIn',
			'label' => 'lightSpeedIn',
		),
		array(
			'value' => 'lightSpeedOut',
			'label' => 'lightSpeedOut',
		),
		array(
			'value' => 'rotateIn',
			'label' => 'rotateIn',
		),
		array(
			'value' => 'rotateInDownLeft',
			'label' => 'rotateInDownLeft',
		),
		array(
			'value' => 'rotateInDownRight',
			'label' => 'rotateInDownRight',
		),
		array(
			'value' => 'rotateInUpLeft',
			'label' => 'rotateInUpLeft',
		),
		array(
			'value' => 'rotateInUpRight',
			'label' => 'rotateInUpRight',
		),
		array(
			'value' => 'rotateOut',
			'label' => 'rotateOut',
		),
		array(
			'value' => 'rotateOutDownLeft',
			'label' => 'rotateOutDownLeft',
		),
		array(
			'value' => 'rotateOutDownRight',
			'label' => 'rotateOutDownRight',
		),
		array(
			'value' => 'rotateOutUpLeft',
			'label' => 'rotateOutUpLeft',
		),
		array(
			'value' => 'rotateOutUpRight',
			'label' => 'rotateOutUpRight',
		),
		array(
			'value' => 'slideInDown',
			'label' => 'slideInDown',
		),
		array(
			'value' => 'slideInLeft',
			'label' => 'slideInLeft',
		),
		array(
			'value' => 'slideInRight',
			'label' => 'slideInRight',
		),
		array(
			'value' => 'slideOutLeft',
			'label' => 'slideOutLeft',
		),
		array(
			'value' => 'slideOutRight',
			'label' => 'slideOutRight',
		),
		array(
			'value' => 'slideOutUp',
			'label' => 'slideOutUp',
		),
		array(
			'value' => 'hinge',
			'label' => 'hinge',
		),
		array(
			'value' => 'rollIn',
			'label' => 'rollIn',
		),
		array(
			'value' => 'rollOut',
			'label' => 'rollOut',
		),
	);
}

/**
 * Icons
 */
function willow_get_icons() {
	return array_merge(
		array(
			'Linecons: heart' => 'linecons li_heart',
			'Linecons: cloud' => 'linecons li_cloud',
			'Linecons: star' => 'linecons li_star',
			'Linecons: tv' => 'linecons li_tv',
			'Linecons: sound' => 'linecons li_sound',
			'Linecons: video' => 'linecons li_video',
			'Linecons: trash' => 'linecons li_trash',
			'Linecons: user' => 'linecons li_user',
			'Linecons: key' => 'linecons li_key',
			'Linecons: search' => 'linecons li_search',
			'Linecons: settings' => 'linecons li_settings',
			'Linecons: camera' => 'linecons li_camera',
			'Linecons: tag' => 'linecons li_tag',
			'Linecons: lock' => 'linecons li_lock',
			'Linecons: bulb' => 'linecons li_bulb',
			'Linecons: pen' => 'linecons li_pen',
			'Linecons: diamond' => 'linecons li_diamond',
			'Linecons: display' => 'linecons li_display',
			'Linecons: location' => 'linecons li_location',
			'Linecons: eye' => 'linecons li_eye',
			'Linecons: bubble' => 'linecons li_bubble',
			'Linecons: stack' => 'linecons li_stack',
			'Linecons: cup' => 'linecons li_cup',
			'Linecons: phone' => 'linecons li_phone',
			'Linecons: news' => 'linecons li_news',
			'Linecons: mail' => 'linecons li_mail',
			'Linecons: like' => 'linecons li_like',
			'Linecons: photo' => 'linecons li_photo',
			'Linecons: note' => 'linecons li_note',
			'Linecons: clock' => 'linecons li_clock',
			'Linecons: paperplane' => 'linecons li_paperplane',
			'Linecons: params' => 'linecons li_params',
			'Linecons: banknote' => 'linecons li_banknote',
			'Linecons: data' => 'linecons li_data',
			'Linecons: music' => 'linecons li_music',
			'Linecons: megaphone' => 'linecons li_megaphone',
			'Linecons: study' => 'linecons li_study',
			'Linecons: lab' => 'linecons li_lab',
			'Linecons: food' => 'linecons li_food',
			'Linecons: t-shirt' => 'linecons li_t-shirt',
			'Linecons: fire' => 'linecons li_fire',
			'Linecons: clip' => 'linecons li_clip',
			'Linecons: shop' => 'linecons li_shop',
			'Linecons: calendar' => 'linecons li_calendar',
			'Linecons: vallet' => 'linecons li_vallet',
			'Linecons: vynil' => 'linecons li_vynil',
			'Linecons: truck' => 'linecons li_truck',
			'Linecons: world' => 'linecons li_world',
		),
		array(		
			'FontAwesome: glass' => 'fa fa-glass',
			'FontAwesome: music' => 'fa fa-music',
			'FontAwesome: search' => 'fa fa-search',
			'FontAwesome: envelope-o' => 'fa fa-envelope-o',
			'FontAwesome: heart' => 'fa fa-heart',
			'FontAwesome: star' => 'fa fa-star',
			'FontAwesome: star-o' => 'fa fa-star-o',
			'FontAwesome: user' => 'fa fa-user',
			'FontAwesome: film' => 'fa fa-film',
			'FontAwesome: th-large' => 'fa fa-th-large',
			'FontAwesome: th' => 'fa fa-th',
			'FontAwesome: th-list' => 'fa fa-th-list',
			'FontAwesome: check' => 'fa fa-check',
			'FontAwesome: times' => 'fa fa-times',
			'FontAwesome: search-plus' => 'fa fa-search-plus',
			'FontAwesome: search-minus' => 'fa fa-search-minus',
			'FontAwesome: power-off' => 'fa fa-power-off',
			'FontAwesome: signal' => 'fa fa-signal',
			'FontAwesome: gear' => 'fa fa-gear',
			'FontAwesome: cog' => 'fa fa-cog',
			'FontAwesome: trash-o' => 'fa fa-trash-o',
			'FontAwesome: home' => 'fa fa-home',
			'FontAwesome: file-o' => 'fa fa-file-o',
			'FontAwesome: clock-o' => 'fa fa-clock-o',
			'FontAwesome: road' => 'fa fa-road',
			'FontAwesome: download' => 'fa fa-download',
			'FontAwesome: arrow-circle-o-down' => 'fa fa-arrow-circle-o-down',
			'FontAwesome: arrow-circle-o-up' => 'fa fa-arrow-circle-o-up',
			'FontAwesome: inbox' => 'fa fa-inbox',
			'FontAwesome: play-circle-o' => 'fa fa-play-circle-o',
			'FontAwesome: rotate-right' => 'fa fa-rotate-right',
			'FontAwesome: repeat' => 'fa fa-repeat',
			'FontAwesome: refresh' => 'fa fa-refresh',
			'FontAwesome: list-alt' => 'fa fa-list-alt',
			'FontAwesome: lock' => 'fa fa-lock',
			'FontAwesome: flag' => 'fa fa-flag',
			'FontAwesome: headphones' => 'fa fa-headphones',
			'FontAwesome: volume-off' => 'fa fa-volume-off',
			'FontAwesome: volume-down' => 'fa fa-volume-down',
			'FontAwesome: volume-up' => 'fa fa-volume-up',
			'FontAwesome: qrcode' => 'fa fa-qrcode',
			'FontAwesome: barcode' => 'fa fa-barcode',
			'FontAwesome: tag' => 'fa fa-tag',
			'FontAwesome: tags' => 'fa fa-tags',
			'FontAwesome: book' => 'fa fa-book',
			'FontAwesome: bookmark' => 'fa fa-bookmark',
			'FontAwesome: print' => 'fa fa-print',
			'FontAwesome: camera' => 'fa fa-camera',
			'FontAwesome: font' => 'fa fa-font',
			'FontAwesome: bold' => 'fa fa-bold',
			'FontAwesome: italic' => 'fa fa-italic',
			'FontAwesome: text-height' => 'fa fa-text-height',
			'FontAwesome: text-width' => 'fa fa-text-width',
			'FontAwesome: align-left' => 'fa fa-align-left',
			'FontAwesome: align-center' => 'fa fa-align-center',
			'FontAwesome: align-right' => 'fa fa-align-right',
			'FontAwesome: align-justify' => 'fa fa-align-justify',
			'FontAwesome: list' => 'fa fa-list',
			'FontAwesome: dedent' => 'fa fa-dedent',
			'FontAwesome: outdent' => 'fa fa-outdent',
			'FontAwesome: indent' => 'fa fa-indent',
			'FontAwesome: video-camera' => 'fa fa-video-camera',
			'FontAwesome: photo' => 'fa fa-photo',
			'FontAwesome: image' => 'fa fa-image',
			'FontAwesome: picture-o' => 'fa fa-picture-o',
			'FontAwesome: pencil' => 'fa fa-pencil',
			'FontAwesome: map-marker' => 'fa fa-map-marker',
			'FontAwesome: adjust' => 'fa fa-adjust',
			'FontAwesome: tint' => 'fa fa-tint',
			'FontAwesome: edit' => 'fa fa-edit',
			'FontAwesome: pencil-square-o' => 'fa fa-pencil-square-o',
			'FontAwesome: share-square-o' => 'fa fa-share-square-o',
			'FontAwesome: check-square-o' => 'fa fa-check-square-o',
			'FontAwesome: arrows' => 'fa fa-arrows',
			'FontAwesome: step-backward' => 'fa fa-step-backward',
			'FontAwesome: fast-backward' => 'fa fa-fast-backward',
			'FontAwesome: backward' => 'fa fa-backward',
			'FontAwesome: play' => 'fa fa-play',
			'FontAwesome: pause' => 'fa fa-pause',
			'FontAwesome: stop' => 'fa fa-stop',
			'FontAwesome: forward' => 'fa fa-forward',
			'FontAwesome: fast-forward' => 'fa fa-fast-forward',
			'FontAwesome: step-forward' => 'fa fa-step-forward',
			'FontAwesome: eject' => 'fa fa-eject',
			'FontAwesome: chevron-left' => 'fa fa-chevron-left',
			'FontAwesome: chevron-right' => 'fa fa-chevron-right',
			'FontAwesome: plus-circle' => 'fa fa-plus-circle',
			'FontAwesome: minus-circle' => 'fa fa-minus-circle',
			'FontAwesome: times-circle' => 'fa fa-times-circle',
			'FontAwesome: check-circle' => 'fa fa-check-circle',
			'FontAwesome: question-circle' => 'fa fa-question-circle',
			'FontAwesome: info-circle' => 'fa fa-info-circle',
			'FontAwesome: crosshairs' => 'fa fa-crosshairs',
			'FontAwesome: times-circle-o' => 'fa fa-times-circle-o',
			'FontAwesome: check-circle-o' => 'fa fa-check-circle-o',
			'FontAwesome: ban' => 'fa fa-ban',
			'FontAwesome: arrow-left' => 'fa fa-arrow-left',
			'FontAwesome: arrow-right' => 'fa fa-arrow-right',
			'FontAwesome: arrow-up' => 'fa fa-arrow-up',
			'FontAwesome: arrow-down' => 'fa fa-arrow-down',
			'FontAwesome: mail-forward' => 'fa fa-mail-forward',
			'FontAwesome: share' => 'fa fa-share',
			'FontAwesome: expand' => 'fa fa-expand',
			'FontAwesome: compress' => 'fa fa-compress',
			'FontAwesome: plus' => 'fa fa-plus',
			'FontAwesome: minus' => 'fa fa-minus',
			'FontAwesome: asterisk' => 'fa fa-asterisk',
			'FontAwesome: exclamation-circle' => 'fa fa-exclamation-circle',
			'FontAwesome: gift' => 'fa fa-gift',
			'FontAwesome: leaf' => 'fa fa-leaf',
			'FontAwesome: fire' => 'fa fa-fire',
			'FontAwesome: eye' => 'fa fa-eye',
			'FontAwesome: eye-slash' => 'fa fa-eye-slash',
			'FontAwesome: warning' => 'fa fa-warning',
			'FontAwesome: exclamation-triangle' => 'fa fa-exclamation-triangle',
			'FontAwesome: plane' => 'fa fa-plane',
			'FontAwesome: calendar' => 'fa fa-calendar',
			'FontAwesome: random' => 'fa fa-random',
			'FontAwesome: comment' => 'fa fa-comment',
			'FontAwesome: magnet' => 'fa fa-magnet',
			'FontAwesome: chevron-up' => 'fa fa-chevron-up',
			'FontAwesome: chevron-down' => 'fa fa-chevron-down',
			'FontAwesome: retweet' => 'fa fa-retweet',
			'FontAwesome: shopping-cart' => 'fa fa-shopping-cart',
			'FontAwesome: folder' => 'fa fa-folder',
			'FontAwesome: folder-open' => 'fa fa-folder-open',
			'FontAwesome: arrows-v' => 'fa fa-arrows-v',
			'FontAwesome: arrows-h' => 'fa fa-arrows-h',
			'FontAwesome: bar-chart-o' => 'fa fa-bar-chart-o',
			'FontAwesome: twitter-square' => 'fa fa-twitter-square',
			'FontAwesome: facebook-square' => 'fa fa-facebook-square',
			'FontAwesome: camera-retro' => 'fa fa-camera-retro',
			'FontAwesome: key' => 'fa fa-key',
			'FontAwesome: gears' => 'fa fa-gears',
			'FontAwesome: cogs' => 'fa fa-cogs',
			'FontAwesome: comments' => 'fa fa-comments',
			'FontAwesome: thumbs-o-up' => 'fa fa-thumbs-o-up',
			'FontAwesome: thumbs-o-down' => 'fa fa-thumbs-o-down',
			'FontAwesome: star-half' => 'fa fa-star-half',
			'FontAwesome: heart-o' => 'fa fa-heart-o',
			'FontAwesome: sign-out' => 'fa fa-sign-out',
			'FontAwesome: linkedin-square' => 'fa fa-linkedin-square',
			'FontAwesome: thumb-tack' => 'fa fa-thumb-tack',
			'FontAwesome: external-link' => 'fa fa-external-link',
			'FontAwesome: sign-in' => 'fa fa-sign-in',
			'FontAwesome: trophy' => 'fa fa-trophy',
			'FontAwesome: github-square' => 'fa fa-github-square',
			'FontAwesome: upload' => 'fa fa-upload',
			'FontAwesome: lemon-o' => 'fa fa-lemon-o',
			'FontAwesome: phone' => 'fa fa-phone',
			'FontAwesome: square-o' => 'fa fa-square-o',
			'FontAwesome: bookmark-o' => 'fa fa-bookmark-o',
			'FontAwesome: phone-square' => 'fa fa-phone-square',
			'FontAwesome: twitter' => 'fa fa-twitter',
			'FontAwesome: facebook' => 'fa fa-facebook',
			'FontAwesome: github' => 'fa fa-github',
			'FontAwesome: unlock' => 'fa fa-unlock',
			'FontAwesome: credit-card' => 'fa fa-credit-card',
			'FontAwesome: rss' => 'fa fa-rss',
			'FontAwesome: hdd-o' => 'fa fa-hdd-o',
			'FontAwesome: bullhorn' => 'fa fa-bullhorn',
			'FontAwesome: bell' => 'fa fa-bell',
			'FontAwesome: certificate' => 'fa fa-certificate',
			'FontAwesome: hand-o-right' => 'fa fa-hand-o-right',
			'FontAwesome: hand-o-left' => 'fa fa-hand-o-left',
			'FontAwesome: hand-o-up' => 'fa fa-hand-o-up',
			'FontAwesome: hand-o-down' => 'fa fa-hand-o-down',
			'FontAwesome: arrow-circle-left' => 'fa fa-arrow-circle-left',
			'FontAwesome: arrow-circle-right' => 'fa fa-arrow-circle-right',
			'FontAwesome: arrow-circle-up' => 'fa fa-arrow-circle-up',
			'FontAwesome: arrow-circle-down' => 'fa fa-arrow-circle-down',
			'FontAwesome: globe' => 'fa fa-globe',
			'FontAwesome: wrench' => 'fa fa-wrench',
			'FontAwesome: tasks' => 'fa fa-tasks',
			'FontAwesome: filter' => 'fa fa-filter',
			'FontAwesome: briefcase' => 'fa fa-briefcase',
			'FontAwesome: arrows-alt' => 'fa fa-arrows-alt',
			'FontAwesome: group' => 'fa fa-group',
			'FontAwesome: users' => 'fa fa-users',
			'FontAwesome: chain' => 'fa fa-chain',
			'FontAwesome: link' => 'fa fa-link',
			'FontAwesome: cloud' => 'fa fa-cloud',
			'FontAwesome: flask' => 'fa fa-flask',
			'FontAwesome: cut' => 'fa fa-cut',
			'FontAwesome: scissors' => 'fa fa-scissors',
			'FontAwesome: copy' => 'fa fa-copy',
			'FontAwesome: files-o' => 'fa fa-files-o',
			'FontAwesome: paperclip' => 'fa fa-paperclip',
			'FontAwesome: save' => 'fa fa-save',
			'FontAwesome: floppy-o' => 'fa fa-floppy-o',
			'FontAwesome: square' => 'fa fa-square',
			'FontAwesome: navicon' => 'fa fa-navicon',
			'FontAwesome: reorder' => 'fa fa-reorder',
			'FontAwesome: bars' => 'fa fa-bars',
			'FontAwesome: list-ul' => 'fa fa-list-ul',
			'FontAwesome: list-ol' => 'fa fa-list-ol',
			'FontAwesome: strikethrough' => 'fa fa-strikethrough',
			'FontAwesome: underline' => 'fa fa-underline',
			'FontAwesome: table' => 'fa fa-table',
			'FontAwesome: magic' => 'fa fa-magic',
			'FontAwesome: truck' => 'fa fa-truck',
			'FontAwesome: pinterest' => 'fa fa-pinterest',
			'FontAwesome: pinterest-square' => 'fa fa-pinterest-square',
			'FontAwesome: google-plus-square' => 'fa fa-google-plus-square',
			'FontAwesome: google-plus' => 'fa fa-google-plus',
			'FontAwesome: money' => 'fa fa-money',
			'FontAwesome: caret-down' => 'fa fa-caret-down',
			'FontAwesome: caret-up' => 'fa fa-caret-up',
			'FontAwesome: caret-left' => 'fa fa-caret-left',
			'FontAwesome: caret-right' => 'fa fa-caret-right',
			'FontAwesome: columns' => 'fa fa-columns',
			'FontAwesome: unsorted' => 'fa fa-unsorted',
			'FontAwesome: sort' => 'fa fa-sort',
			'FontAwesome: sort-down' => 'fa fa-sort-down',
			'FontAwesome: sort-desc' => 'fa fa-sort-desc',
			'FontAwesome: sort-up' => 'fa fa-sort-up',
			'FontAwesome: sort-asc' => 'fa fa-sort-asc',
			'FontAwesome: envelope' => 'fa fa-envelope',
			'FontAwesome: linkedin' => 'fa fa-linkedin',
			'FontAwesome: rotate-left' => 'fa fa-rotate-left',
			'FontAwesome: undo' => 'fa fa-undo',
			'FontAwesome: legal' => 'fa fa-legal',
			'FontAwesome: gavel' => 'fa fa-gavel',
			'FontAwesome: dashboard' => 'fa fa-dashboard',
			'FontAwesome: tachometer' => 'fa fa-tachometer',
			'FontAwesome: comment-o' => 'fa fa-comment-o',
			'FontAwesome: comments-o' => 'fa fa-comments-o',
			'FontAwesome: flash' => 'fa fa-flash',
			'FontAwesome: bolt' => 'fa fa-bolt',
			'FontAwesome: sitemap' => 'fa fa-sitemap',
			'FontAwesome: umbrella' => 'fa fa-umbrella',
			'FontAwesome: paste' => 'fa fa-paste',
			'FontAwesome: clipboard' => 'fa fa-clipboard',
			'FontAwesome: lightbulb-o' => 'fa fa-lightbulb-o',
			'FontAwesome: exchange' => 'fa fa-exchange',
			'FontAwesome: cloud-download' => 'fa fa-cloud-download',
			'FontAwesome: cloud-upload' => 'fa fa-cloud-upload',
			'FontAwesome: user-md' => 'fa fa-user-md',
			'FontAwesome: stethoscope' => 'fa fa-stethoscope',
			'FontAwesome: suitcase' => 'fa fa-suitcase',
			'FontAwesome: bell-o' => 'fa fa-bell-o',
			'FontAwesome: coffee' => 'fa fa-coffee',
			'FontAwesome: cutlery' => 'fa fa-cutlery',
			'FontAwesome: file-text-o' => 'fa fa-file-text-o',
			'FontAwesome: building-o' => 'fa fa-building-o',
			'FontAwesome: hospital-o' => 'fa fa-hospital-o',
			'FontAwesome: ambulance' => 'fa fa-ambulance',
			'FontAwesome: medkit' => 'fa fa-medkit',
			'FontAwesome: fighter-jet' => 'fa fa-fighter-jet',
			'FontAwesome: beer' => 'fa fa-beer',
			'FontAwesome: h-square' => 'fa fa-h-square',
			'FontAwesome: plus-square' => 'fa fa-plus-square',
			'FontAwesome: angle-double-left' => 'fa fa-angle-double-left',
			'FontAwesome: angle-double-right' => 'fa fa-angle-double-right',
			'FontAwesome: angle-double-up' => 'fa fa-angle-double-up',
			'FontAwesome: angle-double-down' => 'fa fa-angle-double-down',
			'FontAwesome: angle-left' => 'fa fa-angle-left',
			'FontAwesome: angle-right' => 'fa fa-angle-right',
			'FontAwesome: angle-up' => 'fa fa-angle-up',
			'FontAwesome: angle-down' => 'fa fa-angle-down',
			'FontAwesome: desktop' => 'fa fa-desktop',
			'FontAwesome: laptop' => 'fa fa-laptop',
			'FontAwesome: tablet' => 'fa fa-tablet',
			'FontAwesome: mobile-phone' => 'fa fa-mobile-phone',
			'FontAwesome: mobile' => 'fa fa-mobile',
			'FontAwesome: circle-o' => 'fa fa-circle-o',
			'FontAwesome: quote-left' => 'fa fa-quote-left',
			'FontAwesome: quote-right' => 'fa fa-quote-right',
			'FontAwesome: spinner' => 'fa fa-spinner',
			'FontAwesome: circle' => 'fa fa-circle',
			'FontAwesome: mail-reply' => 'fa fa-mail-reply',
			'FontAwesome: reply' => 'fa fa-reply',
			'FontAwesome: github-alt' => 'fa fa-github-alt',
			'FontAwesome: folder-o' => 'fa fa-folder-o',
			'FontAwesome: folder-open-o' => 'fa fa-folder-open-o',
			'FontAwesome: smile-o' => 'fa fa-smile-o',
			'FontAwesome: frown-o' => 'fa fa-frown-o',
			'FontAwesome: meh-o' => 'fa fa-meh-o',
			'FontAwesome: gamepad' => 'fa fa-gamepad',
			'FontAwesome: keyboard-o' => 'fa fa-keyboard-o',
			'FontAwesome: flag-o' => 'fa fa-flag-o',
			'FontAwesome: flag-checkered' => 'fa fa-flag-checkered',
			'FontAwesome: terminal' => 'fa fa-terminal',
			'FontAwesome: code' => 'fa fa-code',
			'FontAwesome: mail-reply-all' => 'fa fa-mail-reply-all',
			'FontAwesome: reply-all' => 'fa fa-reply-all',
			'FontAwesome: star-half-empty' => 'fa fa-star-half-empty',
			'FontAwesome: star-half-full' => 'fa fa-star-half-full',
			'FontAwesome: star-half-o' => 'fa fa-star-half-o',
			'FontAwesome: location-arrow' => 'fa fa-location-arrow',
			'FontAwesome: crop' => 'fa fa-crop',
			'FontAwesome: code-fork' => 'fa fa-code-fork',
			'FontAwesome: unlink' => 'fa fa-unlink',
			'FontAwesome: chain-broken' => 'fa fa-chain-broken',
			'FontAwesome: question' => 'fa fa-question',
			'FontAwesome: info' => 'fa fa-info',
			'FontAwesome: exclamation' => 'fa fa-exclamation',
			'FontAwesome: superscript' => 'fa fa-superscript',
			'FontAwesome: subscript' => 'fa fa-subscript',
			'FontAwesome: eraser' => 'fa fa-eraser',
			'FontAwesome: puzzle-piece' => 'fa fa-puzzle-piece',
			'FontAwesome: microphone' => 'fa fa-microphone',
			'FontAwesome: microphone-slash' => 'fa fa-microphone-slash',
			'FontAwesome: shield' => 'fa fa-shield',
			'FontAwesome: calendar-o' => 'fa fa-calendar-o',
			'FontAwesome: fire-extinguisher' => 'fa fa-fire-extinguisher',
			'FontAwesome: rocket' => 'fa fa-rocket',
			'FontAwesome: maxcdn' => 'fa fa-maxcdn',
			'FontAwesome: chevron-circle-left' => 'fa fa-chevron-circle-left',
			'FontAwesome: chevron-circle-right' => 'fa fa-chevron-circle-right',
			'FontAwesome: chevron-circle-up' => 'fa fa-chevron-circle-up',
			'FontAwesome: chevron-circle-down' => 'fa fa-chevron-circle-down',
			'FontAwesome: html5' => 'fa fa-html5',
			'FontAwesome: css3' => 'fa fa-css3',
			'FontAwesome: anchor' => 'fa fa-anchor',
			'FontAwesome: unlock-alt' => 'fa fa-unlock-alt',
			'FontAwesome: bullseye' => 'fa fa-bullseye',
			'FontAwesome: ellipsis-h' => 'fa fa-ellipsis-h',
			'FontAwesome: ellipsis-v' => 'fa fa-ellipsis-v',
			'FontAwesome: rss-square' => 'fa fa-rss-square',
			'FontAwesome: play-circle' => 'fa fa-play-circle',
			'FontAwesome: ticket' => 'fa fa-ticket',
			'FontAwesome: minus-square' => 'fa fa-minus-square',
			'FontAwesome: minus-square-o' => 'fa fa-minus-square-o',
			'FontAwesome: level-up' => 'fa fa-level-up',
			'FontAwesome: level-down' => 'fa fa-level-down',
			'FontAwesome: check-square' => 'fa fa-check-square',
			'FontAwesome: pencil-square' => 'fa fa-pencil-square',
			'FontAwesome: external-link-square' => 'fa fa-external-link-square',
			'FontAwesome: share-square' => 'fa fa-share-square',
			'FontAwesome: compass' => 'fa fa-compass',
			'FontAwesome: toggle-down' => 'fa fa-toggle-down',
			'FontAwesome: caret-square-o-down' => 'fa fa-caret-square-o-down',
			'FontAwesome: toggle-up' => 'fa fa-toggle-up',
			'FontAwesome: caret-square-o-up' => 'fa fa-caret-square-o-up',
			'FontAwesome: toggle-right' => 'fa fa-toggle-right',
			'FontAwesome: caret-square-o-right' => 'fa fa-caret-square-o-right',
			'FontAwesome: euro' => 'fa fa-euro',
			'FontAwesome: eur' => 'fa fa-eur',
			'FontAwesome: gbp' => 'fa fa-gbp',
			'FontAwesome: dollar' => 'fa fa-dollar',
			'FontAwesome: usd' => 'fa fa-usd',
			'FontAwesome: rupee' => 'fa fa-rupee',
			'FontAwesome: inr' => 'fa fa-inr',
			'FontAwesome: cny' => 'fa fa-cny',
			'FontAwesome: rmb' => 'fa fa-rmb',
			'FontAwesome: yen' => 'fa fa-yen',
			'FontAwesome: jpy' => 'fa fa-jpy',
			'FontAwesome: ruble' => 'fa fa-ruble',
			'FontAwesome: rouble' => 'fa fa-rouble',
			'FontAwesome: rub' => 'fa fa-rub',
			'FontAwesome: won' => 'fa fa-won',
			'FontAwesome: krw' => 'fa fa-krw',
			'FontAwesome: bitcoin' => 'fa fa-bitcoin',
			'FontAwesome: btc' => 'fa fa-btc',
			'FontAwesome: file' => 'fa fa-file',
			'FontAwesome: file-text' => 'fa fa-file-text',
			'FontAwesome: sort-alpha-asc' => 'fa fa-sort-alpha-asc',
			'FontAwesome: sort-alpha-desc' => 'fa fa-sort-alpha-desc',
			'FontAwesome: sort-amount-asc' => 'fa fa-sort-amount-asc',
			'FontAwesome: sort-amount-desc' => 'fa fa-sort-amount-desc',
			'FontAwesome: sort-numeric-asc' => 'fa fa-sort-numeric-asc',
			'FontAwesome: sort-numeric-desc' => 'fa fa-sort-numeric-desc',
			'FontAwesome: thumbs-up' => 'fa fa-thumbs-up',
			'FontAwesome: thumbs-down' => 'fa fa-thumbs-down',
			'FontAwesome: youtube-square' => 'fa fa-youtube-square',
			'FontAwesome: youtube' => 'fa fa-youtube',
			'FontAwesome: xing' => 'fa fa-xing',
			'FontAwesome: xing-square' => 'fa fa-xing-square',
			'FontAwesome: youtube-play' => 'fa fa-youtube-play',
			'FontAwesome: dropbox' => 'fa fa-dropbox',
			'FontAwesome: stack-overflow' => 'fa fa-stack-overflow',
			'FontAwesome: instagram' => 'fa fa-instagram',
			'FontAwesome: flickr' => 'fa fa-flickr',
			'FontAwesome: adn' => 'fa fa-adn',
			'FontAwesome: bitbucket' => 'fa fa-bitbucket',
			'FontAwesome: bitbucket-square' => 'fa fa-bitbucket-square',
			'FontAwesome: tumblr' => 'fa fa-tumblr',
			'FontAwesome: tumblr-square' => 'fa fa-tumblr-square',
			'FontAwesome: long-arrow-down' => 'fa fa-long-arrow-down',
			'FontAwesome: long-arrow-up' => 'fa fa-long-arrow-up',
			'FontAwesome: long-arrow-left' => 'fa fa-long-arrow-left',
			'FontAwesome: long-arrow-right' => 'fa fa-long-arrow-right',
			'FontAwesome: apple' => 'fa fa-apple',
			'FontAwesome: windows' => 'fa fa-windows',
			'FontAwesome: android' => 'fa fa-android',
			'FontAwesome: linux' => 'fa fa-linux',
			'FontAwesome: dribbble' => 'fa fa-dribbble',
			'FontAwesome: skype' => 'fa fa-skype',
			'FontAwesome: foursquare' => 'fa fa-foursquare',
			'FontAwesome: trello' => 'fa fa-trello',
			'FontAwesome: female' => 'fa fa-female',
			'FontAwesome: male' => 'fa fa-male',
			'FontAwesome: gittip' => 'fa fa-gittip',
			'FontAwesome: sun-o' => 'fa fa-sun-o',
			'FontAwesome: moon-o' => 'fa fa-moon-o',
			'FontAwesome: archive' => 'fa fa-archive',
			'FontAwesome: bug' => 'fa fa-bug',
			'FontAwesome: vk' => 'fa fa-vk',
			'FontAwesome: weibo' => 'fa fa-weibo',
			'FontAwesome: renren' => 'fa fa-renren',
			'FontAwesome: pagelines' => 'fa fa-pagelines',
			'FontAwesome: stack-exchange' => 'fa fa-stack-exchange',
			'FontAwesome: arrow-circle-o-right' => 'fa fa-arrow-circle-o-right',
			'FontAwesome: arrow-circle-o-left' => 'fa fa-arrow-circle-o-left',
			'FontAwesome: toggle-left' => 'fa fa-toggle-left',
			'FontAwesome: caret-square-o-left' => 'fa fa-caret-square-o-left',
			'FontAwesome: dot-circle-o' => 'fa fa-dot-circle-o',
			'FontAwesome: wheelchair' => 'fa fa-wheelchair',
			'FontAwesome: vimeo-square' => 'fa fa-vimeo-square',
			'FontAwesome: turkish-lira' => 'fa fa-turkish-lira',
			'FontAwesome: try' => 'fa fa-try',
			'FontAwesome: plus-square-o' => 'fa fa-plus-square-o',
			'FontAwesome: space-shuttle' => 'fa fa-space-shuttle',
			'FontAwesome: slack' => 'fa fa-slack',
			'FontAwesome: envelope-square' => 'fa fa-envelope-square',
			'FontAwesome: wordpress' => 'fa fa-wordpress',
			'FontAwesome: openid' => 'fa fa-openid',
			'FontAwesome: institution' => 'fa fa-institution',
			'FontAwesome: bank' => 'fa fa-bank',
			'FontAwesome: university' => 'fa fa-university',
			'FontAwesome: mortar-board' => 'fa fa-mortar-board',
			'FontAwesome: graduation-cap' => 'fa fa-graduation-cap',
			'FontAwesome: yahoo' => 'fa fa-yahoo',
			'FontAwesome: google' => 'fa fa-google',
			'FontAwesome: reddit' => 'fa fa-reddit',
			'FontAwesome: reddit-square' => 'fa fa-reddit-square',
			'FontAwesome: stumbleupon-circle' => 'fa fa-stumbleupon-circle',
			'FontAwesome: stumbleupon' => 'fa fa-stumbleupon',
			'FontAwesome: delicious' => 'fa fa-delicious',
			'FontAwesome: digg' => 'fa fa-digg',
			'FontAwesome: pied-piper-square' => 'fa fa-pied-piper-square',
			'FontAwesome: pied-piper' => 'fa fa-pied-piper',
			'FontAwesome: pied-piper-alt' => 'fa fa-pied-piper-alt',
			'FontAwesome: drupal' => 'fa fa-drupal',
			'FontAwesome: joomla' => 'fa fa-joomla',
			'FontAwesome: language' => 'fa fa-language',
			'FontAwesome: fax' => 'fa fa-fax',
			'FontAwesome: building' => 'fa fa-building',
			'FontAwesome: child' => 'fa fa-child',
			'FontAwesome: paw' => 'fa fa-paw',
			'FontAwesome: spoon' => 'fa fa-spoon',
			'FontAwesome: cube' => 'fa fa-cube',
			'FontAwesome: cubes' => 'fa fa-cubes',
			'FontAwesome: behance' => 'fa fa-behance',
			'FontAwesome: behance-square' => 'fa fa-behance-square',
			'FontAwesome: steam' => 'fa fa-steam',
			'FontAwesome: steam-square' => 'fa fa-steam-square',
			'FontAwesome: recycle' => 'fa fa-recycle',
			'FontAwesome: automobile' => 'fa fa-automobile',
			'FontAwesome: car' => 'fa fa-car',
			'FontAwesome: cab' => 'fa fa-cab',
			'FontAwesome: taxi' => 'fa fa-taxi',
			'FontAwesome: tree' => 'fa fa-tree',
			'FontAwesome: spotify' => 'fa fa-spotify',
			'FontAwesome: deviantart' => 'fa fa-deviantart',
			'FontAwesome: soundcloud' => 'fa fa-soundcloud',
			'FontAwesome: database' => 'fa fa-database',
			'FontAwesome: file-pdf-o' => 'fa fa-file-pdf-o',
			'FontAwesome: file-word-o' => 'fa fa-file-word-o',
			'FontAwesome: file-excel-o' => 'fa fa-file-excel-o',
			'FontAwesome: file-powerpoint-o' => 'fa fa-file-powerpoint-o',
			'FontAwesome: file-photo-o' => 'fa fa-file-photo-o',
			'FontAwesome: file-picture-o' => 'fa fa-file-picture-o',
			'FontAwesome: file-image-o' => 'fa fa-file-image-o',
			'FontAwesome: file-zip-o' => 'fa fa-file-zip-o',
			'FontAwesome: file-archive-o' => 'fa fa-file-archive-o',
			'FontAwesome: file-sound-o' => 'fa fa-file-sound-o',
			'FontAwesome: file-audio-o' => 'fa fa-file-audio-o',
			'FontAwesome: file-movie-o' => 'fa fa-file-movie-o',
			'FontAwesome: file-video-o' => 'fa fa-file-video-o',
			'FontAwesome: file-code-o' => 'fa fa-file-code-o',
			'FontAwesome: vine' => 'fa fa-vine',
			'FontAwesome: codepen' => 'fa fa-codepen',
			'FontAwesome: jsfiddle' => 'fa fa-jsfiddle',
			'FontAwesome: life-bouy' => 'fa fa-life-bouy',
			'FontAwesome: life-saver' => 'fa fa-life-saver',
			'FontAwesome: support' => 'fa fa-support',
			'FontAwesome: life-ring' => 'fa fa-life-ring',
			'FontAwesome: circle-o-notch' => 'fa fa-circle-o-notch',
			'FontAwesome: ra' => 'fa fa-ra',
			'FontAwesome: rebel' => 'fa fa-rebel',
			'FontAwesome: ge' => 'fa fa-ge',
			'FontAwesome: empire' => 'fa fa-empire',
			'FontAwesome: git-square' => 'fa fa-git-square',
			'FontAwesome: git' => 'fa fa-git',
			'FontAwesome: hacker-news' => 'fa fa-hacker-news',
			'FontAwesome: tencent-weibo' => 'fa fa-tencent-weibo',
			'FontAwesome: qq' => 'fa fa-qq',
			'FontAwesome: wechat' => 'fa fa-wechat',
			'FontAwesome: weixin' => 'fa fa-weixin',
			'FontAwesome: send' => 'fa fa-send',
			'FontAwesome: paper-plane' => 'fa fa-paper-plane',
			'FontAwesome: send-o' => 'fa fa-send-o',
			'FontAwesome: paper-plane-o' => 'fa fa-paper-plane-o',
			'FontAwesome: history' => 'fa fa-history',
			'FontAwesome: circle-thin' => 'fa fa-circle-thin',
			'FontAwesome: header' => 'fa fa-header',
			'FontAwesome: paragraph' => 'fa fa-paragraph',
			'FontAwesome: sliders' => 'fa fa-sliders',
			'FontAwesome: share-alt' => 'fa fa-share-alt',
			'FontAwesome: share-alt-square' => 'fa fa-share-alt-square',
			'FontAwesome: bomb' => 'fa fa-bomb',
		)
	);
}

/**
 * Dependency: Portfolio Default Layout options
 */
VP_Security::instance()->whitelist_function( 'willow_dependency_portfolio_default_layout' );
function willow_dependency_portfolio_default_layout( $value ) {
	return ! $value;
}

/**
 * Dependency: Hero Slide Background Image
 */
VP_Security::instance()->whitelist_function( 'willow_dependency_hero_slide_background_image' );
function willow_dependency_hero_slide_background_image( $value ) {
	if ( 'image' == $value ) return true;
	return false;
}

/**
 * Dependency: Hero Slide Background Video
 */
VP_Security::instance()->whitelist_function( 'willow_dependency_hero_slide_background_video' );
function willow_dependency_hero_slide_background_video( $value ) {
	if ( 'video' == $value ) return true;
	return false;
}

/**
 * Dependency: Hero Slide Top Text
 */
VP_Security::instance()->whitelist_function( 'willow_dependency_hero_slide_top_text' );
function willow_dependency_hero_slide_top_text( $value ) {
	if ( $value != 'style-0' ) return true;
	return false;
}

/**
 * Dependency: Hero Slide Middle Text
 */
VP_Security::instance()->whitelist_function( 'willow_dependency_hero_slide_middle_text' );
function willow_dependency_hero_slide_middle_text( $value ) {
	if ( $value != 'style-0' ) return true;
	return false;
}

/**
 * Dependency: Hero Slide Bottom Text
 */
VP_Security::instance()->whitelist_function( 'willow_dependency_hero_slide_bottom_text' );
function willow_dependency_hero_slide_bottom_text( $value ) {
	if ( $value != 'style-0' ) return true;
	return false;
}

/**
 * Dependency: Hero Slide Button
 */
VP_Security::instance()->whitelist_function( 'willow_dependency_hero_slide_button' );
function willow_dependency_hero_slide_button( $value ) {
	if ( $value != 'style-0' ) return true;
	return false;
}

/**
 * Dependency: Hero Slide Button 2
 */
VP_Security::instance()->whitelist_function( 'willow_dependency_hero_slide_button_2' );
function willow_dependency_hero_slide_button_2( $value ) {
	if ( ! in_array( $value, array( 'style-0', 'style-1', 'style-2' ) ) ) return true;
	return false;
}

/**
 * Dependency: Hero Slide CSS animation
 */
VP_Security::instance()->whitelist_function( 'willow_dependency_hero_slide_css_animation' );
function willow_dependency_hero_slide_css_animation( $value ) {
	if ( $value !== 'style-0' ) return true;
	return false;
}
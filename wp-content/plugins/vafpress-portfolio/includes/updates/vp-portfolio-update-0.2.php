<?php
/**
 * Update Vafpress Portfolio to 0.2
 *
 * @author      Vafpress
 * @since       0.2
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

$args = array (
	'post_type'      => 'portfolio',
	'posts_per_page' => '-1',
	'fields'         => 'ids',
);
$query = new WP_Query( $args );
$posts = $query->get_posts();

foreach ($posts as $post_id) {
	VP_PF_Portfolio::instance();
	$new_media = get_post_meta( $post_id, '_vp_portfolio_medias', true );
	$old_media = get_post_meta( $post_id, '_vp_portfolio_images', true );
	$is_new    = ( $new_media !== '' and array_key_exists( 'mode', $new_media ) );

	if( ! $is_new ) {
		// normalize data
		$old_media['mode'] = 'image';
		// save meta to the new meta id
		if( update_post_meta( $post_id, '_vp_portfolio_medias', $old_media ) ) {
			// delete the old one
			delete_post_meta( $post_id, '_vp_portfolio_images' );
		}
	}
}

/**
 * EOF
 */
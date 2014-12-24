<?php
/**
 * VP_PF_Portfolio class.
 *
 * @class           VP_PF_Portfolio
 * @since           0.1
 * @category        Class
 * @author          Vafpress
 */

if( ! defined( 'ABSPATH' ) ) exit; // exit on direct access

if( ! class_exists( 'VP_PF_Portfolio' ) ) :

class VP_PF_Portfolio {

	protected static $_instance;

	public static function instance() {
		if(is_null(self::$_instance))
		{
			self::$_instance = new self();
		}
		return self::$_instance;
	}

	public function __construct() {
		add_action( 'init'     , array( $this, 'register_post_and_taxonomies' ) );
		add_action( 'save_post', array( $this, 'save_meta_title_pool' ) );
	}

	public function register_post_and_taxonomies() {
		$args = array(
	    	'labels'            => array(
				'name'               => __( 'Portfolios', 'vp_portfolio' ),
				'singular_name'      => __( 'Portfolio', 'vp_portfolio' ),
				'add_new'            => __( 'Add New', 'vp_portfolio' ),
				'add_new_item'       => __( 'Add New Portfolio', 'vp_portfolio' ),
				'edit_item'          => __( 'Edit Portfolio', 'vp_portfolio' ),
				'new_item'           => __( 'Add New', 'vp_portfolio' ),
				'all_items'          => __( 'All Portfolios', 'vp_portfolio' ),
				'view_item'          => __( 'View Portfolio', 'vp_portfolio' ),
				'search_items'       => __( 'Search Portfolio', 'vp_portfolio' ),
				'not_found'          => __( 'No portfolio found', 'vp_portfolio' ),
				'not_found_in_trash' => __( 'No portfolio found in trash', 'vp_portfolio' ),
				'parent_item_colon'  => __( '', 'vp_portfolio' ),
				'menu_name'          => __( 'Portfolios', 'vp_portfolio' ),
				'parent'             => __( 'Parent Portfolio', 'portfolio' ),
			),
	    	'public'            => true,	
			'supports'          => array( 'title', 'editor', 'author', 'post_thumbnail', 'thumbnail', 'custom-fields' ),
			'capability_type'   => 'post',
			'rewrite'           => array(
				'slug'       => vp_pf_option('post_rewrite_slug', 'portfolio'),
				'with_front' => vp_pf_option('post_rewrite_with_front', false),
			),
			'has_archive'       => true
		);
		$args = apply_filters('vp_pf_post_type_args', $args);
		register_post_type( 'portfolio', $args );

		$args = array(
			'labels'                     => array(
				'name'                       => _x( 'Portfolio Categories', 'Taxonomy General Name', 'vp_portfolio' ),
				'singular_name'              => _x( 'Portfolio Category', 'Taxonomy Singular Name', 'vp_portfolio' ),
				'menu_name'                  => __( 'Portfolio Categories', 'vp_portfolio' ),
				'all_items'                  => __( 'All Portfolio Categories', 'vp_portfolio' ),
				'parent_item'                => __( 'Parent Portfolio Category', 'vp_portfolio' ),
				'parent_item_colon'          => __( 'Parent Portfolio Category:', 'vp_portfolio' ),
				'new_item_name'              => __( 'New Portfolio Category Name', 'vp_portfolio' ),
				'add_new_item'               => __( 'Add New Portfolio Category', 'vp_portfolio' ),
				'edit_item'                  => __( 'Edit Portfolio Category', 'vp_portfolio' ),
				'update_item'                => __( 'Update Portfolio Category', 'vp_portfolio' ),
				'separate_items_with_commas' => __( 'Separate Portfolio Categories with commas', 'vp_portfolio' ),
				'search_items'               => __( 'Search Portfolio Categories', 'vp_portfolio' ),
				'add_or_remove_items'        => __( 'Add or remove Portfolio Categories', 'vp_portfolio' ),
				'choose_from_most_used'      => __( 'Choose from the most used Portfolio Categories', 'vp_portfolio' ),
			),
			'hierarchical'               => true,
			'public'                     => true,
			'show_ui'                    => true,
			'show_admin_column'          => true,
			'show_in_nav_menus'          => true,
			'show_tagcloud'              => true,
			'rewrite'           => array(
				'slug'       => vp_pf_option('category_rewrite_slug', 'portfolio-category'),
				'with_front' => vp_pf_option('category_rewrite_with_front', false),
			),
		);
		$args = apply_filters('vp_pf_category_taxonomy_args', $args);
		register_taxonomy( 'portfolio_category', 'portfolio', $args );

		$args = array(
			'labels'                     => array(
				'name'                       => _x( 'Portfolio Tags', 'Taxonomy General Name', 'vp_portfolio' ),
				'singular_name'              => _x( 'Portfolio Tag', 'Taxonomy Singular Name', 'vp_portfolio' ),
				'menu_name'                  => __( 'Portfolio Tags', 'vp_portfolio' ),
				'all_items'                  => __( 'All Portfolio Tags', 'vp_portfolio' ),
				'parent_item'                => __( 'Parent Portfolio Tag', 'vp_portfolio' ),
				'parent_item_colon'          => __( 'Parent Portfolio Tag:', 'vp_portfolio' ),
				'new_item_name'              => __( 'New Portfolio Tag Name', 'vp_portfolio' ),
				'add_new_item'               => __( 'Add New Portfolio Tag', 'vp_portfolio' ),
				'edit_item'                  => __( 'Edit Portfolio Tag', 'vp_portfolio' ),
				'update_item'                => __( 'Update Portfolio Tag', 'vp_portfolio' ),
				'separate_items_with_commas' => __( 'Separate Portfolio Tags with commas', 'vp_portfolio' ),
				'search_items'               => __( 'Search Portfolio Tags', 'vp_portfolio' ),
				'add_or_remove_items'        => __( 'Add or remove Tag Categories', 'vp_portfolio' ),
				'choose_from_most_used'      => __( 'Choose from the most used Portfolio Tags', 'vp_portfolio' ),
			),
			'hierarchical'               => false,
			'public'                     => true,
			'show_ui'                    => true,
			'show_admin_column'          => true,
			'show_in_nav_menus'          => true,
			'show_tagcloud'              => true,
			'rewrite'           => array(
				'slug'       => vp_pf_option('tag_rewrite_slug', 'portfolio-tag'),
				'with_front' => vp_pf_option('tag_rewrite_with_front', false),
			),
		);
		$args = apply_filters('vp_pf_tag_taxonomy_args', $args);
		register_taxonomy( 'portfolio_tag', 'portfolio', $args );

	}

	public function save_meta_title_pool($post_id) {		
		// check autosave
		if (defined('DOING_AUTOSAVE') AND DOING_AUTOSAVE) return $post_id;

		// make sure data came from our meta box, verify nonce
		$nonce = isset($_POST[VP_PF_MB_INFO_ID . '_nonce']) ? $_POST[VP_PF_MB_INFO_ID . '_nonce'] : NULL ;
		if (!wp_verify_nonce($nonce, VP_PF_MB_INFO_ID)) return $post_id;

		// check user permissions
		if ($_POST['post_type'] == 'portfolio') 
		{
			if (!current_user_can('edit_page', $post_id)) return $post_id;
		}
		else
		{
			if (!current_user_can('edit_post', $post_id)) return $post_id;
		}

		// authentication passed, process data
		$meta_data = isset( $_POST[VP_PF_MB_INFO_ID] ) ? $_POST[VP_PF_MB_INFO_ID] : NULL ;

		if( isset( $meta_data['info'] ) )
		{
			$this->normalize( $post_id, $meta_data );
		}
	}

	public function normalize( $post_id, $data = null ) {
		if( !is_null( $data ) )
			$meta_data = $data['info'];
		else
			$meta_data = vp_metabox( VP_PF_MB_INFO_ID . '.info', null, $post_id );

		// if there is valid info meta data
		if( !is_null( $meta_data ) )
		{
			$q_titles = vp_pf_option('queryable_titles', '');
			$q_titles = preg_split('/[\s,]+/', $q_titles);

			foreach ($meta_data as $info)
			{
				if( !isset($info['tocopy']) )
				{
					if( in_array($info['title'], $q_titles) )
					{
						$title = sanitize_title( $info['title'] );
						if( !empty($title) )
						{
							$info['title'] = 'vp_pf_' . $title;
							update_post_meta( $post_id, $info['title'], $info['content'] );
						}
					}
				}
			}

			$metas    = $this->get_queryable_meta( $post_id );
			$q_titles = array_map( array( $this, 'prefix_sanitize' ), $q_titles );

			foreach ($metas as $meta)
			{
				if( !in_array($meta['meta_key'], $q_titles) )
				{
					delete_post_meta( $post_id, $meta['meta_key'] );
				}
			}
		}
	}

	public function prefix_sanitize( $value ) {
		return 'vp_pf_' . sanitize_title( $value );
	}

	public function get_queryable_meta( $post_id ) {
		global $wpdb;
		$querystr = "
			SELECT $wpdb->postmeta.meta_key
			FROM $wpdb->posts, $wpdb->postmeta
			WHERE $wpdb->posts.ID = $post_id
			AND $wpdb->posts.ID = $wpdb->postmeta.post_id 
			AND $wpdb->postmeta.meta_key LIKE 'vp_pf_%' 
			AND $wpdb->posts.post_type = 'portfolio'
			ORDER BY $wpdb->posts.post_date DESC
		";

		$pageposts = $wpdb->get_results($querystr, ARRAY_A);
		return $pageposts;
	}

	public function count() {
		$args = array (
			'post_type'      => 'portfolio',
			'posts_per_page' => '-1',
			'suppress_filters'=> true
		);
		$query = new WP_Query( $args );
		$found = $query->found_posts;
		return $found;
	}

	public function get_all_ids() {
		$args = array (
			'post_type'      => 'portfolio',
			'posts_per_page' => '-1',
			'fields'         => 'ids',
			'suppress_filters'=> true
		);
		$query = new WP_Query( $args );
		$posts = $query->get_posts();
		return $posts;
	}

	public function get_media_type() {
		global $post;

		$medias = vp_metabox( VP_PF_MB_MEDIAS_ID );
		if( $medias !== null and $medias->meta !== '' ) {
			return vp_metabox( VP_PF_MB_MEDIAS_ID . '.mode' );
		} else { // pre version 0.2 fallback
			return 'image';
		}		
	}

	public function get_media() {
		global $post;
		
		$medias = vp_metabox( VP_PF_MB_MEDIAS_ID );
		if( $medias !== null and $medias->meta !== '' ) {
			$type   = vp_metabox( VP_PF_MB_MEDIAS_ID . '.mode' );
			$medias = $medias->meta[$type];
		} else { // pre version 0.2 fallback
			$type   = 'image';
			$medias = get_post_meta($post->ID, '_vp_portfolio_images', true);
			$medias = $medias[$type];
		}
		return array(
			'mode'  => $type,
			'media' => $medias
		);
	}

}

endif;

VP_PF_Portfolio::instance();

/**
 * EOF
 */
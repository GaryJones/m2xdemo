<?php

class Widget_Willow_Social_Links extends WP_Widget {

	function __construct() {
		parent::__construct(
			'willow_social_links',
			__( 'Willow: Social Links', 'willow' ),
			array( 'description' => __( 'Display Social Links Set', 'willow' ) )
		);

		add_action( 'save_post', array( $this, 'flush_widget_cache' ) );
		add_action( 'deleted_post', array( $this, 'flush_widget_cache' ) );
		add_action( 'switch_theme', array( $this, 'flush_widget_cache' ) );
	}

	public function widget( $args, $instance ) {
		$cache = wp_cache_get( 'widget_willow_social_links', 'widget' );

		if ( ! is_array( $cache ) ) $cache = array();

		if ( ! isset( $args['widget_id'] ) ) $args['widget_id'] = $this->id;

		if ( isset( $cache[ $args['widget_id'] ] ) ) {
			echo $cache[ $args['widget_id'] ];
			return;
		}

		$title = apply_filters( 'widget_title', $instance['title'] );
		$links = $instance['links'];

		if ( empty( $links ) ) return;
		else $links = preg_split( "/\\r\\n|\\r|\\n/", $links );

		ob_start();

		echo $args['before_widget'];
		echo ( ! empty( $title ) ) ? $args['before_title'] . $title . $args['after_title'] : ''; ?>
		<ul class="social-media-links">
			<?php foreach ( $links as $value ) : ?>
				<?php $link = willow_option( 'social_media_' . $value, null ); if ( empty( $link ) ) continue; ?>
				<li>
					<a href="<?php echo $link; ?>">
						<i class="fa fa-<?php echo $value; ?>"></i><span class="hidden"><?php echo $value; ?></span>
					</a>
				</li>
			<?php endforeach; ?>
		</ul>
		<?php echo $args['after_widget'];

		$cache[ $args['widget_id'] ] = ob_get_flush();
		
		wp_cache_set( 'widget_willow_social_links', $cache, 'widget' );
	}

	public function form( $instance ) {
		$title = isset( $instance['title'] ) ? esc_attr( $instance['title'] ) : '';
		$links = isset( $instance['links'] ) ? esc_attr( $instance['links'] ) : 
		'facebook
		twitter
		linkedin';
		
		?>
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:', 'willow' ); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo $title; ?>" />
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 'links' ); ?>"><?php _e( 'Link slugs (line break separated):', 'willow' ); ?></label>
			<textarea class="widefat" id="<?php echo $this->get_field_id( 'links' ); ?>" name="<?php echo $this->get_field_name( 'links' ); ?>" rows="5"><?php echo $links; ?></textarea>
			<small><?php _e( 'First, you need to set the links on Theme Options > Social Media, and do not put something like this "facebook: http://facebook.com", please put the social media type only e.g. "facebook".', 'willow' ); ?></small>
		</p>
		<?php
	}

	public function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['links'] = $new_instance['links'];
		$this->flush_widget_cache();

		return $instance;
	}

	function flush_widget_cache() {
		wp_cache_delete( 'willow_social_links', 'widget' );
	}

}

// register
function register_widget_willow_social_links() {
    register_widget( 'Widget_Willow_Social_Links' );
}
add_action( 'widgets_init', 'register_widget_willow_social_links' );
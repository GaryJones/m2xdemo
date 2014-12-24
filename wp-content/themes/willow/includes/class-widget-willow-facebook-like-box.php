<?php

class Widget_Willow_Facebook_Like_Box extends WP_Widget {

	function __construct() {
		parent::__construct(
			'willow_facebook_like_box',
			__( 'Willow: Facebook Like Box', 'willow' ),
			array( 'description' => __( 'Facebook Like Box', 'willow' ) )
		);

		add_action( 'save_post', array( $this, 'flush_widget_cache' ) );
		add_action( 'deleted_post', array( $this, 'flush_widget_cache' ) );
		add_action( 'switch_theme', array( $this, 'flush_widget_cache' ) );
	}

	public function widget( $args, $instance ) {
		$cache = wp_cache_get( 'widget_willow_facebook_like_box', 'widget' );

		if ( ! is_array( $cache ) ) $cache = array();

		if ( ! isset( $args['widget_id'] ) ) $args['widget_id'] = $this->id;

		if ( isset( $cache[ $args['widget_id'] ] ) ) {
			echo $cache[ $args['widget_id'] ];
			return;
		}

		$title = apply_filters( 'widget_title', $instance['title'] );
		$url = $instance['url']; if ( empty( $url ) ) return;
		$height = $instance['height']; if ( empty( $height ) ) $height = 558;
		$show_faces = $instance['show_faces']; if ( empty( $show_faces ) ) $show_faces = false;
		$show_posts = $instance['show_posts']; if ( empty( $show_posts ) ) $show_posts = false;

		ob_start();

		echo $args['before_widget'];
		echo ( ! empty( $title ) ) ? $args['before_title'] . $title . $args['after_title'] : ''; ?>
		<div class="fb-like-box">
			<iframe src="//www.facebook.com/plugins/likebox.php?href=<?php echo esc_url( $url ); ?>&amp;width=300&amp;height=<?php echo $height; ?>&amp;colorscheme=light&amp;show_faces=<?php echo ( $show_faces ) ? 'true' : 'false'; ?>&amp;header=false&amp;stream=<?php echo ( $show_posts ) ? 'true' : 'false'; ?>&amp;show_border=false&amp;appId=1461883470698515" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:300px; height:<?php echo $height; ?>px;" allowTransparency="true"></iframe>
		</div>
		<?php echo $args['after_widget'];

		$cache[ $args['widget_id'] ] = ob_get_flush();

		wp_cache_set( 'widget_willow_facebook_like_box', $cache, 'widget' );
	}

	public function form( $instance ) {
		$title      = isset( $instance['title'] ) ? esc_attr( $instance['title'] ) : '';
		$url        = isset( $instance['url'] ) ? $instance['url'] : '';
		$height     = isset( $instance['height'] ) ? absint( $instance['height'] ) : 558;
		$show_faces = isset( $instance['show_faces'] ) ? (bool) $instance['show_faces'] : false;
		$show_date  = isset( $instance['show_posts'] ) ? (bool) $instance['show_posts'] : false;
		
		?>
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:', 'willow' ); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo $title; ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'url' ); ?>"><?php _e( 'Facebook Page URL:', 'willow' ); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'url' ); ?>" name="<?php echo $this->get_field_name( 'url' ); ?>" type="text" value="<?php echo $url; ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'height' ); ?>"><?php _e( 'Height in px:', 'willow' ); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'height' ); ?>" name="<?php echo $this->get_field_name( 'height' ); ?>" type="text" value="<?php echo $height; ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'show_faces' ); ?>">
				<input class="checkbox" id="<?php echo $this->get_field_id( 'show_faces' ); ?>" type="checkbox" <?php checked( $show_faces ); ?> name="<?php echo $this->get_field_name( 'show_faces' ); ?>" />
				<?php _e( 'Show Faces?', 'willow' ); ?>
			</label>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'show_posts' ); ?>">
				<input class="checkbox" id="<?php echo $this->get_field_id( 'show_posts' ); ?>" type="checkbox" <?php checked( $show_posts ); ?> name="<?php echo $this->get_field_name( 'show_posts' ); ?>" />
				<?php _e( 'Show Posts?', 'willow' ); ?>
			</label>
		</p>
		<?php
	}

	public function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['url'] = $new_instance['url'];
		$instance['height'] = (int) $new_instance['height'];
		$instance['show_faces'] = (bool) $new_instance['show_faces'];
		$instance['show_posts'] = (bool) $new_instance['show_posts'];
		$this->flush_widget_cache();

		return $instance;
	}

	function flush_widget_cache() {
		wp_cache_delete( 'willow_facebook_like_box', 'widget' );
	}

}

// register
function register_widget_willow_facebook_like_box() {
    register_widget( 'Widget_Willow_Facebook_Like_Box' );
}
add_action( 'widgets_init', 'register_widget_willow_facebook_like_box' );
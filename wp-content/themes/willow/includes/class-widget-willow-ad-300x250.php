<?php

class Widget_Willow_Ad_300x250 extends WP_Widget {

	function __construct() {
		parent::__construct(
			'willow_ad_300x250',
			__( 'Willow: Ad 300x250', 'willow' ),
			array( 'description' => __( 'Ad 300x250', 'willow' ) )
		);

		add_action( 'save_post', array( $this, 'flush_widget_cache' ) );
		add_action( 'deleted_post', array( $this, 'flush_widget_cache' ) );
		add_action( 'switch_theme', array( $this, 'flush_widget_cache' ) );
	}

	public function widget( $args, $instance ) {
		$cache = wp_cache_get( 'widget_willow_ad_300x250', 'widget' );

		if ( ! is_array( $cache ) ) $cache = array();

		if ( ! isset( $args['widget_id'] ) ) $args['widget_id'] = $this->id;

		if ( isset( $cache[ $args['widget_id'] ] ) ) {
			echo $cache[ $args['widget_id'] ];
			return;
		}

		$title = apply_filters( 'widget_title', $instance['title'] );
		$code = $instance['code'];

		if ( empty( $code ) ) return;

		ob_start();

		echo $args['before_widget'];
		echo ( ! empty( $title ) ) ? $args['before_title'] . $title . $args['after_title'] : ''; ?>
		<div class="ad ad-300x250">
			<?php echo $code; ?>
		</div>
		<?php echo $args['after_widget'];

		$cache[ $args['widget_id'] ] = ob_get_flush();
		
		wp_cache_set( 'widget_willow_ad_300x250', $cache, 'widget' );
	}

	public function form( $instance ) {
		$title = isset( $instance['title'] ) ? esc_attr( $instance['title'] ) : '';
		$code = isset( $instance['code'] ) ? esc_attr( $instance['code'] ) : '';
		
		?>
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:', 'willow' ); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo $title; ?>" />
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 'code' ); ?>"><?php _e( 'Link slugs (enter separated):', 'willow' ); ?></label>
			<textarea class="widefat" id="<?php echo $this->get_field_id( 'code' ); ?>" name="<?php echo $this->get_field_name( 'code' ); ?>" rows="5"><?php echo $code; ?></textarea>
		</p>
		<?php
	}

	public function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['code'] = $new_instance['code'];
		$this->flush_widget_cache();

		return $instance;
	}

	function flush_widget_cache() {
		wp_cache_delete( 'willow_ad_300x250', 'widget' );
	}

}

// register
function register_widget_willow_ad_300x250() {
    register_widget( 'Widget_Willow_Ad_300x250' );
}
add_action( 'widgets_init', 'register_widget_willow_ad_300x250' );
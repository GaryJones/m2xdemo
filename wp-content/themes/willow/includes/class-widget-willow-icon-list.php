<?php

class Widget_Willow_Icon_List extends WP_Widget {

	function __construct() {
		parent::__construct(
			'willow_icon_list',
			__( 'Willow: Icon List', 'willow' ),
			array( 'description' => __( 'Display Icon List Set', 'willow' ) )
		);

		add_action( 'save_post', array( $this, 'flush_widget_cache' ) );
		add_action( 'deleted_post', array( $this, 'flush_widget_cache' ) );
		add_action( 'switch_theme', array( $this, 'flush_widget_cache' ) );
	}

	public function widget( $args, $instance ) {
		$cache = wp_cache_get( 'widget_willow_icon_list', 'widget' );

		if ( ! is_array( $cache ) ) $cache = array();

		if ( ! isset( $args['widget_id'] ) ) $args['widget_id'] = $this->id;

		if ( isset( $cache[ $args['widget_id'] ] ) ) {
			echo $cache[ $args['widget_id'] ];
			return;
		}

		$title = apply_filters( 'widget_title', $instance['title'] );
		$items = $instance['items'];

		if ( empty( $items ) ) return;
		else $items = preg_split( "/\\r\\n|\\r|\\n/", $items );

		$dl = array();
		foreach ( $items as $item ) {
			if ( empty( $item ) ) continue;
			$item = preg_replace( "/(^)?(<br\s*\/?>\s*)+$/", "", $item );
			$arr = explode( ':' , $item, 2 );
			$arr = array_map( 'trim', $arr );
			$dl[] = array( 'icon' => $arr[0], 'content' => $arr[1] );
		}

		ob_start();

		echo $args['before_widget'];
		echo ( ! empty( $title ) ) ? $args['before_title'] . $title . $args['after_title'] : ''; ?>
		<dl class="dl-icon">
			<?php foreach ( $dl as $item ) : ?>
				<dt><span class="<?php echo $item[icon]; ?>"></span></dt>
				<dd><?php echo $item['content']; ?></dd>
			<?php endforeach; ?>
		</dl>
		<?php echo $args['after_widget'];

		$cache[ $args['widget_id'] ] = ob_get_flush();
		
		wp_cache_set( 'widget_willow_icon_list', $cache, 'widget' );
	}

	public function form( $instance ) {
		$title = isset( $instance['title'] ) ? esc_attr( $instance['title'] ) : '';
		$items = isset( $instance['items'] ) ? esc_attr( $instance['items'] ) : 
		'fa fa-globe: This is FontAwesome globe
		linecons li_heart: This is Linecons heart';
		
		?>
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:', 'willow' ); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo $title; ?>" />
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 'items' ); ?>"><?php _e( 'Items (line break separated):', 'willow' ); ?></label>
			<textarea class="widefat" id="<?php echo $this->get_field_id( 'items' ); ?>" name="<?php echo $this->get_field_name( 'items' ); ?>" rows="5"><?php echo $items; ?></textarea>
			<small><?php _e( 'You can input <a href="http://fontawesome.io/">FontAwesome</a>, or <a href="http://solopine.com/icons/linecons">Linecons</a> icons. And please do not forget to include the provider prefix. For example:<br/><br/>if you use "fa-globe" from FontAwesome, it should be "fa fa-globe".<br/><br/>if you use "li_heart" from Linecons, it should be "linecons li_heart".', 'willow' ); ?></small>
		</p>
		<?php
	}

	public function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['items'] = $new_instance['items'];
		$this->flush_widget_cache();

		return $instance;
	}

	function flush_widget_cache() {
		wp_cache_delete( 'willow_icon_list', 'widget' );
	}

}

// register
function register_widget_willow_icon_list() {
    register_widget( 'Widget_Willow_Icon_List' );
}
add_action( 'widgets_init', 'register_widget_willow_icon_list' );
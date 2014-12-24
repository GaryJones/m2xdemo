<?php
$pages_with_sidebar = willow_option( 'pages_with_sidebar', array() );
$native_types = array( 'blog_index', 'blog_archive', 'portfolio_index', 'portfolio_single', 'search' );

if ( is_search() )                             { $type = 'search'; }
elseif ( is_post_type_archive( 'portfolio' ) ) { $type = 'portfolio_index'; }
elseif ( is_singular( 'portfolio' ) )          { $type = 'portfolio_single'; }
elseif ( is_page() )                           { $type = 'page_single'; }
elseif ( is_home() )                           { $type = 'blog_index'; }
elseif ( is_archive() )                        { $type = 'blog_archive'; }
elseif ( is_single() )                         { $type = 'blog_single'; }
else                                           { $type = ''; }

if ( empty( $type ) ) {
	// No page title
	$show_sidebar = false;
} elseif ( 'page_single' == $type ) {
	// if page
	// this is called by the active page template, so yes!
	$show_sidebar = true;
} elseif ( in_array( $type, $native_types ) || -1 == willow_post_option( 'enable_sidebar', -1 ) || is_null( willow_post_option( 'enable_sidebar', -1 ) ) ) {
	// if doesn't have metabox value (native pages or unset metabox value)
	// or native pages
	// inherit from theme options
	$show_sidebar = in_array( $type, $pages_with_sidebar );
} else {
	// there is a specific setting for current page
	$show_sidebar = willow_post_option( 'enable_sidebar', 1 );
}

if ( $show_sidebar ) : ?>
	<div class="aside-section">
		<aside id="sidebar" class="sidebar">
			<?php dynamic_sidebar( 'content-sidebar' ); ?>
		</aside>
	</div>
<?php endif; ?>
<!DOCTYPE html>
<html <?php language_attributes(); ?> class="<?php echo Mobile_Detect::is_mobile_or_tablet() ? 'small-device' : 'large-device'; ?>">

	<head>
		<meta charset="<?php bloginfo('charset'); ?>" />
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="apple-mobile-web-app-capable" content="yes">
		<meta http-equiv="X-UA-Compatible" content="IE=edge" />
		<title>
			<?php wp_title( '|', true, 'right' ); ?>
		</title>
		<link rel="profile" href="http://gmpg.org/xfn/11" />
		<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
		
		<?php
		$favicon = willow_option( 'favicon' );
		$favicon_iphone = willow_option( 'favicon_iphone' );
		$favicon_ipad = willow_option( 'favicon_ipad' );
		?>
		<?php if ( !empty( $favicon ) ) : ?>
		<link rel="shortcut icon" href="<?php echo $favicon; ?>" />
		<?php endif; ?>
		<?php if ( !empty( $favicon_iphone ) ) : ?>
		<link rel="apple-touch-icon" sizes="60x60" href="<?php echo $favicon_iphone; ?>" />
		<?php endif; ?>
		<?php if ( !empty( $favicon_iphone_retina ) ) : ?>
		<link rel="apple-touch-icon" sizes="120x120" href="<?php echo $favicon_iphone_retina; ?>" />
		<?php endif; ?>
		<?php if ( !empty( $favicon_ipad ) ) : ?>
		<link rel="apple-touch-icon" sizes="76x76" href="<?php echo $favicon_ipad; ?>" />
		<?php endif; ?>
		<?php if ( !empty( $favicon_ipad_retina ) ) : ?>
		<link rel="apple-touch-icon" sizes="152x152" href="<?php echo $favicon_ipad_retina; ?>" />
		<?php endif; ?>

		<?php wp_head(); ?>
	</head>

	<?php $preloader_class = ''; if ( willow_option( 'enable_preloader', 1 ) ) $preloader_class .= 'js-preloader'; ?>

	<body <?php body_class( $preloader_class ); ?>>

		<div id="document" class="document portfolio-iframe">

			<header id="header" class="header-section section navbar navbar-default header-floating" role="navigation">
				<div class="container-fluid">

					<div class="navbar-header portfolio-ajax-header">
						<a class="navbar-brand site-logo" href="<?php echo home_url(); ?>">
							<?php if ( willow_option( 'header_logo' ) ) : ?>
								<img src="<?php echo willow_option( 'header_logo' ); ?>" alt="<?php bloginfo( 'name' ); ?>" />
							<?php else : ?>
								<span><?php bloginfo( 'name' ); ?></span>
							<?php endif ?>
						</a>
					</div>
					
					<div class="header-navigation" id="header-navigation">

						<div class="header-separator pull-left visible-md visible-lg"></div>
						
						<ul class="nav navbar-nav portfolio-ajax-nav pull-right">
							<li>
								<a href="#" class="popup-document-close-button js-close-magnificpopup">
									<span class="hidden"><?php _e( 'Close', 'willow' ); ?></span>
								</a>
							</li>
						</ul>

						<div class="header-separator pull-right visible-md visible-lg"></div>						

						<ul class="nav navbar-nav portfolio-ajax-nav portfolio-ajax-pager">
							<?php $next = get_next_post(); if ( ! empty( $next ) ) : ?>
								<li class="previous pull-left">
									<a href="<?php echo add_query_arg( 'iframe', '1', get_permalink( $next->ID ) ); ?>"><?php _e( '&larr; Next <span class="hidden-xs">Project</span>', 'willow' ); ?></a>
								</li>
							<?php endif; ?>

							<?php $prev = get_previous_post(); if ( ! empty( $prev ) ) : ?>
								<li class="next pull-right">
									<a href="<?php echo add_query_arg( 'iframe', '1', get_permalink( $prev->ID ) ); ?>"><?php _e( 'Previous <span class="hidden-xs">Project</span> &rarr;', 'willow' ); ?></a>
								</li>
							<?php endif; ?>
						</ul>

					</div>

				</div>
			</header>

			<div class="header-floating-anchor"></div>
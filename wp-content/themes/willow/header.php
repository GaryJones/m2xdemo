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

		<!-- BEGIN CUSTOM HEADER SCRIPTS -->
		<?php echo willow_kses( willow_option( 'head_script' ) ); ?>
		<!-- END CUSTOM HEADER SCRIPTS -->

		<?php wp_head(); ?>
	</head>

	<?php $preloader_class = ''; if ( willow_option( 'enable_preloader', 1 ) ) $preloader_class .= 'js-preloader'; ?>

	<body <?php body_class( $preloader_class ); ?>>

		<?php
		$enable_hero_section = willow_page_option( 'enable_hero_section', null );
		$enable_parallax = willow_page_option( 'hero_section.0.enable_parallax', null );
		$background_overlay = willow_page_option( 'hero_section.0.background_overlay', null );
		$hero_slides = willow_page_option( 'hero_section.0.slides', array() );
		$enable_hero_logo = willow_page_option( 'hero_section.0.enable_hero_logo', 0 );
		$hero_slides_interval = willow_page_option( 'hero_section.0.interval', 0 );

		if ( $enable_parallax ) wp_enqueue_script( 'jquery-parallax' ); ?>

		<?php if ( $enable_hero_section ) : ?>

			<?php wp_enqueue_script( 'jquery-caroufredsel' ); ?>

			<section id="hero" class="hero-section section">

				<?php if ( $enable_hero_logo && count( $hero_slides ) > 0 ) : ?>
					<div class="hero-logo site-logo text-center hidden-xs">
						<?php $logo = willow_option( 'hero_logo' ); ?>
						<?php if ( ! empty( $logo ) ) : ?>
							<img src="<?php echo $logo; ?>" alt="<?php bloginfo( 'name' ); ?>" />
						<?php else : ?>
							<span><?php bloginfo( 'name' ); ?></span>
						<?php endif ?>
					</div>
				<?php endif; ?>

				<?php $has_video = false; ?>
				<ul class="section-background-slider caroufredsel js-caroufredsel <?php echo ( ! empty( $background_overlay ) ) ? $background_overlay : ''; ?>" data-caroufredsel="hero-slider"<?php echo willow_data_printer(array('interval' => $hero_slides_interval)); ?>>
					<?php foreach ( $hero_slides as $i => $slide_id ) : ?>

						<?php
						/**
						 * Get Settings
						 */
						
						$media = willow_hero_slide_option( 'background_media', 'image', $slide_id );
						$color_scheme = willow_hero_slide_option( 'color_scheme', 'dark', $slide_id );
						$text_style = willow_hero_slide_option( 'text_style', 'style-1', $slide_id );
						$top_text = willow_hero_slide_option( 'top_text', '', $slide_id );
						$middle_text = willow_hero_slide_option( 'middle_text', '', $slide_id );
						$middle_text_interval = willow_hero_slide_option( 'mt_interval', 5000, $slide_id );
						$bottom_text = willow_hero_slide_option( 'bottom_text', '', $slide_id );
						$button_text = willow_hero_slide_option( 'button_text', '', $slide_id );
						$button_link = willow_hero_slide_option( 'button_link', '#', $slide_id );
						$button_2_text = willow_hero_slide_option( 'button_2_text', '', $slide_id );
						$button_2_link = willow_hero_slide_option( 'button_2_link', '#', $slide_id );
						$css_animation = willow_hero_slide_option( 'css_animation', '', $slide_id );

						// middle text interval normalization
						if( empty( $middle_text_interval ) ) $middle_text_interval = 5000;
						if( $middle_text_interval < 1000 ) $middle_text_interval = 1000;

						?>

						<?php
						/**
						 * Buffering Slide Content
						 */
						
						ob_start(); ?>
						<div class="hero-text container">
							<div class="hero-text-table">
								<div class="hero-text-table-cell text-center">

									<div class="hero-text-content animate_css animated <?php echo $css_animation; ?>">
										<?php if ( willow_dependency_hero_slide_top_text( $text_style ) && ! empty( $top_text ) ) : ?>
											<div class="hero-top-text"><span><?php echo $top_text; ?></span></div>
										<?php endif; ?>

										<?php if ( willow_dependency_hero_slide_middle_text( $text_style ) && ! empty( $middle_text ) ) : ?>
											<div class="hero-middle-text js-fittext">
												<?php $texts = preg_split( "/\\r\\n|\\r|\\n/", $middle_text ); ?>

												<?php if ( count( $texts ) > 1 ) : ?>
													<ul class="text-rotator" <?php echo willow_data_printer(array('interval' => $middle_text_interval)); ?>>
														<?php foreach ( $texts as $text ) : ?>
															<li><span><?php echo $text; ?></span></li>
														<?php endforeach; ?>
													</ul>
												<?php else : ?>
													<span><?php echo $middle_text; ?></span>
												<?php endif; ?>
											</div>
										<?php endif; ?>

										<?php if ( willow_dependency_hero_slide_bottom_text( $text_style ) && ! empty( $bottom_text ) ) : ?>
											<div class="hero-bottom-text"><span><?php echo $bottom_text; ?></span></div>
										<?php endif; ?>
									</div>

									<div class="hero-buttons <?php echo ( $text_style == 'style-3' ) ? 'animate_css animated ' . $css_animation : ''; ?>">
										<?php if ( willow_dependency_hero_slide_button( $text_style ) && ! empty( $button_text ) ) : ?>
											<a href="<?php echo $button_link; ?>" class="btn btn-hero-default js-anchor-link"><?php echo $button_text; ?></a>
										<?php endif; ?>

										<?php if ( willow_dependency_hero_slide_button_2( $text_style ) && ! empty( $button_2_text ) ) : ?>
											<a href="<?php echo $button_2_link; ?>" class="btn btn-hero-primary js-anchor-link"><?php echo $button_2_text; ?></a>
										<?php endif; ?>
									</div>

								</div>
								
							</div>
						</div>
						<?php $slide_content = ob_get_clean(); ?>

						<?php
						/**
						 * Render Slide
						 */
						if ( $media == 'image' ) : ?>

							<?php
							$background_image = willow_hero_slide_option( 'background_image', null, $slide_id );
							$background_repeat = willow_hero_slide_option( 'background_repeat', '', $slide_id );
							?>
							<li class="<?php echo $enable_parallax ? 'parallax-background js-parallax' : ''; ?> <?php echo "$color_scheme-scheme hero-slide-$text_style"; ?>" style="background-image: url(<?php echo $background_image; ?>); <?php echo willow_build_background_repeat_style( $background_repeat ); ?>" data-parallax="background">
								<?php echo $slide_content; ?>
							</li>

						<?php elseif ( $media == 'video' ) : ?>

							<?php
							$video_source = willow_hero_slide_option( 'video_source', null, $slide_id );
							$video_source_webm = willow_hero_slide_option( 'video_source_webm', null, $slide_id );
							$video_source_ogg = willow_hero_slide_option( 'video_source_ogg', null, $slide_id );
							$video_poster = willow_hero_slide_option( 'video_poster', null, $slide_id );
							$video_ratio = willow_hero_slide_option( 'video_ratio', '16:9', $slide_id );
							$video_mute = willow_hero_slide_option( 'video_mute', false, $slide_id );
							$video_id = willow_generate_id( 'video-background-' );
							$has_video = true;
							?>

							<?php if ( Mobile_Detect::is_mobile_or_tablet() ) : ?>
								<li class="<?php echo $enable_parallax ? 'parallax-background js-parallax' : ''; ?> <?php echo "$color_scheme-scheme hero-slide-$text_style"; ?>" style="background-image: url(<?php echo $video_poster; ?>); background-size: cover; background-repeat: no-repeat; background-position: center center;" data-parallax="background">
									<?php echo $slide_content; ?>
								</li>
							<?php else : ?>
								<li class="<?php echo "$color_scheme-scheme hero-slide-$text_style"; ?>">

									<video id="<?php echo $video_id; ?>" class="<?php echo $enable_parallax ? 'parallax js-parallax' : ''; ?> video-background js-video-background" preload="none" loop="true" volume=<?php echo $video_mute ? 0 : 1 ;?> data-section="#hero" data-ratio="<?php echo $video_ratio; ?>" data-parallax="element">
										<?php if ( ! empty( $video_source ) ) : ?>
											<source src="<?php echo $video_source; ?>" type="video/mp4" />
										<?php endif; ?>
										
										<?php if ( ! empty( $video_source_webm ) ) : ?>
											<source src="<?php echo $video_source_webm; ?>" type="video/webm" />
										<?php endif; ?>
										
										<?php if ( ! empty( $video_source_ogg ) ) : ?>
											<source src="<?php echo $video_source_ogg; ?>" type="video/ogg" />
										<?php endif; ?>
									</video>
									<?php echo $slide_content; ?>
								</li>
							<?php endif; ?>

						<?php endif; ?>

					<?php endforeach; ?>
				</ul>

				<?php if ( $has_video ) : ?>
					<a href="#" class="video-volume-toggle <?php echo $video_mute ? '' : 'volume-active' ;?>"></a>
				<?php endif; ?>

				<div class="section-background-pagination caroufredsel-pagination">
					<?php foreach ( $hero_slides as $i => $slide_id ) : ?>
						<a href="#"></a>
					<?php endforeach; ?>
				</div>

			</section>
		<?php endif; ?>

		<div id="document" class="document">

			<header id="header" class="header-section section navbar navbar-default header-floating" role="navigation">
				<div class="container-fluid">

					<div class="navbar-header">
						<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#header-navigation">
							<span class="sr-only">Toggle navigation</span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
						</button>
						<a class="navbar-brand site-logo" href="<?php echo home_url(); ?>">
							<?php if ( willow_option( 'header_logo' ) ) : ?>
								<img src="<?php echo willow_option( 'header_logo' ); ?>" alt="<?php bloginfo( 'name' ); ?>" />
							<?php else : ?>
								<span><?php bloginfo( 'name' ); ?></span>
							<?php endif ?>
						</a>
					</div>
					

					<div class="collapse navbar-collapse header-navigation" id="header-navigation">

						<div class="header-separator pull-left visible-md visible-lg"></div>

						<?php wp_nav_menu( array(
							'theme_location'    => 'header-navigation',
							'depth'             => 0,
							'container'         => false,
							'menu_class'        => 'nav navbar-nav js-superfish sf-menu',
							'fallback_cb'       => 'Willow_Nav_Walker::fallback',
							'walker'            => new Willow_Nav_Walker(),
						) ); ?>
						
						<?php $social_media_links = willow_option( 'social_media_links', array() ); ?>

						<?php if ( ! empty( $social_media_links ) ) : ?>
							<ul class="social-media-links nav navbar-nav navbar-right">
								<?php foreach ( $social_media_links as $value ) : ?>
									<?php $link = willow_option( 'social_media_' . $value, null ); if ( empty( $link ) ) continue; ?>
									<li>
										<a href="<?php echo $link; ?>">
											<i class="fa fa-<?php echo $value; ?>"></i><span class="hidden"><?php echo $value; ?></span>
										</a>
									</li>
								<?php endforeach; ?>
							</ul>

							<div class="header-separator pull-right visible-md visible-lg"></div>

							<?php if ( willow_option( 'enable_wpml_language_switcher' ) ) : ?>

								<?php ob_start(); do_action( 'icl_language_selector' ); $language_switcher = ob_get_clean(); ?>

								<?php if ( ! empty( $language_switcher ) ) : ?>

								<ul class="wpml-switcher nav navbar-nav navbar-right">
									<li><?php echo $language_switcher; ?></li>
								</ul>

								<div class="header-separator pull-right visible-md visible-lg"></div>

								<?php endif; ?>

							<?php endif; ?>
							
						<?php endif; ?>

					</div>

				</div>
			</header>

			<div class="header-floating-anchor"></div>

			<?php
			$pages_with_title_section = willow_option( 'pages_with_title_section', array() );
			$native_types = array( 'blog_index', 'blog_archive', 'portfolio_index', 'portfolio_single', 'search' );

			if ( is_search() )                             { $type = 'search';           $title = __( 'Search Result', 'willow' ); }
			elseif ( is_post_type_archive( 'portfolio' ) ) { $type = 'portfolio_index';  $title = __( 'Portfolio', 'willow' ); }
			elseif ( is_singular( 'portfolio' ) )          { $type = 'portfolio_single'; $title = __( get_the_title(), 'willow' ); }
			elseif ( is_page() )                           { $type = 'page_single';      $title = __( get_the_title(), 'willow' ); }
			elseif ( is_home() )                           { $type = 'blog_index';       $title = ( get_option( 'show_on_front' ) === 'page' ) ? get_the_title( get_option( 'page_for_posts' ) ) : __( 'Blog', 'willow' ); }
			elseif ( is_archive() )                        { $type = 'blog_archive';     $title = __( 'Blog : ' . get_queried_object()->name, 'willow' ); }
			elseif ( is_single() )                         { $type = 'blog_single';      $title = __( get_the_title(), 'willow' ); }
			else                                           { $type = ''; }

			$title_section_background_image = willow_option( 'title_section_background_image' );
			$enable_parallax = willow_option( 'title_section_enable_parallax', 1 );
			$background_overlay = willow_option( 'title_section_background_overlay', '' );
			$background_repeat = willow_option( 'title_section_background_repeat', '' );

			if ( $enable_parallax ) wp_enqueue_script( 'jquery-parallax' );

			if ( empty( $type ) ) {
				// No page title
				$show_page_title = false;
			}
			elseif ( in_array( $type, $native_types ) || -1 == willow_page_option( 'enable_page_title_section', -1 ) || is_null( willow_page_option( 'enable_page_title_section', -1 ) ) ) {
				// if doesn't have metabox value (native pages or unset metabox value)
				// or blog index
				// inherit from theme options
				$show_page_title = in_array( $type, $pages_with_title_section );
			} else {
				// there is a specific setting for current page
				$show_page_title = willow_page_option( 'enable_page_title_section', 1 );
			}

			if ( $show_page_title ) : ?>
			<section id="title" class="title-section section <?php echo willow_option( 'title_section_color_scheme', 'dark' ); ?>-scheme">
				
				<?php if ( ! empty( $title_section_background_image ) ) : ?>
					<div class="section-background <?php echo ( ! empty( $background_overlay ) ) ? $background_overlay : ''; ?> <?php echo $enable_parallax ? 'parallax-background js-parallax' : ''; ?>" style="background-image: url(<?php echo $title_section_background_image; ?>); <?php echo willow_build_background_repeat_style( $background_repeat ); ?>;" data-parallax="background"></div>
				<?php endif; ?>

				<div class="container">
					<h1 class="wpb_willow_big_title wpb_content_element text-center">
						<div class="wpb_wrapper">
							<span><?php echo $title; ?></span>
						</div class="wpb_wrapper">
					</h1>
				</div>
			</section>
			<?php endif; ?>
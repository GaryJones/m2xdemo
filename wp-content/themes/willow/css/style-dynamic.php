<?php
/**
 * Fetch Variables
 */
$heading_font_face    = willow_option( 'heading_font_face' );
$body_font_face       = willow_option( 'body_font_face' );

$accent_color         = willow_option( 'accent_color' );

?>

/**
 * Change font family to body_font_face
 */
body {
	font-family: <?php echo $body_font_face; ?>;
}
/**
 * Change border color to accent color
 */
blockquote {
	border-color: <?php echo $accent_color; ?>;
}
/**
 * Change background color to accent color
 */
.btn.btn-primary,
.btn.btn-hero-primary,
.wpb_willow_service_block .service-icon span {
	background-color: <?php echo $accent_color; ?>;
}
/**
 * Change text color to accent color
 */
a,
h1 a:hover,
h2 a:hover,
h3 a:hover,
h4 a:hover,
h5 a:hover,
h6 a:hover,
.color-accent,
.widget-post .widget-post-title:hover,
.grid-post .grid-post-title:hover,
.widget ul li a:hover,
.widget .tagcloud a:hover,
.wpb_willow_progress_bar .progress-bar-thumb {
	color: <?php echo $accent_color; ?>;
}
/**
 * Change font family to heading_font_face
 */
h1,
h2,
h3,
h4,
h5,
h6,
button,
input[type="submit"],
input[type="reset"],
.btn,
.site-logo,
.separator-title,
.tagcloud a,
.hero-section .hero-slide-style-1 .hero-middle-text,
.hero-section .hero-slide-style-1 .hero-bottom-text,
.hero-section .hero-slide-style-2 .hero-middle-text,
.hero-section .hero-slide-style-2 .hero-bottom-text,
.hero-section .hero-slide-style-3 .hero-top-text,
.hero-section .hero-slide-style-3 .hero-middle-text,
.header-section .header-navigation,
.portfolio-details-section .portfolio-metadata dt,
.page-not-found h1,
.comments .comments-list li .comment-name,
.comments .comments-list li .comment-date,
.content-post .post-meta,
.content-post .post-title,
.content-post .post-pagination,
.widget-post .widget-post-date,
.grid-post .grid-post-title,
.grid-post .grid-post-date,
.widget .widget-title,
.wpb_willow_big_title,
.copyright-section .copyright-legal,
.wpb_willow_team_member_block .team-member-name,
.wpb_willow_team_member_block .team-member-position,
.wpb_willow_team_member_block .team-member-links label,
.wpb_willow_portfolio_grid .portfolio-grid-filter a,
.wpb_willow_portfolio_grid .portfolio-title,
.wpb_willow_portfolio_grid .portfolio-category,
.wpb_willow_progress_bar .progress-bar-text,
.wpb_willow_blog_grid .blog-grid-post-category,
.wpb_willow_blog_grid .blog-grid-post-title,
.wpb_willow_blog_grid .blog-grid-post-date,
.wpb_willow_counter .counter-value,
.wpb_willow_counter .counter-caption,
#jprePercentage {
	font-family: <?php echo $heading_font_face; ?>;
}
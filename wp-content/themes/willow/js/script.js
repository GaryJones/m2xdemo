;(function( $ ) {
	"use strict";

	$( document ).on( 'ready', function() {
		
		var $anchors   = $( '.section > .section-anchor' ),
		    $menus     = $( '.menu-item > a' ),
		    offset     = 90,
		    HTMLOffset = parseInt( $( 'html' ).css( 'marginTop' ) ) + 1;

		$('.hero-section').css('height', $('.hero-section').css('height'));
        $('body').css('height', 'auto');

		$anchors.waypoint(function( direction ) {
			var $this    = $( this ),
			    anchor   = $this.data( 'anchor' ),
			    $section = $( $this.data( 'section' ) );

			if ( $section.length < 1 ) return;

			var id       = $section.attr( 'id' ),
			    $a       = $menus.filter( '[href$="#' + id + '"]' );

			// current
			if ( anchor == 'top' && direction == 'down' ) {
				$menus.removeClass( 'active-scroll' );
				$a.addClass( 'active-scroll' );
			}
			// before
			else if ( anchor == 'bottom' && direction == 'up' ) {
				$menus.removeClass( 'active-scroll' );
				$a.addClass( 'active-scroll' );
			}
			// remove
			else {
				$menus.removeClass( 'active-scroll' );
			}
		}, { offset: offset + HTMLOffset + 1 });

		window.clickAnchorLink = function( $a, e ) {
			var url = $a.attr( 'href' ),
			    hash = url.indexOf( '#' ),
			    $target = ( hash == -1 ) ? null : $( url.substring( hash ) );

			if ( $target && $target.length > 0 ) {
				e.preventDefault();

				var top = $target.offset().top;

				if ( top <= $( '#content' ).offset().top ) {
					offset = 90;
				} else {
					offset = 70;
				}
				
				$( 'body, html' ).animate({ scrollTop: top - offset - HTMLOffset }, 1000 );
			};
		};

		$( 'body' ).on( 'click', '.js-anchor-link', function( e ) {
			clickAnchorLink( $( this ), e );
		});

		$menus.on( 'click', function( e ) {
			clickAnchorLink( $( this ), e );
		});

		// collapse mobile menu on menu item tap
		$( '.navbar-collapse a' ).click( function( e ) {
			if ( $('.navbar-toggle ').css( 'display' ) == 'block' && ! $( this ).siblings().length ) {
				$( '.navbar-collapse' ).collapse( 'toggle' );
			}
		});

		if ( $.fn.jpreLoader ) {
			var $preloader = $( '.js-preloader' );

			$preloader.jpreLoader({
				// autoClose: false,
			}, function() {
				$preloader.addClass( 'preloader-done' );
				$( 'body' ).trigger( 'preloader-done' );
				$( window ).trigger( 'resize' );
			});
		};

		if ( $.fn.superfish ) {
			$( '.js-superfish' ).superfish({
				speed: 300,
				speedOut: 300,
				delay: 0,
			});
		};


		if ( $.fn.fitText ) {
			$( '.js-fittext' ).each(function( i, el ) {
				var $el = $ ( el ),
				    compressor = $el.data( 'fittext_compressor' );

				if ( ! compressor ) compressor = 1;
				$el.fitText( compressor, { maxFontSize: $el.css( 'fontSize' ) } );
			});
		};

		if ( $.fn.gmap3 ) {

			window.isJSON = function( str ) {
				try {
					JSON.parse( str );
				} catch ( e ) {
					return false;
				}
				return true;
			};

			$( '.js-gmap' ).each(function( i, el ) {
				var $el = $( el ),
				    zoom = $el.data( 'zoom' ),
				    lat = $el.data( 'lat' ),
				    lng = $el.data( 'lng' ),
				    marker_lat = $el.data( 'markerlat' ),
				    marker_lng = $el.data( 'markerlng' ),
				    options;

				options = {
					map: {
						options: {
							center: [ lat, lng ],
							zoom: zoom,
							mapTypeControl: false,
							scrollwheel: false,
							streetViewControl: false,
							panControl: false,
							zoomControl: true,
							zoomControlOptions: {
								position: google.maps.ControlPosition.LEFT_CENTER,
								style: google.maps.ZoomControlStyle.SMALL,
							},
						}
					}
				}
				if ( marker_lat !== '' && marker_lng !== '' ) {
					options['marker'] = {
						latLng: [ marker_lat, marker_lng ],
					}
				}
				if ( isJSON( willow.gmap_style_json ) ) {
					options['map']['options']['styles'] = $.parseJSON( willow.gmap_style_json );
				}

				$el.gmap3( options );
			});
		};

		if ( $.fn.sharrre ) {
			$( '.js-social-share' ).each(function( i, el ) {
				var $el         = $( el ),
				    $dummy      = $el.children( 'li.dummy' ),
				    $links      = $el.children( 'li.social-share-item' ),
				    sharrre_php = $el.data( 'sharrre' ),
				    thumbnail   = $el.data( 'thumbnail' );

				$links.each(function( j, link ) {
					var $link   = $( link ),
					    $button = $( $dummy.html() ),
					    $icon   = $button.children( '.icon' ),
					    type    = $link.data( 'type' ),
					    icon    = $link.data( 'icon' ),
					    share   = {},
					    buttons = {},
					    html;

					$icon.addClass( icon );
					html = $( '<li>' ).append( $button ).html();
					share[type] = true;

					if ( type == 'pinterest' ) {
						buttons[type] = {
							media: thumbnail,
						}
					}

					$link.sharrre({
						share: share,
						buttons: buttons,
						enableHover: false,
						enableTracking: true,
						urlCurl : sharrre_php,
						template : html,
						click: function( api, options ){
							api.simulateClick();
							api.openPopup( type );
						},
					});
				});

			});
		};

		if ( $.fn.isotope ) {
			$( '.js-isotope-grid' ).each(function() {

				var $el = $( this ),
				    $filter = $el.find( '.portfolio-grid-filter > a' ),
				    $loop = $el.find( '.portfolio-grid-loop' );

				$loop.isotope();

				$loop.imagesLoaded(function() {
					$loop.isotope( 'layout' );
				});

				if ( $filter.length > 0 ) {

					$filter.on( 'click', function( e ) {
						e.preventDefault();

						$loop.children().addClass( 'wpb_disable_animation' );

						var $a = $(this);
						$filter.removeClass( 'active' );
						$a.addClass( 'active' );
						$loop.isotope({ filter: $a.data( 'filter' ) });
					});
				};
			});
		};

		if ( $.fn.magnificPopup ) {

			var markup = $( '#popup-document > .markup' ).html(),
			    $markup = $( markup );

			window.closeMagnificPopup = function( frame ) {
				if ( frame == undefined ) return;
                
				var $frame = $( frame );
				$frame.removeClass( 'iframe-active' );
				setTimeout(function() {
					$.magnificPopup.close();
				}, 300);
			};

			window.animateMagnificPopup = function( frame ) {
				if ( frame == undefined ) return;

				var $frame = $( frame );
				$frame.addClass( 'iframe-active' );
				$frame.parents( '.mfp-wrap' ).siblings( '.mfp-bg' ).addClass( 'hide-loader' );
				jQuery("html, body").animate({scrollTop: jQuery(document).scrollTop() + 1});
				jQuery("html, body").animate({scrollTop: jQuery(document).scrollTop() - 1});
			};

			window.magnificPopupify = function( $elements ) {
				$elements.magnificPopup({
					type: 'iframe',
					iframe: {
						markup: markup,
					},
					prependTo: '#popup-document',
					showCloseBtn: false,
					callbacks: {
						elementParse: function( item ) {
							item.src = addParameter( item.src, 'iframe', '1' );
						},
					},
				});
			};

			window.addParameter = function( url, param, value ) {
				// Using a positive lookahead (?=\=) to find the
				// given parameter, preceded by a ? or &, and followed
				// by a = with a value after than (using a non-greedy selector)
				// and then followed by a & or the end of the string
				var val = new RegExp( '(\\?|\\&)' + param + '=.*?(?=(&|$))' ),
				    parts = url.toString().split( '#' ),
				    url = parts[0],
				    hash = parts[1],
				    qstring = /\?.+$/,
				    newURL = url;

				// Check if the parameter exists
				if ( val.test( url ) ) {
					// if it does, replace it, using the captured group
					// to determine & or ? at the beginning
					newURL = url.replace( val, '$1' + param + '=' + value );
				} else if ( qstring.test( url ) ) {
					// otherwise, if there is a query string at all
					// add the param to the end of it
					newURL = url + '&' + param + '=' + value;
				} else {
					// if there's no query string, add one
					newURL = url + '?' + param + '=' + value;
				};

				if ( hash ) {
					newURL += '#' + hash;
				};

				return newURL;
			};

			magnificPopupify( $( '.js-ajax-popup' ) );
		};

		if ( $.fn.caroufredsel ) {

			window.resizeVideoBackground = function( $el, video_w, video_h ) {

				var $section  = $( $el.data( 'section' ) ),
				    min_w     = 300,
				    section_w = $section.width(),
				    section_h = $section.height(),
				    scale_w   = section_w / video_w,
				    scale_h   = section_h / video_h,
				    scale     = scale_w > scale_h ? scale_w : scale_h,
				    new_video_w, new_video_h, offet_top, offet_left;

				if ( scale * video_w < min_w ) {
					scale = min_w / video_w;
				};

				new_video_w = scale * video_w;
				new_video_h = scale * video_h;

				offet_left = ( new_video_w - section_w ) / 2 * -1;
				offet_top  = ( new_video_h - section_h ) / 2 * -1;

				$el.css( 'width', new_video_w );
				$el.css( 'height', new_video_h );
				$el.css( 'marginTop', offet_top );
				$el.css( 'marginLeft', offet_left );

				if ( $el.siblings( '.me-plugin' ).length > 0 ) {
					$el.siblings( '.me-plugin' ).css( 'marginTop', $el.css( 'marginTop' ) );
					$el.siblings( '.me-plugin' ).css( 'marginLeft', $el.css( 'marginLeft' ) );
				};
			};

			var doRotate = function($el, $items, counter, interval) {
				return function() {
					$items[counter % $items.length].stop( true, true ).fadeOut(function(){
						$items[ counter = ( counter + 1 ) % $items.length ].stop( true, true ).fadeIn();
					});
					var id = setTimeout( doRotate( $el, $items, counter, interval ), interval );
					$el.data( 'tr-id', id );
				}
			}

			$( '.text-rotator' ).each(function( i, el ) {

				var rotate = function() {

					return function() {

						var $el      = $( el ),
						    $items    = [],
						    counter  = 0,
						    interval = $el.data( 'interval' ) / 2,
						    id       = $el.data( 'tr-id' );

						$el.find( 'li' ).each(function(){ $items.push( $(this) ) });

						if( typeof id !== 'undefined' ) {
							clearTimeout( id );
							$el.find( 'li' ).stop( true, true ).hide();
						}

						$items[0].stop( true, true ).fadeIn();
						id = setTimeout( doRotate( $el, $items, counter, interval ), interval );
						$el.data( 'tr-id', id );
					}
				};

				$( el ).bind( 'rotate', rotate() );
				
			});

			$( '.js-caroufredsel' ).each(function( i, el ) {

				var $el = $( el ),
				    type = $el.data( 'caroufredsel' ),
				    caroufredsel_options;

				$el.imagesLoaded(function() {

					switch ( type ) {
						case 'portfolio-images-slider' :
							caroufredsel_options = {
								responsive : true,
								height     : 'auto',
								auto       : false,
								items      : {
									visible : 1,
								},
								scroll : {
									items    : 1,
									fx       : 'crossfade',
									duration : 800,
								},
								pagination : {
									container     : $el.siblings( '.caroufredsel-pagination' ),
									anchorBuilder : false,
								},
								swipe : true,
								prev : {
									button : $el.siblings( '.caroufredsel-control' ).children( '.prev' ),
								},
								next : {
									button : $el.siblings( '.caroufredsel-control' ).children( '.next' ),
								},
								onCreate : function() {
									$( window ).on( 'resize', function( e ) {
										var new_css = {
										    	width  : $el.children().first().outerWidth(),
										    	height : $el.children().first().outerHeight(),
										    };

										$el.css( 'width', ( new_css.width * $el.children().length ) ).css( 'height', new_css.height );
										$el.parent().css( new_css );
									} );
								},
							};
							break;

						case 'quotes-carousel' :
							var interval = $el.data( 'interval' );

							caroufredsel_options = {
								responsive : true,
								auto       : ( interval <= 0 || interval == undefined ) ? false : {
									timeoutDuration : interval,
									duration        : 800,
								},
								items      : {
									visible : 1,
								},
								scroll : {
									items    : 1,
									fx       : 'crossfade',
									duration : 800,
									onBefore : function( data ) {
										var $new = data.items.visible,
										    new_css = {
										    	height: $new.height(),
										    };
										$el.css( new_css );
										$el.parent().css( new_css );
									},
								},
								pagination : {
									container     : $el.siblings( '.caroufredsel-pagination' ),
									anchorBuilder : false,
								},
								swipe : true,
								onCreate : function() {
									$( window ).on( 'resize', function( e ) {
										var new_css = {
										    	width  : $el.children().first().outerWidth(),
										    	height : $el.children().first().outerHeight(),
										    };

										$el.css( 'width', ( new_css.width * $el.children().length ) ).css( 'height', new_css.height );
										$el.parent().css( new_css );
									} );
								},
							};
							break;

						case 'section-background-slider' :
							var interval = $el.data( 'interval' ),
							    width    = $el.parents( '.content-section' ).outerWidth(),
							    height   = $el.parents( '.content-section' ).outerHeight();

							caroufredsel_options = {
								responsive : true,
								width      : width,
								height     : height,
								auto       : ( interval <= 0 || interval == undefined ) ? false : {
									timeoutDuration : interval,
									duration        : 800,
								},
								items      : {
									visible : 1,
									width   : width,
									height  : height,
								},
								scroll : {
									items    : 1,
									fx       : 'crossfade',
									duration : 800,
								},
								swipe : true,
								pagination : {
									container     : $el.siblings( '.caroufredsel-pagination' ),
									anchorBuilder : false,
								},
								onCreate : function() {
									$( window ).on( 'resize', function( e ) {
										var new_css = {
										    	width  : $el.parents( '.content-section' ).outerWidth(),
										    	height : $el.parents( '.content-section' ).outerHeight(),
										    };

										$el.css( 'width', ( new_css.width * $el.children().length ) ).css( 'height', new_css.height );
										$el.parent().css( new_css );
										$el.children().css( new_css );
									} );
								},
							};

							break;

						case 'hero-slider' :
							var interval = $el.data( 'interval' ),
							    width    = $el.parents( '.hero-section' ).outerWidth(),
							    height   = $el.parents( '.hero-section' ).outerHeight(),
							    $volume  = $( '.video-volume-toggle' ),
							    $videos  = $el.find( 'video.js-video-background' );

							$videos.each(function() {
								var $video   = $( this ),
								    $section = $( $video.data( 'section' ) ),
								    ratio    = $video.data( 'ratio' ),
								    video_w, video_h;

								if ( ratio == '4:3' ) {
									video_w = 4;
									video_h = 3;
								} else {
									video_w = 16;
									video_h = 9;
								};
								resizeVideoBackground( $video, video_w, video_h );

								$( window ).on( 'resize', function() {
									resizeVideoBackground( $video, video_w, video_h );
								});

								$video.get( 0 ).volume = $video.attr( 'volume' );
							});

							caroufredsel_options = {
								responsive : true,
								width      : width,
								height     : height,
								auto       : ( interval <= 0 || interval == undefined ) ? false : {
									timeoutDuration : interval,
									duration        : 800,
								},
								items      : {
									visible : 1,
									width   : width,
									height  : height,
								},
								onCreate    : function( data ) {
									var $first  = data.items,
									    $video  = $first.find( 'video.js-video-background' ),
									    $rot    = $first.find( '.text-rotator' );

									if ( $video.length > 0 ) {
										$video.get( 0 ).play();
										$volume.show();
									} else {
										$volume.hide();
									};
									if ( $rot.length > 0 ) {
										if( $( 'body' ).hasClass( 'js-preloader' ) ) {
											$( 'body' ).on( 'preloader-done', function(){
												$rot.trigger( 'rotate' );
											} );
										} else {
											$rot.trigger( 'rotate' );
										}
									};
									$first.addClass( 'active' );

									$( window ).on( 'resize', function( e ) {
										var new_css = {
										    	width  : $el.parents( '.hero-section' ).outerWidth(),
										    	height : $el.parents( '.hero-section' ).outerHeight(),
										    };

										$el.css( 'width', ( new_css.width * $el.children().length ) ).css( 'height', new_css.height );
										$el.parent().css( new_css );
										$el.children().css( new_css );
									} );

								},
								scroll : {
									items    : 1,
									fx       : 'crossfade',
									duration : 800,
									onBefore : function( data ) {
										var $old = data.items.old,
										    $visible = data.items.visible,
										    $video = $old.find( 'video.js-video-background' ),
										    $rot = $visible.find( '.text-rotator' );

										if ( $video.length > 0 ) {
											$video.get( 0 ).pause();
											$volume.hide();
										};
										if ( $rot.length > 0 ) {
											$rot.trigger( 'rotate' );
										};
										$old.removeClass( 'active' );
									},
									onAfter  : function( data ) {
										var $new = data.items.visible,
										    $video = $new.find( 'video.js-video-background' );

										if ( $video.length > 0 ) {
											$video.get( 0 ).play();
											$volume.show();
										};
										$new.addClass( 'active' );
									},
								},
								pagination : {
									container     : $el.siblings( '.caroufredsel-pagination' ),
									anchorBuilder : false,
								},
								swipe : true,
							};

							$volume.on( 'click', function( e ) {
								e.preventDefault();

								var $a = $( this );

								$videos.each(function( i, el ) {
									var $video = $( el ),
									    current_volume = $video.get( 0 ).volume;

									$video.get( 0 ).volume = Math.abs( current_volume - 1 );
									$a.toggleClass( 'volume-active' );
								});

							});
							break;
					};

					$el.carouFredSel( caroufredsel_options );
				});
			});

		};

		$( '.js-countup' ).each(function( i, el ) {
			var $el = $( el ),
			    counter = $el.data( 'counter' ),
			    start = $el.data( 'start' ),
			    end = $el.data( 'end' ),
			    decimals = $el.data( 'decimals' );

			var countup = new countUp( counter, start, end, decimals, 1.5, {
					useEasing : true, 
					useGrouping : false, 
					separator : '', 
					decimal : '.',
				});

			$( '#' + counter ).waypoint(function( direction ) {
				countup.start();
			}, { offset: 'bottom-in-view' });
		});

		$( '.js-progress-bar' ).each(function( i, el ) {
			var $el = $( el ),
			    value = $el.data( 'value' ),
			    $bar = $el.find( '.progress-bar-thumb' );

			$bar.css( 'width', 0 );
			$el.waypoint(function( direction ) {
				if ( ! $el.data( 'animated' ) ) {
					$({ progress: 0 }).animate({ progress: value }, {
						duration: 1000,
						step: function( now, tween ) {
							$bar.css( 'width', now + '%' );
						},
					});
					$el.data( 'animated', true );
				};
			}, { offset: 'bottom-in-view' });

		});

		if ( $.fn.parallax && willow.is_mobile_or_tablet == 'false' ) {
			$( window ).on( 'load', function() {
				$( '.js-parallax' ).parallax( '50%', 0.5 );
			});
		};

		$( '.header-floating-anchor' ).waypoint(function( direction ) {
			var $header = $( '#header' );

			if ( direction == 'down' ) {
				$header.css( 'top', $( 'body' ).offset().top ).addClass( 'floating' );
			} else if ( direction == 'up' ) {
				$header.css( 'top', '0').removeClass( 'floating' );
			};
		}, { offset: $( 'body' ).offset().top });

		// Portfolio Archive Load More
		$( '.wpb_willow_portfolio_grid' ).each(function( i, el ) {

			var $el               = $( el ),
			    id                = $( el ).attr( 'id' ),
			    $load_more_button = $el.find( '.load-more' ),
			    $load_more_link   = $load_more_button.find( '> a' ),
			    $icon             = $load_more_button.find( '.fa-refresh' ),
			    $loop             = $el.find( '.portfolio-grid-loop' );

			$load_more_button.on( 'click', function( e ) {
				e.preventDefault();

				var ajaxurl      = $load_more_link.attr( 'href' ),
				    $new_archive = $( '<div/>' );

				$icon.addClass('fa-spin');

				$new_archive.load( ajaxurl + ' #' + id + ':first', undefined, function() {

					$new_archive   = $new_archive.find( '.wpb_willow_portfolio_grid' );
					var $new_items = $new_archive.find( '.portfolio-grid-post' );

					$new_items.css( 'visibility', 'hidden' );
					$new_items.css( 'height', 0 );
					// visual composer animation effect fix
					$new_items.addClass( 'wpb_start_animation' );
					$loop.append( $new_items );

					// re-apply magnificPopup
					magnificPopupify( $new_items.find( '.js-ajax-popup' ) );

					$new_items.imagesLoaded(function() {
						$new_items.css( 'visibility', '' );
						$new_items.css( 'height', '' );
						if ( $.fn.isotope ) {
							$loop.isotope( 'appended', $new_items );
						};
						$icon.removeClass( 'fa-spin' );
						if ( ! $new_archive.data( 'next' ) ) {
							$load_more_button.stop().fadeOut( 1000 );
						};
					});

					$el.data( 'next', $new_archive.data( 'next' ) );
					if ( $new_archive.data( 'next' ) ) {
						$load_more_link.attr( 'href', $new_archive.data( 'next' ) );
					};
				});
			});
		});

	});

})( jQuery );
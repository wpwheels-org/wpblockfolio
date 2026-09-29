document.addEventListener( 'DOMContentLoaded', function() {
	/* -----------------------------------------------------------------
	 * Smooth-scroll same-page anchor links (header nav, buttons, etc.)
	 * to their target section, offset by the sticky header height.
	 * ----------------------------------------------------------------- */
	( function() {
		const header = document.querySelector( '.wpblockfolio-header' );

		function headerOffset() {
			return header ? header.getBoundingClientRect().height + 16 : 0;
		}

		function scrollToTarget( target, updateHash ) {
			const top =
				target.getBoundingClientRect().top +
				window.pageYOffset -
				headerOffset();

			window.scrollTo( {
				top: Math.max( top, 0 ),
				behavior: 'smooth',
			} );

			if ( updateHash && window.history && window.history.pushState ) {
				window.history.pushState( null, '', '#' + target.id );
			}
		}

		document.addEventListener( 'click', function( event ) {
			const link = event.target.closest( 'a[href*="#"]' );
			if ( ! link ) {
				return;
			}

			// Only handle links that point at the current page.
			const url = new URL( link.href, window.location.href );
			if (
				url.pathname !== window.location.pathname ||
				url.search !== window.location.search ||
				! url.hash ||
				url.hash === '#'
			) {
				return;
			}

			const target = document.getElementById( url.hash.slice( 1 ) );
			if ( ! target ) {
				return;
			}

			event.preventDefault();
			scrollToTarget( target, true );

			// Close the mobile navigation overlay if it is open.
			const openOverlay = document.querySelector(
				'.wp-block-navigation__responsive-container.is-menu-open',
			);
			if ( openOverlay ) {
				const closeButton = openOverlay.querySelector(
					'.wp-block-navigation__responsive-container-close',
				);
				if ( closeButton ) {
					closeButton.click();
				}
			}
		} );

		// Honour a hash present in the URL on initial load.
		if ( window.location.hash.length > 1 ) {
			const initial = document.getElementById(
				window.location.hash.slice( 1 ),
			);
			if ( initial ) {
				window.setTimeout( function() {
					scrollToTarget( initial, false );
				}, 100 );
			}
		}
	}() );

	const navLinks = document.querySelectorAll( '.wpblockfolio-sidebar-nav a[href^="#"]' );
	const sidebar = document.querySelector( '.wpblockfolio-sidebar-card' );
	if ( ! navLinks.length || ! sidebar ) {
		return;
	}

	const sections = [];
	navLinks.forEach( function( link ) {
		const id = link.getAttribute( 'href' ).slice( 1 );
		const section = document.getElementById( id );
		if ( section ) {
			sections.push( { id, el: section, link } );
		}
	} );
	if ( ! sections.length ) {
		return;
	}

	let currentActive = null;
	let centerTimeout = null;
	let isFirstActivation = true;

	function centerLinkInSidebar( link ) {
		const sidebarRect = sidebar.getBoundingClientRect();
		const linkRect = link.getBoundingClientRect();

		const linkOffsetWithinSidebar = ( linkRect.top - sidebarRect.top ) + sidebar.scrollTop;
		const targetScrollTop = linkOffsetWithinSidebar - ( sidebar.clientHeight / 2 ) + ( linkRect.height / 2 );

		sidebar.scrollTo( {
			top: targetScrollTop,
			behavior: 'smooth',
		} );
	}

	const observer = new IntersectionObserver(
		function( entries ) {
			entries.forEach( function( entry ) {
				const match = sections.find( function( s ) {
					return s.el === entry.target;
				} );
				if ( ! match ) {
					return;
				}
				if ( entry.isIntersecting && currentActive !== match.link ) {
					navLinks.forEach( function( l ) {
						l.classList.remove( 'is-active' );
					} );
					match.link.classList.add( 'is-active' );
					currentActive = match.link;

					// Skip the scroll animation entirely on page load —
					// only start centering from the second activation onward.
					if ( isFirstActivation ) {
						isFirstActivation = false;
						return;
					}

					clearTimeout( centerTimeout );
					centerTimeout = setTimeout( function() {
						centerLinkInSidebar( match.link );
					}, 300 );
				}
			} );
		},
		{
			rootMargin: '-45% 0px -45% 0px',
			threshold: 0,
		},
	);

	sections.forEach( function( s ) {
		observer.observe( s.el );
	} );
} );

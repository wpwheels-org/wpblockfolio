document.addEventListener('DOMContentLoaded', function () {
	/* -----------------------------------------------------------------
	 * Smooth-scroll same-page anchor links (header nav, buttons, etc.)
	 * to their target section, offset by the sticky header height.
	 * ----------------------------------------------------------------- */
	(function () {
		var header = document.querySelector('.fh-header');

		function headerOffset() {
			return header ? header.getBoundingClientRect().height + 16 : 0;
		}

		function scrollToTarget(target, updateHash) {
			var top =
				target.getBoundingClientRect().top +
				window.pageYOffset -
				headerOffset();

			window.scrollTo({
				top: Math.max(top, 0),
				behavior: 'smooth',
			});

			if (updateHash && window.history && window.history.pushState) {
				window.history.pushState(null, '', '#' + target.id);
			}
		}

		document.addEventListener('click', function (event) {
			var link = event.target.closest('a[href*="#"]');
			if (!link) return;

			// Only handle links that point at the current page.
			var url = new URL(link.href, window.location.href);
			if (
				url.pathname !== window.location.pathname ||
				url.search !== window.location.search ||
				!url.hash ||
				url.hash === '#'
			) {
				return;
			}

			var target = document.getElementById(url.hash.slice(1));
			if (!target) return;

			event.preventDefault();
			scrollToTarget(target, true);

			// Close the mobile navigation overlay if it is open.
			var openOverlay = document.querySelector(
				'.wp-block-navigation__responsive-container.is-menu-open'
			);
			if (openOverlay) {
				var closeButton = openOverlay.querySelector(
					'.wp-block-navigation__responsive-container-close'
				);
				if (closeButton) closeButton.click();
			}
		});

		// Honour a hash present in the URL on initial load.
		if (window.location.hash.length > 1) {
			var initial = document.getElementById(
				window.location.hash.slice(1)
			);
			if (initial) {
				window.setTimeout(function () {
					scrollToTarget(initial, false);
				}, 100);
			}
		}
	})();

	var navLinks = document.querySelectorAll('.fh-sidebar-nav a[href^="#"]');
	var sidebar = document.querySelector('.fh-sidebar-card');
	if (!navLinks.length || !sidebar) return;

	var sections = [];
	navLinks.forEach(function (link) {
		var id = link.getAttribute('href').slice(1);
		var section = document.getElementById(id);
		if (section) {
			sections.push({ id: id, el: section, link: link });
		}
	});
	if (!sections.length) return;

	var currentActive = null;
	var centerTimeout = null;
	var isFirstActivation = true;

	function centerLinkInSidebar(link) {
		var sidebarRect = sidebar.getBoundingClientRect();
		var linkRect = link.getBoundingClientRect();

		var linkOffsetWithinSidebar = (linkRect.top - sidebarRect.top) + sidebar.scrollTop;
		var targetScrollTop = linkOffsetWithinSidebar - (sidebar.clientHeight / 2) + (linkRect.height / 2);

		sidebar.scrollTo({
			top: targetScrollTop,
			behavior: 'smooth',
		});
	}

	var observer = new IntersectionObserver(
		function (entries) {
			entries.forEach(function (entry) {
				var match = sections.find(function (s) { return s.el === entry.target; });
				if (!match) return;
				if (entry.isIntersecting && currentActive !== match.link) {
					navLinks.forEach(function (l) { l.classList.remove('is-active'); });
					match.link.classList.add('is-active');
					currentActive = match.link;

					// Skip the scroll animation entirely on page load —
					// only start centering from the second activation onward.
					if (isFirstActivation) {
						isFirstActivation = false;
						return;
					}

					clearTimeout(centerTimeout);
					centerTimeout = setTimeout(function () {
						centerLinkInSidebar(match.link);
					}, 300);
				}
			});
		},
		{
			rootMargin: '-45% 0px -45% 0px',
			threshold: 0,
		}
	);

	sections.forEach(function (s) { observer.observe(s.el); });
});
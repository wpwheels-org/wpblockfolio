document.addEventListener('DOMContentLoaded', function () {
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
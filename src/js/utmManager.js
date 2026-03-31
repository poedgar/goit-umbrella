(function () {
	const COOKIE_NAME = "bettered_utm";
	const COOKIE_LIFETIME_DAYS = 30;

	function parseQueryParams() {
		const params = new URLSearchParams(window.location.search);
		const utms = {};
		[
			"utm_source",
			"utm_medium",
			"utm_campaign",
			"utm_content",
			"utm_term",
			"gclid",
		].forEach((key) => {
			if (params.has(key)) utms[key] = params.get(key);
		});
		return Object.keys(utms).length ? utms : null;
	}

	function setCookieUrl(name, value, days) {
		const date = new Date();
		date.setTime(date.getTime() + days * 24 * 60 * 60 * 1000);
		document.cookie = `${name}=${encodeURIComponent(
			JSON.stringify(value)
		)};path=/;expires=${date.toUTCString()}`;
	}

	function getCookieUrl(name) {
		const match = document.cookie.match(
			new RegExp("(^| )" + name + "=([^;]+)")
		);

		return match ? JSON.parse(decodeURIComponent(match[2])) : null;
	}

	const urlUTMs = parseQueryParams();

	if (urlUTMs) {
		setCookieUrl(COOKIE_NAME, urlUTMs, COOKIE_LIFETIME_DAYS);
	}

	// 🔥 Move the event listener inside the same closure
	document.addEventListener("click", function (e) {
		const link = e.target.closest("a");
		if (!link) return;

		const cookieUTMs = getCookieUrl(COOKIE_NAME);

		if (!cookieUTMs) return;

		const url = new URL(link.href);
		for (const [key, val] of Object.entries(cookieUTMs)) {
			if (url.searchParams.has(key)) {
				url.searchParams.set(key, val);
			} else {
				url.searchParams.set(key, val);
			}
		}
		link.href = url.toString();
	});
})();

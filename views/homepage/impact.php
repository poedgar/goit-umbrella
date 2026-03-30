<?php
$show_section = get_field('show_impact_section');
$title        = get_field('impact_section_title');
$description  = get_field('impact_section_description');
$video_url    = get_field('impact_video');
if (!$show_section) return;
?>
<section id="impact" class="section">
	<div class="container">
		<div class="grid gap-5 md:gap-8 xl:flex xl:flex-row-reverse">
			<div class="flex flex-col gap-5 md:gap-8 xl:items-center xl:justify-center">
				<?php if ($title): ?>
					<h2 class="section-title xl:text-left"><?= $title; ?></h2>
				<?php endif; ?>
				<?php if ($description): ?>
					<p class="low-section-title xl:text-left"><?= wp_kses_post($description); ?></p>
				<?php endif; ?>
			</div>
			<div class="relative xl:w-[800px] shrink-0">
				<div class="mx-auto w-full max-w-[280px] md:max-w-[704px] xl:max-w-[800px]">
					<div class="relative pt-[56.25%]">
						<div id="impactPlayer" class="absolute inset-0 h-full w-full rounded-lg overflow-hidden"></div>
					</div>
				</div>
				<button
					id="playButton"
					data-video-url="<?= esc_url($video_url['url']); ?>"
					class="absolute btn btn-black top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 z-20 shrink-0 hover:scale-[1.1] focus:scale-[1.1] active:scale-[1.1]"
					type="button"
					aria-label="<?php echo esc_attr(__('кнопка відкриття модального вікна з відео', 'umbrella')); ?>"
					tabindex=" 0">
					<?php echo esc_html__('дивитися', 'umbrella'); ?>
				</button>
			</div>
		</div>
	</div>
</section>
<script>
	(function() {
		var ua = navigator.userAgent;
		var isIOS = /iphone|ipad|ipod/i.test(ua);
		var isSafariDesktop = /safari/i.test(ua) && !/chrome/i.test(ua) && !/android/i.test(ua) && !isIOS;
		var isIOSChrome = isIOS && /crios/i.test(ua);
		var useVimeo = isSafariDesktop || isIOSChrome;

		if (useVimeo) {
			var script = document.createElement('script');
			script.src = 'https://player.vimeo.com/api/player.js';
			script.onload = function() {
				var player = new Vimeo.Player('impactPlayer', {
					id: 1170100530,
					autoplay: true,
					muted: true,
					loop: true,
					controls: false,
					responsive: true
				});

				var playButton = document.getElementById('playButton');
				if (!playButton) return;

				playButton.addEventListener('click', function() {
					player.destroy().then(function() {
						player = new Vimeo.Player('impactPlayer', {
							id: 1170101999,
							autoplay: true,
							muted: isIOSChrome ? true : false,
							loop: false,
							controls: true,
							responsive: true
						});
						if (!isIOSChrome) {
							player.setVolume(1);
						}
					});
					playButton.style.display = 'none';
				});
			};
			document.head.appendChild(script);

		} else {
			var tag = document.createElement('script');
			tag.src = 'https://www.youtube.com/iframe_api';
			var firstScriptTag = document.getElementsByTagName('script')[0];
			firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);

			var player;
			var playerReady = false;

			window.onYouTubeIframeAPIReady = function() {
				player = new YT.Player('impactPlayer', {
					width: '100%',
					height: '100%',
					videoId: 'yO0d6nJPPsE',
					playerVars: {
						autoplay: 1,
						mute: 1,
						rel: 0,
						loop: 1,
						playlist: 'yO0d6nJPPsE',
						controls: 0,
						playsinline: 1,
						modestbranding: 1
					},
					events: {
						onReady: function(event) {
							playerReady = true;
							event.target.playVideo();
						},
						onError: function(event) {
							console.log('YouTube Error:', event.data);
						}
					}
				});
			};

			document.addEventListener('DOMContentLoaded', function() {
				var playButton = document.getElementById('playButton');
				if (!playButton) return;

				playButton.addEventListener('click', function() {
					if (!playerReady) return;
					player.loadVideoById('Dn1zS16jhbg');
					player.unMute();
					player.setLoop(false);
					playButton.style.display = 'none';
				});
			});
		}
	})();
</script>
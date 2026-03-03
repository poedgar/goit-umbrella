<?php
// Retrieve values from ACF
$show_section = get_field('show_impact_section');
$title        = get_field('impact_section_title');
$description  = get_field('impact_section_description');
$video_url       = get_field('impact_video');

// Don't render if disabled
if (!$show_section) return;
?>

<section id="impact" class="section">
	<div class="container">
		<!-- main wrapper -->
		<div class="grid gap-5 md:gap-8 xl:flex xl:flex-row-reverse">
			<!-- text wrapper -->
			<div class="flex flex-col gap-5 md:gap-8 xl:items-center xl:justify-center">
				<?php if ($title): ?>
					<h2 class="section-title xl:text-left">
						<?= $title; ?></h2>
				<?php endif; ?>

				<?php if ($description): ?>
					<p class="low-section-title xl:text-left"><?= wp_kses_post($description); ?></p>
				<?php endif; ?>
			</div>

			<!-- video wrapper  -->
			<div class="relative xl:w-[800px] shrink-0">
				<!-- <video
					id="impactVideo"
					class="mx-auto h-auto rounded-[8px] xl:rounded-[8px]"
					title=""
					muted
					autoplay
					loop
					playsinline
					preload="metadata">
					<source id="impactVideoSourceMp4" src="<?php echo get_template_directory_uri(); ?>/src/videos/homepage-video.mp4" type="video/mp4">
					<source id="impactVideoSourceWebm" src="<?php echo get_template_directory_uri(); ?>/src/videos/homepage-video.webm" type="video/webm">
				</video> -->

				<!-- <iframe
					id="impactVideoIframe"
					width="560"
					height="315"
					src="https://www.youtube.com/embed/WBcaj6zuRyA?rel=0"
					title="YouTube video player"
					frameborder="0"
					allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
					allowfullscreen>
				</iframe> -->

				<div class="mx-auto w-full max-w-[280px] md:max-w-[704px] xl:max-w-[800px]">
					<div class="relative pt-[56.25%]">
						<iframe
						id="impactVideo"
						class="absolute inset-0 h-full w-full rounded-lg"
						src="https://www.youtube.com/embed/yO0d6nJPPsE?&autoplay=1&mute=1&rel=0&loop=1&playlist=yO0d6nJPPsE"
						title="YouTube video player"
						frameborder="0"
						allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
						referrerpolicy="strict-origin-when-cross-origin"
						allowfullscreen
						></iframe>
					</div>
				</div>
			</div>
		</div>
	</div>
	</div>
</section>

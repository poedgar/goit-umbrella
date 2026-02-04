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
				<video
					id="impactVideo"
					class="mx-auto h-auto rounded-[8px] xl:rounded-[8px]"
					title=""
					muted
					playsinline
					preload="metadata">
					<source src="<?= esc_url($video_url['url']); ?>" type="video/mp4" />
				</video>
				<button
					id="playButton"
					class="absolute btn btn-black top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 z-20 shrink-0 hover:scale-[1.1] focus:scale-[1.1] active:scale-[1.1]"
					type="button" aria-label="кнопка відкриття модального вікна з відео"
					tabindex="0">
					дивитися
				</button>


			</div>
		</div>
	</div>
	</div>
</section>

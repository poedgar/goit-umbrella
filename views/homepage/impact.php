<?php
// Retrieve values from MetaBoxes
$show_section = get_post_meta(get_the_ID(), 'show_impact_section', true);
$title        = get_post_meta(get_the_ID(), 'impact_section_title', true) ?: 'ВІД ЗНАНЬ ДО ВПЛИВУ';
$description  = get_post_meta(get_the_ID(), 'impact_section_description', true);
$image        = get_post_meta(get_the_ID(), 'impact_image', true);
$btn_label    = get_post_meta(get_the_ID(), 'impact_button_label', true);
$btn_link     = get_post_meta(get_the_ID(), 'impact_button_link', true);

// Don't render if disabled or nothing to show
if (!$show_section) return;
?>

<section class="section">
	<div class="container">
		<div class="bg-white p-5 borded-[8px] grid gap-5 md:gap-8 xl:flex">
			<div class="flex flex-col gap-5 md:gap-8 xl:order-1 xl:items-center xl:justify-center">
				<?php if ($title): ?>
					<h2 class="section-title">
						<?= esc_html($title); ?></h2>
				<?php endif; ?>

				<?php if ($description): ?>
					<p class="text-[20px]/[28px] font-medium uppercase md:text-[24px]/[32px] text-center"><?= esc_html($description); ?></h2>
					</p>
				<?php endif; ?>
			</div>

			<a href="" class="cursor-pointer rounded-[8px] bg-accent overflow-hidden relative xl:order-0 xl:shrink-0"
				rel="noopener noreferrer nofollow" target="_blank">
				<div class="relative bg-red-500">
					<img class="rounded-[8px] w-full h-full md:h-[450px] xl:w-[800px]" alt="" height="498" loading="lazy"
						src="" width="280"
						class="" title="">

					<button
						class="absolute btn btn-black top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 z-20 shrink-0 hover:scale-[1.1] focus:scale-[1.1] active:scale-[1.1]"
						type="button" aria-label="кнопка відкриття модального вікна з відео"
						tabindex="0">
						дивитися
					</button>
				</div>
			</a>
		</div>
	</div>
</section>

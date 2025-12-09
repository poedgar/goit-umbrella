<?php
// Retrieve values from MetaBoxes
$show_section = get_field('show_timeline_section');
$title        = get_field('timeline_section_title');
$subtitle        = get_field('timeline_section_subtitle');
$items        = get_field('timeline_items') ?: [];

// Don't render if section disabled or empty
if (!$show_section || empty($items)) return;
?>

<section id="timeline" class="section overflow-hidden">
	<div class="container overflow-visible">

		<!-- Section Title -->
		<h2 class="section-title">
			<?= wp_kses_post($title); ?>
		</h2>

		<!-- Section SubTitle -->
		<p class="low-section-title mt-5 md:mt-8">
			<?= wp_kses_post($subtitle); ?>
		</p>


		<div class="swiper timeline-swiper mt-5 md:mt-8 flex flex-col-reverse md:flex-col gap-5 md:gap-8 overflow-visible">
			<!-- timeline buttons wrapper -->
			<div class="flex items-center justify-between gap-5">
				<button class="timeline-button-prev btn btn-black w-[150px] md:w-[98px]" type="button" aria-label="до попереднього слайду" aria-disabled="false">назад</button>
				<button class="timeline-button-next btn btn-black w-[150px] md:w-[98px]" type="button" aria-label="до наступного слайду" aria-disabled="false">вперед</button>
			</div>

			<ul class="swiper-wrapper overflow-visible">
				<!-- Timeline slides list -->
				<?php foreach ($items as $index => $item):
					$image_sm   = $item['image_mobile'];
					$image_md   = $item['image_md'];
					$year    = $item['year'];
					$heading = $item['heading'];
					$content = $item['content'];

					$is_last = ($index === count($items) - 1);
				?>

					<!-- Timeline slide -->
					<?php if ($is_last): ?>
						<!-- Останній слайд: -->
						<li class="swiper-slide flex flex-col gap-5 md:gap-8 bg-black text-white rounded-[8px] !w-[320px] md:!w-[384px] p-5 md:p-8">
							<!-- image -->
							<?php if ($image_sm): ?>
								<img src="<?= esc_url($image_sm['url']); ?>" alt="<?= esc_attr($heading); ?>"
									class="w-full rounded-[8px] md:max-h-[312px]">
							<?php endif; ?>

							<!-- title -->
							<?php if ($heading): ?>
								<p class="font-unbounded font-bold text-[20px]/[28px] uppercase md:text-[48px]/[1]"><?= esc_html($heading); ?></p>
							<?php endif; ?>

							<!-- text -->
							<?php if ($content): ?>
								<div class="text-[20px]/[28px] uppercase"><?= wp_kses_post(wpautop($content)); ?></div>
							<?php endif; ?>
						</li>
					<?php else: ?>
						<!-- Всі слайди окрім останнього -->
						<li class="swiper-slide smOnly:!w-[320px] flex smOnly:flex-col smOnly:gap-5 smOnly:p-5 bg-white rounded-[8px] overflow-hidden">
							<!-- slide image -->
							<?php if ($image_sm || $image_md): ?>
								<picture class="shrink-0 w-full md:w-[352px] xl:w-[384px] md:h-[640px] smOnly:rounded-[8px]">
									<?php if ($image_md): ?>
										<source srcset="<?= esc_url($image_md['url']); ?>" media="(min-width: 768px)">
									<?php endif; ?>
									<?php if ($image_sm): ?>
										<img class="w-auto h-full object-cover object-center" src="<?= esc_url($image_sm['url']); ?>" alt="">
									<?php endif; ?>
								</picture>
							<?php endif; ?>

							<!-- slide content -->
							<div class="flex flex-col h-full gap-5 md:p-8 md:gap-8">
								<?php if ($year): ?>
									<h3 class="text-[32px]/[36px] font-unbounded font-extrabold md:text-[48px]/[1]"><?= esc_html($year); ?></h3>
								<?php endif; ?>

								<?php if ($heading): ?>
									<p class="text-[20px]/[28px] uppercase"><?= esc_html($heading); ?></p>
								<?php endif; ?>

								<?php if ($content): ?>
									<div class="smOnly:hidden md:space-y-3 md:grow"><?= wp_kses_post(wpautop($content)); ?></div>
								<?php endif; ?>
							</div>
						</li>
					<?php endif; ?>
				<?php endforeach; ?>
			</ul>
		</div>

	</div>
</section>
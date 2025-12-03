<?php
// Retrieve values from MetaBoxes
$show_section = get_field('show_timeline_section');
$title        = get_field('timeline_section_title') ?: 'НАШ ШЛЯХ';
$items        = get_field('timeline_items') ?: [];

// Don't render if section disabled or empty
if (!$show_section || empty($items)) return;
?>

<section class="py-16 px-4 bg-gray-100">
	<div class="container mx-auto max-w-7xl">

		<!-- Section Title -->
		<h2 class="text-4xl md:text-5xl lg:text-6xl font-bold text-center mb-8 md:mb-12">
			<?= esc_html($title); ?>
		</h2>

		<!-- Carousel Nav -->
		<div class="flex justify-between items-center mb-6">
			<button class="timeline-prev px-4 py-2 bg-gray-200 rounded hover:bg-gray-300 transition">назад</button>
			<button class="timeline-next px-4 py-2 bg-gray-200 rounded hover:bg-gray-300 transition">вперед</button>
		</div>

		<!-- Timeline Carousel -->
		<div class="timeline-track flex gap-6 overflow-x-auto scroll-smooth pb-4">
			<?php foreach ($items as $item):
				$image   = $item['image'] ?? '';
				$year    = $item['year'] ?? '';
				$heading = $item['heading'] ?? '';
				$content = $item['content'] ?? '';
			?>
				<article class="timeline-card flex-shrink-0 w-[720px] bg-white rounded-xl overflow-hidden flex">
					<?php if ($image): ?>
						<div class="w-2/5 min-w-[260px] max-w-[360px]">
							<img src="<?= esc_url($image); ?>" alt="<?= esc_attr($heading ?: $year); ?>"
								class="w-full h-full object-cover block">
						</div>
					<?php endif; ?>

					<div class="p-8 flex-1">
						<?php if ($year): ?>
							<div class="text-5xl font-bold mb-4"><?= esc_html($year); ?></div>
						<?php endif; ?>

						<?php if ($heading): ?>
							<h3 class="text-xl font-bold mb-3 uppercase"><?= esc_html($heading); ?></h3>
						<?php endif; ?>

						<?php if ($content): ?>
							<div class="text-gray-700 text-sm"><?= wp_kses_post(wpautop($content)); ?></div>
						<?php endif; ?>
					</div>
				</article>
			<?php endforeach; ?>
		</div>

	</div>
</section>


<section class="section">
	<div class="container">

		<h2 class="section-title">ПРО НАС
		</h2>

		<p class="low-section-title mt-5 md:mt-8">Від локальних IT-курсів до міжнародної мультипродуктової EdTech-компанії</p>

		<!-- {{-- about slider --}} -->
		<div class="mt-5 md:mt-8 flex flex-col-reverse md:flex-col gap-5 md:gap-8">
			<!-- {{-- about btns --}} -->
			<div class="flex items-center justify-between gap-5 text-[20px]/[28px]">
				<button class="about-prev-btn flex items-center justify-center border border-black p-4 w-[150px] md:w-[98px] h-[44px] rounded-[4px]" type="button" aria-label="до попереднього слайду"
					style="" aria-disabled="false">
					назад
				</button>

				<button class="about-next-btn flex items-center justify-center text-white bg-black p-4 w-[150px] md:w-[98px] h-[44px] rounded-[4px]" type="button" aria-label="до наступного слайду"
					style="" aria-disabled="false">
					вперед
				</button>
			</div>

			<!-- {{-- about slides list --}} -->
			<div class="flex gap-5 md:gap-8">
				<!-- {{-- Swiper slide --}} -->
				<div class="flex smOnly:flex-col smOnly:gap-5 bg-white rounded-[8px] smOnly:p-5 md:overflow-hidden lg:w-[768px]">
					<!-- {{-- slide image --}} -->
					<img class="shrink-0 w-full h-[280px] md:w-[352px] xl:w-[384px] md:h-[640px] bg-yellow-300 smOnly:rounded-[8px]" src="" alt="{{ get_post_meta($image_id, '_wp_attachment_image_alt', true) ?: 'лого бренду' }}" width="72" height="72" loading="lazy" />

					<!-- {{-- slide content --}} -->
					<div class="flex flex-col h-full gap-5 md:p-8 md:gap-8">
						<h3 class="text-[32px]/[36px] font-unbounded font-extrabold md:text-[48px]/[1]">2014</h3>

						<p class="text-[20px]/[28px] uppercase">Одними з перших починаємо навчати світчерів ІТ-професіям</p>

						<div class="smOnly:hidden md:space-y-7 md:grow">
							<p>2014 рік. Україна прагне стати частиною Європи і світу. Українці об’єднуються та створюють круті, змінотворчі ініціативи.</p>
							<p>Школа GoIT — одна з таких ініціатив. У нас були знання з ІТ, готовність ділитися ними та бажання бачити Україну ІТ-нацією з фахівцями світового рівня. </p>
							<p>Ми починаємо збирати групи в Києві і навчати світчерів розробці.</p>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
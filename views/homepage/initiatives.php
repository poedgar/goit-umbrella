<?php
// ACF fields
$show     = get_field('show_initiatives_section');
$title    = get_field('initiatives_section_title');
$subtitle = get_field('initiatives_section_subtitle');
$slides   = get_field('initiatives_list');

// Exit if section disabled or empty
if (!$show || empty($slides)) return;
?>

<section id="initiatives" class="section">
	<div class="container">

		<!-- section title -->
		<h2 class="section-title">
			<?= esc_html($title); ?>
		</h2>

		<!-- section description -->
		<?php if ($subtitle): ?>
			<p class="low-section-title mt-5 md:mt-8">
				<?= esc_html($subtitle); ?>
			</p>
		<?php endif; ?>

		<!-- slider wrapper with btns -->
		<div class="slider-swiper mt-5 md:mt-8 flex flex-col-reverse md:flex-col gap-5 md:gap-8">
			<!-- {{-- Initiatives btns --}} -->
			<div class="flex items-center justify-between gap-5 text-[20px]/[28px]">
				<button class="initiatives-prev-btn btn btn-transparent w-[150px] md:w-[98px] h-[44px]
				" type="button" aria-label="до попереднього слайду"
					style="" aria-disabled="false">
					назад
				</button>

				<button class="initiatives-next-btn btn btn-black w-[150px] md:w-[98px] h-[44px] rounded-[4px]" type="button" aria-label="до наступного слайду"
					style="" aria-disabled="false">
					вперед
				</button>
			</div>

			<!-- Initiatives slides list -->
			<?php foreach ($slides as $slide):
				$photo = $slide['photo'];
				$description = $slide['description'];
			?>
				<div class="bg-gray-50 p-6 rounded-xl shadow-sm">
					<?php if ($photo): ?>
						<img src="<?= esc_url($photo); ?>" alt="<?= esc_attr($slide_title); ?>"
							class="w-full h-64 object-cover rounded-lg mb-4">
					<?php endif; ?>

					<h3 class="text-xl font-semibold mb-2"><?= esc_html($slide_title); ?></h3>
					<p class="text-gray-600"><?= esc_html($description); ?></p>
				</div>
			<?php endforeach; ?>
		</div>
	</div>
</section>
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

		<!-- slider container with btns -->
		<ul class="swiper initiatives-swiper mt-5 md:mt-8 flex flex-col-reverse md:flex-col gap-5 md:gap-8">
			<!-- {{-- Initiatives btns --}} -->
			<li class="flex items-center justify-between gap-5">
				<button class="initiatives-button-prev btn btn-transparent w-[150px] md:w-[98px]" type="button" aria-label="до попереднього слайду"
					style="" aria-disabled="false">
					назад
				</button>

				<button class="initiatives-button-next btn btn-black w-[150px] md:w-[98px]" type="button" aria-label="до наступного слайду"
					style="" aria-disabled="false">
					вперед
				</button>
			</li>

			<div class="swiper-wrapper ">
				<!-- Initiatives slides list -->
				<?php foreach ($slides as $slide):
					$photo = $slide['photo'];
					$description = $slide['description'];
				?>
					<!-- swiper slide -->
					<div class="swiper-slide smOnly:!w-[320px] h-auto flex flex-col gap-5 md:gap-8 bg-white p-5 rounded-[8px] md:p-8">
						<?php if ($photo): ?>
							<img src="<?= esc_url($photo['url']); ?>" alt="декорація"
								class="shrink-0 w-full h-[218px] rounded-[8px]">
						<?php endif; ?>


						<p class="font-medium grow text-[20px]/[28px] uppercase"><?= esc_html($description); ?></p>
					</div>
				<?php endforeach; ?>
			</div>
		</ul>
	</div>
</section>
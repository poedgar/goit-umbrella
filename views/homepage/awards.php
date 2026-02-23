<?php
// ACF fields
$show_section = get_field('show_awards_section');
$title        = get_field('awards_section_title') ?: 'НАШІ НАГОРОДИ';
$description        = get_field('awards_low_title');
$awards_items = get_field('awards_items');

// Don't render if section disabled or empty
if (!$show_section || empty($awards_items)) return;
?>

<section id="awards" class="section">
	<div class="container">

		<!-- Section Title -->
		<?php if ($title): ?>
			<h2 class="section-title">
				<?= esc_html($title); ?>
			</h2>
		<?php endif; ?>

		<?php if ($description): ?>
			<p class="low-section-title mdOnly:text-[32px]/[40px] mt-5 md:mt-8"><?= esc_html($description); ?></h2>
			</p>
		<?php endif; ?>

		<!-- Awards / Logos Grid -->
		<ul class="mt-5 md:mt-8 grid grid-cols-[repeat(auto-fit,minmax(130px,1fr))] gap-x-4 gap-y-10 md:grid-cols-4 md:gap-y-8 md:gap-x-7 xl:gap-x-[57px]">
			<?php foreach ($awards_items as $award):
			?>
				<li class="relative group h-[41px] min-w-[155px] xl:h-[69px] xl:min-w-[261px]">
					<?= wp_get_attachment_image(
						$award['image']['ID'],
						'full',
						false,
						[
							'class'   => 'w-full h-full object-contain',
							'loading' => 'lazy',
						]
					); ?>

					<?php if (!empty($award['desc'])): ?>
						<!-- Mobile: visible below image -->
						<p class="text-center mt-2 text-sm text-gray-600 md:hidden">
							<?= esc_html($award['desc']); ?>
						</p>

						<!-- Desktop: tooltip -->
						<div class="hidden xl:block absolute left-0 top-full 
									w-max max-w-[260px] 
									rounded-xl bg-white shadow-lg 
									px-4 py-2 text-sm text-gray-800 
									opacity-0 invisible 
									transition-all duration-200 
									group-hover:opacity-100 group-hover:visible
									z-50">
							<?= esc_html($award['desc']); ?>
						</div>
					<?php endif; ?>

				</li>
			<?php endforeach; ?>
		</ul>
	</div>
</section>

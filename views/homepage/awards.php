<?php
// ACF fields
$show_section = get_field('show_awards_section');
$title        = get_field('awards_section_title') ?: 'НАШІ НАГОРОДИ';
$description        = get_field('awards_low_title');
$awards_items = get_field('awards_items');

// Don't render if section disabled or empty
if (!$show_section || empty($awards_items)) return;
?>

<section class="section">
	<div class="container">

		<!-- Section Title -->
		<?php if ($title): ?>
			<h2 class="section-title">
				<?= esc_html($title); ?>
			</h2>
		<?php endif; ?>

		<?php if ($description): ?>
			<p class="mt-5 md:mt-8 text-[20px]/[28px] font-medium uppercase md:text-[24px]/[32px] text-center"><?= esc_html($description); ?></h2>
			</p>
		<?php endif; ?>

		<!-- Awards / Logos Grid -->
		<ul class="mt-5 md:mt-16 grid grid-cols-[repeat(auto-fit,minmax(130px,1fr))] gap-x-4 gap-y-10 md:grid-cols-4 md:gap-8 md:gap-x-7 xl:gap-x-[57px]">
			<?php foreach ($awards_items as $award):
			?>
				<li class="h-[41px] min-w-[155px] xl:h-[69px] xl:min-w-[261px]">
					<?= wp_get_attachment_image(
						$award['image']['ID'], // ID зображення
						'full',          // size
						false,           // icon
						[
							'class'   => 'w-full h-full object-contain',
							'loading' => 'lazy',
						]
					); ?>
				</li>
			<?php endforeach; ?>
		</ul>
	</div>
</section>
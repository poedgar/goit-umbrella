<?php
// Retrieve values from ACF
$show_section   = get_field('show_ecosystem_section');
$right_image      = get_field('ecosystem_right_image');
$subtitle       = get_field('ecosystem_subtitle');
$left_image     = get_field('ecosystem_left_image');
$right_images   = get_field('ecosystem_right_images') ?: [];
$logos          = get_field('ecosystem_logos') ?: [];

// Take first image from right_images for top image
$top_image_mobile = '';
if (!empty($right_images)) {
    foreach ($right_images as $ri) {
        if (!empty($ri['image'])) {
            $top_image_mobile = $ri['image'];
            break; // first valid image
        }
    }
}

// Don't render if disabled
if (!$show_section) return;
?>

<section id="ecosystem" class="section !pt-[60px] md:!pt-8">
	<div class="container">
		<!-- MOBILE -->
		<div class="grid md:hidden items-center justify-center gap-5">
			<!-- top image -->
			  <?php if ($top_image_mobile): ?>
				<div class="animated-card card-orange mobile relative w-full h-[120px] mb-2">
					<img src="<?= esc_url($top_image_mobile); ?>" alt="Обличчя людей" class="w-full h-full object-cover rounded-[4px]">
					<div class="overlay absolute inset-0"></div>
				</div>
    		  <?php endif; ?>

			<!-- logo image with text-->
			<?php if ($left_image): ?>
				<!-- Better -->
				<img src="<?php echo $left_image['url']; ?>" alt="<?php echo esc_attr($left_image['alt']); ?>"
					class="mx-auto">
			<?php endif; ?>

			<div class="flex justify-between items-end gap-5">
				<?php if ($subtitle): ?>
					<div class="uppercase font-medium text-[24px]/[36px] text-gray smOnly:mb-[-9px]">
						<?= wp_kses_post(wpautop($subtitle)); ?></div>
				<?php endif; ?>

				<?php if ($right_image): ?>
					<!-- ED -->
					<img src="<?= $right_image['url']; ?>" alt="<?= esc_attr($left_image['alt']); ?>"
						class="shrink-0">
				<?php endif; ?>
			</div>

			<!-- Right: stacked images -->
<?php if (!empty($right_images) && count($right_images) > 1): ?>
    <?php
    $lower_cards = array_slice($right_images, 1, 2);
    $colors = ['card-yellow', 'card-purple'];
    $i = 0;
    ?>
    <?php foreach ($lower_cards as $ri): ?>
        <?php
        $img = $ri['image'] ?? '';
        if (!$img) continue;
        $color_class = $colors[$i] ?? 'card-purple';
        $i++;
        ?>
        <div class="animated-card <?= $color_class ?> mobile relative w-full h-[120px] mb-2">
            <img src="<?= esc_url($img) ?>" alt="Обличчя людей" class="w-full h-full object-cover rounded-[4px]">
            <div class="overlay absolute inset-0"></div>
        </div>
    <?php endforeach; ?>
<?php endif; ?>


		</div>

		<!-- DESKTOP -->
		<div class="hidden md:flex flex-col gap-8">
			<!-- LEFT: Better + ED + left/right images -->
			<div class="flex items-start">
				<!-- LEFT IMAGE (small vertical block) -->
				<?php if ($left_image): ?>
					<div class="w-[547px] xl:w-[941px] h-auto">
						<img src="<?= $left_image['url']; ?>" alt="<?= esc_attr($left_image['alt']); ?>"
							class="w-full h-full object-cover">
					</div>
				<?php endif; ?>
			</div>

			<!-- RIGHT COLUMN: stacked 3 images -->
			<div class="flex flex-col">
				<div class="flex gap-[18px] md:gap-6 xl:gap-8 ml-auto">
					<!-- RIGHT IMAGE under the ED row -->
					<?php if ($right_image): ?>
						<img src="<?= $right_image['url']; ?>" alt="<?= esc_attr($right_image['alt']); ?>"
							class="w-[236px] xl:w-[406px]">
					<?php endif; ?>

					<div class="flex colorful-cards flex-col gap-1 md:gap-2 relative">
						<?php
						if (!empty($right_images)):
							$i = 0;
							foreach ($right_images as $ri):
								$img = $ri['image'] ?? '';
								if (!$img) continue;

								// take only 3 for desktop to match design
								if ($i >= 3) break;
								$i++;

								 $color_class = $i === 1 ? 'card-orange' : ($i === 2 ? 'card-yellow' : 'card-purple');
						?>
								<div class="animated-card <?= $color_class ?> desktop relative w-[224px] xl:w-[384px] h-[42px] xl:h-[72px]">
									<img src="<?= esc_url($img) ?>" alt="" class="w-full h-full object-cover rounded-[4px] xl:rounded-lg">
									<div class="overlay absolute inset-0"></div>
								</div>

						<?php endforeach;
						endif; ?>
					</div>
				</div>

				<!-- Under images text -->
				<?php if ($subtitle): ?>
					<div class="flex justify-end mt-1 md:mt-2">
						<h2 class="text-gray text-[18px]/[21px] tracking-[1.565px] xl:tracking-[1.99px] xl:text-[32px]/[36px] font-normal uppercase">
							<?= wp_kses_post($subtitle); ?>
						</h2>
					</div>
				<?php endif; ?>
			</div>
		</div>

		<?php if (!empty($logos)): ?>
			<div class="mt-20 md:mt-9 xl:mt-16 flex flex-wrap md:flex-nowrap items-center justify-center md:justify-between gap-8">
				<?php foreach ($logos as $lg):
					$image = $lg['image'] ?? '';
					$alt   = $lg['alt'] ?? '';
					if (!$image) continue;
				?>
					<img src="<?= esc_url($image); ?>" alt="<?= esc_attr($alt); ?>" class="h-[51px] w-auto md:h-[47px] xl:h-[80px]">
				<?php endforeach; ?>
			</div>
		<?php endif; ?>
	</div>
</section>

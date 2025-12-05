<?php
// Retrieve values from ACF
$show_section   = get_field('show_ecosystem_section');
$top_image_mobile = get_field('ecosystem_top_image_for_mobile');
$right_image      = get_field('ecosystem_right_image');
$subtitle       = get_field('ecosystem_subtitle');
$left_image     = get_field('ecosystem_left_image');
$right_images   = get_field('ecosystem_right_images') ?: [];
$logos          = get_field('ecosystem_logos') ?: [];

// Don't render if disabled
if (!$show_section) return;
?>

<section class="section">
    <div class="container">
        <!-- MOBILE -->
        <div class="grid grid-cols-1 md:hidden items-center">
            <div>
                <?php if ($top_image_mobile): ?>
                <div class="w-full h-auto">
                    <img src="<?= $top_image_mobile['url']; ?>" alt="<?= $top_image_mobile['alt']; ?>"
                        class="w-full h-full object-cover">
                </div>
                <?php endif; ?>

                <?php if ($left_image || $right_image): ?>
                <div class="mt-5 flex flex-col">
                    <?php if ($left_image): ?>
                    <div class="w-full h-auto">
                        <img src="<?php echo $left_image['url']; ?>" alt="<?php echo esc_attr($left_image['alt']); ?>"
                            class="w-full h-full object-cover">
                    </div>
                    <?php endif; ?>

                    <div class="flex justify-between items-end gap-5 mt-5">
                        <?php if ($subtitle): ?>
                        <h1 class="max-w-[162px] uppercase font-medium text-[24px]/[28px] text-gray max-w-xl">
                            <?= wp_kses_post(wpautop($subtitle)); ?></h1>
                        <?php endif; ?>

                        <?php if ($right_image): ?>
                        <div class="min-h-20">
                            <img src="<?= $right_image['url']; ?>" alt="<?= esc_attr($left_image['alt']); ?>"
                                class="w-full object-cover">
                        </div>
                        <?php endif; ?>
                    </div>
                </div>
                <?php endif; ?>
            </div>

            <!-- Right: stacked images -->
            <div class="flex flex-col items-center mt-5">
                <div class="flex flex-col gap-5 w-full">
                    <?php if (!empty($right_images)): ?>
                    <?php
						$first = true; // Flag to track the first iteration

						foreach ($right_images as $ri):
							// Skip if no image URL
							$image_url = $ri['image'] ?? '';
							if (!$image_url) {
								continue;
							}

							// Skip the very first valid image
							if ($first) {
								$first = false;
								continue;
							}

							// Output the image (all except the first one)
							?>
                    <div class="w-full h-auto">
                        <img src="<?= esc_url($image_url) ?>" alt="" class="w-full h-full object-cover">
                    </div>
                    <?php
						endforeach;
						?>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <!-- DESKTOP -->
        <div class="hidden md:flex flex-col">
            <!-- LEFT: Better + ED + left/right images -->
            <div class="flex flex-col gap-8">
                <div class="flex items-start">
                    <!-- LEFT IMAGE (small vertical block) -->
                    <?php if ($left_image): ?>
                    <div class="w-[547px] xl:w-[941px] h-auto">
                        <img src="<?= $left_image['url']; ?>" alt="<?= esc_attr($left_image['alt']); ?>"
                            class="w-full h-full object-cover rounded-md">
                    </div>
                    <?php endif; ?>
                </div>
            </div>

            <!-- RIGHT COLUMN: stacked 3 images -->
            <div class="mt-[18px] flex flex-col">
                <div class="flex gap-[18px] md:gap-6 ml-auto">
                    <!-- RIGHT IMAGE under the ED row -->
                    <?php if ($right_image): ?>
                    <div class="w-[236px] md:w-[406px] h-[134px] md:h-[232px]">
                        <img src="<?= $right_image['url']; ?>" alt="<?= esc_attr($right_image['alt']); ?>"
                            class="w-full h-full object-cover rounded-md">
                    </div>
                    <?php endif; ?>

                    <div class="flex flex-col gap-1 md:gap-2">
                        <?php
							if (!empty($right_images)):
								$i = 0;
								foreach ($right_images as $ri):
									$img = $ri['image'] ?? '';
									if (!$img) continue;

									// take only 3 for desktop to match design
									if ($i >= 3) break;
									$i++;
						?>
                        <div class="w-[223px] xl:w-[384px] h-[41px] xl:h-[72px]">
                            <img src="<?= esc_url($img) ?>" alt="" class="w-full h-full object-cover">
                        </div>

                        <?php endforeach; endif; ?>
                    </div>
                </div>

                <!-- Under images text -->
                <?php if ($subtitle): ?>
                <div class="flex justify-end mt-1 md:mt-2">
                    <h2 class="text-gray text-[18px]/[21px] md:text-[32px]/[36px] font-semibold uppercase">
                        <?= wp_kses_post($subtitle); ?>
                    </h2>
                </div>
                <?php endif; ?>
            </div>
        </div>

        <?php if (!empty($logos)): ?>
        <div class="mt-20 md:mt-[37px] xl:mt-16">
            <div class="flex flex-wrap md:flex-nowrap items-center justify-between md:justify-between gap-8">
                <?php foreach ($logos as $lg):
                    $image = $lg['image'] ?? '';
                    $alt   = $lg['alt'] ?? '';
                    if (!$image) continue;
                ?>
                <div class="flex items-center w-[20%]">
                    <img src="<?= esc_url($image); ?>" alt="<?= esc_attr($alt); ?>" class="w-full h-full object-cover">
                </div>
                <?php endforeach; ?>
            </div>
        </div>
        <?php endif; ?>
    </div>
</section>
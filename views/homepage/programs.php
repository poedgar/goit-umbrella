<?php
// Retrieve ACF values
$show_section = get_field('show_programs_section');
$title        = get_field('programs_title') ?: 'СТВОРЮЄМО НОВУ КУЛЬТУРУ ОСВІТИ';
$description  = get_field('programs_description') ?: 'Better ED — екосистема онлайн IT-освіти та кар\'єрного розвитку від дитинства до зрілості';
$items        = get_field('programs_items') ?: [];

// Don't render if section disabled or empty
if (!$show_section || empty($items)) return;
?>

<section id="programs" class="section">
    <div class="container">
        <!-- Section Title -->
        <h2 class="section-title"><?= $title ?></h2>

        <!-- Section  Description -->
        <p class="low-section-title mt-5 md:mt-8"><?= $description ?></p>

        <div class="mt-5 md:mt-16 grid gap-5 md:gap-16">
            <?php foreach ($items as $index => $item):
				$reverse = ($index % 2 === 1) ? 'xl:flex-row-reverse' : 'xl:flex-row';
				$company_id = $item['company']->ID ?? '';

				// Collect all logos
				$sites = get_field('sites', $company_id);
				$all_logos = [];
				if ($sites) {
					foreach ($sites as $site) {
						if (!empty($site['logo'])) {
							$all_logos[] = $site['logo'];
						}
					}
				}

				// Stat cards values
				$bg                = $item['bg_color'] ?? '#F5A623';
				$top_value          = $item['stat_top_value'] ?? '';
				$top_description    = $item['stat_top_description'] ?? '';
				$middle_value       = $item['stat_middle_value'] ?? '';
				$middle_description = $item['stat_middle_description'] ?? '';
				$bottom_value       = $item['stat_bottom_value'] ?? '';
				$bottom_description = $item['stat_bottom_description'] ?? '';

				    // Gap class based on company ID (NeoVersity)
				$gap_class = ($company_id === 95) ? 'md:gap-4' : 'md:gap-8';
			?>

            <div class="flex flex-col <?= $reverse ?> p-5 md:p-0 gap-5 md:gap-8">

                <!-- COLUMN: Logos and Site Info -->
                <div class="grid gap-20 md:gap-8 md:p-8 xl:w-[592px]">

                    <!-- Logos for desktop -->
                    <div class="hidden md:flex gap-8 h-20">
                        <?php foreach ($all_logos as $logo): ?>
                        <?php if ($logo): ?>
                        <img src="<?= esc_url($logo['url']); ?>" alt="<?= esc_attr($logo['alt']); ?>"
                            class="w-auto h-full">
                        <?php endif; ?>
                        <?php endforeach; ?>
                    </div>

                    <!-- Sites info -->
                    <?php if (have_rows('sites', $company_id)): ?>
                    <?php while (have_rows('sites', $company_id)): the_row();
								$site_logo      = get_sub_field('logo');
								$site_subtitle  = get_sub_field('subtitle');
								$supporter_img  = get_sub_field('site_supporter')['supporter_image'] ?? '';
								$site_desc      = get_sub_field('description');
								$url            = get_sub_field('url');
								$social         = get_sub_field('social') ?: [];
							?>
                    <div class="flex flex-col smOnly:items-center gap-5 <?= esc_attr($gap_class); ?>">
                        <!-- Mobile logo -->
                        <?php if ($site_logo): ?>
                        <img src="<?= esc_url($site_logo['url']); ?>" alt="<?= esc_attr($site_logo['alt']); ?>"
                            class="md:hidden w-auto h-[80px] <?= ($index === 2 ? 'mb-[60px]' : '') ?>">
                        <?php endif; ?>

                        <!-- Subtitle & supporter -->
                        <?php if ($site_subtitle || $supporter_img): ?>
                        <div class="flex flex-col md:flex-row items-center md:justify-between gap-5">
                            <?php if ($site_subtitle): ?>
                            <p
                                class="text-gray smOnly:text-center font-medium uppercase text-[20px]/[28px] md:text-[24px]/[32px]">
                                <?= wp_kses_post($site_subtitle); ?></p>
                            <?php endif; ?>
                            <?php if ($supporter_img): ?>
                            <img src="<?= esc_url($supporter_img['url']); ?>"
                                alt="<?= esc_attr($supporter_img['alt']); ?>" class="w-[178px] h-auto">
                            <?php endif; ?>
                        </div>
                        <?php endif; ?>

                        <!-- Description -->
                        <?php if ($site_desc): ?>
                        <h3><?= wp_kses_post($site_desc); ?></h3>
                        <?php endif; ?>

                        <!-- Buttons -->
                        <div class="flex justify-between md:justify-start gap-4 md:gap-8 w-full">
                            <a href="<?= esc_url($url); ?>" class="btn btn-black !w-[130px]" target="_blank"
                                rel="noopener noreferrer" aria-label="Відкрити cайт у новій вкладці">сайт</a>

                            <a href="mailto:<?= esc_attr($social['mail'] ?? ''); ?>"
                                class="btn btn-transparent !w-[130px]">зв'язатися</a>
                        </div>

                    </div>
                    <?php endwhile; ?>
                    <?php endif; ?>

                </div> <!-- END COLUMN -->

                <!-- COLUMN: Statistic Card -->
                <div class="flex flex-col gap-5 p-5 md:p-8 md:gap-8 justify-center items-center rounded-lg text-center xl:w-[592px]"
                    data-counter-container style="background:<?= esc_attr($bg); ?>; color:#111;">

                    <?php
						$stats = [
							['value' => $top_value, 'desc' => $top_description],
							['value' => $middle_value, 'desc' => $middle_description],
							['value' => $bottom_value, 'desc' => $bottom_description],
						];
						?>

                    <?php foreach ($stats as $stat): ?>
                    <div>
                        <?php if ($stat['value']): ?>
                        <div class="text-[32px]/[24px] md:text-[48px]/[1] font-black font-unbounded"
                            data-counter="<?= wp_kses_post($stat['value']); ?>"></div>
                        <?php endif; ?>
                        <?php if ($stat['desc']): ?>
                        <div class="text-xl/[28px] font-medium mt-2 uppercase"><?= wp_kses_post($stat['desc']); ?></div>
                        <?php endif; ?>
                    </div>
                    <?php endforeach; ?>

                </div> <!-- END COLUMN -->

            </div> <!-- END ITEM FLEX -->

            <?php endforeach; ?>

        </div> <!-- END GRID -->

    </div> <!-- END CONTAINER -->
</section>

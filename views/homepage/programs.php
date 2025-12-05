<?php
// Retrieve ACF values
$show_section = get_field('show_programs_section');
$title        = get_field('programs_title') ?: 'СТВОРЮЄМО НОВУ КУЛЬТУРУ ОСВІТИ';
$description  = get_field('programs_description') ?: 'Better ED — екосистема онлайн IT-освіти та кар"єрного розвитку від дитинства до зрілості';
$items        = get_field('programs_items') ?: [];

// Don't render if section disabled or empty
if (!$show_section || empty($items)) return;
?>

<section class="section font-unbounded">
    <div class="container">
        <!-- Section Title -->
        <h2 class="text-[32px]/[36px] md:text-[48px]/[48px] font-black text-center">
            <?= esc_html($title); ?>
        </h2>

        <!-- Description Title -->
        <p class="mt-5 md:mt-8 text-xl/[28px] text-[32px]/[36px] text-gray font-medium text-center">
            <?= esc_html($description); ?>
        </p>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mt-[52px] md:mt-[96px]">
            <div class="space-y-10 md:space-y-[96px]">
                <?php foreach ($items as $index => $item):
					$reverse = ($index % 2 === 1) ? 'xl:flex-row-reverse' : 'xl:flex-row';

                    $company_id   = $item['company']->ID ?? '';

                $sites = get_field('sites', $company_id); // Get full repeater field
                $all_logos = [];

                if ($sites) {
					foreach ($sites as $site) {
						if (!empty($site['logo'])) {
							$all_logos[] = $site['logo']; // Collect logo
						}
					}
                }
				?>
                <div class="flex flex-col <?= $reverse ?> gap-20 md:gap-16 xl:gap-8">
                    <!-- LEFT COLUMN: STAT CARDS -->
                    <div class="space-y-10 md:space-y-[96px] xl:space-y-8 xl:w-[50%] xl:p-8">
                        <div class="hidden md:flex gap-8">
                            <?php
					if ($all_logos) {
						foreach ($all_logos as $logo) {
							if (!$logo) continue; // skip empty ones
							// $logo is an ACF image array
							$url = $logo['url'] ?? '';
							$alt = $logo['alt'] ?? '';
?>
                            <div class="">
                                <?php if ($logo): ?>
                                <div class="w-[224px] h-[54px]">
                                    <img src="<?= esc_url($logo['url']); ?>" alt="<?= esc_attr($logo['alt']); ?>"
                                        class="w-full h-full object-cover">
                                </div>
                                <?php endif; ?>
                            </div>
                            <?php
                        }
                        }
                        ?>
                        </div>

                        <?php if (have_rows('sites', $company_id)): ?>
                        <?php while (have_rows('sites', $company_id)): the_row();
				        $site_logo   = get_sub_field('logo');
                        $site_name   = get_sub_field('name');
						$site_subtitle   = get_sub_field('subtitle');
						$supporter_image  = get_sub_field('site_supporter')['supporter_image'] ?? '';
						$site_description   = get_sub_field('description');
                        $url    = get_sub_field('url');
                        $social = get_sub_field('social') ?: [];
                        $has_social = !empty(array_filter($social));
                    ?>
                        <div class="flex flex-col justify-center">
                            <div class="flex-1 flex-col justify-center items-center xl:items-start">
                                <?php if ($site_logo): ?>
                                <div class="w-[224px] h-[54px] md:hidden">
                                    <img src="<?= esc_url($site_logo['url']); ?>"
                                        alt="<?= esc_attr($site_logo['alt']); ?>" class="w-full h-full object-cover">
                                </div>
                                <?php endif; ?>

                                <?php if ($site_subtitle || $supporter_image): ?>
                                <div
                                    class="flex flex-col md:flex-row items-center md:justify-between gap-5 w-full mt-5 md:mt-8 xl:mt-0 text-xl/[28px] md:text-[24px]/[32px] font-medium text-gray">
                                    <?php if ($site_subtitle): ?>
                                    <p>
                                        <?= esc_html($site_subtitle); ?>
                                    </p>
                                    <?php endif; ?>

                                    <?php if ($supporter_image): ?>
                                    <div class="w-[178px] h-[32px]">
                                        <img src="<?= esc_url($supporter_image['url']); ?>"
                                            alt="<?= esc_attr($supporter_image['alt']); ?>"
                                            class="w-full h-full object-cover">
                                    </div>
                                    <?php endif; ?>
                                </div>
                                <?php endif; ?>

                                <?php if ($site_description): ?>
                                <h3 class="text-base/[24px] mt-5 md:mt-4">
                                    <?= esc_html($site_description); ?>
                                </h3>
                                <?php endif; ?>

                                <div
                                    class="flex justify-between md:justify-start gap-4 md:gap-8 w-full mt-5 text-xl/[28px] text-xl/[28px] font-medium text-gray">
                                    <a href="<?= esc_url($url); ?>"
                                        class="flex justify-center items-center min-w-[130px] md:min-w-[] h-[44px] bg-black text-white border-2 px-4 py-2 rounded hover:bg-black hover:text-white transition">
                                        сайт
                                    </a>

                                    <a href="<?php echo 'mailto:' . $social['mail']; ?>"
                                        class="flex justify-center items-center min-w-[130px] h-[44px] bg-white border-2 px-4 py-2 rounded hover:bg-black hover:text-white transition">
                                        зв'язатися
                                    </a>
                                </div>
                            </div>
                        </div>
                        <?php endwhile; ?>
                        <?php endif; ?>
                    </div>

                    <!-- RIGHT COLUMN: STAT CARDS -->
                    <?php
					$bg = $item['bg_color'] ?? '#F5A623';
					$top_value = $item['stat_top_value'] ?? '';
					$top_description = $item['stat_top_description'] ?? '';
					$middle_value = $item['stat_middle_value'] ?? '';
					$middle_description = $item['stat_middle_description'] ?? '';
					$bottom_value = $item['stat_bottom_value'] ?? '';
					$bottom_description = $item['stat_bottom_description'] ?? '';

				?>
                    <div class="flex flex-col gap-8 p-5 md:p-8 xl:justify-center xl:items-center rounded-lg text-center xl:w-[50%]"
                        style="background:<?= esc_attr($bg); ?>; color:#111;">
                        <div class="flex flex-col gap-2 md:gap-2">
                            <?php if ($top_value): ?>
                            <div class="text-[32px]/[36px] md:text-[48px]/[48px] font-unbounded font-black">
                                <?= esc_html($top_value); ?>
                            </div>
                            <?php endif; ?>

                            <?php if ($top_description): ?>
                            <div class="text-xl/[28px]">
                                <?= esc_html($top_description); ?>
                            </div>
                            <?php endif; ?>
                        </div>

                        <div class="flex flex-col gap-2">
                            <?php if ($middle_value): ?>
                            <div class="text-[32px]/[36px] font-unbounded font-black">
                                <?= esc_html($middle_value); ?>
                            </div>
                            <?php endif; ?>

                            <?php if ($middle_description): ?>
                            <div class="text-xl/[28px]">
                                <?= esc_html($middle_description); ?>
                            </div>
                            <?php endif; ?>
                        </div>

                        <div class="flex flex-col gap-2">
                            <?php if ($bottom_value): ?>
                            <div class="text-[32px]/[36px] font-unbounded font-black">
                                <?= esc_html($bottom_value); ?>
                            </div>
                            <?php endif; ?>

                            <?php if ($bottom_description): ?>
                            <div class="text-xl/[28px]">
                                <?= esc_html($bottom_description); ?>
                            </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</section>
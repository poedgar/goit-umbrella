<section id="ai-base" class="section">
  <div class="container">
    <?php
    $show_section = get_field('show_ai_base_section');
    if ($show_section) :
        $main_title = get_field('ai_base_main_title') ?: 'AI БАЗА';
        $subtitle = get_field('ai_base_subtitle') ?: 'ОСНОВИ AI-ГРАМОТНОСТІ ДЛЯ ВСІХ ПОКОЛІНЬ';
        $course_cards = get_field('ai_course_cards');

        $icon_map = [
            "📁" => get_template_directory_uri() . "/src/images/homepage/ai-base/0.png",
            "❤️" => get_template_directory_uri() . "/src/images/homepage/ai-base/1.png",
            "⚙️" => get_template_directory_uri() . "/src/images/homepage/ai-base/2.png",
            "💬" => get_template_directory_uri() . "/src/images/homepage/ai-base/3.png",
            "🖼️" => get_template_directory_uri() . "/src/images/homepage/ai-base/4.png",
            "🤖" => get_template_directory_uri() . "/src/images/homepage/ai-base/5.png",
            "▶️" => get_template_directory_uri() . "/src/images/homepage/ai-base/6.png",
            "👥" => get_template_directory_uri() . "/src/images/homepage/ai-base/7.png",
            "💻" => get_template_directory_uri() . "/src/images/homepage/ai-base/8.png",
        ];
    ?>
    <div class="bg-black text-white p-[20px] md:py-8 md:px-8 xl:py-[128px] xl:px-[64px] rounded-[8px]">
        <!-- Header -->
        <div class="">
            <h1 class="section-title">
                <?php echo esc_html($main_title); ?>
            </h1>

            <p class="low-section-title !text-white mdOnly:text-[32px]/[40px] mt-5 md:mt-8">
                <?php echo esc_html($subtitle); ?>
            </p>

            <div class="flex mt-8 gap-5 md:gap-4 md:justify-center">
                <img src="<?php echo get_template_directory_uri(); ?>/src/images/homepage/ai-base/lock.png" alt="декорація" class="w-6 h-6">
                
                <p class="text-[#FF8856] text-[16px]/[24px] md:text-[20px]/[20px]">
                    Відкритий доступ до навчання протягом березня
                </p>
            </div>
        </div>

        <!-- AI Course Cards -->
        <div class="grid gap-10 md:gap-16 xl:gap-8 xl:grid-cols-3 mt-10 md:mt-16">
        <?php 
        // Loop through course cards from ACF
        if ($course_cards) : 
            foreach ($course_cards as $card) : 
                
                // Define badge color class
                $badge_color = '';
                switch ($card['card_badge_color']) {
                    case 'yellow':
                        $badge_color = 'bg-[#FFBD01] text-black';
                        break;
                    case 'orange':
                        $badge_color = 'bg-[#FF8856] text-black';
                        break;
                    case 'purple':
                        $badge_color = 'bg-[#A472FF] text-black';
                        break;
                    default:
                        $badge_color = 'bg-[#FF8856] text-black';
                }

                var_dump($badge_color);
                
                // Get image
                $image = $card['card_image'];
                $image_url = $image ? $image['url'] : '';
                $image_alt = $image ? $image['alt'] : $card['card_title'];
                
                // Get button text and link
                $button_text = !empty($card['button_text']) ? $card['button_text'] : 'розпочати';
                $button_link = !empty($card['button_link']) ? $card['button_link'] : '#';
        ?>
        
        <!-- AI Course Card -->
        <div class="flex flex-col">
            <!-- Badges -->
            <div class="flex flex-wrap items-center gap-2 mb-4 text-[16px]/[16px]">
                <span class="<?php echo $badge_color; ?> p-1 rounded-[4px]">
                    <?php echo esc_html($card['card_title']); ?>
                </span>
                
                <?php if ($card['show_free_badge']) : ?>
                <span class="bg-[linear-gradient(135deg,#5A05F4,#FF8856,#FFC72F)] text-black p-1 rounded-[4px]">free</span>
                <?php endif; ?>
                
                <span class="bg-neutral-800 p-1 rounded-[4px]">
                    <?php echo esc_html($card['card_audience']); ?>
                </span>

                <!-- break тільки на mobile -->
                <div class="w-full md:hidden"></div>

                <span class="bg-neutral-800 p-1 rounded-[4px]">онлайн</span>

                <!-- break mobile + xl -->
                <div class="xl:w-full md:hidden xl:block"></div>

                <span class="bg-neutral-800 p-1 rounded-[4px]">
                    <?php echo esc_html($card['card_lectures']); ?>
                </span>
            </div>

            <!-- Image -->
            <div class="rounded-[8px] overflow-hidden mb-4">
            <?php if ($image_url) : ?>
                <img src="<?php echo esc_url($image_url); ?>" 
                    alt="<?php echo esc_attr($image_alt); ?>" 
                    class="w-full h-[157px] md:h-[360px] xl:h-[192px] object-cover">
            <?php endif; ?>
            </div>

            <!-- Title -->
            <h3 class="uppercase xl:min-h-[96px] text-[20px]/[28px] md:text-[24px]/[32px] font-medium mb-8">
            <?php echo wp_kses_post($card['course_title']); ?>
            </h3>

            <!-- Features List -->
            <?php if (!empty($card['course_features'])) : ?>
            <ul class="space-y-4 text-[16px]/[24px] text-gray-300 mb-[40px]">
            <?php foreach ($card['course_features'] as $feature) : ?>
            <li class="flex gap-4">
                <span class="w-6 h-6 flex flex-shrink-0 items-center justify-center">
                    <?php 
                        $icon = $feature['feature_icon'];
                        if (isset($icon_map[$icon])) {
                            echo '<img src="' . esc_url($icon_map[$icon]) . '" alt="" class="w-6 h-6 object-contain">';
                        } else {
                            echo esc_html($icon); // fallback if not found
                        }
                    ?>
                </span>                
                <?php echo esc_html($feature['feature_text']); ?>
            </li>
            <?php endforeach; ?>
            </ul>
            <?php endif; ?>

            <!-- Button -->
            <a target="_blank" href="<?php echo esc_url($button_link); ?>" 
            class="btn-border-gradient-ai-base mt-auto w-[126px] h-[44px] text-white text-[20px]/[28px] border border-white px-4 py-2 rounded-[4px] hover:!bg-black text-center inline-block">
            <?php echo esc_html($button_text); ?>
            </a>
        </div>
        <?php 
            endforeach; 
        ?>
        <?php endif; // course_cards check ?>
        </div>
    </div>
    <?php endif; // show_section check ?>
  </div>
</section>
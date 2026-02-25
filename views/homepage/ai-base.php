<section id="ai-base" class="section">
  <div class="container">
    <?php
    // Get ACF fields
    $show_section = get_field('show_ai_base_section');
    if ($show_section) :
        $main_title = get_field('ai_base_main_title') ?: 'AI БАЗА';
        $subtitle = get_field('ai_base_subtitle') ?: 'ОСНОВИ AI-ГРАМОТНОСТІ ДЛЯ ВСІХ ПОКОЛІНЬ';
        $course_cards = get_field('ai_course_cards');
    ?>
    <div class="bg-black text-white xl:py-[64px] xl:px-[128px]">
        <!-- Header -->
        <div class="">
            <h1 class="section-title">
                <?php echo esc_html($main_title); ?>
            </h1>

            <p class="low-section-title mdOnly:text-[32px]/[40px] mt-5 md:mt-8">
                <?php echo esc_html($subtitle); ?>
            </p>
        </div>

        <!-- AI Course Cards -->
        <div class="grid gap-10 xl:grid-cols-3">

        <?php 
        // Loop through course cards from ACF
        if ($course_cards) : 
            foreach ($course_cards as $card) : 
                
                // Define badge color class
                $badge_color = '';
                switch ($card['card_badge_color']) {
                    case 'yellow':
                        $badge_color = 'bg-yellow-400 text-black';
                        break;
                    case 'orange':
                        $badge_color = 'bg-orange-500 text-black';
                        break;
                    case 'purple':
                        $badge_color = 'bg-purple-600 text-white';
                        break;
                    case 'blue':
                        $badge_color = 'bg-blue-600 text-white';
                        break;
                    case 'green':
                        $badge_color = 'bg-green-600 text-white';
                        break;
                    case 'red':
                        $badge_color = 'bg-red-600 text-white';
                        break;
                    default:
                        $badge_color = 'bg-yellow-400 text-black';
                }
                
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
            <div class="flex flex-wrap gap-2 mb-4 text-sm">
            <span class="<?php echo $badge_color; ?> px-3 py-1 rounded-full font-medium">
                <?php echo esc_html($card['card_title']); ?>
            </span>
            
            <?php if ($card['show_free_badge']) : ?>
            <span class="bg-pink-500 px-3 py-1 rounded-full">free</span>
            <?php endif; ?>
            
            <span class="bg-gray-700 px-3 py-1 rounded-full">
                <?php echo esc_html($card['card_audience']); ?>
            </span>
            
            <span class="bg-gray-700 px-3 py-1 rounded-full">онлайн</span>
            </div>

            <!-- Image -->
            <div class="rounded-2xl overflow-hidden mb-6">
            <?php if ($image_url) : ?>
                <img src="<?php echo esc_url($image_url); ?>" 
                    alt="<?php echo esc_attr($image_alt); ?>" 
                    class="w-full h-56 object-cover">
            <?php else : ?>
                <!-- Fallback gradient with icon -->
                <div class="w-full h-56 bg-gradient-to-br from-gray-800 to-gray-900 flex items-center justify-center text-6xl">
                <?php 
                // Different emoji based on card index or title
                $title_lower = strtolower($card['card_title']);
                if (strpos($title_lower, 'teen') !== false) echo '📚';
                elseif (strpos($title_lower, 'goit') !== false) echo '🚀';
                elseif (strpos($title_lower, 'neoversity') !== false) echo '💡';
                else echo '🤖';
                ?>
                </div>
            <?php endif; ?>
            </div>

            <!-- Title -->
            <h3 class="text-xl font-semibold mb-6 leading-snug">
            <?php echo esc_html($card['course_title']); ?>
            </h3>

            <!-- Features List -->
            <?php if (!empty($card['course_features'])) : ?>
            <ul class="space-y-4 text-gray-300 mb-8">
            <?php foreach ($card['course_features'] as $feature) : ?>
            <li class="flex gap-3">
                <span><?php echo $feature['feature_icon']; ?></span>
                <?php echo esc_html($feature['feature_text']); ?>
            </li>
            <?php endforeach; ?>
            </ul>
            <?php endif; ?>

            <!-- Additional Badge if exists -->
            <?php if (!empty($card['card_badge_text'])) : ?>
            <div class="text-sm text-gray-400 mb-4 flex items-center gap-2">
            <span class="inline-block w-2 h-2 bg-pink-500 rounded-full"></span>
            <?php echo esc_html($card['card_badge_text']); ?>
            </div>
            <?php endif; ?>

            <!-- Button -->
            <a href="<?php echo esc_url($button_link); ?>" 
            class="mt-auto border border-white px-6 py-3 rounded-lg hover:bg-white hover:text-black transition text-center inline-block w-full md:w-auto">
            <?php echo esc_html($button_text); ?>
            </a>
        </div>
        
        <?php 
            endforeach; 
        else : 
            // Default/fallback cards if no ACF data
        ?>
        
        <!-- Default Card 1 - GoITeens -->
        <div class="flex flex-col">
            <div class="flex flex-wrap gap-2 mb-4 text-sm">
            <span class="bg-yellow-400 text-black px-3 py-1 rounded-full font-medium">GoITeens</span>
            <span class="bg-pink-500 px-3 py-1 rounded-full">free</span>
            <span class="bg-gray-700 px-3 py-1 rounded-full">для підлітків</span>
            <span class="bg-gray-700 px-3 py-1 rounded-full">онлайн</span>
            </div>

            <!-- Default image -->
            <div class="rounded-2xl overflow-hidden mb-6">
            <img src="https://images.unsplash.com/photo-1522202176988-66273c2fd55f?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&q=80" 
                alt="Teens learning AI" 
                class="w-full h-56 object-cover">
            </div>

            <h3 class="text-xl font-semibold mb-6 leading-snug">
            МІНІКУРС «ПРАКТИЧНЕ ЗАСТОСУВАННЯ AI» ДЛЯ ПІДЛІТКІВ ВІД 12 РОКІВ
            </h3>

            <ul class="space-y-4 text-gray-300 mb-8">
            <li class="flex gap-3"><span>📁</span>Ефективні промпти для будь-яких задач</li>
            <li class="flex gap-3"><span>❤️</span>Генерація контенту різної складності</li>
            <li class="flex gap-3"><span>⚙️</span>150 інструментів AI для продуктивної роботи</li>
            </ul>

            <a href="#" class="mt-auto border border-white px-6 py-3 rounded-lg hover:bg-white hover:text-black transition text-center">
            розпочати
            </a>
        </div>

        <!-- Default Card 2 - GoIT -->
        <div class="flex flex-col">
            <div class="flex flex-wrap gap-2 mb-4 text-sm">
            <span class="bg-orange-500 text-black px-3 py-1 rounded-full font-medium">GoIT</span>
            <span class="bg-pink-500 px-3 py-1 rounded-full">free</span>
            <span class="bg-gray-700 px-3 py-1 rounded-full">для новачків</span>
            <span class="bg-gray-700 px-3 py-1 rounded-full">онлайн</span>
            </div>

            <div class="rounded-2xl overflow-hidden mb-6">
            <img src="https://images.unsplash.com/photo-1531482615715-2afd2c4f6b9f?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&q=80" 
                alt="AI for beginners" 
                class="w-full h-56 object-cover">
            </div>

            <h3 class="text-xl font-semibold mb-6 leading-snug">
            СТАРТ В AI: ВІД ОГЛЯДУ ІНСТРУМЕНТІВ ДО ВЛАСНОГО AI-АГЕНТА
            </h3>

            <ul class="space-y-4 text-gray-300 mb-8">
            <li class="flex gap-3"><span>💬</span>Основи написання перших промптів</li>
            <li class="flex gap-3"><span>🖼️</span>Інструменти для генерації контенту і перший рілз з AI</li>
            <li class="flex gap-3"><span>🤖</span>Основи автоматизації з AI і побудова першого агента</li>
            </ul>

            <a href="#" class="mt-auto border border-white px-6 py-3 rounded-lg hover:bg-white hover:text-black transition text-center">
            розпочати
            </a>
        </div>

        <!-- Default Card 3 - Neoversity -->
        <div class="flex flex-col">
            <div class="flex flex-wrap gap-2 mb-4 text-sm">
            <span class="bg-purple-600 px-3 py-1 rounded-full font-medium">Neoversity</span>
            <span class="bg-pink-500 px-3 py-1 rounded-full">free</span>
            <span class="bg-gray-700 px-3 py-1 rounded-full">для айтіївців</span>
            <span class="bg-gray-700 px-3 py-1 rounded-full">онлайн</span>
            </div>

            <div class="rounded-2xl overflow-hidden mb-6">
            <img src="https://images.unsplash.com/photo-1558494949-ef010cbdcc31?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&q=80" 
                alt="Tech knowledge hub" 
                class="w-full h-56 object-cover">
            </div>

            <h3 class="text-xl font-semibold mb-6 leading-snug">
            TECH KNOWLEDGE HUB: IT-ІНСАЙТИ ВІД ПРОФІ
            </h3>

            <ul class="space-y-4 text-gray-300 mb-8">
            <li class="flex gap-3"><span>▶️</span>9000+ хвилин експертного відеоконтенту</li>
            <li class="flex gap-3"><span>👥</span>Інсайти від фахівців з Netflix, Мінцифри, SoftServe, mono</li>
            <li class="flex gap-3"><span>💻</span>Рішення, які можна застосувати в роботі вже завтра</li>
            </ul>

            <a href="#" class="mt-auto border border-white px-6 py-3 rounded-lg hover:bg-white hover:text-black transition text-center">
            розпочати
            </a>
        </div>
        
        <?php endif; // course_cards check ?>

        </div>
    </div>
    <?php endif; // show_section check ?>
  </div>
</section>
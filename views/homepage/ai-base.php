<?php
// Get ACF fields
$show_section = get_field('show_ai_base_section');
if ($show_section) :
    $main_title = get_field('ai_base_main_title') ?: 'AI БАЗА';
    $subtitle = get_field('ai_base_subtitle') ?: 'ОСНОВИ AI-ГРАМОТНОСТІ ДЛЯ ВСІХ ПОКОЛІНЬ';
    $courses = get_field('ai_base_courses');
    $minicourses = get_field('ai_base_minicourses');

else :
    return; // Don't render if section disabled
endif;
?>

<section class="bg-black text-white py-20 px-6">
  <div class="max-w-7xl mx-auto">
    <!-- Header -->
    <div class="text-center mb-16">
      <h1 class="text-5xl font-extrabold tracking-tight mb-6">
        <?php echo esc_html($main_title); ?>
      </h1>
      <p class="text-2xl text-gray-300">
        <?php echo esc_html($subtitle); ?>
      </p>
    </div>

    <!-- Cards -->
    <div class="grid gap-10 xl:grid-cols-3">

      <?php 
      // Loop through base courses (Go!Teens, CoIT, Neoversity)
      if ($courses) : 
          foreach ($courses as $index => $course) : 
      ?>
      <!-- Card <?php echo $index + 1; ?> -->
      <div class="flex flex-col">
        <!-- Badges -->
        <div class="flex flex-wrap gap-2 mb-4 text-sm">
          <span class="bg-yellow-400 text-black px-3 py-1 rounded-full"><?php echo esc_html($course['title']); ?></span>
          <span class="bg-pink-500 px-3 py-1 rounded-full">free</span>
          <span class="bg-gray-700 px-3 py-1 rounded-full"><?php echo esc_html($course['audience']); ?></span>
        </div>

        <!-- Image placeholder - you can add image field later if needed -->
        <div class="rounded-2xl overflow-hidden mb-6 bg-gray-800 flex items-center justify-center">
          <div class="w-full h-56 flex items-center justify-center text-6xl opacity-50">
            <?php 
            // Different icons for different courses
            if ($index === 0) echo '📚';
            elseif ($index === 1) echo '🚀';
            else echo '💡';
            ?>
          </div>
        </div>

        <?php 
        // Get corresponding minicourse data
        $minicourse_data = isset($minicourses[$index]) ? $minicourses[$index] : null;
        if ($minicourse_data) : 
        ?>
        
        <!-- Title -->
        <h3 class="text-xl font-semibold mb-6 leading-snug">
          <?php echo esc_html($minicourse_data['title']); ?>
          <?php if (!empty($minicourse_data['audience'])) : ?>
            <span class="block text-sm text-gray-400 mt-1"><?php echo esc_html($minicourse_data['audience']); ?></span>
          <?php endif; ?>
        </h3>

        <!-- List -->
        <?php if (!empty($minicourse_data['features'])) : ?>
        <ul class="space-y-4 text-gray-300 mb-8">
          <?php foreach ($minicourse_data['features'] as $feature) : ?>
          <li class="flex gap-3">
            <span>
              <?php 
              // Different icons for different features
              if ($index === 0) echo '📁';
              elseif ($index === 1) echo '💬';
              else echo '▶️';
              ?>
            </span>
            <?php echo esc_html($feature['text']); ?>
          </li>
          <?php endforeach; ?>
        </ul>
        <?php endif; ?>

        <!-- Badge if exists -->
        <?php if (!empty($minicourse_data['badge'])) : ?>
        <div class="text-sm text-gray-400 mb-4">
          <?php echo esc_html($minicourse_data['badge']); ?>
        </div>
        <?php endif; ?>

        <!-- Button -->
        <?php 
        $button_text = !empty($minicourse_data['button_text']) ? $minicourse_data['button_text'] : 'розпочати';
        $button_link = !empty($minicourse_data['button_link']) ? $minicourse_data['button_link'] : '#';
        ?>
        <a href="<?php echo esc_url($button_link); ?>" 
           class="mt-auto border border-white px-6 py-3 rounded-lg hover:bg-white hover:text-black transition text-center inline-block">
          <?php echo esc_html($button_text); ?>
        </a>
        
        <?php endif; // minicourse_data ?>
      </div>
      <?php 
          endforeach; 
      else : 
          // Fallback static content if no ACF data
      ?>
      <!-- Card 1 - Fallback -->
      <div class="flex flex-col">
        <div class="flex flex-wrap gap-2 mb-4 text-sm">
          <span class="bg-yellow-400 text-black px-3 py-1 rounded-full">GoITeens</span>
          <span class="bg-pink-500 px-3 py-1 rounded-full">free</span>
          <span class="bg-gray-700 px-3 py-1 rounded-full">для підлітків</span>
        </div>

        <div class="rounded-2xl overflow-hidden mb-6 bg-gray-800 flex items-center justify-center">
          <div class="w-full h-56 flex items-center justify-center text-6xl opacity-50">📚</div>
        </div>

        <h3 class="text-xl font-semibold mb-6 leading-snug">
          МІНІКУРС «ПРАКТИЧНЕ ЗАСТОСУВАННЯ AI» ДЛЯ ПІДЛІТКІВ ВІД 12 РОКІВ
        </h3>

        <ul class="space-y-4 text-gray-300 mb-8">
          <li class="flex gap-3"><span>📁</span>Ефективні промпти для будь-яких задач</li>
          <li class="flex gap-3"><span>❤️</span>Генерація контенту різної складності</li>
          <li class="flex gap-3"><span>⚙️</span>150 інструментів AI для продуктивної роботи</li>
        </ul>

        <button class="mt-auto border border-white px-6 py-3 rounded-lg hover:bg-white hover:text-black transition">
          розпочати
        </button>
      </div>

      <!-- Card 2 - Fallback -->
      <div class="flex flex-col">
        <div class="flex flex-wrap gap-2 mb-4 text-sm">
          <span class="bg-orange-500 text-black px-3 py-1 rounded-full">GoIT</span>
          <span class="bg-pink-500 px-3 py-1 rounded-full">free</span>
          <span class="bg-gray-700 px-3 py-1 rounded-full">для новачків</span>
        </div>

        <div class="rounded-2xl overflow-hidden mb-6 bg-gray-800 flex items-center justify-center">
          <div class="w-full h-56 flex items-center justify-center text-6xl opacity-50">🚀</div>
        </div>

        <h3 class="text-xl font-semibold mb-6 leading-snug">
          СТАРТ В AI: ВІД ОГЛЯДУ ІНСТРУМЕНТІВ ДО ВЛАСНОГО AI-АГЕНТА
        </h3>

        <ul class="space-y-4 text-gray-300 mb-8">
          <li class="flex gap-3"><span>💬</span>Основи написання перших промптів</li>
          <li class="flex gap-3"><span>🖼️</span>Інструменти для генерації контенту і перший рілз з AI</li>
          <li class="flex gap-3"><span>🤖</span>Основи автоматизації з AI і побудова першого агента</li>
        </ul>

        <button class="mt-auto border border-white px-6 py-3 rounded-lg hover:bg-white hover:text-black transition">
          розпочати
        </button>
      </div>

      <!-- Card 3 - Fallback -->
      <div class="flex flex-col">
        <div class="flex flex-wrap gap-2 mb-4 text-sm">
          <span class="bg-purple-600 px-3 py-1 rounded-full">Neoversity</span>
          <span class="bg-pink-500 px-3 py-1 rounded-full">free</span>
          <span class="bg-gray-700 px-3 py-1 rounded-full">для айтіївців</span>
        </div>

        <div class="rounded-2xl overflow-hidden mb-6 bg-gray-800 flex items-center justify-center">
          <div class="w-full h-56 flex items-center justify-center text-6xl opacity-50">💡</div>
        </div>

        <h3 class="text-xl font-semibold mb-6 leading-snug">
          TECH KNOWLEDGE HUB: IT-ІНСАЙТИ ВІД ПРОФІ
        </h3>

        <ul class="space-y-4 text-gray-300 mb-8">
          <li class="flex gap-3"><span>▶️</span>9000+ хвилин експертного відеоконтенту</li>
          <li class="flex gap-3"><span>👥</span>Інсайти від фахівців з Netflix, Мінцифри, SoftServe, mono</li>
          <li class="flex gap-3"><span>💻</span>Рішення, які можна застосувати в роботі вже завтра</li>
        </ul>

        <button class="mt-auto border border-white px-6 py-3 rounded-lg hover:bg-white hover:text-black transition">
          розпочати
        </button>
      </div>
      <?php endif; // courses check ?>

    </div>
    
    <?php endif; // show_section check ?>
  </div>
</section>
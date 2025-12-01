<?php
// ACF field values
$show_section = get_field('show_collaboration_section');
$title        = get_field('team_section_title') ?: 'СПІВПРАЦЯ З НАМИ';
$team_members = get_field('team_members'); // repeater array

// Don't render if disabled or empty
if (!$show_section || empty($team_members)) return;
?>

<section class="py-16 px-4 bg-gray-100">
    <div class="container mx-auto max-w-7xl">

        <!-- Section Title -->
        <h2 class="text-4xl md:text-5xl lg:text-6xl font-bold text-center mb-12 md:mb-16">
            <?= esc_html($title); ?>
        </h2>

        <!-- Team Members Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 lg:gap-8">

            <?php foreach ($team_members as $member):

                $photo    = $member['photo'] ?? '';   // URL from ACF
                $name     = $member['name'] ?? '';
                $position = $member['position'] ?? '';
                $email    = $member['email'] ?? '';
                $linkedin = $member['linkedin'] ?? '';

            ?>
            <div class="bg-white rounded-lg overflow-hidden shadow-sm hover:shadow-md transition-shadow">

                <?php if ($photo): ?>
                <div class="aspect-square overflow-hidden">
                    <img src="<?= esc_url($photo); ?>" alt="<?= esc_attr($name); ?>" class="w-full h-full object-cover">
                </div>
                <?php endif; ?>

                <div class="p-6">
                    <h3 class="text-xl font-bold text-black mb-2 uppercase"><?= esc_html($name); ?></h3>
                    <p class="text-gray-600 text-sm mb-4"><?= esc_html($position); ?></p>

                    <div class="flex gap-3">

                        <?php if ($email): ?>
                        <a href="mailto:<?= esc_attr($email); ?>"
                            class="w-9 h-9 rounded-full border-2 border-black flex items-center justify-center hover:bg-black hover:text-white transition-colors"
                            aria-label="Email">
                            <svg class="w-5 h-5 fill-current" viewBox="0 0 24 24">
                                <path
                                    d="M20 4H4c-1.1 0-1.99.9-1.99 2L2 18c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm0 4l-8 5-8-5V6l8 5 8-5v2z" />
                            </svg>
                        </a>
                        <?php endif; ?>

                        <?php if ($linkedin): ?>
                        <a href="<?= esc_url($linkedin); ?>" target="_blank" rel="noopener noreferrer"
                            class="w-9 h-9 rounded-full border-2 border-black flex items-center justify-center hover:bg-black hover:text-white transition-colors"
                            aria-label="LinkedIn">
                            <svg class="w-5 h-5 fill-current" viewBox="0 0 24 24">
                                <path
                                    d="M19 0h-14c-2.761 0-5 2.239-5 5v14c0 2.761 2.239 5 5 5h14c2.762 0 5-2.239 5-5v-14c0-2.761-2.238-5-5-5zm-11 19h-3v-11h3v11zm-1.5-12.268c-.966 0-1.75-.79-1.75-1.764s.784-1.764 1.75-1.764 1.75.79 1.75 1.764-.783 1.764-1.75 1.764zm13.5 12.268h-3v-5.604c0-3.368-4-3.113-4 0v5.604h-3v-11h3v1.765c1.396-2.586 7-2.777 7 2.476v6.759z" />
                            </svg>
                        </a>
                        <?php endif; ?>

                    </div>
                </div>

            </div>
            <?php endforeach; ?>

        </div>
    </div>
</section>
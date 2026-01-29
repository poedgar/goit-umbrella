<?php
$show_section = get_field('show_timeline_section');
$section_title = get_field('timeline_section_title');
$section_subtitle = get_field('timeline_section_subtitle');
$items = get_field('timeline_items') ?: [];

if (!$show_section || empty($items)) return;
?>

<section id="timeline" class="section overflow-hidden">
    <div class="container overflow-visible">
        <style>
        .timeline-button {
            transition: all 0.3s ease;
        }

        .timeline-button.active {
            background-color: #000;
            color: #fff;
        }

        .timeline-button:not(.active):hover {
            background-color: #f3f4f6;
        }

        .content-section {
            display: none;
            animation: fadeIn 0.5s ease;
        }

        .content-section.active {
            display: flex;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Mobile/Tablet styles */
        @media (max-width: 1279px) {
            .timeline-content-details {
                display: none;
            }

            .timeline-content-details.expanded {
                display: block;
                animation: slideDown 0.3s ease;
            }

            .details-button {
                transition: all 0.3s ease;
            }

            .details-button.expanded {
                display: none;
            }
        }

        @keyframes slideDown {
            from {
                opacity: 0;
                max-height: 0;
            }
            to {
                opacity: 1;
                max-height: 1000px;
            }
        }

        /* Desktop styles */
        @media (min-width: 1280px) {
            .timeline-content-details {
                display: block !important;
            }

            .details-button {
                display: none !important;
            }
        }
        </style>

        <section class="bg-gray-50">

            <!-- HEADER -->
            <header class="bg-white py-8 px-4">
                <div class="max-w-6xl mx-auto flex justify-between items-center">
                    <h1 class="text-4xl md:text-5xl font-black text-gray-900">
                        <?= esc_html($section_title); ?>
                    </h1>
                </div>

                <?php if ($section_subtitle): ?>
                <div class="max-w-6xl mx-auto mt-4">
                    <p class="text-gray-600 text-lg text-center md:text-left">
                        <?= nl2br(html_entity_decode($section_subtitle)); ?>
                    </p>
                </div>
                <?php endif; ?>
            </header>

            <!-- YEAR NAVIGATION -->
            <div class="bg-white py-6 px-4 sticky top-0 z-50 shadow-sm">
                <div class="max-w-6xl mx-auto">
                    <div class="flex flex-wrap gap-3 justify-center md:justify-start">
                        <?php foreach ($items as $index => $item):
                            $year = $item['year'];
                            $active = $index === 0 ? 'active border-gray-900' : 'border-gray-300';
                        ?>
                        <button class="timeline-button <?= $active ?> px-6 py-3 rounded-lg font-semibold border-2"
                            data-year="<?= esc_attr($year); ?>">
                            <?= esc_html($year); ?>
                        </button>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>

            <!-- CONTENT -->
            <main class="max-w-6xl mx-auto px-4 py-12">
                <?php foreach ($items as $index => $item):
                    $year = $item['year'];
                    $heading = $item['heading'];
                    $content = $item['content'];
				    $image = $item['image'];
                    $active = $index === 0 ? 'active' : '';
                ?>
                <section class="content-section flex flex-col md:flex-row md:gap-8 <?= $active; ?>"
                    data-content="<?= esc_attr($year); ?>">
                    <div class="bg-white md:w-[50%] rounded-2xl p-8 shadow-lg">
                        <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-6">
                            <?= esc_html($heading); ?>
                        </h2>

                        <!-- Details Button for Mobile/Tablet -->
                        <button class="details-button w-full py-3 px-6 bg-gray-900 text-white font-semibold rounded-lg hover:bg-gray-800 transition-colors mb-4"
                            data-year="<?= esc_attr($year); ?>">
                            Детальніше
                        </button>

                        <!-- Content (hidden on mobile until button click) -->
                        <div class="timeline-content-details text-gray-700 text-lg leading-relaxed space-y-4">
                            <?= wp_kses_post($content); ?>
                        </div>
                    </div>

                    <?php if ($image): ?>
                    <div class="md:w-[50%]">
                        <img src="<?= esc_url($image); ?>" alt="<?= esc_attr($heading); ?>"
                            class="w-full h-full object-cover rounded-lg shadow-md">
                    </div>
                    <?php endif; ?>
                </section>
                <?php endforeach; ?>
            </main>
        </section>
    </div>
</section>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const buttons = document.querySelectorAll('.timeline-button');
    const sections = document.querySelectorAll('.content-section');
    const detailsButtons = document.querySelectorAll('.details-button');

    // Year navigation functionality
    buttons.forEach(button => {
        button.addEventListener('click', () => {
            const year = button.dataset.year;

            buttons.forEach(btn => {
                btn.classList.remove('active', 'border-gray-900');
                btn.classList.add('border-gray-300');
            });

            button.classList.add('active');
            button.classList.remove('border-gray-300');
            button.classList.add('border-gray-900');

            sections.forEach(section => {
                section.classList.remove('active');
                if (section.dataset.content === year) {
                    section.classList.add('active');
                    // Reset expanded state when switching years
                    const contentDetails = section.querySelector('.timeline-content-details');
                    const detailsBtn = section.querySelector('.details-button');
                    if (contentDetails && detailsBtn) {
                        contentDetails.classList.remove('expanded');
                        detailsBtn.classList.remove('expanded');
                    }
                }
            });
        });
    });

    // Details button functionality for mobile/tablet
    detailsButtons.forEach(button => {
        button.addEventListener('click', function() {
            const year = this.dataset.year;
            const section = document.querySelector(`.content-section[data-content="${year}"]`);

            if (section) {
                const contentDetails = section.querySelector('.timeline-content-details');

                if (contentDetails) {
                    contentDetails.classList.add('expanded');
                    this.classList.add('expanded');
                }
            }
        });
    });
});
</script>

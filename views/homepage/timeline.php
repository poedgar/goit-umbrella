<?php
$show_section = get_field('show_timeline_section');
$section_title = get_field('timeline_section_title');
$section_subtitle = get_field('timeline_section_subtitle');
$items = array_reverse(get_field('timeline_items') ?: []);

if (!$show_section || empty($items)) return;
?>

<section id="timeline" class="section">
    <div class="container">
    <style>
        /* Ensure parent containers don't block sticky */
        #timeline {
            overflow: visible !important;
        }

        .timeline-wrapper {
            overflow: clip !important;
            position: relative;
        }

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

            /* Fix for image height on tablets */
            .content-section {
                align-items: flex-start;
            }

            .timeline-image-wrapper {
                height: auto;
                align-self: flex-start;
            }

            .timeline-image-wrapper img {
                height: auto;
                max-height: none;
            }

			.timeline-nav-wrapper .scroll-wrap {
				padding-bottom: 18px;
			}

           /* Only sticky when .sticky class is added */
			.timeline-nav-wrapper.sticky {
				position: -webkit-sticky;
				position: sticky;
				z-index: 99;
			}

			/* Default state is static */
			.timeline-nav-wrapper {
				position: static;
			}
        }

		@media (max-width: 767.99px){
			.timeline-nav-wrapper {
            	background-color: #ffffff;
				padding-inline: 20px;
            }

			    /* Only sticky when .sticky class is added */
			.timeline-nav-wrapper.sticky {
				top: 84px; /* your fixed header height */
			}
		}

		@media (min-width: 768px){
			.timeline-nav-wrapper {
            	background-color: #F2F1EE;
			}
		    /* Only sticky when .sticky class is added */
			.timeline-nav-wrapper.sticky {
				top: 100px; /* your fixed header height */
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

            .timeline-nav-wrapper {
                position: static;
                box-shadow: none;
            }
        }
    </style>

        <div class="timeline-wrapper bg-white md:bg-transparent pt-5 smOnly:pb-5 md:pt-0 rounded-[8px] md:rounded-none">
            <h2 class="section-title mx-auto !text-[48px]/[48px] px-5">
                <?= esc_html($section_title); ?>
            </h2>

            <?php if ($section_subtitle): ?>
            <p class="low-section-title mdOnly:!text-[24px]/[32px] mx-auto px-5  mt-5 md:mt-8">
                <?= nl2br(html_entity_decode($section_subtitle)); ?>
            </p>
            <?php endif; ?>

            <!-- YEAR NAVIGATION -->
            <div class="timeline-nav-wrapper pt-5 md:pt-8 notXl:pb-4">
                <div class="scroll-wrap flex flex-row flex-nowrap overflow-x-auto gap-[10px] md:gap-2">
                    <?php foreach ($items as $index => $item):
                            $year = $item['year'];
                            $active = $index === 0 ? 'active' : '';
                        ?>
                    <button
                        class="timeline-button <?= $active ?> w-[78px] md:w-[110px] xl:w-[196px] text-[20px]/[28px] px-4 py-2 rounded-[8px] md:rounded-[4px] border-2 border-black"
                        data-year="<?= esc_attr($year); ?>">
                        <?= esc_html($year); ?>
                    </button>
                    <?php endforeach; ?>
                </div>
            </div>

            <!-- CONTENT -->
            <div class="timeline-content-wrapper">
                <?php foreach ($items as $index => $item):
                        $year = $item['year'];
                        $heading = $item['heading'];
                        $content = $item['content'];
                        $image = $item['image'];
                        $active = $index === 0 ? 'active' : '';
                    ?>
                <div class="content-section bg-white xl:mt-8 px-[20px] md:p-8 rounded-[8px] flex flex-col-reverse md:flex-row md:gap-8 <?= $active; ?>"
                    data-content="<?= esc_attr($year); ?>">
                    <div class="md:w-[50%]">
                        <h2
                            class="uppercase text-[20px]/[28px] xl:text-[32px]/[36px] font-[500] min-h-[84px] notXl:mt-5">
                            <?= wp_kses_post($heading); ?>
                        </h2>

                        <!-- Details Button for Mobile/Tablet -->
                        <button
                            class="details-button my-5 lowercase pb-[1px] border-b border-black text-[20px] leading-[28px] font-[500] transition-colors"
                            data-year="<?= esc_attr($year); ?>">
                            Детальніше
                        </button>

                        <!-- Content (hidden on mobile until button click) -->
                        <div class="timeline-content-details mt-5 xl:mt-[52px] text-[16px]/[24px]">
                            <?= wp_kses_post($content); ?>
                        </div>
                    </div>

                    <?php if ($image): ?>
                    <div class="timeline-image-wrapper md:w-[50%]">
                        <img src="<?= esc_url($image); ?>" alt="<?= esc_attr($heading); ?>"
                            class="w-full h-full object-cover rounded-[8px]">
                    </div>
                    <?php endif; ?>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</section>

<script>
	document.addEventListener('DOMContentLoaded', function() {
    const buttons = document.querySelectorAll('.timeline-button');
    const sections = document.querySelectorAll('.content-section');
    const detailsButtons = document.querySelectorAll('.details-button');
    const timelineNav = document.querySelector('.timeline-nav-wrapper');

    // Function to toggle sticky class
    function setSticky(isSticky) {
        if (!timelineNav) return;
        if (isSticky) {
            timelineNav.classList.add('sticky');
        } else {
            timelineNav.classList.remove('sticky');
        }
    }

    // Function to get header offset based on screen width
    function getHeaderOffset() {
        if (window.innerWidth < 768) return 84; // mobile header height
        if (window.innerWidth >= 768 && window.innerWidth < 1280) return 100; // tablet header height
        return 0; // desktop, no offset needed
    }

    // Year navigation functionality
    buttons.forEach(button => {
        button.addEventListener('click', () => {
            const year = button.dataset.year;

            // Remove active state from all buttons
            buttons.forEach(btn => btn.classList.remove('active'));
            button.classList.add('active');

            // Show corresponding section and reset details
            sections.forEach(section => {
                section.classList.remove('active');
                if (section.dataset.content === year) {
                    section.classList.add('active');

                    const contentDetails = section.querySelector('.timeline-content-details');
                    const detailsBtn = section.querySelector('.details-button');

                    if (contentDetails && detailsBtn) {
                        // Collapse details when switching years
                        contentDetails.classList.remove('expanded');
                        detailsBtn.classList.remove('expanded');

                        // Remove sticky when switching years
                        setSticky(false);
                    }
                }
            });

            // Scroll to top of timeline section smoothly with header offset (mobile/tablet)
            if (timelineNav && window.innerWidth < 1280) {
                const headerOffset = getHeaderOffset();
                const navTop = timelineNav.getBoundingClientRect().top + window.scrollY;

                window.scrollTo({
                    top: navTop - headerOffset,
                    behavior: 'smooth'
                });
            }
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
                    // Expand details content
                    contentDetails.classList.add('expanded');
                    this.classList.add('expanded');

                    // Make timeline nav sticky only after opening details
                    setSticky(true);

                    // Scroll to nav with header offset
                    if (timelineNav && window.innerWidth < 1280) {
                        const headerOffset = getHeaderOffset();
                        const navTop = timelineNav.getBoundingClientRect().top + window.scrollY;

                        window.scrollTo({
                            top: navTop - headerOffset,
                            behavior: 'smooth'
                        });
                    }
                }
            }
        });
    });
});
</script>

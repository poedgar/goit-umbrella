<div id="cookie-modal" class="fixed py-5 inset-0 z-[99999] flex items-end justify-center bg-black/45 backdrop-blur-sm">
	<div class="container">
		<div class="bg-white rounded-[8px] p-5 flex gap-5 md:gap-4 md:p-4 notXl:flex-col xl:items-end xl:justify-between max-h-[80vh] overflow-y-auto">
			<div class="flex flex-col gap-5 md:gap-4 xl:gap-0 items-start">
				<p id="cookie-text" class="text-base">
					<?php
					$short = get_theme_mod('cookie_short_text', 'Ми використовуємо cookies для покращення роботи сайту.');
					$full  = get_theme_mod('cookie_full_text', '');

					$full_html = $full ? '<span id="cookie-full-text" class="hidden">' . nl2br($full) . '</span>' : '';

					echo wp_kses_post($short . ' ' . $full_html);
					?>
				</p>

				<?php if (!empty($full)): ?>
					<button id="show-more" class="underline-dotted notXl:self-end text-[#8e8e8e] text-sm">Читати більше</button>
				<?php endif; ?>
			</div>

			<!-- Кнопки -->
			<div class="flex gap-[10px] xl:gap-4 justify-center">
				<button id="accept-cookies" class="notXl:w-1/2 btn btn-black !text-[16px]/[1]">
					<?php echo esc_html(get_theme_mod('cookie_accept_text')); ?>
				</button>

				<div class="notXl:w-1/2 btn-border-gradient">
					<button id="reject-cookies" class="!w-full btn-transparent !text-[16px]/[1]">
						<?php echo esc_html(get_theme_mod('cookie_reject_text')); ?>
					</button>
				</div>

			</div>
		</div>
	</div>
</div>
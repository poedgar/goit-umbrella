<!-- DROPDOWN = ІНШІ МОВИ -->
<div class="relative inline-block text-left">
	<button id="mobile-language-toggle"
		class="flex items-center gap-1 bg-gray-200 px-3 py-1 text-sm">
		Укр
		<svg class="w-3 h-3" viewBox="0 0 20 20" fill="currentColor">
			<path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06.02L10 11.168l3.71-3.938a.75.75 0 111.08 1.04l-4.24 4.5a.75.75 0 01-1.08 0l-4.24-4.5a.75.75 0 01.02-1.06z" clip-rule="evenodd"/>
		</svg>
	</button>

	<div id="mobile-language-dropdown"
		class="absolute left-0 mt-1 w-full bg-white shadow-md text-sm hidden">
		
		<?php if (function_exists('icl_get_languages')) : ?>
			<?php
			$languages = icl_get_languages('skip_missing=0&orderby=custom&order=asc');
			$active_lang_code = $current_lang['language_code'] ?? '';
			$allowed_langs = ['uk', 'en'];
			?>

			<?php foreach ($languages as $lang) : ?>
				<?php
				$lang_code = $lang['language_code'] ?? '';
				if (!in_array($lang_code, $allowed_langs, true)) continue;
				if ($lang_code === $active_lang_code) continue;

				$name = $custom_names[$lang_code] ?? ($lang['native_name'] ?? '');
				?>

				<?php if (!empty($lang['url'])) : ?>
					<a href="<?= esc_url($lang['url']); ?>"
						class="block px-3 py-1 hover:bg-gray-100 text-center">
						<?= esc_html($name); ?>
					</a>
				<?php endif; ?>
			<?php endforeach; ?>
		<?php endif; ?>
	</div>
</div>
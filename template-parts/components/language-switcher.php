<!-- DROPDOWN = ІНШІ МОВИ -->
<div id="mobile-language-dropdown"
	class="bg-white rounded-b border border-gray-200 overflow-hidden
		transition-all duration-300 ease-in-out">
	перемикач мови
	<?php if (function_exists('icl_get_languages')) : ?>

		<?php
		$languages = icl_get_languages('skip_missing=0&orderby=custom&order=asc');
		// активна мова
		$active_lang_code = $current_lang['language_code'] ?? '';

		// дозволені мови
		$allowed_langs = ['uk', 'en'];
		?>

		<?php foreach ($languages as $lang) : ?>

			<?php
			$lang_code = $lang['language_code'] ?? '';

			// ❗ тільки uk та en
			if (!in_array($lang_code, $allowed_langs, true)) {
				continue;
			}

			// ❗ пропускаємо активну мову
			if ($lang_code === $active_lang_code) {
				continue;
			}

			$name = $custom_names[$lang_code] ?? ($lang['native_name'] ?? '');
			?>

			<?php if (!empty($lang['url'])) : ?>
				<a href="<?= esc_url($lang['url']); ?>"
					class="block text-center px-4 py-2 hover:bg-gray-50 transition">
					<?= esc_html($name); ?>
				</a>
			<?php endif; ?>

		<?php endforeach; ?>

	<?php endif; ?>

</div>
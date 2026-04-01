<!-- DROPDOWN = ІНШІ МОВИ -->
<?php
$current_lang_code = apply_filters('wpml_current_language', null);


// map full → short
$lang_labels = [
	'uk' => 'Укр',
	'en' => 'Eng',
];

// fallback if something unexpected
$current_label = $lang_labels[$current_lang_code] ?? strtoupper($current_lang_code);
?>

<div class="relative inline-block text-left xl:mr-4 rounded-b">
	<button id="mobile-language-toggle"
		class="flex justify-center items-center gap-[10px] px-4 py-2 xl:text-[20px]/[28px]">
		<span><?= esc_html($current_label); ?></span>

		<svg xmlns="http://www.w3.org/2000/svg" width="12" height="8" viewBox="0 0 12 8" fill="none">
		<path d="M7.04761 7.31467C6.99908 7.37038 6.95813 7.43241 6.91747 7.4941C6.47288 8.16863 5.52713 8.16863 5.08253 7.4941C5.04187 7.43241 5.00092 7.37038 4.95239 7.31467L0.225467 1.88833C0.176938 1.83262 0.133193 1.77219 0.10381 1.7044C-0.235517 0.921568 0.296444 9.88424e-07 1.12704 9.10801e-07L10.873 0C11.7036 -7.76231e-08 12.2355 0.921567 11.8962 1.7044C11.8668 1.77219 11.8231 1.83262 11.7745 1.88833L7.04761 7.31467Z" fill="black"/>
		</svg>
	</button>

	<div id="mobile-language-dropdown"
		class="absolute left-0 mt-1 w-full bg-white shadow-md text-sm hidden">
		<?php if (function_exists('icl_get_languages')) : ?>
			<?php
			$languages = icl_get_languages('skip_missing=0&orderby=custom&order=asc');
			$active_lang_code = $current_label ?? '';
			$allowed_langs = ['uk', 'en'];
			?>

			<?php foreach ($languages as $lang) : ?>
				<?php
				$lang_code = $lang['language_code'] ?? '';
				if (!in_array($lang_code, $allowed_langs, true)) continue;
				if ($lang_labels[$lang_code] === $active_lang_code) continue;

                $name = $lang_labels[$lang_code] ?? ($lang['native_name'] ?? strtoupper($lang_code));
				?>

				<?php if (!empty($lang['url'])) : ?>
					<a href="<?= esc_url($lang['url']); ?>"
						class="block underline text-[20px]/[28px] px-4 py-2 hover:bg-gray-100 text-center">
						<?= esc_html($name); ?>
					</a>
				<?php endif; ?>
			<?php endforeach; ?>
		<?php endif; ?>
	</div>
</div>
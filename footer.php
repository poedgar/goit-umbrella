<?php

/**
 * The footer
 *
 * @package Bathe
 */

?>
</main>

<footer class="bg-black text-gray-68 py-5 md:py-8 xl:py-16">
	<div class="container">
		<div class="grid grid-cols-1 xl:grid-cols-3 gap-20 md:gap-8">
			<?php
			$companies = new WP_Query([
				'post_type'      => 'companies',
				'posts_per_page' => -1,
				'orderby'        => 'menu_order',
				'order'          => 'ASC',
				'post_status'    => 'publish',
			]);

			if ($companies->have_posts()):
				while ($companies->have_posts()): $companies->the_post();
					$post_id = get_the_ID();
			?>

					<!-- Company Column -->
					<div>
						<!-- Company Title -->
						<h3 class="text-xl/[28px]">
							<?php the_title(); ?>
						</h3>

						<!-- Description -->
						<div class="mt-5 md:mt-4 xl:mt-8 text-base/[24px] xl:min-h-[72px]">
							<?php the_excerpt(); ?>
						</div>

						<?php while (have_rows('sites', $post_id)): the_row();
								$name   = get_sub_field('footer_name');
								$url    = get_sub_field('url');
								$social = get_sub_field('social') ?: [];
								$has_social = !empty(array_filter($social));

								// Якщо немає ні назви, ні url, ні соцмереж — пропускаємо блок
								if (empty($name) && !$has_social) {    continue;
								}
							?>

								<!-- Site block -->
								<div class="mt-5 md:mt-4 xl:mt-8 flex items-center gap-5 md:gap-8 xl:flex-col xl:gap-5 xl:items-start">
									<!-- Main link -->
									<?php if ($url): ?>
										<div class="">
											<a href="<?php echo esc_url($url); ?>" target="_blank"
												class="text-base/[24px] text-white underline uppercase hover:text-white transition">
												<?php echo esc_html($name); ?>
											</a>
										</div>
									<?php endif; ?>

									<!-- Social icons -->
									<?php if ($has_social): ?>
										<div class="flex gap-2">
											<?php foreach (
												[
													'mail' => 'mail',
													'instagram' => 'instagram',
													'linkedin'  => 'linkedin',
													'youtube'   => 'youtube',
													'facebook'  => 'facebook',
													'twitter'   => 'x',
												] as $key => $icon
											): ?>

												<?php if (!empty($social[$key])): ?>
													<a href="<?php echo $key === 'mail' ? 'mailto:' . esc_attr($social[$key]) : esc_url($social[$key]); ?>"
														<?php echo $key !== 'mail' ? 'target="_blank"' : ''; ?>
														class="social-link-footer">
														<img src="<?php echo get_template_directory_uri(); ?>/src/images/socials/<?php echo $icon; ?>.svg"
															alt="<?php echo $key; ?>">
													</a>
												<?php endif; ?>
											<?php endforeach; ?>
										</div>
									<?php endif; ?>
								</div>
							<?php endwhile; ?>
					</div>

			<?php endwhile;
			endif;
			wp_reset_postdata(); ?>
		</div>

		<!-- Footer bottom -->
		<div
			class="mt-20 md:mt-16 flex flex-col md:flex-row justify-center md:justify-between items-center md:items-start text-center md:text-left text-base/[24px] text-gray-34">
			<div class="flex flex-col md:flex-row gap-[10px] md:gap-8">
				<a lang="uk" class="md:max-w-[102px] xl:max-w-[230px] hyphens-auto hover:text-white" href="#">Умови
					користування
					послугами</a>
				<a lang="uk" class="md:max-w-[102px] xl:max-w-[230px] hyphens-auto hover:text-white" href="#">Політика
					конфіденційності</a>
				<a lang="uk" class="md:max-w-[102px] xl:max-w-[230px] hyphens-auto hover:text-white" href="#">Відмова
					від
					відповідальності</a>
			</div>

			<div class="md:max-w-[102px] xl:max-w-[230px] text-base/[24px] mt-[10px] md:mt-0 xl:ml-8">
				Better<i>ED</i> © <?php echo date('Y'); ?>
			</div>

			<a href="/" class="mt-[10px] md:mt-0 xl:ml-8 w-[168px] h-[28px] transition">
				<!-- Simple icons (SVG) -->
				<img src="<?php echo get_template_directory_uri(); ?>/src/images/logo/logo-white.svg" alt="логотип BetterED" aria-label="На головну">
			</a>
		</div>
	</div>
</footer>


<?php wp_footer(); ?>
</body>

</html>

<?php

/**
 * The footer
 *
 * @package Bathe
 */

?>
</main>

<footer class="footer bg-black text-gray-68 py-5 md:py-8 xl:py-16">
	<div class="container flex flex-col gap-[80px] md:gap-16">
		<div class="grid grid-cols-1 xl:grid-cols-4 gap-20 md:gap-8">
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
					<div class="flex flex-col gap-5 md:gap-4 xl:gap-8">
						<!-- Company Title -->
						<h3 class="text-xl/[28px]">
							<?php the_title(); ?>
						</h3>

						<!-- Description -->
						<div class="grow text-base/[24px]">
							<?php the_excerpt(); ?>
						</div>

						<?php while (have_rows('sites', $post_id)): the_row();
							$name   = get_sub_field('footer_name');
							$url    = get_sub_field('url');
							$social = get_sub_field('social') ?: [];
							$has_social = !empty(array_filter($social));

							// Якщо немає ні назви, ні url, ні соцмереж — пропускаємо блок
							if (empty($name) && !$has_social) {
								continue;
							}
						?>

							<!-- Site block -->
							<div class="flex items-center gap-5 md:gap-8 xl:flex-col xl:gap-5 xl:items-start">
								<!-- Main link -->
								<?php if ($url): ?>
									<div>
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

		<div class="">
			<a href="/" class="smOnly:mx-auto block w-fit">
				<img class="h-[28px] w-[168px] md:h-[36px] md:w-[208px]" src="<?php echo get_template_directory_uri(); ?>/src/images/logo/logo-white.svg" alt="логотип BetterED" aria-label="На головну">
			</a>

			<p class="mt-4 uppercase text-[20px]/[28px] md:text-[32px]/[28px] text-[#4D4D4D] smOnly:text-center"><?= esc_html(get_theme_mod('footer_slogan')); ?></p>
		</div>

		<!-- Footer bottom -->
		<div
			class="flex flex-col md:flex-row justify-center md:justify-between items-center md:items-start text-center md:text-left text-base/[24px] text-gray-68">
			<!-- Agreements links -->
			<?php get_template_part('template-parts/menus/agreements-menu'); ?>


			<div class="xl:max-w-[230px] text-base/[24px] smOnly:mt-[10px] xl:ml-8">
				BetterED © <?= date('Y'); ?>
			</div>

			<p class="text-base/[24px] smOnly:mt-[10px]"><?php echo esc_html(get_theme_mod('contact_email', 'info@bettered.global')); ?></p>

		</div>
	</div>
</footer>

<?php get_template_part('template-parts/global/cookie-banner'); ?>

<?php wp_footer(); ?>
</body>

</html>
<?php
// ACF field values
$show_section = get_field('show_collaboration_section');
$title = get_field('team_section_title');
$team_members = get_field('team_members'); // repeater array

// Don't render if disabled or empty
if (!$show_section || empty($team_members)) {
	return;
}
?>

<section id="collaboration" class="section">
	<div class="container">

		<!-- Section Title -->
		<?php if ($title): ?>
			<h2 class="section-title">
				<?= esc_html($title) ?>
			</h2>
		<?php endif; ?>

		<!-- Team Members Grid -->
		<ul class="mt-5 md:mt-8 flex smOnly:flex-col gap-5 md:gap-8">

			<?php foreach ($team_members as $member):

				$photo = $member['photo']['url'];
				$name = $member['name'];
				$position = $member['position'];
				$email = $member['email'];
				$linkedin = $member['linkedin'];
			?>
				<li class="flex flex-1 flex-col gap-5 xl:gap-8 hover:bg-white rounded-[8px] notXl:bg-white p-5 xl:p-8">

					<?php if ($photo): ?>
						<div class="aspect-square overflow-hidden w-full rounded-[8px]">
							<img src="<?= esc_url($photo) ?>" alt="<?= esc_attr(
																		$name,
																	) ?>" class="w-full  h-full object-cover">
						</div>
					<?php endif; ?>

					<?php if ($name): ?>
						<h3 class="text-[20px]/[28px] grow font-medium uppercase"><?= esc_html(
																						$name,
																					) ?></h3>
					<?php endif; ?>

					<?php if ($position): ?>
						<p class=""><?= esc_html($position) ?></p>
					<?php endif; ?>

					<!-- linkedin link -->
					<?php if ($linkedin): ?>
						<a href="<?= esc_url($linkedin) ?>" target="_blank" rel="noopener noreferrer"
							class="social-link"
							aria-label="LinkedIn">
							<svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
								<path d="M3.47331 16H0.0569397V4.57143H3.47331V16ZM16 16H12.5836V9.89486C12.5836 8.304 12.0188 7.512 10.8994 7.512C10.0122 7.512 9.44968 7.95543 9.16726 8.84343C9.16726 10.2857 9.16726 16 9.16726 16H5.75089C5.75089 16 5.79644 5.71429 5.75089 4.57143H8.44754L8.65594 6.85714H8.72655C9.4269 5.71429 10.5463 4.93943 12.0814 4.93943C13.2487 4.93943 14.1927 5.26514 14.9136 6.08343C15.639 6.90286 16 8.00229 16 9.54629V16Z" fill="black" />
								<path d="M1.76512 3.42857C2.73998 3.42857 3.53025 2.66106 3.53025 1.71429C3.53025 0.767512 2.73998 0 1.76512 0C0.790273 0 0 0.767512 0 1.71429C0 2.66106 0.790273 3.42857 1.76512 3.42857Z" fill="black" />
							</svg>
						</a>
					<?php endif; ?>
				</li>
			<?php
			endforeach; ?>

		</ul>

		<!-- MediaKit -->
		<div class="mt-[80px] text-center mb-10 xl:mt-[128px] xl:mb-16 text-[20px]/[28px] ">
			<!-- The PDF file should be uploaded to the following directory:
    /assets/files/  -->
			<div class="btn-border-gradient !w-[237px]">
				<a class="btn btn-transparent !w-full" href="<?php echo get_template_directory_uri(); ?>/assets/files/media-kit-examples.pdf" download>
					завантажити медіакіт
				</a>
			</div>

			<p class="mt-8 uppercase text-center font-medium">З питань партнерств і PR:
				<a class="hover:underline" href="mailto:info@bettered.global"> <?php echo esc_html(get_theme_mod('contact_email', 'info@bettered.global')); ?>
				</a>
			</p>
		</div>
	</div>
</section>
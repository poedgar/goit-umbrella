<?php
// ACF field values
$show_section = get_field('show_collaboration_section');
$title        = get_field('team_section_title');
$team_members = get_field('team_members'); // repeater array

// Don't render if disabled or empty
if (!$show_section || empty($team_members)) return;
?>

<section class="section">
	<div class="container">

		<!-- Section Title -->
		<?php if ($title): ?>
			<h2 class="section-title">
				<?= esc_html($title); ?>
			</h2>
		<?php endif; ?>

		<!-- Team Members Grid -->
		<ul class="mt-5 md:mt-16 flex smOnly:flex-col gap-5 md:gap-8">

			<?php foreach ($team_members as $member):

				$photo    = $member['photo']['url'];
				$name     = $member['name'];
				$position = $member['position'];
				$email    = $member['email'];
				$linkedin = $member['linkedin'];

			?>
				<li class="flex flex-1 flex-col gap-5 xl:gap-8 bg-white md:first:bg-transparent md:last:bg-transparent rounded-[8px] p-5 xl:p-8">

					<?php if ($photo): ?>
						<div class="aspect-square overflow-hidden w-full rounded-[8px]">
							<img src="<?= esc_url($photo); ?>" alt="<?= esc_attr($name); ?>" class="w-full  h-full object-cover">
						</div>
					<?php endif; ?>

					<?php if ($name): ?>
						<h3 class="text-[20px]/[28px] grow font-medium uppercase"><?= esc_html($name); ?></h3>
					<?php endif; ?>

					<?php if ($position): ?>
						<p class=""><?= esc_html($position); ?></p>
					<?php endif; ?>

					<!-- social links -->
					<div class="flex gap-4 md:gap-2 justify-start items-center">
						<?php if ($email): ?>
							<a href="mailto:<?= esc_attr($email); ?>"
								class="social-link"
								aria-label="Email">
								<svg width="18" height="16" viewBox="0 0 18 16" fill="none" xmlns="http://www.w3.org/2000/svg">
									<path fill-rule="evenodd" clip-rule="evenodd" d="M4.81395 0C3.46189 0 2.23924 0.349085 1.35181 1.20035C0.455961 2.05969 0 3.33583 0 4.97297V11.027C0 12.6642 0.455961 13.9403 1.35181 14.7997C2.23924 15.6509 3.46189 16 4.81395 16H13.186C14.5381 16 15.7608 15.6509 16.6482 14.7997C17.5441 13.9403 18 12.6642 18 11.027V4.97297C18 3.33583 17.5441 2.05969 16.6482 1.20035C15.7608 0.349085 14.5381 0 13.186 0H4.81395ZM15.0518 4.85388C15.3261 4.63485 15.3767 4.22748 15.1646 3.94401C14.9526 3.66053 14.5583 3.6083 14.2839 3.82735L9.6398 7.53436C9.26297 7.83524 8.73695 7.83524 8.36004 7.53436L3.71604 3.82735C3.44162 3.6083 3.04729 3.66053 2.83525 3.94401C2.62321 4.22748 2.67377 4.63485 2.94818 4.85388L7.59223 8.56095C8.4214 9.22275 9.57851 9.22275 10.4077 8.56095L15.0518 4.85388Z" fill="black" />
								</svg>

							</a>
						<?php endif; ?>

						<?php if ($linkedin): ?>
							<a href="<?= esc_url($linkedin); ?>" target="_blank" rel="noopener noreferrer"
								class="social-link"
								aria-label="LinkedIn">
								<svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
									<path d="M3.47331 16H0.0569397V4.57143H3.47331V16ZM16 16H12.5836V9.89486C12.5836 8.304 12.0188 7.512 10.8994 7.512C10.0122 7.512 9.44968 7.95543 9.16726 8.84343C9.16726 10.2857 9.16726 16 9.16726 16H5.75089C5.75089 16 5.79644 5.71429 5.75089 4.57143H8.44754L8.65594 6.85714H8.72655C9.4269 5.71429 10.5463 4.93943 12.0814 4.93943C13.2487 4.93943 14.1927 5.26514 14.9136 6.08343C15.639 6.90286 16 8.00229 16 9.54629V16Z" fill="black" />
									<path d="M1.76512 3.42857C2.73998 3.42857 3.53025 2.66106 3.53025 1.71429C3.53025 0.767512 2.73998 0 1.76512 0C0.790273 0 0 0.767512 0 1.71429C0 2.66106 0.790273 3.42857 1.76512 3.42857Z" fill="black" />
								</svg>
							</a>
						<?php endif; ?>

					</div>
				</li>
			<?php endforeach; ?>

		</ul>
	</div>
</section>

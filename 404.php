<?php get_header(); ?>
<main>
	<div class="container flex flex-col justify-center items-center min-h-[400px] md:min-h-[600px] xl:min-h-[800px]">
		<!-- <img src="<?php echo get_template_directory_uri(); ?>/src/images/404.png" alt="404" class="mb-20 md:mb-16 w-full"> -->

		<video class="mb-20 md:mb-16 w-full" autoplay muted loop>
			<source src="<?php echo get_template_directory_uri(); ?>/src/videos/404.webm" type="video/webm">
			Your browser does not support the video tag.
		</video>

		<h1 class="max-w-[320px] md:max-w-full uppercase text-[#565656] text-center text-[32px]/[36px] font-medium">
			<?php echo __('Помилка: Сторінку не знайдено', 'umbrella'); ?>
		</h1>
	</div>
</main>
<?php get_footer();

<?php

/**
* Template Name: Policy & Terms
* Description: Template for Policy and Terms pages
**/

get_header();
?>


<div class="container policy mt-[60px] md:mt-[48px] xl:mt-[96px]">
    <?php
    while ( have_posts() ) :
        the_post();
    ?>
		<!-- title -->
	    <h1 class="text-center font-unbounded font-black [font-size:clamp(23px,6.5vw,32px)] leading-[32px] md:text-[48px]/[48px] xl:text-[64px]/[64px] uppercase"><?php the_title(); ?></h1>
		<!-- Excerpt (text under title) -->
	    <?php if ( has_excerpt() ) : ?>
	        <div class="policy-excerpt mt-5 md:mt-8 text-[20px]/[28px] md:text-[24px]/[32px] xl:text-[32px]/[36px] text-gray uppercase text-center font-medium">
	            <?php the_excerpt(); ?>
	        </div>
	    <?php endif; ?>

		<!-- Content -->
		 <div class="policy-content my-[80px] xl:my-[128px]">
	        <?php the_content(); ?>
		</div>
	<?php endwhile; ?>
</div>

<?php get_footer(); ?>

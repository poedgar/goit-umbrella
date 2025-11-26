<?php
/**
 * Template Name: Test
 * Description: Test
 */

get_header(); ?>

<div class="full-width-template">
    <h1>Hey there from test template</h1>
    <?php
    while ( have_posts() ) :
        the_post();
        ?>

    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
        <header class="entry-header">
            <h1 class="entry-title"><?php the_title(); ?></h1>
        </header>

        <div class="entry-content">
            <?php the_content(); ?>
        </div>
    </article>

    <?php endwhile; ?>
</div>

<?php get_footer(); ?>
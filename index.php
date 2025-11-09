<?php get_header(); ?>
<main>
    <div id="enspyred-theme-default"></div>
    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
        <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
            <h2 class="entry-title"><?php the_title(); ?></h2>
            <div class="entry-content">
                <?php the_content(); ?>
            </div>
        </article>
    <?php endwhile; else : ?>
        <p><?php esc_html_e('Sorry, no content found.'); ?></p>
    <?php endif; ?>
    <?php
        if (function_exists('do_shortcode')) {
            // echo do_shortcode('[enspyred_contact_form config="default"]');
        }
    ?>
</main>
<?php get_footer(); ?>
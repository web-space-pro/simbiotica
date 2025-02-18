<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package simbiotica
 */

get_header();
?>

    <main class="container mx-auto px-4 py-8 flex flex-col md:flex-row gap-2">
        <?php if ( is_cart() || is_shop() ) : ?>
            <!-- Левый сайдбар -->
            <aside class="w-full md:w-1/4 order-2 md:order-1">
                <div class="bg-gray-100 dark:bg-gray-800 p-4 rounded-lg shadow-md">
                    <h2 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Фильтры</h2>
                    <?php if (is_active_sidebar('shop-sidebar')) : ?>
                        <?php dynamic_sidebar('shop-sidebar'); ?>
                    <?php else : ?>
                        <p class="text-gray-600 dark:text-gray-400">Добавьте фильтры в админке.</p>
                    <?php endif; ?>
                </div>
            </aside>
            <?php
            while ( have_posts() ) :
                the_post();
                get_template_part( 'content-parts/content', 'page' );
            endwhile;
            ?>
        <?php else:?>
            <!-- Левый сайдбар -->
            <div class="w-full md:w-1/3 lg:w-1/4 order-2 md:order-1">
                <?php get_sidebar(); ?>
            </div>

            <?php
            while ( have_posts() ) :
                the_post();
                get_template_part( 'content-parts/content', 'page' );
            endwhile;
            ?>
        <?php endif;?>
    </main>

<?php get_footer(); ?>

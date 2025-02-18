<?php
    /**
     * The template for shop *
     * @package simbiotica
     */

?>

<?php get_header(); ?>

<main class="container mx-auto px-4 py-8 flex flex-col md:flex-row gap-8">

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

    <!-- Сетка товаров -->
    <section class="w-full md:w-3/4 order-1 md:order-2">
        <h1 class="text-3xl font-bold text-gray-900 dark:text-white mb-6"><?php woocommerce_page_title(); ?></h1>

        <?php if (have_posts()) : ?>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                <?php while (have_posts()) : the_post(); ?>
                    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md overflow-hidden">
                        <a href="<?php the_permalink(); ?>">
                            <?php if (has_post_thumbnail()) : ?>
                                <img class="w-full h-48 object-cover" src="<?php the_post_thumbnail_url(); ?>" alt="<?php the_title(); ?>">
                            <?php endif; ?>
                        </a>
                        <div class="p-4">
                            <h2 class="text-xl font-semibold text-gray-900 dark:text-white">
                                <a href="<?php the_permalink(); ?>" class="hover:underline"><?php the_title(); ?></a>
                            </h2>
                            <p class="text-gray-600 dark:text-gray-400 mt-2"><?php echo get_the_excerpt(); ?></p>
                            <p class="text-lg font-semibold text-blue-600 dark:text-blue-400 mt-2"><?php echo wc_price(get_post_meta(get_the_ID(), '_price', true)); ?></p>
                            <a href="<?php echo esc_url('?add-to-cart=' . get_the_ID()); ?>" class="inline-block mt-4 px-4 py-2 bg-blue-600 text-white font-semibold rounded hover:bg-blue-700 transition">В корзину</a>
                        </div>
                    </div>
                <?php endwhile; ?>
            </div>

            <div class="mt-8 flex justify-center">
                <?php woocommerce_pagination(); ?>
            </div>
        <?php else : ?>
            <p class="text-gray-700 dark:text-gray-300 text-center">Товаров пока нет.</p>
        <?php endif; ?>
    </section>

</main>

<?php get_footer(); ?>


<?php
/**
 * The Template for displaying product archives, including the main shop page which is a post type archive
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/archive-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 8.6.0
 */

defined( 'ABSPATH' ) || exit;

get_header( 'shop' );


// Получаем список категорий товаров
$categories = get_terms([
    'taxonomy'   => 'product_cat',
    'hide_empty' => false,
    'exclude'    => [15],
    'orderby'    => 'date',
    'order'      => 'DESC',
]);

// Определяем активную категорию (если не выбрана - берём первую)
$first_categoryID    = !empty($categories) && is_array($categories) ? $categories[0]->term_id : '';
$current_category_id = is_tax('product_cat') ? get_queried_object_id() : $first_categoryID;

// Создаём кастомный запрос для вывода товаров только из выбранной категории
$args = [
    'post_type'      => 'product',
    'posts_per_page' => -1,
    'tax_query'      => [
        [
            'taxonomy' => 'product_cat',
            'field'    => 'term_id',
            'terms'    => $first_categoryID,
        ]
    ]
];

// Подменяем глобальный запрос WooCommerce
$query = new WP_Query($args);
?>
<div class="min-h-svh flex-grow-1 flex flex-col px-4 sm:px-[2.8vmax] pt-6 pb-6">
    <?php
    do_action( 'woocommerce_before_main_content' );
    do_action('woocommerce_shop_loop_header');
    ?>

    <section class="filter-product">
        <div class="pb-6 sm:pb-8 flex gap-2 sm:gap-4 lowercase items-center overflow-x-auto scrollbar-none">
            <?php foreach ($categories as $key => $item) :
                $is_active = ($current_category_id == $item->term_id) ? 'active' : '';
                ?>
                <button type="button" data-id="<?= esc_attr($item->term_id) ?>" data-name="<?= esc_attr($item->slug) ?>"
                        class="<?= $is_active ?> w-fit lowercase outline-none hover:border-gray-10 border-gray-10/0 border px-2 py-1 shrink-0 border-black">
                    <?= esc_html($item->name) ?>
                </button>
            <?php endforeach; ?>
        </div>
    </section>


    <section class="mb-7 sm:mb-10">
        <ul id="products-list" class="grid grid-cols-2 lg:grid-cols-3 gap-4">
            <?php if ($query->have_posts()) : ?>
                <?php while ($query->have_posts()) : $query->the_post(); ?>
                    <?php wc_get_template_part('content', 'product'); ?>
                <?php endwhile; ?>
            <?php else : ?>
                <p class="text-center text-gray-500 col-span-2 lg:col-span-3">Товары не найдены</p>
            <?php endif; ?>
        </ul>
    </section>

    <?php
    do_action( 'woocommerce_after_main_content' );
    do_action('woocommerce_sidebar');
    ?>


    <section class="hidden related-products mt-7 sm:mt-10 mb-8 sm:mb-16">
        <div class="text-2xl sm:text-[1.75rem] mb-5 sm:mb-10 font-medium leading-tight">
            <h2>Возможно вас может еще заинтересовать</h2>
        </div>
        <div class="grid gap-y-4 gap-x-[1.2vmax] sm:gap-y-[1.2vmax] grid-cols-2 lg:grid-cols-3">
            <?php
            $args_related = [
                'post_type'      => 'product',
                'posts_per_page' => 9,
                'orderby'        => 'rand',
            ];
            $loop_related = new WP_Query($args_related);

            if ($loop_related->have_posts()) :
                while ($loop_related->have_posts()) :
                    $loop_related->the_post();
                    wc_get_template_part('content', 'product');
                endwhile;
                wp_reset_postdata();
            endif;
            ?>
        </div>
    </section>
</div>

<?php
wp_reset_postdata();
get_footer();
?>











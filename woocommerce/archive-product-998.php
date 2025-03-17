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


$categories = get_terms([
    'taxonomy' => 'product_cat',
    'hide_empty' => false,
    'exclude' => [15],
    'orderby' => 'date',
    'order' => 'DESC',
]);
// Получаем первый ID категории
$first_categoryID = !empty($categories) && is_array($categories) ? $categories[0]->term_id : '';
$current_category_id = is_tax('product_cat') ? get_queried_object_id() : $first_categoryID;


$args = [
    'post_type'      => 'product',
    'posts_per_page' => 12,
    'tax_query'      => [
        [
            'taxonomy' => 'product_cat',
            'field'    => 'term_id',
            'terms'    => $current_category_id,
        ]
    ]
];

$query = new WP_Query($args);

?>
   <div class="min-h-svh flex-grow-1 flex flex-col px-4 sm:px-[2.8vmax] pt-6 pb-6">
    <?php

    /**
     * Hook: woocommerce_before_main_content.
     *
     * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
     * @hooked woocommerce_breadcrumb - 20
     * @hooked WC_Structured_Data::generate_website_data() - 30
     */
    do_action( 'woocommerce_before_main_content' );


    /**
     * Hook: woocommerce_shop_loop_header.
     *
     * @since 8.6.0
     *
     * @hooked woocommerce_product_taxonomy_archive_header - 10
     */
    do_action('woocommerce_shop_loop_header');

    ?>
    <section class="filter-product">
        <div class="pb-6 sm:pb-8 flex gap-2 sm:gap-4 lowercase items-center overflow-x-auto scrollbar-none">
            <?php foreach ($categories as $key => $item) :
                $is_active = ($current_category_id == $item->term_id) ? 'active' : '';
            ?>
                <button type="button" data-id="<?= $item->term_id ?>" data-name="<?= $item->slug ?>"
                        class="<?=$is_active?> w-fit lowercase outline-none hover:border-gray-10 border-gray-10/0 border px-2 py-1 shrink-0 border-black">
                    <?= $item->name ?>
                </button>
            <?php endforeach; ?>
        </div>
    </section>
    <section class="mb-7 sm:mb-10">
        <?php
        if ($query->have_posts()) :
            echo '<ul id="products-list" class="products-list grid gap-y-4 gap-x-[1.2vmax] sm:gap-y-[1.2vmax] grid-cols-2 lg:grid-cols-3">';
            while ($query->have_posts()) : $query->the_post();
                wc_get_template_part('content', 'product');
            endwhile;
            echo '</div>';
            wp_reset_postdata();
        else :
            echo '<p>Нет товаров в этой категории.</p>';
        endif;
        ?>
    </section>

    <?php
    /**
     * Hook: woocommerce_after_main_content.
     *
     * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
     */
    do_action( 'woocommerce_after_main_content' );

    /**
     * Hook: woocommerce_sidebar.
     *
     * @hooked woocommerce_get_sidebar - 10
     */
    do_action('woocommerce_sidebar');

    ?>

<!--    <section class="hidden related-products mt-7 sm:mt-10 mb-8 sm:mb-16">-->
<!--        <div class="text-2xl sm:text-[1.75rem] mb-5 sm:mb-10 font-medium leading-tight">-->
<!--            <h2>Возможно вас может еще заинтересовать</h2>-->
<!--        </div>-->
<!--        <div class="grid gap-y-4 gap-x-[1.2vmax] sm:gap-y-[1.2vmax] grid-cols-2 lg:grid-cols-3">-->
<!--        --><?php
//            $args = array(
//                'post_type'      => 'product',
//                'posts_per_page' => 9,
//                'orderby'        => 'rand',
//            );
//            $loop = new WP_Query($args);
//
//            if ($loop->have_posts()) :
//                while ($loop->have_posts()) : $loop->the_post();
//                    wc_get_template_part('content', 'product');
//                endwhile;
//                wp_reset_postdata();
//            endif;
//        ?>
<!--        </div>-->
<!--    </section>-->
</div>
<?php get_footer( '' ); ?>












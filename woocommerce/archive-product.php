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
    'orderby'    => 'name',
    'order'      => 'DESC',
]);
?>

<div class="min-h-svh flex-grow-1 flex flex-col px-4 sm:px-[2.8vmax] pt-6 pb-6">
    <?php
    do_action( 'woocommerce_before_main_content' );
    do_action('woocommerce_shop_loop_header');
    ?>
    <?php foreach ($categories as $category) :
        $args = [
            'post_type'      => 'product',
            'posts_per_page' => -1,
            'tax_query'      => [
                [
                    'taxonomy' => 'product_cat',
                    'field'    => 'term_id',
                    'terms'    => $category->term_id,
                ]
            ]
        ];
        $query = new WP_Query($args);

        if ($query->have_posts()) : ?>
            <section class="mb-7 sm:mb-10">
                <div id="category-<?= esc_attr($category->term_id) ?>" class="offset-anchor"></div>
                <h2 class="text-2xl font-bold mb-4"> <?= esc_html($category->name) ?> </h2>
                <ul class="grid grid-cols-2 lg:grid-cols-3 gap-4">
                    <?php while ($query->have_posts()) : $query->the_post();
                        wc_get_template_part('content', 'product');
                    endwhile; ?>
                </ul>
            </section>
        <?php endif;
        wp_reset_postdata();
    endforeach; ?>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const buttons = document.querySelectorAll('.scroll-to');
            const sections = document.querySelectorAll('.offset-anchor');
            const headerHeight = document.querySelector('header');
            const headerOffset =  headerHeight.getBoundingClientRect().height;

            function updateActiveButton(targetId) {
                buttons.forEach(btn => {
                    btn.classList.remove('active');
                });

                const activeButton = document.querySelector(`.scroll-to[data-target="${targetId}"]`);
                if (activeButton) {
                    activeButton.classList.add('active');
                }
            }

            buttons.forEach(button => {
                button.addEventListener('click', function() {
                    const target = document.getElementById(this.getAttribute('data-target'));
                    if (target) {
                        window.scrollTo({
                            top: target.offsetTop - headerOffset,
                            behavior: 'smooth'
                        });
                        updateActiveButton(this.getAttribute('data-target'));
                    }
                });
            });

            const observer = new IntersectionObserver(entries => {
                let activeId = null;
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        activeId = entry.target.id;
                    }
                });
                if (activeId) {
                    updateActiveButton(activeId);
                }
            }, { rootMargin: "-90px 0px -80% 0px", threshold: 0.2 });

            sections.forEach(section => {
                observer.observe(section);
            });
        });
    </script>

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











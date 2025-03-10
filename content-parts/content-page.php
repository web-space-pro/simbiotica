<?php
/**
 * Template part for displaying page content in page.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package simbiotica
 */

?>

<?php if (is_cart() || is_checkout() || is_wc_endpoint_url('order-received') || is_account_page()): ?>
    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
        <div class="flex flex-col md:flex-row gap-4 md:gap-16">
            <div class="w-full">
                <?php if (is_cart()): ?>
                    <div class="flex flex-row justify-between items-center">
                        <h1 class="text-2xl md:text-[1.75rem] lowercase leading-tight font-medium text-black"><?php the_title(); ?></h1>
                        <?php if (!WC()->cart->is_empty()) : ?>
                            <a href="#" target="_self">поделиться корзиной</a>
                        <?php endif; ?>
                    </div>
                <?php else: ?>
                    <h1 class="text-2xl md:text-[1.75rem] lowercase leading-tight font-medium text-black"><?php the_title(); ?></h1>
                <?php endif; ?>
                <div class="max-w-full mt-4 pt-5 border-t border-gray-10 font-sans *:mb-4">
                    <?php the_content(); ?>
                </div>
            </div>
        </div>
    </article>
<?php else:?>
    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
        <div class="flex flex-col md:flex-row gap-4 md:gap-16">
            <?php if (has_post_thumbnail()) : ?>
                <div class="hidden md:block md:w-6/12 xl:w-8/12">
                    <div class="relative h-full">
                        <div class="xs:w-1/2 m-auto  md:w-full md:sticky md:top-20 2xl:top-16">
                            <?php simbiotica_post_thumbnail(); ?>
                        </div>
                    </div>
                </div>
                <div class="md:w-6/12 xl:w-4/12">

                    <h1 class="text-2xl md:text-[1.75rem] leading-tight font-medium text-black"><?php the_title(); ?></h1>
                    <div class="block md:hidden max-w-full mt-4 pt-5 border-t border-gray-10">
                        <div class="relative h-full">
                            <?php simbiotica_post_thumbnail(); ?>
                        </div>
                    </div>

                    <div class="max-w-full mt-4 pt-5 border-t border-gray-10 font-sans *:mb-4">
                        <?php the_content(); ?>
                    </div>

                    <div class="hidden md:block sticky bottom-16 h-[3.438rem] text-mask"></div>
                </div>
            <?php else: ?>
                <div class="w-full">

                    <h1 class="text-2xl md:text-[1.75rem] leading-tight font-medium text-black"><?php the_title(); ?></h1>

                    <div class="max-w-full mt-4 pt-5 border-t border-gray-10 font-sans *:mb-4">
                        <?php the_content(); ?>
                    </div>

                    <div class="hidden md:block sticky bottom-16 h-[3.438rem] text-mask"></div>
                </div>
            <?php endif; ?>
        </div>
    </article>
<?php endif;?>


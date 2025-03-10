<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package simbiotica
 */
if (!is_cart() && !is_checkout() && !is_wc_endpoint_url('order-received') && !is_account_page()) {
    $postID = get_the_ID();
    $year_create = get_field('project_yers', $postID);
    $gallery = get_field('project_gallery', $postID);
}
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <?php if (!is_cart() && !is_checkout() && !is_wc_endpoint_url('order-received') && !is_account_page()): ?>
        <div class="flex flex-col md:flex-row gap-4 md:gap-16">
            <div class="md:w-6/12 xl:w-7/12">
                <h1 class="block md:hidden text-2xl md:text-[1.75rem] leading-tight font-medium text-black"><?php the_title(); ?></h1>
                <?php if(!empty($year_create)):?>
                    <div class="block md:hidden font-sans text-xl md:text-2xl text-black mb-5 mt-3 md:mt-5">
                        <span><?=$year_create?></span>
                    </div>
                <?php endif; ?>
                <div class="relative h-full">
                    <div class="xs:w-1/2 m-auto  md:w-full md:sticky md:top-20 2xl:top-16">
                        <?php  if (!empty($gallery)): ?>
                            <div class="slider" id="slider-product">
                                <?php
                                foreach ($gallery as $image_id) {
                                    echo wp_get_attachment_image($image_id, 'post');
                                }
                                ?>
                            </div>
                        <?php else: ?>
                            <div class="post-thumbnail">
                                <?php the_post_thumbnail('post'); ?>
                            </div>
                        <?php endif;?>
                    </div>
                </div>

            </div>
            <div class="md:w-6/12 xl:w-5/12">

                <h1 class="hidden md:block text-2xl md:text-[1.75rem] leading-tight font-medium text-black"><?php the_title(); ?></h1>

                <?php if(!empty($year_create)):?>
                    <div class="hidden md:block font-sans text-xl md:text-2xl text-black mb-5 mt-5">
                        <span><?=$year_create?></span>
                    </div>
                <?php endif; ?>

                <div class="max-w-full mt-4 pt-5 border-t border-gray-10 font-sans *:mb-4">
                    <?php the_content(); ?>
                </div>

                <div class="hidden md:block sticky bottom-16 h-[3.438rem] text-mask"></div>
            </div>
        </div>
    <?php else:?>
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
    <?php endif; ?>

</article>

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
}
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <?php if (!is_cart() && !is_checkout() && !is_wc_endpoint_url('order-received') && !is_account_page()): ?>
        <div class="flex flex-col md:flex-row gap-4 md:gap-16">
            <div class="md:w-6/12 xl:w-8/12">
                <h1 class="block md:hidden text-2xl md:text-[1.75rem] leading-tight font-medium text-black"><?php the_title(); ?></h1>
                <?php if(!empty($year_create)):?>
                    <div class="block md:hidden font-sans text-xl md:text-2xl text-black mb-5 mt-3 md:mt-5">
                        <span><?=$year_create?></span>
                    </div>
                <?php endif; ?>
                <div class="relative h-full">
                    <div class="xs:w-1/2 m-auto  md:w-full md:sticky md:top-20 2xl:top-16">
                        <?php simbiotica_post_thumbnail(); ?>
                        <div class="absolute z-10 top-0 right-0">
                            <?php
                            the_post_navigation(
                                array(
                                    'prev_text' => '<svg width="24" height="24" viewBox="0 0 24 24" fill="none"><path fill-rule="evenodd" clip-rule="evenodd" d="M10.5552 4.21301C10.8406 4.49703 10.8406 4.95751 10.5552 5.24153L4.495 11.2727H20.2692C20.6728 11.2727 21 11.5983 21 12C21 12.4017 20.6728 12.7273 20.2692 12.7273H4.495L10.5552 18.7585C10.8406 19.0425 10.8406 19.503 10.5552 19.787C10.2698 20.071 9.80711 20.071 9.52173 19.787L2.21404 12.5143C1.92865 12.2302 1.92865 11.7698 2.21404 11.4857L9.52173 4.21301C9.80711 3.929 10.2698 3.929 10.5552 4.21301Z" fill="#3F4042" /></svg>',
                                    'next_text' => '<svg width="24" height="24" viewBox="0 0 24 24" fill="none"><path fill-rule="evenodd" clip-rule="evenodd" d="M12.4448 4.21301C12.1594 4.49703 12.1594 4.95751 12.4448 5.24153L18.505 11.2727H2.73077C2.32718 11.2727 2 11.5983 2 12C2 12.4017 2.32718 12.7273 2.73077 12.7273H18.505L12.4448 18.7585C12.1594 19.0425 12.1594 19.503 12.4448 19.787C12.7302 20.071 13.1929 20.071 13.4783 19.787L20.786 12.5143C21.0713 12.2302 21.0713 11.7698 20.786 11.4857L13.4783 4.21301C13.1929 3.929 12.7302 3.929 12.4448 4.21301Z" fill="#3F4042" /></svg>',
                                )
                            );
                            ?>
                        </div>
                    </div>
                </div>

            </div>
            <div class="md:w-6/12 xl:w-4/12">

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

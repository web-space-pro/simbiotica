<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package simbiotica
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <?php wp_head(); ?>
</head>

<body <?php body_class('flex flex-col min-h-screen antialiased font-sans font-normal bg-white-10 leading-normal text-sm xs:text-base text-black selection:bg-black selection:text-white-10'); ?> data-page-id="<?php the_ID(); ?>">
<?php wp_body_open(); ?>

    <?php if (!is_front_page()): ?>
    <header class="max-w-full-client-width px-[2.8vmax] top-0 sticky z-40 w-full bg-white backdrop-blur-md overflow-hidden">
        <div class=" flex py-4 gap-y-4 justify-between items-center flex-wrap ">
            <div class="flex gap-x-4 flex-row w-full basis-1/5 md:w-auto md:basis-1/2">
                <nav class="hidden xs:flex flex-row" role="navigation">
                    <?php header_nav(); ?>
                </nav>
                <div class="xs:hidden">
                    <div id="nav-icon">
                        <span></span>
                        <span></span>
                        <span></span>
                        <span></span>
                        <span></span>
                        <span></span>
                    </div>
                </div>
            </div>
            <div class="flex justify-end flex-row items-center w-full basis-3/5 md:w-auto md:basis-1/2 twrapper">
                <div class="tcontainer">
                    <div class="front flex justify-end flex-row items-center">
                        <div class="flex gap-4 pr-8 md:pr-[15vmax]">
                            <a href="<?php echo wc_get_cart_url(); ?>" target="_self">
                                <div class="text-black flex relative items-center justify-center gap-0">
                                    <div class="select-none xs:text-xl font-medium leading-none" id="cart-count">
                                        <?php echo WC()->cart->get_cart_contents_count(); ?>
                                    </div>
                                    <svg width="32" height="32" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M16.0007 5.33333C13.684 5.33333 11.7823 7.18277 11.7823 9.4359V10.2564H7.61614L7.56384 11.0261L6.72014 25.7953L6.66699 26.6667H25.3337L25.2814 25.7945L24.4377 11.0252L24.3845 10.2564H20.2192V9.4359C20.2192 7.18277 18.3175 5.33333 16.0007 5.33333ZM16.0007 6.97436C16.672 6.97436 17.3158 7.2337 17.7905 7.69533C18.2652 8.15696 18.5318 8.78306 18.5318 9.4359V10.2564H13.4697V9.4359C13.4697 8.78306 13.7363 8.15696 14.211 7.69533C14.6857 7.2337 15.3295 6.97436 16.0007 6.97436ZM9.19807 11.8974H11.7823V14.359H13.4697V11.8974H18.5318V14.359H20.2192V11.8974H22.8034L23.5417 25.0256H8.46068L9.19807 11.8974Z" fill="black" />
                                    </svg>
                                </div>
                            </a>
                            <a href="<?php echo esc_url( wc_get_page_permalink( 'myaccount' ) ); ?>" target="_self">
                                <svg width="32" height="32" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M25.8294 22.743C25.2943 21.5455 24.5177 20.4578 23.5429 19.5404C22.5711 18.6203 21.4199 17.8868 20.1528 17.3802C20.1415 17.3749 20.1301 17.3722 20.1188 17.3668C21.8862 16.1608 23.0351 14.1963 23.0351 11.9799C23.0351 8.30821 19.8862 5.33333 15.9997 5.33333C12.1132 5.33333 8.96426 8.30821 8.96426 11.9799C8.96426 14.1963 10.1132 16.1608 11.8806 17.3695C11.8692 17.3749 11.8579 17.3776 11.8465 17.3829C10.5756 17.8894 9.43518 18.6157 8.45646 19.543C7.48259 20.4612 6.70613 21.5487 6.16995 22.7457C5.64321 23.9176 5.35913 25.174 5.33308 26.4469C5.33232 26.4755 5.33763 26.504 5.3487 26.5306C5.35976 26.5572 5.37636 26.5815 5.39751 26.602C5.41866 26.6225 5.44394 26.6387 5.47185 26.6498C5.49976 26.661 5.52974 26.6667 5.56003 26.6667H7.26214C7.38697 26.6667 7.48626 26.5729 7.48909 26.4576C7.54583 24.3886 8.42526 22.4509 9.97986 20.9822C11.5884 19.4626 13.7245 18.6265 15.9997 18.6265C18.2748 18.6265 20.411 19.4626 22.0195 20.9822C23.5741 22.4509 24.4535 24.3886 24.5103 26.4576C24.5131 26.5755 24.6124 26.6667 24.7372 26.6667H26.4393C26.4696 26.6667 26.4996 26.661 26.5275 26.6498C26.5554 26.6387 26.5807 26.6225 26.6018 26.602C26.623 26.5815 26.6396 26.5572 26.6507 26.5306C26.6617 26.504 26.667 26.4755 26.6663 26.4469C26.6379 25.1658 26.357 23.9196 25.8294 22.743ZM15.9997 16.5896C14.6976 16.5896 13.472 16.1099 12.5501 15.2389C11.6281 14.3678 11.1203 13.2101 11.1203 11.9799C11.1203 10.7497 11.6281 9.59196 12.5501 8.72094C13.472 7.84992 14.6976 7.37018 15.9997 7.37018C17.3018 7.37018 18.5273 7.84992 19.4493 8.72094C20.3713 9.59196 20.8791 10.7497 20.8791 11.9799C20.8791 13.2101 20.3713 14.3678 19.4493 15.2389C18.5273 16.1099 17.3018 16.5896 15.9997 16.5896Z" fill="black" />
                                </svg>
                            </a>
                        </div>
                        <a href="<?=get_home_url()?>" target="_self">
                            <img class="h-5 w-24 xs:w-28 select-none" src="/wp-content/uploads/2025/02/logo_simbiotica.svg" alt="Логотип Masamadre" draggable="false">
                        </a>
                    </div>
                    <nav class="back mobile-menu flex xs:hidden flex-row" role="navigation">
                        <?php header_nav(); ?>
                    </nav>
                </div>
            </div>
        </div>

        <?php if(is_shop()):?>
        <?php
            $categories = get_terms([
                'taxonomy'   => 'product_cat',
                'hide_empty' => true,
                'exclude'    => [15],
                'orderby'    => 'name',
                'order'      => 'DESC',
            ]);
        ?>
            <div class="filter-product pb-3 sm:pb-8 pt-2 sm:pt-4">
                <div class="flex gap-2 sm:gap-4 lowercase items-center overflow-x-auto scrollbar-none">
                    <?php foreach ($categories as $key => $item):?>
                        <button type="button" class="<?= ($key == 1 ) ? 'active': ''?> scroll-to w-fit lowercase outline-none hover:border-gray-10 border-gray-10/0 border px-2 py-1 shrink-0 border-black" data-target="category-<?= esc_attr($item->term_id) ?>">
                            <?= esc_html($item->name) ?>
                        </button>
                    <?php endforeach; ?>
                </div>
            </div>
        <?php endif; ?>
    </header>
    <?php endif; ?>
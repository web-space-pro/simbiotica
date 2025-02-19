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

<body <?php body_class('antialiased font-reg font-normal bg-white-10 leading-none text-base text-black lowercase selection:bg-black selection:text-white-10'); ?>>
<?php wp_body_open(); ?>

    <?php if (!is_front_page()): ?>
    <header class="sticky bg-light-100 py-1 xl:py-3.5 w-full top-0 font-normal backdrop-blur-2xl z-50">
        <div class="relative text-sm xl:text-base text-black font-semibold">
            <div class="container">
                <div class="flex items-center">
                    <div class="w-[65px] xl:w-[100px]">
                        <a href="<?php echo home_url(); ?>" title="<?php bloginfo('name'); ?>">
                            SITE LOGO
                        </a>
                    </div>
                    <div class="w-full flex items-center justify-end">
                        <nav class="hidden lg:block mr-2 xl:mr-20 ml-4">
                            <?php
                            wp_nav_menu(
                                array(
                                    'theme_location' => 'menu-1',
                                    'menu_id'        => 'primary-menu',
                                )
                            );
                            ?>
                        </nav>
                        <div class="hidden sm:flex items-center flex-none">
                            <a class="flex items-center mr-5" href="tel:+79907777777">
                                +79907777777
                            </a>
                        </div>
                    </div>
                    <div class="lg:hidden ml-auto w-auto">
                        <div class="hamburger hamburger--squeeze">
                            <div class="hamburger-box">
                                <div class="hamburger-inner"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <nav class="absolute menu-mobile hidden flex-col w-full text-gray-900">
            <div class="bg-light-100 top-0 p-6 overflow-x-auto h-[70vh]">
                <div>
                    <?php
                    wp_nav_menu(
                        array(
                            'theme_location' => 'menu-1',
                            'menu_id'        => 'primary-menu',
                        )
                    );
                    ?>
                </div>
                <div class="flex flex-wrap border-t-2 pt-5 justify-center items-center flex-none">
                    <a class="flex items-center mr-5" href="tel:+79907777777">
                        +79907777777
                    </a>
                </div>
            </div>
        </nav>
    </header>
    <?php endif; ?>
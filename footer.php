<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package simbiotica
 */

?>

<footer class="py-5 xl:py-10 text-center font-base text-light-100 font-semibold">
    <div class="container">
        <div class="flex justify-between">
            <div class="pb-3.5 xl:pb-7">
                <div class="mx-auto">
                    <a href="<?php echo home_url(); ?>" title="<?php bloginfo('name'); ?>">
                        SITE LOGO
                    </a>
                </div>
            </div>
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
        </div>
        <div class="block sm:flex justify-between">
            <span class="text-light-150 text-sm font-normal">Копирайт</span>
            <div class="text-light-150 text-xs">

                <ul class="flex justify-center">

                    <li class="px-3">
                        <a class="bg-black-100 hover:bg-red-100 flex items-center w-8 h-8 p-2 rounded-full transition duration-300" href="" target="">
                            tg
                        </a>
                    </li>
                </ul>

            </div>
        </div>
    </div>
</footer>


<?php wp_footer(); ?>

</body>
</html>

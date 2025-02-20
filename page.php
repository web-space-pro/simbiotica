<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package simbiotica
 */

get_header();
?>
    <main class="flex flex-col md:h-[75svh] overflow-x-hidden px-[2.8vmax] pt-6 mb-20 sm:mb-24">


        <?php
        while ( have_posts() ) :
            the_post();
            if (function_exists('have_rows') && have_rows('components' )  ) :
                while( have_rows('components') )
                {
                    the_row();
                    $layout = get_row_layout();
                    $inclusion = get_stylesheet_directory() . DIRECTORY_SEPARATOR . "block-parts" . DIRECTORY_SEPARATOR ."tpl-{$layout}.php";
                    if( file_exists( $inclusion ) )
                    {
                        include( $inclusion );
                    }
                }
            else:
                ?>
                <section style="display: none">
                    <?php get_template_part( 'content-parts/content', get_post_type('page') ); ?>
                </section>
            <?php
            endif;
        endwhile;
        ?>
    </main>

<?php get_footer(); ?>

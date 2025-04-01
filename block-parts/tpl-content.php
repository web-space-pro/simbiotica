<?php
if ( function_exists('get_field') ) {
    $show  = get_sub_field('show_page_content');
}
?>
<?php if($show):?>
    <section class="relative">
        <div class="w-full">
            <div class="mt-6 sm:mt-14 font-sans text-gray-10 page-content *:mb-6">
                <?php the_content(); ?>
            </div>
        </div>
    </section>
<?php endif;?>


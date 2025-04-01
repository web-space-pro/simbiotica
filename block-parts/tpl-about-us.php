<?php
if ( function_exists('get_field') ) {

}
?>

<section class="mt-2 xl:mt-20 mb-4">
    <div class="flex flex-col md:flex-row gap-4 md:gap-16">
        <div class="md:w-6/12 xl:w-8/12">
            <h1 class="block md:hidden text-2xl md:text-[1.75rem] leading-tight font-medium text-black"><?php the_title(); ?></h1>
            <div class="relative h-full">
                <div class="xs:w-1/2 m-auto  md:w-full md:sticky md:top-20 2xl:top-16">
                    <?php simbiotica_post_thumbnail(); ?>
                </div>
            </div>
        </div>
        <div class="md:w-6/12 xl:w-4/12">

            <h1 class="hidden md:block text-2xl md:text-[1.75rem] leading-tight font-medium text-black"><?php the_title(); ?></h1>

            <div class="max-w-full mt-4 pt-5 border-t border-gray-10 font-sans *:mb-4">
                <?php the_content(); ?>
            </div>

            <div class="hidden md:block sticky bottom-16 h-[3.438rem] text-mask"></div>
        </div>
    </div>
</section>

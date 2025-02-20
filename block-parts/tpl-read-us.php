<?php
if ( function_exists('get_field') ) {
    $title  = get_sub_field('title');
    $titleTwo  = get_sub_field('title-two');
    $titleLast  = get_sub_field('title-last');

    $links  = get_sub_field('links');
    $remark  = get_sub_field('remark');
}
?>

<section class="mt-2 xl:mt-20 mb-4">
    <div class="mb-10">
        <?php if(!empty($title)) : ?>
            <h1 class="text-[1.75rem] sm:text-[2rem] lg:text-[2.5rem] font-medium leading-tight">
                <?=$title?>
                <span class="block xs:pl-[7vmax]"><?=$titleTwo?>
                <span class="text-gray-20"><?=$titleLast?></span>
            </span>
            </h1>
        <?php endif; ?>
    </div>
    <?php if(!empty($links)) : ?>
    <div class="w-full sm:flex sm:justify-end xs:pl-[7vmax] sm:pl-0 sm:pr-[10vmax]">
        <div class="grid gap-4 grid-cols-2 xs:grid-cols-3">
        <?php foreach($links as $value): ?>
            <div>
                <a href="<?=$value['link']['url']?>" target="_blank" class="inline-block w-full text-center relative font-medium transition-all before:content-[''] before:duration-300 before:ease-out before:top-0 before:left-0 before:bottom-0 before:w-0 before:absolute before:h-full hover:before:w-full hover:before:bg-black">
                    <span class="sm:px-12 py-6 px-4 border border-black inline-block w-full hover:text-white-10 relative top-0 left-0 transition-all">
                        <?=$value['link']['title']?>
                    </span>
                </a>
            </div>
        <?php endforeach; ?>
        </div>
    </div>
    <?php endif; ?>
    <?php if(!empty($remark)) : ?>
        <div class="text-sm text-gray-20 mt-10 sm:mt-24 xs:pl-[7vmax] sm:pl-0 sm:max-w-80 sm:ml-auto font-sans">
            <?=$remark?>
        </div>
    <?php endif; ?>
</section>

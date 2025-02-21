<?php
if ( function_exists('get_field') ) {

    $title_head  = get_sub_field('title_head');
    $title       = $title_head['title'];
    $titleTwo    = $title_head['title_two'];
    $titleThree  = $title_head['title_three'];

    $text        = get_sub_field('tekst');
    $description = get_sub_field('description');
    $link        = get_sub_field('link');

    $policy      = get_sub_field('policy');
    $p_title     = $policy['title'];
    $p_text      = $policy['text'];

}
?>

<section class="mt-2 xl:mt-20 mb-4">
    <?php if(!empty($title)) : ?>
        <div class="sm:max-w-[43rem] mb-8 sm:mb-16">
          <h1 class="text-[1.75rem] sm:text-[2rem] lg:text-[2.5rem] font-medium leading-tight">
                    <?=$title?>
                    <span class="sm:block xs:pl-[7vmax]">
                        <?=$titleTwo?>
                        <span class="text-gray-20"><?=$titleThree?></span>
                    </span>
                </h1>
        </div>
    <?php endif; ?>

    <div class="">
        <?php if(!empty($text)) : ?>
            <div class="text-2xl sm:text-3xl xl:text-[1.75rem] text-gray-20 font-medium leading-tight">
                <?=$text?>
            </div>
        <?php endif; ?>
        <?php if(!empty($description)) : ?>
            <div class="mt-6 sm:mt-14 sm:max-w-[33rem] font-sans text-xl text-gray-10">
                <?=$description?>
            </div>
        <?php endif; ?>
    </div>
    <div class="mt-8 sm:mt-20">
        <div class="flex flex-col sm:flex-row gap-10 justify-between">
            <?php if(!empty($link)) : ?>
            <div class="w-full xl:w-2/6 sm:mt-9">
                <a href="<?=$link['url']?>" target="<?=$link['target']?>" class="link">
                   <?=$link['title']?>
                </a>
            </div>
            <?php endif; ?>
            <div class="w-full xl:w-1/4 mr-[6vmax]">
                <?php if(!empty($policy)) : ?>
                    <h3 class="text-2xl font-medium leading-tight"><?=$p_title?></h3>
                    <div class="text-base text-gray-20 mt-8 font-sans">
                        <?=$p_text?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>

<?php
if ( function_exists('get_field') ) {
    $title  = get_sub_field('header');
    $link  = get_sub_field('link');
    $photo  = get_sub_field('tg_photo');
    $incentives  = get_sub_field('incentives');

}
?>

<section class="hero">
    <div class="hero__container">
        <div class="hero__image">
            <?php if(!empty($photo)) : ?>
            <div class="hero__image--box">
                <figure>
                    <img src="<?=$photo?>" alt="<?=get_bloginfo()?>" width="262" height="240">
                </figure>
            </div>
            <?php endif; ?>
        </div>
        <div class="hero__content">
            <div class="hero__content--title">
                <?php if(!empty($title)) : ?>
                    <h1><?=$title?></h1>
                <?php endif; ?>
            </div>

            <?php if(!empty($incentives)) : ?>
                <div class="hero__incentives hidden-lg">
                    <div class="incentives">
                <?php foreach ($incentives as $key=>$item):?>
                         <div class="incentives__item panel">
                        <div class="icon">
                            <svg width="24" height="24">
                                <use href="<?=get_template_directory_uri()?>/assets/dist/icons/icons.svg#<?=$item['icon']?>"></use>
                            </svg>
                        </div>
                        <h3><?=$item['title']?></h3>
                    </div>
                <?php endforeach; ?>
                    </div>
                </div>
             <?php endif; ?>

            <?php if(!empty($link)) : ?>
                <div class="hero__link hidden-lg">
                    <a href="<?=$link['url']?>" class="btn btn-primary"><?=$link['title']?></a>
                </div>
            <?php endif; ?>
        </div>
    </div>
    <div class="hero__container --mobile">
        <?php if(!empty($incentives)) : ?>
            <div class="hero__incentives">
                <div class="incentives">
                    <?php foreach ($incentives as $key=>$item):?>
                        <div class="incentives__item panel">
                            <div class="icon">
                                <svg width="24" height="24">
                                    <use href="<?=get_template_directory_uri()?>/assets/dist/icons/icons.svg#<?=$item['icon']?>"></use>
                                </svg>
                            </div>
                            <h3><?=$item['title']?></h3>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        <?php endif; ?>

        <?php if(!empty($link)) : ?>
            <div class="hero__link hidden-lg">
                <a href="<?=$link['url']?>" class="btn btn-primary"><?=$link['title']?></a>
            </div>
        <?php endif; ?>
    </div>
    <div class="blur"></div>
</section>

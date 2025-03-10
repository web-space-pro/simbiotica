<?php
if ( function_exists('get_field') ) {
    $production  = get_sub_field('production');
    $p_title = $production['title'];
    $p_content = $production['dannye'];

    $office  = get_sub_field('office');
    $o_title = $office['title'];
    $o_content = $office['dannye'];

}
?>

<section>
    <div class="grid gap-4 grid-cols-1 xs:grid-cols-2">
        <div class="mb-6">
            <div class="map h-60 md:h-80 grayscale-[70%] bg-white-20 border border-black mb-6" id="map-production"></div>
            <div class="sm:w-4/5">
                <?php if(!empty($p_title)) : ?>
                    <h2 class="text-2xl font-medium mb-4"><?=$p_title?></h2>
                <?php endif; ?>

                <?php if(!empty($p_content)) : ?>
                    <?php foreach($p_content as $value) : ?>
                        <div class="font-sans mb-2">
                            <h3 class="text-base font-reg text-gray-20 lowercase mb-1"><?=$value['label']?></h3>
                            <?=$value['text']?>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </div>
        <div class="mb-6">
            <div class="map h-60 md:h-80 grayscale-[70%] bg-white-20 border border-black mb-6" id="map-office"></div>
            <div class="sm:w-4/5">
                <?php if(!empty($o_title)) : ?>
                    <h2 class="text-2xl font-medium mb-4"><?=$o_title?></h2>
                <?php endif; ?>

                <?php if(!empty($o_content)) : ?>
                    <?php foreach($o_content as $value) : ?>
                        <div class="font-sans mb-2">
                            <h3 class="text-base font-reg text-gray-20 lowercase mb-1"><?=$value['label']?></h3>
                            <?=$value['text']?>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>

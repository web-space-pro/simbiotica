<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package simbiotica
 */
if (!is_cart() && !is_checkout() && !is_wc_endpoint_url('order-received') && !is_account_page()) {
    $postID = get_the_ID();
    $year_create = get_field('project_yers', $postID);
    $gallery = get_field('project_gallery', $postID);
}
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <div class="flex flex-col md:flex-row gap-4 md:gap-20">
        <div class="hidden md:block md:w-6/12">
            <div class="sticky top-20">
                <?php if (!empty($gallery)): ?>
                    <div class="slider relative xs:h-[min(73vw,73vh)] aspect-square" id="slider-product">
                        <?php foreach ($gallery as $image_id):
                            $image = wp_get_attachment_image($image_id, 'full', false, ['class' => 'w-full h-full object-cover']);
                            $attachment = get_post($image_id);
                            $description = $attachment->post_content;
                            ?>
                            <div class="relative w-full h-full">
                                <?= $image ?>
                                <?php if (!empty($description)): ?>
                                    <div class="img_desc hidden absolute bottom-0 right-0 p-2 sm:p-5 bg-white-10 border border-b-0 border-r-0 border-black text-xs w-auto h-auto bg-red-700">
                                        <?= wpautop($description) ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php else: ?>
                    <div class="post-thumbnail w-full xs:h-[min(73vw,73vh)] aspect-square sticky top-4">
                        <?php the_post_thumbnail('post', ['class' => 'w-full h-full object-cover']); ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>

        <div class="md:w-6/12">
            <h1 class="text-2xl md:text-[1.75rem] leading-tight font-medium text-black"><?php the_title(); ?></h1>
            <?php if (!empty($year_create)): ?>
                <div class="font-sans text-xl md:text-2xl text-black mb-5 mt-5">
                    <span><?= $year_create ?></span>
                </div>
            <?php endif; ?>

            <div class="block md:hidden w-full sm:w-1/2 md:w-full m-auto mt-6 mb-6">
                <?php if (!empty($gallery)): ?>
                    <div class="slider relative xs:h-[min(73vw,73vh)] aspect-square" id="slider-mobile">
                        <?php foreach ($gallery as $image_id):
                            $image = wp_get_attachment_image($image_id, 'full', false, ['class' => 'w-full h-full object-cover']);
                            $attachment = get_post($image_id);
                            $description = $attachment->post_content;
                            ?>
                            <div class="relative w-full h-full">
                                <?= $image ?>
                                <?php if (!empty($description)): ?>
                                    <div class="img_desc hidden absolute bottom-0 right-0 p-2 sm:p-5 bg-white-10 border border-b-0 border-r-0 border-black text-xs w-auto h-auto bg-red-700">
                                        <?= wpautop($description) ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php else: ?>
                    <div class="post-thumbnail w-full xs:h-[min(73vw,73vh)] aspect-square sticky top-4">
                        <?php the_post_thumbnail('post', ['class' => 'w-full h-full object-cover']); ?>
                    </div>
                <?php endif; ?>
            </div>

            <div class="max-w-full mt-4 pt-5 border-t border-gray-10 font-sans *:mb-4">
                <?php the_content(); ?>
            </div>

            <div class="hidden md:block sticky bottom-16 h-[3.438rem] text-mask"></div>
        </div>
    </div>
</article>




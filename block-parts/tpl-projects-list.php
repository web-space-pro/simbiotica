<?php
if (function_exists('get_field')) {
    $show_category = get_sub_field('show-category');
    $show_project = get_sub_field('show-project');

    $acf_category = get_sub_field('category');
    $acf_projects = get_sub_field('projects');
}


// Если $show_project == true, получаем проекты из WP
if ($show_project) {
    $projects_query = new WP_Query([
        'post_type'      => 'projects',
        'posts_per_page' => -1,
        'orderby'        => 'date',
        'order'          => 'DESC',
    ]);
    $projects = $projects_query->posts;
} else {
    $projects = $acf_projects;
}

// Флаг, есть ли проекты
$has_projects = false;
?>

<section class="mt-2 xl:mt-1 mb-7 sm:mb-10">

    <div class="grid gap-y-4 gap-x-[1.2vmax] sm:gap-y-[1.2vmax] grid-cols-2 lg:grid-cols-3">

        <?php if (!empty($projects)) : ?>
            <?php foreach ($projects as $project) : ?>
                <?php
                $post_id = $project->ID;
                $post_link = get_permalink($post_id);
                $post_title = $project->post_title;
                $post_image = get_the_post_thumbnail_url($post_id);
                $year_create = get_field('project_yers', $post_id);
                ?>
                <div class="leading-4 flex flex-col items-stretch">
                        <a href="<?= $post_link ?>" target="_self" class="group">
                            <div class="relative aspect-square w-full overflow-hidden mb-3 bg-white-20 border border-gray-10">
                                <?php if (!empty($post_image)) : ?>
                                    <img alt="<?= $post_title ?>"
                                         class="object-cover object-center transition-all bg-[#F6F6F6] group-hover:scale-110"
                                         src="<?= $post_image ?>"
                                         style="position: absolute; height: 100%; width: 100%; inset: 0px; color: transparent;">
                                <?php endif; ?>
                            </div>
                        </a>
                        <div class="flex flex-col grow md:flex-row gap-x-2 sm:gap-x-4 gap-y-1 sm:gap-y-2 items-stretch justify-between pr-2">
                            <a class="block" href="<?= $post_link ?>">
                                <h3 class="font-medium text-xs sm:text-base text-black lowercase"><?= $post_title ?></h3>
                            </a>
                            <?php if (!empty($year_create)) : ?>
                                <div class="font-sans">
                                    <p class="text-nowrap text-xs sm:text-base whitespace-nowrap"><?= $year_create ?></p>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
        <?php endforeach; else: ?>
            <p class="text-center text-gray-500 col-span-2 lg:col-span-3">Проекты не найдены</p>
        <?php endif; ?>
    </div>
</section>

<?php
// Очистка WP_Query
if ($show_project) {
    wp_reset_postdata();
}
?>

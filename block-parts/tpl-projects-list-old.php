<?php
if (function_exists('get_field')) {
    $show_category = get_sub_field('show-category');
    $show_project = get_sub_field('show-project');

    $acf_category = get_sub_field('category');
    $acf_projects = get_sub_field('projects');
}

// Если $show_category == true, получаем категории из WP
if ($show_category) {
    var_dump('wp');
    $categories = get_terms([
        'taxonomy'   => 'project_cat',
        'hide_empty' => false,
        'orderby'    => 'name',
        'order'      => 'ASC',
    ]);
} else {
    var_dump('acf');
    $categories = $acf_category;
}

// Получаем первый ID категории
$first_categoryID = !empty($categories) && is_array($categories) ? $categories[0]->term_id : '';

// Если $show_project == true, получаем проекты из WP
if ($show_project) {
    var_dump('wp');
    $projects_query = new WP_Query([
        'post_type'      => 'projects',
        'posts_per_page' => 9,
        'orderby'        => 'date',
        'order'          => 'DESC',
        'tax_query'      => [
            [
                'taxonomy' => 'project_cat',
                'field'    => 'term_id',
                'terms'    => $first_categoryID,
            ],
        ],
    ]);
    $projects = $projects_query->posts;
} else {
    var_dump('acf');
    $projects = $acf_projects;
}

// Флаг, есть ли проекты
$has_projects = false;
?>

<section class="mt-2 xl:mt-1 mb-7 sm:mb-10">
    <?php if (!empty($categories)) : ?>
        <div class="pb-6 sm:pb-8 flex gap-2 sm:gap-4 lowercase items-center overflow-x-auto scrollbar-none">
            <?php foreach ($categories as $key => $item) : ?>
                <button type="button" data-id="<?= $item->term_id ?>" data-name="<?= $item->slug ?>"
                        class="<?= ($key == 0) ? 'active' : '' ?> w-fit lowercase outline-none hover:border-gray-10 border-gray-10/0 border px-2 py-1 shrink-0 border-black">
                    <?= $item->name ?>
                </button>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>

    <div id="projects-container" class="grid gap-y-4 gap-x-[1.2vmax] sm:gap-y-[1.2vmax] grid-cols-2 lg:grid-cols-3">
        <?php if (!empty($projects)) : ?>
            <?php foreach ($projects as $project) : ?>
                <?php
                $post_id = $project->ID;
                $post_link = get_permalink($post_id);
                $post_title = $project->post_title;
                $post_image = get_the_post_thumbnail_url($post_id);
                $year_create = get_field('project_yers', $post_id);

                // Проверяем, есть ли у поста категория $first_categoryID
                $has_first_category = false;
                $categories = get_the_terms($post_id, 'project_cat');

                if (!empty($categories) && !is_wp_error($categories)) {
                    foreach ($categories as $category) {
                        if ($category->term_id == $first_categoryID) {
                            $has_first_category = true;
                            $has_projects = true;
                            break;
                        }
                    }
                }

                // Выводим проект, если он принадлежит нужной категории
                if ($has_first_category) :
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
                <?php endif; ?>
            <?php endforeach; ?>

            <?php if (!$has_projects) : ?>
                <p class="text-center text-gray-500 col-span-2 lg:col-span-3">Проекты не найдены</p>
            <?php endif; ?>
        <?php endif; ?>
    </div>
</section>

<?php
// Очистка WP_Query, если использовали
if ($show_project) {
    wp_reset_postdata();
}
?>


<section class="mt-7 sm:mt-10 mb-4">
    <?php
    $visited_categories = isset($_COOKIE['visited_project_cat']) ? json_decode(stripslashes($_COOKIE['visited_project_cat']), true) : [];

    // Базовые аргументы для WP_Query
    $args = [
        'post_type'      => 'projects',
        'posts_per_page' => 9,
        'orderby'        => 'rand',
    ];

    // Если есть посещенные категории — фильтруем по ним
    if (!empty($visited_categories)) {
        $args['tax_query'] = [
            [
                'taxonomy' => 'project_cat',
                'field'    => 'term_id',
                'terms'    => $visited_categories,
            ]
        ];
    }
    // Запрос постов
    $query = new WP_Query($args);
    if ($query->have_posts()) : ?>
        <section class="related-projects">
            <div class="text-2xl sm:text-[1.75rem] mb-5 sm:mb-10 font-medium leading-tight">
                <h2>Возможно вас может еще заинтересовать</h2>
            </div>
            <div class="grid gap-y-4 gap-x-[1.2vmax] sm:gap-y-[1.2vmax] grid-cols-2 lg:grid-cols-3">
                <?php while ($query->have_posts()) : $query->the_post(); ?>
                    <?php
                    $post_id = get_the_ID();
                    $post_image = get_the_post_thumbnail_url($post_id);
                    $year_create = get_field('project_yers', $post_id);
                    ?>
                    <article class="leading-4 flex flex-col items-stretch">
                        <a href="<?php the_permalink(); ?>" target="_self" class="group">
                            <div class="relative aspect-square w-full overflow-hidden mb-3 bg-white-20 border border-gray-10">
                                <?php if(!empty($post_image)): ?>
                                    <img
                                            alt="<?php the_title(); ?>"
                                            class="object-cover object-center transition-all bg-[#F6F6F6] group-hover:scale-110"
                                            src="<?=$post_image?>"
                                            style="position: absolute; height: 100%; width: 100%; inset: 0px; color: transparent;"
                                    />
                                <?php endif; ?>
                            </div>
                        </a>
                        <div class="flex flex-col grow md:flex-row gap-x-4 gap-y-2 items-stretch justify-between pr-2">
                            <a class="block" href="<?php the_permalink(); ?>">
                                <h3 class="font-medium text-xs sm:text-base text-black lowercase"><?php the_title(); ?></h3>
                            </a>
                            <?php if(!empty($year_create)): ?>
                                <div class="font-sans">
                                    <p class="text-nowrap text-xs sm:text-base whitespace-nowrap"><?=$year_create?></p>
                                </div>
                            <?php endif; ?>
                        </div>
                    </article>
                <?php endwhile; ?>
            </div>
        </section>
        <?php wp_reset_postdata();
    endif;
    ?>
</section>

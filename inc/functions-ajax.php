<?php
add_action('wp_head', 'simbiotica_ajax_script');
add_action('wp_ajax_simbiotica_filter_projects', 'simbiotica_filter_projects');
add_action('wp_ajax_nopriv_simbiotica_filter_projects', 'simbiotica_filter_projects');



function simbiotica_ajax_script() {
    echo '<script>var ajaxurl = "' . admin_url('admin-ajax.php') . '";</script>';
}

function simbiotica_filter_projects() {
    $category_id = isset($_POST['category_id']) ? (int) $_POST['category_id'] : 0;
    $page_id = isset($_POST['page_id']) ? (int) $_POST['page_id'] : 0;

    if (!$page_id) {
        echo '<p class="text-center text-gray-500 col-span-2 lg:col-span-3">Ошибка: не передан ID страницы</p>';
        wp_die();
    }

    // Получаем ACF-поле show-project
    $show_project = false;
    $components = get_field('components', $page_id);
    // Флаг, есть ли проекты
    $has_projects = false;
    if (!empty($components)) {
        foreach ($components as $component) {
            if ($component['acf_fc_layout'] === 'projects-list') {
                $show_project = $component['show-project'];
                $acf_projects = $component['projects'];
                break;
            }
        }
    }

    // Если проекты берутся из WP_Query
    if ($show_project) {
        $args = [
            'post_type'      => 'projects',
            'posts_per_page' => -1,
            'orderby'        => 'date',
            'order'          => 'DESC',
        ];

        if ($category_id) {
            $args['tax_query'] = [
                [
                    'taxonomy' => 'project_cat',
                    'field'    => 'id',
                    'terms'    => $category_id,
                ]
            ];
        }

        $query = new WP_Query($args);

        if ($query->have_posts()) :
            while ($query->have_posts()) : $query->the_post();
                render_project_card(get_the_ID());
            endwhile;
            wp_reset_postdata();
        else :
            echo '<p class="text-center text-gray-500 col-span-2 lg:col-span-3">Проекты не найдены</p>';
        endif;
    }
    // Если проекты берутся из ACF
    else {
        if (!empty($acf_projects)) {
            foreach ($acf_projects as $project) {
                $categories = get_the_terms($project->ID, 'project_cat');
                $has_category = false;

                if (!empty($categories) && !is_wp_error($categories)) {
                    foreach ($categories as $category) {
                        if ($category->term_id == $category_id) {
                            $has_category = true;
                            $has_projects = true;
                            break;
                        }
                    }
                }

                if ($has_category) {
                    render_project_card($project->ID);
                }
            }
            if (!$has_projects) :
                echo '<p class="text-center text-gray-500 col-span-2 lg:col-span-3">Проекты не найдены</p>';
            endif;
        } else {
            echo '<p class="text-center text-gray-500 col-span-2 lg:col-span-3">Проекты не найдены</p>';
        }
    }
    wp_die();
}

// Вспомогательная функция для вывода карточки проекта
function render_project_card($post_id) {
    $post_link = get_permalink($post_id);
    $post_title = get_the_title($post_id);
    $post_image = get_the_post_thumbnail_url($post_id);
    $year_create = get_field('project_yers', $post_id);

    ?>
    <article class="leading-4 flex flex-col items-stretch">
        <a href="<?=$post_link?>" target="_self" class="group">
            <div class="relative aspect-square w-full overflow-hidden mb-3 bg-white-20 border border-gray-10">
                <?php if (!empty($post_image)): ?>
                    <img
                            alt="<?=$post_title?>"
                            class="object-cover object-center transition-all bg-[#F6F6F6] group-hover:scale-110"
                            src="<?=$post_image?>"
                            style="position: absolute; height: 100%; width: 100%; inset: 0px; color: transparent;"
                    />
                <?php endif; ?>
            </div>
        </a>
        <div class="flex flex-col grow md:flex-row gap-x-4 gap-y-2 items-stretch justify-between pr-2">
            <a class="block" href="<?=$post_link?>">
                <h3 class="font-medium text-xs sm:text-base text-black lowercase"><?=$post_title?></h3>
            </a>
            <?php if (!empty($year_create)): ?>
                <div class="font-sans">
                    <p class="text-nowrap text-xs sm:text-base whitespace-nowrap"><?=$year_create?></p>
                </div>
            <?php endif; ?>
        </div>
    </article>
    <?php
}



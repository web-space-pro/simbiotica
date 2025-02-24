<?php

function simbiotica_track_user_project_categories() {
    if (!is_singular('projects')) {
        return;
    }

    $post_id = get_the_ID();
    $terms = wp_get_post_terms($post_id, 'project_cat', ['fields' => 'ids']);

    if (!empty($terms)) {
        $visited_categories = isset($_COOKIE['visited_project_cat']) ? json_decode(stripslashes($_COOKIE['visited_project_cat']), true) : [];

        // Добавляем новые категории
        $visited_categories = array_unique(array_merge($visited_categories, $terms));

        // Оставляем только 7 последних
        $visited_categories = array_slice($visited_categories, -7);

        // Сохраняем в cookie (на 30 дней)
        setcookie('visited_project_cat', json_encode($visited_categories), time() + 30 * DAY_IN_SECONDS, COOKIEPATH, COOKIE_DOMAIN);
    }
}
add_action('wp', 'simbiotica_track_user_project_categories');

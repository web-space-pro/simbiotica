<?php

//динамическое обновление количество товаров в корзине
add_action('wp_ajax_simbiotica_get_cart_count', 'simbiotica_get_cart_count');
add_action('wp_ajax_nopriv_simbiotica_get_cart_count', 'simbiotica_get_cart_count');

function simbiotica_get_cart_count() {
    if (WC()->cart) {
        echo WC()->cart->get_cart_contents_count();
    } else {
        echo 0;
    }
    wp_die();
}

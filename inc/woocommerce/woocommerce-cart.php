<?php

//динамическое обновление количество товаров в корзине
add_action('wp_ajax_simbiotica_get_cart_count', 'simbiotica_get_cart_count');
add_action('wp_ajax_nopriv_simbiotica_get_cart_count', 'simbiotica_get_cart_count');

add_action('before_woocommerce_init', function () {
    if (class_exists('\Automattic\WooCommerce\Utilities\FeaturesUtil')) {
        \Automattic\WooCommerce\Utilities\FeaturesUtil::declare_compatibility('custom_cart_checkout_blocks', 'your-theme-folder', false);
    }
});
add_filter('woocommerce_should_load_cart_checkout_blocks', '__return_false');

function simbiotica_get_cart_count() {
    if (WC()->cart) {
        echo WC()->cart->get_cart_contents_count();
    } else {
        echo 0;
    }
    wp_die();
}



add_filter('woocommerce_get_item_data', function ($item_data, $cart_item) {
    return []; // Полностью убираем метаданные
}, 10, 2);
function enable_cart_fragments() {
    if (is_cart()) {
        wp_enqueue_script('wc-cart-fragments');
    }
}
add_action('wp_enqueue_scripts', 'enable_cart_fragments');

add_action('wp_ajax_update_cart_ajax', 'update_cart_ajax');
add_action('wp_ajax_nopriv_update_cart_ajax', 'update_cart_ajax');

function update_cart_ajax() {
    if (!isset($_POST['cart_item_key']) || !isset($_POST['quantity'])) {
        wp_send_json_error(['message' => 'Отсутствуют данные']);
        return;
    }

    $cart_item_key = sanitize_text_field($_POST['cart_item_key']);
    $quantity = intval($_POST['quantity']);

    if ($cart_item_key && $quantity >= 0) {
        WC()->cart->set_quantity($cart_item_key, $quantity);
        WC()->cart->calculate_totals();
    }

    // Начинаем буферизацию
    ob_start();
    woocommerce_cart_totals();
    $cart_totals = ob_get_clean();

    ob_start();
    woocommerce_cart_contents();
    $cart_contents = ob_get_clean();

    if (!$cart_totals || !$cart_contents) {
        wp_send_json_error(['message' => 'Ошибка при генерации HTML корзины']);
        return;
    }

    // Отправляем обновленные фрагменты
    wp_send_json_success([
        'fragments' => apply_filters('woocommerce_add_to_cart_fragments', [
            '.woocommerce-cart-form' => $cart_contents,
            '.cart_totals' => $cart_totals,
        ]),
    ]);

    wp_die();
}

add_action('wp_ajax_update_cart_shop', 'update_cart_shop');
add_action('wp_ajax_nopriv_update_cart_shop', 'update_cart_shop');

function update_cart_shop() {
    error_log("Запрос AJAX получен.");

    if (empty($_POST['hash'])) {
        error_log("Ошибка: hash не передан.");
        wp_send_json_error(['message' => 'Отсутствует hash товара']);
        return;
    }

    $cart_item_key = sanitize_text_field($_POST['hash']);
    $quantity = intval($_POST['quantity']);

    error_log("Обновляем товар {$cart_item_key}, количество: {$quantity}");

    $cart_item = WC()->cart->get_cart_item($cart_item_key);
    if (!$cart_item) {
        error_log("Ошибка: товар не найден в корзине.");
        wp_send_json_error(['message' => 'Товар не найден в корзине']);
        return;
    }

    $passed_validation = apply_filters('woocommerce_update_cart_validation', true, $cart_item_key, $cart_item, $quantity);
    if ($passed_validation) {
        WC()->cart->set_quantity($cart_item_key, $quantity, true);
    } else {
        error_log("Ошибка валидации.");
        wp_send_json_error(['message' => 'Ошибка валидации']);
        return;
    }

    error_log("Товар обновлен, формируем ответ.");

    // Генерируем новые фрагменты корзины
    ob_start();
    woocommerce_cart_totals();
    $cart_totals = ob_get_clean();

    ob_start();
    woocommerce_cart_contents();
    $cart_contents = ob_get_clean();

    if (!$cart_totals || !$cart_contents) {
        error_log("Ошибка: корзина пустая.");
        wp_send_json_error(['message' => 'Ошибка при обновлении корзины']);
        return;
    }

    error_log("Ответ сформирован, отправляем.");

    wp_send_json_success([
        'fragments' => apply_filters('woocommerce_add_to_cart_fragments', [
            '.woocommerce-cart-form' => $cart_contents,
            '.cart_totals' => $cart_totals,
        ]),
    ]);

    wp_die();
}











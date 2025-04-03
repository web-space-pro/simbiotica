<?php


//Удаление всех стилей WooCommerce
add_action('wp_enqueue_scripts', 'simbiotica_dequeue_woocommerce_styles', 99);
function simbiotica_dequeue_woocommerce_styles() {
    wp_dequeue_style('woocommerce-general');  // Основные стили
    wp_dequeue_style('woocommerce-layout');   // Стили разметки
    wp_dequeue_style('woocommerce-smallscreen'); // Стили для мобильных устройств
    wp_dequeue_style('woocommerce-inline');   // Убираем стили уведомлений
}

require 'woocommerce-cart.php';
require 'woocommerce-archive.php';
require 'woocommerce-single-product.php';
require 'woocommerce-checkout.php';
require 'woocommerce-my-account.php';
?>
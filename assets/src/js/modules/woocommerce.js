function updateCartCount() {
    fetch('/wp-admin/admin-ajax.php?action=simbiotica_get_cart_count')
        .then(response => response.text())
        .then(count => {
            document.getElementById('cart-count').textContent = count;
        })
        .catch(error => console.error('Ошибка AJAX:', error));
}

// Обновляем количество при загрузке страницы
updateCartCount();

// Обновляем при добавлении товара в корзину
jQuery(document).on('added_to_cart', function() {
    updateCartCount();
});
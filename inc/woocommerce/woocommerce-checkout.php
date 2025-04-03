<?php

remove_action('woocommerce_checkout_order_review', 'woocommerce_order_review', 10);

//Удаление <label> в форме оформления заказа
add_filter('woocommerce_form_field', function($field, $key, $args) {
    if (isset($args['label'])) {
        $field = preg_replace('/<label.*?<\/label>/', '', $field);
    }
    return $field;
}, 10, 3);

add_filter('woocommerce_checkout_fields', 'simbiotica_checkout_fields');

function simbiotica_checkout_fields($fields) {
    unset($fields['billing']['billing_company']);
    unset($fields['billing']['billing_address_2']);
    unset($fields['billing']['billing_address_1']);
    unset($fields['billing']['billing_postcode']);
    unset($fields['billing']['billing_state']);
    unset($fields['billing']['billing_city']);
    unset($fields['billing']['billing_apartment']);
//    unset($fields['billing']['billing_country']);
    unset($fields['billing']['billing_last_name']);

    unset($fields['shipping']['shipping_company']);
    unset($fields['shipping']['shipping_address_2']);
    unset($fields['shipping']['shipping_address_1']);
    unset($fields['shipping']['shipping_postcode']);
    unset($fields['shipping']['shipping_state']);
    unset($fields['shipping']['shipping_city']);
//    unset($fields['shipping']['shipping_country']);
    unset($fields['shipping']['shipping_last_name']);

    // Настроим billing поля
    $fields['billing']['billing_first_name'] = array(
        'type'        => 'text',
        'label'       => __('ФИО', 'woocommerce'),
        'placeholder' => __('ФИО', 'woocommerce'),
        'required'    => true,
        'class'       => array('form-row-wide'),
        'priority'    => 10,
    );
    $fields['billing']['billing_phone'] = array(
        'type'        => 'tel',
        'label'       => __('Телефон', 'woocommerce'),
        'placeholder' => __('Телефон', 'woocommerce'),
        'required'    => true,
        'class'       => array('form-row-wide'),
        'priority'    => 20,
    );
    $fields['billing']['billing_email'] = array(
        'type'        => 'email',
        'label'       => __('Email', 'woocommerce'),
        'placeholder' => __('Email', 'woocommerce'),
        'required'    => true,
        'class'       => array('form-row-wide'),
        'priority'    => 30,
    );

    // Дублируем поля для Shipping (они будут скрыты, но данные сохранятся)
    $fields['shipping']['shipping_first_name'] = $fields['billing']['billing_first_name'];
    $fields['shipping']['shipping_phone'] = $fields['billing']['billing_phone'];
    $fields['shipping']['shipping_email'] = $fields['billing']['billing_email'];

    return $fields;
}

add_action('woocommerce_checkout_update_order_meta', 'simbiotica_billing_to_shipping');

function simbiotica_billing_to_shipping($order_id) {
    if (!empty($_POST['billing_first_name'])) {
        update_post_meta($order_id, '_billing_first_name', sanitize_text_field($_POST['billing_first_name']));
        update_post_meta($order_id, '_shipping_first_name', sanitize_text_field($_POST['billing_first_name']));
    }
    if (!empty($_POST['billing_phone'])) {
        update_post_meta($order_id, '_billing_phone', sanitize_text_field($_POST['billing_phone']));
        update_post_meta($order_id, '_shipping_phone', sanitize_text_field($_POST['billing_phone']));
    }
    if (!empty($_POST['billing_email'])) {
        update_post_meta($order_id, '_billing_email', sanitize_text_field($_POST['billing_email']));
        update_post_meta($order_id, '_shipping_email', sanitize_text_field($_POST['billing_email']));
    }
}

add_filter('woocommerce_default_address_fields', function ($fields) {
    $fields['address_1']['required'] = false;
    $fields['city']['required'] = false;
    $fields['state']['required'] = false;
    $fields['postcode']['required'] = false;
    $fields['country']['required'] = false;
    return $fields;
});

//Отображение сохранённых полей в админке заказа
add_action('woocommerce_admin_order_data_after_billing_address', 'display_custom_billing_fields', 10, 1);
function display_custom_billing_fields($order) {
    echo '<p><strong>' . __('ФИО:', 'woocommerce') . '</strong> ' . get_post_meta($order->get_id(), '_billing_first_name', true) . '</p>';
    echo '<p><strong>' . __('Телефон:', 'woocommerce') . '</strong> ' . get_post_meta($order->get_id(), '_billing_phone', true) . '</p>';
    echo '<p><strong>' . __('Email:', 'woocommerce') . '</strong> ' . get_post_meta($order->get_id(), '_billing_email', true) . '</p>';
}


add_filter('woocommerce_add_error', function ($error) {
    return str_replace('Платежи', 'Поле', $error);
});

add_filter('woocommerce_checkout_fields', function ($fields) {
    $fields['order']['order_comments']['placeholder'] = __('комментарий к заказу', 'woocommerce');
    return $fields;
});


add_action('wp_footer', 'force_checkout_create_account_js');
function force_checkout_create_account_js() {
    if (!is_user_logged_in() && is_checkout() && !is_wc_endpoint_url()) :
        ?>
        <script>
            (function($){
                $(document).ready(function(){
                    let $createAccount = $('input[name=createaccount]');
                    if ($createAccount.length) {
                        $createAccount.prop('checked', true).trigger('change');
                    }
                });
            })(jQuery);
        </script>
    <?php
    endif;
}

add_action( 'woocommerce_thankyou', 'show_password_email_message_for_new_users', 10, 1 );

function show_password_email_message_for_new_users( $order_id ) {
    if ( ! $order_id ) return;

    $order = wc_get_order( $order_id );
    $user_id = $order->get_user_id();

    // Проверяем, есть ли у пользователя другие заказы
    $has_previous_orders = wc_get_customer_order_count( $user_id ) > 1;

    if ( $user_id && ! $has_previous_orders ) {
        $user_email = $order->get_billing_email();
        echo '<p class="woocommerce-message text-center font-xl font-bold">Спасибо за заказ! Ваш пароль для входа в личный кабинет был выслан на указанный email: ' . esc_html( $user_email ) . '.</p>';
    }
}

// Добавляем сообщение в личный кабинет WooCommerce
add_action( 'woocommerce_account_dashboard', 'show_welcome_message_for_new_users' );

function show_welcome_message_for_new_users() {
    $user_id = get_current_user_id();

    if ( ! $user_id ) return; // Если не залогинен, выходим

    // Проверяем, есть ли у пользователя другие заказы
    $has_previous_orders = wc_get_customer_order_count( $user_id ) > 1;

    if ( ! $has_previous_orders ) {
        $user_email = wp_get_current_user()->user_email;
        echo '<p class="woocommerce-message text-center font-xl font-bold">Добро пожаловать! Ваш пароль для входа был выслан на email: ' . esc_html( $user_email ) . '.</p>';
    }
}






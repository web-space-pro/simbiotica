<?php
/**
 * Order Customer Details
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/order/order-details-customer.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 8.7.0
 */

defined( 'ABSPATH' ) || exit;

?>
<section class="woocommerce-customer-details border border-gray-10 shadow-sm rounded-lg p-4 md:p-6 space-y-3">
    <h2 class="woocommerce-column__title text-lg md:text-xl font-semibold mb-4">Данные доставки</h2>
    <div class="mt-3">
        <?php if ( $order->get_billing_first_name() ) : ?>
            <p><strong>ФИО:</strong> <?php echo esc_html( $order->get_billing_first_name() ); ?></p>
        <?php endif; ?>
        <?php if ($order->get_billing_phone()) : ?>
            <p class="woocommerce-customer-details--phone font-medium mt-2">
                <?php echo esc_html($order->get_billing_phone()); ?>
            </p>
        <?php endif; ?>

        <?php if ($order->get_billing_email()) : ?>
            <p class="woocommerce-customer-details--email font-medium mt-1">
                <?php echo esc_html($order->get_billing_email()); ?>
            </p>
        <?php endif; ?>
    </div>

    <?php
    do_action('woocommerce_order_details_after_customer_address', 'billing', $order);
    ?>
</section>

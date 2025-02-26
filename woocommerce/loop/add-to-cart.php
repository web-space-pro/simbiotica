<?php
/**
 * Loop Add to Cart
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/loop/add-to-cart.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see         https://woocommerce.com/document/template-structure/
 * @package     WooCommerce\Templates
 * @version     9.2.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

global $product;
$product_id = $product->get_id();

$aria_describedby = isset( $args['aria-describedby_text'] ) ? sprintf( 'aria-describedby="woocommerce_loop_add_to_cart_link_describedby_%s"', esc_attr( $product->get_id() ) ) : '';
?>

<div class="product-actions" data-product-id="<?php echo esc_attr($product_id); ?>">
    <?php
    echo apply_filters(
        'woocommerce_loop_add_to_cart_link',
        sprintf(
            '<a href="%s" %s data-quantity="%s" class="%s" %s>%s</a>',
            esc_url( $product->add_to_cart_url() ),
            $aria_describedby,
            esc_attr( isset( $args['quantity'] ) ? $args['quantity'] : 1 ),
            esc_attr( isset( $args['class'] ) ? $args['class'] : 'button' ),
            isset( $args['attributes'] ) ? wc_implode_html_attributes( $args['attributes'] ) : '',
            esc_html( $product->add_to_cart_text() )
        ),
        $product,
        $args
    );
    ?>
    <div class="quantity-wrapper flex hidden-quantity">
        <button type="button" class="qty-minus"><svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" clip-rule="evenodd" d="M2.6665 7.83337C2.6665 7.55723 2.89758 7.33337 3.18263 7.33337H12.817C13.1021 7.33337 13.3332 7.55723 13.3332 7.83337C13.3332 8.10952 13.1021 8.33337 12.817 8.33337H3.18263C2.89758 8.33337 2.6665 8.10952 2.6665 7.83337Z" fill="black" /></svg></button>
        <input type="number" class="input-text qty text" step="1" min="0" value="1" title="Qty" size="4" inputmode="numeric">
        <button type="button" class="qty-plus"><svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" clip-rule="evenodd" d="M7.99984 2.66663C8.26761 2.66663 8.48468 2.8837 8.48468 3.15147V7.51511H12.8483C13.1161 7.51511 13.3332 7.73218 13.3332 7.99996C13.3332 8.26773 13.1161 8.48481 12.8483 8.48481H8.48468V12.8484C8.48468 13.1162 8.26761 13.3333 7.99984 13.3333C7.73206 13.3333 7.51499 13.1162 7.51499 12.8484V8.48481H3.15135C2.88358 8.48481 2.6665 8.26773 2.6665 7.99996C2.6665 7.73218 2.88358 7.51511 3.15135 7.51511H7.51499V3.15147C7.51499 2.8837 7.73206 2.66663 7.99984 2.66663Z" fill="black" /></svg></button>
    </div>
</div>

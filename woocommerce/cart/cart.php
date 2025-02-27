<?php
/**
 * Cart Page
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/cart/cart.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 7.9.0
 */

defined( 'ABSPATH' ) || exit;

do_action( 'woocommerce_before_cart' ); ?>
<form class="woocommerce-cart-form" action="<?php echo esc_url( wc_get_cart_url() ); ?>" method="post">
	<?php do_action( 'woocommerce_before_cart_table' ); ?>

    <div class="shop_table shop_table_responsive cart woocommerce-cart-form__contents" cellspacing="0">
        <?php do_action( 'woocommerce_before_cart_contents' ); ?>

        <?php
        foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
            $_product   = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
            $product_id = apply_filters( 'woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key );
            /**
             * Filter the product name.
             *
             * @since 2.1.0
             * @param string $product_name Name of the product in the cart.
             * @param array $cart_item The product in the cart.
             * @param string $cart_item_key Key for the product in the cart.
             */
            $product_name = apply_filters( 'woocommerce_cart_item_name', $_product->get_name(), $cart_item, $cart_item_key );

            if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters( 'woocommerce_cart_item_visible', true, $cart_item, $cart_item_key ) ) {
                $product_permalink = apply_filters( 'woocommerce_cart_item_permalink', $_product->is_visible() ? $_product->get_permalink( $cart_item ) : '', $cart_item, $cart_item_key );
                ?>
                <div class="flex flex-row justify-between gap-4 woocommerce-cart-form__cart-item pb-5 pt-5 border-b border-black  <?php echo esc_attr( apply_filters( 'woocommerce_cart_item_class', 'cart_item', $cart_item, $cart_item_key ) ); ?>">

                    <div class="basis-6/12 sm:basis-2/12 product-thumbnail overflow-hidden bg-white-20 border border-gray-10">
                        <?php
                        $thumbnail = apply_filters( 'woocommerce_cart_item_thumbnail', $_product->get_image(), $cart_item, $cart_item_key );

                        if ( ! $product_permalink ) {
                            echo $thumbnail; // PHPCS: XSS ok.
                        } else {
                            printf( '<a href="%s">%s</a>', esc_url( $product_permalink ), $thumbnail ); // PHPCS: XSS ok.
                        }
                        ?>
                    </div>
                    <div class="basis-5/12 flex flex-col justify-between sm:hidden">
                        <div class="product-name text-xs md:text-base lg:text-xl xl:text-2xl sm:w-2/3 leading-tight font-reg font-medium text-black" data-title="<?php esc_attr_e( 'Product', 'woocommerce' ); ?>">
                            <?php
                            if ( ! $product_permalink ) {
                                echo wp_kses_post( $product_name . '&nbsp;' );
                            } else {
                                /**
                                 * This filter is documented above.
                                 *
                                 * @since 2.1.0
                                 */
                                echo wp_kses_post( apply_filters( 'woocommerce_cart_item_name', sprintf( '<a href="%s">%s</a>', esc_url( $product_permalink ), $_product->get_name() ), $cart_item, $cart_item_key ) );
                            }

                            do_action( 'woocommerce_after_cart_item_name', $cart_item, $cart_item_key );

                            // Meta data.
                            echo wc_get_formatted_cart_item_data( $cart_item ); // PHPCS: XSS ok.

                            // Backorder notification.
                            if ( $_product->backorders_require_notification() && $_product->is_on_backorder( $cart_item['quantity'] ) ) {
                                echo wp_kses_post( apply_filters( 'woocommerce_cart_item_backorder_notification', '<p class="backorder_notification">' . esc_html__( 'Available on backorder', 'woocommerce' ) . '</p>', $product_id ) );
                            }
                            ?>
                        </div>
                        <div class="product-price mt-2 text-xs md:text-base lg:text-xl xl:text-2xl font-sans leading-tight font-normal text-black" data-title="<?php esc_attr_e( 'Price', 'woocommerce' ); ?>">
                            <?php
                            echo apply_filters( 'woocommerce_cart_item_price', WC()->cart->get_product_price( $_product ), $cart_item, $cart_item_key ); // PHPCS: XSS ok.
                            ?>
                        </div>
                        <div class="product-subtotal mt-4" data-title="<?php esc_attr_e( 'Subtotal', 'woocommerce' ); ?>">
                            <div class="text-xs md:text-base lg:text-xl xl:text-2xl font-sans leading-tight font-normal text-gray-20">
                                <?php echo apply_filters( 'woocommerce_cart_item_subtotal', WC()->cart->get_product_subtotal( $_product, $cart_item['quantity'] ), $cart_item, $cart_item_key ); // PHPCS: XSS ok.?> / шт
                            </div>
                        </div>
                        <div class="product-quantity" data-title="<?php esc_attr_e( 'Quantity', 'woocommerce' ); ?>">
                            <div class="quantity-wrapper flex relative">
                                <span class="qty-minus cursor-pointer">
                                    <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M2.6665 7.83337C2.6665 7.55723 2.89758 7.33337 3.18263 7.33337H12.817C13.1021 7.33337 13.3332 7.55723 13.3332 7.83337C13.3332 8.10952 13.1021 8.33337 12.817 8.33337H3.18263C2.89758 8.33337 2.6665 8.10952 2.6665 7.83337Z" fill="black" />
                                    </svg>
                                </span>

                                <?php
                                if ( $_product->is_sold_individually() ) {
                                    $min_quantity = 1;
                                    $max_quantity = 1;
                                } else {
                                    $min_quantity = 0;
                                    $max_quantity = $_product->get_max_purchase_quantity();
                                }

                                $product_quantity = woocommerce_quantity_input(
                                    array(
                                        'input_name'   => "cart[{$cart_item_key}][qty]",
                                        'input_value'  => $cart_item['quantity'],
                                        'max_value'    => $max_quantity,
                                        'min_value'    => $min_quantity,
                                        'product_name' => $product_name,
                                        'classes'      => ['input-text', 'qty', 'text'],
                                    ),
                                    $_product,
                                    false
                                );

                                echo apply_filters( 'woocommerce_cart_item_quantity', $product_quantity, $cart_item_key, $cart_item );
                                ?>

                                <span type="button" class="qty-plus cursor-pointer">
                                    <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M7.99984 2.66663C8.26761 2.66663 8.48468 2.8837 8.48468 3.15147V7.51511H12.8483C13.1161 7.51511 13.3332 7.73218 13.3332 7.99996C13.3332 8.26773 13.1161 8.48481 12.8483 8.48481H8.48468V12.8484C8.48468 13.1162 8.26761 13.3333 7.99984 13.3333C7.73206 13.3333 7.51499 13.1162 7.51499 12.8484V8.48481H3.15135C2.88358 8.48481 2.6665 8.26773 2.6665 7.99996C2.6665 7.73218 2.88358 7.51511 3.15135 7.51511H7.51499V3.15147C7.51499 2.8837 7.73206 2.66663 7.99984 2.66663Z" fill="black" />
                                    </svg>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="hidden sm:block sm:basis-4/12">
                        <div class="flex flex-col h-full justify-between">
                            <div class="product-name text-xs md:text-base lg:text-xl xl:text-2xl sm:w-2/3 leading-tight font-reg font-medium text-black" data-title="<?php esc_attr_e( 'Product', 'woocommerce' ); ?>">
                                <?php
                                if ( ! $product_permalink ) {
                                    echo wp_kses_post( $product_name . '&nbsp;' );
                                } else {
                                    /**
                                     * This filter is documented above.
                                     *
                                     * @since 2.1.0
                                     */
                                    echo wp_kses_post( apply_filters( 'woocommerce_cart_item_name', sprintf( '<a href="%s">%s</a>', esc_url( $product_permalink ), $_product->get_name() ), $cart_item, $cart_item_key ) );
                                }

                                do_action( 'woocommerce_after_cart_item_name', $cart_item, $cart_item_key );

                                // Meta data.
                                echo wc_get_formatted_cart_item_data( $cart_item ); // PHPCS: XSS ok.

                                // Backorder notification.
                                if ( $_product->backorders_require_notification() && $_product->is_on_backorder( $cart_item['quantity'] ) ) {
                                    echo wp_kses_post( apply_filters( 'woocommerce_cart_item_backorder_notification', '<p class="backorder_notification">' . esc_html__( 'Available on backorder', 'woocommerce' ) . '</p>', $product_id ) );
                                }
                                ?>
                            </div>
                            <div class="product-price text-xs md:text-base lg:text-xl xl:text-2xl font-sans leading-tight font-normal text-black" data-title="<?php esc_attr_e( 'Price', 'woocommerce' ); ?>">
                                <?php
                                echo apply_filters( 'woocommerce_cart_item_price', WC()->cart->get_product_price( $_product ), $cart_item, $cart_item_key ); // PHPCS: XSS ok.
                                ?>
                            </div>
                        </div>
                    </div>
                    <div class="hidden sm:block sm:basis-2/12 product-quantity" data-title="<?php esc_attr_e( 'Quantity', 'woocommerce' ); ?>">
                        <div class="quantity-wrapper flex relative">
                                <span class="qty-minus cursor-pointer">
                                    <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M2.6665 7.83337C2.6665 7.55723 2.89758 7.33337 3.18263 7.33337H12.817C13.1021 7.33337 13.3332 7.55723 13.3332 7.83337C13.3332 8.10952 13.1021 8.33337 12.817 8.33337H3.18263C2.89758 8.33337 2.6665 8.10952 2.6665 7.83337Z" fill="black" />
                                    </svg>
                                </span>

                            <?php
                            if ( $_product->is_sold_individually() ) {
                                $min_quantity = 1;
                                $max_quantity = 1;
                            } else {
                                $min_quantity = 0;
                                $max_quantity = $_product->get_max_purchase_quantity();
                            }

                            $product_quantity = woocommerce_quantity_input(
                                array(
                                    'input_name'   => "cart[{$cart_item_key}][qty]",
                                    'input_value'  => $cart_item['quantity'],
                                    'max_value'    => $max_quantity,
                                    'min_value'    => $min_quantity,
                                    'product_name' => $product_name,
                                    'classes'      => ['input-text', 'qty', 'text'],
                                ),
                                $_product,
                                false
                            );

                            echo apply_filters( 'woocommerce_cart_item_quantity', $product_quantity, $cart_item_key, $cart_item );
                            ?>

                            <span type="button" class="qty-plus cursor-pointer">
                                    <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M7.99984 2.66663C8.26761 2.66663 8.48468 2.8837 8.48468 3.15147V7.51511H12.8483C13.1161 7.51511 13.3332 7.73218 13.3332 7.99996C13.3332 8.26773 13.1161 8.48481 12.8483 8.48481H8.48468V12.8484C8.48468 13.1162 8.26761 13.3333 7.99984 13.3333C7.73206 13.3333 7.51499 13.1162 7.51499 12.8484V8.48481H3.15135C2.88358 8.48481 2.6665 8.26773 2.6665 7.99996C2.6665 7.73218 2.88358 7.51511 3.15135 7.51511H7.51499V3.15147C7.51499 2.8837 7.73206 2.66663 7.99984 2.66663Z" fill="black" />
                                    </svg>
                                </span>
                        </div>
                    </div>
                    <div class="hidden sm:block sm:basis-3/12 product-subtotal" data-title="<?php esc_attr_e( 'Subtotal', 'woocommerce' ); ?>">
                        <div class="text-xs md:text-base lg:text-xl xl:text-2xl font-sans leading-tight font-normal text-black">
                            <?php echo apply_filters( 'woocommerce_cart_item_subtotal', WC()->cart->get_product_subtotal( $_product, $cart_item['quantity'] ), $cart_item, $cart_item_key ); // PHPCS: XSS ok.?>
                        </div>
                    </div>
                    <div class="basis-1/12 product-remove text-right">
                        <a href="<?php echo esc_url(wc_get_cart_remove_url($cart_item_key)); ?>" data-product_id="<?=$product_id?>" class="inline-block">
                            <svg class="hover:opacity-70" width="24" height="24" viewBox="0 0 24 24" fill="none"><path fill-rule="evenodd" clip-rule="evenodd" d="M6.19526 6.19526C6.45561 5.93491 6.87772 5.93491 7.13807 6.19526L12 11.0572L16.8619 6.19526C17.1223 5.93491 17.5444 5.93491 17.8047 6.19526C18.0651 6.45561 18.0651 6.87772 17.8047 7.13807L12.9428 12L17.8047 16.8619C18.0651 17.1223 18.0651 17.5444 17.8047 17.8047C17.5444 18.0651 17.1223 18.0651 16.8619 17.8047L12 12.9428L7.13807 17.8047C6.87772 18.0651 6.45561 18.0651 6.19526 17.8047C5.93491 17.5444 5.93491 17.1223 6.19526 16.8619L11.0572 12L6.19526 7.13807C5.93491 6.87772 5.93491 6.45561 6.19526 6.19526Z" fill="black" /></svg>
                        </a>
                    </div>
                </div>
                <?php
            }
        }
        ?>

        <?php do_action( 'woocommerce_cart_contents' ); ?>

        <div class="mt-10">
            <div class="actions hidden">
                <div class="flex">
                    <?php if ( wc_coupons_enabled() ) { ?>
                        <div class="coupon">
                            <label for="coupon_code" class="screen-reader-text"><?php esc_html_e( 'Coupon:', 'woocommerce' ); ?></label> <input type="text" name="coupon_code" class="input-text" id="coupon_code" value="" placeholder="<?php esc_attr_e( 'Coupon code', 'woocommerce' ); ?>" /> <button type="submit" class="button<?php echo esc_attr( wc_wp_theme_get_element_class_name( 'button' ) ? ' ' . wc_wp_theme_get_element_class_name( 'button' ) : '' ); ?>" name="apply_coupon" value="<?php esc_attr_e( 'Apply coupon', 'woocommerce' ); ?>"><?php esc_html_e( 'Apply coupon', 'woocommerce' ); ?></button>
                            <?php do_action( 'woocommerce_cart_coupon' ); ?>
                        </div>
                    <?php } ?>
                </div>

                <div class="hidden">
                    <button type="submit" class="button<?php echo esc_attr( wc_wp_theme_get_element_class_name( 'button' ) ? ' ' . wc_wp_theme_get_element_class_name( 'button' ) : '' ); ?>" name="update_cart" value="<?php esc_attr_e( 'Update cart', 'woocommerce' ); ?>"><?php esc_html_e( 'Update cart', 'woocommerce' ); ?></button>
                </div>
                <?php do_action( 'woocommerce_cart_actions' ); ?>

                <?php wp_nonce_field( 'woocommerce-cart', 'woocommerce-cart-nonce' ); ?>
            </div>
        </div>
        <?php do_action( 'woocommerce_after_cart_contents' ); ?>
	</div>
	<?php do_action( 'woocommerce_after_cart_table' ); ?>
</form>

<?php do_action( 'woocommerce_before_cart_collaterals' ); ?>

<div class="cart-collaterals">
	<?php
		/**
		 * Cart collaterals hook.
		 *
		 * @hooked woocommerce_cross_sell_display
		 * @hooked woocommerce_cart_totals - 10
		 */
		do_action( 'woocommerce_cart_collaterals' );
	?>
</div>

<?php do_action( 'woocommerce_after_cart' ); ?>

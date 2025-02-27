<?php
/**
 * Single Product Price
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/price.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $product;

?>
<div class="mt-5 md:mt-0 mb-4 md:mb-0 flex justify-between items-center">
    <p class="font-sans text-xl md:text-2xl text-black mb-5 mt-5"><?php echo $product->get_price_html(); ?></p>
    <div class="block md:hidden add_to_cart_mobile">
        <?php woocommerce_template_single_add_to_cart(); ?>
    </div>
</div>
<div class="block md:hidden">
    <div class="relative h-full">
        <div class="xs:w-1/2 m-auto relative md:w-full md:sticky md:top-20 2xl:top-16">
            <?php simbiotica_post_thumbnail(); ?>
            <div class="absolute z-10 top-0 right-0">
                <?php
                the_post_navigation(
                    array(
                        'prev_text' => '<svg width="24" height="24" viewBox="0 0 24 24" fill="none"><path fill-rule="evenodd" clip-rule="evenodd" d="M10.5552 4.21301C10.8406 4.49703 10.8406 4.95751 10.5552 5.24153L4.495 11.2727H20.2692C20.6728 11.2727 21 11.5983 21 12C21 12.4017 20.6728 12.7273 20.2692 12.7273H4.495L10.5552 18.7585C10.8406 19.0425 10.8406 19.503 10.5552 19.787C10.2698 20.071 9.80711 20.071 9.52173 19.787L2.21404 12.5143C1.92865 12.2302 1.92865 11.7698 2.21404 11.4857L9.52173 4.21301C9.80711 3.929 10.2698 3.929 10.5552 4.21301Z" fill="#3F4042" /></svg>',
                        'next_text' => '<svg width="24" height="24" viewBox="0 0 24 24" fill="none"><path fill-rule="evenodd" clip-rule="evenodd" d="M12.4448 4.21301C12.1594 4.49703 12.1594 4.95751 12.4448 5.24153L18.505 11.2727H2.73077C2.32718 11.2727 2 11.5983 2 12C2 12.4017 2.32718 12.7273 2.73077 12.7273H18.505L12.4448 18.7585C12.1594 19.0425 12.1594 19.503 12.4448 19.787C12.7302 20.071 13.1929 20.071 13.4783 19.787L20.786 12.5143C21.0713 12.2302 21.0713 11.7698 20.786 11.4857L13.4783 4.21301C13.1929 3.929 12.7302 3.929 12.4448 4.21301Z" fill="#3F4042" /></svg>',
                    )
                );
                ?>
            </div>
        </div>
    </div>
    <?php
    /**
     * Hook: woocommerce_before_single_product_summary.
     *
     * @hooked woocommerce_show_product_sale_flash - 10
     * @hooked woocommerce_show_product_images - 20
     */
    do_action( 'woocommerce_before_single_product_summary' );
    ?>
</div>

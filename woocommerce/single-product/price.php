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

$gallery_images = $product->get_gallery_image_ids();

$product_id = $product->get_id();
$meta_data = get_post_meta($product_id);
$custom_field_value = get_post_meta($product_id, '_wapf_fieldgroup', true);
?>
<div class="mb-5">
    <?php if (empty($custom_field_value)): ?>
        <p class="font-sans text-xl md:text-2xl text-black mb-5 mt-5"><?php echo $product->get_price_html(); ?></p>
    <?php endif; ?>
    <div class="block md:hidden add_to_cart_mobile">
        <?php woocommerce_template_single_add_to_cart(); ?>
    </div>
</div>
<div class="block md:hidden">
    <div class="relative h-full">
        <div class="w-full sm:w-1/2 md:w-full m-auto">
            <?php  if (!empty($gallery_images)): ?>
                <div class="slider relative sm:h-[min(73vw,73vh)] aspect-square" id="slider-mobile">
                    <?php
                    foreach ($gallery_images as $image_id) {
                        echo wp_get_attachment_image($image_id, 'post');
                    }

                    ?>
                </div>
            <?php else: ?>
                <div class="post-thumbnail">
                    <?php the_post_thumbnail('post'); ?>
                </div>
            <?php endif;?>
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

<?php
/**
 * The template for displaying product content in the single-product.php template
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-single-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.6.0
 */

defined( 'ABSPATH' ) || exit;

global $product;

/**
 * Hook: woocommerce_before_single_product.
 *
 * @hooked woocommerce_output_all_notices - 10
 */
do_action( 'woocommerce_before_single_product' );

if ( post_password_required() ) {
	echo get_the_password_form(); // WPCS: XSS ok.
	return;
}
$gallery_images = $product->get_gallery_image_ids();
?>
<div id="product-<?php the_ID(); ?>" <?php wc_product_class( 'h-full', $product ); ?>>
    <div class="flex flex-col md:flex-row gap-4 md:gap-16">
        <div class="hidden md:block md:w-6/12">
            <div class="relative h-full">
                <div class="xs:w-1/2 m-auto  md:w-full md:sticky md:top-20 2xl:top-16">
                    <?php  if (!empty($gallery_images)): ?>
                    <div class="slider relative xs:h-[min(73vw,73vh)] aspect-square" id="slider-product">
                         <?php foreach ($gallery_images as $image_id):
                            $image = wp_get_attachment_image($image_id, 'full', false, ['class' => 'w-full h-full object-cover']);
                            $attachment = get_post($image_id);
                            $description = $attachment->post_content;
                            ?>
                        <div class="relative w-full h-full">
                            <?= $image ?>
                            <?php if (!empty($description)): ?>
                                <div class="img_desc hidden absolute bottom-0 right-0 p-2 sm:p-5 bg-white-10 border border-b-0 border-r-0 border-black text-xs w-auto h-auto bg-red-700">
                                    <?= wpautop($description) ?>
                                </div>
                            <?php endif; ?>
                        </div>
                        <?php endforeach; ?>
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
        <div class="md:w-6/12">
            <?php
            /**
             * Hook: woocommerce_single_product_summary.
             *
             * @hooked woocommerce_template_single_title - 5
             * @hooked woocommerce_template_single_rating - 10
             * @hooked woocommerce_template_single_price - 10
             * @hooked woocommerce_template_single_excerpt - 20
             * @hooked woocommerce_template_single_add_to_cart - 30
             * @hooked woocommerce_template_single_meta - 40
             * @hooked woocommerce_template_single_sharing - 50
             * @hooked WC_Structured_Data::generate_product_data() - 60
             */
            do_action( 'woocommerce_single_product_summary' );
            ?>
        </div>
    </div>

	<div>
        <?php
        /**
         * Hook: woocommerce_after_single_product_summary.
         *
         * @hooked woocommerce_output_product_data_tabs - 10
         * @hooked woocommerce_upsell_display - 15
         * @hooked woocommerce_output_related_products - 20
         */
        do_action( 'woocommerce_after_single_product_summary' );
        ?>
    </div>
</div>

<?php do_action( 'woocommerce_after_single_product' ); ?>

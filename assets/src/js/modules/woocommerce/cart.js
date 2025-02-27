// jQuery(function ($) {
//     function updateCart($input) {
//         let newQty = parseInt($input.val()) || 0;
//         let cartKey = $input.attr("name").match(/\[(.*?)\]/)[1];
//
//         let data = {
//             action: "update_cart_ajax",
//             cart_item_key: cartKey,
//             quantity: newQty,
//         };
//
//         $.ajax({
//             type: "POST",
//             url: wc_cart_params.ajax_url,
//             data: data,
//             beforeSend: function () {
//                 $(".woocommerce-cart-form").addClass("loading");
//             },
//             success: function (response) {
//                 console.log("AJAX Response:", response); // Проверяем ответ
//
//                 if (response.fragments) {
//                     $.each(response.fragments, function (key, value) {
//                         $(key).replaceWith(value);
//                     });
//                     // console.log("Fragments:", response.fragments);
//                 } else {
//                     console.warn("Фрагменты корзины не обновились. Принудительное обновление.");
//                    // location.reload(); // Если фрагментов нет, перезагружаем страницу
//                 }
//             },
//             complete: function () {
//                 $(".woocommerce-cart-form").removeClass("loading");
//             },
//             error: function (xhr, status, error) {
//                 console.error("Ошибка AJAX:", error);
//             },
//         });
//     }
//
//     $(".woocommerce-cart-form").on("click", ".qty-plus", function () {
//         let $input = $(this).closest(".quantity-wrapper").find(".qty");
//         let currentVal = parseInt($input.val()) || 0;
//         let maxVal = parseInt($input.attr("max")) || 1000;
//
//         if (currentVal < maxVal) {
//             $input.val(currentVal + 1).trigger("change");
//         }
//     });
//
//     $(".woocommerce-cart-form").on("click", ".qty-minus", function () {
//         let $input = $(this).closest(".quantity-wrapper").find(".qty");
//         let currentVal = parseInt($input.val()) || 1;
//         let minVal = parseInt($input.attr("min")) || 1;
//
//         if (currentVal > minVal) {
//             $input.val(currentVal - 1).trigger("change");
//         }
//     });
//
//     $(".woocommerce-cart-form").on("change", ".qty", function () {
//         updateCart($(this));
//     });
// });

jQuery(document).ready(function ($) {
    $(".qty-plus, .qty-minus").on("click", function () {
        let $input = $(this).closest(".quantity-wrapper").find(".qty");
        let newVal = parseInt($input.val()) + ($(this).hasClass("qty-plus") ? 1 : -1);
        if (newVal < 1) newVal = 1; // Минимальное значение = 1

        $input.val(newVal);

        let cartItemKey = $input.attr("name").match(/\[([a-zA-Z0-9]+)\]\[qty\]/)[1];

        $.ajax({
            type: "POST",
            url: wc_cart_params.ajax_url,
            data: {
                action: "update_cart_shop",
                hash: cartItemKey,
                quantity: newVal,
            },
            success: function (response) {
                if (response.success && response.data.fragments) {
                    $.each(response.data.fragments, function (key, value) {
                        $(key).replaceWith(value);
                    });
                } else {
                    console.warn("Ошибка обновления корзины:", response.data.message);
                }
            },
            error: function (xhr) {
                console.error("Ошибка AJAX:", xhr.responseText);
            },
        });
    });
});

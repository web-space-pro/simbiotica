function ready() {

    ymaps.ready(init);

    function init() {


        const myMap = new ymaps.Map("map", {
                center: [45.015378, 39.064426],
                zoom: 16
            }, {
                searchControlProvider: 'yandex#search'
            }),
            myPlacemark = new ymaps.Placemark([45.015378, 39.064426], {
                    // Чтобы балун и хинт открывались на метке, необходимо задать ей определенные свойства.
                balloonContentHeader: "Наркологическая клиника в Краснодаре - Мед Плюс",
                hintContent: "Наркологическая клиника в Краснодаре - Мед Плюс",

                balloonContentBody: [
                    '<address>',
                    'Адрес:  Краснодар, улица Трамвайная, 15/1',
                    '</address>'
                    ].join('')
                }, {
                    // Опции
                    iconLayout: 'default#imageWithContent',
                    // Своё изображение иконки метки.
                    iconImageHref: '/wp-content/themes/med-plus/map/marker.png',
                    // Размеры метки.
                    iconImageSize: [72, 72],
                    // Смещение левого верхнего угла иконки относительно
                    // её "ножки" (точки привязки).
                    iconImageOffset: [-30, -80],
                    iconCaption: "Диаграмма"
                }
            );

        myMap.geoObjects.add(myPlacemark);

        if (jQuery(window).width() < 960) {
            myMap.behaviors.disable('drag');
        }
        else{
            myMap.behaviors.disable('scrollZoom');
        }


    }

}
document.addEventListener("DOMContentLoaded", ready);
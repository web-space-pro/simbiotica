function ready() {

    ymaps.ready(init);

    function init() {
        // Первая карта
        const mapOffice = new ymaps.Map("map-office", {
                center: [44.950457, 34.102069],
                zoom: 16
            }, {
                searchControlProvider: 'yandex#search'
            }),
            placemarkOffice = new ymaps.Placemark([44.950457, 34.102069], {
                balloonContentHeader: "Симбиотика - Офис",
                hintContent: "Симбиотика - Офис",
                balloonContentBody: '<address>Адрес: Крым, г.Симферополь, ул.Одесская 2/21, 2 этаж</address>'
            }, {
                iconLayout: 'default#imageWithContent',
                iconImageHref: '/wp-content/themes/simbiotica/map/marker.png',
                iconImageSize: [72, 72],
                iconImageOffset: [-30, -80]
            });

        mapOffice.geoObjects.add(placemarkOffice);

        // Вторая карта
        const mapProduction = new ymaps.Map("map-production", {
                center: [44.898572, 34.141793],
                zoom: 14
            }, {
                searchControlProvider: 'yandex#search'
            }),
            placemarkProduction = new ymaps.Placemark([44.898572, 34.141793], {
                balloonContentHeader: "Карьер Петропавловский, Симбиотика",
                hintContent: "Карьер Петропавловский, Симбиотика",
                balloonContentBody: '<address>Адрес: Крым, Симферопольский район, Карьер Петропавловский, Симбиотика</address>'
            }, {
                iconLayout: 'default#imageWithContent',
                iconImageHref: '/wp-content/themes/simbiotica/map/marker.png',
                iconImageSize: [72, 72],
                iconImageOffset: [-30, -80]
            });

        mapProduction.geoObjects.add(placemarkProduction);

        // Отключение поведения для мобильных устройств
        if (jQuery(window).width() < 960) {
            mapOffice.behaviors.disable('drag');
            mapProduction.behaviors.disable('drag');
        } else {
            mapOffice.behaviors.disable('scrollZoom');
            mapProduction.behaviors.disable('scrollZoom');
        }
    }

}
document.addEventListener("DOMContentLoaded", ready);
try {
    window.jQuery = window.$ = require('jquery');
    // require("./vendors");
    // require("./modules/input_mask");
    require("./modules/menu");
    // require("./modules/generall");
    require("./modules/woocommerce");
}
catch (e) {
    console.log('JS ERROR!!!', e);
}
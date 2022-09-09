var CATEGORY_CONFIG_SHOW = function () {

    var state;

    function load() {
        CONFIG.load();
        CATEGORY_CONFIG_FORM.load();
    }

    return {load};
};

window.onload = function () {
    CATEGORY_CONFIG_SHOW().load();
}
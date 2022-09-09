var CATEGORY_CONFIG_CREATE = function () {

    var state;

    function load() {
        CONFIG.load();
        CATEGORY_CONFIG_FORM.load();
    }

    return {load};
};

window.onload = function () {
    CATEGORY_CONFIG_CREATE().load();
}
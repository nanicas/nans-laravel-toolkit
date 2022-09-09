var CATEGORY_CONFIG = function () {

    var state;

    function load() {
        CONFIG.load();
    }

    return {load};
};

window.onload = function () {
    CATEGORY_CONFIG().load();
}

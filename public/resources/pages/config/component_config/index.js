var COMPONENT_CONFIG = function () {

    var state;

    function load() {
        CONFIG.load();
    }

    return {load};
};

window.onload = function () {
    COMPONENT_CONFIG().load();
}

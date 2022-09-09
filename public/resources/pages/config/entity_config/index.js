var ENTITY_CONFIG = function () {

    var state;

    function load() {
        CONFIG.load();
    }

    return {load};
};

window.onload = function () {
    ENTITY_CONFIG().load();
}

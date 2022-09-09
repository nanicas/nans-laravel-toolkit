var ENTITY_CONFIG_SHOW = function () {

    var state;

    function load() {
        CONFIG.load();
        ENTITY_CONFIG_FORM.load();
    }

    return {load};
};

window.onload = function () {
    ENTITY_CONFIG_SHOW().load();
}
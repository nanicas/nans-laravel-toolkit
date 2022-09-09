var COMPONENT_CONFIG_SHOW = function () {

    var state;

    function load() {
        CONFIG.load();
        COMPONENT_CONFIG_FORM.load();
    }

    return {load};
};

window.onload = function () {
    COMPONENT_CONFIG_SHOW().load();
}
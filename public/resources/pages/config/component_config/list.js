var COMPONENT_CONFIG_LIST = function () {

    var state = {};

    function load() {
        CONFIG.load();
        LIST_CRUD.load();
    }

    return {load};
};

window.onload = function () {
    COMPONENT_CONFIG_LIST().load();
}
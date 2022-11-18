var CATEGORY_CONFIG_LIST = function () {

    var state = {};

    function load() { }

    return {load};
};

window.onload = function () {
    LIST_CRUD.load();
    CATEGORY_CONFIG_LIST().load();
}
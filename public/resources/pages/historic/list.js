var HISTORIC_LIST = function () {

    var state = {};

    function load() { }

    return {load};
};

window.onload = function () {
    LIST_CRUD.load();
    HISTORIC_LIST().load();
}
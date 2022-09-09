var DATA_CONFIG_CREATE = function () {

    var state;

    function load() {
        CONFIG.load();
        DATA_CONFIG_FORM.load();
    }

    return {load};
};

window.onload = function () {
    DATA_CONFIG_CREATE().load();
}
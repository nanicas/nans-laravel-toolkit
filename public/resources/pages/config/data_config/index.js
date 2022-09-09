var DATA_CONFIG = function () {

    var state;

    function load() {
        CONFIG.load();
    }

    return {load};
};

window.onload = function () {
    DATA_CONFIG().load();
}

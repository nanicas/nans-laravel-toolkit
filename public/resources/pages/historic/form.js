var HISTORIC_FORM = (function () {

    var state;

    function load() {
        CRUD_FORM.load();

        state = {
            personalizeds_selects: $('select.personalized-select'),
        };

        state.personalizeds_selects.select2();
    }

    return {load};
})();

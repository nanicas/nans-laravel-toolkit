var HISTORIC_FORM = (function () {

    var state;

    function load() {
        FORM_CRUD.load();

        state = {
            personalizeds_selects: $('select.personalized-select'),
        };

        state.personalizeds_selects.select2();
    }

    return {load};
})();

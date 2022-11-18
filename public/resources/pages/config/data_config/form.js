var DATA_CONFIG_FORM = (function () {

    var state = {};

    function load() {
        CRUD_FORM.load();
        state.instanceCrudForm = CRUD_FORM;
    }

    return {load, state};
})();
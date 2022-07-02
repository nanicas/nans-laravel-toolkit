var USER_CONFIG_FORM = (function () {

    var state = {};

    function load() {
        FORM_CRUD.load();
        state.instanceFormCrud = FORM_CRUD;
    }

    return {load, state};
})();
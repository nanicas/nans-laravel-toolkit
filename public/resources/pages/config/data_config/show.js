var DATA_CONFIG_SHOW = function () {

    var state = {};

    function load() {

        CONFIG.load();
        DATA_CONFIG_FORM.load();

        state.crudForm = DATA_CONFIG_FORM.state.instanceCrudForm.state.crudForm;
        state.messageState = state.crudForm.siblings('.alert.alert-success.state');

        if (state.messageState.length > 0) {
            state.messageState.fadeOut(3000, function () {
                $(this).remove();
            })
        }
    }

    return {load};
};

window.onload = function () {
    DATA_CONFIG_SHOW().load();
}
var USER_CONFIG_SHOW = function () {

    var state = {};

    function load() {

        USER_CONFIG_FORM.load();

        state.crudForm = USER_CONFIG_FORM.state.instanceFormCrud.state.formCrud;
        state.messageState = state.crudForm.find('.alert.alert-success.state');

        if (state.messageState.length > 0) {
            state.messageState.fadeOut(3000, function () {
                $(this).remove();
            })
        }
    }

    return {load};
};

window.onload = function () {
    USER_CONFIG_SHOW().load();
}
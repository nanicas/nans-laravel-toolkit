var CRUD_FORM = (function () {

    var state = {};

    function behaviorOnSubmitFinish(data) {
        if (data.status == true) {
            return window.location.href = data.response.url_redir;
        }

        state.formResultBox.html(data.response.message);
    }

    function load() {

        DASHBOARD.load();

        state.crudForm = $('#crud-form');
        state.formResultBox = $('#form-result-box');
        state.id = $('input[type="hidden"][name="id"]');
        state.isUpdate = (state.id.length > 0);

        state.crudForm.submit(function (e) {
            HELPER.behaviorOnSubmit(e, $(this), function (data) {
                behaviorOnSubmitFinish(data);
            });
        });
    }

    return {load, state, behaviorOnSubmitFinish};
})();
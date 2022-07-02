var STUDENT = function () {

    var state;

    function load() {

        state = {
            modalitiesByPlanBox: $('#modalities-by-plan-box'),
            availablePlans: $('#plan')
        };

        state.availablePlans.change(function () {

            var contentElement = state.modalitiesByPlanBox.find('.card-body'),
                    button = $(this),
                    val = button.val();

            if (val == 0) {
                return contentElement.html('...');
            }

            contentElement.html('Buscando informações, aguarde ...')

            $.get(button.data('route') + '?id=' + button.val(), function (html) {
                contentElement.html(html);
            });
        });
    }

    return {load};
};

window.onload = function () {
    FORM_CRUD.load();
    STUDENT().load();
}
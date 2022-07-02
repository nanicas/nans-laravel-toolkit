var SCHEDULING = function () {

    var state;

    function load() {

        state = {
            filterLoad: $('#filter-loading'),
            applicationsBox: $('#applications-box'),
            filterForm: $('#filter-form'),
            schedulingListBox: $('#schedulings-list-box'),
            schedulingModal: $('#scheduling-modal')
        };

        $('.dates-box input[type=text]').datepicker({
            language: "pt-BR"
        });

        state.schedulingModal.on('click', '.turn-student', function (e) {
            e.stopPropagation();
            e.preventDefault();

            var button = $(this),
                    ladda = Ladda.create(button.get(0));

            ladda.start();

            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: button.data('route'),
                type: 'POST',
                dataType: 'JSON',
                complete: function () {
                    ladda.stop();
                },
                success: function (data) {
                    button.next('.response-box').html(data.response.message);

                    if (data.status == true) {
                        button.remove();
                    }
                }
            });
        });

        state.schedulingListBox.on('click', '.show-scheduling-details', function () {

            state.schedulingModal.modal('show');

            var contentElement = state.schedulingModal.find('.modal-body'),
                    button = $(this);

            contentElement.html('Buscando informações, aguarde ...')

            $.get(button.data('route'), function (html) {
                contentElement.html(html);
            });
        });

        state.filterForm.submit(function (e) {
            e.stopPropagation();
            e.preventDefault();

            var self = $(this);
            state.filterLoad.show();

            $.ajax({
                url: self.attr('action'),
                type: self.attr('method'),
                data: new FormData($(this)[0]),
                processData: false,
                contentType: false,
                dataType: 'HTML',
                complete: function () {
                    state.filterLoad.hide();
                },
                success: function (data) {
                    state.schedulingListBox.find('.card-body').html(data);
                    state.schedulingListBox.show();
                }
            });
        });
    }

    return {load};
};

window.onload = function () {
    DASHBOARD.load();
    SCHEDULING().load();
}
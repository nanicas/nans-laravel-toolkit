var FORM_CRUD = (function () {

    var state = {};

    function load() {

        DASHBOARD.load();

        state.formCrud = $('#crud-form');
        state.formResultBox = $('#form-result-box');

        state.formCrud.submit(function (e) {
            e.stopPropagation();
            e.preventDefault();

            var self = $(this),
                    button = self.find('button[type="submit"]'),
                    ladda = Ladda.create(button.get(0));

            ladda.start();

            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: self.attr('action'),
                type: self.attr('method'),
                data: new FormData(self[0]),
                processData: false,
                contentType: false,
                dataType: 'JSON',
                complete: function () {
                    ladda.stop();
                },
                success: function (data) {

                    if (data.status == true) {
                        return window.location.href = data.response.url_redir;
                    }

                    state.formResultBox.html(data.response.message);
                }
            });
        });
    }

    return {load, state};
})();
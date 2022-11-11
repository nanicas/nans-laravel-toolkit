var HELPER = (function () {

    function behaviorOnSubmit(e, form, callback) {

        if (e) {
            e.stopPropagation();
            e.preventDefault();
        }

        var self = form,
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
                if (typeof (callback) == 'function') {
                    return callback(data);
                }
            }
        });
    }

    return {behaviorOnSubmit};
})();
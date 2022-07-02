var HOME = function () {

    var state;

    function load() {

        state = {
            applicationLoad: $('#app-load-link'),
            applicationsBox: $('#applications-box')
        };

        $('.application').click(function (e) {
            e.stopPropagation();
            e.preventDefault();

            var self = $(this);
            state.applicationLoad.show();

            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: state.applicationsBox.data('route-temp-link'),
                type: 'POST',
                data: {app_id: self.data('app-id')},
                dataType: 'JSON',
                complete: function () {
                    state.applicationLoad.hide();
                },
                success: function (data) {

                    if (data.status == false) {
                        return APP.setTopMessage(data.response.message, false);
                    }

                    window.open(self.attr('href') + '?' + data.response.params);
                }
            })
        });
    }

    return {load};
};

window.onload = function () {
    DASHBOARD.load();
    HOME().load();
}
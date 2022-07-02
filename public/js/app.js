var APP = (function () {

    var state;

    function load() {
        state = {
            body: $('body'),
            topMessage: $('#top-message')
        }
    }

    function getBaseUrl() {
        return state.body.data('base-url');
    }

    function setTopMessage(message, type) {
        state.topMessage.removeClass('none');
        state.topMessage.html(message);

        if (type == true) {
            state.topMessage.addClass('alert-success');
        } else {
            state.topMessage.addClass('alert-danger');
        }
    }

    return {load, getBaseUrl, setTopMessage};
})();
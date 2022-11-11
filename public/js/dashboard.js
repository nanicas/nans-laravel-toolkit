var DASHBOARD = (function () {

    var state = {};

    function load() {
        
        APP.load();
        APP.replaceIcons();
        
        state.menu = $('#sidebarMenu');
        state.topMessageElement = $('#top-dashboard-message');
        state.bottomMessageElement = $('#bottom-dashboard-message');
    }
    
    function setTopMessage(message, type) {
        state.topMessageElement.removeClass('none');
        state.topMessageElement.html(message);
    }

    return { load, setTopMessage };
})();

//DASHBOARD = DASHBOARD();
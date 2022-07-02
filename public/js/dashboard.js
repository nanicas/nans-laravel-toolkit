var DASHBOARD = (function () {

    var state;

    function load() {
        
        APP.load();
        
        state = {
            menu: $('#sidebarMenu')
        }
    }

    return { load };
})();

//DASHBOARD = DASHBOARD();
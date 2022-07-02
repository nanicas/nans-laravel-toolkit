var MODALITY_FORM = (function () {

    var state;

    function load() {
        FORM_CRUD.load();
        
        $('#modalities').select2();
        
        
    }

    return {load};
})();
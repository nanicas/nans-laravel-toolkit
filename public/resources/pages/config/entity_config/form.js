var ENTITY_CONFIG_FORM = (function () {

    var state;

    function load() {
        
        state = {
            component: $('#component'),
            componentLoad : $('#component-load'),
            dynamicFormByComponent : $('#dynamic-form-by-component'),
            id: $('input[name="id"]')
        }
        
        FORM_CRUD.load();
        
        state.component.change(function (e) {

            var self = $(this);
                state.componentLoad.show();

            $.ajax({
                url: self.data('action'),
                type: self.data('method'),
                data: {component_id: self.val(), id: state.id.val()},
                dataType: 'HTML',
                error: function() {
                    state.dynamicFormByComponent.html('');
                },
                complete: function () {
                    state.componentLoad.hide();
                },
                success: function (data) {
                    state.dynamicFormByComponent.html(data);
                }
            });
        });
        
        state.component.trigger('change');
    }

    return {load};
})();
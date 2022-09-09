var CONFIG = (function () {

    var state;

    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('.avatar').attr('src', e.target.result);
            }

            reader.readAsDataURL(input.files[0]);
        }
    }

    function load() {

        DASHBOARD.load();

        state = {
            contextBox: $('#config-box')
        };

        $(".file-upload").on('change', function () {
            readURL(this);
        });
        
        state.contextBox.on('click', '.nav-link', function(){
            window.location.href = $(this).attr('href');
        });
    }

    return {load};
})();
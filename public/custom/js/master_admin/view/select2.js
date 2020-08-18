var KTSelect2 = function() {
    var demos = function() {
        $('#location').select2({
            placeholder: "Select a state"
        });
    }
    return {
        init: function() {
           demos();
        }
    };
}();

jQuery(document).ready(function() {
    KTSelect2.init();
});


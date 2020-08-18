$(document).ready(function () {

    function convertToSlug(Text)
    {
        return Text.toString().toLowerCase()
        .replace(/\s+/g, '-')           // Replace spaces with -
        .replace(/[^\w\-]+/g, '')       // Remove all non-word chars
        .replace(/\-\-+/g, '-')         // Replace multiple - with single -
        .replace(/^-+/, '')             // Trim - from start of text
        .replace(/-+$/, '');            // Trim - from end of text
    }

    $("#btn_generate_url").click(function (e) {
        e.preventDefault();
        $("#input_url").val(convertToSlug($("#input_title").val()));
    });
});
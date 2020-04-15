// wait untill the page is loaded completely
$(document).ready(function () {
    // include the validation for the form function comes with this plugin
    $('#add-resources').validate({
        // set validation rules for input fields
        rules: {
            title: {
                required: true,
            },
            type: {
                required: true,
            },
            url: {
                required: true,
                url: true
            }
        }
    });
});
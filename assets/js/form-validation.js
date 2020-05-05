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
            },
            image: {
                required: function (ele) {
                    const file = $('#hidden_file');
                    return !(file.attr('value') > 0 && file.attr('data-file-type') == 'image');
                },
                extension: 'png|jpg'
            }
        }
    });

    $('#add-document').validate({
        // set validation rules for input fields
        rules: {
            title: {
                required: true,
            },
            type: {
                required: true,
            },
            content_type: {
                required: true,
            },
            icon: {
                required: function (ele) {
                    const file = $('#icon_id');
                    return !(file.attr('value') > 0);
                },
                extension: 'png|jpg|jpeg'
            }
        }
    });
});
import 'bootstrap';
import $ from 'jquery';
import Echo from 'laravel-echo';
import Pusher from 'pusher-js';

window.Pusher = Pusher;

window.Echo = new Echo({
    broadcaster: 'pusher',
    key: 'eec6aa224a3deb8ed84b',
    cluster: 'eu',
    forceTLS: true
});

$(document).ready(function () {
    $('#upload-form').on('submit', function (e) {
        e.preventDefault();

        let formData = new FormData(this);
        $('#file-error').text('');

        $.ajax({
            url: "/upload",
            method: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            success: function (response) {
                $('#notification').text(response.success).show();
            },
            error: function (xhr) {
                let errors = xhr.responseJSON.errors;
                if (errors && errors.file) {
                    $('#file-error').text(errors.file[0]).show();
                } else {
                    $('#file-error').text('Произошла ошибка при загрузке файла.').show();
                }
            }
        });
    });

    window.Echo.channel('uploads')
        .listen('.FileUploaded', (e) => {
            console.log(e);
            $('#notification').append('<div>websocket Echo -> ' + e.message + '</div>').show();
        });

    window.Echo.channel('rows')
        .listen('.RowsCreated', (e) => {
            console.log(e);
            $('#notification').append('<div>websocket Echo -> ' + e.message + '</div>').show();
        });

    window.Echo.channel('import')
        .listen('.ImportCompleted', (e) => {
            console.log(e);
            $('#notification').append('<div>websocket Echo -> ' + e.message + '</div>').show();
        });
});

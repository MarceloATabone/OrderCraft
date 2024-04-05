// main.js

function submitLoginForm() {
    var email = $('#email').val();
    var password = $('#password').val();

    var dataToSend = JSON.stringify({ email: email, password: password });

    $.ajax({
        url: 'api/signIn',
        method: 'POST',
        contentType: 'application/json',
        data: dataToSend,
        success: function (response, statusText, xhr) {
            if (xhr.status === 200) {
                window.location.href = 'dashboard';
            } else {
                console.log(response.error);
                alert(response.error);
            }
        },
        error: function (xhr, status, error) {
            console.error(error);
            alert(xhr.responseText);
        }
    });
}

$(document).ready(function () {
    $('#loginForm').submit(function (e) {
        e.preventDefault();
        submitLoginForm();
    });
});


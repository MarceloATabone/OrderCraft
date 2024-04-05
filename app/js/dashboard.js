// dashboard.js




$(document).ready(function () {
    $('#loginForm').submit(function (e) {
        e.preventDefault();
        submitLoginForm();
    });

    // Function to load the user list
    function loadUserList() {
        $.ajax({
            url: 'api/user',
            method: 'GET',
            success: function (response) {
                $('#userList').empty();

                response.forEach(function (user) {
                    var userButton = $('<button class="btn btn-primary btn-block mb-2">' + user.first_name + '</button>');
                    userButton.data('user', user);
                    $('#userList').append(userButton);
                });
            },
            error: function (xhr, status, error) {
                console.error(error);
                alert(xhr.responseText);
            }
        });
    }

    loadUserList();


    $('#userList').on('click', 'button', function () {
        var userDetails = $(this).data('user');
        $('#userDetails').html('<p>Name: ' + userDetails.first_name + '</p>' +
            '<p>Last Name: ' + userDetails.last_name + '</p>' +
            '<p>Email: ' + userDetails.email + '</p>' +
            '<p>Document: ' + userDetails.document + '</p>' +
            '<p>Phone Number: ' + userDetails.phone_number + '</p>' +
            '<p>Birth Date: ' + userDetails.birth_date + '</p>');
    });





    // Event listener for New User button click
    $('#newUserButton').click(function () {
        $('#newUserModal').modal('show');
    });

    // Event listener for New User form submission
    $('#newUserForm').submit(function (e) {
        e.preventDefault();
        var newUser = {
            first_name: $('#newFirstName').val(),
            last_name: $('#newLastName').val(),
            document: $('#newDocument').val(),
            email: $('#newEmail').val(),
            password: $('#newPassword').val(),
            passwordVerify: $('#newPassword').val(),
            phone_number: $('#newPhoneNumber').val(),
            birth_date: $('#newBirthDate').val()
        };

        $.ajax({
            url: 'api/user',
            method: 'POST',
            contentType: 'application/json',
            data: JSON.stringify(newUser),
            success: function (response) {
                $('#newUserModal').modal('hide');
                loadUserList();
            },
            error: function (xhr, status, error) {
                console.error(error);
                alert(xhr.responseText);
            }
        });
    });

});




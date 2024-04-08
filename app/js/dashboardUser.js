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
                if (Array.isArray(response)) {
                    response.forEach(function (user) {
                        response.forEach(function (user) {
                            var listItem = $('<li class="list-group-item d-flex justify-content-between align-items-center">' +
                                '<button class="btn btn-primary user-button">' + user.first_name + '</button>' +
                                '<button class="btn btn-warning edit-btn" data-user-id="' + user.id + '"><i class="fas fa-edit"></i></button>' +
                                '<button class="btn btn-danger delete-btn" data-user-id="' + user.id + '"><i class="fas fa-trash"></i></button>' +
                                '</li>');
                            listItem.data('user', user);
                            $('#userList').append(listItem);
                        });
                    });
                }

            },
            error: function (xhr, status, error) {
                console.error(error);
                alert(xhr.responseText);
            }
        });
    }

    loadUserList();

    $('#userList').on('click', '.user-button', function () {
        var userDetails = $(this).closest('li').data('user');
        if (userDetails) {
            $('#userDetails').html('<p>Name: ' + userDetails.first_name + '</p>' +
                '<p>Last Name: ' + userDetails.last_name + '</p>' +
                '<p>Email: ' + userDetails.email + '</p>' +
                '<p>Document: ' + userDetails.document + '</p>' +
                '<p>Phone Number: ' + userDetails.phone_number + '</p>' +
                '<p>Birth Date: ' + userDetails.birth_date + '</p>');
        } else {
            console.error('User details are undefined.');
        }
    });


    $('#userList').on('click', '.delete-btn', function () {
        var userId = $(this).data('user-id');
        if (confirm('Are you sure you want to delete this user?')) {
            $.ajax({
                url: 'api/user/' + userId,
                method: 'DELETE',
                success: function (response) {
                    loadUserList();
                },
                error: function (xhr, status, error) {
                    console.error(error);
                    alert(xhr.responseText);
                }
            });
        }
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
            password_verify: $('#newPassword').val(),
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


    function populateEditForm(user) {
        $('#editFirstName').val(user.first_name);
        $('#editLastName').val(user.last_name);
        $('#editDocument').val(user.document);
        $('#editPhoneNumber').val(user.phone_number);
        $('#editBirthDate').val(user.birth_date);
    }

    $('#userList').on('click', '.edit-btn', function () {
        var userId = $(this).data('user-id');
        var user = $(this).closest('li').data('user');
        populateEditForm(user);
        $('#editUserModal').data('user-id', userId).modal('show'); // Definir o ID do usuário no modal de edição
    });

    $('#editUserForm').submit(function (e) {
        e.preventDefault();
        var userId = $('#editUserModal').data('user-id'); // Obter o ID do usuário definido no modal
        var editedUser = {
            first_name: $('#editFirstName').val(),
            last_name: $('#editLastName').val(),
            document: $('#editDocument').val(),
            phone_number: $('#editPhoneNumber').val(),
            birth_date: $('#editBirthDate').val()
        };

        $.ajax({
            url: 'api/user/' + userId,
            method: 'PUT',
            contentType: 'application/json',
            data: JSON.stringify(editedUser),
            success: function (response) {
                $('#editUserModal').modal('hide');
                loadUserList();
            },
            error: function (xhr, status, error) {
                console.error(error);
                alert(xhr.responseText);
            }
        });
    });

});

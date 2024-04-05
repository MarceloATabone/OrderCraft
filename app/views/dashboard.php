<!-- dashboard.php -->

<?php



?>

<div class="bg-light dashboard-sidebar">
    <h2 class="text-center mt-3">Users</h2>
    <button id="newUserButton" class="btn btn-success btn-block mb-2">New User</button>
    <ul class="list-group" id="userList">
    </ul>
</div>
<div class="bg-light dashboard-content">
    <div class="container-fluid mt-3">
        <h2 class="text-center"> User Details</h2>
        <div class="card">
            <div class="card-body" id="userDetails">
                <p>Select a user on the left to see the details.</p>
            </div>
        </div>
    </div>
</div>

<!-- Modals -->
<div class="modal fade" id="newUserModal" tabindex="-1" role="dialog" aria-labelledby="newUserModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="newUserModalLabel">New User</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="newUserForm">
                    <div class="form-group">
                        <label for="newFirstName">First Name</label>
                        <input type="text" class="form-control" id="newFirstName">
                    </div>
                    <div class="form-group">
                        <label for="newLastName">Last Name</label>
                        <input type="text" class="form-control" id="newLastName">
                    </div>
                    <div class="form-group">
                        <label for="newDocument">Document</label>
                        <input type="text" class="form-control" id="newDocument">
                    </div>
                    <div class="form-group">
                        <label for="newEmail">Email</label>
                        <input type="email" class="form-control" id="newEmail">
                    </div>
                    <div class="form-group">
                        <label for="newPassword">Password</label>
                        <input type="password" class="form-control" id="newPassword" value="D3s9aNh@S3gur@!" readonly>
                    </div>
                    <div class="form-group">
                        <label for="newPhoneNumber">Phone Number</label>
                        <input type="text" class="form-control" id="newPhoneNumber">
                    </div>
                    <div class="form-group">
                        <label for="newBirthDate">Birth Date</label>
                        <input type="date" class="form-control" id="newBirthDate">
                    </div>
                    <button type="submit" class="btn btn-primary">Create</button>
                </form>
            </div>
        </div>
    </div>
</div>
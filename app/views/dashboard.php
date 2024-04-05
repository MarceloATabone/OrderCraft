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

<?php
// Include the new user modal
include 'modals/newUserModal.html';
// Include the edit user modal
include 'modals/editUserModal.html';
?>
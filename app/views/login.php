<!-- login.php -->
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    echo "Login form submitted";

    if (isset($_POST['loggedIn']) && $_POST['loggedIn'] === 'true') {
        $_SESSION['loggedIn'] = true;
        header("Location: index.php?page=dashboard");
        exit;
    }
}
?>

<div class="container">
    <div class="row justify-content-center mt-5">
        <div class="col-md-6">
            <h2 class="text-center mb-4">Login</h2>
            <form id="loginForm">
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" class="form-control" id="email" placeholder="Enter email" value="admin@admin.com">
                </div>
                <div class="form-group">
                    <label for="password">Password:</label>
                    <input type="password" class="form-control" id="password" placeholder="Enter password" value="password">
                </div>
                <button type="submit" class="btn btn-primary btn-block">Login</button>
            </form>
        </div>
    </div>
</div>
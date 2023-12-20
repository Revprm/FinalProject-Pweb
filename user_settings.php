<?php
include("auth_session.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Update Account</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/gs_color.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="assets/js/script.js"></script>
</head>

<body>
    <nav class="navbar navbar-expand-lg sticky-top navbar-gs bg-gs p-3 shadow-lg" id="home_navigation">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Articles Website</a>
            <div class="navbar-nav ms-auto">
                <a class="nav-link" href="index.php">Home</a>
                <a class="nav-link" href="dashboard.php">Dashboard</a>
                <a class="nav-link" href="user_logout.php">Logout</a>
            </div>
        </div>
    </nav>

    <div class="container mt-5">
        <div class="form rounded-4 shadow-lg">
            <h4 class="text-center mt-2 mb-3">Account Settings</h4>
            <form action="user_update.php" method="post">
                <div class="mb-3">
                    <label for="new-username" class="form-label">New Username</label>
                    <input type="text" class="form-control" name="new-username" id="new-username" placeholder="New Username" required>
                </div>
                <div class="mb-3">
                    <label for="new-password" class="form-label">New Password</label>
                    <input type="password" class="form-control" name="new-password" id="new-password" placeholder="New Password" required>
                </div>
                <div class="mb-3">
                    <input type="submit" value="Update" name="submit" class="btn container-fluid rounded-3" />
                </div>
            </form>
            <div class="col-12 mb-3">
                <a href="delete.php">
                    <button class="btn btn-primary rounded-2" style="width: 250px;">Delete</button>
                </a>
            </div>
        </div>
    </div>
</body>

</html>
<?php
include("auth_session.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Delete Account</title>
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
            <a class="navbar-brand" href="#">Masits</a>
            <div class="navbar-nav ms-auto">
                <a class="nav-link" href="index.php">Home</a>
                <a class="nav-link" href="dashboard.php">Dashboard</a>
                <a class="nav-link" href="user_logout.php">Logout</a>
            </div>
        </div>
    </nav>

    <div class="container mt-5">
        <div class="form">
            <h4 class="text-center mt-2 mb-3">Delete Account</h4>
            <p class="text-center">Are you sure you want to delete your account?</p>
            <form action="process_delete.php" method="post">
                <div class="mb-3">
                    <input type="submit" value="Yes" name="submit" class="btn container-fluid rounded-3" />
                </div>
            </form>
            <div class="mb-3">
                <a href="dashboard.php">
                    <button class="btn container-fluid rounded-3">No</button>
                </a>
            </div>
        </div>
    </div>
</body>

</html>
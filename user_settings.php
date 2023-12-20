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
    <nav class="navbar navbar-expand-lg sticky-top navbar-gs bg-gs" id="home_navigation">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Articles Website</a>
            <div class="navbar-nav ms-auto">
                <a class="nav-link" href="dashboard.php">Dashboard</a>
                <a class="nav-link" href="logout.php">Logout</a>
            </div>
        </div>
    </nav>

    <div class="container mt-5">
        <div class="form rounded-4">
            <h4 class="text-center mt-2 mb-3">Account Settings</h4>
            <form action="process_update.php" method="post">
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
            <form action="process_delete.php" method="post">
                <div class="mb-3">
                    <input type="submit" value="Delete" name="submit" class="btn container-fluid rounded-3" />
                </div>
            </form>
        </div>
    </div>
</body>

</html>
<!-- delete.php -->
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
    <div class="container mt-5">
        <div class="form rounded-3">
            <h5 class="text-center">Are you sure you want to logout from your account?</h5>
            <a href="index.php">
                <button class="btn shadow-lg mt-4 rounded-3" style="width: 250px;">No</button>
            </a>
            <a href="process_logout.php">
                <button class="btn shadow-lg mt-4 rounded-3" style="width: 250px;">Yes</button>
            </a>
            </form>
        </div>
    </div>
</body>

</html>
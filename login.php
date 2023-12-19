<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/gs_color.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="assets/js/script.js"></script>
</head>

<body>
    <?php
    require('sqlcon.php');
    $conn = dbconn();
    session_start();
    // When form submitted, check and create user session.
    if (isset($_POST['username'])) {
        $username = stripslashes($_REQUEST['username']);    // removes backslashes
        $username = mysqli_real_escape_string($conn, $username);
        $password = stripslashes($_REQUEST['password']);
        $password = mysqli_real_escape_string($conn, $password);
        // Check user is exist in the database
        $query    = "SELECT * FROM `users` WHERE username='$username'
                     AND password='" . md5($password) . "'";
        $result = mysqli_query($conn, $query);
        $rows = mysqli_num_rows($result);
        if ($rows == 1) {
            $_SESSION['username'] = $username;
            header("Location: dashboard.php");
        } else {
            echo "<form class='form rounded-4'>
                  <p class='text-center mt-2 mb-3'>Username/password is incorrect.</h4>
                  <br/>Click here to <a href='login.php'>Login</a></form>";
        }
    } else {
    ?>
        <form class="form rounded-4" method="post" name="login">
            <h4 class="text-center mt-2 mb-3">Login</h1>
                <div class="mb-3">
                    <label for="username-input" class="form-label">Username</label>
                    <input type="text" class="form-control" name="username" id="username-input" placeholder="Username">
                </div>
                <div class="mb-3">
                    <label for="inputpassword" class="form-label">Password</label>
                    <input type="password" class="form-control" name="password" id="inputpassword" placeholder="Password">
                </div>
                <div class="mb-3">
                    <input type="submit" value="Login" name="submit" class="btn container-fluid rounded-3" />
                    <p class="link mt-3"><a href="registration.php">Register</a></p>
                </div>
        </form>
    <?php
    }
    ?>
</body>

</html>
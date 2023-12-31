<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <title>Registration</title>
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
    if (isset($_REQUEST['username'])) {
        $username = stripslashes($_REQUEST['username']);
        $username = mysqli_real_escape_string($conn, $username);
        $email    = stripslashes($_REQUEST['email']);
        $email    = mysqli_real_escape_string($conn, $email);
        $password = stripslashes($_REQUEST['password']);
        $password = mysqli_real_escape_string($conn, $password);
        $create_datetime = date("Y-m-d H:i:s");
        $query    = "INSERT into `users` (username, password, email, create_datetime)
                     VALUES ('$username', '" . md5($password) . "', '$email', '$create_datetime')";
        $result   = mysqli_query($conn, $query);
        if ($result) {
            echo "<div class='form'>
                  <h3>You are registered successfully.</h3><br/>
                  <p class='link'>Click here to <a href='user_login.php'>Login</a></p>
                  </div>";
        } else {
            echo "<div class='form'>
                  <h3>Required fields are missing.</h3><br/>
                  <p class='link'>Click here to <a href='registration.php'>registration</a> again.</p>
                  </div>";
        }
    } else {
    ?>
        <form class="form rounded-4" method="post" name="login">
            <h4 class="text-center mt-2 mb-3">Register</h1>
                <div class="mb-3">
                    <label for="email-input" class="form-label">Email Adress</label>
                    <input type="email" class="form-control" name="email" id="email-input" placeholder="Email Address" required>
                </div>
                <div class="mb-3">
                    <label for="username-input" class="form-label">Username</label>
                    <input type="text" class="form-control" name="username" id="username-input" placeholder="Username" required>
                </div>
                <div class="mb-3">
                    <label for="inputpassword" class="form-label">Password</label>
                    <input type="password" class="form-control" name="password" id="inputpassword" placeholder="Password" required>
                </div>
                <div class="mb-3">
                    <input type="submit" value="Register" name="submit" class="btn container-fluid rounded-3" />
                    <p class="link mt-3">Already have an account? <a href="user_login.php">Login</a></p>
                    <p class="link mt-3"><a href="index.php">Home</a></p>
                </div>
        </form>
    <?php
    }
    ?>
</body>

</html>
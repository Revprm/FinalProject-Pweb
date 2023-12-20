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

    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];
        $hashed_password = md5($password);

        $query = "SELECT id, email FROM `users` WHERE username = ? AND password = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("ss", $username, $hashed_password);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows == 1) {
            $user = $result->fetch_assoc();

            $_SESSION['username'] = $username;
            $_SESSION['email'] = $user['email']; // Set the email to the session
            header("Location: dashboard.php");
            exit();
        } else {
            echo "<form class='form rounded-4'>
                  <p class='text-center mt-2 mb-3'>Username/password is incorrect.</p>
                  <br/>Click here to <a href='user_login.php'>Login</a></form>";
        }
    } else {
    ?>
        <form class="form rounded-4 shadow-lg" method="post" name="login">
            <h4 class="text-center mt-2 mb-3">Login</h1>
                <div class="mb-3">
                    <label for="username-input" class="form-label">Username</label>
                    <input type="text" class="form-control" name="username" id="username-input" placeholder="Username" required>
                </div>
                <div class="mb-3">
                    <label for="inputpassword" class="form-label">Password</label>
                    <input type="password" class="form-control" name="password" id="inputpassword" placeholder="Password" required>
                </div>
                <div class="mb-3">
                    <input type="submit" value="Login" name="submit" class="btn container-fluid rounded-3" />
                    <p class="link mt-3"><a href="registration.php">Register</a></p>
                    <p class="link mt-3"><a href="index.php">Home</a></p>
                </div>
        </form>
        </form>
    <?php
    }
    ?>
</body>

</html>

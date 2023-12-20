<!-- process_update.php -->
<?php
session_start();
include("auth_session.php");
include("sqlcon.php");

$conn = dbconn();

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_POST['submit'])) {
    $newUsername = stripslashes($_POST['new-username']);
    $newUsername = mysqli_real_escape_string($conn, $newUsername);
    $newPassword = stripslashes($_POST['new-password']);
    $newPassword = mysqli_real_escape_string($conn, $newPassword);
    
    $query = "UPDATE `users` SET username='$newUsername', password='" . md5($newPassword) . "' WHERE username='" . $_SESSION['username'] . "'";
    $result = mysqli_query($conn, $query);

    if ($result) {
        $_SESSION['username'] = $newUsername; 
        header("Location: dashboard.php");
    } else {
        echo "Failed to update account. Please try again.";
    }
}

$conn->close();
?>

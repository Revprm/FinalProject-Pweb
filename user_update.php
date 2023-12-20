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
    $newUsername = $_POST['new-username'];
    $newEmail = $_POST['new-email'];
    $newPassword = $_POST['new-password'];
    

    $query = "UPDATE `users` SET username=?, email =?,  password=? WHERE username=?";
    $stmt = $conn->prepare($query);
    $hashedPassword = md5($newPassword);
    $stmt->bind_param("ssss", $newUsername, $newEmail, $hashedPassword, $_SESSION['username']);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        $_SESSION['username'] = $newUsername;
        header("Location: dashboard.php");
        exit();
    } else {
        echo "Failed to update account. Please try again.";
    }

    $stmt->close();
}

$conn->close();
?>

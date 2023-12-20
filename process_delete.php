<!-- process_delete.php -->
<?php
session_start();
include("auth_session.php");
include("sqlcon.php");

$conn = dbconn();

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_POST['submit'])) {
    $usernameToDelete = $_SESSION['username'];
    
    $query = "DELETE FROM `users` WHERE username='$usernameToDelete'";
    $result = mysqli_query($conn, $query);

    if ($result) {
        session_destroy();  // Destroy the session
        header("Location: index.php");
    } else {
        echo "Failed to delete account. Please try again.";
    }
}

$conn->close();
?>

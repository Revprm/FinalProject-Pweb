<?php
session_start();
include("sqlcon.php");

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['article_id'])) {
    $article_id = $_POST['article_id'];
    $conn = dbconn();

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Perform the deletion query
    $sql = "DELETE FROM artikel WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $article_id);

    if ($stmt->execute()) {
        // Article deleted successfully
        header("Location: dashboard.php"); // Redirect back to the dashboard or any desired page
        exit();
    } else {
        // Error in deletion
        echo "Error deleting article: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
} else {
    // Handle case where article ID is not provided or POST request is not valid
    echo "Invalid request.";
}
?>

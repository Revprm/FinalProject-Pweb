<?php
include("auth_session.php");
include("sqlcon.php");

if (!isset($_SESSION['username'])) {
    header("Location: login.php"); 
    exit();
}

$conn = dbconn();

if (!isset($_GET['id'])) {
    echo "Article ID is missing.";
    exit();
}

$article_id = $_GET['id'];

$sql = "SELECT * FROM artikel WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $article_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows == 0) {
    echo "Article not found.";
    exit();
}

$row = $result->fetch_assoc();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $new_title = $_POST['new_title']; 
    $new_subtitle = $_POST['new_subtitle'];
    $new_content = $_POST['new_content'];
    $new_image_links = $_POST['new_image_links'];

    $update_sql = "UPDATE artikel SET judul = ?, subjudul = ?, deskripsi = ?, image_url = ? WHERE id = ?";
    $stmt = $conn->prepare($update_sql);
    $stmt->bind_param("ssssi", $new_title, $new_subtitle, $new_content, $new_image_links, $article_id);
    
    if ($stmt->execute()) {
        echo "Article updated successfully";
    } else {
        echo "Error updating article: " . $stmt->error;
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Update Article</title>
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
            <a class="navbar-brand" href="#">Articles Website</a>
            <div class="navbar-nav ms-auto">
                <a class="nav-link" href="index.php">Home</a>
                <a class="nav-link" href="dashboard.php">Dashboard</a>
                <a class="nav-link" href="user_settings.php">Settings</a>
                <a class="nav-link" href="user_logout.php">Logout</a>
            </div>
        </div>
    </nav>

    <div class="container mt-5 align-content-lg-center bg-gs container-fluid rounded-3 shadow-lg">
        <div class="container-fluid rounded-3">
            <form class="row g-3 m-3" method="post" name="update_article">
                <div class="col-12 mb-3">
                    <label for="inputTitle" class="form-label">Title</label>
                    <input type="text" class="form-control" name="new_title" id="inputTitle" placeholder="Enter the title">
                </div>
                <div class="col-12 mb-3">
                    <label for="inputSubtitle" class="form-label">Subtitle</label>
                    <input type="text" class="form-control" name="new_subtitle" id="inputSubtitle" placeholder="Enter the subtitle">
                </div>
                <div class="col-12 mb-3">
                    <label for="inputContent" class="form-label">Content</label>
                    <textarea class="form-control" name="new_content" id="inputContent" rows="4" placeholder="Enter the content"></textarea>
                </div>
                <div class="col-12 mb-3">
                    <label for="inputImageLinks" class="form-label">Image Links</label>
                    <input type="text" class="form-control" name="new_image_links" id="inputImageLinks" placeholder="Enter image links">
                </div>
                <div class="col-12 mb-3">
                    <button type="submit" class="btn btn-primary rounded-2" style="width: 1224px;">Update</button>
                </div>
            </form>

            </form>
        </div>
    </div>
</body>

</html>
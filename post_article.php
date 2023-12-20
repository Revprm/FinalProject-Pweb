<?php
include("auth_session.php");
include("sqlcon.php");

$conn = dbconn();

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST["title"];
    $content = $_POST["content"];
    $subtitle = $_POST["subtitle"];
    $image_links = $_POST["image_links"];
    $author = $_SESSION['username'];

    // Use prepared statement to prevent SQL injection
    $userQuery = $conn->prepare("SELECT id FROM users WHERE username = ?");
    $userQuery->bind_param("s", $author);
    $userQuery->execute();
    $userResult = $userQuery->get_result();

    if ($userResult->num_rows > 0) {
        $userData = $userResult->fetch_assoc();
        $id_user = $userData['id'];

        // Use prepared statement to prevent SQL injection
        $sql = $conn->prepare("INSERT INTO artikel (judul, deskripsi, subjudul, image_url, id_user) VALUES (?, ?, ?, ?, ?)");
        $sql->bind_param("ssssi", $title, $content, $subtitle, $image_links, $id_user);
        $result = $sql->execute();

        if ($result) {
            echo "Article inserted successfully!";
        } else {
            echo "Error inserting article: " . $conn->error;
        }
    } else {
        echo "User not found!";
    }
    $userQuery->close();
    $sql->close();
}
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/gs_color.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="assets/js/script.js"></script>
</head>

<body>
    <section class="ftco-section sticky-top">
		<nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light" id="ftco-navbar">
	    <div class="container">
	      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav" aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
	        <span class="fa fa-bars"></span> Menu
	      </button>
	      <div class="collapse navbar-collapse" id="ftco-nav">
	        <ul class="navbar-nav mr-auto">
	        	<li class="nav-item active"><a href="#" class="nav-link">Masits</a></li>
	        </ul>
	      </div>
          <div class="navbar-nav ms-auto">
                <a class="nav-link" href="index.php">Home</a>
                <a class="nav-link" href="dashboard.php">Dashboard</a>
                <a class="nav-link" href="user_settings.php">Settings</a>
                <a class="nav-link" href="user_logout.php">Logout</a>
            </div>
	    </div>
	  </nav>

	</section>

    <div class="container mt-5 align-content-lg-center bg-gs container-fluid rounded-3 shadow-lg">
        <div class="container-fluid rounded-3">
            <form class="row g-3 m-3" method="post" name="add_article">
                <div class="col-12 mb-3">
                    <label for="inputTitle" class="form-label">Title</label>
                    <input type="text" class="form-control" name="title" id="inputTitle" placeholder="Enter the title">
                </div>
                <div class="col-12 mb-3">
                    <label for="inputSubtitle" class="form-label">Subtitle</label>
                    <input type="text" class="form-control" name="subtitle" id="inputSubtitle" placeholder="Enter the subtitle">
                </div>
                <div class="col-12 mb-3">
                    <label for="inputContent" class="form-label">Content</label>
                    <textarea class="form-control" name="content" id="inputContent" rows="4" placeholder="Enter the content"></textarea>
                </div>
                <div class="col-12 mb-3">
                    <label for="inputImageLinks" class="form-label">Image Links</label>
                    <input type="text" class="form-control" name="image_links" id="inputImageLinks" placeholder="Enter image links">
                </div>
                <div class="col-12 mb-3">
                    <button type="submit" class="btn btn-primary rounded-2" style="width: 1224px;">Submit</button>
                </div>
            </form>

            </form>
        </div>
    </div>
</body>

</html>
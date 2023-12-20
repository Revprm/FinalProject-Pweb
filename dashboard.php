<?php
include("auth_session.php");
include("sqlcon.php");
$conn = dbconn();

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM artikel";
$result = $conn->query($sql);

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
    <nav class="navbar navbar-expand-lg sticky-top navbar-gs bg-gs p-3 shadow-lg" id="home_navigation">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Articles Website</a>
            <div class="navbar-nav ms-auto">
                <a class="nav-link" href="index.php">Home</a>
                <a class="nav-link" href="user_settings.php">Settings</a>
                <a class="nav-link" href="user_logout.php">Logout</a>
            </div>
        </div>
    </nav>

    <div class="container mt-5">
        <div class="form shadow-lg">
            <p>Hello, <?php echo $_SESSION['username']; ?>!</p>
            <p>Welcome to the the user dashboard</p>
            <p>Feel Free to modify your own articles in our website!</p>
            </form>
        </div>
    </div>

    <div class="container rounded-5 p-5">
        <input class="form-control shadow-lg" id="myInput" type="text" placeholder="Search..">
        <br>
        <table class="table table-responsive table-hover shadow-lg" id="tabel">
            <thead>
                <tr>
                    <th scope="col" class="text-center">Artikel</th>
                    <th scope="col" class="text-center">Actions</th>
                </tr>
            </thead>
            <tbody id="myTable">
                <?php
                $check = false;
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        if ($row['author'] == $_SESSION['username']) {
                            $check = true;
                            echo '<tr>';
                            echo '<th scope="col" id="desc">';
                            echo '<a href="artikel.php?id=' . $row['id'] . '" target="_blank" style="text-decoration: none;">';
                            echo '<img class="img-responsive mw-100 mh-100 col-xl-6 col-md-12 p-2" width="475px" src="' . $row['image_url'] . '" alt="' . $row['judul'] . '">';
                            echo '<div class="col-xl-6 col-md-12 float-end ps-5 pt-4 pe-5 flex-column">';
                            echo '<h4>' . $row['judul'] . '</h4>';
                            echo '<p>' . $row['subjudul'] . '</p>';
                            echo '<p class ="mt-5">Author: ' . $row['author'] . '</p>';
                            echo '</div>';
                            echo '</a>';
                            echo '</th>';
                            echo '<th scope="col" class="text-center">';
                            echo '<a href="update_article.php?id=' . $row['id'] . '" class="btn mb-3 rounded-3">Update</a>';
                            echo '<a href="delete_article.php?id=' . $row['id'] . '" class="btn mb-3 rounded-3">Delete</a>';
                            echo '</th>';
                            echo '</tr>';
                        }
                    }
                    if (!$check) {
                        echo '<tr><th scope="col" id="desc">No Articles found</th>';
                        echo '<th scope="col" id="desc"></th>';
                        echo '</tr>';
                        
                    }
                }
                $conn->close();
                ?>
            </tbody>

        </table>
        <div class="text-start mt-3">
            <a href="post_article.php" class="btn btn-primary shadow-lg">Add New Article</a>
        </div>
</body>

</html>
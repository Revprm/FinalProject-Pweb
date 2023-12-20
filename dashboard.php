<?php
include("auth_session.php");
include("sqlcon.php");
$conn = dbconn();

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT artikel.id, artikel.judul, artikel.subjudul, artikel.image_url, users.username AS author, users.email 
        FROM artikel
        INNER JOIN users ON artikel.id_user = users.id";

$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/styles.css">
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
                <a class="nav-link" href="user_settings.php">Settings</a>
                <a class="nav-link" href="user_logout.php">Logout</a>
            </div>
	    </div>
	  </nav>

	</section>

    <div class="container mt-5">
        <div class="row">
            <div class="col form shadow-lg mx-3">
            <p><?php echo $_SESSION['username']; ?>!</p>
                <?php
                // Check if the 'email' key is set in the $_SESSION array
                if (isset($_SESSION['email'])) {
                    echo '<p>' . $_SESSION['email'] . '!</p>';
                } else {
                    echo '<p>Email not set!</p>';
                }
                ?>
            </div>
            <div class="col form shadow-lg">
                <p>Cara Menambahkan List Makanan</p>
                <p>1. Pencet tombol Tambah Makanan</p>
                <p>2. Isi data - data yang diperlukan</p>
                <p>3. Untuk gambar, copy image adress nya dari gambar yang anda ingin masukkan</p>
                <p>4. gunakan embed map pada google map</p>
                <p>Pencet submit dan Referensi makanan anda sudah di post!</p>
                </form>
            </div>
        </div>
    </div>

    <div class="container rounded-5 p-5">
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
                            echo '<a href="update_article.php?id=' . $row['id'] . '" class="btn mb-3 rounded-3" style="width: 125px;">Update</a>';
                            echo '<a href="delete_article.php?id=' . $row['id'] . '" class="btn mb-3 rounded-3" style="width: 125px;">Delete</a>';
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
        <div class="pagination float-end pt-1">
            <button id="prevPage" class="btn shadow-lg rounded-3" style="width: 100px;">Previous</button>
            <span id="pageInfo" class="pt-1 me-2 ms-2">Page 1</span>
            <button id="nextPage" class="btn shadow-lg rounded-3" style="width: 100px;">Next</button>
        </div>

        <div class="text-start mt-3">
            <a href="post_article.php" class="btn btn-primary shadow-lg rounded-3">Add New Article</a>
        </div>
</body>

</html>
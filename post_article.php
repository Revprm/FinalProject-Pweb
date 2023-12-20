<?php
include("auth_session.php");
include("sqlcon.php");

$conn = dbconn();

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $namatoko = $_POST["namatoko"];
    $gmaps = $_POST["gmaps"];
    $gambar = $_POST["gambar"];
    $author = $_SESSION['username'];

    $userQuery = $conn->prepare("SELECT id FROM users WHERE username = ?");
    $userQuery->bind_param("s", $author);
    $userQuery->execute();
    $userResult = $userQuery->get_result();

    if ($userResult->num_rows > 0) {
        $userData = $userResult->fetch_assoc();
        $id_user = $userData['id'];

        $sql = $conn->prepare("INSERT INTO makanan (nama_toko, link_gmaps, foto_makanan, id_user) VALUES (?, ?, ?, ?)");
        $sql->bind_param("sssi", $namatoko, $gmaps, $gambar, $id_user);
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
                    <label for="inputNamatoko" class="form-label">Nama Toko</label>
                    <input type="text" class="form-control" name="namatoko" id="inputNamatoko" placeholder="Nama Toko">
                </div>
                <div class="col-12 mb-3">
                    <label for="inputGambar" class="form-label">Link Gambar makanan</label>
                    <input type="text" class="form-control" name="gambar" id="inputGambar" placeholder="Link Gambar">
                </div>
                <div class="col-12 mb-3">
                    <label for="inputGmaps" class="form-label">Lokasi di Google Maps</label>
                    <textarea class="form-control" name="gmaps" id="inputGmaps" placeholder="Lokasi Google Maps"></textarea>
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
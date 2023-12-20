<?php
include("auth_session.php");
include("sqlcon.php");
$conn = dbconn();

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT makanan.id, makanan.nama_toko, makanan.foto_makanan, makanan.link_gmaps, users.username AS author, users.email 
        FROM makanan
        INNER JOIN users ON makanan.id_user = users.id";

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
                <p>Data Akun: </p>
                <p>Username: <?php echo $_SESSION['username'];?></p>
                <p>Email: <?php echo $_SESSION['email'];?></p>
            </div>
            <div class="col form shadow-lg">
                <p>Cara Menambahkan List Makanan atau Minuman</p>
                <p>1. Pencet tombol Tambah Makanan atau Minuman</p>
                <p>2. Isi data - data yang diperlukan</p>
                <p>3. Untuk gambar, copy image adress nya dari gambar yang anda ingin masukkan</p>
                <p>4. gunakan embed map pada google map (ambil hanya link yang ada pada bagian src saja)</p>
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
                    <th scope="col" class="text-center">Makanan atau minuman</th>
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
                            echo '<td>';
                            echo '<div class="row">';
                            echo '<h4 class="text-center pt-2 pb-3">' . $row['nama_toko'] . '</h4>';
                            echo '<div class="col-md-6">';
                            echo '<img class="img-responsive mw-100 mh-100 p-4" width="475px" src="' . $row['foto_makanan'] . '" alt="' . $row['nama_toko'] . '">';
                            echo '</div>';
                            echo '<div class="col-xl-6 col-md-12 p-4">';
                            echo '<iframe src="' . $row['link_gmaps'] . '" width="450" height="300" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>';
                            echo '</div>';
                            echo '</div>';
                            echo '</td>';
                            echo '<td class="text-center">';
                            echo '<a href="update_article.php?id=' . $row['id'] . '" class="btn mb-3 mx-2 rounded-3" style="width: 125px;">Update</a>';
                            echo '<a href="delete_article.php?id=' . $row['id'] . '" class="btn mb-3 rounded-3" style="width: 125px;">Delete</a>';
                            echo '</td>';
                            echo '</tr>';
                        }
                    }
                    if (!$check) {
                        echo '<tr><td colspan="2" class="text-center">Tidak ada makanan yang terdata di akun ini</td></tr>';
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
            <a href="post_article.php" class="btn btn-primary shadow-lg rounded-3">Tambah Makanan atau Minuman</a>
        </div>
</body>

</html>
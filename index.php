<?php
session_start();

include("sqlcon.php");

$conn = dbconn();

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT makanan.id, makanan.nama_toko, makanan.link_gmaps, makanan.foto_makanan, users.username AS author 
        FROM makanan
        INNER JOIN users ON makanan.id_user = users.id";

$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <title>Final Project Pweb</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
          <?php
          if (isset($_SESSION['username'])) {
            echo '<a class="nav-link" href="dashboard.php">' . $_SESSION['username'] . '</a>';
            echo '<a class="nav-link" href="user_logout.php">Logout</a>';
          } else {
            echo '<a class="nav-link" href="user_login.php">Login</a>';
          }
          ?>
        </div>
      </div>
    </nav>

  </section>

  <section id="about" class="d-flex align-items-center">
    <div class="container">
      <div class="row">
        <div class="col-lg-6 d-flex flex-column justify-content-center pt-4 pt-lg-0 order-2 order-lg-1" data-aos="fade-up" data-aos-delay="200">
          <h1>Apa itu Masits?</h1>
          <h2>Masits adalah website untuk anda yang belum mengetahui makanan atau minuman enak di sekitar ITS</h2>
          <div class="d-flex justify-content-center justify-content-lg-start">
          </div>
        </div>
        <div class="col-lg-6 order-1 order-lg-2 hero-img" data-aos="zoom-in" data-aos-delay="200">
          <img src="https://asset.kompas.com/crops/YZLqjNDVZAfgW5WhcF4AhXCNWIQ=/0x83:1000x750/750x500/data/photo/2019/10/27/5db54a0447a82.jpg" class="img-fluid animated" alt="">
        </div>
      </div>
    </div>
  </section>

  <div class="container rounded-5 p-5">
    <input class="form-control shadow-lg" id="myInput" type="text" placeholder="Search..">
    <br>
    <table class="table table-responsive table-hover shadow-lg" id="tabel">
      <thead>
        <tr>
          <th scope="col" class="text-center">Makanan atau minuman</th>
        </tr>
      </thead>
      <tbody id="myTable">
        <?php
        if ($result->num_rows > 0) {
          while ($row = $result->fetch_assoc()) {
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
          }
        } else {
          echo '<tr><th scope="col" id="desc">Tidak ada makanan atau minuman yang terdata</th></tr>';
        }
        $conn->close();
        ?>
      </tbody>
    </table>

    <div class="pagination float-end pt-1">
      <button id="prevPage" class="btn shadow-lg rounded-3" style="width: 125px;">Previous</button>
      <span id="pageInfo" class="pt-1 me-2 ms-2">Page 1</span>
      <button id="nextPage" class="btn shadow-lg rounded-3" style="width: 125px;">Next</button>
    </div>
  </div>

  <footer class="text-center pt-5">
    <figcaption class="blockquote-footer">
      <p>Tugas Pemrograman Web Jurusan Teknik Informatika ITS 2023</p>
      <p>5025221252, Revy Pramana, Dosen: Imam Kuswardayan, S.Kom, M.T</p>
    </figcaption>
  </footer>

</body>

</html>
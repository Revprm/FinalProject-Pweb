<?php
session_start();

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
  <nav class="navbar navbar-expand-lg sticky-top navbar-gs bg-gs p-3 shadow-lg" id="home_navigation">
    <div class="container-fluid">
      <a class="navbar-brand" href="#">Articles Website</a>
      <div class="navbar-nav ms-auto">
        <a class="nav-link" href="index.php">Home</a>
        <?php
        if (isset($_SESSION['username'])) {
          echo '<a class="nav-link" href="dashboard.php">' . $_SESSION['username'] . '</a>';
          echo'<a class="nav-link" href="user_logout.php">Logout</a>';
        } else {
          echo '<a class="nav-link" href="user_login.php">Login</a>';
        }
        ?>
      </div>
    </div>
  </nav>

  <section id="About">
    <div class="container-fluid text-center">
      <h1>Revy Pramana</h1>
      <figcaption class="blockquote-footer mt-2 text-light">
        <em>A keyboard enthusiast</em>
      </figcaption>
      <p class="fs-5"><em>5025221252</em></p>
    </div>
  </section>

  <div class="container rounded-5 p-5">
    <input class="form-control shadow-lg" id="myInput" type="text" placeholder="Search..">
    <br>
    <table class="table table-responsive table-hover shadow-lg" id="tabel">
      <thead>
        <tr>
          <th scope="col" class="text-center">Artikel</th>
        </tr>
      </thead>
      <tbody id="myTable">
        <?php
        if ($result->num_rows > 0) {
          while ($row = $result->fetch_assoc()) {
            echo '<tr>';
            echo '<th scope="col" id="desc">';
            echo '<a href="artikel.php?id=' . $row['id'] . '" target="_blank" style="text-decoration: none;">';
            echo '<img class="img-responsive mw-100 mh-100 col-xl-6 col-md-12 p-2" width="475px" src="' . $row['image_url'] . '" alt="' . $row['judul'] . '">';
            echo '<div class="col-xl-6 col-md-12 float-end ps-5 pt-4 pe-5 flex-column">';
            echo '<h4>' . $row['judul'] . '</h4>';
            echo '<p>' . $row['subjudul'] . '</p>';
            if($row['author'] != null){
              echo '<p class ="mt-5">Author: ' . $row['author'] . '</p>';
            }
            else{
              echo '<p class ="mt-5">Author: Admin</p>';
            }
            echo '</div>';
            echo '</a>';
            echo '</th>';
            echo '</tr>';
          }
        } else {
          echo '<tr><th scope="col" id="desc">No articles found</th></tr>';
        }
        $conn->close();
        ?>
      </tbody>
    </table>

    <div class="pagination float-end pt-1">
      <button id="prevPage" class="btn shadow-lg">Previous</button>
      <span id="pageInfo" class="pt-1 me-2 ms-2">Page 1</span>
      <button id="nextPage" class="btn shadow-lg">Next</button>
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
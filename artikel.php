<?php
include("sqlcon.php");
$conn = dbconn();

$articleId = isset($_GET['id']) ? $_GET['id'] : null;
if ($articleId == "") header("location:index.php");

$sql = "SELECT * FROM artikel WHERE id = $articleId";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $articleTitle = $row['judul'];
    $content = $row['deskripsi'];
    $image_url = $row['image_url'];

    $paragraphs = explode("\n", $content);

    $firstParagraph = '<p class="col-xl-6 float-end p-4 me-5 mt-5 text-center">' . trim($paragraphs[0]) . '</p>';
    $remainingParagraphs = '';

    for ($i = 1; $i < count($paragraphs); $i++) {
        $remainingParagraphs .= '<p class="px-5 py-1">' . trim($paragraphs[$i]) . '</p>';
    }
} else {
    $articleTitle = "Article Not Found";
    $firstParagraph = '';
    $remainingParagraphs = '<p>The requested article does not exist.</p>';
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $articleTitle ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/gs_color.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
</head>

<body>
    <div class="container-fluid" id="containercard">
        <h2 class="text-center p-5 text-white"><?php echo $articleTitle ?></h2>
    </div>
    <div class="container-fluid justify-content-center">
        <?php echo '<img class="p-3 rounded-5 col-xl-5 mw-100" width="400px" src="' . $row['image_url'] . '" alt="' . $row['judul'] . '">'; ?>
        <?php echo $firstParagraph . $remainingParagraphs; ?>
    </div>

    <div class="text-center">
        <a href="index.php">
            <button type="button" class="btn">Back</button>
        </a>
    </div>

    <footer class="text-center pt-5">
        <figcaption class="blockquote-footer">
            <p>Tugas Pemrograman Web Jurusan Teknik Informatika ITS 2023</p>
            <p>5025221252, Revy Pramana, Dosen: Imam Kuswardayan, S.Kom, M.T</p>
        </figcaption>
    </footer>
</body>

</html>
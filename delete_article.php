<?php
include("auth_session.php");

if (isset($_GET['id'])) {
    $article_id = $_GET['id'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Delete Article</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/gs_color.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="assets/js/script.js"></script>
</head>

<body>
    <div class="container mt-5">
        <div class="form rounded-3">
            <h5 class="text-center">Are you sure you want to delete this article?</h5>
            <form action="process_delete_article.php" method="post">
                <input type="hidden" name="article_id" value="<?php echo $article_id; ?>">
                <a href="dashboard.php">
                    <button type="button" class="btn shadow-lg mt-4 rounded-3" style="width: 250px;">No</button>
                </a>
                <button type="submit" class="btn shadow-lg mt-4 rounded-3" style="width: 250px;">Yes</button>
            </form>
        </div>
    </div>
</body>


</html>

<?php
} else {
    echo "Article ID not specified.";
}
?>

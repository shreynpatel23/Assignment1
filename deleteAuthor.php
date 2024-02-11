<?php

include 'connect.php';

if (isset($_POST['submit'])) {

    $authorId = $_POST['author_id'];
    $sql = 'delete FROM Authors WHERE author_id = ' . $authorId . '';

    $result = mysqli_query($connect, $sql);

    if ($result) {
        // go back to list
        header('location: authorList.php');
    } else {
        die(mysqli_error($connect));
    }
}
?>

<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>Author Delete</title>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
                <a class="navbar-brand" href="index.php">Amazon</a>
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" href="bookList.php">Books</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="authorList.php">Authors</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="container my-5">
        <h1 class="display-6">Delete Author</h1>
        <?php
        $authorId = $_GET['authorId'];
        $authorName = "";

        if (isset($authorId)) {
            // fetch the details from db
            $sql = 'select * FROM Authors WHERE author_id = ' . $authorId . '';

            $result = mysqli_query($connect, $sql);

            if ($result) {
                while ($row = mysqli_fetch_array($result)) {
                    $authorName = $row['full_name'];
                }
            }
        }
        echo '
            <p class="lead">Are you sure you want to delete <br/> <span class="fw-bold">' . $authorName . '</span></p>
            <p class="lead">Please keep in mind, you cannot revert this action</p>
            <div class="d-flex align-items-center gap-4 mt-4">
                <a href="authorDetails.php?authorId=' . $authorId . '" class="btn btn-secondary">Cancel</a>
                <form method="post">
                    <input type="hidden" name="author_id" value=' . $authorId . '>
                    <button type="submit" name="submit" class="btn btn-danger">Delete</button>
                </form>
            </div>
            '
        ?>
    </div>

    <footer class="my-3 text-center">
        <p class="mb-0 text-dark fw-bold">© Copyright Amazon 2024 | All rights reserved</p>
    </footer>
</body>

</html>
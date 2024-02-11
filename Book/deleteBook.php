<?php

include '../database/connect.php';

if (isset($_POST['submit'])) {

    $bookId = $_POST['book_id'];
    $sql = 'delete FROM Books WHERE book_id = ' . $bookId . '';

    $result = mysqli_query($connect, $sql);

    if ($result) {
        // go back to list
        header('location: bookList.php');
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

    <title>Delete Book</title>
</head>

<body>
    <?php include '../common/header.php' ?>
    <div class="container my-5">
        <h1 class="display-6">Delete Book</h1>
        <?php
        $bookId = $_GET['bookId'];
        $title = "";

        if (isset($bookId)) {
            // fetch the details from db
            $sql = 'select book_id, title FROM Books WHERE book_id = ' . $bookId . '';

            $result = mysqli_query($connect, $sql);

            if ($result) {
                while ($row = mysqli_fetch_array($result)) {
                    $title = $row['title'];
                }
            }
        }
        echo '
            <p class="lead">Are you sure you want to delete <br/> <span class="fw-bold">' . $title . '</span></p>
            <p class="lead">Please keep in mind, you cannot revert this action</p>
            <div class="d-flex align-items-center gap-4 mt-4">
                <a href="bookList.php" class="btn btn-secondary">Cancel</a>
                <form method="post">
                    <input type="hidden" name="book_id" value=' . $bookId . '>
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
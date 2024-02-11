<?php

include '../database/connect.php';

if (isset($_POST['submit'])) {
    $bookId = $_POST['book_id'];
    $title = $_POST['title'];
    $price = $_POST['price'];
    $publicationDate = $_POST['publication_date'];
    $authorId = $_POST['author_id'];

    $sql = "UPDATE Books SET title = '$title', price = '$price', publication_date = '$publicationDate', author_id = '$authorId' WHERE book_id = $bookId";

    echo $sql;

    $result = mysqli_query($connect, $sql);

    if ($result) {
        // go back to list
        header('location: bookList.php');
    } else {
        echo 'Something went wrong!';
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

    <title>Update Book</title>
</head>

<body>
    <?php include '../common/header.php' ?>
    <div class="container my-5">
        <h1 class="display-6">Update Book</h1>
        <?php
        $bookId = $_GET['bookId'];

        $sql = 'select * FROM Books WHERE book_id = ' . $bookId . '';

        $result = mysqli_query($connect, $sql);

        if ($result) {

            while ($row = mysqli_fetch_array($result)) {
                $title = $row['title'];
                $price = $row['price'];
                $publicationDate = $row['publication_date'];
                $authorId = $row['author_id'];
            }
        }

        echo '
            <form style="width: 40rem;" method="post">
                <input type="hidden" name="book_id" value=' . $bookId . '>
                <div class="mb-3">
                    <label for="title" class="form-label">Title</label>
                    <input required type="text" value="' . htmlspecialchars($title) . '" class="form-control" id="title" name="title" aria-describedby="Book Title">
                </div>
                <div class="mb-3">
                    <label for="price" class="form-label">Price</label>
                    <input required type="number" value="' . htmlspecialchars($price) . '" class="form-control" id="price" name="price" aria-describedby="Book Price">
                </div>
                <div class="mb-3">
                    <label for="publication_date" class="form-label">Publication Date</label>
                    <input required type="date" value="' . htmlspecialchars($publicationDate) . '" class="form-control" id="publication_date" name="publication_date" aria-describedby="Book Publication Date">
                </div>
                <div class="mb-3">
                    <label for="author_id" class="form-label">Author</label>
                    <select required class="form-select" id="author_id" name="author_id" aria-label="Author list">
                    ';

        // get all authors from database
        $sql = "Select author_id, full_name from Authors ORDER BY author_id DESC";

        $result = mysqli_query($connect, $sql);
        if ($result) {
            while ($row = mysqli_fetch_assoc($result)) {
                $id = $row['author_id'];
                $fullName = $row['full_name'];
                $selected = '';
                if ($id === $authorId) {
                    $selected = 'selected';
                }
                echo '<option value=' . $id . ' ' . $selected . '>' . $fullName . '</option>';
            }
        }
        echo '
                    </select>
                </div>
                <div class="d-flex align-items-center gap-4">
                    <a href="bookList.php" class="btn btn-secondary">Cancel</a>
                    <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        ';
        ?>
    </div>
    <footer class="my-3 text-center">
        <p class="mb-0 text-dark fw-bold">© Copyright Amazon 2024 | All rights reserved</p>
    </footer>
</body>

</html>
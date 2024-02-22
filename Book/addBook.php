<?php

include '../database/connect.php';

if (isset($_POST['submit'])) {
    $title = $_POST['title'];
    $price = $_POST['price'];
    $publication_date = $_POST['publication_date'];
    $author_id = $_POST['author_id'];

    $sql = "INSERT INTO `Books`(`title`, `price`, `publication_date`, `author_id`) 
            VALUES (
                '" . mysqli_real_escape_string($connect,$title) . "',
                '" . mysqli_real_escape_string($connect,$price) . "',
                '" . mysqli_real_escape_string($connect,$publication_date) . "', 
                '" . mysqli_real_escape_string($connect,$author_id) . "')";

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

    <link rel="stylesheet" href="../assets/styles/styles.css">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>Add Author</title>
</head>

<body>
    <?php include '../common/header.php' ?>
    <div class="container my-5">
        <h1 class="display-6">Add Book</h1>
        <form style="width: 40rem;" method="post">
            <div class="mb-3">
                <label for="title" class="form-label">Title</label>
                <input required type="text" class="form-control" id="title" name="title" aria-describedby="Book Title">
            </div>
            <div class="mb-3">
                <label for="price" class="form-label">Price</label>
                <input required type="number" class="form-control" id="price" name="price" aria-describedby="Book Price">
            </div>
            <div class="mb-3">
                <label for="publication_date" class="form-label">Publication Date</label>
                <input required type="date" class="form-control" id="publication_date" name="publication_date" aria-describedby="Book Publication Date">
            </div>
            <div class="mb-3">
                <label for="author_id" class="form-label">Author</label>
                <select required class="form-select" id="author_id" name="author_id" aria-label="Author list">
                    <option selected>Select Author</option>
                    <?php
                    $sql = "Select author_id, full_name from Authors ORDER BY author_id DESC";

                    $result = mysqli_query($connect, $sql);

                    if ($result) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            $id = $row['author_id'];
                            $fullName = $row['full_name'];
                            echo '<option value=' . $id . '>' . $fullName . '</option>';
                        }
                    }
                    ?>
                </select>
            </div>
            <div class="d-flex align-items-center gap-4">
                <a href="bookList.php" class="btn btn-secondary">Cancel</a>
                <button type="submit" name="submit" class="btn btn-primary">Submit</button>
            </div>
        </form>
    </div>
    <?php include'../common/footer.php' ?>
</body>

</html>
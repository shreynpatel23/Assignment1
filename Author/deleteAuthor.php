<?php

include '../database/connect.php';

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

    <link rel="stylesheet" href="../assets/styles/styles.css">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>Author Delete</title>
</head>

<body>
    <?php include '../common/header.php' ?>
    <div class="container my-5">
        <h1 class="display-6">Delete Author</h1>
        <?php
        $authorId = $_GET['authorId'];
        $authorName = "";

        if (isset($authorId)) {
            // fetch the details from db
            $sql = 'select author_id, full_name FROM Authors WHERE author_id = ' . $authorId . '';

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

    <?php include'../common/footer.php' ?>
</body>

</html>
<?php include '../database/connect.php'; ?>

<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>Book List</title>
</head>

<body>
    <?php include '../common/header.php' ?>
    <div class="container my-5">
        <div class="d-flex align-items-center gap-5 mb-4">
            <h1 class="display-6">Books</h1>
            <a href="addBook.php" class="btn btn-primary">Add Book</a>
        </div>
        <?php
        $sql = "Select * from Books ORDER BY book_id DESC";

        $result = mysqli_query($connect, $sql);

        echo ' <div class="d-flex align-items-start gap-4 flex-wrap">';
        if ($result) {
            while ($row = mysqli_fetch_assoc($result)) {
                $id = $row['book_id'];
                $title = $row['title'];
                $price = $row['price'];
                $publicationDate = $row['publication_date'];

                echo '
                    <div class="card" style="width: 18rem;">
                        <div class="card-body">
                            <h5 class="card-title">' . $title . '</h5>
                            <h6 class="card-subtitle mb-2 text-muted">$ ' . $price . ' </h6>
                            <p class="card-text">Publication Date: <span class="fw-bold" >' . $publicationDate . '</span> </p>
                        </div>
                    </div>
                    ';
            }
        }
        echo '</div>';
        ?>
    </div>
    <footer class="my-3 text-center">
        <p class="mb-0 text-dark fw-bold">© Copyright Amazon 2024 | All rights reserved</p>
    </footer>
</body>

</html>
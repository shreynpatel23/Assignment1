<?php include '../database/connect.php'; ?>

<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="../assets/styles/styles.css">
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
        $sql = "select * FROM Books JOIN Authors ON Books.author_id = Authors.author_id ORDER BY book_id DESC";

        $result = mysqli_query($connect, $sql);
        
        echo ' <div class="d-flex align-items-start gap-4 flex-wrap">';
        if ($result) {
            while ($row = mysqli_fetch_assoc($result)) {
                $bookId = $row['book_id'];
                $authorId = $row['author_id'];
                $authorName = $row['full_name'];
                $title = $row['title'];
                $price = $row['price'];
                $publicationDate = $row['publication_date'];

                echo '
                    <div class="card" style="width: 18rem;">
                        <div class="card-body">
                            <h5 class="card-title">' . $title . '</h5>
                            <h6 class="card-subtitle mb-2 text-muted">$ ' . $price . ' </h6>
                            <p class="card-text">Publication Date: <span class="fw-bold" >' . $publicationDate . '</span> </p>
                            <p class="card-text">Author: <a href="../Author/authorDetails.php?authorId=' . $authorId . '" class="text-primary fw-bold">' . $authorName . '</a> </p>
                            <div class="d-flex align-items-center gap-4 mt-3">
                                <a href="updateBook.php?bookId='. $bookId .'" class="btn btn-primary btn-sm">Edit</a>
                                <a href="deleteBook.php?bookId='. $bookId .'" class="btn btn-danger btn-sm">Delete</a>
                            </div>
                        </div>
                    </div>
                    ';
            }
        }
        echo '</div>';
        ?>
    </div>
    <?php include'../common/footer.php' ?>
</body>

</html>
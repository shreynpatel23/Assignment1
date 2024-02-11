<?php include '../database/connect.php'; ?>

<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>Author Details</title>
</head>

<body>
    <?php include '../common/header.php' ?>
    <div class="container my-5">
        <a href="authorList.php" class="btn btn-secondary">Back</a>
        <hr>
        <?php

        $authorId = $_GET['authorId'];
        $authorName = "";
        $authorBio = "";
        $authorNationality = "";
        $authorLanguage = "";
        $authorBirthplace = "";
        $authorBooks = [];

        if (isset($authorId)) {
            // fetch the details from db
            $sql = 'select * FROM Authors WHERE author_id = ' . $authorId . '';

            $result = mysqli_query($connect, $sql);

            if ($result) {
                while ($row = mysqli_fetch_array($result)) {
                    $authorName = $row['full_name'];
                    $authorBio = $row['biography'];
                    $authorNationality = $row['nationality'];
                    $authorLanguage = $row['language'];
                    $authorBirthplace = $row['birthplace'];
                }

                echo '
                        <div class="d-flex align-items-center justify-content-between">
                            <h1 class="display-6 mt-3">Author Details</h1>
                            <div class="d-flex align-items-center gap-4">
                                <a href="updateAuthor.php?authorId=' . $authorId . '" class="btn btn-primary">Edit</a>
                                <a href="deleteAuthor.php?authorId=' . $authorId . '" class="btn btn-danger">Delete</a>
                            </div>
                        </div>
                        <div class="py-4">
                            <h3>' . $authorName . '</a></h3>
                            <p class="text-dark">' . $authorBio . '</p>
                            <p class="text-dark">Nationality: <span class="fw-bold">' . $authorNationality . '</span></p>
                            <p class="text-dark">Language: <span class="fw-bold">' . $authorLanguage . '</span></p>
                            <p class="text-dark">Birth Place: <span class="fw-bold">' . $authorBirthplace . '</span></p>
                        </div>
                        <hr />
                    ';
            }

            // fetch books data by joining the author and the books table
            $sql = 'select * FROM Authors JOIN Books ON Authors.author_id = Books.author_id WHERE Authors.author_id = ' . $authorId . '';
            $result = mysqli_query($connect, $sql);
            if ($result) {
                while ($row = mysqli_fetch_array($result)) {
                    // push the books in the array
                    array_push($authorBooks, (object)[
                        'bookTitle' => $row['title'],
                        'bookPrice' => $row['price'],
                        'bookPublicationDate' => $row['publication_date'],
                    ]);
                }
            }

            if (count($authorBooks) <= 0) {
                echo '<p>This author has not written a single book!</p>';
            } else {
                echo '<h4 class="mb-3">Books Written</h4>';
                echo '<div class="d-flex align-items-center gap-4 flex-wrap">';
                // read the data from author books
                $i = 0;
                while ($i < count($authorBooks)) {
                    echo '
                <div class="card" style="width: 18rem;">
                    <div class="card-body">
                        <h5 class="card-title">' . $authorBooks[$i]->bookTitle . ' Book Name</h5>
                        <h6 class="card-subtitle mb-2 text-muted">$ ' . $authorBooks[$i]->bookPrice . ' </h6>
                        <p class="card-text">Publication Date: ' . $authorBooks[$i]->bookPublicationDate . ' </p>
                    </div>
                </div>
                ';
                    $i++;
                }
                echo '</div>';
            }
        }
        ?>
    </div>
    <footer class="my-3 text-center">
        <p class="mb-0 text-dark fw-bold">© Copyright Amazon 2024 | All rights reserved</p>
    </footer>
</body>

</html>
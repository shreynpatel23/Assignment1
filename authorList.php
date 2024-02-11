<?php include 'connect.php'; ?>

<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>Author List</title>
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
        <div class="d-flex align-items-center gap-5 mb-4">
            <h1 class="display-6">Authors</h1>
            <a href="addAuthor.php" class="btn btn-primary">Add Author</a>
        </div>
        <?php
            $sql = "Select * from Authors ORDER BY author_id DESC";

            $result = mysqli_query($connect, $sql);

            if($result) {
                while($row=mysqli_fetch_assoc($result)){
                    $id = $row['author_id'];
                    $fullName = $row['full_name'];
                    $bio = $row['biography'];
                    $nationality = $row['nationality'];
                    $language = $row['language'];

                    echo '
                    <div class="py-4 border-bottom">
                        <h3><a href="authorDetails.php?authorId='. $id . '" class="text-dark">'. $fullName . '</a></h3>
                        <p class="text-dark">'. $bio . '</p>
                        <p class="text-dark">Nationality: <span class="fw-bold">'. $nationality .'</span></p>
                        <p class="text-dark">Language: <span class="fw-bold">'. $language .'</span></p>
                    </div>
                    ';
                }
            }
        ?>
    </div>
    <footer class="my-3 text-center">
    <p class="mb-0 text-dark fw-bold">© Copyright Amazon 2024 | All rights reserved</p>
  </footer>
</body>

</html>
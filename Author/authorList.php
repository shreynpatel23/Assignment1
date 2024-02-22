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

    <title>Author List</title>
</head>

<body>
    <?php include '../common/header.php' ?>
    <div class="container my-5">
        <div class="d-flex align-items-center gap-5 mb-4">
            <h1 class="display-6">Authors</h1>
            <a href="addAuthor.php" class="btn btn-primary">Add Author</a>
        </div>
        <?php
        $sql = "Select * from Authors ORDER BY author_id DESC";

        $result = mysqli_query($connect, $sql);

        if ($result) {
            while ($row = mysqli_fetch_assoc($result)) {
                $id = $row['author_id'];
                $fullName = $row['full_name'];
                $bio = $row['biography'];
                $nationality = $row['nationality'];
                $language = $row['language'];

                echo '
                    <div class="py-4 border-bottom">
                        <h3><a href="authorDetails.php?authorId=' . $id . '" class="text-dark">' . $fullName . '</a></h3>
                        <p class="text-dark">' . $bio . '</p>
                        <p class="text-dark">Nationality: <span class="fw-bold">' . $nationality . '</span></p>
                        <p class="text-dark">Language: <span class="fw-bold">' . $language . '</span></p>
                    </div>
                    ';
            }
        }
        ?>
    </div>
    <?php include'../common/footer.php' ?>
</body>

</html>
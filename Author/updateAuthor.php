<?php

include '../database/connect.php';

if (isset($_POST['submit'])) {
  $authorId = $_POST['author_id'];
  $fullName = $_POST['full_name'];
  $bio = $_POST['biography'];
  $nationality = $_POST['nationality'];
  $language = $_POST['language'];
  $birthplace = $_POST['birthplace'];


  $sql = "UPDATE Authors SET full_name = '$fullName', nationality = '$nationality', biography = '$bio', language = '$language', birthplace = '$birthplace' WHERE author_id = $authorId";

  echo $sql;

  $result = mysqli_query($connect, $sql);

  if ($result) {
    // go back to list
    header("location: authorDetails.php?authorId=$authorId");
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

  <title>Update Author</title>
</head>

<body>
  <?php include '../common/header.php' ?>
  <div class="container my-5">
    <h1 class="display-6">Update Author</h1>
    <?php
    $authorId = $_GET['authorId'];

    $sql = 'select * FROM Authors WHERE author_id = ' . $authorId . '';

    $result = mysqli_query($connect, $sql);

    if ($result) {

      while ($row = mysqli_fetch_array($result)) {
        $fullName = $row['full_name'];
        // echo $name;
        $authorBio = $row['biography'];
        $authorNationality = $row['nationality'];
        $authorLanguage = $row['language'];
        $authorBirthplace = $row['birthplace'];
      }
    }

    $nationalities = array(
      "British",
      "American",
      "Indian",
      "Canadian",
      "Russian",
      "Austrian-Hungarian",
      "Japanese"
    );

    echo '
    <form style="width: 40rem;" method="post">
      <input type="hidden" name="author_id" value=' . $authorId . '>
      <div class="mb-3">
        <label for="full_name" class="form-label">Full Name</label>
        <input required type="text" value="'.htmlspecialchars($fullName).'" class="form-control" id="full_name" name="full_name" aria-describedby="Author Full Name">
      </div>
      <div class="mb-3">
        <label for="biography" class="form-label">Biography</label>
        <textarea required class="form-control" id="biography" name="biography" aria-describedby="Author Biography" rows="3">' . $authorBio . '</textarea>
      </div>
      <div class="mb-3">
        <label for="nationality" class="form-label">Nationality</label>
        <select required class="form-select" id="nationality" name="nationality" aria-label="Author Nationality">
          ';
    foreach ($nationalities as $nationality) {
      $selected = '';
      if ($nationality === $authorNationality) {
        $selected = 'selected';
      }
      echo '<option value=' . $nationality . ' ' . $selected . '>' . $nationality . '</option>';
    }
    echo '
        </select>
      </div>
      <div class="mb-3">
        <label for="language" class="form-label">Language</label>
        <input required type="text" value="'.htmlspecialchars($authorLanguage).'" class="form-control" id="language" name="language" aria-describedby="Author Language">
      </div>
      <div class="mb-3">
        <label for="birthplace" class="form-label">Birthplace</label>
        <input required type="text" value="'.htmlspecialchars($authorBirthplace).'" class="form-control" id="birthplace" name="birthplace" aria-describedby="Author Birthplace">
      </div>
      <div class="d-flex align-items-center gap-4">
        <a href="authorDetails.php?authorId=' . $authorId . '" class="btn btn-secondary">Cancel</a>
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
<?php

include '../database/connect.php';

if (isset($_POST['submit'])) {
  $fullName = $_POST['full_name'];
  $bio = $_POST['biography'];
  $nationality = $_POST['nationality'];
  $language = $_POST['language'];
  $birthplace = $_POST['birthplace'];

  $sql = "INSERT INTO `Authors`(`full_name`, `nationality`, `biography`, `language`, `birthplace`) 
          VALUES (
          '". mysqli_real_escape_string($connect, $fullName ) ."',
          '". mysqli_real_escape_string($connect, $nationality ) ."',
          '". mysqli_real_escape_string($connect, $bio ) ."',
          '". mysqli_real_escape_string($connect, $language ) ."',
          '". mysqli_real_escape_string($connect, $birthplace ) ."')";

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

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

  <title>Add Author</title>
</head>

<body>
  <?php include '../common/header.php' ?>
  <div class="container my-5">
    <h1 class="display-6">Add Author</h1>
    <form style="width: 40rem;" method="post">
      <div class="mb-3">
        <label for="full_name" class="form-label">Full Name</label>
        <input required type="text" class="form-control" id="full_name" name="full_name" aria-describedby="Author Full Name">
      </div>
      <div class="mb-3">
        <label for="biography" class="form-label">Biography</label>
        <textarea required class="form-control" id="biography" name="biography" aria-describedby="Author Biography" rows="3"></textarea>
      </div>
      <div class="mb-3">
        <label for="nationality" class="form-label">Nationality</label>
        <select required class="form-select" id="nationality" name="nationality" aria-label="Author Nationality">
          <option selected>Select Nationality</option>
          <option value="British">British</option>
          <option value="American">American</option>
          <option value="Indian">Indian</option>
          <option value="Canadian">Canadian</option>
          <option value="Russian">Russian</option>
          <option value="Austrian-Hungarian">Austrian-Hungarian</option>
          <option value="Japanese">Japanese</option>
        </select>
      </div>
      <div class="mb-3">
        <label for="language" class="form-label">Language</label>
        <input required type="text" class="form-control" id="language" name="language" aria-describedby="Author Language">
      </div>
      <div class="mb-3">
        <label for="birthplace" class="form-label">Birthplace</label>
        <input required type="text" class="form-control" id="birthplace" name="birthplace" aria-describedby="Author Birthplace">
      </div>
      <div class="d-flex align-items-center gap-4">
        <a href="authorList.php" class="btn btn-secondary">Cancel</a>
        <button type="submit" name="submit" class="btn btn-primary">Submit</button>
      </div>
    </form>
  </div>
  <?php include'../common/footer.php' ?>
</body>

</html>
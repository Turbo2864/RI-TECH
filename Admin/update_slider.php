<?php
session_start();
include("../config/config.php");

if (!isset($_SESSION['username'])) {
    header("Location: index.php");
    exit();
}

// CONNECT
$link = mysqli_connect($mysql_host, $mysql_user, $mysql_password, $mysql_database);
if (!$link) {
    die("Connection failed: " . mysqli_connect_error());
}

// GET SLIDER ID
$id = $_GET['id'] ?? 1;

// FETCH SLIDER DATA
$sql = "SELECT * FROM slider WHERE id='$id'";
$result = mysqli_query($link, $sql);
$row = mysqli_fetch_array($result);


if (isset($_POST['update_details'])) {

    $title = $_POST['title'];
    $description = $_POST['description'];
    $link_url = $_POST['link'];

    $update = "UPDATE slider 
               SET title='$title', description='$description', link='$link_url'
               WHERE id='$id'";

    mysqli_query($link, $update);

    header("Location: dashboard.php?id=$id");
    exit();
}

if (isset($_POST['update_image'])) {

    $image = $_FILES['image']['name'];
    $tmp = $_FILES['image']['tmp_name'];

    $folder = "../admin/" . $image;

    move_uploaded_file($tmp, $folder);

    $update = "UPDATE slider SET path='$image' WHERE id='$id'";
    mysqli_query($link, $update);

    header("Location: dashboard.php?id=$id");
    exit();
}
?>

<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Dashboard</title>
  <link href="assets/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

<div class="container mt-5">

  <div class="row">

  
    <div class="col-md-6">
      <div class="card p-4 shadow">
        <h4>Update Slider Details</h4>

        <form method="POST">

          <div class="mb-3">
            <label>Title</label>
            <input type="text" name="title" class="form-control"
                   value="<?php echo $row['title']; ?>" required>
          </div>

          <div class="mb-3">
            <label>Description</label>
            <textarea name="description" class="form-control" required><?php echo $row['description']; ?></textarea>
          </div>

          <div class="mb-3">
            <label>Link</label>
            <input type="text" name="link" class="form-control"
                   value="<?php echo $row['link']; ?>" required>
          </div>

          <button type="submit" name="update_details" class="btn btn-warning w-100">
            Update Details
          </button>

        </form>
      </div>
    </div>

    <div class="col-md-6">
      <div class="card p-4 shadow">
        <h4>Update Slider Image</h4>

        <form method="POST" enctype="multipart/form-data">

          <div class="mb-3 text-center">
            <label>Current Image</label><br>
            <img src="../admin/<?php echo $row['path']; ?>" width="200">
          </div>

          <div class="mb-3">
            <label>New Image</label>
            <input type="file" name="image" class="form-control" required>
          </div>

          <button type="submit" name="update_image" class="btn btn-success w-100">
            Update Image
          </button>

        </form>
      </div>
    </div>

  </div>

</div>

<script src="assets/js/bootstrap.bundle.min.js"></script>
</body>
</html>
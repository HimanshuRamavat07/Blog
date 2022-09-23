<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <link rel="stylesheet" href="./Assets/css/style.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.9.1/font/bootstrap-icons.min.css" integrity="sha512-5PV92qsds/16vyYIJo3T/As4m2d8b6oWYfoqV+vtizRB6KhF1F9kYzWzQmsO6T3z3QG2Xdhrx7FQ+5R1LiQdUA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <title>Blog:Home</title>
</head>

<body>
  <div class="container-fluid ">
    <div class="row">
      <div class="col-sm-auto bg-light sticky-top">
        <div class="d-flex flex-sm-column flex-row flex-nowrap bg-light align-items-center sticky-top " style="margin-top:23rem ;">
          <a href="./index.php" class="d-block p-3 link-dark text-decoration-none" title="Blog" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-original-title="Icon-only">
            <i class="bi-stickies fs-1"></i>
          </a>

          <?php if (isset($_SESSION['user'])) { ?>
            <div class="dropdown">
              <a  class="d-flex align-items-center justify-content-center p-3 link-dark text-decoration-none dropdown-toggle" id="dropdownUser3" data-bs-toggle="dropdown" aria-expanded="false">
                <i class="bi-person-circle h2">
                </i>
              </a>
              <ul class="dropdown-menu text-small shadow" aria-labelledby="dropdownUser3">
                <li><a class="dropdown-item" href="./profile.php?aid=<?php echo $_SESSION['id']; ?>">Profile</a></li>
                <li><a class="dropdown-item" href="./logout.php">logout</a></li>
              
              </ul>

            </div>
          <?php } ?>

        </div>
      </div>
      <div class="col-sm p-3 min-vh-100">
        <div class="container-fluid">
          <div class="card shadow-sm p-3 mb-5 bg-white rounded">

            <h3 class="fw-bold text-center ">Blog's</h3>

          </div>
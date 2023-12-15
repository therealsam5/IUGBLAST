<?php
session_start();


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home - IUGB</title>
    <link rel="stylesheet" href=" https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../style.css">
    <link rel="icon" href="img\logo\logo.png">
</head>
<body class="body-home">
 <h3>Hi Admin</h3>

 <div class="row no-gutters">
  <div class="col-sm-4 mb-3 mb-sm-0">
    <div class="card">
      <div class="card-body">
        <h5 class="card-title">List of teachers</h5>
        <p class="card-text">View the list of teachers.</p>
        <a href="display_teacher.php" class="btn btn-primary">View</a>
    
      </div>
    </div>
  </div>
  <div class="row no-gutters">
  <div class="col-sm-4 mb-3 mb-sm-0">
    <div class="card">
      <div class="card-body">
        <h5 class="card-title">Assign course to a teacher</h5>
        <p class="card-text">View the list of teachers.</p>
        <a href="assign_course_teacher.php" class="btn btn-primary">View</a>
    
      </div>
    </div>
  </div>
  <a href="admin_home.php" class="text-decoration-none">Go back to homepage</a>
  </div>
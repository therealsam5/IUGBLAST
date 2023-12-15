<?php
session_start();



// Retrieve the student's ID from the session
if (isset($_SESSION['student_id'])) {
    $student_id = $_SESSION['student_id'];

    echo "Student ID: $student_id";

} else {
    echo "Student ID not found in the session.";
}
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
 <h3>Hi Student</h3>

<div class="row no-gutters">
  <div class="col-sm-4 mb-3 mb-sm-0">
    <div class="card">
      <div class="card-body">
        <h5 class="card-title">View All Courses</h5>
        <p class="card-text">View the list of all the courses.</p>
        <a href="view_course.php" class="btn btn-primary">Go to courses</a>
      </div>
    </div>
  </div>
  
  <div class="col-sm-3">
    <div class="card">
      <div class="card-body">
        <h5 class="card-title">My Courses</h5>
        <p class="card-text">View enrolled courses.</p>
        <a href="display_student_course.php" class="btn btn-primary">Go to courses</a>
      </div>
    </div>
    </div>
</div>
<a href="..\..\logout.php" class="text-decoration-none">Log out </a> 

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>


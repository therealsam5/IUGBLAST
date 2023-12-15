<?php
session_start();




// Check if the Teacher is logged in
if (!isset($_SESSION['teacher_id'])) {
    header("Location:../../login.php");
    exit();
}
if (isset($_GET['course_id'])) {
    $course_id = $_GET['course_id'];

    echo "course ID: $course_id";

} else {
    echo "course ID not found in the session.";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Assign a grade- IUGB</title>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
<link rel="icon" href="img\logo\logo.png">
</head>

<body>
    <div class="container">
        <br><br>
        <h3>Assigned Grade</h3>

        <form method="post" action="assign_grade1.php?course_id=<?php echo $course_id; ?>">
    <input type="hidden" name="course_id" value="<?php echo $course_id; ?>">
    <input type="hidden" name="student_id" value="<?php echo $student_id; ?>">

    <div class="text-center"> 
        <img src="" width="">
        <div class="mb-1">
            <label class="form-label">Midterm-Grade</label>
            <input type="int" class="form-control" name="midterm_grade">
        </div>
        
        <div class="mb-3">
            <label class="form-label">Final Grade</label>
            <input type="int" class="form-control" name="final_grade"> 
        </div>
        
        <button type="submit" class="btn btn-primary" name="submit">Confirm</button>
        <a href="teacher_home.php" class="text-decoration-none">Cancel</a>
    </div>
</form>

        
        <br>
        <div class="text-center text-light">
            <> Copyright &copy; 2023 International University of Grand Bassam. All rights reserved.  </>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

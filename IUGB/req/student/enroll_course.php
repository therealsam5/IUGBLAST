<?php
session_start();
include '../../DB_connection.php';

// Check if the Student is logged in
if (!isset($_SESSION['student_id'])) {
    header("Location:../../login.php");
    exit();
  }

$course_id = $_POST['course_id'];
$student_id = $_POST['student_id'];

// Check if the combination already exists
$checkSql = "SELECT * FROM `student_course` WHERE student_id = '$student_id' AND course_id = '$course_id'";
$checkResult = $con->query($checkSql);

if ($checkResult->num_rows > 0) {
    // Combination already exists, return an error message
    echo "Error: Student is already enrolled .";
} else {
    // Insert a new record
    $insertSql = "INSERT INTO `student_course` (student_id, course_id) VALUES ('$student_id', '$course_id')";

    if ($con->query($insertSql) === TRUE) {
        echo "Enrollment successful.";
    } else {
        echo "Error during enrollment: " . $con->error;
    }
}

$con->close();

?>

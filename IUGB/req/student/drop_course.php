<?php
session_start();

include '../../DB_connection.php';

// Check if the Student is logged in
if (!isset($_SESSION['student_id'])) {
    header("Location:../../login.php");
    exit();
  }

$course_id = $_GET['drop_id_1'];
$student_id = $_GET['drop_id_2'];


$sql = "DELETE FROM `student_course` WHERE student_id = '$student_id' AND course_id = '$course_id'";



if ($con->query($sql) === TRUE) {
    echo "Drop successful.";
} else {
    echo "Error during enrollment: " . $con->error;
}

$con->close();

?>

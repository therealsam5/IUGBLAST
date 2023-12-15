<?php
session_start();

include '../../DB_connection.php';

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

// Assuming you have received the form data using POST method
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $course_id = isset($_POST['course_id']) ? $_POST['course_id'] : null;
    $student_id = isset($_POST['student_id']) ? $_POST['student_id'] : null;
    $midterm_grade = isset($_POST['midterm_grade']) ? $_POST['midterm_grade'] : null;
    $final_grade = isset($_POST['final_grade']) ? $_POST['final_grade'] : null;
    

    // Check if the course_id exists in the course table
    $checkStmt = $con->prepare("SELECT course_id FROM `course` WHERE course_id = ?");
    $checkStmt->bind_param("i", $course_id);
    $checkStmt->execute();
    $checkStmt->store_result();

    // If the course_id does not exist, handle the error
    if ($checkStmt->num_rows == 0) {
        echo "Error: The specified course_id does not exist.";
        $checkStmt->close();
        $con->close();
        exit();
    }

    $checkStmt->close();
    // Check if student_id exists in the student table
$checkStudentStmt = $con->prepare("SELECT student_id FROM `student` WHERE student_id = ?");
$checkStudentStmt->bind_param("i", $student_id);
$checkStudentStmt->execute();
$checkStudentStmt->store_result();

// If the student_id does not exist, handle the error
if ($checkStudentStmt->num_rows == 0) {
    echo "Error: The specified student_id does not exist in the student table.";
    $checkStudentStmt->close();
    $con->close();
    exit();
}

$checkStudentStmt->close();

// Insert grades into the student_course table
$insertStmt = $con->prepare("INSERT INTO `student_course` (student_id, course_id, midterm_grade, final_grade) VALUES (?, ?, ?, ?)");

// Check if the prepare() succeeded
if ($insertStmt) {
    $insertStmt->bind_param("iiii", $student_id, $course_id, $midterm_grade, $final_grade);

    // Check if the bind_param succeeded
    if ($insertStmt->execute()) {
        echo "Grades record successful.";
    } else {
        echo "Error inserting grades record: " . $insertStmt->error;
    }

    $insertStmt->close();
} else {
    echo "Error preparing statement: " . $con->error;
}

$insertStmt->close();
}
$con->close();
?>
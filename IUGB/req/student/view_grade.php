<?php
session_start();

// Check if the Student is logged in
if (!isset($_SESSION['student_id'])) {
    header("Location:../../login.php");
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Grade</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link rel="icon" href="img\logo\logo.png">
</head>
<body>

    <br>
    <?php

    // Retrieve the student's ID from the session
    if (isset($_SESSION['student_id'])) {
        $student_id = $_SESSION['student_id'];

        echo "Student ID: $student_id";

    } else {
        echo "Student ID not found in the session.";
    }
    ?>
    <div class="container">
        <h3>View Grade</h3>
    </div>

    <a href="student_home.php" class="text-decoration-none">Go back to homepage</a>

    <table class="table">
        <thead>
            <tr>
                
                <th scope="col">Midterm Grade</th>
                <th scope="col">Final Grade</th>
            </tr>
        </thead>
        <tbody>

            <?php

            // Check if the Student is logged in
            if (!isset($_SESSION['student_id'])) {
                header("Location:../../login.php");
                exit();
            }

            include '../../DB_connection.php';

            $course_id = isset($_POST['course_id']) ? $_POST['course_id'] : '';

            // Check if the course_id is set before using it in the query
            if (!empty($course_id)) {
                // Use prepared statements to prevent SQL injection
                $sql = "SELECT course.course_id, course.course_name, student_course.midterm_grade, student_course.final_grade
                        FROM student_course
                        INNER JOIN course ON student_course.course_id = course.course_id
                        WHERE student_course.student_id = ? AND student_course.course_id = ?";

                $stmt = $con->prepare($sql);
                $stmt->bind_param("ii", $student_id, $course_id);
                $stmt->execute();
                $result = $stmt->get_result();

                if ($result) {
                    // Check if there are rows in the result set
                    if (mysqli_num_rows($result) > 0) {
                        // Output a table with the grades
                        echo '<table class="table">
                                <thead>
                                    <tr>
                                      
                                        <th scope="col">Midterm Grade</th>
                                        <th scope="col">Final Grade</th>
                                    </tr>
                                </thead>
                                <tbody>';

                        // Output data of each row
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo '<tr>
                                    
                                    <td>' . $row['midterm_grade'] . '</td>
                                    <td>' . $row['final_grade'] . '</td>
                                </tr>';
                        }

                        echo '</tbody></table>';
                    } else {
                        echo "No grades available for this course.";
                    }
                } else {
                    echo "Error executing the query: " . $stmt->error;
                }

                $stmt->close();
            } else {
                echo "Error: Course ID not provided.";
            }

            $con->close();
            ?>

        </tbody>
    </table>

    <div class="text-center text-light">
        <> Copyright &copy; 2023 International University of Grand Bassam. All rights reserved.  <>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

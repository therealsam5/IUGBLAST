<?php
session_start();



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Course list</title>
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
        <h3>List of enrolled courses</h3>
    </div>

    <a href="student_home.php" class="text-decoration-none">Go back to homepage</a>

    <table class="table">
        <thead>
        
        <tbody>

            <?php

            // Check if the Student is logged in
            if (!isset($_SESSION['student_id'])) {
                header("Location:../../login.php");
                exit();
            }

            include '../../DB_connection.php';

            $student_id = isset($_SESSION['student_id']) ? $_SESSION['student_id'] : '';

            // Check if the student_id is set before using it in the query
            if (!empty($student_id)) {
                // Use prepared statements to prevent SQL injection
                $sql = "SELECT course.course_id, course.course_name, course.course_description
                        FROM student_course
                        INNER JOIN course ON student_course.course_id = course.course_id
                        WHERE student_course.student_id = ?";

                $stmt = $con->prepare($sql);
                $stmt->bind_param("i", $student_id);
                $stmt->execute();
                $result = $stmt->get_result();

                if ($result) {
                    // Check if there are rows in the result set
                    if (mysqli_num_rows($result) > 0) {
                        // Output a table with the enrolled courses
                        echo '<table class="table">
                                <thead>
                                <tr>
                                <th scope="col">Course ID</th>
                                <th scope="col">Course name</th>
                                <th scope="col">Course Description</th>
                                <th scope="col">Actions</th>
                                </tr>
                                </thead>
                                <tbody>';

                        // Output data of each row
                        while ($row = mysqli_fetch_assoc($result)) {
                          // Initialize $course_name before using it
                $course_id = $row['course_id'];
                            echo '<tr>
                                    <td>' . $row['course_id'] . '</td>
                                    <td>' . $row['course_name'] . '</td>
                                    <td>' . $row['course_description'] . '</td>
                                    
                                    <td>
                                    <a href="view_grade.php" button type="submit" class="btn btn-primary">View Grade</button><button class="btn btn-danger">
                                    </form>
                                    

                                    <a href="drop_course.php? drop_id_1='.$course_id.' & drop_id_2='.$student_id.'" class="text-light">Drop</a></button>
                                </td>
                                </tr>';
                        }

                        echo '</tbody></table>';
                    } else {
                        echo "No enrolled courses.";
                    }
                } else {
                    echo "Error executing the query: " . $stmt->error;
                }

                $stmt->close();
            } else {
                echo "Error: Student ID not provided.";
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

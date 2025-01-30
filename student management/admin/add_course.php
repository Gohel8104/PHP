<?php
// Start session and verify admin login
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'admin') {
    header("Location: ../login.php"); // Redirect to login if not an admin
    exit();
}

// Include database configuration
include '../db_config.php';

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get course name from the form
    $course_name = $_POST['course_name'];

    // Prepare SQL query to insert course into the database
    $sql = "INSERT INTO courses (name) VALUES (?)";
    $stmt = $conn->prepare($sql);

    // Check if prepare() failed
    if ($stmt === false) {
        die("Error preparing query: " . $conn->error);
    }

    // Bind the parameter
    $stmt->bind_param("s", $course_name);

    // Execute the query
    if ($stmt->execute()) {
        echo "Course added successfully!";
    } else {
        echo "Error executing query: " . $stmt->error; // More specific error
    }

    // Close the statement
    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Course</title>
    <link rel="stylesheet" href="../css/style.css"> <!-- Link to your CSS file -->
</head>
<body>
    <h2>Add Course</h2>
    <form method="POST" action="">
        <label for="course_name">Course Name:</label>
        <input type="text" id="course_name" name="course_name" required><br><br>

        <button type="submit">Add Course</button>
    </form>
</body>
</html>

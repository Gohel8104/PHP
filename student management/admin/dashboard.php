<?php
// Start session and verify admin login
session_start();

// Check if the user is logged in and has the role of 'admin'
if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'admin') {
    header("Location: ../login.php"); // Redirect to login if not authorized
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="../css/style.css"> <!-- Link to CSS file -->
</head>
<body>
    <header>
        <h1>Welcome to Admin Dashboard</h1>
        <nav>
        <a href="add_student.php">Add Student</a>
        <a href="add_teacher.php">Add Teacher</a>
        <a href="add_course.php">Add Course</a>
        <a href="assign_teacher.php">Assign Teacher</a>
        <a href="delete_user.php">Delete User</a>
        <a href="logout.php">Log out</a>
        </nav>
    </header>

    <main>
        <section>
            <h2>Overview</h2>
            <p>Manage the student management system effectively here.</p>
        </section>
    </main>

    <footer>
        <p>&copy; 2024 Student Management System</p>
    </footer>
</body>
</html>

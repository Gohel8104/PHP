<?php
// Start session and verify admin login
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'admin') {
    header("Location: ../login.php"); // Redirect to login if not an admin
    exit();
}

// Include database configuration
include '../db_config.php';

// Fetch all teachers and courses
$teachers = $conn->query("SELECT * FROM users WHERE role = 'teacher'");
$courses = $conn->query("SELECT * FROM courses");

// Handle form submission to assign teacher
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $teacher_id = $_POST['teacher_id'];
    $course_id = $_POST['course_id'];

    // Insert teacher-course assignment into the database
    $sql = "INSERT INTO course_assignments (teacher_id, course_id) VALUES (?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ii", $teacher_id, $course_id);

    if ($stmt->execute()) {
        echo "Teacher assigned to course successfully!";
    } else {
        echo "Error: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Assign Teacher to Course</title>
    <link rel="stylesheet" href="../css/style.css"> <!-- Link to your CSS file -->
</head>
<body>
    <h2>Assign Teacher to Course</h2>
    <form method="POST" action="">
        <label for="teacher_id">Select Teacher:</label>
        <select id="teacher_id" name="teacher_id" required>
            <?php while ($teacher = $teachers->fetch_assoc()): ?>
                <option value="<?= $teacher['id']; ?>"><?= $teacher['username']; ?></option>
            <?php endwhile; ?>
        </select><br><br>

        <label for="course_id">Select Course:</label>
        <select id="course_id" name="course_id" required>
            <?php while ($course = $courses->fetch_assoc()): ?>
                <option value="<?= $course['id']; ?>"><?= $course['name']; ?></option>
            <?php endwhile; ?>
        </select><br><br>

        <button type="submit">Assign Teacher</button>
    </form>
</body>
</html>

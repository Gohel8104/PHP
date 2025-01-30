<?php
// Start the session to store user information after login
session_start();

// Include the database configuration file
include 'db_config.php';

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Retrieve the username and password entered by the user
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Query to check if the user exists in the database
    $sql = "SELECT * FROM users WHERE username = ?";
    $stmt = $conn->prepare($sql); // Prepare the SQL statement
    $stmt->bind_param("s", $username); // Bind the username parameter
    $stmt->execute(); // Execute the statement
    $result = $stmt->get_result(); // Get the result

    // Check if a user with the given username exists
    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc(); // Fetch the user data

        // Verify the entered password against the stored hashed password
        if (password_verify($password, $user['password'])) {
            // Set session variables for the logged-in user
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['role'] = $user['role'];

            // Redirect the user based on their role
            if ($user['role'] == 'admin') {
                header("Location: admin/dashboard.php");
            } elseif ($user['role'] == 'teacher') {
                header("Location: teacher/dashboard.php");
            } elseif ($user['role'] == 'student') {
                header("Location: student/dashboard.php");
            }
            exit(); // End the script after redirection
        } else {
            // Display an error message for incorrect password
            echo "Invalid password.";
        }
    } else {
        // Display an error message if the username is not found
        echo "User not found.";
    }
}
?>

<!-- Basic HTML form for login -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="style.css"> <!-- Optional CSS for styling -->
</head>
<body>
    <h2>Login</h2>
    <form method="POST" action="">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required><br><br>
        
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required><br><br>
        
        <button type="submit">Login</button>
    </form>
</body>
</html>

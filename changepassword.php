<!DOCTYPE html>
<html>
<head>
    <title>Change Password</title>
    <link rel="stylesheet" href="pass.css">
</head>
<body>
<div class="navbar">
    <h3 class="navbar-title">
        <i class="fas fa-book"></i>
        RENT-A-READ
    </h3>
        <a href="home.php" class="nav-icon">
            <i class="fas fa-home"></i>
            <span>Home</span>
        </a>
        <a href="borrow.php" class="nav-icon">
            <i class="fas fa-hand-holding"></i>
            <span>Borrow</span>
        </a>
        <a href="Returnn.php" class="nav-icon">
            <i class="fas fa-undo-alt"></i>
            <span>Return</span>
        </a>
        <a href="profile.php" class="nav-icon">
            <i class="fas fa-user"></i>
            <span>Profile</span>
        </a>
        <a href="login.php" class="nav-icon">
            <i class="fas fa-sign-in-alt"></i>
            <span>Log Out</span>
        </a>    
    </div>
    <h2>Change Password</h2>
    <form action="changepassword.php" method="post">
        <label>Current Password:</label>
        <input type="password" name="current_password" required><br>
        <label>New Password:</label>
        <input type="password" name="new_password" required><br>
        <label>Confirm New Password:</label>
        <input type="password" name="confirm_password" required><br>
        <input type="submit" value="Change Password">
    </form>
    <br>
    
</body>
</html>
<?php
session_start();

if (!isset($_SESSION['email'])) {
    header("Location: home.php");
    exit();
}

// Replace with your actual database connection details
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "bookdb";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Process password change
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["current_password"]) && isset($_POST["new_password"]) && isset($_POST["confirm_password"])) {
        $current_password = $_POST["current_password"];
        $new_password = $_POST["new_password"];
        $confirm_password = $_POST["confirm_password"];

        // Sanitize the inputs (you can use better sanitization methods)
        $current_password = $conn->real_escape_string($current_password);
        $new_password = $conn->real_escape_string($new_password);
        $confirm_password = $conn->real_escape_string($confirm_password);

        // Retrieve the user's email from the session
        $email = $_SESSION['email'];

        // Query to check if the current password matches the user's stored password
        $sql = "SELECT email FROM users WHERE email='$email' AND password='$current_password'";
        $result = $conn->query($sql);

        if ($result->num_rows == 1) {
            // Current password is correct, now check if the new password and confirmation match
            if ($new_password === $confirm_password) {
                // Update the user's password in the database
                $update_sql = "UPDATE users SET password='$new_password' WHERE email='$email'";
                if ($conn->query($update_sql) === TRUE) {
                    echo '<div class="message">Password updated successfully.</div>';
                } else {
                    echo '<div class="error">Error updating password: ' . $conn->error . '</div>';
                }
            } else {
                echo '<div class="error">New password and confirmation password do not match.</div>';
            }
        } else {
            echo '<div class="error">Invalid current password. Please try again.</div>';
        }
    }
}

$conn->close();
?>
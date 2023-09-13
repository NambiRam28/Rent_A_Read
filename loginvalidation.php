<?php
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


// Process login
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    if (isset($_POST["email"]) && isset($_POST["password"])) {
        $email = $_POST["email"];
        $password = $_POST["password"];

        // Sanitize the inputs (you can use better sanitization methods)
        $email = $conn->real_escape_string($email);
        $password = $conn->real_escape_string($password);

        // Query to check if the email and password match
        $sql = "SELECT email FROM users WHERE email='$email' AND password='$password'";
        $result = $conn->query($sql);
       if($email=='admin@nec.edu.in' && $password=='admin@123')
       {
        header("Location: admin.php");
       }
      else{
        if ($result->num_rows == 1) {
            // Login successful, set the session variable and redirect to index.php
            session_start();
            $_SESSION['email'] = $email;
            
            header("Location: home.php");
            exit();
        } else {
            // Login failed, display an error message
            echo "Invalid email or password.";
        }
    }
    
    }
}


$conn->close();
?>

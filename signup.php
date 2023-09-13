<?php


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    $username = $_POST['username'];
    $userEmail = $_POST['email'];
    $department = $_POST['department'];
    $randomPassword = $_POST['randomPassword'];

    $dbHost = 'localhost';
    $dbUser = 'root';
    $dbPassword = '';
    $dbName = 'bookdb';

    $conn = new mysqli($dbHost, $dbUser, $dbPassword, $dbName);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    
    $sql = "INSERT INTO users (Username, email, password, Department) VALUES ('$username', '$userEmail', '$randomPassword', '$department')";

    if ($conn->query($sql) === TRUE) {
    
        echo "Data inserted successfully!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
    $conn->close();
}

?>

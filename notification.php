<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notifications</title>
    <link rel="stylesheet" href="notification.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
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
    <a href="profile.php" class="nav-icon">
        <i class="fas fa-user"></i>
        <span>Profile</span>
    </a>
    <a href="notification.php" class="nav-icon">
        <i class="fas fa-bell"></i>
        <span>Notifications</span>
    </a>
    <a href="logout.php" class="nav-icon">
        <i class="fas fa-sign-in-alt"></i>
        <span>Log Out</span>
    </a>
</div>
<div class="container">
    <h2>Notifications</h2>
    <?php
    $dbHost = 'localhost';
    $dbUser = 'root';
    $dbPassword = '';
    $dbName = 'bookdb';

    $conn = new mysqli($dbHost, $dbUser, $dbPassword, $dbName);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    session_start();

    $userEmail = $_SESSION['email']; // Replace this with the actual user's email

    // Fetch notifications for the logged-in user's email from the database
    $sql = "SELECT email, bookids_list FROM borrow WHERE email = '$userEmail'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $userEmail = $row['email'];
            $bookIdsList = $row['bookids_list'];
            $bookIds = explode(',', $bookIdsList);

            // Display the fetched data
            echo "<p><b>$userEmail</b>
             accepted bookids are </p>";
            foreach ($bookIds as $bookId) {
                echo "<li>Book ID: $bookId</li>";
            }
            // echo "<hr>";
        }
    } else {
        echo "No notifications found.";
    }

    $conn->close();
    ?>
</div>
</body>
</html>

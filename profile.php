
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
    <link rel="stylesheet" href="profile.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
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
        <a href="Notification.php" class="nav-icon">
           <i class="fas fa-bell"></i>
           <span>Notifications</span>
       </a>
        <a href="logout.php" class="nav-icon">
            <i class="fas fa-sign-in-alt"></i>
            <span>Log Out</span>
        </a>
    </div>
    <div class="container">
   
        <div class="profile-icon">
            <i class="fas fa-user-circle"></i>
        </div>
        <div class="profile-info">
            <h2>User Profile</h2>
           
            <?php
            $dbHost = 'localhost';
            $dbUser = 'root';
            $dbPassword = '';
            $dbName = 'bookdb';

            $conn = new mysqli($dbHost, $dbUser, $dbPassword, $dbName);

            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            // Assuming the user's ID is available in the session or as a parameter
            // Change 'user_id' to the actual column name representing the user's unique identifier
            $userId = 1; // Replace this with the actual user's ID

            // Fetch user data from the database
            $sql = "SELECT Username, email, Department FROM users";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                $username = $row['Username'];
                $userEmail = $row['email'];
                $department = $row['Department'];

                // Display the fetched data
                echo "<p><b>Name:</b>$username</p><br>";
                
                echo "<p><b>Email:</b>$userEmail</p><br>";
                echo "<p><b>Department:</b>$department</p>";
            } else {
                echo "User not found.";
            }

            $conn->close();
            ?>
        </div>
    </div>
    <a href="changepassword.php" class="change-password-link">Change Password</a>

    <!-- <a href="changepassword.php">Change Password </a> -->
</body>
</html>
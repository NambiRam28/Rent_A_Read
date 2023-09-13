<?php

session_start();

if (isset($_SESSION['email'])) {
    
    $email = $_SESSION['email'];
   
    $welcome_message = "Welcome " . $email;

    $host = "localhost";
    $user = "root";
    $pass = "";
    $db = "bookdb";
    $tablename = "book";
    $conn = new mysqli($host, $user, $pass, $db);
    $books_query = "SELECT * FROM book"; 
    $books_result = mysqli_query($conn, $books_query);
    $books = mysqli_fetch_all($books_result, MYSQLI_ASSOC);
?>

<!-- Your HTML and CSS code -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="home.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <title>Home</title>
</head>
<body>
    <div class="navbar">
    <h3 class="navbar-title">
        <i class="fas fa-book"></i>
        RENT-A-READ
    </h3>
        <header>
        <!-- Add your header content here -->
        <h1 style="color: white;font-family:cursive; font-size: 20px;left:10px;position:relative;"><?php echo $welcome_message; ?></h1>
    </header>
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
        <a href="graph.php" class="nav-icon">
        <i class="bi bi-graph-up"></i>
            <span>Graph</span>
        </a>
        <a href="logout.php" class="nav-icon">
            <i class="fas fa-sign-in-alt"></i>
            <span>Log Out</span>
        </a>
       
        
    </div>
    <div class="waviy">
   <span style="--i:1">T</span>
   <span style="--i:2">o</span>
   <span style="--i:3"> </span>
   <span style="--i:4">S</span>
   <span style="--i:5">U</span>
   <span style="--i:6">C</span>
   <span style="--i:7">C</span>
   <span style="--i:8">E</span>
   <span style="--i:9">E</span>
   <span style="--i:10">D</span>
   <span style="--i:11"> </span>
   <span style="--i:12">Y</span>
   <span style="--i:13">O</span>
   <span style="--i:14">U</span>
   <span style="--i:15"> </span>
   <span style="--i:16">M</span>
   <span style="--i:17">U</span>
   <span style="--i:18">S</span>
   <span style="--i:19">T</span>
   <span style="--i:20"> </span>
   <span style="--i:21">R</span>
   <span style="--i:22">E</span>
   <span style="--i:23">A</span>
   <span style="--i:24">D</span>
   <span style="--i:25">.</span>
   <span style="--i:26">.</span>
   <span style="--i:27">.</span>
  </div>
</body>
    <div class="container">
        <h1>RENT-A-READ</h1>
        <p><b>Welcome to Rent-A-Read!</b>Discover a world of captivating stories with our flexible book rental service. Explore diverse genres, enjoy personalized recommendations, and read anytime, anywhere. 
            Join our book community and embrace eco-friendly reading. Start your literary journey today!</p>
        <p><b>Literary Adventures:</b>Dive into our extensive collection of books from various genres. Whether you seek thrilling mysteries, 
        heartwarming romances, or mind-bending sci-fi, we have the perfect read for you.</p>
        <p><b>Convenience at Your Fingertips:</b>Browse, rent, and return books online from the comfort of your home. 
            Experience a hassle-free reading journey with our user-friendly platform.</p>
        <P>Eco-Friendly Reading: Embrace sustainable reading practices. Rent-A-Read promotes reducing paper waste while fostering a love for literature.
            <br><br><b>Start your reading adventure today and unlock a world of captivating stories with Rent-A-Read!</b></P>   
    </div>

    <main>
    // JavaScript for sliding quotes
    <script>
        const quotes = document.querySelectorAll('.quote');
        let index = 0;

        function showNextQuote() {
            quotes.forEach((quote) => quote.classList.remove('slide'));
            quotes[index].classList.add('slide');
            index = (index + 1) % quotes.length;
        }

        // Show the first quote initially
        showNextQuote();

        // Change quote every 5 seconds
        setInterval(showNextQuote, 5000);
    </script>
    </main>
</body>
</html>

<?php
} else {
    // If the user is not logged in, redirect them to the login page
    header("Location: login.php");
    exit();
}
?>
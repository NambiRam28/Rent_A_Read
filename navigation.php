<?php
session_start();
// ... Rest of your PHP code ...

// Echo the email as a JavaScript variable
echo '<script>var userEmail = "' . $_SESSION["email"] . '";</script>';
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Books</title>
  <link rel="stylesheet" href="navigate.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <link rel="stylesheet" href="navcards.css">
  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
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
        <a href="logout.php" class="nav-icon">
            <i class="fas fa-sign-in-alt"></i>
            <span>Log Out</span>
        </a>
    </div>
  <header>
    <h1>Books Added</h1>
    <div class="search-bar">
      <input type="text" id="searchInput" placeholder="Search books by title, author, or genre">
      <button id="searchButton">Search</button>
    </div>
  </header>

  <main>
  <div class="book-list" id="book-list">
        </div>
  </main>

  <footer>
  <!-- <input type="email" id="userEmail" placeholder="Your Email"> -->
  <button id="borrowButton" class="button">Borrow</button>
</footer>


  <script src="navigate.js"></script>
  
  
</body>
</html>



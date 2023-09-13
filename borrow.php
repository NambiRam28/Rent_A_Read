<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Borrow Books</title>
    <script src="borrowscript.js"></script>
    <link rel="stylesheet" href="borrow.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
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
    <header>
        <h1>Borrow Books</h1>
        <div class="search-bar">
            <input type="text" id="searchInput" placeholder="Search books">
            <button type="submit" id="searchButton" onclick="getBooks()">Search</button>
        </div>
    </header>
    <div class="addtocart">
        <button class="add-to-cart" id="addToCartButton" onclick="addToCart()">Add to Cart</button>
    </div>
    <main>
        <div class="book-list" id="book-list">
        </div>
        
    </main>

    <footer>
    <div id="pagination">
        <!-- Pagination content goes here -->
    </div><br>
   </footer>
</body>

</html>
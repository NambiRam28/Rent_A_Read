<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Books</title>
  <link rel="stylesheet" href="Returnn.css">
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
        <a href="Returnn.php" class="nav-icon">
            <i class="fas fa-undo-alt"></i>
            <span>Return</span>
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
    <h1>Accepted Books</h1>
  </header>

  <main>
    <div class="book-list">
    <ul>
        <?php
        session_start();
        // Check if the user is logged in and the email is set in the session
        if (isset($_SESSION['email'])) {
          $email = $_SESSION['email'];

          // Connect to the database (replace these values with your database credentials)
          $servername = "localhost";
          $user = "root";
          $password = "";
          $dbname = "bookdb";

          // Create a database connection
          $conn = new mysqli($servername, $user, $password, $dbname);

          // Check connection
          if ($conn->connect_error) {
              die("Connection failed: " . $conn->connect_error);
          }

          // Fetch the borrowed book records for the logged-in user
          $sql = "SELECT * FROM borrow WHERE email='$email'";
          $result = $conn->query($sql);

          if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
              // Get the bookids_list and convert it into an array of book IDs
              $bookids = explode(",", $row['bookids_list']);

              // Fetch the book details for each book ID
              foreach ($bookids as $bookid) {
                $sql_book = "SELECT * FROM book WHERE Bookid='$bookid'";
                $result_book = $conn->query($sql_book);

                if ($result_book->num_rows > 0) {
                  $book = $result_book->fetch_assoc();
                  // $due_date = $row['Due_Date'];
                  // // Display the book details
                  // echo "<li>";
                  // echo "<input type='checkbox' name='selectedBooks[]' value='" . $book['Bookid'] . "' " . ($book['Available_Copies'] == 0 ? 'disabled' : '') . ">";
                  // echo "<div class='book-info'>";      
                  // echo "<h3>" . $book['Book_Name'] . "</h3>";
                  // echo "<p>Author: " . $book['Author'] . "</p>";
                  // // echo "<p>Description: " . $book['Description'] . "</p>";
                  // echo "<p>Book ID: " . $book['Bookid'] . "</p>";
                  // echo "<p>Available_copies: " . $book['Available_Copies'] . "</p>";

                  // echo "<p>Due Date: " . $due_date . "</p>";
                  // // echo "<p class='book-due-date'>Due Date: " . $due_date . "</p>";


                  // echo "<hr>";
                  // echo "</li>";
                  echo "<div class='book-card'>";

echo "<div class='book-info'>";
echo "<h3>" . $book['Book_Name'] . "</h3>";
echo "<p>Author: " . $book['Author'] . "</p>";
// echo "<p>Description: " . $book['Description'] . "</p>";
echo "<p>Book ID: " . $book['Bookid'] . "</p>";
echo "<p>Available Copies: " . $book['Available_Copies'] . "</p>";


echo "</div>";
echo "</div>";

                }
                $sql_due_date = "SELECT Due_Date FROM borrow WHERE bookids_list LIKE '%{$book['Bookid']}%'";
$result_due_date = $conn->query($sql_due_date);
if ($result_due_date->num_rows > 0) {
  $due_date_row = $result_due_date->fetch_assoc();
  $due_date = $due_date_row['Due_Date'];
  echo "<p class='book-due-date'>THE BOOKS ARE BORROWED<br>Due Date: " . $due_date . "</p>";
}
              }
            }
          } else {
            echo "<p>No borrowed books found for this user.</p>";
          }

          // Close the database connection
          $conn->close();
        }
        ?>
      </ul>
    
    </div>
  </main>

  <!-- <footer>
    <div class="dropdown">
      <button class="dropdown-button">Drop_Books</button>
    </div>
  </footer> -->
  
</body>
</html>

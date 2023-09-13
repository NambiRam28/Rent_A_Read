<?php
// accept_books.php

// Function to fetch book information based on book IDs
function getBooksInfoFromBookTable($bookIds) {
  $host = 'localhost';
  $username = 'root';
  $password = '';
  $dbname = 'bookdb';

  $conn = new mysqli($host, $username, $password, $dbname);

  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }

  // Create a comma-separated string of book IDs to use in the SQL query
  $bookIdsString = implode(",", $bookIds);

  // Fetch book information from the book table for the given book IDs
  $sql = "SELECT * FROM book WHERE id IN ($bookIdsString)";
  $result = $conn->query($sql);

  $booksInfo = array();
  if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
      $booksInfo[] = $row;
    }
  }

  $conn->close();
  return $booksInfo;
}

// If the admin accepts the borrow requests, handle it here
if (isset($_GET['accept_requests'])) {
  // Assuming you have some logic to handle the acceptance of requests, for example, changing the status in the database or performing other actions

  // Retrieve the book IDs from the temporary_requests table
  $host = 'localhost';
  $username = 'root';
  $password = '';
  $dbname = 'bookdb';

  $conn = new mysqli($host, $username, $password, $dbname);

  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }

  $sql = "SELECT book_ids FROM temporary_requests";
  $result = $conn->query($sql);

  $bookIds = array();
  if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
      $bookIds[] = explode(",", $row['book_ids']);
    }
  }

  $conn->close();
  
  // Get the book information for the accepted requests from the book table
  $booksInfo = getBooksInfoFromBookTable($bookIds);
  header('Content-Type: application/json');
  echo json_encode($booksInfo);
  // Display the book information
  if (!empty($booksInfo)) {
    // Display the book information in a tabular format
    echo "<h2>Accepted Books Information</h2>";
    echo "<table>";
    echo "<tr><th>Book Name</th><th>Description</th><th>Author</th></tr>";
    foreach ($booksInfo as $book) {
      echo "<tr><td>".$book['Book_Name']."</td><td>".$book['Description']."</td><td>".$book['Author']."</td></tr>";
    }
    echo "</table>";
  } else {
    echo "<p>No books found for accepted requests.</p>";
  }
}
?>

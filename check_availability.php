<?php
// Assuming you have already established the database connection
$mysqli = new mysqli('localhost', 'root', '', 'bookdb');

// Check connection
if ($mysqli->connect_errno) {
  die("Database connection failed: " . $mysqli->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] === "GET") {
  if (isset($_GET["book-ids"]) && is_numeric($_GET["book-ids"])) {
    $bookId = $_GET["book-ids"];

    // Prepare and execute the query
    $stmt = $mysqli->prepare("SELECT Available_Copies FROM book WHERE Bookid = ?");
    $stmt->bind_param("i", $bookId);
    $stmt->execute();
    $stmt->bind_result($availableCopies);
    $stmt->fetch();
    $stmt->close();

    // Check if the book is available
    $isAvailable = ($availableCopies > 0);

    // Return the response as JSON
    header('Content-Type: application/json');
    echo json_encode(array('available' => $isAvailable));
    exit;
  }
}

// Close the database connection
$mysqli->close();
?>
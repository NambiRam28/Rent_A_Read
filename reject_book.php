<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $bookId = $_POST['bookId'];
  $email = $_POST['email'];

  $host = 'localhost';
  $username = 'root';
  $password = '';
  $dbname = 'bookdb';

  $conn = new mysqli($host, $username, $password, $dbname);

  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }

  // Check if the bookId exists in the temporary_requests table
  $checkStmt = $conn->prepare("SELECT count, book_ids FROM temporary_requests WHERE user_email = ?");
  $checkStmt->bind_param("s", $email);
  $checkStmt->execute();
  $checkStmt->bind_result($existingCount, $selectedBookIds);
  $checkStmt->fetch();
  $checkStmt->close();

  if ($existingCount !== null && $selectedBookIds !== null) {
    // Remove the specified bookId from the list of selected book IDs for the user
    $bookIdsArray = explode(",", $selectedBookIds);
    $updatedBookIds = array_diff($bookIdsArray, [$bookId]);

    // Calculate the updated count
    $updatedCount = count($updatedBookIds);

    // Create a comma-separated string of book IDs
    $updatedBookIdsString = implode(",", $updatedBookIds);

    // Update the temporary_requests table with the new count and updated book IDs
    $updateStmt = $conn->prepare("UPDATE temporary_requests SET count = ?, book_ids = ? WHERE user_email = ?");
    $updateStmt->bind_param("iss", $updatedCount, $updatedBookIdsString, $email);
    $updateStmt->execute();
    $updateStmt->close();

    // Return a success response
    header('Content-Type: application/json');
    echo json_encode(['success' => true]);
  } else {
    // Return an error response
    header('Content-Type: application/json');
    echo json_encode(['error' => 'Failed to reject the request.']);
  }

  // Close the database connection
  $conn->close();
}
?>

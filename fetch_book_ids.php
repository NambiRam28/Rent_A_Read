<?php
session_start();

// Check if the user's email is available in the session
if (isset($_SESSION['user_email'])) {
    $userEmail = $_SESSION['user_email'];

    // Assuming you have already established the database connection
    $mysqli = new mysqli('localhost', 'root', '', 'bookdb');

    // Check connection
    if ($mysqli->connect_errno) {
        die("Database connection failed: " . $mysqli->connect_error);
    }

    // Sanitize the email before using it in the query to prevent SQL injection
    $email = $mysqli->real_escape_string($userEmail);

    // Fetch book IDs and their corresponding information from the temporary_requests and book tables
    $query = "SELECT t.book_ids, b.Author, b.Description, b.Book_Name, b.Available_Copies
              FROM temporary_requests t
              JOIN book b ON FIND_IN_SET(b.Bookid, t.book_ids) > 0
              WHERE t.email = '$email'";
    
    $result = $mysqli->query($query);

    if (!$result) {
        die("Error executing the query: " . $mysqli->error);
    }

    // Prepare an array to store the book data
    $booksData = array();

    while ($row = $result->fetch_assoc()) {
        // Split book IDs into an array
        $bookIds = explode(",", $row['book_ids']);

        // Process each book ID and its corresponding information
        foreach ($bookIds as $bookId) {
            if (!empty(trim($bookId))) {
                // Use the book ID as the key in the $booksData array
                // Add the book details only if the key doesn't exist
                if (!isset($booksData[$bookId])) {
                    $bookData = array(
                        "Bookid" => (int)$bookId,
                        "Author" => $row['Author'],
                        "Description" => $row['Description'],
                        "Book_Name" => $row['Book_Name'],
                        "Available_Copies" => (int)$row['Available_Copies']
                    );
                    $booksData[$bookId] = $bookData;
                }
            }
        }
    }

    // Close the database connection
    $mysqli->close();

    // Convert the array to JSON and send it as the response
    header('Content-Type: application/json');

    if (empty($booksData)) {
        die(json_encode(array("error" => "No data found.")));
    } else {
        echo json_encode(array_values($booksData));
    }
} else {
    // Handle the case when the user's email is not available in the session
    // Redirect or display an error message, etc.
}
?>

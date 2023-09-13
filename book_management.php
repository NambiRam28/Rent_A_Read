<?php
// Include your database connection file (adjust the credentials as needed)
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "bookdb";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle form submissions
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_POST["add-book"])) {
        // Add book record
        $bookName = $_POST["book-name"];
        $author = $_POST["author"];
        $description = $_POST["description"];
        $availableCopies = $_POST["available-copies"];

        // Implement your logic to insert the new book record into the "book" table
        $sql = "INSERT INTO book (Book_Name, Author, Description, Available_copies) VALUES ('$bookName', '$author', '$description', '$availableCopies')";
        if ($conn->query($sql) === TRUE) {
            echo "<script>alert('Book added successfully.');</script>";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
        
    } elseif (isset($_POST["delete-book"])) {
       // Delete book record
        $bookName = $_POST["book-name"];

          // Implement your logic to delete the book record from the "book" table based on the book name
$sql = "DELETE FROM book WHERE Book_Name = '$bookName'";
if ($conn->query($sql) === TRUE) {
    echo "<script>alert('Book deleted successfully.');</script>";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

    } elseif (isset($_POST["update-book"])) {
        // Update book record
$bookName = $_POST["book-name"];
$author = $_POST["author"];
$description = $_POST["description"];
$availableCopies = $_POST["available-copies"];

// Implement your logic to update the book record in the "book" table based on the book name
$sql = "UPDATE book SET Author = '$author', Description = '$description', Available_copies = '$availableCopies' WHERE Book_Name = '$bookName'";
if ($conn->query($sql) === TRUE) {
    echo "<script>alert('Book updated successfully.');</script>";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

    }
}
?>

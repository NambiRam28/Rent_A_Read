<?php
$host = "localhost";
$user = "root";
$pass = "";
$db = "bookdb";
$tablename = "book";
$book_data = array();

$conn = new mysqli($host, $user, $pass, $db);

$search = $conn->real_escape_string($_POST["searchInput"]);
$page = isset($_POST["page"]) ? intval($_POST["page"]) : 1;
$perPage = isset($_POST["perPage"]) ? intval($_POST["perPage"]) : 10;

$query = "SELECT * FROM book WHERE Book_Name LIKE '%" . $search . "%'
          OR Author LIKE '%" . $search . "%'
          OR Bookid LIKE '%" . $search . "%'";

$result = $conn->query($query);
$totalBooks = $result->num_rows;

$query .= " LIMIT " . ($page - 1) * $perPage . ", " . $perPage;
$result = $conn->query($query);

if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $book_data[] = array(
            'Book_Name' => $row['Book_Name'],
            'Author' => $row['Author'],
            'Description' => $row['Description'],
            'Available_Copies' => $row['Available_Copies'],
            'Bookid' => $row['Bookid'],  
        );
    }
}

$response = array(
    'total' => $totalBooks,
    'books' => $book_data
);

echo json_encode($response);
?>
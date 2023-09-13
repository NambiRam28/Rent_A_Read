<?php
$host = "localhost";
$user = "root";
$pass = "";
$db = "bookdb";
$tablename = "book";
$search = $_POST["searchInput"];
// $selectedIds = json_decode($_POST["selectedId"]); 

$book_data = array();

$conn = new mysqli($host, $user, $pass, $db);

$bookIds = implode(',', $search);


$query = "SELECT * FROM book WHERE Bookid IN ($bookIds)";
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

$conn->close();




// $placeholders = implode(',', array_fill(0, count($selectedIds), '?'));
// $query = "SELECT * FROM book WHERE Bookid IN ($placeholders) AND Book_Name LIKE ?";

// $stmt = $conn->prepare($query);

// $searchInput = '%' . $search . '%';
// $stmt->bind_param('s', $searchInput);
// $stmt->bind_param(str_repeat('i', count($selectedIds)), ...$selectedIds);
// $stmt->execute();
// $result = $stmt->get_result();

// if ($result && $result->num_rows > 0) {
//     while ($row = $result->fetch_assoc()) {
//         $book_data[] = array(
//             'Book_Name' => $row['Book_Name'],
//             'Author' => $row['Author'],
//             'Description' => $row['Description'],
//             'Available_Copies' => $row['Available_Copies'],
//             'Bookid' => $row['Bookid'],
//         );
//     }
// }

// $stmt->close();
// $conn->close();

echo json_encode($book_data);
?>

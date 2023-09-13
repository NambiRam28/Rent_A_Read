<?
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $bookIds = $_POST['bookIds']; 
  $userEmail = $_POST['userEmail'];

  $host = 'localhost';
  $username = 'root';
  $password = '';
  $dbname = 'bookdb';

  $conn = new mysqli($host, $username, $password, $dbname);

  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }

  // Insert the data into the temporary_requests table
  $sql = "INSERT INTO dup_temporary_requests (user_email, book_ids) VALUES ('$userEmail', '" . implode(",", $bookIds) . "')";
  if ($conn->query($sql) === TRUE) {
    // Return a success response
    header('Content-Type: application/json');
    echo json_encode(['success' => true]);
  } else {
    // Return an error response
    header('Content-Type: application/json');
    echo json_encode(['error' => 'Failed to store the request.']);
  }

  // Close the database connection
  $conn->close();
}


// if ($_SERVER['REQUEST_METHOD'] === 'GET') {
//   $host = 'localhost';
//   $username = 'root';
//   $password = '';
//   $dbname = 'bookdb';

//   $conn = new mysqli($host, $username, $password, $dbname);

//   if ($conn->connect_error) {
//     die("Connection failed: " . $conn->connect_error);
//   }

//   // Fetch the requests from the temporary_requests table
//   $sql = "SELECT * FROM temporary_requests";
//   $result = $conn->query($sql);

//   if ($result->num_rows > 0) {
//     $requests = array();
//     while ($row = $result->fetch_assoc()) {
//       $requests[] = $row;
//     }

//     // Return the requests as a JSON response
//     header('Content-Type: application/json');
//     echo json_encode($requests);
//   } else {
//     // Return an empty array if no requests found
//     header('Content-Type: application/json');
//     echo json_encode(array());
//   }

//   // Close the database connection
//   $conn->close();
// }


?>

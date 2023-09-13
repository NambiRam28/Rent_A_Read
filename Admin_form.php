<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Library Form</title>
  <link rel="stylesheet" href="admin_form.css">
</head>

<body>
  <div class="form-container">
    <div class="card">
      <h2>Library Form</h2>
      <form method="post">
        <div class="form-group">
          <label for="username">Username:</label>
          <input type="text" id="username" name="username" required>
        </div>
        <div class="form-group">
          <label for="email">Email:</label>
          <input type="email" id="email" name="email" required>
        </div>
        <div class="form-group">
          <label for="department">Department:</label>
          <input type="text" id="department" name="department" required>
        </div>
        <div class="form-group">
          <label for="bookids">Book IDs:</label>
          <input type="text" id="bookids" name="bookids" required>
        </div>
        <div class="button-group">
          <button type="submit" name="borrow" class="btn btn-borrow">Borrow</button>
          <button type="submit" name="return" class="btn btn-return">Return</button>
        </div>
      </form>
    </div>
  </div>

<?php
if (isset($_POST['borrow'])) {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $department = $_POST['department'];
    $bookids = $_POST['bookids'];
    $issuedDateTime = date('Y-m-d H:i:s');
    $dueDateTime = date('Y-m-d H:i:s', strtotime('+14 days'));

    // Validate the data (you can add more validation if needed)
    if (empty($username) || empty($email) || empty($department) || empty($bookids)) {
        echo "Please fill in all the fields.";
    } else {
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
        $input_bookids_array = explode(",", $bookids);

        // Check if all the book IDs in the input are present in the temporary_requests table
        $sql_check_bookids = "SELECT COUNT(*) as count FROM temporary_requests WHERE FIND_IN_SET(book_ids, '$bookids')";
        $result = $conn->query($sql_check_bookids);
    
        // Check if the email and bookids are present in the temporary_requests table
        // $sql = "SELECT * FROM temporary_requests WHERE user_email='$email' AND book_ids='$bookids'";
        // $result = $conn->query($sql);
        $updated_count = 0;
        if ($result === false) {
            echo "Error executing the SQL query: " . $conn->error;
        } else {
            if ($result->num_rows > 0) {
                // Check if the combination of Username, email, and bookids_list exists in the borrow table
                $sql_check = "SELECT * FROM borrow WHERE Username='$username' AND email='$email'";
                $result_check = $conn->query($sql_check);

                if ($result_check->num_rows > 0) {
                    // If the combination exists, fetch the existing row
                    $row = $result_check->fetch_assoc();
                    $existing_bookids = $row['bookids_list'];

                    // Concatenate the existing book IDs and the new book ID
                    $updated_bookids = $existing_bookids . "," . $bookids;

                    // Calculate the length of the bookids_list
                    $bookids_list_array = explode(",", $updated_bookids);
                    $updated_count = count($bookids_list_array);
                    // Update the row with the new book IDs and count
                    $sql_update = "UPDATE borrow SET bookids_list='$updated_bookids', Count='$updated_count' WHERE Username='$username' AND email='$email'";
                    if ($conn->query($sql_update) === TRUE) {
                        // Book IDs ($bookids) borrowed successfully. Update Available_Copies in the book table.
                        $sql_update_copies = "UPDATE book SET Available_Copies = Available_Copies - 1 WHERE Bookid IN ($bookids)";
                        if ($conn->query($sql_update_copies) === TRUE) {
                            echo "<script>alert('Book IDs ($bookids) borrowed successfully.');</script>";
                        } else {
                            echo "Error updating Available_Copies: " . $conn->error;
                        }
                    } else {
                        echo "Error: " . $sql_update . "<br>" . $conn->error;
                    }
                } else {
                    $bookids_list_array = explode(",", $bookids);
                    $updated_count = count($bookids_list_array);
                    $status = "accepted";

                    $sql_insert = "INSERT INTO borrow (Username, email, Department, bookids_list, issued_Date, Due_Date, Count, status)
                                  VALUES ('$username', '$email', '$department', '$bookids', '$issuedDateTime', '$dueDateTime', '$updated_count', '$status')";
                    if ($conn->query($sql_insert) === TRUE) {
                        // Book IDs ($bookids) borrowed successfully. Update Available_Copies in the book table.
                        $sql_update_copies = "UPDATE book SET Available_Copies = Available_Copies - 1 WHERE Bookid IN ($bookids)";
                        if ($conn->query($sql_update_copies) === TRUE) {
                            echo "<script>alert('Book IDs ($bookids) borrowed successfully.');</script>";
                        } else {
                            echo "Error updating Available_Copies: " . $conn->error;
                        }
                    } else {
                        echo "Error: " . $sql_insert . "<br>" . $conn->error;
                    }
                }
            } else {
                echo "<script>alert('The book with ID $bookids is not available for borrowing or the email is incorrect.');</script>";
            }
        }

        // Close the database connection
        $conn->close();
    }
}
if (isset($_POST['return'])) {
  $username = $_POST['username'];
  $email = $_POST['email'];
  $returned_bookids = $_POST['bookids'];
  echo $returned_bookids;

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

  // Check if the books are borrowed by the user
  $sql_check = "SELECT * FROM borrow WHERE Username='$username' AND email='$email' AND FIND_IN_SET(bookids_list, '$returned_bookids')";
  $result_check = $conn->query($sql_check);

  if ($result_check->num_rows > 0) {
      // Book(s) is/are borrowed by the user. Remove the book entries from the borrow table.
      $sql_return = "DELETE FROM borrow WHERE Username='$username' AND email='$email' AND FIND_IN_SET(bookids_list, '$returned_bookids')";
      if ($conn->query($sql_return) === TRUE) {
          // Books returned successfully. Update Available_Copies in the book table.
          $returned_bookids_array = explode(",", $returned_bookids);
          foreach ($returned_bookids_array as $bookid) {
              $sql_update_copies = "UPDATE book SET Available_Copies = Available_Copies + 1 WHERE Bookid = $bookid";
              if ($conn->query($sql_update_copies) !== TRUE) {
                  echo "Error updating Available_Copies for book with ID $bookid: " . $conn->error;
              }
          }

          // Check if all book IDs are returned by the user
          $sql_remaining_bookids = "SELECT COUNT(*) as count FROM borrow WHERE Username='$username' AND email='$email'";
          $result_remaining_bookids = $conn->query($sql_remaining_bookids);
          $remaining_bookids_row = $result_remaining_bookids->fetch_assoc();
          $remaining_bookids_count = $remaining_bookids_row['count'];

          if ($remaining_bookids_count === 0) {
              // If all book IDs are returned, delete the row from the borrow table
              $sql_delete_user_row = "DELETE FROM borrow WHERE Username='$username' AND email='$email'";
              if ($conn->query($sql_delete_user_row) !== TRUE) {
                  echo "Error deleting the user row: " . $conn->error;
              }
          }

          // Remove the returned book IDs from the temporary_requests table
          $sql_delete_temporary_requests = "DELETE FROM temporary_requests WHERE FIND_IN_SET(book_ids, '$returned_bookids') AND user_email='$email'";
          if ($conn->query($sql_delete_temporary_requests) !== TRUE) {
              echo "Error deleting book IDs from temporary_requests: " . $conn->error;
          }

          echo "<script>alert('Book(s) with ID $returned_bookids returned successfully.');</script>";
      } else {
          echo "Error returning book(s): " . $conn->error;
      }
  } else {
      echo "<script>alert('The book(s) with ID $returned_bookids is not borrowed by the user.');</script>";
  }

  // Close the database connection
  $conn->close();
}
?>
</body>

</html>


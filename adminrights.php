<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login and Signup</title>
  <link rel="stylesheet" href="adminrights.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
<div class="navbar">
    <h3 class="navbar-title">
        <i class="fas fa-book"></i>
        RENT-A-READ
    </h3>
        <a href="admin.php" class="nav-icon">
            <i class="fas fa-home"></i>
            <span>Home</span>
        </a>
        <a href="Admin_form.php" class="nav-icon">
            <i class="fas fa-book"></i>
            <span>Entry Form</span>
        </a>  
        <a href="" class="nav-icon">
            <i class="fas fa-book"></i>
            <span>Books</span>
        </a>  
    </div>
  <div class="container">
    <div class="form-box">
      <div id="login" class="tabcontent">
        <h2>Book Management</h2>
        <form action="book_management.php" method="post">
          <input type="text" name="book-name" placeholder="Book Name" required>
          <input type="text" name="author" placeholder="Author" required>
          <textarea id="description" name="description" placeholder="Description" required></textarea>
          <br>
          <input type="number" id="available-copies" name="available-copies" placeholder="Available Copies" required>
          <button type="submit" name="add-book" id="add-book">Add Book</button>
          <button type="submit" name="delete-book" id="delete-book">Delete Book</button>
          <button type="submit" name="update-book" id="update-book">Update Book</button>
        </form>
      </div>
    </div>
  </div>
  <script src="admin_form.js"></script>
</body>
</html>
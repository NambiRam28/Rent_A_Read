<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Selected Books</title>
</head>

<body>
  <h1>Selected Books</h1>
  <div id="selected-books"></div>

  <script>

    var selectedBooksJson = "<?php echo isset($_GET['books']) ? $_GET['books'] : ''; ?>";
    var selectedBooks = JSON.parse(decodeURIComponent(selectedBooksJson));

 
    var selectedBooksDiv = document.getElementById("selected-books");
    selectedBooks.forEach(function (book) {
      var bookDiv = document.createElement("div");
      bookDiv.textContent = "ID: " + book.Bookid + ", Title: " + book.Book_Name;
      selectedBooksDiv.appendChild(bookDiv);
      console.log(bookDiv)
    });
  </script>
</body>

</html>

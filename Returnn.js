// Returnn.js

$(document).ready(function() {
  // When the page loads, fetch accepted books' information
  fetchAcceptedBooks();

  $('.book-list').on('change', 'input[type="checkbox"]', function () {
    updateSelectedBooks();
});
});

function fetchAcceptedBooks() {
  // Make an AJAX GET request to the PHP script that retrieves accepted books' information
  $.ajax({
    url: 'accept_books.php?accept_requests=true',
    type: 'GET',
    dataType: 'json',
    success: function(response) {
      // Handle the response data here
      if (response.length > 0) {
        // If there are accepted books, dynamically generate the HTML for the book list
        var bookList = $('.book-list ul');
        bookList.empty();

        $.each(response, function(index, book) {
          var listItem = $('<li></li>').text(book.title + ' by ' + book.author);
          bookList.append(listItem);
        });
      } else {
        // If there are no accepted books, display a message or handle it as needed
        var bookList = $('.book-list ul');
        bookList.empty();
        bookList.append('<li>No accepted books found.</li>');
      }
    },
    error: function(xhr, status, error) {
      // Handle the error if the request fails
      console.error('Error fetching accepted books: ' + error);
    }
  });
}
function updateSelectedBooks() {
    // Get the selected book IDs from the checkboxes
    var selectedBooks = [];
    $('input[name="selectedBooks[]"]:checked').each(function () {
        selectedBooks.push($(this).val());
    });

    // You can use the 'selectedBooks' array to perform further actions, such as sending it to the server via AJAX or processing the selections on the client side.
    console.log(selectedBooks);
    // Here, 'selectedBooks' contains an array of Book IDs that are currently selected by the user.
    // You can perform any further operations based on these selected Book IDs.
}
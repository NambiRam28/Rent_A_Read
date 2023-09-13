// const storedBooks = localStorage.getItem("selectedId").split(",");

// // var jsonData = JSON.stringify(storedBooks);
// // console.log(jsonData);
// if (storedBooks) {
//     $.ajax({
//       type: 'POST',
//       url: 'returncopy.php',
//       data: { searchInput: storedBooks }, // Use storedBooks directly without JSON.stringify
//       success: function (response) {
//         console.log('Data sent successfully!');
//         console.log(response);
//       },
//       error: function (exception) {
//         console.log('Error while sending data:', exception);
//       }
//     });
//   } else {
//     console.log("No data found in localStorage or 'selectedId' is not set.");
//   }
// Get the book list container element

// Get the book list container element



// Rest of the code for fetching book details remains the same
var storedBooks = localStorage.getItem("selectedId").split(",");
if (storedBooks) {
  $.ajax({
    type: 'POST',
    url: 'returncopy.php',
    data: { searchInput: storedBooks },
    success: function (response) {
      console.log('Data sent successfully!');
      console.log(response);
      var bookData = JSON.parse(response);
      var bookList = document.getElementById('book-list');
      bookList.innerHTML = " ";

      bookData.forEach(book => {
        var bookCard = document.createElement('div');
        bookCard.className = 'book-card'; // Apply the book card class
      
        bookCard.innerHTML = `
          <h3 class="book-title">${book.Book_Name}</h3>
          <p class="book-author">Author: ${book.Author}</p>
          <p class="book-description">Description: ${book.Description}</p>
          <p class="book-copies">Available Copies: ${book.Available_Copies}</p>
          <p class="book-id">Book ID: ${book.Bookid}</p>
          <input type="checkbox" class="book-checkbox" data-book-id="${book.Bookid}">
          <hr>
        `;
      
        // Add the book card to the book list
        var bookList = document.getElementById('book-list');
        bookList.appendChild(bookCard);
      });
      
      // bookData.forEach(book => {
      //   var listItem = document.createElement('li');
      //   listItem.innerHTML = `
      //     <h3>${book.Book_Name}</h3>
      //     <p>Author: ${book.Author}</p>
      //     <p>Description: ${book.Description}</p>
      //     <p>Available Copies: ${book.Available_Copies}</p>
      //     <p>Book ID: ${book.Bookid}</p>
      //     <hr>
      //   `;
      //   bookList.appendChild(listItem);
      // });
    },
    error: function (exception) {
      console.log('Error while sending data:', exception);
    }
  });
} else {
  console.log("No data found in localStorage or 'selectedId' is not set.");
}


  // // Wait for the DOM to be ready
  // $(document).ready(function () {
  //   // Add an event listener to the "borrow" button
  //   $("#borrowButton").on("click", function () {
  //     // Get the book ID and book name from the first book card (assuming there's only one book for borrowing)
  //     var bookCard = document.querySelector(".book-card");
  //     var bookId = bookCard.querySelector(".book-id").innerText.split(": ")[1];
  //     var bookName = bookCard.querySelector(".book-title").innerText;

  //     // Get the user email from the input field
  //     var userEmail = document.getElementById("userEmail").value;

  //     // Check if the user email is not empty
  //     if (userEmail.trim() === "") {
  //       alert("Please enter your email.");
  //       return;
  //     }

  //     // Send the book details and user email to the admin
  //     $.ajax({
  //       type: 'POST',
  //       url: 'send_borrow_request.php', // Replace with the actual URL for sending requests to the admin
  //       data: {
  //         bookId: bookId,
  //         bookName: bookName,
  //         userEmail: userEmail
  //       },
  //       success: function (response) {
  //         console.log('Request sent successfully!');
  //         console.log(response);
  //       },
  //       error: function (exception) {
  //         console.log('Error while sending request:', exception);
  //       }
  //     });
  //   });
  // });

  $("#borrowButton").on("click", function () {
    // Get the user email from the input field
    // var userEmail = document.getElementById("userEmail").value;

    // // Check if the user email is not empty
    // if (userEmail.trim() === "") {
    //   alert("Please enter your email.");
    //   return;
    // }


    var selectedBookIds = [];
    $(".book-checkbox:checked").each(function () {
      selectedBookIds.push($(this).data("book-id"));
    });

    // Check if any book is selected
    if (selectedBookIds.length === 0) {
      alert("Please select at least one book to borrow.");
      return;
    }

    // Send the book IDs and user email to the admin
    $.ajax({
      type: 'POST',
      url: 'send_borrow_request.php', // Replace with the actual URL for sending requests to the admin
      data: {
        bookIds: selectedBookIds,
        userEmail: userEmail
      },
      success: function (response) {
        console.log('Requests sent successfully!');
        console.log(response);
        // Clear the selectedBooks from local storage after sending the requests
        localStorage.removeItem("selectedBooks");
        alert("Requests sent successfully!");
      },
      error: function (xhr, status, error) {
        console.log('Error while sending requests:', error);
        alert("Error while sending requests. Please try again later.");
      }
    });
    
  });
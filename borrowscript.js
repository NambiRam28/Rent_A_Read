// document.getElementById("searchButton").addEventListener("click", function () {
  //   getBooks();
  // });
  
  
  
  
  // function addToCart() {
  
  //   var selectedBooks = [];
  //   var checkboxes = document.querySelectorAll(".book-card input[type='checkbox']:checked");
  //   // var checkboxes = document.getElementById("book-list").value;
  //   console.log(checkboxes)
  
  //   checkboxes.forEach(function (checkbox) {
  //     const selectedDiv = document.getElementsByClassName('book-card');
  //     selectedDiv.addEventListener('click', function (e) {
  //       console.log(e.target);
  //     })
  //     // console.log(checkbox.Author)
  //     // var bookId = checkbox.value;
  //     // console.log(bookId)
  //     // var bookTitle = checkbox.parentElement.querySelector("h3");
  //     // selectedBooks.push({ id: bookId, title: bookTitle });
  //   });
  
  
  //   var selectedBooksDiv = document.getElementById("selected-books");
  //   selectedBooksDiv.innerHTML = "<h1>Selected Books</h1>";
  //   selectedBooks.forEach(function () {
  //     var bookDiv = document.createElement("div");
  //     bookDiv.className = "selected-book-card";
  //     bookDiv.innerHTML = `
  //     <h3>${book.Book_Name}</h3>x
  //     <ul>
  //   <p>Author : ${book.Author}</p>
  //   <p>Overview : ${book.Description}</p>
  //   <p>Available_Copies: ${book.Available_Copies}</p>
  //     <br>
  //     </ul>
  //     <ul>
  //     <center> <input type="checkbox" value="${book.Bookid}"></center>
  //     </ul>
  //     `;
  //     selectedBooksDiv.appendChild(bookDiv);
  
  //   });
  // }
  
  
  // $(document).ready(function () {
  //   $("#searchButton").on("click", function () {
  //     getBooks();
  //   });
  
  //   $("#addToCartButton").on("click", function () {
  //     addToCart();
  //   });
  // });
  // function addToCart() {
  //   var selectedBooks = [];
  //   var checkboxes = document.querySelectorAll(".book-card input[type='checkbox']:checked");
  //   checkboxes.forEach(function (checkbox) {
  //     var bookId = checkbox.value;
  //     var bookTitle = checkbox.parentElement.querySelector("h3").textContent;
  //     selectedBooks.push({ id: bookId, title: bookTitle });
  //   });
  
  //   console.log("Selected Books:", selectedBooks); // Debug: Check if selectedBooks are captured correctly
  
  //   // Store the selected book data in LocalStorage (optional)
  //   localStorage.setItem("selectedBooks", JSON.stringify(selectedBooks));
  
  //   // Display the selected books on the page
  //   var selectedBooksDiv = document.getElementById("selected-books");
  //   selectedBooksDiv.innerHTML = "<h1>Selected Books</h1>";
  //   selectedBooks.forEach(function (book) {
  //     var bookDiv = document.createElement("div");
  //     bookDiv.textContent = "ID: " + book.id + ", Title: " + book.title;
  //     selectedBooksDiv.appendChild(bookDiv);
  //   });
  
  //   // Hide the book list (optional)
  //   var bookList = document.getElementById("book-list");
  //   bookList.style.display = "none";
  // }
  // document.getElementById("searchButton").addEventListener("click", function () {
  //   getBooks();
  // });
  
  function addToCart() {
    window.location.href = "navigation.php";
  }
  
  const chosenBooks = []
  
  const getBookById = (e)=>{
    chosenBooks.push(+e.target.value)
    localStorage.setItem("selectedId",chosenBooks);
    console.log(chosenBooks)
  }
  
  var currentPage = 1;
var booksPerPage = 10;
var totalBooks = 0;

function getBooks() {
  var searchInput = document.getElementById("searchInput").value;
  var bookList = document.getElementById("book-list");
  bookList.innerHTML = ""; 

  $.ajax({
    type: 'POST',
    url: 'borrowsearch.php',
    data: {
      searchInput: searchInput,
      page: currentPage,
      perPage: booksPerPage
    },
    success: function (response) {
      var result = JSON.parse(response);
      totalBooks = result.total;
      var books = result.books;

      books.forEach(function (book) {
        var listItem = document.createElement("div");
        listItem.className = "book-card";
        listItem.innerHTML = `
          <h3>${book.Book_Name}</h3>
          <ul>
            <p>Author: ${book.Author}</p>
            <p>Overview: ${book.Description}</p>
            <p>Available Copies: ${book.Available_Copies}</p>
            <br>
          </ul>
          <ul>
            <center> <input type="checkbox" onclick="getBookById(event)" value="${book.Bookid}" ${book.Available_Copies < 1 ? "disabled" : ""}></center>
          </ul>
        `;
        bookList.appendChild(listItem);
      });

      updatePagination();
    },
    error: function (exception) {
      console.log(exception);
    }
  });
}

function updatePagination() {
  var totalPages = Math.ceil(totalBooks / booksPerPage);
  var paginationElement = document.getElementById("pagination");

  paginationElement.innerHTML = `
    <p>Page ${currentPage} of ${totalPages}</p>
  `;

  for (var i = 1; i <= totalPages; i++) {
    var pageButton = document.createElement("button");
    pageButton.innerText = i;
    pageButton.value = i;
    pageButton.addEventListener("click", function () {
      currentPage = parseInt(this.value);
      getBooks();
    });

    paginationElement.appendChild(pageButton);
  }
}


  // function getBooks() {
  //   var searchInput = document.getElementById("searchInput").value;
  //   var bookList = document.getElementById("book-list");
  //   //let selectedDiv bookList.innerHTML = "";
  
  //   $.ajax({
  //     type: 'POST',
  //     url: 'borrowsearch.php',
  //     data: {
  //       searchInput: searchInput
  //     },
  //     success: function (response) {
  //       var books = JSON.parse(response);
  //       // console.log(books);
  //       books.forEach(function (book) {
  //         var listItem = document.createElement("div");
  //         listItem.className = "book-card";
  //         // var listItem = document.createElement("li");
  //         listItem.innerHTML = `
  //           <h3>${book.Book_Name}</h3>
  //           <ul>
  //         <p>Author : ${book.Author}</p>
  //         <p>Overview : ${book.Description}</p>
  //         <p>Available_Copies: ${book.Available_Copies}</p>
  //           <br>
  //           </ul>
  //           <ul>
  //           <center> <input type="checkbox" onclick="getBookById(event)" value="${book.Bookid}" ${book.Available_Copies < 1 ? "disabled" : ""}></center>
  //           </ul>
  //         `;
  //         bookList.appendChild(listItem);
  //         console.log(listItem)
  //         totalDiv = document.querySelectorAll('.book-card')
  //         // selectedDiv.map(sd => sd.addEventListener('click',(e)=>console.log(e.target.value)))
  //       });
  //     },
  //     error: function (exception) { 
  //       console.log(exception);
  //     },
  //     complete: function(){
  //       const length = totalDiv.length
  //       console.log(length)
  //     }
  //   });
  // }
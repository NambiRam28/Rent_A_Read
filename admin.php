<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Dashboard</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <style>
    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap');
body, html {
    margin: 0;
    padding: 0;
    font-family: Arial, sans-serif;
  }
  
  /* Navbar styles */
  .navbar {
    background-color: #a13232;
    display: flex;
    align-items: center;
    padding: 10px;
    gap: 50px; /* Adjust the gap as needed */
  }
  
  .navbar-title {
    color: #fff;
    display: flex;
    align-items: center;
    font-size: 24px;
  }
  
  .navbar-title i {
    margin-right: 10px; /* Adjust the spacing between the icon and text */
  }
  
  .nav-icon {
    color: #fff;
    display: flex;
    flex-direction: column;
    align-items: center;
    text-decoration: none;
    font-size: 16px;
  }
  
  
  /* General styles */
  h1 {
    color: #ffffff;
  }
  
  /* Align the h3 text to the left corner */
  .navbar-title {
    margin-right: auto;
    color: #fff;
    font-size: 24px;
  }
  
  /* Adjustments for mobile application */
  @media only screen and (max-width: 600px) {
    .navbar {
      flex-direction: column;
      padding: 10px 0;
    }
  
    .nav-icon {
      margin: 10px 0;
    }
  
    .navbar .nav-links {
      display: none; /* Hide the nav links by default on mobile */
      flex-direction: column;
      align-items: center;
      gap: 20px;
    }
  
    .navbar .nav-links a {
      display: block;
      text-align: center;
    }
  
    .navbar.active .nav-links {
      display: flex; /* Show the nav links when the navbar is active */
    }
  
    .navbar .menu-icon {
      display: flex; /* Show the menu icon by default on mobile */
    }
  
    .navbar.active .menu-icon {
      display: none; /* Hide the menu icon when the navbar is active */
    }
  }

   /* ... (existing CSS rules remain unchanged) ... */

.request {
  position: relative;
  margin: 10px 20px;
  border: 1px solid #ccc;
  padding: 10px;
  cursor: pointer;
  background-color: #ffffffa9;
}

.request-date {
  position: absolute;
  top: 5px;
  right: 5px;
}

/* ... (existing CSS rules remain unchanged) ... */


    .book-ids {
      display: none;
      margin-top: 10px;
    }

    .book-id {
      margin-bottom: 5px;
    }

    /* Add some margin to the top of the requestsContainer */
    #requestsContainer {
      margin-top: 20px;
    }

    h1 {
      text-align: center;
      color: black;
    }

    /* Style for the container holding the button */
    #fetchRequests {
      background-color: #0362dd; /* Green color */
      color: white; /* Text color */
      padding: 10px 20px; /* Add padding to increase size */
      font-size: 16px; /* Increase font size */
      border: none; /* Remove default border */
      cursor: pointer;
      text-align: center;
      border-radius: 12px;
    }
    selector {
    font-size: 80px;
}
    /* Adjust the button on hover */
    #fetchRequests:hover {
      background-color: #00bfff; /* Slightly darker green color */
    }

    .book-id {
      margin-bottom: 5px;
      background-color: #F0FFF0; /* Light gray background */
      padding: 5px;
      border-radius: 4px;
    }

    /* Style for the "Accept" button */
    .acceptBtn {
      background-color: #4CAF50; 
      color: white; /* Text color */
      border: 2px solid #4CAF50; /* Green border */
      border-radius: 25px;
      padding: 5px 10px;
      margin-right: 5px;
      cursor: pointer;
    }

    /* Adjust the "Accept" button on hover */
    .acceptBtn:hover {
      background-color: #45a049; /* Slightly darker green color */
    }

    /* Style for the "Reject" button */
    .rejectBtn {
      background-color: #f44336; /* Red color */
      color: white; /* Text color */
      border: 2px solid #f44336; /* Red border */
      border-radius: 25px;
      padding: 5px 10px;
      cursor: pointer;
    }

    /* Adjust the "Reject" button on hover */
    .rejectBtn:hover {
      background-color: #d32f2f; /* Slightly darker red color */
    }

    #logOut{
      background-color: #FF0000; /* Red color */
      color: white; /* Text color */
      border: none;
      border-radius: 12px;
      padding: 10px;
      margin-top: 10px;
      cursor: pointer;
      font-size: 16px;
      right: 20px;
      position:absolute;
      padding: 10px 20px; 
      text-align: center;
      border-radius: 12px;
    }

    #logOut:hover {
      background-color: #B30000;
    }
    
  </style>
</head>
<body>
<div class="navbar">
    <h3 class="navbar-title">
        <i class="fas fa-book"></i>
        RENT-A-READ
    </h3>
        <a href="adminrights.php" class="nav-icon">
            <i class="fas fa-book"></i>
            <span>Manage Book</span>
        </a>
        <a href="logout.php" class="nav-icon">
            <i class="fas fa-sign-in-alt"></i>
            <span>Log Out</span>
        </a>
    </div>
  <h1>Admin Dashboard</h1>
  <button id="fetchRequests">Fetch Requests</button>
  <div id="requestsContainer"></div>

  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
  <script>
    $(document).ready(function () {
      function checkAvailability(bookId) {
        return new Promise((resolve, reject) => {
          $.ajax({
            type: 'GET',
            url: `check_availability.php?bookId=${bookId}`,
            success: function (response) {
              const { available } = response;
              resolve(available);
            },
            error: function (exception) {
              reject(exception);
            }
          });
        });
      }

      $("#fetchRequests").on("click", function () {
        $.ajax({
          type: 'GET',
          url: 'send_borrow_request.php',
          success: function (response) {
            console.log('Requests fetched successfully!');
            console.log(response);

            if (Array.isArray(response)) {
              response.sort((a, b) => new Date(a.request_date) - new Date(b.request_date));

              var requestsContainer = document.getElementById('requestsContainer');
              requestsContainer.innerHTML = '';

              response.forEach(request => {
                var requestInfo = `
                  <div class="request">
                    <div class="request-content timestamp-and-books">
                      <p><b>${request.user_email} </b>requested to borrow books.</p>
                      <div class="book-ids">
                        <p><strong>Book IDs:</strong></p>
                        ${request.book_ids.split(',').map(bookId => `
                          <div class="book-id">Book ID: ${bookId}
                            <button class="acceptBtn" data-book-id="${bookId}" data-user-email="${request.user_email}">Accept</button>
                            <button class="rejectBtn" data-book-id="${bookId}" data-user-email="${request.user_email}">Reject</button>
                          </div>`).join('')}
                      </div>
                    </div>
                    <div class="request-date">
                      <strong>Request Date: ${request.request_date}</strong> 
                    </div>
                  </div>
                `;
                requestsContainer.innerHTML += requestInfo;
              });

              $(".request").on("click", function () {
                $(this).find(".book-ids").toggle();
              });

              $(".acceptBtn").on("click", function () {
                var bookId = $(this).data("book-id");
                var userEmail = $(this).data("user-email");
                checkAvailability(bookId)
                  .then(available => {
                    if (available) {
                      console.log("Accepted request for Book ID:", bookId);
                      $.ajax({
                        type: 'POST',
                        url: 'accept_book.php',
                        data: {
                          bookId: bookId,
                          email: userEmail,
                          status: 'accepted'
                        },
                        success: function (response) {
                          console.log('Request accepted and saved to the database.');
                        },
                        error: function (exception) {
                          console.log('Error while accepting request:', exception);
                        }
                      });
                    } else {
                      console.log("No available copies for Book ID:", bookId);
                    }
                  })
                  .catch(error => {
                    console.log("Error while checking availability:", error);
                  });
              });

              $(".rejectBtn").on("click", function () {
                var bookId = $(this).data("book-id");
                var userEmail = $(this).data("user-email");
                console.log("Rejected request for Book ID:", bookId);
                $.ajax({
                  type: 'POST',
                  url: 'reject_book.php',
                  data: {
                    bookId: bookId,
                    email: userEmail,
                    status: 'rejected'
                  },
                  success: function (response) {
                    console.log('Request rejected and saved to the database.');
                  },
                  error: function (exception) {
                    console.log('Error while rejecting request:', exception);
                  }
                });
              });

            } else {
              console.log('No requests found or the response is not an array.');
            }
          },
          error: function (exception) {
            console.log('Error while fetching requests:', exception);
          }
        });
      });
    });
  </script>
</body>
</html>
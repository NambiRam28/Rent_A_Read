
<?php
session_start();
session_unset(); // Clear all session variables
session_destroy(); // Destroy the session data
header("Location: welcome.php"); // Redirect the user to the login page after logout
exit();
?>
<!DOCTYPE html>
<html>
<head>
</head>
<body>
  <script>
    // Clear the localStorage when the page loads
    localStorage.clear();
    // Redirect the user to the login page
    window.location.href = "welcome.php";
  </script>
</body>
</html>
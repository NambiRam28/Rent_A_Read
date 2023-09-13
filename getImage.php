<?php
if (isset($_GET['bookId'])) {
    $bookId = $_GET['bookId'];
    $imagePath = "D:/Library_Management_System/project/book" . $bookId . ".jpeg";

    if (file_exists($imagePath)) {
        header("Content-Type: image/jpeg");
        readfile($imagePath);
        exit;
    } else {
        // If the image doesn't exist, you can serve a default image or an error image.
        // For example:
        // $defaultImagePath = "path/to/default-image.jpg";
        // header("Content-Type: image/jpeg");
        // readfile($defaultImagePath);
        exit;
    }
} else {
    // If the bookId parameter is not provided, return an error image or handle the situation accordingly.
    // For example:
    // $errorImagePath = "path/to/error-image.jpg";
    // header("Content-Type: image/jpeg");
    // readfile($errorImagePath);
    exit;
}
